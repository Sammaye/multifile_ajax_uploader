<html>
	<head><title>Example uploader</title></head>

	<link href="/css/main.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/video_uploader.js"></script>
	<script type="text/javascript">
	$(function(){

		// Add a new upload form
		add_upload();

		$(document).on('change', '.upload_item input[type=file]', function(event){

			reset_bar_message($(this).parents('.upload_item'));

			if(check_upload($(this).parents('.upload_item').data().id)){
				$(this).parents('.upload_item').find('.uploadForm').hide();
				$(this).parents('.upload_item').find('.uploading_pane').show();
				$(this).parents('form').submit();
				add_upload();
			}else{
				alert('The file you selected did not match our requirements. Please try a different file.');
			}
		});

		$(document).on('click', '.upload_item .uploadBar .cancel', function(event){
			event.preventDefault();
			stop_upload($(this).parents('.upload_item').data().id);
		});

		$(document).on('click', '.upload_item .form_top .remove a', function(event){
			event.preventDefault();
			remove_upload($(this).parents('.upload_item').data().id);
		});

		$(document).on('click', '.upload_item .bar_summary .close', function(event){
			event.preventDefault();
			reset_bar_message($(this).parents('.upload_item'));
		});
	});
	</script>
	<div class="container_16 upload_video_body">
		<div class="upload_container">
			<div id="uploadForm_container-outer"></div>
			<div id="u_iframe_container" class="u_iframe_container"></div>
		</div>
	</div>
</html>