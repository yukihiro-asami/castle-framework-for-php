<?php
namespace castle;
function secret_box_key_generator() : string
{
    return _base64_encode_url_safe(
        sodium_crypto_secretbox_keygen()
    );
}