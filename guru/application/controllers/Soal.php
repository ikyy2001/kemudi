<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soal extends CI_Controller {
	
	function __construct(){
    parent::__construct(); 
    //cek_session(); // untuk cek_sesion login di helper, agar bisa akases conttroler
    $this->load->model('M_login'); 
    $this->load->model('M_soal','soal'); 
    $this->load->model('M_mapel');
    $this->load->model('M_kls_lv_pk','klp'); 
    $this->load->helper(array('fungsi','crud'));  
    date_default_timezone_set('Asia/Jakarta');
    // $error = $db->error()
  }
  function cache($id){
  	$this->output->cache($id); 
  }
  function clear_cache(){
		$this->db->cache_delete_all();
		
    $path = $this->config->item('cache_path');

    $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

    $handle = opendir($cache_path);
    while (($file = readdir($handle))!== FALSE) 
    {
        //Leave the directory protection alone
        if ($file != '.htaccess' && $file != 'index.html')
        {
           @unlink($cache_path.'/'.$file);
        }
    }
    closedir($handle); 
		redirect('admin/', 'refresh');
  }
  
 
//&siswa----------------------------------------------------------	
	function session_kelas(){ return $this->session->userdata('id_kelas');}
	function session_jurusan(){ return $this->session->userdata('id_jurusan');}
	function session_idguru(){ return $this->session->userdata('id_pengawas');}
	
	function daftar_soal(){ //
	//$this->cache(1);
		$data['setting'] = $this->M_login->setting();
		$data['mapel_ujian'] = $this->M_mapel->get_mapel_ujian()->result();
		$data['pk'] = $this->klp->get_pk()->result();
		$data['level'] = $this->klp->get_level()->result();
		$data['konten'] = "soal/v_soal.php";
		
		$this->load->view('admin',$data);
	}
	function get_kelas_by(){
		$data= $this->klp->get_kelas_by($_POST['idlevel'])->result();
		$ops=array("semua","khusus");
		foreach ($data as $kelas) {
			$data2[] = $kelas->id_kelas;
		}
		$cek = array_merge($ops, $data2); 
		echo json_encode($cek);
	}
	function get_siswa_by(){
		$data= $this->klp->get_siswa_by($_POST['idlevel'])->result();
		// $opss=array(
		// 	'id_siswa' =>'semua',
		// 	'nama' =>'semua',
		// );
		foreach ($data as $siswa) {
			$data2[] = $siswa;
		}
		//$cek2 = array_merge($opss, $data2); 
		echo json_encode($data2);
	}
	function v_daftar_soal_json(){
		$data= $this->soal->v_daftar_ujia($this->session_idguru());
		$data2 = array();
		$no=1;
		foreach ($data as $value) {
			//---------------------------------------------------------------
			$kelas = unserialize($value->kelas);
			foreach ($kelas as $key => $value2) :
				$data_kelas[]=  "<small class='label label-success'>".$value2."</small>&nbsp;";
			endforeach;
			$kelas2 = implode(' | ',$data_kelas);
			//---------------------------------------------------------------
			$cek = $this->soal->select_soal_pg2($value->id_mapel)->row_array();
			if ($cek > 0) {
				$status = '<label class="label label-success"> aktif </label>';
			} else {
				$status = '<label class="label label-warning"> Soal Kosong </label>';
			}

			$href = base_url('soal/lihat_soal?idmapel=').encrypt_url($value->id_mapel);
			$href2 = base_url('soal/import_soal?idmapel=').encrypt_url($value->id_mapel);
			//$href3 = base_url('soal/hapus_soal?idmapel=').encrypt_url($value->id_mapel);
			//------------------------------------------------------------------------
			$kumpulData = array();
			$kumpulData[]=$no++;
			$kumpulData[]=$value->nama_mapel;
			$kumpulData[]='<small class="label label-warning">'.$value->jml_soal.'/'.$value->tampil_pg.'</small>&nbsp;<small class="label label-danger">'.$value->bobot_pg.' %</small>&nbsp;<small class="label label-danger">'.$value->opsi.'</small>';
			$kumpulData[]='<small class="label label-warning">'.$value->jml_esai.'/'.$value->tampil_esai.'</small>&nbsp;<small class="label label-danger">'.$value->bobot_esai.' %</small>';
			$kumpulData[]=$kelas2;
			$kumpulData[]=$status;
			$kumpulData[]=$value->nama_guru;
			$kumpulData[]='<a href="'.$href.'" class="btn btn-flat btn-success btn-flat btn-xs"><i class="fa fa-search"></i></a> <a href="'.$href2.'" class="btn btn-info btn-flat btn-xs"><i class="fa fa-upload"></i></a> <button  data-id="'.encrypt_url($value->id_mapel).'" class="btn btn-danger btn-flat btn-xs hapus_banksoal"><i class="fa fa-trash"></i></button>';

			$data2[] = $kumpulData;
		}
		$json_data = array(
			'data' =>$data2
		);
		echo json_encode($json_data);
	}
	function lihat_soal(){
		//$this->cache(1);
		$idmapel = decrypt_url($_GET['idmapel']);
		$data['setting'] = $this->M_login->setting();
		$data['konten'] = "soal/lihat_soal";
		
		$data['select_soal'] = $this->soal->select_soal_pg($idmapel);
		
		$this->load->view('admin',$data);
	}
	function import_soal(){
		//$this->cache(1);
		$idmapel = decrypt_url($_GET['idmapel']);
		$data['setting'] = $this->M_login->setting();
		$data['konten'] = "soal/import_soal";
		
		$data['mapel'] = $this->soal->select_ujian2($idmapel)->row_array();
		
		$this->load->view('admin',$data);
	}
	function import_excel(){
		$autoload_path = FCPATH . "../vendor/autoload.php";
		if (file_exists($autoload_path)) {
			require_once $autoload_path;
		}
		require_once(FCPATH . "../config/excel_reader2.php");

		if (isset($_FILES['file']['name']) && !empty($_FILES['file']['tmp_name'])) {
			$id_mapel = isset($_POST['id_mapel']) ? $_POST['id_mapel'] : '';
			$dec = decrypt_url($id_mapel);
			if ($dec !== false && $dec !== '') {
				$id_mapel = $dec;
			}
			$file = $_FILES['file']['name'];
			$temp = $_FILES['file']['tmp_name'];
			$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

			if ($ext !== 'xls' && $ext !== 'xlsx') {
				echo "Harap pilih file excel berformat .xls atau .xlsx";
				return;
			}

			$rows = array();
			// Method 1: PhpSpreadsheet for .xlsx and .xls
			if (class_exists('\PhpOffice\PhpSpreadsheet\IOFactory')) {
				try {
					$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($temp);
					$sheet = $spreadsheet->getActiveSheet();
					$sheetData = $sheet->toArray(null, true, true, false);
					if (!empty($sheetData) && count($sheetData) > 1) {
						foreach ($sheetData as $r_idx => $r_val) {
							if ($r_idx === 0) continue; // Skip header
							$rows[] = array(
								'no'      => isset($r_val[0]) ? trim((string)$r_val[0]) : '',
								'soal'    => isset($r_val[1]) ? trim((string)$r_val[1]) : '',
								'pilA'    => isset($r_val[2]) ? trim((string)$r_val[2]) : '',
								'pilB'    => isset($r_val[3]) ? trim((string)$r_val[3]) : '',
								'pilC'    => isset($r_val[4]) ? trim((string)$r_val[4]) : '',
								'pilD'    => isset($r_val[5]) ? trim((string)$r_val[5]) : '',
								'pilE'    => isset($r_val[6]) ? trim((string)$r_val[6]) : '',
								'jawaban' => isset($r_val[7]) ? strtoupper(trim((string)$r_val[7])) : '',
								'jenis'   => isset($r_val[8]) ? trim((string)$r_val[8]) : '1',
								'file1'   => isset($r_val[9]) ? trim((string)$r_val[9]) : '',
								'file2'   => isset($r_val[10]) ? trim((string)$r_val[10]) : '',
								'fileA'   => isset($r_val[11]) ? trim((string)$r_val[11]) : '',
								'fileB'   => isset($r_val[12]) ? trim((string)$r_val[12]) : '',
								'fileC'   => isset($r_val[13]) ? trim((string)$r_val[13]) : '',
								'fileD'   => isset($r_val[14]) ? trim((string)$r_val[14]) : '',
								'fileE'   => isset($r_val[15]) ? trim((string)$r_val[15]) : '',
							);
						}
					}
				} catch (Exception $e) {
					// Fallback below
				}
			}

			// Method 2: Spreadsheet_Excel_Reader fallback for .xls
			if (empty($rows) && $ext === 'xls') {
				error_reporting(0);
				$data = new Spreadsheet_Excel_Reader($temp);
				$hasildata = $data->rowcount(0);
				for ($i = 2; $i <= $hasildata; $i++) {
					$rows[] = array(
						'no'      => trim((string)$data->val($i, 1)),
						'soal'    => trim((string)$data->val($i, 2)),
						'pilA'    => trim((string)$data->val($i, 3)),
						'pilB'    => trim((string)$data->val($i, 4)),
						'pilC'    => trim((string)$data->val($i, 5)),
						'pilD'    => trim((string)$data->val($i, 6)),
						'pilE'    => trim((string)$data->val($i, 7)),
						'jawaban' => strtoupper(trim((string)$data->val($i, 8))),
						'jenis'   => trim((string)$data->val($i, 9)),
						'file1'   => trim((string)$data->val($i, 10)),
						'file2'   => trim((string)$data->val($i, 11)),
						'fileA'   => trim((string)$data->val($i, 12)),
						'fileB'   => trim((string)$data->val($i, 13)),
						'fileC'   => trim((string)$data->val($i, 14)),
						'fileD'   => trim((string)$data->val($i, 15)),
						'fileE'   => trim((string)$data->val($i, 16)),
					);
				}
			}

			if (empty($rows)) {
				echo "Gagal membaca isi file excel atau file excel kosong!";
				return;
			}

			$sukses = 0;
			$gagal = 0;
			
			$this->db->delete('soal', array('id_mapel' => $id_mapel));
			$this->db->delete('file_pendukung', array('id_mapel' => $id_mapel));
			
			foreach ($rows as $idx => $r) {
				$nomor_soal = !empty($r['no']) ? $r['no'] : ($idx + 1);
				$soal = $r['soal'];
				$pilA = $r['pilA'];
				$pilB = $r['pilB'];
				$pilC = $r['pilC'];
				$pilD = $r['pilD'];
				$pilE = $r['pilE'];
				$jawaban = strtoupper($r['jawaban']);
				$jenis = !empty($r['jenis']) ? $r['jenis'] : '1';
				$file1 = $r['file1'];
				$file2 = $r['file2'];
				$fileA = $r['fileA'];
				$fileB = $r['fileB'];
				$fileC = $r['fileC'];
				$fileD = $r['fileD'];
				$fileE = $r['fileE'];
				
				if (!empty($soal)) {
					$insert_data = array(
						'id_mapel' => $id_mapel,
						'nomor'    => $nomor_soal,
						'soal'     => $soal,
						'pilA'     => $pilA,
						'pilB'     => $pilB,
						'pilC'     => $pilC,
						'pilD'     => $pilD,
						'pilE'     => $pilE,
						'jawaban'  => $jawaban,
						'jenis'    => $jenis,
						'file'     => $file1,
						'file1'    => $file2,
						'fileA'    => $fileA,
						'fileB'    => $fileB,
						'fileC'    => $fileC,
						'fileD'    => $fileD,
						'fileE'    => $fileE
					);
					$exec = $this->db->insert('soal', $insert_data);
					if ($exec) {
						$sukses++;
						$files = array($file1, $file2, $fileA, $fileB, $fileC, $fileD, $fileE);
						foreach ($files as $f) {
							if (!empty($f)) {
								$this->db->insert('file_pendukung', array('nama_file' => $f, 'id_mapel' => $id_mapel));
							}
						}
					} else {
						$gagal++;
					}
				} else {
					$gagal++;
				}
			}
			$this->clear_cache();
			$total = count($rows);
			echo "Berhasil: $sukses | Gagal: $gagal | Total: $total";
		} else {
			echo "File tidak ditemukan!";
		}
	}
	function import_file(){
		if (isset($_FILES['zip_file']['name'])) {
			$file_name = $_FILES['zip_file']['name'];
			$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$allowed_ext_program = array('php','phtml','php3','php4','php5','php7','phps','js','htaccess');
			if ($ext == 'zip') {
				$path = FCPATH . '../files/';
				if (!is_dir($path)) {
					@mkdir($path, 0777, true);
				}
				$location = $path . $file_name;
				if (move_uploaded_file($_FILES['zip_file']['tmp_name'], $location)) {
					$zip = new ZipArchive;
					if ($zip->open($location) === TRUE) {
						$cekno = 0;
						for ($i = 0; $i < $zip->numFiles; $i++) {
							$file_ext = strtolower(pathinfo($zip->getNameIndex($i), PATHINFO_EXTENSION));
							if (in_array($file_ext, $allowed_ext_program)) {
								$cekno++;
							}
						}
						if ($cekno > 0) {
							@unlink($location);
							echo 'BAHAYA';
						} else {
							$zip->extractTo($path);
							$zip->close();
							@unlink($location);
							echo 'OK';
						}
					} else {
						echo 'Gagal membuka file ZIP';
					}
				} else {
					echo 'Gagal mengunggah file';
				}
			} else {
				echo 'Harap unggah file arsip berformat .zip';
			}
		} else {
			echo 'File tidak ditemukan';
		}
	}
	function hapus_soal_id(){
		$id = $_POST['id'];
		$soal = $this->soal->select_soal_id($id);
		foreach ($soal as $value) {
			$file = '../files/'.$value->file;
			$file1 = '../files/'.$value->file1;
			$fileA = '../files/'.$value->fileA;
			$fileB = '../files/'.$value->fileB;
			$fileC = '../files/'.$value->fileC;
			$fileD = '../files/'.$value->fileD;
			$fileE = '../files/'.$value->fileE;

			unlink($file);
			unlink($file1);
			unlink($fileA);
			unlink($fileB);
			unlink($fileC);
			unlink($fileD);
			unlink($fileE);
			
		}
		$where = array(
			'id_soal'=>$id
		);
		
		// if (file_exists('../files/15905903563.png')){
		// 	unlink('../files/15905903563.png');
		// }
		// else{
		// 	echo"tidak ada";
		// }
		$ex = Hapus_data($where,'soal');
		if($ex == true){ echo 1; }else{ echo 0; }
		$this->clear_cache();
	}
	function hapus_banksoal_id(){

		$idmapel = decrypt_url($_POST['id']);
		//echo $id;
		$soal = $this->soal->select_soal_pg2($idmapel)->result();
		foreach ($soal as $value) {
			//looping untuk hapus gambar file pendukung
			$file = '../files/'.$value->file;
			$file1 = '../files/'.$value->file1;
			$fileA = '../files/'.$value->fileA;
			$fileB = '../files/'.$value->fileB;
			$fileC = '../files/'.$value->fileC;
			$fileD = '../files/'.$value->fileD;
			$fileE = '../files/'.$value->fileE;

			unlink($file);
			unlink($file1);
			unlink($fileA);
			unlink($fileB);
			unlink($fileC);
			unlink($fileD);
			unlink($fileE);
		}
		//print_r($aa);
		$where = array(
			'id_mapel'=>$idmapel
		);
		$ex = Hapus_data($where,'soal');
		$ex1 = Hapus_data($where,'mapel');
		$ex2 = Hapus_data($where,'file_pendukung');
		if($ex == true and $ex1 == true){ echo 1; }else{ echo 0; }
		$this->clear_cache();
	}
	
	
}
