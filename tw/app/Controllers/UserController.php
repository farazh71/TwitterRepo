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
            if ($e->getCode() == 1062) { // MySQL error code for duplicate entry
                return $this->response->setStatusCode(ResponseInterface::HTTP_CONFLICT)
                                      ->setBody('Duplicate entry for username.');
            } else {
                return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                                      ->setBody('An unexpected error occurred.');
            }
        }
    }
}
