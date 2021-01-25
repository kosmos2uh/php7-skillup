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
            <form class="form-horizontal" method="post" action="<?php echo url('admin_recipes_create'); ?>">
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
                    <a href="<?php echo url('admin_recipes'); ?>" class="btn btn-default">Отмена</a>
                    <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->