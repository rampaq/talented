<?php
ob_start();
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php require_once $abs_us_root.$us_url_root.'users/helpers/helpers.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/user_spice_ver.php'; ?>
<?php
//check for a custom page
$currentPage = currentPage();
if(file_exists($abs_us_root.$us_url_root.'usersc/'.$currentPage)){
	if(currentFolder()!= 'usersc'){
		Redirect::to($us_url_root.'usersc/'.$currentPage);
	}
}

$db = DB::getInstance();
$settingsQ = $db->query("Select * FROM settings");
$settings = $settingsQ->first();
if ($settings->site_offline==1){
	die("The site is currently offline.");
}

if ($settings->force_ssl==1){
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
		// if request is not secure, redirect to secure url
		$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		Redirect::to($url);
		exit;
	}
}

if($settings->track_guest == 1){
	new_user_online();
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<?php
	if(file_exists($abs_us_root.$us_url_root.'usersc/includes/head_tags.php')){
		require_once $abs_us_root.$us_url_root.'usersc/includes/head_tags.php';
	}
	?>

	<title><?=$settings->site_name;?></title>

	<!-- Bootstrap Core CSS -->
	<!-- AKA Primary CSS -->
	<link href="<?=$resource_abs_url?>css/default/standard.css" rel="stylesheet">

	<!-- Template CSS -->
	<!-- AKA Secondary CSS -->
	<link href="<?=$resource_abs_url?>css/default/sb-admin.css" rel="stylesheet">

	<link rel="stylesheet" href="<?=$resource_abs_url;?>css/reset.css">
	<link rel="stylesheet" href="<?=$resource_abs_url;?>css/style.css">
	<link rel="stylesheet" href="<?=$resource_abs_url;?>css/customScrollbar.css">

	<script src="<?=$resource_abs_url;?>js/lib/jquery-3.0.0.min.js"></script>
	<script src="<?=$resource_abs_url;?>js/class/Menu.js"></script>
	<script src="<?=$resource_abs_url;?>js/utility.js"></script>

</head>

<body>
