<!-- Header -->
<{include file='db:service_admin_header.tpl' }>

<{if $categories_list}>
	<table class='table table-bordered'>
		<thead>
			<tr class='head'>
				<th class="center"><{$smarty.const._AM_SERVICE_CATEGORIE_ID}></th>
				<th class="center"><{$smarty.const._AM_SERVICE_CATEGORIE_NAME}></th>
				<th class="center"><{$smarty.const._AM_SERVICE_CATEGORIE_LOGO}></th>
				<th class="center"><{$smarty.const._AM_SERVICE_CATEGORIE_CREATED}></th>
				<th class="center"><{$smarty.const._AM_SERVICE_CATEGORIE_SUBMITTER}></th>
				<th class="center width5"><{$smarty.const._AM_SERVICE_FORM_ACTION}></th>
			</tr>
		</thead>
		<{if $categories_count}>
		<tbody>
			<{foreach item=categorie from=$categories_list}>
			<tr class='<{cycle values='odd, even'}>'>
				<td class='center'><{$categorie.id}></td>
				<td class='center'><{$categorie.name}></td>
				<td class='center'><img src="<{$service_upload_url}>/images/categories/<{$categorie.logo}>" alt="categories" style="max-width:100px" /></td>
				<td class='center'><{$categorie.created}></td>
				<td class='center'><{$categorie.submitter}></td>
				<td class="center  width5">
					<a href="categories.php?op=edit&amp;cat_id=<{$categorie.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}> categories" /></a>
					<a href="categories.php?op=delete&amp;cat_id=<{$categorie.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}> categories" /></a>
				</td>
			</tr>
			<{/foreach}>
		</tbody>
		<{/if}>
	</table>
	<div class="clear">&nbsp;</div>
	<{if $pagenav}>
		<div class="xo-pagenav floatright"><{$pagenav}></div>
		<div class="clear spacer"></div>
	<{/if}>
<{/if}>
<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>

<!-- Footer -->
<{include file='db:service_admin_footer.tpl' }>
