<?php

function calcSize($file) {
    $bytes = $file;
    $size = $bytes;

    if ($bytes > 1024) {
        $kb = round($bytes / 1024);

        $size = $kb;

    }

    return $size;
}
