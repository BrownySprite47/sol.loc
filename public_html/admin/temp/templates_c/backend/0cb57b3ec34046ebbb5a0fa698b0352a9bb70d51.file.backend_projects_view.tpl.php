<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-30 13:50:36
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_projects_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:235525a1fbf7c42fce5-09511732%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cb57b3ec34046ebbb5a0fa698b0352a9bb70d51' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_projects_view.tpl',
      1 => 1512039034,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235525a1fbf7c42fce5-09511732',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1fbf7cb9f199_24980816',
  'variables' => 
  array (
    'aContentData' => 0,
    'bProjectsEdit' => 0,
    'aContentDataErrors' => 0,
    'aBackendUsers' => 0,
    'aContentDataDefault' => 0,
    'sProjectCreateDateRecommend' => 0,
    'item' => 0,
    'iBackendUserId' => 0,
    'aOptions' => 0,
    'aCities' => 0,
    'aLeaders' => 0,
    'bLeaderProjectDeleteEnabled' => 0,
    'iLeaderOrderMax' => 0,
    'aFilials' => 0,
    'bFilialDeleteEnabled' => 0,
    'iFilialOrderMax' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1fbf7cb9f199_24980816')) {function content_5a1fbf7cb9f199_24980816($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
if (!is_callable('smarty_modifier_date_format')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\modifier.date_format.php';
?><div class="sub_links">
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])&&$_smarty_tpl->tpl_vars['bProjectsEdit']->value) {?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=view">создать проект ЛИСС</a> | <?php }?>
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list">список проектов ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Проекты ЛИСС / <?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])) {?>редактирование<?php } else { ?>создание<?php }?></p></div>

<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['transaction_id'])) {?>
<p class="error_text_header">Данные не могу быть сохранены, так как произошло их изменение. Обновите страницу.</p>
<?php } else { ?>
<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value)&&!empty($_smarty_tpl->tpl_vars['aContentDataErrors']->value)) {?>
<p class="error_text_header">Обратите внимание, что данные не сохранены.</p>
<?php }?>
<?php }?>

<form id="form_projects" action="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=edit<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])) {?>&content_id=<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_id'];
}?>" method="post">

<input type="hidden" name="transaction_id" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['leader_id'])) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['transaction_id'];
}?>">

