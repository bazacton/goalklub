<?php
/**
 * The template for Sending a Contact Message
 */

	require_once '../../../wp-load.php';
	define('WP_USE_THEMES', false);
	$subject = '';
	$cs_contact_error_msg = '';
	$subject_name = 'Subject';
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = $values;
	}
	if(isset($phone) && $phone <> ''){
		$subject_name = 'Phone';
		 $subject = $phone;
	}
	
	$subjecteEmail = "(" . $bloginfo . ") Contact Form Received";
$global_REMOTE_ADDR = '';
if(function_exist('cs_glob_server')){
    $global_REMOTE_ADDR = cs_glob_server('REMOTE_ADDR');
}
	$message = '
		<table width="100%" border="1">
		  <tr>
			<td width="100"><strong>'.__('Name','goalklub').'</strong></td>
			<td>'.$contact_name.'</td>
		  </tr>
		  <tr>
			<td><strong>'.__('Email','goalklub').'</strong></td>
			<td>'.$contact_email.'</td>
		  </tr>
		  <tr>
			<td><strong>'.$subject_name.':</strong></td>
			<td>'.$subject.'</td>
		  </tr>
		  <tr>
			<td><strong>'.__('Message','goalklub').'</strong></td>
			<td>'.$contact_msg.'</td>
		  </tr>
		  <tr>
			<td><strong>'.__('IP Address','goalklub').'</strong></td>
			<td>'.$global_REMOTE_ADDR.'</td>
		  </tr>
		</table>
		';
	$headers = "From: " . $contact_name . "\r\n";
	$headers .= "Reply-To: " . $contact_email . "\r\n";
	$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
	$headers .= "MIME-Version: 1.0" . "\r\n";
	$attachments = '';
	$mail_check = false;
    if (function_exists('cs_mail')) {
        $mail_check = cs_mail( $cs_contact_email, $subjecteEmail, $message, $headers, $attachments );
    }
	if(	$mail_check ) {
		$json	= array();
		$json['type']    = "success";
		$json['message'] = cs_textarea_filter($cs_contact_succ_msg);
	} else {
		$json['type']    = "error";
		$json['message'] = cs_textarea_filter($cs_contact_error_msg);
	};
	echo json_encode( $json );