<?php

use yii\db\Migration;

/**
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class m170616_203208_seed_words_data extends Migration
{
    /** @var integer countries category reference id */
    const COUNTRIES_CATEGORY_ID = 1;
    /** @var integer cities category reference id */
    const CITIES_CATEGORY_ID = 2;
    /** @var integer animals category reference id */
    const ANIMALS_CATEGORY_ID = 3;
    
    /**
     * @inheritdoc
     */
    public function up()
    {
        // populate words for countries category
        $this->batchInsert('word', ['category_id', 'letters'], [
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Албания'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Бразилия'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'България'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Великобритания'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Виетнам'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Германия'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Гърция'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Дания'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Египет'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Еквадор'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Испания'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Италия'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Ирландия'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Китай'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Колумбия'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Канада'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Куба'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Мексико'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Молдова'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Полша'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Португалия'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Румъния'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Русия'], ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Сърбия'],
            ['category_id' => self::COUNTRIES_CATEGORY_ID, 'letters' => 'Турция'],
        ]);
        
        // populate words for cities category
        $this->batchInsert('word', ['category_id', 'letters'], [
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Тирана'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Сао Пауло'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'София'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Лондон'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Ханой'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Берлин'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Атина'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Копенхаген'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Кайро'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Кито'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Мадрид'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Рим'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Дъблин'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Пекин'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Богота'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Отава'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Хавана'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Чиапас'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Кишинев'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Варшава'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Лисабон'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Букурещ'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Москва'], ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Белград'],
            ['category_id' => self::CITIES_CATEGORY_ID, 'letters' => 'Анкара'],
        ]);
        
        // populate words for animals category
        $this->batchInsert('word', ['category_id', 'letters'], [
            ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Див заек'], ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Котка'],
            ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Див козел'], ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Гущер'],
            ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Пепелянка'], ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Водно конче'],
            ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Сива водна змия'], ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Ястреб'],
            ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Фламинго'], ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Орел рибар'],
            ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Черният кълвач'], ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Белокоременият тюлен'],
            ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Черният щъркел'], ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Tритон'],
            ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Лъв'], ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Хиена'],
            ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Лешояд'], ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Тигър'],
            ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Гъзела'], ['category_id' => self::ANIMALS_CATEGORY_ID, 'letters' => 'Крокодил'],
        ]);
    }
    
    /**
     * @inheritdoc
     */
    public function down()
    {
        // delete all words entities
        $this->delete('word');
    }
}