<div class="options_add open" for="block_01">Общая информация</div>
<table class="form_table block_01">
<tbody>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Id проекта ЛИСС</td>
<td colspan="2"><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_id'];?>
</td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата и время создания</td>
<td colspan="2"><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_create_datetime'];?>
</td>
</tr>
<?php if ($_smarty_tpl->tpl_vars['aContentData']->value['transaction_create_datetime']!='') {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата и время последнего изменения</td>
<td colspan="2"><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['transaction_create_datetime'];?>
</td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['project_create_backend_user_id']])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Инициатор</td>
<td colspan="2"><?php echo $_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['project_create_backend_user_id']]["backend_user_name"];?>
</td>
</tr>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['aContentData']->value['transaction_backend_user_id']!=''&&isset($_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['transaction_backend_user_id']])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Автор последнего изменения данных</td>
<td colspan="2"><?php echo $_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['transaction_backend_user_id']]["backend_user_name"];?>
</td>
</tr>
<?php }?>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата интервью <div class="info"><span>Формат: YYYY-MM-DD</span></div></td>
<td colspan="2"><input type="text" name="project_interview_date" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_interview_date'];
} else {
if (isset($_smarty_tpl->tpl_vars['aContentDataDefault']->value)) {
echo $_smarty_tpl->tpl_vars['aContentDataDefault']->value['project_interview_date'];
} else {
echo smarty_modifier_date_format(time(),"%Y-%m-%d");
}
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_interview_date'])) {?> error<?php }?>" id="project_interview_date" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_interview_date'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_interview_date'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата появления в БД <div class="info"><span>Формат: YYYY-MM-DD</span></div></td>
<td colspan="2"><input type="text" name="project_create_date" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_create_date'];
} else {
if (isset($_smarty_tpl->tpl_vars['aContentDataDefault']->value)) {
echo $_smarty_tpl->tpl_vars['aContentDataDefault']->value['project_create_date'];
} else {
echo $_smarty_tpl->tpl_vars['sProjectCreateDateRecommend']->value;
}
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_create_date'])) {?> error<?php }?>" id="project_create_date" /> рекомендуемая дата: <a href="#" onclick="$('#project_create_date').val('<?php echo $_smarty_tpl->tpl_vars['sProjectCreateDateRecommend']->value;?>
'); return false;"><?php echo $_smarty_tpl->tpl_vars['sProjectCreateDateRecommend']->value;?>
</a><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_create_date'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_create_date'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Интервьюируемый <div class="info"><span>ФИО или id лидера ЛИСС</span></div></td>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])&&$_smarty_tpl->tpl_vars['aContentData']->value['leader_id']!='') {?>
<td style="width: 20%;"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_surname'];
if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_name'];
if ($_smarty_tpl->tpl_vars['aContentData']->value['leader_patronymic']!='') {?> <?php echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_patronymic'];
}
}
if ($_smarty_tpl->tpl_vars['aContentData']->value['project_name_1']!='') {?> (<?php echo $_smarty_tpl->tpl_vars['aContentData']->value['project_name_1'];?>
)<?php }?></a></td>
<?php }?>
<td<?php if (!isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])||$_smarty_tpl->tpl_vars['aContentData']->value['leader_id']=='') {?> colspan="2"<?php }?>><input class="search_link_2" id="leader_name" autocomplete="off" type="text" name="leader_name"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {?> value="<?php if (!isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])||$_smarty_tpl->tpl_vars['aContentData']->value['leader_id']=='') {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_name'];
} else {
echo $_smarty_tpl->tpl_vars['aContentData']->value['leader_id'];
}?>"<?php } else {
if (isset($_smarty_tpl->tpl_vars['aContentDataDefault']->value)) {?> value="<?php echo $_smarty_tpl->tpl_vars['aContentDataDefault']->value['leader_id'];?>
"<?php }
}?> placeholder="ФИО или id" /></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aBackendUsers']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Интервьюер</td>
<td colspan="2"><select name="project_interview_backend_user_id"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aBackendUsers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_id'];?>
"<?php if ((isset($_smarty_tpl->tpl_vars['aContentData']->value['project_interview_backend_user_id'],$_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['project_interview_backend_user_id']])&&$_smarty_tpl->tpl_vars['aContentData']->value['project_interview_backend_user_id']==$_smarty_tpl->tpl_vars['item']->value['backend_user_id'])||(isset($_smarty_tpl->tpl_vars['aContentDataDefault']->value['project_interview_backend_user_id'],$_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentDataDefault']->value['project_interview_backend_user_id']])&&$_smarty_tpl->tpl_vars['aContentDataDefault']->value['project_interview_backend_user_id']==$_smarty_tpl->tpl_vars['item']->value['backend_user_id'])||(!isset($_smarty_tpl->tpl_vars['aContentData']->value['project_interview_backend_user_id'])&&!isset($_smarty_tpl->tpl_vars['aContentDataDefault']->value['project_interview_backend_user_id'])&&$_smarty_tpl->tpl_vars['iBackendUserId']->value==$_smarty_tpl->tpl_vars['item']->value['backend_user_id'])) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_name'];?>
</option><?php } ?></select></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Кто заполняет анкету</td>
<td colspan="2"><select name="project_write_backend_user_id"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aBackendUsers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_id'];?>
"<?php if ((isset($_smarty_tpl->tpl_vars['aContentData']->value['project_write_backend_user_id'],$_smarty_tpl->tpl_vars['aBackendUsers']->value[$_smarty_tpl->tpl_vars['aContentData']->value['project_write_backend_user_id']])&&$_smarty_tpl->tpl_vars['aContentData']->value['project_write_backend_user_id']==$_smarty_tpl->tpl_vars['item']->value['backend_user_id'])||(!isset($_smarty_tpl->tpl_vars['aContentData']->value['project_write_backend_user_id'])&&$_smarty_tpl->tpl_vars['iBackendUserId']->value==$_smarty_tpl->tpl_vars['item']->value['backend_user_id'])) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['backend_user_name'];?>
</option><?php } ?></select></td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_01",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Статус анкеты</td>
<td colspan="2">
<input id="project_enabled" type="checkbox" name="project_enabled"<?php if (!isset($_smarty_tpl->tpl_vars['aContentData']->value)||$_smarty_tpl->tpl_vars['aContentData']->value['project_enabled']==1) {?> checked<?php }?> /> <label for="project_enabled">анкета актуальна</label>
<input id="project_done" type="checkbox" name="project_done"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_done']==1) {?> checked<?php }?> /> <label for="project_done">анкета заполнена</label>
</td>
</tr>
</tbody>
</table>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])&&$_smarty_tpl->tpl_vars['bProjectsEdit']->value) {?>
<div class="options_add" for="block_02" id="header-fixed-fio"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_name'];
}?></div>
<!-- <div class="options_add foxFix" for="block_02"><div>Личная информация</div></div> -->
<?php }?>

