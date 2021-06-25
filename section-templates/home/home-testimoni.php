<section class="testimoni" style="background-image:url('https://goodwish.qodeinteractive.com/elementor/wp-content/uploads/2017/03/h1-parallax-3.jpg');">
    <div class="container">
        <div class="testimoni-carousel owl-carousel owl-theme">
            <?php foreach (get_field('testiomi') ?? [] as $testiomi) : ?>

                <div class="item">
                    <div class="box-testimoni-text">
                        <h4 class="testimonial-title"><?php echo $testiomi['title']; ?></h4>
                        <div class="testimonial-text"><?php echo $testiomi['text']; ?></div>
                    </div>
                    <span class="testimonial-arrow"></span>
                    <div class="testimoni-author">
                        <div class="row">
                            <div class="col-3">
                                <div class="wrap-testimoni-author-photo">
                                    <img src="<?php echo $testiomi['photo']['image']['url']; ?>" alt="" class="rounded-circle">
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="wrap-testimoni-author-name">
                                    <h6 class="name">
                                        <?php echo $testiomi['name']; ?>
                                    </h6>
                                    <div class="author-from">
                                        <?php echo $testiomi['from']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</section>