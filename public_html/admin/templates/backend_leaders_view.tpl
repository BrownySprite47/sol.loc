<div class="sub_links">
{if isset($aContentData.leader_id) and $bLeadersEdit}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view">создать лидера ЛИСС</a> | {/if}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=list">список лидеров ЛИСС</a>
</div>

<div class="bread_crumbs"><p>Лидеры ЛИСС / {if isset($aContentData.leader_id)}редактирование{else}создание{/if}</p></div>

{if isset($aContentDataErrors.transaction_id)}
<p class="error_text_header">Данные не могу быть сохранены, так как произошло их изменение. Обновите страницу.</p>
{else}
{if isset($aContentDataErrors) and !empty($aContentDataErrors)}
<p class="error_text_header">Обратите внимание, что данные не сохранены.</p>
{/if}
{/if}

<form id="form_leaders" action="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=edit{if isset($aContentData.leader_id)}&content_id={$aContentData.leader_id}{/if}" method="post">

<input type="hidden" name="transaction_id" value="{if isset($aContentData.leader_id)}{$aContentData.transaction_id}{/if}">

<div class="options_add open" for="block_01">Общая информация</div>
<table class="form_table block_01">
<tbody>
{if isset($aContentData.leader_id)}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Id лидера ЛИСС</td>
<td>{$aContentData.leader_id}</td>
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
{/if}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата интервью <div class="info"><span>Формат: YYYY-MM-DD</span></div></td>
<td><input type="text" name="leader_interview_date" value="{if isset($aContentData)}{$aContentData.leader_interview_date}{else}{$smarty.now|date_format:"%Y-%m-%d"}{/if}" class="small{if isset($aContentDataErrors.leader_interview_date)} error{/if}" id="leader_interview_date" /><p class="error_text">{if isset($aContentDataErrors.leader_interview_date)}{$aContentDataErrors.leader_interview_date}{/if}</p></td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Дата появления в БД <div class="info"><span>Формат: YYYY-MM-DD</span></div></td>
<td><input type="text" name="leader_create_date" value="{if isset($aContentData)}{$aContentData.leader_create_date}{else}{$sLeaderCreateDateRecommend}{/if}" class="small{if isset($aContentDataErrors.leader_create_date)} error{/if}" id="leader_create_date" /> рекомендуемая дата: <a href="#" onclick="$('#leader_create_date').val('{$sLeaderCreateDateRecommend}'); return false;">{$sLeaderCreateDateRecommend}</a><p class="error_text">{if isset($aContentDataErrors.leader_create_date)}{$aContentDataErrors.leader_create_date}{/if}</p></td>
</tr>
{if isset($aBackendUsers)}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Интервьюер</td>
<td><select name="leader_interview_backend_user_id"><option></option>{foreach from=$aBackendUsers item=item}<option value="{$item.backend_user_id}"{if (isset($aContentData.leader_interview_backend_user_id, $aBackendUsers[$aContentData.leader_interview_backend_user_id]) and $aContentData.leader_interview_backend_user_id eq $item.backend_user_id) or (!isset($aContentData.leader_interview_backend_user_id) and $iBackendUserId eq $item.backend_user_id)} selected{/if}>{$item.backend_user_name}</option>{/foreach}</select></td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Кто заполняет анкету</td>
<td><select name="leader_write_backend_user_id"><option></option>{foreach from=$aBackendUsers item=item}<option value="{$item.backend_user_id}"{if (isset($aContentData.leader_write_backend_user_id, $aBackendUsers[$aContentData.leader_write_backend_user_id]) and $aContentData.leader_write_backend_user_id eq $item.backend_user_id) or (!isset($aContentData.leader_write_backend_user_id) and $iBackendUserId eq $item.backend_user_id)} selected{/if}>{$item.backend_user_name}</option>{/foreach}</select></td>
</tr>
{/if}
{if isset($aOptions[1])}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Способ проведения интервью</td>
<td><select name="leader_interview_type"><option></option>{foreach from=$aOptions[1]["option_value"] item=item}<option value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.leader_interview_type eq $item.option_value_id} selected{/if}>{$item.option_value}</option>{/foreach}</select></td>
</tr>
{/if}
{if isset($aRecommendationsFrom)}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Рекомендатели</td>
<td>{foreach from=$aRecommendationsFrom item=item}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view&content_id={$item.leader_id}" target="_blank">{$item.leader_surname}{if $item.leader_name ne ""} {$item.leader_name}{if $item.leader_patronymic ne ""} {$item.leader_patronymic}{/if}{/if}{if $item.project_name ne ""} ({$item.project_name}){/if}</a><br/>{/foreach}</td>
</tr>
{/if}
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Источник контакта <div class="info"><span>Заполняется до интервью</span></div></td>
<td><input type="text" name="leader_contact_from" value="{if isset($aContentData)}{$aContentData.leader_contact_from}{/if}" /></td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Договоренности <div class="info"><span>Следующие шаги, о которых договорились на интервью</span></div></td>
<td><textarea name="leader_interview_result">{if isset($aContentData)}{$aContentData.leader_interview_result}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Комментарий по назначению интервью</td>
<td><textarea name="leader_question_21">{if isset($aContentData)}{$aContentData.leader_question_21}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Статус анкеты</td>
<td><input id="leader_high_priority" type="checkbox" name="leader_high_priority"{if isset($aContentData) and $aContentData.leader_high_priority eq 1} checked{/if} /> <label for="leader_high_priority">приоритетный порядок интервью</label> <input id="leader_enabled" type="checkbox" name="leader_enabled"{if !isset($aContentData) or $aContentData.leader_enabled eq 1} checked{/if} /> <label for="leader_enabled">анкета актуальна</label></td>
</tr>
<tr{cycle name="content_data_01" values=' class="odd",'}>
<td>Заполненность анкеты</td>
<td>
  <!-- <input id="leader_done" type="checkbox" name="leader_done"{if isset($aContentData) and $aContentData.leader_done eq 1} checked{/if} />
  <label for="leader_done">анкета заполнена</label> -->
  <input id="leader_done_1" type="checkbox" name="leader_done_1"{if isset($aContentData) and $aContentData.leader_done_1 eq 1} checked{/if} />
  <label for="leader_done_1">Заполнены минимальные данные</label>
  <input id="leader_done_2" type="checkbox" name="leader_done_2"{if isset($aContentData) and $aContentData.leader_done_2 eq 1} checked{/if} />
  <label for="leader_done_2">Заполнены данные для FAS</label>
  <input id="leader_done_3" type="checkbox" name="leader_done_3"{if isset($aContentData) and $aContentData.leader_done_3 eq 1} checked{/if} />
  <label for="leader_done_3">Внесено все интервью</label>
  <input id="leader_done_4" type="checkbox" name="leader_done_4"{if isset($aContentData) and $aContentData.leader_done_4 eq 1} checked{/if} />
  <label for="leader_done_4">Проставлены теги</label>

