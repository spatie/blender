<?php

namespace App\Http\Controllers\Back\Api;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use App\Models\Transformers\ContentBlockTransformer;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContentBlockController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request, $this->validationRules());

        $model = $this->getModelFromRequest($request);

        $contentBlock = new ContentBlock(['collection_name' => $request->collection_name]);

        $model->contentBlocks()->save($contentBlock);

        return fractal($contentBlock, new ContentBlockTransformer());
    }

    protected function getModelFromRequest($request): Model
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
            'model_name' => 'required',
            'model_id' => 'required',
            'collection_name' => 'required',
        ];
    }

    protected function throwValidationException(Request $request, $validator)
    {
        throw new ValidationException($validator, response()->json($validator->messages(), 400));
    }
}
