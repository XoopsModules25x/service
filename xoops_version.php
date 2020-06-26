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

// 
$moduleDirName      = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);
// ------------------- Informations ------------------- //
$modversion = [
	'name'                => _MI_SERVICE_NAME,
	'version'             => 1.0,
	'description'         => _MI_SERVICE_DESC,
	'author'              => 'B.Heyula',
	'author_mail'         => 'b.heyula@hotmail.com',
	'author_website_url'  => 'http://erenyumak.com',
	'author_website_name' => 'XOOPS Project',
	'credits'             => 'XOOPS Development Team',
	'license'             => 'GPL 2.0 or later',
	'license_url'         => 'http://www.gnu.org/licenses/gpl-3.0.en.html',
	'help'                => 'page=help',
	'release_info'        => 'release_info',
	'release_file'        => XOOPS_URL . '/modules/service/docs/release_info file',
	'release_date'        => '2020/06/25',
	'manual'              => 'link to manual file',
	'manual_file'         => XOOPS_URL . '/modules/service/docs/install.txt',
	'min_php'             => '7.0',
	'min_xoops'           => '2.5.9',
	'min_admin'           => '1.2',
	'min_db'              => ['mysql' => '5.6', 'mysqli' => '5.6'],
	'image'               => 'assets/images/logoModule.png',
	'dirname'             => basename(__DIR__),
	'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
	'sysicons16'          => '../../Frameworks/moduleclasses/icons/16',
	'sysicons32'          => '../../Frameworks/moduleclasses/icons/32',
	'modicons16'          => 'assets/icons/16',
	'modicons32'          => 'assets/icons/32',
	'demo_site_url'       => 'https://xoops.org',
	'demo_site_name'      => 'XOOPS Demo Site',
	'support_url'         => 'https://xoops.org/modules/newbb',
	'support_name'        => 'Support Forum',
	'module_website_url'  => 'www.xoops.org',
	'module_website_name' => 'XOOPS Project',
	'release'             => '2017-12-02',
	'module_status'       => 'Beta 1',
	'system_menu'         => 1,
	'hasAdmin'            => 1,
	'hasMain'             => 1,
	'adminindex'          => 'admin/index.php',
	'adminmenu'           => 'admin/menu.php',
	'onInstall'           => 'include/install.php',
	'onUninstall'         => 'include/uninstall.php',
	'onUpdate'            => 'include/update.php',
];
// ------------------- Templates ------------------- //
$modversion['templates'] = [
	// Admin templates
	['file' => 'service_admin_about.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'service_admin_header.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'service_admin_index.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'service_admin_categories.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'service_admin_services.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'service_admin_broken.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'service_admin_permissions.tpl', 'description' => '', 'type' => 'admin'],
	['file' => 'service_admin_footer.tpl', 'description' => '', 'type' => 'admin'],
	// User templates
	['file' => 'service_header.tpl', 'description' => ''],
	['file' => 'service_index.tpl', 'description' => ''],
	['file' => 'service_categories.tpl', 'description' => ''],
	['file' => 'service_categories_list.tpl', 'description' => ''],
	['file' => 'service_categories_item.tpl', 'description' => ''],
	['file' => 'service_services.tpl', 'description' => ''],
	['file' => 'service_services_list.tpl', 'description' => ''],
	['file' => 'service_services_item.tpl', 'description' => ''],
	['file' => 'service_breadcrumbs.tpl', 'description' => ''],
	['file' => 'service_pdf.tpl', 'description' => ''],
	['file' => 'service_print.tpl', 'description' => ''],
	['file' => 'service_rate.tpl', 'description' => ''],
	['file' => 'service_rss.tpl', 'description' => ''],
	['file' => 'service_search.tpl', 'description' => ''],
	['file' => 'service_footer.tpl', 'description' => ''],
];
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'] = [
	'service_categories',
	'service_services',
	'service_ratings',
];
// ------------------- Search ------------------- //
$modversion['hasSearch'] = 1;
$modversion['search'] = [
	'file' => 'include/search.inc.php',
	'func' => 'service_search',
];
// ------------------- Menu ------------------- //
$currdirname  = isset($GLOBALS['xoopsModule']) && is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';
if ($currdirname == $moduleDirName) {
	$modversion['sub'][] = [
		'name' => _MI_SERVICE_SMNAME1,
		'url'  => 'index.php',
	];
	// Sub services
	$modversion['sub'][] = [
		'name' => _MI_SERVICE_SMNAME2,
		'url'  => 'services.php',
	];
	// Sub Submit
	$modversion['sub'][] = [
		'name' => _MI_SERVICE_SMNAME3,
		'url'  => 'services.php?op=new',
	];
}
// ------------------- Blocks ------------------- //
// Services last
$modversion['blocks'][] = [
	'file'        => 'services.php',
	'name'        => _MI_SERVICE_SERVICES_BLOCK_LAST,
	'description' => _MI_SERVICE_SERVICES_BLOCK_LAST_DESC,
	'show_func'   => 'b_service_services_show',
	'edit_func'   => 'b_service_services_edit',
	'template'    => 'service_block_services.tpl',
	'options'     => 'last|5|25|0',
];
// Services new
$modversion['blocks'][] = [
	'file'        => 'services.php',
	'name'        => _MI_SERVICE_SERVICES_BLOCK_NEW,
	'description' => _MI_SERVICE_SERVICES_BLOCK_NEW_DESC,
	'show_func'   => 'b_service_services_show',
	'edit_func'   => 'b_service_services_edit',
	'template'    => 'service_block_services.tpl',
	'options'     => 'new|5|25|0',
];
// Services hits
$modversion['blocks'][] = [
	'file'        => 'services.php',
	'name'        => _MI_SERVICE_SERVICES_BLOCK_HITS,
	'description' => _MI_SERVICE_SERVICES_BLOCK_HITS_DESC,
	'show_func'   => 'b_service_services_show',
	'edit_func'   => 'b_service_services_edit',
	'template'    => 'service_block_services.tpl',
	'options'     => 'hits|5|25|0',
];
// Services top
$modversion['blocks'][] = [
	'file'        => 'services.php',
	'name'        => _MI_SERVICE_SERVICES_BLOCK_TOP,
	'description' => _MI_SERVICE_SERVICES_BLOCK_TOP_DESC,
	'show_func'   => 'b_service_services_show',
	'edit_func'   => 'b_service_services_edit',
	'template'    => 'service_block_services.tpl',
	'options'     => 'top|5|25|0',
];
// Services random
$modversion['blocks'][] = [
	'file'        => 'services.php',
	'name'        => _MI_SERVICE_SERVICES_BLOCK_RANDOM,
	'description' => _MI_SERVICE_SERVICES_BLOCK_RANDOM_DESC,
	'show_func'   => 'b_service_services_show',
	'edit_func'   => 'b_service_services_edit',
	'template'    => 'service_block_services.tpl',
	'options'     => 'random|5|25|0',
];
// ------------------- Config ------------------- //
// Editor Admin
xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
	'name'        => 'editor_admin',
	'title'       => '_MI_SERVICE_EDITOR_ADMIN',
	'description' => '_MI_SERVICE_EDITOR_ADMIN_DESC',
	'formtype'    => 'select',
	'valuetype'   => 'text',
	'default'     => 'dhtml',
	'options'     => array_flip($editorHandler->getList()),
];
// Editor User
xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
	'name'        => 'editor_user',
	'title'       => '_MI_SERVICE_EDITOR_USER',
	'description' => '_MI_SERVICE_EDITOR_USER_DESC',
	'formtype'    => 'select',
	'valuetype'   => 'text',
	'default'     => 'dhtml',
	'options'     => array_flip($editorHandler->getList()),
];
// Editor : max characters admin area
$modversion['config'][] = [
	'name'        => 'editor_maxchar',
	'title'       => '_MI_SERVICE_EDITOR_MAXCHAR',
	'description' => '_MI_SERVICE_EDITOR_MAXCHAR_DESC',
	'formtype'    => 'textbox',
	'valuetype'   => 'int',
	'default'     => 50,
];
// Get groups
$memberHandler = xoops_getHandler('member');
$xoopsGroups  = $memberHandler->getGroupList();
$groups = [];
foreach ($xoopsGroups as $key => $group) {
	$groups[$group]  = $key;
}
// General access groups
$modversion['config'][] = [
	'name'        => 'groups',
	'title'       => '_MI_SERVICE_GROUPS',
	'description' => '_MI_SERVICE_GROUPS_DESC',
	'formtype'    => 'select_multi',
	'valuetype'   => 'array',
	'default'     => $groups,
	'options'     => $groups,
];
// Upload groups
$modversion['config'][] = [
	'name'        => 'upload_groups',
	'title'       => '_MI_SERVICE_UPLOAD_GROUPS',
	'description' => '_MI_SERVICE_UPLOAD_GROUPS_DESC',
	'formtype'    => 'select_multi',
	'valuetype'   => 'array',
	'default'     => $groups,
	'options'     => $groups,
];
// Get Admin groups
$crGroups = new \CriteriaCompo();
$crGroups->add(new \Criteria('group_type', 'Admin'));
$memberHandler = xoops_getHandler('member');
$adminXoopsGroups  = $memberHandler->getGroupList($crGroups);
$adminGroups = [];
foreach ($adminXoopsGroups as $key => $adminGroup) {
	$adminGroups[$adminGroup]  = $key;
}
$modversion['config'][] = [
	'name'        => 'admin_groups',
	'title'       => '_MI_SERVICE_ADMIN_GROUPS',
	'description' => '_MI_SERVICE_ADMIN_GROUPS_DESC',
	'formtype'    => 'select_multi',
	'valuetype'   => 'array',
	'default'     => $adminGroups,
	'options'     => $adminGroups,
];
unset($crGroups);
// Get groups
$memberHandler = xoops_getHandler('member');
$xoopsGroups  = $memberHandler->getGroupList();
$ratingbar_groups = [];
foreach ($xoopsGroups as $key => $group) {
	$ratingbar_groups[$group]  = $key;
}
// Rating: Groups with rating permissions
$modversion['config'][] = [
	'name'        => 'ratingbar_groups',
	'title'       => '_MI_SERVICE_RATINGBAR_GROUPS',
	'description' => '_MI_SERVICE_RATINGBAR_GROUPS_DESC',
	'formtype'    => 'select_multi',
	'valuetype'   => 'array',
	'default'     => [1],
	'options'     => $ratingbar_groups,
];
// Rating : used ratingbar
$modversion['config'][] = [
	'name'        => 'ratingbars',
	'title'       => '_MI_SERVICE_RATINGBARS',
	'description' => '_MI_SERVICE_RATINGBARS_DESC',
	'formtype'    => 'select',
	'valuetype'   => 'int',
	'default'     => 0,
	'options'     => ['_MI_SERVICE_RATING_NONE' => 0, '_MI_SERVICE_RATING_5STARS' => 1, '_MI_SERVICE_RATING_10STARS' => 2, '_MI_SERVICE_RATING_LIKES' => 3, '_MI_SERVICE_RATING_10NUM' => 4],
];
// Keywords
$modversion['config'][] = [
	'name'        => 'keywords',
	'title'       => '_MI_SERVICE_KEYWORDS',
	'description' => '_MI_SERVICE_KEYWORDS_DESC',
	'formtype'    => 'textbox',
	'valuetype'   => 'text',
	'default'     => 'service, categories, services',
];
// create increment steps for file size
include_once __DIR__ . '/include/xoops_version.inc.php';
$iniPostMaxSize       = serviceReturnBytes(ini_get('post_max_size'));
$iniUploadMaxFileSize = serviceReturnBytes(ini_get('upload_max_filesize'));
$maxSize              = min($iniPostMaxSize, $iniUploadMaxFileSize);
if ($maxSize > 10000 * 1048576) {
	$increment = 500;
}
if ($maxSize <= 10000 * 1048576) {
	$increment = 200;
}
if ($maxSize <= 5000 * 1048576) {
	$increment = 100;
}
if ($maxSize <= 2500 * 1048576) {
	$increment = 50;
}
if ($maxSize <= 1000 * 1048576) {
	$increment = 10;
}
if ($maxSize <= 500 * 1048576) {
	$increment = 5;
}
if ($maxSize <= 100 * 1048576) {
	$increment = 2;
}
if ($maxSize <= 50 * 1048576) {
	$increment = 1;
}
if ($maxSize <= 25 * 1048576) {
	$increment = 0.5;
}
$optionMaxsize = [];
$i = $increment;
while ($i * 1048576 <= $maxSize) {
	$optionMaxsize[$i . ' ' . _MI_SERVICE_SIZE_MB] = $i * 1048576;
	$i += $increment;
}
// Uploads : maxsize of image
$modversion['config'][] = [
	'name'        => 'maxsize_image',
	'title'       => '_MI_SERVICE_MAXSIZE_IMAGE',
	'description' => '_MI_SERVICE_MAXSIZE_IMAGE_DESC',
	'formtype'    => 'select',
	'valuetype'   => 'int',
	'default'     => 3145728,
	'options'     => $optionMaxsize,
];
// Uploads : mimetypes of image
$modversion['config'][] = [
	'name'        => 'mimetypes_image',
	'title'       => '_MI_SERVICE_MIMETYPES_IMAGE',
	'description' => '_MI_SERVICE_MIMETYPES_IMAGE_DESC',
	'formtype'    => 'select_multi',
	'valuetype'   => 'array',
	'default'     => ['image/gif', 'image/jpeg', 'image/png'],
	'options'     => ['bmp' => 'image/bmp','gif' => 'image/gif','pjpeg' => 'image/pjpeg', 'jpeg' => 'image/jpeg','jpg' => 'image/jpg','jpe' => 'image/jpe', 'png' => 'image/png'],
];
$modversion['config'][] = [
	'name'        => 'maxwidth_image',
	'title'       => '_MI_SERVICE_MAXWIDTH_IMAGE',
	'description' => '_MI_SERVICE_MAXWIDTH_IMAGE_DESC',
	'formtype'    => 'textbox',
	'valuetype'   => 'int',
	'default'     => 8000,
];
$modversion['config'][] = [
	'name'        => 'maxheight_image',
	'title'       => '_MI_SERVICE_MAXHEIGHT_IMAGE',
	'description' => '_MI_SERVICE_MAXHEIGHT_IMAGE_DESC',
	'formtype'    => 'textbox',
	'valuetype'   => 'int',
	'default'     => 8000,
];
// Admin pager
$modversion['config'][] = [
	'name'        => 'adminpager',
	'title'       => '_MI_SERVICE_ADMIN_PAGER',
	'description' => '_MI_SERVICE_ADMIN_PAGER_DESC',
	'formtype'    => 'textbox',
	'valuetype'   => 'int',
	'default'     => 10,
];
// User pager
$modversion['config'][] = [
	'name'        => 'userpager',
	'title'       => '_MI_SERVICE_USER_PAGER',
	'description' => '_MI_SERVICE_USER_PAGER_DESC',
	'formtype'    => 'textbox',
	'valuetype'   => 'int',
	'default'     => 10,
];
// Use tag
$modversion['config'][] = [
	'name'        => 'usetag',
	'title'       => '_MI_SERVICE_USE_TAG',
	'description' => '_MI_SERVICE_USE_TAG_DESC',
	'formtype'    => 'yesno',
	'valuetype'   => 'int',
	'default'     => 0,
];
// Number column
$modversion['config'][] = [
	'name'        => 'numb_col',
	'title'       => '_MI_SERVICE_NUMB_COL',
	'description' => '_MI_SERVICE_NUMB_COL_DESC',
	'formtype'    => 'select',
	'valuetype'   => 'int',
	'default'     => 1,
	'options'     => [1 => '1', 2 => '2', 3 => '3', 4 => '4'],
];
// Divide by
$modversion['config'][] = [
	'name'        => 'divideby',
	'title'       => '_MI_SERVICE_DIVIDEBY',
	'description' => '_MI_SERVICE_DIVIDEBY_DESC',
	'formtype'    => 'select',
	'valuetype'   => 'int',
	'default'     => 1,
	'options'     => [1 => '1', 2 => '2', 3 => '3', 4 => '4'],
];
// Table type
$modversion['config'][] = [
	'name'        => 'table_type',
	'title'       => '_MI_SERVICE_TABLE_TYPE',
	'description' => '_MI_SERVICE_DIVIDEBY_DESC',
	'formtype'    => 'select',
	'valuetype'   => 'int',
	'default'     => 'bordered',
	'options'     => ['bordered' => 'bordered', 'striped' => 'striped', 'hover' => 'hover', 'condensed' => 'condensed'],
];
// Panel by
$modversion['config'][] = [
	'name'        => 'panel_type',
	'title'       => '_MI_SERVICE_PANEL_TYPE',
	'description' => '_MI_SERVICE_PANEL_TYPE_DESC',
	'formtype'    => 'select',
	'valuetype'   => 'text',
	'default'     => 'default',
	'options'     => ['default' => 'default', 'primary' => 'primary', 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger'],
];
// Advertise
$modversion['config'][] = [
	'name'        => 'advertise',
	'title'       => '_MI_SERVICE_ADVERTISE',
	'description' => '_MI_SERVICE_ADVERTISE_DESC',
	'formtype'    => 'textarea',
	'valuetype'   => 'text',
	'default'     => '',
];
// Bookmarks
$modversion['config'][] = [
	'name'        => 'bookmarks',
	'title'       => '_MI_SERVICE_BOOKMARKS',
	'description' => '_MI_SERVICE_BOOKMARKS_DESC',
	'formtype'    => 'yesno',
	'valuetype'   => 'int',
	'default'     => 0,
];
// Make Sample button visible?
$modversion['config'][] = [
	'name'        => 'displaySampleButton',
	'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
	'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
	'formtype'    => 'yesno',
	'valuetype'   => 'int',
	'default'     => 1,
];
// Maintained by
$modversion['config'][] = [
	'name'        => 'maintainedby',
	'title'       => '_MI_SERVICE_MAINTAINEDBY',
	'description' => '_MI_SERVICE_MAINTAINEDBY_DESC',
	'formtype'    => 'textbox',
	'valuetype'   => 'text',
	'default'     => 'https://xoops.org/modules/newbb',
];
// ------------------- Notifications ------------------- //
$modversion['hasNotification'] = 1;
$modversion['notification'] = [
	'lookup_file' => 'include/notification.inc.php',
	'lookup_func' => 'service_notify_iteminfo',
];
// Categories of notification
// Global Notify
$modversion['notification']['category'][] = [
	'name'           => 'global',
	'title'          => _MI_SERVICE_NOTIFY_GLOBAL,
	'description'    => '',
	'subscribe_from' => ['index.php', 'services.php'],
];
// Service Notify
$modversion['notification']['category'][] = [
	'name'           => 'services',
	'title'          => _MI_SERVICE_NOTIFY_SERVICE,
	'description'    => '',
	'subscribe_from' => 'services.php',
	'item_name'      => 'ser_id',
	'allow_bookmark' => 1,
];
// Global events notification
// GLOBAL_NEW Notify
$modversion['notification']['event'][] = [
	'name'          => 'global_new',
	'category'      => 'global',
	'admin_only'    => 0,
	'title'         => _MI_SERVICE_NOTIFY_GLOBAL_NEW,
	'caption'       => _MI_SERVICE_NOTIFY_GLOBAL_NEW_CAPTION,
	'description'   => '',
	'mail_template' => 'global_new_notify',
	'mail_subject'  => _MI_SERVICE_NOTIFY_GLOBAL_NEW_SUBJECT,
];
// GLOBAL_MODIFY Notify
$modversion['notification']['event'][] = [
	'name'          => 'global_modify',
	'category'      => 'global',
	'admin_only'    => 0,
	'title'         => _MI_SERVICE_NOTIFY_GLOBAL_MODIFY,
	'caption'       => _MI_SERVICE_NOTIFY_GLOBAL_MODIFY_CAPTION,
	'description'   => '',
	'mail_template' => 'global_modify_notify',
	'mail_subject'  => _MI_SERVICE_NOTIFY_GLOBAL_MODIFY_SUBJECT,
];
// GLOBAL_DELETE Notify
$modversion['notification']['event'][] = [
	'name'          => 'global_delete',
	'category'      => 'global',
	'admin_only'    => 0,
	'title'         => _MI_SERVICE_NOTIFY_GLOBAL_DELETE,
	'caption'       => _MI_SERVICE_NOTIFY_GLOBAL_DELETE_CAPTION,
	'description'   => '',
	'mail_template' => 'global_delete_notify',
	'mail_subject'  => _MI_SERVICE_NOTIFY_GLOBAL_DELETE_SUBJECT,
];
// GLOBAL_APPROVE Notify
$modversion['notification']['event'][] = [
	'name'          => 'global_approve',
	'category'      => 'global',
	'admin_only'    => 0,
	'title'         => _MI_SERVICE_NOTIFY_GLOBAL_APPROVE,
	'caption'       => _MI_SERVICE_NOTIFY_GLOBAL_APPROVE_CAPTION,
	'description'   => '',
	'mail_template' => 'global_approve_notify',
	'mail_subject'  => _MI_SERVICE_NOTIFY_GLOBAL_APPROVE_SUBJECT,
];
// GLOBAL_BROKEN Notify
$modversion['notification']['event'][] = [
	'name'          => 'global_broken',
	'category'      => 'global',
	'admin_only'    => 0,
	'title'         => _MI_SERVICE_NOTIFY_GLOBAL_BROKEN,
	'caption'       => _MI_SERVICE_NOTIFY_GLOBAL_BROKEN_CAPTION,
	'description'   => '',
	'mail_template' => 'global_broken_notify',
	'mail_subject'  => _MI_SERVICE_NOTIFY_GLOBAL_BROKEN_SUBJECT,
];
// Event notifications for items
// SERVICE_MODIFY Notify
$modversion['notification']['event'][] = [
	'name'          => 'service_modify',
	'category'      => 'services',
	'admin_only'    => 0,
	'title'         => _MI_SERVICE_NOTIFY_SERVICE_MODIFY,
	'caption'       => _MI_SERVICE_NOTIFY_SERVICE_MODIFY_CAPTION,
	'description'   => '',
	'mail_template' => 'service_modify_notify',
	'mail_subject'  => _MI_SERVICE_NOTIFY_SERVICE_MODIFY_SUBJECT,
];
// SERVICE_DELETE Notify
$modversion['notification']['event'][] = [
	'name'          => 'service_delete',
	'category'      => 'services',
	'admin_only'    => 0,
	'title'         => _MI_SERVICE_NOTIFY_SERVICE_DELETE,
	'caption'       => _MI_SERVICE_NOTIFY_SERVICE_DELETE_CAPTION,
	'description'   => '',
	'mail_template' => 'service_delete_notify',
	'mail_subject'  => _MI_SERVICE_NOTIFY_SERVICE_DELETE_SUBJECT,
];
// SERVICE_APPROVE Notify
$modversion['notification']['event'][] = [
	'name'          => 'service_approve',
	'category'      => 'services',
	'admin_only'    => 0,
	'title'         => _MI_SERVICE_NOTIFY_SERVICE_APPROVE,
	'caption'       => _MI_SERVICE_NOTIFY_SERVICE_APPROVE_CAPTION,
	'description'   => '',
	'mail_template' => 'service_approve_notify',
	'mail_subject'  => _MI_SERVICE_NOTIFY_SERVICE_APPROVE_SUBJECT,
];
// SERVICE_BROKEN Notify
$modversion['notification']['event'][] = [
	'name'          => 'service_broken',
	'category'      => 'services',
	'admin_only'    => 0,
	'title'         => _MI_SERVICE_NOTIFY_SERVICE_BROKEN,
	'caption'       => _MI_SERVICE_NOTIFY_SERVICE_BROKEN_CAPTION,
	'description'   => '',
	'mail_template' => 'service_broken_notify',
	'mail_subject'  => _MI_SERVICE_NOTIFY_SERVICE_BROKEN_SUBJECT,
];
