<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table = 'Likes';
    protected $primaryKey = 'like_id';
    protected $allowedFields = ['user_id', 'tweet_id', 'liked_at'];

    public function getLikesByTweetId($tweetId)
    {
        return $this->where('tweet_id', $tweetId)->findAll();
    }

    public function userHasLiked($userId, $tweetId)
    {
        return $this->where(['user_id' => $userId, 'tweet_id' => $tweetId])->first() !== null;
    }

    public function userExists($userId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Users');
        $builder->select('user_id');
        $builder->where('user_id', $userId);
        return $builder->get()->getRowArray() ? true : false;
    }

    public function toggleLike($tweetId, $userId)
    {
        $existingLike = $this->userHasLiked($userId, $tweetId);

        if ($existingLike) {
            // User has already liked this tweet, so we remove the like
            return $this->where(['user_id' => $userId, 'tweet_id' => $tweetId])->delete();
        } else {
            // User has not liked this tweet, so we add the like
            return $this->insert(['user_id' => $userId, 'tweet_id' => $tweetId]);
        }
    }


}
