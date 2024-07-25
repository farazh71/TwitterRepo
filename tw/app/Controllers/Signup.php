<?php namespace App\Controllers;
   use CodeIgniter\Controller;

   class Signup extends Controller
   {
       public function index()
       {
           return view('signup');
       }
   }