<div class="options_add foxFix" for="block_02"><div>Общие данные о проекте</div></div>
<table class="form_table block_02">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Название проекта * <div class="info"><span>Название, которое дали проекту авторы</span></div></td>
<td><input type="text" name="project_name" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_name'];
}?>"<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_name'])) {?> class="error"<?php }?> /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_name'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_name'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Краткое название <div class="info"><span>Короткое название для быстрого поиска в базе. Оно же будет использоваться в визуализации (не больше 30 символов)</span></div></td>
<td><input type="text" name="project_name_small" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_name_small'];
}?>" /></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Название для карты <div class="info"><span>Не более 12 символов</span></div></td>
<td><input type="text" name="project_name_code" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_name_code'];
}?>"<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_name_code'])) {?> class="error"<?php }?> /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_name_code'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_name_code'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Суть проекта <div class="info"><span>Краткое описание проекта (5-6 строк), публичная версия</span></div></td>
<td><textarea name="project_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_text'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_02",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Основной сайт</td>
<td><input type="text" name="project_site" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_site'];
}?>" /></td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_03">Описание проекта</div>
<table class="form_table block_03">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Какую проблему решает проект <div class="info"><span>Сформулировать в виде проблемы, а не цели</span></div></td>
<td><textarea name="project_question_01"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_01'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Для кого ваш проект? <div class="info"><span>Бенефициар(ы)</span></div></td>
<td><textarea name="project_question_02"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_02'];
}?></textarea></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[5])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Сфера <div class="info"><span>Одна или несколько областей социальной сферы, в которых действует проект. Только значимые направления деятельности проекта</span></div></td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[5]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<div class="wrap_input">
<input id="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="checkbox" name="options[5][]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['option_selected']==1) {?> checked<?php }?> />
<label for="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?>
<input type="text" name="project_area" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_area'];
}?>" placeholder="другие сферы" />
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
?>
<div class="wrap_input">
<input id="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="checkbox" name="options[6][]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['option_selected']==1) {?> checked<?php }?> />
<label for="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?>
</td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[7])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_03",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Среда реализации <div class="info"><span>Среда реализации, то есть то, где реализуется деятельность</span></div></td>
<td><select name="project_question_03"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[7]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_question_03']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</option><?php } ?></select>
</td>
</tr>
<?php }?>
</tbody>
</table>

