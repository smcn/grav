<?php

use Grav\Common\Utils;

// Get subsite name from sub-domain
$environment = isset($_SERVER['HTTP_HOST'])
    ? $_SERVER['HTTP_HOST']
    : (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost');
// Remove port from HTTP_HOST generated $environment
$environment = strtolower(Utils::substrToString($environment, ':'));
$folder = "sites/{$environment}";

if ($environment === 'localhost' || !is_dir(ROOT_DIR . "user/{$folder}")) {
    return [];
}

return [
    'environment' => $environment,
    'streams' => [
        'schemes' => [
            'user' => [ 
				'type' => 'ReadOnlyStream', 
				'prefixes' => [ 
					'' => [
						"user/{$folder}"
					], 
				] 
			], 
			'cache' => [ 
				'type' => 'ReadOnlyStream', 
				'prefixes' => [ 
					'' => ["cache"], 
				] 
			], 
			'plugins' => [ 
				'type' => 'ReadOnlyStream', 
				'prefixes' => [ 
					'' => [
						"user/plugins"
					], 
				] 
			], 
			'themes' => [ 
				'type' => 'ReadOnlyStream', 
				'prefixes' => [ 
					'' => [
						"user/themes"
					], 
				] 
			], 
			'images' => [ 
				'type' => 'ReadOnlyStream', 
				'prefixes' => [ 
					'' => [
						"user/{$folder}/images"
					], 
				] 
			] 
        ]
    ]
];
