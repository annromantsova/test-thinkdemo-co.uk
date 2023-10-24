<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Artical;

class ArticleController extends Controller
{
    public function index()
    {
        return Artical::all();
    }

    public function store(ArticleRequest $request)
    {
        return Artical::create($request->validated());
    }

    public function show(Artical $artical)
    {
        return $artical;
    }

    public function update(ArticleRequest $request, Artical $artical)
    {
        $artical->update($request->validated());

        return $artical;
    }

    public function destroy(Artical $artical)
    {
        $artical->delete();

        return response()->json();
    }
}
