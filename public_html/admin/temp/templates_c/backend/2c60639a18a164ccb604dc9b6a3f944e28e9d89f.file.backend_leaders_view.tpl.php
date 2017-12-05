<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-12-04 15:14:06
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_leaders_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:143805a1fc016720db0-06471173%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c60639a18a164ccb604dc9b6a3f944e28e9d89f' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_leaders_view.tpl',
      1 => 1512386687,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143805a1fc016720db0-06471173',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1fc016d71136_49577254',
  'variables' => 
  array (
    'aContentData' => 0,
    'bLeadersEdit' => 0,
    'aContentDataErrors' => 0,
    'aBackendUsers' => 0,
    'sLeaderCreateDateRecommend' => 0,
    'item' => 0,
    'iBackendUserId' => 0,
    'aOptions' => 0,
    'aRecommendationsFrom' => 0,
    'aSex' => 0,
    'aCities' => 0,
    'aProjects' => 0,
    'bLeaderProjectDeleteEnabled' => 0,
    'iProjectOrderMax' => 0,
    'aTagsLiders' => 0,
    'aRecommendations' => 0,
    'bRecommendationDeleteEnabled' => 0,
    'iTemp' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fc016d71136_49577254')) {function content_5a1fc016d71136_49577254($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
if (!is_callable('smarty_modifier_date_format')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\modifier.date_format.php';
?><div class="sub_links">
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bLeadersEdit']->value) {?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view">создать лидера ЛИСС</a> | <?php }?>
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=list">список лидеров ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Лидеры ЛИСС / <?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])) {?>редактирование<?php } else { ?>создание<?php }?></p></div>

<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['transaction_id'])) {?>
<p class="error_text_header">Данные не могу быть сохранены, так как произошло их изменение. Обновите страницу.</p>
<?php } else { ?>
<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value)&&!empty($_smarty_tpl->tpl_vars['aContentDataErrors']->value)) {?>
<p class="error_text_header">Обратите внимание, что данные не сохранены.</p>
<?php }?>
<?php }?>

<form id="form_leaders" action="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=edit<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])) {?>&content_id=<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_id'];
}?>" method="post">

<input type="hidden" name="transaction_id" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['transaction_id'];
}?>">

