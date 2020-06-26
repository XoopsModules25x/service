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
$serId = Request::getInt('ser_id');
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
if (empty($serId)) {
	redirect_header(SERVICE_URL . '/index.php', 2, _MA_SERVICE_NOSERID);
}
// Get Instance of Handler
$servicesHandler = $helper->getHandler('Services');
// Verify that the article is published
$services = $servicesHandler->get($serId);
// Verify permissions
if (!$grouppermHandler->checkRight('service_view', $serId->getVar('ser_id'), $groups, $GLOBALS['xoopsModule']->getVar('mid'))) {
	redirect_header(SERVICE_URL . '/index.php', 3, _NOPERM);
	exit();
}
$service = $services->getValuesServices();
foreach ($service as $k => $v) {
	$GLOBALS['xoopsTpl']->append('"{$k}"', $v);
}
$GLOBALS['xoopsTpl']->assign('xoops_sitename', $GLOBALS['xoopsConfig']['sitename']);
$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', strip_tags($service->getVar('ser_cat') - _MA_SERVICE_PRINT - $GLOBALS['xoopsModule']->name()));
$GLOBALS['xoopsTpl']->display('db:services_print.tpl');
