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

include_once __DIR__ . '/common.php';
include_once __DIR__ . '/main.php';

// ---------------- Admin Index ----------------
define('_AM_SERVICE_STATISTICS', 'Statistics');
// There are
define('_AM_SERVICE_THEREARE_CATEGORIES', "There are <span class='bold'>%s</span> categories in the database");
define('_AM_SERVICE_THEREARE_SERVICES', "There are <span class='bold'>%s</span> services in the database");
// ---------------- Admin Files ----------------
// There aren't
define('_AM_SERVICE_THEREARENT_CATEGORIES', "There aren't categories");
define('_AM_SERVICE_THEREARENT_SERVICES', "There aren't services");
// Save/Delete
define('_AM_SERVICE_FORM_OK', 'Successfully saved');
define('_AM_SERVICE_FORM_DELETE_OK', 'Successfully deleted');
define('_AM_SERVICE_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
define('_AM_SERVICE_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
// Buttons
define('_AM_SERVICE_ADD_CATEGORIE', 'Add New Categorie');
define('_AM_SERVICE_ADD_SERVICE', 'Add New Service');
// Lists
define('_AM_SERVICE_CATEGORIES_LIST', 'List of Categories');
define('_AM_SERVICE_SERVICES_LIST', 'List of Services');
// ---------------- Admin Classes ----------------
// Categorie add/edit
define('_AM_SERVICE_CATEGORIE_ADD', 'Add Categorie');
define('_AM_SERVICE_CATEGORIE_EDIT', 'Edit Categorie');
// Elements of Categorie
define('_AM_SERVICE_CATEGORIE_ID', 'Id');
define('_AM_SERVICE_CATEGORIE_NAME', 'Name');
define('_AM_SERVICE_CATEGORIE_LOGO', 'Logo');
define('_AM_SERVICE_CATEGORIE_LOGO_UPLOADS', 'Logo in %s :');
define('_AM_SERVICE_CATEGORIE_CREATED', 'Created');
define('_AM_SERVICE_CATEGORIE_SUBMITTER', 'Submitter');
// Service add/edit
define('_AM_SERVICE_SERVICE_ADD', 'Add Service');
define('_AM_SERVICE_SERVICE_EDIT', 'Edit Service');
// Elements of Service
define('_AM_SERVICE_SERVICE_ID', 'Id');
define('_AM_SERVICE_SERVICE_CAT', 'Categories');
define('_AM_SERVICE_SERVICE_TITLE', 'Title');
define('_AM_SERVICE_SERVICE_DESC', 'Desc');
define('_AM_SERVICE_SERVICE_IMG', 'Img');
define('_AM_SERVICE_SERVICE_IMG_UPLOADS', 'Img in %s :');
// General
define('_AM_SERVICE_FORM_UPLOAD', 'Upload file');
define('_AM_SERVICE_FORM_UPLOAD_NEW', 'Upload new file: ');
define('_AM_SERVICE_FORM_UPLOAD_SIZE', 'Max file size: ');
define('_AM_SERVICE_FORM_UPLOAD_SIZE_MB', 'MB');
define('_AM_SERVICE_FORM_UPLOAD_IMG_WIDTH', 'Max image width: ');
define('_AM_SERVICE_FORM_UPLOAD_IMG_HEIGHT', 'Max image height: ');
define('_AM_SERVICE_FORM_IMAGE_PATH', 'Files in %s :');
define('_AM_SERVICE_FORM_ACTION', 'Action');
define('_AM_SERVICE_FORM_EDIT', 'Modification');
define('_AM_SERVICE_FORM_DELETE', 'Clear');
// Broken
define('_AM_SERVICE_BROKEN_RESULT', 'Broken items in table %s');
define('_AM_SERVICE_BROKEN_NODATA', 'No broken items in table %s');
define('_AM_SERVICE_BROKEN_TABLE', 'Table');
define('_AM_SERVICE_BROKEN_KEY', 'Key field');
define('_AM_SERVICE_BROKEN_KEYVAL', 'Key value');
define('_AM_SERVICE_BROKEN_MAIN', 'Info main');
// ---------------- Admin Permissions ----------------
// Permissions
define('_AM_SERVICE_PERMISSIONS_GLOBAL', 'Permissions global');
define('_AM_SERVICE_PERMISSIONS_GLOBAL_DESC', 'Permissions global to check type of.');
define('_AM_SERVICE_PERMISSIONS_GLOBAL_4', 'Permissions global to approve');
define('_AM_SERVICE_PERMISSIONS_GLOBAL_8', 'Permissions global to submit');
define('_AM_SERVICE_PERMISSIONS_GLOBAL_16', 'Permissions global to view');
define('_AM_SERVICE_PERMISSIONS_APPROVE', 'Permissions to approve');
define('_AM_SERVICE_PERMISSIONS_APPROVE_DESC', 'Permissions to approve');
define('_AM_SERVICE_PERMISSIONS_SUBMIT', 'Permissions to submit');
define('_AM_SERVICE_PERMISSIONS_SUBMIT_DESC', 'Permissions to submit');
define('_AM_SERVICE_PERMISSIONS_VIEW', 'Permissions to view');
define('_AM_SERVICE_PERMISSIONS_VIEW_DESC', 'Permissions to view');
define('_AM_SERVICE_NO_PERMISSIONS_SET', 'No permission set');
// ---------------- Admin Others ----------------
define('_AM_SERVICE_ABOUT_MAKE_DONATION', 'Submit');
define('_AM_SERVICE_SUPPORT_FORUM', 'Support Forum');
define('_AM_SERVICE_DONATION_AMOUNT', 'Donation Amount');
define('_AM_SERVICE_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------
