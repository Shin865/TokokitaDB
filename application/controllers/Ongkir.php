<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ongkir extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Madmin');
	}

	public function index(){
		if(empty($this->session->userdata('userName'))){
			redirect('adminpanel');
		}
		$data['ongkir']=$this->Madmin->get_all_data('tbl_ongkir')->result();
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/ongkir/tampil', $data);
		$this->load->view('admin/layout/footer');
	}

	public function add(){
		if(empty($this->session->userdata('userName'))){
			redirect('adminpanel');
		}
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/ongkir/formAdd');
		$this->load->view('admin/layout/footer');
	}

	public function save(){
		if(empty($this->session->userdata('userName'))){
			redirect('adminpanel');
		}
		$tujuan = $this->input->post('tujuan');
		$kurir = $this->input->post('kurir');
		$ongkos = $this->input->post('ongkos');
		$dataInput=array('tujuan'=>$tujuan, 'kurir' => $kurir, 'ongkos' => $ongkos);
		$this->Madmin->insert('tbl_ongkir', $dataInput);
		redirect('ongkir');
	}

	public function get_by_id($id){
		if(empty($this->session->userdata('userName'))){
			redirect('adminpanel');
		}
		$dataWhere = array('idOngkir'=>$id);
		$data['ongkir'] = $this->Madmin->get_by_id('tbl_ongkir', $dataWhere)->row_object();
		$this->load->view('admin/layout/header');
		$this->load->view('admin/layout/menu');
		$this->load->view('admin/ongkir/formEdit', $data);
		$this->load->view('admin/layout/footer');
	}

	public function edit(){
		if(empty($this->session->userdata('userName'))){
			redirect('adminpanel');
		}
		$id = $this->input->post('id');	
		$tujuan = $this->input->post('tujuan');
		$kurir = $this->input->post('kurir');
		$ongkos = $this->input->post('ongkos');
		$dataUpdate=array('tujuan'=>$tujuan, 'kurir' => $kurir, 'ongkos' => $ongkos);
		$this->Madmin->update('tbl_ongkir', $dataUpdate, 'idOngkir', $id);
		redirect('ongkir');
	}

	public function delete($id){
		if(empty($this->session->userdata('userName'))){
			redirect('adminpanel');
		}
		$this->Madmin->delete('tbl_ongkir', 'idOngkir', $id);
		redirect('ongkir');
	}
}
