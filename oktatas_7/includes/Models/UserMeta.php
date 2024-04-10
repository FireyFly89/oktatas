<?php
class UserMeta extends Model
{
    public string $country = '';
    public string $city = '';
    public string $street = '';
    public string $house = '';

    public function __construct(array $data = [])
    {
        parent::__construct();
        parent::$tableName = 'users';
    }

    public static function create(array $data = []) {
        if (!empty($data)) {
            parent::create($data);
        }

        parent::create(parent::$preparedData);
    }
}
