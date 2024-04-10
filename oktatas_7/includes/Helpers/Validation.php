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
    protected function validate(string $name, string $type, array $rule = []): bool {
        $value = $this->getValue($name);

        switch($type) {
            case 'required':
                return empty($value) && $value !== 0;
                break;
            case 'match':
                return $this->match($name, $value, $rule);
                break;
            case 'compare_repeat':
                return $this->compareFields($name, $value);
                break;
            case 'compare_with_reference':
                return $this->compareFields($name, $value, $rule);
                break;
            case 'length':
                return $this->compareLengths($rule, $value);
                break;
            default:
                return false;
        }
    }

    private function match(string $name, string $value, array $rule): bool {
        if (!array_key_exists('pattern', $rule) || empty($rule['pattern'])) {
            return true;
        }
        
        return !preg_match($rule['pattern'], $value);
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
            return true;
        } else if ($this->getMax($rule) < strlen($value)) {
            return true;
        }

        return false;
    }

    private function compareFields(string $name, string $value, array $rule = []) {
        $reference = "";

        if (!empty($rule)) {
            if (empty($rule['reference'])) {
                return true;
            }

            $reference = $this->data[$rule['reference']];
        } else {
            $compareFieldName = $name . '_repeat';

            if (!array_key_exists($compareFieldName, $this->data)) {
                return true;
            }

            $reference = $this->data[$compareFieldName];
        }

        return $value !== $reference;
    }
}