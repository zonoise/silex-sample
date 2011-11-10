<?php
require_once __DIR__.'/silex.phar'; 


$app = new Silex\Application(); 
$app['debug'] = true;

//Register Twig Extension
$app->register(new Silex\Provider\TwigServiceProvider(),array(
  'twig.path'           => __DIR__.'/views' ,
  'twig.class_path' => __DIR__.'/vender/Twig/lib'
));

$app->get('/', function() use($app) { 
  return 'top'; 
}); 

$app->get('/hello/{name}', function($name) use($app) { 
  return 'Hello '.$app->escape($name); 
}); 

#about page (static html )
$app->get('/about', function() use($app) { 
  return  $app['twig']->render('about.twig'); 
}); 


$app->error(function (\Exception $e, $code) use ($app) {
  return 'We are sorry, but something went terribly wrong.'
  . $code
   . '</pre>' . $app['twig']. '</pre>' ;
});

$app->run(); 
?>
