<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-25 13:05:11
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\user\templates\backend_login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:67625a1940570bcb32-14366797%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65c415289e3e9ecc15320b6e739dc27b399227d6' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\user\\templates\\backend_login.tpl',
      1 => 1504465005,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67625a1940570bcb32-14366797',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aPageData' => 0,
    'aContentDataErrors' => 0,
    'aContentData' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a194057128ce5_46877718',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a194057128ce5_46877718')) {function content_5a194057128ce5_46877718($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("config.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?><!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php if (isset($_smarty_tpl->tpl_vars['aPageData']->value['html_title'])) {
echo $_smarty_tpl->tpl_vars['aPageData']->value['html_title'];
}?></title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/favicon.ico" type="image/ico" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
css/main.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
css/jquery-ui.min.css" />

    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
js/jquery-ui.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
js/jquery.main.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
js/forms/form_login.js"><?php echo '</script'; ?>
>

</head>
<body>
    <!-- site -->
    <div class="site">
        <form id="form_login" class="content login_form" action="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=login" method="post">
            <table class="login_table">
                <tbody>
                <tr>
                    <td>Логин</td>
                    <td><input class="medium<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['backend_user_login'])) {?> error<?php }?>" type="text" name="backend_user_login" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['backend_user_login'];
}?>" /><p class="error"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['backend_user_login'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['backend_user_login'];
}?></p></td>
                </tr>
                <tr>
                    <td>Пароль</td>
                    <td><input class="medium text<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['backend_user_password'])) {?> error<?php }?>" type="password" name="backend_user_password" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['backend_user_password'];
}?>" /><p class="error"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['backend_user_password'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['backend_user_password'];
}?></p></td>
                </tr>
                </tbody>
            </table>
            <input type="submit" value="Вход" />
        </form>
    </div>
    <!-- /site -->

</body>
</html><?php }} ?>
