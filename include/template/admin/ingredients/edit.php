<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Редактирование ингредиента</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php /** @var \App\Entity\Ingredient $ingredient */ $ingredient = $arData; ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php if($ingredient->id == 0) { ?>
            <div class="alert alert-danger">
                <i class="icon fas fa-ban"></i> Ингредиент не найден!
            </div>
        <?php } else { ?>
            <div class="card">
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo url('admin_entity_update', ['entity' => 'ingredients']); ?>">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="<?php echo $_POST['name'] ?? $ingredient->name; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="<?php echo url('admin_entity_list', ['entity' => 'ingredients']); ?>" class="btn btn-default">Отмена</a>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </div>
                    <!-- /.card-footer -->
                    <input type="hidden" name="id" value="<?php echo $ingredient->id; ?>">
                </form>
            </div>
        <?php }  ?>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->