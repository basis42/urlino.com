<?php

class Default_Model_UrlEventMapper
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
            $this->setDbTable('Default_Model_DbTable_UrlEvent');
        }
        return $this->_dbTable;
    }

    public function save(Default_Model_UrlEvent $urlEvent)
    {
        $data = array(
            'url_id'   => $urlEvent->getUrlId(),
            'created' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $urlEvent->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Default_Model_UrlEvent $urlEvent)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $urlEvent->setId($row->id)
                  ->setUrlId($row->url_id)
                  ->setCreated($row->created)
                  ->setMapper($this);
    }

    public function findByUrlId($urlId, Default_Model_UrlEvent $urlEvent)
    {
		
    	$select = $this->getDbTable()->select();
		$select->where('url_id = ?', $key);
		$result = $this->getDbTable()->fetchAll($select);
		    	
        if (0 == count($result)) {
            return;
        }
        foreach ($resultSet as $row) {
            $entry = new Default_Model_UrlEvent();
            $entry->setId($row->id)
                  ->setUrlId($row->url_id)
                  ->setCreated($row->created)
                  ->setMapper($this);
            $entries[] = $entry;
        }
        return entries;
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