<?php

namespace XoopsModules\Service;

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

use XoopsModules\Service;

defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Services
 */
class Services extends \XoopsObject
{
	/**
	 * Constructor
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('ser_id', XOBJ_DTYPE_INT);
		$this->initVar('ser_cat', XOBJ_DTYPE_INT);
		$this->initVar('ser_title', XOBJ_DTYPE_TXTBOX);
		$this->initVar('ser_desc', XOBJ_DTYPE_OTHER);
		$this->initVar('ser_img', XOBJ_DTYPE_TXTBOX);
	}

	/**
	 * @static function &getInstance
	 *
	 * @param null
	 */
	public static function getInstance()
	{
		static $instance = false;
		if (!$instance) {
			$instance = new self();
		}
	}

	/**
	 * The new inserted $Id
	 * @return inserted id
	 */
	public function getNewInsertedIdServices()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return \XoopsThemeForm
	 */
	public function getFormServices($action = false)
	{
		$helper = \XoopsModules\Service\Helper::getInstance();
		if (!$action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		$isAdmin = $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
		// Permissions for uploader
		$grouppermHandler = xoops_getHandler('groupperm');
		$groups = is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->getGroups() : XOOPS_GROUP_ANONYMOUS;
		$permissionUpload = $grouppermHandler->checkRight('upload_groups', 32, $groups, $GLOBALS['xoopsModule']->getVar('mid')) ? true : false;
		// Title
		$title = $this->isNew() ? sprintf(_AM_SERVICE_SERVICE_ADD) : sprintf(_AM_SERVICE_SERVICE_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Use tag module
		$dirTag = is_dir(XOOPS_ROOT_PATH . '/modules/tag') ? true : false;
		if (($helper->getConfig('usetag') == 1) && $dirTag) {
			$tagId = $this->isNew() ? 0 : $this->getVar('ser_id');
			include_once XOOPS_ROOT_PATH . '/modules/tag/include/formtag.php';
			$form->addElement(new \XoopsFormTag('tag', 60, 255, $tagId, 0), true);
		}
		// Form Table categories
		$categoriesHandler = $helper->getHandler('Categories');
		$serCatSelect = new \XoopsFormSelect(_AM_SERVICE_SERVICE_CAT, 'ser_cat', $this->getVar('ser_cat'));
		$serCatSelect->addOptionArray($categoriesHandler->getList());
		$form->addElement($serCatSelect, true);
		// Form Text serTitle
		$form->addElement(new \XoopsFormText(_AM_SERVICE_SERVICE_TITLE, 'ser_title', 50, 255, $this->getVar('ser_title')), true);
		// Form Editor DhtmlTextArea serDesc
		$editorConfigs = [];
		if ($isAdmin) {
			$editor = $helper->getConfig('editor_admin');
		} else {
			$editor = $helper->getConfig('editor_user');
		}
		$editorConfigs['name'] = 'ser_desc';
		$editorConfigs['value'] = $this->getVar('ser_desc', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $editor;
		$form->addElement(new \XoopsFormEditor(_AM_SERVICE_SERVICE_DESC, 'ser_desc', $editorConfigs), true);
		// Form Image serImg
		// Form Image serImg: Select Uploaded Image 
		$getSerImg = $this->getVar('ser_img');
		$serImg = $getSerImg ?  : 'blank.gif';
		$imageDirectory = '/uploads/service/images/services';
		$imageTray = new \XoopsFormElementTray(_AM_SERVICE_SERVICE_IMG, '<br>');
		$imageSelect = new \XoopsFormSelect(sprintf(_AM_SERVICE_SERVICE_IMG_UPLOADS, ".{$imageDirectory}/"), 'ser_img', $serImg, 5);
		$imageArray = \XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . $imageDirectory );
		foreach ($imageArray as $image1) {
			$imageSelect->addOption((string)($image1), $image1);
		}
		$imageSelect->setExtra("onchange='showImgSelected(\"imglabel_ser_img\", \"ser_img\", \"" . $imageDirectory . '", "", "' . XOOPS_URL . "\")'");
		$imageTray->addElement($imageSelect, false);
		$imageTray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $imageDirectory . '/' . $serImg . "' id='imglabel_ser_img' alt='' style='max-width:100px' />"));
		// Form Image serImg: Upload new image
		if ($permissionUpload) {
			$maxsize = $helper->getConfig('maxsize_image');
			$imageTray->addElement(new \XoopsFormFile('<br>' . _AM_SERVICE_FORM_UPLOAD_NEW, 'ser_img', $maxsize));
			$imageTray->addElement(new \XoopsFormLabel(_AM_SERVICE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . _AM_SERVICE_FORM_UPLOAD_SIZE_MB));
			$imageTray->addElement(new \XoopsFormLabel(_AM_SERVICE_FORM_UPLOAD_IMG_WIDTH, $helper->getConfig('maxwidth_image') . ' px'));
			$imageTray->addElement(new \XoopsFormLabel(_AM_SERVICE_FORM_UPLOAD_IMG_HEIGHT, $helper->getConfig('maxheight_image') . ' px'));
		} else {
			$imageTray->addElement(new \XoopsFormHidden('ser_img', $serImg));
		}
		$form->addElement($imageTray, true);
		// Permissions
		$memberHandler = xoops_getHandler('member');
		$groupList = $memberHandler->getGroupList();
		$grouppermHandler = xoops_getHandler('groupperm');
		$fullList[] = array_keys($groupList);
		if (!$this->isNew()) {
			$groupsIdsApprove = $grouppermHandler->getGroupIds('service_approve_services', $this->getVar('ser_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsApprove[] = array_values($groupsIdsApprove);
			$groupsCanApproveCheckbox = new \XoopsFormCheckBox(_AM_SERVICE_PERMISSIONS_APPROVE, 'groups_approve_services[]', $groupsIdsApprove);
			$groupsIdsSubmit = $grouppermHandler->getGroupIds('service_submit_services', $this->getVar('ser_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsSubmit[] = array_values($groupsIdsSubmit);
			$groupsCanSubmitCheckbox = new \XoopsFormCheckBox(_AM_SERVICE_PERMISSIONS_SUBMIT, 'groups_submit_services[]', $groupsIdsSubmit);
			$groupsIdsView = $grouppermHandler->getGroupIds('service_view_services', $this->getVar('ser_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsView[] = array_values($groupsIdsView);
			$groupsCanViewCheckbox = new \XoopsFormCheckBox(_AM_SERVICE_PERMISSIONS_VIEW, 'groups_view_services[]', $groupsIdsView);
		} else {
			$groupsCanApproveCheckbox = new \XoopsFormCheckBox(_AM_SERVICE_PERMISSIONS_APPROVE, 'groups_approve_services[]', $fullList);
			$groupsCanSubmitCheckbox = new \XoopsFormCheckBox(_AM_SERVICE_PERMISSIONS_SUBMIT, 'groups_submit_services[]', $fullList);
			$groupsCanViewCheckbox = new \XoopsFormCheckBox(_AM_SERVICE_PERMISSIONS_VIEW, 'groups_view_services[]', $fullList);
		}
		// To Approve
		$groupsCanApproveCheckbox->addOptionArray($groupList);
		$form->addElement($groupsCanApproveCheckbox);
		// To Submit
		$groupsCanSubmitCheckbox->addOptionArray($groupList);
		$form->addElement($groupsCanSubmitCheckbox);
		// To View
		$groupsCanViewCheckbox->addOptionArray($groupList);
		$form->addElement($groupsCanViewCheckbox);
		// To Save
		$form->addElement(new \XoopsFormHidden('op', 'save'));
		$form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}

	/**
	 * Get Values
	 * @param null $keys
	 * @param null $format
	 * @param null $maxDepth
	 * @return array
	 */
	public function getValuesServices($keys = null, $format = null, $maxDepth = null)
	{
		$helper  = \XoopsModules\Service\Helper::getInstance();
		$utility = new \XoopsModules\Service\Utility();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id']         = $this->getVar('ser_id');
		$categoriesHandler = $helper->getHandler('Categories');
		$categoriesObj = $categoriesHandler->get($this->getVar('ser_cat'));
		$ret['cat']        = $categoriesObj->getVar('cat_name');
		$ret['title']      = $this->getVar('ser_title');
		$ret['desc']       = $this->getVar('ser_desc', 'e');
		$editorMaxchar = $helper->getConfig('editor_maxchar');
		$ret['desc_short'] = $utility::truncateHtml($ret['desc'], $editorMaxchar);
		$ret['img']        = $this->getVar('ser_img');
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayServices()
	{
		$ret = [];
		$vars = $this->getVars();
		foreach (array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('"{$var}"');
		}
		return $ret;
	}
}
