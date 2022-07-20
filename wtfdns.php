<?php
    require_once __DIR__.'/vendor/autoload.php';
	  use function Termwind\render;

    $dnsList = [
        'cloudflare'      => [
            'cloudflare1' => '1.1.1.1',
            'cloudflare2' => '1.0.0.1',
        ],
        'opendns'         => [
            'opendns1'    => '208.67.222.222',
            'opendns2'    => '208.67.220.220',
        ],
        'google'          => [
            'google1'     => '8.8.8.8',
            'google2'     => '8.8.4.4',      
        ],
        'tech companies'  => [
            'VeriSign'        => '64.6.64.6',
            'IBM Quad 9'      => '9.9.9.9',
            'Norton'          => '199.85.127.10',
        ],
        'regions'         => [
            'Seattle'         => '66.93.87.2',
            'Dallas'          => '64.81.127.2',
            'Washington DC'   => '66.92.159.2',
            'Quebec'          => '50.21.174.18',
        ],
    ];

    function check_domain($domain, $server, $dns_ip) {
        $handle = popen("dig +timeout=1 +short {$domain} @{$dns_ip}|grep -oE '\b([0-9]{1,3}\.){3}[0-9]{1,3}\b'",'r');
        $response = fread($handle, 2096);
        render(<<<HTML
            <div>
                <span class="px-3 bg-green text-black">$server</span> <span>\t$response</span>
            </div>
        HTML);
    }

    // check for command line argument

    render('<div class="p-3 bg-red text-black">WTF DNS?</div>');
    foreach($dnsList as $dns_server => $dns_ip) {
        
        if (is_array($dns_ip)) {
            render(<<<HTML
                <div class="px-1 uppercase bg-cyan text-black">$dns_server</div>
            HTML);
            foreach($dns_ip as $server => $ip) {
                check_domain($argv[1], $server, $ip);
            }
        } else {
            check_domain($argv[1], $dns_server, $dns_ip);
        }
    }

