<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-30 11:39:37
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_stat_07.tpl" */ ?>
<?php /*%%SmartyHeaderCode:247725a1fc3c97a9190-83313645%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cec708a61a3167606106e655782a9c62f4bb1a9b' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_stat_07.tpl',
      1 => 1504038412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '247725a1fc3c97a9190-83313645',
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
  'unifunc' => 'content_5a1fc3c98a7be4_28332630',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fc3c98a7be4_28332630')) {function content_5a1fc3c98a7be4_28332630($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="bread_crumbs"><p>Статистика по сферам деятельности</p></div>

<form id="form_stat_07" action="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=stat_07" method="get">
<input type="hidden" name="module_name" value="stat_07" />
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
<th rowspan="2"><strong>Сфера деятельности</strong></th>
<th colspan="4"><strong>Лидеры ЛИСС</strong></th>
<th rowspan="2"><strong>Проекты ЛИСС</strong></th>
</tr>
<tr>
<th><strong>Интервью пройдено + интервью на сегодня</strong></th>
<th><strong>Интервью ожидается</strong></th>
<th><strong>Интервью не назначено</strong></th>
<th><strong>Всего</strong></th>
</tr>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aContentList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['project_option_5'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_1'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_2'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_3'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count_4'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['projects_count_1'];?>
</td>
</tr>
<?php } ?>
</table>
<?php } else { ?>
<p>Нет данных.</p>
<?php }?><?php }} ?>
