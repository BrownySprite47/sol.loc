<div class="sub_links">
{if isset($aContentData.project_id)}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=view">создать проект ЛИСС</a> | {/if}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=list">список проектов ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Проекты ЛИСС / {if isset($aContentData.project_id)}редактирование{else}создание{/if}</p></div>

{if isset($aContentDataErrors.transaction_id)}
<p class="error_text_header">Данные не могу быть сохранены, так как произошло их изменение. Обновите страницу.</p>
{else}
{if isset($aContentDataErrors) and !empty($aContentDataErrors)}
<p class="error_text_header">Обратите внимание, что данные не сохранены.</p>
{/if}
{/if}

<form id="form_projects" action="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=edit{if isset($aContentData.project_id)}&content_id={$aContentData.project_id}{/if}" method="post">

<input type="hidden" name="transaction_id" value="{if isset($aContentData.leader_id)}{$aContentData.transaction_id}{/if}">

<div class="options_add open" for="block_01">Общая информация</div>
<table class="form_table block_01">
<tbody>
{if isset($aContentData.project_id)}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Id проекта ЛИСС</td>
<td colspan="2">{$aContentData.project_id}</td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата и время создания</td>
<td colspan="2">{$aContentData.project_create_datetime}</td>
</tr>
{if $aContentData.transaction_create_datetime ne ""}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата и время последнего изменения</td>
<td colspan="2">{$aContentData.transaction_create_datetime}</td>
</tr>
{/if}
{if isset($aBackendUsers[$aContentData.project_create_backend_user_id])}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Инициатор</td>
<td colspan="2">{$aBackendUsers[$aContentData.project_create_backend_user_id]["backend_user_name"]}</td>
</tr>
{/if}
{if $aContentData.transaction_backend_user_id ne "" and isset($aBackendUsers[$aContentData.transaction_backend_user_id])}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Автор последнего изменения данных</td>
<td colspan="2">{$aBackendUsers[$aContentData.transaction_backend_user_id]["backend_user_name"]}</td>
</tr>
{/if}
{/if}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата интервью <div class="info"><span>Формат: YYYY-MM-DD</span></div></td>
<td colspan="2"><input type="text" name="project_interview_date" value="{if isset($aContentData)}{$aContentData.project_interview_date}{else}{if isset($aContentDataDefault)}{$aContentDataDefault.project_interview_date}{else}{$smarty.now|date_format:"%Y-%m-%d"}{/if}{/if}" class="small{if isset($aContentDataErrors.project_interview_date)} error{/if}" id="project_interview_date" /><p class="error_text">{if isset($aContentDataErrors.project_interview_date)}{$aContentDataErrors.project_interview_date}{/if}</p></td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Интервьюируемый <div class="info"><span>ФИО или id лидера ЛИСС</span></div></td>
{if isset($aContentData.project_id) and $aContentData.leader_id ne ""}
<td style="width: 20%;"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view&content_id={$aContentData.leader_id}" target="_blank">{$aContentData.leader_surname}{if $aContentData.leader_name ne ""} {$aContentData.leader_name}{if $aContentData.leader_patronymic ne ""} {$aContentData.leader_patronymic}{/if}{/if} ({$aContentData.leader_id})</a></td>
{/if}
<td{if !isset($aContentData.project_id) or $aContentData.leader_id eq ""} colspan="2"{/if}><input class="search_link_2" id="leader_name" autocomplete="off" type="text" name="leader_name"{if isset($aContentData)} value="{if !isset($aContentData.project_id) or $aContentData.leader_id eq ""}{$aContentData.leader_name}{else}{$aContentData.leader_id}{/if}"{else}{if isset($aContentDataDefault)} value="{$aContentDataDefault.leader_id}"{/if}{/if} placeholder="ФИО или id" /></td>
</tr>
{if isset($aBackendUsers)}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Интервьюер</td>
<td colspan="2"><select name="project_interview_backend_user_id"><option></option>{foreach from=$aBackendUsers item=item}<option value="{$item.backend_user_id}"{if (isset($aContentData.project_interview_backend_user_id, $aBackendUsers[$aContentData.project_interview_backend_user_id]) and $aContentData.project_interview_backend_user_id eq $item.backend_user_id) or (isset($aContentDataDefault.project_interview_backend_user_id, $aBackendUsers[$aContentDataDefault.project_interview_backend_user_id]) and $aContentDataDefault.project_interview_backend_user_id eq $item.backend_user_id) or (!isset($aContentData.project_interview_backend_user_id) and !isset($aContentDataDefault.project_interview_backend_user_id) and $iBackendUserId eq $item.backend_user_id)} selected{/if}>{$item.backend_user_name}</option>{/foreach}</select></td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Кто заполняет анкету</td>
<td colspan="2"><select name="project_write_backend_user_id"><option></option>{foreach from=$aBackendUsers item=item}<option value="{$item.backend_user_id}"{if (isset($aContentData.project_write_backend_user_id, $aBackendUsers[$aContentData.project_write_backend_user_id]) and $aContentData.project_write_backend_user_id eq $item.backend_user_id) or (!isset($aContentData.project_write_backend_user_id) and $iBackendUserId eq $item.backend_user_id)} selected{/if}>{$item.backend_user_name}</option>{/foreach}</select></td>
</tr>
{/if}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Актуальность анкеты</td>
<td colspan="2"><input type="checkbox" name="project_enabled"{if !isset($aContentData) or $aContentData.project_enabled eq 1} checked{/if} /></td>
</tr>
</tbody>
</table>

