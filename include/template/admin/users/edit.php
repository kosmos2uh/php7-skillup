<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Редактирование пользователя</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<?php /** @var \App\Entity\User $user */ $user = $arData; ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <?php if($user->id == 0) { ?>
            <div class="alert alert-danger">
                <i class="icon fas fa-ban"></i> Пользователь не найден!
            </div>
        <?php } else { ?>
            <div class="card">
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo url('admin_users_update'); ?>">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Имя</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="<?php echo $_POST['name'] ?? $user->name; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" value="<?php echo $_POST['email'] ?? $user->email; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Пароль</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin" value="1"<?php if(($_POST['is_admin'] ?? $user->is_admin) == 1) { ?> checked="checked"<?php } ?>>
                                    <label class="form-check-label" for="is_admin">Администратор</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="<?php echo url('admin_users'); ?>" class="btn btn-default">Отмена</a>
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </div>
                    <!-- /.card-footer -->
                    <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                </form>
            </div>
        <?php }  ?>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->