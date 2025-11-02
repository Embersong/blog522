<?php

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
    return [
        1 => [
            'id' => 1,
            'category_id' => 1,
            'title' => 'Пост 1',
            'text' => 'Текст поста 1 о политике'
        ],
        2 => [
            'id' => 2,
            'category_id' => 1,
            'title' => 'Пост 2',
            'text' => 'Текст поста 2 о политике'
        ],
        3 => [
            'id' => 3,
            'category_id' => 2,
            'title' => 'Пост 3',
            'text' => 'Текст поста 3 о спорте'
        ],
        4 => [
            'id' => 4,
            'category_id' => 2,
            'title' => 'Пост 4',
            'text' => 'Текст поста 4 о спорте'
        ],

    ];

}
