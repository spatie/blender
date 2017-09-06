<?php

namespace App\Http\Controllers\Back;

use App\Models\Scopes\NonDraftScope;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use ReflectionClass;

abstract class Controller
{
    use ValidatesRequests;
    use Traits\UpdateMedia;
    use Traits\UpdateOnlineToggle;
    use Traits\UpdateDates;
    use Traits\UpdateSeoValues;
    use Traits\UpdateTags;
    use Traits\UpdateTranslations;

    /** @var string */
    protected $modelClass;
    protected $moduleName;

    /** @var bool */
    protected $redirectToIndex = false;

    public function __construct()
    {
        $this->modelClass = $this->determineModelClass();
        $this->moduleName = $this->determineModuleName();
    }

    public function index()
    {
        $models = $this->all();

        return view("back.{$this->moduleName}.index", compact('models'));
    }

    public function create()
    {
        $model = $this->make();

        return redirect()->to($this->action('edit', $model->id));
    }

    public function show($id)
    {
        return redirect()->to($this->action('edit', $id));
    }

    public function edit(int $id)
    {
        $model = $this->find($id);

        return view("back.{$this->moduleName}.edit")
            ->with('model', $model)
            ->with('module', $this->moduleName);
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, $this->validationRules());

        $model = $this->find($id);

        $this->updateFromRequest($model, $request);

        Cache::flush();

        $eventDescription = $this->updatedEventDescriptionFor($model);
        activity()->on($model)->log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->to(
            $this->redirectToIndex
                ? $this->action('index')
                : $this->action('edit', $model->id)
        );
    }

    public function destroy($id)
    {
        $model = $this->find($id);

        $eventDescription = $this->deletedEventDescriptionFor($model);
        activity()->log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        $model->delete();

        Cache::flush();

        return redirect()->to($this->action('index'));
    }

    public function changeOrder()
    {
        call_user_func([$this->modelClass, 'setNewOrder'], request('ids'));

        Cache::flush();
    }

    protected function find(int $id): Eloquent
    {
        return call_user_func([$this->modelClass, 'where'], 'id', $id)
            ->withoutGlobalScope(NonDraftScope::class)
            ->firstOrFail();
    }

    protected function all(): Collection
    {
        return call_user_func([$this->modelClass, 'all']);
    }

    protected function determineModelClass(): string
    {
        return (new ReflectionClass($this))
            ->getMethod('make')
            ->getReturnType();
    }

    protected function determineModuleName(): string
    {
        return lcfirst(str_replace_last('Controller', '', class_basename($this)));
    }

    protected function updateModel(Eloquent $model, Request $request)
    {
        $this->updateTranslations($model, $request);
        $this->updateMedia($model, $request);
        $this->updateOnlineToggle($model, $request);
        $this->updateDates($model, $request);
        $this->updateSeoValues($model, $request);

        $model->save();
    }

    protected function updateFields(Eloquent $model, Request $request, array $fields)
    {
        collect($fields)->each(function ($field) use ($model, $request) {
            $model->$field = $request->get($field, false);
        });
    }

    protected function updatedEventDescriptionFor(Eloquent $model): string
    {
        $modelName = ucfirst(__("back.models.{$this->moduleName}"));

        $linkToModel = '"<a href="'.$this->action('edit', $model->id).'">'.$model->name.'</a>"';

        if ($model->wasDraft) {
            return $modelName.' '.$linkToModel.' '.__('werd aangemaakt');
        }

        return $modelName.' '.$linkToModel.' '.__('werd gewijzigd');
    }

    protected function deletedEventDescriptionFor(Eloquent $model): string
    {
        $modelName = ucfirst(__("back.models.{$this->moduleName}"));

        return $modelName.' "'.$model->name.'" '.__('werd verwijderd');
    }

    protected function action(string $action, $parameters = []): string
    {
        return action('\\'.static::class.'@'.$action, $parameters);
    }
}
