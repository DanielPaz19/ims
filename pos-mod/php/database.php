
<?php
class Database
{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'inventorymanagement';
    private $mysqli = '';

    public function __construct()
    {
        // Create connection
        $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
        // echo "Connected successfully";
    }

    public function select($rows = "*", $table, $where = null)
    {
        if ($where != null) {
            $sql = "SELECT $rows FROM $table WHERE $where";
        } else {
            $sql = "SELECT $rows FROM $table";
        }

        return $this->mysqli->query($sql);
    }


    public function __destruct()
    {
        $this->mysqli->close();
    }
}
?>