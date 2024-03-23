<?php
// User type
class User extends DatabaseManager
{
    public string $username = '';
    public string $email = '';
    public string $phoneCountry = '';
    public string $phone = '';
    public string $password = '';
    public string $city = '';
    public string $street = '';
    public string $house = '';

    public function __construct(array $data = [])
    {
        parent::__construct();
        $this->set($data);
        $this->tableName = 'users';
    }

    // Setter
    public function set(array $data)
    {
        foreach ($data as $key => $value) {
            if (isset($this->{$key})) {
                if ($key === 'password') {
                    $this->{$key} = password_hash($value, PASSWORD_BCRYPT);
                    continue;
                }

                $this->{$key} = $value;
            }
        }
    }

    // Getter
    public function get(string|array $keys = '')
    {
        if (is_string($keys)) {
            if (!isset($this->{$keys})) {
                return "No such field";
            }

            return $this->{$keys};
        } else if (is_array($keys)) {
            $result = [];

            foreach ($keys as $key) {
                if (!isset($this->{$key})) {
                    continue;
                }

                $result[$key] = $this->{$key};
            }

            return $result;
        }
    }

    public function toArray()
    {
        return (array) $this;
    }
}
