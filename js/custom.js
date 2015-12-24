/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {


//  Newsletter popup cookie
// ________________________________________	
if($("#homepage-flag").length > 0) {
	if (document.cookie.indexOf('visited=true') == -1) {
		var fifteenDays = 1000*60*60*24*15;
		var expires = new Date((new Date()).valueOf() + fifteenDays);
		document.cookie = "visited=true;expires=" + expires.toUTCString();
		
			$('.newsletter').animate({ "max-width": "80%" }, 'fast');
	}
}
//  Close the modal
// ________________________________________	
$('.close').click(function() {
	$(this).parent('.newsletter').animate({ "max-width": "0" }, 'fast');
});
$('.nothanks').click(function() {
	$(this).parent('.newsletter').animate({ "max-width": "0" }, 'fast');
});

 /*if (document.cookie.indexOf('visited=true') == -1) {
	var fifteenDays = 1000*60*60*24*15;
	var expires = new Date((new Date()).valueOf() + fifteenDays);
	document.cookie = "visited=true;expires=" + expires.toUTCString();
	$.colorbox({width:"60%", inline:true, href:"#mc_embed_signup"});
}*/
	
// 		Newsletter Signup
// ________________________________________
/*$(".newsletter").colorbox({
	inline:true, width:"60%",
	className:'newsletter'
 });*/

/*
		Sticky Nav
__________________________________________
*/	
	var  mn = $(".head-contents");
    mns = "head-contents-scrolled";
    hdr = $('.head-contents').height();

	$(window).scroll(function() {
	  if( $(this).scrollTop() > hdr ) {
		mn.addClass(mns);
		//mns.animate({"opacity":"1"}, 1000);
	  } else {
		//mn.removeClass(mns);
		mn.removeClass(mns);
		//mns.animate({"opacity":"0"}, 1000);
	  }
	});	
		
		// Make active current page
	$("[href]").each(function() {
    if (this.href == window.location.href) {
        $(this).addClass("active");
        }
	});
	
	
	// Flexslider
	// front page slider 
/*	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider*/
	
	// Colorbox
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
	//Isotope with images loaded ...
	var $container = $('#container').imagesLoaded( function() {
  	$container.isotope({
    // options
	 itemSelector: '.item',
		  masonry: {
			gutter: 15
			}
 		 });
	});
	
	
	// Equal heights divs
	$('.blocks').matchHeight();
	/*var byRow = $('body').hasClass('test-rows');
		$('.blocks-container').each(function() {
		 $(this).children('.blocks').matchHeight({
			   byRow: byRow
		//property: 'min-height'
		});
	});*/
	
	

	(function() {

      // store the slider in a local variable
      var $window = $(window),
          flexslider;

      // tiny helper function to add breakpoints
      function getGridSize() {
        return (window.innerWidth < 600) ? 1 :
               (window.innerWidth < 900) ? 3 : 4;
      }

      $(function() {
        SyntaxHighlighter.all();
      });

      $window.load(function() {
        $('.flexslider').flexslider({
          animation: "slide",
		   controlNav:false,
          animationSpeed: 400,
          animationLoop: false,
          itemWidth: 230,
          itemMargin: 5,
          minItems: getGridSize(), // use function to pull in initial value
          maxItems: getGridSize(), // use function to pull in initial value
          start: function(slider){
            $('body').removeClass('loading');
            flexslider = slider;
          }
        });
      });

      // check grid size on resize event
      $window.resize(function() {
        var gridSize = getGridSize();

        flexslider.vars.minItems = gridSize;
        flexslider.vars.maxItems = gridSize;
      });
    }());


});// END #####################################    END Document Ready

