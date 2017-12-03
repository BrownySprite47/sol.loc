<div class="sub_links">
{if isset($aContentData.option_value_id)}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=option_values&action_name=view">создать вариант ответа</a> | {/if}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=option_values&action_name=list">справочники</a>
</div>

<div class="bread_crumbs"><p>Справочники / {if isset($aContentData.option_value_id)}редактирование варианта ответа{else}создание варианта ответа{/if}</p></div>

<form id="form_option_values" action="{#PROJECT_BACKEND_URL#}index.php?module_name=option_values&action_name=edit{if isset($aContentData.option_value_id)}&content_id={$aContentData.option_value_id}{/if}" method="post">
<table class="form_table">
<tbody>
{if isset($aContentData.option_value_id)}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Вопрос</td>
<td>{$aContentData.option_name}</td>
</tr>
{else}
{if isset($aOptions)}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Вопрос *</td>
<td><select name="option_id"{if isset($aContentDataErrors.option_id)} class="error"{/if}><option></option>{foreach from=$aOptions item=item}<option value="{$item.option_id}"{if isset($aContentData) and $aContentData.option_id eq $item.option_id} selected{/if}>{$item.option_name}</option>{/foreach}</select><p class="error_text">{if isset($aContentDataErrors.option_id)}{$aContentDataErrors.option_id}{/if}</p></td>
</tr>
{/if}
{/if}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Вариант ответа *</td>
<td><input type="text" name="option_value" value="{if isset($aContentData)}{$aContentData.option_value}{/if}"{if isset($aContentDataErrors.option_value)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.option_value)}{$aContentDataErrors.option_value}{/if}</p></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Подсказка</td>
<td><textarea name="option_value_help">{if isset($aContentData)}{$aContentData.option_value_help}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Сортировка *</td>
<td><input type="text" name="option_order" value="{if isset($aContentData)}{$aContentData.option_order}{else}{#ORDER_DEFAULT#}{/if}" class="small{if isset($aContentDataErrors.option_order)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.option_order)}{$aContentDataErrors.option_order}{/if}</p></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Комментарий</td>
<td><textarea name="option_value_comment">{if isset($aContentData)}{$aContentData.option_value_comment}{/if}</textarea></td>
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