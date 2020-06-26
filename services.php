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
$GLOBALS['xoopsOption']['template_main'] = 'service_services.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $helper->getConfig('userpager'));
$serId = Request::getInt('ser_id', 0);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);

$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('service_url', SERVICE_URL);

$keywords = [];

$permEdit = $permissionsHandler->getPermGlobalSubmit();
$GLOBALS['xoopsTpl']->assign('permEdit', $permEdit);
$GLOBALS['xoopsTpl']->assign('showItem', $serId > 0);

switch ($op) {
	case 'show':
	case 'list':
	default:
		$ratingbars = (int)$helper->getConfig('ratingbars');
		if ($ratingbars > 0) {
			$GLOBALS['xoTheme']->addStylesheet(SERVICE_URL . '/assets/css/rating.css', null);
			$GLOBALS['xoopsTpl']->assign('rating', $ratingbars);
			$GLOBALS['xoopsTpl']->assign('rating_5stars', (Constants::RATING_5STARS === $ratingbars));
			$GLOBALS['xoopsTpl']->assign('rating_10stars', (Constants::RATING_10STARS === $ratingbars));
			$GLOBALS['xoopsTpl']->assign('rating_10num', (Constants::RATING_10NUM === $ratingbars));
			$GLOBALS['xoopsTpl']->assign('rating_likes', (Constants::RATING_LIKES === $ratingbars));
			$GLOBALS['xoopsTpl']->assign('itemid', 'ser_id');
			$GLOBALS['xoopsTpl']->assign('service_icon_url_16', SERVICE_URL . '/' . $modPathIcon16);
		}
		$crServices = new \CriteriaCompo();
		if ($serId > 0) {
			$crServices->add(new \Criteria('ser_id', $serId));
		}
		$servicesCount = $servicesHandler->getCount($crServices);
		$GLOBALS['xoopsTpl']->assign('servicesCount', $servicesCount);
		$crServices->setStart($start);
		$crServices->setLimit($limit);
		$servicesAll = $servicesHandler->getAll($crServices);
		if ($servicesCount > 0) {
			$services = [];
			// Get All Services
			foreach (array_keys($servicesAll) as $i) {
				$services[$i] = $servicesAll[$i]->getValuesServices();
				$keywords[$i] = $servicesAll[$i]->getVar('ser_cat');
				$services[$i]['rating'] = $ratingsHandler->getItemRating($servicesAll[$i]->getVar('ser_id'), Constants::TABLE_SERVICES);
			}
			$GLOBALS['xoopsTpl']->assign('services', $services);
			unset($services);
			// Display Navigation
			if ($servicesCount > $limit) {
				include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
				$pagenav = new \XoopsPageNav($servicesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
			$GLOBALS['xoopsTpl']->assign('type', $helper->getConfig('table_type'));
			$GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
			$GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
		}
		break;
	case 'save':
		// Security Check
		if (!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('services.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		// Check permissions
		if (!$permissionsHandler->getPermGlobalSubmit()) {
			redirect_header('services.php?op=list', 3, _NOPERM);
		}
		if ($serId > 0) {
			$servicesObj = $servicesHandler->get($serId);
		} else {
			$servicesObj = $servicesHandler->create();
		}
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
			$newSerId = $serId > 0 ? $serId : $servicesObj->getNewInsertedIdServices();
			$grouppermHandler = xoops_getHandler('groupperm');
			$mid = $GLOBALS['xoopsModule']->getVar('mid');
			// Permission to view_services
			$grouppermHandler->deleteByModule($mid, 'service_view_services', $newSerId);
			if (isset($_POST['groups_view_services'])) {
				foreach ($_POST['groups_view_services'] as $onegroupId) {
					$grouppermHandler->addRight('service_view_services', $newSerId, $onegroupId, $mid);
				}
			}
			// Permission to submit_services
			$grouppermHandler->deleteByModule($mid, 'service_submit_services', $newSerId);
			if (isset($_POST['groups_submit_services'])) {
				foreach ($_POST['groups_submit_services'] as $onegroupId) {
					$grouppermHandler->addRight('service_submit_services', $newSerId, $onegroupId, $mid);
				}
			}
			// Permission to approve_services
			$grouppermHandler->deleteByModule($mid, 'service_approve_services', $newSerId);
			if (isset($_POST['groups_approve_services'])) {
				foreach ($_POST['groups_approve_services'] as $onegroupId) {
					$grouppermHandler->addRight('service_approve_services', $newSerId, $onegroupId, $mid);
				}
			}
			// Handle notification
			$serCat = $servicesObj->getVar('ser_cat');
			$tags = [];
			$tags['ITEM_NAME'] = $serCat;
			$tags['ITEM_URL']  = XOOPS_URL . '/modules/service/services.php?op=show&ser_id=' . $serId;
			$notificationHandler = xoops_getHandler('notification');
			if ($serId > 0) {
				// Event modify notification
				$notificationHandler->triggerEvent('global', 0, 'global_modify', $tags);
				$notificationHandler->triggerEvent('services', $newSerId, 'service_modify', $tags);
			} else {
				// Event new notification
				$notificationHandler->triggerEvent('global', 0, 'global_new', $tags);
			}
			// redirect after insert
			if ('' !== $uploaderErrors) {
				redirect_header('services.php?op=edit&ser_id=' . $newSerId, 5, $uploaderErrors);
			} else {
				redirect_header('services.php?op=list', 2, _MA_SERVICE_FORM_OK);
			}
		}
		// Get Form Error
		$GLOBALS['xoopsTpl']->assign('error', $servicesObj->getHtmlErrors());
		$form = $servicesObj->getFormServices();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'new':
		// Check permissions
		if (!$permissionsHandler->getPermGlobalSubmit()) {
			redirect_header('services.php?op=list', 3, _NOPERM);
		}
		// Form Create
		$servicesObj = $servicesHandler->create();
		$form = $servicesObj->getFormServices();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'edit':
		// Check permissions
		if (!$permissionsHandler->getPermGlobalSubmit()) {
			redirect_header('services.php?op=list', 3, _NOPERM);
		}
		// Check params
		if (0 == $serId) {
			redirect_header('services.php?op=list', 3, _MA_SERVICE_INVALID_PARAM);
		}
		// Get Form
		$servicesObj = $servicesHandler->get($serId);
		$form = $servicesObj->getFormServices();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'delete':
		// Check permissions
		if (!$permissionsHandler->getPermGlobalSubmit()) {
			redirect_header('services.php?op=list', 3, _NOPERM);
		}
		// Check params
		if (0 == $serId) {
			redirect_header('services.php?op=list', 3, _MA_SERVICE_INVALID_PARAM);
		}
		$servicesObj = $servicesHandler->get($serId);
		$serCat = $servicesObj->getVar('ser_cat');
		if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if (!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('services.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if ($servicesHandler->delete($servicesObj)) {
				// Event delete notification
				$tags = [];
				$tags['ITEM_NAME'] = $serCat;
				$notificationHandler = xoops_getHandler('notification');
				$notificationHandler->triggerEvent('global', 0, 'global_delete', $tags);
				$notificationHandler->triggerEvent('services', $serId, 'service_delete', $tags);
				redirect_header('services.php', 3, _MA_SERVICE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $servicesObj->getHtmlErrors());
			}
		} else {
			$xoopsconfirm = new Common\XoopsConfirm(
				['ok' => 1, 'ser_id' => $serId, 'op' => 'delete'],
				$_SERVER['REQUEST_URI'],
				sprintf(_MA_SERVICE_FORM_SURE_DELETE, $servicesObj->getVar('ser_cat')));
			$form = $xoopsconfirm->getFormXoopsConfirm();
			$GLOBALS['xoopsTpl']->assign('form', $form->render());
		}
		break;
	case 'broken':
		// Check params
		if (0 == $serId) {
			redirect_header('services.php?op=list', 3, _MA_SERVICE_INVALID_PARAM);
		}
		$servicesObj = $servicesHandler->get($serId);
		$serCat = $servicesObj->getVar('ser_cat');
		if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if (!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('services.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			$servicesObj->setVar('', Constants::STATUS_BROKEN);
			if ($servicesHandler->insert($servicesObj)) {
				// Event broken notification
				$tags = [];
				$tags['ITEM_NAME'] = $serCat;
				$tags['ITEM_URL']  = XOOPS_URL . '/modules/service/services.php?op=show&ser_id=' . $serId;
				$notificationHandler = xoops_getHandler('notification');
				$notificationHandler->triggerEvent('global', 0, 'global_broken', $tags);
				$notificationHandler->triggerEvent('services', $serId, 'service_broken', $tags);
				redirect_header('services.php', 3, _MA_SERVICE_FORM_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $servicesObj->getHtmlErrors());
			}
		} else {
			$xoopsconfirm = new Common\XoopsConfirm(
				['ok' => 1, 'ser_id' => $serId, 'op' => 'broken'],
				$_SERVER['REQUEST_URI'],
				sprintf(_MA_SERVICE_FORM_SURE_BROKEN, $servicesObj->getVar('ser_cat')));
			$form = $xoopsconfirm->getFormXoopsConfirm();
			$GLOBALS['xoopsTpl']->assign('form', $form->render());
		}
		break;
}

// Breadcrumbs
$xoBreadcrumbs[] = ['title' => _MA_SERVICE_SERVICES];

// Keywords
serviceMetaKeywords($helper->getConfig('keywords') . ', ' . implode(',', $keywords));
unset($keywords);

// Description
serviceMetaDescription(_MA_SERVICE_SERVICES_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', SERVICE_URL.'/services.php');
$GLOBALS['xoopsTpl']->assign('service_upload_url', SERVICE_UPLOAD_URL);

require __DIR__ . '/footer.php';
