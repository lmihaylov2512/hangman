<?php

use yii\db\Migration;

/**
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class m170616_202657_seed_categories_data extends Migration
{
    public function up()
    {
        // populate categories
        $this->batchInsert('category', ['id', 'name'], [
            ['id' => 1, 'name' => 'Държави'],
            ['id' => 2, 'name' => 'Градове'],
            ['id' => 3, 'name' => 'Животни'],
        ]);
    }
    
    public function down()
    {
        $this->delete('category');
    }
}
