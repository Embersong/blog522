<?php

function render(string $page, array $params = []): string
{
    getLogger()->debug("params", $params);
    return renderTemplate('layouts/main', [
        'menu' => renderTemplate('parts/menu'),
        'content' => renderTemplate($page, $params)
    ]);
}

//$params =
// 'name' => 'Alex'
function renderTemplate(string $page, array $params = []): string
{
    ob_start();

    extract($params);

    include VIEWS_PATH . '/' . $page . '.phtml';

    return ob_get_clean();
}