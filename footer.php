      </div>
      <footer class="site-footer">
        <p><?php bloginfo('name'); ?> - &copy; <?php echo date('Y'); ?></p>
      </footer>
    </div>
    <script type="text/javascript">
      jQuery.noConflict();
      jQuery(document).foundation();

      jQuery(".menu-toggle").click(function () {
        var menu = jQuery(".main-nav nav ul");        
        menu.slideToggle();
      });

      jQuery(".search-toggle").click(function () {
        var searchContainer = jQuery(".search-container");
        searchContainer.slideToggle();
      });

      jQuery(".category-menu-toggle").click(function () {
        var menu = jQuery(".category-nav");
        menu.slideToggle();
      });

      jQuery(document).scroll(function() {
        var menuTop = jQuery('.site-header').offset().top + (jQuery('.site-header').height() - jQuery('.main-nav').height());
        if (jQuery(this).scrollTop() > menuTop) {
          jQuery('.main-nav').css('position','fixed');
          jQuery('.main-nav').css('top','0');
          jQuery('.main-nav').css('width','100%');
          jQuery('.form-container').css('position','fixed');
          jQuery('.form-container').css('top','58px');
          jQuery('.form-container').css('left','0');
          jQuery('.form-container').css('right','0');
          jQuery('.form-container').css('background-color', '#FFF');
          if (jQuery('.menu-toggle').is(':visible') && !jQuery('.search-container').is(':visible')) {
            jQuery('.main-nav').css('box-shadow','0px 0px 10px #000');
          } else {
            jQuery('.form-container').css('box-shadow','0px 0px 10px #000');
          }
        } 
        else {
          jQuery('.main-nav').css('position','static');
          jQuery('.form-container').css('position','relative');
          jQuery('.form-container').css('background-color', 'transparent');
          
          if (jQuery('.menu-toggle').is(':visible') && !jQuery('.search-container').is(':visible')) { 
            jQuery('.main-nav').css('box-shadow','none');
          } else {
            jQuery('.form-container').css('box-shadow','none');
          }
        }
      });

      jQuery(".category-nav ul li:has(.current-cat-parent)").find("ul").show();

    </script>
    <?php wp_footer(); ?>
  </body>
</html>
