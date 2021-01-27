<?php

namespace App\Entity;

class User
{
    public int $id = 0;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public int $is_admin = 0;

    public function __construct(int $id = 0)
    {
        if($id > 0) {
            $this->get($id);
        }
    }

    public static function getList(): array
    {
        $link = db_connect();
        $arItems = [];
        $query = "SELECT id, name, email, password, is_admin FROM users ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $user = new self();
            $user->id = $row['id'];
            $user->name = $row['name'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->is_admin = $row['is_admin'];
            $arItems[] = $user;
        }
        return $arItems;
    }

    private function get(int $id) {
        $link = db_connect();
        $query = "SELECT id, name, email, password, is_admin FROM users WHERE id = {$id}";
        $result = mysqli_query($link, $query);
        if($row = mysqli_fetch_assoc($result)) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->is_admin = $row['is_admin'];
        }
    }

    public function add(): bool
    {
        $result = false;
        if($this->id == 0) {
            $link = db_connect();
            $hash = password_hash($this->password, PASSWORD_DEFAULT);
            $query = "
                INSERT INTO users
                SET
                    name = '" . $this->name . "',
                    email = '" . $this->email . "',
                    is_admin = " . $this->is_admin . ",
                    password = '" . $hash . "'
            ";
            $result = mysqli_query($link, $query);
        }
        return (bool)$result;
    }

    public function update(): bool
    {
        $result = false;
        if($this->id > 0) {
            $link = db_connect();
            $query = "
                UPDATE users
                SET
                    name = '" . $this->name . "',
                    email = '" . $this->email . "',
                    is_admin = " . $this->is_admin . "
                WHERE id = {$this->id}
            ";
            $result = mysqli_query($link, $query);
            if($this->password != '') {
                $hash = password_hash($this->password, PASSWORD_DEFAULT);
                $query = "UPDATE users SET password = '" . $hash . "' WHERE id = {$this->id}";
                mysqli_query($link, $query);
            }
        }
        return (bool)$result;
    }


    function delete(): bool
    {
        $result = false;
        if($this->id > 0) {
            $link = db_connect();
            $query = "DELETE FROM users WHERE id = {$this->id}";
            $result = mysqli_query($link, $query);
        }
        return (bool)$result;
    }
}