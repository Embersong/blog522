<?php

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../config/app.php';

$page = $_GET['page'] ?? 'index';

switch ($page) {
    case 'index':
        echo render('index');
        break;

    case 'calc':
        $result = 0;
        $arg1 = 0;
        $arg2 = 0;

        if (!empty($_POST)) {
            $arg1 = (float)($_POST['arg1'] ?? 0);
            $arg2 = (float)($_POST['arg2'] ?? 0);

            $result = $arg1 + $arg2;
        }
        echo render('calc', [
            'arg1' => $arg1,
            'arg2' => $arg2,
            'result' => $result
        ]);
        break;

    case 'categories':
        $categories = getCategories();

        include VIEWS_PATH . '/categories/index.phtml';
        break;

    case 'posts-by-category':
        $id = (int)($_GET['id'] ?? 0);

        $posts = getPostsByCategoryId($id);
        $categoryName = getCategoryName($id);

        echo render('categories/show', [
            'posts' => $posts,
            'categoryName' => $categoryName,
        ]);
        break;

    case 'posts':
        $posts = getPosts();

        echo render('posts/index', [
            'posts' => $posts,
        ]);

        break;

    case 'post':
        $id = (int)($_GET['id'] ?? 0);
        $post = getPost($id);

        echo render('posts/show', [
            'post' => $post,
        ]);
        break;

    case 'about':
        echo render('about');

        break;

    default:
        die("Нет такой страницы");
}




