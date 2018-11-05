var o = {
	init: function(){
		this.diagram();
	},
	random: function(l, u){
		return Math.floor((Math.random()*(u-l+1))+l);
	},
	diagram: function(){
		$arr=$('.diagram2');
		
		var r=new Array();
		for (var pp=0;pp<$arr.length;pp++)
{
	
		 r[pp] = Raphael($arr.get(pp), 180, 180),
			rad = 25,
		
			defaultText = $($arr.get(pp)).attr('attr')+'%',
			speed = 50;
		
		r[pp].circle(80, 80, 45).attr({ stroke: 'none', fill: '#193340' });

		var title = r[pp].text(80, 80, defaultText).attr({
			font: '20px Arial',
			fill: '#fff'
		}).toFront();
		
		r[pp].customAttributes.arc = function(value, color, rad){
			var v = 3.6*value,
				alpha = v == 360 ? 359.99 : v,
				random = o.random(91, 240),
				a = (random-alpha) * Math.PI/180,
				b = random * Math.PI/180,
				sx = 80 + rad * Math.cos(b),
				sy = 80 - rad * Math.sin(b),
				x = 80 + rad * Math.cos(a),
				y = 80 - rad * Math.sin(a),
				path = [['M', sx, sy], ['A', rad, rad, 0, +(alpha > 180), 1, x, y]];
			return { path: path, stroke: color }
		}
		
	/*	$('.get2').find('.arc2').each(function(i){*
	var t = $(this), */
			 var t = $($arr.get(pp)).parent().next().find('.arc2'), 
			
				color = t.find('.color2').val(),
				value = $($arr.get(pp)).attr('attr'),
				text = t.find('.text2').text();
			
			rad += 35;	
			var z = r[pp].path().attr({ arc: [value, color, rad], 'stroke-width': 20 });
			
			z.mouseover(function(){
                this.animate({ 'stroke-width': 30, opacity: .75 }, 1000, 'elastic');
                if(Raphael.type != 'VML') //solves IE problem
				this.toFront();
				title.stop().animate({ opacity: 0 }, speed, '>', function(){
					this.attr({ text: text + '\n' + value + '%' }).animate({ opacity: 1 }, speed, '<');
				});
            }).mouseout(function(){
				this.stop().animate({ 'stroke-width': 26, opacity: 1 }, speed*4, 'elastic');
				title.stop().animate({ opacity: 0 }, speed, '>', function(){
					title.attr({ text: defaultText }).animate({ opacity: 1 }, speed, '<');
				});	
            });
		/*});*/
		}
	}
}


var ot = {
	init: function(){
		this.diagram();
	},
	random: function(l, u){
		return Math.floor((Math.random()*(u-l+1))+l);
	},
	diagram: function(){
		$arr=$('.diagram');
	 var r=new Array();
		for (var pp=0;pp<$arr.length;pp++)
{


		 r[pp] = Raphael($arr.get(pp), 180, 180),
			rad = 25,
			defaultText = $($arr.get(pp)).attr('attr')+'%',
			speed = 250;
		
		r[pp].circle(80, 80, 45).attr({ stroke: 'none', fill: '#193340' });
		
		var title = r[pp].text(80, 80, defaultText).attr({
			font: '20px Arial',
			fill: '#fff'
		}).toFront();
		
		r[pp].customAttributes.arc = function(value, color, rad){
			var v = 3.6*value,
				alpha = v == 360 ? 359.99 : v,
				random = o.random(91, 240),
				a = (random-alpha) * Math.PI/180,
				b = random * Math.PI/180,
				sx = 80 + rad * Math.cos(b),
				sy = 80 - rad * Math.sin(b),
				x = 80 + rad * Math.cos(a),
				y = 80 - rad * Math.sin(a),
				path = [['M', sx, sy], ['A', rad, rad, 0, +(alpha > 180), 1, x, y]];
			return { path: path, stroke: color }
		}
		
		/*$('.get').find('.arc').each(function(i){*/
		
			
		
			 var t = $($arr.get(pp)).parent().next().find('.arc'), 
				color = t.find('.color').val(),
				value = $($arr.get(pp)).attr('attr'),
				text = t.find('.text').text();
			
			rad += 35;	
			
			var z = r[pp].path().attr({ arc: [value, color, rad], 'stroke-width': 20 });
			
			z.mouseover(function(){
                this.animate({ 'stroke-width': 30, opacity: .75 }, 1000, 'elastic');
                if(Raphael.type != 'VML') //solves IE problem
				this.toFront();
				title.stop().animate({ opacity: 0 }, speed, '>', function(){
					this.attr({ text: text + '\n' + value + '%' }).animate({ opacity: 1 }, speed, '<');
				});
            }).mouseout(function(){
				this.stop().animate({ 'stroke-width': 26, opacity: 1 }, speed*4, 'elastic');
				title.stop().animate({ opacity: 0 }, speed, '>', function(){
					title.attr({ text: defaultText }).animate({ opacity: 1 }, speed, '<');
				});	
            });
		/*});*/
		}
	}
}


