<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-30 12:44:44
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_projects_view_without_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:305585a1fd30ce17060-01629361%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bf23ba5cb12147c19501bcf097bb472f6259d98' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_projects_view_without_edit.tpl',
      1 => 1512030146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '305585a1fd30ce17060-01629361',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aContentData' => 0,
    'bProjectsEdit' => 0,
    'aBackendUsers' => 0,
    'aOptions' => 0,
    'item' => 0,
    'aCities' => 0,
    'iTemp' => 0,
    'aLeaders' => 0,
    'aFilials' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1fd30d450ad1_44047054',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fd30d450ad1_44047054')) {function content_5a1fd30d450ad1_44047054($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="sub_links">
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])&&$_smarty_tpl->tpl_vars['bProjectsEdit']->value) {?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=view">создать проект ЛИСС</a> | <?php }?>
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list">список проектов ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Проекты ЛИСС / просмотр</p></div>

<div class="options_add open" for="block_01">Общая информация</div>
<table class="form_table block_01">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Id проекта ЛИСС</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_id'];
if ($_smarty_tpl->tpl_vars['bProjectsEdit']->value) {?> <a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_id'];?>
">редактировать</a><?php }?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата и время создания</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_create_datetime'];?>
</td>
</tr>
<?php if ($_smarty_tpl->tpl_vars['aContentData']->value['transaction_create_datetime']!='') {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата и время последнего изменения</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['transaction_create_datetime'];?>
</td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['project_create_backend_user_id']])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Инициатор</td>
<td><?php echo $_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['project_create_backend_user_id']]["backend_user_name"];?>
</td>
</tr>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['aContentData']->value['transaction_backend_user_id']!=''&&isset($_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['transaction_backend_user_id']])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Автор последнего изменения данных</td>
<td><?php echo $_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['transaction_backend_user_id']]["backend_user_name"];?>
</td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата интервью</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_interview_date'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата появления в БД</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_create_date'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Интервьюируемый</td>
<td><?php if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_id']!='') {?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_surname'];
if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_name'];
if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_patronymic']!='') {?> <?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_patronymic'];
}
}
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_name_1']!='') {?> (<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_name_1'];?>
)<?php }?></a><?php } else {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_name'];
}?></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aBackendUsers']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Интервьюер</td>
<td><?php if (isset($_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['project_interview_backend_user_id']])) {
echo $_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['project_interview_backend_user_id']]["backend_user_name"];
}?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Кто заполняет анкету</td>
<td><?php if (isset($_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['project_write_backend_user_id']])) {
echo $_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['project_write_backend_user_id']]["backend_user_name"];
}?></td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Анкета актуальна</td>
<td><?php if ($_smarty_tpl->tpl_vars['aContentData']->value['project_enabled']==1) {?>+<?php } else { ?>-<?php }?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Анкета заполнена</td>
<td><?php if ($_smarty_tpl->tpl_vars['aContentData']->value['project_done']==1) {?>+<?php } else { ?>-<?php }?></td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_02">Общие данные о проекте</div>
<table class="form_table block_02">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Название проекта</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_name'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Краткое название</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_name_small'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Название для карты</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_name_code'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Суть проекта</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_text']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Основной сайт</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_site'];?>
</td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_03">Описание проекта</div>
<table class="form_table block_03">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Какую проблему решает проект</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_01']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Для кого ваш проект?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_02']);?>
</td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[5])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Сфера</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[5]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['option_selected']==1) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
<br/><?php }
}
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_area'];?>
</td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[6])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Тип проекта</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[6]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['option_selected']==1) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
<br/><?php }
} ?></td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[7])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Среда реализации</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[7]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_question_03']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<?php }?>
</tbody>
</table>

<div class="options_add" for="block_04">Проблематизация</div>
<table class="form_table block_04">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>На основании чего Вы сделали вывод, что проблема существует?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_04']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Деятельность проекта</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_05']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Прямой эффект</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_06']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Косвенный эффект</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_07']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Как Вы оцениваете свою эффективность?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_45']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Как проблема решается сегодня?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_08']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Какие ресурсы Вы используете</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_10']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Какую ценность вы создаёте для тех, кто вам помогает?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_09']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Кто в Вашей команде? Как Вы их мотивируете?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_46']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Комментарий по проекту</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_11']);?>
</td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[2])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Уровень воздействия</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[2]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_question_12']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<?php }?>
</tbody>
</table>

<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[8])) {?>
<div class="options_add" for="block_05">Инновационность</div>
<table class="form_table block_05">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Инновационность</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[8]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_question_13']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Новое содержание</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[8]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_question_14']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Новая форма представления</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[8]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_question_15']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Новые процессы, роли, форматы</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[8]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_question_16']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Новая инфраструктура</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[8]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_question_17']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
</tbody>
</table>
<?php }?>

