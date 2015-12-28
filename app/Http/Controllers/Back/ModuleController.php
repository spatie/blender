<?php

namespace App\Http\Controllers\Back;

use Activity;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class ModuleController extends Controller
{
    /**
     * @var string
     */
    protected $modelName;

    /**
     * @var string
     */
    protected $moduleName;

    /**
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Return a fresh instance of the model (called on `create()`).
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract protected function make();

    /**
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->query()->nonDraft()->get();

        $data = [
            $this->moduleName => $models,
        ];

        return view("back.{$this->moduleName}.index", $data);
    }

    /**
     * Create a new record and redirect to the edit page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $model = $this->make();

        return redirect()->action("Back\\{$this->modelName}Controller@edit", [$model->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return redirect()->action("Back\\{$this->modelName}Controller@edit", [$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $model = $this->query()->find($id);

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

        $model = $this->query()->find($id);

        $model = $this->createUpdater($model, $request)->update();

        $model->save();
        app('cache')->flush();

        $eventDescription = $this->getUpdatedEventDescription($model);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action("Back\\{$this->modelName}Controller@edit", [$model->id]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Http\Request            $request
     *
     * @return \App\Models\Foundation\Updaters\Updater
     */
    protected function createUpdater(Model $model, Request $request)
    {
        $className = "App\\Models\\Updaters\\{$this->modelName}Updater";

        return $className::create($model, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param mixed $model
     *
     * @return string
     */
    protected function getUpdatedEventDescription($model)
    {
        $modelName = trans("back-{$this->moduleName}.singular");

        $linkToModel = link_to_action("Back\\{$this->modelName}Controller@edit", $model->name, ['id' => $model->id]);

        if ($model->wasDraft) {
            return trans('back.events.created', ['model' => $modelName, 'name' => $linkToModel]);
        }

        return trans('back.events.updated', ['model' => $modelName, 'name' => $linkToModel]);
    }

    /**
     * @param mixed $model
     *
     * @return string
     */
    protected function getDeletedEventDescription($model)
    {
        $modelName = trans("back-{$this->moduleName}.singular");

        return trans('back.events.deleted', ['model' => $modelName, 'name' => $model->name]);
    }

    protected function query()
    {
        return call_user_func("App\\Models\\{$this->modelName}::query");
    }
}
