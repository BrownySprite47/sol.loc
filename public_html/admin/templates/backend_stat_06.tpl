<div class="bread_crumbs"><p>Статистика по городам</p></div>

<form id="form_stat_06" action="{#PROJECT_BACKEND_URL#}index.php?module_name=stat_06" method="get">
<input type="hidden" name="module_name" value="stat_06" />
<div class="options_add open" for="search">Параметры</div>
<table class="form_table search">
<tbody>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Период</td>
<td>с <input type="text" name="date_from" value="{$aSearch.date_from}" class="small" id="date_from" /> по <input type="text" name="date_to" value="{$aSearch.date_to}" class="small" id="date_to" /></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Выгрузить в Excel</td>
<td><input type="checkbox" name="excel_enabled" value="1" /></td>
</tr>
</tbody>
</table>

<table class="wrap_sub search">
<tr>
<td></td>
<td><input type="submit" value="Отобразить статистику"/></td>
</tr>
</table>

</form>

{if isset($aContentList)}
<table class="base_table">
<tr>
<th rowspan="2"><strong>Город</strong></th>
<th colspan="4"><strong>Лидеры ЛИСС</strong></th>
<th rowspan="2"><strong>Проекты ЛИСС</strong></th>
</tr>
<tr>
<th><strong>Интервью пройдено + интервью на сегодня</strong></th>
<th><strong>Интервью ожидается</strong></th>
<th><strong>Интервью не назначено</strong></th>
<th><strong>Всего</strong></th>
</tr>
{foreach from=$aContentList item=item}
<tr{cycle name="content_list" values=' class="odd",'}>
{if $item.city_name eq "Всего"}
<td><strong>{$item.city_name}</strong></td>
<td><strong>{$item.leaders_count_1}</strong></td>
<td><strong>{$item.leaders_count_2}</strong></td>
<td><strong>{$item.leaders_count_3}</strong></td>
<td><strong>{$item.leaders_count_4}</strong></td>
<td><strong>{$item.projects_count_1}</strong></td>
{else}
<td>{$item.city_name}</td>
<td>{$item.leaders_count_1}</td>
<td>{$item.leaders_count_2}</td>
<td>{$item.leaders_count_3}</td>
<td>{$item.leaders_count_4}</td>
<td>{$item.projects_count_1}</td>
{/if}
</tr>
{/foreach}
</table>
{else}
<p>Нет данных.</p>
{/if}