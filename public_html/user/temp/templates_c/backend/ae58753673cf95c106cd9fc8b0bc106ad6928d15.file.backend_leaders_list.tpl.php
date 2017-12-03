<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-25 13:00:14
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_leaders_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:244945a193f2e31e1d0-03312803%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae58753673cf95c106cd9fc8b0bc106ad6928d15' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_leaders_list.tpl',
      1 => 1511566926,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '244945a193f2e31e1d0-03312803',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aSearch' => 0,
    'aOV4' => 0,
    'item' => 0,
    'aContentList' => 0,
    'key' => 0,
    'iCurrentOrder' => 0,
    'i' => 0,
    'iMaxPage' => 0,
    'iCurrentPage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a193f2e501809_89168019',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a193f2e501809_89168019')) {function content_5a193f2e501809_89168019($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="sub_links">
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view">создать лидера ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Лидеры ЛИСС / список</p></div>

<form action="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list" method="get">
<input type="hidden" name="module_name" value="leaders" />
<input type="hidden" name="action_name" value="list" />
<div class="options_add open" for="search">Поиск</div>
<table class="form_table search">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата создания лидера</td>
<td>с <input type="text" name="date_from" value="<?php echo $_smarty_tpl->tpl_vars['aSearch']->value['date_from'];?>
" class="small" id="date_from" /> по <input type="text" name="date_to" value="<?php echo $_smarty_tpl->tpl_vars['aSearch']->value['date_to'];?>
" class="small" id="date_to" /></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Поиск <div class="info"><span>Поиск по id лидера ЛИСС, ФИО, телефону, e-mail, городу, id проекта ЛИСС, наименованию проекта ЛИСС. Поиск по вхождению фразы. Фраза не менее трех символов.</span></div></td>
<td><input type="text" name="search_text" value="<?php echo $_smarty_tpl->tpl_vars['aSearch']->value['search_text'];?>
" /></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOV4']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Категория лидера</td>
<td>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOV4']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<div class="wrap_input">
<input id="ov_4_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="checkbox" name="ov_4[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['option_value_checked']==1) {?> checked="checked"<?php }?> />
<label for="ov_4_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?>
</td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Статус интервью</td>
<td>
<input id="leader_interview_date_type_1" type="radio" name="leader_interview_date_type_id" value="1"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_interview_date_type_id']=="1") {?> checked="checked"<?php }?> /> <label for="leader_interview_date_type_1">все</label>
<input id="leader_interview_date_type_2" type="radio" name="leader_interview_date_type_id" value="2"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_interview_date_type_id']=="2") {?> checked="checked"<?php }?> /> <label for="leader_interview_date_type_2">прошедшие</label>
<input id="leader_interview_date_type_3" type="radio" name="leader_interview_date_type_id" value="3"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_interview_date_type_id']=="3") {?> checked="checked"<?php }?> /> <label for="leader_interview_date_type_3">идут</label>
<input id="leader_interview_date_type_4" type="radio" name="leader_interview_date_type_id" value="4"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_interview_date_type_id']=="4") {?> checked="checked"<?php }?> /> <label for="leader_interview_date_type_4">ожидаются</label>
<input id="leader_interview_date_type_5" type="radio" name="leader_interview_date_type_id" value="5"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_interview_date_type_id']=="5") {?> checked="checked"<?php }?> /> <label for="leader_interview_date_type_5">не назначены</label>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Приоритет интервью</td>
<td>
<input id="leader_high_priority_type_1" type="radio" name="leader_high_priority_type_id" value="1"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_high_priority_type_id']=="1") {?> checked="checked"<?php }?> /> <label for="leader_high_priority_type_1">все</label>
<input id="leader_high_priority_type_2" type="radio" name="leader_high_priority_type_id" value="2"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_high_priority_type_id']=="2") {?> checked="checked"<?php }?> /> <label for="leader_high_priority_type_2">приоритетные</label>
<input id="leader_high_priority_type_3" type="radio" name="leader_high_priority_type_id" value="3"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_high_priority_type_id']=="3") {?> checked="checked"<?php }?> /> <label for="leader_high_priority_type_3">остальные</label>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Актуальность</td>
<td>
<input id="leader_enabled_type_1" type="radio" name="leader_enabled_type_id" value="1"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_enabled_type_id']=="1") {?> checked="checked"<?php }?> /> <label for="leader_enabled_type_1">все</label>
<input id="leader_enabled_type_2" type="radio" name="leader_enabled_type_id" value="2"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_enabled_type_id']=="2") {?> checked="checked"<?php }?> /> <label for="leader_enabled_type_2">только актуальные</label>
<input id="leader_enabled_type_3" type="radio" name="leader_enabled_type_id" value="3"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_enabled_type_id']=="3") {?> checked="checked"<?php }?> /> <label for="leader_enabled_type_3">только не актуальные</label>
</td>
</tr>
</tbody>
</table>

