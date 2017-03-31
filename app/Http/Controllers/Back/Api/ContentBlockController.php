<?php

namespace App\Http\Controllers\Back\Api;

use App\Models\ContentBlock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Spatie\Blender\Model\Transformers\ContentBlockTransformer;

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

    protected function getModelFromRequest(ContentBlockRequest $request): Model
    {
        return call_user_func($request['model_name'].'::findOrFail', $request['model_id']);
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
