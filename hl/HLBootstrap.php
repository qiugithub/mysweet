<?php
namespace hl;
/**
** @ClassName: HLBootstrap
** @Description:自动加载器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/

class HLBootstrap
{
    /*
    ** 加载器实例
    */
    public static $loader;
    
    /*
    ** 实例化自身
    */
    public static function init()
    {
        if (self::$loader == NULL) {
            self::$loader = new self();
        }
        return self::$loader;
    }
    
    /*
    ** 注册类
    */
    public function __construct() 
    {
        spl_autoload_register(array($this, 'models'));
        spl_autoload_register(array($this, 'controllers'));
        spl_autoload_register(array($this, 'services'));
    }
    
    /*
    ** 加载控制器
    */
    public function controllers($class) 
    {
        $cutRoom = strrpos($class, DIRECTORY_SEPARATOR);
        $classPath = substr($class, 0, $cutRoom);
        $className = substr($class, $cutRoom + 1, strlen($class));
        set_include_path(get_include_path () . PATH_SEPARATOR . ROOT_PATH.$classPath.DIRECTORY_SEPARATOR.'controllers');
        spl_autoload_extensions('.php');
        spl_autoload($className);
    }
    
    public function models($class)
    {
        $class = preg_replace ( '/_model$/ui', '', $class );
        set_include_path ( get_include_path () . PATH_SEPARATOR . '/models/' );
        spl_autoload_extensions ( '.php' );
        spl_autoload ( $class );
    }
    
    public function services($class) 
    {
        $class = preg_replace ( '/_helper$/ui', '', $class );
        set_include_path ( get_include_path () . PATH_SEPARATOR . '/services/' );
        spl_autoload_extensions ( '.php' );
        spl_autoload ( $class );
    }
}
