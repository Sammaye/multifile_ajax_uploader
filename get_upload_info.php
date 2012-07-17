<?php

$ret = array();

for($i = 0; $i<count($_GET['ids']); $i++){
	$upload_id = $_GET['ids'][$i];

	// This is our magic function. It gets our upload information
	$info = uploadprogress_get_info($upload_id);
//var_dump($info);
	if(!$info){
		// Then this file is done uploading.
	}else{
		$ret[$i] = array('id' => $upload_id, 'file' => $info['filename'], 'uploaded' => $info['bytes_uploaded'], 'total' => $info['bytes_total'],
						'left' => gmdate("H:i:s", $info['est_sec']), 'speed' => convert_size_human($info['speed_average']));
	}
}

echo json_encode($ret);


/**
 * HELPER FUNCTIONS
 */

function convert_size_human($size){
	$unit=array('','KB','MB','GB','TB','PB');
	$byte_size = $size/pow(1024,($i=floor(log($size,1024))));

	if(is_really_int($byte_size)){
		return $byte_size.' '.$unit[$i];
	}else{
		preg_match('/^[0-9]+\.[0-9]{2}/', $byte_size, $matches);
		return $matches[0].' '.$unit[$i];
	}
}

function is_really_int(&$val) {
	$num = (int)$val;
	if ($val==$num) {
		$val=$num;
		return true;
	}
	return false;
}