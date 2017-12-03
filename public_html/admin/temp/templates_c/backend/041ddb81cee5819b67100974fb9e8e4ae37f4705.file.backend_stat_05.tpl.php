<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-30 11:39:31
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_stat_05.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131425a1fc3c32c84e1-37666374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '041ddb81cee5819b67100974fb9e8e4ae37f4705' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_stat_05.tpl',
      1 => 1504825702,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131425a1fc3c32c84e1-37666374',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aSearch' => 0,
    'aContentData' => 0,
    'aBackendUsers' => 0,
    'item' => 0,
    'key' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1fc3c339d235_19453662',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fc3c339d235_19453662')) {function content_5a1fc3c339d235_19453662($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="bread_crumbs"><p>Статистика по интервьюерам</p></div>

<form id="form_stat_05" action="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=stat_05" method="get">
<input type="hidden" name="module_name" value="stat_05" />
<div class="options_add open" for="search">Параметры</div>
<table class="form_table search">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Период</td>
<td>с <input type="text" name="date_from" value="<?php echo $_smarty_tpl->tpl_vars['aSearch']->value['date_from'];?>
" class="small" id="date_from" /> по <input type="text" name="date_to" value="<?php echo $_smarty_tpl->tpl_vars['aSearch']->value['date_to'];?>
" class="small" id="date_to" /></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Группировка</td>
<td>
<select name="stat_type_id">
<option value="1"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['stat_type_id']==1) {?> selected="selected"<?php }?>>по дням</option>
<option value="2"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['stat_type_id']==2) {?> selected="selected"<?php }?>>по неделям</option>
<option value="3"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['stat_type_id']==3) {?> selected="selected"<?php }?>>по месяцам</option>
<option value="4"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['stat_type_id']==4) {?> selected="selected"<?php }?>>по годам</option>
<option value="5"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['stat_type_id']==5) {?> selected="selected"<?php }?>>за весь период</option>
</select>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Выгрузить в Excel</td>
<td><input type="checkbox" name="excel_enabled" value="1" /></td>
</tr>
</tbody>
</table>

<table class="wrap_sub search">
<tr>
<td></td>
<td><input type="submit" value="Отобразить статистику"/></td>
</tr>
</table>

</form>

<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {?>
<table class="base_table">
<tr>
<th style="width: 20%;"><strong>Период интервью</strong></th>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aBackendUsers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><th colspan="2"><strong><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</strong></th><?php } ?>
</tr>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['aContentData']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<?php if ($_smarty_tpl->tpl_vars['key']->value=="all"||$_smarty_tpl->tpl_vars['key']->value=="all_0") {?>
<td><strong>Всего<?php if ($_smarty_tpl->tpl_vars['key']->value=="all_0") {?> назначено<?php }?></strong></td>
<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['aBackendUsers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
<?php if (isset($_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['k']->value])) {?>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['k']->value]["leaders_done_count"];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['k']->value]["leaders_count"];?>
</strong></td>
<?php } else { ?>
<td><strong>0</strong></td>
<td><strong>0</strong></td>
<?php }?>
<?php } ?>
<?php } else { ?>
<td><?php if ($_smarty_tpl->tpl_vars['key']->value=="-") {?>интервью не назначено<?php } else {
if ($_smarty_tpl->tpl_vars['key']->value=="--") {?>-<?php } else {
echo $_smarty_tpl->tpl_vars['key']->value;
}
}?></td>
<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['aBackendUsers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
<?php if ($_smarty_tpl->tpl_vars['k']->value=="all") {?>
<?php if (isset($_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['k']->value])) {?>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['k']->value]["leaders_done_count"];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['k']->value]["leaders_count"];?>
</strong></td>
<?php } else { ?>
<td><strong>0</strong></td>
<td><strong>0</strong></td>
<?php }?>
<?php } else { ?>
<?php if (isset($_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['k']->value])) {?>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['k']->value]["leaders_done_count"];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['k']->value]["leaders_count"];?>
</td>
<?php } else { ?>
<td>0</td>
<td>0</td>
<?php }?>
<?php }?>
<?php } ?>
<?php }?>
</tr>
<?php } ?>
</table>
<?php } else { ?>
<p>Нет данных.</p>
<?php }?><?php }} ?>
