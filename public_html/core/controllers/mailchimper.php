<?php

use \DrewM\MailChimp\MailChimp;

function mailchimp($action, $data) {
	if (!isset($action) || !isset($data)) {
		die("error");
	}

	switch ($action) {
		case 'add_to_list':     return mailchimp_add_to_list($data);
		case 'del_from_list':   return mailchimp_del_from_list($data);
	}
}

function mailchimp_add_to_list($data) {
	$MailChimp = new MailChimp(MAILCHIMP_API_KEY);

	$result = $MailChimp->post(
		'lists/' . $data['list_id'] . '/members',
		[
			'email_address' => $data['email'],
			'status'        => $data['status'],
			'merge_fields'  => [
	            'FNAME'     => $data['firstname'],
	            'LNAME'     => $data['lastname'],
	            'MMERGE3'     => $data['token'],           
	        ],
		]
	);

	return $result;
}

function mailchimp_del_from_list($data) {
	$MailChimp = new MailChimp(MAILCHIMP_API_KEY);

	$subscriber_hash = $MailChimp->subscriberHash($data['email']);
	$result = $MailChimp->delete('lists/' . $data['list_id'] . '/members/' . $subscriber_hash);

	return $result;
}
