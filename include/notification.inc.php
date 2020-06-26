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

/**
 * comment callback functions
 *
 * @param  $category
 * @param  $item_id
 * @return array item|null
 */
function service_notify_iteminfo($category, $item_id)
{
	global $xoopsDB;

	if (!defined('SERVICE_URL')) {
		define('SERVICE_URL', XOOPS_URL . '/modules/service');
	}

	switch ($category) {
		case 'global':
			$item['name'] = '';
			$item['url']  = '';
			return $item;
			break;
		case 'services':
			$sql          = 'SELECT ser_cat FROM ' . $xoopsDB->prefix('service_services') . ' WHERE ser_id = '. $item_id;
			$result       = $xoopsDB->query($sql);
			$result_array = $xoopsDB->fetchArray($result);
			$item['name'] = $result_array['ser_cat'];
			$item['url']  = SERVICE_URL . '/services.php?ser_id=' . $item_id;
			return $item;
			break;
	}
	return null;
}
