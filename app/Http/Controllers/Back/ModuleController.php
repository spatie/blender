<?php

namespace App\Http\Controllers\Back;

use Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\EloquentSortable\SortableInterface;

abstract class ModuleController extends Controller
{
    /** @var string */
    protected $modelName = null;

    /** @var string */
    protected $moduleName = null;

    /** @var bool */
    protected $redirectToIndex = false;

    /** @return \Illuminate\Database\Eloquent\Model */
    abstract protected function make();

    public function index()
    {
        $models = $this->query()->get();

        $data = [
            $this->moduleName => $models,
        ];

        return view("back.{$this->moduleName}.index", $data);
    }

    public function create()
    {
        $model = $this->make();

        return redirect()->action("Back\\{$this->modelName}Controller@edit", [$model->id]);
    }

    public function show($id)
    {
        return redirect()->action("Back\\{$this->modelName}Controller@edit", [$id]);
    }

    public function edit(Request $request, int $id)
    {
        $model = $this->find($id);

        if ($request->has('revert')) {
            $model->clearTemporaryMedia();

            return redirect()->action("Back\\{$this->modelName}Controller@edit", [$id]);
        }

        $data = [
            'model' => $model,
            'module' => $this->moduleName,
        ];

        return view("back.{$this->moduleName}.edit", $data);
    }

    public function update(int $id)
    {
        $request = app()->make("App\\Http\\Requests\\Back\\{$this->modelName}Request");

        $model = $this->find($id);

        call_user_func("App\\Models\\Updaters\\{$this->modelName}Updater::update", $model, $request);

        $model->save();
        app('cache')->flush();

        $eventDescription = $this->getUpdatedEventDescription($model);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        if ($this->redirectToIndex) {
            return redirect()->action("Back\\{$this->modelName}Controller@index");
        }

        return redirect()->action("Back\\{$this->modelName}Controller@edit", [$model->id]);
    }

    public function destroy($id)
    {
        $model = $this->query()->find($id);

        $eventDescription = $this->getDeletedEventDescription($model);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        $model->delete();
        app('cache')->flush();

        return redirect()->action("Back\\{$this->modelName}Controller@index");
    }

    public function changeOrder(Request $request)
    {
        $model = "\\App\\Models\\{$this->modelName}";

        $model::setNewOrder($request->get('ids'));
    }

    protected function getUpdatedEventDescription($model)
    {
        $modelName = fragment("back.{$this->moduleName}.singular");

        $linkToModel = link_to_action("Back\\{$this->modelName}Controller@edit", $model->name, ['id' => $model->id]);

        if ($model->wasDraft) {
            return fragment('back.events.created', ['model' => $modelName, 'name' => $linkToModel]);
        }

        return fragment('back.events.updated', ['model' => $modelName, 'name' => $linkToModel]);
    }

    protected function getDeletedEventDescription($model)
    {
        $modelName = fragment("back.{$this->moduleName}.singular");

        return fragment('back.events.deleted', ['model' => $modelName, 'name' => $model->name]);
    }

    protected function find(int $id)
    {
        $class = "App\\Models\\{$this->modelName}";

        return call_user_func("{$class}::find", $id);
    }

    protected function query()
    {
        $class = "App\\Models\\{$this->modelName}";

        $query = call_user_func("{$class}::query")->nonDraft();

        if (array_key_exists(SortableInterface::class, class_implements($class))) {
            return $query->orderBy('order_column', 'asc');
        }

        return $query;
    }
}
