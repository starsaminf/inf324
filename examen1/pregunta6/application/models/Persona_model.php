<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persona_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function personas()
	{
		$query = $this->db->query("SELECT * FROM persona");
		return $query->result();
	}

	public function get_by_ci($ci)
	{
		$query = $this->db->query("SELECT * FROM persona WHERE ci = $ci");
		return $query->first_row();
	}

	public function create($data)
	{
		$this->db->insert('persona', $data);
		return $this->db->insert_id();
	}

	public function update($ci, $data)
	{
		$this->db->where('ci', $ci);
		$this->db->update('persona', $data);
		return $this->db->affected_rows();
	}

	public function delete($ci)
	{
		$this->db->where('ci', $ci);
		$this->db->delete('persona');
		return $this->db->affected_rows();
	}
}
