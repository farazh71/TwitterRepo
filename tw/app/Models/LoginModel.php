<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'Users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'user_name',
        'name',
        'phone_or_email',
        'password',
        'bio',
        'profile_photo_url',
        'cover_photo_url',
        'created_at'
    ];
    public function getUserByUsername($username)
    {
        return $this->where('user_name', $username)->first();
    }


    public function verifyPassword($username, $password)
    {
        // Fetch the user by username
        $user = $this->getUserByUsername($username);
        if ($user) {
            // Check if the provided password matches the hashed password
            return $password == $user['password'];
        }

        return false; // User not found or password does not match
    }
    
    // If you want to automatically handle timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; // If you have an updated_at field
}
