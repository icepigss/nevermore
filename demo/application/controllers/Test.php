<?php
use Halo\Base\controller;
use Ss\Service\first;

class TestController extends controller {
    public function testAction() {
        $params = $this->getParams(array('name', 'value'));
        $ss = new First();
        $this->inputResult($ss->test());
    }
}
