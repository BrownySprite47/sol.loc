<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php if ($_SESSION['role'] == 'user'): ?>
<?php //view($data['user_social']) ?>
<?php 
    $title = 'Личный кабинет';
    $page_projects = 'active';
    $page_liders = '';
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>

<div id="content-main">
    <div class="container">
        <div class="list-group">
            <div class="list-group-item col-lg-12">
                <div class="row">
                        <div class="col-lg-4">
                            <div class="list-group-item title_menu_admin">
                                <?php if (!empty($data['user'][0]['image_name'])): ?>
                                    <img class="liders_photo" src="/uploads/images/<?= $data['user'][0]['image_name'] ?>" alt="">
                                <?php else: ?>
                                    <img class="liders_photo" src="/assets/images/img_not_found.png" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="list-group-item" style="text-align: center; padding: 10px 0;">
                                <a href="/user/edit" class="btn btn-warning">Редактировать анкету</a>
                            </div>
                            <?php if(!empty($data['user'][0]['fio'])): ?>                                
                            <div class="list-group-item title_menu_admin">
                                <p><span class="title"> ФИО: </span><?= ($data['user'][0]['fio'] == '') ? 'Не указано' : $data['user'][0]['fio'] ?></p>
                                <p><span class="title"> Телефон: </span><?= ($data['user'][0]['telephone'] == '') ? 'Не указано' : $data['user'][0]['telephone'] ?></p>
                                <p><span class="title"> Email: </span><?= ($data['user'][0]['email'] == '') ? 'Не указано' : $data['user'][0]['email'] ?></p>
                                <p><span class="title"> Город : </span><?= ($data['user'][0]['city'] == '') ? 'Не указано' : $data['user'][0]['city'] ?></p>
                                <p><span class="title"> Регион: </span><?= ($data['user'][0]['region'] == '') ? 'Не указано' : $data['user'][0]['region'] ?></p>
                                <?php if ($data['user'][0]['male_female'] == 'м'): ?>
                                    <p><span class="title"> Пол: </span>Мужской</p>
                                <?php elseif($data['user'][0]['male_female'] == 'ж'): ?>
                                    <p><span class="title"> Пол: </span>Женский</p>
                                <?php else: ?>
                                    <p><span class="title"> Пол: </span>Не указано</p>
                                <?php endif; ?>


                                <?php if ($data['user'][0]['social'] == ''): ?>
                                    <p><span class="title"> Страница в соц.сетях: </span>Не указано</p>
                                <?php else: ?>
                                    <p><span class="title"> Страница в соц.сетях: </span><a  target="_blank" href="<?= $data['user'][0]['social']?>">Ссылка</a></p>
                                <?php endif; ?>
