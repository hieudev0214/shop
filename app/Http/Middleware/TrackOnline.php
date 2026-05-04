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

        $onlineUsers[$key] = [
            'type' => Auth::check() ? 'member' : 'guest',
            'time' => time(),
        ];

        $todayUsers = Cache::get('today_users', []);

$todayKey = date('Y-m-d') . '_' . $key;

$todayUsers[$todayKey] = true;

Cache::put('today_users', $todayUsers, now()->addDay());

        foreach ($onlineUsers as $k => $user) {
            if (time() - $user['time'] > 15) {
                unset($onlineUsers[$k]);
            }
        }

        Cache::put('online_users', $onlineUsers, now()->addMinutes(10));

        return $next($request);
    }
}