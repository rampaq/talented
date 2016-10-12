/*
+----------------------+--------------------+
| 			  Main title animation          |
+----------------------+--------------------+
| Author:              | Tomáš Faikl        |
| Date:                | 5/10/2016          |
| Site:                | http://talented.cz |
+----------------------+--------------------+
*/

var _string;
var main_color;
var main_color_hsb;
var moving_count;
var pixel_span;
var grey_colors = [];
var main_colors = [];
var font_particles = [];
var moving_particles = [];
var font_points = [];
var initialized;
var hover;
var time;
var time_set;

$( window ).resize(function() {
	$('#header-animation').css('left', (window.innerWidth - $('#header-animation canvas').width())/2 );
	$('#header-animation').css('top',  (window.innerHeight*.8 - $('#header-animation canvas').height())*.5);
});

function setup() {
	var canvas;
	if(window.innerWidth <= 1000) {
		canvas = createCanvas(1000, .8*window.innerHeight);
		canvas.parent('header-animation');
		$('#header-animation').css('left', (window.innerWidth - $('#header-animation canvas').width())/2 );
	} else {
		canvas = createCanvas(window.innerWidth, .8*window.innerHeight);
		canvas.parent('header-animation');
	}

	frameRate(30);
	textFont("Righteous");
	textAlign(CENTER, CENTER);
	colorMode(RGB, 255, 255, 255, 255);

	// -- NASTAVENÍ -- //
	_string = "TALENTED";
	textSize(190);
	main_color_hsb = [88, 0.75, 1]; //ve formátu HSB maxima (360, 1, 1)
	main_color = hsb2rgb(main_color_hsb[0], main_color_hsb[1], main_color_hsb[2]);
	main_color = color(main_color[0], main_color[1], main_color[2]);
	moving_count = 300;
	pixel_span = 10;

	initialized = false;
	hover = false;
	time = 0;
	time_set = 0;

	// READ COORDINATES FROM FILE
	if (window.File && window.FileReader && window.FileList && window.Blob) {
		var reader = new FileReader();
		reader.readAsDataUrl('./190_Righteous_10.txt');
	}

	// - create main colors -//
	main_colors[0] = main_color;
	// HSB je ve formátu (360, 1, 1)
	if (_string.length > 1) {
		var h_step = 360 / (_string.length - 1);
		var hue = main_color_hsb[0];
		for (var i = 1; i < _string.length; i++) {
			hue += h_step;
			hue %= 360;
			var rgb = hsb2rgb(hue, main_color_hsb[1], main_color_hsb[2]);
			main_colors[i] = color(rgb[0], rgb[1], rgb[2]);
		}
	}

	// - create shades of main color -//
	var rgb_step = 100/(_string.length - 1);
	var curr_lev = 255;
	for (var i = 0; i < _string.length; i++) {
		grey_colors[i] = color(curr_lev);
		curr_lev -= rgb_step;
	}
}

