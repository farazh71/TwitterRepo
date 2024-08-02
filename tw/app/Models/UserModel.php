<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'Users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'user_name',
        'Name', // Note the capital 'N'
        'phone_or_email',
        'password',
        'bio',
        'profile_photo_url',
        'cover_photo_url',
        'created_at',
        'date_of_birth',
        'website',
        'location'
    ];

    // Automatically handle timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; // Ensure this field exists in your schema

    // Validation rules
    protected $validationRules = [
        'user_name' => 'required',
        'Name' => 'required',
        'phone_or_email' => 'required',
        'password' => 'required',
        'bio' => 'required',
        'date_of_birth' => 'permit_empty',
        'website' => 'permit_empty',
        'location' => 'permit_empty',
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
