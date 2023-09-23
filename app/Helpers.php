<?php

use App\Models\User;
use Carbon\Carbon;

if (!function_exists('asset_dir')) {
    function asset_dir($path, $secure = null)
    {
        $url = config('app.asset_url') . $path;

        // if ($secure) {
        //     str_replace(['http://', 'https://', $url]);
        // }

        return $url;
    }
}

if (!function_exists('media')) {
    function media($path, $secure = null)
    {
        $url = config('app.media_url') . $path;

        // if ($secure) {
        //     str_replace(['http://', 'https://', $url]);
        // }

        return $url;
    }
}

if (!function_exists('getUniqueFileName')) {
    /**
     * get unique file name by length
     *
     * @param int $length
     * @return string
     *
     */
    function getUniqueFileName(int $length = 24): string
    {
        return substr(sha1(microtime()), 0, $length);
    }
}

if (!function_exists('getUniquePrefix')) {
    /**
     * get unique prefix which can use letter
     *
     * @return string
     *
     */
    function getUniquePrefix(): string
    {
        $characters       = "ABCDEFGHIJKLMNPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < 1; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('generateRandomString')) {
    /**
     * generate the random string
     *
     * @param int $length
     * @return string
     *
     */
    function generateRandomString(int $length = 15): string
    {
        $characters       = '0123456789@#&!abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('makeDir')) {
    /**
     * make new directory for us
     *
     * @param string $path
     * @param bool $isPermission
     * @return bool
     *
     */
    function makeDir(string $path, bool $isPermission = false): bool
    {
        if (!file_exists($path)) {
            mkdir($path, 0775, true);
            if ($isPermission) {
                chmod($path, 0775);
            }
        }

        return true;
    }
}

if (!function_exists('removeFile')) {
    /**
     * remove file from givan path
     *
     * @param string $path
     * @return boolean
     *
     */
    function removeFile(string $path): bool
    {
        if (file_exists($path)) {
            return unlink($path);
        }
    }
}

if (!function_exists('getRandomAdmin')) {
    /**
     * get random admin user for user ticket
     *
     * @return boolean
     *
     */
    function getRandomAdmin(): int
    {
        return User::where('role_id', "1")->inRandomOrder()->first()->id;
    }
}

if (!function_exists('getTimeDiff')) {
    /**
     * get time diff
     *
     * @param string $datetime
     * @return void
     *
     */
    function getTimeDiff($datetime)
    {
        return Carbon::parse($datetime)->format("h:i A");
    }
}