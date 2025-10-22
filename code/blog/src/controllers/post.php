<?php

namespace Application\Controller;

require_once(__DIR__ . '/../lib/database.php');
require_once(__DIR__ . '/../model/post.php');
require_once(__DIR__ . '/../model/comment.php');

use Application\Lib\DatabaseConnection;
use Application\Model\Post\PostRepository;
use Application\Model\Comment\CommentRepository;

function post(string $identifier)
{
    $connection = new DatabaseConnection();

    $postRepository = new PostRepository();
    $postRepository->connection = $connection;
    $post = $postRepository->getPost($identifier);

    $commentRepository = new CommentRepository();
    $commentRepository->connection = $connection;
    $comments = $commentRepository->getComments($identifier);

    require('templates/post.php');
}

