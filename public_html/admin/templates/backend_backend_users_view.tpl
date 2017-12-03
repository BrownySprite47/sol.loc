<div class="sub_links">
{if isset($aContentData.backend_user_id)}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=backend_users&action_name=view">создать пользователя</a> | {/if}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=backend_users&action_name=list">список пользователей</a>
</div>

<div class="bread_crumbs"><p>Пользователи / {if isset($aContentData.backend_user_id)}редактирование пользователя{else}создание пользователя{/if}</p></div>

<form id="form_backend_users" action="{#PROJECT_BACKEND_URL#}index.php?module_name=backend_users&action_name=edit{if isset($aContentData.backend_user_id)}&content_id={$aContentData.backend_user_id}{/if}" method="post">
<table class="form_table">
<tbody>
{if isset($aContentData.backend_user_id)}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Id пользователя</td>
<td>{$aContentData.backend_user_id}</td>
</tr>
{/if}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>ФИО *</td>
<td><input type="text" name="backend_user_name" value="{if isset($aContentData)}{$aContentData.backend_user_name}{/if}"{if isset($aContentDataErrors.backend_user_name)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.backend_user_name)}{$aContentDataErrors.backend_user_name}{/if}</p></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Логин *</td>
<td><input type="text" name="backend_user_login" value="{if isset($aContentData)}{$aContentData.backend_user_login}{/if}"{if isset($aContentDataErrors.backend_user_login)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.backend_user_login)}{$aContentDataErrors.backend_user_login}{/if}</p></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Пароль *</td>
<td><input type="password" name="backend_user_password" value=""{if isset($aContentDataErrors.backend_user_password)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.backend_user_password)}{$aContentDataErrors.backend_user_password}{/if}</p></td>
</tr>
{if isset($aBackendAccessTypes)}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Права</td>
<td>
{foreach from=$aBackendAccessTypes item=item}
<div class="wrap_input">
<input id="backend_access_type_{$item.backend_access_type_id}" type="checkbox" name="backend_access_types[]" value="{$item.backend_access_type_id}"{if isset($aContentData["backend_access_types"][$item.backend_access_type_id])} checked="checked"{/if} />
<label for="backend_access_type_{$item.backend_access_type_id}">{$item.backend_access_type_name}</label>
</div>
{/foreach}
</td>
</tr>
{/if}
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Комментарий</td>
<td><textarea name="backend_user_comment">{if isset($aContentData)}{$aContentData.backend_user_comment}{/if}</textarea></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Доступ разрешен</td>
<td><input type="checkbox" name="backend_user_enabled"{if isset($aContentData) and $aContentData.backend_user_enabled eq 1} checked="checked"{/if} /></td>
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