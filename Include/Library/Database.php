<?php
defined('ZYNK') or die('Good bye bot!');
class Database {
    private static $_oInstance;
    private $_oDB;
    private $_rResource;
    private function __construct(){
        $this->_oDB = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
        mysqli_select_db($this->_oDB, DB_NAME);
        mysqli_query($this->_oDB, "SET NAMES UTF8");
    }
    public static function getInstance()
    {
        if (self::$_oInstance == null)
        {
            self::$_oInstance = new self;
        }
        return self::$_oInstance;

    }

    public function query($sQuery)
    {
        $this->_rResource = mysqli_query($this->_oDB,$sQuery) or die(mysqli_error($this->_oDB));
        return $this;
    }
    public function get($sParam='rows')
    {

        $aReturn = [];
        if ($sParam == 'row')
        {
            $aReturn = mysqli_fetch_assoc($this->_rResource);
        }
        elseif ($sParam == 'rows')
        {
            $row = mysqli_fetch_assoc($this->_rResource);
            do
            {
                if (!empty($row))
                {
                    if (!empty($row))
                    {
                        $aReturn[] = $row;
                    }
                }
            }
            while($row = mysqli_fetch_assoc($this->_rResource));
        }

        return $aReturn;
    }
}