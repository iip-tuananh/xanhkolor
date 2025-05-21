$(document).ready(function(){
	$(".product-action .thumbs-list .thumbs-list-item img").hover(function () {
		var t = $(this).attr("data-img");
		$(this).parent().siblings().removeClass("active"), $(this).parent().addClass("active");
		var e = $(this).parents(".product-action").find(".product-thumbnail .image_thumb img");
		e && $(e).attr("src", t);
	});
});
$(".not-dqtab").each( function(e){
	var $this1 = $(this);
	var datasection = $this1.closest('.not-dqtab').attr('data-section');
	$this1.find('.tabs-title li:first-child').addClass('current');
	var view = $this1.closest('.not-dqtab').attr('data-view');
	$this1.find('.tab-content').first().addClass('current');
	var droptab = $(this).find('.tab-desktop');
	$this1.find('.tabs-title.ajax li').click(function(){
		var $this2 = $(this),
			tab_id = $this2.attr('data-tab'),
			url = $this2.attr('data-url');
		var etabs = $this2.closest('.e-tabs');
		etabs.find('.tab-viewall').attr('href',url);
		etabs.find('.tabs-title li').removeClass('current');
		etabs.find('.tab-content').removeClass('current');
		$this2.addClass('current');
		etabs.find("."+tab_id).addClass('current');
		if(!$this2.hasClass('has-content')){
			$this2.addClass('has-content');		
			getContentTab(url,"."+ datasection+" ."+tab_id,view);
		}
	});
});
$('.not-dqtab .next').click(function(e){
	var count = 0
	$(this).parents('.content').find('.tab-content').each(function(e){
		count +=1;
	})
	var str = $(this).parent().find('.tab-titlexs').attr('data-tab'),
		res = str.replace("tab-", ""),
		datasection = $(this).closest('.not-dqtab').attr('data-section');
	res = Number(res);
	if(res < count){
		var current = res + 1;
	}else{
		var current = 1;
	}
	action(current,datasection);
})
$('.not-dqtab .prev').click(function(e){
	var count = 0
	$(this).parents('.content').find('.tab-content').each(function(e){
		count +=1;
	})
	var str = $(this).parent().find('.tab-titlexs').attr('data-tab'),
		res = str.replace("tab-", ""),
		datasection = $(this).closest('.not-dqtab').attr('data-section'),
		res = Number(res);	
	if(res > 1){
		var current = res - 1;
	}else{
		var current = count;
	}
	action(current,datasection);
})
function action(current,datasection,view){
	$('.'+datasection+' .tab-titlexs').attr('data-tab','tab-'+current);
	var text = '',
		url = '',
		tab_id='';
	$('.'+datasection+' ul.tabs.tabs-title.hidden-xs li').each(function(e){
		if($(this).attr('data-tab') == 'tab-'+current){
			var $this3 = $(this);
			title = $this3.find('span').text();
			url = $this3.attr('data-url');
			tab_id = $this3.attr('data-tab');
			if(!$this3.hasClass('has-content')){
				$this3.addClass('has-content');	
				getContentTab(url,"."+ datasection+" ."+tab_id,view);				
			}
		}
	})
	$("."+ datasection+" .tab-titlexs span").text(title);
	$("."+ datasection+" .tab-content").removeClass('current');
	$("."+ datasection+" .tab-"+current).addClass('current');
}
// Get content cho tab
function getContentTab(url,selector){
	url = url+"?view=ajaxload4";
	var loading = '<div class="text-center">Đang tải dữ liệu...</div>';
	var fill = $(selector);
	$.ajax({
		type: 'GET',
		url: url,
		beforeSend: function() {
			fill.find('.contentfill').html(loading);
		},
		success: function(data) {

			var content = $(data);
			setTimeout(function(){
				fill.find('.contentfill').html(content.html());
				awe_lazyloadImage();
				$(selector+' .add_to_cart').click(function(e){	
					e.preventDefault();		
					var $this = $(this);
					var form = $this.parents('form');	
					$.ajax({
						type: 'POST',
						url: '/cart/add.js',
						async: false,
						data: form.serialize(),
						dataType: 'json',
						beforeSend: function() { },
						success: function(line_item) {
							$('.cart-popup-name').html(line_item.title).attr('href', line_item.url, 'title', line_item.title);
							ajaxCart.load();
							$('#popup-cart-desktop, .cart-sidebar, .backdrop__body-backdrop___1rvky').addClass('active');
						},
						cache: false
					});
				});
				var modal = $('.quickview-product');
				var btn = $('.quick-view');
				var span = $('.quickview-close');

				btn.click(function () {
					modal.show();
				});

				span.click(function () {
					modal.hide();
				});

				$(window).on('click', function (e) {
					if ($(e.target).is('.modal')) {
						modal.hide();
					}
				});
			},300);

		},
		dataType: "html"
	});
}
var swiperReview = new Swiper('.swiper-cus-review', {
	slidesPerView: 2,
	loop: false,
	grabCursor: true,
	spaceBetween: 30,
	roundLengths: true,
	slideToClickedSlide: false,
	autoplay: {
		delay: 4000,
	},
	navigation: {
		nextEl: '.swiper-cus-review .swiper-button-next',
		prevEl: '.swiper-cus-review .swiper-button-prev',
	},
	pagination: {
		el: '.swiper-cus-review .swiper-pagination',
		clickable: true,
	},
	breakpoints: {
		300: {
			slidesPerView: 1,
			spaceBetween: 0
		},
		500: {
			slidesPerView: 1,
			spaceBetween: 0
		},
		640: {
			slidesPerView: 2,
			spaceBetween: 30
		},
		768: {
			slidesPerView: 2,
			spaceBetween: 30
		},
		992: {
			slidesPerView:2,
			spaceBetween: 30
		},
		1200: {
			slidesPerView:2,
			spaceBetween: 30
		}
	}
});
var swiperBlog = new Swiper('.swiper-blog', {
	slidesPerView: 3,
	loop: false,
	grabCursor: true,
	spaceBetween: 30,
	roundLengths: true,
	slideToClickedSlide: false,
	navigation: {
		nextEl: '.swiper-blog .swiper-button-next',
		prevEl: '.swiper-blog .swiper-button-prev',
	},
	pagination: {
		el: '.swiper-blog .swiper-pagination',
		clickable: true,
	},
	autoplay: {
		delay: 4000,
	},
	breakpoints: {
		300: {
			slidesPerView: 1,
			spaceBetween: 30
		},
		500: {
			slidesPerView: 1,
			spaceBetween: 30
		},
		640: {
			slidesPerView: 2,
			spaceBetween: 30
		},
		768: {
			slidesPerView: 2,
			spaceBetween: 30
		},
		992: {
			slidesPerView:3,
			spaceBetween: 30
		},
		1200: {
			slidesPerView:3,
			spaceBetween: 30
		}
	}
});
var swiperBrand = new Swiper('.swiper-brand', {
	slidesPerView: 6,
	loop: false,
	grabCursor: true,
	spaceBetween: 30,
	roundLengths: true,
	slideToClickedSlide: false,
	navigation: {
		nextEl: '.swiper-brand .swiper-button-next',
		prevEl: '.swiper-brand .swiper-button-prev',
	},
	pagination: {
		el: '.swiper-brand .swiper-pagination',
		clickable: true,
	},
	autoplay: false,
	breakpoints: {
		300: {
			slidesPerView: 2,
			spaceBetween: 10
		},
		500: {
			slidesPerView: 2,
			spaceBetween: 10
		},
		640: {
			slidesPerView: 5,
			spaceBetween: 10
		},
		768: {
			slidesPerView: 5,
			spaceBetween: 10
		},
		992: {
			slidesPerView:6,
			spaceBetween: 30
		},
		1200: {
			slidesPerView:6,
			spaceBetween: 30
		}
	}
});
var swiperTeam = new Swiper('.swiper-team', {
	slidesPerView: 4,
	loop: false,
	grabCursor: true,
	spaceBetween: 30,
	navigation: {
		nextEl: '.swiper-team .swiper-button-next',
		prevEl: '.swiper-team .swiper-button-prev',
	},
	pagination: {
		el: '.swiper-team .swiper-pagination',
		clickable: true,
	},
	autoplay: {
		delay: 4000,
	},
	breakpoints: {
		300: {
			slidesPerView: 1,
			spaceBetween: 30
		},
		500: {
			slidesPerView: 1,
			spaceBetween: 30
		},
		640: {
			slidesPerView: 3,
			spaceBetween: 30
		},
		768: {
			slidesPerView: 3,
			spaceBetween: 30
		},
		992: {
			slidesPerView:4,
			spaceBetween: 30
		},
		1200: {
			slidesPerView:4,
			spaceBetween: 30
		}
	}
});
var swiperCustomer = new Swiper('.swiper-customer', {
	slidesPerView: 4,
	loop: false,
	grabCursor: true,
	spaceBetween: 30,
	navigation: {
		nextEl: '.swiper-customer .swiper-button-next',
		prevEl: '.swiper-customer .swiper-button-prev',
	},
	pagination: {
		el: '.swiper-customer .swiper-pagination',
		clickable: true,
	},
	autoplay: false,
	breakpoints: {
		300: {
			slidesPerView: 1,
			spaceBetween: 30
		},
		500: {
			slidesPerView: 1,
			spaceBetween: 30
		},
		640: {
			slidesPerView: 2,
			spaceBetween: 20
		},
		768: {
			slidesPerView: 2,
			spaceBetween: 20
		},
		992: {
			slidesPerView:2,
			spaceBetween: 20
		},
		1200: {
			slidesPerView:2,
			spaceBetween: 20
		}
	}
});

if ($(window).width() < 767) {
	$(document).on('click', '.section_service .item .inner', function () {
		if ($(this).hasClass('current')) {
			$(this).removeClass('current');
		} else {
			$('.section_service .item .inner').removeClass('current');
			$(this).addClass('current');
		}

	})
}