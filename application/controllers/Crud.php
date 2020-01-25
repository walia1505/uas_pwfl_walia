<?php

class Crud extends CI_Controller
{
	public function __construct()

	{
		parent::__construct();
		$this->load->model('mcrud');
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function index()
	{
		$data = array(
			'l' => $this->mcrud->donut(),
			'p' => $this->mcrud->donut2(),
		);
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('donut', $data);
		$this->load->view('template/footer', $data);
	}

	public function tampil()
	{
		$data = array(
			'isi' => $this->mcrud->retrieve(),
		);
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('tampil_data', $data);
		$this->load->view('template/footer');
	}

	public function tampil2()
	{
		$data = array(
			'isi' => $this->mcrud->retrieve2(),
		);
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('tampil_log', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data = array('judul' => 'Tambah Data');
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('tambah_data', $data);
		$this->load->view('template/footer');
	}

	public function simpan()
	{
		
			$data = array('judul' => 'Tambah Data');
			$this->load->view('tambah_data', $data);
 
			{
			echo "hal tersimpan";

			$data = array(
				'id' => '',
				'nim' => $this->input->post('nim'),
				'nama_mhs' => $this->input->post('nama_mhs'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp')

			);
			$this->mcrud->simpan_data($data);
		}
	}

	public function ubah()
	{

		$id = $this->uri->segment(3);
		$q = $this->mcrud->getRow($id);
		$data = array(
			'judul' => 'Ubah Data',
			'id' 	=> $q->row('id'),
			'nim' => $q->row('nim'),
			'nama_mhs' => $q->row('nama_mhs'),
			'jenis_kelamin' => $q->row('jenis_kelamin'),
			'alamat' => $q->row('alamat'),
			'no_hp' => $q->row('no_hp')
		);

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('update_data', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$this->mcrud->update_data();
	}

	public function view()
	{
		$id = $this->uri->segment(3);
	}

	public function hapus()
	{
		$this->mcrud->hapus_data();
	}

	public function excel()
    {
        // load fungsi model.
        $data['mahasiswa'] = $this->mcrud->retrieve();

        // load plugin PHPExcel mulai.
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
        // load plugin PHPExcel selesai.

        // Panggil class PHPExcel
        $objPHPExcel = new PHPExcel();

        // membuat properties file mulai.
        $objPHPExcel->getProperties()->setCreator("Melati");
        $objPHPExcel->getProperties()->setLastModifiedBy("Melati");
        $objPHPExcel->getProperties()->setTitle("Data Mahasiswa");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");
        // membuat properties file selesai.

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel.
        $style_col = array(
            // Set font nya jadi bold.
            'font' => array('bold' => true),
            'alignment' => array(
                // Set text jadi ditengah secara horizontal (center)
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                // Set text jadi di tengah secara vertical (middle)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                // set border atas, bawah, kanan, dan kiri dengan garis tipis mulai.
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
                // set border atas, bawah, kanan, dan kiri dengan garis tipis selesai.
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel.
        $style_row = array(
            'alignment' => array(
                // Set text jadi ditengah secara horizontal (center)
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                // Set text jadi di tengah secara vertical (middle)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                // set border atas, bawah, kanan, dan kiri dengan garis tipis mulai.
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
                // set border atas, bawah, kanan, dan kiri dengan garis tipis selesai.
            )
        );

        // mengatur sheet yang aktif.
        $objPHPExcel->setActiveSheetIndex(0); // sheet yang pertama = (0).
        // merge cells A1 Sampai H1
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
        // membuat font A1 bold
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        // ukuran huruf A1
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
        // Set text jadi ditengah secara horizontal (center)
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // mengatur nama-nama field mulai.
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Data Mahasiswa');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'No');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'NIM');
        $objPHPExcel->getActiveSheet()->setCellValue('C3', 'Nama');
        $objPHPExcel->getActiveSheet()->setCellValue('D3', 'Jenis Kelamin');
        $objPHPExcel->getActiveSheet()->setCellValue('E3', 'Alamat');
        $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Nomer Hp');
        // mengatur nama-nama field selesai.

        // style kolom mulai.
        $objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        // style kolom selesai.

        // memasukkan data mulai.
        // variabel untuk baris.
        $baris = 4;
        // variabel untuk nomer.
        $x = 1;

        //looping data (mulai)
        foreach ($data['mahasiswa'] as $data) {
            // memanggil data tabel.
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $baris, $x);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $baris, $data['nim']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $baris, $data['nama_mhs']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $baris, $data['jenis_kelamin']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $baris, $data['alamat']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $baris, $data['no_hp']);
            // style row.
            $objPHPExcel->getActiveSheet()->getStyle('A' . $baris)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $baris)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $baris)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $baris)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $baris)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $baris)->applyFromArray($style_row);
            // perulangan
            $x++;
            $baris++;
        }
        //looping data (selesai)
        // memasukkan data (selesai)
        // set lebar kolom otomatis mulai.
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        // set lebar kolom otomatis selesai.
        // Set tinggi semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // membuat nama file excel
        $filename = "Data Mahasiswa " . date('Y-m-d-H-i-s') . ".xlsx";
        // set judul aktif sheet
        $objPHPExcel->getActiveSheet()->setTitle("Data Mahasiswa");

        // proses file excel mulai.
        header("Content-Type: apllication/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
        // proses file excel selesai.
    }
}
