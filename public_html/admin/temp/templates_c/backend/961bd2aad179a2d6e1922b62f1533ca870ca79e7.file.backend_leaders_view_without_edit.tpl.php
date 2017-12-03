<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-30 11:25:40
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_leaders_view_without_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7575a1fc084be9fb6-44212513%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '961bd2aad179a2d6e1922b62f1533ca870ca79e7' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_leaders_view_without_edit.tpl',
      1 => 1512030220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7575a1fc084be9fb6-44212513',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aContentData' => 0,
    'bLeadersEdit' => 0,
    'aBackendUsers' => 0,
    'aOptions' => 0,
    'item' => 0,
    'aRecommendationsFrom' => 0,
    'aSex' => 0,
    'aCities' => 0,
    'iTemp' => 0,
    'aProjects' => 0,
    'aRecommendations' => 0,
    'i' => 0,
    'iTemp1' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1fc084f11384_65825512',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fc084f11384_65825512')) {function content_5a1fc084f11384_65825512($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="sub_links">
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bLeadersEdit']->value) {?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view">создать лидера ЛИСС</a> | <?php }?>
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list">список лидеров ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Лидеры ЛИСС / просмотр</p></div>

<div class="options_add open" for="block_01">Общая информация</div>
<table class="form_table block_01">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Id лидера ЛИСС</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_id'];
if ($_smarty_tpl->tpl_vars['bLeadersEdit']->value) {?> <a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_id'];?>
">редактировать</a><?php }?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата и время создания</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_create_datetime'];?>
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
<?php if (isset($_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['leader_create_backend_user_id']])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Инициатор</td>
<td><?php echo $_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['leader_create_backend_user_id']]["backend_user_name"];?>
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
<td>Шаблон анкеты</td>
<td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=docx&content_id=<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_id'];?>
" target="_blank">скачать</a></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата интервью</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_date'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата появления в БД</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_create_date'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Интервьюер</td>
<td><?php if (isset($_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_backend_user_id']])) {
echo $_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_backend_user_id']]["backend_user_name"];
}?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Кто заполняет анкету</td>
<td><?php if (isset($_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['leader_write_backend_user_id']])) {
echo $_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['leader_write_backend_user_id']]["backend_user_name"];
}?></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[1])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Способ проведения интервью</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[1]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_type']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aRecommendationsFrom']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Рекомендатели</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aRecommendationsFrom']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_patronymic']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_patronymic'];
}
}
if ($_smarty_tpl->tpl_vars['item']->value['project_name']!='') {?> (<?php echo $_smarty_tpl->tpl_vars['item']->value['project_name'];?>
)<?php }?></a><br/><?php } ?></td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Источник контакта</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_contact_from'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Договоренности</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_result']);?>
</textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Комментарий по назначению интервью</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_21']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Приоритетный порядок интервью</td>
<td><?php if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_high_priority']==1) {?>+<?php } else { ?>-<?php }?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Анкета актуальна</td>
<td><?php if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_enabled']==1) {?>+<?php } else { ?>-<?php }?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Анкета заполнена</td>
<td><?php if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_done']==1) {?>+<?php } else { ?>-<?php }?></td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_02">Личная информация</div>
<table class="form_table block_02">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Фамилия</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_surname'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Имя</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_name'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Отчество</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_patronymic'];?>
</td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aSex']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Пол</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aSex']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['sex_id']==$_smarty_tpl->tpl_vars['item']->value['sex_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['sex_name'];
}
} ?></td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aCities']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Город</td>
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
if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_city_name']!='') {
if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> (<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_city_name'];?>
)<?php } else {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_city_name'];
}
}?></td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата рождения</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_birth_date'];
if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_birth_date_correct']==1) {?> (дата точная)<?php }?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Основное место работы</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_company'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Должность</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_position'];?>
</td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_03">Контакты</div>
<table class="form_table block_03">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Телефон <div class="info"><span>Основной телефон</span></div></td>
<td><?php if (strlen($_smarty_tpl->tpl_vars['aContentData']->value['leader_phone'])==10) {?><a href="tel:+7<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_phone'];?>
">+7<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_phone'];?>
</a><?php } else {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_phone'];
}?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>E-mail <div class="info"><span>Основной e-mail</span></div></td>
<td><?php if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_email']!='') {?><a href="mailto:<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_email'];?>
"><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_email'];?>
</a><?php }?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Skype</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_skype'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Ссылка на страницу в социальных сетях</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_social_network'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дополнительная контактная информация</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_contacts']);?>
</td>
</tr>
</tbody>
</table>

<?php if (isset($_smarty_tpl->tpl_vars['aProjects']->value)) {?>
<div class="options_add" for="projects">Проекты (<?php echo count($_smarty_tpl->tpl_vars['aProjects']->value);?>
)</div>
<table class="base_table projects">
<tr>
<th><strong>Проект</strong></th>
<th><strong>Роль лидера в проекте</strong></th>
<th colspan="2"><strong>Период участия <div class="info white"><span>Примерные даты (от и до) участия лидера в проекте, если известно</span></div></strong></th>
</tr>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aProjects']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"projects",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['project_id']!='') {?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['project_id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['item']->value['project_name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];?>
)</a><?php } else {
echo $_smarty_tpl->tpl_vars['item']->value['project_name'];
}?></td>
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

