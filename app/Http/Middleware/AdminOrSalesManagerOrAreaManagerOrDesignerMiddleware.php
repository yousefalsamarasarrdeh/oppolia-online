<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOrSalesManagerOrAreaManagerOrDesignerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // تحقق من دور المستخدم
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'Sales manager', 'Area manager', 'designer'])) {
            return $next($request);
        }

        // إعادة التوجيه مع رسالة خطأ إذا لم يكن له الصلاحية
        return redirect('/')->with('error', 'You do not have access to this section.');
    }
}