</td>
</tr>
</tbody>
</table>
{if isset($aContentData.leader_id) and $bLeadersEdit}
<div class="options_add" for="block_02" id="header-fixed-fio">{if isset($aContentData)}{$aContentData.leader_surname}{/if} {if isset($aContentData)}{$aContentData.leader_name}{/if} {if isset($aContentData)}{$aContentData.leader_patronymic}{/if}</div>
{/if}
<div class="options_add foxFix" for="block_02"><div>Личная информация</div></div>

<table class="form_table block_02">
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Фамилия * <div class="info"><span>Если фамилия неизвестна, пишем "Неизвестно". Если непонятно, как её писать, ставим знак вопроса после фамилии</span></div></td>
<td colspan="2"><input type="text" name="leader_surname" value="{if isset($aContentData)}{$aContentData.leader_surname}{/if}"{if isset($aContentDataErrors.leader_surname)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.leader_surname)}{$aContentDataErrors.leader_surname}{/if}</p></td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Имя</td>
<td colspan="2"><input type="text" name="leader_name" value="{if isset($aContentData)}{$aContentData.leader_name}{/if}" /></td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Отчество <div class="info"><span>Отчество заполняется, если его использование уместно в письмах и других сообщениях</span></div></td>
<td colspan="2"><input type="text" name="leader_patronymic" value="{if isset($aContentData)}{$aContentData.leader_patronymic}{/if}" /></td>
</tr>
{if isset($aSex)}
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Пол</td>
<td colspan="2">{foreach from=$aSex item=item}<input id="sex_{$item.sex_id}" type="radio" name="sex_id" value="{$item.sex_id}"{if isset($aContentData) and $aContentData.sex_id eq $item.sex_id} checked{/if} /> <label for="sex_{$item.sex_id}">{$item.sex_name}</label> {/foreach}</td>
</tr>
{/if}
{if isset($aCities)}
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Город <div class="info"><span>Основное место жительства. Город или ближайший большой город (столица региона), например для Первоуральска выбирайте Екатеринбург, это нужно для укрупнённой региональной классификации. Если в списке нет, то заполните поле "другой город", для маленьких городов указывайте область</span></div></td>
<td style="width: 10%;"><select name="city_id"><option></option>{foreach from=$aCities item=item}<option value="{$item.city_id}"{if isset($aContentData) and $aContentData.city_id eq $item.city_id} selected{/if}>{$item.city_name}</option>{/foreach}</select></td>
<td><input type="text" name="leader_city_name" value="{if isset($aContentData)}{$aContentData.leader_city_name}{/if}" placeholder="другой город" /></td>
</tr>
{/if}
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Дата рождения <div class="info"><span>Формат: YYYY-MM-DD. Если неизвестен день, устанавливаем 01, если неизвестен месяц, устанавливаем 07, если неизвестен год, даём свою оценку. Если дата известна, то отмечаем "дата точная", будет использоваться для поздравлений</span></div></td>
<td colspan="2"><input type="text" name="leader_birth_date" value="{if isset($aContentData)}{$aContentData.leader_birth_date}{/if}" class="small{if isset($aContentDataErrors.leader_birth_date)} error{/if}" id="leader_birth_date" /> <input id="leader_birth_date_correct" type="checkbox" name="leader_birth_date_correct"{if isset($aContentData) and $aContentData.leader_birth_date_correct eq 1} checked{/if} /> <label for="leader_birth_date_correct">дата точная</label></td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Основное место работы <div class="info"><span>Основное - это значит, что человек там числится и зарабатывает. Формальное "трудовая лежит" не нужно. Лучше всего брать информацию из визитной карточки</span></div></td>
<td colspan="2"><input type="text" name="leader_company" value="{if isset($aContentData)}{$aContentData.leader_company}{/if}" /></td>
</tr>
<tr{cycle name="content_data_02" values=' class="odd",'}>
<td>Должность</td>
<td colspan="2"><input type="text" name="leader_position" value="{if isset($aContentData)}{$aContentData.leader_position}{/if}" /></td>
</tr>
</tbody>
</table>

