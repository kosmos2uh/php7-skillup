<?php


namespace App\Entity;


class Category
{
    public int $id = 0;
    public string $name = '';
    public ?int $parent_id = null;
    public string $image = '';
    public int $level = 0;
    public array $children = [];

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
        $query = "SELECT id, name, parent_id, image FROM categories ORDER BY id";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $category = new self();
            $category->id = $row['id'];
            $category->name = $row['name'];
            $category->parent_id = $row['parent_id'];
            $category->image = $row['image'];
            $arItems[] = $category;
        }
        return $arItems;
    }

    public static function getListForRecipe(Recipe $recipe): array
    {
        $arItems = [];
        if($recipe->id > 0) {
            $link = db_connect();
            $query = "
                SELECT c.id, c.name, c.parent_id, c.image
                FROM recipes_categories rc
                LEFT JOIN categories c on rc.category_id = c.id
                WHERE rc.recipe_id = {$recipe->id}
                ORDER BY c.id
            ";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $category = new self();
                $category->id = $row['id'];
                $category->name = $row['name'];
                $category->parent_id = $row['parent_id'];
                $category->image = $row['image'];
                $arItems[] = $category;
            }
        }
        return $arItems;
    }

    public static function getTree($parent_id = 0, $max_level = 0, $current_level = 0) {
        $arResult = [];
        foreach (self::getList() as /** @var self $category */ $category) {
            if($parent_id == $category->parent_id) {
                $arResult[$category->id] = $category;
                if($max_level == 0 || $max_level > $current_level) {
                    $arResult[$category->id]->children = self::getTree($category->id, $max_level, $current_level + 1);
                }
            }
        }
        return $arResult;
    }

    public static function getListStructured($parent_id = 0, $max_level = 0, $current_level = 0) {
        $arResult = [];
        foreach (self::getList() as /** @var self $category */ $category) {
            if($parent_id == $category->parent_id) {
                $arResult[$category->id] = $category;
                $arResult[$category->id]->level = $current_level;
                if($max_level == 0 || $max_level > $current_level) {
                    $arResult = array_merge($arResult, self::getListStructured($category->id, $max_level, $current_level + 1));
                }
            }
        }
        return $arResult;
    }

    private function get(int $id) {
        $link = db_connect();
        $query = "SELECT id, name, parent_id, image FROM categories WHERE id = {$id}";
        $result = mysqli_query($link, $query);
        if($row = mysqli_fetch_assoc($result)) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->parent_id = $row['parent_id'];
            $this->image = $row['image'];
        }
    }

    public function add(): bool
    {
        $result = false;
        if($this->id == 0 && $this->image = saveEntityImage('category', 'image')) {
            $link = db_connect();
            $query = "
                INSERT INTO categories
                SET
                    name = '" . $this->name . "',
                    parent_id = " . ($this->parent_id > 0 ? $this->parent_id : 'NULL') . ",
                    image = '" . $this->image . "'
            ";
            if(!($result = mysqli_query($link, $query))) {
                deleteEntityImage('category', $this->image);
            }
        }
        return (bool)$result;
    }

    public function update(): bool
    {
        $result = false;
        if($this->id > 0) {

            $link = db_connect();

            if($image = saveEntityImage('category', 'image')) {
                if(!empty($this->image)) {
                    deleteEntityImage('category', $this->image);
                }
                $this->image = $image;
            }

            $query = "
                UPDATE categories
                SET
                    name = '" . $this->name . "',
                    parent_id = " . ($this->parent_id > 0 ? $this->parent_id : 'NULL') . ",
                    image = '" . $this->image . "'
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
            if(!empty($this->image)) {
                deleteEntityImage('category', $this->image);
            }
            $query = "DELETE FROM categories WHERE id = {$this->id}";
            $result = mysqli_query($link, $query);
        }
        return (bool)$result;
    }
}