<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\Exceptions\DatabaseException;

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
}
