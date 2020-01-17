<?php

namespace App\Http\Controllers;

use App\WebPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class WebPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['webpages'] = WebPage::orderBy('id', 'desc')->paginate(10);

        return view('webpage.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('webpage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|url'
        ]);

        WebPage::create($request->all());

        return Redirect::to('webpages')
            ->with('success', 'Great! Web page created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $where = ['id' => $id];
        $data['webpage'] = WebPage::where($where)->first();

        return view('webpage.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'address' => 'required|url'
        ]);

        $update = ['address' => $request->address];

        //o first aqui serve para rodar o observer corretamente
        WebPage::where('id', $id)->first()->update($update);

        return Redirect::to('webpages')
            ->with('success', 'Great! Web page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //o first aqui serve para rodar o observer corretamente
        WebPage::where('id', $id)->first()->delete();

        return Redirect::to('webpages')->with('success', 'Web page deleted successfully');
    }

    /**
     * retrive a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reload()
    {
        $data['webpages'] = WebPage::orderBy('id', 'desc')->paginate(10);

        return view('webpage.table', $data);
    }

    /**
     * returns the content of the web page crawled
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function content($id) {
        return view('webpage.content', [
            "address" => Storage::disk('public')->get("webpages/{$id}.html")
        ]);
    }
}
