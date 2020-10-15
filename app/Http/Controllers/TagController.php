<?php

namespace App\Http\Controllers;

use App\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:tags',
        ]);
        Tag::create($validatedData);

        flash()->success(__('flashes.tag.store'));
        return redirect()->route('tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return Response
     */
    public function edit(Tag $tag)
    {
        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tag $tag
     * @return Response
     */
    public function update(Request $request, Tag $tag)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:tags',
        ]);
        $tag->fill($validatedData)->save();

        flash()->success(__('flashes.tag.update'));

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return Response
     * @throws Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->tasks()->detach();
        $tag->delete();
        flash()->success(__('flashes.tag.destroy'));

        return back();
    }
}
