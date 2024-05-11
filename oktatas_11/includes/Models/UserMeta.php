<?php
class UserMeta extends Model
{
    public int $userId;
    public string $country = '';
    public string $city = '';
    public string $street = '';
    public string $zip = '';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        parent::$tableName = 'user_meta';
    }

    public static function create(array $data = [], string $tableName = "") {
        if (!empty($data)) {
            return parent::create($data);
        }

        return parent::create(parent::$preparedData);
    }
}
