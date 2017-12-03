<div class="sub_links">
{if isset($aContentData.city_id)}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=cities&action_name=view">создать город</a> | {/if}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=cities&action_name=list">список городов</a>
</div>

<div class="bread_crumbs"><p>Города / {if isset($aContentData.city_id)}редактирование города{else}создание города{/if}</p></div>

<form id="form_cities" action="{#PROJECT_BACKEND_URL#}index.php?module_name=cities&action_name=edit{if isset($aContentData.city_id)}&content_id={$aContentData.city_id}{/if}" method="post">
<table class="form_table">
<tbody>
{if isset($aContentData.city_id)}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Id города</td>
<td>{$aContentData.city_id}</td>
</tr>
{/if}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Город *</td>
<td><input type="text" name="city_name" value="{if isset($aContentData)}{$aContentData.city_name}{/if}"{if isset($aContentDataErrors.city_name)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.city_name)}{$aContentDataErrors.city_name}{/if}</p></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Сортировка *</td>
<td><input type="text" name="city_order" value="{if isset($aContentData)}{$aContentData.city_order}{else}{#ORDER_DEFAULT#}{/if}" class="small{if isset($aContentDataErrors.city_order)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.city_order)}{$aContentDataErrors.city_order}{/if}</p></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Комментарий</td>
<td><textarea name="city_comment">{if isset($aContentData)}{$aContentData.city_comment}{/if}</textarea></td>
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