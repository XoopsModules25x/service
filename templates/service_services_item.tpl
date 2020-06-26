            <div class="col-md-12">
               <div class="ts-service-box">
                  <div class="ts-service-box-img pull-left">
                     <img src="<{$service_upload_url}>/images/services/<{$service.img}>" alt="" />
                  </div>
                  <div class="ts-service-info">
                     <h3 class="service-box-title"><a href="services.php?op=show&amp;ser_id=<{$service.ser_id}>"><{$service.title}></a></h3>
                     <p><{$service.desc}></p>
                  </div>
               </div>
            </div>
<{if $rating}>
	<{include file='db:service_rate.tpl' item=$service}>
<{/if}>


