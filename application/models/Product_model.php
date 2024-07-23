<?php
class Product_model extends CI_Model
{
    public function get_all_products()
    {       
        return $this->db->get('products')->result();
    }

    public function get_product($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row();
    } 

    public function to_check_product_purchase($product_id)
    {
        $this->db->select('transactions.*, products.name as product_name, products.price as product_price');
        $this->db->from('transactions');
        $this->db->join('products', 'transactions.product_id = products.id');
        $this->db->where('transactions.product_id', $product_id);
        $this->db->order_by('transactions.id','desc');
        $data =  $this->db->get()->row();
        if($data->status){
            return $data;
        }else{
            return false;
        }       
    }

    public function insert_payment($data)
    {
        $this->db->insert('transactions', $data);
    }

    public function update_payment($order_id, $data)
    {
        $this->db->where('order_id', $order_id);
        $this->db->update('transactions', $data);
    }

    public function get_payment_by_order_id($order_id)
    {
        $this->db->select('transactions.*, products.name as product_name, products.price as product_price');
        $this->db->from('transactions');
        $this->db->join('products', 'transactions.product_id = products.id');
        $this->db->where('transactions.order_id', $order_id);
        return $this->db->get()->row();
    }



}
