<?php
require_once __DIR__.'/silex.phar'; 


$app = new Silex\Application(); 

//Register Twig Extension
$app->register(new Silex\Provider\TwigServiceProvider(),array(
  'twig.path'           => __DIR__ . '/../views' ,
  'twig.class_path' => __DIR__ .  '/../vender'
));

$app->get('/hello/{name}', function($name) use($app) { 
  return 'Hello '.$app->escape($name); 
}); 

#about page (static html )
$app->get('/about', function() use($app) { 
  return 'Hello '.$app['twig']->render('about.twig'); 
}); 


$app->error(function (\Exception $e, $code) use ($app) {
  return ('We are sorry, but something went terribly wrong.', $code);
});

$app->run(); 
?>
