centerizeEl();
// menu initialization
var default_mode;
if( $( '#menu' ).hasClass('menu-minimal') ){
	default_mode = 'minimal';
} else {
	default_mode = 'contrast';
}
var treshold = $( '#menu' ).attr('data-treshold');
var menuObj = new Menu( $( '#menu' ), default_mode, $( treshold ) );
window.onscroll = function(){
	menuObj.setMode(); //změna stylu menu při přechodu přes header
	menuObj.setActiveTab(); // označí aktivní položku menu v závislosti na pozici stránky
};

// Při kliknutí na odkaz na prvek na stránce přejet scrollováním.
$(' a[href^="#"][href!="#"] ').click(function(e) { //všechny linky, které obsahují kotvu (prázdný # se nepočítá)
	e.preventDefault(); //zabrání aktualizaci stránky
	$( 'html,body' ).animate({
		scrollTop: $( $(this).attr('href') ).offset().top - 69}, //- výška vrchního menu
		'slow'
	);
});