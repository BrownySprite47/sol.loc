{if $bLeadersEdit}<div class="sub_links">
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view">создать лидера ЛИСС</a>
</div>{/if}

<div class="bread_crumbs"><p>Лидеры ЛИСС / список</p></div>

<form action="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list" method="get">
<input type="hidden" name="module_name" value="leaders" />
<input type="hidden" name="action_name" value="list" />
<div class="options_add open" for="search">Поиск</div>
<table class="form_table search">
<tbody>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Дата появления в БД</td>
<td>с <input type="text" name="date_from" value="{$aSearch.date_from}" class="small" id="date_from" /> по <input type="text" name="date_to" value="{$aSearch.date_to}" class="small" id="date_to" /></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Поиск <div class="info"><span>Поиск по id лидера ЛИСС, ФИО, телефону, e-mail, городу, id проекта ЛИСС, наименованию проекта ЛИСС. Поиск по вхождению фразы. Фраза не менее трех символов.</span></div></td>
<td><input type="text" name="search_text" value="{$aSearch.search_text}" /></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Интервьюер</td>
<td><select name="leader_interview_backend_user_id"><option value=""></option><option value="0"{if $aSearch.leader_interview_backend_user_id eq "0"} selected{/if}>без интервьюера</option>{if isset($aLeaderInterviewBackendUsers)}{foreach from=$aLeaderInterviewBackendUsers item=item}<option value="{$item.backend_user_id}"{if $aSearch.leader_interview_backend_user_id eq $item.backend_user_id} selected{/if}>{$item.backend_user_name}</option>{/foreach}{/if}</select></td>
</tr>
{if isset($aOV4)}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Категория лидера</td>
<td>
{foreach from=$aOV4 item=item}
<div class="wrap_input inline_input">
<input id="ov_4_{$item.option_value_id}" type="checkbox" name="ov_4[]" value="{$item.option_value_id}"{if $item.option_value_checked eq 1} checked="checked"{/if} />
<label for="ov_4_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}
</td>
</tr>
{/if}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Статус интервью</td>
<td>
<input id="leader_interview_date_type_1" type="radio" name="leader_interview_date_type_id" value="1"{if $aSearch.leader_interview_date_type_id eq "1"} checked="checked"{/if} /> <label for="leader_interview_date_type_1">все</label>
<input id="leader_interview_date_type_2" type="radio" name="leader_interview_date_type_id" value="2"{if $aSearch.leader_interview_date_type_id eq "2"} checked="checked"{/if} /> <label for="leader_interview_date_type_2">прошедшие</label>
<input id="leader_interview_date_type_3" type="radio" name="leader_interview_date_type_id" value="3"{if $aSearch.leader_interview_date_type_id eq "3"} checked="checked"{/if} /> <label for="leader_interview_date_type_3">идут</label>
<input id="leader_interview_date_type_4" type="radio" name="leader_interview_date_type_id" value="4"{if $aSearch.leader_interview_date_type_id eq "4"} checked="checked"{/if} /> <label for="leader_interview_date_type_4">ожидаются</label>
<input id="leader_interview_date_type_5" type="radio" name="leader_interview_date_type_id" value="5"{if $aSearch.leader_interview_date_type_id eq "5"} checked="checked"{/if} /> <label for="leader_interview_date_type_5">не назначены</label>
</td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Приоритет интервью</td>
<td>
<div class="wrap_input inline_input">
<input id="leader_high_priority_type_1" type="radio" name="leader_high_priority_type_id" value="1"{if $aSearch.leader_high_priority_type_id eq "1"} checked="checked"{/if} /> <label for="leader_high_priority_type_1">все</label>
</div>
<div class="wrap_input inline_input">
<input id="leader_high_priority_type_2" type="radio" name="leader_high_priority_type_id" value="2"{if $aSearch.leader_high_priority_type_id eq "2"} checked="checked"{/if} /> <label for="leader_high_priority_type_2">приоритетные</label>
</div>
<div class="wrap_input inline_input">
<input id="leader_high_priority_type_3" type="radio" name="leader_high_priority_type_id" value="3"{if $aSearch.leader_high_priority_type_id eq "3"} checked="checked"{/if} /> <label for="leader_high_priority_type_3">остальные</label>
</div>
</td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Заполненность анкеты</td>
<td>
<div class="wrap_input inline_input">
<input id="leader_done_type_1" type="radio" name="leader_done_type_id" value="1"{if $aSearch.leader_done_type_id eq "1"} checked="checked"{/if} /> <label for="leader_done_type_1">все</label>
</div>
<div class="wrap_input inline_input">
<input id="leader_done_type_2" type="radio" name="leader_done_type_id" value="2"{if $aSearch.leader_done_type_id eq "2"} checked="checked"{/if} /> <label for="leader_done_type_2">заполенные анкеты</label>
</div>
<div class="wrap_input inline_input">
<input id="leader_done_type_3" type="radio" name="leader_done_type_id" value="3"{if $aSearch.leader_done_type_id eq "3"} checked="checked"{/if} /> <label for="leader_done_type_3">незаполненные анкеты</label>
</div>
</td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Актуальность</td>
<td>
<div class="wrap_input inline_input">
<input id="leader_enabled_type_1" type="radio" name="leader_enabled_type_id" value="1"{if $aSearch.leader_enabled_type_id eq "1"} checked="checked"{/if} /> <label for="leader_enabled_type_1">все</label>
</div>
<div class="wrap_input inline_input">
<input id="leader_enabled_type_2" type="radio" name="leader_enabled_type_id" value="2"{if $aSearch.leader_enabled_type_id eq "2"} checked="checked"{/if} /> <label for="leader_enabled_type_2">актуальные</label>
</div>
<div class="wrap_input inline_input">
<input id="leader_enabled_type_3" type="radio" name="leader_enabled_type_id" value="3"{if $aSearch.leader_enabled_type_id eq "3"} checked="checked"{/if} /> <label for="leader_enabled_type_3">неактуальные</label>
</div>
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

