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

include_once __DIR__ . '/admin.php';

// ---------------- Main ----------------
define('_MA_SERVICE_INDEX', 'Home');
define('_MA_SERVICE_TITLE', 'Service');
define('_MA_SERVICE_DESC', 'Our Service Area');
define('_MA_SERVICE_INDEX_DESC', "Welcome to the homepage of your new module Service!<br>
As you can see, you have created a page with a list of links at the top to navigate between the pages of your module. This description is only visible on the homepage of this module, the other pages you will see the content you created when you built this module with the module ModuleBuilder, and after creating new content in admin of this module. In order to expand this module with other resources, just add the code you need to extend the functionality of the same. The files are grouped by type, from the header to the footer to see how divided the source code.<br><br>If you see this message, it is because you have not created content for this module. Once you have created any type of content, you will not see this message.<br><br>If you liked the module ModuleBuilder and thanks to the long process for giving the opportunity to the new module to be created in a moment, consider making a donation to keep the module ModuleBuilder and make a donation using this button <a href='http://www.txmodxoops.org/modules/xdonations/index.php' title='Donation To Txmod Xoops'><img src='https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' alt='Button Donations' /></a><br>Thanks!<br><br>Use the link below to go to the admin and create content.");
define('_MA_SERVICE_NO_PDF_LIBRARY', 'Libraries TCPDF not there yet, upload them in root/Frameworks');
define('_MA_SERVICE_NO', 'No');
define('_MA_SERVICE_DETAILS', 'Show details');
define('_MA_SERVICE_BROKEN', 'Notify broken');
// ---------------- Contents ----------------
// Categorie
define('_MA_SERVICE_CATEGORIE', 'Categorie');
define('_MA_SERVICE_CATEGORIES', 'Categories');
define('_MA_SERVICE_CATEGORIES_TITLE', 'Categories title');
define('_MA_SERVICE_CATEGORIES_DESC', 'Categories description');
define('_MA_SERVICE_CATEGORIES_LIST', 'List of Categories');
// Caption of Categorie
define('_MA_SERVICE_CATEGORIE_ID', 'Id');
define('_MA_SERVICE_CATEGORIE_NAME', 'Name');
define('_MA_SERVICE_CATEGORIE_LOGO', 'Logo');
define('_MA_SERVICE_CATEGORIE_CREATED', 'Created');
define('_MA_SERVICE_CATEGORIE_SUBMITTER', 'Submitter');
// Service
define('_MA_SERVICE_SERVICE', 'Service');
define('_MA_SERVICE_SERVICES', 'Services');
define('_MA_SERVICE_SERVICES_TITLE', 'Services title');
define('_MA_SERVICE_SERVICES_DESC', 'Services description');
define('_MA_SERVICE_SERVICES_LIST', 'List of Services');
// Caption of Service
define('_MA_SERVICE_SERVICE_ID', 'Id');
define('_MA_SERVICE_SERVICE_CAT', 'Cat');
define('_MA_SERVICE_SERVICE_TITLE', 'Title');
define('_MA_SERVICE_SERVICE_DESC', 'Desc');
define('_MA_SERVICE_SERVICE_IMG', 'Img');
define('_MA_SERVICE_INDEX_THEREARE', 'There are %s Services');
define('_MA_SERVICE_INDEX_LATEST_LIST', 'Last Service');
// Submit
define('_MA_SERVICE_SUBMIT', 'Submit');
define('_MA_SERVICE_SUBMIT_SERVICE', 'Submit Service');
define('_MA_SERVICE_SUBMIT_ALLPENDING', 'All service/script information are posted pending verification.');
define('_MA_SERVICE_SUBMIT_DONTABUSE', 'Username and IP are recorded, so please do not abuse the system.');
define('_MA_SERVICE_SUBMIT_ISAPPROVED', 'Your service has been approved');
define('_MA_SERVICE_SUBMIT_PROPOSER', 'Submit a service');
define('_MA_SERVICE_SUBMIT_RECEIVED', 'We have received your service info. Thank you !');
define('_MA_SERVICE_SUBMIT_SUBMITONCE', 'Submit your service/script only once.');
define('_MA_SERVICE_SUBMIT_TAKEDAYS', 'This will take many days to see your service/script added successfully in our database.');
// Form
define('_MA_SERVICE_FORM_OK', 'Successfully saved');
define('_MA_SERVICE_FORM_DELETE_OK', 'Successfully deleted');
define('_MA_SERVICE_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
define('_MA_SERVICE_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
define('_MA_SERVICE_FORM_SURE_BROKEN', "Are you sure to notify as broken: <b><span style='color : Red;'>%s </span></b>");
define('_MA_SERVICE_INVALID_PARAM', "Invalid parameter");
// ---------------- Ratings ----------------
define('_MA_SERVICE_RATING_CURRENT_1', 'Rating: %c / %m (%t rating totally)');
define('_MA_SERVICE_RATING_CURRENT_X', 'Rating: %c / %m (%t ratings totally)');
define('_MA_SERVICE_RATING_CURRENT_SHORT_1', '%c (%t rating)');
define('_MA_SERVICE_RATING_CURRENT_SHORT_X', '%c (%t ratings)');
define('_MA_SERVICE_RATING1', '1 of 5');
define('_MA_SERVICE_RATING2', '2 of 5');
define('_MA_SERVICE_RATING3', '3 of 5');
define('_MA_SERVICE_RATING4', '4 of 5');
define('_MA_SERVICE_RATING5', '5 of 5');
define('_MA_SERVICE_RATING_10_1', '1 of 10');
define('_MA_SERVICE_RATING_10_2', '2 of 10');
define('_MA_SERVICE_RATING_10_3', '3 of 10');
define('_MA_SERVICE_RATING_10_4', '4 of 10');
define('_MA_SERVICE_RATING_10_5', '5 of 10');
define('_MA_SERVICE_RATING_10_6', '6 of 10');
define('_MA_SERVICE_RATING_10_7', '7 of 10');
define('_MA_SERVICE_RATING_10_8', '8 of 10');
define('_MA_SERVICE_RATING_10_9', '9 of 10');
define('_MA_SERVICE_RATING_10_10', '10 of 10');
define('_MA_SERVICE_RATING_VOTE_BAD', 'Invalid vote');
define('_MA_SERVICE_RATING_VOTE_ALREADY', 'You have already voted');
define('_MA_SERVICE_RATING_VOTE_THANKS', 'Thank you for rating');
define('_MA_SERVICE_RATING_NOPERM', "Sorry, you don't have permission to rate items");
define('_MA_SERVICE_RATING_LIKE', 'Like');
define('_MA_SERVICE_RATING_DISLIKE', 'Dislike');
define('_MA_SERVICE_RATING_ERROR1', 'Error: update base table failed!');
// Admin link
define('_MA_SERVICE_ADMIN', 'Admin');
// ---------------- End ----------------
