<?php
class Word_import extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->lang->load('basic', $this->config->item('language'));
    $this->db->truncate('savsoft_qbank');
    $this->db->truncate('savsoft_options');
    $this->load->helper('word_import_helper');
    $this->load->model('word_import_model','',TRUE);
  }

  function index($limit='0',$cid='0')
  {
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
      $id_soal = !empty($_POST['id_bank_soal']) ? $_POST['id_bank_soal'] : (!empty($_POST['id_mapel']) ? $_POST['id_mapel'] : '');
      $id_lokal = !empty($_POST['id_lokal']) ? rtrim($_POST['id_lokal'], '/') : '';
      $redirect_url = !empty($id_lokal) ? $id_lokal . '/crew/index.php?pg=banksoal&ac=importsoal&id=' . $id_soal : '../index.php?pg=banksoal&ac=importsoal&id=' . $id_soal;
      if (!headers_sent()) {
        header("Location: " . $redirect_url);
      } else {
        echo "<script>window.location.href='" . $redirect_url . "';</script>";
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

    $this->load->helper('word_import_helper');
    $questions = word_file_import($Filepath);
    $this->word_import_model->import_ques($questions);

    $id_soal = !empty($_POST['id_bank_soal']) ? $_POST['id_bank_soal'] : (!empty($_POST['id_mapel']) ? $_POST['id_mapel'] : '');
    $id_lokal = !empty($_POST['id_lokal']) ? rtrim($_POST['id_lokal'], '/') : '';

    // =========================================================================
    // SIMPAN LANGSUNG DARI savsoft_qbank & savsoft_options KE TABEL soal
    // (Agar soal langsung tersimpan tanpa bergantung pada redirect URL HTTP)
    // =========================================================================
    $qbank = $this->db->order_by('qid', 'ASC')->get('savsoft_qbank')->result_array();
    if (!empty($qbank)) {
      $no = 1;
      $noesai = 1;
      $alphabet = array('A', 'B', 'C', 'D', 'E');

      foreach ($qbank as $r) {
        $qid = $r['qid'];
        $soal_tanya = $r['question'];
        $g_soal = str_replace(" ", "", $r['description'] ?? '');

        $soal_tanya = str_replace("&amp;lt;", "<", $soal_tanya);
        $soal_tanya = str_replace("&amp;gt;", ">", $soal_tanya);
        $soal_tanya = str_replace("&amp;quot;", '"', $soal_tanya);
        $soal_tanya = str_replace("&#34;", '"', $soal_tanya);
        $soal_tanya = str_replace(" &amp;lt;br&amp;gt;", "<br>", $soal_tanya);
        $soal_tanya = str_replace("&amp;lt;br&amp;gt;", "<br>", $soal_tanya);

        $options = $this->db->order_by('oid', 'ASC')->get_where('savsoft_options', array('qid' => $qid))->result_array();
        $opj = array('', '', '', '', '');
        $files = array('', '', '', '', '');
        $kunci = '';

        if (count($options) > 0) {
          $jns = '1';
          foreach ($options as $idx => $opt) {
            if ($idx < 5) {
              $text = str_replace(" &ndash;", "-", $opt['q_option']);
              $text = str_replace("&amp;lt;", "<", $text);
              $text = str_replace("&amp;gt;", ">", $text);
              $text = str_replace("&amp;lt;br&amp;gt;", "<br>", $text);
              $opj[$idx] = $text;
              $files[$idx] = str_replace(" ", "", $opt['q_option_match'] ?? '');
              if ($opt['score'] > 0) {
                $kunci = $alphabet[$idx];
              }
            }
          }
        } else {
          $jns = '2'; // Esai
        }

        $nomor_soal = ($jns == '1') ? $no++ : $noesai++;

        $data_soal = array(
          'id_mapel' => $id_soal,
          'nomor'    => $nomor_soal,
          'soal'     => $soal_tanya,
          'pilA'     => $opj[0],
          'pilB'     => $opj[1],
          'pilC'     => $opj[2],
          'pilD'     => $opj[3],
          'pilE'     => $opj[4],
          'jawaban'  => $kunci,
          'jenis'    => $jns,
          'file'     => $g_soal,
          'file1'    => '',
          'fileA'    => $files[0],
          'fileB'    => $files[1],
          'fileC'    => $files[2],
          'fileD'    => $files[3],
          'fileE'    => $files[4],
        );

        $this->db->insert('soal', $data_soal);

        $all_files = array_filter(array_merge(array($g_soal), $files));
        foreach ($all_files as $af) {
          if (!empty($af)) {
            $this->db->insert('file_pendukung', array('nama_file' => $af, 'id_mapel' => $id_soal));
          }
        }
      }

      $this->db->truncate('savsoft_qbank');
      $this->db->truncate('savsoft_options');
    }

    $target_redirect = !empty($id_lokal) ? $id_lokal . '/crew/index.php?pg=banksoal&ac=lihat&id=' . $id_soal : '../index.php?pg=banksoal&ac=lihat&id=' . $id_soal;

    if (!headers_sent()) {
      header('Location: ' . $target_redirect);
    } else {
      echo "<script>window.location.href='" . $target_redirect . "';</script>";
    }
    exit;
  }
}
