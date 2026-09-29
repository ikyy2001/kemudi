<?php
Class word_import_model extends CI_Model
{

function import_ques($question){
	$questioncid = $this->input->post('cid');
	$questiondid = $this->input->post('lid');
	$option_file_delim = !empty($_POST['option_file']) ? $_POST['option_file'] : '/FileO:/';

	foreach($question as $key => $singlequestion){
		if(!empty(trim($singlequestion['question'] ?? ''))){

			$q_text = str_replace('"','&#34;', $singlequestion['question']);
			$q_text = str_replace("‘",'&#39;', $q_text);
			$q_text = str_replace("’",'&#39;', $q_text);
			$q_text = str_replace("â€œ",'&#34;', $q_text);
			$q_text = str_replace("â€˜",'&#39;', $q_text);
			$q_text = str_replace("â€™",'&#39;', $q_text);
			$q_text = str_replace("â€ ",'&#34;', $q_text);
			$q_text = str_replace("'","&#39;", $q_text);
			$q_text = str_replace("\n","<br>", $q_text);

			$raw_desc = isset($singlequestion['description']) ? $singlequestion['description'] : '';
			$description = str_replace('"','&#34;', $raw_desc);
			$description = str_replace("‘",'&#39;', $description);
			$description = str_replace("’",'&#39;', $description);
			$description = str_replace("â€œ",'&#34;', $description);
			$description = str_replace("â€˜",'&#39;', $description);
			$description = str_replace("â€™",'&#39;', $description);
			$description = str_replace("â€ ",'&#34;', $description);
			$description = str_replace("'","&#39;", $description);
			$description = str_replace("\n","<br>", $description);

			$option_count = isset($singlequestion['option']) ? count($singlequestion['option']) : 0;
			$ques_type = "0";
			if($option_count != 0){
				$correct_raw = isset($singlequestion['correct']) ? trim($singlequestion['correct']) : '';
				if($correct_raw !== ""){
					if (strpos($correct_raw, ',') !== false) {
						$ques_type = "1";
					} else {
						$ques_type = "0";
					}
				}
			}

			$ques_type2 = ($ques_type == "1") ? "Multiple Choice Multiple Answer" : "Multiple Choice Single Answer"; 

			$corect_position = array(
				'A' => 0,
				'B' => 1,
				'C' => 2,
				'D' => 3,
				'E' => 4
			);

			$insert_data = array(
				'cid' => $questioncid,
				'lid' => $questiondid,
				'question' => $q_text,
				'description' => $description,
				'question_type' => $ques_type2 
			);
				
			if($this->db->insert('savsoft_qbank', $insert_data)){
				$qid = $this->db->insert_id();
				if(($ques_type == "0" || $ques_type == "1") && !empty($singlequestion['option'])){
					$correct_str = isset($singlequestion['correct']) ? $singlequestion['correct'] : '';
					$correct_op = array_filter(explode(',', $correct_str));
					$correct_option_position = array();

					foreach($correct_op as $v){
						$v_clean = trim(strtoupper($v));
						if (isset($corect_position[$v_clean])) {
							$correct_option_position[] = $corect_position[$v_clean];
						}
					}
				 
					foreach($singlequestion['option'] as $corect_key => $correct_val){
						$split_opt = array_values(array_filter(preg_split($option_file_delim, $correct_val)));
						$opt_text = isset($split_opt[0]) ? $split_opt[0] : $correct_val;
						$opt_desc = '';
						if (isset($split_opt[1])) {
							$opt_desc = str_replace('"','&#34;', $split_opt[1]);
							$opt_desc = str_replace("‘",'&#39;', $opt_desc);
							$opt_desc = str_replace("’",'&#39;', $opt_desc);
							$opt_desc = str_replace("â€œ",'&#34;', $opt_desc);
							$opt_desc = str_replace("â€˜",'&#39;', $opt_desc);
							$opt_desc = str_replace("â€™",'&#39;', $opt_desc);
							$opt_desc = str_replace("â€ ",'&#34;', $opt_desc);
							$opt_desc = str_replace("'","&#39;", $opt_desc);
							$opt_desc = str_replace("\n","<br>", $opt_desc);
						}

						if(in_array((int)$corect_key, $correct_option_position, true)){
							$divideratio = count($correct_option_position);
							$correctoption = ($divideratio > 0) ? (1 / $divideratio) : 1;
						} else {
							$correctoption = 0;
						}										

						$insert_options = array(
							"qid" => $qid,
							"q_option" => $opt_text,
							"score" => $correctoption,
							"q_option_match" => $opt_desc
						);
						$this->db->insert("savsoft_options", $insert_options);
					}
				}
			}
		}
	}
}

}
