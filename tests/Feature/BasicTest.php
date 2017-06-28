<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Product;

use App\Order;

class BasicTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $this->assertTrue(true);
    // }

//test for creation of new products
    public function testHasNameAndDescription() {
    	$product = new Product();
    	$product->name = "New Product";
    	$product->description = "Product Description";

    	$this->assertTrue($product->save());

    }

    public function testContentofProduct() {
    	$product = new Product();

    	$product->name = "New Product";
    	$product->description = "Product Description";

    	$product->save();
    	$this->assertEquals('New Product', $product->name);

    }

    public function testOrderCreationWithRelationships() {
    	$product = new Product();

    	$product->name = "New Product";
    	$product->description = "Product Description";
    	$product->price = 2.0;
    	$product->save();

    	$order = new Order();
    	$order->product_id = $product->id;
    	$order->user_id= 1;
    	$order->quantity = 2;
    	$order->total = 2*$product->price;

    	$this->assertTrue($order->save());

    }



}
