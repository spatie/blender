<?php

namespace App\Console\Commands;

use App\Models\Foundation\Traits\Draftable;
use File;
use Illuminate\Console\Command;
use Log;

class DeleteOldDrafts extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'db:deleteOldDrafts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete drafts from all tables that are older than 24 hours.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        array_map(function ($draftableModelClass) {
            $this->deleteOldDraftsForModelClass($draftableModelClass);
        }, $this->getAllDraftableModelClassNames());

        Log::info('old drafts deleted');
    }

    private function getAllDraftableModelClassNames()
    {
        return array_filter($this->getAllModelClassNames(), function ($modelClass) {
            return  in_array(Draftable::class, class_uses($modelClass));
        });
    }

    private function getAllModelClassNames()
    {
        return array_map(function ($path) {
            $modelPath = str_replace(base_path().'/', '', $path);
            $modelClass = '\\'.ucfirst(str_replace(['/', '.php'], ['\\', ''], $modelPath));

            return $modelClass;
        }, File::files(app_path('Models')));
    }

    private function deleteOldDraftsForModelClass($draftableModelClass)
    {
        $model = new $draftableModelClass();

        foreach ($model->draftsOlderThanHours(24)->get() as $oldRecord) {
            $oldRecord->delete();
        }
    }
}
