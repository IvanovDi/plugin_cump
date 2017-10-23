<?php

include_once( plugin_dir_path( __FILE__ ) . 'shared/class-deserializer.php' );

$deserializer = new Deserializer();

if ($_POST['form_id'] && isset($_POST['form_id'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'camp_schedule';
    echo "<pre>";
    var_dump($_POST);

    $wpdb->insert($table_name, [
        'from' => $_POST['new']['date_from'],
        'to' => $_POST['new']['date_to'],
        'booking' => $_POST['new']['booking'] ? 1 : 0,
        'price_mid' => $_POST['new']['price_mid'],
        'price_full' => $_POST['new']['price_full'],
        'location' => $_POST['location']
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



                    <?php foreach ($deserializer->get_camp_price_value() as $item) { ?>
                        <div>
                        <lable> Date From
                            <input type="date" name="edit[date_from]" required value="<?php echo $item['from']; ?>">
                        </lable>
                        <lable> Date To
                            <input type="date" name="edit[date_to]" required value="<?php echo $item['to']; ?>">
                        </lable>
                        <lable> Price Mid
                            <select class="price" style="width:200px;" name="new[price_mid]">
                                <option value="<?php echo $item['price_mid']; ?>"></option>
                            </select>
                        </lable>
                        <lable> Price Full
                            <select class="price" style="width:200px;" name="new[price_full]">
                                <!-- Dropdown List Option -->
                            </select>
                        </lable>
                        <lable>Booking
                            <input type="checkbox" name="new[booking]" >
                        </lable>
                        <span class="trash-icon"><a href="" title="trash"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></span>
                        </div>
                    <?php } ?>






                    <input type="hidden" name="form_id" value="1">
                    <input type="hidden" name="location" value="niclolaev">
                    <lable> Date From
                        <input type="date" name="new[date_from]" required value="">
                    </lable>
                    <lable> Date To
                        <input type="date" name="new[date_to]" required value="">
                    </lable>
                    <lable> Price Mid
                        <select class="price" style="width:200px;" name="new[price_mid]">
                            <!-- Dropdown List Option -->
                        </select>
                    </lable>
                    <lable> Price Full
                        <select class="price" style="width:200px;" name="new[price_full]">
                            <!-- Dropdown List Option -->
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


<script>
    jQuery( function() {
        jQuery( "#tabs" ).tabs();

        var price = [];
        <?php foreach ($deserializer->get_price() as $item) { ?>

            price.push({id : <?php echo $item['price'] ?>, text: "<?php echo $item['service_name'] ?>"});

        <?php } ?>
        console.log(price);
        jQuery(".price").select2({
            data: price
        });
    } );
</script>