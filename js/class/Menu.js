//menu jako jQuery objekt
function Menu(menu, default_mode, treshold){
	this.menu = menu;
	this.default = default_mode;
	this.treshold = treshold;

	// Když je menu za úrovní switche (nadpisu, původně), tak změní styl menu.
	this.setMode = function(){
		var top_pos = window.pageYOffset; //aktální pozice uživatele na stránce
		var limit = this.treshold.offset().top - 10; // pozice vrchního okraje nadpisu stránky + 10px rezerva
		var class1;
		var class2;

		if(this.default == 'minimal'){
			class1 = 'menu-minimal';
			class2 = 'menu-contrast';
		}else{
			class1 = 'menu-contrast';
			class2 = 'menu-minimal';
		}

		if ( top_pos > limit - 85 ){ // - velikost většího menu
			this.menu.removeClass( class1 ).addClass( class2 ); //nastav kontrast
		} else {
			this.menu.removeClass( class2 ).addClass( class1 ); //nastav normální
		}
	}

	// Označí classou '.menu-aktivni-tab' aktivní položku v menu v závislosti na scrollu (pozici uživatele na stránce).
	// -- Marker je element, na který se odkazuje položka menu.
	this.setActiveTab = function(){
		var top_pos = window.pageYOffset; //aktální pozice uživatele na stránce
		var tab_links = $('a[href^="#"][href!="#"]', this.menu); //všechny linky, které obsahují kotvu (prázdný # se nepočítá)
		var markerIDs = [];

		tab_links.each( function(i, el){
			var href = $(el).attr('href');
			//pokud existuje element, na který položka menu existuje, přidej do seznamu
			if( $(href).length ){
				markerIDs.push( href );
			}
		});

		for (i = 0; i < markerIDs.length; i++){
			var j = markerIDs.length - 1 - i;
			var marker = $( markerIDs[j] )[0];
			var tab = $( 'a[href="' + markerIDs[j] + '"]', this.menu ).parent();
			var active_tab = $( '.menu-aktivni-tab' );

			if ( top_pos + 70 >= marker.offsetTop && top_pos < marker.offsetTop + marker.offsetHeight ){ //70 px je výška menu
				// uživatel se nachází v markeru

				// zabrání opakovanému označování jedné položky (která je zároveň označená a zároveň ji metoda chce označit)
				if( !tab.is(active_tab) ){
					active_tab.removeClass();
					tab.attr('class', 'menu-aktivni-tab');
				}
				break; // není důvod testovat další markery, ukončí foreach smyčku
			} else {
				// uživatel se nenachází v žádném markeru

				if( active_tab.length ){ //pokud je co odznačovat
					active_tab.removeClass();
				}
			}
		}
	}

}