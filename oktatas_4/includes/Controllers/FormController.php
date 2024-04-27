<?php
class FormController
{
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->processUserData($data);
        }
    }

    private function isValidated(): bool
    {
        return !array_key_exists('errors', $_SESSION) || empty($_SESSION['errors']);
    }

    private function processUserData(array $data)
    {
        if (!empty($data)) {
            $formMap = json_decode(getAsset('userForm', 'json', 'definitions'), true);
            //$this->validate($data, $formMap);
            $validationError = new ValidationError($formMap, $data);

            if ($this->isValidated()) {
                $user = new User($data);

                //file_put_contents(getFilePath('userData', 'json'), json_encode($data));
                //redirect();
            }
        }
    }

    public static function generateForm()
    {
        $formMap = json_decode(getAsset('userForm', 'json', 'definitions'), true);

        foreach ($formMap as $fieldKey => $definition) {
            $theDefinition = $definition[0];

            if (!array_key_exists('name', $theDefinition)) {
                continue;
            }

            $type = "text";

            if (array_key_exists('type', $theDefinition)) {
                $type = $theDefinition['type'];
            }

            $label = "";

            if (array_key_exists('label', $theDefinition)) {
                $label = $theDefinition['label'];
            }

            $error = true;

            if (array_key_exists('error', $theDefinition) && $theDefinition['error'] === false) {
                $error = false;
            }

            $id = $theDefinition['name'];
            self::getInputTemplate($theDefinition['name'], $type, $label, $id, $error);
        }
    }

    private static function getInputTemplate(string $name, string $type, string $label = "", string $id = "", bool $error = true, bool $replaceValue = true)
    {
        if (empty($name)) {
            return false;
        }

        if (empty($id)) {
            $id = $name;
        }

        if (!empty($label)) {
            echo "<label for='$id'>$label</label>";
        }

        $value = '';

        if ($replaceValue && !empty($_POST[$name])) {
            $value = $_POST[$name];
        }

        echo "<input type='$type' name='$name' id='$id' value='$value' />";

        if ($error) {
            $error = self::getError($name);
            echo "<span class='form-errors'>$error</span>";
        }
    }

    private static function getError(int | string $key): string
    {
        if (empty($_SESSION) || !array_key_exists($key, $_SESSION['errors'])) {
            return false;
        }

        return $_SESSION['errors'][$key];
    }

    private function addError(int | string $key, mixed $value): void
    {
        $_SESSION['errors'][$key] = $value;
    }

    private function cleanErrors(): void
    {
        $_SESSION = [];
    }
}
