<?php

namespace App\Models;

use CodeIgniter\Model;

class TweetFetchModel extends Model
{
    protected $table = 'Tweets';
    protected $primaryKey = 'tweet_id';

    protected $allowedFields = [
        'user_id',
        'content',
        'media_type',
        'created_at'
    ];

   
    protected $useTimestamps = false;

    public function getTweetsWithUserDetails($limit = 10, $offset = 0)
    {
     
        return $this->select('Tweets.*, Users.profile_photo_url, Users.Name')
                    ->join('Users', 'Users.user_id = Tweets.user_id')
                    ->orderBy('Tweets.created_at', 'DESC')
                    ->findAll($limit, $offset);
    }
}
