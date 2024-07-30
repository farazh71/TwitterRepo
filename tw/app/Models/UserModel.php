<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'Users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'username',
        'phone_or_email',
        'password',
        'bio',
        'profile_photo_url',
        'cover_photo_url',
        'created_at'
    ];

    // If you want to automatically handle timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; // If you have an updated_at field
}
