<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class LastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        // $redis = Redis::connection();

        // $key = 'last_seen_' . Auth::id();
        // $value = (new \DateTime())->format("Y-m-d H:i:s");

        // $redis->set($key, $value);

        $user = Auth::user();

        // $user->last_seen = Carbon::now();
        // if($user->update()){
        //     return $next($request);
        // }else{
        //     return $next($request);

        // }
        $expiresAt = Carbon::now()->addSeconds(30); // keep online for 30 seconds
        Cache::put('user-is-online-'.$user->id, true, $expiresAt);

        // last seen
        $user->last_seen = Carbon::now();
        if($user->update()){
             return $next($request);
        }


        return $next($request);

    }
}
