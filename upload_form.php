<div class="upload_item" data-id='<?php echo $u_id ?>' id="upload_item_<?php echo $u_id ?>">

	<div class="uploadForm" id="uploadForm_<?php echo $u_id ?>">
		<form action="http://<?php echo glue::$params['uploadBase'] ?>/video/upload_to_server?id=<?php echo $u_id ?>" target="u_ifr<?php echo $u_id ?>" method="post" enctype="multipart/form-data">
			<a href="javascript: void(0)" class='add_upload'>Click here to Upload a Video
			<input type="hidden" name="UPLOAD_IDENTIFIER" value="<?php echo $u_id ?>" /><input type="file" name="<?php echo $u_id ?>" id="<?php echo $u_id ?>" class='file_upload' /></a>
		</form><iframe name="u_ifr<?php echo $u_id ?>" style="display:none;" id="u_ifr<?php echo $u_id ?>"></iframe>
	</div>

	<div class="uploading_pane" id="uploading_pane_<?php echo $u_id ?>" style='display:none;'>
		<div class='bar_summary'><span></span><div class='close'><a href='#'><?php echo utf8_decode('&#215;') ?></a></div></div>
		<div class='inner_padded'>
			<div class="form_top">
				<h1 class="file_title"><img alt='video' src="/images/videos_small.png"/> <span></span></h1>
				<div class="uploadBar">
					<div class="uploadProgOuter"><div class="uploadProgInner">&nbsp;</div></div>
					<span class="percent_complete">0%</span><a href="#" class="cancel">Cancel</a><div class="clearer"></div>
					<div class="message" id="upload_status_<?php echo $u_id ?>"><span>Connecting to server...</span></div>
				</div>
				<div class='remove'><a href='#'><?php echo utf8_decode('&#215;') ?></a></div>
			<div class='clearer'></div></div>
		</div>
	</div><div class='clearer'></div>
</div>