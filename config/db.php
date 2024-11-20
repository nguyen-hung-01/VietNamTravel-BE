<?php
// Connect DB by PDO
class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "lnh070601.";
    private $dbname = "vietnam_travel";
    public $conn;

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname . "", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Kết nối thành công";
        } catch (PDOException $e) {
            echo "Thất bại: " . $e->getMessage();
        }
        return $this->conn;

    }

}

?>