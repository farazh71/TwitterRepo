<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use App\Models\LoginModel;

class LoginController extends ResourceController
{
    protected $modelName = 'App\Models\LoginModel';
    protected $format = 'json';
    public function __construct()
    {
        $this->model = new LoginModel();
    }
    public function loginUser()
    {
        $data = $this->request->getPost();

        $userData = $data['data'];
        $x = json_decode($userData);
        $username = $x->user_name;
        $password = $x->password;

        $user = $this->model->getUserByUsername($username);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        if (!$this->model->verifyPassword($username, $password)) {
            return $this->fail('Incorrect password');
        }
        $key = env('SECRET_KEY');
        $algorithm = 'HS256';
        $payload = [
            'iat' => time(), // Issued at 
            'exp' => time() + 3600, // Expiration time 
            'sub' => $user['user_id'] // Subject 
        ];
        $token = JWT::encode($payload, $key,  $algorithm );
        return $this->respond(['token' => $token]);
    }
}