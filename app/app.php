<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/places.php";

    session_start();
    if (empty($_SESSION['cities'])) {
        $_SESSION['cities'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));
    $app->get("/", function() use ($app) {

        return $app['twig']->render('rectangle.html.twig');
        // return "test";
    });


    $app->post("/cities", function() use ($app) {
        // return var_dump($cities);
        $city = new Place($_POST['city']);
        $city->save();

        return $app->redirect('/displayCities');
    });

    $app->get("/displayCities", function() use ($app) {
        return $app['twig']->render('cities.html.twig', array('places' => Place::getAll()));
    });

    return $app;
 ?>