<div class="options_add" for="block_04">Проблематизация</div>
<table class="form_table block_04">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>На основании чего Вы сделали вывод, что проблема существует? <div class="info"><span>Статистика, исследования в России и зарубежом</span></div></td>
<td><textarea name="project_question_04"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_04'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Деятельность проекта <div class="info"><span>Описание проекта</span></div></td>
<td><textarea name="project_question_05"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_05'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Прямой эффект <div class="info"><span>Что должно стать результатом проекта? Как Вы поймете, что достигли результата? Как масштабируется проект?</span></div></td>
<td><textarea name="project_question_06"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_06'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Косвенный эффект <div class="info"><span>Видите ли Вы какие-то непрямые эффекты, то есть эффекты на целевых группах, которые не в прямом фокусе проекта? Например?</span></div></td>
<td><textarea name="project_question_07"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_07'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Как Вы оцениваете свою эффективность? <div class="info"><span>Как оценивается эффективность деятельности? Какие методики используются?</span></div></td>
<td><textarea name="project_question_45"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_45'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Как проблема решается сегодня? <div class="info"><span>Кто ещё решает эту проблему, как она решается сегодня? Что Вы делаете иначе? (содержание/форма/процессы/инфраструктура)</span></div></td>
<td><textarea name="project_question_08"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_08'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Какие ресурсы Вы используете <div class="info"><span>Источники финансирования, партнеры (как помогают), волонтёры, платформы... - описание общими словами. Какие ресурсы гос./негос. поддержки Вы знаете/используете, какие из них реально работают?</span></div></td>
<td><textarea name="project_question_10"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_10'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Какую ценность вы создаёте для тех, кто вам помогает? <div class="info"><span>Что Вашим партнёрам, волонтёрам, спонсорам... даёт участие в вашей деятельности? Как Вы их мотивируете?</span></div></td>
<td><textarea name="project_question_09"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_09'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Кто в Вашей команде? Как Вы их мотивируете? <div class="info"><span>Как Вы подбираете собтрудников? Как Вы их мотивируете? Что станет с проектом если Вы перестанете им заниматься?</span></div></td>
<td><textarea name="project_question_46"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_46'];
}?></textarea></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Комментарий по проекту <div class="info"><span>Неформальные комментарии на тему проекта</span></div></td>
<td><textarea name="project_question_11"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_11'];
}?></textarea></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[2])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_04",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Уровень воздействия <div class="info"><span>Этот показатель оценивает уровень воздействия проекта</span></div></td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[2]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<div class="wrap_input">
<input id="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="radio" name="project_question_12" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_question_12']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> checked<?php }?> />
<label for="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?></td>
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
<td>Инновационность <div class="info"><span>Под инновациями мы понимаем проекты, нацеленные на изменение привычных социальных моделей</span></div></td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[8]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<input id="option_value_13_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="radio" name="project_question_13" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_question_13']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> checked<?php }?> /> <label for="option_value_13_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Новое содержание <div class="info"><span>Новая предметная область, новая отрасль, новые знания</span></div></td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[8]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<input id="option_value_14_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="radio" name="project_question_14" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_question_14']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> checked<?php }?> /> <label for="option_value_14_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Новая форма представления <div class="info"><span>Переход от традиционных форм (урок-лекция, урок-задание, книги) к новым, например, игры, мультфильмы, интерактивные уроки, деятельностный подход</span></div></td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[8]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<input id="option_value_15_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="radio" name="project_question_15" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_question_15']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> checked<?php }?> /> <label for="option_value_15_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Новые процессы, роли, форматы <div class="info"><span>Переход от традиционных процессов работы к новым, например, тьюторство, конструктор опыта, развивающее обучение, учи.ру, открытая школа, эдьютейнмент</span></div></td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[8]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<input id="option_value_16_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="radio" name="project_question_16" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_question_16']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> checked<?php }?> /> <label for="option_value_16_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_05",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Новая инфраструктура <div class="info"><span>Создание новых инфраструктурных решений, например, маркетплейс, электронный дневник, образовательный краудфандинг</span></div></td>
<td><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[8]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<input id="option_value_17_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="radio" name="project_question_17" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_question_17']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> checked<?php }?> /> <label for="option_value_17_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?></td>
</tr>
</tbody>
</table>
<?php }?>

