<?php

function xml_attribute($object, $attribute)
{
    if(isset($object[$attribute]))
        return (string) $object[$attribute];
}

if ( ! function_exists('word_file_import')){
    function word_file_import($Filepath){
        $dir = rtrim(dirname($Filepath), '/\\');
        $target_dir = ($dir !== '' && $dir !== '.' && $dir !== '/') ? $dir . '/' : "upload/";
        if (!is_dir($target_dir)) {
            @mkdir($target_dir, 0777, true);
        }

        $info = pathinfo($Filepath);
        $new_name = $info['filename'] . '.Zip'; 
        $new_name_path = $target_dir . $new_name;
        if (!@rename($Filepath, $new_name_path)) {
            @copy($Filepath, $new_name_path);
        }

        $zip = new ZipArchive;
        if ($zip->open($new_name_path) === TRUE) {
            $zip->extractTo($target_dir);
            $zip->close();
         
            $word_xml = $target_dir . "word/document.xml";
            $word_xml_relational = $target_dir . "word/_rels/document.xml.rels";
            if (!file_exists($word_xml)) {
                return 'failed';
            }

            $content = file_get_contents($word_xml);
            $content = htmlentities(strip_tags($content, "<a:blip>"));

            $relation_image = array();
            if (file_exists($word_xml_relational)) {
                $xml = simplexml_load_file($word_xml_relational);
                $supported_image = array('gif', 'jpg', 'jpeg', 'png');

                if ($xml !== false) {
                    foreach($xml as $key => $qjd){
                        $ext = strtolower(pathinfo((string)$qjd['Target'], PATHINFO_EXTENSION));
                        if (in_array($ext, $supported_image)) {
                            $id = xml_attribute($qjd, 'Id');
                            $target = xml_attribute($qjd, 'Target');
                            $relation_image[$id] = $target;  
                        } 
                    }
                }
            }

            $word_folder = $target_dir . "word";
            $prop_folder = $target_dir . "docProps";
            $relat_folder = $target_dir . "_rels";
            $content_folder = $target_dir . "[Content_Types].xml";
            $custom_xml = $target_dir . "customXml";
            $rand_inc_number = 1;

            foreach($relation_image as $key => $value){
                $rplc_str = '&lt;a:blip r:embed=&quot;'.$key.'&quot; cstate=&quot;print&quot;/&gt;';
                $rplc_str2 = '&lt;a:blip r:embed=&quot;'.$key.'&quot;&gt;&lt;/a:blip&gt;';
                $rplc_str3 = '&lt;a:blip r:embed=&quot;'.$key.'&quot;/&gt;';
                $ext_img2 = strtolower(pathinfo($value, PATHINFO_EXTENSION));
                $ext_img = ($ext_img2 == "jpeg") ? "jpg" : $ext_img2;
                $imagenew_name = time() . $rand_inc_number . "." . $ext_img;
                $old_path = $word_folder . "/" . $value;
                $files_dir = $target_dir . "../../../files/";
                if (!is_dir($files_dir)) {
                    @mkdir($files_dir, 0777, true);
                }
                $new_path = $files_dir . $imagenew_name;
                if (file_exists($old_path)) {
                    @rename($old_path, $new_path);
                }
                $img = $imagenew_name;
                $content = str_replace($rplc_str, $img, $content);
                $content = str_replace($rplc_str2, $img, $content);
                $content = str_replace($rplc_str3, $img, $content);
                $rand_inc_number++;
            }

            rrmdir($word_folder);
            rrmdir($relat_folder);
            rrmdir($prop_folder);
            rrmdir($custom_xml);
            if (file_exists($content_folder)) { @unlink($content_folder); }
            if (file_exists($new_name_path)) { @unlink($new_name_path); }

            $question_split = !empty($_POST['question_split']) ? $_POST['question_split'] : '/Q:[0-9]+\)/';
            $option_split = !empty($_POST['option_split']) ? $_POST['option_split'] : '/[A-Z]:\)/';
            $correct_split = !empty($_POST['correct_split']) ? $_POST['correct_split'] : '/Kunci:/';
            $description_split = !empty($_POST['description_split']) ? $_POST['description_split'] : '/FileQ:/';

            $singlequestion_array = array();
            $expl = array_filter(preg_split($question_split, $content));
            $k = 0;

            foreach($expl as $ekey => $value){	 
                $options = array_values(array_filter(preg_split($option_split, $value)));
                $option_count = count($options);
                $question = "";
                $option = array();

                foreach($options as $key_option => $val_option){
                    if($option_count > 1){
                        if($key_option == 0){
                            $question = $val_option;
                        }else{
                            if($key_option == ($option_count - 1)){
                                if (preg_match($correct_split, $val_option, $match)) {
                                    $correct = array_values(array_filter(preg_split($correct_split, $val_option)));
                                    $option[] = isset($correct[0]) ? $correct[0] : '';
                                    $singlequestion_array[$k]['correct'] = isset($correct[1]) ? trim($correct[1]) : '';
                                } else {
                                    $option[] = $val_option;
                                    $singlequestion_array[$k]['correct'] = "";
                                }
                            } else {
                                $option[] = $val_option;
                            }
                        }
                    } else if($option_count == 1){
                        if (preg_match($correct_split, $val_option, $match)) {
                            $correct = array_values(array_filter(preg_split($correct_split, $val_option)));
                            $question = isset($correct[0]) ? $correct[0] : '';
                            $singlequestion_array[$k]['correct'] = isset($correct[1]) ? trim($correct[1]) : '';
                        } else {
                            $question = $val_option;
                            $singlequestion_array[$k]['correct'] = "";
                        }
                    }
                }

                $q_split = array_values(array_filter(preg_split($description_split, $question)));
                $singlequestion_array[$k]['question'] = isset($q_split[0]) ? $q_split[0] : '';
                $singlequestion_array[$k]['description'] = isset($q_split[1]) ? $q_split[1] : '';
                $singlequestion_array[$k]['option'] = $option;
                $k++;
            } 
          
            return $singlequestion_array;
        } else {
            return 'failed';
        }
    }   
}

function rrmdir($dir) { 
    if (is_dir($dir)) { 
        $objects = scandir($dir); 
        foreach ($objects as $object) { 
            if ($object != "." && $object != "..") { 
                if (filetype($dir . "/" . $object) == "dir") {
                    rrmdir($dir . "/" . $object);
                } else {
                    @unlink($dir . "/" . $object); 
                }
            } 
        } 
        reset($objects); 
        if(basename($dir) != "upload" && basename($dir) != "uploads"){
            @rmdir($dir);
        } 
    }
}
