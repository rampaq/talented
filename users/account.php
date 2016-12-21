<?php
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
<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();}
 if ($settings->site_offline==1){die("The site is currently offline.");}?>
<?php
$grav = get_gravatar(strtolower(trim($user->data()->email)));
$get_info_id = $user->data()->id;
// $groupname = ucfirst($loggedInUser->title);
$raw = date_parse($user->data()->join_date);
$signupdate = $raw['day']."/".$raw['month']."/".$raw['year'];
$userdetails = fetchUserDetails(NULL, NULL, $get_info_id); //Fetch user details
 ?>
<table>
	<tr>
		<td style="width: 45%; text-align: right;">
			<a href="user_settings.php"><img src="<?=($userdetails->avatar_path)?$userdetails->avatar_path:$resource_abs_url.'img/avatars/default.png'; ?>" class="img-thumbnail" alt="Profilový obrázek"></a>
		</td>
		<td style="width: 45%; text-align: left; margin: 0 1em;vertical-align: middle; padding-left: 1em;">
			<h1 style="margin-bottom:.5em;"><?=ucfirst($user->data()->fname)." ".ucfirst($user->data()->lname)?></h1>
			<?=$user->data()->email?><br>
			Členem od: <?=$signupdate?>
		</td>
	</tr>
</table>

<div style="clear:both;">
<p><a href="user_settings.php" class="btn btn-primary">Upravit údaje</a></p>
<p><a class="btn btn-primary " href="profile.php?id=<?=$get_info_id;?>" role="button">Public Profile</a></p>
</div>


<!-- PŘIŘAZENÍ HANDLERŮ -->
<script>
	$('[data-dialog]').each(function(index, toggleEl){

		var dialog = document.getElementById( $(toggleEl).attr('data-dialog') ),
			dlg = new DialogFx( dialog ),
			dlg_action = new DialogAct( dialog );
		var form = $( 'form', dialog ),
			add_btn = $( '.special-add', dialog );

		// přiřazení přepnutí stavu dialogu při kliknutí na spuštěcí element
		toggleEl.addEventListener( 'click', dlg.toggle.bind(dlg) );
	});
</script>

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
