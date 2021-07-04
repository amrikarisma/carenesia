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

        <div class="entry-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="notes">
                        <?php echo get_field('manual')['content']; ?>
                        <a class="btn btn-sm btn-primary" target="_blank" href="<?php echo get_field('manual')['halaman_konfirmasi']['url'] . '?external_id=' . $args['external_id'] ?>"><?php echo get_field('manual')['halaman_konfirmasi']['text']; ?></a>
                        <br>
                        <p></p>
                    </div>
                    <table class="table">
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td> <i><?php echo $args['status'] ?> </i></td>
                        </tr>
                        <tr>
                            <td>No. Transaksi</td>
                            <td>:</td>
                            <td> <strong><?php echo $args['external_id'] ?> </strong></td>
                        </tr>
                        <tr>
                            <td>Nominal</td>
                            <td>:</td>
                            <td> <strong><?php echo 'Rp. ' . number_format($args['nominal'], 0, ',', '.') ?> </strong></td>
                        </tr>
                        <tr>
                            <td>Bank</td>
                            <td>:</td>
                            <td>
                                <?php foreach (get_field('manual')['bank'] as $bank) : ?>
                                    <div class="row">
                                        <div class="col-auto justify-content-center align-items-center align-self-center">
                                            <img src="<?php echo $bank['logo']['url']; ?>" alt="" width="50">
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-12">
                                                    <strong><?php echo $bank['nama_bank']; ?></strong>
                                                </div>
                                                <div class="col-12">
                                                    <i><?php echo $bank['atas_nama']; ?></i>
                                                </div>
                                                <div class="col-12">
                                                    <strong><?php echo $bank['no_rekening']; ?> </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div><!-- .entry-content -->
    </div>



</article><!-- #post-## -->