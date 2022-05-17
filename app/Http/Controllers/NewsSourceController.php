<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsSourceStoreRequest;
use App\Http\Requests\NewsSourceUpdateRequest;
use App\Models\NewsSource;
use Illuminate\Http\Request;

class NewsSourceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $newsSources = NewsSource::all();

        return view('newsSource.index', compact('newsSources'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('newsSource.create');
    }

    /**
     * @param \App\Http\Requests\NewsSourceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsSourceStoreRequest $request)
    {
        $newsSource = NewsSource::create($request->validated());

        $request->session()->flash('newsSource.id', $newsSource->id);

        return redirect()->route('newsSource.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NewsSource $newsSource
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, NewsSource $newsSource)
    {
        return view('newsSource.show', compact('newsSource'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NewsSource $newsSource
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, NewsSource $newsSource)
    {
        return view('newsSource.edit', compact('newsSource'));
    }

    /**
     * @param \App\Http\Requests\NewsSourceUpdateRequest $request
     * @param \App\Models\NewsSource $newsSource
     * @return \Illuminate\Http\Response
     */
    public function update(NewsSourceUpdateRequest $request, NewsSource $newsSource)
    {
        $newsSource->update($request->validated());

        $request->session()->flash('newsSource.id', $newsSource->id);

        return redirect()->route('newsSource.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\NewsSource $newsSource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, NewsSource $newsSource)
    {
        $newsSource->delete();

        return redirect()->route('newsSource.index');
    }

    public function search(Request $request){

    }
}
