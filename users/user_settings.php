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
<?php require_once '../users/init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/classes/class.upload.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php
if (!securePage($_SERVER['PHP_SELF'])){die();}

if ($settings->site_offline==1){die("The site is currently offline.");}?>
<?php

//PHP Goes Here!
$errors=[];
$successes=[];
$userId = $user->data()->id;
$grav = get_gravatar(strtolower(trim($user->data()->email)));

$validation = new Validate();
$userdetails=$user->data();

//Temporary Success Message
$holdover = Input::get('success');
if($holdover == 'true'){
	bold("Account Updated");
}

//Forms posted
if(!empty($_POST)) {
    $token = $_POST['csrf'];
    if(!Token::check($token)){
      die('Token doesn\'t match!');
    }else {
/*
    //Update display name
    if ($userdetails->email != $_POST['email']){
		$displayname = Input::get("email");

		$fields=array('email'=>$displayname);
		$validation->check($_POST,array(
		'email' => array(
		  'display' => 'email',
		  'required' => true,
		  'unique_update' => 'users,'.$userId,
		  'min' => 1,
		  'max' => 25
		)
		));
		if($validation->passed()){
			//echo 'email changes are disabled by commenting out this field and disabling input in the form/view';
			//$db->update('users',$userId,$fields);

			$successes[]="email updated.";
		}else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}

		}
    }else{
		$displayname=$userdetails->email;
	}
*/
/*
    //Update first name

    if ($userdetails->fname != $_POST['fname']){
    	/*
		$fname = Input::get("fname");

		$fields=array('fname'=>$fname);
		$validation->check($_POST,array(
		'fname' => array(
		  'display' => 'First Name',
		  'required' => true,
		  'min' => 1,
		  'max' => 25
		)
		));
		if($validation->passed()){
			$db->update('users',$userId,$fields);

			$successes[]='First name updated.';
		}else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}

		}

    } else{
		$fname=$userdetails->fname;
	}


    //Update last name

    if ($userdetails->lname != $_POST['lname']){
      $lname = Input::get("lname");

      $fields=array('lname'=>$lname);
      $validation->check($_POST,array(
        'lname' => array(
          'display' => 'Last Name',
          'required' => true,
          'min' => 1,
          'max' => 25
        )
      ));
    if($validation->passed()){
      $db->update('users',$userId,$fields);

	  $successes[]='Last name updated.';
    }else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}

      }

    } else{
		$lname=$userdetails->lname;
	}
*/
/*
    //Update email
    if ($userdetails->email != $_POST['email']){
      $email = Input::get("email");
      $fields=array('email'=>$email);
      $validation->check($_POST,array(
        'email' => array(
          'display' => 'Email',
          'required' => true,
          'valid_email' => true,
          'unique_update' => 'users,'.$userId,
          'min' => 3,
          'max' => 75
        )
      ));
    if($validation->passed()){
      $db->update('users',$userId,$fields);

	  $successes[]='Email updated.';
    }else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}
      }

    }else{
		$email=$userdetails->email;
	}
*/
	//---CUSTOM---//

	//město
	if ($userdetails->city != $_POST['city']){
		$city = Input::get("city");

		$fields=array('city'=>$city);
		$validation->check($_POST,array(
		'city' => array(
		  'display' => 'Město',
		  'required' => true,
		  'min' => 2,
		  'max' => 55
		)
		));
		if($validation->passed()){
			$db->update('users',$userId,$fields);

			$successes[]='Město aktualizováno.';
		}else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}

		}
    }else{
		$city=$userdetails->city;
	}

	//škola
	if ($userdetails->school != $_POST['school']){
		$school = Input::get("school");

		$fields=array('school'=>$school);
		$validation->check($_POST,array(
		'school' => array(
		  'display' => 'Škola',
		  'required' => true,
		  'min' => 5,
		  'max' => 150
		)
		));
		if($validation->passed()){
			$db->update('users',$userId,$fields);

			$successes[]='Škola aktualizována.';
		}else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}

		}
    }else{
		$school=$userdetails->school;
	}

	//zaměření
	if ($userdetails->focus != $_POST['focus']){
		$focus = Input::get("focus");

		$fields=array('focus'=>$focus);
		$validation->check($_POST,array(
		'focus' => array(
		  'display' => 'Zaměření',
		  'required' => true,
		  'min' => 3,
		  'max' => 350
		)
		));
		if($validation->passed()){
			$db->update('users',$userId,$fields);

			$successes[]='Zaměření aktualizováno.';
		}else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}

		}
    }else{
		$focus=$userdetails->focus;
	}

	//mimoškolní aktivity
	if ($userdetails->activity != $_POST['activity']){
		$activity = Input::get("activity");

		$fields=array('activity'=>$activity);
		$validation->check($_POST,array(
		'activity' => array(
		  'display' => 'Mimoškolní aktivity',
		  'min' => 0,
		  'max' => 350
		)
		));
		if($validation->passed()){
			$db->update('users',$userId,$fields);

			$successes[]='Mimoškolní aktivity aktualizovány.';
		}else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}

		}
    }else{
		$activity=$userdetails->activity;
	}

	//jazyky
	if ($userdetails->language != $_POST['language']){
		$language = Input::get("language");

		$fields=array('language'=>$language);
		$validation->check($_POST,array(
		'language' => array(
		  'display' => 'Jazyky',
		  'min' => 0,
		  'max' => 350
		)
		));
		if($validation->passed()){
			$db->update('users',$userId,$fields);

			$successes[]='Jazyky aktualizovány.';
		}else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}

		}
    }else{
		$language=$userdetails->language;
	}

	//certifikáty
	if ($userdetails->certificate != $_POST['certificate']){
		$certificate = Input::get("certificate");

		$fields=array('certificate'=>$certificate);
		$validation->check($_POST,array(
		'certificate' => array(
		  'display' => 'Certifikáty',
		  'min' => 0,
		  'max' => 350
		)
		));
		if($validation->passed()){
			$db->update('users',$userId,$fields);

			$successes[]='Certifikáty aktualizovány.';
		}else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}

		}
    }else{
		$certificate=$userdetails->certificate;
	}

	//názor na školu
	if ($userdetails->edu_opinion != $_POST['edu_opinion']){
		$edu_opinion = Input::get("edu_opinion");

		$fields=array('edu_opinion'=>$edu_opinion);
		$validation->check($_POST,array(
		'edu_opinion' => array(
		  'display' => 'Názor na školství',
		  'min' => 0,
		  'max' => 450
		)
		));
		if($validation->passed()){
			$db->update('users',$userId,$fields);

			$successes[]='Názor na školství aktualizován.';
		}else{
			//validation did not pass
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}

		}
    }else{
		$edu_opinion=$userdetails->edu_opinion;
	}

	//avatar!
	if ($_FILES['avatar_path']){
		$handle = new Upload($_FILES['avatar_path']);

		if ($handle->uploaded) {
        // yes, the file is on the server
        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/my_uploads/');
		$handle->allowed = array('image/*');
		$handle->image_convert = 'png';
		$filename = 'av_'.$userId;
       	$handle->file_new_name_body = $filename; //rename to av_01.jpg
       	$handle->image_resize = true;
       	$handle->image_ratio = true; // 300px je hraniční velikost
       	$handle->image_x = 300;
       	$handle->image_y = 300;

       	// backup current profile pic to temp
        if( $userdetails->avatar_path ){
        	// if profile pic isnt default avatar
        	$backup = true;
        	$original_file = $abs_us_root.$us_url_root.'img/avatars/'.basename($userdetails->avatar_path);
        	$temp_file = $abs_us_root.$us_url_root.'img/avatars/temp/'.basename($userdetails->avatar_path);
        	rename($original_file, $temp_file);
        }

        $handle->Process($abs_us_root.$us_url_root.'img/avatars');

        // we check if everything went OK
	        if ($handle->processed) {
	            // everything was fine !

	        	$fields=array('avatar_path'=>$resource_abs_url.'img/avatars/av_'.$userId.'.png');
	            $db->update('users',$userId,$fields);
				$successes[]='Profilový obrázek aktualizován.';
				//delete backup avatar
				if($backup){
					unlink($temp_file);
				}

	        } else {
	            // one error occured
	            $errors[] = $handle->error;
	            echo '<script>console.log('.$handle->error.');</script>';
	            // backup avatar picture back
	            rename($temp_file, $original_file);

	        }
        // we delete the temporary files
        $handle-> Clean();

        $avatar_path=$resource_abs_url.'img/avatars/av_'.$userId.'.png';
    }

    }else{
		$avatar_path=$userdetails->avatar_path;	}


	// update pwd
    if(!empty($_POST['password'])) {
      $validation->check($_POST,array(
        'old' => array(
          'display' => 'Old Password',
          'required' => true,
        ),
        'password' => array(
          'display' => 'New Password',
          'required' => true,
          'min' => 6,
        ),
        'confirm' => array(
          'display' => 'Confirm New Password',
          'required' => true,
          'matches' => 'password',
        ),
      ));
		foreach ($validation->errors() as $error) {
			$errors[] = $error;
		}

      if (!password_verify(Input::get('old'),$user->data()->password)) {
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}
			$errors[]='Your password does not match our records.';
      }
		if (empty($errors)) {
			//process
			$new_password_hash = password_hash(Input::get('password'),PASSWORD_BCRYPT,array('cost' => 12));
			$user->update(array('password' => $new_password_hash,),$user->data()->id);
			$successes[]='Password updated.';
		}
    }
    }
}else{
	$displayname=$userdetails->email;
	$fname=$userdetails->fname;
	$lname=$userdetails->lname;
	$email=$userdetails->email;
	//custom
	$city=$userdetails->city;
	$school=$userdetails->school;
	$focus=$userdetails->focus;
	$activity=$userdetails->activity;
	$language=$userdetails->language;
	$certificate=$userdetails->certificate;
	$edu_opinion=$userdetails->edu_opinion;
	if($userdetails->avatar_path == ""){
		$avatar_path = $resource_abs_url."img/avatars/default.png";
	} else {
		$avatar_path=$userdetails->avatar_path;
	}
}

