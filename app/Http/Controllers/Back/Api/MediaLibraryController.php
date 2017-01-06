<?php

namespace App\Http\Controllers\Back\Api;

use Response;
use Exception;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AddMediaRequest;
use App\Models\Transformers\MediaTransformer;

class MediaLibraryController extends Controller
{
    public function add(AddMediaRequest $request)
    {
        $model = $this->getModelFromRequest($request);

        $files = $request->file('file');

        if (! is_array($files)) {
            $files = [$files];
        }

        $media = collect($files)
            ->map(function (UploadedFile $file) use ($model, $request) {
                return $model
                    ->addMedia($file)
                    ->withCustomProperties(['draft' => $request->has('redactor') ? false : true])
                    ->toCollection($request->get('collection_name', 'default'));
            });

        if ($request->has('redactor')) {
            return Response::json(['filelink' => $media->first()->getUrl('redactor')]);
        }

        return fractal()->collection($media)->transformWith(new MediaTransformer());
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
        if (! isset($request['model_name'])) {
            throw new Exception('No model name provided');
        }

        if (! isset($request['model_id'])) {
            throw new Exception('No model id provided');
        }

        return call_user_func($request['model_name'].'::findOrFail', $request['model_id']);
    }
}
