<?php
$post = [
    'title' => 'Un faux titre.',
    'french_creation_date' => '03/03/2022 à 12h14min42s',
    'content' => "Le faux contenu de mon billet.\nC'est fantastique !",
];

$comments = [
    [
        'author' => 'Un premier faux auteur',
        'french_creation_date' => '03/03/2022 à 12h15min42s',
        'comment' => "Un faux commentaire.\n Le premier.",
    ],
    [
        'author' => 'Un second faux auteur',
        'french_creation_date' => '03/03/2022 à 12h16min42s',
        'comment' => "Un faux commentaire.\n Le second.",
    ],
];

require('templates/post.php');
require('src/model.php');

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $identifier = $_GET['id'];
} else {
    echo 'Erreur : aucun identifiant de billet envoyé';
    die;
}

$post = getPost($identifier);
$comments = getComments($identifier);
