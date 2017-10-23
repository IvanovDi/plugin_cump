<script>
    jQuery( function() {
        jQuery( "#tabs" ).tabs();

        var country = ["Australia", "Bangladesh", "Denmark", "Hong Kong", "Indonesia", "Netherlands", "New Zealand", "South Africa"];
        jQuery("#count").select2({
            data: country
        });
    } );
</script>


<?php

include_once( plugin_dir_path( __FILE__ ) . 'shared/class-deserializer.php' );

$deserializer = new Deserializer();

if ($_POST['form_id'] && isset($_POST['form_id'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'camp_schedule';
    echo "<pre>";
    print_r($_POST);

    $wpdb->insert($table_name, [
        'from' => $_POST['new']['date_from'],
        'to' => $_POST['new']['date_to'],
        'booking' => $_POST['new']['booking'] ? 1 : 0,
        'price' => $_POST['new']['price'],
        'location' => 'Niko'
    ]);
}
?>

<div class="wrap">

    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Николаев</a></li>
            <li><a href="#tabs-2">Киев</a></li>
            <li><a href="#tabs-3">Херсон</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" id="structure" name="structure" enctype="multipart/form-data">
                <div>
                    <input type="hidden" name="form_id" value="1">
                    <lable> Date From
                        <input type="date" name="new[date_from]" required value="">
                    </lable>
                    <lable> Date To
                        <input type="date" name="new[date_to]" required value="">
                    </lable>
                    <lable> Price Mid
                        <div>
                            <select id="count" style="width:300px;">
                                <!-- Dropdown List Option -->
                            </select>
                        </div>

                        <!--            использовать Autocomplete  jquery ui-->
<!--                            <select  name="new['price_mid']">-->
<!--                                --><?php //foreach ($deserializer->get_value() as $item) { ?>
<!--                                    <option value='--><?php //echo  $item['price']; ?><!--'>--><?php //echo  $item['service_name']; echo " / {$item['location']}"; ?><!--</option>-->
<!---->
<!--                                --><?php //}?>
<!---->
<!--                            </select>-->
                    </lable>
                    <lable> Price Full
                        <!--            получать значение из своей базы -->
                        <select  name="new['price_full']">
                            <?php foreach ($deserializer->get_value() as $item) { ?>
                                <option value='<?php echo  $item['price']; ?>'><?php echo  $item['service_name']; echo " / {$item['location']}"; ?></option>

                            <?php }?>

                        </select>
                    </lable>
                    <lable>Booking
                        <input type="checkbox" name="new[booking]" >
                    </lable>
    <!--                реализовать удаление-->
                    <span class="trash-icon"><a href="" title="trash"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></span>
                </div>
                <?php
                    wp_nonce_field( 'acme-settings-save', 'acme-custom-message' );

                    submit_button('Save');
                ?>

            </form>
        </div>
        <div id="tabs-2">
            <form action="" method="post" id="structure" name="structure" enctype="multipart/form-data">
                <input type="hidden" name="form_id" value="2">
                <lable> Date From
                    <input type="date" name="new[date_from]" required value="">
                </lable>
                <lable> Date To
                    <input type="date" name="new[date_to]" required value="">
                </lable>
                <lable> Price
                    <!--            получать значение из своей базы -->
                    <input type="text" name="new[price]" value="">
                </lable>
                <lable>Booking
                    <input type="checkbox" name="new[booking]" value="">
                </lable>
                <!--                реализовать удаление-->
                <span class="trash-icon"><a href="" title="trash"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></span>


            </form>
        </div>
        <div id="tabs-3">
            <form action="" method="post" id="structure" name="structure" enctype="multipart/form-data">
                <input type="hidden" name="form_id" value="3">
                <lable> Date From
                    <input type="date" name="new[date_from]" required value="">
                </lable>
                <lable> Date To
                    <input type="date" name="new[date_to]" required value="">
                </lable>
                <lable> Price
                    <!--            получать значение из своей базы -->
                    <input type="text" name="new[price]" value="">
                </lable>
                <lable>Booking
                    <input type="checkbox" name="new[booking]" value="">
                </lable>
                <!--                реализовать удаление-->
                <span class="trash-icon"><a href="" title="trash"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></span>


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