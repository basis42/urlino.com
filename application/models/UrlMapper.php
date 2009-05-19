<?php

class Default_Model_UrlMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_Url');
        }
        return $this->_dbTable;
    }

    public function save(Default_Model_Url $url)
    {
        $data = array(
            'url'   => $url->getUrl(),
        	'urlkey' => $url->getKey(),
            'created' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $url->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Default_Model_Url $url)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $url->setId($row->id)
                  ->setUrl($row->url)
                  ->setCreated($row->created);
    }

    public function findByKey($key, Default_Model_Url $url)
    {
		
    	$select = $this->getDbTable()->select();
		$select->where('urlkey = ?', $key);
		$result = $this->getDbTable()->fetchAll($select);
		    	
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $url->setId($row->id)
                  ->setUrl($row->url)
                  ->setKey($row->urlkey)
                  ->setCreated($row->created);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Default_Model_Url();
            $entry->setId($row->id)
                  ->setUrl($row->url)
                  ->setCreated($row->created)
                  ->setMapper($this);
            $entries[] = $entry;
        }
        return $entries;
    }
}

?>