<div class="options_add" for="block_06">Организация проекта</div>
<table class="form_table block_06">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Оператор/автор проекта <div class="info"><span>Физическое или юридическое лицо, которое является основным оператором проекта (управляет, распоряжается бюджетом проекта)</span></div></td>
<td colspan="2"><input type="text" name="project_question_43" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_43'];
}?>" /></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aCities']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Местоположение головной компании (город) <div class="info"><span>Основное место жительства. Город или ближайший большой город (столица региона), например для Первоуральска выбирайте Екатеринбург, это нужно для укрупнённой региональной классификации. Если в списке нет, то заполните поле "другой город", для маленьких городов указывайте область</span></div></td>
<td class="small"><select name="city_id"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['city_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['city_id']==$_smarty_tpl->tpl_vars['item']->value['city_id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['city_name'];?>
</option><?php } ?></select></td>
<td><input type="text" name="project_city_name" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_city_name'];
}?>" placeholder="другой город" /></td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата начала деятельности <div class="info"><span>Формат: YYYY-MM-DD. Если неизвестен день, устанавливаем 01, если неизвестен месяц, устанавливаем 07, если неизвестен год, устанавливаем примерный год</span></div></td>
<td colspan="2"><input type="text" name="project_start_date" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_start_date'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_start_date'])) {?> error<?php }?>" id="project_start_date" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_start_date'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_start_date'];
}?></p></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[10])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Организационно-правовая форма оператора проекта <div class="info"><span>Только те варианты, на которые приходится значимая (>20%) часть деятельности (выручки/затрат)</span></div></td>
<td colspan="2"><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[10]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<div class="wrap_input">
<input id="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="checkbox" name="options[10][]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['option_selected']==1) {?> checked<?php }?> />
<label for="option_value_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?>
</td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[11])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Стадия проекта <div class="info"><span>Наиболее подходящий вариант на момент интервью</span></div></td>
<td colspan="2"><select name="project_question_41"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[11]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_question_41']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</option><?php } ?></select>
</td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[12])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_06",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Бизнес модель</td>
<td colspan="2"><select name="project_question_42"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[12]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_question_42']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</option><?php } ?></select>
</td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_08",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Описание бизнес модели</td>
<td colspan="2"><textarea name="project_question_44"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_44'];
}?></textarea></td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_07">Структура затрат</div>
<table class="form_table block_07">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_07",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Благотворительная деятельность <div class="info"><span>Примерное распределение затрат в 2017 г. (оценка). Примерная сумма в миллионах рублей</span></div></td>
<td><input type="text" name="project_question_18" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_18'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_18'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_18'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_18'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_07",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Коммерческая деятельность <div class="info"><span>Примерное распределение затрат в 2017 г. (оценка). Примерная сумма в миллионах рублей</span></div></td>
<td><input type="text" name="project_question_19" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_19'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_19'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_19'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_19'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_07",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Комментарий к структуре затрат <div class="info"><span>Планируются ли существенные изменения?</span></div></td>
<td><textarea name="project_question_32"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_32'];
}?></textarea></td>
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
<td style="text-align: left;">Инвестиции <div class="info"><span>Примерное распределение доходов в 2017 г. (оценка). Примерную сумма в миллионах рублей</span></div></td>
<td><input type="text" name="project_question_20" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_20'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_20'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_20'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_20'];
}?></p></td>
<td><input type="text" name="project_question_21" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_21'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_21'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_21'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_21'];
}?></p></td>
<td><input type="text" name="project_question_22" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_22'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_22'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_22'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_22'];
}?></p></td>
<td><input type="text" name="project_question_23" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_23'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_23'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_23'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_23'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"block_08",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td style="text-align: left;">Выручка <div class="info"><span>Примерное распределение доходов в 2017 г. (оценка). Примерную сумма в миллионах рублей</span></div></td>
<td><input type="text" name="project_question_24" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_24'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_24'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_24'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_24'];
}?></p></td>
<td><input type="text" name="project_question_25" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_25'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_25'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_25'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_25'];
}?></p></td>
<td><input type="text" name="project_question_26" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_26'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_26'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_26'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_26'];
}?></p></td>
<td><input type="text" name="project_question_27" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_27'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_27'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_27'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_27'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"block_08",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td style="text-align: left;">Гранты/спонсорство <div class="info"><span>Примерное распределение доходов в 2017 г. (оценка). Примерную сумма в миллионах рублей</span></div></td>
<td><input type="text" name="project_question_28" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_28'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_28'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_28'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_28'];
}?></p></td>
<td><input type="text" name="project_question_29" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_29'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_29'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_29'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_29'];
}?></p></td>
<td><input type="text" name="project_question_30" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_30'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_30'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_30'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_30'];
}?></p></td>
<td><input type="text" name="project_question_31" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_31'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_31'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_31'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_31'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"block_08",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td style="text-align: left;">Комментарий к структуре доходов <div class="info"><span>Планируются ли существенные изменения?</span></div></td>
<td colspan="4"><textarea name="project_question_33"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_33'];
}?></textarea></td>
</tr>
</table>

