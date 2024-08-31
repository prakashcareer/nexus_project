<?php
require_once 'Database.php';

class User {
    private $conn;
    private $table_name = 'students';

    public $id;
    public $name;
    public $course_name;
    public $semester;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, course_name=:course_name, semester=:semester, email=:email, password=:password";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));
        $this->semester = htmlspecialchars(strip_tags($this->semester));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':course_name', $this->course_name);
        $stmt->bindParam(':semester', $this->semester);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify($this->password, $row['password'])){
            $this->id = $row['id'];
            $this->password = $row['password'];
            $this->name = $row['name'];
            $this->course_name = $row['course_name'];
            $this->semester = $row['semester'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }
}
?>
