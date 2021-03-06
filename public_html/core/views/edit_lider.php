<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php $check = check_correct_lider($_SESSION['id'] ,$_GET['id']) ?>
<?php //view($data) ?>
<?php echo ""; ?>
<?php if (($check && $_SESSION['role'] == 'user') || $_SESSION['role'] == 'admin'): ?>

    <?php 
    $title = 'Редактирование лидера';
    $page_projects = 'active';
    $page_liders = '';
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>
    <div class="container">
        <div class="list-group">
            <div class="form-horizontal">
                <?php if (($_GET['t'] == '1')): ?>
                    <div class="list-group-item"><a id="back_link" href="javascript:history.back(2)">Назад</a></div>
                <?php endif; ?>
                <div class="">
                    <div class="">
                        <div class="list-group-item title_menu_admin">
                            <div class="menu_edit">
                                <h2>РЕДАКТИРОВАНИЕ ЛИДЕРА</h2>
                                <button class="btn btn-danger open-modal del_btn_abs">Удалить лидера</button> 
                                <a href="/project/add?id=<?= $_GET['id'] ?>" class="btn btn-info" style="position: absolute; top: 24px; right: 183px;">Добавить новый проект</a>     
                            </div>
                        </div>
                        <!-- <div class="list-group-item title_menu_admin">
                            <h2>РЕДАКТИРОВАНИЕ ЛИДЕРА</h2>
                        </div>
                        <div class="col-xs-3">
                            <div class="navbar-form navbar-right">
                                <button class="btn btn-danger open-modal">Удалить лидера</button>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="navbar-form navbar-right">
                                <a href="/project/add?id=<?= $_GET['id'] ?>" class="btn btn-info">Добавить новый проект</a>
                            </div>
                        </div> -->
                    </div>
                    <div class="list-group-item">
                        <?php if($_SESSION['role'] == 'user') :?>
                            <input style="display: none;" id="user_id" value="<?= $_SESSION['id'] ?>">
                        <?php endif; ?>
                        <input style="display: none;" id="id_lid" value="<?= $_GET['id'] ?>">
                        <div class="form-group liders_photo_box">
                            <div class="col-lg-3">
                                <div id="preview">
                                    <?php if (!empty($data['user'][0]['image_name'])): ?>
                                        <img class="liders_photo" src="/uploads/images/<?= $data['user'][0]['image_name'] ?>" alt="">
                                    <?php else: ?>
                                        <img class="liders_photo" src="/assets/images/img_not_found.png" alt="">
                                    <?php endif; ?>
                                </div>
                                <input id="sortpicture" type="file" name="sortpic" />
                                <progress id="progressbar" value="0" max="100" style="display: none;"></progress>
                                <!-- <button id="upload">Загрузить</button> -->
                            </div>
                            <div class="col-lg-9">
                                <div class="col-lg-5">
                                    <label for="familya" class="control-label">Фамилия:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="familya" class="form-control" id="familya" value="<?= ($data['user'][0]['familya'] == '0') ? '' : $data['user'][0]['familya'] ?>">
                                    <p id='familya_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="name" class="control-label">Имя:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="name" class="form-control" id="name" value="<?= ($data['user'][0]['name'] == '0') ? '' : $data['user'][0]['name'] ?>">
                                    <p id='name_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="otchestvo" class="control-label">Отчество:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="otchestvo" class="form-control" id="otchestvo" value="<?= ($data['user'][0]['otchestvo'] == '0') ? '' : $data['user'][0]['otchestvo'] ?>">
                                    <p id='otchestvo_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="city" class="control-label">Основное место жительства (город):</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="city" class="form-control" id="city" value="<?= ($data['user'][0]['city'] == '0') ? '' : $data['user'][0]['city'] ?>">
                                    <p id='city_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="region" class="control-label">Регион:</label>
                                </div>                                
                                <div class="col-lg-7">
                                    <input type="text" name="region" class="form-control" id="region" value="<?= ($data['user'][0]['region'] == '0') ? '' : $data['user'][0]['region'] ?>">
                                    <p id='region_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="region" class="control-label">Пол:</label>
                                </div>
                                <div class="col-lg-7">
                                    <select id="male_female" name="male_female" class="selectpicker form-control">
                                        <option <?= ($data['user'][0]['male_female'] == '') ? 'selected' : '' ?> value="">Не выбрано</option>
                                        <option <?= ($data['user'][0]['male_female'] == "м") ? 'selected' : '' ?> value="м">Мужской</option>
                                        <option <?= ($data['user'][0]['male_female'] == "ж") ? 'selected' : '' ?> value="ж">Женский</option>
                                    </select>
                                    <p id='region_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="birthday" class="control-label">Дата рождения:</label>
                                </div>
                                <div class="col-lg-7">
                                    <div class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                                        <input id="birthday" name="birthday" class="form-control" type="text" value="<?= ($data['user'][0]['birthday'] == '0') ? '' : $data['user'][0]['birthday'] ?>" readonly>
                                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    </div>
                                    <p id='birthdayl_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="social" class="control-label">Страница в соц.сетях:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="social" class="form-control" id="social" value="<?= ($data['user'][0]['social'] == '0') ? '' : $data['user'][0]['social'] ?>">
                                    <p id='social_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="telephone" class="control-label">Телефон:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="telephone" class="form-control" id="telephone" value="<?= ($data['user'][0]['telephone'] == '0') ? '' : $data['user'][0]['telephone'] ?>">
                                    <p id='telephone_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="email" class="control-label">Email:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="email" name="email" class="form-control" id="email" value="<?= ($data['user'][0]['email'] == '0') ? '' : $data['user'][0]['email'] ?>">
                                    <p id='email_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="contact_info" class="control-label">Дополнительная контактная информация:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="contact_info" class="form-control" id="contact_info" value="<?= ($data['user'][0]['contact_info'] == '0') ? '' : $data['user'][0]['contact_info'] ?>">
                                    <p id='contact_info_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="contact_info" class="control-label">Могу поделиться:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="i_can" class="form-control" id="i_can" value="<?= ($data['user'][0]['i_can'] == '0') ? '' : $data['user'][0]['i_can'] ?>">
                                    <p id='i_can_lid' class='error'></p>
                                </div><div class="col-lg-5">
                                    <label for="i_need" class="control-label">Мне нужно:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="i_need" class="form-control" id="i_need" value="<?= ($data['user'][0]['i_need'] == '0') ? '' : $data['user'][0]['i_need'] ?>">
                                    <p id='i_need_lid' class='error'></p>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item content_lider_file"><h3>Прикрепленные файлы:</h3></div>
                    <?php if (!empty($_GET) && !empty($data['project_files'][0]['filename'])) :?>
                        <?php $i = 0;?>
                        <?php foreach($data['project_files'] as $key => $value): ?>
                        <div class="list-group-item content_lider_file file<?= $i; ?> checkSizeFile">
                            <div class="form-group">
                                <div class="col-xs-offset col-xs-1"><button onclick='AjaxCheckLiderDbFile("del", ".file<?= $i; ?>");' class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div>
                                <?php if ($value['description'] == '') {
                                    $value['description'] = 'ССЫЛКА';
                                } ?>
                                <div class="col-xs-3"><p><a href="/uploads/files/<?= $value['filename'] ?>"><?= $value['description'] ?></a></p></div>                                
                                <input id="preview_file_<?= $i ?>" type="text" name="filename" value="<?= $value['filename'] ?>" style="display: none;">
                                <div class="col-xs-2"><p>Изменить название: </p></div>
                                <div class="col-xs-6"><input type="text" maxlength="150" name="description<?= $i ?>" class="form-control" id="description<?= $i ?>" placeholder="" value="<?= $value['description'] ?>"></div>
                            </div> 
                        </div>
