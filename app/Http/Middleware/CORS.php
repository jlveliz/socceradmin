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
      // header('Access-Control-Allow-Origin','*');
      

      // $headers = [
      //     'Access-Control-Allow-Origin' => '*',
      //     'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
      //     'Access-Control-Allow-Credentials' => 'true',
      //     'Access-Control-Max-Age' => '10000',
      //     'Access-Control-Allow-Headers' => '*'
      // ];

      // if ($request->getMethod() == "OPTIONS") {
      //   $response = response('OK', 200);
      // } else {
      //   $response = $next($request);
      // }

      // foreach ($headers as $key => $value)
      //     $response->header($key, $value);

      // return $response;

      
      header("Access-Control-Allow-Origin: *");
        //ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization',
        ];
        if ($request->getMethod() == "OPTIONS"){
            //The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return response()->json('OK',200,$headers);
        }
        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }
        return $response;
    }
}
