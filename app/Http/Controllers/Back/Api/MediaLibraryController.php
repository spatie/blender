<?php

namespace App\Http\Controllers\Back\Api;

use App\Http\Controllers\Controller;
use App\Models\Transformers\MediaTransformer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\Models\Media;

class MediaLibraryController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request, $this->validationRules());

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
                    ->toMediaCollection($request->get('collection_name', 'default'));
            });

        if ($request->has('redactor')) {
            $media = $media->first();

            return response()->json([
                'url' => $request->get('redactor') === 'file' ? $media->getUrl() : $media->getUrl('redactor'),
                'name' => $media->file_name,
            ]);
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

        return $request['model_name']::withoutGlobalScopes()->findOrFail($request['model_id']);
    }

    protected function validationRules(): array
    {
        return [
            'file' => 'required|max:'.config('medialibrary.max_file_size'),
        ];
    }

    protected function throwValidationException(Request $request, $validator)
    {
        throw new ValidationException($validator, response()->json($validator->messages(), 400));
    }
}
