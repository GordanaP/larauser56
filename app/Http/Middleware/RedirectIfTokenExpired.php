<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfTokenExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->activationToken->hasExpired())
        {
            return $this->failedResponse();
        }

        return $next($request);
    }

    /**
     * The response has failed.
     *
     * @return mixed
     */
    protected function failedResponse()
    {
        $response = message('The activation token has expired. Click here to create a new account.', 'error');

        return back()->with($response);
    }
}
