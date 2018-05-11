<?php
class Messages_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_latest_messages()
  {
    return array_reverse($this->db->order_by('id', 'desc')->get('messages', 1000, 0)->result_array());
  }

  public function add_message()
  {
      
      
    $admin = $this->db->get_where('usertable', array('email'=>'admin@admin.com'))->row()->no;
              
    $data = array(
      'sender' => $this->session->userdata('admin_id'),
      'receiver'=> $admin,
      'message' => $this->input->post('msg'),
      'created_at' => date('Y-m-d H:i:s'),
    );
    return $this->db->insert('messages', $data);
  }
}
