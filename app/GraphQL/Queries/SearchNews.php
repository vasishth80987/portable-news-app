<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Http;

final class SearchNews
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $q = $args['q'];

        $response = Http::get('https://content.guardianapis.com/search?q='.$q.'&format=json&order-by=relevance&page-size=100&api-key=test');

        $results = $response->object()->response->results;

        $return = [];

        foreach($results as $result){
            $obj = new \stdClass();
            $obj->id = $result->id;
            $obj->title = $result->webTitle;
            $obj->published_at = $result->webPublicationDate;
            $obj->url = $result->webUrl;
            $return[] = $obj;
        }
        return $return;
    }
}
