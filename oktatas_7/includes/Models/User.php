<?php
class User extends Model
{
    public string $username = '';
    public string $email = '';
    public string $phoneCountry = '';
    public string $phone = '';
    public string $password = '';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        parent::$tableName = 'users';
    }

    public static function create(array $data = []) {
        if (!empty($data)) {
            parent::create($data);
        }

        parent::create(parent::$preparedData);
    }
}
