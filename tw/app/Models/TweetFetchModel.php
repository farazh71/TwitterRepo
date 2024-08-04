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

    public function getTweetsWithUserDetails($limit = 5, $offset = 0, $userId)
    {
        $builder = $this->db->table('Tweets')
            ->select('Tweets.*, Users.profile_photo_url, Users.Name, COUNT(Likes.tweet_id) as like_count, 
                      IF(EXISTS(SELECT 1 FROM Retweets WHERE Retweets.tweet_id = Tweets.tweet_id AND Retweets.user_id = ' . $userId . '), TRUE, FALSE) AS is_retweeted', false)
            ->join('Users', 'Users.user_id = Tweets.user_id')
            ->join('Likes', 'Likes.tweet_id = Tweets.tweet_id', 'left')
            ->join('Retweets', 'Retweets.tweet_id = Tweets.tweet_id', 'left')
            ->groupBy('Tweets.tweet_id')
            ->orderBy('Tweets.created_at', 'DESC')
            ->limit($limit, $offset);

        $tweets = $builder->get()->getResultArray();

        // Check if the user has liked each tweet
        foreach ($tweets as &$tweet) {
            $tweet['liked'] = $this->db->table('Likes')
                ->where('tweet_id', $tweet['tweet_id'])
                ->where('user_id', $userId)
                ->countAllResults() > 0;
            
            $tweet['retweet_count'] = $this->db->table('Retweets')
                ->where('tweet_id', $tweet['tweet_id'])
                ->countAllResults();
        }

        return $tweets;
    }
}
