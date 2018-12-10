<?php

namespace inquid\inquidcurrencies\models\ActiveQuery;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\ActiveQuery\Currencies]].
 *
 * @see ActiveQuery
 */
class CurrenciesQuery extends ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CurrenciesQuery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CurrenciesQuery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