<div class="options_add open" for="block_01">Общая информация</div>
<table class="form_table block_01">
<tbody>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Id лидера ЛИСС</td>
<td><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_id'];?>
</td>
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
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата интервью <div class="info"><span>Формат: YYYY-MM-DD</span></div></td>
<td><input type="text" name="leader_interview_date" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_date'];
} else {
echo smarty_modifier_date_format(time(),"%Y-%m-%d");
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_interview_date'])) {?> error<?php }?>" id="leader_interview_date" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_interview_date'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_interview_date'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата появления в БД <div class="info"><span>Формат: YYYY-MM-DD</span></div></td>
<td><input type="text" name="leader_create_date" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_create_date'];
} else {
echo $_smarty_tpl->tpl_vars['sLeaderCreateDateRecommend']->value;
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_create_date'])) {?> error<?php }?>" id="leader_create_date" /> рекомендуемая дата: <a href="#" onclick="$('#leader_create_date').val('<?php echo $_smarty_tpl->tpl_vars['sLeaderCreateDateRecommend']->value;?>
'); return false;"><?php echo $_smarty_tpl->tpl_vars['sLeaderCreateDateRecommend']->value;?>
</a><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_create_date'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_create_date'];
}?></p></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aBackendUsers']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Интервьюер</td>
<td><select name="leader_interview_backend_user_id"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aBackendUsers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_id'];?>
"<?php if ((isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_backend_user_id'],$_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_backend_user_id']])&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_backend_user_id']==$_smarty_tpl->tpl_vars['item']->value['backend_user_id'])||(!isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_backend_user_id'])&&$_smarty_tpl->tpl_vars['iBackendUserId']->value==$_smarty_tpl->tpl_vars['item']->value['backend_user_id'])) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_name'];?>
</option><?php } ?></select></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Кто заполняет анкету</td>
<td><select name="leader_write_backend_user_id"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aBackendUsers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_id'];?>
"<?php if ((isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_write_backend_user_id'],$_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['leader_write_backend_user_id']])&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_write_backend_user_id']==$_smarty_tpl->tpl_vars['item']->value['backend_user_id'])||(!isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_write_backend_user_id'])&&$_smarty_tpl->tpl_vars['iBackendUserId']->value==$_smarty_tpl->tpl_vars['item']->value['backend_user_id'])) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_name'];?>
</option><?php } ?></select></td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[1])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Способ проведения интервью</td>
<td><select name="leader_interview_type"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[1]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_type']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</option><?php } ?></select></td>
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
<td>Источник контакта <div class="info"><span>Заполняется до интервью</span></div></td>
<td><input type="text" name="leader_contact_from" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_contact_from'];
}?>" /></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Договоренности <div class="info"><span>Следующие шаги, о которых договорились на интервью</span></div></td>
<td><textarea name="leader_interview_result"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_interview_result'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Комментарий по назначению интервью</td>
<td><textarea name="leader_question_21"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_21'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Статус анкеты</td>
<td><input id="leader_high_priority" type="checkbox" name="leader_high_priority"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_high_priority']==1) {?> checked<?php }?> /> <label for="leader_high_priority">приоритетный порядок интервью</label> <input id="leader_enabled" type="checkbox" name="leader_enabled"<?php if (!isset($_smarty_tpl->tpl_vars['aContentData']->value)||$_smarty_tpl->tpl_vars['aContentData']->value['leader_enabled']==1) {?> checked<?php }?> /> <label for="leader_enabled">анкета актуальна</label></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Заполненность анкеты</td>
<td>
  <!-- <input id="leader_done" type="checkbox" name="leader_done"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_done']==1) {?> checked<?php }?> />
  <label for="leader_done">анкета заполнена</label> -->
  <input id="leader_done_1" type="checkbox" name="leader_done_1"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_done_1']==1) {?> checked<?php }?> />
  <label for="leader_done_1">Заполнены минимальные данные</label>
  <input id="leader_done_2" type="checkbox" name="leader_done_2"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_done_2']==1) {?> checked<?php }?> />
  <label for="leader_done_2">Заполнены данные для FAS</label>
  <input id="leader_done_3" type="checkbox" name="leader_done_3"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_done_3']==1) {?> checked<?php }?> />
  <label for="leader_done_3">Внесено все интервью</label>
  <input id="leader_done_4" type="checkbox" name="leader_done_4"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_done_4']==1) {?> checked<?php }?> />
  <label for="leader_done_4">Проставлены теги</label>

</td>
</tr>
</tbody>
</table>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bLeadersEdit']->value) {?>
<div class="options_add" for="block_02" id="header-fixed-fio"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_surname'];
}?> <?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_name'];
}?> <?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_patronymic'];
}?></div>
<?php }?>
<div class="options_add foxFix" for="block_02"><div>Личная информация</div></div>

