<?php

function createPost(string $title, string $text, int $category_id): int
{
    $posts = getPosts();

    //создаем новый пост в массиве, id генерится автоматом
    $posts[] = [
        'category_id' => $category_id,
        'title' => $title,
        'text' => $text,
    ];

    //добавляем сгенерированный id в массив
    $lastKey = array_key_last($posts);
    $posts[$lastKey]['id'] = $lastKey;

    //сделать красиво, чтобы id шел первым
    $posts[$lastKey] = array_merge(['id' => $lastKey], $posts[$lastKey]);

    file_put_contents(ROOT_PATH . '/posts.json', json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    return $lastKey;
}

function getPost(int $id): ?array
{
    return getPosts()[$id] ?? null;
}

function getPostsByCategoryId(int $id): ?array
{
    $filteredPosts = array_filter(getPosts(), function($post) use ($id) {
        return $post['category_id'] === $id;
    });

    return !empty($filteredPosts) ? array_values($filteredPosts) : null;
}


function getPosts(): array
{
    return json_decode(file_get_contents(ROOT_PATH . '/posts.json'), true);
}
