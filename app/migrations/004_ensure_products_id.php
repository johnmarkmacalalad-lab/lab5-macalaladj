<?php

class Ensure_products_id
{
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if (!$this->_lava->dbforge->table_exists('products')) {
            return;
        }

        $id_exists = $this->_lava->dbforge->column_exists('products', 'id');

        if (!$id_exists) {
            $this->_lava->db->raw(
                'ALTER TABLE `products` ADD COLUMN `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY'
            );
            return;
        }

        $primary_key = $this->_lava->db->raw(
            "SELECT COUNT(*) FROM information_schema.table_constraints
             WHERE table_schema = DATABASE()
             AND table_name = 'products'
             AND constraint_type = 'PRIMARY KEY'"
        );

        if ((int) $primary_key->fetchColumn() === 0) {
            $this->_lava->db->raw('ALTER TABLE `products` ADD PRIMARY KEY (`id`)');
        }
    }

    public function down()
    {
        // Keep the products table intact during rollback.
    }
}