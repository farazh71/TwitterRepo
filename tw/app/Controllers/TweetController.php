<?php

namespace App\Controllers;

use App\Models\TweetModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TweetController extends BaseController
{
    use ResponseTrait;

    public function uploadMedia($fileInputName)
    {
        $request = service('request');
        $mediaFile = $request->getFile($fileInputName);

        if ($mediaFile && $mediaFile->isValid() && !$mediaFile->hasMoved()) {
            $newFileName = $mediaFile->getRandomName();
            $mediaFile->move(WRITEPATH . 'uploads', $newFileName);
            return base_url('uploads/' . $newFileName);
        }

        return null;
    }
    public function uploadTweet()
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
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token.');
        }

        if (!isset($decoded->sub)) {
            return $this->failUnauthorized('User ID not found in token.');
        }

        $userId = $decoded->sub;
        $content = $this->request->getPost('content');
        $mediaType = $this->request->getPost('media_type');

        if (empty($content)) {
            return $this->failValidationErrors('Tweet content is required.');
        }

        $mediaUrl = null;
        if ($this->request->getFile('media')) {
            $mediaUrl = $this->uploadMedia('media');
        }

        $tweetData = [
            'user_id' => $userId,
            'content' => $content,
            'media_type' => $mediaType,
            'media_url' => $mediaUrl,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $tweetModel = new TweetModel();
        if ($tweetModel->insertTweet($tweetData)) {
            return $this->respondCreated(['message' => 'Tweet posted successfully.']);
        } else {
            return $this->fail('Failed to post tweet.');
        }
    }
    public function retweet()
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
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token.');
        }

        if (!isset($decoded->sub)) {
            return $this->failUnauthorized('User ID not found in token.');
        }

        $userId = $decoded->sub;
        $input = $this->request->getJSON(true);
        $tweetId = $input['tweet_id'] ?? null;

        if (!$tweetId || !$userId) {
            return $this->failValidationError('Invalid tweet ID or user ID.');
        }

        $retweetModel = new \App\Models\RetweetModel();

        // Check if the user has already retweeted this tweet
        $existingRetweet = $retweetModel->where('tweet_id', $tweetId)
                                        ->where('user_id', $userId)
                                        ->first();

        if ($existingRetweet) {
            return $this->fail('Already retweeted.');
        }

        $data = [
            'tweet_id' => $tweetId,
            'user_id'  => $userId,
            'retweeted_at' => date('Y-m-d H:i:s')
        ];

        if ($retweetModel->insert($data)) {
            return $this->respondCreated(['message' => 'Retweet successful.']);
        } else {
            return $this->fail('Failed to retweet.');
        }
    }
}
