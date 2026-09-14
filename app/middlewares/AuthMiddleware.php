<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        $session = load_class('session', 'libraries');

        if (!$session->has_userdata('user')) {
            redirect('/login');
            exit;
        }

        return $next();
    }
}