<div class="options_add open" for="block_02">Общие данные о проекте</div>
<table class="form_table block_02">
<tbody>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Название проекта * <div class="info"><span>Название, которое дали проекту авторы</span></div></td>
<td><input type="text" name="project_name" value="{if isset($aContentData)}{$aContentData.project_name}{/if}"{if isset($aContentDataErrors.project_name)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.project_name)}{$aContentDataErrors.project_name}{/if}</p></td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Краткое название <div class="info"><span>Короткое название для быстрого поиска в базе. Оно же будет использоваться в визуализации (не больше 30 символов)</span></div></td>
<td><input type="text" name="project_name_small" value="{if isset($aContentData)}{$aContentData.project_name_small}{/if}" /></td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Название для карты <div class="info"><span>Не более 12 символов</span></div></td>
<td><input type="text" name="project_name_code" value="{if isset($aContentData)}{$aContentData.project_name_code}{/if}"{if isset($aContentDataErrors.project_name_code)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.project_name_code)}{$aContentDataErrors.project_name_code}{/if}</p></td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Суть проекта <div class="info"><span>Краткое описание проекта (5-6 строк), публичная версия</span></div></td>
<td><textarea name="project_text">{if isset($aContentData)}{$aContentData.project_text}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Основной сайт</td>
<td><input type="text" name="project_site" value="{if isset($aContentData)}{$aContentData.project_site}{/if}" /></td>
</tr>
</tbody>
</table>

<div class="options_add open" for="block_03">Описание проекта</div>
<table class="form_table block_03">
<tbody>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Какую проблему решает проект <div class="info"><span>Сформулировать в виде проблемы, а не цели</span></div></td>
<td><textarea name="project_question_01">{if isset($aContentData)}{$aContentData.project_question_01}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Для кого ваш проект? <div class="info"><span>Бенефициар(ы)</span></div></td>
<td><textarea name="project_question_02">{if isset($aContentData)}{$aContentData.project_question_02}{/if}</textarea></td>
</tr>
{if isset($aOptions[5])}
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Сфера <div class="info"><span>Одна или несколько областей социальной сферы, в которых действует проект. Только значимые направления деятельности проекта</span></div></td>
<td>{foreach from=$aOptions[5]["option_value"] item=item}
<div class="wrap_input">
<input id="option_value_{$item.option_value_id}" type="checkbox" name="options[5][]" value="{$item.option_value_id}"{if $item.option_selected eq 1} checked{/if} />
<label for="option_value_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}
<input type="text" name="project_area" value="{if isset($aContentData)}{$aContentData.project_area}{/if}" placeholder="другие сферы" />
</td>
</tr>
{/if}
{if isset($aOptions[6])}
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Тип проекта</td>
<td>{foreach from=$aOptions[6]["option_value"] item=item}
<div class="wrap_input">
<input id="option_value_{$item.option_value_id}" type="checkbox" name="options[6][]" value="{$item.option_value_id}"{if $item.option_selected eq 1} checked{/if} />
<label for="option_value_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}
</td>
</tr>
{/if}
{if isset($aOptions[7])}
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Среда реализации <div class="info"><span>Среда реализации, то есть то, где реализуется деятельность</span></div></td>
<td><select name="project_question_03"><option></option>{foreach from=$aOptions[7]["option_value"] item=item}<option value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.project_question_03 eq $item.option_value_id} selected{/if}>{$item.option_value}</option>{/foreach}</select>
</td>
</tr>
{/if}
</tbody>
</table>

