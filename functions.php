<?php

function dd($debug) {
    echo "<pre>";
    var_dump($debug);
    echo "</pre>";
    exit;
}

function newId($id) {
    return $id + 1;
}