<div class="options_add" for="block_04">Личные вопросы</div>
<table class="form_table block_04">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Почему Вас рекомендовали, как ЛИСС?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_01']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Сколько лет Вы реализуете проекты в социальной сфере?</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_02'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Что привело в социальную сферу?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_03']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Зачем Вы занимаетесь проектом?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_04']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Какие успешные проекты Вы реализовали?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_05']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>В каких экспертных группах Вы состоите?</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_06']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Комментарии</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_07']);?>
</td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[2])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Уровень мышления</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[2]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_08']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[3])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Тип лидера в классификации Ашока</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[3]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_09']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];
}
} ?></td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[4])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Категория лидера</td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[4]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['option_selected']==1) {
echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
<br/><?php }
} ?></td>
</tr>
<?php }?>
</tbody>
</table>

<div class="options_add" for="block_05">Вызовы, препятствия и потребности</div>
<table class="base_table block_05">
<tr>
<th><strong></strong></th>
<th><strong>Вызовы</strong></th>
<th><strong>Препятствия</strong></th>
<th><strong>Потребности</strong></th>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Личность</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_10']);?>
</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_11']);?>
</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_12']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Проект</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_13']);?>
</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_14']);?>
</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_15']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Система</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_16']);?>
</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_17']);?>
</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_18']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Потребности в законодательстве</td>
<td colspan="3"><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_19']);?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Отношение к социальной деятельности</td>
<td colspan="3"><?php echo nl2br($_smarty_tpl->tpl_vars['aContentData']->value['leader_question_20']);?>
</td>
</tr>
</table>

<?php if (isset($_smarty_tpl->tpl_vars['aRecommendations']->value)) {?>
<div class="options_add" for="leaders">Рекомендации (входящие: <?php echo $_smarty_tpl->tpl_vars['aContentData']->value['recommendations_to_count_all'];?>
 (<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['recommendations_to_count_for_interview'];?>
), исходящие: <?php echo count($_smarty_tpl->tpl_vars['aRecommendations']->value);?>
)</div>
<table class="base_table leaders">
<tbody>
<tr>
<th colspan="2"><strong>Рекомендуемый лидер</strong></th>
<th><strong>Причина рекомендации</strong></th>
<th><strong>Комментарий</strong></th>
</tr>
<?php $_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("0", null, 0);?>

<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aRecommendations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==0) {
$_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("1", null, 0);
} else {
$_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("0", null, 0);
}?>
<?php if ($_smarty_tpl->tpl_vars['item']->value['leader_id_to']!='') {?>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td colspan="2"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_id_to'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_patronymic']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_patronymic'];
}
}
if ($_smarty_tpl->tpl_vars['item']->value['project_name']!='') {?> (<?php echo $_smarty_tpl->tpl_vars['item']->value['project_name'];?>
)<?php }?></a></td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['item']->value['recommendation_reason']);?>
</td>
<td><?php echo nl2br($_smarty_tpl->tpl_vars['item']->value['recommendation_comment']);?>
</td>
</tr>
<?php } else { ?>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">ФИО</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_patronymic']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_patronymic'];
}
}?></td>
<td rowspan="5"><?php echo nl2br($_smarty_tpl->tpl_vars['item']->value['recommendation_reason']);?>
</td>
<td rowspan="5"><?php echo nl2br($_smarty_tpl->tpl_vars['item']->value['recommendation_comment']);?>
</td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">Проект</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_name'];?>
</td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">Город</td>
<td><?php $_smarty_tpl->tpl_vars["iTemp1"] = new Smarty_variable("0", null, 0);
if (isset($_smarty_tpl->tpl_vars['aCities']->value)) {
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['city_id']==$_smarty_tpl->tpl_vars['i']->value['city_id']) {
echo $_smarty_tpl->tpl_vars['i']->value['city_name'];
$_smarty_tpl->tpl_vars["iTemp1"] = new Smarty_variable("1", null, 0);
}
}
}
if ($_smarty_tpl->tpl_vars['item']->value['leader_city_name']!='') {
if ($_smarty_tpl->tpl_vars['iTemp1']->value==0) {?> (<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_city_name'];?>
)<?php } else {
echo $_smarty_tpl->tpl_vars['item']->value['leader_city_name'];
}
}?></td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">Телефон</td>
<td><?php if (strlen($_smarty_tpl->tpl_vars['item']->value['leader_phone'])==10) {?><a href="tel:+7<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_phone'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_phone'];?>
</a><?php } else {
echo $_smarty_tpl->tpl_vars['item']->value['leader_phone'];
}?></td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">E-mail</td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['leader_email']!='') {?><a href="mailto:<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_email'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_email'];?>
</a><?php }?></td>
</tr>
<?php }?>
<?php } ?>
</tbody>
</table>
<?php }?><?php }} ?>
