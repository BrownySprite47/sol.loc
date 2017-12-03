<?php

require_once 'lib/SocialAuther/autoload.php';
require_once 'config.inc.php';

$adapterConfigs = array(
    'vk' => array(
        'client_id'     => '6233715',
        'client_secret' => 'u40cRAHjI9eOTY6cKxtw',
        'redirect_uri'  => 'http://suppor1k.beget.tech/auth/?provider=vk'
    ),
    'odnoklassniki' => array(
        'client_id'     => '1258439680',
        'client_secret' => 'CE103DF846BACA78A54811C1',
        'redirect_uri'  => 'http://suppor1k.beget.tech/auth?provider=odnoklassniki',
        'public_key'    => 'CBAFEDAMEBABABABA'
    ),
    'mailru' => array(
        'client_id'     => '757179',
        'client_secret' => '561b3eeebf994db5c9053c50a0dc6e87',
        'redirect_uri'  => 'http://suppor1k.beget.tech/auth/?provider=mailru'
    ),
    'yandex' => array(
        'client_id'     => '3272d2f091804fbabb89c007cd0f412b',
        'client_secret' => '6ae003cf124c438889ff93fc404226c3',
        'redirect_uri'  => 'http://suppor1k.beget.tech/auth/?provider=yandex'
    ),
    'google' => array(
        'client_id'     => '529306401514-h62351b4kai0m3vsdumsmcq1cc4056j9.apps.googleusercontent.com',
        'client_secret' => 'sCSXPqY0ye3PHLIGsSsAVuHG',
        'redirect_uri'  => 'http://suppor1k.beget.tech/auth?provider=google'
    ),
    'facebook' => array(
        'client_id'     => '291924507965005',
        'client_secret' => 'd35c45551b6c96ffe07570175b720fd0',
        'redirect_uri'  => 'http://suppor1k.beget.tech/auth/?provider=facebook'
    )
);

$adapters = array();
foreach ($adapterConfigs as $adapter => $settings) {
    $class = 'SocialAuther\Adapter\\' . ucfirst($adapter);
    $adapters[$adapter] = new $class($settings);
}

if (isset($_GET['provider']) && array_key_exists($_GET['provider'], $adapters) && !isset($_SESSION['login'])) {
    $auther = new SocialAuther\SocialAuther($adapters[$_GET['provider']]);

    if ($auther->authenticate()) {
        $qu = "SELECT *  FROM users WHERE {$auther->getProvider()} = '{$auther->getSocialId()}' LIMIT 1";
        $result = mysql_query($qu);
        $record = mysql_fetch_array($result); 
        if (!$record) {
            $values = array(
                $auther->getProvider(),
                $auther->getSocialId(),
                $auther->getName(),
                $auther->getEmail(),
                $auther->getSocialPage(),
                $auther->getSex(),
                date('Y-m-d', strtotime($auther->getBirthday())),
                $auther->getAvatar()
            );

            // $query = "INSERT INTO `users` (`{provider}`, `social_id`, `name`, `email`, `social_page`, `sex`, `birthday`, `avatar`) VALUES ('";
            $query = "INSERT INTO users ({$auther->getProvider()}, avatar, name) VALUES ('{$auther->getSocialId()}', '{$auther->getAvatar()}', '{$auther->getName()}')";

            // $query .= implode("', '", $values) . "')";
            $result = mysql_query($query);
                        //echo "$query";

            $result1 = mysql_query("SELECT *  FROM users WHERE {$auther->getProvider()} = '{$auther->getSocialId()}' LIMIT 1");
            $record1 = mysql_fetch_array($result1); 


            $query2 = "INSERT INTO liders (user_id) VALUES ('".$record1['id']."')";

            //echo "$query2";
            $result2 = mysql_query($query2);
            //var_dump($record1);
            //$_SESSION['user'] = $user;
            $_SESSION['id'] = $record1['id'];
            $_SESSION['role'] = $record1['role'];
            $_SESSION['test'] = $query2;

        } else {
            $userFromDb = new stdClass();
            $userFromDb->provider   = $record['provider'];
            $userFromDb->socialId   = $record['social_id'];
            $userFromDb->name       = $record['name'];
            $userFromDb->email      = $record['email'];
            $userFromDb->socialPage = $record['social_page'];
            $userFromDb->sex        = $record['sex'];
            $userFromDb->birthday   = date('m.d.Y', strtotime($record['birthday']));
            $userFromDb->avatar     = $record['avatar'];

            //$_SESSION['user'] = $user;
            $_SESSION['id'] = $record['id'];
            $_SESSION['role'] = $record['role'];
        }

        $user = new stdClass();
        $user->provider   = $auther->getProvider();
        $user->socialId   = $auther->getSocialId();
        $user->name       = $auther->getName();
        $user->email      = $auther->getEmail();
        $user->socialPage = $auther->getSocialPage();
        $user->sex        = $auther->getSex();
        $user->birthday   = $auther->getBirthday();
        $user->avatar     = $auther->getAvatar();

        $_SESSION['login'] = $user->name;
        $_SESSION['avatar'] = $user->avatar; 
        //var_dump($record);
        // if (isset($userFromDb) && $userFromDb != $user) {
        //     $idToUpdate = $record['id'];
        //     $birthday = date('Y-m-d', strtotime($user->birthday));

        //     mysql_query("UPDATE users SET {$auther->getProvider} = '{$auther->getSocialId()}' WHERE id = '{$_SESSION['id']}'");
        // }  
        if ($_SESSION['role'] == 'user') {
            header("location: /user/settings"); 
        }else{
            header("location: /");
        }
           
    }
    
    // $provider['$auther->getProvider()'] = $auther->getSocialId();
    

}

if (isset($_GET['provider']) && array_key_exists($_GET['provider'], $adapters) && isset($_SESSION['login'])) {
    $auther1 = new SocialAuther\SocialAuther($adapters[$_GET['provider']]);

    if ($auther1->authenticate()) {
        $query = "UPDATE users SET {$auther1->getProvider()} = '{$auther1->getSocialId()}' WHERE id = '{$_SESSION['id']}'";
        $result = mysql_query($query);
    }
    if ($_SESSION['role'] == 'user') {
        header("location: /user/settings"); 
    }else{
        header("location: /");
    }

                  
} 

// if ($_SESSION['role'] = 'user') {
//             header("location: /user/settings"); 
//     }else{
//         header("location: /");
//     }

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
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
            <h3 class="success_reg">Вход</h3>
            <div class="panel panel-login">
                <div class="panel-body" style="text-align: center; padding: 80px;">

                    <?php if (isset($_SESSION['user'])): ?>
                        <?php header("location: /"); ?>
                    <?php elseif (!isset($_GET['code']) && !isset($_SESSION['user'])): ?>
                        <?php foreach ($adapters as $title => $adapter): ?>
                            <a href="<?=$adapter->getAuthUrl()?>" style="padding: 20px; display: inline-block; width: 32px; height: 32px; background: rgba(0, 0, 0, 0) url('/assets/images/<?=ucfirst($title)?>.png') no-repeat;"></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
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