<table class="form_table block_02">
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Фамилия * <div class="info"><span>Если фамилия неизвестна, пишем "Неизвестно". Если непонятно, как её писать, ставим знак вопроса после фамилии</span></div></td>
<td colspan="2"><input type="text" name="leader_surname" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_surname'];
}?>"<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_surname'])) {?> class="error"<?php }?> /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_surname'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_surname'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Имя</td>
<td colspan="2"><input type="text" name="leader_name" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_name'];
}?>" /></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Отчество <div class="info"><span>Отчество заполняется, если его использование уместно в письмах и других сообщениях</span></div></td>
<td colspan="2"><input type="text" name="leader_patronymic" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_patronymic'];
}?>" /></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aSex']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Пол</td>
<td colspan="2"><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aSex']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><input id="sex_<?php echo $_smarty_tpl->tpl_vars['item']->value['sex_id'];?>
" type="radio" name="sex_id" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['sex_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['sex_id']==$_smarty_tpl->tpl_vars['item']->value['sex_id']) {?> checked<?php }?> /> <label for="sex_<?php echo $_smarty_tpl->tpl_vars['item']->value['sex_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['sex_name'];?>
</label> <?php } ?></td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aCities']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Город <div class="info"><span>Основное место жительства. Город или ближайший большой город (столица региона), например для Первоуральска выбирайте Екатеринбург, это нужно для укрупнённой региональной классификации. Если в списке нет, то заполните поле "другой город", для маленьких городов указывайте область</span></div></td>
<td style="width: 10%;"><select name="city_id"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['city_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['city_id']==$_smarty_tpl->tpl_vars['item']->value['city_id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['city_name'];?>
</option><?php } ?></select></td>
<td><input type="text" name="leader_city_name" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_city_name'];
}?>" placeholder="другой город" /></td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата рождения <div class="info"><span>Формат: YYYY-MM-DD. Если неизвестен день, устанавливаем 01, если неизвестен месяц, устанавливаем 07, если неизвестен год, даём свою оценку. Если дата известна, то отмечаем "дата точная", будет использоваться для поздравлений</span></div></td>
<td colspan="2"><input type="text" name="leader_birth_date" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_birth_date'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_birth_date'])) {?> error<?php }?>" id="leader_birth_date" /> <input id="leader_birth_date_correct" type="checkbox" name="leader_birth_date_correct"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_birth_date_correct']==1) {?> checked<?php }?> /> <label for="leader_birth_date_correct">дата точная</label></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Основное место работы <div class="info"><span>Основное - это значит, что человек там числится и зарабатывает. Формальное "трудовая лежит" не нужно. Лучше всего брать информацию из визитной карточки</span></div></td>
<td colspan="2"><input type="text" name="leader_company" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_company'];
}?>" /></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Должность</td>
<td colspan="2"><input type="text" name="leader_position" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_position'];
}?>" /></td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_03">Контакты</div>
<table class="form_table block_03">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Телефон <div class="info"><span>Основной телефон</span></div></td>
<td><input type="text" name="leader_phone" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_phone'];
}?>"<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_phone'])) {?> class="error"<?php }?> /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_phone'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_phone'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>E-mail <div class="info"><span>Основной e-mail</span></div></td>
<td><input type="text" name="leader_email" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_email'];
}?>"<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_email'])) {?> class="error"<?php }?> /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_email'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_email'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Skype <div class="info"><span>Указывется, если удобно сязываться через Skype</span></div></td>
<td><input type="text" name="leader_skype" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_skype'];
}?>" /></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Ссылка на страницу в социальных сетях</td>
<td><input type="text" name="leader_social_network" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_social_network'];
}?>" /></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дополнительная контактная информация <div class="info"><span>Дополнительные контакты, такие как: телефон (формат: +71231234567), e-mail, социальные сети и т. п.</span></div></td>
<td><textarea name="leader_contacts"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_contacts'];
}?></textarea></td>
</tr>
</tbody>
</table>

