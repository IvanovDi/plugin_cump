<?php

class Deserializer
{
    public function get_value(  ) {
        global $wpdb;

        $table_name = $wpdb->prefix . 'camp_price';
        return $wpdb->get_results("
            SELECT `service_name`, `price`, `location` FROM {$table_name}
        ", ARRAY_A);
    }
}