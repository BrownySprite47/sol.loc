<div class="sub_links">
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=backend_users&action_name=view">создать пользователя</a>
</div>

<div class="bread_crumbs"><p>Пользователи / список пользователей</p></div>

{if isset($aContentList)}
<table class="base_table">
<tr>
<th><strong>ФИО</strong></th>
<th><strong>Права</strong></th>
<th><strong>Доступ</strong></th>
<th colspan="2" class="small"></th>
</tr>

{foreach from=$aContentList item=item}
<tr{cycle name="content_list" values=' class="odd",'}>
<td>{$item.backend_user_name}</td>
<td>{$item.backend_access_types}</td>
<td>{if $item.backend_user_enabled eq 1}+{else}-{/if}</td>
<td><a href="{#PROJECT_BACKEND_URL#}index.php?module_name=backend_users&action_name=view&content_id={$item.backend_user_id}"><img src="{#PROJECT_BACKEND_URL#}images/edit.png" alt="Редактировать" /></a></td>
<td>{if $item.backend_user_delete_enabled}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=backend_users&action_name=delete&content_id={$item.backend_user_id}" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="{#PROJECT_BACKEND_URL#}images/delete.png" alt="Удалить" /></a>{/if}</td>
</tr>
{/foreach}

</table>
{else}
<p>Пока пользователей не создано.</p>
{/if}