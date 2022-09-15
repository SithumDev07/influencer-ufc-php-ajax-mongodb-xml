<?php

require "vendor/autoload.php";

$DBClient = new \MongoDB\Client("mongodb://localhost:27017");

$db = $DBClient->selectDatabase("influencer");