<?php
require_once __DIR__.'/../config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
function db(): PDO {
    static $pdo;
    if (!$pdo) {
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
        ]);
    }
    return $pdo;
}
function e($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function url($path=''): string { return rtrim(BASE_URL,'/').'/'.ltrim($path,'/'); }
function current_user() { return $_SESSION['user'] ?? null; }
function require_login(): void { if (!current_user()) { header('Location: '.url('login.php')); exit; } }
function flash($message=null) {
    if ($message !== null) { $_SESSION['flash']=$message; return; }
    $m=$_SESSION['flash']??''; unset($_SESSION['flash']); return $m;
}
function csrf_token(): string { if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function verify_csrf(): void { if(!hash_equals($_SESSION['csrf']??'', $_POST['csrf']??'')) { http_response_code(403); exit('Invalid form token. Please go back and try again.'); } }
function money($n): string { return '₦'.number_format((float)$n); }
