<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <script src="/assets/bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/css/registration.css">
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
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <!-- <img src="images/xsbs_logo.png" alt="Как учат"> -->
                <p>Как учат</p>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/">Назад</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3 class="success_reg">Регистрация</h3>
            <div class="panel panel-login">
                <div class="panel-body">
                    <form method="POST">
                        <?php if (isset($data['messages']['unique'])): ?>
                            <p class="error_message"><?= $data['messages']['unique'] ?></p>
                        <?php endif; ?>
                        <div class="form-group">
                            <input type="text" autofocus name="login"
                                   class="form-control <?= (isset($data['errors']['login'])) ? 'error' : '' ?>"
                                   placeholder="Логин"
                                   value="<?= (isset($_POST['login'])) ? $_POST['login'] : '' ?>">
                        </div>
                        <?php if (isset($data['errors']['login'])):?>
                            <?php foreach($data['errors']['login'] as $key => $value):?>
                                <?php if (isset($data['messages'][$value])): ?>
                                    <p class="error_message"><?= $data['messages'][$value] ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="form-group">
                            <input type="email" name="email"
                                   class="form-control <?= (isset($data['errors']['email'])) ? 'error' : '' ?>"
                                   placeholder="Email"
                                   value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>">
                        </div>
                        <?php if (isset($data['errors']['email'])):?>
                            <?php foreach($data['errors']['email'] as $key => $value):?>
                                <?php if (isset($data['messages'][$value])): ?>
                                    <p class="error_message"><?= $data['messages'][$value] ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="form-group">
                            <input type="password" name="password"
                                   class="form-control <?= (isset($data['errors']['password'])) ? 'error' : '' ?>"
                                   placeholder="Пароль"
                                   value="<?= (isset($_POST['password'])) ? $_POST['password'] : '' ?>">
                        </div>
                        <?php if (isset($data['errors']['password'])):?>
                            <?php foreach($data['errors']['password'] as $key => $value):?>
                                <?php if (isset($data['messages'][$value])): ?>
                                    <p class="error_message"><?= $data['messages'][$value] ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="form-group">
                            <input type="password" name="password2"
                                   class="form-control <?= (isset($data['errors']['password2'])) ? 'error' : '' ?>"
                                   placeholder="Повторите пароль"
                                   value="<?= (isset($_POST['password2'])) ? $_POST['password2'] : '' ?>">
                        </div>
                        <?php if (isset($data['errors']['password2'])):?>
                            <?php foreach($data['errors']['password2'] as $key => $value):?>
                                <?php if (isset($data['messages'][$value])): ?>
                                    <p class="error_message"><?= $data['messages'][$value] ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (isset($data['errors']['password2']['equal'])):?>
                            <p class="error_message"><?= $data['errors']['password2']['equal'] ?></p>
                        <?php endif; ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="form-control btn btn-register">Зарегистрироваться</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(ANALYTICS): ?>
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter45694533 = new Ya.Metrika({
                        id:45694533,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/45694533" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<?php endif; ?>
</body>
</html>
