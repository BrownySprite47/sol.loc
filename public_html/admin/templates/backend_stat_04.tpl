<div class="bread_crumbs"><p>Статистика по датам создания</p></div>

<form id="form_stat_04" action="{#PROJECT_BACKEND_URL#}index.php?module_name=stat_04" method="get">
<input type="hidden" name="module_name" value="stat_04" />
<div class="options_add open" for="search">Параметры</div>
<table class="form_table search">
<tbody>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Период</td>
<td>с <input type="text" name="date_from" value="{$aSearch.date_from}" class="small" id="date_from" /> по <input type="text" name="date_to" value="{$aSearch.date_to}" class="small" id="date_to" /></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Группировка</td>
<td>
<select name="stat_type_id">
<option value="1"{if $aSearch.stat_type_id eq 1} selected="selected"{/if}>по дням</option>
<option value="2"{if $aSearch.stat_type_id eq 2} selected="selected"{/if}>по неделям</option>
<option value="3"{if $aSearch.stat_type_id eq 3} selected="selected"{/if}>по месяцам</option>
<option value="4"{if $aSearch.stat_type_id eq 4} selected="selected"{/if}>по годам</option>
<option value="5"{if $aSearch.stat_type_id eq 5} selected="selected"{/if}>за весь период</option>
</select>
</td>
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
<th rowspan="2" style="width: 20%;"><strong>Период создания</strong></th>
<th colspan="6"><strong>Лидеры ЛИСС</strong></th>
<th colspan="2"><strong>Проекты ЛИСС</strong></th>
<th colspan="2"><strong>Рекомендации</strong></th>
</tr>
<tr>
<th><strong>Интервью пройдено + интервью на сегодня</strong></th>
<th><strong>Интервью ожидается</strong></th>
<th><strong>Интервью не назначено</strong></th>
<th><strong>Анкет заполено</strong></th>
<th><strong>Всего</strong></th>
<th><strong>Рекомендации 2+</strong></th>
<th><strong>Анкет заполено</strong></th>
<th><strong>Всего</strong></th>
<th><strong>Лидер создан</strong></th>
<th><strong>Всего</strong></th>
</tr>
{foreach from=$aContentList item=item}
<tr{cycle name="content_list" values=' class="odd",'}>
{if $item.period_name_show eq "Всего"}
<td><strong>{$item.period_name_show}</strong></td>
<td><strong>{$item.leaders_count_1}</strong></td>
<td><strong>{$item.leaders_count_2}</strong></td>
<td><strong>{$item.leaders_count_3}</strong></td>
<td><strong>{$item.leaders_count_4}</strong></td>
<td><strong>{$item.leaders_count_5}</strong></td>
<td><strong>{$item.leaders_count_6}</strong></td>
<td><strong>{$item.projects_count_1}</strong></td>
<td><strong>{$item.projects_count_2}</strong></td>
<td><strong>{$item.recommendations_count_1}</strong></td>
<td><strong>{$item.recommendations_count_2}</strong></td>
{else}
<td>{$item.period_name_show}</td>
<td>{$item.leaders_count_1}</td>
<td>{$item.leaders_count_2}</td>
<td>{$item.leaders_count_3}</td>
<td>{$item.leaders_count_4}</td>
<td>{$item.leaders_count_5}</td>
<td>{$item.leaders_count_6}</td>
<td>{$item.projects_count_1}</td>
<td>{$item.projects_count_2}</td>
<td>{$item.recommendations_count_1}</td>
<td>{$item.recommendations_count_2}</td>
{/if}
</tr>
{/foreach}
</table>
{else}
<p>Нет данных.</p>
{/if}