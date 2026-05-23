<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TrackOnline
{
    public function handle($request, Closure $next)
    {
        $onlineUsers = Cache::get('online_users', []);

        $key = Auth::check()
            ? 'member_' . Auth::id() . '_' . session()->getId()
            : 'guest_' . session()->getId();

        session(['online_key' => $key]);

        // online realtime
        $onlineUsers[$key] = [
            'type' => Auth::check() ? 'member' : 'guest',
            'time' => time(),
        ];

        // ===== TODAY USERS THEO NGÀY =====
        $todayCacheKey = 'today_users_' . now()->format('Y-m-d');

        $todayUsers = Cache::get($todayCacheKey, []);

        // tránh F5 tăng số
        $todayUsers[$key] = true;

        Cache::put(
            $todayCacheKey,
            $todayUsers,
            now()->endOfDay()
        );

        // remove offline users (>15s)
        foreach ($onlineUsers as $k => $user) {
            if (time() - $user['time'] > 15) {
                unset($onlineUsers[$k]);
            }
        }

        Cache::put(
            'online_users',
            $onlineUsers,
            now()->addMinutes(10)
        );

        return $next($request);
    }
}