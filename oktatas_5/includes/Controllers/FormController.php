<?php
class FormController
{
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->processUserData($data);
        }
    }

    private function processUserData(array $data)
    {
        if (!empty($data)) {
            $formMap = json_decode(getAsset('userForm', 'json', 'definitions'), true);
            $validationError = new ValidationError($formMap, $data);
            $sessionManager = new ErrorSessionManager();
            $sessionManager->addErrors($validationError->validationErrors);
            
            if ($sessionManager->isValidated()) {
                $user = new User($data);
                file_put_contents(getFilePath('userData', 'json'), json_encode($user));
                redirect();
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
            $sessionManager = new ErrorSessionManager();
            $error = $sessionManager->getError($name);
            echo "<span class='form-errors'>$error</span>";
        }
    }
}
