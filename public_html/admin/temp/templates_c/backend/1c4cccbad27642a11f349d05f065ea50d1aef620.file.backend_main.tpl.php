<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-12-03 01:37:12
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:293155a1fbf7c023a86-99046017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c4cccbad27642a11f349d05f065ea50d1aef620' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_main.tpl',
      1 => 1512037604,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '293155a1fbf7c023a86-99046017',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1fbf7c0c7904_44478137',
  'variables' => 
  array (
    'aPageData' => 0,
    'item' => 0,
    'aMenu' => 0,
    'i' => 0,
    'sInnerPage' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fbf7c0c7904_44478137')) {function content_5a1fbf7c0c7904_44478137($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("config.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?><!DOCTYPE html>
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
    
    <?php if (isset($_smarty_tpl->tpl_vars['aPageData']->value['java_scripts'])) {
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aPageData']->value['java_scripts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"><?php echo '</script'; ?>
><?php }
}?>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
js/fixed_menu.js"><?php echo '</script'; ?>
>
    <style type="text/css">
        #header-fixed, #header-fixed-fio {
            position: fixed;
            display: none;
            z-index: 9000;
        }
    </style>
</head>
<body>
    <!-- site -->
    <div class="site">
        <div class="site__layout">

            <table class="site__content">

                <tr>
                    <td>

                        <!-- left_aside -->
                        <aside class="left_aside active">
                            <div class="aside_content">
                            <div class="menu_btn active"></div>

<?php if (isset($_smarty_tpl->tpl_vars['aMenu']->value)) {?>
<ul class="sub_menu">
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aMenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<?php if (isset($_smarty_tpl->tpl_vars['item']->value['items'])) {?>
<li>
<a class="dropdown<?php if (isset($_smarty_tpl->tpl_vars['item']->value['active'])) {?> active open<?php }?>" href="#"><?php echo $_smarty_tpl->tpl_vars['item']->value['menu_name'];?>
</a>
<ul>
<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
<li><a <?php if (isset($_smarty_tpl->tpl_vars['i']->value['active'])) {?>class="current" <?php }?>href="<?php echo $_smarty_tpl->tpl_vars['i']->value['menu_url'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['menu_name'];?>
</a></li>
<?php } ?>
</ul>
</li>
<?php } else { ?>
<li><a <?php if (isset($_smarty_tpl->tpl_vars['item']->value['active'])) {?>class="current" <?php }?>href="<?php echo $_smarty_tpl->tpl_vars['item']->value['menu_url'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['menu_name'];?>
</a></li>
<?php }?>
<?php } ?>
</ul>
<?php }?>
                            </div>
                        </aside>
                        <!-- /left_aside -->

                    </td>
                    <td style="border-left: 1px solid #e5e5e5; width: 100%;">
                        <div class="content">

                          <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['sInnerPage']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['sInnerPage']->value=="backend_leaders_view"||$_smarty_tpl->tpl_vars['sInnerPage']->value=="backend_projects_view") {?><div id="search_block"></div><?php }?>
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <!-- /site -->
<?php echo '<script'; ?>
 type="text/javascript">fixTable();<?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
