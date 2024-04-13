<?php
class Model extends DatabaseManager
{
    public function __construct(array $data = [])
    {
        parent::__construct();
        $this->set($data);
    }

    public function set(array $data)
    {
        $preparedData = [];

        foreach ($data as $key => $value) {
            if (isset($this->{$key})) {
                if ($key === 'password') {
                    $encryptedPassword = password_hash($value, PASSWORD_BCRYPT);
                    $this->{$key} = $encryptedPassword;
                    $preparedData[$key] = $encryptedPassword;
                    continue;
                }

                if (!empty($insertId = self::$connection->lastInsertId())) {
                    $this->userId = $insertId;
                    $preparedData['userId'] = $insertId;
                }

                $this->{$key} = $value;
                $preparedData[$key] = $value;
            }
        }

        DatabaseManager::prepareData($preparedData);
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