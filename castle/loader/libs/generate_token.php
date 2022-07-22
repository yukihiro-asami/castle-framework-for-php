<?php
namespace castle;
/**
 * @param string $salt
 * @param int $length
 * @param string $algo
 * @return string
 * @throws \Exception
 */
function generate_token(string $salt = 'z9KapBR85ofNWiRl', int $length = 32, string $algo = 'sha512') : string
{
    return substr(hash($algo, $salt . bin2hex(random_bytes(64))), 0, $length);
};