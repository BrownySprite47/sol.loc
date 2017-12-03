<div class="sub_links">
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=view">создать проект ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Проекты ЛИСС / список</p></div>

<form action="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list" method="get">
<input type="hidden" name="module_name" value="projects" />
<input type="hidden" name="action_name" value="list" />
<div class="options_add open" for="search">Поиск</div>
<table class="form_table search">
<tbody>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Дата создания проекта</td>
<td>с <input type="text" name="date_from" value="{$aSearch.date_from}" class="small" id="date_from" /> по <input type="text" name="date_to" value="{$aSearch.date_to}" class="small" id="date_to" /></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Поиск <div class="info"><span>Поиск по id, названию, городу. Поиск по вхождению фразы. Фраза не менее трех символов.</span></div></td>
<td><input type="text" name="search_text" value="{$aSearch.search_text}" /></td>
</tr>
{if isset($aOV5)}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Сфера деятельности</td>
<td>
{foreach from=$aOV5 item=item}
<div class="wrap_input">
<input id="ov_5_{$item.option_value_id}" type="checkbox" name="ov_5[]" value="{$item.option_value_id}"{if $item.option_value_checked eq 1} checked="checked"{/if} />
<label for="ov_5_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}
<div class="wrap_input">
<input id="project_area_enabled" type="checkbox" name="project_area_enabled" value="1"{if $aSearch.project_area_enabled eq 1} checked="checked"{/if} />
<label for="project_area_enabled">другое</label>
</div>
</td>
</tr>
{/if}
{if isset($aOV11)}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Стадия проекта</td>
<td>
{foreach from=$aOV11 item=item}
<div class="wrap_input">
<input id="ov_11_{$item.option_value_id}" type="checkbox" name="ov_11[]" value="{$item.option_value_id}"{if $item.option_value_checked eq 1} checked="checked"{/if} />
<label for="ov_11_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}
</td>
</tr>
{/if}
{if isset($aOV12)}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Бизнес-модель</td>
<td>
{foreach from=$aOV12 item=item}
<div class="wrap_input">
<input id="ov_12_{$item.option_value_id}" type="checkbox" name="ov_12[]" value="{$item.option_value_id}"{if $item.option_value_checked eq 1} checked="checked"{/if} />
<label for="ov_12_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}
</td>
</tr>
{/if}
{if isset($aOV9)}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>География деятельности</td>
<td>
{foreach from=$aOV9 item=item}
<input id="ov_9_{$item.option_value_id}" type="checkbox" name="ov_9[]" value="{$item.option_value_id}"{if $item.option_value_checked eq 1} checked="checked"{/if} /> <label for="ov_9_{$item.option_value_id}">{$item.option_value}</label>
{/foreach}
</td>
</tr>
{/if}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Актуальность</td>
<td>
<input id="project_enabled_type_1" type="radio" name="project_enabled_type_id" value="1"{if $aSearch.project_enabled_type_id eq "1"} checked="checked"{/if} /> <label for="project_enabled_type_1">все</label>
<input id="project_enabled_type_2" type="radio" name="project_enabled_type_id" value="2"{if $aSearch.project_enabled_type_id eq "2"} checked="checked"{/if} /> <label for="project_enabled_type_2">только актуальные</label>
<input id="project_enabled_type_3" type="radio" name="project_enabled_type_id" value="3"{if $aSearch.project_enabled_type_id eq "3"} checked="checked"{/if} /> <label for="project_enabled_type_3">только не актуальные</label>
</td>
</tr>
</tbody>
</table>

<table class="wrap_sub search">
<tr>
<td></td>
<td><input type="submit" value="Искать" /></td>
</tr>
</table>

</form>

{if isset($aContentList)}

