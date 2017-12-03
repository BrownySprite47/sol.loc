<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php //view($data) ?>
<?php $check = check_correct_project($_SESSION['id'] ,$_GET['id']) ?>
<?php 
    $title = 'Карточка проекта';
    $page_projects = 'active';
    $page_liders = '';
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>
<div class="container">
    <?php if (($_GET['t'] == '1')): ?>
        <div class="list-group-item col-lg-12"><a href="javascript:history.back()">Назад</a></div>
    <?php endif; ?>

    <div class="list-group">
        <div class="list-group-item col-lg-12 title_menu_admin ">
            <div class="row">
                <div class="col-lg-8">
                    <h2>КАРТОЧКА ПРОЕКТА</h2>
                </div>
                <?php if ($session && $admin): ?>
                    <div id="result_status" style="margin-top: 15px;">
                        <?php if (($data["project"][0]['checked'] != '1')): ?>
                            <a href="javascript:void(0);" class="btn btn-success" onclick="AjaxSendStatusProject(1, <?= $_GET['id'] ?>);">Принять</a>
                        <?php endif; ?>                        
                        <?php if (($_GET['t'] == '1')): ?>
                            <a href="/project/edit?id=<?= $_GET['id'] ?>&&t=1" class="btn btn-warning">Редактировать проект</a>
                        <?php else:?>
                            <a href="/project/edit?id=<?= $_GET['id'] ?>" class="btn btn-warning">Редактировать проект</a>
                        <?php endif; ?>                        
                        <a href="javascript:void(0);" class="btn btn-danger" onclick="AjaxSendStatusProject(2, <?= $_GET['id'] ?>);">Отклонить</a>
                    </div>
                <?php elseif ($_SESSION['role'] == 'user' && $check): ?>
                        <?php if (($_GET['t'] == '1')): ?>
                            <a href="/project/edit?id=<?= $_GET['id'] ?>&&t=1" class="btn btn-warning">Редактировать проект</a>
                        <?php else:?>
                            <a href="/project/edit?id=<?= $_GET['id'] ?>" class="btn btn-warning">Редактировать проект</a>
                        <?php endif; ?>                        
                <?php endif; ?>
            </div>
        </div>
        
        <div class="list-group-item col-lg-12">
            <div class="col-lg-4">
                <?php if (!empty($data['project'][0]['image_name'])): ?>
                    <img class="project_photo" src="/uploads/images/<?= $data['project'][0]['image_name'] ?>" alt="">
                <?php else: ?>
                    <img class="project_photo" src="/assets/images/img_not_found.png" alt="">
                <?php endif; ?>
            </div>
            <div class="col-lg-8">
                <h3>Общие характеристики проекта:</h3>
                <p class="title">Название проекта:</p>
                <p><?= $data['project'][0]['project_title'] ?></p>
                <p class="title">Краткое название:</p>
                <p><?= $data['project'][0]['short_title'] ?></p>
                <p class="title">Сайт:</p>
                <p><a target="_blank" href="http://<?= $data['project'][0]['site'] ?>"><?= $data['project'][0]['site'] ?></a></p>
                <p class="title">Описание проекта:</p>
                <p><?= $data['project'][0]['project_description'] ?></p>
            </div>
        </div>
        <div class="list-group-item col-lg-12">
            <div class="row">
                <div class="col-lg-2">
                    <p class="title">Метапредметная направленность:</p>
                    <?php foreach ($data['project'][0]['metapredmets'] as $key => $value): ?>
                        <p><?= $data['localizations']['metapredmets'][$key] ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-2">
                    <p class="title">Предметная направленность проекта:</p>
                    <?php foreach ($data['project'][0]['predmets'] as $key => $value): ?>
                        <p><?= $data['localizations']['predmets'][$key] ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-3">
                    <p class="title">Конечные потребители:</p>
                    <?php foreach ($data['project'][0]['ages'] as $key => $value): ?>
                        <p><?= $data['localizations']['ages'][$key] ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-3">
                    <p class="title">Среда реализации:</p>
                    <?php foreach ($data['project'][0]['method'] as $key => $value): ?>
                        <p><?= $data['localizations']['methods'][$key] ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-2">
                    <p class="title">Уровень воздействия:</p>
                    <?php foreach ($data['project'][0]['level'] as $key => $value): ?>
                        <p><?= $data['localizations']['levels'][$key] ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="list-group-item col-lg-12"><h3>Организация проекта:</h3></div>
        <div class="list-group-item col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <p class="title">Оператор/автор проекта:</p>
                    <p><?= $data['project'][0]['author'] ?></p>
                </div>
                <div class="col-lg-4">
                    <p class="title">Местоположение автора/головной компании (город):</p>
                    <p><?= $data['project'][0]['author_location'] ?></p>
                </div>
                <div class="col-lg-4">
                    <p class="title">Год начала деятельности:</p>
                    <p><?= $data['project'][0]['start_year'] ?></p>
                </div>
            </div>
        </div>
        <div class="list-group-item col-lg-12"><h3>Масштаб проекта:</h3></div>
        <div class="list-group-item col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <p class="title">География оффлайн проекта:</p>
                    <?php foreach ($data['project'][0]['geography'] as $key => $value): ?>
                        <p><?= $value ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-6">
                    <p class="title">Стадия проекта:</p>
                    <p><?= $data['project'][0]['stage_of_project'] ?></p>
                </div>

            </div>
        </div>
        <div class="list-group-item col-lg-12"><h3>Лидеры:</h3></div>
        <?php if (!empty($data['one_project'])): ?>            
            <div class="list-group-item col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <p class="title">ФИО лидера:</p>
                        <?php foreach ($data['one_project'] as $key => $value): ?>
                            <p><a href="/lider?id=<?= $value['id'] ?>"><?= $value['id_lid'] ?></a></p>

                        <?php endforeach; ?>
                    </div>
                    <div class="col-lg-6">
                        <p class="title">Роль лидера:</p>
                        <?php foreach ($data['one_project'] as $key => $value): ?>
                            <p><?= $value['role'] ?>&nbsp;</p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="list-group-item col-lg-12">
                <div class="row">
                    <div class="col-lg-6">                  
                        <p>У проекта нет лидеров</p> 
                    </div>                
                </div>
            </div>
        <?php endif; ?>
        <div class="list-group-item col-lg-12"><h3>Прикрепленные файлы:</h3></div>
        <?php if (!empty($data['project_files'])): ?>            
            <div class="list-group-item col-lg-12">
                <div class="row">                    
                    <?php foreach ($data['project_files'] as $key => $value): ?>
                        <div class="col-lg-6">
                            <?php if ($value['description'] == '') {
                                $value['description'] = 'ССЫЛКА';
                            } ?>
                            <p><a target="_blank" href="/uploads/files/<?= $value['filename'] ?>"><?= $value['description'] ?></a></p>
                        </div>
                    <?php endforeach; ?>                    
                </div>
            </div>
        <?php else: ?>
            <div class="list-group-item col-lg-12">
                <div class="row">  
                    <div class="col-lg-6">                  
                        <p>Нет прикрепленных файлов</p> 
                    </div>                 
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>
