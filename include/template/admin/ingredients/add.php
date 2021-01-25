<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Добавление ингредиента</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="card">
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo url('admin_ingredients_create'); ?>">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Название</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="<?php echo $arData['name'] ?? ''; ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="<?php echo url('admin_ingredients'); ?>" class="btn btn-default">Отмена</a>
                    <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->