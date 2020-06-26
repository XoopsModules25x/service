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

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
$templateMain = 'service_admin_broken.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('broken.php'));

// Check table services
$start = Request::getInt('startServices', 0);
$limit = Request::getInt('limitServices', $helper->getConfig('adminpager'));
$crServices = new \CriteriaCompo();
$crServices->add(new \Criteria('', Constants::STATUS_BROKEN));
$servicesCount = $servicesHandler->getCount($crServices);
$GLOBALS['xoopsTpl']->assign('services_count', $servicesCount);
$GLOBALS['xoopsTpl']->assign('services_result', sprintf(_AM_SERVICE_BROKEN_RESULT, 'Services'));
$crServices->setStart($start);
$crServices->setLimit($limit);
if ($servicesCount > 0) {
	$servicesAll = $servicesHandler->getAll($crServices);
	foreach (array_keys($servicesAll) as $i) {
		$service['table'] = 'Services';
		$service['key'] = 'ser_id';
		$service['keyval'] = $servicesAll[$i]->getVar('ser_id');
		$service['main'] = $servicesAll[$i]->getVar('ser_cat');
		$GLOBALS['xoopsTpl']->append('services_list', $service);
	}
	// Display Navigation
	if ($servicesCount > $limit) {
		include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
		$pagenav = new \XoopsPageNav($servicesCount, $limit, $start, 'startServices', 'op=list&limitServices=' . $limit);
		$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
	}
} else {
	$GLOBALS['xoopsTpl']->assign('nodataServices', sprintf(_AM_SERVICE_BROKEN_NODATA, 'Services'));
}
unset($crServices);

require __DIR__ . '/footer.php';
