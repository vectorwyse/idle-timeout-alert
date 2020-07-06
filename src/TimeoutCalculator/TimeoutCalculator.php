<?php

namespace Vectorwyse\IdleTimeoutAlert\TimeoutCalculator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TimeoutCalculator
{
    /**
     * Calculates the number of seconds left before session expires.
     *
     * @param \Illuminate\Http\Request  $request
     * @return int
     */
    public static function getSecondsLeft(Request $request)
    {
        $cookie = $request->cookie('laravel_session');
        if (!$cookie) {
            throw new TimeoutCalculatorException('Not logged in');
        }

        $sessionId = Crypt::decryptString($request->cookie('laravel_session'));
        
        switch (config('session.driver')) {
            case 'file':    $checker = new FileSessionChecker($sessionId);  break;
            default:        throw new TimeoutCalculatorException('Session driver not supported');
        }

        $secondsSince = time() - $checker->getLastModified();
        $secondsLeft = config('session.lifetime') * 60 - $secondsSince;
        return $secondsLeft;
    }
}
