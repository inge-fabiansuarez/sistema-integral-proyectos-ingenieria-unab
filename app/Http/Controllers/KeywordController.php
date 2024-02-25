<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;

/**
 * Class KeywordController
 * @package App\Http\Controllers
 */
class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keywords = Keyword::paginate();

        return view('keyword.index', compact('keywords'))
            ->with('i', (request()->input('page', 1) - 1) * $keywords->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keyword = new Keyword();
        return view('keyword.create', compact('keyword'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Keyword::$rules);

        $keyword = Keyword::create($request->all());

        return redirect()->route('keywords.index')
            ->with('success', 'Keyword created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keyword = Keyword::find($id);

        return view('keyword.show', compact('keyword'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keyword = Keyword::find($id);

        return view('keyword.edit', compact('keyword'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Keyword $keyword
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keyword $keyword)
    {
        request()->validate(Keyword::$rules);

        $keyword->update($request->all());

        return redirect()->route('keywords.index')
            ->with('success', 'Keyword updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $keyword = Keyword::find($id)->delete();

        return redirect()->route('keywords.index')
            ->with('success', 'Keyword deleted successfully');
    }
}
