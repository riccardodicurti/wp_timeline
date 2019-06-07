$j = jQuery;



  $j(window).load(function(){

    $j(".slider").mCustomScrollbar({
      horizontalScroll: true,
      scrollInertia: 2000,
      theme:"dark",
      documentTouchScroll: true,
      contentTouchScroll: 25,

      advanced: {
        autoExpandHorizontalScroll: true
      },

      keyboard: {
        enable: true,
        scrollAmount: 25
      },

      scrollButtons: {
        enable:true
      }
    });

    $j(".menu a").click(function(){

      var myid= $j(this).attr("href");

      $j(".menu a").removeClass('selected');
      $j(this).addClass('selected');

      $j(".slider").mCustomScrollbar("scrollTo","" + myid + "");

    });

  });

  $j(document).ready(function(){

    //When btn is clicked
    $j(".btn-responsive-menu").click(function() {
      $j(".menu").toggleClass("show");
    });

  });
