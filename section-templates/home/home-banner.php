<section class="banner">
    <div class="row no-gutters">
        <?php foreach (get_field('banner')['item'] ?? [] as $banner) : ?>
            <div class="col-md-4">
                <div class="wrapper-outer-banner">
                    <div class="wrapper-banner-image">
                        <img src="<?php echo $banner['image']['url'] ?>" alt="<?php echo $banner['image']['title'] ?? '' ?>" srcset="">
                    </div>
                    <div class="wrapper-banner-text">
                        <h3 class="title">
                            <?php echo $banner['title'] ?? '' ?>
                        </h3>
                        <a class="btn btn-secondary"><?php echo $banner['button_text'] ?? '' ?></a>
                    </div>
                    <div class="banner-overlay-holder" style="background-color:<?php echo $banner['color'] ?? '' ?>; opacity: 0.6;"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>