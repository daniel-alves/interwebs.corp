<?php

namespace App\Http\Controllers;

use App\WebPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WebPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['webpages'] = WebPage::orderBy('id','desc')->paginate(10);

        return view('webpage.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('webpage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|url'
        ]);

        $data = $request->all();
        $data["content"] = null;
        $data["visited_at"] = null;
        $data["status_code"] = null;

        WebPage::create($request->all());

        return Redirect::to('webpages')
            ->with('success','Great! Web page created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'address' => 'required|url'
        ]);

        $update = ['address' => $request->address];
        WebPage::where('id', $id)->update($update);

        return Redirect::to('webpages')
            ->with('success','Great! Web page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WebPage::where('id', $id)->delete();

        return Redirect::to('webpages')->with('success','Web page deleted successfully');
    }

    /**
     * retrive a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reload()
    {
        $data['webpages'] = WebPage::orderBy('id','desc')->paginate(10);

        return view('webpage.table', $data);
    }
}
