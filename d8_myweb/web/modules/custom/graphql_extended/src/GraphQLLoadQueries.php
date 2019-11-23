<?php

namespace Drupal\graphql;
use Drupal\graphql\GraphQL;

class GraphQLLoadQueries {

  public function __construct() {
    $queryType = new ObjectType([
      'name' => 'Query',
      'fields' => [
        'echo' => [
          'type' => Type::string(),
          'args' => [
            'message' => ['type' => Type::string()],
          ],
          'resolve' => function ($root, $args) {
            return $root['prefix'] . $args['message'];
          }
        ],
      ],
    ]);

    $mutationType = new ObjectType([
      'name' => 'Calc',
      'fields' => [
        'sum' => [
          'type' => Type::int(),
          'args' => [
            'x' => ['type' => Type::int()],
            'y' => ['type' => Type::int()],
          ],
          'resolve' => function ($root, $args) {
            return $args['x'] + $args['y'];
          },
        ],
      ],
    ]);

    // See docs on schema options:
    // http://webonyx.github.io/graphql-php/type-system/schema/#configuration-options
    $schema = new Schema([
      'query' => $queryType,
      'mutation' => $mutationType,
    ]);

    // See docs on server options:
    // http://webonyx.github.io/graphql-php/executing-queries/#server-configuration-options
    $server = new StandardServer([
      'schema' => $schema
    ]);
  }
}
