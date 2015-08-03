<?php

use Halo\Base\controller;

class ErrorController extends controller {
    public function errorAction(Exception $exception) {
        $code = intval($exception->getCode());
        $desc = $exception->getMessage();
        if ($code == 0) {
            $code = -500;
        } elseif ($code > 0) {
            $code = -$code;
        }

    }

    public function forbiddenAction() {
        $this->inputError(-403, '禁止访问');
    }

    public function invalidTokenAction() {
        $this->inputError(-405, 'invalid token');
    }
}
