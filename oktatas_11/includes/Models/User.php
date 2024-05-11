<?php
class User extends Model
{
    public int $id;
    public string $username;
    public string $email;
    public string $password;
    public string $phoneCountry;
    public string $phone;
    protected array $hidden = ['password'];

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        parent::$tableName = 'users';
    }

    public static function create(array $data = [], string $tableName = "") {
        if (!empty($data)) {
            return parent::create($data);
        }

        return parent::create(parent::$preparedData);
    }

    public function getHiddenFields() {
        return $this->hidden;
    }

    public function isLoggedIn(): bool {
        return !empty($_SESSION['user']);
    }
}
