<?php

namespace inquid\inquidcurrencies\models\base;

use inquid\inquidcurrencies\models\ActiveQuery\CurrenciesQuery;
use mootensai\relation\RelationTrait;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the base model class for table "{{%components}}".
 *
 * @property integer $id
 * @property string $currency_name
 * @property string $currency_code
 * @property string $currency_symbol
 * @property double $exchange_rate
 * @property integer $decimal_places
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted
 */
class Currencies extends ActiveRecord
{
    use RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exchange_rate'], 'number'],
            [['decimal_places', 'status', 'created_by', 'updated_by', 'deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['currency_name'], 'string', 'max' => 50],
            [['currency_code'], 'string', 'max' => 5],
            [['currency_symbol'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%currencies}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_name' => 'Nombre de la moneda',
            'currency_code' => 'Codigo de la moneda',
            'currency_symbol' => 'Simbolo de la moneda',
            'exchange_rate' => 'TIpo de Cambio',
            'decimal_places' => 'Decimales',
            'status' => 'Status',
        ];
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('CONVERT_TZ(NOW(),"+00:00","-05:00")'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return CurrenciesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CurrenciesQuery(get_called_class());
    }
}
