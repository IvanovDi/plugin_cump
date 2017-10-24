<div>
    <?php foreach ($deserializer->get_camp_price_value($location) as $item) { ?>
        <div>
            <lable> Date From
                <input type="date" name="edit[<?php echo $item['id']; ?>][date_from]" value="<?php echo $item['date_from']; ?>">
            </lable>
            <lable> Date To
                <input type="date" name="edit[<?php echo $item['id']; ?>][date_to]" value="<?php echo $item['date_to']; ?>">
            </lable>
            <lable> Price Mid
                <select class="price" style="width:200px;" name="edit[<?php echo $item['id']; ?>][price_mid]">
                    <option value="<?php echo "{$item['price_mid']}@{$item['service_name_mid']}" ?>"><?php echo $item['service_name_mid']; ?></option>
                </select>
            </lable>
            <lable> Price Full
                <select class="price" style="width:200px;" name="edit[<?php echo $item['id']; ?>][price_full]">
                    <option value="<?php echo "{$item['price_full']}@{$item['service_name_full']}" ?>"><?php echo $item['service_name_full']; ?></option>
                </select>
            </lable>
            <lable>Booking
                <input type="checkbox" <?php echo $item['booking'] ? 'checked' : ''; ?> name="edit[<?php echo $item['id']; ?>][booking]" >
            </lable>
            <span class="trash-icon"><a href="/wp-admin/options-general.php?page=custom-admin-page&del=<?php echo $item['id']; ?>" onclick="return confirm('delete item id - <?php echo $item['id']; ?> ?');" title="trash"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></span>
        </div>
    <?php } ?>

    <p><b>Create New Item</b></p>
    <lable> Date From
        <input type="date" name="new[date_from]" value="">
    </lable>
    <lable> Date To
        <input type="date" name="new[date_to]" value="">
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

</div>
<?php
wp_nonce_field( 'acme-settings-save', 'acme-custom-message' );

submit_button('Save');
?>