<!--                         <script>
                            $('#upload_<?= $i; ?>').on('click', function() {
                                var file_data = $('#file<?= $i; ?>').prop('files')[0];
                                var form_data = new FormData();
                                form_data.append('file', file_data);
            //                    alert(form_data);
                                $.ajax({
                                    url: '/ajax/upload_file',
                                    dataType: 'text',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: form_data,
                                    type: 'post',
                                    success: function(php_script_response){
                                        $('#preview_file_<?= $i; ?>').val(php_script_response);
                                    }
                                });
                            });
                        </script> -->
                        <script>
                            function AjaxCheckLiderDbFile($check, $id){
                                if ($check == false) {
                                    $(".check<?= $i; ?>").remove();
                                } else if ($check == 'del') {
                                    $($id).remove();
                                    $("head").append($("<style type='text/css'> #addFile {display: block;} </style>"));
                                }
                            }
                        </script>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="list-group-item addFile">
                        <div class="form-group">
                            <div class="col-xs-offset col-xs-12">
                                <button class="btn btn-primary" id="addFile">Прикрепить файл</button>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item save_lider">
                        <div class="form-group">
                            <div class="col-xs-offset col-xs-12">
                                <button id="edit_lid_btn" type="submit" onclick="AjaxSendUpdateLider();" class="btn btn-danger">Сохранить</button>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="form-group">
                            <p id="result_public"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <!-- HTML-код модального окна-->
            <div id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Вы уверены, что хотите удалить лидера?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Восстановить данные будет невозможно</p>
                        </div>
                        <div class="modal-footer">
                            <button id="del_proj_id" onclick="delete_lider(<?= $_GET['id'] ?>)" class="btn btn-default del-lid" data-dismiss="modal">Удалить</button>
                            <button class="btn btn-default" data-dismiss="modal">Отмена</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>
            

<?php else: show404page();
endif; ?>

