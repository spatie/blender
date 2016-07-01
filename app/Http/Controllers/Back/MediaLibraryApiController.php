<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AddMediaRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Media;
use App\Models\Transformers\MediaTransformer;

class MediaLibraryApiController extends Controller
{
    public function add(AddMediaRequest $request)
    {
        try {

            $model = $this->getModelFromRequest($request);

            $media = $model
                ->addMedia($request->file('file')[0])
                ->withCustomProperties(['temp' => $request->has('redactor') ? false : true])
                ->toCollection($request->get('collection_name', 'default'));

            if ($request->has('redactor')) {
                return Response::json(['filelink' => $media->getUrl('redactor')]);
            }

            return response()->json(
                fractal()
                    ->item($media)
                    ->transformWith(new MediaTransformer())
                    ->toArray()
            );

        } catch (Exception $e) {

            return response(null, 500);

        }
    }

    public function index(Request $request)
    {
        $model = $this->getModelFromRequest($request);

        $collectionName = $request->get('collectionName');

        $media = $model->getMedia($collectionName)->reduce(function (Collection $collection, Media $media) {
            return $collection->push([
                'thumb' => $media->getUrl('admin'),
                'image' => $media->getUrl('redactor'),
                'name' => $media->name,
            ]);
        }, new Collection());

        return response()->json($media);
    }

    protected function getModelFromRequest(Request $request)
    {
        if (!isset($request['model_name'])) {
            throw new Exception('No model name provided');
        }

        if (!isset($request['model_id'])) {
            throw new Exception('No model id provided');
        }

        return call_user_func($request['model_name'].'::findOrFail', $request['model_id']);
    }
}
