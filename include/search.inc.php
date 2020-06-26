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


/**
 * search callback functions
 *
 * @param $queryarray
 * @param $andor
 * @param $limit
 * @param $offset
 * @param $userid
 * @return mixed $itemIds
 */
function service_search($queryarray, $andor, $limit, $offset, $userid)
{
	$ret = [];
	$helper = \XoopsModules\Service\Helper::getInstance();

	// search in table services
	// search keywords
	$elementCount = 0;
	$servicesHandler = $helper->getHandler('Services');
	if (is_array($queryarray)) {
		$elementCount = count($queryarray);
	}
	if ($elementCount > 0) {
		$crKeywords = new \CriteriaCompo();
		for ($i = 0; $i  <  $elementCount; $i++) {
			$crKeyword = new \CriteriaCompo();
			$crKeyword->add(new \Criteria('ser_cat', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
			$crKeyword->add(new \Criteria('ser_title', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
			$crKeyword->add(new \Criteria('ser_desc', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
			$crKeyword->add(new \Criteria('ser_img', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
			$crKeywords->add($crKeyword, $andor);
			unset($crKeyword);
		}
	}
	// search user(s)
	if ($userid && is_array($userid)) {
		$userid = array_map('intval', $userid);
		$crUser = new \CriteriaCompo();
		$crUser->add(new \Criteria('ser_submitter', '(' . implode(',', $userid) . ')', 'IN'), 'OR');
	} elseif (is_numeric($userid) && $userid > 0) {
		$crUser = new \CriteriaCompo();
		$crUser->add(new \Criteria('ser_submitter', $userid), 'OR');
	}
	$crSearch = new \CriteriaCompo();
	if (isset($crKeywords)) {
		$crSearch->add($crKeywords, 'AND');
	}
	if (isset($crUser)) {
		$crSearch->add($crUser, 'AND');
	}
	$crSearch->setStart($offset);
	$crSearch->setLimit($limit);
	$crSearch->setSort('ser_id_date');
	$crSearch->setOrder('DESC');
	$servicesAll = $servicesHandler->getAll($crSearch);
	foreach (array_keys($servicesAll) as $i) {
		$ret[] = [
			'image'  => 'assets/icons/16/services.png',
			'link'   => 'services.php?op=show&amp;ser_id=' . $servicesAll[$i]->getVar('ser_id'),
			'title'  => $servicesAll[$i]->getVar('ser_cat'),
		];
	}
	unset($crKeywords);
	unset($crKeyword);
	unset($crUser);
	unset($crSearch);

	return $ret;

}
