jQuery(document).ready(function() {
  

   $('#carouselHacked').carousel();
  
	//this code is for the gmap
	 var map = new GMaps({
        el: '#map',
        lat: 28.603809,
        lng: 77.353677
      });


      //this code is for smooth scroll and nav selector
            $(document).ready(function () {
              $(document).on("scroll", onScroll);
              
              //smoothscroll
              $('a[href^="#"]').on('click', function (e) {
                  e.preventDefault();
                  $(document).off("scroll");
                  
                  $('a').each(function () {
                      $(this).removeClass('active');
                  })
                  $(this).addClass('active');
                
                  var target = this.hash,
                      menu = target;
                  $target = $(target);
                  $('html, body').stop().animate({
                      'scrollTop': $target.offset().top+2
                  }, 500, 'swing', function () {
                      window.location.hash = target;
                      $(document).on("scroll", onScroll);
                  });
              });
          });

          function onScroll(event){
              var scrollPos = $(document).scrollTop();
              $('.navbar-default .navbar-nav>li>a').each(function () {
                  var currLink = $(this);
                  var refElement = $(currLink.attr("href"));
                  if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                      $('.navbar-default .navbar-nav>li>a').removeClass("active");
                      currLink.addClass("active");
                  }
                  else{
                      currLink.removeClass("active");
                  }
              });
          }
     
     
     //this code is for animation nav
     jQuery(window).scroll(function() {
        var windowScrollPosTop = jQuery(window).scrollTop();

        if(windowScrollPosTop >= 150) {
          jQuery(".header").css({"background": "#B193DD",});
          jQuery(".top-header img.logo").css({"margin-top": "0px", "margin-bottom": "0"});
          jQuery(".top-header img.logo").css({"height": "45px", "width": "192px", "transition":"all .5s ease 0s", "-webkit-transition":"all .5s ease 0s", "-moz-transition":"all .5s ease 0s", "-o-transition":"all .5s ease 0s", "-ms-transition":"all .5s ease 0s" });
          jQuery(".navbar-default").css({"margin-top": "0px",});
        }
        else{
          jQuery(".header").css({"background": "transparent",});
           jQuery(".top-header img.logo").css({"margin-top": "0px", "margin-bottom": "5px"});
          jQuery(".top-header img.logo").css({"height": "60px", "width": "256px", "transition":"all .5s ease 0s", "-webkit-transition":"all .5s ease 0s", "-moz-transition":"all .5s ease 0s", "-o-transition":"all .5s ease 0s", "-ms-transition":"all .5s ease 0s" });
           jQuery(".navbar-default").css({"margin-top": "12px", "margin-bottom": "0"});
          
        }
     });

      
     

});


/*-----------------------------------------------------
   Scroll Top
  -------------------------------------------------------*/

jQuery(document).ready(function(){
	jQuery("#scroll-up").hide();
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 300) {
				jQuery('#scroll-up').fadeIn();
			} else {
				jQuery('#scroll-up').fadeOut();
			}
		});
		jQuery('a#scroll-up').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
});