<div class="options_add" for="block_03">Контакты</div>
<table class="form_table block_03">
<tbody>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Телефон <div class="info"><span>Основной телефон</span></div></td>
<td><input type="text" name="leader_phone" value="{if isset($aContentData)}{$aContentData.leader_phone}{/if}"{if isset($aContentDataErrors.leader_phone)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.leader_phone)}{$aContentDataErrors.leader_phone}{/if}</p></td>
</tr>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>E-mail <div class="info"><span>Основной e-mail</span></div></td>
<td><input type="text" name="leader_email" value="{if isset($aContentData)}{$aContentData.leader_email}{/if}"{if isset($aContentDataErrors.leader_email)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.leader_email)}{$aContentDataErrors.leader_email}{/if}</p></td>
</tr>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Skype <div class="info"><span>Указывется, если удобно сязываться через Skype</span></div></td>
<td><input type="text" name="leader_skype" value="{if isset($aContentData)}{$aContentData.leader_skype}{/if}" /></td>
</tr>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Ссылка на страницу в социальных сетях</td>
<td><input type="text" name="leader_social_network" value="{if isset($aContentData)}{$aContentData.leader_social_network}{/if}" /></td>
</tr>
<tr{cycle name="content_data_03" values=' class="odd",'}>
<td>Дополнительная контактная информация <div class="info"><span>Дополнительные контакты, такие как: телефон (формат: +71231234567), e-mail, социальные сети и т. п.</span></div></td>
<td><textarea name="leader_contacts">{if isset($aContentData)}{$aContentData.leader_contacts}{/if}</textarea></td>
</tr>
</tbody>
</table>

