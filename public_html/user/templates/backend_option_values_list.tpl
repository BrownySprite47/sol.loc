<div class="sub_links">
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=option_values&action_name=view">создать вариант ответа</a>
</div>

<div class="bread_crumbs"><p>Справочники / варианты ответов</p></div>

{if isset($aOptions)}
{foreach from=$aOptions item=item}
<div class="options_add open" for="option_{$item.option_id}">{$item.option_name} (тип: {$item.option_type_name}, мультивыбор: {if $item.option_multi_enabled eq 1}+{else}-{/if})</div>
{if isset($aOptionValues[$item.option_id])}
<table class="base_table option_{$item.option_id}">
<tr>
<th><strong>Вариант ответа</strong></th>
<th><strong>Количество лидеров ЛИСС</strong></th>
<th><strong>Количество проектов ЛИСС</strong></th>
<th colspan="2" class="small"></th>
</tr>
{foreach from=$aOptionValues[$item.option_id] item=i}
<tr{cycle name="content_list" values=' class="odd",'}>
<td>{$i.option_value}</td>
<td>{$i.leaders_count}</td>
<td>{$i.projects_count}</td>
<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=option_values&action_name=view&content_id={$i.option_value_id}"><img src="{#PROJECT_BACKEND_URL#}images/edit.png" alt="Редактировать" /></a></td>
<td>{if $i.leaders_count eq 0 and $i.projects_count eq 0}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=option_values&action_name=delete&content_id={$i.option_value_id}" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a>{/if}</td>
</tr>
{/foreach}
</table>
{/if}
{/foreach}
{else}
<p>Пока справочник пуст.</p>
{/if}