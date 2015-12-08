<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Ubicaciones]].
 *
 * @see Ubicaciones
 */
class UbicacionesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Ubicaciones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Ubicaciones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}