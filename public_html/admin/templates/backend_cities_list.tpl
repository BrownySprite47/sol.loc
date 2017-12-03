<div class="sub_links">
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=cities&action_name=view">создать город</a>
</div>

<div class="bread_crumbs"><p>Города / список городов</p></div>

{if isset($aContentList)}
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

{foreach from=$aContentList item=item}
<tr{cycle name="content_list" values=' class="odd",'}>
<td>{$item.city_id}</td>
<td>{$item.city_name}</td>
<td>{$item.region_name}</td>
<td>{$item.leaders_count}</td>
<td>{$item.projects_count}</td>
<td>{$item.recommendations_count}</td>
<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=cities&action_name=view&content_id={$item.city_id}"><img src="{#PROJECT_BACKEND_URL#}images/edit.png" alt="Редактировать" /></a></td>
<td>{if $item.leaders_count eq 0 and $item.projects_count eq 0 and $item.recommendations_count eq 0}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=cities&action_name=delete&content_id={$item.city_id}" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a>{/if}</td>
</tr>
{/foreach}

</table>
{else}
<p>Пока городов не создано.</p>
{/if}