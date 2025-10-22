<?php

require_once('src/lib/database.php');
require_once('src/model/comment.php');

function addComment(string $postId, array $input)
{
    if (empty($input['author']) || empty($input['comment'])) {
        throw new Exception('Les données du formulaire sont invalides.');
    }

    $author = $input['author'];
    $commentText = $input['comment'];

    $commentRepository = new CommentRepository();
    $commentRepository->connection = new DatabaseConnection();

    $success = $commentRepository->createComment($postId, $author, $commentText);

    if (!$success) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }

    header('Location: index.php?action=post&id=' . $postId);
}
