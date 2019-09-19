<?php declare(strict_types=1);

use App\Models\SimpleModel;
use Nette\Database\Table\ActiveRow;
use Nette\Utils\ArrayHash;
use Tester\Assert;
use Tester\Environment;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

class SimpleModelTest extends TestCase
{
	use ConnectionHelper;

	public function setUp()
	{
		Environment::lock('database', __DIR__ . '/../tmp');
	}

	public function testClassTypes()
	{
		$model = new SimpleModel($this->getContext());
		Assert::type(SimpleModel::class, $model);
	}

	public function testProductsListing()
	{
		$model = new SimpleModel($this->getContext());

		// --- getProducts()
		$products = $model->getProducts()->order('id ASC')->fetchAll();
		$keys = array_keys($products);
		Assert::count(7, $products);

		Assert::same(1, array_shift($keys));
		Assert::same('Nikon D5300 TEST', array_shift($products)->name);
		Assert::same(2, array_shift($keys));
		Assert::same('Krytka objektivu Nikon TEST', array_shift($products)->name);

		// --- getVisibleProducts()
		$visibleProducts = $model->getVisibleProducts()->order('id ASC')->fetchAll();
		$keys = array_keys($visibleProducts);
		Assert::count(5, $visibleProducts);

		Assert::same(1, array_shift($keys));
		Assert::same('Nikon D5300 TEST', array_shift($visibleProducts)->name);
		Assert::same(3, array_shift($keys));
		Assert::same('Nikon D850 TEST', array_shift($visibleProducts)->name);
	}

	public function testProductReading()
	{
		$model = new SimpleModel($this->getContext());

		// existing
		$product = $model->getProduct(4);
		Assert::type(ActiveRow::class, $product);
		Assert::same(4, $product->id);
		Assert::same('Nikon 200-500 mm f/5,6E ED VR TEST', $product->name);
		Assert::same(29999.00, $product->price);
		Assert::same('nikon-200-500mm-f-5-6e-ed-vr', $product->url);
		Assert::same('Objektivy TEST', $product->category->name);

		// not existing
		$product = $model->getProduct(8);
		Assert::null($product);
	}

	public function testProductCreate()
	{
		$model = new SimpleModel($this->getContext());

		$data = ArrayHash::from([
			'name' => 'Newly created product',
			'price' => 123456.78,
			'url' => 'newly created product',
			'category_id' => 2,
		]);

		$product = $model->createProduct($data);
		Assert::type(ActiveRow::class, $product);
		Assert::same(8, $product->id);

		$product = $model->getProduct(8);
		Assert::same('Newly created product', $product->name);
		Assert::same(123456.78, $product->price);
		Assert::same('newly-created-product', $product->url);
		Assert::same(2, $product->category_id);
	}
}

(new SimpleModelTest())->run();