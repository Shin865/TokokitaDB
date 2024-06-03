<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Madmin');
		$this->load->library('cart');

		$params = array('server_key' => 'YOUR API KEY', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function index()
	{
		$data['produk'] = $this->Madmin->get_produk()->result();
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header',$data);
		$this->load->view('home/layanan');
		$this->load->view('home/home');
		$this->load->view('home/layout/footer');
	}

	public function detail_produk($idProduk)
	{
		$dataWhere = array('idProduk'=>$idProduk);
		$data['produk']=$this->Madmin->get_by_id('tbl_produk',$dataWhere)->row_object();
		$data['kategori']=$this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header',$data);
		$this->load->view('home/detail_produk',$data);
		$this->load->view('home/layout/footer');
	}

	public function add_cart($idProduk)
	{
		if(empty($this->session->userdata('idKonsumen'))){
			echo "<script>alert('Anda harus login dulu untuk add cart');history.back()</script>";
			exit();
		}

		$dataWhere = array('idProduk'=>$idProduk);
		$produk = $this->Madmin->get_by_id('tbl_produk',$dataWhere)->row_object();
		$kota = $this->Madmin->get_kota_penjual($produk->idToko)->row_object();
	

		$this->session->set_userdata('idKotaAsal',$kota->idKota);
		$this->session->set_userdata('idTokoPenjual',$produk->idToko);

		$data = array(
			'id' => $produk->idProduk,
			'qty' => 1,
			'price' => $produk->harga,
			'name' => $produk->namaProduk,
			'image' => $produk->foto
		);

		$this->cart->insert($data);
		redirect("main/cart");
	}

	public function cart()
	{
		if(empty($this->session->userdata('idKonsumen'))){
			echo "<script>alert('Anda harus login dulu untuk add cart');history.back()</script>";
			exit();
		}

		$data['kota_asal'] = $this->session->userdata('idKotaAsal');
		$data['kota_tujuan'] = $this->session->userdata('idKotaTujuan');

		$data['cartItems'] = $this->cart->contents();
		$data['kategori']=$this->Madmin->get_all_data('tbl_kategori')->result();
		$data['total'] = $this->cart->total();

		$this->load->view('home/layout/header',$data);
		$this->load->view('home/cart',$data);
		$this->load->view('home/layout/footer');
	}

	public function delete_cart($rowid)
	{
		$remove = $this->cart->remove($rowid);
		redirect("main/cart");
	}

	public function register()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/register');
		$this->load->view('home/layout/footer');
	}

	public function getProvince(){
		$curl = curl_init(); 
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			"key: YOUR_API_KEY"
			),
		));
		$response = curl_exec($curl);
		
		$err = curl_error($curl);

		curl_close($curl);
		$data = json_decode($response, true);
		echo "<option value=''>Pilih Provinsi</option>";
		for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
		echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
		} 
	}

	public function getCity($province){
		$curl = curl_init(); 
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$province,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			"key: YOUR_API_KEY"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$data = json_decode($response, true);
		echo "<option value=''>Pilih Kota</option>";
		for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
		echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
		} 
	}

	public function save_reg(){
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telpon = $this->input->post('telpon');
		$idKota = $this->input->post('city');
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$alamat = $this->input->post('alamat');

		$dataInput=array('username'=>$username,'password'=>$password,'idKota'=>$idKota,'namaKonsumen'=>$nama,'alamat'=>$alamat,'email'=>$email,'tlpn'=>$telpon,'statusAktif'=>'Y');
		$this->Madmin->insert('tbl_member', $dataInput);
		echo "OK";
	}

	public function login(){
		$this->load->view('home/layout/header');
		$this->load->view('home/login');
		$this->load->view('home/layout/footer');	
	}

	public function login_member(){
		$this->load->model('Madmin');
		$u= $this->input->post('username');
		$p= md5($this->input->post('password'));
		
		$cek = $this->Madmin->cek_login_member($u, $p)->row_array();
		$result = $this->Madmin->cek_login_member($u, $p)->row_object();
	
		if($cek != NULL){
			if($cek['password'] == $p){
				$data_session = array(
					'idKonsumen' => $result->idKonsumen,
					'idKotaTujuan' => $result->idKota,
					'Member' => $u,
					'status' => 'login'
				);
				$this->session->set_userdata($data_session);
				redirect('main/dashboard');
			} else
				echo "<script>alert('Password Anda Salah, Coba Lagi');</script>";
		} else
			echo "<script>alert('Username atau Password Salah, Coba Lagi');</script>";
			$this->login();
	}

	public function dashboard(){
		$data['produk'] = $this->Madmin->get_produk()->result();
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header',$data);
		$this->load->view('home/dashboard');
		$this->load->view('home/layout/footer');
	}

	public function profile_member(){
		$data['produk'] = $this->Madmin->get_produk()->result();
		$data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('home/layout/header',$data);
		$this->load->view('home/profile');
		$this->load->view('home/layout/footer');
	}

	public function get_by_id($id){
		if(empty($this->session->userdata('Member'))){
			redirect('main/dashboard');
		}
		$dataWhere = array('idKonsumen'=>$id);
		$data['member'] = $this->Madmin->get_by_id('tbl_member', $dataWhere)->row_object();
		$this->load->view('home/layout/header');
		$this->load->view('home/form_edit', $data);
		$this->load->view('home/layout/footer');
	}

	public function edit() {
		if(empty($this->session->userdata('Member'))){
			redirect('main/dashboard');
		}
		$id = $this->input->post('idMember');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$nohp = $this->input->post('telpon');
		$dataUpdate = array(
			'username'=>$username,
			'namaKonsumen'=>$nama,
			'alamat'=>$alamat,
			'email'=>$email,
			'tlpn'=>$nohp
		);
		$this->Madmin->update('tbl_member', $dataUpdate, 'idKonsumen', $id);
		echo "<script>alert('Profile Berhasil Berubah');</script>";
		$this->dashboard();
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('main/login');
	}

	public function proses_transaksi()
    {
		$dataWhere = array('idKonsumen'=>$this->session->userdata('idKonsumen'));
		$member = $this->Madmin->get_by_id('tbl_member', $dataWhere)->row_object();
		$kota_asal = $this->session->userdata('idKotaAsal');
		$kota_tujuan = $this->session->userdata('idKotaTujuan');

		$this->load->helper('toko_helper');
		$ongkir = getOngkir($kota_asal,$kota_tujuan, '1000', 'jne');
		$ongkir_value = $ongkir['rajaongkir']['results']['0']['costs']['0']['cost']['0']['value'];

		$dataInput=array(
			'idKonsumen'=>$member->idKonsumen,
			'idToko'=>$this->session->userdata('idTokoPenjual'),
			'tglOrder'=>date("Y-m-d"),
			'statusOrder'=>"Belum Bayar",
			'kurir'=>"JNE OKE",
			'ongkir'=>$ongkir_value
		);
		$this->Madmin->insert('tbl_order', $dataInput);
		$insert_id = $this->db->insert_id();

		// Required
		$transaction_details = array(
		  'order_id' => $insert_id,
		  'gross_amount' => $ongkir_value + $this->cart->total(), // no decimal allowed for creditcard
		);

		$item_details = [];
		foreach ($this->cart->contents() as $item) {
			$item_details[] = array(
			  'id' => $item["id"],
			  'price' => $item["price"],
			  'quantity' => $item['qty'],
			  'name' => $item["name"]
			);
		}

		$item_details[] = array(
		  'id' => "ONGKIR",
		  'price' => $ongkir_value,
		  'quantity' => 1,
		  'name' => "Ongkos Kirim JNE OKE"
		);

		$billing_address = array(
		  'first_name'    => $member->namaKonsumen,
		  'last_name'     => "",
		  'address'       => $member->alamat,
		  'city'          => $member->alamat,
		  'postal_code'   => "",
		  'phone'         => $member->tlpn,
		  'country_code'  => 'IDN'
		);
		
		$shipping_address = array(
			'first_name'    => $member->namaKonsumen,
			'last_name'     => "",
			'address'       => $member->alamat,
			'city'          => $member->alamat,
			'postal_code'   => "",
			'phone'         => $member->tlpn,
			'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => $member->namaKonsumen,
		  'last_name'     => "",
		  'email'         => $member->email,
		  'phone'         => $member->tlpn,
		  'billing_address'  => $billing_address,
		  'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'hour', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
    	
		if ($result->transaction_status=="settlement") {
			$id = $result->order_id;
			$dataUpdate = array('statusOrder'=>"Dikemas");
			$this->Madmin->update('tbl_order', $dataUpdate, 'idOrder', $id);
			redirect('/');
		}

    }
}