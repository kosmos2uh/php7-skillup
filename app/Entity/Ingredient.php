<?php

namespace App\Entity;

class Ingredient
{
    public int $id = 0;
    public string $name = '';

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
        $query = "SELECT id, name FROM ingredients ORDER BY name";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $ingredient = new self();
            $ingredient->id = $row['id'];
            $ingredient->name = $row['name'];
            $arItems[] = $ingredient;
        }
        return $arItems;
    }

    public static function getListForRecipe(Recipe $recipe): array
    {
        $arItems = [];
        if($recipe->id > 0) {
            $link = db_connect();
            $query = "
                SELECT i.id, i.name
                FROM recipes_ingredients ri
                LEFT JOIN ingredients i ON ri.ingredient_id = i.id
                WHERE ri.recipe_id = {$recipe->id}
            ";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $ingredient = new self();
                $ingredient->id = $row['id'];
                $ingredient->name = $row['name'];
                $arItems[] = $ingredient;
            }
        }
        return $arItems;
    }

    private function get(int $id) {
        $link = db_connect();
        $query = "SELECT id, name FROM ingredients WHERE id = {$id}";
        $result = mysqli_query($link, $query);
        if($row = mysqli_fetch_assoc($result)) {
            $this->id = $row['id'];
            $this->name = $row['name'];
        }
    }

    public function add(): bool
    {
        $result = false;
        if($this->id == 0) {
            $link = db_connect();
            $query = "
                INSERT INTO ingredients
                SET
                    name = '" . $this->name . "'
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
                UPDATE ingredients
                SET
                    name = '" . $this->name . "'
                WHERE id = {$this->id}
            ";
            $result = mysqli_query($link, $query);
        }
        return (bool)$result;
    }


    function delete(): bool
    {
        $result = false;
        if($this->id > 0) {
            $link = db_connect();
            $query = "DELETE FROM ingredients WHERE id = {$this->id}";
            $result = mysqli_query($link, $query);
        }
        return (bool)$result;
    }
}