<?php

class DataScheduleCamps
{
    protected $wpdb_global;

    protected $wpdb_custom;


    public function __construct($wpdb_global)
    {
        $this->wpdb_global = $wpdb_global;
        //плучать данные из конфига
        $this->wpdb_custom = new wpdb('root', 'q232m869', 'newbackup',  '212.47.228.90');
    }

    public function createTableScheduleCamps()
    {
        $table_name = $this->wpdb_global->prefix . 'camp_price';
        if($this->wpdb_global->get_var("show tables like '$table_name'") != $table_name) {
                $sql = ("
                CREATE TABLE {$table_name} (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `location` VARCHAR(45) NULL,
                  `price` DECIMAL(16,2) NULL,
                  `service_name` VARCHAR(45),
                  PRIMARY KEY (`id`)) ENGINE=InnoDB CHARACTER SET=utf8;
            ");
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);
        }

//        вынести в отдельный метод

            $table_name = $this->wpdb_global->prefix . 'camp_schedule';
        if($this->wpdb_global->get_var("show tables like '$table_name'") != $table_name) {
            $sql = ("
                CREATE TABLE {$table_name} (
                  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                  `date_from` DATE NULL,
                  `date_to` DATE NULL,
                  `price_mid` DECIMAL(16,2),
                  `price_full` DECIMAL(16,2),
                  `booking` TINYINT(4) NULL,
                  `location` VARCHAR(45) NULL,
                  `service_name_mid` VARCHAR(45),
                  `service_name_full` VARCHAR(45),
                  PRIMARY KEY (`id`)) ENGINE=InnoDB CHARACTER SET=utf8;
            ");
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }

    }

    public function storeDataPriceCamps()
    {
        $data = $this->receivingPriceCamps();

        $table_name = $this->wpdb_global->prefix . 'camp_price';

        foreach ($data as $row) {
            $this->wpdb_global->insert($table_name, $row);
        }
    }

    protected function receivingPriceCamps()
    {
       return $this->wpdb_custom->get_results("
            select v_s.servicename as service_name, v_s.unit_price as price, v_s_f.cf_811 as location from vtiger_service v_s
            join vtiger_servicecf v_s_f on v_s.serviceid = v_s_f.serviceid
            where v_s.servicecategory = 'Летний лагерь';
        ", ARRAY_A);
    }
}