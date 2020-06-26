<small>
    <{if $rating_5stars}>
        <div class="service_ratingblock">
            <div id="unit_long<{$item.id}>">
                <div id="unit_ul<{$item.id}>" class="service_unit-rating">
                    <div class="service_current-rating" style="width:<{$item.rating.size}>;"><{$item.rating.text}></div>
                    <div>
                        <a class="service_r1-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=1&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING1}>" rel="nofollow">1</a>
                    </div>
                    <div>
                        <a class="service_r2-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=2&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING2}>" rel="nofollow">2</a>
                    </div>
                    <div>
                        <a class="service_r3-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=3&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING3}>" rel="nofollow">3</a>
                    </div>
                    <div>
                        <a class="service_r4-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=4&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING4}>" rel="nofollow">4</a>
                    </div>
                    <div>
                        <a class="service_r5-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=5&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING5}>" rel="nofollow">5</a>
                    </div>
                </div>
                <div>
                    <{$item.rating.text}>
                </div>
            </div>
        </div>
    <{/if}>
    <{if $rating_10stars}>
        <div class="service_ratingblock">
            <div id="unit_long<{$item.id}>">
                <div id="unit_ul<{$item.id}>" class="service_unit-rating-10">
                    <div class="service_current-rating" style="width:<{$item.rating.size}>;"><{$item.rating.text}></div>
                    <div>
                        <a class="service_r1-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=1&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_10_1}>" rel="nofollow">1</a>
                    </div>
                    <div>
                        <a class="service_r2-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=2&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_10_2}>" rel="nofollow">2</a>
                    </div>
                    <div>
                        <a class="service_r3-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=3&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_10_3}>" rel="nofollow">3</a>
                    </div>
                    <div>
                        <a class="service_r4-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=4&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_10_4}>" rel="nofollow">4</a>
                    </div>
                    <div>
                        <a class="service_r5-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=5&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_10_5}>" rel="nofollow">5</a>
                    </div>
                    <div>
                        <a class="service_r6-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=6&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_10_6}>" rel="nofollow">6</a>
                    </div>
                    <div>
                        <a class="service_r7-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=7&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_10_7}>" rel="nofollow">7</a>
                    </div>
                    <div>
                        <a class="service_r8-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=8&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_10_8}>" rel="nofollow">8</a>
                    </div>
                    <div>
                        <a class="service_r9-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=9&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_10_9}>" rel="nofollow">9</a>
                    </div>
                    <div>
                        <a class="service_r10-unit rater" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=10&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_10_10}>" rel="nofollow">10</a>
                    </div>
                </div>
                <div>
                    <{$item.rating.text}>
                </div>
            </div>
        </div>
    <{/if}>
<{if $rating_10num}>
        <div class="service_ratingblock">
            <div id="unit_long<{$item.id}>">
                <div id="unit_ul<{$item.id}>" class="service_unit-rating-10numeric">
                    <a class="service-rater-numeric <{if $item.rating.avg_rate_value >=1}>service-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=1&amp;source=1" rel="nofollow">1</a>
                    <a class="service-rater-numeric <{if $item.rating.avg_rate_value >=2}>service-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=2&amp;source=1" rel="nofollow">2</a>
                    <a class="service-rater-numeric <{if $item.rating.avg_rate_value >=3}>service-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=3&amp;source=1" rel="nofollow">3</a>
                    <a class="service-rater-numeric <{if $item.rating.avg_rate_value >=4}>service-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=4&amp;source=1" rel="nofollow">4</a>
                    <a class="service-rater-numeric <{if $item.rating.avg_rate_value >=5}>service-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=5&amp;source=1" rel="nofollow">5</a>
                    <a class="service-rater-numeric <{if $item.rating.avg_rate_value >=6}>service-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=6&amp;source=1" rel="nofollow">6</a>
                    <a class="service-rater-numeric <{if $item.rating.avg_rate_value >=7}>service-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=7&amp;source=1" rel="nofollow">7</a>
                    <a class="service-rater-numeric <{if $item.rating.avg_rate_value >=8}>service-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=8&amp;source=1" rel="nofollow">8</a>
                    <a class="service-rater-numeric <{if $item.rating.avg_rate_value >=9}>service-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=9&amp;source=1" rel="nofollow">9</a>
                    <a class="service-rater-numeric <{if $item.rating.avg_rate_value >=10}>service-rater-numeric-active<{/if}>" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=10&amp;source=1" rel="nofollow">10</a>
                </div>
                <div class='left'>
                    <{$item.rating.text}>
                </div>
            </div>
        </div>
    <{/if}>
    <{if $rating_likes}>
        <div class="service_ratingblock">
            <a class="service-rate-like" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=1&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_LIKE}>" rel="nofollow">
                <img class='service-btn-icon' src='<{$service_icon_url_16}>/like.png' alt='<{$smarty.const._MA_SERVICE_RATING_LIKE}>' title='<{$smarty.const._MA_SERVICE_RATING_LIKE}>'>(<{$item.rating.likes}>)</a>

            <a class="service-rate-dislike" href="rate.php?op=save&amp;<{$itemid}>=<{$item.id}>&rating=-1&amp;source=1" title="<{$smarty.const._MA_SERVICE_RATING_DISLIKE}>" rel="nofollow">
                <img class='service-btn-icon' src='<{$service_icon_url_16}>/dislike.png' alt='<{$smarty.const._MA_SERVICE_RATING_DISLIKE}>' title='<{$smarty.const._MA_SERVICE_RATING_DISLIKE}>'> (<{$item.rating.dislikes}>)</a>
        </div>
    <{/if}>
</small>