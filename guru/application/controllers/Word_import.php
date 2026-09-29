<?php
class Word_import extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->lang->load('basic', $this->config->item('language'));
   $this->load->helper('url');
   $this->load->helper('security');
   $this->load->helper('savesoall'); // load helper simpan ke tabel soal
   $this->load->helper('word_import_helper');
   $this->load->model('word_import_model','',TRUE);
   $this->load->model('M_savesoal','savesoal'); 
 }

 function index($limit='0',$cid='0')
 {
  $id_soal2 = isset($_POST['id_mapel']) ? $_POST['id_mapel'] : '';
  $dec = decrypt_url($id_soal2);
  $plain_id = ($dec !== false && $dec !== '') ? $dec : $id_soal2;
  $enc_id = ($dec !== false && $dec !== '') ? $id_soal2 : encrypt_url($id_soal2);

  if (!is_dir('./upload/')) {
    @mkdir('./upload/', 0777, true);
  }
  $config['upload_path']          = './upload/';
  $config['allowed_types']        = 'docx';
  $config['max_size']             = 10000;
  $this->load->library('upload', $config);

  if ( ! $this->upload->do_upload('word_file'))
  {
    $error = array('error' => $this->upload->display_errors());
    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$error['error']." </div>");
    $back_url = base_url('soal/import_soal?idmapel=' . $enc_id);
    if (!headers_sent()) {
      redirect($back_url);
    } else {
      echo "<script>window.location.href='" . $back_url . "';</script>";
    }
    exit;
  }
  else
  {
    $data = array('upload_data' => $this->upload->data());
    $targets = 'upload/';
    $targets = $targets . basename($data['upload_data']['file_name']);
    $Filepath = $targets;               
  }

  $this->savesoal->truncate('savsoft_qbank');
  $this->savesoal->truncate('savsoft_options');
  $this->load->helper('word_import_helper');
  $questions = word_file_import($Filepath);
  $this->word_import_model->import_ques($questions);

  $ex = save_soal($plain_id);
  $this->session->set_flashdata('success', $this->lang->line('data_imported_successfully'));

  $target_url = base_url('soal/lihat_soal?idmapel=' . $enc_id);
  if (!headers_sent()) {
    redirect($target_url);
  } else {
    echo "<script>window.location.href='" . $target_url . "';</script>";
  }
  exit;
 }

}
