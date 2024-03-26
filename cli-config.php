<?php

// config de doctrine 
require_once "vendor/autoload.php";
session_start();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Twig\Extra\Intl\IntlExtension;


$isDevMode = true;
$proxyDir = null;
$cache = null;
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'mathea',
    'password' => 'plop',
    'dbname' => 'BTS_Mathea',
);
$useSimpleAnnotationReader = false;
$config = ORMSetup::createAttributeMetadataConfiguration(
    array(__DIR__."/src"),
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
 );

$entityManager =  EntityManager::create($dbParams, $config);

//url paramètres
$class = "Controllers\\" .(isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'IndexController');
$target = isset($_GET['t']) ? $_GET['t'] : "index";
$getParams = isset($_GET['c']) ? $_GET['c'] : null;
$postParams = isset($_POST) ? $_POST : null;

if (!array_key_exists('Logged',$_SESSION)){
    $_SESSION['Logged'] = false;
}

if ($class == "Controllers\IndexController" && in_array($target, get_class_methods($class))) // si c = index et qu'on a un t = methode existante de c
{
    $class = new Controllers\IndexController;
} 
else // dans tout les autres cas ou c != index et t n'existe pas alors
{
    $class = new $class;
}

$goTo=false;

$reflection = new \ReflectionClass($class);

$namespaceName=$reflection->getNamespaceName();
foreach ($reflection->getMethods() as $method) {
    
    if ($target == $method->getName()) {
        $attributes = $method->getAttributes(\Controllers\Role::class);
        foreach ($attributes as $attribute) {
            
            if("Controllers\Role"==$attribute->getName()) {
                switch ($attribute->getArguments()[0]) { 
                    case "Anonym" :
                        $goTo = true;
                    
                    case "ADMIN" :
                        if (array_key_exists('Logged',$_SESSION)){
                            if ($_SESSION['Logged']) {
                                $goTo = true;
                            }
                        }
                    
                }
            }
            
        }    
    }

}
$params = array(array(
    "url"=>"https://195.154.118.169/mathea/hockey/",
    "message"=>(isset($_GET["message"])?$_GET['message']:"Message"),
    "get"=>$_GET,
    "post"=>$postParams,
    "session"=>$_SESSION['Logged'],
    "em"=>$entityManager
));

if(array_key_exists('Logged',$_SESSION));
if ($goTo) {
    //$class->$target($params);
}
else {
    $class = new Controllers\UserController();
    $target= "login";
    //$class->$target($params);
}

call_user_func_array([$class, $target],$params);