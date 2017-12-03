<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-30 11:41:14
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_backend_users_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70855a1fc42a90b036-35616754%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ecdbc6aa001acc3cae0120da0fdf1a818314441' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_backend_users_list.tpl',
      1 => 1502406062,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70855a1fc42a90b036-35616754',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aContentList' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1fc42a99c3f5_51874700',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fc42a99c3f5_51874700')) {function content_5a1fc42a99c3f5_51874700($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="sub_links">
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=backend_users&action_name=view">создать пользователя</a>
</div>

<div class="bread_crumbs"><p>Пользователи / список пользователей</p></div>

<?php if (isset($_smarty_tpl->tpl_vars['aContentList']->value)) {?>
<table class="base_table">
<tr>
<th><strong>ФИО</strong></th>
<th><strong>Права</strong></th>
<th><strong>Доступ</strong></th>
<th colspan="2" class="small"></th>
</tr>

<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aContentList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_name'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['backend_access_types'];?>
</td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['backend_user_enabled']==1) {?>+<?php } else { ?>-<?php }?></td>
<td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=backend_users&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_id'];?>
"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/edit.png" alt="Редактировать" /></a></td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['backend_user_delete_enabled']) {?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=backend_users&action_name=delete&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_id'];?>
" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/delete.png" alt="Удалить" /></a><?php }?></td>
</tr>
<?php } ?>

</table>
<?php } else { ?>
<p>Пока пользователей не создано.</p>
<?php }?><?php }} ?>
