<?php

namespace Tests\Feature;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    /** @var User Login */
    private $configLogin;
    /** @var User Login Refresh */
    private $userLogin;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->configLogin = [
            'grant_type' => 'password',
            'client_id' => '1',
            'client_secret' => 'JvaFWlNwZ8p8hMCrXgKhQALXYAw1gJHiI20RiVbt',
        ];

        $this->userLogin = array_merge([
            'username' => 'fabio@app2u.co',
            'password' => '123456'
        ], $this->configLogin);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUrlApi()
    {
        $response = $this->post('/oauth/token');
        $response->assertStatus(400);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginApi()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/oauth/token', $this->userLogin);

        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
            ]);
    }

    public function testLoginRefreshTokenApi()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/oauth/token', $this->userLogin);

        $content = json_decode($response->getContent());
        $refreshToken = $content->refresh_token;

        $this->configLogin['grant_type'] = 'refresh_token';
        $this->configLogin['refresh_token'] = $refreshToken;

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/oauth/token', $this->configLogin);

        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
            ]);
    }
}
