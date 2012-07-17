<?php

header('P3P: CP="CAO PSA OUR"');

// This is normally where you would move your fields around etc
//var_dump($_FILES[$_GET['id']]['tmp_name']);

?>
<html>
	<head>
		<title>Saving Your Video - StageX</title>
		<?php
		$error = false; // This is where you would do your checks to ensure the file uploaded to your server correctly.

		if($error){ ?>
			<script type="text/javascript">
				parent.finish_upload("<?php echo $_GET['id'] ?>", false, "<?php echo $message ?>");
			</script><?php
		}else{ ?>
			<script type="text/javascript">
				parent.finish_upload("<?php echo $_GET['id'] ?>", true, "Your video has been uploaded and added to your library");
			</script>
		<?php } ?>
	</head>
	<body>
	</body>
</html>