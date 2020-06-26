<!-- Header -->
<{include file='db:service_admin_header.tpl' }>

<{if $services_list}>
	<table class='table table-bordered'>
		<thead>
			<tr class='head'>
				<th class="center"><{$smarty.const._AM_SERVICE_SERVICE_ID}></th>
				<th class="center"><{$smarty.const._AM_SERVICE_SERVICE_CAT}></th>
				<th class="center"><{$smarty.const._AM_SERVICE_SERVICE_TITLE}></th>
				<th class="center"><{$smarty.const._AM_SERVICE_SERVICE_DESC}></th>
				<th class="center"><{$smarty.const._AM_SERVICE_SERVICE_IMG}></th>
				<th class="center width5"><{$smarty.const._AM_SERVICE_FORM_ACTION}></th>
			</tr>
		</thead>
		<{if $services_count}>
		<tbody>
			<{foreach item=service from=$services_list}>
			<tr class='<{cycle values='odd, even'}>'>
				<td class='center'><{$service.id}></td>
				<td class='center'><{$service.cat}></td>
				<td class='center'><{$service.title}></td>
				<td class='center'><{$service.desc_short}></td>
				<td class='center'><img src="<{$service_upload_url}>/images/services/<{$service.img}>" alt="services" style="max-width:100px" /></td>
				<td class="center  width5">
					<a href="services.php?op=edit&amp;ser_id=<{$service.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}> services" /></a>
					<a href="services.php?op=delete&amp;ser_id=<{$service.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}> services" /></a>
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
