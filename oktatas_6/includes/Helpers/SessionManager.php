<?php
class SessionManager {
    public function __construct()
    {
        if (session_status() === 0) {
            return "Sessions are disabled!";
        }
        
        if (session_status() !== 2) {
            session_start();
        }
    }

    public function get(int|string $container, int|string $key): string|null {
        if (!array_key_exists($container, $_SESSION) || !array_key_exists($key, $_SESSION)) {
            return null;
        }

        return $_SESSION[$container][$key];
    }

    public function set(int|string $container, mixed $value, int|string $key = null): void
    {
        if (empty($key)) {
            $_SESSION[$container] = $value;
        } else {
            $_SESSION[$container][$key] = $value;
        }
    }

    public function removeKey(int|string $container, int|string $key): void
    {
        if (!array_key_exists($container, $_SESSION) || !array_key_exists($key, $_SESSION)) {
            return;
        }

        unset($_SESSION[$container][$key]);
    }

    public function remove(int|string $container): void
    {
        if (!array_key_exists($container, $_SESSION)) {
            return;
        }

        unset($_SESSION[$container]);
    }
}