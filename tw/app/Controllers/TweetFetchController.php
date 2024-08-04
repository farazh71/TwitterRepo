<?php

namespace App\Controllers;

use App\Models\TweetFetchModel;
use App\Models\LikeModel;
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
            $userId = $decoded->sub;
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token.');
        }

        $tweetModel = new TweetFetchModel();
        $data['tweets'] = $tweetModel->getTweetsWithUserDetails(3, 0, $userId);

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
            $userId = $decoded->sub;
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token.');
        }

        $tweetModel = new TweetFetchModel();
        $tweets = $tweetModel->getTweetsWithUserDetails(3, $offset, $userId);

        return $this->response->setJSON($tweets);
    }
    
    public function toggleLike()
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
            $key = getenv('SECRET_KEY');
            $algorithm = 'HS256';
            $decoded = JWT::decode($token, new Key($key, $algorithm));
            $userId = $decoded->sub;
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token: ' . $e->getMessage());
        }

        $input = $this->request->getJSON(true);
        $tweetId = $input['tweet_id'] ?? null;

        if (!$tweetId) {
            return $this->failValidationError('Tweet ID is required.');
        }

        $likeModel = new likeModel();
        if (!$likeModel->userExists($userId)) {
            return $this->failNotFound('User not found.');
        }

        $likeModel->toggleLike($tweetId, $userId);

        return $this->respond(['message' => 'Like status toggled successfully.']);
    }
}
