<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-12-04 13:31:30
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_leaders_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:112825a1fd277642bf8-03253917%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae58753673cf95c106cd9fc8b0bc106ad6928d15' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_leaders_list.tpl',
      1 => 1512383174,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112825a1fd277642bf8-03253917',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1fd2778bef20_25028717',
  'variables' => 
  array (
    'bLeadersEdit' => 0,
    'aSearch' => 0,
    'aLeaderInterviewBackendUsers' => 0,
    'item' => 0,
    'aOV4' => 0,
    'aContentList' => 0,
    'key' => 0,
    'iCurrentOrder' => 0,
    'i' => 0,
    'iMaxPage' => 0,
    'iCurrentPage' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fd2778bef20_25028717')) {function content_5a1fd2778bef20_25028717($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><?php if ($_smarty_tpl->tpl_vars['bLeadersEdit']->value) {?><div class="sub_links">
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view">создать лидера ЛИСС</a>
</div><?php }?>

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
<td>Дата появления в БД</td>
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
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Интервьюер</td>
<td><select name="leader_interview_backend_user_id"><option value=""></option><option value="0"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_interview_backend_user_id']=="0") {?> selected<?php }?>>без интервьюера</option><?php if (isset($_smarty_tpl->tpl_vars['aLeaderInterviewBackendUsers']->value)) {
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aLeaderInterviewBackendUsers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_interview_backend_user_id']==$_smarty_tpl->tpl_vars['item']->value['backend_user_id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_name'];?>
</option><?php }
}?></select></td>
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
<div class="wrap_input inline_input">
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
<div class="wrap_input inline_input">
<input id="leader_high_priority_type_1" type="radio" name="leader_high_priority_type_id" value="1"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_high_priority_type_id']=="1") {?> checked="checked"<?php }?> /> <label for="leader_high_priority_type_1">все</label>
</div>
<div class="wrap_input inline_input">
<input id="leader_high_priority_type_2" type="radio" name="leader_high_priority_type_id" value="2"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_high_priority_type_id']=="2") {?> checked="checked"<?php }?> /> <label for="leader_high_priority_type_2">приоритетные</label>
</div>
<div class="wrap_input inline_input">
<input id="leader_high_priority_type_3" type="radio" name="leader_high_priority_type_id" value="3"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_high_priority_type_id']=="3") {?> checked="checked"<?php }?> /> <label for="leader_high_priority_type_3">остальные</label>
</div>
</td>
</tr>


<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Заполненность анкеты</td>
<td>
<div class="wrap_input inline_input">
<!-- <input id="leader_done_type_1" type="radio" name="leader_done_type_id" value="1"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_done_type_id']=="1") {?> checked="checked"<?php }?> /> <label for="leader_done_type_1">все</label> -->
  <input id="leader_done_1" type="checkbox" name="leader_done_1"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_done_1']=="1") {?> checked="checked"<?php }?> />
  <label for="leader_done_1">Заполнены минимальные данные</label>
</div>
<div class="wrap_input inline_input">
<!-- <input id="leader_done_type_2" type="radio" name="leader_done_type_id" value="2"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_done_type_id']=="2") {?> checked="checked"<?php }?> /> <label for="leader_done_type_2">заполенные анкеты</label> -->
  <input id="leader_done_2" type="checkbox" name="leader_done_2"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_done_2']=="1") {?> checked="checked"<?php }?>/>
  <label for="leader_done_2">Заполнены данные для FAS</label>
</div>
<div class="wrap_input inline_input">
<!-- <input id="leader_done_type_3" type="radio" name="leader_done_type_id" value="3"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_done_type_id']=="3") {?> checked="checked"<?php }?> /> <label for="leader_done_type_3">незаполненные анкеты</label> -->
  <input id="leader_done_3" type="checkbox" name="leader_done_3"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_done_3']=="1") {?> checked="checked"<?php }?> />
  <label for="leader_done_3">Внесено все интервью</label>
</div>
<div class="wrap_input inline_input">
  <input id="leader_done_4" type="checkbox" name="leader_done_4"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_done_4']=="1") {?> checked="checked"<?php }?> />
  <label for="leader_done_4">Проставлены теги</label>
</div>
</td>
</tr>


<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Актуальность</td>
<td>
<div class="wrap_input inline_input">
<input id="leader_enabled_type_1" type="radio" name="leader_enabled_type_id" value="1"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_enabled_type_id']=="1") {?> checked="checked"<?php }?> /> <label for="leader_enabled_type_1">все</label>
</div>
<div class="wrap_input inline_input">
<input id="leader_enabled_type_2" type="radio" name="leader_enabled_type_id" value="2"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_enabled_type_id']=="2") {?> checked="checked"<?php }?> /> <label for="leader_enabled_type_2">актуальные</label>
</div>
<div class="wrap_input inline_input">
<input id="leader_enabled_type_3" type="radio" name="leader_enabled_type_id" value="3"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['leader_enabled_type_id']=="3") {?> checked="checked"<?php }?> /> <label for="leader_enabled_type_3">неактуальные</label>
</div>
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

<table class="base_table" id="header-fixed"></table>
<table class="base_table foxFix">
	<thead>
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
<?php if ($_smarty_tpl->tpl_vars['bLeadersEdit']->value) {?><th rowspan="2" class="small"></th><?php }?>
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
</thead>
<tbody>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aContentList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr class="<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>'odd,'),$_smarty_tpl);
if ($_smarty_tpl->tpl_vars['item']->value['leader_enabled']==0) {?> disable<?php }?>">
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_id'];?>
</td>
<td><a target="_blank" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view<?php if (!$_smarty_tpl->tpl_vars['bLeadersEdit']->value) {?>_without_edit<?php }?>&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_id'];?>
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
} else { ?><a target="_blank" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
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
<?php if ($_smarty_tpl->tpl_vars['item']->value['leader_question_21']==$_smarty_tpl->tpl_vars['item']->value['leader_question_21_small']) {?>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_question_21'];?>
</td>
<?php } else { ?>
<td class="has_info">
<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_question_21_small'];?>
 <a class="popup_info_link" onclick="return false;" href="#">...</a><span class="popup_info"><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_question_21'];?>
</span>
</td>
<?php }?>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendations_to_count'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendations_from_count'];?>
</td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['leader_done']==1) {?>+<?php } else { ?>-<?php }?></td>
<?php if ($_smarty_tpl->tpl_vars['bLeadersEdit']->value) {?><td><a target="_blank" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view_without_edit&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_id'];?>
"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/view.png" alt="Просмотр" width="15" /></a></td><?php }?>
</tr>
<?php } ?>
</tbody>
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
