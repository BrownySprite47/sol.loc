<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php //view($data) ?>
<?php if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin'): ?>

    <?php 
    $title = 'Добавление лидера';
    $page_projects = 'active';
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>
<!--     <form action="search.php" method="post" name="form" onsubmit="return false;">
  <p>
    Живой поиск:<br>
    <input name="search" type="text" id="familya">
    <small>Вводите на английском языке</small>
  </p>
</form> -->
<div class="resSearch" style="position: absolute; z-index: 10;"></div>
<script type="text/javascript">
    function checkSearch($id){;
            $('.search_box_'+$id).hide();
        }
</script>
<script type="text/javascript">
$(function(){
  $("#familya").keyup(function(){
     var search = $("#familya").val();
     $.ajax({
       type: "POST",
       url: "/ajax/search_recommend",
       data: {"search": search},
       cache: false,                                
       success: function(response){
          $(".resSearch").html(response);
       }
     });
     return false;
   });
});
</script>

        <div class="container">
            <div class="list-group">
                <div class="form-horizontal">
                    <?php if (($_GET['t'] == '1')): ?>
                        <div class="list-group-item"><a href="javascript:history.back()">Назад</a></div>
                    <?php endif; ?>
                    <!-- <div class="list-group-item"><a href="javascript:history.back()">Назад</a></div> -->
                    <div class="list-group-item title_menu_admin">
                        <?php if($_SESSION['role'] == 'user') :?>
                            <h2>РЕКОМЕНДОВАТЬ ЛИДЕРА</h2>
                        <?php else: ?>
                            <h2>ДОБАВЛЕНИЕ НОВОГО ЛИДЕРА</h2>
                        <?php endif;?>
                    </div>
                    <div class="list-group-item">
                        <?php if($_SESSION['role'] == 'user') :?>
                            <input style="display: none;" id="user_id" value="<?= $_SESSION['id'] ?>">
                        <?php endif; ?>
                        <input style="display: none;" id="id_lid" value="<?= $data['user'][0]['id_lid'] ?>">
                        <div class="form-group liders_photo_box">
                            <div class="col-lg-3">
                                <div id="preview">
                                    <img class="liders_photo" src="/assets/images/img_not_found.png" alt="">
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
                                    <input type="text" maxlength="150" name="familya" class="form-control" id="familya" placeholder="">
                                    <p id='familya_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="name" class="control-label">Имя:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" maxlength="150" name="name" class="form-control" id="name" placeholder="">
                                    <p id='name_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="otchestvo" class="control-label">Отчество:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" maxlength="150" name="otchestvo" class="form-control" id="otchestvo" placeholder="">
                                    <p id='otchestvo_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="city" class="control-label">Основное место жительства (город):</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" maxlength="50" name="city" class="form-control" id="city" placeholder="">
                                    <p id='city_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="region" class="control-label">Регион:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" maxlength="100" name="region" class="form-control" id="region" placeholder="">
                                    <p id='region_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="region" class="control-label">Пол:</label>
                                </div>
                                <div class="col-lg-7">
                                    <select id="male_female" name="male_female" class="selectpicker form-control">
                                        <option value="">Не выбрано</option>
                                        <option value="м">Мужской</option>
                                        <option value="ж">Женский</option>
                                    </select>
                                    <p id='region_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="birthday" class="control-label">Дата рождения:</label>
                                </div>
                                <div class="col-lg-7">
                                    <div class="input-group date form_date" data-date-format="dd.mm.yyyy" data-link-format="yyyy.mm.dd">
                                        <input id="birthday" name="birthday" class="form-control" type="text" value="" readonly>
                                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    </div>
                                    <p id='birthdayl_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="telephone" class="control-label">Телефон:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" maxlength="200" name="telephone" class="form-control" id="telephone" placeholder="">
                                    <p id='telephone_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="email" class="control-label">Email:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="email" required maxlength="200" name="email" class="form-control" id="email" placeholder="">
                                    <p id='email_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="social" class="control-label">Страница в соц.сетях:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" maxlength="200" name="social" class="form-control" id="social" placeholder="">
                                    <p id='social_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="contact_info" class="control-label">Дополнительная контактная информация:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="contact_info" maxlength="400" class="form-control" id="contact_info" placeholder="">
                                    <p id='contact_info_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="i_can" class="control-label">Чем лидер может поделиться:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="i_can" maxlength="400" class="form-control" id="i_can" placeholder="">
                                    <p id='i_can_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="i_need" class="control-label">Что этому лидеру интересно:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="i_need" maxlength="400" class="form-control" id="i_need" placeholder="">
                                    <p id='i_need_lid' class='error'></p>
                                </div>
                                <div class="col-lg-5">
                                    <label for="contact_info" class="control-label">Причина рекомендации:</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" name="reason" class="form-control" id="reason" placeholder="">
                                    <p id='contact_info_lid' class='error'></p>
                                </div>                                
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
                    <div class="list-group-item save_lider">
                        <div class="form-group">
                            <div class="col-xs-offset col-xs-12">
                                <button id="add_lid_btn" type="submit" onclick="AjaxSendAddLider();" class="btn btn-danger">Сохранить</button>
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
                            <h4 class="modal-title">Лидер успешно добавлен!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Хотите рекомендовать еще одного лидера?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="/lider/add" class="btn btn-default">Да</a>
                            <a href="/user/settings" class="btn btn-default">Нет</a>
                        </div>
                    </div>
                </div>
            </div>

<?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>







<?php else: header('Location: /');
endif; ?>
