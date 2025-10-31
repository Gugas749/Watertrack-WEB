<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['site/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'defaultRoute' => 'dashboard/index',
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'api/user',
                        'api/user-profile',
                        'api/technician-info',
                        'api/enterprise',
                        'api/meter',
                        'api/meter-problem',
                        'api/meter-reading',
                        'api/meter-type'
                    ],
                    'extraPatterns' => [
                        'GET count' => 'count',
                        'GET nomes' => 'nomes',
                        'GET profile/{id}' => 'profile',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                ],
            ],
        ],
        'as beforeRequest' => [
            'class' => 'yii\filters\AccessControl',
            'except' => ['site/login', 'site/error'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
            'denyCallback' => function ($rule, $action) {
                return Yii::$app->response->redirect(['site/login']);
            },
        ],
    ],
    'params' => $params,
];
