<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php //view($data['getUserData']) ?>
<?php $check = check_correct_project($_SESSION['id'] ,$_GET['id']) ?>
<?php echo ""; ?>
<?php if (($check && $_SESSION['role'] == 'user') || ($_SESSION['role'] == 'admin')): ?>

    <?php 
    $title = 'Редактирование проекта';
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
                    <div class="list-group-item title_menu_admin">
                        <div class="menu_edit">
                            <h2>РЕДАКТИРОВАНИЕ ПРОЕКТА</h2>
                            <button class="btn btn-danger open-modal del_btn_abs">Удалить проект</button>      
                        </div>
                    </div>                    
                    <div class="form-group"></div>
                    <?php if(isset($_SESSION['id']) && $_SESSION['role'] == 'user'): ?>
                        <input style="display: none;" id="user_id" value="<?= $_SESSION['id'] ?>">
                    <?php elseif(isset($_SESSION['id']) && $_SESSION['role'] == 'admin'): ?>
                        <input style="display: none;" id="id_lid" value="<?= $_GET['id'] ?>">
                    <?php endif; ?>
                        <input style="display: none;" id="id_proj" value="<?= $data['project'][0]['id_proj'] ?>">
                    <div class="list-group-item">

                        <div class="form-group">
                            <label for="sortpicture" class="control-label col-xs-4">Загрузите изображение для проекта:</label>
                            <div class="col-xs-4">
                                <div id="preview">
                                    <?php if (!empty($data['project'][0]['image_name'])): ?>
                                        <img class="liders_photo" src="/uploads/images/<?= $data['project'][0]['image_name'] ?>" alt="">
                                    <?php else: ?>
                                        <img class="liders_photo" src="/assets/images/img_not_found.png" alt="">
                                    <?php endif; ?>
                                </div>
                                <input id="sortpicture" type="file" name="sortpic" />
                                <progress id="progressbar" value="0" max="100" style="display: none;"></progress>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="project_title" class="control-label col-xs-4">Название проекта:</label>
                            <div class="col-xs-6">
                                <input type="text" value="<?= $data['project'][0]['project_title'] ?>" maxlength="200" name="project_title" class="form-control" id="project_title" placeholder="">
                                <p id='project_title_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="short_title" class="control-label col-xs-4">Краткое название:</label>
                            <div class="col-xs-6">
                                <input type="text" maxlength="100" value="<?= $data['project'][0]['short_title'] ?>" name="short_title" class="form-control" id="short_title" placeholder="">
                                <p id='short_title_proj' class='error'></p>
                            </div>
                        </div>                        

                        <div class="form-group">
                            <label for="site" class="control-label col-xs-4">Сайт:</label>
                            <div class="col-xs-6">
                                <input type="text" maxlength="200" value="<?= $data['project'][0]['site'] ?>"  name="site" class="form-control" id="site" placeholder="">
                                <p id='site_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-4">Метапредметная направленность проекта:</label>
                            <div class="col-xs-6">
                                <?php foreach ($data['localizations']['metapredmets'] as $key => $value) : ?>
                                    <div class="checkbox">
                                        <label><input id="<?= $key ?>" <?= ($data['project'][0]['metapredmets'][$key] == '1') ? 'checked' : '' ?> class="metapredmets_check" type="checkbox" name="<?= $key ?>"><?= $value ?></label>
                                    </div>
                                <?php endforeach; ?>
                                <p id='metapredmets_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-4">Предметная направленность проекта:</label>
                            <div class="col-xs-6">
                                <?php foreach ($data['localizations']['predmets'] as $key => $value) : ?>
                                    <div class="checkbox">
                                        <label><input id="<?= $key ?>" <?= ($data['project'][0]['predmets'][$key] == '1') ? 'checked' : '' ?> type="checkbox" name="<?= $key ?>"><?= $value ?></label>
                                    </div>
                                <?php endforeach; ?>
                                <p id='predmets_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-4">Конечные потребители:</label>
                            <div class="col-xs-6">
                                <?php foreach ($data['localizations']['ages'] as $key => $value) : ?>
                                    <div class="checkbox">
                                        <label><input id="<?= $key ?>" <?= ($data['project'][0]['ages'][$key] == '1') ? 'checked' : '' ?> type="checkbox" name="<?= $key ?>" value="1"><?= $value ?></label>
                                    </div>
                                <?php endforeach; ?>
                                <p id='ages_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-4">Среда реализации:</label>
                            <div class="col-xs-6">
                                <select id="method" name="method" class="selectpicker form-control">
                                    <option value="">Не выбрано</option>
                                    <?php foreach ($data['localizations']['methods'] as $key => $value): ?>
                                        <option <?= ($data['project'][0]['method'][$key] == '1') ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>;
                                    <?php endforeach; ?>
                                </select>
                                <p id='method_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-4">Уровень воздействия:</label>
                            <div class="col-xs-6">
                                <select id="level" name="level" class="selectpicker form-control">
                                    <option value="">Не выбрано</option>
                                    <?php foreach ($data['localizations']['levels'] as $key => $value): ?>
                                        <option <?= ($data['project'][0]['level'][$key] == '1') ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>;
                                    <?php endforeach; ?>
                                </select>
                                <p id='level_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-4">Стадия проекта:</label>
                            <div class="col-xs-6">
                                <select id="stage_of_project" name="stage_of_project" class="selectpicker form-control">
                                    <option value="">Не выбрано</option>
                                    <?php foreach ($data['localizations']['stage_of_project'] as $key => $value): ?>
                                        <option <?= ($data['project'][0]['stage_of_project'] == $value) ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>;
                                    <?php endforeach; ?>
                                </select>
                                <p id='stage_of_project_proj' class='error'></p>
                            </div>
                        </div>

                    </div>
                    <!-- <div class="list-group-item"><h3>Общие характеристики проекта:</h3></div> -->
                    <div class="list-group-item">
                        <div class="form-group">
                            <label for="author" class="control-label col-xs-4">Оператор/автор проекта (физическое или юридическое лицо):</label>
                            <div class="col-xs-6">
                                <input type="text" maxlength="150" value="<?= $data['project'][0]['author'] ?>" name="author" class="form-control" id="author" placeholder="">
                                <p id='author_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="author_location" class="control-label col-xs-4">Местоположение автора/головной компании (город):</label>
                            <div class="col-xs-6">
                                <input type="text" maxlength="100" value="<?= $data['project'][0]['author_location'] ?>" name="author_location" class="form-control" id="author_location" placeholder="">
                                <p id='author_location_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start_year" class="control-label col-xs-4">Год начала деятельности:</label>
                            <div class="col-xs-6">
                                <input type="text" maxlength="4" value="<?= $data['project'][0]['start_year'] ?>" name="start_year" class="form-control" id="start_year" placeholder="">
                                <p id='start_year_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="geography" class="control-label col-xs-4">География оффлайн проекта:</label>
                            <div class="col-xs-6">
                                <select id="offline_geography" name="offline_geography" class="selectpicker form-control" required aria-required="true">
                                    <option value="">Не выбрано</option>
                                    <?php foreach ($data['localizations']['geographys'] as $key => $value): ?>
                                        <option <?= ($data['project'][0]['geography']['offline_geography'] == $value) ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>;
                                    <?php endforeach; ?>
                                </select>
                                <p id='offline_geography_proj' class='error'></p>
                            </div>
                        </div>

                    </div>
                    <div class="list-group-item">
                        <div class="form-group">
                            <label for="project_description" class="control-label col-xs-4">Описание проекта:</label>
                            <div class="col-xs-6">
                                <textarea type="text" rows="20" type="text" maxlength="2000" name="project_description" class="form-control" id="project_description" placeholder=""><?= $data['project'][0]['project_description'] ?></textarea>
                                <p id='project_description_proj' class='error'></p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item content_lider"><h3>Лидеры:</h3></div>
                    <?php if (!empty($_GET) && !empty($data['getUserData'][0]['fio'])) :?>
                        <?php $i = 0;?>
                        <?php foreach($data['getUserData'] as $key => $value): ?>
                        <div class="list-group-item lider<?= $i ?> check<?= $i ?> checkSize">

                            <div class="form-group">
                                <div class="col-xs-offset col-xs-1"><button onclick='AjaxCheckLiderDb("del", ".lider<?= $i ?>");' class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div>
                                <label for="fio<?= $i ?>" class="control-label col-xs-3">Фамилия Имя Отчество:</label>
                                <div class="col-xs-6">
                                    <select data-live-search="true" class="selectpicker form-control" name="fio<?= $i ?>" id="fio<?= $i ?>">
                                        <option value="">Не выбрано</option>
                                        <?php foreach ($data['filters']['fio'] as $filter): ?>
                                            <option <?= ($data['getUserData'][$key]['fio'] == $filter['fio'] ? 'selected' : '') ?> value="<?= $filter['fio'] ?>"><?= $filter['fio'] ?></option>';
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role<?= $i ?>" class="control-label col-xs-4">Роль лидера в проекте:</label>
                                <div class="col-xs-6">
                                    <input type="text" maxlength="150" name="role<?= $i ?>" class="form-control" id="role<?= $i ?>" placeholder="" value="<?= $data['getUserData'][$key]['role'] ?>">
                                    <p id='role<?= $i ?>_lid' class='error'></p>
                                </div>
                            </div>
                        </div>
                        <script>
                            function AjaxCheckLiderDb($check, $id){
                                if ($check == false) {
                                    $(".check<?= $i ?>").remove();
                                } else if ($check == 'del') {
                                    $($id).remove();
                                    $("head").append($("<style type='text/css'> #addLider {display: block;} </style>"));
                                }
                            }
                        </script>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>                    
                    <div class="list-group-item addLider">
                        <div class="form-group">
                            <div class="col-xs-offset col-xs-12">
                                <button class="btn btn-primary" id="addLider">Добавить лидера</button>
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
                    <div class="list-group-item save_project">
                        <div class="form-group">
                            <div class="col-xs-offset col-xs-12">
                                <button type="submit" onclick="AjaxSendUpdateProject();" class="btn btn-danger">Опубликовать</button>
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
        <!-- HTML-код модального окна-->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Вы уверены, что хотите удалить проект?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Восстановить данные будет невозможно</p>
                    </div>
                    <div class="modal-footer">
                        <button id="del_proj_id" onclick="delete_project(<?= $_GET['id'] ?>)" class="btn btn-default del-lid" data-dismiss="modal">Удалить</button>
                        <button class="btn btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>
        
<?php else: show404page(); ?>
<?php endif; ?>
