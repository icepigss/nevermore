<?php
namespace Halo\Data;

use Halo\Data\PreDao;

class DAO {
    private $model;

    public function __CONSTRUCT($adapter) {
        $this->model = new PreDao($adapter);
    }

    public function read($condition, $field, $pager = array(), $sorter = array()) {
        $db = $this->model->getDb();
        $query = $this->model->getReadQuery($condition, $field, $pager, $sorter);
        $res = $db->query($query);
        $numCount = $res->rowCount();
        $data = array();
        while ($row = $res->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return array('count' => $numCount, 'data' =>$data);
    }
}
