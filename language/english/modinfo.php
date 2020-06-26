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

include_once 'common.php';

// ---------------- Admin Main ----------------
define('_MI_SERVICE_NAME', 'Service');
define('_MI_SERVICE_DESC', 'Our Service Area');
// ---------------- Admin Menu ----------------
define('_MI_SERVICE_ADMENU1', 'Dashboard');
define('_MI_SERVICE_ADMENU2', 'Categories');
define('_MI_SERVICE_ADMENU3', 'Services');
define('_MI_SERVICE_ADMENU4', 'Broken items');
define('_MI_SERVICE_ADMENU5', 'Permissions');
define('_MI_SERVICE_ADMENU6', 'Feedback');
define('_MI_SERVICE_ABOUT', 'About');
// ---------------- Admin Nav ----------------
define('_MI_SERVICE_ADMIN_PAGER', 'Admin pager');
define('_MI_SERVICE_ADMIN_PAGER_DESC', 'Admin per page list');
// User
define('_MI_SERVICE_USER_PAGER', 'User pager');
define('_MI_SERVICE_USER_PAGER_DESC', 'User per page list');
// Submenu
define('_MI_SERVICE_SMNAME1', 'Index page');
define('_MI_SERVICE_SMNAME2', 'Services');
define('_MI_SERVICE_SMNAME3', 'Submit Services');
define('_MI_SERVICE_SMNAME4', 'Search');
// Rating bars
define('_MI_SERVICE_RATINGBAR_GROUPS', 'Groups with rating rights');
define('_MI_SERVICE_RATINGBAR_GROUPS_DESC', 'Select groups which should have the right to rate');
define('_MI_SERVICE_RATINGBARS', 'Allow rating');
define('_MI_SERVICE_RATINGBARS_DESC', 'Define whether rating should be possible and which kind of rating should be used');
define('_MI_SERVICE_RATING_NONE', 'Do not use rating');
define('_MI_SERVICE_RATING_5STARS', 'Rating with 5 stars');
define('_MI_SERVICE_RATING_10STARS', 'Rating with 10 stars');
define('_MI_SERVICE_RATING_LIKES', 'Rating with likes and dislikes');
define('_MI_SERVICE_RATING_10NUM', 'Rating with 10 points');
// Blocks
define('_MI_SERVICE_SERVICES_BLOCK', 'Services block');
define('_MI_SERVICE_SERVICES_BLOCK_DESC', 'Services block description');
define('_MI_SERVICE_SERVICES_BLOCK_SERVICE', 'Services block  SERVICE');
define('_MI_SERVICE_SERVICES_BLOCK_SERVICE_DESC', 'Services block  SERVICE description');
define('_MI_SERVICE_SERVICES_BLOCK_LAST', 'Services block last');
define('_MI_SERVICE_SERVICES_BLOCK_LAST_DESC', 'Services block last description');
define('_MI_SERVICE_SERVICES_BLOCK_NEW', 'Services block new');
define('_MI_SERVICE_SERVICES_BLOCK_NEW_DESC', 'Services block new description');
define('_MI_SERVICE_SERVICES_BLOCK_HITS', 'Services block hits');
define('_MI_SERVICE_SERVICES_BLOCK_HITS_DESC', 'Services block hits description');
define('_MI_SERVICE_SERVICES_BLOCK_TOP', 'Services block top');
define('_MI_SERVICE_SERVICES_BLOCK_TOP_DESC', 'Services block top description');
define('_MI_SERVICE_SERVICES_BLOCK_RANDOM', 'Services block random');
define('_MI_SERVICE_SERVICES_BLOCK_RANDOM_DESC', 'Services block random description');
// Config
define('_MI_SERVICE_EDITOR_ADMIN', 'Editor admin');
define('_MI_SERVICE_EDITOR_ADMIN_DESC', 'Select the editor which should be used in admin area for text area fields');
define('_MI_SERVICE_EDITOR_USER', 'Editor user');
define('_MI_SERVICE_EDITOR_USER_DESC', 'Select the editor which should be used in user area for text area fields');
define('_MI_SERVICE_EDITOR_MAXCHAR', 'Text max characters');
define('_MI_SERVICE_EDITOR_MAXCHAR_DESC', 'Max characters for showing text of a textarea or editor field in admin area');
define('_MI_SERVICE_KEYWORDS', 'Keywords');
define('_MI_SERVICE_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
define('_MI_SERVICE_SIZE_MB', 'MB');
define('_MI_SERVICE_MAXSIZE_IMAGE', 'Max size image');
define('_MI_SERVICE_MAXSIZE_IMAGE_DESC', 'Define the max size for uploading images');
define('_MI_SERVICE_MIMETYPES_IMAGE', 'Mime types image');
define('_MI_SERVICE_MIMETYPES_IMAGE_DESC', 'Define the allowed mime types for uploading images');
define('_MI_SERVICE_MAXWIDTH_IMAGE', 'Max width image');
define('_MI_SERVICE_MAXWIDTH_IMAGE_DESC', 'Set the max width which is allowed for uploading images (in pixel)<br>0 means that images keep original size<br>If original image is smaller the image will be not enlarged');
define('_MI_SERVICE_MAXHEIGHT_IMAGE', 'Max height image');
define('_MI_SERVICE_MAXHEIGHT_IMAGE_DESC', 'Set the max height which is allowed for uploading images (in pixel)<br>0 means that images keep original size<br>If original image is smaller the image will be not enlarged');
define('_MI_SERVICE_USE_TAG', 'Use TAG');
define('_MI_SERVICE_USE_TAG_DESC', 'If you use tag module, check this option to yes');
define('_MI_SERVICE_NUMB_COL', 'Number Columns');
define('_MI_SERVICE_NUMB_COL_DESC', 'Number Columns to View.');
define('_MI_SERVICE_DIVIDEBY', 'Divide By');
define('_MI_SERVICE_DIVIDEBY_DESC', 'Divide by columns number.');
define('_MI_SERVICE_TABLE_TYPE', 'Table Type');
define('_MI_SERVICE_TABLE_TYPE_DESC', 'Table Type is the bootstrap html table.');
define('_MI_SERVICE_PANEL_TYPE', 'Panel Type');
define('_MI_SERVICE_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div.');
define('_MI_SERVICE_IDPAYPAL', 'Paypal ID');
define('_MI_SERVICE_IDPAYPAL_DESC', 'Insert here your PayPal ID for donactions.');
define('_MI_SERVICE_ADVERTISE', 'Advertisement Code');
define('_MI_SERVICE_ADVERTISE_DESC', 'Insert here the advertisement code');
define('_MI_SERVICE_MAINTAINEDBY', 'Maintained By');
define('_MI_SERVICE_MAINTAINEDBY_DESC', 'Allow url of support site or community');
define('_MI_SERVICE_BOOKMARKS', 'Social Bookmarks');
define('_MI_SERVICE_BOOKMARKS_DESC', 'Show Social Bookmarks in the single page');
define('_MI_SERVICE_FACEBOOK_COMMENTS', 'Facebook comments');
define('_MI_SERVICE_FACEBOOK_COMMENTS_DESC', 'Allow Facebook comments in the single page');
define('_MI_SERVICE_DISQUS_COMMENTS', 'Disqus comments');
define('_MI_SERVICE_DISQUS_COMMENTS_DESC', 'Allow Disqus comments in the single page');
// Global notifications
define('_MI_SERVICE_NOTIFY_GLOBAL', 'Global notification');
define('_MI_SERVICE_NOTIFY_GLOBAL_NEW', 'Any new item');
define('_MI_SERVICE_NOTIFY_GLOBAL_NEW_CAPTION', 'Notify me about any new item');
define('_MI_SERVICE_NOTIFY_GLOBAL_NEW_SUBJECT', 'Notification about new item');
define('_MI_SERVICE_NOTIFY_GLOBAL_MODIFY', 'Any modified item');
define('_MI_SERVICE_NOTIFY_GLOBAL_MODIFY_CAPTION', 'Notify me about any item modification');
define('_MI_SERVICE_NOTIFY_GLOBAL_MODIFY_SUBJECT', 'Notification about modification');
define('_MI_SERVICE_NOTIFY_GLOBAL_DELETE', 'Any deleted item');
define('_MI_SERVICE_NOTIFY_GLOBAL_DELETE_CAPTION', 'Notify me about any deleted item');
define('_MI_SERVICE_NOTIFY_GLOBAL_DELETE_SUBJECT', 'Notification about deleted item');
define('_MI_SERVICE_NOTIFY_GLOBAL_APPROVE', 'Any item to approve');
define('_MI_SERVICE_NOTIFY_GLOBAL_APPROVE_CAPTION', 'Notify me about any item waiting for approvement');
define('_MI_SERVICE_NOTIFY_GLOBAL_APPROVE_SUBJECT', 'Notification about item waiting for approvement');
define('_MI_SERVICE_NOTIFY_GLOBAL_BROKEN', 'Any broken item');
define('_MI_SERVICE_NOTIFY_GLOBAL_BROKEN_CAPTION', 'Notify me about any broken item');
define('_MI_SERVICE_NOTIFY_GLOBAL_BROKEN_SUBJECT', 'Notification about broken item');
// Service notifications
define('_MI_SERVICE_NOTIFY_SERVICE', 'Service notification');
define('_MI_SERVICE_NOTIFY_SERVICE_MODIFY', 'Service modification');
define('_MI_SERVICE_NOTIFY_SERVICE_MODIFY_CAPTION', 'Notify me about service modification');
define('_MI_SERVICE_NOTIFY_SERVICE_MODIFY_SUBJECT', 'Notification about modification');
define('_MI_SERVICE_NOTIFY_SERVICE_DELETE', 'Service deleted');
define('_MI_SERVICE_NOTIFY_SERVICE_DELETE_CAPTION', 'Notify me about deleted services');
define('_MI_SERVICE_NOTIFY_SERVICE_DELETE_SUBJECT', 'Notification delete service');
define('_MI_SERVICE_NOTIFY_SERVICE_APPROVE', 'Service approve');
define('_MI_SERVICE_NOTIFY_SERVICE_APPROVE_CAPTION', 'Notify me about services waiting for approvement');
define('_MI_SERVICE_NOTIFY_SERVICE_APPROVE_SUBJECT', 'Notification service waiting for approvement');
define('_MI_SERVICE_NOTIFY_SERVICE_BROKEN', 'Service broken');
define('_MI_SERVICE_NOTIFY_SERVICE_BROKEN_CAPTION', 'Notify me about broken service');
define('_MI_SERVICE_NOTIFY_SERVICE_BROKEN_SUBJECT', 'Notification about broken service');
// Permissions Groups
define('_MI_SERVICE_GROUPS', 'Groups access');
define('_MI_SERVICE_GROUPS_DESC', 'Select general access permission for groups.');
define('_MI_SERVICE_ADMIN_GROUPS', 'Admin Group Permissions');
define('_MI_SERVICE_ADMIN_GROUPS_DESC', 'Which groups have access to tools and permissions page');
define('_MI_SERVICE_UPLOAD_GROUPS', 'Upload Group Permissions');
define('_MI_SERVICE_UPLOAD_GROUPS_DESC', 'Which groups have permissions to upload files');
// ---------------- End ----------------
