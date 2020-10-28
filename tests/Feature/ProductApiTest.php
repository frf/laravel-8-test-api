<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testResponseIndex()
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testResponseShow()
    {
        $response = $this->get('/api/products/1');
        $response->assertStatus(200);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testSaveProduct()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/api/products', ['name' => 'Macbook', 'category_id' => 3]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created_at' => true,
                'id' => true,
            ]);
    }

}
