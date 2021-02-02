<?php


namespace App\Entity;

use App\Entity\User;

class Recipe
{
    public int $id = 0;
    public string $name = '';
    public string $description = '';
    public string $image = '';
    public string $date = '';
    public array $categories = [];
    public array $ingredients = [];
    public ?User $user = null;

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
        $query = "
            SELECT
                r.id,
                r.name,
                r.description,
                r.image,
                r.user_id,
                r.date,
                u.id as user_id,
                u.name as user_name,
                u.email as user_email,
                u.is_admin as user_is_admin,
                u.password as user_password
            FROM recipes r
            LEFT JOIN users u on r.user_id = u.id
            ORDER BY r.id DESC
        ";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $recipe = new self();
            $recipe->id = $row['id'];
            $recipe->name = $row['name'];
            $recipe->description = $row['description'];
            $recipe->image = $row['image'];
            $recipe->date = $row['date'];
            if($row['user_id'] > 0) {
                $user = new User();
                $user->id = $row['user_id'];
                $user->name = $row['user_name'];
                $user->email = $row['user_email'];
                $user->password = $row['user_password'];
                $user->is_admin = $row['user_is_admin'];
                $recipe->user = $user;
            }
            $arItems[] = $recipe;
        }
        return $arItems;
    }

    private function get(int $id) {
        $link = db_connect();
        $query = "
            SELECT
                r.id,
                r.name,
                r.description,
                r.image,
                r.user_id,
                r.date,
                u.id as user_id,
                u.name as user_name,
                u.email as user_email,
                u.is_admin as user_is_admin,
                u.password as user_password
            FROM recipes r
            LEFT JOIN users u on r.user_id = u.id
            WHERE r.id = {$id}
        ";
        $result = mysqli_query($link, $query);
        if($row = mysqli_fetch_assoc($result)) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->image = $row['image'];
            $this->date = $row['date'];
            if($row['user_id'] > 0) {
                $user = new User();
                $user->id = $row['user_id'];
                $user->name = $row['user_name'];
                $user->email = $row['user_email'];
                $user->password = $row['user_password'];
                $user->is_admin = $row['user_is_admin'];
                $this->user = $user;
            }
            $this->categories = $this->getCategories();
            $this->ingredients = $this->getIngredients();
        }
    }

    private function getCategories(): array
    {
        return Category::getListForRecipe($this);
    }

    private function getIngredients(): array
    {
        return Ingredient::getListForRecipe($this);
    }

    public function add(array $arIngredientsId = [], array $arCategoriesId = []): bool
    {
        $result = false;
        if($this->id == 0) {
            $link = db_connect();
            $this->image = saveEntityImage('recipe', 'image');
            $query = "
                INSERT INTO recipes
                SET
                    name = '{$this->name}',
                    description = '{$this->description}',
                    user_id = " . ($this->user->id > 0 ? $this->user->id : 'NULL') . ",
                    image = '{$this->image}',
                    date = '{$this->date}'
            ";
            if(mysqli_query($link, $query)) {
                $this->id = mysqli_insert_id($link);
                $this->updateIngredients($arIngredientsId);
                $this->updateCategories($arCategoriesId);
                $result = true;
            } else {
                if(!empty($this->image)) {
                    deleteEntityImage('recipe', $this->image);
                }
            }
        }
        return (bool)$result;
    }

    public function update(array $arIngredientsId = [], array $arCategoriesId = []): bool
    {
        $result = false;
        if($this->id > 0) {

            $link = db_connect();

            if($image = saveEntityImage('recipe', 'image')) {
                if(!empty($this->image)) {
                    deleteEntityImage('recipe', $this->image);
                }
                $this->image = $image;
            }

            $query = "
                UPDATE recipes
                SET
                    name = '{$this->name}',
                    description = '{$this->description}',
                    user_id = " . ($this->user->id > 0 ? $this->user->id : 'NULL') . ",
                    image = '{$this->image}',
                    date = '{$this->date}'
                WHERE id = {$this->id}
            ";
            if(mysqli_query($link, $query)) {
                $this->updateIngredients($arIngredientsId);
                $this->updateCategories($arCategoriesId);
                $result = true;
            }
        }
        return (bool)$result;
    }

    function delete(): bool
    {
        $result = false;
        if($this->id > 0) {
            $link = db_connect();
            if(!empty($this->image)) {
                deleteEntityImage('recipe', $this->image);
            }
            $query = "DELETE FROM recipes WHERE id = {$this->id}";
            $result = mysqli_query($link, $query);
        }
        return (bool)$result;
    }

    private function updateCategories(array $arCategoriesId) {
        if($this->id > 0 && !empty($arCategoriesId)) {
            $link = db_connect();

            $query = "DELETE FROM recipes_categories WHERE recipe_id = {$this->id}";
            mysqli_query($link, $query);

            $values = '';
            foreach ($arCategoriesId as $category_id) {
                $values .= $values != '' ? ',' : '';
                $values .= "({$this->id}, {$category_id})";
            }

            $query = "
                INSERT INTO recipes_categories (recipe_id, category_id)
                VALUES {$values}
            ";
            mysqli_query($link, $query);
        }
    }

    private function updateIngredients(array $arIngredientsId) {
        if($this->id > 0 && !empty($arIngredientsId)) {
            $link = db_connect();

            $query = "DELETE FROM recipes_ingredients WHERE recipe_id = {$this->id}";
            mysqli_query($link, $query);

            $values = '';
            foreach ($arIngredientsId as $ingredient_id) {
                $values .= $values != '' ? ',' : '';
                $values .= "({$this->id}, {$ingredient_id})";
            }

            $query = "
                INSERT INTO recipes_ingredients (recipe_id, ingredient_id)
                VALUES {$values}
            ";
            mysqli_query($link, $query);
        }
    }
}