<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])) {?>
<div class="options_add" for="projects">Проекты (<?php if (isset($_smarty_tpl->tpl_vars['aProjects']->value)) {
echo count($_smarty_tpl->tpl_vars['aProjects']->value);
} else { ?>0<?php }?>)</div>
<table class="base_table projects">
<tr>
<th width="40%" colspan="2"><strong>Проект * <div class="info white"><span>Название или id проекта</span></div></strong></th>
<th width="40%"><strong>Роль лидера в проекте</strong></th>
<th colspan="2" class="small"><strong>Период участия <div class="info white"><span>Примерные даты (от и до) участия лидера в проекте, если известно</span></div></strong></th>
<th class="small"><strong>Сортировка * <div class="info white"><span>Порядковый номер проекта у лидера. Особенно важен выбор первого проекта</span></div></strong></th>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bLeaderProjectDeleteEnabled']->value) {?><th class="small"></th><?php }?>
</tr>
<?php $_smarty_tpl->tpl_vars["iProjectOrderMax"] = new Smarty_variable("0", null, 0);?>
<?php if (isset($_smarty_tpl->tpl_vars['aProjects']->value)) {?>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aProjects']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['iProjectOrderMax']->value<$_smarty_tpl->tpl_vars['item']->value['project_order']) {
$_smarty_tpl->tpl_vars["iProjectOrderMax"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['item']->value['project_order']), null, 0);
}?>
<tr<?php echo smarty_function_cycle(array('name'=>"projects",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<?php if ($_smarty_tpl->tpl_vars['item']->value['project_id']!='') {?>
<td colspan="2"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['project_id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['item']->value['project_name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];?>
)</a></td>
<?php } else { ?>
<td><input class="search_link_1" id="leader_project_old_<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
" type="text" name="project_name[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['project_name'];?>
" autocomplete="off" placeholder="название проекта или id" /></td>
<td class="small"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=create&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
" target="_blank" onclick="return confirm('Вы уверены, что хотите создать проект?');">создать</a></td>
<?php }?>
<td><input type="text" name="leader_role[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_role'];?>
" /></td>
<td><input type="text" name="leader_date_from[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" class="small" id="leader_date_from_<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_date_from'];?>
" /></td>
<td><input type="text" name="leader_date_to[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" class="small" id="leader_date_to_<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_date_to'];?>
" /></td>
<td><input type="text" name="project_order[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" class="small" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['project_order'];?>
" />
<?php echo '<script'; ?>
>
$(function(){
  $("#leader_date_from_<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1,
      yearRange: "1900:+0"
  });

  $("#leader_date_to_<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1,
      yearRange: "1900:+0"
  });
});
<?php echo '</script'; ?>
>
</td>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bLeaderProjectDeleteEnabled']->value) {?><td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=project_delete&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/delete.png" alt="Удалить" /></a></td><?php }?>
</tr>
<?php } ?>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['for'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['for']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['name'] = 'for';
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['loop'] = is_array($_loop=4) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<?php $_smarty_tpl->tpl_vars["iProjectOrderMax"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['iProjectOrderMax']->value+1), null, 0);?>
<tr<?php echo smarty_function_cycle(array('name'=>"projects",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><input class="search_link_1" id="leader_project_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" type="text" name="project_name_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" placeholder="название проекта или id" autocomplete="off" /></td>
<td class="small"></td>
<td><input type="text" name="leader_role_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" /></td>
<td><input type="text" name="leader_date_from_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" class="small" id="leader_date_from_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" /></td>
<td><input type="text" name="leader_date_to_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" class="small" id="leader_date_to_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" /></td>
<td><input type="text" name="project_order_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" class="small" value="<?php echo $_smarty_tpl->tpl_vars['iProjectOrderMax']->value;?>
" />
<?php echo '<script'; ?>
>
$(function(){
  $("#leader_date_from_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1,
      yearRange: "1900:+0"
  });

  $("#leader_date_to_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1,
      yearRange: "1900:+0"
  });
});
<?php echo '</script'; ?>
>
</td>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bLeaderProjectDeleteEnabled']->value) {?><td></td><?php }?>
</tr>
<?php endfor; endif; ?>
<tr<?php echo smarty_function_cycle(array('name'=>"projects",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td style="text-align:left;" colspan="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bLeaderProjectDeleteEnabled']->value) {?>7<?php } else { ?>6<?php }?>"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=view&leader_id=<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_id'];?>
" target="_blank">создать новый проект</a></td>
</tr>
</table>
<?php }?>

<div class="options_add" for="block_04">Личные вопросы</div>
<table class="form_table block_04">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Почему Вас рекомендовали, как ЛИСС? <div class="info"><span>Цель вопроса - настроить на тему</span></div></td>
<td><textarea name="leader_question_01"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_01'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Сколько лет Вы реализуете проекты в социальной сфере?</td>
<td><input type="text" name="leader_question_02" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_02'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_question_02'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_question_02'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['leader_question_02'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Что привело в социальную сферу? <div class="info"><span>Цель вопроса - выявить изначальную мотивацию</span></div></td>
<td><textarea name="leader_question_03"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_03'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Зачем Вы занимаетесь проектом? <div class="info"><span>Цель вопроса - выявить личный смысл деятельности</span></div></td>
<td><textarea name="leader_question_04"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_04'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Какие успешные проекты Вы реализовали?</td>
<td><textarea name="leader_question_05"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_05'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>В каких экспертных группах Вы состоите?</td>
<td><textarea name="leader_question_06"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_06'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Комментарии <div class="info"><span>Неформальные комментарии на тему лидера (не публичные)</span></div></td>
<td><textarea name="leader_question_07"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_07'];
}?></textarea></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[2])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Уровень мышления <div class="info"><span>Этот показатель оценивает широту взгляда лидера, на каком уровне он хочет изменить мир</span></div></td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[2]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<div class="wrap_input">
<input id="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="radio" name="leader_question_08" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_question_08']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> checked<?php }?> />
<label for="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?></td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[3])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Тип лидера в классификации Ашока <div class="info"><span>Показатель характеризует тип ЛИСС</span></div></td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[3]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<div class="wrap_input">
<input id="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="radio" name="leader_question_09" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_question_09']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> checked<?php }?> />
<label for="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?></td>
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
?>
<div class="wrap_input">
<input id="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="checkbox" name="options[4][]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['option_selected']==1) {?> checked<?php }?> />
<label for="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?></td>
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
<td><textarea name="leader_question_10"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_10'];
}?></textarea></td>
<td><textarea name="leader_question_11"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_11'];
}?></textarea></td>
<td><textarea name="leader_question_12"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_12'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Проект</td>
<td><textarea name="leader_question_13"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_13'];
}?></textarea></td>
<td><textarea name="leader_question_14"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_14'];
}?></textarea></td>
<td><textarea name="leader_question_15"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_15'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Система</td>
<td><textarea name="leader_question_16"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_16'];
}?></textarea></td>
<td><textarea name="leader_question_17"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_17'];
}?></textarea></td>
<td><textarea name="leader_question_18"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_18'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Потребности в законодательстве <div class="info"><span>Какие изменения в законодательстве помогли бы вам? Какие законы мешают проекту?</span></div></td>
<td colspan="3"><textarea name="leader_question_19"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_19'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Отношение к социальной деятельности <div class="info"><span>Какое отношение к соей деятельности вы чаще всего встречаете? Как в целом относятся к социальной деятельности?</span></div></td>
<td colspan="3"><textarea name="leader_question_20"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_question_20'];
}?></textarea></td>
</tr>
</table>