//nezměnitelné columns, yet still visible
$fname=$userdetails->fname;
$lname=$userdetails->lname;
$email=$userdetails->email;
?>
<!-- dialogy -->
<link rel=stylesheet href="<?php echo $resource_abs_url;?>css/dialog/dialog.css">
<link rel=stylesheet href="<?php echo $resource_abs_url;?>css/dialog/dialog-sally.css">
<script src="<?php echo $resource_abs_url;?>js/dialog/snap.svg-min.js"></script>
<script src="<?php echo $resource_abs_url;?>js/dialog/modernizr.custom.js"></script>
<script src="<?php echo $resource_abs_url;?>js/dialog/classie.js"></script>
<script src="<?php echo $resource_abs_url;?>js/dialog/dialogFx.js"></script>

<div id="page-wrapper">
<h2>Změna uživatelských údajů</h2>

<div class="errors"><?=display_errors($errors);?></div>
<div class="successes"><?=display_successes($successes);?></div>
<h1><?php echo $fname." ".$lname; ?></h1>
<form name='updateAccount' enctype="multipart/form-data" action='user_settings.php' method='post'>
	<img src="<?=$avatar_path?>" class="img-thumbnail" alt="Profilový obrázek">
	<hr>
	<label for="avatar_path">Nahraj profilový obrázek (jpg, png, bmp; < 2MB):</label><input type="file" id="avatar_path" name="avatar_path" accept=".jpg,.png,.bmp" />
	<fieldset class="zakl-udaje">
		<legend>ZÁKLADNÍ ÚDAJE</legend>
		<label for="city">Bydliště:</label><input type="text" id="city" name="city" placeholder="stačí pouze město" value="<?=$city?>">
		<label for="school">Škola:</label><input type="text" id="school" name="school" value="<?=$school?>">
	</fieldset>

	<fieldset class="rozsir-udaje">
		<label for="focus">Čemu by ses chtěl v budoucnu věnovat (zaměstnání):</label><br>
		<textarea id="focus" name="focus" cols="100" rows="10" required><?=$focus?></textarea>

		<br>
		<label>Tvoje mimoškolní aktivity: </label><a id="activity-preview" class="preview" data-placeholder="---"><?=$activity?></a>
		<br>
		<a href="#" class="btn highlight" data-dialog="dialog-activity">Přidat aktivity</a>
		<input type="hidden" name="activity" value="<?=$activity?>">

		<br>
		<label>Jazyky: </label><a id="language-preview" class="preview" data-placeholder="---"><?=$language?></a>
		<br>
		<a href="#" class="btn highlight" data-dialog="dialog-language">Přidat jazyk</a>
		<input type="hidden" name="language" value="<?=$language?>">

		<br>
		<label>Certifikáty, diplomy: </label><a id="certificate-preview" class="preview" data-placeholder="---"><?=$certificate?></a>
		<br>
		<a href="#" class="btn highlight" data-dialog="dialog-certificate">Přidat certifikát</a>
		<input type="hidden" name="certificate" value="<?=$certificate?>">
	</fieldset>

	<fieldset class="prihl-udaje">
		<legend>PŘIHLAŠOVACÍ ÚDAJE</legend>
		<label for="email">Email:</label><input type="text" size="10" id="email" name="email" value="<?=$email?>" disabled>
		<br>

		<label for="old">Old Password (required to change password)</label><input class='form-control' type='password' name='old' />
		<label for="password">New Password (8 character minimum)</label><input class='form-control' type='password' name='password' />
		<label for="confirm">Confirm Password</label><input class='form-control' type='password' name='confirm' />
	</fieldset>

	<fieldset class="volitelne">
		<legend>VOLITELNÉ</legend>
		<label for="edu_opinion">Jaký máš postoj k českému školství (názor):</label><br>
		<textarea name="edu_opinion" cols="100" rows="10" value="<?=$edu_opinion?>"></textarea>
	</fieldset>

	<input type="hidden" name="csrf" value="<?=Token::generate();?>" />
	<div class="t-center">
		<input type="submit" value="Odeslat">
		<a class="btn" href="account.php">Zrušit</a>
	</div>