<div class="options_add" for="leaders">Лидеры проекта (<?php if (isset($_smarty_tpl->tpl_vars['aLeaders']->value)) {
echo count($_smarty_tpl->tpl_vars['aLeaders']->value);
} else { ?>0<?php }?>)</div>
<table class="base_table leaders">
<tr>
<th colspan="4"><strong>Лидер ЛИСС * <div class="info white"><span>ФИО или id лидера ЛИСС</span></div></strong></th>
<th><strong>Роль лидера в проекте</strong></th>
<th colspan="2" class="small"><strong>Период участия <div class="info white"><span>Примерные даты (от и до) участия лидера в проекте, если известно</span></div></strong></th>
<th class="small"><strong>Сортировка * <div class="info white"><span>Порядковый номер лидера у проекта. Особенно важен выбор первого лидера</span></div></strong></th>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'],$_smarty_tpl->tpl_vars['aLeaders']->value)&&$_smarty_tpl->tpl_vars['bLeaderProjectDeleteEnabled']->value) {?><th class="small"></th><?php }?>
</tr>
<?php $_smarty_tpl->tpl_vars["iLeaderOrderMax"] = new Smarty_variable("0", null, 0);?>
<?php if (isset($_smarty_tpl->tpl_vars['aLeaders']->value)) {?>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aLeaders']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['iLeaderOrderMax']->value<$_smarty_tpl->tpl_vars['item']->value['leader_order']) {
$_smarty_tpl->tpl_vars["iLeaderOrderMax"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['item']->value['leader_order']), null, 0);
}?>
<tr<?php echo smarty_function_cycle(array('name'=>"leaders",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<?php if ($_smarty_tpl->tpl_vars['item']->value['leader_id']=='') {?>
<td><input class="search_link_2" id="leader_project_old_<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
" type="text" name="leader_surname_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];?>
" placeholder="фамилия или id" autocomplete="off" /></td>
<td><input type="text" name="leader_name_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];?>
" placeholder="имя" /></td>
<td><input type="text" name="leader_patronymic_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_patronymic'];?>
" placeholder="отчество" /></td>
<td class="small"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=create&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
" target="_blank" onclick="return confirm('Вы уверены, что хотите создать лидера ЛИСС?');">создать</a></td>
<?php } else { ?>
<td colspan="4"><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_id'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['item']->value['leader_surname'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_name']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_name'];
if ($_smarty_tpl->tpl_vars['item']->value['leader_patronymic']!='') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['leader_patronymic'];
}
}
if ($_smarty_tpl->tpl_vars['item']->value['project_name']!='') {?> (<?php echo $_smarty_tpl->tpl_vars['item']->value['project_name'];?>
)<?php }?></a></td>
<?php }?>
<td><input type="text" name="leader_role_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_role'];?>
" /></td>
<td><input type="text" name="leader_date_from_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" class="small" id="leader_date_from_<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_date_from'];?>
" /></td>
<td><input type="text" name="leader_date_to_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" class="small" id="leader_date_to_<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_date_to'];?>
" /></td>
<td><input type="text" name="leader_order_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
]" class="small" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_order'];?>
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
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])&&$_smarty_tpl->tpl_vars['bLeaderProjectDeleteEnabled']->value) {?><td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=leader_delete&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['leader_project_id'];?>
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
<?php $_smarty_tpl->tpl_vars["iLeaderOrderMax"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['iLeaderOrderMax']->value+1), null, 0);?>
<tr<?php echo smarty_function_cycle(array('name'=>"leaders",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><input class="search_link_2" id="leader_project_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" type="text" name="leader_surname_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]"<?php if (isset($_smarty_tpl->tpl_vars['aContentDataDefault']->value)&&$_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration']==1) {?> value="<?php echo $_smarty_tpl->tpl_vars['aContentDataDefault']->value['leader_id'];?>
"<?php }?> placeholder="фамилия или id" autocomplete="off" /></td>
<td><input type="text" name="leader_name_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" placeholder="имя" /></td>
<td><input type="text" name="leader_patronymic_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" placeholder="отчество" /></td>
<td class="small"></td>
<td><input type="text" name="leader_role_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" /></td>
<td><input type="text" name="leader_date_from_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" class="small" id="leader_date_from_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" /></td>
<td><input type="text" name="leader_date_to_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" class="small" id="leader_date_to_new_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
" /></td>
<td><input type="text" name="leader_order_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" class="small" value="<?php echo $_smarty_tpl->tpl_vars['iLeaderOrderMax']->value;?>
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
></td>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'],$_smarty_tpl->tpl_vars['aLeaders']->value)&&$_smarty_tpl->tpl_vars['bLeaderProjectDeleteEnabled']->value) {?><td></td><?php }?>
</tr>
<?php endfor; endif; ?>
</table>

<div class="options_add" for="block_09">Масштаб проекта и воздействие</div>
<table class="form_table block_09">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td style="width: 40%;">Среднемесячное количество посещений сайта/страницы <div class="info"><span>На основании данных Similarweb</span></div></td>
<td><input type="text" name="project_question_34" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_34'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_34'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_34'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_34'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Среднемесячное количество посещений из России <div class="info"><span>На основании данных Similarweb</span></div></td>
<td><input type="text" name="project_question_35" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_35'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_35'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_35'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_35'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Количество человек в команде <div class="info"><span>Количество человек, включая соратников, амбассадоров, волонтеров</span></div></td>
<td><input type="text" name="project_question_36" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_36'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_36'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_36'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_36'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Членов команды в штате <div class="info"><span>Количество штатных сотрудников</span></div></td>
<td><input type="text" name="project_question_37" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_37'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_37'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_37'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_37'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Общее количество пользователей/потребителей в год <div class="info"><span>Количество человек, которые воспользовались услугами/продуктами проекта</span></div></td>
<td><input type="text" name="project_question_38" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_38'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_38'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_38'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_38'];
}?></p></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Общее количество пользователей/потребителей в год в России <div class="info"><span>Количество человек, которые воспользовались услугами/продуктами проекта из России</span></div></td>
<td><input type="text" name="project_question_39" value="<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_39'];
}?>" class="small<?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_39'])) {?> error<?php }?>" /><p class="error_text"><?php if (isset($_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_39'])) {
echo $_smarty_tpl->tpl_vars['aContentDataErrors']->value['project_question_39'];
}?></p></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOptions']->value[9])) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>География деятельности <div class="info"><span>География деятельности (по факту на текущий момент)</span></div></td>
<td><select name="project_question_40"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOptions']->value[9]["option_value"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)&&$_smarty_tpl->tpl_vars['aContentData']->value['project_question_40']==$_smarty_tpl->tpl_vars['item']->value['option_value_id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</option><?php } ?></select>
</td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data_09",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Комментарий</td>
<td><textarea name="project_question_47"><?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value)) {
echo $_smarty_tpl->tpl_vars['aContentData']->value['project_question_47'];
}?></textarea></td>
</tr>
</tbody>
</table>

