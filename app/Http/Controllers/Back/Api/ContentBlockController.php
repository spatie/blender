<?php

namespace App\Http\Controllers\Back\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AddContentBlockRequest;
use App\Models\ContentBlock;
use App\Models\Transformers\ContentBlockTransformer;
use Illuminate\Database\Eloquent\Model;
use Response;

class ContentBlockController extends Controller
{
    public function add(AddContentBlockRequest $request)
    {
        $model = $this->getModelFromRequest($request);

        $contentBlock = new ContentBlock(['collection_name' => $request->collection_name]);

        $model->contentBlocks()->save($contentBlock);

        return fractal($contentBlock, new ContentBlockTransformer());
    }

    protected function getModelFromRequest(AddContentBlockRequest $request): Model
    {
        return call_user_func($request['model_name'].'::findOrFail', $request['model_id']);
    }
}
