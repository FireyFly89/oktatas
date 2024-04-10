<?php
class ValidationError extends Validation {
    public array $validationErrors = [];

    public function __construct(array $map, array $data)
    {
        parent::__construct($data);
        
        foreach ($map as $definition) {
            $definition = array_shift($definition);
            
            if (!array_key_exists('rules', $definition)) {
                continue;
            }
            
            foreach ($definition['rules'] as $rule) {
                if (!array_key_exists('type', $rule) || !is_string($rule['type'])) {
                    continue;
                }

                if ($this->validate($definition['name'], $rule['type'], $rule)) {
                    $this->add($definition['name'], $rule['message']);
                }
            }
        }
    }

    public function add(int|string $name, string $message) {
        $this->validationErrors[$name][] = $message;
    }

    public function remove(int|string $name) {
        if (array_key_exists($name, $this->validationErrors)) {
            unset($this->validationErrors[$name]);
        }
    }
}