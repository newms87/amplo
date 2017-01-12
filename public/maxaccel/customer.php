<?php

class Customer
{
	private $db;

	const
		STATUS_ACTIVE = 'ACTIVE',
		STATUS_INACTIVE = 'INACTIVE',
		STATUS_PENDING = 'PENDING';

	static $statuses = [
		self::STATUS_ACTIVE   => self::STATUS_ACTIVE,
		self::STATUS_INACTIVE => self::STATUS_INACTIVE,
		self::STATUS_PENDING  => self::STATUS_PENDING
	];

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function create($customer)
	{
		if (empty($customer['name'])) {
			$this->error = "Name required.";

			return false;
		}

		if (empty($customer['phone'])) {
			$this->error = "Phone required.";

			return false;
		}

		$customer['phone'] = preg_replace("/[^0-9]/", '', $customer['phone']);

		if (empty($customer['status'])) {
			$this->error = "Name required.";

			return false;
		}

		$customer['date_added'] = date('Y-m-d H:i:s');

		return $this->db->insert('contact_tb', $customer);
	}

	public function addNote($contact_id, $note)
	{
		$record = [
			'contact_id' => $contact_id,
			'timestamp'  => date('Y-m-d H:i:s'),
			'note'       => $note,
		];

		return $this->db->insert('customer_note_tb', $record);
	}

	public function get()
	{
		return (array)$this->db->queryRows("SELECT * FROM contact_tb");
	}
}
