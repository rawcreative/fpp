<?php namespace FPP\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'Illuminate\Foundation\Http\Middleware\VerifyCsrfToken',

	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'FPP\Http\Middleware\Authenticate',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'FPP\Http\Middleware\RedirectIfAuthenticated',

	];


	/**
	 * Handle an incoming HTTP request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function handle($request)
	{

		try
		{
			return $this->sendRequestThroughRouter($request);
		}
		catch (NotFoundHttpException $e) {

			$this->reportException($e);

			if(Str::contains($request->getPathInfo(), '/api/')) {
				return response()->json(['error' => 'Not Found'], 404);
			}

			return $this->renderException($request, $e);
		}
		catch (Exception $e)
		{

			$this->reportException($e);

			return $this->renderException($request, $e);
		}
	}
}
