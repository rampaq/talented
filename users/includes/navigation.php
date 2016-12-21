<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

Feb 02 2016 - Ported US3.2.1 top-nav

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

// Signup
$lang = array_merge($lang,array(
	"SIGNUP_TEXT"			=> "Register",
	"SIGNUP_BUTTONTEXT"		=> "Register Me",
	"SIGNUP_AUDITTEXT"		=> "Registered",
	));

// Signin
$lang = array_merge($lang,array(
	"SIGNIN_FAIL"			=> "** FAILED LOGIN **",
	"SIGNIN_TITLE"			=> "Please Log In",
	"SIGNIN_TEXT"			=> "Log In",
	"SIGNOUT_TEXT"			=> "Log Out",
	"SIGNIN_BUTTONTEXT"		=> "Login",
	"SIGNIN_AUDITTEXT"		=> "Logged In",
	"SIGNOUT_AUDITTEXT"		=> "Logged Out",
	));

//Navigation
$lang = array_merge($lang,array(
	"NAVTOP_HELPTEXT"		=> "Help",
	));

$query = $db->query("SELECT * FROM email");
$results = $query->first();

//Value of email_act used to determine whether to display the Resend Verification link
$email_act=$results->email_act;

?>

<!-- INDEX menu -->
<div class="menu menu-contrast" id="menu">
	<ul>
		<li class="f-left">
			<a href="<?=$us_url_root?>">-home, sweet home-</a>
		</li>
		<?php if($user->isLoggedIn()){ //anyone is logged in?>
			<li class="f-right">
				<a href="<?=$us_url_root?>users/logout.php">Odhlásit se</a>
			</li>
			<li class="f-right">
				<a href="<?=$us_url_root?>users/account.php"><?=$user->data()->email;?></a>
			</li>
		<?php }else{ // no one is logged in so display default items ?>
			<li class="f-right">
				<a href="<?=$us_url_root?>users/login.php">Přihlásit se</a>
			</li>
			<li class="f-right">
				<a href="<?=$us_url_root?>users/join.php">Registrovat se</a>
			</li>
				<?php if ($email_act){ //Only display following menu item if activation is enabled ?>
				<li class="f-right">
					<a href="<?=$us_url_root?>users/verify_resend.php"> Resend Activation Email</a>
				</li>
				<?php }?>
		<?php } //end of conditional for menu display ?>
	</ul>
</div> <!-- end div.menu -->
<div style="height: 64px;"></div> <!-- výplň pro menu -->