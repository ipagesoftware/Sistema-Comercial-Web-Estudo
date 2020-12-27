<?php
 namespace App\Recursos;
/**
 * Session class
 *
 * @author Diógenes Dias - IPAGE Software Software <rafadinix@gmail.com>
 * @version 1.0  <10/2010>
 * web: www.clares.wordpress.com
 * 
 */
Class Session
{
    /**
     * $session = new Session;
     * $session->start();
     * $session->init(TimeLife);
     * $session->setMsg("Hello, ".$session->getId()."." );
     * $session->check();
     * $session->status();
     * $session->destroy();
     */
    private static $instance;    
    private $appName = "scw";
    public $session_message = "A sessão requerida não está ativa";
    /**
     *************************************************************************
    */    
    public function start()
    {
      if(!isset($_SESSION)){
        @session_regenerate_id(true);
        session_start();
      }
    }
    /**
     *************************************************************************
    */
    public function init( $timeLife = null )
    {
        $_SESSION['ACTIVITY_ID' . '_' . $this->appName] = md5( uniqid( time() ) );
        $_SESSION['LAST_ACTIVITY' . '_' . $this->appName] = time();
        if( $timeLife != null )
        {
            $_SESSION['LIFE_TIME' . '_' . $this->appName] = $timeLife;
        }
        else
        {
            $_SESSION['LIFE_TIME' . '_' . $this->appName] = 1800;
        }
    }
    /**
     *************************************************************************
    */      
    public function getLeftTime()
    {
        $minutos = floor( ($_SESSION['LIFE_TIME' . '_' . $this->appName] - (time() - $_SESSION['LAST_ACTIVITY' . '_' . $this->appName]) ) / 60 );
        $segundos = (($_SESSION['LIFE_TIME' . '_' . $this->appName] - (time() - $_SESSION['LAST_ACTIVITY' . '_' . $this->appName]) ) % 60 );
        if( $segundos <= 9 )
        {
            $segundos = "0" . $segundos;
        }
        return "$minutos:$segundos";
    }
    /**
     *************************************************************************
    */  
    public function addNode( $key, $value )
    {      
        $key = strtolower($key);
        $_SESSION['node' . '_' . $this->appName][$key] = $value;
        return $this;
    }
    /**
     *************************************************************************
    */  
    public function getNode( $key )
    { 
        $key = strtolower($key);
        if( isset( $_SESSION['node' . '_' . $this->appName][$key] ) )
        {
            return $_SESSION['node' . '_' . $this->appName][$key];
        }
    }
    /**
     *************************************************************************
    */  
    public function setNode( $key, $value )
    {
        $key = strtolower($key);      
        $this->remNode($key);      
        $_SESSION['node' . '_' . $this->appName][$key] = $value;//IPAGE 
        return $this;
    }  
    /**
     *************************************************************************
    */  
    public function remNode( $key )
    {
        $key = strtolower($key);
        if( isset( $_SESSION['node' . '_' . $this->appName][$key] ) )
        {
            unset( $_SESSION['node' . '_' . $this->appName][$key] );
        }
        return $this;
    }
    /**
     *************************************************************************
    */  
    public function destroyNodes()
    {
        if( isset( $_SESSION['node' . '_' . $this->appName] ) )
        {
            unset( $_SESSION['node' . '_' . $this->appName] );
        }
        return $this;
    }
    /**
     *************************************************************************
    */  
    public function check( $showMessage = null )
    {
        if( !isset( $_SESSION['LAST_ACTIVITY' . '_' . $this->appName] ) || (time() - $_SESSION['LAST_ACTIVITY' . '_' . $this->appName] >= $_SESSION['LIFE_TIME' . '_' . $this->appName]) )
        {
            //$this->destroy();
            return false;
        }
        else
        {
            return true;
        }
    }
    /**
     *************************************************************************
    */  
    public function setMsg( $msg )
    {
        $this->session_message = $msg;
    }
    /**
     *************************************************************************
    */  
    public function getId()
    {
        if( isset( $_SESSION['ACTIVITY_ID' . '_' . $this->appName] ) )
        {
            return $_SESSION['ACTIVITY_ID' . '_' . $this->appName];
        }
        else
        {
            $this->setMsg( "sessão nula" );
            return $this->session_message;
        }
    }
    /**
     *************************************************************************
    */  
    public function status()
    {
        return $this->session_message;
    }
    /**
     *************************************************************************
    */  
    public function destroy()
    {
        @session_destroy();
        if(isset($_SESSION['LAST_ACTIVITY' . '_' . $this->appName])){
          unset($_SESSION['LAST_ACTIVITY' . '_' . $this->appName]);
        }
        //
        if(isset($_SESSION['LIFE_TIME' . '_' . $this->appName])){
          unset( $_SESSION['LIFE_TIME' . '_' . $this->appName]);
        }
        //
        if(isset($_SESSION['ACTIVITY_ID' . '_' . $this->appName])){
            unset($_SESSION['ACTIVITY_ID' . '_' . $this->appName]);
        }
        //
        return false;
    }
    
    /**
     * [getInstance description]
     * @return [type] [description]
     */
    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }
}
