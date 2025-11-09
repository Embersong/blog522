<?php

function postsIndex():void
{
    $posts = getPosts();

    echo render('posts/index', [
        'posts' => $posts,
    ]);
}

function postShow():void
{
    $success = $_GET['success'] ?? null;
    $id = (int)($_GET['id'] ?? 0);
    $post = getPost($id);

    echo render('posts/show', [
        'post' => $post,
        'success' => $success,
    ]);
}

function postCreate():void
{
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
}