<?php declare(strict_types=1);

use Nette\Caching\Storages\FileStorage;
use Nette\Database\Connection;
use Nette\Database\Context;
use Nette\Database\Conventions\DiscoveredConventions;
use Nette\Database\Helpers;
use Nette\Database\Structure;

trait ConnectionHelper
{
	private $dsn = 'mysql:host=127.0.0.1;dbname=mt_test';
	private $user = 'travis';
	private $password = 'rejpal';

	public function getConnection(): Connection
	{
		$database = new Connection($this->dsn, $this->user, $this->password);

		if($database->query("SHOW TABLES;")->getRowCount() == 0) {
			Helpers::loadFromFile($database, __DIR__ . '/../../app/sql/structure.sql');
		}

		Helpers::loadFromFile($database, __DIR__ . '/testing_data.sql');

		return $database;
	}

	public function getContext(): Context
	{
		$storage = new FileStorage(TEMP_DIR);
		$connection = $this->getConnection();
		$structure = new Structure($connection, $storage);
		$conventions = new DiscoveredConventions($structure);
		$context = new Context($connection, $structure, $conventions, $storage);

		return $context;
	}
}