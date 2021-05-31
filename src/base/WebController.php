<?php

namespace hyii\base;

use hyii\helpers\HyiiHelper;
use yii\web\Controller;
use hyii\helpers\HyiiHelper as Helper;
use Hyii;

class WebController extends Controller
{

    private $twig;

    protected $data = [];

    /**
     * Checks to see if this has been set to app to use templates from the templates folder at the root of the project.
     * If not, it uses the base templates under the src director.
     *
     * @var string
     *
     */
    protected $template_dir = "base";

    public function __construct($id, $module, $config = [])
    {
        //Hyii::$app->request->enableCookieValidation = true;
        //Hyii::dd(Hyii::$app->request);
        //Hyii::$app->components['request']['enableCookieValidation'] = true;
        //Hyii::dd(Hyii::$app->components['request']);
        //Hyii::$app->user->enableSession = true;
        //Hyii::dd(Hyii::$app->user);
        parent::__construct($id, $module, $config);

        $hyii_path = Hyii::getAlias("@hyii");
        $this->data['site_url'] = Hyii::getAlias("@site_url") . "/";

        if (getenv("ENVIRONMENT") == "dev") {
            $this->data['devmode'] = true;
        } else {
            $this->data['devmode'] = false;
        }

        if (Helper::getUser() == "") {
            $this->data['loggedIn'] = false;
        } else {
            $this->data['loggedIn'] = true;
        }

        $this->data['site_name'] = getenv("SITE_NAME");

        if ($this->template_dir == "app") {
            $loader = new \Twig\Loader\FilesystemLoader(APP_TEMPLATES);
        } else {
            $loader = new \Twig\Loader\FilesystemLoader($hyii_path . '/templates');
        }

        $this->twig = new \Twig\Environment($loader, [
            'cache' => false
        ]);
    }

    /**
     * @param string $template
     * @param array $data
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function renderTemplate($template="", $data=[])
    {
        $data = array_merge($this->data, $data);

        return $this->twig->render($template, $data);
    }

}