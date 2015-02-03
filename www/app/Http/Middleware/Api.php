<?php namespace FPP\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Api {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		try {

			return $next($request);

		} catch(NotFoundHttpException $e) {


			return response()->json(['error' => 'Not found'], 404);
		}

		return $next($request);
	}

}