<div class="options_add open" for="block_04">Проблематизация</div>
<table class="form_table block_04">
<tbody>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>На основании чего Вы сделали вывод, что проблема существует? <div class="info"><span>Статистика, исследования в России и зарубежом</span></div></td>
<td><textarea name="project_question_04">{if isset($aContentData)}{$aContentData.project_question_04}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Деятельность проекта <div class="info"><span>Описание проекта</span></div></td>
<td><textarea name="project_question_05">{if isset($aContentData)}{$aContentData.project_question_05}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Прямой эффект <div class="info"><span>Что должно стать результатом проекта? Как Вы поймете, что достигли результата? Как масштабируется проект?</span></div></td>
<td><textarea name="project_question_06">{if isset($aContentData)}{$aContentData.project_question_06}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Косвенный эффект <div class="info"><span>Видите ли Вы какие-то непрямые эффекты, то есть эффекты на целевых группах, которые не в прямом фокусе проекта? Например?</span></div></td>
<td><textarea name="project_question_07">{if isset($aContentData)}{$aContentData.project_question_07}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Как Вы оцениваете свою эффективность? <div class="info"><span>Как оценивается эффективность деятельности? Какие методики используются?</span></div></td>
<td><textarea name="project_question_45">{if isset($aContentData)}{$aContentData.project_question_45}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Как проблема решается сегодня? <div class="info"><span>Кто ещё решает эту проблему, как она решается сегодня? Что Вы делаете иначе? (содержание/форма/процессы/инфраструктура)</span></div></td>
<td><textarea name="project_question_08">{if isset($aContentData)}{$aContentData.project_question_08}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Какие ресурсы Вы используете <div class="info"><span>Источники финансирования, партнеры (как помогают), волонтёры, платформы... - описание общими словами. Какие ресурсы гос./негос. поддержки Вы знаете/используете, какие из них реально работают?</span></div></td>
<td><textarea name="project_question_10">{if isset($aContentData)}{$aContentData.project_question_10}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Какую ценность вы создаёте для тех, кто вам помогает? <div class="info"><span>Что Вашим партнёрам, волонтёрам, спонсорам... даёт участие в вашей деятельности? Как Вы их мотивируете?</span></div></td>
<td><textarea name="project_question_09">{if isset($aContentData)}{$aContentData.project_question_09}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Кто в Вашей команде? Как Вы их мотивируете? <div class="info"><span>Как Вы подбираете собтрудников? Как Вы их мотивируете? Что станет с проектом если Вы перестанете им заниматься?</span></div></td>
<td><textarea name="project_question_46">{if isset($aContentData)}{$aContentData.project_question_46}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Комментарий по проекту <div class="info"><span>Неформальные комментарии на тему проекта</span></div></td>
<td><textarea name="project_question_11">{if isset($aContentData)}{$aContentData.project_question_11}{/if}</textarea></td>
</tr>
{if isset($aOptions[2])}
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Уровень воздействия <div class="info"><span>Этот показатель оценивает уровень воздействия проекта</span></div></td>
<td>{foreach from=$aOptions[2]["option_value"] item=item}
<div class="wrap_input">
<input id="option_value_{$item.option_value_id}" type="radio" name="project_question_12" value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.project_question_12 eq $item.option_value_id} checked{/if} />
<label for="option_value_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}</td>
</tr>
{/if}
</tbody>
</table>

