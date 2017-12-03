<?php require SITE_DIR . '/core/library/session.php'; ?>
<?php 
    $title = 'Проекты';
    $page_projects = 'active';
    $page_liders = '';
    include SITE_DIR . '/core/views/layouts/header.php'; 
    ?>
<div id="content-main">

    <?php require SITE_DIR.'/core/views/layouts/content.php' ?> <!-- Блоки проектов -->

</div>
<!-- <script type="text/javascript">
	$(window).scroll(function(){
    sc = $(window).scrollTop(); //узнаем на сколько проскролили страницу
});
function show(el) {
    var ca = $('#content').html(); //кешируем контент
    var sco = sc; //берем текущее значение скрола
    var location.hash = '?project=';
};
//отлавливаем изменение хеша
$(window).bind('hashchange', function(){
    hash = window.location.hash.replace('', '');
    //если хеш пустой, значит мы на главной странице
    if(hash=='') {
        //грузим контент из кеша
        $('#content').html(ca);
        //очищаем кеш
        ca = '';
        //скролим страницу вниз
        $(window).scrollTop(sco);
    }
});
</script> -->
<?php include SITE_DIR . '/core/views/layouts/footer.php'; ?>
