<?php

require __DIR__.'/../vendor/autoload.php';

use KnpU\CodeBattle\Application;

/*
 * Create our application object
 *
 * This configures all of the routes, providers, etc (in the constructor)
 */
$app = new Application(array(
    'debug' => true,
));
/** show all errors! */
ini_set('display_errors', 1);
error_reporting(E_ALL);

/*
 ************* OTHER SETUP ******************
 */

if (!file_exists($app['sqlite_path'])) {
    /** @var \KnpU\CodeBattle\DataFixtures\FixturesManager $fixtures */
    $fixtures = $app['fixtures_manager'];
    $fixtures->resetDatabase();
    $fixtures->populateData($app);
}


/*
 ************* CONTROLLERS ******************
 */

$app->mount('/', new \KnpU\CodeBattle\Controller\DefaultController());
$app->mount('/', new \KnpU\CodeBattle\Controller\UserController());
$app->mount('/', new \KnpU\CodeBattle\Controller\ProgrammerController());

return $app;