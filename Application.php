<?php

namespace carbon42\phpmvc;

use carbon42\phpmvc\db\Database;
use carbon42\phpmvc\db\DbModel;
use carbon42\phpmvc\Request;

class Application
{

    public static string        $ROOT_DIR;
    public string               $layout = 'default';
    public string               $userClass;

    public Request              $request;
    public Router               $router;
    public ?Controller          $controller = null;
    public Response             $response;
    public Session              $session;
    public Database             $db;
    public ?UserModel           $user = null;
    public View                 $view;

    public static Application   $app;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->userClass = $config['userClass'];
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);

        }
        else {
            $this->user = NULL;
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = NULL;
        $this->session->remove('user');
    }
}