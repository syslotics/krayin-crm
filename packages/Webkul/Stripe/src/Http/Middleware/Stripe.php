<?php

namespace Webkul\Stripe\Http\Middleware;

use Closure;

class Stripe
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        abort_if(! core()->getConfigData('general.stripe.active'), 404);

        return $next($request);
    }
}
