<?php

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;

// Define the /areas path along with the supported operations.
$users = PathItem::create()
    ->route('/search')
    ->parameters(
        Parameter::query()
            ->name('type')
            ->example('users')
            ->description('The github search service')
            ->required()
            ->schema(
                Schema::string()
            ),
        Parameter::query()
            ->name('text')
            ->example('ahmed-aliraqi')
            ->description('The text that will search for')
            ->required()
            ->schema(
                Schema::string()
            )
    )
    ->operations(
        Operation::get()
            ->summary('Search Users')
            ->operationId('search.users')
            ->responses(
                Response::create()
                    ->statusCode(200)
                    ->description('OK')
                    ->content(
                        MediaType::json()->schema(
                            Schema::object()
                                ->properties(
                                    Schema::integer('total_count')->example(1),
                                    Schema::boolean('incomplete_results')->example(false),
                                    Schema::array('items')->items(
                                        Schema::object()->properties(
                                            Schema::string('login')->example('ahmed-aliraqi'),
                                            Schema::integer('id')->example(23261109)
                                        )
                                    )
                                )
                        )
                    )
            )
    );

return [$users];
