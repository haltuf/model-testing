<?php declare(strict_types=1);

namespace App\Presenters;

use App\Models\SimpleModel;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

	/** @var SimpleModel @inject */
	public $db;

	public function actionDefault()
	{
		$this->template->products = $this->db->getVisibleProducts();
	}
}
