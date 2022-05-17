Run following commands to access graphql-query ui

composer install<br>
php artisan vendor:publish --tag=lighthouse-schema<br>
open browser -> visit localhost/graphql-playground<br>

use following query to see guardian api results,

query{
  search_news(q:"{search phrase}"){
    id,
    title,
    url
  }
}
