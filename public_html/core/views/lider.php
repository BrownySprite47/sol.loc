<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php //view($data) ?>
<?php $check = check_correct_lider($_SESSION['id'] ,$_GET['id']) ?>
<?php 
    $title = 'Карточка лидера';
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
                <input type="text" id="id_lid_num" style="display: none;" value="<?= $_GET['id'] ?>">
                <div class="col-lg-5">
                    <?php if ($_SESSION['role'] == 'user' && !$check && isset($_GET['recom']) && ($_GET['recom'] == 'true')): ?>
                        <h2>РЕКОМЕНДОВАТЬ ЛИДЕРА</h2>
                    <?php else:?>
                        <h2>КАРТОЧКА ЛИДЕРА</h2>
                    <?php endif; ?> 
                    </div>
                <?php if ($session && $admin): ?>
                    <div id="result_status" style="margin-top: 15px;">                        
                        <?php if (($data["lider"][0]['checked'] != '1')): ?>
                            <a href="javascript:void(0);" class="btn btn-success" onclick="AjaxSendStatusLider(1, <?= $_GET['id'] ?>);">Принять</a>
                        <?php endif; ?>
                        <?php if (($_GET['t'] == '1')): ?>
                            <a href="/lider/edit?id=<?= $_GET['id'] ?>&&t=1" class="btn btn-warning">Редактировать лидера</a>
                        <?php else:?>
                            <a href="/lider/edit?id=<?= $_GET['id'] ?>" class="btn btn-warning">Редактировать лидера</a>
                        <?php endif; ?>
                        <a href="javascript:void(0);" class="btn btn-danger" onclick="AjaxSendStatusLider(2, <?= $_GET['id'] ?>);">Отклонить</a>
                        <a href="/project/add?id=<?= $_GET['id'] ?>&&t=1" class="btn btn-info">Добавить новый проект</a>
                    </div>
                    <?php elseif ($_SESSION['role'] == 'user' && $check): ?>
                    <div class="col-lg-2">
                        <?php if (($_GET['t'] == '1')): ?>
                            <a href="/lider/edit?id=<?= $_GET['id'] ?>&&t=1" class="btn btn-success edit_btn_abs">Редактировать лидера</a>
                        <?php else:?>
                            <a href="/lider/edit?id=<?= $_GET['id'] ?>" class="btn btn-success edit_btn_abs">Редактировать лидера</a>
                        <?php endif; ?>                        
                    </div>>
                <?php endif; ?>


            </div>
        </div>
        <div class="list-group-item col-lg-12"><p><span class="title"> ФИО: </span><?= $data['lider'][0]['fio'] ?></p></div>
        <div class="list-group-item col-lg-12">
            <div class="row">
                    <?php if ($_SESSION['role'] == 'user' && !$check && isset($_GET['recom']) && ($_GET['recom'] == 'true')): ?>
                        <div class="col-lg-8">
                        <strong>Напишите, почему вы рекомендуете именно этого лидера?</strong>
                        <textarea style="width: 100%; resize: none; margin: 20px 0" rows="10" id="textfield_recom" type="text" value=""></textarea>
                        <button class="btn btn-success open-modal-recom">Рекомендовать</button> 
                        </div>
                    <?php endif; ?>
                <div class="col-lg-4">
                    <?php if (!empty($data['lider'][0]['image_name'])): ?>
                        <img class="liders_photo" src="/uploads/images/<?= $data['lider'][0]['image_name'] ?>" alt="">
                    <?php else: ?>
                        <img class="liders_photo" src="/assets/images/img_not_found.png" alt="">
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <?php if(!empty($data['lider'][0]['city'])): ?>
                        <p><span class="title"> Основное место жительства (город): <br></span><?= $data['lider'][0]['city'] ?></p>
                    <?php else: ?>
                        <p><span class="title"> Основное место жительства (город): <br></span>Не указано</p>
                    <?php endif; ?>

                    <?php if(!empty($data['lider'][0]['region'])): ?>
                        <p><span class="title"> Регион: <br></span><?= $data['lider'][0]['region'] ?></p>
                    <?php else: ?>
                        <p><span class="title"> Регион: <br></span>Не указано</p>
                    <?php endif; ?>
                    
                </div>
                <div class="col-lg-4">
                    <!-- <p><span class="title"> Дата рождения: </span><?= $data['lider'][0]['birthday'] ?></p> -->
                    <?php if(!empty($data['lider'][0]['social'])): ?>
                        <p><span class="title"> Страница в соц.сетях: <br></span><a target="_blank" href="<?= $data['lider'][0]['social'] ?>">ССЫЛКА</a></p>
                    <?php else: ?>
                        <p><span class="title"> Страница в соц.сетях: <br></span>Не указано</p>
                    <?php endif; ?>                      
                    <?php if ($data['lider'][0]['male_female'] == 'м'): ?>
                        <p><span class="title"> Пол: </span>Мужской</p>
                    <?php elseif($data['lider'][0]['male_female'] == 'ж'): ?>
                        <p><span class="title"> Пол: </span>Женский</p>
                    <?php else: ?>
                        <p><span class="title"> Пол: </span>Не указано</p>
                    <?php endif; ?>  
                    <?php if($_SESSION['role'] =='admin'): ?>
                        <?php if(!empty($data['lider'][0]['telephone'])): ?>
                            <p><span class="title"> Телефон: <br></span><?= $data['lider'][0]['telephone'] ?></p>
                        <?php else: ?>
                            <p><span class="title"> Телефон: <br></span>Не указано</p>
                        <?php endif; ?>
                        <?php if(!empty($data['lider'][0]['email'])): ?>
                            <p><span class="title"> Email: <br></span><?= $data['lider'][0]['email'] ?></p> 
                        <?php else: ?>
                            <p><span class="title"> Email: <br></span>Не указано</p> 
                        <?php endif; ?>                                               
                    <?php endif; ?>
                    <?php if(!empty($data['lider'][0]['contact_info'])): ?>
                        <p><span class="title"> Дополнительная контактная информация: <br></span><?= $data['lider'][0]['contact_info'] ?></p>
                    <?php else: ?>
                        <p><span class="title"> Дополнительная контактная информация: <br></span>Не указано</p>
                    <?php endif; ?>                    
                </div>
            </div>
        </div>
        <div class="list-group-item col-lg-12">
            <div class="row">
                <?php if(!empty($data['lider'][0]['i_can'])): ?>
                <div class="col-lg-6">
                    <p><span class="title"> Могу поделиться: <br></span><?= $data['lider'][0]['i_can'] ?></p>
                </div>
                <?php endif; ?>
                <?php if(!empty($data['lider'][0]['i_need'])): ?>
                <div class="col-lg-6">
                    <p><span class="title"> Мне нужно: <br></span><?= $data['lider'][0]['i_need'] ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="list-group-item col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <p class="title">Проекты у лидера:</p>
                    <?php if(!empty($data['projects'])): ?>
                        <?php foreach ($data['projects'] as $key => $value): ?>
                            <p><a href="/project?id=<?= $value['id_proj'] ?>"><?= $value['project_title'] ?></a></p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Нет проектов</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
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
<!-- HTML-код модального окна-->
            <div id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Ваша рекомендация успешно принята!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Вы хотите рекомендовать еще одного лидера?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="/lider/add" class="btn btn-default">Да</a>
                            <a href="/lider/?id=<?= $_GET['id'] ?>" class="btn btn-default">Нет</a>
                        </div>
                    </div>
                </div>
            </div>

<?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>