{if isset($aContentData.leader_id)}
<div class="options_add" for="projects">Проекты ({if isset($aProjects)}{count($aProjects)}{else}0{/if})</div>
<table class="base_table projects">
<tr>
<th width="40%" colspan="2"><strong>Проект * <div class="info white"><span>Название или id проекта</span></div></strong></th>
<th width="40%"><strong>Роль лидера в проекте</strong></th>
<th colspan="2" class="small"><strong>Период участия <div class="info white"><span>Примерные даты (от и до) участия лидера в проекте, если известно</span></div></strong></th>
<th class="small"><strong>Сортировка * <div class="info white"><span>Порядковый номер проекта у лидера. Особенно важен выбор первого проекта</span></div></strong></th>
{if isset($aContentData.leader_id) and $bLeaderProjectDeleteEnabled}<th class="small"></th>{/if}
</tr>
{assign var="iProjectOrderMax" value="0"}
{if isset($aProjects)}
{foreach from=$aProjects item=item}
{if $iProjectOrderMax lt $item.project_order}{assign var="iProjectOrderMax" value="`$item.project_order`"}{/if}
<tr{cycle name="projects" values=' class="odd",'}>
{if $item.project_id ne ""}
<td colspan="2"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=view&content_id={$item.project_id}" target="_blank">{$item.project_name} ({$item.leader_name})</a></td>
{else}
<td><input class="search_link_1" id="leader_project_old_{$item.leader_project_id}" type="text" name="project_name[{$item.leader_project_id}]" value="{$item.project_name}" autocomplete="off" placeholder="название проекта или id" /></td>
<td class="small"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=create&content_id={$item.leader_project_id}" target="_blank" onclick="return confirm('Вы уверены, что хотите создать проект?');">создать</a></td>
{/if}
<td><input type="text" name="leader_role[{$item.leader_project_id}]" value="{$item.leader_role}" /></td>
<td><input type="text" name="leader_date_from[{$item.leader_project_id}]" class="small" id="leader_date_from_{$item.leader_project_id}" value="{$item.leader_date_from}" /></td>
<td><input type="text" name="leader_date_to[{$item.leader_project_id}]" class="small" id="leader_date_to_{$item.leader_project_id}" value="{$item.leader_date_to}" /></td>
<td><input type="text" name="project_order[{$item.leader_project_id}]" class="small" value="{$item.project_order}" />
<script>
$(function(){
  $("#leader_date_from_{$item.leader_project_id}").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1,
      yearRange: "1900:+0"
  });

  $("#leader_date_to_{$item.leader_project_id}").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1,
      yearRange: "1900:+0"
  });
});
</script>
</td>
{if isset($aContentData.leader_id) and $bLeaderProjectDeleteEnabled}<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=project_delete&content_id={$item.leader_project_id}" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a></td>{/if}
</tr>
{/foreach}
{/if}
{section name=for loop=4}
{assign var="iProjectOrderMax" value="`$iProjectOrderMax+1`"}
<tr{cycle name="projects" values=' class="odd",'}>
<td><input class="search_link_1" id="leader_project_new_{$smarty.section.for.iteration}" type="text" name="project_name_new[{$smarty.section.for.iteration}]" placeholder="название проекта или id" autocomplete="off" /></td>
<td class="small"></td>
<td><input type="text" name="leader_role_new[{$smarty.section.for.iteration}]" /></td>
<td><input type="text" name="leader_date_from_new[{$smarty.section.for.iteration}]" class="small" id="leader_date_from_new_{$smarty.section.for.iteration}" /></td>
<td><input type="text" name="leader_date_to_new[{$smarty.section.for.iteration}]" class="small" id="leader_date_to_new_{$smarty.section.for.iteration}" /></td>
<td><input type="text" name="project_order_new[{$smarty.section.for.iteration}]" class="small" value="{$iProjectOrderMax}" />
<script>
$(function(){
  $("#leader_date_from_new_{$smarty.section.for.iteration}").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1,
      yearRange: "1900:+0"
  });

  $("#leader_date_to_new_{$smarty.section.for.iteration}").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      firstDay: 1,
      yearRange: "1900:+0"
  });
});
</script>
</td>
{if isset($aContentData.leader_id) and $bLeaderProjectDeleteEnabled}<td></td>{/if}
</tr>
{/section}
<tr{cycle name="projects" values=' class="odd",'}>
<td style="text-align:left;" colspan="{if isset($aContentData.leader_id) and $bLeaderProjectDeleteEnabled}7{else}6{/if}"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=projects&action_name=view&leader_id={$aContentData.leader_id}" target="_blank">создать новый проект</a></td>
</tr>
</table>
{/if}

