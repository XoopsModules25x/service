<{include file='db:service_header.tpl' }>

<{if $servicesCount > 0}>
	<!-- Start show new services in index -->

			<!-- Start new link loop -->
			<{section name=i loop=$services}>
			
					<{include file='db:service_services_list.tpl' service=$services[i]}>
			
				<{if $services[i].count is div by $divideby}>
					
				<{/if}>
			<{/section}>
			<!-- End new link loop -->

<{/if}>

