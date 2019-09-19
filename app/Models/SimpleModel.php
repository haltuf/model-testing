<?php declare(strict_types=1);

namespace App\Models;

use Nette\Database\Context;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Nette\Utils\Strings;

class SimpleModel {

	/** @var Context */
	private $db;

	public function __construct(Context $db)
	{
		$this->db = $db;
	}

	public function getProducts(): Selection
	{
		return $this->db->table('product');
	}

	public function getVisibleProducts(): Selection
	{
		return $this->db->table('product')->where('category.visible', 1);
	}

	public function getProduct($id): ?ActiveRow
	{
		return $this->db->table('product')->get($id);
	}

	public function createProduct(iterable $data)
	{
		$sql = [
			'name' => (string) $data->name,
			'price' => (float) $data->price,
			'category_id' => (int) $data->category_id,
			'url' => Strings::webalize($data->url),
		];

		return $this->db->table('product')->insert($sql);
	}
}