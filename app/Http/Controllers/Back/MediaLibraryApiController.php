<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AddMediaRequest;
use Response;

class MediaLibraryApiController extends Controller
{
    /**
     * Add the upload file to the mediaLibrary.
     *
     * @param \App\Http\Requests\Back\AddMediaRequest $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(AddMediaRequest $request)
    {
        $model = call_user_func($request['model_name'].'::findOrFail', $request['model_id']);

        $media = $model
            ->addMedia($request->file('file'))
            ->withCustomProperties(['temp' => $request->has('redactor') ? false : true])
            ->toCollection($request['collection_name']);

        if ($request->has('redactor')) {
            return Response::json(['filelink' => $media->getUrl('redactor')]);
        }

        return Response::json(['media' => $media->toArray()]);
    }
}
