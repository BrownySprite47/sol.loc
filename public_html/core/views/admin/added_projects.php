<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php //view($data['added_liders']) ?>
<?php if ($_SESSION['role'] == 'admin'): ?>
    <?php 
    $title = 'Добавленные проекты';
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>
    <div id="content-main">
        <div class="container">
            <div class="list-group">
                <div class="tab-content col-lg-12">
                    <div id="panel9">
                        <div class="list-group">
                            <div class="list-group">                       
                            <div class="list-group-item title_menu_admin">
                                <h2>ДОБАВЛЕННЫЕ ПРОЕКТЫ</h2>
                            </div>
                            <?php if(!empty($data['added_projects'][0])): ?>
                                <?php foreach ($data['added_projects'] as $key => $value): ?>
                                    <div class="list-group-item relat_box_project_<?= $value['id_proj'] ?> col-lg-12">
                                        <div>
                                            <span>Добавил: Администратор</span><br>
                                            <p class="padd_H3 title">Название проекта:</p> 
                                            <h4 style="max-width: 630px;"><a href="/project?id=<?= $value['id_proj'] ?>&&t=1"><?= $value['project_title'] ?></a></h4>
                                            <p class="title">Описание проекта:</p>
                                            <p><?= $value['project_description'] ?></p>
                                            <a href="/project/edit?id=<?= $value['id_proj'] ?>&&t=1" class="btn btn-warning" style="top: 25px; right: 112px; position: absolute;">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-danger redactor_adm3" onclick="AjaxSendStatusProject(2, <?= $value['id_proj'] ?>);">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="list-group-item col-lg-12">
                                    <h3 class="title">Нет добавленных проектов</h3>
                                </div>
                            <?php endif; ?>
                        </div>
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
