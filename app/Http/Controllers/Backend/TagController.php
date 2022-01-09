<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TagRequest;
use App\Models\Tag;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

        //for role and permission
        if (!auth()->user()->ability(['admin'],['manage_tags','show_tags'])){
            return redirect('admin/index');
        }

        // search by this query
        //1-keyword
        //2-status
        //3-sort_by
        //4-order_by
        //5-limit_by

//        dd(\request()->status);
        // Bcause many to many you cant do Withcount
        $tags = Tag::with('products')
            ->when(\request()->keyword !=null, function ($q){
                $q->search(\request()->keyword);
            })
            ->when(\request()->status !=null, function ($q){
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'asc')
            ->paginate(\request()->limit_by ?? 10 );

        return view('backend.tags.index' , compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['create_tags'])){
            return redirect('admin/index');
        }

        return view('backend.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagRequest $request)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['create_tags'])){
            return redirect('admin/index');
        }

        //$input['name'] = $request->name;
        //$input['status'] = $request->status;

        Tag::create($request->validated());
        return redirect()->route('admin.tags.index')->with([
            'message'   =>'Created Successfully',
            'alert-type'=>'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['display_tags'])){
            return redirect('admin/index');
        }

        return view('backend.tags.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['update_tags'])){
            return redirect('admin/index');
        }

        return view('backend.tags.edit',compact( 'tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TagRequest $request, Tag $tag)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['update_tags'])){
            return redirect('admin/index');
        }

        $input['name'] = $request->name;
        // for use the new slug
        $input['slug'] = null;
        $input['status'] = $request->status;

        $tag->update($input);

        return redirect()->route('admin.tags.index')->with([
            'message'   =>'Updated Successfully',
            'alert-type'=>'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tag $tag)
    {
        //for role and permission
        if (!auth()->user()->ability(['admin'],['delete_tags'])){
            return redirect('admin/index');
        }

        $tag->delete();

        return redirect()->route('admin.tags.index')->with([
            'message'   =>'Deleted Successfully',
            'alert-type'=>'success'
        ]);

    }

}
