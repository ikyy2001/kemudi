<?php if (!defined("BASEPATH")) exit("No direct script access allowed");


function save_soal($id) {
  $ci = & get_instance();
  $dec = decrypt_url($id);
  $id_mapel = ($dec !== false && $dec !== '') ? $dec : $id;

  $no = 1;
  $noesai = 1;
  $sqlcek = $ci->db->get('savsoft_qbank')->result();
  if (empty($sqlcek)) {
    return false;
  }

  foreach ($sqlcek as $r) {
    $qid = $r->qid;
    $soal_tanya = $r->question;
    $g_soal = str_replace(" ", "", $r->description ?? '');

    $soal_tanya = str_replace("&amp;lt;", "<", $soal_tanya);
    $soal_tanya = str_replace("&amp;gt;", ">", $soal_tanya);
    $soal_tanya = str_replace("&amp;quot;", '"', $soal_tanya);
    $soal_tanya = str_replace("&#34;", '"', $soal_tanya);
    $soal_tanya = str_replace(" &amp;lt;br&amp;gt;", "<br>", $soal_tanya);
    $soal_tanya = str_replace("&amp;lt;br&amp;gt;", "<br>", $soal_tanya);

    // Fetch options for this question in order
    $options = $ci->db->order_by('oid', 'ASC')->get_where('savsoft_options', array('qid' => $qid))->result_array();

    $opj = array('', '', '', '', '');
    $files = array('', '', '', '', '');
    $kunci = '';
    $alphabet = array('A', 'B', 'C', 'D', 'E');

    $ck_jum = count($options);
    if ($ck_jum > 0) {
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

    $data22 = array(
      'id_mapel' => $id_mapel,
      'nomor' => $nomor_soal,
      'soal' => $soal_tanya,
      'pilA' => $opj[0],
      'pilB' => $opj[1],
      'pilC' => $opj[2],
      'pilD' => $opj[3],
      'pilE' => $opj[4],
      'jawaban' => $kunci,
      'jenis' => $jns,
      'file' => $g_soal,
      'file1' => '',
      'fileA' => $files[0],
      'fileB' => $files[1],
      'fileC' => $files[2],
      'fileD' => $files[3],
      'fileE' => $files[4],
    );

    $ci->savesoal->insert_soal($data22);

    // Insert file_pendukung
    $all_files = array_filter(array_merge(array($g_soal), $files));
    foreach ($all_files as $af) {
      if (!empty($af)) {
        $ci->savesoal->insert_dukung(array('nama_file' => $af, 'id_mapel' => $id_mapel));
      }
    }
  }

  $ci->savesoal->truncate('savsoft_qbank');
  $ci->savesoal->truncate('savsoft_options');
  return true;
}