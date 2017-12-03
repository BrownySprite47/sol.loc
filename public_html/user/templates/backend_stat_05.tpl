<div class="bread_crumbs"><p>Статистика по интервьюерам</p></div>

<form id="form_stat_05" action="{#PROJECT_BACKEND_URL#}index.php?module_name=stat_05" method="get">
<input type="hidden" name="module_name" value="stat_05" />
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

{if isset($aContentData)}
<table class="base_table">
<tr>
<th style="width: 20%;"><strong>Период интервью</strong></th>
{foreach from=$aBackendUsers item=item}<th><strong>{$item}</strong></th>{/foreach}
</tr>
{foreach from=$aContentData item=item key=key}
<tr{cycle name="content_list" values=' class="odd",'}>
{if $key eq "all"}
<td><strong>Всего</strong></td>
{foreach from=$aBackendUsers item=i key=k}
{if isset($item[$k])}
<td><strong>{$item[$k]["leaders_count"]}</strong></td>
{else}
<td><strong>0</strong></td>
{/if}
{/foreach}
{else}
<td>{if $key eq "-"}интервью не назначено{else}{$key}{/if}</td>
{foreach from=$aBackendUsers item=i key=k}
{if $k eq "all"}
{if isset($item[$k])}
<td><strong>{$item[$k]["leaders_count"]}</strong></td>
{else}
<td><strong>0</strong></td>
{/if}
{else}
{if isset($item[$k])}
<td>{$item[$k]["leaders_count"]}</td>
{else}
<td>0</td>
{/if}
{/if}
{/foreach}
{/if}
</tr>
{/foreach}
</table>
{else}
<p>Нет данных.</p>
{/if}