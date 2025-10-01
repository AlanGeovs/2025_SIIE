<?php
class PasswordHash
{
    private $itoa64;
    private $iteration_count_log2;
    private $portable_hashes;
    private $random_state;

    public function __construct($iteration_count_log2, $portable_hashes)
    {
        $this->itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $this->iteration_count_log2 = $iteration_count_log2;
        $this->portable_hashes = $portable_hashes;
        $this->random_state = microtime() . uniqid(rand(), TRUE);
    }

    public function CheckPassword($password, $stored_hash)
    {
        $hash = $this->crypt_private($password, $stored_hash);
        if ($hash[0] === '*') {
            $hash = crypt($password, $stored_hash);
        }
        return hash_equals($stored_hash, $hash);
    }

    private function crypt_private($password, $setting)
    {
        $output = '*0';
        if (substr($setting, 0, 3) !== '$P$' && substr($setting, 0, 3) !== '$H$') {
            return $output;
        }

        $count_log2 = strpos($this->itoa64, $setting[3]);
        if ($count_log2 < 7 || $count_log2 > 30) return $output;

        $count = 1 << $count_log2;
        $salt = substr($setting, 4, 8);
        if (strlen($salt) !== 8) return $output;

        $hash = md5($salt . $password, TRUE);
        for ($i = 0; $i < $count; $i++) {
            $hash = md5($hash . $password, TRUE);
        }

        $output = substr($setting, 0, 12);
        $output .= $this->encode64($hash, 16);

        return $output;
    }

    private function encode64($input, $count)
    {
        $output = '';
        $i = 0;
        do {
            $value = ord($input[$i++]);
            $output .= $this->itoa64[$value & 0x3f];
            if ($i < $count) {
                $value |= ord($input[$i]) << 8;
            }
            $output .= $this->itoa64[($value >> 6) & 0x3f];
            if ($i++ >= $count) break;

            if ($i < $count) {
                $value |= ord($input[$i]) << 16;
            }
            $output .= $this->itoa64[($value >> 12) & 0x3f];
            if ($i++ >= $count) break;

            $output .= $this->itoa64[($value >> 18) & 0x3f];
        } while ($i < $count);

        return $output;
    }
}

if (!function_exists('wp_check_password')) {
    function wp_check_password($password, $hash)
    {
        static $wp_hasher;

        if (empty($wp_hasher)) {
            require_once __DIR__ . '/wp-password.php'; // asegura que la clase PasswordHash esté cargada
            $wp_hasher = new PasswordHash(8, true);
        }

        return $wp_hasher->CheckPassword($password, $hash);
    }
}
