<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-12-05 12:47:23
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_cities_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:84635a266b2bd85325-07411009%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5a18a03a2ccbd6628936994465d3a4171237b0c' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_cities_list.tpl',
      1 => 1507819626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84635a266b2bd85325-07411009',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aContentList' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a266b2be32e40_74588701',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a266b2be32e40_74588701')) {function content_5a266b2be32e40_74588701($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="sub_links">
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=cities&action_name=view">создать город</a>
</div>

<div class="bread_crumbs"><p>Города / список городов</p></div>

<?php if (isset($_smarty_tpl->tpl_vars['aContentList']->value)) {?>
<table class="base_table">
<tr>
<th><strong>Id</strong></th>
<th><strong>Город</strong></th>
<th><strong>Регион</strong></th>
<th><strong>Количество лидеров ЛИСС</strong></th>
<th><strong>Количество проектов ЛИСС</strong></th>
<th><strong>Количество рекомендаций лидеров ЛИСС</strong></th>
<th colspan="2" class="small"></th>
</tr>

<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aContentList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['city_id'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['city_name'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['region_name'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['leaders_count'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['projects_count'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['recommendations_count'];?>
</td>
<td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=cities&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['city_id'];?>
"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/edit.png" alt="Редактировать" /></a></td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['leaders_count']==0&&$_smarty_tpl->tpl_vars['item']->value['projects_count']==0&&$_smarty_tpl->tpl_vars['item']->value['recommendations_count']==0) {?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=cities&action_name=delete&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['city_id'];?>
" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/delete.png" alt="Удалить" /></a><?php }?></td>
</tr>
<?php } ?>

</table>
<?php } else { ?>
<p>Пока городов не создано.</p>
<?php }?><?php }} ?>
