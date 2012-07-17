var upload_timer;
var timeout = 10000;
var u_ids = [];

function finish_upload(id, success, message){
	reset_bar_message($("#upload_item_"+id));
	show_bar_message($("#upload_item_"+id), success, message);

	$("#upload_item_"+id).find('.uploadBar .uploadProgInner').css("width", "100%");
	$("#upload_item_"+id).find('.uploadBar .percent_complete').html('100%');
	$("#upload_item_"+id).find('.uploadBar .cancel').hide();

	u_ids.splice(u_ids.indexOf(id), 1);
	if(success){
		$("#upload_item_"+id).find('.uploadBar .message span').html('Completed');
	}else{
		$("#upload_item_"+id).find('.toggle_panel').hide();
		$("#upload_item_"+id).find('.upload_details').hide();
		$("#upload_item_"+id).find('.uploadBar .message span').html('Failed');
		$("#upload_item_"+id).find('.form_top .remove').show();
	}
}

/**
 * Stops an upload
 *
 * @param id
 */
function stop_upload(id){

	var answer = confirm("Are you sure you wish to cancel this upload?"), p_id = "#uploading_pane_"+id;

	// Only remove the upload if it has not completed.
	if (answer && ($(p_id+" .uploadProgInner").css("width") != "100%")){
		// Show Cancel message
		show_bar_message($(p_id).parents('.upload_item'), false, 'The upload was cancelled by the user.');

		$(p_id).parents('.upload_item').find('.uploadForm').remove();

		// Hide parts of the form
		$(p_id).parents('.upload_item').find('.uploadBar,.toggle_panel,.upload_details').hide();
		$("#upload_item_"+id).find('.form_top .remove').show();
		u_ids.splice(u_ids.indexOf(id), 1);
	}else{
		show_bar_message($(p_id).parents('.upload_item'), false, 'An unknown error occurred. The upload could not be stopped.');
	}
}

function remove_upload(id){
	$("#upload_item_"+id).remove();
	u_ids.splice(u_ids.indexOf(id), 1);
}

/**
 * This function runs when a upload is submitted. It checks the
 * file field as best it can for a valid file. TBH there are some things
 * we just have to do AFTER the file has been uploaded to /temp
 *
 * @param id
 * @returns {Boolean}
 */
function check_upload(id){
	var file = $("#"+id).val(), end = file.length, start = end - 5;
	var path_parts = file.split('\\');
	var ext = file.substring(start, end);

	// Is the file a divx extension?
	$("#uploading_pane_"+id+" .file_title span").html(path_parts[path_parts.length-1]);
	$("#uploading_pane_"+id+" .upload_details #video_title_input").val(path_parts[path_parts.length-1]);
	return true;
}

/**
 * This adds a new upload form to the screen
 */
function add_upload(){
	var ts, count;

	// We make a ts as a cache buster for shit browsers cough-Opera-cough
	ts = Math.round(new Date().getTime() / 1000);

	// How many forms already exist?
	count = $(".upload_item").length;

	// Generate the form
	$.get("/video/add_upload", {ts: ts}, function(data){

		// Add to the page
		$("#uploadForm_container-outer").append(data);

		// If this is the first form then add the updater iframe
		//if(count == 0 && $('#uInfo_ifr').length == 0){
			//$("#u_iframe_container").html("<iframe id='uInfo_ifr' src='/video/get_upload_info' name='uInfo_ifr'></iframe>");
		//}

		// Add the upload id to the list of IDs
		var e = $(".upload_item").last().find("input[name=UPLOAD_IDENTIFIER]").val();
		count_ids = u_ids.length;
		u_ids[count_ids] = e;
	});
}

/**
 * This gets the updated status of the uploads
 *
 * @param info
 */
function update_progress(info){

	// Scrolls through the IDs assigning the information.
	for(i = 0; i < info.length; i++){

		// Sometimes uploadprogress can return null for a upload
		if(info[i] != null){
			// Ascertain the IDs for the elements needing change
			var id = "#uploading_pane_"+info[i].id;
			var message_id = "#upload_status_"+info[i].id;

			if(info[i].hasOwnProperty('message')){
				// Calculate how much has been uploaded
				var done = 90;

				// Change the width of the progress bar to match done and set a message for the upload status
				$(id+" .uploadProgInner").css("width", done+"%");
				$(id+" .percent_complete").html(done+"%");

				$(message_id+" span").html(info[i]['message']);
			}else{
				// Calculate how much has been uploaded
				var done = Math.floor(100 * parseInt(info[i].uploaded) / parseInt(info[i].total));

				// Change the width of the progress bar to match done and set a message for the upload status
				$(id+" .uploadProgInner").css("width", done+"%");
				$(id+" .percent_complete").html(done+"%");

				$(message_id+" span").html("Estimated Time Left: "+info[i].left+" at "+info[i].speed+"ps");
			}
		}
	}
}

function reset_bar_message(selector){
	selector.find('.bar_summary').removeClass('success error').css({ 'display': 'none' }).find('span').html('');
}

function show_bar_message(selector, success, message){
	if(success){
		selector.find('.bar_summary').addClass('success').css({ 'display': 'block' }).find('span').html(message);
	}else{
		selector.find('.bar_summary').addClass('error').css({ 'display': 'block' }).find('span').html(message);
	}
}

function get_upload_progress(){
	$.getJSON('/get_upload_info.php', {ids: u_ids}, function(data){
		update_progress(data);
	});
	upload_timer = setTimeout("get_upload_progress()", timeout);
}

var upload_timer = setTimeout("get_upload_progress()", timeout);