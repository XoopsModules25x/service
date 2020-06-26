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
use XoopsModules\Service\Common;

require __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = Request::getCmd('op', 'list');
// Request ser_id
$serId = Request::getInt('ser_id');
switch ($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet($style, null);
		$start = Request::getInt('start', 0);
		$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
		$templateMain = 'service_admin_services.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('services.php'));
		$adminObject->addItemButton(_AM_SERVICE_ADD_SERVICE, 'services.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$servicesCount = $servicesHandler->getCountServices();
		$servicesAll = $servicesHandler->getAllServices($start, $limit);
		$GLOBALS['xoopsTpl']->assign('services_count', $servicesCount);
		$GLOBALS['xoopsTpl']->assign('service_url', SERVICE_URL);
		$GLOBALS['xoopsTpl']->assign('service_upload_url', SERVICE_UPLOAD_URL);
		// Table view services
		if ($servicesCount > 0) {
			foreach (array_keys($servicesAll) as $i) {
				$service = $servicesAll[$i]->getValuesServices();
				$GLOBALS['xoopsTpl']->append('services_list', $service);
				unset($service);
			}
			// Display Navigation
			if ($servicesCount > $limit) {
				include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
				$pagenav = new \XoopsPageNav($servicesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _AM_SERVICE_THEREARENT_SERVICES);
		}
		break;
	case 'new':
		$templateMain = 'service_admin_services.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('services.php'));
		$adminObject->addItemButton(_AM_SERVICE_SERVICES_LIST, 'services.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Form Create
		$servicesObj = $servicesHandler->create();
		$form = $servicesObj->getFormServices();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'save':
		// Security Check
		if (!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('services.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if ($serId > 0) {
			$servicesObj = $servicesHandler->get($serId);
		} else {
			$servicesObj = $servicesHandler->create();
		}
		// Set Vars
		$servicesObj->setVar('ser_cat', Request::getInt('ser_cat', 0));
		$servicesObj->setVar('ser_title', Request::getString('ser_title', ''));
		$servicesObj->setVar('ser_desc', Request::getText('ser_desc', ''));
		// Set Var ser_img
		include_once XOOPS_ROOT_PATH . '/class/uploader.php';
		$filename       = $_FILES['ser_img']['name'];
		$imgMimetype    = $_FILES['ser_img']['type'];
		$imgNameDef     = Request::getString('ser_cat');
		$uploaderErrors = '';
		$uploader = new \XoopsMediaUploader(SERVICE_UPLOAD_IMAGE_PATH . '/services/', 
													$helper->getConfig('mimetypes_image'), 
													$helper->getConfig('maxsize_image'), null, null);
		if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$extension = preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
			$imgName = str_replace(' ', '', $imgNameDef) . '.' . $extension;
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if (!$uploader->upload()) {
				$uploaderErrors = $uploader->getErrors();
			} else {
				$savedFilename = $uploader->getSavedFileName();
				$maxwidth  = (int)$helper->getConfig('maxwidth_image');
				$maxheight = (int)$helper->getConfig('maxheight_image');
				if ($maxwidth > 0 && $maxheight > 0) {
					// Resize image
					$imgHandler                = new Service\Common\Resizer();
					$imgHandler->sourceFile    = SERVICE_UPLOAD_IMAGE_PATH . '/services/' . $savedFilename;
					$imgHandler->endFile       = SERVICE_UPLOAD_IMAGE_PATH . '/services/' . $savedFilename;
					$imgHandler->imageMimetype = $imgMimetype;
					$imgHandler->maxWidth      = $maxwidth;
					$imgHandler->maxHeight     = $maxheight;
					$result                    = $imgHandler->resizeImage();
				}
				$servicesObj->setVar('ser_img', $savedFilename);
			}
		} else {
			if ($filename > '') {
				$uploaderErrors = $uploader->getErrors();
			}
			$servicesObj->setVar('ser_img', Request::getString('ser_img'));
		}
		// Insert Data
		if ($servicesHandler->insert($servicesObj)) {
			$newSerId = $servicesObj->getNewInsertedIdServices();
			$permId = isset($_REQUEST['ser_id']) ? $serId : $newSerId;
			$grouppermHandler = xoops_getHandler('groupperm');
			$mid = $GLOBALS['xoopsModule']->getVar('mid');
			// Permission to view_services
			$grouppermHandler->deleteByModule($mid, 'service_view_services', $permId);
			if (isset($_POST['groups_view_services'])) {
				foreach ($_POST['groups_view_services'] as $onegroupId) {
					$grouppermHandler->addRight('service_view_services', $permId, $onegroupId, $mid);
				}
			}
			// Permission to submit_services
			$grouppermHandler->deleteByModule($mid, 'service_submit_services', $permId);
			if (isset($_POST['groups_submit_services'])) {
				foreach ($_POST['groups_submit_services'] as $onegroupId) {
					$grouppermHandler->addRight('service_submit_services', $permId, $onegroupId, $mid);
				}
			}
			// Permission to approve_services
			$grouppermHandler->deleteByModule($mid, 'service_approve_services', $permId);
			if (isset($_POST['groups_approve_services'])) {
				foreach ($_POST['groups_approve_services'] as $onegroupId) {
					$grouppermHandler->addRight('service_approve_services', $permId, $onegroupId, $mid);
				}
			}
			if ('' !== $uploaderErrors) {
				redirect_header('services.php?op=edit&ser_id=' . $serId, 5, $uploaderErrors);
			} else {
				redirect_header('services.php?op=list', 2, _AM_SERVICE_FORM_OK);
			}
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $servicesObj->getHtmlErrors());
		$form = $servicesObj->getFormServices();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'edit':
		$templateMain = 'service_admin_services.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('services.php'));
		$adminObject->addItemButton(_AM_SERVICE_ADD_SERVICE, 'services.php?op=new', 'add');
		$adminObject->addItemButton(_AM_SERVICE_SERVICES_LIST, 'services.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$servicesObj = $servicesHandler->get($serId);
		$form = $servicesObj->getFormServices();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'delete':
		$templateMain = 'service_admin_services.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('services.php'));
		$servicesObj = $servicesHandler->get($serId);
		$serCat = $servicesObj->getVar('ser_cat');
		if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if (!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('services.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if ($servicesHandler->delete($servicesObj)) {
				redirect_header('services.php', 3, _AM_SERVICE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $servicesObj->getHtmlErrors());
			}
		} else {
			$xoopsconfirm = new Common\XoopsConfirm(
				['ok' => 1, 'ser_id' => $serId, 'op' => 'delete'],
				$_SERVER['REQUEST_URI'],
				sprintf(_AM_SERVICE_FORM_SURE_DELETE, $servicesObj->getVar('ser_cat')));
			$form = $xoopsconfirm->getFormXoopsConfirm();
			$GLOBALS['xoopsTpl']->assign('form', $form->render());
		}
		break;
}
require __DIR__ . '/footer.php';
