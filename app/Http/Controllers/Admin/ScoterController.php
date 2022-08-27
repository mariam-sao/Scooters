<?php

namespace App\Http\Controllers\Admin;

use App\Models\Scoter;
use App\Models\Booking;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\ScoterRequest;
use Symfony\Component\HttpFoundation\Response;

class ScoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        abort_if(Gate::denies('scoter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scoters = Scoter::all();

        return view('admin.scoters.index', compact('scoters'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        abort_if(Gate::denies('scoter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::get()->pluck('name', 'id');

        return view('admin.scoters.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScoterRequest $request)
    {
        abort_if(Gate::denies('scoter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Scoter::create($request->validated());

        return redirect()->route('admin.scoters.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

     /**
     * Display Scoter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Scoter $scoter)
    {
        abort_if(Gate::denies('scoter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookings = Booking::where('scoter_id', $scoter->id)->get();

        return view('admin.scoters.show', compact('scoter', 'bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Scoter $scoter)
    {
        abort_if(Gate::denies('scoter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::get()->pluck('name', 'id');

        return view('admin.scoters.edit', compact('scoter', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScoterRequest $request, Scoter $scoter)
    {
        abort_if(Gate::denies('scoter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scoter->update($request->validated());

        return redirect()->route('admin.scoters.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scoter $scoter)
    {
        abort_if(Gate::denies('scoter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scoter->delete();

        return redirect()->route('admin.scoters.index')->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

        /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('scoter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Scoter::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
