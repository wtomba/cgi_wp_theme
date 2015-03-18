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

      jQuery(".category-menu-toggle").click(function () {
        var menu = jQuery(".category-nav");
        menu.slideToggle();
      });

      jQuery(document).scroll(function() {
        if (jQuery(this).scrollTop() > 100) {
          jQuery('.main-nav').css('position','fixed');
          jQuery('.main-nav').css('top','0');
          jQuery('.main-nav').css('width','100%');
          jQuery('.main-nav').css('box-shadow','0px 0px 10px #000');
        } 
        else {
          jQuery('.main-nav').css('position','static');
          jQuery('.main-nav').css('box-shadow','none');
        }
      });
    </script>
    <?php wp_footer(); ?>
  </body>
</html>
