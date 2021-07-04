<?php

if (!function_exists('wpcfu_output_file_upload_form')) {

    /**
     * Output the form.
     *
     * @param      array  $atts   User defined attributes in shortcode tag
     */
    function wpcfu_output_file_upload_form($atts)
    {
        $atts = shortcode_atts(array(), $atts);
        $html = '';
        $success = '<div class="alert alert-success" role="alert">
        Bukti transfer berhasil dikirim.
      </div>';
        if (isset($_GET['error_message'])) {
            $failed = '<div class="alert alert-danger" role="alert">' . $_GET['error_message'] . '</div>';
        }
        if (isset($_GET['external_id'])) {
            $_SESSION['external_id'] = $_GET['external_id'];
            $external_id = $_SESSION['external_id'];
        } else {
            $external_id = $_SESSION['external_id'];
        }

        $html .= isset($_GET['success_message']) ? $success : '';

        $html .= '<form class="form" method="POST" enctype="multipart/form-data">';
        $html .= isset($_GET['error_message']) ? $failed : '';
        $html .= '<div class="form-group">';
        $html .= '<label for="wpcfu_name">Nama</label>';
        $html .= '<input type="text" class="form-control"  name="wpcfu_name" id="wpcfu_name" placeholder="Nama">';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label for="wpcfu_email">Email</label>';
        $html .= '<input type="email" class="form-control"  name="wpcfu_email" id="wpcfu_email" placeholder="Email">';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label for="wpcfu_external_id">No. Transaksi</label>';
        $html .= '<input type="text" class="form-control"  name="wpcfu_external_id" id="wpcfu_external_id" placeholder="Masukan No. Transaksi" value="' . $external_id . '">';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<label for="wpcfu_file">Upload Bukti Transfer</label>';
        $html .= '<input type="file" class="form-control-file"  name="wpcfu_file" id="wpcfu_file" accept=".jpg,.png,.jpeg,.gif">';
        $html .= '</div>';


        // Output the nonce field
        $html .= wp_nonce_field('upload_wpcfu_file', 'wpcfu_nonce', true, false);
        $html .= '<br>';

        $html .= '<button type="submit" name="submit_wpcfu_form" class="btn btn-primary">';
        $html .= esc_html__('Upload', 'theme-text-domain');
        $html .= '</button>';

        $html .= '</form>';

        echo $html;
    }
}

/**
 * Add the shortcode '[wpcfu_form]'.
 */
add_shortcode('wpcfu_form', 'wpcfu_output_file_upload_form');

if (!function_exists('wpcfu_handle_file_upload')) {

    /**
     * Handles the file upload request.
     */
    function wpcfu_handle_file_upload()
    {
        global $wp;

        if (!isset($_POST['submit_wpcfu_form'])) {
            return;
        }
        $currentURL = home_url($_SERVER['REQUEST_URI']);
        $currentURL = explode('?', $currentURL)[0];

        // Verify nonce
        if (!wp_verify_nonce($_POST['wpcfu_nonce'], 'upload_wpcfu_file')) {
            wp_die(esc_html__('Nonce mismatched', 'theme-text-domain'));
        }

        // Throws a message if no file is selected
        if (!$_FILES['wpcfu_file']['name']) {
            wp_redirect(add_query_arg(array('error_message' => esc_html__('Upload bukti transfer terlebih dahulu', 'theme-text-domain')), $currentURL));
            exit;
            // wp_die(esc_html__('Please choose a file', 'theme-text-domain'));
        }

        $allowed_extensions = array('jpg', 'jpeg', 'png');
        $file_type = wp_check_filetype($_FILES['wpcfu_file']['name']);
        $file_extension = $file_type['ext'];

        // Check for valid file extension
        if (!in_array($file_extension, $allowed_extensions)) {
            wp_redirect(add_query_arg(array('error_message' => sprintf(esc_html__('Format tidak diijinkan: %s', 'theme-text-domain'), implode(', ', $allowed_extensions))), $currentURL));
            exit;
            // wp_die(sprintf(esc_html__('Invalid file extension, only allowed: %s', 'theme-text-domain'), implode(', ', $allowed_extensions)));
        }

        $file_size = $_FILES['wpcfu_file']['size'];
        $allowed_file_size = 2097152; // Here we are setting the file size limit to 2048 KB = 2048 × 1024

        // Check for file size limit
        if ($file_size >= $allowed_file_size) {
            wp_redirect(add_query_arg(array('error_message' => sprintf(esc_html__('File terlalu besar, file harus lebih kecil dari %d KB', 'theme-text-domain'), $allowed_file_size / 1000)), $currentURL));
            exit;
            // wp_die(sprintf(esc_html__('File size limit exceeded, file size should be smaller than %d KB', 'theme-text-domain'), $allowed_file_size / 1000));
        }



        $result = checkExistTransaction(
            [
                'external_id'   => $_POST['wpcfu_external_id'],
                'current_url'   => $currentURL,
            ]
        );
        if ($result != true) {
            return $result;
            wp_die();
        }

        // These files need to be included as dependencies when on the front end.
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');


        add_filter('upload_dir', 'wpse_141088_upload_dir');

        // Let WordPress handle the upload.
        // Remember, 'wpcfu_file' is the name of our file input in our form above.
        // Here post_id is 0 because we are not going to attach the media to any post.

        // $attachment_id = media_handle_upload('wpcfu_file', 0);

        $upload_overrides = array(
            'test_form' => false,
            'unique_filename_callback'  => 'my_cust_filename'
        );
        $upload_image = wp_handle_upload($_FILES['wpcfu_file'], $upload_overrides);

        remove_filter('upload_dir', 'wpse_141088_upload_dir');

        $newfilename = basename($upload_image['url']);

        $result = checkExistTransaction(
            [
                'external_id'   => $_POST['wpcfu_external_id'],
                'image'         => $newfilename,
                'current_url'   => $currentURL,
            ]
        );
        return $result;
        exit;
    }
    /**
     * Override the default upload path.
     * 
     * @param   array   $dir
     * @return  array
     */
    function wpse_141088_upload_dir($dir)
    {
        return array(
            'path'   => $dir['basedir'] . '/manual-transfer',
            'url'    => $dir['baseurl'] . '/manual-transfer',
            'subdir' => '/manual-transfer',
        ) + $dir;
    }
    function my_cust_filename($dir, $name, $ext)
    {
        $filename = 'transfer_manual_' . time();
        return $filename . $ext;
    }

    function checkExistTransaction($data)
    {
        $external_id = preg_replace('!\s+!', '', strip_tags($data['external_id']));
        if (!empty(get_donation('check', $external_id))) {
            if (isset($data['image'])) {
                $update = update_donation([
                    'external_id'   => $external_id,
                    'image'   => strip_tags($data['image']),
                ]);

                if (!$update) {
                    return $update;
                }
                $_SESSION['external_id'] = '';
                wp_redirect(add_query_arg(array('success_message' => 'Bukti transfer berhasil dikirim.'), $data['current_url']));
                exit;
            }
            return true;
        }
        wp_redirect(add_query_arg(array('error_message' => 'No Transaksi tidak ditemukan'), $data['current_url']));
        exit;
    }
}

/**
 * Hook the function that handles the file upload request.
 */
add_action('init', 'wpcfu_handle_file_upload');
