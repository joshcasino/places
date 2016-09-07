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

        return "
        <!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Places I have Rectangle!</title>
        </head>
        <body>
            <div class='container'>
                <h1>Places You've Been</h1>
                <p>Enter the places you've been.</p>
                <form action='/cities'>
                    <div class='form-group'>
                      <label for='city'>Enter the city:</label>
                      <input id='city' name='city' class='form-control' type='text'>
                    </div>
                    <button type='submit' class='btn-success'>Create</button>
                </form>
            </div>
        </body>
        </html>";
    });

    $app->get("/cities", function() use ($app) {
        $city = new Place($_GET['city']);
        $city->save();
        $places = $_SESSION['cities'];
        // return var_dump($cities);

        return $app['twig']->render('cities.html.twig', array('places' => $places));
    });

    return $app;
 ?>
