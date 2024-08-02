<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowModel extends Model
{
    protected $table = 'Users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'user_name',
        'Name',
        'profile_photo_url'
    ];

    public function getUsers($limit = 10)
    {
        return $this->select('Name, profile_photo_url, user_id, user_name')
                    ->limit($limit)
                    ->findAll();
    }
}
