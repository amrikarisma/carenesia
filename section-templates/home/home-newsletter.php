<?php if (isset(get_field('newsletters')['message'])) : ?>
    <section class="newsletter" style="background-color: <?php echo get_field('newsletters')['style']['background_color']; ?>;">
        <div class="container">
            <div class="row">
                <div class="col-7 col-md-9">
                    <!-- <h2>Subscribe and receive weekly our newsletter</h2> -->
                    <h2 style="color: <?php echo get_field('newsletters')['style']['text_color']; ?>;"><?php echo get_field('newsletters')['message']; ?></h2>
                </div>
                <div class="col-5 col-md-3 text-right">
                    <a href="<?php echo get_field('newsletters')['button']['url']; ?>" class="btn btn-secondary"><?php echo get_field('newsletters')['button']['text']; ?></a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>