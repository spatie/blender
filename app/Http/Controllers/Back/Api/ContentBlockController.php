<?php

namespace App\Http\Controllers\Back\Api;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use App\Models\Transformers\ContentBlockTransformer;
use Exception;
use Illuminate\Http\Request;

class ContentBlockController extends Controller
{
    public function add(Request $request)
    {
        $model = $this->getModelFromRequest($request);

        $contentBlock = new ContentBlock();

        $model->contentBlocks()->save($contentBlock);

        return fractal($contentBlock, new ContentBlockTransformer());
    }

    public function index(Request $request)
    {
        $model = $this->getModelFromRequest($request);

        return fractal($model->contentBlocks, new ContentBlockTransformer());
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
