<?php

namespace App\Http\Controllers\Back\Api;

use App\Models\ContentBlock;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Back\ContentBlockRequest;
use Spatie\Blender\Model\Transformers\ContentBlockTransformer;

class ContentBlockController extends Controller
{
    public function add(ContentBlockRequest $request)
    {
        $model = $this->getModelFromRequest($request);

        $contentBlock = new ContentBlock(['collection_name' => $request->collection_name]);

        $model->contentBlocks()->save($contentBlock);

        return fractal($contentBlock, new ContentBlockTransformer());
    }

    protected function getModelFromRequest(ContentBlockRequest $request): Model
    {
        return call_user_func($request['model_name'].'::findOrFail', $request['model_id']);
    }
}
