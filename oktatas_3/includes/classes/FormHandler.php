<?php
class FormHandler {
    private function getInputTemplate(string $name, string $type, string $label = "", string $id = "", bool $error = true, bool $replaceValue = true) {
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
            $error = $this->getError($name);
            echo "<span class='form-errors'>$error</span>";
        }
    }
    
    private function addError(int|string $key, mixed $value): void {
        $_SESSION['errors'][$key] = $value;
    }
    
    private function getError(int|string $key): string {
        if (empty($_SESSION) || !array_key_exists($key, $_SESSION['errors'])) {
            return false;
        }
    
        return $_SESSION['errors'][$key];
    }
    
    private function isValidated(): bool {
        return !array_key_exists('errors', $_SESSION) || empty($_SESSION['errors']);
    }
    
    private function cleanErrors(): void {
        $_SESSION = [];
    }
    
    private function validate(array $data, array $formMap): void {
       $this->cleanErrors();
    
       if (!empty($data)) {
            foreach($formMap as $fieldKey => $definition) {
                foreach($definition[0]['rules'] as $rule) {
                    if (is_string($rule['rule']) && $rule['rule'] === 'required') {
                        if (array_key_exists($fieldKey, $data) && empty($data[$fieldKey])) {
                            $this->addError($fieldKey, $rule['message']);
                        }
                    } else if (is_array($rule['rule'])) {
                        foreach($rule['rule'] as $type => $complexRule) {
                            if ($type === 'min') {
                                if (strlen($data[$fieldKey]) < $complexRule) {
                                    $this->addError($fieldKey, $rule['message']);
                                }
                            } else if ($type === 'max') {
                                if (strlen($data[$fieldKey]) > $complexRule) {
                                    $this->addError($fieldKey, $rule['message']);
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $this->addError('form', "Form was empty");
        }
    }
    
    public function generateForm() {
        $formMap = json_decode(getAsset('userForm', 'json', 'definitions'), true);
    
        foreach($formMap as $fieldKey => $definition) {
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
            $this->getInputTemplate($theDefinition['name'], $type, $label, $id, $error);
        }
    }
    
    public function processUserData(array $data) {
        if (!empty($data)) {
            $formMap = json_decode(getAsset('userForm', 'json', 'definitions'), true);
            $this->validate($data, $formMap);
    
            if ($this->isValidated()) {
                file_put_contents(getFilePath('userData', 'json'), json_encode($data));
                redirect();
            }
        }
    }
}