{if isset($aOptions[8])}
<div class="options_add open" for="block_05">Инновационность</div>
<table class="form_table block_05">
<tbody>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Инновационность <div class="info"><span>Под инновациями мы понимаем проекты, нацеленные на изменение привычных социальных моделей</span></div></td>
<td>{foreach from=$aOptions[8]["option_value"] item=item}
<input id="option_value_13_{$item.option_value_id}" type="radio" name="project_question_13" value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.project_question_13 eq $item.option_value_id} checked{/if} /> <label for="option_value_13_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Новое содержание <div class="info"><span>Новая предметная область, новая отрасль, новые знания</span></div></td>
<td>{foreach from=$aOptions[8]["option_value"] item=item}
<input id="option_value_14_{$item.option_value_id}" type="radio" name="project_question_14" value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.project_question_14 eq $item.option_value_id} checked{/if} /> <label for="option_value_14_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Новая форма представления <div class="info"><span>Переход от традиционных форм (урок-лекция, урок-задание, книги) к новым, например, игры, мультфильмы, интерактивные уроки, деятельностный подход</span></div></td>
<td>{foreach from=$aOptions[8]["option_value"] item=item}
<input id="option_value_15_{$item.option_value_id}" type="radio" name="project_question_15" value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.project_question_15 eq $item.option_value_id} checked{/if} /> <label for="option_value_15_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Новые процессы, роли, форматы <div class="info"><span>Переход от традиционных процессов работы к новым, например, тьюторство, конструктор опыта, развивающее обучение, учи.ру, открытая школа, эдьютейнмент</span></div></td>
<td>{foreach from=$aOptions[8]["option_value"] item=item}
<input id="option_value_16_{$item.option_value_id}" type="radio" name="project_question_16" value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.project_question_16 eq $item.option_value_id} checked{/if} /> <label for="option_value_16_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}</td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Новая инфраструктура <div class="info"><span>Создание новых инфраструктурных решений, например, маркетплейс, электронный дневник, образовательный краудфандинг</span></div></td>
<td>{foreach from=$aOptions[8]["option_value"] item=item}
<input id="option_value_17_{$item.option_value_id}" type="radio" name="project_question_17" value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.project_question_17 eq $item.option_value_id} checked{/if} /> <label for="option_value_17_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}</td>
</tr>
</tbody>
</table>
{/if}

