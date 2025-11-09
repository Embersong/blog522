<?php

function calculateController(): void
{
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
}