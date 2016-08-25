<?php
namespace library;
 
class HTTPResponse {

    public function redirect($url, $interne = true) {
        header("Location: ".($interne ? WWW_ROOT : '').$url);
        exit;
    }

    public function permanentRedirect($url, $interne = true) {
        header('Status: 301 Moved Permanently', false, 301);
        header("Location: ".($interne ? WWW_ROOT : '').$url);
        exit;
    }
}