<?php
class User extends Model
{
    public string $username = '';
    public string $email = '';
    public string $phoneCountry = '';
    public string $phone = '';
    public string $password = '';
    protected array $hidden = ['password'];

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        parent::$tableName = 'users';
    }

    public static function create(array $data = []) {
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
