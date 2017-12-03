<div class="sub_links">
{if isset($aContentData.region_id)}<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=regions&action_name=view">создать регион</a> | {/if}
<a href="{#PROJECT_BACKEND_URL#}index.php?module_name=regions&action_name=list">список регионов</a>
</div>

<div class="bread_crumbs"><p>Регионы / {if isset($aContentData.region_id)}редактирование региона{else}создание региона{/if}</p></div>

<form id="form_regions" action="{#PROJECT_BACKEND_URL#}index.php?module_name=regions&action_name=edit{if isset($aContentData.region_id)}&content_id={$aContentData.region_id}{/if}" method="post">
<table class="form_table">
<tbody>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Регион *</td>
<td><input type="text" name="region_name" value="{if isset($aContentData)}{$aContentData.region_name}{/if}"{if isset($aContentDataErrors.region_name)} class="error"{/if} /><p class="error_text">{if isset($aContentDataErrors.region_name)}{$aContentDataErrors.region_name}{/if}</p></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Сортировка *</td>
<td><input type="text" name="region_order" value="{if isset($aContentData)}{$aContentData.region_order}{else}{#ORDER_DEFAULT#}{/if}" class="small{if isset($aContentDataErrors.region_order)} error{/if}" /><p class="error_text">{if isset($aContentDataErrors.region_order)}{$aContentDataErrors.region_order}{/if}</p></td>
</tr>
<tr{cycle name="content_data" values=' class="odd",'}>
<td>Комментарий</td>
<td><textarea name="region_comment">{if isset($aContentData)}{$aContentData.region_comment}{/if}</textarea></td>
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