<div class="options_add" for="block_04">Личные вопросы</div>
<table class="form_table block_04">
<tbody>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Почему Вас рекомендовали, как ЛИСС? <div class="info"><span>Цель вопроса - настроить на тему</span></div></td>
<td><textarea name="leader_question_01">{if isset($aContentData)}{$aContentData.leader_question_01}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Сколько лет Вы реализуете проекты в социальной сфере?</td>
<td><input type="text" name="leader_question_02" value="{if isset($aContentData)}{$aContentData.leader_question_02}{/if}" class="small{if isset($aContentDataErrors.leader_question_02)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.leader_question_02)}{$aContentDataErrors.leader_question_02}{/if}</p></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Что привело в социальную сферу? <div class="info"><span>Цель вопроса - выявить изначальную мотивацию</span></div></td>
<td><textarea name="leader_question_03">{if isset($aContentData)}{$aContentData.leader_question_03}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Зачем Вы занимаетесь проектом? <div class="info"><span>Цель вопроса - выявить личный смысл деятельности</span></div></td>
<td><textarea name="leader_question_04">{if isset($aContentData)}{$aContentData.leader_question_04}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Какие успешные проекты Вы реализовали?</td>
<td><textarea name="leader_question_05">{if isset($aContentData)}{$aContentData.leader_question_05}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>В каких экспертных группах Вы состоите?</td>
<td><textarea name="leader_question_06">{if isset($aContentData)}{$aContentData.leader_question_06}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Комментарии <div class="info"><span>Неформальные комментарии на тему лидера (не публичные)</span></div></td>
<td><textarea name="leader_question_07">{if isset($aContentData)}{$aContentData.leader_question_07}{/if}</textarea></td>
</tr>
{if isset($aOptions[2])}
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Уровень мышления <div class="info"><span>Этот показатель оценивает широту взгляда лидера, на каком уровне он хочет изменить мир</span></div></td>
<td>{foreach from=$aOptions[2]["option_value"] item=item}
<div class="wrap_input">
<input id="option_value_{$item.option_value_id}" type="radio" name="leader_question_08" value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.leader_question_08 eq $item.option_value_id} checked{/if} />
<label for="option_value_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}</td>
</tr>
{/if}
{if isset($aOptions[3])}
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Тип лидера в классификации Ашока <div class="info"><span>Показатель характеризует тип ЛИСС</span></div></td>
<td>{foreach from=$aOptions[3]["option_value"] item=item}
<div class="wrap_input">
<input id="option_value_{$item.option_value_id}" type="radio" name="leader_question_09" value="{$item.option_value_id}"{if isset($aContentData) and $aContentData.leader_question_09 eq $item.option_value_id} checked{/if} />
<label for="option_value_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}</td>
</tr>
{/if}
{if isset($aOptions[4])}
<tr{cycle name="content_data_04" values=' class="odd",'}>
<td>Категория лидера</td>
<td>{foreach from=$aOptions[4]["option_value"] item=item}
<div class="wrap_input">
<input id="option_value_{$item.option_value_id}" type="checkbox" name="options[4][]" value="{$item.option_value_id}"{if $item.option_selected eq 1} checked{/if} />
<label for="option_value_{$item.option_value_id}">{$item.option_value}</label>
</div>
{/foreach}</td>
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
<td><textarea name="leader_question_10">{if isset($aContentData)}{$aContentData.leader_question_10}{/if}</textarea></td>
<td><textarea name="leader_question_11">{if isset($aContentData)}{$aContentData.leader_question_11}{/if}</textarea></td>
<td><textarea name="leader_question_12">{if isset($aContentData)}{$aContentData.leader_question_12}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Проект</td>
<td><textarea name="leader_question_13">{if isset($aContentData)}{$aContentData.leader_question_13}{/if}</textarea></td>
<td><textarea name="leader_question_14">{if isset($aContentData)}{$aContentData.leader_question_14}{/if}</textarea></td>
<td><textarea name="leader_question_15">{if isset($aContentData)}{$aContentData.leader_question_15}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Система</td>
<td><textarea name="leader_question_16">{if isset($aContentData)}{$aContentData.leader_question_16}{/if}</textarea></td>
<td><textarea name="leader_question_17">{if isset($aContentData)}{$aContentData.leader_question_17}{/if}</textarea></td>
<td><textarea name="leader_question_18">{if isset($aContentData)}{$aContentData.leader_question_18}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Потребности в законодательстве <div class="info"><span>Какие изменения в законодательстве помогли бы вам? Какие законы мешают проекту?</span></div></td>
<td colspan="3"><textarea name="leader_question_19">{if isset($aContentData)}{$aContentData.leader_question_19}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data_05" values=' class="odd",'}>
<td>Отношение к социальной деятельности <div class="info"><span>Какое отношение к соей деятельности вы чаще всего встречаете? Как в целом относятся к социальной деятельности?</span></div></td>
<td colspan="3"><textarea name="leader_question_20">{if isset($aContentData)}{$aContentData.leader_question_20}{/if}</textarea></td>
</tr>
</table>







<!-- Начало блока тегов -->


{if isset($aTagsLiders)}
<!-- Исправила for -->
<div class="options_add" for="tags">Теги</div>
<!-- Исправила класс на tags -->
<table class="base_table tags">
<tbody>
<tr>
<th style="width: 30%;" colspan="3"><strong>Наименование объекта</strong></th>
<th style="width: 35%;"><strong>Значение объекта <!-- <div class="info white"><span>Почему Вы его рекомендуете, как ЛИСС? Какие проблемы он решает? Почему Вы думаете, что он действительно решает социальные проблемы? Насколько Вы ему доверяете как человеку и как профессионалу?</span></div> --></strong></th>
<th style="width: 45%;"><strong>Колонка под теги</strong></th>
{if isset($aContentData.leader_id, $aRecommendations) and $bRecommendationDeleteEnabled}<th class="small"></th>{/if}
</tr>
{assign var="iTemp" value="0"}

{if isset($aTagsLiders[0].data.id_leader)}
{foreach from=$aTagsLiders item=item key=index name=count}
{assign var="num" value=$smarty.foreach.count.index+1}
{if $iTemp eq 0}{assign var="iTemp" value="1"}{else}{assign var="iTemp" value="0"}{/if}
{if $item.data.id_leader ne ""}
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="width: 5%; text-align: center;">{$num}</td>
<td colspan="2">
  <p>{$item.object.name.name}</p>
    <input style="display: none;" class="search_link_4" id="object_value_old_1_{$num}_tag" type="text" name="leader_object_old[{$num}]" value="{$item.data.id_name_object}" />
