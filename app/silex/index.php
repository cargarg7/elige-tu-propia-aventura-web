<?php

use Symfony\Component\HttpFoundation\Request;

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/Application.php';

$app = \Application::bootstrap();

// Home
$app->get('/', function () use ($app) {
    return $app['twig']->render('layout.html.twig');
})->bind('home');

// View stories
$app->get('/stories', function () use ($app) {
    $request = new \Etpa\UseCases\Story\ViewStoriesRequest();
    $usecase = new \Etpa\UseCases\Story\ViewStoriesUseCase($app['story-repository']);
    $response = $usecase->execute($request);

    return $app['twig']->render('view-stories.html.twig', ['stories' => $response->stories]);
})->bind('read');

// View story
$app->get('/story/{id}', function ($id) use ($app) {
    $request = new \Etpa\UseCases\Story\ViewStoryRequest();
    $request->storyId = $id;

    $response = (new \Etpa\UseCases\Story\ViewStoryUseCase($app['story-repository']))->execute($request);

    return $app['twig']->render('view-story.html.twig', ['story' => $response->story]);
})->bind('story');

// Rate story
$app->get('/story/{storyId}/rating/{rating}', function ($storyId, $rating) use ($app) {
    $usecase = new \Etpa\UseCases\Story\RateStoryUseCase($app['story-repository']);
    $usecase = $app['tx-use-case-factory']->newTransactionalUseCaseFrom($usecase);

    $request = new \Etpa\UseCases\Story\RateStoryRequest();
    $request->storyId = $storyId;
    $request->rating = $rating;

    $response = $usecase->execute($request);
    return $app->redirect($app['url_generator']->generate('story', array('id' => $response->story->getId())));
})->bind('rate-story');

// View page
$app->get('/page/{id}', function ($id) use ($app) {
    $request = new \Etpa\UseCases\Page\ViewPageRequest();
    $request->pageId = $id;

    $pageRepository = $app['em']->getRepository('Etpa\Domain\Page');
    $usecase = new \Etpa\UseCases\Page\ViewPageUseCase($pageRepository);
    $response = $usecase->execute($request);

    return $app['twig']->render('view-page.html.twig', ['page' => $response->page]);
})->bind('page');

$app->get('/signup', function () use ($app) {
    return $app['twig']->render('signup.html.twig');
})->bind('signup');

$app->get('/story/add', function () use ($app) {
    return $app['twig']->render('add-story.html.twig');
})->bind('add-story');

$app->post('/story/add', function (Request $httpRequest) use ($app) {
    $request = new \Etpa\UseCases\Story\CreateStoryRequest();
    $request->title = $httpRequest->get('title');
    $request->description = $httpRequest->get('description');

    $storyRepository = $app['em']->getRepository('Etpa\Domain\Story');
    $usecase = new \Etpa\UseCases\Story\CreateStoryUseCase($storyRepository);
    $response = $usecase->execute($request);

    return $app->redirect('/stories');
});

$app->get('/my-played-stories', function () use ($app) {
    return $app['twig']->render('view-stories.html.twig', ['stories' => []]);
})->bind('my-played-stories');

$app->get('/my-written-stories', function () use ($app) {
        return $app['twig']->render('view-stories.html.twig', ['stories' => []]);
    })->bind('my-written-stories');

$app->get('/dashboard', function () use ($app) {
    $request = new \Etpa\UseCases\User\ViewDashboardRequest();
    $request->userId = 1;

    $userRepository = $app['em']->getRepository('Etpa\Domain\User');
    $usecase = new \Etpa\UseCases\User\ViewDashboardUseCase($userRepository);
    $response = $usecase->execute($request);

    return $app['twig']->render('dashboard.html.twig', ['user' => $response->user]);
})->bind('dashboard');

$app->run();
