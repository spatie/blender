<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AddMediaRequest;
use Input;
use Request;
use Response;

class MediaLibraryApiController extends Controller
{
    /**
     * Return all the media in the current collection for the given model as json.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $model = $this->getModel();
        $collectionName = $this->getCollectionName();

        $mediaArray = [];
        foreach ($model->getMedia($collectionName) as $mediaItem) {
            $mediaArray[] = ['thumb' => $mediaItem->getUrl('admin'), 'image' => $mediaItem->getUrl('redactor'), 'name' => $mediaItem->name];
        }

        return Response::json($mediaArray);
    }

    /**
     * Add the upload file to the mediaLibrary.
     *
     * @param \App\Http\Requests\Back\AddMediaRequest $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(AddMediaRequest $request)
    {
        $media = $this->addUploadedFileToMediaLibrary();
        if (Input::has('redactor')) {
            return Response::json(['filelink' => $media->getUrl('redactor')]);
        }

        return Response::json(['media' => $media->toArray()]);
    }

    /**
     * Get the model for the current request.
     *
     * @return mixed
     */
    private function getModel()
    {
        $modelClass = 'App\\Models\\'.ucfirst(Request::route()->parameter('modelClass'));
        $model = $modelClass::find(Request::route()->parameter('id'));

        return $model;
    }

    /**
     * Get the collectionName for this request.
     *
     * @return mixed
     */
    private function getCollectionName()
    {
        return Request::route()->parameter('collectionName');
    }

    /**
     * Add the file that was uploaded during this request to the medialibrary.
     *
     * @return mixed
     */
    private function addUploadedFileToMediaLibrary()
    {
        return $this->getModel()
            ->addMedia(Input::file('file'))
            ->withCustomProperties(['temp' => Input::has('redactor') ? false : true])
            ->toCollection($this->getCollectionName());
    }
}
