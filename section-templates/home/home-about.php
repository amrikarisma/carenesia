<section class="about">
    <div class="about-header">
        <h2><?php echo get_field('who_we_are')['title'] ?? ''; ?></h2>
        <div class="tagline">
            <p><?php echo get_field('who_we_are')['tagline'] ?? ''; ?></p>
        </div>
    </div>
    <div class="wrap-list-about">
        <div class="container">
            <div class="row">
                <?php


                foreach (get_field('who_we_are')['list'] ?? [] as $list) : ?>

                    <div class="col-md-4 mb-4">
                        <div class="wrap-about-image">
                            <img src="<?php echo $list['image']['url']; ?>" alt="<?php echo $list['title']; ?>">
                        </div>
                        <div class="wrap-about-text">
                            <h2><?php echo $list['title']; ?></h2>
                            <p><?php echo $list['description']; ?></p>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>