<!--                                 <p><span class="title"> Страница в соц.сетях: <br></span><a  target="_blank" href="<?= ($data['user'][0]['social'] == '0') ? '' : $data['user'][0]['social'] ?>"><?= ($data['user'][0]['social'] == '') ? 'Не указано' : $data['user'][0]['social']  ?></a></p> -->
                                <p><span class="title"> Дополнительная контактная информация: <br></span><?= ($data['user'][0]['contact_info'] == '0') ? '' : $data['user'][0]['contact_info']  ?></p>
                                <p><span class="title"> Дата рождения: </span><?= ($data['user'][0]['birthday'] == '') ? 'Не указано' : $data['user'][0]['birthday']  ?></p>
                                <p><span class="title"> Могу поделиться: </span><?= ($data['user'][0]['i_can'] == '') ? 'Не указано' : $data['user'][0]['i_can']  ?></p>
                                <p><span class="title"> Мне нужно: </span><?= ($data['user'][0]['i_need'] == '') ? 'Не указано' : $data['user'][0]['i_need']  ?></p>
                                <?php if ($data['user'][0]['checked'] == '0' || $data['user'][0]['checked'] == '3'): ?>
                                    <div class="rel_box_btn_status_lider">
                                        <a class="btn btn-warning">Проверяется</a>
                                    </div>
                                <?php endif; ?>
                                <?php if ($data['user'][0]['checked'] == '1'): ?>
                                    <div class="rel_box_btn_status_lider">
                                        <a class="btn btn-success">Опубликован</a>
                                    </div>
                                <?php endif; ?>
                                <?php if ($data['user'][0]['checked'] == '2'): ?>
                                    <div class="rel_box_btn_status_lider">
                                        <a class="btn btn-danger">Отклонен</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="list-group-item title_menu_admin">Мои файлы: </div>
                            <?php if (!empty($data['project_files'])): ?>            
                                <div class="list-group-item title_menu_admin">
                                    <div class="row">                    
                                        <?php foreach ($data['project_files'] as $key => $value): ?>
                                            <div class="col-lg-12">
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
                        <?php else: ?>
                            <div class="list-group-item"><p>Для получения доступа к возможности рекомендовать других лидеров, а также добавления собственных проектов, Вам необходимо заполнить информацию о себе! <span class="title"><a href="/user/edit">Заполните анкету</a></span></p></div>
                        <?php endif; ?>
                    </div>
                    <div class="list-group col-lg-8">
                        <div class="list-group-item title_menu_admin">
                            <div class="" style="">
                                <h2>ПОДКЛЮЧИТЬ СОЦСЕТИ</h2>
                            </div> 
                        </div>
                        <div class="list-group-item rel_box">
                            <div class="panel panel-login">
                                <div class="panel-body social_user_app" style="text-align: center;">     
                                    <?php if ($data['user_social'][0]["vk"] != ''): ?>
                                        <i style="color: green;position: absolute;bottom: 39px;left: 191px;" class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    <?php endif; ?>                                   
                                    <a href="http://oauth.vk.com/authorize?client_id=6233715&scope=notify&redirect_uri=http://suppor1k.beget.tech/auth/?provider=vk&response_type=code" style="padding: 20px 30px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/Vk.png') no-repeat;"></a>
                                    <?php if ($data['user_social'][0]["odnoklassniki"] != ''): ?>
                                        <i style="color: green;position: absolute;bottom: 39px;left: 255px;" class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <a href="http://www.odnoklassniki.ru/oauth/authorize?client_id=1258439680&response_type=code&redirect_uri=http://suppor1k.beget.tech/auth?provider=odnoklassniki" style="padding: 20px 30px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/Odnoklassniki.png') no-repeat;"></a>
                                    <?php if ($data['user_social'][0]["mailru"] != ''): ?>
                                        <i style="color: green;position: absolute;bottom: 39px;left: 319px;" class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <a href="https://connect.mail.ru/oauth/authorize?client_id=757179&response_type=code&redirect_uri=http://suppor1k.beget.tech/auth/?provider=mailru" style="padding: 20px 30px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/Mailru.png') no-repeat;"></a>
                                    <?php if ($data['user_social'][0]["yandex"] != ''): ?>
                                        <i style="color: green;position: absolute;bottom: 39px;right: 346px;" class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <a href="https://oauth.yandex.ru/authorize?response_type=code&client_id=3272d2f091804fbabb89c007cd0f412b&display=popup" style="padding: 20px 30px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/Yandex.png') no-repeat;"></a>
                                    <?php if ($data['user_social'][0]["google"] != ''): ?>
                                        <i style="color: green;position: absolute;bottom: 39px;right: 283px;" class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <a href="https://accounts.google.com/o/oauth2/auth?redirect_uri=http://suppor1k.beget.tech/auth?provider=google&response_type=code&client_id=529306401514-h62351b4kai0m3vsdumsmcq1cc4056j9.apps.googleusercontent.com&scope=https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile" style="padding: 20px 30px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/Google.png') no-repeat;"></a>
                                    <?php if ($data['user_social'][0]["facebook"] != ''): ?>
                                        <i style="color: green;position: absolute;bottom: 39px;right: 219px;" class="fa fa-check-circle-o" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <a href="https://www.facebook.com/dialog/oauth?client_id=291924507965005&redirect_uri=http://suppor1k.beget.tech/auth/?provider=facebook&response_type=code&scope=email,user_birthday" style="padding: 20px 30px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/Facebook.png') no-repeat;"></a>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group col-lg-8">
                        <div class="list-group-item title_menu_admin">
                            <div class="" style="display: inline-block;">
                                <h2>МОИ ПРОЕКТЫ</h2>
                            </div>
                            <?php if(!empty($data['user'][0]['fio'])): ?>  
                                <div class="" style="float: right;padding-top: 18px;">
                                    <a href="/project/add" class="btn btn-danger">Добавить свой проект</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($data['getProjectsFromUser'])): ?>
                        <?php foreach ($data['getProjectsFromUser'] as $key => $value): ?>
                        <div class="list-group-item rel_box">
                            <div>
                                <p class="padd_H3 title">Название проекта:</p> 
                                <h4 style="max-width: 537px;"><a target="_blank" href="/project?id=<?= $value['id_proj'] ?>"><?= $value['project_title'] ?></a></h4>
                                <div class="form-group">
                                    <input style="display: none;" id="user_id" value="<?= $_SESSION['id'] ?>">
                                </div>
                                <div class="form-group">
                                    <input style="display: none;" id="id_proj" value="<?= $value['id_proj'] ?>">
                                </div>
                                <p class="title">Описание проекта:</p> 
                                <?php if (empty($value['project_description'])): ?>
                                    <p>Нет описания</p>
                                <?php else: ?>
                                    <p><?= $value['project_description'] ?></p>
                                <?php endif; ?>        
                                
                            </div>
                            <div class="rel_box_btn">
                                <a  target="_blank" href="/project/edit?id=<?= $value['id_proj'] ?>" class="btn btn-default">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                            </div>
                            <?php if ($value['checked'] == '0' || $value['checked'] == '3'): ?>
                                <div class="rel_box_btn_status" style="position: absolute;top: 10px;right: 75px;">
                                    <a href="javascript:void(0);" class="btn btn-warning">Проверяется</a>
                                </div>
                            <?php endif; ?>
                            <?php if ($value['checked'] == '1'): ?>
                                <div class="rel_box_btn_status" style="position: absolute;top: 10px;right: 75px;">
                                    <a href="javascript:void(0);" class="btn btn-success">Опубликован</a>
                                </div>
                            <?php endif; ?>
                            <?php if ($value['checked'] == '2'): ?>
                                <div class="rel_box_btn_status" style="position: absolute;top: 10px;right: 75px;">
                                    <a href="javascript:void(0);" class="btn btn-danger">Отклонен</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="list-group-item">
                            <h3>Нет проектов</h3>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($_GET['auth_key'])): ?>            
        <!-- HTML-код модального окна-->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog" style="margin: 220px auto !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" style="text-align: center;">Пожалуйста, введите новый пароль!</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-3">&nbsp;</div>
                                <div class="col-xs-6">
                                    <input maxlength="100" name="password1" class="form-control" id="password1" placeholder="" type="text">
                                    <p id="password1_proj" class="error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-3">&nbsp;</div>
                                <div class="col-xs-6">
                                    <input type="text" maxlength="100" name="password2" class="form-control" id="password2" placeholder="">
                                    <p id='password2_proj' class='error'></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-xs-12" style="text-align: center;">
                            <button id="change" class="btn btn-info">Изменить</button>
                        </div>
                        <p id="error_pass"></p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $("#myModal").removeClass("modal fade").addClass("modal fade in"); 
                $("#myModal").css("display", "block"); 
                $("#backdrop").addClass("modal-backdrop fade in");          
            }); 
        </script>
        <script>
                $('#change').click(function(){
                    $.post(
                        '/ajax/change_password',
                        {
                            password1: $('#password1').val(),
                            password2: $('#password2').val(),
                        },
                        AjaxSuccess
                    );

                    function AjaxSuccess(data) {
                        if (data == "password_wrong_user") {
                            $('#error_pass').html('Проверьте корректность ввода пароля');
                        }if (data == "password_wrong_user_empty") {
                            $('#error_pass').html('Заполните оба поля');
                        }if (data == "password_success_user") {
                            window.location.href = "/user";
                        }else{
                            $('#error_pass').html(data);
                        }
                    }
                });
        </script>
<?php endif; ?>
<?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>


<?php else: header('Location: /');
endif; ?>
