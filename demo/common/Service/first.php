<?php
namespace Ss\Service;

use Halo\Data\DAO;
use Ss\Adapter\TestAdapter;

class First {
    public function test() {
        $dao = new DAO(new TestAdapter());
        $rows = $dao->read(array(), array(), array(), array(array('col' => 'id', 'type' =>
                        'DESC')));
        return $rows;
    }
}
