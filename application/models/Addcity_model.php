<?php
class Addcity_model extends CI_Model{
function __construct() {
parent::__construct();
}
function add($data){
// Inserting in Table(students) of Database(college)
$this->load->database();
$this->db->insert('city', $data);
}
}
?>