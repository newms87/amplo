<?php

require_once('config.php');
require_once('db.php');
require_once('customer.php');

$db = new Db(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$result = $db->multiQuery(file_get_contents('install.sql'));

if (!$result) {
	die ("<h2>There was an error during installation</h2><br/><br/>" . $db->getError());
}

$customerDb = new Customer($db);

$customers = require_once('customer_data.php');

foreach ($customers as $customer) {
	$customer_record = [
		'name'   => $customer['name'],
		'phone'  => $customer['phone'],
		'status' => $customer['status'],
	];

	$customer_id = $customerDb->create($customer_record);

	if ($customer_id && !empty($customer['notes'])) {
		foreach ($customer['notes'] as $note) {
			$customerDb->addNote($customer_id, $note);
		}
	}
}

echo "<h2>Installation Successful!</h2>";
