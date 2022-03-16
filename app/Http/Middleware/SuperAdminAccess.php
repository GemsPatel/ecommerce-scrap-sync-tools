<?php
	namespace App\Http\Middleware;
	
	use Closure;
	use Auth;
	
	class SuperAdminAccess
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
			if(Auth::user()->category == 'Super Admin')
			{
				return redirect()->intended('superadmin/manage-admins');	
			}
			else
			{
				//abort(403);
				return $next($request);
			}
		}
	}