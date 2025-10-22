<?php

class Post
{
    public string $title;
    public string $frenchCreationDate;
    public string $content;
    public string $identifier;
}

class PostRepository
{
    private ?PDO $database = null;

    private function dbConnect(): void
    {
        if ($this->database === null) {
            $this->database = new PDO(
                'mysql:host=localhost;dbname=blog;charset=utf8',
                'blog',
                'password'
            );
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    public function getPosts(): array
    {
        $this->dbConnect();
        $statement = $this->database->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts"
        );

        $posts = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post();
            $post->title = $row['title'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->content = $row['content'];
            $post->identifier = $row['id'];

            $posts[] = $post;
        }

        return $posts;
    }

    public function getPost(string $identifier): ?Post
    {
        $this->dbConnect();
        $statement = $this->database->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date  FROM posts WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $post = new Post();
        $post->title = $row['title'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->content = $row['content'];
        $post->identifier = $row['id'];

        return $post;
    }
}