{capture name="search_url"}{if isset($aSearch)}{foreach from=$aSearch item=item key=key}&{$key}={$item}{/foreach}{/if}{if isset($aOV4)}{foreach from=$aOV4 item=item}{if $item.option_value_checked eq 1}&ov_4[]={$item.option_value_id}{/if}{/foreach}{/if}{/capture}

<table class="base_table" id="header-fixed"></table>
<table class="base_table foxFix">
	<thead>
<tr>
<th class="order small" rowspan="2"><strong>Id</strong>
{if $iCurrentOrder eq 1}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=1{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 2}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=2{$smarty.capture.search_url}"></a>{/if}
</th>
<th class="order" rowspan="2"><strong>Лидер</strong>
{if $iCurrentOrder eq 3}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=3{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 4}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=4{$smarty.capture.search_url}"></a>{/if}
</th>
<th rowspan="2"><strong>@</strong></th>
<th class="order" rowspan="2"><strong>Город</strong>
{if $iCurrentOrder eq 5}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=5{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 6}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=6{$smarty.capture.search_url}"></a>{/if}
</th>
<th rowspan="2" class="order"><strong>Категория</strong>
{if $iCurrentOrder eq 11}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=11{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 12}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=12{$smarty.capture.search_url}"></a>{/if}
</th>
<th rowspan="2" class="order"><strong>Проекты</strong>
{if $iCurrentOrder eq 9}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=9{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 10}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=10{$smarty.capture.search_url}"></a>{/if}
</th>
<th colspan="5"><strong>Интервью</strong></th>
<th colspan="2"><strong>Рекомендации</strong></th>
<th rowspan="2" class="small"><strong>✓</strong></th>
{if $bLeadersEdit}<th rowspan="2" class="small"></th>{/if}
</tr>
<tr>
<th class="order"><strong>Интервьюер</strong>
{if $iCurrentOrder eq 19}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=19{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 20}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=20{$smarty.capture.search_url}"></a>{/if}
</th>
<th class="order"><strong>Дата</strong>
{if $iCurrentOrder eq 7}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=7{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 8}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=8{$smarty.capture.search_url}"></a>{/if}
</th>
<th class="order"><strong>↑</strong>
{if $iCurrentOrder eq 17}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=17{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 18}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=18{$smarty.capture.search_url}"></a>{/if}
</th>
<th><strong>Способ</strong></th>
<th><strong>Комментарий по интервью</strong></th>
<th class="order"><strong><-</strong>
{if $iCurrentOrder eq 13}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=13{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 14}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=14{$smarty.capture.search_url}"></a>{/if}</th>
<th class="order"><strong>-></strong>
{if $iCurrentOrder eq 15}<span class="order_asc"></span>{else}<a class="order_asc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=15{$smarty.capture.search_url}"></a>{/if}
{if $iCurrentOrder eq 16}<span class="order_desc"></span>{else}<a class="order_desc" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list&order=16{$smarty.capture.search_url}"></a>{/if}</th>
</tr>
</thead>
<tbody>
{foreach from=$aContentList item=item}
<tr class="{cycle name="content_list" values='odd,'}{if $item.leader_enabled eq 0} disable{/if}">
<td>{$item.leader_id}</td>
<td><a target="_blank" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view{if !$bLeadersEdit}_without_edit{/if}&content_id={$item.leader_id}">{$item.leader_surname}{if $item.leader_name ne ""} {$item.leader_name}{if $item.leader_patronymic ne ""} {$item.leader_patronymic}{/if}{/if}</a></td>
<td>{if $item.leader_email ne ""}<a href="#" onclick='{literal}clipboard.copy({"text/plain": "{/literal}{$item.leader_email}", "text/html": "{$item.leader_email}"{literal}});{/literal} return false;' title="{$item.leader_email}">@</a>{/if}</td>
<td>{$item.city_name_show}</td>
<td>{$item.leader_option_4}</td>
<td>{if isset($item.projects) and !empty($item.projects)}{foreach from=$item.projects item=i}{if $i.project_id eq 0}{$i.project_name}{else}<a target="_blank" href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=view&content_id={$i.project_id}">{$i.project_name}</a>{/if}<br/>{/foreach}{/if}</td>
<td>{$item.leader_interview_backend_user_name}</td>
<td>{$item.leader_interview_date}</td>
<td>{if $item.leader_high_priority eq 1}↑{/if}</td>
<td>{$item.leader_option_1}</td>
{if $item.leader_question_21 eq $item.leader_question_21_small}
<td>{$item.leader_question_21}</td>
{else}
<td class="has_info">
{$item.leader_question_21_small} <a class="popup_info_link" onclick="return false;" href="#">...</a><span class="popup_info">{$item.leader_question_21}</span>
</td>
{/if}
<td>{$item.recommendations_to_count}</td>
<td>{$item.recommendations_from_count}</td>
<td>{if $item.leader_done eq 1}+{else}-{/if}</td>
{if $bLeadersEdit}<td><a target="_blank" href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view_without_edit&content_id={$item.leader_id}"><img src="{#PROJECT_BACKEND_URL#}images/view.png" alt="Просмотр" width="15" /></a></td>{/if}
</tr>
{/foreach}
</tbody>
</table>

{if $iMaxPage gt 1}
<p class="navigation">
{section name=for loop=$iMaxPage}
{if $smarty.section.for.iteration eq $iCurrentPage}
<span class="active">{$smarty.section.for.iteration}</span>
{else}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list{if $smarty.section.for.iteration ne 1}&page={$smarty.section.for.iteration}{/if}&order={$iCurrentOrder}{$smarty.capture.search_url}">{$smarty.section.for.iteration}</a>
{/if}
{/section}
</p>
{/if}

{else}
<p>По вашему запросу лидеры ЛИСС не найдены.</p>
{/if}