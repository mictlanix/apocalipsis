$(document).ready(function() {
    $(".navbar-brand img").addClass('flipInY animated');  


    $(".navbar-brand img").on("mouseenter",(function() {      
      $(this).addClass("flipInY animated");
    }));

    $(".navbar-brand img").live("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",(function() {
      $(this).removeClass("flipInY animated");
    }));


$(window).scroll(function() {
   if($(window).scrollTop() + $(window).height() == $(document).height()) {
       $("#imagenfooter").addClass("flipInY animated");
   }
});

$(window).scroll(function() {
   if($(window).scrollTop() == 0) {
       $(".navbar-brand img").addClass("flipInY animated");
   }
});












    $("#imagenfooter").on("mouseenter",(function() {      
      $(this).addClass("flipInY animated");
    }));
    $("#imagenfooter").live("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",(function() {
      $(this).removeClass("flipInY animated");
    }));


    $("#bs-example-navbar-collapse-1").removeClass('oculto');
    
    

    $(".navbar-nav li").each(function(i){
        var t = $(this);        
        setTimeout(function(){ t.addClass('bounceIn animated'); }, (i+1) * 500);
	  });

    $(".navbar-nav li a").hover(
      function () {
      	
        $(this).addClass('tada animated');
        
      }, 
      function () {
        $(this).removeClass('tada animated');
      }
    );
    $(".ic").hover(
      function () {
        $(this).addClass('pulse animated');

      }, 
      function () {
        $(this).removeClass('pulse animated');
      }
    );
    $(".resp-tabs-list li").hover(
      function () {
        
        $(this).addClass('tada animated');
        
      }, 
      function () {
        $(this).removeClass('tada animated');
      }
    );
    
  

    $(".menu-fot li a").on("mouseenter",(function() {      
      $(this).addClass("flipInY animated");
    }));
    $(".menu-fot li a").live("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",(function() {
      $(this).removeClass("flipInY animated");
    }));

setInterval(function() {
    
    $("#carrito").addClass("jello animated");  
    $("#carrito").live("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",(function() {
      $(this).removeClass("jello animated");
    }));
}, 4000);

    });