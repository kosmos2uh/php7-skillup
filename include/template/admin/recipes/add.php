<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Добавление рецепта</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="card">
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo url('admin_entity_create', ['entity' => 'recipes']); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Пользователь</label>
                        <div class="col-sm-10">
                            <input type="text" name="user_id" value="<?php echo $arData['user_id'] ?? ''; ?>" class="form-control" pattern="^[0-9]+$">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Название</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="<?php echo $arData['name'] ?? ''; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ингредиенты</label>
                        <div class="col-sm-10">
                            <select name="ingredients[]" class="form-control select2" multiple="multiple">
                                <?php foreach ($arData['ingredients_list'] as /** @var \App\Entity\Ingredient $ingredient */ $ingredient) { ?>
                                    <option value="<?php echo $ingredient->id; ?>"><?php echo $ingredient->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Категории</label>
                        <div class="col-sm-10">
                            <select name="categories[]" class="form-control select2" multiple="multiple">
                                <?php foreach ($arData['categories_list'] as /** @var \App\Entity\Category $category */ $category) { ?>
                                    <option value="<?php echo $category->id; ?>"><?php
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
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Описание</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" id="summernote" required><?php echo $arData['description'] ?? ''; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Дата</label>
                        <div class="col-sm-10">
                            <input type="date" name="date" value="<?php echo $arData['date'] ?? date('Y-m-d'); ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="<?php echo url('admin_entity_list', ['entity' => 'recipes']); ?>" class="btn btn-default">Отмена</a>
                    <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->