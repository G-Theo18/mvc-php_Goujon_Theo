<?php

namespace Application\Controller;

use Application\Lib\DatabaseConnection;
use Application\Model\Comment\CommentRepository;

function addComment(string $postId, array $input)
{
    if (empty($input['author']) || empty($input['comment'])) {
        throw new \Exception('Les données du formulaire sont invalides.');
    }

    $author = $input['author'];
    $commentText = $input['comment'];

    $connection = new DatabaseConnection();
    $commentRepository = new CommentRepository();
    $commentRepository->connection = $connection;

    $success = $commentRepository->createComment($postId, $author, $commentText);

    if (!$success) {
        throw new \Exception('Impossible d\'ajouter le commentaire !');
    }

    header('Location: index.php?action=post&id=' . $postId);
}
