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
 * Class Object Categories
 */
class Categories extends \XoopsObject
{
	/**
	 * Constructor
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('cat_id', XOBJ_DTYPE_INT);
		$this->initVar('cat_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('cat_logo', XOBJ_DTYPE_TXTBOX);
		$this->initVar('cat_created', XOBJ_DTYPE_INT);
		$this->initVar('cat_submitter', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdCategories()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return \XoopsThemeForm
	 */
	public function getFormCategories($action = false)
	{
		$helper = \XoopsModules\Service\Helper::getInstance();
		if (!$action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		$isAdmin = $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
		// Title
		$title = $this->isNew() ? sprintf(_AM_SERVICE_CATEGORIE_ADD) : sprintf(_AM_SERVICE_CATEGORIE_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text catName
		$form->addElement(new \XoopsFormText(_AM_SERVICE_CATEGORIE_NAME, 'cat_name', 50, 255, $this->getVar('cat_name')), true);
		// Form Text Date Select catCreated
		$catCreated = $this->isNew() ? 0 : $this->getVar('cat_created');
		$form->addElement(new \XoopsFormTextDateSelect(_AM_SERVICE_CATEGORIE_CREATED, 'cat_created', '', $catCreated), true);
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
	public function getValuesCategories($keys = null, $format = null, $maxDepth = null)
	{
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id']        = $this->getVar('cat_id');
		$ret['name']      = $this->getVar('cat_name');
		$ret['logo']      = $this->getVar('cat_logo');
		$ret['created']   = formatTimestamp($this->getVar('cat_created'), 's');
		$ret['submitter'] = \XoopsUser::getUnameFromId($this->getVar('cat_submitter'));
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayCategories()
	{
		$ret = [];
		$vars = $this->getVars();
		foreach (array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('"{$var}"');
		}
		return $ret;
	}
}
