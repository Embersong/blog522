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
            $operation = $_POST['operation'] ?? '';
            $result = calculate($arg1, $arg2, $operation);
        }
        echo render('calc', [
            'arg1' => $arg1,
            'arg2' => $arg2,
            'result' => $result
        ]);
        break;

    case 'categories':
        $categories = getCategories();

        echo render('categories/index', [
            'categories' => $categories,
        ]);
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
        $success = $_GET['success'] ?? null;
        $id = (int)($_GET['id'] ?? 0);
        $post = getPost($id);

        echo render('posts/show', [
            'post' => $post,
            'success' => $success,
        ]);
        break;

    case 'post-create':
        $categories = getCategories();
        $success = $_GET['success'] ?? null;

        if (!empty($_POST)) {

            //добавляете пост в файл

            $title = htmlspecialchars($_POST['title']);
            $text = htmlspecialchars($_POST['text']);
            $category_id = (int)$_POST['category_id'];

            //Валидация
            if (empty($title) || empty($text) || empty($category_id)) {
                header('Location: ?page=post-create&success=0');
                die();
            }
            $lastKey = createPost($title, $text, $category_id);

            //редирект методом GET
            header('Location: ?page=post&id=' . $lastKey . '&success=1');
            die();
        }
        echo render('posts/create', [
            'categories' => $categories,
            'success' => $success,
        ]);
        break;

    case 'about':
        echo render('about');

        break;

    default:
        die("Нет такой страницы");
}




