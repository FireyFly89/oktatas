<?php
class UserController
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
                $sanitizer = new Sanitize($data);
                $data = $sanitizer->sanitize($data);
                $user = new User($data);
                $user->create();
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
            $rules = [];

            if (array_key_exists('rules', $theDefinition)) {
                $rules = $theDefinition['rules'];
                
            }

            self::getInputTemplate($theDefinition['name'], $type, $label, $id, $error, $rules);
        }
    }

    private static function getInputTemplate(string $name, string $type, string $label = "", string $id = "", bool $error = true, array $rules, bool $replaceValue = true)
    {
        if (empty($name)) {
            return false;
        }

        if (empty($id)) {
            $id = $name;
        }

        $isRequired = false;

        foreach ($rules as $rule) {
            if (empty($rule) || !array_key_exists('type', $rule)) {
                continue;
            }

            if ($rule['type'] === 'required') {
                $isRequired = true;
            }
        }

        echo "<div>";

        if (!empty($label)) {
            if ($isRequired) {
                $label .= " *";
            }
            
            echo "<label for='$id'>$label</label>";
        }

        $value = '';

        if ($replaceValue && !empty($_POST[$name])) {
            $value = $_POST[$name];
        }

        echo "<input type='$type' name='$name' id='$id' value='$value' />";

        if ($error) {
            $sessionManager = new ErrorSessionManager();
            $errorMessage = $sessionManager->getError($name);
            echo "<span class='form-errors'>$errorMessage</span>";
        }

        echo "</div>";
    }
}
