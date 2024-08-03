<?php

namespace App\Controllers;

use App\Models\TweetFetchModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TweetFetchController extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        helper('url'); // Load the URL helper
    }

    public function index()
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

        $tweetModel = new TweetFetchModel();
        $data['tweets'] = $tweetModel->getTweetsWithUserDetails(10);

        return view('tweet_list', $data);
    }

    public function loadMore($offset)
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

        $tweetModel = new TweetFetchModel();
        $tweets = $tweetModel->getTweetsWithUserDetails(10, $offset);

        return $this->response->setJSON($tweets);
    }
}
