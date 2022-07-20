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
        'cyberghost'      => [
            'cyberghost1'   => '38.132.106.139',
            'cyberghost2'   => '194.187.251.67'
        ],
        'IBM Quad 9'      => [
            'IBM Quad 9'      => '9.9.9.9',
            'IBM Quad 9 #2' => '149.112.112.112'
        ],
        'tech companies'  => [
            'VeriSign'        => '64.6.64.6',
            'Norton'          => '199.85.127.10',
            'FreeDNS'         => '45.33.97.5',
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
        
        // check for empty dig response
        if (empty($response)) {
            $response = '<span class="bg-red">ERROR</span>';
        }

        render(<<<HTML
            <div>
                <span class="px-3 bg-green text-black">$server</span> \t$response
            </div>
        HTML);
    }

    // check for empty command line argument
    if (empty($argv[1])) {
        render('<div class="bg-red text-white">Provide host</div>');
        exit(1);
    }

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

