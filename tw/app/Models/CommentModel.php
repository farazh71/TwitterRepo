<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'Comments';
    protected $primaryKey = 'comment_id';
    protected $allowedFields = ['tweet_id', 'user_id', 'content', 'created_at'];

    public function getCommentsByTweetId($tweetId)
    {
        $builder = $this->db->table('Comments');
        $builder->select('Comments.comment_id, Comments.tweet_id, Comments.user_id, Comments.content, Comments.created_at, Users.Name');
        $builder->join('Users', 'Comments.user_id = Users.user_id', 'left');
        $builder->where('Comments.tweet_id', $tweetId);
        $builder->orderBy('Comments.created_at', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}