function draw() {
	if (!initialized) {
		// -- inicializace bodů a částic -- //

		if (window.File && window.FileReader && window.FileList && window.Blob) {
			reader.result;
		} else {
			background(0);
			fill(255); //white
			noStroke();
			text(_string, width/2, height/2 + 20);

			// - vyhledej body - //
			var last_x = width/2 - 515; // pozice, ze které zahajovat hledání dalšího písmene
			var in_gap = true;

			for (var i = 0; i < _string.length; i++) {
				var coords = [];
				X:
					for (var x = last_x + pixel_span; x < width/2 + 515; x += pixel_span) {
						var exists_point = false;
						for (var y = height/2 - 140; y < height/2 + 140; y += pixel_span) {
							last_x = x;
							var col_p = get(x, y);
							if (col_p[0] > 0) { //stačí porovnat jeden kanál
								// detekován bod
								in_gap = false;
								exists_point = true;
								coords.push(createVector(x, y));
								// když ani na konci sloupce neexistuje jediný bod a pokud předchozí sloupec nebyl mezera, překroč k dalšímu písmenu
							} else if (!exists_point && y >= height/2 + 140 - pixel_span && !in_gap) {
								in_gap = true;
								break X;
							}
						}
					}
				font_points[i] = coords; //new FontPoints(i, coords));
			}
		}




// WRITE POINTS TO OUTPUT //
		// process the points
		var min_x = 9999;
		var min_y = 9999;
		var max_x = 0;
		var max_y = 0;
		for(var i = 0; i < _string.length; i++){
			var coords = font_points[i];
			for(var j = 0; j < coords.length; j++){
				if(coords[i].x < min_x){
					min_x = coords[i].x;
				}
				if(coords[i].y < min_y){
					min_y = coords[i].y;
				}
				if(coords[i].x > max_x){
					max_x = coords[i].x;
				}
				if(coords[i].y > max_y){
					max_y = coords[i].y;
				}
			}
		}
		// create file with instructions
		// normalize - translate to origin
		var font_height = max_y - min_y;
		var font_width = max_x - min_x;
		var content = "" + font_width + " " + font_height + "\n"; // sirka vyska
		for(var i = 0; i < _string.length; i++){
			var coords = font_points[i];
			console.log(coords);
			for(var j = 0; j < coords.length; j++){
				content += (coords[j].x - min_x) + " " + (coords[j].y - min_y) + "\n"; // x y \n
			}
			content += "-" + "\n"; // -
		}
		$( '#output' ).text( content );

		// -- creating particles -- //
		// create static particles
		for (var i = 0; i < _string.length; i++) {
			var char_points = font_points[i];
			for(var j = 0; j < char_points.length; j++){
				var coord = char_points[j];
				font_particles.push(new FontParticle(coord.x, coord.y, i));
			}
		}

		// create moving particles with random initial coords inside of one random letter
		for (var j = 0; j < moving_count; j++) {
			var i =	int(random(0, _string.length)); //random letter
			var char_points = font_points[i];
			var rand_pos = char_points[ int(random(0, char_points.length)) ];
			moving_particles.push(new MovingParticle(rand_pos.x, rand_pos.y, i));
		}

		console.log("initialized!");
		font_points = [];
		initialized = true;
	} else {

		// -- DRAWING LOOP -- //
		background(10, 10, 10);

		if(!hover && $("canvas:hover").length == 1){
			time_set = time;
			hover = true;
		} else if(hover && $("canvas:hover").length == 0){
			time_set = time;
			hover = false;
		}

		// wind effect
		if (hover) {
			for(var i = 0; i < moving_particles.length; i++){
				var p = moving_particles[i];
				var vect = createVector(mouseX, mouseY);
				vect = centerizeVector(vect);
				vect.x = map(vect.x, -width / 2, width / 2, -sqrt(2) / 2, sqrt(2) / 2);
				vect.y = map(vect.y, -height / 2, height / 2, -sqrt(2) / 2, sqrt(2) / 2);
				p.applyForce(vect.mult(.3));
			}
		}

		for(var i = 0; i < moving_particles.length; i++){
			var p = moving_particles[i];
			if(p.pos.x >= width/2){
				vect = createVector(0.005*window.pageYOffset, 0);
			} else {
				vect = createVector(-0.005*window.pageYOffset, 0);
			}
			p.applyForce(vect);
		}

		// loop for particles
		for(var i = 0; i < moving_particles.length; i++){
			var p = moving_particles[i];
			p.update();
			p.display();
		}
		for(var i = 0; i < font_particles.length; i++){
			var p = font_particles[i];
			p.update();
			p.display();
		}

		//console.log(getFrameRate());
		time++;
	}

}
function centerizeVector(vector) {
	var center = createVector(width / 2, height / 2);
	vector = p5.Vector.sub(vector, center);
	return vector;
}

