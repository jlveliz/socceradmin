<?php

namespace Futbol\Http\Middleware;

use Closure;

class CORS
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
      $headers = [
          'Access-Control-Allow-Origin' => '*',
          'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
          'Access-Control-Allow-Credentials' => 'true',
          'Access-Control-Max-Age' => '10000',
          'Access-Control-Allow-Headers' => '*'
      ];

      if ($request->getMethod() == "OPTIONS") {
        $response = response('OK', 200);
      }
      else {
        $response = $next($request);
      }

      foreach ($headers as $key => $value)
          $response->header($key, $value);

      return $response;
    }
}
