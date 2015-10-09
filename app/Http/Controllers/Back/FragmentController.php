<?php

namespace App\Http\Controllers\Back;

use Activity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\FragmentRequest;
use App\Models\Fragment;
use App\Repositories\FragmentRepository;

class FragmentController extends Controller
{
    /**
     * @var \App\Repositories\FragmentRepository
     */
    protected $fragmentRepository;

    /**
     * @param \App\Repositories\FragmentRepository $fragmentRepository
     */
    public function __construct(FragmentRepository $fragmentRepository)
    {
        $this->fragmentRepository = $fragmentRepository;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fragments = $this->fragmentRepository->getAll();

        return view('back.fragments.index')->with(compact('fragments'));
    }

    /**
     * Create a new record and redirect to the edit page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $fragment = new Fragment();
        $fragment->save();

        return redirect()->action('Back\FragmentController@edit', [$fragment->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fragment = $this->fragmentRepository->findById($id);

        return view('back.fragments.edit')->with(compact('fragment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int                                     $id
     * @param \App\Http\Requests\Back\FragmentRequest $fragmentRequest
     *
     * @return \App\Http\Controllers\Back\Response
     */
    public function update($id, FragmentRequest $fragmentRequest)
    {
        $fragment = $this->fragmentRepository->findById($id);

        $fragment->updateWithRelations($fragmentRequest->all());

        $this->fragmentRepository->save($fragment);

        $eventDescription = trans('back.events.updated', ['model' => 'Fragment', 'name' => $fragment->name]);
        Activity::log($eventDescription);
        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\FragmentController@edit', [$fragment->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fragment = $this->fragmentRepository->findById($id);

        $eventDescription = trans('back.events.deleted', ['model' => 'Fragment', 'name' => $fragment->name]);

        $this->fragmentRepository->delete($fragment);

        flash()->success(strip_tags($eventDescription));

        return redirect()->action('Back\FragmentController@index');
    }
}