<!-- Начало блока тегов -->


<?php if (isset($_smarty_tpl->tpl_vars['aTagsLiders']->value)) {?>
<!-- Исправила for -->
<div class="options_add" for="tags">Теги</div>
<!-- Исправила класс на tags -->
<table class="base_table tags">
<tbody>
<tr>
<th style="width: 30%;" colspan="3"><strong>Наименование объекта</strong></th>
<th style="width: 40%;"><strong>Значение объекта <!-- <div class="info white"><span>Почему Вы его рекомендуете, как ЛИСС? Какие проблемы он решает? Почему Вы думаете, что он действительно решает социальные проблемы? Насколько Вы ему доверяете как человеку и как профессионалу?</span></div> --></strong></th>
<th style="width: 30%;"><strong>Колонка под теги</strong></th>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'],$_smarty_tpl->tpl_vars['aRecommendations']->value)&&$_smarty_tpl->tpl_vars['bRecommendationDeleteEnabled']->value) {?><th class="small"></th><?php }?>
</tr>
<?php $_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("0", null, 0);?>

<?php if (!empty($_smarty_tpl->tpl_vars['aTagsLiders']->value['data']['id_leader'])) {?>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aTagsLiders']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==0) {
$_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("1", null, 0);
} else {
$_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("0", null, 0);
}?>
<?php if ($_smarty_tpl->tpl_vars['item']->value['data']['id_leader']!='') {?>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="width: 5%; text-align: center;">1</td>
<td colspan="2"><p><?php echo $_smarty_tpl->tpl_vars['item']->value['object']['name']['name'];?>
</p></td>
<td><textarea name="object_value_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
]"><?php if (isset($_smarty_tpl->tpl_vars['item']->value['object']['value']['value_object'])) {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['object']['value']['value_object'];
}?></textarea></td>
<td>
  <p><?php echo $_smarty_tpl->tpl_vars['item']->value['tag_1']['name'];?>