// --- TŘÍDY --- //
function FontParticle(init_x, init_y, _i){
	var pos, vel, acc;
	var init_pos;
	var i; //assign to n-th letter in string
	var size;
	var init_size;

	this.init_pos = createVector(init_x, init_y);
	this.pos = createVector(init_x, init_y);
	this.vel = createVector(0, 0);
	this.acc = createVector(0, 0);
	this.i = _i;
	this.init_size = random(2, 8);
	this.size = this.init_size;

  this.applyForce = function(force){
    this.acc.add(force);
  }

  this.update = function(){
    //this.applyForce(createVector(random(-.05, .05), random(-.05, .05))); //jiggle
    //this.applyForce(p5.Vector.sub(this.init_pos, this.pos).mult(.3)); //restrict jiggling far from initial position
    this.size = map(sin(time* Math.PI/40 + this.init_size), -1, 1, 2, pixel_span/2); //change size
    this.vel.add(this.acc.limit(.1));
    this.acc.mult(0);
    this.pos.add(this.vel);
  }

  this.display = function(){
    var lerp_to = (hover) ? main_colors[this.i] : grey_colors[this.i];
    var lerp_from = (!hover) ? main_colors[this.i] : grey_colors[this.i];
    var col;
    if (time_set != 0) {
      col = lerpColor(lerp_from, lerp_to, norm(time - time_set, 0, 25));
    } else {
      col = grey_colors[this.i];
    }
    //col._array[3] = .8; //opacity
    noStroke();
    fill(col);
    ellipse(this.pos.x, this.pos.y, 2*this.size, 2*this.size);
  }
}

function MovingParticle(init_x, init_y, _i){
	var pos, vel, acc;
	var init_coord;
	var i; //assign to n-th letter in string
	var size;
	var max_vel;
	var lifespan;
	var lifetime;
	var opacity;

	this.init_coord = createVector(init_x, init_y);
	this.pos = createVector(init_x, init_y);
	this.vel = createVector(random(-2, 2), random(-6, 2));
	this.acc = createVector(0, 0);
	this.i = _i;

	this.size = random(2, 3);
	this.max_vel = 10/this.size;
	//this.lifespan = random(80, 200);
	this.lifespan = random(150, 160);
	this.lifetime = 0;
	this.opacity = 255;

  this.applyForce = function(force){
    this.acc.add(force);
  }

  this.update = function(){
    if(this.opacity <= 2){ //malá hodnota, 0 nefuguje dobře kvůli kroku
        this.pos = this.init_coord.copy();
        this.vel = createVector(random(-2, 2), random(-6, 2));
        this.acc = createVector(0, 0);
        this.lifetime = 0;
        this.opacity = 1;
    }
    this.vel.add(this.acc).limit(this.max_vel);
    this.acc.mult(0);
    this.pos.add(this.vel);
    this.borders();
    this.lifetime++;
    this.opacity = map(cos(this.lifetime*Math.PI/this.lifespan), -1, 1, 0, 150); //zde se mění požadovaná opacity
  }

  this.display = function(){
    var lerp_to = (!hover) ? main_colors[this.i] : grey_colors[this.i];
    var lerp_from = (hover) ? main_colors[this.i] : grey_colors[this.i];
    var col;
    if (time_set != 0) {
      //col = lerpColorM(main_colors[this.i]._array[0]*100, lerp_from, lerp_to, norm(time - time_set, 0, 25));
      col = lerpColor(lerp_from, lerp_to, norm(time - time_set, 0, 25));
    } else {
      col = main_colors[this.i];
    }
    col._array[3] = norm(this.opacity, 0, 255);
    noStroke();
    fill(col);
    ellipse(this.pos.x, this.pos.y, 2*this.size, 2*this.size);
  }

  this.borders = function(){
    if (this.pos.x < 0) {
      this.pos.x += width;
    } else if (this.pos.x > width) {
      this.pos.x -= width;
    }

    if (this.pos.y < 0) {
      this.pos.y += height;
    } else if (this.pos.y > height) {
      this.pos.y -= height;
    }
  }
}