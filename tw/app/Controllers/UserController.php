<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Files\File;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\Controller;

class UserController extends BaseController
{
    public function insertData()
    {
        $request = service('request');
        $data = json_decode($request->getPost('data'), true);

        $userModel = new UserModel();

        try {
            if ($userModel->insert($data)) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                    ->setBody('Data inserted successfully.');
            } else {
                return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                    ->setBody('Failed to insert data.');
            }
        } catch (DatabaseException $e) {
            // Log the exception to understand the issue
            log_message('error', 'DatabaseException: ' . $e->getMessage());

            if (strpos($e->getMessage(), '1062') !== false) { // Check for duplicate entry error code
                return $this->response->setStatusCode(ResponseInterface::HTTP_CONFLICT)
                    ->setBody('Duplicate entry for username.');
            } else {
                return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setBody('An unexpected error occurred.');
            }
        }
    }

    public function getUserData()
    {
        $userModel = new UserModel();

        // Extract the token from the Authorization header
        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        if (!$authHeader) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                ->setBody('Authorization header not found.');
        }

        list($token) = sscanf($authHeader, 'Bearer %s');
        if (!$token) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                ->setBody('Bearer token not found.');
        }

        $key = getenv('SECRET_KEY');
        $algorithm = 'HS256';

        try {
            // Decode the JWT token
            $decoded = JWT::decode($token, new Key($key, $algorithm));
            $userId = $decoded->sub; // Extract user_id from token

            // Fetch user data from the database
            $userData = $userModel->find($userId);

            if ($userData) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                    ->setJSON($userData);
            } else {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setBody('User not found.');
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., invalid token, expired token)
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                ->setBody('Invalid or expired token.');
        }
    }

    public function uploadPhoto()
    {
        $request = service('request');

        // Extract the JWT token from the Authorization header
        $authHeader = $request->getServer('HTTP_AUTHORIZATION');
        if (!$authHeader) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                ->setBody('Authorization header not found.');
        }

        list($token) = sscanf($authHeader, 'Bearer %s');
        if (!$token) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                ->setBody('Bearer token not found.');
        }

        $key = getenv('SECRET_KEY'); // Retrieve the secret key from environment
        $algorithm = 'HS256';

        try {
            // Decode the JWT token
            $decoded = JWT::decode($token, new Key($key, $algorithm));
            $userId = $decoded->sub; // Extract user_id from token

            $userModel = new UserModel();
            $updateData = [];

            // Check for cover photo upload
            $coverPhoto = $request->getFile('cover_photo');
            if ($coverPhoto && $coverPhoto->isValid() && !$coverPhoto->hasMoved()) {
                $newCoverName = $coverPhoto->getRandomName();
                $coverPhoto->move(WRITEPATH . 'uploads', $newCoverName);
                $updateData['cover_photo_url'] = base_url('uploads/' . $newCoverName);
            }

            // Check for profile photo upload
            $profilePhoto = $request->getFile('profile_photo');
            if ($profilePhoto && $profilePhoto->isValid() && !$profilePhoto->hasMoved()) {
                $newProfileName = $profilePhoto->getRandomName();
                $profilePhoto->move(WRITEPATH . 'uploads', $newProfileName);
                $updateData['profile_photo_url'] = base_url('uploads/' . $newProfileName);
            }

            if (!empty($updateData)) {
                $userModel->update($userId, $updateData);
                return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                    ->setBody('Photos updated successfully.');
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setBody('No valid files uploaded.');
        } catch (\Firebase\JWT\ExpiredException $e) {
            // Handle expired token specifically
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                ->setBody('Token has expired.');
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            // Handle invalid signature
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                ->setBody('Invalid token signature.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                ->setBody('Invalid or expired token.');
        }
    }
}
