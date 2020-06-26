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
if (!defined('XOOPS_ICONS32_PATH')) {
	define('XOOPS_ICONS32_PATH', XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
}
if (!defined('XOOPS_ICONS32_URL')) {
	define('XOOPS_ICONS32_URL', XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
}
define('SERVICE_DIRNAME', 'service');
define('SERVICE_PATH', XOOPS_ROOT_PATH . '/modules/' . SERVICE_DIRNAME);
define('SERVICE_URL', XOOPS_URL . '/modules/' . SERVICE_DIRNAME);
define('SERVICE_ICONS_PATH', SERVICE_PATH . '/assets/icons');
define('SERVICE_ICONS_URL', SERVICE_URL . '/assets/icons');
define('SERVICE_IMAGE_PATH', SERVICE_PATH . '/assets/images');
define('SERVICE_IMAGE_URL', SERVICE_URL . '/assets/images');
define('SERVICE_UPLOAD_PATH', XOOPS_UPLOAD_PATH . '/' . SERVICE_DIRNAME);
define('SERVICE_UPLOAD_URL', XOOPS_UPLOAD_URL . '/' . SERVICE_DIRNAME);
define('SERVICE_UPLOAD_FILES_PATH', SERVICE_UPLOAD_PATH . '/files');
define('SERVICE_UPLOAD_FILES_URL', SERVICE_UPLOAD_URL . '/files');
define('SERVICE_UPLOAD_IMAGE_PATH', SERVICE_UPLOAD_PATH . '/images');
define('SERVICE_UPLOAD_IMAGE_URL', SERVICE_UPLOAD_URL . '/images');
define('SERVICE_UPLOAD_SHOTS_PATH', SERVICE_UPLOAD_PATH . '/images/shots');
define('SERVICE_UPLOAD_SHOTS_URL', SERVICE_UPLOAD_URL . '/images/shots');
define('SERVICE_ADMIN', SERVICE_URL . '/admin/index.php');
$localLogo = SERVICE_IMAGE_URL . '/b.heyula_logo.png';
// Module Information
$copyright = "<a href='http://erenyumak.com' title='XOOPS Project' target='_blank'><img src='" . $localLogo . "' alt='XOOPS Project' /></a>";
include_once XOOPS_ROOT_PATH . '/class/xoopsrequest.php';
include_once SERVICE_PATH . '/include/functions.php';
