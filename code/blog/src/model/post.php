<?php

require_once('src/model/post.php');


class Post
{
    public int $identifier;
    public string $title;
    public string $content;
    public string $frenchCreationDate;
}

function postDbConnect(): PDO
{
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'password');
    return $database;
}



