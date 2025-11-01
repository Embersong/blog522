<?php

include __DIR__ . '/../vendor/autoload.php';


$page = $_GET['page'] ?? 'index';

switch ($page) {
    case 'index':
        include __DIR__ . '/../views/index.phtml';
        break;

    case 'posts':
        $posts = getPosts();
        include __DIR__ . '/../views/posts/posts.phtml';
        break;

    case 'post':
        $id = $_GET['id'] ?? 0;
        $post = getPost($id);

        include __DIR__ . '/../views/posts/post.phtml';
        break;

    case 'about':
        include __DIR__ . '/../views/about.phtml';
        break;

    default:
        die("Нет такой страницы");
}




