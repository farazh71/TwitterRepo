<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function insertData()
    {
        $request = service('request');
            $data = json_decode($request->getPost('data'), true);

            $userModel = new UserModel();
        if ($userModel->insert($data)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                                  ->setBody('Data inserted successfully.');
        } else {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                                  ->setBody('Failed to insert data.');
        }
    }
}
