<?php require SITE_DIR . '/core/library/session.php'; ?>

<?php if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin'): ?>

    <?php 
    $title = 'Рекомендованные лидеры';
    $page_projects = 'active';
    $page_liders = '';  
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>
    <div class="container">
        <div class="list-group">
                <div class="form-horizontal">
                    <!-- <div class="list-group-item"><a href="javascript:history.back()">Назад</a></div> -->
                    <div class="list-group-item title_menu_admin">
                        <h2>РЕКОМЕНДОВАННЫЕ ЛИДЕРЫ</h2>
                    </div>
                    <?php if(!empty($data['recommend'])): ?>
                        <?php foreach ($data['recommend'] as $key => $value): ?>
                            <div class="list-group-item">
                                <div class="form-group liders_photo_box rel_box">
                                    <div class="col-lg-3">
                                        <div id="preview">
                                            <?php if (!empty($value['image_name'])): ?>
                                                <img class="liders_photo" src="/uploads/images/<?= $value['image_name'] ?>" alt="">
                                            <?php else: ?>
                                                <img class="liders_photo" src="/assets/images/img_not_found.png" alt="">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <p><span class="title">ФИО:</span> <a target="_blank" href="/lider?id=<?= $value['id_lid'] ?>"><?= $value['fio'] ?></a></p>
                                        <?php if (!empty($value['telephone'])): ?>
                                            <p><span class="title">ТЕЛЕФОН:</span> <?= $value['telephone'] ?></p>
                                        <?php else: ?>
                                            <p><span class="title">ТЕЛЕФОН:</span> Не указано</p>
                                        <?php endif; ?>
                                        <?php if (!empty($value['email'])): ?>
                                            <p><span class="title">EMAIL:</span> <?= $value['email'] ?></p>
                                        <?php else: ?>
                                            <p><span class="title">EMAIL:</span> Не указано</p>
                                        <?php endif; ?>
                                        <?php if (!empty($value['reason'])): ?>
                                            <p><span class="title">ПРИЧИНА РЕКОМЕНДАЦИИ:</span> <?= $value['reason'] ?></p>
                                        <?php else: ?>
                                            <p><span class="title">ПРИЧИНА РЕКОМЕНДАЦИИ:</span> Не указано</p>
                                        <?php endif; ?> 
                                    </div>
                                    <?php if ($value['checked'] == '0'): ?>
                                        <div class="rel_box_btn_status">
                                            <a href="javascript:void(0);" class="btn btn-warning">Рекомендация проверяется</a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($value['checked'] == '1'): ?>
                                        <div class="rel_box_btn_status">
                                            <a href="javascript:void(0);" class="btn btn-success">Рекомендация принята</a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($value['checked'] == '2'): ?>
                                        <div class="rel_box_btn_status">
                                            <a href="javascript:void(0);" class="btn btn-danger">Рекомендация отклонена</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <div class="list-group-item col-lg-12">
                                <div class="row">  
                                    <div class="col-lg-6">                  
                                        <p>Вы не рекомендовали лидеров.</p> 
                                    </div>                 
                                </div>
                            </div>
                        <?php endif; ?>
                </div>
            </div>
        </div>
<?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>
            
    <?php else: header('Location: /'); ?>
    <?php endif; ?>

