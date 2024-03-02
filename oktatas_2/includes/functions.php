<?php
session_start();
const ROOT_DIR = "/var/www/secondproject/oktatas_2/";

function getTemplate(string $path = '')
{
    ob_start();
    include("templates/$path.php");
    echo ob_get_clean();
}

// Dump Die
function dd(mixed $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function redirect(string $url = "/")
{
    header("Location: $url");
    die();
}

function addError(int|string $key, mixed $value): void
{
    $_SESSION['errors'][$key] = $value;
}

function getError(int|string $key)
{
    if (empty($_SESSION) || !array_key_exists($key, $_SESSION['errors'])) {
        return false;
    }

    return $_SESSION['errors'][$key];
}

function cleanErrors()
{
    $_SESSION = [];
}

function validateUserData(array $data): bool
{
    if (empty($data)) {
        addError('form', "Form was empty");
        return false;
    }

    cleanErrors();
    $success = true;

    if (empty($data['username'])) {
        addError('username', "Username is required");
        $success = false;
    }

    if (empty($data['password'])) {
        addError('password', "Password is required");
        $success = false;
    }

    if (strlen($data['username']) > 20 || strlen($data['username']) <= 2) {
        addError('username', "Username has to be at least 2 characters but maximum 20 characters");
        $success = false;
    }

    return $success;
}

function processUserData(array $data)
{
    if (!empty($data) && validateUserData($data)) {
        file_put_contents(getFilePath('userData', 'json'), json_encode($data));
        redirect();
    }
}

echo processUserData($_POST);

function getFilePath(string $path, string $extension, string $type = '')
{
    if (!empty($type)) {
        $allowedTypes = [
            'template' => 'templates/',
            'includes' => 'includes/',
            'assets' => 'assets/',
            'image' => 'assets/img/',
            'js' => 'assets/js/',
            'css' => 'assets/css/'
        ];

        if (array_key_exists($type, $allowedTypes)) {
            return ROOT_DIR . $allowedTypes[$type] . "$path.$extension";
        }
    }

    return ROOT_DIR . "$path.$extension";
}

function getRandomHash(string $fileName): string
{
    return substr(md5($fileName . rand(1, 9999999) . time()), 0, 10);
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

saveFile();

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

/* HÁZIFELADAT:
Bővítsük ki a felhasználó feltöltését a következő mezőkkel:

telefonszám (külön országhívó kód, külön szám) (text)
email (email)
utca (text)
házszám (text)
ország (text)
feltételeket elfogadó checkbox (checkbox)
neme (radio)

VALIDÁCIÓT IS ÍRJUNK RÁ (a validateUserData függvényben) */