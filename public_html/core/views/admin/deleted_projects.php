<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php //view($data['added_liders']) ?>
<?php if ($_SESSION['role'] == 'admin'): ?>
    <?php 
    $title = 'Отклоненные проекты';
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>
    <div id="content-main">
        <div class="container">
            <div class="list-group">
                <div class="tab-content col-lg-12">
                    <div id="panel6">
                        <div class="list-group">                            
                            <div class="list-group-item title_menu_admin">
                                <h2>ОТКЛОНЕННЫЕ ПРОЕКТЫ</h2>
                            </div>
                            <?php if(!empty($data['getProjectsAdmin_del'])): ?>
                                <?php foreach ($data['getProjectsAdmin_del'] as $key => $value): ?>
                                    <div class="list-group-item relat_box_project_<?= $value['id_proj'] ?> col-lg-12">
                                        <div>
                                            <span>Добавил:</span>
                                            <a href="/lider?id=<?= $value['id_lid'] ?>&&t=1"><?= $value['fio'] ?></a>
                                            <p class="padd_H3 title">Название проекта:</p> 
                                            <h4 style="max-width: 630px;"><a href="/project?id=<?= $value['id_proj'] ?>&&t=1"><?= $value['project_title'] ?></a></h4>
                                            <p class="title">Описание проекта:</p>
                                            <p><?= $value['project_description'] ?></p>
                                            <!-- <a href="edit_project.php?project=<?= $value['id_proj'] ?>" class="btn btn-success"> -->
                                            <a href="javascript:void(0);" class="btn btn-success redactor_adm1" onclick="AjaxSendStatusProject(1, <?= $value['id_proj'] ?>);">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </a>
                                            <a href="/project/edit?id=<?= $value['id_proj'] ?>&&t=1" class="btn btn-warning" style="top: 25px; right: 112px; position: absolute;">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="list-group-item col-lg-12">
                                    <h3 class="title">Нет отклоненных проектов</h3>
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
