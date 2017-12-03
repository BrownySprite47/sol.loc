<div class="sub_links">
{if isset($aContentData.leader_id) and $bLeadersEdit}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view">создать лидера ЛИСС</a> | {/if}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list">список лидеров ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Лидеры ЛИСС / просмотр</p></div>

<div class="options_add open" for="block_01">Общая информация</div>
<table class="form_table block_01">
<tbody>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Id лидера ЛИСС</td>
<td>{$aContentData.leader_id}{if $bLeadersEdit} <a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view&content_id={$aContentData.leader_id}">редактировать</a>{/if}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата и время создания</td>
<td>{$aContentData.leader_create_datetime}</td>
</tr>
{if $aContentData.transaction_create_datetime ne ""}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата и время последнего изменения</td>
<td>{$aContentData.transaction_create_datetime}</td>
</tr>
{/if}
{if isset($aBackendUsers[$aContentData.leader_create_backend_user_id])}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Инициатор</td>
<td>{$aBackendUsers[$aContentData.leader_create_backend_user_id]["backend_user_name"]}</td>
</tr>
{/if}
{if $aContentData.transaction_backend_user_id ne "" and isset($aBackendUsers[$aContentData.transaction_backend_user_id])}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Автор последнего изменения данных</td>
<td>{$aBackendUsers[$aContentData.transaction_backend_user_id]["backend_user_name"]}</td>
</tr>
{/if}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Шаблон анкеты</td>
<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=docx&content_id={$aContentData.leader_id}" target="_blank">скачать</a></td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата интервью</td>
<td>{$aContentData.leader_interview_date}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата появления в БД</td>
<td>{$aContentData.leader_create_date}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Интервьюер</td>
<td>{if isset($aBackendUsers[$aContentData.leader_interview_backend_user_id])}{$aBackendUsers[$aContentData.leader_interview_backend_user_id]["backend_user_name"]}{/if}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Кто заполняет анкету</td>
<td>{if isset($aBackendUsers[$aContentData.leader_write_backend_user_id])}{$aBackendUsers[$aContentData.leader_write_backend_user_id]["backend_user_name"]}{/if}</td>
</tr>
{if isset($aOptions[1])}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Способ проведения интервью</td>
<td>{foreach from=$aOptions[1]["option_value"] item=item}{if $aContentData.leader_interview_type eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
{/if}
{if isset($aRecommendationsFrom)}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Рекомендатели</td>
<td>{foreach from=$aRecommendationsFrom item=item}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view&content_id={$item.leader_id}" target="_blank">{$item.leader_surname}{if $item.leader_name ne ""} {$item.leader_name}{if $item.leader_patronymic ne ""} {$item.leader_patronymic}{/if}{/if}{if $item.project_name ne ""} ({$item.project_name}){/if}</a><br/>{/foreach}</td>
</tr>
{/if}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Источник контакта</td>
<td>{$aContentData.leader_contact_from}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Договоренности</td>
<td>{$aContentData.leader_interview_result|nl2br}</textarea></td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Комментарий по назначению интервью</td>
<td>{$aContentData.leader_question_21|nl2br}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Приоритетный порядок интервью</td>
<td>{if $aContentData.leader_high_priority eq 1}+{else}-{/if}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Анкета актуальна</td>
<td>{if $aContentData.leader_enabled eq 1}+{else}-{/if}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Анкета заполнена</td>
<td>{if $aContentData.leader_done eq 1}+{else}-{/if}</td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_02">Личная информация</div>
<table class="form_table block_02">
<tbody>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Фамилия</td>
<td>{$aContentData.leader_surname}</td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Имя</td>
<td>{$aContentData.leader_name}</td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Отчество</td>
<td>{$aContentData.leader_patronymic}</td>
</tr>
{if isset($aSex)}
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Пол</td>
<td>{foreach from=$aSex item=item}{if $aContentData.sex_id eq $item.sex_id}{$item.sex_name}{/if}{/foreach}</td>
</tr>
{/if}
{if isset($aCities)}
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Город</td>
<td>{assign var="iTemp" value="0"}{foreach from=$aCities item=item}{if $aContentData.city_id eq $item.city_id}{$item.city_name}{assign var="iTemp" value="1"}{/if}{/foreach}{if $aContentData.leader_city_name ne ""}{if $iTemp eq 1} ({$aContentData.leader_city_name}){else}{$aContentData.leader_city_name}{/if}{/if}</td>
</tr>
{/if}
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Дата рождения</td>
<td>{$aContentData.leader_birth_date}{if $aContentData.leader_birth_date_correct eq 1} (дата точная){/if}</td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Основное место работы</td>
<td>{$aContentData.leader_company}</td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Должность</td>
<td>{$aContentData.leader_position}</td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_03">Контакты</div>
<table class="form_table block_03">
<tbody>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Телефон <div class="info"><span>Основной телефон</span></div></td>
<td>{if strlen($aContentData.leader_phone) eq 10}<a href="tel:+7{$aContentData.leader_phone}">+7{$aContentData.leader_phone}</a>{else}{$aContentData.leader_phone}{/if}</td>
</tr>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>E-mail <div class="info"><span>Основной e-mail</span></div></td>
<td>{if $aContentData.leader_email ne ""}<a href="mailto:{$aContentData.leader_email}">{$aContentData.leader_email}</a>{/if}</td>
</tr>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Skype</td>
<td>{$aContentData.leader_skype}</td>
</tr>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Ссылка на страницу в социальных сетях</td>
<td>{$aContentData.leader_social_network}</td>
</tr>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Дополнительная контактная информация</td>
<td>{$aContentData.leader_contacts|nl2br}</td>
</tr>
</tbody>
</table>

{if isset($aProjects)}
<div class="options_add" for="projects">Проекты ({count($aProjects)})</div>
<table class="base_table projects">
<tr>
<th><strong>Проект</strong></th>
<th><strong>Роль лидера в проекте</strong></th>
<th colspan="2"><strong>Период участия <div class="info white"><span>Примерные даты (от и до) участия лидера в проекте, если известно</span></div></strong></th>
</tr>
{foreach from=$aProjects item=item}
<tr{cycle name="projects" values=' class="odd",'}>
<td>{if $item.project_id ne ""}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=view&content_id={$item.project_id}" target="_blank">{$item.project_name} ({$item.leader_name})</a>{else}{$item.project_name}{/if}</td>
<td>{$item.leader_role}</td>
<td>{$item.leader_date_from}</td>
<td>{$item.leader_date_to}</td>
</tr>
{/foreach}
</table>
{/if}

<div class="options_add" for="block_04">Личные вопросы</div>
<table class="form_table block_04">
<tbody>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Почему Вас рекомендовали, как ЛИСС?</td>
<td>{$aContentData.leader_question_01|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Сколько лет Вы реализуете проекты в социальной сфере?</td>
<td>{$aContentData.leader_question_02}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Что привело в социальную сферу?</td>
<td>{$aContentData.leader_question_03|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Зачем Вы занимаетесь проектом?</td>
<td>{$aContentData.leader_question_04|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Какие успешные проекты Вы реализовали?</td>
<td>{$aContentData.leader_question_05|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>В каких экспертных группах Вы состоите?</td>
<td>{$aContentData.leader_question_06|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Комментарии</td>
<td>{$aContentData.leader_question_07|nl2br}</td>
</tr>
{if isset($aOptions[2])}
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Уровень мышления</td>
<td>{foreach from=$aOptions[2]["option_value"] item=item}{if $aContentData.leader_question_08 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
{/if}
{if isset($aOptions[3])}
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Тип лидера в классификации Ашока</td>
<td>{foreach from=$aOptions[3]["option_value"] item=item}{if $aContentData.leader_question_09 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
{/if}
{if isset($aOptions[4])}
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Категория лидера</td>
<td>{foreach from=$aOptions[4]["option_value"] item=item}{if $item.option_selected eq 1}{$item.option_value}<br/>{/if}{/foreach}</td>
</tr>
{/if}
</tbody>
</table>

<div class="options_add" for="block_05">Вызовы, препятствия и потребности</div>
<table class="base_table block_05">
<tr>
<th><strong></strong></th>
<th><strong>Вызовы</strong></th>
<th><strong>Препятствия</strong></th>
<th><strong>Потребности</strong></th>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Личность</td>
<td>{$aContentData.leader_question_10|nl2br}</td>
<td>{$aContentData.leader_question_11|nl2br}</td>
<td>{$aContentData.leader_question_12|nl2br}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Проект</td>
<td>{$aContentData.leader_question_13|nl2br}</td>
<td>{$aContentData.leader_question_14|nl2br}</td>
<td>{$aContentData.leader_question_15|nl2br}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Система</td>
<td>{$aContentData.leader_question_16|nl2br}</td>
<td>{$aContentData.leader_question_17|nl2br}</td>
<td>{$aContentData.leader_question_18|nl2br}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Потребности в законодательстве</td>
<td colspan="3">{$aContentData.leader_question_19|nl2br}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Отношение к социальной деятельности</td>
<td colspan="3">{$aContentData.leader_question_20|nl2br}</td>
</tr>
</table>

{if isset($aRecommendations)}
<div class="options_add" for="leaders">Рекомендации (входящие: {$aContentData.recommendations_to_count_all} ({$aContentData.recommendations_to_count_for_interview}), исходящие: {count($aRecommendations)})</div>
<table class="base_table leaders">
<tbody>
<tr>
<th colspan="2"><strong>Рекомендуемый лидер</strong></th>
<th><strong>Причина рекомендации</strong></th>
<th><strong>Комментарий</strong></th>
</tr>
{assign var="iTemp" value="0"}

{foreach from=$aRecommendations item=item}
{if $iTemp eq 0}{assign var="iTemp" value="1"}{else}{assign var="iTemp" value="0"}{/if}
{if $item.leader_id_to ne ""}
<tr{if $iTemp eq 1} class="odd"{/if}>
<td colspan="2"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view&content_id={$item.leader_id_to}" target="_blank">{$item.leader_surname}{if $item.leader_name ne ""} {$item.leader_name}{if $item.leader_patronymic ne ""} {$item.leader_patronymic}{/if}{/if}{if $item.project_name ne ""} ({$item.project_name}){/if}</a></td>
<td>{$item.recommendation_reason|nl2br}</td>
<td>{$item.recommendation_comment|nl2br}</td>
</tr>
{else}
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">ФИО</td>
<td>{$item.leader_surname}{if $item.leader_name ne ""} {$item.leader_name}{if $item.leader_patronymic ne ""} {$item.leader_patronymic}{/if}{/if}</td>
<td rowspan="5">{$item.recommendation_reason|nl2br}</td>
<td rowspan="5">{$item.recommendation_comment|nl2br}</td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">Проект</td>
<td>{$item.leader_project_name}</td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">Город</td>
<td>{assign var="iTemp1" value="0"}{if isset($aCities)}{foreach from=$aCities item=i}{if $item.city_id eq $i.city_id}{$i.city_name}{assign var="iTemp1" value="1"}{/if}{/foreach}{/if}{if $item.leader_city_name ne ""}{if $iTemp1 eq 0} ({$item.leader_city_name}){else}{$item.leader_city_name}{/if}{/if}</td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">Телефон</td>
<td>{if strlen($item.leader_phone) eq 10}<a href="tel:+7{$item.leader_phone}">{$item.leader_phone}</a>{else}{$item.leader_phone}{/if}</td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">E-mail</td>
<td>{if $item.leader_email ne ""}<a href="mailto:{$item.leader_email}">{$item.leader_email}</a>{/if}</td>
</tr>
{/if}
{/foreach}
</tbody>
</table>
{/if}