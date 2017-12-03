<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php //view($data['added_liders']) ?>
<?php if ($_SESSION['role'] == 'admin'): ?>
    <?php 
    $title = 'Отредактированные лидеры';
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>
    <div id="content-main">
        <div class="container">
            <div class="list-group">
                <div class="tab-content col-lg-12">
                    <div id="panel5">
                        <div class="list-group">                            
                            <div class="list-group-item title_menu_admin">
                                <h2>ОТРЕДАКТИРОВАННЫЕ ЛИДЕРЫ</h2>
                            </div>
                            <?php if(!empty($data['getLidersAdmin_edit'])): ?>

                                <?php foreach ($data['getLidersAdmin_edit'] as $lider): ?>
                                    <?php if ($lider['fio'] != '0'): ?>
                                        <div class="list-group-item relat_box_lider_<?= $lider['id_lid'] ?>">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <?php if (!empty($lider['image_name'])): ?>
                                                        <img class="liders_photo" src="/uploads/images/<?= $lider['image_name'] ?>" alt="">
                                                    <?php else: ?>
                                                        <img class="liders_photo" src="/assets/images/img_not_found.png" alt="">
                                                    <?php endif; ?>
                                                </div>                                                
                                                <div class="col-lg-5">
                                                    <p class="padd_H3 title">Имя лидера:</p> 
                                                    <h4 style="max-width: 630px;"><a href="/lider?id=<?= $lider['id_lid'] ?>&&t=1 " onclick="show(this);"><?= $lider['fio'] ?></a></h4>
                                                    <p class="title">Проекты у лидера:</p>
                                                    <?php if (isset($lider['projects'])):
                                                        foreach ($lider['projects'] as $key => $value): ?>
                                                            <div class="text">
                                                                <a href="/project?id=<?= $value['id_proj'] ?>&&t=1 " onclick="show(this);"><?= $value['project_title'] ?></a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <div class="text">
                                                            <p>Нет проектов</p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-lg-4">
                                                    <a href="javascript:void(0);" class="btn btn-success redactor_adm1" onclick="AjaxSendStatusLider(1, <?= $lider['id_lid'] ?>);">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="/lider/edit?id=<?= $lider['id_lid'] ?>&&t=1" class="btn btn-warning" style="top: 25px; right: 112px; position: absolute;">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-danger redactor_adm3" onclick="AjaxSendStatusLider(2, <?= $lider['id_lid'] ?>);">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="list-group-item col-lg-12">
                                    <h3 class="title">Нет отредактированных лидеров</h3>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>
    </body>
    </html>

<?php else: header('Location: /index');
endif; ?>
