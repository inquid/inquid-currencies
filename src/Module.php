<?php

namespace inquid\inquidcurrencies;

/**
 * components module definition class
 */
class Module extends \yii\base\Module
{
    public $menu = [];

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'inquid\inquidcurrencies\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::configure($this, require(__DIR__ . '/config/config.php'));
        if (isset(Yii::$app->user->identity))
            $this->menu = ['label' => 'Opciones',
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin,
                'url' => ['/components/default/index'],
                'template' => '<a href="{url}">{label}<i class="fa fa-angle-left pull-right"></i></a>',
                'items' => [
                    ['label' => 'Asuntos', 'url' => ['/legal/asuntos/index'], 'visible' => Yii::$app->user->identity->isAdmin],
                ],
            ];
        // custom initialization code goes here
    }
}
