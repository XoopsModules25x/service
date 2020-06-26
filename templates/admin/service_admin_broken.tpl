<!-- Header -->
<{include file='db:service_admin_header.tpl' }>

<h3><{$services_result}></h3>
<{if $services_count}>
	<table class='table table-bordered'>
		<thead>
			<tr class='head'>
				<th class='center'><{$smarty.const._AM_SERVICE_BROKEN_TABLE}></th>
				<th class='center'><{$smarty.const._AM_SERVICE_BROKEN_MAIN}></th>
				<th class='center width5'><{$smarty.const._AM_SERVICE_FORM_ACTION}></th>
			</tr>
		</thead>
		<tbody>
			<{foreach item=service from=$services_list}>
			<tr class='<{cycle values='odd, even'}>'>
				<td class='center'><{$service.table}></td>
				<td class='center'><{$service.main}></td>
				<td class='center width5'>
					<a href='services.php?op=edit&amp;<{$service.key}>=<{$service.keyval}>' title='<{$smarty.const._EDIT}>'><img src='<{xoModuleIcons16 edit.png}>' alt='services' /></a>
					<a href='services.php?op=delete&amp;<{$service.key}>=<{$service.keyval}>' title='<{$smarty.const._DELETE}>'><img src='<{xoModuleIcons16 delete.png}>' alt='services' /></a>
				</td>
			</tr>
			<{/foreach}>
		</tbody>
	</table>
	<div class='clear'>&nbsp;</div>
	<{if $pagenav}>
		<div class='xo-pagenav floatright'><{$pagenav}></div>
		<div class='clear spacer'></div>
	<{/if}>
<{else}>
	<{if $nodataServices}>
		<div>
			<{$nodataServices}><img src='<{xoModuleIcons32 button_ok.png}>' alt='services' />
		</div>
		<div class='clear spacer'></div>
		<br />
		<br />
	<{/if}>
<{/if}>
<br />
<br />
<br />
<{if $error}>
	<div class='errorMsg'>
<strong><{$error}></strong>	</div>
<{/if}>

<!-- Footer -->
<{include file='db:service_admin_footer.tpl' }>
