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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php if(empty($arData)) { ?>
            <div class="alert alert-danger">
                <i class="icon fas fa-ban"></i> Рецепт не найден!
            </div>
        <?php } else { ?>
            <div class="card">
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo url('admin_entity_update', ['entity' => 'recipes']); ?>">
                    <div class="card-body">
                        <?php if($arData['user_id'] > 0) { ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Пользователь</label>
                            <div class="col-sm-10">
                                <div class="form-control">
                                    <a href="<?php echo url('admin_entity_edit', ['entity' => 'users', 'id' => $arData['user_id']]); ?>" target="_blank">[<?php echo $arData['user_id']; ?>]</a> <?php echo $arData['user_name']; ?>
                                    <input type="hidden" name="user_id" value="<?php echo $arData['user_id']; ?>">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="<?php echo $arData['name']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ингредиенты</label>
                            <div class="col-sm-10">
                                <select name="ingredients[]" class="form-control select2    " multiple="multiple">
                                    <?php foreach ($arData['ingredients_list'] as $arIngredient) {
                                        $selected = false;
                                        foreach ($arData['ingredients'] as $arRecipeIngredient) {
                                            if($arRecipeIngredient['id'] == $arIngredient['id']) {
                                                $selected = true;
                                                break;
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $arIngredient['id']; ?>"<?php if($selected) { ?> selected="selected"<?php } ?>><?php echo $arIngredient['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Категории</label>
                            <div class="col-sm-10">
                                <select name="categories[]" class="form-control select2" multiple="multiple">
                                    <?php foreach ($arData['categories_list'] as $arCategory) {
                                        $selected = false;
                                        foreach ($arData['categories'] as $arRecipeCategory) {
                                            if($arRecipeCategory['id'] == $arCategory['id']) {
                                                $selected = true;
                                                break;
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $arCategory['id']; ?>"<?php if($selected) { ?> selected="selected" <?php } ?>><?php
                                            for($i = 0; $i <= $arCategory['level']; $i++) {
                                                echo '&ndash; &ndash; ';
                                            }
                                            echo $arCategory['name'];
                                            ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Описание</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" id="summernote" required><?php echo $arData['description']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Дата</label>
                            <div class="col-sm-10">
                                <input type="date" name="date" value="<?php echo $arData['date']; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="<?php echo url('admin_entity_list', ['entity' => 'recipes']); ?>" class="btn btn-default">Отмена</a>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </div>
                    <!-- /.card-footer -->
                    <input type="hidden" name="id" value="<?php echo $arData['id']; ?>">
                </form>
            </div>
        <?php }  ?>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->