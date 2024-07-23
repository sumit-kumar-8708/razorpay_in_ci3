<?php
class Payment_model extends CI_Model
{
    public function insert_payment($data)
    {
        return $this->db->insert('payments', $data);
    }

    public function get_payment_details($payment_id)
    {
        $this->db->where('payment_id', $payment_id);
        $query = $this->db->get('payments');
        return $query->row_array();
    }
}
