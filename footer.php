      </div>
      <footer class="site-footer">
        <p><?php bloginfo('name'); ?> - &copy; <?php echo date('Y'); ?></p>
      </footer>
    </div>
    <script type="text/javascript">
      jQuery(function ($){
        $.noConflict();
        $(document).foundation();

        $(".menu-toggle").click(function () {
          var menu = $(".main-nav nav ul");        
          menu.slideToggle();
        });

        $(".search-toggle").click(function () {
          var searchContainer = $(".search-container");
          searchContainer.slideToggle();
        });

        $(".category-menu-toggle").click(function () {
          var menu = $(".category-nav");
          menu.slideToggle();
        });

        <?php if (!is_page("startpage")) { ?>
          $(document).scroll(function() {
            var menuTop = $('.site-header').offset().top + ($('.site-header').height() - $('.main-nav').height());
            if ($(this).scrollTop() > menuTop) {
              $('.main-nav').css('position','fixed');
              $('.main-nav').css('top','0');
              $('.main-nav').css('width','100%');
              $('.form-container').css('position','fixed');
              $('.form-container').css('top','58px');
              $('.form-container').css('left','0');
              $('.form-container').css('right','0');
              $('.form-container').css('background-color', '#FFF');
              if ($('.menu-toggle').is(':visible') && !$('.search-container').is(':visible')) {
                $('.main-nav').css('box-shadow','0px 0px 10px #000');
              } else {
                $('.form-container').css('box-shadow','0px 0px 10px #000');
              }
            } 
            else {
              $('.main-nav').css('position','static');
              $('.form-container').css('position','relative');
              $('.form-container').css('top','2.5rem');
              $('.form-container').css('background-color', 'transparent');
              
              if ($('.menu-toggle').is(':visible') && !$('.search-container').is(':visible')) { 
                $('.main-nav').css('box-shadow','none');
              } else {
                $('.form-container').css('box-shadow','none');
              }
            }
          });
        <?php } ?>

        $(".category-nav ul li:has(.current-cat-parent)").find("ul").show();

        $(".map iframe").height($(".map iframe").width() * 0.6);

        $('.owl-carousel.arconix-slider').owlCarousel({
          singleItem:         true,
          slideSpeed:         500,
          autoHeight:         false,
          navigation:         true,
          navigationText:     false,
          transitionStyle:    "fade",
        });
      });

    </script>
    <?php wp_footer(); ?>
  </body>
</html>
