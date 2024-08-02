<?php

namespace App\Controllers;

use App\Models\FollowModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class FollowUsersController extends BaseController
{
    use ResponseTrait;

    public function fetchFollowUsers()
    {
        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        if (!$authHeader) {
            return $this->failUnauthorized('Authorization header not found.');
        }

        list($token) = sscanf($authHeader, 'Bearer %s');
        if (!$token) {
            return $this->failUnauthorized('Bearer token not found.');
        }

        try {
            $key = getenv('SECRET_KEY'); // Retrieve the secret key from environment
            $algorithm = 'HS256';
            $decoded = JWT::decode($token, new Key($key, $algorithm));
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token.');
        }

        $userModel = new FollowModel();
        $users = $userModel->getUsers(10); // Fetch 10 users

        return $this->respond($users);
    }
}
