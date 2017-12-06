<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-12-05 12:47:05
         compiled from "C:\OSPanel\domains\localhost\sol.loc\public_html\admin\templates\backend_regions_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:303185a266b19122e06-40682091%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4b0cce4bb1317235259d3e9ebdfcc05d8445ae1' => 
    array (
      0 => 'C:\\OSPanel\\domains\\localhost\\sol.loc\\public_html\\admin\\templates\\backend_regions_list.tpl',
      1 => 1507819188,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '303185a266b19122e06-40682091',
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
  'unifunc' => 'content_5a266b19193d44_84781461',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a266b19193d44_84781461')) {function content_5a266b19193d44_84781461($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:/OSPanel/domains/localhost/sol.loc/public_html/admin/libs/Smarty/plugins\\function.cycle.php';
?><div class="sub_links">
<a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=regions&action_name=view">создать регион</a>
</div>

<div class="bread_crumbs"><p>Регионы / список регионов</p></div>

<?php if (isset($_smarty_tpl->tpl_vars['aContentList']->value)) {?>
<table class="base_table">
<tr>
<th><strong>Регион</strong></th>
<th><strong>Количество городов</strong></th>
<th colspan="2" class="small"></th>
</tr>

<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aContentList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
<tr<?php echo smarty_function_cycle(array('name'=>"content_list",'values'=>' class="odd",'),$_smarty_tpl);?>
>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['region_name'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['cities_count'];?>
</td>
<td><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=regions&action_name=view&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['region_id'];?>
"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/edit.png" alt="Редактировать" /></a></td>
<td><?php if ($_smarty_tpl->tpl_vars['item']->value['cities_count']==0) {?><a href="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
index.php?module_name=regions&action_name=delete&content_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['region_id'];?>
" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $_smarty_tpl->getConfigVariable('PROJECT_BACKEND_URL');?>
images/delete.png" alt="Удалить" /></a><?php }?></td>
</tr>
<?php } ?>

</table>
<?php } else { ?>
<p>Пока регионов не создано.</p>
<?php }?><?php }} ?>
