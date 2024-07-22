<?php
require_once './config/database.php';

class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $title;
    public $content;
    public $image;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT id, title, content, image FROM " . $this->table_name.' order by id desc;';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function read_id(){
        $query = "SELECT id, title, content, image FROM " . $this->table_name.' where id=:id';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        return $stmt;
    }
    public function read_sum() {
        $query = "SELECT  COUNT(*) as total FROM " . $this->table_name.';';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, content=:content, image=:image";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->image = htmlspecialchars(strip_tags($this->image));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image", $this->image);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET title=:title, content=:content, image=:image WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
