<?php

namespace Application\Model\Comment;

use Application\Lib\DatabaseConnection;
use PDO;

class Comment
{
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
}

class CommentRepository
{
    public DatabaseConnection $connection;

    public function getComments(string $postId): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, comment,
            DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date
             FROM comments
             WHERE post_id = ?
             ORDER BY comment_date DESC"
        );
        $statement->execute([$postId]);

        $comments = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comments[] = $comment;
        }

        return $comments;
    }

    public function createComment(string $postId, string $author, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
        );

        return $statement->execute([$postId, $author, $comment]);
    }
}
