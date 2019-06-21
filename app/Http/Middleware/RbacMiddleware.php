<?php

namespace App\Http\Middleware;

use Closure;

class RbacMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = session('RolesUser');
        $roles_key = array_keys($roles);
        $actions = explode('\\', \Route::current()->getActionName());
        //或$actions=explode('\\', \Route::currentRouteAction());
        $modelName = $actions[count($actions) - 2] == 'Controllers' ? null : $actions[count($actions) - 2];
        $func = explode('@', $actions[count($actions) - 1]);
        $controllerName = strtolower($func[0]);
        $actionName = strtolower($func[1]);
        if (!in_array($controllerName, $roles_key)) {
            return redirect('/admin/rbac');
        }
        if (!in_array($actionName, $roles[$controllerName])) {
            return redirect('/admin/rbac');
        }
        return $next($request);
    }
}
