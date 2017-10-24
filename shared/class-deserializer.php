<?php

class Deserializer
{
    public function get_price() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'camp_price';
        return $wpdb->get_results("
            SELECT `service_name`, `price`, `location` FROM {$table_name}
        ", ARRAY_A);
    }

    public function get_camp_price_value($location)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'camp_schedule';
        return $wpdb->get_results("
            SELECT * FROM {$table_name} WHERE `location` = '{$location}'
        ", ARRAY_A);
    }
}