<?php
namespace Halo\Data;

class PreDao {
    private $adapter;
    private $_config;
    private $_table;

    public function __CONSTRUCT($adapter) {
        $this->_config = \Yaf_Registry::get('config');
        $this->adapter = $adapter;
    }
    
    public function getDb() {
        $table = $this->adapter->getTable();
        $dbFlg = $this->adapter->getDatabase();
        $host = $this->_config['db'][$dbFlg]['host'];
        $port = $this->_config['db'][$dbFlg]['port'];
        $name = $this->_config['db'][$dbFlg]['name'];
        $user = $this->_config['db'][$dbFlg]['user'];
        $pass = $this->_config['db'][$dbFlg]['pass'];
        $this->_table = $table;

        $dsn = "mysql:host=$host;port=$port;dbname=$name";
        $db = new \PDO($dsn, $user, $pass);
        return $db;
    }

    public function getReadQuery($condition, $field, $pager, $sorter) {
        $whereStr = '';
        $fieldStr = '*';
        $pagerStr = '';
        $sorterStr = '';

        if ($field) {
            $fieldStr = implode(', ', $field);
        }

        if ($pager) {
            $page = $pager['page'];
            $pageSize = $pager['page_size'];
            $pagerStr = "limit $page, $pageSize ";
        }

        $whereStr = $this->getWheres($condition);

        if ($sorter) {
            foreach ($sorter as $row) {
                $str = $row['col'].' '.$row['type'].', ';
                $sorterStr .=$str;
            }
            $sorterStr = 'order by '.substr($sorterStr, 0, strlen($sorterStr)-2);
        }

        $query = "select $fieldStr from $this->_table $whereStr $pagerStr $sorterStr";
        return $query;
    }

    public function getWheres($condition) {
        $whereStr = '';
        if ($condition) {
            foreach ($condition as $col => $row) {
                if (is_array($row)) {
                    if ($row['op'] == 'between') {
                        $str = $col.' between '. $row['value1'].' and '. $row['value2'].' and ';
                    } elseif (preg_match('/in/', $row['op'])) {
                        $str = $col.' '.$row['op'].' ('.implode(',', $row['value']).') '.' and ';
                    } else {
                        $str = $col.' '.$row['op'].' '.$row['value']. 'and ';
                    }
                } else {
                    $str = $col.' = '.$row.' and ';
                }
                $whereStr .=$str;
            }
            $whereStr = 'where '.substr($whereStr, 0, strlen($whereStr)-4);
        }
        return $whereStr;
    }
}
