<?php


namespace App\Models;


use App\Database;

class Student
{
    private  $id;
    private  $name;
    private  $subject;
    private  $created_at;
    private $database;
    private $table = "alumnos";

    public function __construct(string $name = '', string $subject = '', int $id = null, string $created_at = null)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->id = $id;
        $this->created_at = $created_at;

        if (!$this->database) {
            $this->database = new Database();
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function rename($name)
    {
        $this->name = $name;
    }
    public function changeSubject($subject)
    {
        $this->subject = $subject;
    }

    public function save(): void
    {
        $this->database->mysql->query("INSERT INTO `{$this->table}` (`name`, `subject`) VALUES ('$this->name', '$this->subject')");
    }

    public function all()
    {
        $query = $this->database->mysql->query("select * FROM {$this->table}");
        $studentsArray = $query->fetchAll();
        $studentList = [];
        foreach ($studentsArray as $student) {
            $studentItem = new Student($student["name"], $student["subject"], $student["id"], $student["created_at"]);
            array_push($studentList, $studentItem);
        }

        return $studentList;
    }

    public function deleteById($id)
    {
        $query = $this->database->mysql->query("DELETE FROM `{$this->table}` WHERE `{$this->table}`.`id` = {$id}");
    }

    public function delete()
    {
        $query = $this->database->mysql->query("DELETE FROM `{$this->table}` WHERE `{$this->table}`.`id` = {$this->id}");
    }

    public function findById($id)
    {
        $query = $this->database->mysql->query("SELECT * FROM `{$this->table}` WHERE `id` = {$id}");
        $result = $query->fetchAll();
        

        return new Student($result[0]["name"], $result[0]["subject"], $result[0]["id"], $result[0]["created_at"]);
    }

    public function UpdateById($data, $id)
    {
        $this->database->mysql->query("UPDATE `{$this->table}` SET `name` =  '{$data["name"]}' WHERE `id` = {$id}");
    }

    public function Update()
    {
        $this->database->mysql->query("UPDATE `{$this->table}` SET `name` =  '{$this->name}' , `subject`= '{$this->subject}' WHERE `id` = {$this->id}");
    }
}
