<?php

namespace hyii\base;

use Hyii;
use yii\web\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class ApiController extends Controller {

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        Hyii::$app->request->parsers = [ 'application/json' => 'yii\web\JsonParser'];

        //Hyii::dd(Hyii::$app);
    }

    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
        ];
        /*
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        */
        return $behaviors;
    }
}