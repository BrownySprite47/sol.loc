<div class="sub_links">
{if isset($aContentData.project_id) and $bProjectsEdit}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=view">создать проект ЛИСС</a> | {/if}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list">список проектов ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Проекты ЛИСС / просмотр</p></div>

<div class="options_add open" for="block_01">Общая информация</div>
<table class="form_table block_01">
<tbody>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Id проекта ЛИСС</td>
<td>{$aContentData.project_id}{if $bProjectsEdit} <a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=view&content_id={$aContentData.project_id}">редактировать</a>{/if}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата и время создания</td>
<td>{$aContentData.project_create_datetime}</td>
</tr>
{if $aContentData.transaction_create_datetime ne ""}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата и время последнего изменения</td>
<td>{$aContentData.transaction_create_datetime}</td>
</tr>
{/if}
{if isset($aBackendUsers[$aContentData.project_create_backend_user_id])}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Инициатор</td>
<td>{$aBackendUsers[$aContentData.project_create_backend_user_id]["backend_user_name"]}</td>
</tr>
{/if}
{if $aContentData.transaction_backend_user_id ne "" and isset($aBackendUsers[$aContentData.transaction_backend_user_id])}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Автор последнего изменения данных</td>
<td>{$aBackendUsers[$aContentData.transaction_backend_user_id]["backend_user_name"]}</td>
</tr>
{/if}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата интервью</td>
<td>{$aContentData.project_interview_date}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата появления в БД</td>
<td>{$aContentData.project_create_date}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Интервьюируемый</td>
<td>{if $aContentData.leader_id ne ""}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view&content_id={$aContentData.leader_id}" target="_blank">{$aContentData.leader_surname}{if $aContentData.leader_name ne ""} {$aContentData.leader_name}{if $aContentData.leader_patronymic ne ""} {$aContentData.leader_patronymic}{/if}{/if}{if $aContentData.project_name_1 ne ""} ({$aContentData.project_name_1}){/if}</a>{else}{$aContentData.leader_name}{/if}</td>
</tr>
{if isset($aBackendUsers)}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Интервьюер</td>
<td>{if isset($aBackendUsers[$aContentData.project_interview_backend_user_id])}{$aBackendUsers[$aContentData.project_interview_backend_user_id]["backend_user_name"]}{/if}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Кто заполняет анкету</td>
<td>{if isset($aBackendUsers[$aContentData.project_write_backend_user_id])}{$aBackendUsers[$aContentData.project_write_backend_user_id]["backend_user_name"]}{/if}</td>
</tr>
{/if}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Анкета актуальна</td>
<td>{if $aContentData.project_enabled eq 1}+{else}-{/if}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Анкета заполнена</td>
<td>{if $aContentData.project_done eq 1}+{else}-{/if}</td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_02">Общие данные о проекте</div>
<table class="form_table block_02">
<tbody>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Название проекта</td>
<td>{$aContentData.project_name}</td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Краткое название</td>
<td>{$aContentData.project_name_small}</td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Название для карты</td>
<td>{$aContentData.project_name_code}</td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Суть проекта</td>
<td>{$aContentData.project_text|nl2br}</td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Основной сайт</td>
<td>{$aContentData.project_site}</td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_03">Описание проекта</div>
<table class="form_table block_03">
<tbody>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Какую проблему решает проект</td>
<td>{$aContentData.project_question_01|nl2br}</td>
</tr>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Для кого ваш проект?</td>
<td>{$aContentData.project_question_02|nl2br}</td>
</tr>
{if isset($aOptions[5])}
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Сфера</td>
<td>{foreach from=$aOptions[5]["option_value"] item=item}{if $item.option_selected eq 1}{$item.option_value}<br/>{/if}{/foreach}{$aContentData.project_area}</td>
</tr>
{/if}
{if isset($aOptions[6])}
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Тип проекта</td>
<td>{foreach from=$aOptions[6]["option_value"] item=item}{if $item.option_selected eq 1}{$item.option_value}<br/>{/if}{/foreach}</td>
</tr>
{/if}
{if isset($aOptions[7])}
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Среда реализации</td>
<td>{foreach from=$aOptions[7]["option_value"] item=item}{if $aContentData.project_question_03 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
{/if}
</tbody>
</table>

<div class="options_add" for="block_04">Проблематизация</div>
<table class="form_table block_04">
<tbody>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>На основании чего Вы сделали вывод, что проблема существует?</td>
<td>{$aContentData.project_question_04|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Деятельность проекта</td>
<td>{$aContentData.project_question_05|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Прямой эффект</td>
<td>{$aContentData.project_question_06|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Косвенный эффект</td>
<td>{$aContentData.project_question_07|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Как Вы оцениваете свою эффективность?</td>
<td>{$aContentData.project_question_45|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Как проблема решается сегодня?</td>
<td>{$aContentData.project_question_08|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Какие ресурсы Вы используете</td>
<td>{$aContentData.project_question_10|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Какую ценность вы создаёте для тех, кто вам помогает?</td>
<td>{$aContentData.project_question_09|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Кто в Вашей команде? Как Вы их мотивируете?</td>
<td>{$aContentData.project_question_46|nl2br}</td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Комментарий по проекту</td>
<td>{$aContentData.project_question_11|nl2br}</td>
</tr>
{if isset($aOptions[2])}
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Уровень воздействия</td>
<td>{foreach from=$aOptions[2]["option_value"] item=item}{if $aContentData.project_question_12 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
{/if}
</tbody>
</table>

{if isset($aOptions[8])}
<div class="options_add" for="block_05">Инновационность</div>
<table class="form_table block_05">
<tbody>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Инновационность</td>
<td>{foreach from=$aOptions[8]["option_value"] item=item}{if $aContentData.project_question_13 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Новое содержание</td>
<td>{foreach from=$aOptions[8]["option_value"] item=item}{if $aContentData.project_question_14 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Новая форма представления</td>
<td>{foreach from=$aOptions[8]["option_value"] item=item}{if $aContentData.project_question_15 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Новые процессы, роли, форматы</td>
<td>{foreach from=$aOptions[8]["option_value"] item=item}{if $aContentData.project_question_16 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Новая инфраструктура</td>
<td>{foreach from=$aOptions[8]["option_value"] item=item}{if $aContentData.project_question_17 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
</tbody>
</table>
{/if}

<div class="options_add" for="block_06">Организация проекта</div>
<table class="form_table block_06">
<tbody>
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Оператор/автор проекта</td>
<td>{$aContentData.project_question_43}</td>
</tr>
{if isset($aCities)}
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Местоположение головной компании (город)</td>
<td>{assign var="iTemp" value="0"}{foreach from=$aCities item=item}{if $aContentData.city_id eq $item.city_id}{$item.city_name}{assign var="iTemp" value="1"}{/if}{/foreach}{if $aContentData.project_city_name ne ""}{if $iTemp eq 0}{$aContentData.project_city_name}{else} ({$aContentData.project_city_name}){/if}{/if}</td>
</tr>
{/if}
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Дата начала деятельности</td>
<td>{$aContentData.project_start_date}</td>
</tr>
{if isset($aOptions[10])}
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Организационно-правовая форма оператора проекта</td>
<td>{foreach from=$aOptions[10]["option_value"] item=item}{if $item.option_selected eq 1}{$item.option_value}<br/>{/if}{/foreach}</td>
</tr>
{/if}
{if isset($aOptions[11])}
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Стадия проекта</td>
<td>{foreach from=$aOptions[11]["option_value"] item=item}{if $aContentData.project_question_41 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
{/if}
{if isset($aOptions[12])}
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Бизнес модель</td>
<td>{foreach from=$aOptions[12]["option_value"] item=item}{if $aContentData.project_question_42 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
{/if}
<tr{cycle name="content_data_08" values=' class="odd",'}>
<td>Описание бизнес модели</td>
<td>{$aContentData.project_question_44|nl2br}</td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_07">Структура затрат</div>
<table class="form_table block_07">
<tbody>
<tr{cycle name="content_data_07" values=' class="odd",'}>
<td>Благотворительная деятельность</td>
<td>{$aContentData.project_question_18}</td>
</tr>
<tr{cycle name="content_data_07" values=' class="odd",'}>
<td>Коммерческая деятельность</td>
<td>{$aContentData.project_question_19}</td>
</tr>
<tr{cycle name="content_data_07" values=' class="odd",'}>
<td>Комментарий к структуре затрат</td>
<td>{$aContentData.project_question_32|nl2br}</td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_08">Структура доходов</div>
<table class="base_table block_08">
<tr>
<th style="width: 28%;"></th>
<th style="width: 18%;"><strong>Физлица</strong></th>
<th style="width: 18%;"><strong>Юрлица</strong></th>
<th style="width: 18%;"><strong>Фонды/НКО</strong></th>
<th style="width: 18%;"><strong>Государство (бюджет)</strong></th>
</tr>
<tr{cycle name="block_08" values=' class="odd",'}>
<td style="text-align: left;">Инвестиции</td>
<td>{$aContentData.project_question_20}</td>
<td>{$aContentData.project_question_21}</td>
<td>{$aContentData.project_question_22}</td>
<td>{$aContentData.project_question_23}</td>
</tr>
<tr{cycle name="block_08" values=' class="odd",'}>
<td style="text-align: left;">Выручка</td>
<td>{$aContentData.project_question_24}</td>
<td>{$aContentData.project_question_25}</td>
<td>{$aContentData.project_question_26}</td>
<td>{$aContentData.project_question_27}</td>
</tr>
<tr{cycle name="block_08" values=' class="odd",'}>
<td style="text-align: left;">Гранты/спонсорство</td>
<td>{$aContentData.project_question_28}</td>
<td>{$aContentData.project_question_29}</td>
<td>{$aContentData.project_question_30}</td>
<td>{$aContentData.project_question_31}</td>
</tr>
<tr{cycle name="block_08" values=' class="odd",'}>
<td style="text-align: left;">Комментарий к структуре доходов</td>
<td colspan="4">{$aContentData.project_question_33|nl2br}</td>
</tr>
</table>

{if isset($aLeaders)}
<div class="options_add" for="leaders">Лидеры проекта ({count($aLeaders)})</div>
<table class="base_table leaders">
<tr>
<th><strong>Лидер ЛИС</th>
<th><strong>Роль лидера в проекте</strong></th>
<th colspan="2"><strong>Период участия <div class="info white"><span>Примерные даты (от и до) участия лидера в проекте, если известно</span></div></strong></th>
</tr>
{foreach from=$aLeaders item=item}
<tr{cycle name="leaders" values=' class="odd",'}>
<td>
{if $item.leader_id eq ""}
{$item.leader_surname}{if $item.leader_name ne ""} {$item.leader_name}{if $item.leader_patronymic ne ""} {$item.leader_patronymic}{/if}{/if}
{else}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view&content_id={$item.leader_id}" target="_blank">{$item.leader_surname}{if $item.leader_name ne ""} {$item.leader_name}{if $item.leader_patronymic ne ""} {$item.leader_patronymic}{/if}{/if}{if $item.project_name ne ""} ({$item.project_name}){/if}</a>
{/if}
</td>
<td>{$item.leader_role}</td>
<td>{$item.leader_date_from}</td>
<td>{$item.leader_date_to}</td>
</tr>
{/foreach}
</table>
{/if}

<div class="options_add" for="block_09">Масштаб проекта и воздействие</div>
<table class="form_table block_09">
<tbody>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Среднемесячное количество посещений сайта/страницы</td>
<td>{$aContentData.project_question_34}</td>
</tr>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Среднемесячное количество посещений из России</td>
<td>{$aContentData.project_question_35}</td>
</tr>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Количество человек в команде</td>
<td>{$aContentData.project_question_36}</td>
</tr>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Членов команды в штате</td>
<td>{$aContentData.project_question_37}</td>
</tr>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Общее количество пользователей/потребителей в год</td>
<td>{$aContentData.project_question_38}</td>
</tr>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Общее количество пользователей/потребителей в год в России</td>
<td>{$aContentData.project_question_39}</td>
</tr>
{if isset($aOptions[9])}
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>География деятельности</td>
<td>{foreach from=$aOptions[9]["option_value"] item=item}{if $aContentData.project_question_40 eq $item.option_value_id}{$item.option_value}{/if}{/foreach}</td>
</tr>
{/if}
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Комментарий</td>
<td>{$aContentData.project_question_47|nl2br}</td>
</tr>
</tbody>
</table>

{if isset($aFilials)}
<div class="options_add" for="filials">Филиалы ({count($aFilials)})</div>
<table class="base_table filials">
<tr>
<th><strong>Город</strong></th>
<th><strong>Адрес</strong></th>
<th><strong>Комментарий</strong></th>
</tr>
{foreach from=$aFilials item=item}
<tr{cycle name="filials" values=' class="odd",'}>
<td>{assign var="iTemp" value="0"}{if isset($aCities)}{foreach from=$aCities item=i}{if $item.city_id eq $i.city_id}{$i.city_name}{assign var="iTemp" value="1"}{/if}{/foreach}{/if}{if $item.filial_city_name ne ""}{if $iTemp eq 0} ({$item.filial_city_name}){else}{$item.filial_city_name}{/if}{/if}</td>
<td>{$item.filial_address|nl2br}</td>
<td>{$item.filial_comment|nl2br}</td>
</tr>
{/foreach}
</table>
{/if}