multifile_ajax_uploader
=======================

A multi-file AJAX uploader with the ability to start and stop uploads dynamically and individually.

This uploader acts a lot like the Youtube uploader except instead of working over the HTML5 file uploader protocol or Flash it can either work over:

- AJAX (as it is now)
- Or an iframe

For instructions on what you need to complete this repository please visit my blog page about this code here: [PHP Upload Progress bar V2](http://sammaye.wordpress.com/2010/11/16/php-upload-progress-bar-v2/)

You will need:

- PHP 5.2+
- uploadprogess extension (unless you are using PHP 5.4 then you can change the `get_upload_info.php` to get from the users `$_SESSION`)
- To modify the permissions on some folders for uploading (see the uploads directory in this repo)
- Will need to prepare PHP for large uploads. On a local server the uploads have to be in excess of 800meg to actually see a progress since anything smaller can be uploaded in under 5 seconds. To understand how to configure PHP for large file uploads please consult Google or Stackoverflow.