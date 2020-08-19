<?php

use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;

return PathItem::create()
    ->route('/api/search')
    ->parameters(
        Parameter::query()
            ->name('type')
            ->example('users')
            ->description('The type parameter should be one of "users" or "repositories" or "issues"')
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
        Operation::post()
            ->tags(
                Tag::create()
                    ->name('Search Api')
            )
            ->summary('The search api requires 2 query parameters. type and text')
            ->operationId('search')
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
                                            Schema::integer('id')->example(23261109),
                                            Schema::string('node_id')->example('MDQ6VXNlcjIzMjYxMTA5'),
                                            Schema::string('avatar_url')->example('https://avatars2.githubusercontent.com/u/23261109?v=4'),
                                            Schema::string('gravatar_id')->example(''),
                                            Schema::string('url')->example('https://api.github.com/users/ahmed-aliraqi'),
                                            Schema::string('html_url')->example('https://github.com/ahmed-aliraqi'),
                                            Schema::string('followers_url')->example('https://api.github.com/users/ahmed-aliraqi/followers'),
                                            Schema::string('following_url')->example('https://api.github.com/users/ahmed-aliraqi/following{/other_user}'),
                                            Schema::string('gists_url')->example('https://api.github.com/users/ahmed-aliraqi/gists{/gist_id}'),
                                            Schema::string('starred_url')->example('https://api.github.com/users/ahmed-aliraqi/starred{/owner}{/repo}'),
                                            Schema::string('subscriptions_url')->example('https://api.github.com/users/ahmed-aliraqi/subscriptions'),
                                            Schema::string('organizations_url')->example('https://api.github.com/users/ahmed-aliraqi/orgs'),
                                            Schema::string('repos_url')->example('https://api.github.com/users/ahmed-aliraqi/repos'),
                                            Schema::string('events_url')->example('https://api.github.com/users/ahmed-aliraqi/events{/privacy}'),
                                            Schema::string('received_events_url')->example('https://api.github.com/users/ahmed-aliraqi/received_events'),
                                            Schema::string('received_events_url')->example('https://api.github.com/users/ahmed-aliraqi/received_events'),
                                            Schema::string('type')->example('User'),
                                            Schema::boolean('site_admin')->example(false),
                                            Schema::integer('score')->example(1)
                                        )
                                    )
                                )
                        )
                    )
            )
    );
