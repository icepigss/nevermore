<?php
namespace Halo\Base;

class controller extends \Yaf_Controller_Abstract {
    public function inputResult($res = array()) {
        if ($res) {
            echo json_encode(array('data' => $res, 'code' => 0));
        }
        \Yaf_Dispatcher::getInstance()->autoRender(FALSE);
    }

    public function getParams(array $params) {
        $res = array();
        foreach ($params as $param) {
            $res[$param] = $this->getRequest()->get($param);
        }
        return $res;
    }
}