</form>
</div>

<?php
if (!empty($errorrs) || !empty($successes)){
?>
<div class="notification-bar">
<?php
echo (!empty($errorrs)) ? 'Vyskytly se problémy s údaji.'.PHP_EOL : '';
echo (!empty($successes)) ? 'Aktualizace údajů proběhla úspěšně.' : '';
?>
</div>
<?php
}
?>

<!-- *** VYSKAKOVACÍ DIALOGY *** -->
<!-- PŘIDAT AKTIVITY -->
<div id="dialog-activity" class="dialog">
	<div class="dialog__overlay"></div>
	<div class="dialog__content">
		<h3 class="t-center">Správa aktivit</h3>
		<form>
			<table>
				<tr>
					<td><input type="text"></td>
				</tr>
			</table>
			<button type="button" class="special-add centerize">+</button>
			<hr/>
			<input type="submit" value="Hotovo" data-dialog-close>
		</form>
	</div>
</div>
<!-- PŘIDAT JAZYKY -->
<div id="dialog-language" class="dialog">
	<div class="dialog__overlay"></div>
	<div class="dialog__content">
		<h3 class="t-center">Správa jazyků</h3>
		<form>
		<ul>
			<li>A1 (začátečník)</li>
			<li>A2 (lepší začátečník)</li>
			<li>B1 (středně pokročilý)</li>
			<li>B2 (lepší středně pokročilý)</li>
			<li>C1 (pokročilý)</li>
			<li>C2 (zvládnutí jazyka)</li>
		</ul>
			<table>
				<tr>
					<td><input type="text" placeholder="jazyk"></td>
					<td>
						<select>
							<option value="" disabled selected>úroveň</option>
							<option>A1</option>
							<option>A2</option>
							<option>B1</option>
							<option>B2</option>
							<option>C1</option>
							<option>C2</option>
						</select>
					</td>
				</tr>
			</table>
			<button type="button" class="special-add centerize">+</button>
			<hr/>
			<input type="submit" value="Hotovo" data-dialog-close>
		</form>
		<div style="display:none;"><button data-dialog-close>Zavřít</button></div>
	</div>
