<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php //view($data) ?>
<?php if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin'): ?>

    <?php 
    $title = 'Добавление проекта';
    $page_projects = 'active';
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>

        <div class="container">
            <div class="list-group">
                <div class="form-horizontal">
<!--                     <div class="list-group-item"><a href="/user">Назад</a></div> -->
                    <?php if (($_GET['t'] == '1')): ?>
                        <div class="list-group-item"><a href="javascript:history.back()">Назад</a></div>
                    <?php endif; ?>
                    <div class="list-group-item title_menu_admin">
                        <h2>ДОБАВЛЕНИЕ НОВОГО ПРОЕКТА</h2>
                    </div>
                    <div class="form-group"></div>
                    <?php if(isset($_SESSION['id'])) :?>
                        <input style="display: none;" id="user_id" value="<?= $_SESSION['id'] ?>">
                    <?php endif; ?>
                    <?php if($_SESSION['role'] == 'admin') :?>
                        <input style="display: none;" id="id_lid" value="<?= $_GET['id'] ?>">
                    <?php endif; ?>
                    <div class="list-group-item">

                        <div class="form-group">
                            <label for="sortpicture" class="control-label col-xs-4">Загрузите изображение для проекта:</label>
                            <div class="col-xs-4">
                                <div id="preview">
                                    <img class="project_photo" src="/assets/images/img_not_found.png" alt="">
                                </div>
                                <input id="sortpicture" type="file" name="sortpic" />
                                <progress id="progressbar" value="0" max="100" style="display: none;"></progress>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="project_title" class="control-label col-xs-4">Название проекта:</label>
                            <div class="col-xs-6">
                                <input type="text" maxlength="200" name="project_title" class="form-control" id="project_title" placeholder="">
                                <p id='project_title_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="short_title" class="control-label col-xs-4">Краткое название:</label>
                            <div class="col-xs-6">
                                <input type="text" maxlength="100" name="short_title" class="form-control" id="short_title" placeholder="">
                                <p id='short_title_proj' class='error'></p>
                            </div>
                        </div>                        

                        <div class="form-group">
                            <label for="site" class="control-label col-xs-4">Сайт:</label>
                            <div class="col-xs-6">
                                <input type="text" maxlength="200" name="site" class="form-control" id="site" placeholder="">
                                <p id='site_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-4">Метапредметная направленность проекта:</label>
                            <div class="col-xs-6">
                                <?php foreach ($data['localizations']['metapredmets'] as $key => $value) : ?>
                                    <div class="checkbox">
                                        <label><input id="<?= $key ?>" class="metapredmets_check" type="checkbox" name="<?= $key ?>" value="1"><?= $value ?></label>
                                    </div>
                                <?php endforeach; ?>
                                <p id='metapredmets_proj' class='error'></p>
                            </div>
                        </div>
                        <!-- <div class="list-group-item"><h3>Направленность проекта:</h3></div> -->
                        <div class="form-group">
                            <label class="control-label col-xs-4">Предметная направленность проекта:</label>
                            <div class="col-xs-6">
                                <?php foreach ($data['localizations']['predmets'] as $key => $value) : ?>
                                    <div class="checkbox">
                                        <label><input id="<?= $key ?>" type="checkbox" name="<?= $key ?>" value="1"><?= $value ?></label>
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
                                        <label><input id="<?= $key ?>" type="checkbox" name="<?= $key ?>" value="1"><?= $value ?></label>
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
                                        <option value="<?= $key ?>"><?= $value ?></option>;
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
                                        <option value="<?= $key ?>"><?= $value ?></option>;
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
                                        <option value="<?= $key ?>"><?= $value ?></option>;
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
                                <input type="text" maxlength="150" name="author" class="form-control" id="author" placeholder="">
                                <p id='author_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="author_location" class="control-label col-xs-4">Местоположение автора/головной компании (город):</label>
                            <div class="col-xs-6">
                                <input type="text" maxlength="100" name="author_location" class="form-control" id="author_location" placeholder="">
                                <p id='author_location_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start_year" class="control-label col-xs-4">Год начала деятельности:</label>
                            <div class="col-xs-6">
                                <input type="text" maxlength="4" name="start_year" class="form-control" id="start_year" placeholder="">
                                <p id='start_year_proj' class='error'></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="geography" class="control-label col-xs-4">География оффлайн проекта:</label>
                            <div class="col-xs-6">
                                <select id="offline_geography" name="offline_geography" class="selectpicker form-control" required aria-required="true">
                                    <option value="">Не выбрано</option>
                                    <?php foreach ($data['localizations']['geographys'] as $key => $value): ?>
                                        <option value="<?= $value ?>"><?= $value ?></option>;
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
                                <textarea type="text" rows="20" cols="20" maxlength="2000" name="project_description" class="form-control" id="project_description" placeholder=""></textarea>
                                <p id='project_description_proj' class='error'></p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item content_lider"><h3>Лидеры:</h3></div>
                    <?php if (!empty($_GET) && !empty($data['getUserData'][0]['fio']) && $_SESSION['role'] == 'user') :?>
                        <div class="list-group-item check lider0 checkSize">

                            <div class="form-group">
                                <div class="col-xs-offset col-xs-1"><button onclick='AjaxCheckLiderDb("del", ".lider0");' class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div>
                                <label for="fio0" class="control-label col-xs-3">Фамилия Имя Отчество:</label>
                                <div class="col-xs-6">
                                    <input placeholder="<?= $data['getUserData'][0]['fio']?>" type="text" maxlength="150" name="fio0" id="fio0" class="form-control" disabled value="<?= $data['getUserData'][0]['fio']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role0" class="control-label col-xs-4">Роль лидера в проекте:</label>
                                <div class="col-xs-6">
                                    <input type="text" maxlength="150" name="role0" class="form-control" id="role0" placeholder="">
                                    <p id='role_lid' class='error'></p>
                                </div>
                            </div>
                        </div>
                        <script>
                            function AjaxCheckLiderDb($check, $id){
                                if ($check == false) {
                                    $(".check").remove();
                                } else if ($check == 'del') {
                                    $($id).remove();
                                    $("head").append($("<style type='text/css'> #addLider {display: block;} </style>"));
                                }
                            }
                        </script>
                    <?php endif; ?>
                    <?php if (!empty($_GET) && !empty($data['getUserData'][0]['fio']) && $_SESSION['role'] == 'admin') :?>
                        <div class="list-group-item check lider0 checkSize">

                            <div class="form-group">
                                <div class="col-xs-1"></div>
                                <label for="fio0" class="control-label col-xs-3">Фамилия Имя Отчество:</label>
                                <div class="col-xs-6">
                                    <input placeholder="<?= $data['getUserData'][0]['fio']?>" type="text" maxlength="150" name="fio0" id="fio0" class="form-control" disabled value="<?= $data['getUserData'][0]['fio']?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role0" class="control-label col-xs-4">Роль лидера в проекте:</label>
                                <div class="col-xs-6">
                                    <input type="text" maxlength="150" name="role0" class="form-control" id="role0" placeholder="">
                                    <p id='role0_lid' class='error'></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="list-group-item addLider">
                        <div class="form-group">
                            <div class="col-xs-offset col-xs-12">
                                <button class="btn btn-primary" id="addLider">Добавить лидера</button>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item content_lider_file"><h3>Прикрепленные файлы:</h3></div>
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
                                <button id="save_proj_id" type="submit" onclick="AjaxSendAddProject();" class="btn btn-danger">Опубликовать</button>
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
<?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>
        

<?php else: header('Location: /');
endif; ?>
