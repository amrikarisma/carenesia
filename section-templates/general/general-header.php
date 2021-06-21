<?php
if (has_post_thumbnail()) :
    $style = "background-image:url(" . get_the_post_thumbnail_url(get_the_ID(), 'full') . ");    height: 280px;";
    $css = '';
else :
    $style = "background-color:#f6f4ee;    height: 280px;";
    $css = 'no-bg-header';
endif;
?>
<section class="header <?php echo $css; ?>" style="<?php echo $style; ?>">
    <div class="wrap-title">
        <div class="container">
            <?php the_title('<h2 class="title">', '</h2>'); ?>
        </div>
    </div>
</section>