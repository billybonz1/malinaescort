(function($) {
	/**
	 * [rating plugin init]
	 */
	$('.rating').rating({
	    min: 0,
	    max: 5,
	    step: 1,
	    size: 'xs',
	    showClear: false,
	    showCaption: false,

	});
	/**==========================================================================================**/
	/*
	 * [fancybox modal box init]
	 */
	$('.fancy-popup').fancybox({
		padding: 0,
		maxWidth: 640,

	});

	$(".fancy-gallery").fancybox({
		openEffect	: 'elastic',
		closeEffect	: 'elastic',
		height: '80vh'
	});
	/**==========================================================================================**/
	/*
	 * [gallery slider slick carousel init]
	 */
	$('.big-slide').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  fade: true,
	  adaptiveHeight: true,
	  asNavFor: '.small-slides',
	  nextArrow: '<button class="slick-nav next-btn"></button>',
	  prevArrow: '<button class="slick-nav prev-btn"></button>',
	});

	$('.small-slides').slick({
	  slidesToShow: 4,
	   adaptiveHeight: true,
	  slidesToScroll: 1,
	  asNavFor: '.big-slide',
	  nextArrow: '<button class="slick-nav next-btn-l"></button>',
	  prevArrow: '<button class="slick-nav prev-btn-l"></button>',
	  focusOnSelect: true
	});

	$('.js-viplist-horizontal').slick({
	  slidesToShow: 6,
	  slidesToScroll: 1,
	  nextArrow: '<button class="slick-nav next-btn-l"></button>',
	  prevArrow: '<button class="slick-nav prev-btn-l"></button>',
	  responsive: [
	    {
	      breakpoint: 1300,
	      settings: {
	        slidesToShow: 5,
	      }
	    },
	    {
	      breakpoint: 1170,
	      settings: {
	        slidesToShow: 4,
	      }
	    },
	    {
	      breakpoint: 992,
	      settings: {
	        slidesToShow: 3,
	      }
	    },
	    {
	      breakpoint: 780,
	      settings: {
	        slidesToShow: 2,
	      }
	    },
	  ]
	});

	$('.js-viplist-vertical').slick({
	  slidesToShow: 8,
	  slidesToScroll: 1,
	  vertical: true,
	  nextArrow: '<button class="slick-nav next-btn-l"></button>',
	  prevArrow: '<button class="slick-nav prev-btn-l"></button>',
	});
	/**==========================================================================================**/

    $(document).on('click', '.collapsed', function(e){
        e.preventDefault();
        var selector = $(this).attr('href');
        var $that = $(this);

        if($(this).attr('aria-expanded') == 'false') {
            $(selector).slideDown(300, function(){
                $that.attr('aria-expanded', 'true');
            });
        } else {
            $(selector).slideUp(300, function() {
                $that.attr('aria-expanded', 'false');
            });
        }
    });
}(jQuery));

// $(window).load(function() {
// 	setEqualHeight( $('.questionnaire-item') );
// 	if ($(window).width() >)
// 	$( window ).resize(function() {
// 		$('.questionnaire-item').css({'height': 'auto'});
// 	  setEqualHeight( $('.questionnaire-item') );
// 	});
// });
/**==================================functions===================================================**/
function setEqualHeight(columns){
 	var tallestcolumn = 0;
  	columns.each(function() {
    	currentHeight = $(this).height();
    	if(currentHeight > tallestcolumn){
    		tallestcolumn = currentHeight;
     	}
  	});
  	columns.height(tallestcolumn);
}



$(function(){
	var l = '';
	if(window.location.href.indexOf("en/") > -1){
         l = '/en';
	} else if(window.location.href.indexOf("tr/") > -1){
		l = '/tr';
	}
	console.log(l);
    $(document).on('click', '#Load_more', function(){
		$('#pagination_limit').attr("value", Number($('#pagination_limit').val())+20);
        $.ajax({
            url: l+'/form/AjaxLoad',
            data: $('#searchForm').serialize(),
            success:function(data){
                $('#JSFormsList').append(data);
            },
            error: function(data) {}
        });
        return false;
    });

});


/*
jQuery(window).scroll(function() {
	element = document.getElementById('Load_more');
	
	if (element) {
		var scroll_picca =jQuery('#Load_more').offset().top; 
		scrollBottom = $(window).scrollTop() + $(window).height();
		
		if (scrollBottom > scroll_picca) {
			$( "#Load_more" ).trigger( "click" );
		}
	}
});
*/
