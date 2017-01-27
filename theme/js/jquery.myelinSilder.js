/*
 *  MyelinSlider v0.8
 *  Mokgoon 2014.04.25
 *  Update 2016.03.08
 *  mokgoon@gmail.com
 *  http://www.mokgoon.com
 *
 */

(function($){
	
	/*
	 *  Type 
	 *  content
	 *  slideshow
	 * 
	 */
	

	$.fn.myelinSlider = function(obj){
		var firstOnBoolean,
			autoSlider,
			defaults,
			add,
			con,
			slideImg,		// 슬라이드 이미지 객체
			slideImgLen,	// 슬라이드 이미지 갯수
			slideHtm,		// 슬라이드 텍스트 태그
			slideA,
			cnt = 1;
			

		slideImg = $(this).find('img');
		slideA= $(this).find('a');
		slideImgLen = $(this).find('li').length;

		if(obj.type === 'content'){
			console.log('content');
	        // content style 
			slideHtml = '<ul class="content-txt"></ul>';
			$(this).append(slideHtml);
	
			function contentCreateLi(){
				
				var slideLi = '<li></li>';
	
				for(var i = 0; i < slideImgLen; i++){							
					var aL = creadteAlink($(slideImg)[i].alt, slideA[i].id);
					$('.content-txt').append(slideLi);
					$('.content-txt li').eq(i).append(aL);
					cnt++;
				}
			}
			contentCreateLi();
		}


		if(obj.type === 'slideshow'){
			console.log('slideshow');
			// slide show style
			slideHtml = '<div class="slide_tab"><ul class="slideshow-txt"></ul></div>';
			$(this).append(slideHtml);
	
			function slideshowCreateLi(){
				var slideLi = '<li></li>';
	
				for(var i = 0; i < slideImgLen; i++){
					
					console.log(slideA[i].id);
												
					var aL = creadteAlink($(slideImg)[i].alt, slideA[i].id);
					$('.slideshow-txt').append(slideLi);
					$('.slideshow-txt li').eq(i).append(aL);
					cnt++;
				}
			}
			slideshowCreateLi();
		}
		
		
		function creadteAlink(t, _id){
			var aLink = '<a href="#none" class="'+_id+'">'+t+'</a>';
			return aLink;
		}

		

		function f() {
			var args = [].slice.call( arguments, 1, 3);
			return args;
		}

		// console.error
		function errorFunction(msg){
			console.error(msg);
		}

		// 기본 정의
		defaults = {
			mode : 'fade',
			item : 5,
			direction : 'down',
			auto : false,
			speed : 3000
		};

		add = {
			type : obj.type,
			direction : obj.direction,
			auto : obj.auto,
			speed : obj.speed,
			dataImg : this.children().eq(0).children(),
			dataTxt : this.children().eq(1).children(),
			dataImgLen : this.children().eq(0).children().length,
			item : this.children().eq(1).children().length,
			targetImg : this.children().eq(0).children().children(),
			targetTxt : this.children().eq(1).children().children()
		};
		
		if(obj.type === 'slideshow'){
			add.item = this.children().eq(1).children().eq(0).children().length;
			console.log(add.item);
			add.dataTxt = this.children().eq(1).children().eq(0).children();
		}
		
		if(obj.type === 'content'){
			add.item = this.children().eq(0).children().length;
			add.dataTxt = this.children().eq(1).children();
		}
		
		con = $.extend(defaults, add);

		// 슬라이드 이미지와, 텍스트의 갯수가 일치 하지않을때, 경고 창알림
		if(con.dataImgLen !== con.item){
			errorFunction('배너이미지와 텍스트의 개수가 일치하지 않습니다.');
		}
		
		
		// 텍스트 첫번째에 on 클래스가 있는지 확인
		if(obj.type === 'slideshow'){
			firstOnBoolean = $(con.dataTxt).children().eq(0).hasClass('on');
		}
		
		if(obj.type === 'content'){
			firstOnBoolean = $(con.dataTxt).eq(0).hasClass('on');
		}
		
		// 없으면 추가해준다.
		if(!firstOnBoolean){
				$(con.dataTxt).eq(0).addClass('on');
		}

		// 텍스트에 hover 이벤트가 발생시 실행
		$(con.dataImg).hover(
			function() {
				con.auto = false;
				clearInterval(autoSlider);
			}, function(){
				autoSlider = setInterval(mgSlider,con.speed);
			}
		);
		
		$(con.dataTxt).hover(
			function() {
				
				con.auto = false;
				clearInterval(autoSlider);

				if($(con.dataTxt).hasClass('on')){$(con.dataTxt).removeClass('on');}
				$(this).addClass('on');
				var tagetNm = $(this).children()[0].className; 

				for(var i = 0; i < con.dataImgLen; i++){
					if(tagetNm == con.targetImg[i].id){
						$('#'+con.targetImg[i].id).show();
					}else{
						$('#'+con.targetImg[i].id).hide();
					}
				}
			}, function(){
				autoSlider = setInterval(mgSlider,con.speed);
			}
		);

		// auto 가 true일때
		
		if(con.auto){
			autoSlider = setInterval(mgSlider,con.speed);
		}

		function mgSlider(){
			for(var k = 0; k < con.item; k++){
				
				if(con.dataTxt.eq(k).hasClass('on')){
					con.dataTxt.eq(k).removeClass('on');
					$('#'+con.targetImg[k].id).hide();
					k++
					if(!con.dataTxt.eq(k).hasClass('on')){
						con.dataTxt.eq(k).addClass('on');
						if(k == con.item){
							$(con.dataTxt).eq(0).addClass('on');
							$('#'+con.targetImg[0].id).show();
						}else{
							$('#'+con.targetImg[k].id).show();
						}
					}
				}
				
			}
			
			
		}
/*

		function getScreenHeight(){
			var eleHeight = $('.banner').css('height');
			$('.banner-img > li > a > img').css('height',eleHeight);
		}

		getScreenHeight();*/


	}

})(jQuery);