<?php

namespace App\Http\Controllers\Back;

use Activity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\FragmentRequest;
use App\Models\Fragment;
use App\Models\Updaters\FragmentUpdater;
use Spatie\FragmentImporter\Exporter;

class FragmentController extends Controller
{
    public function index()
    {
        $fragments = Fragment::all();

        return view('back.fragments.index')->with(compact('fragments'));
    }

    public function create()
    {
        $fragment = new Fragment();
        $fragment->save();

        return redirect()->action('Back\FragmentController@edit', [$fragment->id]);
    }

    public function edit($id)
    {
        $fragment = Fragment::find($id);

        return view('back.fragments.edit')->with(compact('fragment'));
    }

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

    public function download()
    {
        Exporter::sendExportToBrowser();
    }
}
