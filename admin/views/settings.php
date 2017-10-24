<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



$deserializer = new Deserializer();

if(isset($_GET['del']) && $_GET['del']) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'camp_schedule';
    $wpdb->delete($table_name, array('id' => $_GET['del']));
}


if (isset($_POST['form_id']) && $_POST['form_id']) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'camp_schedule';

    $price_mid_arr = explode('@', $_POST['new']['price_mid']);
    $price_full_arr = explode('@', $_POST['new']['price_full']);


//    echo "<pre>";
//    var_dump($price_mid_arr);
    if ($_POST['new']['date_from'] && isset($_POST['new']['date_from'])) {
        $wpdb->insert($table_name, [
            'date_from' => $_POST['new']['date_from'],
            'date_to' => $_POST['new']['date_to'],
            'booking' => $_POST['new']['booking'] ? 1 : 0,
            'price_mid' => $price_mid_arr[0],
            'service_name_mid' => $price_mid_arr[1],
            'service_name_full' => $price_full_arr[1],
            'price_full' => $price_full_arr[0],
            'location' => $_POST['location']
        ]);
    }

    foreach ($_POST['edit'] as $key => $value) {

        // есть возможность оптимизировать, сделать обновление формы по идентификатору
//        echo '<pre>';
//        print_r($value);

        $price_mid_arr = explode('@', $value['price_mid']);
        $price_full_arr = explode('@', $value['price_full']);
        $value ['price_mid'] =  $price_mid_arr[0];
        $value ['service_name_mid'] = $price_mid_arr[1];
        $value ['price_full'] =  $price_full_arr[0];
        $value ['service_name_full'] = $price_full_arr[1];
        $value['booking'] = $value['booking'] ? 1 : 0;

        $wpdb->update(
                $table_name,
                $value,
                array('id' => $key)
            );
    }

}


?>

<div class="wrap">

    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Николаев</a></li>
            <li><a href="#tabs-2">Херсон</a></li>
            <li><a href="#tabs-3">Киев</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" id="structure" name="structure" enctype="multipart/form-data">

                <input type="hidden" name="form_id" value="1">
                <input type="hidden" name="location" value="mykolaiv">

                <?php
                    $location = "mykolaiv";
                    include (plugin_dir_path( __FILE__ ) . 'form-input.php');
                    $location = '';
                ?>


            </form>
        </div>
        <div id="tabs-2">
            <form action="" method="post" id="structure" name="structure" enctype="multipart/form-data">

                <input type="hidden" name="form_id" value="2">
                <input type="hidden" name="location" value="kherson">

                <?php
                    $location = "kherson";
                    include (plugin_dir_path( __FILE__ ) . 'form-input.php');
                    $location = '';
                ?>

            </form>
        </div>
        <div id="tabs-3">
            <form action="" method="post" id="structure" name="structure" enctype="multipart/form-data">

                <input type="hidden" name="form_id" value="3">
                <input type="hidden" name="location" value="kiev">

                <?php
                    $location = "kiev";
                    include (plugin_dir_path( __FILE__ ) . 'form-input.php');
                    $location = '';
                ?>

            </form>
        </div>
    </div>



 
<!--    <form method="post" action="--><?php //echo esc_html( admin_url( 'admin-post.php' ) ); ?><!--">-->
<!---->
<!--    	<div id="universal-message-container">-->
<!--            <h2>Universal Message</h2>-->
<!-- -->
<!--            <div class="options">-->
<!--                <p>-->
<!--                    <label>What message would you like to display above each post?</label>-->
<!--                    <br />-->
<!--                    <input type="text" name="acme-message"-->
<!--                           value="--><?php //echo esc_attr( $this->deserializer->get_value( 'tutsplus-custom-data' ) ); ?><!--" />-->
<!--                </p>-->
<!--        </div>-->
<!---->
<!--          --><?php
//            wp_nonce_field( 'acme-settings-save', 'acme-custom-message' );
//            submit_button();
//        ?>
<!---->
<!--    </form>-->
 
</div>


<script>
    jQuery( function() {
        jQuery( "#tabs" ).tabs();

        var price = [];

        <?php foreach ($deserializer->get_price() as $item) { ?>

            price.push({id : <?php echo "\"{$item['price']}@{$item['service_name']}\"" ?>, text: "<?php echo $item['service_name'] ?>"});

        <?php } ?>

        jQuery(".price").select2({
            data: price
        });

    } );
</script>