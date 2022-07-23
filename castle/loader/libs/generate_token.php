<?php
namespace castle;
function generate_token(string $salt = 'z9KapBR85ofNWiRl', int $length = 32, string $algo = 'sha512') : string
{
    try {
        return substr(hash($algo, $salt . bin2hex(random_bytes(64))), 0, $length);
    } catch (\Throwable $t) {
        return '';
    }
}