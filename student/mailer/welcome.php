<?php
include'../../config.php';
require_once'../session.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="jQuery Responsive Carousel - Owl Carusel">
    <meta name="author" content="Bartosz Wojciechowski">
    <meta name="keywords" content="HTML,CSS,JSON,JavaScript, jQuery, Responsive, Design, Owl, Carousel, Free">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="../dist/css/assets/css/bootstrapTheme.css" rel="stylesheet">
    <link href="../dist/css/assets/css/custom.css" rel="stylesheet">

    <!-- Owl Carousel Assets -->
    <link href="../plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="../plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="../icon/ionicon/css/ionicons.min.css" rel="stylesheet"/>

    <!-- Prettify -->
    <link href="../dist/css/assets/js/google-code-prettify/prettify.css" rel="stylesheet">

    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">
      
<style>
    .ion{font-size:100px}  
</style>
  </head>
  <body style="background:#ecf0f5 !important">

      

      <div id="demo">
        <div class="container">
          <div class="row">
            <div class="span12">
                <img src="../header.png">
              </div>
          </div>

          <div class="row" style='padding-top:100px'>
            <div class="span12">

              <div id="owl-example" class="owl-carousel">

                <div class="item darkCyan">
                 <i class="ion ion-email"></i>
                    <h3>Mailer</h3>
                    <h4></h4>
                </div>
                  <div class="item forestGreen">
                   <i class="ion ion-clipboard"></i>
                    <h3>Test</h3>
                    <h4></h4>
                </div>
                  <div class="item orange">
                   <i class="ion ion-ios-book-outline"></i>
                    <h3>Tutorial</h3>
                    <h4></h4>
                </div>
                <div class="item yellow">
                   <i class="ion ion-briefcase"></i>
                    <h3>Placement</h3>
                    <h4></h4>
                </div>
                <div class="item dodgerBlue">
                   <i class="ion ion-edit"></i>
                    <h3>Feedback</h3>
                    <h4></h4>
                </div>

                <div class="item skyBlue">
                   <i class="ion ion-gear-b"></i>
                    <h3>Settings</h3>
                    <h4></h4>
                </div>

                <div class="item zombieGreen">
                   <i class="ion ion-log-out"></i>
                    <h3>Logout</h3>
                    <h4></h4>
                </div>

                

                

                

                

                

              </div>


            </div>
          </div>

        </div>
      </div>
      <script>
            var owldomain = window.location.hostname.indexOf("owlgraphic");
            if(owldomain !== -1){
              !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
            }
            </script>
      <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../plugins/owl-carousel/owl.carousel.min.js"></script>
      <script>

    $(document).ready(function($) {
      $("#owl-example").owlCarousel();
    });


    $("body").data("page", "frontpage");

    </script>
      
      <script src="../dist/css/assets/js/bootstrap-collapse.js"></script>
    <script src="../dist/css/assets/js/bootstrap-transition.js"></script>

    <script src="../dist/css/assets/js/google-code-prettify/prettify.js"></script>
	  <script src="../dist/css/assets/js/application.js"></script>

    <script type="text/javascript">
    jQuery(function($){
      var disqus_loaded = false;
      var top = $("#faq").offset().top; 
      var owldomain = window.location.hostname.indexOf("owlgraphic");
      var comments = window.location.href.indexOf("comment");

      if(owldomain !== -1){
        function check(){
          if ( (!disqus_loaded && $(window).scrollTop() + $(window).height() > top) || (comments !== -1) ){
            $(window).off( "scroll" )
            disqus_loaded = true;
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'owlcarousel'; // required: replace example with your forum shortname
            var disqus_identifier = 'OWL Carousel';
            //var disqus_url = 'http://owlgraphic.com/owlcarousel/';
            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
          }
        }
        $(window).on( "scroll", check )
        check();
      } else {
        $('.disqus').hide();
      }
    });
    </script>

   

      </html>