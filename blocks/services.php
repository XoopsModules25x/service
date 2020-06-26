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

use XoopsModules\Service;
use XoopsModules\Service\Helper;
use XoopsModules\Service\Constants;

include_once XOOPS_ROOT_PATH . '/modules/service/include/common.php';

/**
 * Function show block
 * @param  $options
 * @return array
 */
function b_service_services_show($options)
{
	include_once XOOPS_ROOT_PATH . '/modules/service/class/services.php';
	$myts = MyTextSanitizer::getInstance();
	$GLOBALS['xoopsTpl']->assign('service_upload_url', SERVICE_UPLOAD_URL);
	$block       = [];
	$typeBlock   = $options[0];
	$limit       = $options[1];
	$lenghtTitle = $options[2];
	$helper      = Helper::getInstance();
	$servicesHandler = $helper->getHandler('Services');
	$crServices = new \CriteriaCompo();
	array_shift($options);
	array_shift($options);
	array_shift($options);

	switch ($typeBlock) {
		case 'last':
		default:
			// For the block: services last
			$crServices->setSort('');
			$crServices->setOrder('DESC');
			break;
		case 'new':
			// For the block: services new
			$crServices->add(new \Criteria('', strtotime(date(_SHORTDATESTRING)), '>='));
			$crServices->add(new \Criteria('', strtotime(date(_SHORTDATESTRING))+86400, '<='));
			$crServices->setSort('');
			$crServices->setOrder('ASC');
			break;
		case 'hits':
			// For the block: services hits
			$crServices->setSort('ser_hits');
			$crServices->setOrder('DESC');
			break;
		case 'top':
			// For the block: services top
			$crServices->add(new \Criteria('', strtotime(date(_SHORTDATESTRING))+86400, '<='));
			$crServices->setSort('ser_top');
			$crServices->setOrder('ASC');
			break;
		case 'random':
			// For the block: services random
			$crServices->add(new \Criteria('', strtotime(date(_SHORTDATESTRING))+86400, '<='));
			$crServices->setSort('RAND()');
			break;
	}

	$crServices->setLimit($limit);
	$servicesAll = $servicesHandler->getAll($crServices);
	unset($crServices);
	if (count($servicesAll) > 0) {
		foreach (array_keys($servicesAll) as $i) {
			$block[$i]['cat'] = $servicesAll[$i]->getVar('ser_cat');
			$block[$i]['title'] = $myts->htmlSpecialChars($servicesAll[$i]->getVar('ser_title'));
			$block[$i]['desc'] = strip_tags($servicesAll[$i]->getVar('ser_desc'));
			$block[$i]['img'] = $servicesAll[$i]->getVar('ser_img');
		}
	}

	return $block;

}

/**
 * Function edit block
 * @param  $options
 * @return string
 */
function b_service_services_edit($options)
{
	include_once XOOPS_ROOT_PATH . '/modules/service/class/services.php';
	$helper = Helper::getInstance();
	$servicesHandler = $helper->getHandler('Services');
	$GLOBALS['xoopsTpl']->assign('service_upload_url', SERVICE_UPLOAD_URL);
	$form = _MB_SERVICE_DISPLAY;
	$form .= "<input type='hidden' name='options[0]' value='".$options[0]."' />";
	$form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' />&nbsp;<br>";
	$form .= _MB_SERVICE_TITLE_LENGTH . " : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' /><br><br>";
	array_shift($options);
	array_shift($options);
	array_shift($options);

	$crServices = new \CriteriaCompo();
	$crServices->add(new \Criteria('ser_id', 0, '!='));
	$crServices->setSort('ser_id');
	$crServices->setOrder('ASC');
	$servicesAll = $servicesHandler->getAll($crServices);
	unset($crServices);
	$form .= _MB_SERVICE_SERVICES_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
	$form .= "<option value='0' " . (in_array(0, $options) == false ? '' : "selected='selected'") . '>' . _MB_SERVICE_ALL_SERVICES . '</option>';
	foreach (array_keys($servicesAll) as $i) {
		$ser_id = $servicesAll[$i]->getVar('ser_id');
		$form .= "<option value='" . $ser_id . "' " . (in_array($ser_id, $options) == false ? '' : "selected='selected'") . '>' . $servicesAll[$i]->getVar('ser_cat') . '</option>';
	}
	$form .= '</select>';

	return $form;

}
