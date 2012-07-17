<?php
$ret = array();

for($i = 0; $i<count($_GET['ids']); $i++){
	$upload_id = $_GET['ids'][$i];

	// This is our magic function. It gets our upload information
	$info = uploadprogress_get_info($upload_id);

	if(!$info){
		// Then this file is done uploading.
	}else{
		$ret[$i] = array('id' => $upload_id, 'file' => $info['filename'], 'uploaded' => $info['bytes_uploaded'], 'total' => $info['bytes_total'],
						'left' => gmdate("H:i:s", $info['est_sec']), 'speed' => convert_size_human($info['speed_average']));
	}
}

echo json_encode($ret);