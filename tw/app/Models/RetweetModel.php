<?php
namespace App\Models;

use CodeIgniter\Model;

class RetweetModel extends Model
{
    protected $table = 'Retweets';
    protected $primaryKey = 'retweet_id';

    protected $allowedFields = ['tweet_id', 'user_id', 'retweeted_at'];

    protected $useTimestamps = false;
}
