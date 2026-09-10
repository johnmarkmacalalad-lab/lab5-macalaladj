<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product_model extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_name', 'description', 'price', 'quantity'];

    public function all_products()
    {
        return $this->db->table($this->table)->order_by('id', 'DESC')->result();
    }

    public function find_product($id)
    {
        return $this->db->table($this->table)->where('id', (int) $id)->row();
    }

    public function create_product($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function update_product($id, $data)
    {
        return $this->db->table($this->table)->where('id', (int) $id)->update($data);
    }

    public function delete_product($id)
    {
        return $this->db->table($this->table)->where('id', (int) $id)->delete();
    }
}