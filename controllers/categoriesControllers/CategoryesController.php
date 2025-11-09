<?php

function categoriesIndex():void
{
    $categories = getCategories();

    echo render('categories/index', [
        'categories' => $categories,
    ]);
}

function categoriesPostByCategory():void
{
    $id = (int)($_GET['id'] ?? 0);

    $posts = getPostsByCategoryId($id);
    $categoryName = getCategoryName($id);

    echo render('categories/show', [
        'posts' => $posts,
        'categoryName' => $categoryName,
    ]);
}