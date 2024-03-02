<?php
/*
function getInputTemplate(string $name, string $type, string $label = "", string $id = "", bool $error = true, bool $replaceValue = true) {
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
        $error = getError($name);
        echo "<span class='form-errors'>$error</span>";
    }
}

function addError(int|string $key, mixed $value): void {
    $_SESSION['errors'][$key] = $value;
}

function getError(int|string $key): string {
    if (empty($_SESSION) || !array_key_exists($key, $_SESSION['errors'])) {
        return false;
    }

    return $_SESSION['errors'][$key];
}

function isValidated(): bool {
    return !array_key_exists('errors', $_SESSION) || empty($_SESSION['errors']);
}

function cleanErrors(): void {
    $_SESSION = [];
}

function validate(array $data, array $formMap): void {
   cleanErrors();

   if (!empty($data)) {
        foreach($formMap as $fieldKey => $definition) {
            foreach($definition[0]['rules'] as $rule) {
                if (is_string($rule['rule']) && $rule['rule'] === 'required') {
                    if (array_key_exists($fieldKey, $data) && empty($data[$fieldKey])) {
                        addError($fieldKey, $rule['message']);
                    }
                } else if (is_array($rule['rule'])) {
                    foreach($rule['rule'] as $type => $complexRule) {
                        if ($type === 'min') {
                            if (strlen($data[$fieldKey]) < $complexRule) {
                                addError($fieldKey, $rule['message']);
                            }
                        } else if ($type === 'max') {
                            if (strlen($data[$fieldKey]) > $complexRule) {
                                addError($fieldKey, $rule['message']);
                            }
                        }
                    }
                }
            }
        }
    } else {
        addError('form', "Form was empty");
    }
}

function generateForm() {
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
        getInputTemplate($theDefinition['name'], $type, $label, $id, $error);
    }
}

function processUserData(array $data) {
    if (!empty($data)) {
        $formMap = json_decode(getAsset('userForm', 'json', 'definitions'), true);
        validate($data, $formMap);

        if (isValidated()) {
            file_put_contents(getFilePath('userData', 'json'), json_encode($data));
            redirect();
        }
    }
}


// RÉGI
function validateUserData(array $data): bool {
    cleanErrors();

    if (empty($data)) {
        addError('form', "Form was empty");
        return false;
    }

    if (array_key_exists('username', $data) && empty($data['username'])) {
        addError('username', "Username is required");
    }

    if (array_key_exists('password', $data) && empty($data['password'])) {
        addError('password', "Password is required");
    }

    if (array_key_exists('username', $data) && strlen($data['username']) > 20 || strlen($data['username']) <= 2) {
        addError('username', "Username has to be at least 2 characters but maximum 20 characters");
    }

    validatePhoneData();
}

// RÉGI
function validatePhoneData(array $data): bool {
    if (array_key_exists('phone', $data) && array_key_exists('phone_country', $data) && empty($data['phone']) || empty($data['phone_country'])) {
        addError('phone', "Phone number is required");
    }
}
*/