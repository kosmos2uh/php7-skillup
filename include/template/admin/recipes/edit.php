<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Редактирование рецепта</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php /** @var \App\Entity\Recipe $recipe */ $recipe = $arData['recipe']; ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php if($recipe->id == 0) { ?>
            <div class="alert alert-danger">
                <i class="icon fas fa-ban"></i> Рецепт не найден!
            </div>
        <?php } else { ?>
            <div class="card">
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo url('admin_entity_update', ['entity' => 'recipes']); ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php if($recipe->user->id > 0) { ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Пользователь</label>
                            <div class="col-sm-10">
                                <div class="form-control">
                                    <a href="<?php echo url('admin_entity_edit', ['entity' => 'users', 'id' => $recipe->user->id]); ?>" target="_blank">[<?php echo $recipe->user->id; ?>]</a> <?php echo $recipe->user->name; ?>
                                    <input type="hidden" name="user_id" value="<?php echo $recipe->user->id; ?>">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="<?php echo $_POST['name'] ?? $recipe->name; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ингредиенты</label>
                            <div class="col-sm-10">
                                <select name="ingredients[]" class="form-control select2" multiple="multiple">
                                    <?php foreach ($arData['ingredients_list'] as /** @var \App\Entity\Ingredient $ingredient */ $ingredient) {
                                        $selected = false;
                                        foreach ($recipe->ingredients as /** @var \App\Entity\Ingredient $recipeIngredient */ $recipeIngredient) {
                                            if($recipeIngredient->id == $ingredient->id) {
                                                $selected = true;
                                                break;
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $ingredient->id; ?>"<?php if($selected) { ?> selected="selected"<?php } ?>><?php echo $ingredient->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Категории</label>
                            <div class="col-sm-10">
                                <select name="categories[]" class="form-control select2" multiple="multiple">
                                    <?php foreach ($arData['categories_list'] as /** @var \App\Entity\Category $category */ $category) {
                                        $selected = false;
                                        foreach ($recipe->categories as /** @var \App\Entity\Category $recipeCategory */ $recipeCategory) {
                                            if($recipeCategory->id == $category->id) {
                                                $selected = true;
                                                break;
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $category->id; ?>"<?php if($selected) { ?> selected="selected" <?php } ?>><?php
                                            for($i = 0; $i <= $category->level; $i++) {
                                                echo '&ndash; &ndash; ';
                                            }
                                            echo $category->name;
                                            ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Картинка</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" accept="image/jpeg, image/png" id="image_input">
                                    <label class="custom-file-label" for="image_input">Выбрать картинку</label>
                                </div>
                                <?php if(!empty($recipe->image)) { ?>
                                    <img src="<?php echo getEntityImage('recipe', $recipe->image); ?>" alt="" style="max-width: 200px;">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Описание</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" id="summernote" required><?php echo $_POST['description'] ?? $recipe->description; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Дата</label>
                            <div class="col-sm-10">
                                <input type="date" name="date" value="<?php echo $_POST['date'] ?? $recipe->date; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="<?php echo url('admin_entity_list', ['entity' => 'recipes']); ?>" class="btn btn-default">Отмена</a>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </div>
                    <!-- /.card-footer -->
                    <input type="hidden" name="id" value="<?php echo $recipe->id; ?>">
                </form>
            </div>
        <?php }  ?>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->