<?php
class Sanitize {
    protected mixed $data;

    public function __construct(mixed $data) {
        $this->data = $data;
    }

    public function sanitize(): mixed {
        if (is_array($this->data)) {
            foreach ($this->data as $key => $data) {
                if (str_contains($key, '_repeat')) {
                    unset($this->data[$key]);
                }
            }
        }

        return $this->data;
    }
}