<div class="options_add open" for="block_06">Организация проекта</div>
<table class="form_table block_06">
<tbody>
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Оператор/автор проекта <div class="info"><span>Физическое или юридическое лицо, которое является основным оператором проекта (управляет, распоряжается бюджетом проекта)</span></div></td>
<td colspan="2"><input type="text" name="project_question_43" value="{if isset($aContentData)}{$aContentData.project_question_43}{/if}" /></td>
</tr>
{if isset($aCities)}
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Местоположение головной компании (город) <div class="info"><span>Основное место жительства. Город или ближайший большой город (столица региона), например для Первоуральска выбирайте Екатеринбург, это нужно для укрупнённой региональной классификации. Если в списке нет, то заполните поле "другой город", для маленьких городов указывайте область</span></div></td>
<td class="small"><select name="city_id"><option></option>{foreach from=$aCities item=item}<option value="{$item.city_id}"{if isset($aContentData) and $aContentData.city_id eq $item.city_id} selected{/if}>{$item.city_name}</option>{/foreach}</select></td>
<td><input type="text" name="project_city_name" value="{if isset($aContentData)}{$aContentData.project_city_name}{/if}" placeholder="другой город" /></td>
</tr>
{/if}
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Дата начала деятельности <div class="info"><span>Формат: YYYY-MM-DD. Если неизвестен день, устанавливаем 01, если неизвестен месяц, устанавливаем 07, если неизвестен год, устанавливаем примерный год</span></div></td>
<td colspan="2"><input type="text" name="project_start_date" value="{if isset($aContentData)}{$aContentData.project_start_date}{/if}" class="small{if isset($aContentDataErrors.project_start_date)} error{/if}" id="project_start_date" /><p class="error_text">{if isset($aContentDataErrors.project_start_date)}{$aContentDataErrors.project_start_date}{/if}</p></td>
</tr>
{if isset($aOptions[10])}
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Организационно-правовая форма оператора проекта <div class="info"><span>Только те варианты, на которые приходится значимая (>20%) часть деятельности (выручки/затрат)</span></div></td>
<td colspan="2">{foreach from=$aOptions[10]["option_value"] item=item}
<div class="wrap_input">
<input id="option_value_{$item.option_value_id}" type="checkbox" name="options[10][]" value="{$item.option_value_id}"{if $item.option_selected eq 1} checked{/if} />
<label for="option_value_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}
</td>
</tr>
{/if}
{if isset($aOptions[11])}
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Стадия проекта <div class="info"><span>Наиболее подходящий вариант на момент интервью</span></div></td>
<td colspan="2"><select name="project_question_41"><option></option>{foreach from=$aOptions[11]["option_value"] item=item}<option value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.project_question_41 eq $item.option_value_id} selected{/if}>{$item.option_value}</option>{/foreach}</select>
</td>
</tr>
{/if}
{if isset($aOptions[12])}
<tr{cycle name="content_data_06" values=' class="odd",'}>
<td>Бизнес модель</td>
<td colspan="2"><select name="project_question_42"><option></option>{foreach from=$aOptions[12]["option_value"] item=item}<option value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.project_question_42 eq $item.option_value_id} selected{/if}>{$item.option_value}</option>{/foreach}</select>
</td>
</tr>
{/if}
<tr{cycle name="content_data_08" values=' class="odd",'}>
<td>Описание бизнес модели</td>
<td colspan="2"><textarea name="project_question_44">{if isset($aContentData)}{$aContentData.project_question_44}{/if}</textarea></td>
</tr>
</tbody>
</table>

<div class="options_add open" for="block_07">Структура затрат</div>
<table class="form_table block_07">
<tbody>
<tr{cycle name="content_data_07" values=' class="odd",'}>
<td>Благотворительная деятельность <div class="info"><span>Примерное распределение затрат в 2017 г. (оценка). Примерная сумма в миллионах рублей</span></div></td>
<td><input type="text" name="project_question_18" value="{if isset($aContentData)}{$aContentData.project_question_18}{/if}" class="small{if isset($aContentDataErrors.project_question_18)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_18)}{$aContentDataErrors.project_question_18}{/if}</p></td>
</tr>
<tr{cycle name="content_data_07" values=' class="odd",'}>
<td>Коммерческая деятельность <div class="info"><span>Примерное распределение затрат в 2017 г. (оценка). Примерная сумма в миллионах рублей</span></div></td>
<td><input type="text" name="project_question_19" value="{if isset($aContentData)}{$aContentData.project_question_19}{/if}" class="small{if isset($aContentDataErrors.project_question_19)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_19)}{$aContentDataErrors.project_question_19}{/if}</p></td>
</tr>
<tr{cycle name="content_data_07" values=' class="odd",'}>
<td>Комментарий к структуре затрат <div class="info"><span>Планируются ли существенные изменения?</span></div></td>
<td><textarea name="project_question_32">{if isset($aContentData)}{$aContentData.project_question_32}{/if}</textarea></td>
</tr>
</tbody>
</table>

