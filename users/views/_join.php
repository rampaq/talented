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

<?php
if (!$form_valid && Input::exists()){
	//echo display_errors($validation->errors());
?>
<div class="errors"><?=display_errors($validation->errors());?></div>
<?php
}
?>

<!-- dialogy -->
<link rel=stylesheet href="<?php echo $resource_abs_url;?>css/dialog/dialog.css">
<link rel=stylesheet href="<?php echo $resource_abs_url;?>css/dialog/dialog-sally.css">
<script src="<?php echo $resource_abs_url;?>js/dialog/snap.svg-min.js"></script>
<script src="<?php echo $resource_abs_url;?>js/dialog/modernizr.custom.js"></script>
<script src="<?php echo $resource_abs_url;?>js/dialog/classie.js"></script>
	<script src="<?php echo $resource_abs_url;?>js/dialog/dialogFx.js"></script>


<form id="profile-data-form" action="<?=$form_action;?>" method="<?=$form_method;?>">
	<fieldset class="zakl-udaje">
		<legend>ZÁKLADNÍ ÚDAJE</legend>
		<label for="fname">Jméno:</label><input type="text" id="fname" name="fname" value="<?php if (!$form_valid && !empty($_POST)){ echo $fname;} ?>" required>
		<label for="lname">Příjmení:</label><input type="text" id="lname" name="lname" value="<?php if (!$form_valid && !empty($_POST)){ echo $lname;} ?>" required>

		<br>
		<label for="day">Datum narození:</label>
		<select id="day" required>
			<option value="" disabled selected>den</option>
			<option value="01">1</option>
			<option value="02">2</option>
			<option value="03">3</option>
			<option value="04">4</option>
			<option value="05">5</option>
			<option value="06">6</option>
			<option value="07">7</option>
			<option value="08">8</option>
			<option value="09">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
		</select>
		<select id="month" required>
			<option value="" disabled selected>měsíc</option>
			<option value="01">leden</option>
			<option value="02">únor</option>
			<option value="03">březen</option>
			<option value="04">duben</option>
			<option value="05">květen</option>
			<option value="06">červen</option>
			<option value="07">červenec</option>
			<option value="08">srpen</option>
			<option value="09">září</option>
			<option value="10">říjen</option>
			<option value="11">listopad</option>
			<option value="12">prosinec</option>
		</select>
		<select id="year" required>
			<option value="" disabled selected>rok</option>
		<?php
			$date = intval( date('Y') );
			for($i = 0; $i <= 25; $i++):
			$curr = $date - 25 + $i;
		?>
			<option value="<?php echo $curr; ?>"><?php echo $curr; ?></option>
		<?php
			endfor;
		?>
		</select>
		<input type="hidden" name="born_date">

		<br>
		<label for="city">Bydliště:</label><input type="text" id="city" name="city" placeholder="stačí pouze město" value="<?php if (!$form_valid && !empty($_POST)){ echo $city;} ?>" required>
		<label for="school">Škola:</label><input type="text" id="school" name="school" value="<?php if (!$form_valid && !empty($_POST)){ echo $school;} ?>" required>
	</fieldset>

	<fieldset class="rozsir-udaje">
		<label for="focus">Čemu by ses chtěl v budoucnu věnovat (zaměstnání):</label><br>
		<textarea id="focus" name="focus" cols="100" rows="10" required><?php if (!$form_valid && !empty($_POST)){ echo $focus;} ?></textarea>

		<br>
		<label id="activity">Tvoje mimoškolní aktivity: </label><a id="activity-preview" class="preview" data-placeholder="---"><?php if (!$form_valid && !empty($_POST)){ echo $activity;} ?></a>
		<br>
		<a href="#" class="btn highlight" data-dialog="dialog-activity">Přidat aktivity</a>
		<input type="hidden" name="activity" value="<?php if (!$form_valid && !empty($_POST)){ echo $activity;} ?>">

		<br>
		<label id="language">Jazyky: </label><a id="language-preview" class="preview" data-placeholder="---"><?php if (!$form_valid && !empty($_POST)){ echo $language;} ?></a>
		<br>
		<a href="#" class="btn highlight" data-dialog="dialog-language">Přidat jazyk</a>
		<input type="hidden" name="language" value="<?php if (!$form_valid && !empty($_POST)){ echo $language;} ?>">

		<br>
		<label id="certificate">Certifikáty, diplomy: </label><a id="certificate-preview" class="preview" data-placeholder="---"><?php if (!$form_valid && !empty($_POST)){ echo $certificate;} ?></a>
		<br>
		<a href="#" class="btn highlight" data-dialog="dialog-certificate">Přidat certifikát</a>
		<input type="hidden" name="certificate" value="<?php if (!$form_valid && !empty($_POST)){ echo $certificate;} ?>">
	</fieldset>

	<fieldset class="prihl-udaje">
		<legend>PŘIHLAŠOVACÍ ÚDAJE</legend>
		<label for="email">Email:</label><input type="text" size="10" id="email" name="email" value="<?php if (!$form_valid && !empty($_POST)){ echo $email;} ?>" required>
		<br>
		<label for="password">Heslo:</label><input type="password" size="10" id="password" name="password" required>
		<label for="confirm">Potvrdit heslo:</label><input type="password" size="10" id="confirm" name="confirm" required>
	</fieldset>

	<fieldset class="volitelne">
		<legend>VOLITELNÉ</legend>
		<label for="edu_opinion">Jaký máš postoj k českému školství (názor):</label><br>
		<textarea name="edu_opinion" cols="100" rows="10" value="<?php if (!$form_valid && !empty($_POST)){ echo $edu_opinion;} ?>"></textarea>
	</fieldset>

	<br>

	<input type="checkbox" id="agreement_checkbox" name="agreement_checkbox" required><label for="agreement_checkbox">Souhlasíte s našimi ďábelskými podmínkami, které Vám neřekneme? (stejně nemáš na vybranou)</label>

	<?php if($settings->recaptcha == 1){ ?>
	<div class="form-group">
		<div class="g-recaptcha" data-sitekey="<?=$publickey; ?>"></div>
	</div>
	<?php } ?>
	<input type="hidden" value="<?=Token::generate();?>" name="csrf">

	<input type="submit" value="Odeslat">
</form>

<?php
//skript nemůže být na začátku stránky, protože elementy, na které se aplikujío chyby se ještě nenačetly
	if (!$form_valid && Input::exists()){
		foreach($validation->errors() as $error){
			if(is_array($error) && isset($error[1]) ){
				?>
				<script>$("#<?php echo $error[1]; ?>").addClass("has-error");</script>
				<?php
			}
		}
	}
?>

<?php
if (!$form_valid && Input::exists()){
	//echo display_errors($validation->errors());
?>
<div class="notification-bar">Vyskytly se problémy s údaji.</div>
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

	$( '#profile-data-form' ).submit( function(e){
			e.preventDefault();
			$( 'input[name="born_date"]' ).val( serializeInput('-', ['#year', '#month', '#day']) );
			$(this).off('submit').submit();
	} );

	centerizeEl();
</script>