<div class="options_add" for="filials">Филиалы (<?php if (isset($_smarty_tpl->tpl_vars['aFilials']->value)) {
echo count($_smarty_tpl->tpl_vars['aFilials']->value);
} else { ?>0<?php }?>)</div>
<table class="base_table filials">
<tr>
<th colspan="2"><strong>Город *</strong></th>
<th style="width: 40%;"><strong>Адрес</strong></th>
<th><strong>Комментарий</strong></th>
<th class="small"><strong>Сортировка *</strong></th>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'],$_smarty_tpl->tpl_vars['aFilials']->value)&&$_smarty_tpl->tpl_vars['bFilialDeleteEnabled']->value) {?><th class="small"></th><?php }?>
</tr>
<?php $_smarty_tpl->tpl_vars["iFilialOrderMax"] = new Smarty_variable("0", null, 0);?>
<?php if (isset($_smarty_tpl->tpl_vars['aFilials']->value)) {?>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aFilials']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['iFilialOrderMax']->value<$_smarty_tpl->tpl_vars['item']->value['filial_order']) {
$_smarty_tpl->tpl_vars["iFilialOrderMax"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['item']->value['filial_order']), null, 0);
}?>
<tr<?php echo smarty_function_cycle(array('name'=>"filials",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td class="small"><?php if (isset($_smarty_tpl->tpl_vars['aCities']->value)) {?><select name="city_id_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['filial_id'];?>
]"><option></option><?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['i']->value['city_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['city_id']==$_smarty_tpl->tpl_vars['i']->value['city_id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value['city_name'];?>
</option><?php } ?></select><?php }?></td>
<td><input type="text" name="filial_city_name_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['filial_id'];?>
]" placeholder="другой город" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['filial_city_name'];?>
" /></td>
<td><textarea name="filial_address_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['filial_id'];?>
]"><?php echo $_smarty_tpl->tpl_vars['item']->value['filial_address'];?>
</textarea></td>
<td><textarea name="filial_comment_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['filial_id'];?>
]"><?php echo $_smarty_tpl->tpl_vars['item']->value['filial_comment'];?>
</textarea></td>
<td><input type="text" name="filial_order_old[<?php echo $_smarty_tpl->tpl_vars['item']->value['filial_id'];?>
]" class="small" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['filial_order'];?>
" /></td>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'])&&$_smarty_tpl->tpl_vars['bFilialDeleteEnabled']->value) {?><td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=filial_delete&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['filial_id'];?>
" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/delete.png" alt="Удалить" /></a></td><?php }?>
</tr>
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
<?php $_smarty_tpl->tpl_vars["iFilialOrderMax"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['iFilialOrderMax']->value+1), null, 0);?>
<tr<?php echo smarty_function_cycle(array('name'=>"filials",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td class="small"><?php if (isset($_smarty_tpl->tpl_vars['aCities']->value)) {?><select name="city_id_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]"><option></option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aCities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['city_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['city_name'];?>
</option><?php } ?></select><?php }?></td>
<td><input type="text" name="filial_city_name_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" placeholder="другой город" /></td>
<td><textarea name="filial_address_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]"></textarea></td>
<td><textarea name="filial_comment_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]"></textarea></td>
<td><input type="text" name="filial_order_new[<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
]" class="small" value="<?php echo $_smarty_tpl->tpl_vars['iFilialOrderMax']->value;?>
" /></td>
<?php if (isset($_smarty_tpl->tpl_vars['aContentData']->value['project_id'],$_smarty_tpl->tpl_vars['aFilials']->value)&&$_smarty_tpl->tpl_vars['bFilialDeleteEnabled']->value) {?><td></td><?php }?>
</tr>
<?php endfor; endif; ?>
</table>


<table class="wrap_sub">
<tr>
<td></td>
<td><input style="position: fixed;bottom: 24px;left: 166px;" type="submit" value="Сохранить"/></td>
</tr>
</table>

</form>

<p>Поля отмеченные * обязательны для заполнения.</p>

<?php echo '<script'; ?>
 type="text/javascript">fixTableFio();<?php echo '</script'; ?>
><?php }} ?>
