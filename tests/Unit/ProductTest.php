<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /** @var @var Products */
    private $products;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $product1 = new Product();
        $product1->name = "Fabio";
        $product2 = new Product();
        $product2->name = "Jo";
        $products = new Collection();

        $products->add($product1);
        $products->add($product2);

        $this->products = $products;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testListProducts()
    {
        $this->assertNotCount(0, $this->products);
    }
}
