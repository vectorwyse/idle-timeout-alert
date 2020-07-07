<?php

namespace Vectorwyse\IdleTimeoutAlert\TimeoutCalculator;

use Illuminate\Support\Facades\DB;

class DatabaseSessionChecker extends SessionChecker
{
    public function getLastModified()
    {
        $session = DB::table('sessions')->where('id', $this->sessionId)->first();
        if (!$session) {
            throw new TimeoutCalculatorException('Session not found');
        }

        return $session->last_activity;
    }
}
