<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\TweetFetchModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CommentController extends BaseController
{
    use ResponseTrait;

    public function submitComment()
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
            $key = getenv('SECRET_KEY'); // Retrieve the secret key from the environment
            $algorithm = 'HS256';
            $decoded = JWT::decode($token, new Key($key, $algorithm));
            $userId = $decoded->sub;
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token: ' . $e->getMessage());
        }

        $input = $this->request->getJSON(true); // true to get an associative array

        // Extract tweet_id and content from the decoded JSON
        $tweetId = $input['tweet_id'] ?? null;
        $content = $input['content'] ?? null;

        
        $tweetModel = new TweetFetchModel();
        $tweet = $tweetModel->find($tweetId);

        if (!$tweet) {
            return $this->failNotFound('Tweet not found.');
        }

        $commentModel = new CommentModel();
        $data = [
            'tweet_id' => $tweetId,
            'user_id' => $userId,
            'content' => $content,
        ];

        if ($commentModel->insert($data)) {
            return $this->respondCreated(['message' => 'Comment submitted successfully.']);
        } else {
            return $this->fail('Failed to submit comment.');
        }
    }

    public function getComments($tweetId)
    {
        $commentModel = new CommentModel();
        $comments = $commentModel->getCommentsByTweetId($tweetId);

        return $this->respond($comments);
    }
}
