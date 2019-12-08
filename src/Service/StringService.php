<?php

namespace App\Service;

class StringService {
    public function getToken(int $length = 32):string{
        return bin2hex(random_bytes($length / 2));
    }
}