<div class="options_add open" for="block_08">Структура доходов</div>
<table class="base_table block_08">
<tr>
<th style="width: 28%;"></th>
<th style="width: 18%;"><strong>Физлица</strong></th>
<th style="width: 18%;"><strong>Юрлица</strong></th>
<th style="width: 18%;"><strong>Фонды/НКО</strong></th>
<th style="width: 18%;"><strong>Государство (бюджет)</strong></th>
</tr>
<tr{cycle name="block_08" values=' class="odd",'}>
<td style="text-align: left;">Инвестиции <div class="info"><span>Примерное распределение доходов в 2017 г. (оценка). Примерную сумма в миллионах рублей</span></div></td>
<td><input type="text" name="project_question_20" value="{if isset($aContentData)}{$aContentData.project_question_20}{/if}" class="small{if isset($aContentDataErrors.project_question_20)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_20)}{$aContentDataErrors.project_question_20}{/if}</p></td>
<td><input type="text" name="project_question_21" value="{if isset($aContentData)}{$aContentData.project_question_21}{/if}" class="small{if isset($aContentDataErrors.project_question_21)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_21)}{$aContentDataErrors.project_question_21}{/if}</p></td>
<td><input type="text" name="project_question_22" value="{if isset($aContentData)}{$aContentData.project_question_22}{/if}" class="small{if isset($aContentDataErrors.project_question_22)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_22)}{$aContentDataErrors.project_question_22}{/if}</p></td>
<td><input type="text" name="project_question_23" value="{if isset($aContentData)}{$aContentData.project_question_23}{/if}" class="small{if isset($aContentDataErrors.project_question_23)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_23)}{$aContentDataErrors.project_question_23}{/if}</p></td>
</tr>
<tr{cycle name="block_08" values=' class="odd",'}>
<td style="text-align: left;">Выручка <div class="info"><span>Примерное распределение доходов в 2017 г. (оценка). Примерную сумма в миллионах рублей</span></div></td>
<td><input type="text" name="project_question_24" value="{if isset($aContentData)}{$aContentData.project_question_24}{/if}" class="small{if isset($aContentDataErrors.project_question_24)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_24)}{$aContentDataErrors.project_question_24}{/if}</p></td>
<td><input type="text" name="project_question_25" value="{if isset($aContentData)}{$aContentData.project_question_25}{/if}" class="small{if isset($aContentDataErrors.project_question_25)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_25)}{$aContentDataErrors.project_question_25}{/if}</p></td>
<td><input type="text" name="project_question_26" value="{if isset($aContentData)}{$aContentData.project_question_26}{/if}" class="small{if isset($aContentDataErrors.project_question_26)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_26)}{$aContentDataErrors.project_question_26}{/if}</p></td>
<td><input type="text" name="project_question_27" value="{if isset($aContentData)}{$aContentData.project_question_27}{/if}" class="small{if isset($aContentDataErrors.project_question_27)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_27)}{$aContentDataErrors.project_question_27}{/if}</p></td>
</tr>
<tr{cycle name="block_08" values=' class="odd",'}>
<td style="text-align: left;">Гранты/спонсорство <div class="info"><span>Примерное распределение доходов в 2017 г. (оценка). Примерную сумма в миллионах рублей</span></div></td>
<td><input type="text" name="project_question_28" value="{if isset($aContentData)}{$aContentData.project_question_28}{/if}" class="small{if isset($aContentDataErrors.project_question_28)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_28)}{$aContentDataErrors.project_question_28}{/if}</p></td>
<td><input type="text" name="project_question_29" value="{if isset($aContentData)}{$aContentData.project_question_29}{/if}" class="small{if isset($aContentDataErrors.project_question_29)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_29)}{$aContentDataErrors.project_question_29}{/if}</p></td>
<td><input type="text" name="project_question_30" value="{if isset($aContentData)}{$aContentData.project_question_30}{/if}" class="small{if isset($aContentDataErrors.project_question_30)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_30)}{$aContentDataErrors.project_question_30}{/if}</p></td>
<td><input type="text" name="project_question_31" value="{if isset($aContentData)}{$aContentData.project_question_31}{/if}" class="small{if isset($aContentDataErrors.project_question_31)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_31)}{$aContentDataErrors.project_question_31}{/if}</p></td>
</tr>
<tr{cycle name="block_08" values=' class="odd",'}>
<td style="text-align: left;">Комментарий к структуре доходов <div class="info"><span>Планируются ли существенные изменения?</span></div></td>
<td colspan="4"><textarea name="project_question_33">{if isset($aContentData)}{$aContentData.project_question_33}{/if}</textarea></td>
</tr>
</table>

