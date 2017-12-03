<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-12-01 16:59:09
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_constants_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150505a21602d8b8328-09757957%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cef95c948b67da3b67ebb681319832a0c864a9fe' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_constants_list.tpl',
      1 => 1502360276,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150505a21602d8b8328-09757957',
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
  'unifunc' => 'content_5a21602e641fc3_35750630',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a21602e641fc3_35750630')) {function content_5a21602e641fc3_35750630($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="bread_crumbs"><p>Настройки / список групп настроек</p></div>

<?php if (isset($_smarty_tpl->tpl_vars['aContentList']->value)) {?>
<table class="base_table">
<tr>
<th><strong>Группа настроек</strong></th>
<th><strong>Количество настроек</strong></th>
<th class="small"></th>
</tr>

<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aContentList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['constant_type_name'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['constants_count'];?>
</td>
<td class="small"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=constants&action_name=view&constant_type_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['constant_type_id'];?>
"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/edit.png" alt="Редактировать" /></a></td>
</tr>
<?php } ?>

</table>
<?php } else { ?>
<p>Настроек нет.</p>
<?php }?><?php }} ?>
