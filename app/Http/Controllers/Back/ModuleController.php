<?php

namespace App\Http\Controllers\Back;

use Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use ReflectionClass;
use Spatie\EloquentSortable\SortableInterface;

abstract class ModuleController
{
    use Updaters\UpdateMedia;
    use Updaters\UpdateOnlineToggle;
    use Updaters\UpdatePublishDate;
    use Updaters\UpdateSeoValues;
    use Updaters\UpdateTags;
    use Updaters\UpdateTranslations;

    /** @var string */
    protected $modelClass, $moduleName;

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

        return view("back.{$this->moduleName}.index")->with('models', $models);
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

        if (request()->has('revert')) {
            $model->clearTemporaryMedia();

            return redirect()->to($this->action('edit', $id));
        }

        return view("back.{$this->moduleName}.edit")
            ->with('model', $model)
            ->with('module', $this->moduleName);
    }

    public function update(int $id)
    {
        $formRequest = $this->determineUpdateRequestClass();

        $request = app()->make($formRequest);

        $model = $this->find($id);

        $this->updateFromRequest($model, $request);

        Cache::flush();

        $eventDescription = $this->updatedEventDescriptionFor($model);
        activity()->on($model)->log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->to(
            $this->redirectToIndex ? $this->action('index') : $this->action('edit', $model->id)
        );
    }

    public function destroy($id)
    {
        $model = $this->query()->find($id);

        $eventDescription = $this->deletedEventDescriptionFor($model);
        activity()->log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        $model->delete();

        Cache::flush();

        return redirect()->to($this->action('index'));
    }

    public function changeOrder(Request $request)
    {
        call_user_func([$this->modelClass, 'setNewOrder'], $request->get('ids'));
    }

    protected function find(int $id): Model
    {
        return call_user_func("{$this->modelClass}::findOrFail", $id);
    }

    protected function all(): Collection
    {
        $query = call_user_func("{$this->modelClass}::query")->nonDraft();

        if (array_key_exists(SortableInterface::class, class_implements($this->modelClass))) {
            $query->orderBy('order_column', 'asc');
        }

        return $query->get();
    }

    protected function determineModelClass(): string
    {
        return (new ReflectionClass($this))
            ->getMethod('make')
            ->getReturnType();
    }

    protected function determineModuleName(): string
    {
        return explode('_', snake_case(short_class_name($this), '_'), 2)[0];
    }

    protected function determineUpdateRequestClass(): string
    {
        return (new ReflectionClass($this))
            ->getMethod('updateFromRequest')
            ->getParameters()[1]
            ->getClass()
            ->getName();
    }

    protected function updateModel(Model $model, FormRequest $request)
    {
        $this->updateTranslations($model, $request);
        $this->updateMedia($model, $request);
        $this->updateOnlineToggle($model, $request);
        $this->updatePublishDate($model, $request);
        $this->updateSeoValues($model, $request);

        $model->save();
    }

    protected function updatedEventDescriptionFor($model): string
    {
        $modelName = fragment("back.{$this->moduleName}.singular");

        $linkToModel = el('a', ['href' => $this->action('edit', $model->id)], $model->name);

        if ($model->wasDraft) {
            return fragment('back.events.created', ['model' => $modelName, 'name' => $linkToModel]);
        }

        return fragment('back.events.updated', ['model' => $modelName, 'name' => $linkToModel]);
    }

    protected function deletedEventDescriptionFor($model): string
    {
        $modelName = fragment("back.{$this->moduleName}.singular");

        return fragment('back.events.deleted', ['model' => $modelName, 'name' => $model->name]);
    }

    protected function action(string $action, $parameters = []): string
    {
        return action('\\'.static::class.'@'.$action, $parameters);
    }
}
