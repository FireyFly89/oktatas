<?php
class Validation {
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // Protected = Csak a szülő, és a gyerek fér hozzá
    // Public = Mindenki hozzáfér
    // Private = Csak a szülő fér hozzá
    protected function validate(string $name, array $rules) {
        $messages = [];

        foreach ($rules as $rule) {
            if (!array_key_exists('type', $rule) || !is_string($rule['type'])) {
                continue;
            }

            $type = $rule['type'];
            $value = $this->getValue($name);

            switch($type) {
                case 'required':
                    if (empty($value)) {
                        $messages[] = $rule['message'];
                    }
                    break;
                case 'match':
                    break;
                case 'length':
                    if (!$this->compareLengths($rule, $value)) {
                        $messages[] = $rule['message'];
                    }
                    break;
            }
        }

        if (empty($messages)) {
            return null;
        }

        return $messages;
    }

    private function getValue(string|int $name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return null;
    }

    private function getMin($rule) {
        if (array_key_exists('rule', $rule) && array_key_exists('min', $rule['rule'])) {
            return $rule['rule']['min'];
        }

        return null;
    }

    private function getMax($rule) {
        if (array_key_exists('rule', $rule) && array_key_exists('max', $rule['rule'])) {
            return $rule['rule']['max'];
        }

        return null;
    }

    private function compareLengths(array $rule, string $value) {
        if ($this->getMin($rule) > strlen($value)) {
            return false;
        } else if ($this->getMax($rule) < strlen($value)) {
            return false;
        }

        return true;
    }
}