<?php
class ErrorSessionManager extends SessionManager {
    private $container = 'errors';

    public function __construct()
    {
        parent::__construct();
    }

    public function isValidated(): bool
    {
        return !array_key_exists($this->container, $_SESSION) || empty($_SESSION[$this->container]);
    }

    public function getError(int | string $key): string
    {
        return $this->get($this->container, $key) ?? '';
    }

    public function addError(int | string $key, mixed $value): void
    {
        $this->set($this->container, $value, $key);
    }

    public function removeErrors(): void
    {
        $this->remove($this->container);
    }

    public function addErrors(mixed $value): void
    {
        $this->set($this->container, $value);
    }
}