</p>
  <p><?php if ($_smarty_tpl->tpl_vars['item']->value['tag_2']['name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['tag_2']['name'];
}?> </p>
  <p><?php if ($_smarty_tpl->tpl_vars['item']->value['tag_3']['name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['tag_3']['name'];
}?> </p>
</td>

<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bRecommendationDeleteEnabled']->value) {?><td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=recommendation_delete&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/delete.png" alt="Удалить" /></a></td><?php }?>
</tr>
<?php } else { ?>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="width: 5%; text-align: center;">1</td>
<td colspan="2">

  <input class="search_link_3" id="object_tag_old_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
_tag" type="text" name="leader_object_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" />
  <input class="search_link_3" id="object_tag_old_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" placeholder="наименование объекта" autocomplete="off" />

</td>
<td><textarea rows="7" placeholder="значение объекта" name="recommendation_comment_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]"><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_comment'];?>
</textarea></td>
<td>
  <br>
    <input class="search_link_4" id="tag_old_1_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
_tag" type="text" name="leader_tag_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
][1]" />
    <input class="search_link_4" id="tag_old_1_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" placeholder="наименование тега" autocomplete="off" />

    <input class="search_link_4" id="tag_old_2_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
_tag" type="text" name="leader_tag_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
][2]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" />
    <input class="search_link_4" id="tag_old_2_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" placeholder="наименование тега" autocomplete="off" />

    <input class="search_link_4" id="tag_old_3_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
_tag" type="text" name="leader_tag_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
][3]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" />
    <input class="search_link_4" id="tag_old_3_<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" placeholder="наименование тега" autocomplete="off" />

    <input class="search_link_4" id="tag_old_4_<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
_tag" type="text" name="leader_tag_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
][4]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" />
    <input class="search_link_4" id="tag_old_4_<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" placeholder="наименование тега" autocomplete="off" />

    <input class="search_link_4" id="tag_old_5_<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
_tag" type="text" name="leader_tag_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
][5]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" />
    <input class="search_link_4" id="tag_old_5_<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" placeholder="наименование тега" autocomplete="off" />

    <br>
    <br>
</td>

<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bRecommendationDeleteEnabled']->value) {?><td rowspan="6"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=recommendation_delete&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/delete.png" alt="Удалить" /></a></td><?php }?>
</tr>
<?php }?>
<?php } ?>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['for'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['for']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['name'] = 'for';
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==0) {
$_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("1", null, 0);
} else {
$_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("0", null, 0);
}?>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="width: 5%; text-align: center;">1</td>
<td colspan="2">

  <input class="search_link_3" id="object_tag_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
_tag" type="text" name="leader_object_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" />
  <input class="search_link_3" id="object_tag_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" type="text" placeholder="наименование объекта" autocomplete="off" />

</td>
<td><textarea placeholder="значение объекта" rows="7" name="object_value_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]"></textarea></td>
<td>
  <br>
  <input class="search_link_4" id="tag_new_1_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
