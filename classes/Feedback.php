<?php
require_once 'Database.php';

class Feedback {
    private $conn;
    private $table_name = 'feedback';

    public $id;
    public $user_id;
    public $date;
    public $tags;
    public $feedback;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function submitFeedback() {
        $query = "INSERT INTO " . $this->table_name . " SET user_id=:user_id, date=:date, tags=:tags, feedback=:feedback";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->feedback = htmlspecialchars(strip_tags($this->feedback));
        $this->tags = htmlspecialchars(strip_tags($this->tags));
        $this->date = htmlspecialchars(strip_tags($this->date));

        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':tags', $this->tags);
        $stmt->bindParam(':feedback', $this->feedback);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
