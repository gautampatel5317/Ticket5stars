<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class UserAuthenticated {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (Auth::check()) {
			// if user end-user take him to his homepage
			if (Auth::user()->is_front == 1) {
				return $next($request);
			} else {
				return redirect('admin');
			}
		}
		return redirect('login');
	}
}
