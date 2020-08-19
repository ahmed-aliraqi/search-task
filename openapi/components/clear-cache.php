<?php

use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;

return PathItem::create()
    ->route('/api/clear-cache')
    ->operations(
        Operation::post()
            ->tags(
                Tag::create()
                    ->name('Clear Search Results Cache')
            )
            ->summary('This service allow you to clear the search results cache')
            ->operationId('clear')
            ->responses(
                Response::create()
                    ->statusCode(200)
                    ->description('OK')
                    ->content(
                        MediaType::json()->schema(
                            Schema::object()
                                ->properties(
                                    Schema::string('message')
                                        ->example('The cache has been cleared successfully')
                                )
                        )
                    )
            )
    );
