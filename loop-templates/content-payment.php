<?php

/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="container">

        <header class="entry-header">

            <?php the_title('<h3 class="entry-title">', '</h3>'); ?>

            <div class="entry-meta">

                <?php //understrap_posted_on(); 
                ?>

            </div><!-- .entry-meta -->

        </header><!-- .entry-header -->
        <div class="entry-content">
            <!-- Array ( [is_closed] => [status] => PENDING [currency] => IDR [owner_id] => 60c48cf24daf6a40ad0895ee [external_id] => VA_fixed-1624262199 [bank_code] => BNI [merchant_code] => 8808 [name] => Merritt Downs [account_number] => 8808999916816312 [is_single_use] => [expiration_date] => 2052-06-20T17:00:00.000Z [id] => 60cfe3c7606c6f7a4ca08804 ) -->
            <table class="table">
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td><?php echo $args['status'] ?></td>
                </tr>
                <tr>
                    <td>Bank</td>
                    <td>:</td>
                    <td><?php echo $args['bank_code'] ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo $args['name'] ?></td>
                </tr>
                <tr>
                    <td>No. VA</td>
                    <td>:</td>
                    <td><?php echo $args['account_number'] ?></td>
                </tr>
                <tr>
                    <td>Nominal</td>
                    <td>:</td>
                    <td><?php echo 'Rp. ' . number_format($args['expected_amount'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <td>Batas Waktu Pembayaran</td>
                    <td>:</td>
                    <td><?php echo $args['expiration_date'] ?></td>
                </tr>
            </table>

            <?php var_dump($args); ?>

        </div><!-- .entry-content -->
    </div>



</article><!-- #post-## -->