</td>
<td><textarea rows="10" name="object_value_old[{$num}]">{if isset($item.object.value.value_object)}{$item.object.value.value_object}{/if}</textarea></td>
<td>
  {foreach from=$item item=item1}
    <p>{if isset($item1.tag_1.name)} {$item1.tag_1.name}{/if} {if isset($item1.tag_2.name)} / {$item1.tag_2.name}{/if} {if isset($item1.tag_3.name)} / {$item1.tag_3.name}{/if}</p>
  {/foreach}

  <input style="display: none;" class="search_link_4" id="tag_old_1_{$num}_tag" type="text" name="leader_tag_old[{$num}][1]" />
  <input style="margin: 5px 0;" class="search_link_4" id="tag_old_1_{$num}" type="text" placeholder="наименование тега" autocomplete="off" />

  <input style="display: none;" class="search_link_4" id="tag_old_2_{$num}_tag" type="text" name="leader_tag_old[{$num}][2]" />
  <input style="margin: 5px 0;" class="search_link_4" id="tag_old_2_{$num}" type="text" placeholder="наименование тега" autocomplete="off" />

  <input style="display: none;" class="search_link_4" id="tag_old_3_{$num}_tag" type="text" name="leader_tag_old[{$num}][3]" />
  <input style="margin: 5px 0;" class="search_link_4" id="tag_old_3_{$num}" type="text" placeholder="наименование тега" autocomplete="off" />
</td>

{if isset($aTagsLiders[0].data.id_leader)}<td><a href="javascript:void(0);" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a></td>{/if}
<!-- {if isset($aContentData.leader_id) and $bRecommendationDeleteEnabled}<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=recommendation_delete&content_id={$item.id}" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a></td>{/if} -->
</tr>
{else}
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="width: 5%; text-align: center;"></td>
<td colspan="2">

  <input class="search_link_3" id="object_tag_old_{$item.id}_tag" type="text" name="leader_object[{$item.recommendation_id}]" value="{$item.leader_surname}" />
  <input class="search_link_3" id="object_tag_old_{$item.id}" type="text" value="{$item.leader_surname}" placeholder="наименование объекта" autocomplete="off" />

</td>
<td><textarea rows="10" placeholder="значение объекта" name="recommendation_comment_old[{$item.recommendation_id}]">{$item.recommendation_comment}</textarea></td>
<td>
  <br>
<!--     <input class="search_link_4" id="tag_old_1_{$item.id}_tag" type="text" name="leader_tag[{$item.recommendation_id}][1]" />
    <input class="search_link_4" id="tag_old_1_{$item.id}" type="text" value="{$item.leader_surname}" placeholder="наименование тега" autocomplete="off" />

    <input class="search_link_4" id="tag_old_2_{$item.id}_tag" type="text" name="leader_tag[{$item.recommendation_id}][2]" value="{$item.leader_surname}" />
    <input class="search_link_4" id="tag_old_2_{$item.id}" type="text" value="{$item.leader_surname}" placeholder="наименование тега" autocomplete="off" />

    <input class="search_link_4" id="tag_old_3_{$item.id}_tag" type="text" name="leader_tag[{$item.recommendation_id}][3]" value="{$item.leader_surname}" />
    <input class="search_link_4" id="tag_old_3_{$item.recommendation_id}" type="text" value="{$item.leader_surname}" placeholder="наименование тега" autocomplete="off" />

    <input class="search_link_4" id="tag_old_4_{$item.recommendation_id}_tag" type="text" name="leader_tag[{$item.recommendation_id}][4]" value="{$item.leader_surname}" />
    <input class="search_link_4" id="tag_old_4_{$item.recommendation_id}" type="text" value="{$item.leader_surname}" placeholder="наименование тега" autocomplete="off" />

    <input class="search_link_4" id="tag_old_5_{$item.recommendation_id}_tag" type="text" name="leader_tag[{$item.recommendation_id}][5]" value="{$item.leader_surname}" />
    <input class="search_link_4" id="tag_old_5_{$item.recommendation_id}" type="text" value="{$item.leader_surname}" placeholder="наименование тега" autocomplete="off" /> -->

    <br>
    <br>
</td>

<!-- {if isset($aContentData.leader_id)}<td rowspan="6"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=recommendation_delete&content_id={$item.recommendation_id}" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a></td>{/if} -->
</tr>
{/if}
{/foreach}
{/if}

{section name=for loop=3}
{if $iTemp eq 0}{assign var="iTemp" value="1"}{else}{assign var="iTemp" value="0"}{/if}
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="width: 5%; text-align: center;"></td>
<td colspan="2">

  <input style="display: none; " class="search_link_3" id="object_tag_new_{$smarty.section.for.iteration}_tag" type="text" name="leader_object_new[{$smarty.section.for.iteration}]" />
  <input class="search_link_3" id="object_tag_new_{$smarty.section.for.iteration}" type="text" placeholder="наименование объекта" autocomplete="off" />

