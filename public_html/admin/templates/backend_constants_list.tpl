<div class="bread_crumbs"><p>Настройки / список групп настроек</p></div>

{if isset($aContentList)}
<table class="base_table">
<tr>
<th><strong>Группа настроек</strong></th>
<th><strong>Количество настроек</strong></th>
<th class="small"></th>
</tr>

{foreach from=$aContentList item=item}
<tr{cycle name="content_list" values=' class="odd",'}>
<td>{$item.constant_type_name}</td>
<td>{$item.constants_count}</td>
<td class="small"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=constants&action_name=view&constant_type_id={$item.constant_type_id}"><img src="{#PROJECT_BACKEND_URL#}images/edit.png" alt="Редактировать" /></a></td>
</tr>
{/foreach}

</table>
{else}
<p>Настроек нет.</p>
{/if}