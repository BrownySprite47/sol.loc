<?php// view($data); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-select.css">

    <link rel="stylesheet" href="/assets/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/font-awesome-4.7.0/fonts/FontAwesome.otf">
    <link rel="stylesheet" href="/assets/css/styleAddProj.css">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="/assets/bootstrap/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/ajax/ajax.js"></script>
    <link rel="stylesheet" href="/assets/css/style.css">

    <link href="/assets/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <?php if(ANALYTICS): ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-105077093-1', 'auto');
            ga('send', 'pageview');
        </script>
    <?php endif; ?>
    <style type="text/css">
        #admin_menu_list li .fa {
            width: 20px;
        }
        #admin_menu_list li { position: relative; }
        #admin_menu_list p { 
            position: absolute;
            right: -39px;
            top: 3px; 
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><p>Как учат</p></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?= $page_projects ?>"><a href="/">Проекты<span class="sr-only">(current)</span></a></li>
        <li class="<?= $page_liders ?>"><a href="/filter">Лидеры</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(isset($_SESSION['login'])): ?>
        <li class="dropdown">            
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Привет, <?= $_SESSION['login'] ?> <span class="caret"></span></a>
        <ul class="dropdown-menu" id="admin_menu_list" style="padding: 3px 55px 3px 17px;">
            <?php if ($admin): ?>
                <li><a href="javascript:void(0);"><i class="fa fa-address-book" aria-hidden="true"></i> Админпанель</a></li>
                <li role="separator" class="divider"></li>
                <li>
                    <a href="/admin"><i class="fa fa-bandcamp" aria-hidden="true"></i> Новые проекты</a>
                    <?php if (!empty($data['getProjectsAdmin_add'])) : ?>
                        <p class='info_menu'><?= count($data['getProjectsAdmin_add']) ?></p>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="/admin/new_liders"><i class="fa fa-window-restore" aria-hidden="true"></i> Новые лидеры</a>
                    <?php if (!empty($data['getLidersAdmin_add'])) : ?>
                        <p class='info_menu'><?= count($data['getLidersAdmin_add']) ?></p>
                    <?php endif; ?>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                    <a href="/admin/recommend_liders"><i class="fa fa-envelope-open" aria-hidden="true"></i> Рекомендации</a>
                    <?php if (!empty($data['recommendLider'])) : ?>
                        <p class='info_menu'><?= count($data['recommendLider']) ?></p>
                    <?php endif; ?>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                    <a href="/admin/edit_projects"><i class="fa fa-binoculars" aria-hidden="true"></i> Отредактированные проекты</a>
                    <?php if (!empty($data['getProjectsAdmin_edit'])) : ?>
                        <p class='info_menu'><?= count($data['getProjectsAdmin_edit']) ?></p>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="/admin/edit_liders"><i class="fa fa-bookmark" aria-hidden="true"></i> Отредактированные лидеры</a>
                    <?php if (!empty($data['getLidersAdmin_edit'])) : ?>
                        <p class='info_menu'><?= count($data['getLidersAdmin_edit']) ?></p>
                    <?php endif; ?>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                    <a href="/admin/deleted_projects"><i class="fa fa-bullseye" aria-hidden="true"></i> Отклоненные проекты</a>
                    <!-- <?php if (!empty($data['getProjectsAdmin_del'])) : ?>
                        <p class='info_menu'><?= count($data['getProjectsAdmin_del']) ?></p>
                    <?php endif; ?> -->
                </li>
                <li>
                    <a href="/admin/deleted_liders"><i class="fa fa-calendar" aria-hidden="true"></i> Отклоненные лидеры</a>
                    <!-- <?php if (!empty($data['getLidersAdmin_del'])) : ?>
                        <p class='info_menu'><?= count($data['getLidersAdmin_del']) ?></p>
                    <?php endif; ?> -->
                </li>
                <li role="separator" class="divider"></li>
                <li><a target="_blank" href="/lider/add"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Добавить лидера</a></li>
                <li><a target="_blank" href="/project/add"><i class="fa fa-car" aria-hidden="true"></i> Добавить проект</a></li>
                <li role="separator" class="divider"></li>
                <li>
                    <a href="/admin/added_liders"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i> Добавленные лидеры</a>
                    <!-- <?php if (!empty($data['added_liders'])) : ?>
                        <p class='info_menu'><?= count($data['added_liders']) ?></p>
                    <?php endif; ?> -->
                </li>
                <li>
                    <a href="/admin/added_projects"><i class="fa fa-certificate" aria-hidden="true"></i> Добавленные проекты</a>
                    <!-- <?php if (!empty($data['added_projects'])) : ?>
                        <p class='info_menu'><?= count($data['added_projects']) ?></p>
                    <?php endif; ?> -->
                </li>
                <!-- <li><a data-toggle="tab" href="#panel9">Заблокированные пользователи</a></li> -->
                <!-- <li><a href="/admin/settings" class="btn btn-default active">Настройки</a></li> -->

            <?php else :?>
                <li><img style="margin: 0 20px;" src="<?= $_SESSION['avatar']?>"></li>
                <li role="separator" class="divider"></li>
                <li><a href="/user"><i class="fa fa-bullseye" aria-hidden="true"></i>Интересы</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/lider/add"><i class="fa fa-calendar" aria-hidden="true"></i> Рекомендовать лидера</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Рекомендовать проект</a></li>
                <li><a href="/user/recommend"><i class="fa fa-car" aria-hidden="true"></i> Рекомендованные лидеры</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i> Рекомендованные проекты</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/user/settings"><i class="fa fa-certificate" aria-hidden="true"></i> Настройки</a></li>
                
            <?php endif; ?>
            <li role="separator" class="divider"></li>
            <li><a href="/logout"><i class="fa fa-bullseye" aria-hidden="true"></i> Выйти</a></li>
          </ul>
        </li>
      <?php else: ?>
        <li class="dropdown">
        <a href="/auth" class="dropdown-toggle">Вход</a>
    </li>
    <?php endif; ?>
          
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


