<?php

namespace App\Http\Controllers;

use App\Http\Requests\PinnedArticleStoreRequest;
use App\Http\Requests\PinnedArticleUpdateRequest;
use App\Models\PinnedArticle;
use Illuminate\Http\Request;

class PinnedArticleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pinnedArticles = PinnedArticle::all();

        return view('pinnedArticle.index', compact('pinnedArticles'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pinnedArticle.create');
    }

    /**
     * @param \App\Http\Requests\PinnedArticleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PinnedArticleStoreRequest $request)
    {
        $pinnedArticle = PinnedArticle::create($request->validated());

        $request->session()->flash('pinnedArticle.id', $pinnedArticle->id);

        return redirect()->route('pinnedArticle.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PinnedArticle $pinnedArticle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PinnedArticle $pinnedArticle)
    {
        return view('pinnedArticle.show', compact('pinnedArticle'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PinnedArticle $pinnedArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PinnedArticle $pinnedArticle)
    {
        return view('pinnedArticle.edit', compact('pinnedArticle'));
    }

    /**
     * @param \App\Http\Requests\PinnedArticleUpdateRequest $request
     * @param \App\Models\PinnedArticle $pinnedArticle
     * @return \Illuminate\Http\Response
     */
    public function update(PinnedArticleUpdateRequest $request, PinnedArticle $pinnedArticle)
    {
        $pinnedArticle->update($request->validated());

        $request->session()->flash('pinnedArticle.id', $pinnedArticle->id);

        return redirect()->route('pinnedArticle.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PinnedArticle $pinnedArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PinnedArticle $pinnedArticle)
    {
        $pinnedArticle->delete();

        return redirect()->route('pinnedArticle.index');
    }
}
