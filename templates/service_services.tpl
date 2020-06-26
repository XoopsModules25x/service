<{include file='db:service_header.tpl' }>

<{if $servicesCount > 0}>
<div class='table-responsive'>
	<table class='table table-<{$table_type}>'>
		<thead>
			<tr class='head'>
				<th colspan='<{$divideby}>'><{$smarty.const._MA_SERVICE_SERVICES_TITLE}></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<{foreach item=service from=$services}>
				<td>
					<div class='panel panel-<{$panel_type}>'>
						<{include file='db:service_services_item.tpl' }>
					</div>
				</td>
				<{if $service.count is div by $divideby}>
					</tr><tr>
				<{/if}>
				<{/foreach}>
			</tr>
		</tbody>
		<tfoot><tr><td>&nbsp;</td></tr></tfoot>
	</table>
</div>
<{/if}>
<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<{$error}>
<{/if}>

<{include file='db:service_footer.tpl' }>
