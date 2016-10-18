<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\FragmentRequest;
use App\Models\Fragment;
use Spatie\FragmentImporter\Exporter;

class FragmentsController
{
    public function index()
    {
        $fragments = Fragment::where('hidden', false)->get();

        return view('back.fragments.index')->with(compact('fragments'));
    }

    public function hidden()
    {
        $fragments = Fragment::where('hidden', true)->get();

        return view('back.fragments.index')->with(compact('fragments'));
    }

    public function create()
    {
        $fragment = new Fragment();
        $fragment->save();

        return redirect()->action('Back\FragmentsController@edit', [$fragment->id]);
    }

    public function edit($id)
    {
        $fragment = Fragment::find($id);

        return view('back.fragments.edit')->with(compact('fragment'));
    }

    public function update($id, FragmentRequest $request)
    {
        $fragment = Fragment::find($id);

        foreach (locales() as $locale) {
            $requestAttribute = "translated_{$locale}_text";

            $fragment->setTranslation($locale, $request->get($requestAttribute));
        }

        $fragment->save();
        app('cache')->flush();

        $eventDescription = fragment('back.events.updated', ['model' => 'Fragment', 'name' => $fragment->name]);

        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\FragmentsController@index');
    }

    public function download()
    {
        Exporter::sendExportToBrowser();
    }
}
