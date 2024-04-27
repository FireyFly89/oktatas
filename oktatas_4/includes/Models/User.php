<?php
// User type
class User
{
    public string $username = '';
    public string $email = '';
    public string $phoneCountry = '';
    public string $phone = '';
    public string $password = '';
    public string $city = '';
    public string $street = '';
    public string $house = '';

    public function __construct(array $data)
    {
        $this->set($data);
    }

    public function create()
    {
    }

    public function read()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    // Setter
    public function set(array $data)
    {
        foreach ($data as $key => $value) {
            if (isset($this->{$key})) {
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
}
