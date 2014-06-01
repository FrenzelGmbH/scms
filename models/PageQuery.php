<?php

namespace app\modules\pages\models;

use yii\db\ActiveQuery;

/**
 * Scope class for dmpaper which allows to view only none deleted records
 */

class PageQuery extends ActiveQuery
{
    public function active()
    {
        $this->andWhere('(special <> -1 OR special IS NULL) AND status NOT LIKE "archived"');
        return $this;
    }
}
