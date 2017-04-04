<?php

namespace App\Http\Controllers\Back;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TagsController extends Controller
{
    protected $redirectToIndex = true;

    protected function make(): Tag
    {
        return Tag::create();
    }

    protected function updateFromRequest(Tag $tag, Request $request)
    {
        $tag->type = $request->get('type');
        $tag->online = true;

        $this->updateTranslations($tag, $request);

        $tag->save();
    }

    public function index()
    {
        $tags = Tag::where('draft', false)->orderBy('order_column')->get()->reduce(function (Collection $carry, Tag $tag) {
            if (! $carry->has($tag->type)) {
                $carry->put($tag->type, new Collection());
            }

            $carry->get($tag->type)->push($tag);

            return $carry;
        }, new Collection());

        return view('back.tags.index', compact('tags'));
    }

    public function edit(int $id)
    {
        return parent::edit($id)->withTypes(Tag::typesForSelect());
    }

    protected function validationRules(): array
    {
        $rules = [];

        foreach (config('app.locales') as $locale) {
            $rules[translate_field_name('name', $locale)] = 'required';
        }

        return $rules;
    }
}