</td>
<td><textarea placeholder="значение объекта" rows="10" name="object_value_new[{$smarty.section.for.iteration}]"></textarea></td>
<td>
  <br>
  <input style="display: none; " class="search_link_4" id="tag_new_1_{$smarty.section.for.iteration}_tag" type="text" name="leader_tag_new[{$smarty.section.for.iteration}][1]" />
  <input style="margin: 5px 0;" class="search_link_4" id="tag_new_1_{$smarty.section.for.iteration}" type="text" placeholder="наименование тега" autocomplete="off" />

  <input style="display: none; " class="search_link_4" id="tag_new_2_{$smarty.section.for.iteration}_tag" type="text" name="leader_tag_new[{$smarty.section.for.iteration}][2]" />
  <input style="margin: 5px 0;" class="search_link_4" id="tag_new_2_{$smarty.section.for.iteration}" type="text" placeholder="наименование тега" autocomplete="off" />

  <input style="display: none; " class="search_link_4" id="tag_new_3_{$smarty.section.for.iteration}_tag" type="text" name="leader_tag_new[{$smarty.section.for.iteration}][3]" />
  <input style="margin: 5px 0;" class="search_link_4" id="tag_new_3_{$smarty.section.for.iteration}" type="text" placeholder="наименование тега" autocomplete="off" />

  <input style="display: none; " class="search_link_4" id="tag_new_4_{$smarty.section.for.iteration}_tag" type="text" name="leader_tag_new[{$smarty.section.for.iteration}][4]" />
  <input style="margin: 5px 0;" class="search_link_4" id="tag_new_4_{$smarty.section.for.iteration}" type="text" placeholder="наименование тега" autocomplete="off" />

  <input style="display: none; " class="search_link_4" id="tag_new_5_{$smarty.section.for.iteration}_tag" type="text" name="leader_tag_new[{$smarty.section.for.iteration}][5]" />
  <input style="margin: 5px 0;" class="search_link_4" id="tag_new_5_{$smarty.section.for.iteration}" type="text" placeholder="наименование тега" autocomplete="off" />
  <br>
  <br>
</td>
{if isset($aContentData.leader_id, $aRecommendations) and $bRecommendationDeleteEnabled}<td rowspan="6"></td>{/if}
</tr>
{/section}

</tbody>
</table>
{/if}




<!-- Конец блока тегов -->





{if isset($aContentData.leader_id)}
<div class="options_add" for="leaders">Рекомендации (входящие: {$aContentData.recommendations_to_count_all} ({$aContentData.recommendations_to_count_for_interview}), исходящие: {if isset($aRecommendations)}{count($aRecommendations)}{else}0{/if})</div>
<table class="base_table leaders">
<tbody>
<tr>
<th style="width: 40%;" colspan="3"><strong>Рекомендуемый лидер</strong></th>
<th style="width: 40%;"><strong>Причина рекомендации <div class="info white"><span>Почему Вы его рекомендуете, как ЛИСС? Какие проблемы он решает? Почему Вы думаете, что он действительно решает социальные проблемы? Насколько Вы ему доверяете как человеку и как профессионалу?</span></div></strong></th>
<th><strong>Комментарий</strong></th>
{if isset($aContentData.leader_id, $aRecommendations) and $bRecommendationDeleteEnabled}<th class="small"></th>{/if}
</tr>
{assign var="iTemp" value="0"}

