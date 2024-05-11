<?php
class DatabaseManager
{
    use UnderscoreColumns;

    public static $connection;
    public static string $tableName;
    public static bool $protectData = true;
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
    public static function create(array $data = [], string $tableName = "")
    {
        $data = UnderscoreColumns::convertKeysToUnderscore($data);

        if (empty($tableName)) {
            $tableName = self::$tableName;
        }

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (:%s)',
            $tableName,
            UnderscoreColumns::getColumnNames($data),
            UnderscoreColumns::getColumnNames($data, ',:')
        );
        
        $statement = self::$connection->prepare($sql);
    
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
    public static function read(array|string $columns = "*", string $where = '', string $tableName = "")
    {
        if (!empty($columns) && is_array($columns)) {
            $columns = static::getColumnNames($columns, ',', false);
        }

        if (empty($tableName)) {
            $tableName = self::$tableName;
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

        if (self::$protectData === true && class_exists($className)) {
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

        return $result;
        //return $this->connection->query()->fetch();
    }

    public static function getUnprotected(array|string $columns = "*", string $where = '', string $tableName = "") {
        self::$protectData = false;
        $result = self::read($columns, $where, $tableName);
        self::$protectData = true;
        return $result;
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

    public static function setTable(string $tableName) {
        self::$tableName = $tableName;
    }
}
