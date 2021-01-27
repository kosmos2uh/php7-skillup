<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Категории</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row mb-3 mt-n5">
            <div class="col col-sm-12">
                <a href="<?php echo url('admin_categories_add'); ?>" class="btn btn-info float-right"><i class="fas fa-folder-plus"></i> добавить категорию</a>
            </div>
        </div>

        <?php if(empty($arData)) { ?>
            <div class="alert alert-info">
                <i class="icon fas fa-info"></i> Категорий нет!
            </div>
        <?php } else { ?>
            <div class="card">
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Картинка</th>
                            <th>Название</th>
                            <th>Parent ID</th>
                            <th style="width: 230px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($arData as $arItem) { ?>
                        <tr>
                            <td><?php echo $arItem['id']; ?></td>
                            <td>
                                <?php if($arItem['image'] != '') { ?>
                                    <img src="<?php echo getEntityImage('category', $arItem['image']); ?>" alt="" style="width: 100px" />
                                <?php } ?>
                            </td>
                            <td><?php
                                for($i = 0; $i < $arItem['level']; $i++) {
                                    echo '&mdash; &mdash; ';
                                }
                                echo $arItem['name'];
                                ?></td>
                            <td><?php echo $arItem['parent_id']; ?></td>
                            <td class="text-right">
                                <form method="post" action="<?php echo url('admin_categories_delete', ['id' => $arItem['id']]); ?>">
                                    <button class="btn btn-xs btn-danger float-right delete-btn" type="submit" data-toggle="modal" data-target="#modal-delete-item" data-message="Удалить категорию <b><?php echo $arItem['name']; ?></b> [<?php echo $arItem['id']; ?>]?"><i class="fas fa-trash"></i> удалить</button>
                                </form>
                                <a class="btn btn-default btn-xs float-right mr-2" href="<?php echo url('admin_categories_edit', ['id' => $arItem['id']]); ?>"><i class="fas fa-pencil-alt"></i> редактировать</a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="modal fade" id="modal-delete-item">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Удалить категорию?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="modal-delete-item-text">Удалить категорию?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <button type="button" class="btn btn-primary confirm_action">Удалить</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php }  ?>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->