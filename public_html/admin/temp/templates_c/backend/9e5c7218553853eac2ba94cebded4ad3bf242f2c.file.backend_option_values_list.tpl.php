<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-30 11:37:32
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_option_values_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110325a1fc34cafe066-25580918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e5c7218553853eac2ba94cebded4ad3bf242f2c' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_option_values_list.tpl',
      1 => 1505247324,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110325a1fc34cafe066-25580918',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aOptions' => 0,
    'item' => 0,
    'aOptionValues' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1fc34cbf91e1_51243503',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fc34cbf91e1_51243503')) {function content_5a1fc34cbf91e1_51243503($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="sub_links">
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=option_values&action_name=view">создать вариант ответа</a>
</div>

<div class="bread_crumbs"><p>Справочники / варианты ответов</p></div>

<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value)) {?>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<div class="options_add open" for="option_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_name'];?>
 (тип: <?php echo $_smarty_tpl->tpl_vars['item']->value['option_type_name'];?>
, мультивыбор: <?php if ($_smarty_tpl->tpl_vars['item']->value['option_multi_enabled']==1) {?>+<?php } else { ?>-<?php }?>)</div>
<?php if (isset($_smarty_tpl->tpl_vars['aOptionValues']->value[$_smarty_tpl->tpl_vars['item']->value['option_id']])) {?>
<table class="base_table option_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_id'];?>
">
<tr>
<th colspan="2"><strong>Вариант ответа</strong></th>
<th style="width: 20%;"><strong>Количество лидеров ЛИСС</strong></th>
<th style="width: 20%;"><strong>Количество проектов ЛИСС</strong></th>
<th colspan="2" class="small"></th>
</tr>
<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptionValues']->value[$_smarty_tpl->tpl_vars['item']->value['option_id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><?php echo $_smarty_tpl->tpl_vars['i']->value['option_value'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['i']->value['option_value_small'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['i']->value['leaders_count'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['i']->value['projects_count'];?>
</td>
<td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=option_values&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['i']->value['option_value_id'];?>
"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/edit.png" alt="Редактировать" /></a></td>
<td><?php if ($_smarty_tpl->tpl_vars['i']->value['leaders_count']==0&&$_smarty_tpl->tpl_vars['i']->value['projects_count']==0) {?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=option_values&action_name=delete&content_id=<?php echo $_smarty_tpl->tpl_vars['i']->value['option_value_id'];?>
" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/delete.png" alt="Удалить" /></a><?php }?></td>
</tr>
<?php } ?>
</table>
<?php }?>
<?php } ?>
<?php } else { ?>
<p>Пока справочник пуст.</p>
<?php }?><?php }} ?>
