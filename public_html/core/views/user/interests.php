<?php require SITE_DIR . '/core/library/session.php'; ?>

<?php if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin'): ?>

    <?php 
    $title = 'Интересы';
    $page_projects = 'active';
    $page_liders = '';
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>

    <div class="container">
        <div class="list-group">
            <div class="form-horizontal">
                <!-- <div class="list-group-item"><a href="javascript:history.back()">Назад</a></div> -->
                <div class="list-group-item title_menu_admin">
                    <h2>ИНТЕРЕСЫ</h2>
                </div>
                <div class="list-group-item">
                    <p>Скоро появятся на сайте</p>
                </div>
            </div>
        </div>
    </div>
<?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>
        
    <?php else: header('Location: /'); ?>
    <?php endif; ?>

