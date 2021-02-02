<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Редактирование категории</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php /** @var \App\Entity\Category $category */ $category = $arData['category']; ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php if($category->id == 0) { ?>
            <div class="alert alert-danger">
                <i class="icon fas fa-ban"></i> Категория не найдена!
            </div>
        <?php } else { ?>
            <div class="card">
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo url('admin_entity_update', ['entity' => 'categories']); ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="<?php echo $_POST['name'] ?? $category->name; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Родитель</label>
                            <div class="col-sm-10">
                                <select name="parent_id" class="form-control">
                                    <option value="">Верхний уровень</option>
                                    <?php foreach ($arData['categories_all'] as /** @var \App\Entity\Category $category_item */ $category_item) { ?>
                                        <option value="<?php echo $category_item->id; ?>"<?php if(($_POST['parent_id'] ?? $category->parent_id) == $category_item->id) { ?> selected="selected" <?php } ?>><?php
                                            for($i = 0; $i <= $category_item->level; $i++) {
                                                echo '&ndash; &ndash; ';
                                            }
                                            echo '[', $category_item->id, '] ', $category_item->name;
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
                                <?php if(!empty($category->image)) { ?>
                                    <img src="<?php echo getEntityImage('category', $category->image); ?>" alt="" style="max-width: 200px;">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="<?php echo url('admin_entity_list', ['entity' => 'categories']); ?>" class="btn btn-default">Отмена</a>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </div>
                    <!-- /.card-footer -->
                    <input type="hidden" name="id" value="<?php echo $category->id; ?>">
                </form>
            </div>
        <?php }  ?>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->