_tag" type="text" name="leader_tag_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
][1]" />
  <input class="search_link_4" id="tag_new_1_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" type="text" placeholder="наименование тега" autocomplete="off" />

  <input class="search_link_4" id="tag_new_2_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
_tag" type="text" name="leader_tag_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
][2]" />
  <input class="search_link_4" id="tag_new_2_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" type="text" placeholder="наименование тега" autocomplete="off" />

  <input class="search_link_4" id="tag_new_3_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
_tag" type="text" name="leader_tag_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
][3]" />
  <input class="search_link_4" id="tag_new_3_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" type="text" placeholder="наименование тега" autocomplete="off" />

  <input class="search_link_4" id="tag_new_4_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
_tag" type="text" name="leader_tag_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
][4]" />
  <input class="search_link_4" id="tag_new_4_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" type="text" placeholder="наименование тега" autocomplete="off" />

  <input class="search_link_4" id="tag_new_5_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
_tag" type="text" name="leader_tag_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
][5]" />
  <input class="search_link_4" id="tag_new_5_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" type="text" placeholder="наименование тега" autocomplete="off" />
  <br>
  <br>
</td>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'],$_smarty_tpl->tpl_vars['aRecommendations']->value)&&$_smarty_tpl->tpl_vars['bRecommendationDeleteEnabled']->value) {?><td rowspan="6"></td><?php }?>
</tr>
<?php endfor; endif; ?>

</tbody>
</table>
<?php }?>




<!-- Конец блока тегов -->





