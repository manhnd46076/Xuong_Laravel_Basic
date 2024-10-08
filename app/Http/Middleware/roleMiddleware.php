<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class roleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $userRole = $request->get('role', null);


        // $userRole = $request->query('role'); // Lấy từ URL ví dụ: http://xuong-b3.com/orders?role=khachhang

        // Admin có quyền truy cập tất cả các trang
        if ($userRole === 'admin') {
            return $next($request);
        }

        // Kiểm tra vai trò dựa trên tham số 'role' được truyền vào
        if ($userRole === $role) {
            return $next($request);
        }
        // Nếu không có quyền truy cập, chuyển hướng tới thông báo lỗi
        return redirect('alert-role');
    }
}
