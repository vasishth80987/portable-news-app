<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PinnedArticle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PinnedArticleController
 */
class PinnedArticleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $pinnedArticles = PinnedArticle::factory()->count(3)->create();

        $response = $this->get(route('pinned-article.index'));

        $response->assertOk();
        $response->assertViewIs('pinnedArticle.index');
        $response->assertViewHas('pinnedArticles');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('pinned-article.create'));

        $response->assertOk();
        $response->assertViewIs('pinnedArticle.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PinnedArticleController::class,
            'store',
            \App\Http\Requests\PinnedArticleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user_id = $this->faker->numberBetween(-10000, 10000);
        $news_source = $this->faker->numberBetween(-10000, 10000);
        $resource_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('pinned-article.store'), [
            'user_id' => $user_id,
            'news_source' => $news_source,
            'resource_id' => $resource_id,
        ]);

        $pinnedArticles = PinnedArticle::query()
            ->where('user_id', $user_id)
            ->where('news_source', $news_source)
            ->where('resource_id', $resource_id)
            ->get();
        $this->assertCount(1, $pinnedArticles);
        $pinnedArticle = $pinnedArticles->first();

        $response->assertRedirect(route('pinnedArticle.index'));
        $response->assertSessionHas('pinnedArticle.id', $pinnedArticle->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $pinnedArticle = PinnedArticle::factory()->create();

        $response = $this->get(route('pinned-article.show', $pinnedArticle));

        $response->assertOk();
        $response->assertViewIs('pinnedArticle.show');
        $response->assertViewHas('pinnedArticle');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $pinnedArticle = PinnedArticle::factory()->create();

        $response = $this->get(route('pinned-article.edit', $pinnedArticle));

        $response->assertOk();
        $response->assertViewIs('pinnedArticle.edit');
        $response->assertViewHas('pinnedArticle');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PinnedArticleController::class,
            'update',
            \App\Http\Requests\PinnedArticleUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $pinnedArticle = PinnedArticle::factory()->create();
        $user_id = $this->faker->numberBetween(-10000, 10000);
        $news_source = $this->faker->numberBetween(-10000, 10000);
        $resource_id = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('pinned-article.update', $pinnedArticle), [
            'user_id' => $user_id,
            'news_source' => $news_source,
            'resource_id' => $resource_id,
        ]);

        $pinnedArticle->refresh();

        $response->assertRedirect(route('pinnedArticle.index'));
        $response->assertSessionHas('pinnedArticle.id', $pinnedArticle->id);

        $this->assertEquals($user_id, $pinnedArticle->user_id);
        $this->assertEquals($news_source, $pinnedArticle->news_source);
        $this->assertEquals($resource_id, $pinnedArticle->resource_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $pinnedArticle = PinnedArticle::factory()->create();

        $response = $this->delete(route('pinned-article.destroy', $pinnedArticle));

        $response->assertRedirect(route('pinnedArticle.index'));

        $this->assertSoftDeleted($pinnedArticle);
    }
}