{if isset($aRecommendations)}
{foreach from=$aRecommendations item=item}
{if $iTemp eq 0}{assign var="iTemp" value="1"}{else}{assign var="iTemp" value="0"}{/if}
{if $item.leader_id_to ne ""}
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">Лидер</td>
<td colspan="2"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=view&content_id={$item.leader_id_to}" target="_blank">{$item.leader_surname}{if $item.leader_name ne ""} {$item.leader_name}{if $item.leader_patronymic ne ""} {$item.leader_patronymic}{/if}{/if}{if $item.project_name ne ""} ({$item.project_name}){/if}</a></td>
<td><textarea name="recommendation_reason_old[{$item.recommendation_id}]">{$item.recommendation_reason}</textarea></td>
<td><textarea name="recommendation_comment_old[{$item.recommendation_id}]">{$item.recommendation_comment}</textarea></td>
{if isset($aContentData.leader_id) and $bRecommendationDeleteEnabled}<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=recommendation_delete&content_id={$item.recommendation_id}" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a></td>{/if}
</tr>
{else}
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;" rowspan="2">ФИО <div class="info"><span>ФИО или id лидера ЛИСС</span></div></td>
<td><input class="search_link_2" id="recommendation_old_{$item.recommendation_id}" type="text" name="leader_surname_old[{$item.recommendation_id}]" value="{$item.leader_surname}" placeholder="фамилия или id" autocomplete="off" /></td>
<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=create_from_recommendation&content_id={$item.recommendation_id}" target="_blank" onclick="return confirm('Вы уверены, что хотите создать лидера?');">создать</a></td>
<td rowspan="6"><textarea name="recommendation_reason_old[{$item.recommendation_id}]" rows="12">{$item.recommendation_reason}</textarea></td>
<td rowspan="6"><textarea name="recommendation_comment_old[{$item.recommendation_id}]" rows="12">{$item.recommendation_comment}</textarea></td>
{if isset($aContentData.leader_id) and $bRecommendationDeleteEnabled}<td rowspan="6"><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=leaders&action_name=recommendation_delete&content_id={$item.recommendation_id}" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a></td>{/if}
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td><input type="text" name="leader_name_old[{$item.recommendation_id}]" value="{$item.leader_name}" placeholder="имя" /></td>
<td><input type="text" name="leader_patronymic_old[{$item.recommendation_id}]" value="{$item.leader_patronymic}" placeholder="отчество" /></td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">Проект</td>
<td colspan="2"><input type="text" name="leader_project_name_old[{$item.recommendation_id}]" value="{$item.leader_project_name}" /></td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">Город</td>
<td style="text-align: left;">{if isset($aCities)}<select name="city_id_old[{$item.recommendation_id}]"><option></option>{foreach from=$aCities item=i}<option value="{$i.city_id}"{if $item.city_id eq $i.city_id} selected{/if}>{$i.city_name}</option>{/foreach}</select>{/if}</td>
<td><input type="text" name="leader_city_name_old[{$item.recommendation_id}]" placeholder="другой город" value="{$item.leader_city_name}" /></td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">Телефон</td>
<td colspan="2"><input type="text" name="leader_phone_old[{$smarty.section.for.iteration}]" value="{$item.leader_phone}" /></td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">E-mail</td>
<td colspan="2"><input type="text" name="leader_email_old[{$smarty.section.for.iteration}]" value="{$item.leader_email}" /></td>
</tr>
{/if}
{/foreach}
{/if}

{section name=for loop=3}
{if $iTemp eq 0}{assign var="iTemp" value="1"}{else}{assign var="iTemp" value="0"}{/if}
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left" rowspan="2">ФИО <div class="info"><span>ФИО или id лидера ЛИСС</span></div></td>
<td><input class="search_link_2" id="recommendation_new_{$smarty.section.for.iteration}" type="text" name="leader_surname_new[{$smarty.section.for.iteration}]" placeholder="фамилия или id" autocomplete="off" /></td>
<td></td>
<td rowspan="6"><textarea name="recommendation_reason_new[{$smarty.section.for.iteration}]" rows="12"></textarea></td>
<td rowspan="6"><textarea name="recommendation_comment_new[{$smarty.section.for.iteration}]" rows="12"></textarea></td>
{if isset($aContentData.leader_id, $aRecommendations) and $bRecommendationDeleteEnabled}<td rowspan="6"></td>{/if}
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td><input type="text" name="leader_name_new[{$smarty.section.for.iteration}]" placeholder="имя" /></td>
<td><input type="text" name="leader_patronymic_new[{$smarty.section.for.iteration}]" placeholder="отчество" /></td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">Проект</td>
<td colspan="2"><input type="text" name="leader_project_name_new[{$smarty.section.for.iteration}]" /></td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">Город</td>
<td style="text-align: left;">{if isset($aCities)}<select name="city_id_new[{$smarty.section.for.iteration}]"><option></option>{foreach from=$aCities item=item}<option value="{$item.city_id}">{$item.city_name}</option>{/foreach}</select>{/if}</td>
<td><input type="text" name="leader_city_name_new[{$smarty.section.for.iteration}]" placeholder="другой город" /></td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">Телефон</td>
<td colspan="2"><input type="text" name="leader_phone_new[{$smarty.section.for.iteration}]" /></td>
</tr>
<tr{if $iTemp eq 1} class="odd"{/if}>
<td style="text-align: left;">E-mail</td>
<td colspan="2"><input type="text" name="leader_email_new[{$smarty.section.for.iteration}]" /></td>
</tr>
{/section}
</tbody>
</table>
{/if}

<table class="wrap_sub">
<tr>
<td></td>
<td><input style="position: fixed;bottom: 24px;left: 77px;" type="submit" value="Сохранить"/></td>
</tr>
</table>

</form>

<p>Поля отмеченные * обязательны для заполнения.</p>

<script type="text/javascript">fixTableFio();</script>