<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])) {?>
<div class="options_add" for="leaders">Рекомендации (входящие: <?php echo $_smarty_tpl->tpl_vars['aContentData']->value['recommendations_to_count_all'];?>
 (<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['recommendations_to_count_for_interview'];?>
), исходящие: <?php if (isset($_smarty_tpl->tpl_vars['aRecommendations']->value)) {
echo count($_smarty_tpl->tpl_vars['aRecommendations']->value);
} else { ?>0<?php }?>)</div>
<table class="base_table leaders">
<tbody>
<tr>
<th style="width: 40%;" colspan="3"><strong>Рекомендуемый лидер</strong></th>
<th style="width: 40%;"><strong>Причина рекомендации <div class="info white"><span>Почему Вы его рекомендуете, как ЛИСС? Какие проблемы он решает? Почему Вы думаете, что он действительно решает социальные проблемы? Насколько Вы ему доверяете как человеку и как профессионалу?</span></div></strong></th>
<th><strong>Комментарий</strong></th>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'],$_smarty_tpl->tpl_vars['aRecommendations']->value)&&$_smarty_tpl->tpl_vars['bRecommendationDeleteEnabled']->value) {?><th class="small"></th><?php }?>
</tr>
<?php $_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("0", null, 0);?>

<?php if (isset($_smarty_tpl->tpl_vars['aRecommendations']->value)) {?>
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
<td style="text-align: left;">Лидер</td>
<td colspan="2"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_id_to'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_patronymic']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_patronymic'];
}
}
if ($_smarty_tpl->tpl_vars['item']->value['project_name']!='') {?> (<?php echo $_smarty_tpl->tpl_vars['item']->value['project_name'];?>
)<?php }?></a></td>
<td><textarea name="recommendation_reason_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]"><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_reason'];?>
</textarea></td>
<td><textarea name="recommendation_comment_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]"><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_comment'];?>
</textarea></td>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bRecommendationDeleteEnabled']->value) {?><td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=recommendation_delete&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/delete.png" alt="Удалить" /></a></td><?php }?>
</tr>
<?php } else { ?>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;" rowspan="2">ФИО <div class="info"><span>ФИО или id лидера ЛИСС</span></div></td>
<td><input class="search_link_2" id="recommendation_old_<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
" type="text" name="leader_surname_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" placeholder="фамилия или id" autocomplete="off" /></td>
<td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=create_from_recommendation&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
" target="_blank" onclick="return confirm('Вы уверены, что хотите создать лидера?');">создать</a></td>
<td rowspan="6"><textarea name="recommendation_reason_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]" rows="12"><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_reason'];?>
</textarea></td>
<td rowspan="6"><textarea name="recommendation_comment_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]" rows="12"><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_comment'];?>
</textarea></td>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])&&$_smarty_tpl->tpl_vars['bRecommendationDeleteEnabled']->value) {?><td rowspan="6"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=recommendation_delete&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/delete.png" alt="Удалить" /></a></td><?php }?>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td><input type="text" name="leader_name_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];?>
" placeholder="имя" /></td>
<td><input type="text" name="leader_patronymic_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_patronymic'];?>
" placeholder="отчество" /></td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">Проект</td>
<td colspan="2"><input type="text" name="leader_project_name_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_name'];?>
" /></td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">Город</td>
<td style="text-align: left;"><?php if (isset($_smarty_tpl->tpl_vars['aCities']->value)) {?><select name="city_id_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]"><option></option><?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['i']->value['city_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['city_id']==$_smarty_tpl->tpl_vars['i']->value['city_id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value['city_name'];?>
</option><?php } ?></select><?php }?></td>
<td><input type="text" name="leader_city_name_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['recommendation_id'];?>
]" placeholder="другой город" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_city_name'];?>
" /></td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">Телефон</td>
<td colspan="2"><input type="text" name="leader_phone_old[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_phone'];?>
" /></td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">E-mail</td>
<td colspan="2"><input type="text" name="leader_email_old[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_email'];?>
" /></td>
</tr>
<?php }?>
<?php } ?>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['for'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['for']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['name'] = 'for';
$_smarty_tpl->tpl_vars['smarty']->value['section']['for']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==0) {
$_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("1", null, 0);
} else {
$_smarty_tpl->tpl_vars["iTemp"] = new Smarty_variable("0", null, 0);
}?>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left" rowspan="2">ФИО <div class="info"><span>ФИО или id лидера ЛИСС</span></div></td>
<td><input class="search_link_2" id="recommendation_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" type="text" name="leader_surname_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" placeholder="фамилия или id" autocomplete="off" /></td>
<td></td>
<td rowspan="6"><textarea name="recommendation_reason_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" rows="12"></textarea></td>
<td rowspan="6"><textarea name="recommendation_comment_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" rows="12"></textarea></td>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'],$_smarty_tpl->tpl_vars['aRecommendations']->value)&&$_smarty_tpl->tpl_vars['bRecommendationDeleteEnabled']->value) {?><td rowspan="6"></td><?php }?>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td><input type="text" name="leader_name_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" placeholder="имя" /></td>
<td><input type="text" name="leader_patronymic_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" placeholder="отчество" /></td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">Проект</td>
<td colspan="2"><input type="text" name="leader_project_name_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" /></td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">Город</td>
<td style="text-align: left;"><?php if (isset($_smarty_tpl->tpl_vars['aCities']->value)) {?><select name="city_id_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['city_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['city_name'];?>
</option><?php } ?></select><?php }?></td>
<td><input type="text" name="leader_city_name_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" placeholder="другой город" /></td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">Телефон</td>
<td colspan="2"><input type="text" name="leader_phone_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" /></td>
</tr>
<tr<?php if ($_smarty_tpl->tpl_vars['iTemp']->value==1) {?> class="odd"<?php }?>>
<td style="text-align: left;">E-mail</td>
<td colspan="2"><input type="text" name="leader_email_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" /></td>
</tr>
<?php endfor; endif; ?>
</tbody>
</table>
<?php }?>

<table class="wrap_sub">
<tr>
<td></td>
<td><input style="position: fixed;bottom: 24px;left: 77px;" type="submit" value="Сохранить"/></td>
</tr>
</table>

</form>

<p>Поля отмеченные * обязательны для заполнения.</p>

<?php echo '<script'; ?>
 type="text/javascript">fixTableFio();<?php echo '</script'; ?>
><?php }} ?>
