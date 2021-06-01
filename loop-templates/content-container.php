<?php
/**
 * Content empty partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="container">

        <div class="entry-content">

            <?php the_content(); ?>

        </div>
        
    </div>

</article><!-- #post-## -->

