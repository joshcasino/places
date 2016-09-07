<?php
    class Place
    {
        private $city_name;

        function __construct($city_name)
        {
            $this->city_name = $city_name;
        }

        function getCity()
        {
            return $this->city_name;
        }

        function setCity($new_city)
        {
            $this->city_name = $new_city;
        }

        function save()
        {
            array_push($_SESSION['cities'], $this);
        }
    }
 ?>