<table class="wrap_sub search">
<tr>
<td></td>
<td><input type="submit" value="Искать" /></td>
</tr>
</table>

</form>

<?php if (isset($_smarty_tpl->tpl_vars['aContentList']->value)) {?>

<?php $_smarty_tpl->_capture_stack[0][] = array("search_url", null, null); ob_start();
if (isset($_smarty_tpl->tpl_vars['aSearch']->value)) {
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['aSearch']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>&<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
=<?php echo $_smarty_tpl->tpl_vars['item']->value;
}
}
if (isset($_smarty_tpl->tpl_vars['aOV4']->value)) {
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOV4']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['option_value_checked']==1) {?>&ov_4[]=<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];
}
}
}
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<table class="base_table">
<tr>
<th class="order small" rowspan="2"><strong>Id</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==1) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=1<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==2) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=2<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th class="order" rowspan="2"><strong>Лидер</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==3) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=3<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==4) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=4<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th rowspan="2"><strong>@</strong></th>
<th class="order" rowspan="2"><strong>Город</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==5) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=5<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==6) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=6<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th rowspan="2" class="order"><strong>Категория</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==11) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=11<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==12) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=12<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th rowspan="2" class="order"><strong>Проекты</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==9) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=9<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==10) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=10<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th colspan="5"><strong>Интервью</strong></th>
<th colspan="2"><strong>Рекомендации</strong></th>
<th rowspan="2" class="small"><strong>✓</strong></th>
</tr>
<tr>
<th class="order"><strong>Интервьюер</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==19) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=19<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==20) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=20<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th class="order"><strong>Дата</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==7) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=7<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==8) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=8<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th class="order"><strong>↑</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==17) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=17<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==18) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=18<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th><strong>Способ</strong></th>
<th><strong>Комментарий по интервью</strong></th>
<th class="order"><strong><-</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==13) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=13<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==14) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=14<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?></th>
<th class="order"><strong>-></strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==15) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=15<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==16) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list&order=16<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?></th>
</tr>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aContentList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_id'];?>
</td>
<td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_patronymic']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_patronymic'];
}
}?></a></td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['leader_email']!='') {?><a href="#" onclick='clipboard.copy({"text/plain": "<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_email'];?>
", "text/html": "<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_email'];?>
"}); return false;' title="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_email'];?>
">@</a><?php }?></td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['city_name_show'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_option_4'];?>
</td>
<td><?php if (isset($_smarty_tpl->tpl_vars['item']->value['projects'])&&!empty($_smarty_tpl->tpl_vars['item']->value['projects'])) {
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
if ($_smarty_tpl->tpl_vars['i']->value['project_id']==0) {
echo $_smarty_tpl->tpl_vars['i']->value['project_name'];
} else { ?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['i']->value['project_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['project_name'];?>
</a><?php }?><br/><?php }
}?></td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_interview_backend_user_name'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_interview_date'];?>
</td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['leader_high_priority']==1) {?>↑<?php }?></td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_option_1'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_question_21'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendations_to_count'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendations_from_count'];?>
</td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['leader_enabled']==1) {?>+<?php } else { ?>-<?php }?></td>
</tr>
<?php } ?>

</table>

<?php if ($_smarty_tpl->tpl_vars['iMaxPage']->value>1) {?>
<p class="navigation">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['for'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['for']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['name'] = 'for';
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['iMaxPage']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['for']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['for']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['for']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['for']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['for']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['for']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['for']['total']);
?>
<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration']==$_smarty_tpl->tpl_vars['iCurrentPage']->value) {?>
<span class="active"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
</span>
<?php } else { ?>
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration']!=1) {?>&page=<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];
}?>&order=<?php echo $_smarty_tpl->tpl_vars['iCurrentOrder']->value;
echo Smarty::$_smarty_vars['capture']['search_url'];?>
"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
</a>
<?php }?>
<?php endfor; endif; ?>
</p>
<?php }?>

<?php } else { ?>
<p>По вашему запросу лидеры ЛИСС не найдены.</p>
<?php }?><?php }} ?>
