<?php
if (has_post_thumbnail()) :
    $style = "background-image:linear-gradient(#21252952, #2125297d), url('" . get_the_post_thumbnail_url(get_the_ID(), 'full') . "');height: 280px;background-size: cover;background-position-y: center;";
    $css = '';
else :
    $style = "background-color:#f6f4ee;    height: 280px;";
    $css = 'no-bg-header';
endif;
?>
<section class="header <?php echo $css; ?>" style="<?php echo $style; ?>">
    <div class="wrap-title">
        <div class="container">
            <h2 class="title"> <?php wp_title('', true); ?></h2>
        </div>
    </div>
</section>