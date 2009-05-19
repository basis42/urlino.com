<?php
class Default_Model_UrlEvent
{
    protected $_id;
    protected $_created;
    protected $_url_id;
    protected $_mapper;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid url property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid url property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setUrlId($id)
    {
        $this->_url_id = (integer) $id;
        return $this;
    }

    public function getUrlId()
    {
        return $this->_url_id;
    }
    
    public function setCreated($ts)
    {
        $this->_created = $ts;
        return $this;
    }

    public function getCreated()
    {
        return $this->_created;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }

    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Default_Model_UrlEventMapper());
        }
        return $this->_mapper;
    }

    public function save()
    {
        $this->getMapper()->save($this);
    }

    public function find($id)
    {
        $this->getMapper()->find($id, $this);
        return $this;
    }

    public function findByUrlId($url_id)
    {
    	$this->getMapper()->findByUrlId($url_id, $this);
        return $this;
    }

    public function fetchAll()
    {
        return $this->getMapper()->fetchAll();
    }
}

?>