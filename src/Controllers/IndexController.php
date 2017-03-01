<?php 

namespace App\Controllers;


use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Api\ControllerProviderInterface;




class IndexController 
{


    public function __construct(Application $app, \Twig_Environment $twig)
    {
        $this->app = $app;
        $this->twig = $twig;
    }


	public function index()
	{	
		$user = new \App\Entities\User();
		
		$user->setName('user1');
		
		// print_r($this->app['orm.em']);

		// exit();
		$this->app['orm.em']->persist($user);
			print_r($user);
		exit();
		$this->app['orm.em']->flush();

		return $this->twig->render('index.html.twig');
	}




	// protected function getFullCtrlPath()
	// {
	// 	$ctrlReflection = new \ReflectionClass($this);

	// 	return $ctrlReflection->getName();
	// }

	// public function connect(Application $app)
	// {	
	// 	$factory = $app['controllers_factory'];
	// 	foreach(self::$routes as $route)
	// 	{
	// 		$factory->$route["method"]($route["route"], $this->getFullCtrlPath() . '::' . $route["action"] );
	// 	}
	// 	return $factory;
	// }	

}