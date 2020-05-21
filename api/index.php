<?php

chdir('..');
require_once 'config/config.php';

use builder\IndexPageBuilder;
use entity\IndexPage;

/** @var IndexPage $thisPage */
$thisPage = (new IndexPageBuilder(include('config/db_pdo.php')))->build();

header("Content-type: application/json; charset=utf-8");
echo $thisPage->getSectionAsJson();