<div class="options_add open" for="leaders">Лидеры проекта ({if isset($aLeaders)}{count($aLeaders)}{else}0{/if})</div>
<table class="base_table leaders">
<tr>
<th colspan="4"><strong>Лидер ЛИСС * <div class="info white"><span>ФИО или id лидера ЛИСС</span></div></strong></th>
<th><strong>Роль лидера в проекте</strong></th>
<th colspan="2" class="small"><strong>Период участия <div class="info white"><span>Примерные даты (от и до) участия лидера в проекте, если известно</span></div></strong></th>
<th class="small"><strong>Сортировка * <div class="info white"><span>Порядковый номер лидера у проекта. Особенно важен выбор первого лидера</span></div></strong></th>
{if isset($aContentData.leader_id) and $bLeaderProjectDeleteEnabled}<th class="small"></th>{/if}
</tr>
{assign var="iLeaderOrderMax" value="0"}
{if isset($aLeaders)}
{foreach from=$aLeaders item=item}
{if $iLeaderOrderMax lt $item.leader_order}{assign var="iLeaderOrderMax" value="`$item.leader_order`"}{/if}
<tr{cycle name="leaders" values=' class="odd",'}>
{if $item.leader_id eq ""}
<td><input class="search_link_2" id="leader_project_old_{$item.leader_project_id}" type="text" name="leader_surname_old[{$item.leader_project_id}]" value="{$item.leader_surname}" placeholder="фамилия или id" autocomplete="off" /></td>
<td><input type="text" name="leader_name_old[{$item.leader_project_id}]" value="{$item.leader_name}" placeholder="имя" /></td>
<td><input type="text" name="leader_patronymic_old[{$item.leader_project_id}]" value="{$item.leader_patronymic}" placeholder="отчество" /></td>
<td class="small"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=create&content_id={$item.leader_project_id}" target="_blank" onclick="return confirm('Вы уверены, что хотите создать лидера ЛИСС?');">создать</a></td>
{else}
<td colspan="4"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view&content_id={$item.leader_id}" target="_blank">{$item.leader_surname}{if $item.leader_name ne ""} {$item.leader_name}{if $item.leader_patronymic ne ""} {$item.leader_patronymic}{/if}{/if} ({$item.leader_id})</a></td>
{/if}
<td><input type="text" name="leader_role_old[{$item.leader_project_id}]" value="{$item.leader_role}" /></td>
<td><input type="text" name="leader_date_from_old[{$item.leader_project_id}]" class="small" id="leader_date_from_{$item.leader_project_id}" value="{$item.leader_date_from}" /></td>
<td><input type="text" name="leader_date_to_old[{$item.leader_project_id}]" class="small" id="leader_date_to_{$item.leader_project_id}" value="{$item.leader_date_to}" /></td>
<td><input type="text" name="leader_order_old[{$item.leader_project_id}]" class="small" value="{$item.leader_order}" />
<script>
$(function(){
  $("#project_date_from_{$item.leader_project_id}").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1
  });

  $("#project_date_to_{$item.leader_project_id}").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1
  });
});
</script>
</td>
{if isset($aContentData.project_id) and $bLeaderProjectDeleteEnabled}<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=leader_delete&content_id={$item.leader_project_id}" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a></td>{/if}
</tr>
{/foreach}
{/if}
{section name=for loop=4}
{assign var="iLeaderOrderMax" value="`$iLeaderOrderMax+1`"}
<tr{cycle name="leaders" values=' class="odd",'}>
<td><input class="search_link_2" id="leader_project_new_{$smarty.section.for.iteration}" type="text" name="leader_surname_new[{$smarty.section.for.iteration}]"{if isset($aContentDataDefault) and $smarty.section.for.iteration eq 1} value="{$aContentDataDefault.leader_id}"{/if} placeholder="фамилия или id" autocomplete="off" /></td>
<td><input type="text" name="leader_name_new[{$smarty.section.for.iteration}]" placeholder="имя" /></td>
<td><input type="text" name="leader_patronymic_new[{$smarty.section.for.iteration}]" placeholder="отчество" /></td>
<td class="small"></td>
<td><input type="text" name="leader_role_new[{$smarty.section.for.iteration}]" /></td>
<td><input type="text" name="leader_date_from_new[{$smarty.section.for.iteration}]" class="small" id="leader_date_from_new_{$smarty.section.for.iteration}" /></td>
<td><input type="text" name="leader_date_to_new[{$smarty.section.for.iteration}]" class="small" id="leader_date_to_new_{$smarty.section.for.iteration}" /></td>
<td><input type="text" name="leader_order_new[{$smarty.section.for.iteration}]" class="small" value="{$iLeaderOrderMax}" />
<script>
$(function(){
  $("#leader_date_from_new_{$smarty.section.for.iteration}").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1
  });

  $("#leader_date_to_new_{$smarty.section.for.iteration}").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1
  });
});
</script></td>
{if isset($aContentData.leader_id) and $bLeaderProjectDeleteEnabled}<td></td>{/if}
</tr>
{/section}
</table>