{capture name="search_url"}{if isset($aSearch)}{foreach from=$aSearch item=item key=key}&{$key}={$item}{/foreach}{/if}{if isset($aOV5)}{foreach from=$aOV5 item=item}{if $item.option_value_checked eq 1}&ov_5[]={$item.option_value_id}{/if}{/foreach}{/if}{if isset($aOV11)}{foreach from=$aOV11 item=item}{if $item.option_value_checked eq 1}&ov_11[]={$item.option_value_id}{/if}{/foreach}{/if}{if isset($aOV12)}{foreach from=$aOV12 item=item}{if $item.option_value_checked eq 1}&ov_12[]={$item.option_value_id}{/if}{/foreach}{/if}{if isset($aOV9)}{foreach from=$aOV9 item=item}{if $item.option_value_checked eq 1}&ov_9[]={$item.option_value_id}{/if}{/foreach}{/if}{/capture}

<table class="base_table">
<tr>
<th class="order small"><strong>Id</strong>
{if $iCurrentOrder eq 1}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=1{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 2}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=2{$smarty.capture.search_url}"></a>{/if}
</th>
<th class="order"><strong>Проект</strong>
{if $iCurrentOrder eq 3}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=3{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 4}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=4{$smarty.capture.search_url}"></a>{/if}
</th>
<th class="order"><strong>Город</strong>
{if $iCurrentOrder eq 5}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=5{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 6}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=6{$smarty.capture.search_url}"></a>{/if}
</th>
<th class="order"><strong>Сфера деятельности</strong>
{if $iCurrentOrder eq 15}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=15{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 16}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=16{$smarty.capture.search_url}"></a>{/if}
</th>
<th class="order"><strong>Стадия</strong>
{if $iCurrentOrder eq 9}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=9{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 10}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=10{$smarty.capture.search_url}"></a>{/if}
</th>
<th class="order"><strong>Модель</strong>
{if $iCurrentOrder eq 11}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=11{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 12}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=12{$smarty.capture.search_url}"></a>{/if}
</th>
<th class="order"><strong>Лидеры</strong>
{if $iCurrentOrder eq 13}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=13{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 14}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=14{$smarty.capture.search_url}"></a>{/if}
</th>
<th class="order"><strong>Интервьюер</strong>
{if $iCurrentOrder eq 7}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=7{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 8}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list&order=8{$smarty.capture.search_url}"></a>{/if}
</th>
<th><strong>Сайт</strong></th>
<th class="small"><strong>✓</strong></th>
</tr>
{foreach from=$aContentList item=item}
<tr{cycle name="content_list" values=' class="odd",'}>
<td>{$item.project_id}</td>
<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=view&content_id={$item.project_id}">{$item.project_name_small_show}</a></td>
<td>{$item.city_name_show}</td>
<td>{$item.project_option_5}{if $item.project_area ne ""}{if $item.project_option_5 ne ""}, {/if}{$item.project_area}{/if}</td>
<td>{$item.project_option_11}</td>
<td>{$item.project_option_12}</td>
<td>{if isset($item.leaders) and !empty($item.leaders)}{foreach from=$item.leaders item=i}{if $i.leader_id eq 0}{$i.leader_name}{else}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view&content_id={$i.leader_id}">{$i.leader_name}</a>{/if}<br/>{/foreach}{/if}</td>
<td>{$item.project_interview_backend_user_name}</td>
<td>{if $item.project_site_enabled eq 1}<a href="{$item.project_site}" target="_blank">link</a>{else}{$item.project_site}{/if}</td>
<td>{if $item.project_enabled eq 1}+{else}-{/if}</td>
</tr>
{/foreach}

</table>

{if $iMaxPage gt 1}
<p class="navigation">
{section name=for loop=$iMaxPage}
{if $smarty.section.for.iteration eq $iCurrentPage}
<span class="active">{$smarty.section.for.iteration}</span>
{else}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list{if $smarty.section.for.iteration ne 1}&page={$smarty.section.for.iteration}{/if}&order={$iCurrentOrder}{$smarty.capture.search_url}">{$smarty.section.for.iteration}</a>
{/if}
{/section}
</p>
{/if}

{else}
<p>По вашему запросу проекты ЛИСС не найдены.</p>
{/if}