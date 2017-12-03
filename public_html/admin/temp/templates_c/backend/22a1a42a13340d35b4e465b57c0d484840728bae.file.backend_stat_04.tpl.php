<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-30 11:39:28
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_stat_04.tpl" */ ?>
<?php /*%%SmartyHeaderCode:228975a1fc3c0900731-45434445%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22a1a42a13340d35b4e465b57c0d484840728bae' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_stat_04.tpl',
      1 => 1504823550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '228975a1fc3c0900731-45434445',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aSearch' => 0,
    'aContentList' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1fc3c09b1257_76348660',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fc3c09b1257_76348660')) {function content_5a1fc3c09b1257_76348660($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="bread_crumbs"><p>Статистика по датам создания</p></div>

<form id="form_stat_04" action="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=stat_04" method="get">
<input type="hidden" name="module_name" value="stat_04" />
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

<?php if (isset($_smarty_tpl->tpl_vars['aContentList']->value)) {?>
<table class="base_table">
<tr>
<th rowspan="2" style="width: 20%;"><strong>Период создания</strong></th>
<th colspan="6"><strong>Лидеры ЛИСС</strong></th>
<th colspan="2"><strong>Проекты ЛИСС</strong></th>
<th colspan="2"><strong>Рекомендации</strong></th>
</tr>
<tr>
<th><strong>Интервью пройдено + интервью на сегодня</strong></th>
<th><strong>Интервью ожидается</strong></th>
<th><strong>Интервью не назначено</strong></th>
<th><strong>Анкет заполено</strong></th>
<th><strong>Всего</strong></th>
<th><strong>Рекомендации 2+</strong></th>
<th><strong>Анкет заполено</strong></th>
<th><strong>Всего</strong></th>
<th><strong>Лидер создан</strong></th>
<th><strong>Всего</strong></th>
</tr>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aContentList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<?php if ($_smarty_tpl->tpl_vars['item']->value['period_name_show']=="Всего") {?>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['period_name_show'];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_1'];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_2'];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_3'];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_4'];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_5'];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_6'];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['projects_count_1'];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['projects_count_2'];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendations_count_1'];?>
</strong></td>
<td><strong><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendations_count_2'];?>
</strong></td>
<?php } else { ?>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['period_name_show'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_1'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_2'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_3'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_4'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_5'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_6'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['projects_count_1'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['projects_count_2'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendations_count_1'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendations_count_2'];?>
</td>
<?php }?>
</tr>
<?php } ?>
</table>
<?php } else { ?>
<p>Нет данных.</p>
<?php }?><?php }} ?>
