<?php
class DatabaseManager
{
    use UnderscoreColumns;

    public $connection;
    public string $tableName;

    public function __construct(
        string $host = "localhost",
        string $dbName = "oktatas",
        string $user = "localuser",
        string $pass = "localpass"
    ) {
        $this->connection = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
    }

    /*
    SQL Példa: INSERT INTO users (username, email, password) VALUES ("felhasználónév", "email cím", "jelszó");
    */
    public function create(array $data)
    {
        /*$user = new User($data);
        $data = $user->toArray();*/
        $data = $this->convertKeysToUnderscore($data);
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (:%s)',
            $this->tableName,
            $this->getColumnNames($data),
            $this->getColumnNames($data, ',:')
        );
        $stmt = $this->connection->prepare($sql);

        try {
            $result = $stmt->execute($data);
        } catch (PDOException $exception) {
            error_log(sprintf("Error in %s at line %s, %s", __CLASS__, __LINE__, $exception->getMessage()));
        }
    }

    /*
    SQL Példa: select * from users (where id = 1);
    () = OPCIONÁLIS
    */
    public function read(array|string $columns = "*", string $where = '')
    {
        if (!empty($columns) && is_array($columns)) {
            $columns = $this->getColumnNames($columns, ',', false);
        }

        $sql = sprintf(
            'select %s from users %s',
            $columns,
            !empty($where) ? "where " . $where : ""
        );
        $stmt = $this->connection->prepare($sql);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log(sprintf("Error in %s at line %s, %s", __CLASS__, __LINE__, $exception->getMessage()));
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
}
