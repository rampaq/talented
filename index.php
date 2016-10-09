<?php

if(file_exists("install/index.php")){
	//perform redirect if installer files exist
	//this if{} block may be deleted once installed
	header("Location: install/index.php");
}

require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
?>

<link rel=stylesheet href="<?=$resource_abs_url;?>css/main-pages.css"> <!-- speciální styly pro hlavní stránku -->
<script>
// pro malé zařízení nezobrazovat animaci
if( !(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) ) {
	$.getScript("js/p5/p5.min.js");
	$.getScript("js/p5/hsb2rgb.js");
	$.getScript("js/animation/header-logo.min.js");
}
</script>

<!-- INDEX menu -->
<div class="menu menu-minimal" id="menu" data-treshold=".header-titles h1">
	<ul>
		<li><a href="#" onclick="$( 'html,body' ).animate({scrollTop: 0},'slow');">↑</a></li>
		<li><a href="#o-prvni-sanci">O První šanci</a></li>
		<li><a href="#studenti">Pro studenty</a></li>
		<li><a href="#firmy">Pro firmy</a></li>
		<li><a href="#kontakt">Kontakt</a></li>

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
		<?php } //end of conditional for menu display ?>

	</ul>
</div> <!-- end div.menu -->

<!-- ****** OBSAH ****** -->
	<header>
		<div class="header-titles">
			<h1>Talented</h1>
			<h2><cite>První šance od studentů pro studenty</cite></h2>
		</div>
		<div id="header-animation"></div>
	</header>

	<section id="uvod">
		<p>
			Považuješ se za nadaného a talentovaného středoškoláka, chceš se ve svém oboru zdokonalovat, ale nemáš možnost? Uvítal bys praxi nebo stáž u firmy, která by tvůj obor dokázala plně rozvinout a umožňovala ti v něm možný budoucí kariérní růst ? Nebo jen hledáš brigádu, která ti dá i něco víc než peníze?
		</p>
		<p>
			V První šanci poskytujeme studentům možnost nabrat zkušenosti ve firemním prostředí. Naše práce spočívá v tom, že ti najdeme stáž nebo praxi na míru. Osobně domluvíme detaily a podmínky a podle tvé specifikace ti najdeme stáž u vhodné firmy. Je to jednoduché, zaregistruj se a my Tě kontaktujeme.
		</p>
	</section>

	<section id="o-prvni-sanci">
		<h2>O První šanci</h2>
		<p>
			Jsme mladá ambiciózní firma, která studentům zprostředkovává brigádu, praxi nebo stáž za účelem získání tolik požadované praxe v prvním zaměstnání.
		</p>
		<div class="parallax-window" data-parallax="scroll" data-image-src="<?php echo $resource_abs_url; ?>img/index-00.jpg"></div>
		<p>
			Zároveň bychom chtěli pomoci aktivním studentům, kteří se snaží zdokonalit se ve svém oboru a najít jim možnost uplatnění přesně na míru. U nás si nemyslíme, že by nadaní studenti měli začínat s praxí jen z důvodu zápočtu ve škole nebo až na vysoké škole. Naší prioritou je zlepšit studentovo povědomí o práci ve vysněném oboru už na střední škole, čímž se lišíme od ostatních webových stránek zaměřených na podobnou tématiku.
		</p>
		<p>
			Nezáleží nám na tom, z jaké střední školy student pochází, ať už je to gymnázium, nebo odborná střední škola. Důležité je, jaké dovednosti student ovládá a hlavně zda se chce zlepšovat a získávat zkušenosti již nyní!
		</p>
	</section> <!--end section.o-prvni-sanci-->

	<section id="studenti">
		<h2>Výhody pro studenty</h2>
		<p>
			Pojď s námi otevřít pomyslné dveře otevírající pracovní svět, ve kterém máš jako student, nebo studentka mnoho možností, jak se uplatnit!
		</p>
		<p>
			Získáš mnoho nových zkušeností, naučíš se nové věci a dovednosti, najdeš si přátele a také mnoho kontaktů, které jsou v dnešní době k nazaplacení! Také si budeš zvykat a připravovat se na svou budoucnost a v praxi okusíš, čemu by ses chtěl/a či mohl/a věnovat. Naučíš se být zodpovědnější a odpovědný/ná sám/a za sebe. A samozřejmě si můžeš vydělat nějaké peníze, které se pro studentský život a například na cestování rozhodně hodí.
		</p>
		<p>
			Život ti leží u nohou, tak ho zvedni a pojď do toho, nemáš co ztratit!
		</p>
	</section> <!--end section.studenti-->

	<section id="firmy">
		<h2>Spolupráce s firmami</h2>
	</section> <!--end section.firmy-->

	<section id="o-nas">
		<h2>O nás</h2>
	</section> <!--end section.o-nas-->

	<section id="kontakt">
		<h2>Kontakt</h2>
		<h3>Napište nám!</h3>

		<form action="sendMail.php" method="post" class="center">
			<div class="t-left">
			<fieldset>
				<legend>Napište nám!</legend>
				<ul class="no-bullets">
					<li>
						<input type="text" name="email" placeholder="*e-mail" size="30">
					</li>
					<li>
						<textarea name="message" placeholder="*text zprávy" rows="10" cols="50"></textarea>
					</li>
					<li class="t-center">
						<input type="submit"/>
					</li>
				</ul>
			</fieldset>
			</div>
		</form>
	</section> <!--end section.kontakt-->

<!-- footers -->
<?php //require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // currently just the closing /body and /html ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
