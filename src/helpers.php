<?php

if (! function_exists('mix_token')) {
    /**
     * Create mix token.
     *
     * @return string|null
     */
    function mix_token()
    {
        $path = public_path('mix-manifest.json');

        return file_exists($path) ? md5(file_get_contents($path)) : null;
    }
}
