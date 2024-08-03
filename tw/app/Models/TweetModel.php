<?php

namespace App\Models;

use CodeIgniter\Model;

class TweetModel extends Model
{
    protected $table = 'Tweets';
    protected $primaryKey = 'tweet_id';
    protected $allowedFields = [
        'user_id',
        'content',
        'media_type',
        'created_at',
        'media_url'
    ];

    public function insertTweet($data)
    {
        return $this->insert($data);
    }
}