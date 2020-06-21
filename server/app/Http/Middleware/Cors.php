<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * OptionsCorsResponse middleware - add CORS headers if request method OPTIONS
 */
class Cors
{
    /**
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        /* @var $response Response */
        $response = $next($request);
        if (!$request->isMethod('OPTIONS')) {
            return $response;
        }
        $allow = $response->headers->get('Allow'); // true list of allowed methods
        if (!$allow) {
            return $response;
        }
        $headers = [
            'Access-Control-Allow-Methods' => $allow,
            'Access-Control-Max-Age' => 3600,
            'Access-Control-Allow-Headers' => 'X-Requested-With, Origin, X-Csrftoken, Content-Type, Accept',
        ];
        return $response->withHeaders($headers);
    }
}







//
//namespace App\Http\Middleware;
//
//use Closure;
//
//class Cors
//{
//    /**
//     * Handle an incoming request.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \Closure  $next
//     * @return mixed
//     */
//    public function handle($request, Closure $next)
//    {
////        if ($request->isMethod('OPTIONS')){
////            $response = Response::make();
////        } else {
////            $response = $next($request);
////        }
//
//        return $next($request)
//            ->header('Content-Type', 'application/json')
//            ->header('Access-Control-Request-Method', '*')
//            ->header('Access-Control-Request-Headers', '*')
//            ->header('Access-Control-Allow-Credentials', true)
//            ->header('Origin', '*');
////            ->header('Access-Control-Allow-Origin', '*')
////            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
////            ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
////        dd(123);
////        return $next($request)
////            ->header('Access-Control-Allow-Origin', '*')
////            ->header('Access-Control-Allow-Methods', '*');
////            ->header('Access-Control-Allow-Headers:  Origin'); //Content-Type, X-Auth-Token, Authorization,
//    }
//}
