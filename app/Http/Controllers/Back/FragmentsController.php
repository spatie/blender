<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Back\Traits\UpdateMedia;
use App\Models\Fragment;
use Illuminate\Http\Request;

class FragmentsController
{
    use UpdateMedia;

    public function index()
    {
        $fragments = Fragment::all();

        return view('back.fragments.index', compact('fragments'));
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

    public function update($id, Request $request)
    {
        $fragment = Fragment::find($id);

        foreach (locales() as $locale) {
            $requestAttribute = "translated_{$locale}_text";

            $fragment->setTranslation($locale, $request->get($requestAttribute) ?? '');
        }

        $fragment->save();
        $this->updateMedia($fragment, $request);
        app('cache')->flush();

        $eventDescription = 'Fragment <a href="'.action('Back\FragmentsController@edit', $fragment->id).
            "\">`{$fragment->group}.{$fragment->key}`</a> was saved.";

        activity()->on($fragment)->log($eventDescription);

        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\FragmentsController@index');
    }
}
