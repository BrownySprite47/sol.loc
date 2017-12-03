<div class="sub_links">
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=constants&action_name=list">список настроек</a>
</div>

<div class="bread_crumbs"><p>Настройка / редактирование настроек</p></div>

<form id="form_constants" action="{#PROJECT_BACKEND_URL#}index.php?module_name=constants&action_name=edit&constant_type_id={$aContentList[0]["constant_type_id"]}" method="post" method="post">
<table class="form_table">
<tbody>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Группа настроек</td>
<td>{$aContentList[0]["constant_type_name"]}</td>
</tr>
{foreach from=$aContentList item=item}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>{$item.constant_name}{if $item.constant_text ne ""} <div class="info"><span>{$item.constant_text}</span></div>{/if}</td>
<td><textarea name="constant_values[{$item.constant_id}]">{$item.constant_value}</textarea></td>
</tr>
{/foreach}
</tbody>
</table>

<table class="wrap_sub">
<tr>
<td></td>
<td><input type="submit" value="Сохранить"/></td>
</tr>
</table>

</form>