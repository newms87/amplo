<?php

require_once('config.php');
require_once('db.php');
require_once('customer.php');

$db = new Db(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$customer = new Customer($db);

$customers = $customer->get();

?>

<table>
	<tbody>
  <?php foreach ($customers as $customer) { ?>
		<tr>
			<td><?= $customer['name']; ?></td>
			<td><?= $customer['phone']; ?></td>
			<td><?= $customer['status']; ?></td>
		</tr>
  <?php } ?>
	</tbody>
</table>
