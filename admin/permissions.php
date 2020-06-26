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

// Template Index
$templateMain = 'service_admin_permissions.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('permissions.php'));

$op = Request::getCmd('op', 'global');

// Get Form
include_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
xoops_load('XoopsFormLoader');
$permTableForm = new \XoopsSimpleForm('', 'fselperm', 'permissions.php', 'post');
$formSelect = new \XoopsFormSelect('', 'op', $op);
$formSelect->setExtra('onchange="document.fselperm.submit()"');
$formSelect->addOption('global', _AM_SERVICE_PERMISSIONS_GLOBAL);
$formSelect->addOption('approve_services', _AM_SERVICE_PERMISSIONS_APPROVE . ' Services');
$formSelect->addOption('submit_services', _AM_SERVICE_PERMISSIONS_SUBMIT . ' Services');
$formSelect->addOption('view_services', _AM_SERVICE_PERMISSIONS_VIEW . ' Services');
$permTableForm->addElement($formSelect);
$permTableForm->display();
switch ($op) {
	case 'global':
	default:
		$formTitle = _AM_SERVICE_PERMISSIONS_GLOBAL;
		$permName = 'service_ac';
		$permDesc = _AM_SERVICE_PERMISSIONS_GLOBAL_DESC;
		$globalPerms = array( '4' => _AM_SERVICE_PERMISSIONS_GLOBAL_4, '8' => _AM_SERVICE_PERMISSIONS_GLOBAL_8, '16' => _AM_SERVICE_PERMISSIONS_GLOBAL_16 );
		break;
	case 'approve_services':
		$formTitle = _AM_SERVICE_PERMISSIONS_APPROVE;
		$permName = 'service_approve_services';
		$permDesc = _AM_SERVICE_PERMISSIONS_APPROVE_DESC . ' Services';
		$handler = $helper->getHandler('services');
		break;
	case 'submit_services':
		$formTitle = _AM_SERVICE_PERMISSIONS_SUBMIT;
		$permName = 'service_submit_services';
		$permDesc = _AM_SERVICE_PERMISSIONS_SUBMIT_DESC . ' Services';
		$handler = $helper->getHandler('services');
		break;
	case 'view_services':
		$formTitle = _AM_SERVICE_PERMISSIONS_VIEW;
		$permName = 'service_view_services';
		$permDesc = _AM_SERVICE_PERMISSIONS_VIEW_DESC . ' Services';
		$handler = $helper->getHandler('services');
		break;
}
$moduleId = $xoopsModule->getVar('mid');
$permform = new \XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php');
$permFound = false;
if ('global' === $op) {
	foreach ($globalPerms as $gPermId => $gPermName) {
		$permform->addItem($gPermId, $gPermName);
	}
	$GLOBALS['xoopsTpl']->assign('form', $permform->render());
	$permFound = true;
}
if ($op === 'approve_services' || $op === 'submit_services' || $op === 'view_services') {
	$servicesCount = $servicesHandler->getCountServices();
	if ($servicesCount > 0) {
		$servicesAll = $servicesHandler->getAllServices(0, 'ser_cat');
		foreach (array_keys($servicesAll) as $i) {
			$permform->addItem($servicesAll[$i]->getVar('ser_id'), $servicesAll[$i]->getVar('ser_cat'));
		}
		$GLOBALS['xoopsTpl']->assign('form', $permform->render());
	}
	$permFound = true;
}
unset($permform);
if (true !== $permFound) {
	redirect_header('permissions.php', 3, _AM_SERVICE_NO_PERMISSIONS_SET);
	exit();
}
require __DIR__ . '/footer.php';
