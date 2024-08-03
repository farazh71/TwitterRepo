<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Login::index');
$routes->get('main', 'Main::index');
$routes->get('signup', 'Signup::index');
$routes->post('insertData', 'UserController::insertData');
$routes->post('loginUser', 'LoginController::loginUser');
$routes->post('verifyToken', 'LoginController::verifyToken');
$routes->get('user/data', 'UserController::getUserData');
$routes->post('upload-photo', 'UserController::uploadPhoto');
$routes->get('uploads/(:segment)', 'FileController::serve/$1');
$routes->post('updateProfile', 'UserController::updateProfile');
$routes->get('user/fetchFollowUsers', 'FollowUsersController::fetchFollowUsers');
$routes->post('tweet/upload', 'TweetController::uploadTweet');
$routes->get('tweet-list', 'TweetFetchController::index');
$routes->get('tweet-fetch-more/(:num)', 'TweetFetchController::loadMore/$1');
$routes->post('submit-comment', 'CommentController::submitComment');
$routes->get('get-comments/(:num)', 'CommentController::getComments/$1');
// $routes->post('tweet/like', 'TweetController::toggleLike');
// $routes->get('tweet/likes/(:num)', 'TweetController::getLikes/$1');
