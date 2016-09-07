<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/places.php";

    session_start();
    if (empty($_SESSION['cities'])) {
        $_SESSION['cities'] = array();
    }

    $app = new Silex\Application();

    $app->get("/", function() {

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

    $app->get("/cities", function() {
        $city = new Place($_GET['city']);
        $city->save();
        $return_string = "<!DOCTYPE html>
                <html>
                <head>
                    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
                    <title>I've been to so many rectangles!</title>
                </head>
                <body>
                    <ul>";
        foreach ($_SESSION['cities'] as $city) {
            $return_string .= "<li>" . $city->getCity() . "</li>";
        }
        $return_string .= "
            </ul>
            </body>
            </html>
            ";

        return $return_string;
    });

    return $app;
 ?>
