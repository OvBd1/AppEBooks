<?php

class User {
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    public function __construct($id, $name, $email, $password, $role, $created_at, $updated_at, $deleted_at) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
    }

    public function save() {
        $pdo = new PDO('mysql:host=localhost;dbname=app_ebooks', 'root', '');
        $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role
        ]);

        $this->id = $pdo->lastInsertId();

        return $this;
    }

    public static function findByEmail($email) {
        $pdo = new PDO('mysql:host=localhost;dbname=app_ebooks', 'root', '');
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);

        $row = $stmt->fetch();

        if ($row) {
            return new User($row['id'], $row['name'], $row['email'], $row['password'], $row['role'], $row['created_at'], $row['updated_at'], $row['deleted_at']);
        } else {
            return null;
        }
    }

    public static function findById($id) {
        $pdo = new PDO('mysql:host=localhost;dbname=app_ebooks', 'root', '');
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();

        if ($row) {
            return new User($row['id'], $row['name'], $row['email'], $row['password'], $row['role'], $row['created_at'], $row['updated_at'], $row['deleted_at']);
        } else {
            return null;
        }
    }

    public static function all() {
        $pdo = new PDO('mysql:host=localhost;dbname=app_ebooks', 'root', '');
        $sql = "SELECT * FROM users";
        $stmt = $pdo->query($sql);

        $rows = $stmt->fetchAll();

        $users = [];

        foreach ($rows as $row) {
            $users[] = new User($row['id'], $row['name'], $row['email'], $row['password'], $row['role'], $row['created_at'], $row['updated_at'], $row['deleted_at']);
        }

        return $users;
    }

    public function delete() {
        $pdo = new PDO('mysql:host=localhost;dbname=app_ebooks', 'root', '');
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $this->id]);

        return $this;
    }

    public function update() {
        $pdo = new PDO('mysql:host=localhost;dbname=app_ebooks', 'root', '');
        $sql = "UPDATE users SET name = :name, email = :email, password = :password, role = :role WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'id' => $this->id
        ]);

        return $this;
    }
}

class Books {
    private $id;
    private $title;
    private $author;
    private $category;
    private $description;

    public function __construct($id, $title, $author, $category, $description) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->description = $description;
    }

    
}