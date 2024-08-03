<?php

namespace App\Controllers;

use App\Models\TweetFetchModel;

class TweetFetchController extends BaseController
{
    public function __construct()
    {
        helper('url');
    }

    public function index()
    {
        $tweetModel = new TweetFetchModel();
        $data['tweets'] = $tweetModel->getTweetsWithUserDetails(3);
        return view('tweet_list', $data);
    }

    public function loadMore($offset)
    {
        $tweetModel = new TweetFetchModel();
        $tweets = $tweetModel->getTweetsWithUserDetails(3, $offset);

        return $this->response->setJSON($tweets);
    }
}
