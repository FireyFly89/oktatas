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
            
            $messages = $this->validate($definition['name'], $definition['rules']);

            if ($messages) {
                foreach($messages as $message) {
                    $this->add($definition['name'], $message);
                }
            }
        }
    }

    public function add(int|string $name, string $message) {
        $this->validationErrors[$name][] = $message;
    }

    public function remove() {
        
    }
}