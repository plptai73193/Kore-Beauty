<?php
  $showRooms = get_field('show_rooms', 'option');
  $social = get_field('social', 'option');
  $ftSocial = get_field('ft_social', 'option');
?>
    </main>
    <footer class="pt-50 pb-30">
      <div class="wraper">
        <div class="flexBox">
          <div class="column">
            <h4 class="fz-18 text-up title_line"> hệ thống showroom</h4>
          </div>
          <div class="column">
            <ul class="social flexBox">
              <li class="mr-10"><a href="<?php echo $ftSocial[0]['twitter'] ?>"><i class="fab fa-twitter"></i></a></li>
              <li class="mr-10"><a href="<?php echo $ftSocial[0]['youtube'] ?>"><i class="fab fa-youtube"></i></a></li>
              <li class="mr-10"><a href="<?php echo $ftSocial[0]['gmail'] ?>"><i class="fas fa-envelope"></i></a></li>
              <li class="mr-10"><a href="<?php echo $ftSocial[0]['facebook'] ?>"><i class="fab fa-facebook-f"></i></a></li>
              <li class="mr-10"><a href="<?php echo $ftSocial[0]['website'] ?>"><i class="fas fa-globe"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="flexBox mt-10">
          <?php
            if(isset($showRooms) && !empty($showRooms)){
              foreach ($showRooms as $showRoom) {
          ?>
          <div class="column toggle_parents">
            <div class="item mt-20">
              <div class="text-bold toggle_btn"><?php echo $showRoom['province'] ?> : </div>
              <div class="toggle_content">
                <div class="mt-5"><i class="fas fa-map-marker-alt mr-5"></i><?php echo $showRoom['address'] ?></div>
                <div class="tel"><a href="#"><i class="fas fa-phone mr-5"></i><?php echo $showRoom['tel_number'] ?></a></div>
              </div>
            </div>
          </div>
          <?php }} ?>
          <div class="column">
            <div class="item mt-20">
              <div class="fb-page" data-href="<?php echo $social[0]['facebook'] ?>" data-tabs="timeline" data-width="500" data-height="120" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote class="fb-xfbml-parse-ignore" cite="<?php echo $social[0]['facebook'] ?>"><a href="<?php echo $social[0]['facebook'] ?>">Facebook</a></blockquote>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="column"></div>
      <div class="column"></div>
    </footer>
  </body>
</html>