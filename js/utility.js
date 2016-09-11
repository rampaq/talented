/***
Struktura:

0. formuláře ---
	i.		DialogAct (class)
	ii.		serializeInput
1. styl ---
	i.		centerizeEl

***/

/* --- (0) FORMULÁŘE --- */
/* - (i) DialogAct (class) - */

// třída obstarávající interakce s dialogem
function DialogAct(dialog) {
	dialog = $( dialog );

	var hidden_name = dialog.attr('id').replace('dialog-', ''), //název skrytého vstupu v původním formuláři
		type = 0;

	switch(hidden_name){
		case 'language':
			type = 1;
			break;
	}

	//naklonuje poslední řádek inputů a vyprázdní je
	this.addRow = function() {
		var lastRow = $('tr', dialog).eq(-1), //poslední řádek s inputy
			row_clone = lastRow.clone();
		$( 'input', row_clone).val( [] ); //vyprázdni obsah inputů
		row_clone.insertAfter( lastRow );
	};

	// odstraní řádek inputů
	this.deleteRow = function() {
		var lastRow = $('tr', dialog).eq(-1)
		lastRow.remove();
	};

	// přenese data z dialogu do (skrytého) pole v původním formuláři
	this.submitData = function() {
		var string = "",
			tbs = $( 'input[type="text"]', dialog); //kolekce všech textboxů v dialogu

		if(type == 0){
			// aktivity + certifikáty
			tbs.each( function(index, element) {
				var tb = tbs.eq(index); //právě iterovaný textbox
				// když textbox obsahuje text
				if( tb.val() ){
					string += tb.val() + ";";
				}
			});
		} else {
			// jazyky
			var selects = $( 'select', dialog); //kolekce všech selectů v dialogu
			for(i = 0; i < tbs.length; i++){
				// neprázdné vstupy
				if( tbs.eq(i).val() && selects.eq(i).val() ){
					string += tbs.eq(i).val() + '_' + selects.eq(i).val() + ';';
				}
			}
		}

		//nahrání do skrytého pole
		$( 'input[name="' + hidden_name + '"]' ).val( string );

		//nahrání do previewu
		$( '#' + hidden_name + '-preview' ).text( string.slice(0, -1).replace(/;/g, ', ').replace(/_/g, ' - ') );
	}

	// nahraje data ze skrytého pole do dialogu
	this.loadData = function() {
		// obsah skrytého pole
		var string = $( 'input[name="' + hidden_name + '"]' ).val(),
			tbs = $( 'input[type="text"]', dialog), //kolekce všech textboxů v dialogu
			row_vals = string.split(';');
		row_vals.pop(); //automaticky vyřadí poslední hodnotu, je prázdná

		var lack = row_vals.length - tbs.length;

		// přidávat nebo ubírat řádky do vyrovnání
		for(i = 0; i < Math.abs(lack); i++){
			tbs = $( 'input[type="text"]', dialog); // aktualizace
			if(lack > 0){
				this.addRow();
			} else if( tbs.length > 1 ) { //jeden řádek nech
				this.deleteRow();
			}
		}

		if(type == 0){
			// aktivity + certifikáty

			//nahrání do polí
			tbs.each( function(i, el){
				tbs.eq(i).val( row_vals[i] );
			});

		} else {
			// jazyky
			var selects = $( 'select', dialog),
				tb_vals = [],
				select_vals = [];

			for(i = 0; i < row_vals.length; i++){
				row_val = row_vals[i].split('_');
				tb_vals.push( row_val[0] );
				select_vals.push( row_val[1] );
			}

			// nahrání do polí
			tbs.each( function(i, el){
				tbs.eq(i).val( tb_vals[i] );
			});

			selects.each( function(k, el){
				selects.eq(k).val( select_vals[k] );
			});
		}
	}

}

/* - (ii) serializeInput - */
// Obsáhne všechny hodnoty zadaných vstupů do jednoho řetězce.
function serializeInput(delimiter, array) {
	string = "";
	array.forEach(function(selector, i){
		console.log(i + selector);
		string += $( selector ).val();
		if(i != array.length - 1){
			string += delimiter;
		}
	});
	return string;
}

/* --- (1) STYL --- */
/* - (i) centerizeEl - */

// všechny prvky zmíněné níže budou obaleny divem, který je umístí doprostřed
function centerizeEl(){
	var els = $( '.centerize' ).add( 'input[type="submit"]' );
	els.each( function(i, el){
		$( el ).wrap( '<div class="t-center"></div>' );
		$( el ).removeClass( 'centerize' );
	});
}