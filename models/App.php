<?php

namespace App;

class App
{
    public $props = [];
    public $view = "";

    public function __construct($method, $request_uri, $script_name)
    {
        $path = parse_url($request_uri, PHP_URL_PATH);
        define("PROJECT_DIRECTORY", dirname($script_name));
        define("BASE_URL", $this->get_base_url());
        $path = substr($path, strlen(PROJECT_DIRECTORY));
        $path = explode("/", $path);
        $path = array_values(array_filter($path));
        $path = empty($path) ? ["actors"] : $path;

        $this->controller = $path[0];
        $this->endpoint = implode("/", $path);
        $this->requestBody = file_get_contents("php://input");
        $this->requestMethod = $method;

        DB::connect();
    }

    function __call($methodFunctionName, $args)
    {
        $pattern = $args[0];
        $closure = $args[1];

        if ($methodFunctionName == strtolower($this->requestMethod) && preg_match($pattern, $this->endpoint, $matches)) {
            $this->queryParams = $matches;
            $closure($this);
            $this->render();
        }
    }

    function processEndpoints($directory)
    {
        global $app;
        $files = array_diff(scandir($directory), ["..", "."]);

        foreach ($files as $file) {
            include("$directory/$file");
        }
    }

    function render()
    {
        extract((array) $this);
        extract($this->props);
        include("views/templates/master_template.php");
    }

    private function get_base_url()
    {
        $s = &$_SERVER;
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : $s['SERVER_NAME']);
        $uri = $protocol . '://' . $host . dirname($_SERVER['SCRIPT_NAME']);
        return rtrim($uri, '/') . '/';
    }
}