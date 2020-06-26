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
// Request cat_id
$catId = Request::getInt('cat_id');
switch ($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet($style, null);
		$start = Request::getInt('start', 0);
		$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
		$templateMain = 'service_admin_categories.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
		$adminObject->addItemButton(_AM_SERVICE_ADD_CATEGORIE, 'categories.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$categoriesCount = $categoriesHandler->getCountCategories();
		$categoriesAll = $categoriesHandler->getAllCategories($start, $limit);
		$GLOBALS['xoopsTpl']->assign('categories_count', $categoriesCount);
		$GLOBALS['xoopsTpl']->assign('service_url', SERVICE_URL);
		$GLOBALS['xoopsTpl']->assign('service_upload_url', SERVICE_UPLOAD_URL);
		// Table view categories
		if ($categoriesCount > 0) {
			foreach (array_keys($categoriesAll) as $i) {
				$categorie = $categoriesAll[$i]->getValuesCategories();
				$GLOBALS['xoopsTpl']->append('categories_list', $categorie);
				unset($categorie);
			}
			// Display Navigation
			if ($categoriesCount > $limit) {
				include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
				$pagenav = new \XoopsPageNav($categoriesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _AM_SERVICE_THEREARENT_CATEGORIES);
		}
		break;
	case 'new':
		$templateMain = 'service_admin_categories.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
		$adminObject->addItemButton(_AM_SERVICE_CATEGORIES_LIST, 'categories.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Form Create
		$categoriesObj = $categoriesHandler->create();
		$form = $categoriesObj->getFormCategories();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'save':
		// Security Check
		if (!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('categories.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if ($catId > 0) {
			$categoriesObj = $categoriesHandler->get($catId);
		} else {
			$categoriesObj = $categoriesHandler->create();
		}
		// Set Vars
		$categoriesObj->setVar('cat_name', Request::getString('cat_name', ''));
		// Set Var cat_logo
		include_once XOOPS_ROOT_PATH . '/class/uploader.php';
		$filename       = $_FILES['cat_logo']['name'];
		$imgMimetype    = $_FILES['cat_logo']['type'];
		$imgNameDef     = Request::getString('cat_name');
		$uploaderErrors = '';
		$uploader = new \XoopsMediaUploader(SERVICE_UPLOAD_IMAGE_PATH . '/categories/', 
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
					$imgHandler->sourceFile    = SERVICE_UPLOAD_IMAGE_PATH . '/categories/' . $savedFilename;
					$imgHandler->endFile       = SERVICE_UPLOAD_IMAGE_PATH . '/categories/' . $savedFilename;
					$imgHandler->imageMimetype = $imgMimetype;
					$imgHandler->maxWidth      = $maxwidth;
					$imgHandler->maxHeight     = $maxheight;
					$result                    = $imgHandler->resizeImage();
				}
				$categoriesObj->setVar('cat_logo', $savedFilename);
			}
		} else {
			if ($filename > '') {
				$uploaderErrors = $uploader->getErrors();
			}
			$categoriesObj->setVar('cat_logo', Request::getString('cat_logo'));
		}
		$categorieCreated = date_create_from_format(_SHORTDATESTRING, Request::getString('cat_created'));
		$categoriesObj->setVar('cat_created', $categorieCreated->getTimestamp());
		$categoriesObj->setVar('cat_submitter', Request::getInt('cat_submitter', 0));
		// Insert Data
		if ($categoriesHandler->insert($categoriesObj)) {
			if ('' !== $uploaderErrors) {
				redirect_header('categories.php?op=edit&cat_id=' . $catId, 5, $uploaderErrors);
			} else {
				redirect_header('categories.php?op=list', 2, _AM_SERVICE_FORM_OK);
			}
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
		$form = $categoriesObj->getFormCategories();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'edit':
		$templateMain = 'service_admin_categories.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
		$adminObject->addItemButton(_AM_SERVICE_ADD_CATEGORIE, 'categories.php?op=new', 'add');
		$adminObject->addItemButton(_AM_SERVICE_CATEGORIES_LIST, 'categories.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$categoriesObj = $categoriesHandler->get($catId);
		$form = $categoriesObj->getFormCategories();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		break;
	case 'delete':
		$templateMain = 'service_admin_categories.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
		$categoriesObj = $categoriesHandler->get($catId);
		$catName = $categoriesObj->getVar('cat_name');
		if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if (!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('categories.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if ($categoriesHandler->delete($categoriesObj)) {
				redirect_header('categories.php', 3, _AM_SERVICE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
			}
		} else {
			$xoopsconfirm = new Common\XoopsConfirm(
				['ok' => 1, 'cat_id' => $catId, 'op' => 'delete'],
				$_SERVER['REQUEST_URI'],
				sprintf(_AM_SERVICE_FORM_SURE_DELETE, $categoriesObj->getVar('cat_name')));
			$form = $xoopsconfirm->getFormXoopsConfirm();
			$GLOBALS['xoopsTpl']->assign('form', $form->render());
		}
		break;
}
require __DIR__ . '/footer.php';
