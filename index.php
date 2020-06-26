<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Service module for xoops
 *
 * @copyright      2020 XOOPS Project (https://xooops.org)
 * @license        GPL 2.0 or later
 * @package        service
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         B.Heyula - Email:<b.heyula@hotmail.com> - Website:<http://erenyumak.com>
 */

use Xmf\Request;
use XoopsModules\Service;
use XoopsModules\Service\Constants;

require __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'service_index.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
$keywords = [];
// 
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('service_url', SERVICE_URL);
// 
$servicesCount = $servicesHandler->getCountServices();
$GLOBALS['xoopsTpl']->assign('servicesCount', $servicesCount);
$count = 1;
if ($servicesCount > 0) {
	$start = Request::getInt('start', 0);
	$limit = Request::getInt('limit', $helper->getConfig('userpager'));
	$servicesAll = $servicesHandler->getAllServices($start, $limit);
	// Get All Services
	$services = [];
	foreach (array_keys($servicesAll) as $i) {
		$service = $servicesAll[$i]->getValuesServices();
		$acount = ['count', $count];
		$services[] = array_merge($service, $acount);
		$keywords[] = $servicesAll[$i]->getVar('ser_cat');
		++$count;
	}
	$GLOBALS['xoopsTpl']->assign('services', $services);
	unset($services);
	// Display Navigation
	if ($servicesCount > $limit) {
		include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
		$pagenav = new \XoopsPageNav($servicesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
		$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
	}
	$GLOBALS['xoopsTpl']->assign('lang_thereare', sprintf(_MA_SERVICE_INDEX_THEREARE, $servicesCount));
	$GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
	$GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => _MA_SERVICE_INDEX];
// Keywords
serviceMetaKeywords($helper->getConfig('keywords') . ', ' . implode(',', $keywords));
unset($keywords);
// Description
serviceMetaDescription(_MA_SERVICE_INDEX_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', SERVICE_URL.'/index.php');
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('service_upload_url', SERVICE_UPLOAD_URL);
require __DIR__ . '/footer.php';
