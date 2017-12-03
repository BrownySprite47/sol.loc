<div class="sub_links">
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=regions&action_name=view">создать регион</a>
</div>

<div class="bread_crumbs"><p>Регионы / список регионов</p></div>

{if isset($aContentList)}
<table class="base_table">
<tr>
<th><strong>Регион</strong></th>
<th><strong>Количество городов</strong></th>
<th colspan="2" class="small"></th>
</tr>

{foreach from=$aContentList item=item}
<tr{cycle name="content_list" values=' class="odd",'}>
<td>{$item.region_name}</td>
<td>{$item.cities_count}</td>
<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=regions&action_name=view&content_id={$item.region_id}"><img src="{#PROJECT_BACKEND_URL#}images/edit.png" alt="Редактировать" /></a></td>
<td>{if $item.cities_count eq 0}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=regions&action_name=delete&content_id={$item.region_id}" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a>{/if}</td>
</tr>
{/foreach}

</table>
{else}
<p>Пока регионов не создано.</p>
{/if}