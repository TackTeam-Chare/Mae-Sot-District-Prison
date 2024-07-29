<?php
require_once './config/database.php';

class Employee {
    private $conn;
    private $table_name = "employees";

    public $id;
    public $name;
    public $image;
    public $create_at;
    public $dep_id;
    public $dep_name;
    public $pos_name;
    public $pos_id;


    
    

    public function __construct($db) {
        $this->conn = $db;
    }


    public function read_job_positions(){

        $query = "SELECT *  FROM job_positions WHERE 1; ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    

    }

    public function read_departments(){

        $query = "SELECT *  FROM departments WHERE 1; ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    

    }
    public function read() {
        $query = "SELECT employees.id , employees.name , employees.image, employees.dep_id , employees.pos_id ,employees.image,departments.dep_name,job_positions.pos_name  FROM ".$this->table_name." JOIN departments  on employees.dep_id = departments.id  join job_positions on employees.pos_id = job_positions.id WHERE employees.dep_id=:dep_id ORDER BY create_at DESC";
        $stmt = $this->conn->prepare($query);
        $this->dep_id = htmlspecialchars(strip_tags($this->dep_id));
        $stmt->bindParam(':dep_id',$this->dep_id);
        $stmt->execute();
        return $stmt;
    }
    public function read_id(){
        $query = "SELECT * FROM " . $this->table_name.' where id=:id';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        return $stmt;
    }

    public function read_emOnPositon(){
        $query = "SELECT employees.id,employees.name, employees.pos_id,employees.dep_id,employees.image,departments.dep_name,job_positions.controll FROM employees join job_positions on job_positions.id = employees.pos_id join departments on departments.id = employees.dep_id where employees.dep_id = :dep_id and employees.pos_id=:pos_id";
        $stmt = $this->conn->prepare($query);
        $this->dep_id = htmlspecialchars(strip_tags($this->dep_id));
        $this->pos_id = htmlspecialchars(strip_tags($this->pos_id));

        $stmt->bindParam(':dep_id',$this->dep_id);
        $stmt->bindParam(':pos_id',$this->pos_id);
        $stmt->execute();
        return $stmt;
    }


    public function read_id_with_position(){
        $query = "SELECT employees.id,employees.name, employees.pos_id,employees.dep_id,employees.image,departments.dep_name,job_positions.controll FROM employees join job_positions on job_positions.id = employees.pos_id join departments on departments.id = employees.dep_id where dep_id = :dep_id";
        $stmt = $this->conn->prepare($query);
        $this->dep_id = htmlspecialchars(strip_tags($this->dep_id));
        // $this->pos_id = htmlspecialchars(strip_tags($this->pos_id));

        $stmt->bindParam(':dep_id',$this->dep_id);
        // $stmt->bindParam(':pos_id',$this->pos_id);
        $stmt->execute();
        return $stmt;
    }

    // public function read_sum() {
    //     $query = "SELECT  COUNT(*) as total FROM " . $this->table_name.';';
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     return $stmt;
    // }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, image=:image,dep_id=:dep_id,pos_id=:pos_id";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->dep_id = htmlspecialchars(strip_tags($this->dep_id));
        $this->pos_id = htmlspecialchars(strip_tags($this->pos_id));
        
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":dep_id", $this->dep_id);
        $stmt->bindParam(":pos_id", $this->pos_id);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name=:name, image=:image ,dep_id=:dep_id,pos_id=:pos_id WHERE id=:id;";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->dep_id = htmlspecialchars(strip_tags($this->dep_id));
        $this->pos_id = htmlspecialchars(strip_tags($this->pos_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":dep_id", $this->dep_id);
        $stmt->bindParam(":pos_id", $this->pos_id);
       
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


    public function count_departments()
    {
        $query = "select count(*) as countDep,departments.dep_name from employees inner join departments on employees.dep_id = departments.id GROUP BY employees.dep_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
