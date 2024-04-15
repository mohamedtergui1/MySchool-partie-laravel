<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    protected $roleName;

    public function __construct($roleName = "admin" )
    {
        $this->roleName = $roleName;
    }

    public function handle($request, Closure $next)
    {
        try {
            $user = Auth::user();
            if (!empty($user)) {
                if ($user->role->name !== $this->roleName) {
                    throw new \Exception('Unauthorized', 401);
                }
            }
            return $next($request);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
        }
    }
}

