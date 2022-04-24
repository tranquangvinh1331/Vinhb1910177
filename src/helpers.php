<?php

if (! function_exists('redirect')) {
    // Chuyển hướng đến một trang khác
    function redirect($location, array $data = [])
    {
        if (ob_get_level()) {
            ob_end_clean();
        }

        foreach($data as $key => $value) {
            $_SESSION[$key] = $value;
        }

        if (ob_get_level()) {
            ob_end_clean();
        }     
           
        header('Location: ' . $location);
        exit();
    }    
}

if (! function_exists('session_get_once')) {
    // Đọc và xóa một biến trong $_SESSION
    function session_get_once($name, $default = null)
    {
        $value = $default;
        if (isset($_SESSION[$name])) {
            $value = $_SESSION[$name];
            unset($_SESSION[$name]);      
        }
        return $value;
    }
}

if (! function_exists('server_log')) {
	// Log to php built-in server console
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	function server_log(string $content)
	{
		if (PHP_SAPI === 'cli-server') {
			defined('STDOUT') || define('STDOUT', fopen('php://stdout', 'w'));
			fwrite(STDOUT, '[' . date('D M  j H:i:s Y') . ']' . " $content\n");
		}
	}
}
