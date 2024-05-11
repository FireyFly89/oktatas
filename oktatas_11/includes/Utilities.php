<?php
function getFilePath(string $path, string $extension, string $type = '')
{
    if (!empty($type)) {
        $allowedTypes = [
            'template' => '/templates/',
            'includes' => '/includes/',
            'assets' => '/assets/',
            'image' => '/assets/img/',
            'js' => '/assets/js/',
            'css' => '/assets/css/',
            'validations' => '/validations/',
            'definitions' => '/templates/formDefinitions/',
        ];

        if (array_key_exists($type, $allowedTypes)) {
            return ROOT_DIR . $allowedTypes[$type] . "$path.$extension";
        }
    }

    return ROOT_DIR . "$path.$extension";
}

function getAsset(string $fileName, string $extension, string $type = '')
{
    return file_get_contents(getFilePath($fileName, $extension, $type));
}

function getTemplatePart(string $part, ...$var) {
    if ($part === 'messages') {
        list($messages) = $var;
    }

    ob_start();
    require_once "templates/$part.php";
    return ob_get_clean();
}

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

function isPostData($key, $value) {
    if (!array_key_exists($key, $_POST)) {
        return false;
    }

    if ($_POST[$key] !== $value) {
        return false;
    }

    return true;
}