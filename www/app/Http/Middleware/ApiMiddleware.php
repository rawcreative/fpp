<?php namespace FPP\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;
use League\Fractal\Manager;

class ApiMiddleware {

	protected $manager;


	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$this->manager = new Manager;

		$this->manager->parseIncludes($request->get('include', array()));

		return $next($request);
	}

}
