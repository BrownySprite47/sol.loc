<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-25 01:39:05
         compiled from "C:\OSPanel\domains\localhost\leaders\templates\backend_projects_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:309605a189f897fcd22-81249313%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7262ff639cff125bf8a2197aaffff2d97c86d12d' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\leaders\\templates\\backend_projects_list.tpl',
      1 => 1504465005,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '309605a189f897fcd22-81249313',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aSearch' => 0,
    'aOV5' => 0,
    'item' => 0,
    'aOV11' => 0,
    'aOV12' => 0,
    'aOV9' => 0,
    'aContentList' => 0,
    'key' => 0,
    'iCurrentOrder' => 0,
    'i' => 0,
    'iMaxPage' => 0,
    'iCurrentPage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a189f89b3afb7_79470383',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a189f89b3afb7_79470383')) {function content_5a189f89b3afb7_79470383($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:\\OSPanel\\domains\\localhost\\leaders\\libs/Smarty/plugins\\function.cycle.php';
?><div class="sub_links">
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=view">создать проект ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Проекты ЛИСС / список</p></div>

<form action="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list" method="get">
<input type="hidden" name="module_name" value="projects" />
<input type="hidden" name="action_name" value="list" />
<div class="options_add open" for="search">Поиск</div>
<table class="form_table search">
<tbody>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Дата создания проекта</td>
<td>с <input type="text" name="date_from" value="<?php echo $_smarty_tpl->tpl_vars['aSearch']->value['date_from'];?>
" class="small" id="date_from" /> по <input type="text" name="date_to" value="<?php echo $_smarty_tpl->tpl_vars['aSearch']->value['date_to'];?>
" class="small" id="date_to" /></td>
</tr>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Поиск <div class="info"><span>Поиск по id, названию, городу. Поиск по вхождению фразы. Фраза не менее трех символов.</span></div></td>
<td><input type="text" name="search_text" value="<?php echo $_smarty_tpl->tpl_vars['aSearch']->value['search_text'];?>
" /></td>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['aOV5']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Сфера деятельности</td>
<td>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOV5']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<div class="wrap_input">
<input id="ov_5_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="checkbox" name="ov_5[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['option_value_checked']==1) {?> checked="checked"<?php }?> />
<label for="ov_5_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?>
<div class="wrap_input">
<input id="project_area_enabled" type="checkbox" name="project_area_enabled" value="1"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['project_area_enabled']==1) {?> checked="checked"<?php }?> />
<label for="project_area_enabled">другое</label>
</div>
</td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOV11']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Стадия проекта</td>
<td>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOV11']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<div class="wrap_input">
<input id="ov_11_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="checkbox" name="ov_11[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['option_value_checked']==1) {?> checked="checked"<?php }?> />
<label for="ov_11_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?>
</td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOV12']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Бизнес-модель</td>
<td>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOV12']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<div class="wrap_input">
<input id="ov_12_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="checkbox" name="ov_12[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['option_value_checked']==1) {?> checked="checked"<?php }?> />
<label for="ov_12_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
</div>
<?php } ?>
</td>
</tr>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['aOV9']->value)) {?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>География деятельности</td>
<td>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOV9']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<input id="ov_9_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
" type="checkbox" name="ov_9[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['option_value_checked']==1) {?> checked="checked"<?php }?> /> <label for="ov_9_<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['option_value'];?>
</label>
<?php } ?>
</td>
</tr>
<?php }?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_data",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td>Актуальность</td>
<td>
<input id="project_enabled_type_1" type="radio" name="project_enabled_type_id" value="1"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['project_enabled_type_id']=="1") {?> checked="checked"<?php }?> /> <label for="project_enabled_type_1">все</label>
<input id="project_enabled_type_2" type="radio" name="project_enabled_type_id" value="2"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['project_enabled_type_id']=="2") {?> checked="checked"<?php }?> /> <label for="project_enabled_type_2">только актуальные</label>
<input id="project_enabled_type_3" type="radio" name="project_enabled_type_id" value="3"<?php if ($_smarty_tpl->tpl_vars['aSearch']->value['project_enabled_type_id']=="3") {?> checked="checked"<?php }?> /> <label for="project_enabled_type_3">только не актуальные</label>
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
if (isset($_smarty_tpl->tpl_vars['aOV5']->value)) {
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOV5']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['option_value_checked']==1) {?>&ov_5[]=<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];
}
}
}
if (isset($_smarty_tpl->tpl_vars['aOV11']->value)) {
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOV11']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['option_value_checked']==1) {?>&ov_11[]=<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];
}
}
}
if (isset($_smarty_tpl->tpl_vars['aOV12']->value)) {
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOV12']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['option_value_checked']==1) {?>&ov_12[]=<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];
}
}
}
if (isset($_smarty_tpl->tpl_vars['aOV9']->value)) {
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aOV9']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
if ($_smarty_tpl->tpl_vars['item']->value['option_value_checked']==1) {?>&ov_9[]=<?php echo $_smarty_tpl->tpl_vars['item']->value['option_value_id'];
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
<th class="order small"><strong>Id</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==1) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=1<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==2) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=2<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th class="order"><strong>Проект</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==3) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=3<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==4) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=4<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th class="order"><strong>Город</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==5) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=5<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==6) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=6<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th class="order"><strong>Сфера деятельности</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==15) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=15<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==16) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=16<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th class="order"><strong>Стадия</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==9) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=9<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==10) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=10<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th class="order"><strong>Модель</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==11) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=11<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==12) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=12<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th class="order"><strong>Лидеры</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==13) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=13<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==14) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=14<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th class="order"><strong>Интервьюер</strong>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==7) {?><span class="order_asc"></span><?php } else { ?><a class="order_asc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=7<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['iCurrentOrder']->value==8) {?><span class="order_desc"></span><?php } else { ?><a class="order_desc" href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=list&order=8<?php echo Smarty::$_smarty_vars['capture']['search_url'];?>
"></a><?php }?>
</th>
<th><strong>Сайт</strong></th>
<th class="small"><strong>✓</strong></th>
</tr>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aContentList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['project_id'];?>
</td>
<td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=projects&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['project_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['project_name_small_show'];?>
</a></td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['city_name_show'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['project_option_5'];
if ($_smarty_tpl->tpl_vars['item']->value['project_area']!='') {
if ($_smarty_tpl->tpl_vars['item']->value['project_option_5']!='') {?>, <?php }
echo $_smarty_tpl->tpl_vars['item']->value['project_area'];
}?></td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['project_option_11'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['project_option_12'];?>
</td>
<td><?php if (isset($_smarty_tpl->tpl_vars['item']->value['leaders'])&&!empty($_smarty_tpl->tpl_vars['item']->value['leaders'])) {
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['leaders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
if ($_smarty_tpl->tpl_vars['i']->value['leader_id']==0) {
echo $_smarty_tpl->tpl_vars['i']->value['leader_name'];
} else { ?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=leaders&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['i']->value['leader_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['leader_name'];?>
</a><?php }?><br/><?php }
}?></td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['project_interview_backend_user_name'];?>
</td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['project_site_enabled']==1) {?><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['project_site'];?>
" target="_blank">link</a><?php } else {
echo $_smarty_tpl->tpl_vars['item']->value['project_site'];
}?></td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['project_enabled']==1) {?>+<?php } else { ?>-<?php }?></td>
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
index.php?module_name=projects&action_name=list<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration']!=1) {?>&page=<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];
}?>&order=<?php echo $_smarty_tpl->tpl_vars['iCurrentOrder']->value;
echo Smarty::$_smarty_vars['capture']['search_url'];?>
"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['for']['iteration'];?>
</a>
<?php }?>
<?php endfor; endif; ?>
</p>
<?php }?>

<?php } else { ?>
<p>По вашему запросу проекты ЛИСС не найдены.</p>
<?php }?><?php }} ?>
