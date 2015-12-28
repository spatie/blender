<?php

namespace App\Http\Controllers\Back;

use Activity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\FragmentRequest;
use App\Models\Fragment;
use App\Models\Updaters\FragmentUpdater;
use App\Repositories\FragmentRepository;

class FragmentController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fragments = Fragment::all();

        return view('back.fragments.index')->with(compact('fragments'));
    }

    /**
     * Create a new record and redirect to the edit page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $fragment = new Fragment();
        $fragment->save();

        return redirect()->action('Back\FragmentController@edit', [$fragment->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fragment = Fragment::find($id);

        return view('back.fragments.edit')->with(compact('fragment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int                                     $id
     * @param \App\Http\Requests\Back\FragmentRequest $request
     *
     * @return \App\Http\Controllers\Back\Response
     */
    public function update($id, FragmentRequest $request)
    {
        $fragment = Fragment::find($id);

        $fragment = FragmentUpdater::create($fragment, $request)->update();

        $fragment->save();
        app('cache')->flush();

        $eventDescription = trans('back.events.updated', ['model' => 'Fragment', 'name' => $fragment->name]);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\FragmentController@edit', [$fragment->id]);
    }
}
