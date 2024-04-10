<?php
// Dump Die
// Arbitrary number of arguments
function dd(mixed ...$data)
{
    echo "<pre>";
    if (count($data) > 1)  {
        foreach ($data as $output) {
            var_dump($output);
            echo "<br/>";
        }
    } else {
        var_dump(array_shift($data));
    }
    echo "</pre>";
    die();
}

function dump(mixed ...$data)
{
    echo "<pre>";
    if (count($data) > 1)  {
        foreach ($data as $output) {
            var_dump($output);
            echo "<br/>";
        }
    } else {
        var_dump(array_shift($data));
    }
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
