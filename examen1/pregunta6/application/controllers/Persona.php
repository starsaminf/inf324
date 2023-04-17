<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persona extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Persona_model');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function create()
	{
		$this->load->view('persona/create');
	}

	public function store()
	{
		$ci = $this->input->post('ci');
		$nombre_completo = $this->input->post('nombre_completo');
		$fecha_nacimiento = $this->input->post('fecha_nacimiento');
		$telefono = $this->input->post('telefono');
		$departamento = $this->input->post('departamento');

		$data = array(
			'ci' => $ci,
			'nombre_completo' => $nombre_completo,
			'fecha_nacimiento' => $fecha_nacimiento,
			'telefono' => $telefono,
			'departamento' => $departamento
		);
		$this->Persona_model->create($data);

		redirect('http://localhost:8080/examen1/pregunta6/index.php');
	}

	public function index()
	{
		$this->load->model("Persona_model");
		$filas = $this->Persona_model->personas();
		$data["data"] = $filas;

		$this->load->view("persona/index", $data);
	}

	public function edit($id)
	{
		$data['data'] = $this->Persona_model->get_by_ci($id);
		$this->load->view('persona/edit', $data);
	}

	public function update()
	{
		$ci               = $this->input->post('ci');
		$nombre_completo  = $this->input->post('nombre_completo');
		$fecha_nacimiento = $this->input->post('fecha_nacimiento');
		$telefono         = $this->input->post('telefono');
		$departamento     = $this->input->post('departamento');

		$data = array(
			'ci'               => $ci,
			'nombre_completo'  => $nombre_completo,
			'fecha_nacimiento' => $fecha_nacimiento,
			'telefono'         => $telefono,
			'departamento'     => $departamento
		);
		$this->Persona_model->update($ci, $data);
		redirect('http://localhost:8080/examen1/pregunta6/index.php/persona/index');
	}

	public function delete($ci)
	{
		$this->Persona_model->delete($ci);
		redirect('http://localhost:8080/examen1/pregunta6/index.php/persona/index');
	}
}
