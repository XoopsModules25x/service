<{include file="db:service_header.tpl"}>
<table class="service">
    <thead class="outer">
        <tr class="head">
            <th class="center"><{$smarty.const._MA_SERVICE_SER_ID}></th>
            <th class="center"><{$smarty.const._MA_SERVICE_SER_CAT}></th>
            <th class="center"><{$smarty.const._MA_SERVICE_SER_TITLE}></th>
            <th class="center"><{$smarty.const._MA_SERVICE_SER_DESC}></th>
            <th class="center"><{$smarty.const._MA_SERVICE_SER_IMG}></th>
        </tr>
    </thead>
    <tbody>
        <{foreach item=list from=$services}>
            <tr class="<{cycle values='odd, even'}>">
                <td class="center"><{$list.id}></td>
                <td class="center"><{$list.cat}></td>
                <td class="center"><{$list.title}></td>
                <td class="center"><{$list.desc}></td>
                <td class="center"><img src="<{$service_upload_url}>/images/services/<{$list.img}>" alt="services"></td>
            </tr>
        <{/foreach}>
    </tbody>
</table>
<{include file="db:service_footer.tpl"}>