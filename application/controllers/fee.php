<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fee extends MY_Controller {
	private $harga = 600;
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_fee');
	}
	function index(){
		$data['title'] = APP_NAME.' - Fee';
		$data['action'] = 'fee/search'.$this->_filter();
		$data['btn_export'] = anchor('fee/export'.$this->_filter(),'Export to Pdf',array('class'=>'btn btn-primary btn-sm','target'=>'_blank'));
		$this->table->set_heading('No','Nama','Fee','Jumlah','Total');
		$this->table->set_template(tbl_tmp());
		$result = $this->mdl_fee->get()->result();
		$i=1;
		foreach($result as $r){
			$this->table->add_row(
				$i++,
				$r->fullname,
				number_format($this->harga),
				number_format($r->jumlah),
				number_format($r->jumlah*$this->harga)
			);
		}
		$data['table'] = $this->table->generate();
		$this->lib_general->display('fee',$data);
	}
	function export(){
		require_once "../assets/fpdf/fpdf.php";
		$pdf = new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage('P','A4');
		$pdf->SetTitle("Fee Data Entry AON");
		
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(0,10,'Report Fee Data Entry AON Hewitt',0,0,'C');
		$pdf->Ln(10);
		
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0,5,'Periode Tanggal : '.$this->input->get('date_from').' s/d '.$this->input->get('date_to'),0,0,'C');
		$pdf->Ln(10);
		
		$pdf->SetFont('Arial','B',10);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(10,7,'No',1,0,'C');
		$pdf->Cell(50,7,'Nama Data Entry',1,0,'C');
		$pdf->Cell(30,7,'Harga',1,0,'C');
		$pdf->Cell(30,7,'Jumlah',1,0,'C');
		$pdf->Cell(30,7,'Total',1,0,'C');
		$pdf->Cell(0,7,'TTD',1,0,'C');

		$pdf->Ln(7);

		$pdf->SetFont('Arial','',8);
		$pdf->SetTextColor(0,0,0);
		$i=1;
		$tot_jumlah = 0;
		$result = $this->mdl_fee->get()->result();
		foreach($result as $r){
			$pdf->Cell(10,5,$i,1,0,'C');
			$pdf->Cell(50,5,$r->fullname,1,0,'L');
			$pdf->Cell(30,5,number_format($this->harga),1,0,'R');
			$pdf->Cell(30,5,number_format($r->jumlah),1,0,'R');
			$pdf->Cell(30,5,number_format($r->jumlah*$this->harga),1,0,'R');			
			$pdf->Cell(0,5,($i).". ....................",1,0,($i%2==0?'R':'L'));
			$i++;
			$tot_jumlah += $r->jumlah;
			$pdf->Ln(5);
		}
		$pdf->SetFont('Arial','B',8);
		$pdf->SetTextColor(0,0,0);		
		$pdf->Cell(90,5,'Total',1,0,'C');
		$pdf->Cell(30,5,number_format($tot_jumlah,0,',',','),1,0,'R');
		$pdf->Cell(30,5,number_format($this->harga*$tot_jumlah,0,',',','),1,0,'R');		
		$pdf->Cell(0,5,'',1,0,'R');		
		$pdf->Ln(10);

		$pdf->Cell(0,5,'Jakarta, '.date('d M Y'),0,0,'C');
		$pdf->Ln(5);

		$pdf->Cell(70,5,'Dibuat Oleh',1,0,'C');
		$pdf->Cell(70,5,'Diperiksa Oleh',1,0,'C');
		$pdf->Cell(0,5,'Disetujui Oleh',1,0,'C');
		$pdf->Ln(5);
		
		$pdf->Cell(35,20,'',1,0,'C');
		$pdf->Cell(35,20,'',1,0,'C');
		$pdf->Cell(35,20,'',1,0,'C');
		$pdf->Cell(35,20,'',1,0,'C');
		$pdf->Cell(0,20,'',1,0,'C');

		$pdf->Ln(20);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(35,5,'('.$this->lib_general->get_username($this->session->userdata('user_login')).')','LT',0,'C');
		$pdf->Cell(35,5,'(M. Nasrudin)','TR',0,'C');
		$pdf->Cell(35,5,'(Teguh Santoso)','LTR',0,'C');
		$pdf->Cell(35,5,'(Farida Ambar)','LTR',0,'C');
		$pdf->Cell(0,5,'(Kannadasen)','LTR',0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(70,5,'Human Resources','LBR',0,'C');
		$pdf->Cell(35,5,'Project Head','LBR',0,'C');
		$pdf->Cell(35,5,'Finance & Tax Head','LBR',0,'C');
		$pdf->Cell(0,5,'Director','LBR',0,'C');
		
		$pdf->Output("Fee Data Entry AON","I");	
	}
	function search(){
		$data = array(
			'date_from'=>$this->input->post('date_from')
			,'date_to'=>$this->input->post('date_to')
		);
		redirect('fee'.$this->_filter($data));
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array('date_from'=>0,'date_to'=>0);
		$result = array_diff_key($data,$add);
		foreach($result as $r => $val){			
			if($this->input->get($r)<>''){
				$str .="&$r=".$this->input->get($r);
			}
		}
		if($add<>''){
			foreach($add as $r => $val){
				$str .="&$r=".$val;
			}
		}
		return $str;
	}
}