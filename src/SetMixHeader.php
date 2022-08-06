<?php

namespace Kerigard\MixToken;

use Closure;
use Illuminate\Http\Request;

class SetMixHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->ajax()) {
            $response->headers->set('X-Mix-Token', mix_token());
        }

        return $response;
    }
}
