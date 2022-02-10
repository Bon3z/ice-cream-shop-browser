<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ConnectionTest extends TestCase
{
    public function test_connection_works()
    {
        $response = $this->get('/');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_http_not_found_when_page_does_not_exist()
    {
        $response = $this->get('/non-existing-page');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
