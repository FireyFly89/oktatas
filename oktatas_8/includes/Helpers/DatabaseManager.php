<?php
class DatabaseManager
{
    use UnderscoreColumns;

    public static $connection;
    public static string $tableName;
    protected static array $preparedData;

    public function __construct(
        string $host = "localhost",
        string $dbName = "oktatas",
        string $user = "localuser",
        string $pass = "localpass"
    ) {
        if (empty(self::$connection)) {
            self::$connection = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
        }
    }

    /*
    SQL Példa: INSERT INTO users (username, email, password) VALUES ("felhasználónév", "email cím", "jelszó");
    */
    public static function create(array $data = [])
    {
        /*$user = new User($data);
        $data = $user->toArray();*/
        $data = UnderscoreColumns::convertKeysToUnderscore($data);
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (:%s)',
            self::$tableName,
            UnderscoreColumns::getColumnNames($data),
            UnderscoreColumns::getColumnNames($data, ',:')
        );
        $statement = self::$connection->prepare($sql);

        // TODO: később kivenni, csak debughoz
        if (array_key_exists('email', $data)) {
            $data['email'] = $data['email'] . time();
        }

        try {
            return $statement->execute($data);
        } catch (PDOException $exception) {
            error_log(sprintf("Error in %s at line %s, %s", __CLASS__, __LINE__, $exception->getMessage()));
        }

        return false;
    }

    /*
    SQL Példa: select * from users (where id = 1);
    () = OPCIONÁLIS
    */
    public static function read(string $tableName, array|string $columns = "*", string $where = '')
    {
        if (!empty($columns) && is_array($columns)) {
            $columns = static::getColumnNames($columns, ',', false);
        }

        $sql = sprintf(
            'select %s from %s %s',
            $columns,
            $tableName,
            !empty($where) ? "where " . $where : ""
        );
        $stmt = self::$connection->prepare($sql);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log(sprintf("Error in %s at line %s, %s", __CLASS__, __LINE__, $exception->getMessage()));
        }

        $className = self::convertStringToClassName($tableName);

        if (class_exists($className)) {
            $model = new $className;
            $hiddenFields = $model->getHiddenFields();

            if (!empty($hiddenFields)) {
                foreach ($result as &$dataArray) {
                    $dataArray = array_filter($dataArray, function($columnName) use ($hiddenFields) {
                        return !in_array($columnName, $hiddenFields);
                    }, ARRAY_FILTER_USE_KEY);
                }
            }
        }

        dd($result);
        //return $this->connection->query()->fetch();
    }

    /*
    SQL Példa: update users set username = "valaki" (where email = "valaki@valami.hu");
    () = OPCIONÁLIS, de erősen javallott
    */
    public function update(string $query)
    {
    }

    /*
    SQL Példa: delete from users (where email = "valaki@valami.hu");
    () = OPCIONÁLIS, de erősen javallott
    */
    public function delete(string $query)
    {
    }

    public static function prepareData(array $data) {
        self::$preparedData = $data;
    }

    public static function singularize(string $subject) {
        $lastChar = $subject[strlen($subject) - 1];

        if ($lastChar === 's') {
            return substr($subject, 0, -1);
        }

        return $subject;
    }

    public static function convertStringToClassName(string $subject) {
        $tableName = self::singularize($subject);
        return ucfirst($tableName);
    }
}
