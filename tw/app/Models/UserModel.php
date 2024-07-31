<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
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

    // Automatically handle timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; // If you have an updated_at field

    // Validation rules
    protected $validationRules = [
        'user_name' => 'required|is_unique[Users.user_name]',
        'name' => 'required',
        'phone_or_email' => 'required',
        'password' => 'required',
        'bio' => 'required'
    ];

    // Validation messages
    protected $validationMessages = [
        'user_name' => [
            'is_unique' => 'The username is already taken. Please choose a different username.'
        ]
    ];

    // Skip validation if the data is empty
    protected $skipValidation = false;
}
