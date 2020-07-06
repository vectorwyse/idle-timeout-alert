<?php

namespace Vectorwyse\IdleTimeoutAlert\TimeoutCalculator;

abstract class SessionChecker
{
    /**
     * The session id.
     *
     * @var string  $sessionId
     */
    protected $sessionId;

    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    abstract public function getLastModified();
}
