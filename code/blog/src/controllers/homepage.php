<?php

namespace Application\Controller;

require_once(__DIR__ . '/../lib/database.php');
require_once(__DIR__ . '/../model/post.php');

use Application\Lib\DatabaseConnection;
use Application\Model\Post\PostRepository;

function homepage()
{
    $connection = new DatabaseConnection();

    $postRepository = new PostRepository();
    $postRepository->connection = $connection;

    $posts = $postRepository->getPosts();

    require('templates/homepage.php');
}
