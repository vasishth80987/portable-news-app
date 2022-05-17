Run following commands to access graphql-query ui

composer install
php artisan vendor:publish --tag=lighthouse-schema
open browser -> visit localhost/graphql-playground

use following query to see guardian api results,

query{
  search_news(q:"{search phrase}"){
    id,
    title,
    url
  }
}
