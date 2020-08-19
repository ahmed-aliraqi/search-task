<?php

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

$searchSchema = Schema::object('search')
    ->properties(
        Schema::integer('id')->format(Schema::FORMAT_INT64),
        Schema::string('name')->format(Schema::TYPE_STRING)
    );

return $searchSchema;
