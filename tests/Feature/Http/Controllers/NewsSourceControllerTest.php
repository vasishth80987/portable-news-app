<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\NewsSource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\NewsSourceController
 */
class NewsSourceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $newsSources = NewsSource::factory()->count(3)->create();

        $response = $this->get(route('news-source.index'));

        $response->assertOk();
        $response->assertViewIs('newsSource.index');
        $response->assertViewHas('newsSources');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('news-source.create'));

        $response->assertOk();
        $response->assertViewIs('newsSource.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NewsSourceController::class,
            'store',
            \App\Http\Requests\NewsSourceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $title = $this->faker->sentence(4);
        $api_url = $this->faker->text;

        $response = $this->post(route('news-source.store'), [
            'title' => $title,
            'api_url' => $api_url,
        ]);

        $newsSources = NewsSource::query()
            ->where('title', $title)
            ->where('api_url', $api_url)
            ->get();
        $this->assertCount(1, $newsSources);
        $newsSource = $newsSources->first();

        $response->assertRedirect(route('newsSource.index'));
        $response->assertSessionHas('newsSource.id', $newsSource->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $newsSource = NewsSource::factory()->create();

        $response = $this->get(route('news-source.show', $newsSource));

        $response->assertOk();
        $response->assertViewIs('newsSource.show');
        $response->assertViewHas('newsSource');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $newsSource = NewsSource::factory()->create();

        $response = $this->get(route('news-source.edit', $newsSource));

        $response->assertOk();
        $response->assertViewIs('newsSource.edit');
        $response->assertViewHas('newsSource');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NewsSourceController::class,
            'update',
            \App\Http\Requests\NewsSourceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $newsSource = NewsSource::factory()->create();
        $title = $this->faker->sentence(4);
        $api_url = $this->faker->text;

        $response = $this->put(route('news-source.update', $newsSource), [
            'title' => $title,
            'api_url' => $api_url,
        ]);

        $newsSource->refresh();

        $response->assertRedirect(route('newsSource.index'));
        $response->assertSessionHas('newsSource.id', $newsSource->id);

        $this->assertEquals($title, $newsSource->title);
        $this->assertEquals($api_url, $newsSource->api_url);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $newsSource = NewsSource::factory()->create();

        $response = $this->delete(route('news-source.destroy', $newsSource));

        $response->assertRedirect(route('newsSource.index'));

        $this->assertSoftDeleted($newsSource);
    }
}
