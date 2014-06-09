<?php

use Etpa\Infrastructure\Persistence\Doctrine\EntityManagerFactory;
use Symfony\Component\HttpFoundation\Request;

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require_once __DIR__.'/../../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$app['em'] = function() {
    return (new EntityManagerFactory())->build();
};

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
        'security.firewalls' => array(
            'default' => array(
                'pattern' => '^/',
                'anonymous' => true,
                'oauth' => array(
                    //'login_path' => '/auth/{service}',
                    //'callback_path' => '/auth/{service}/callback',
                    //'check_path' => '/auth/{service}/check',
                    'failure_path' => '/login',
                    'with_csrf' => false
                ),
                'logout' => array(
                    'logout_path' => '/logout',
                    'with_csrf' => false
                ),
                'users' => new Gigablah\Silex\OAuth\Security\User\Provider\OAuthInMemoryUserProvider()
            )
        ),
        'security.access_rules' => array(
            array('^/auth', 'ROLE_USER')
        )
    ));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->register(new Gigablah\Silex\OAuth\OAuthServiceProvider(), array(
    'oauth.services' => array(
        'twitter' => array(
            'key' => 'SN184Oj2jKWMaMJl9TregXtKU',
            'secret' => '7ngY5V2iNHZJj3AGBk2li5vsBI8wRvdPbgJZgqQYSfovTpto9e',
            'scope' => array(),
            'user_endpoint' => 'https://api.twitter.com/1.1/account/verify_credentials.json'
        ),
        /*
        'facebook' => array(
            'key' => FACEBOOK_API_KEY,
            'secret' => FACEBOOK_API_SECRET,
            'scope' => array('email'),
            'user_endpoint' => 'https://graph.facebook.com/me'
        ),
        'google' => array(
            'key' => GOOGLE_API_KEY,
            'secret' => GOOGLE_API_SECRET,
            'scope' => array(
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/userinfo.profile'
            ),
            'user_endpoint' => 'https://www.googleapis.com/oauth2/v1/userinfo'
        ),
        'github' => array(
            'key' => GITHUB_API_KEY,
            'secret' => GITHUB_API_SECRET,
            'scope' => array('user:email'),
            'user_endpoint' => 'https://api.github.com/user'
        )
        */
    )
));

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $services = array_keys($app['oauth.services']);
    $twig->addGlobal('login_paths', array_map(function ($service) use ($app) {
        return $app['url_generator']->generate('_auth_service', array(
            'service' => $service,
            // '_csrf_token' => $app['form.csrf_provider']->generateCsrfToken('oauth')
        ));
    }, array_combine($services, $services)));

    $twig->addGlobal(
        'logout_path',
        $app['url_generator']->generate('logout', array(
            // '_csrf_token' => $app['form.csrf_provider']->generateCsrfToken('logout')
        ))
    );

    return $twig;
}));

$app->before(function (Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $token = $app['security']->getToken();
    $app['user'] = null;

    if ($token && !$app['security.trust_resolver']->isAnonymous($token)) {
        $app['user'] = $token->getUser();
    }
});

$app->get('/', function () use ($app) {
    return $app['twig']->render('layout.html.twig');
})->bind('home');

$app->get('/stories', function () use ($app) {
    $request = new \Etpa\UseCases\Story\ViewStoriesRequest();

    $storyRepository = $app['em']->getRepository('Etpa\Domain\Story');
    $usecase = new \Etpa\UseCases\Story\ViewStoriesUseCase($storyRepository);
    $response = $usecase->execute($request);

    return $app['twig']->render('view-stories.html.twig', ['stories' => $response->stories]);
})->bind('read');

$app->get('/signup', function () use ($app) {
    return $app['twig']->render('signup.html.twig');
})->bind('signup');

$app->post('/signup', function () use ($app) {
    return $app['twig']->render('signup.html.twig');
});

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

$app->get('/story/{id}', function ($id) use ($app) {
    $request = new \Etpa\UseCases\Story\ViewStoryRequest();
    $request->storyId = $id;

    $storyRepository = $app['em']->getRepository('Etpa\Domain\Story');
    $usecase = new \Etpa\UseCases\Story\ViewStoryUseCase($storyRepository);
    $response = $usecase->execute($request);

    return $app['twig']->render('view-story.html.twig', ['story' => $response->story]);
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

$app->get('/page/{id}', function ($id) use ($app) {
    $request = new \Etpa\UseCases\Page\ViewPageRequest();
    $request->pageId = $id;

    $pageRepository = $app['em']->getRepository('Etpa\Domain\Page');
    $usecase = new \Etpa\UseCases\Page\ViewPageUseCase($pageRepository);
    $response = $usecase->execute($request);

    return $app['twig']->render('view-page.html.twig', ['page' => $response->page]);
});

$app->get('/reset', function () use ($app) {
    $storyRepository = $app['em']->getRepository('Etpa\Domain\Story');

    $secondPage = new \Etpa\Domain\Page();
    $secondPage->setTitle('Fin');
    $secondPage->setDescription('Es una historia que tiene inicio y fin.');

    $firstPage = new \Etpa\Domain\Page();
    $firstPage->setTitle('Inicio');
    $firstPage->setDescription('Es una historia que tiene inicio y fin.');
    $firstPage->addPage($secondPage);

    $story = new \Etpa\Domain\Story();
    $story->setTitle('El laberinto');
    $story->setDescription('Un laberinto sin fin del que tendrás que salir, si puedes.');
    $story->setFirstPage($firstPage);
    $storyRepository->persist($story);

    return $app->escape('Done!');
});

$app->run();
