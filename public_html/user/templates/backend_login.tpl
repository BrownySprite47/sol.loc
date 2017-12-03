{config_load file="config.conf"}<!DOCTYPE html>
<html lang="ru">
<head>
    <title>{if isset($aPageData.html_title)}{$aPageData.html_title}{/if}</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{#PROJECT_BACKEND_URL#}images/favicon.ico" type="image/ico" />
    <link rel="stylesheet" href="{#PROJECT_BACKEND_URL#}css/main.css" />
    <link rel="stylesheet" href="{#PROJECT_BACKEND_URL#}css/jquery-ui.min.css" />

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="{#PROJECT_BACKEND_URL#}js/jquery-ui.min.js"></script>
    <script src="{#PROJECT_BACKEND_URL#}js/jquery.main.js"></script>
    <script src="{#PROJECT_BACKEND_URL#}js/forms/form_login.js"></script>

</head>
<body>
    <!-- site -->
    <div class="site">
        <form id="form_login" class="content login_form" action="{#PROJECT_BACKEND_URL#}index.php?module_name=login" method="post">
            <table class="login_table">
                <tbody>
                <tr>
                    <td>Логин</td>
                    <td><input class="medium{if isset($aContentDataErrors.backend_user_login)} error{/if}" type="text" name="backend_user_login" value="{if isset($aContentData)}{$aContentData.backend_user_login}{/if}" /><p class="error">{if isset($aContentDataErrors.backend_user_login)}{$aContentDataErrors.backend_user_login}{/if}</p></td>
                </tr>
                <tr>
                    <td>Пароль</td>
                    <td><input class="medium text{if isset($aContentDataErrors.backend_user_password)} error{/if}" type="password" name="backend_user_password" value="{if isset($aContentData)}{$aContentData.backend_user_password}{/if}" /><p class="error">{if isset($aContentDataErrors.backend_user_password)}{$aContentDataErrors.backend_user_password}{/if}</p></td>
                </tr>
                </tbody>
            </table>
            <input type="submit" value="Вход" />
        </form>
    </div>
    <!-- /site -->

</body>
</html>