</div>
<!-- PŘIDAT CERTIFIKÁTY -->
<div id="dialog-certificate" class="dialog">
	<div class="dialog__overlay"></div>
	<div class="dialog__content">
		<h3 class="t-center">Správa certifikátů</h3>
		<form>
			<table>
				<tr>
					<td><input type="text"></td>
				</tr>
			</table>
			<button type="button" class="special-add centerize">+</button>
			<hr/>
			<input type="submit" value="Hotovo" data-dialog-close>
		</form>
		<div style="display:none;"><button data-dialog-close>Zavřít</button></div>
	</div>
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

		// načtení dat do dialogu ze skrytého pole
		$( document ).ready( function(){
				dlg_action.loadData();
		});
		$( toggleEl ).click( function(e) {
			e.preventDefault();
			dlg_action.loadData();
		});

		// při potvrzení dat z dialogu zapiš do skrytého pole
		form.submit( function(e) {
			e.preventDefault();
			dlg_action.submitData();
		});

		// při kliknutí na + přidat řádek inputů
		add_btn.click( function() {
			dlg_action.addRow();
		});
	});

	$( '#dialog-avatar form' ).submit( function(e){
		e.preventDefault();
		$( 'input[name="avatar_path"] ').val($( '#dialog-avatar input[type="file"]' ));
	});

	$( '#profile-data-form' ).submit( function(e){
			e.preventDefault();
			$( 'input[name="born_date"]' ).val( serializeInput('-', ['#year', '#month', '#day']) );
			$(this).off('submit').submit();
	} );

	centerizeEl();
</script>

    <!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
