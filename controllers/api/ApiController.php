<?php

namespace app\controllers\api;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * @SWG\Swagger(
 *     produces={"application/json"},
 *     consumes={"application/x-www-form-urlencoded"},
 *     @SWG\Info(version="1.0", title="Test API"),
 * )
 */
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            'docs' => [
                'class' => 'yii2mod\swagger\SwaggerUIRenderer',
                'restUrl' => Url::to(['api/json-schema']),
            ],
            'json-schema' => [
                'class' => 'yii2mod\swagger\OpenAPIRenderer',
                // Тhe list of directories that contains the swagger annotations.
                'scanDir' => [
                    Yii::getAlias('@app/controllers'),
                    Yii::getAlias('@app/models'),
                ],
                'cache' => null,
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}