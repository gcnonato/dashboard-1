<?php
require_once(__DIR__ . '/../bootstrap.php');

$app = new \Slim\Slim(
    array(
        'view' => new \Slim\Extras\Views\Twig(),
        'templates.path' => '../templates',
        'log.enabled' => true,
        'log.level' => \Slim\Log::DEBUG
    )
);

$app->get('/offer/create', function() use ($app){
    $app->render('offers.html');
});

$app->get('/offer/iqu', function() use ($app){
    $app->render('xml_import.html');
});
$app->get('/offer/importer', function() use ($app){
    $app->render('importer.html');
});

$app->post('/offer/import', function() use ($app){
    $offers = new \DashboardTm\Importers\IquImporter($_FILES['xml']['tmp_name']);
    $parsed = $offers->parseXml();

    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($parsed);
    exit;
});

$app->get('/categories', function() use ($app){
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    echo json_encode(
        \HasOffers\Application::findAllOfferCategories(),
        JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK
    );
    exit;
});

$app->get('/countries', function() use ($app){
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    echo json_encode(
        \HasOffers\Application::findAllCountries(),
        JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK
    );
    exit;
});

$app->run();
?>