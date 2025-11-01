<?php

function getPost(int $id): ?array
{
    return getPosts()[$id] ?? null;
}

function getCategories(): array
{
    return [
        1 => [
            'id' => 1,
            'name' => 'Политика',
            'slug' => 'politics'
        ]
    ];
}

function getPosts(): array
{
    return [
        1 => [
            'id' => 1,
            'category_id' => 1,
            'title' => 'Пост 1',
            'text' => 'Текст поста 1'
        ],
        2 => [
            'id' => 2,
            'title' => 'Пост 2',
            'text' => 'Текст поста 2'
        ],
    ];

}