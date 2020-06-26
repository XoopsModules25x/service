

<{if count($block)}>
<{foreach item=service from=$block}>
        <div class="col-lg-3 col-sm-6 mb-6">
            <div class="card border-0 shadow rounded-xs pt-5">
                <div class="card-body"><img src="<{$service_upload_url}>/images/services/<{$service.img}>" width="90" height="85" alt="services" />  
                    <h4 class="mt-4 mb-3"><{$service.title}></h4>
                    <p><{$service.desc}></p>
                </div>
            </div>
        </div>
<{/foreach}>		
<{/if}>		
		
<style>
.shadow,
.subscription-wrapper {
    box-shadow: 0px 15px 39px 0px rgba(8, 18, 109, 0.1) !important
}
.card-body {
    padding: 20px;
}
</style>