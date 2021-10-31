<?php

namespace App\Http\Middleware;

use App\Resource;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Support\Facades\Gate;


class IsAllowed
{
    /**
     * @param $request
     * @param Closure $next
     * @param $resource
     * @return mixed
     */
    public function handle($request, Closure $next, $resource)
    {

        if (Gate::allows($resource, Auth::user()->getUserResources())) {
            return $next($request);
        }

        abort(403, 'Not allowed');

    }
}

