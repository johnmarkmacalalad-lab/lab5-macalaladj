<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller
{
    public function login()
    {
        if ($this->session->has_userdata('user')) {
            redirect('/products');
            exit;
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim((string) ($_POST['username'] ?? ''));
            $password = (string) ($_POST['password'] ?? '');
            $expected_username = getenv('APP_USER') ?: 'admin';
            $expected_hash = getenv('APP_PASSWORD_HASH') ?: password_hash('admin123', PASSWORD_DEFAULT);

            if (hash_equals($expected_username, $username) && password_verify($password, $expected_hash)) {
                session_regenerate_id(true);
                $this->session->set_userdata('user', $username);
                redirect('/products');
                exit;
            }
            $error = 'Invalid username or password.';
        }

        $this->call->view('auth/login', ['error' => $error]);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/login');
        exit;
    }
}