<div class="options_add open" for="block_09">Масштаб проекта и воздействие</div>
<table class="form_table block_09">
<tbody>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td style="width: 40%;">Среднемесячное количество посещений сайта/страницы <div class="info"><span>На основании данных Similarweb</span></div></td>
<td><input type="text" name="project_question_34" value="{if isset($aContentData)}{$aContentData.project_question_34}{/if}" class="small{if isset($aContentDataErrors.project_question_34)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_34)}{$aContentDataErrors.project_question_34}{/if}</p></td>
</tr>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Среднемесячное количество посещений из России <div class="info"><span>На основании данных Similarweb</span></div></td>
<td><input type="text" name="project_question_35" value="{if isset($aContentData)}{$aContentData.project_question_35}{/if}" class="small{if isset($aContentDataErrors.project_question_35)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_35)}{$aContentDataErrors.project_question_35}{/if}</p></td>
</tr>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Количество человек в команде <div class="info"><span>Количество человек, включая соратников, амбассадоров, волонтеров</span></div></td>
<td><input type="text" name="project_question_36" value="{if isset($aContentData)}{$aContentData.project_question_36}{/if}" class="small{if isset($aContentDataErrors.project_question_36)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_36)}{$aContentDataErrors.project_question_36}{/if}</p></td>
</tr>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Членов команды в штате <div class="info"><span>Количество штатных сотрудников</span></div></td>
<td><input type="text" name="project_question_37" value="{if isset($aContentData)}{$aContentData.project_question_37}{/if}" class="small{if isset($aContentDataErrors.project_question_37)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_37)}{$aContentDataErrors.project_question_37}{/if}</p></td>
</tr>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Общее количество пользователей/потребителей в год <div class="info"><span>Количество человек, которые воспользовались услугами/продуктами проекта</span></div></td>
<td><input type="text" name="project_question_38" value="{if isset($aContentData)}{$aContentData.project_question_38}{/if}" class="small{if isset($aContentDataErrors.project_question_38)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_38)}{$aContentDataErrors.project_question_38}{/if}</p></td>
</tr>
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Общее количество пользователей/потребителей в год в России <div class="info"><span>Количество человек, которые воспользовались услугами/продуктами проекта из России</span></div></td>
<td><input type="text" name="project_question_39" value="{if isset($aContentData)}{$aContentData.project_question_39}{/if}" class="small{if isset($aContentDataErrors.project_question_39)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.project_question_39)}{$aContentDataErrors.project_question_39}{/if}</p></td>
</tr>
{if isset($aOptions[9])}
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>География деятельности <div class="info"><span>География деятельности (по факту на текущий момент)</span></div></td>
<td><select name="project_question_40"><option></option>{foreach from=$aOptions[9]["option_value"] item=item}<option value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.project_question_40 eq $item.option_value_id} selected{/if}>{$item.option_value}</option>{/foreach}</select>
</td>
</tr>
{/if}
<tr{cycle name="content_data_09" values=' class="odd",'}>
<td>Комментарий</td>
<td><textarea name="project_question_47">{if isset($aContentData)}{$aContentData.project_question_47}{/if}</textarea></td>
</tr>
</tbody>
</table>


<table class="wrap_sub">
<tr>
<td></td>
<td><input type="submit" value="Сохранить"/></td>
</tr>
</table>

</form>

<p>Поля отмеченные * обязательны для заполнения.</p>

<div id="search_block"></div>