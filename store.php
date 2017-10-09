<?php

    if ($_POST['form_id'] && isset($_POST['form_id'])) {

    $table_name = $wpdb->prefix . 'camp_schedule';

    $wpdb->insert($table_name,  [
        'from' => $_POST['from'],
        'to' => $_POST['to'],
        'booking' => $_POST['booking'],
        'location' => 'Niko'
    ]);

    wp_safe_redirect('_wp_http_referer');
    exit;

}





?>