<?php
class Categories
{
    private $conn;
    // properties
    public $category_id;
    public $category_name;

    // connect DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // read data
    public function read()
    {
        $query = "SELECT * FROM categories ORDER BY category_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // show data
    public function show()
    {
        $query = "SELECT * FROM categories WHERE category_id=? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->category_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->category_name = $row['category_name'];

        return $stmt;
    }

    // create data
    public function create()
    {
        $query = "INSERT INTO categories SET category_name=:category_name";
        $stmt = $this->conn->prepare($query);
        // clean data
        $this->category_name = htmlspecialchars(strip_tags($this->category_name));
        // bind data
        $stmt->bindParam(':category_name', $this->category_name);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->errorInfo()[2]);
            return false;
        }

    }

    // update data
    public function update()
    {
        $query = "UPDATE categories SET category_name=:category_name WHERE category_id=:category_id";
        $stmt = $this->conn->prepare($query);
        // clean data
        $this->category_name = htmlspecialchars(strip_tags($this->category_name));
        // bind data
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':category_name', $this->category_name);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->errorInfo()[2]);
            return false;
        }
    }

    // delete data
    public function delete()
    {
        $query = "DELETE FROM categories WHERE category_id=:category_id";
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->category_name = htmlspecialchars(strip_tags($this->category_name));
        // bind data
        $stmt->bindParam(':category_id', $this->category_id);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->errorInfo()[2]);
            return false;
        }
    }
}
?>