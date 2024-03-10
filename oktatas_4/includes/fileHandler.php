<?php
// TODO: Külső scopeokra nézni megoldást
function getTemplate(string $path = '')
{
    ob_start();
    include("templates/$path.php");
    echo ob_get_clean();
}

function getFilePath(string $path, string $extension, string $type = '')
{
    if (!empty($type)) {
        $allowedTypes = [
            'template' => 'templates/',
            'includes' => 'includes/',
            'assets' => 'assets/',
            'image' => 'assets/img/',
            'js' => 'assets/js/',
            'css' => 'assets/css/',
            'validations' => 'validations/',
            'definitions' => 'templates/formDefinitions/',
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

function saveFile()
{
    if (empty($_FILES) || !array_key_exists('tmp_name', $_FILES['file'])) {
        return;
    }

    $fileData = $_FILES['file'];

    if (!str_contains($fileData['type'], 'image')) {
        return;
    }

    $extension = 'png';

    if ($fileData['type'] === 'image/jpeg') {
        $extension = "jpg";
    }

    move_uploaded_file($_FILES['file']['tmp_name'], getFilePath(getRandomHash($fileData['name']), $extension, 'image'));
    redirect();
}

function isFileExists()
{
    // ha létezik a file
}

function generateUniqueFileName()
{
    $fileName = getRandomHash();

    if (!isFileExists($fileName)) {
        return $fileName;
    }

    $i = 1;

    while (isFileExists($fileName)) {
        $i++;
        $fileName = $fileName . $i;
    }

    return $fileName;
}
