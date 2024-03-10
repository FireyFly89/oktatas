<?php
// Dump Die
function dd(mixed $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function dump(mixed $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function getRandomHash(string $fileName): string
{
    return substr(md5($fileName . rand(1, 9999999) . time()), 0, 10);
}

function redirect(string $url = "/")
{
    header("Location: $url");
    die();
}
