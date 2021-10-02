<?php

namespace Kerigard\MixToken\Tests;

use Illuminate\Http\Request;
use Orchestra\Testbench\TestCase;
use Kerigard\MixToken\SetMixHeader;

class SetMixTokenTest extends TestCase
{
    /**
     * Test SetMixHeader middleware.
     *
     * @return void
     */
    public function test_header_exists_using_ajax()
    {
        $request = new Request();
        $request->headers->set('X-Requested-With', 'XMLHttpRequest');

        $middleware = new SetMixHeader();
        $response = $middleware->handle($request, function ($req) {
            return $req;
        });

        $this->assertTrue($response->headers->has('X-Mix-Token'));
    }

    /**
     * Test SetMixHeader middleware.
     *
     * @return void
     */
    public function test_header_does_not_exists_without_ajax()
    {
        $request = new Request();

        $middleware = new SetMixHeader();
        $response = $middleware->handle($request, function ($req) {
            return $req;
        });

        $this->assertFalse($response->headers->has('X-Mix-Token'));
    }
}
