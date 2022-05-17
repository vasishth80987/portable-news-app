Run following commands to access graphql ui

composer install<br>
php artisan vendor:publish --tag=lighthouse-schema<br>

Open browser -> visit localhost/graphql-playground

Use following query to see guardian api results,

query{
  search_news(q:"{search phrase}"){
    id,
    title,
    url
  }
}