<div class="options_add" for="block_06">Организация проекта</div>
<table class="form_table block_06">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Оператор/автор проекта</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_43'];?>
</td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aCities']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Местоположение головной компании (город)</td>
<td><?php $_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("0", null, 0);
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['city_id']==$_smarty_tpl->tpl_vars['item']->value['city_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['city_name'];
$_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("1", null, 0);
}
}
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_city_name']!='') {
if ($_smarty_tpl->tpl_vars['iTemp']->value==0) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_city_name'];
} else { ?> (<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_city_name'];?>
)<?php }
}?></td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата начала деятельности</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_start_date'];?>
</td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[10])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Организационно-правовая форма оператора проекта</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[10]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['option_selected']==1) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
<br/><?php }
} ?></td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[11])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Стадия проекта</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[11]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_question_41']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[12])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Бизнес модель</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[12]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_question_42']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_08",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Описание бизнес модели</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_44']);?>
</td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_07">Структура затрат</div>
<table class="form_table block_07">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_07",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Благотворительная деятельность</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_18'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_07",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Коммерческая деятельность</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_19'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_07",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Комментарий к структуре затрат</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_32']);?>
</td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_08">Структура доходов</div>
<table class="base_table block_08">
<tr>
<th style="width: 28%;"></th>
<th style="width: 18%;"><strong>Физлица</strong></th>
<th style="width: 18%;"><strong>Юрлица</strong></th>
<th style="width: 18%;"><strong>Фонды/НКО</strong></th>
<th style="width: 18%;"><strong>Государство (бюджет)</strong></th>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"block_08",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td style="text-align: left;">Инвестиции</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_20'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_21'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_22'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_23'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"block_08",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td style="text-align: left;">Выручка</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_24'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_25'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_26'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_27'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"block_08",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td style="text-align: left;">Гранты/спонсорство</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_28'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_29'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_30'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_31'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"block_08",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td style="text-align: left;">Комментарий к структуре доходов</td>
<td colspan="4"><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_33']);?>
</td>
</tr>
</table>

<?php if (isset($_smarty_tpl->tpl_vars['aLeaders']->value)) {?>
<div class="options_add" for="leaders">Лидеры проекта (<?php echo count($_smarty_tpl->tpl_vars['aLeaders']->value);?>
)</div>
<table class="base_table leaders">
<tr>
<th><strong>Лидер ЛИС</th>
<th><strong>Роль лидера в проекте</strong></th>
<th colspan="2"><strong>Период участия <div class="info white"><span>Примерные даты (от и до) участия лидера в проекте, если известно</span></div></strong></th>
</tr>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aLeaders']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"leaders",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>
<?php if ($_smarty_tpl->tpl_vars['item']->value['leader_id']=='') {?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_patronymic']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_patronymic'];
}
}?>
<?php } else { ?>
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_patronymic']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_patronymic'];
}
}
if ($_smarty_tpl->tpl_vars['item']->value['project_name']!='') {?> (<?php echo $_smarty_tpl->tpl_vars['item']->value['project_name'];?>
)<?php }?></a>
<?php }?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_role'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_date_from'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_date_to'];?>
</td>
</tr>
<?php } ?>
</table>
<?php }?>

<div class="options_add" for="block_09">Масштаб проекта и воздействие</div>
<table class="form_table block_09">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Среднемесячное количество посещений сайта/страницы</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_34'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Среднемесячное количество посещений из России</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_35'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Количество человек в команде</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_36'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Членов команды в штате</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_37'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Общее количество пользователей/потребителей в год</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_38'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Общее количество пользователей/потребителей в год в России</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_39'];?>
</td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[9])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>География деятельности</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[9]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_question_40']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Комментарий</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['project_question_47']);?>
</td>
</tr>
</tbody>
</table>

<?php if (isset($_smarty_tpl->tpl_vars['aFilials']->value)) {?>
<div class="options_add" for="filials">Филиалы (<?php echo count($_smarty_tpl->tpl_vars['aFilials']->value);?>
)</div>
<table class="base_table filials">
<tr>
<th><strong>Город</strong></th>
<th><strong>Адрес</strong></th>
<th><strong>Комментарий</strong></th>
</tr>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aFilials']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"filials",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><?php $_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("0", null, 0);
if (isset($_smarty_tpl->tpl_vars['aCities']->value)) {
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['city_id']==$_smarty_tpl->tpl_vars['i']->value['city_id']) {
echo $_smarty_tpl->tpl_vars['i']->value['city_name'];
$_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("1", null, 0);
}
}
}
if ($_smarty_tpl->tpl_vars['item']->value['filial_city_name']!='') {
if ($_smarty_tpl->tpl_vars['iTemp']->value==0) {?> (<?php echo $_smarty_tpl->tpl_vars['item']->value['filial_city_name'];?>
)<?php } else {
echo $_smarty_tpl->tpl_vars['item']->value['filial_city_name'];
}
}?></td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['item']->value['filial_address']);?>
</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['item']->value['filial_comment']);?>
</td>
</tr>
<?php } ?>
</table>
<?php }?><?php }} ?>
