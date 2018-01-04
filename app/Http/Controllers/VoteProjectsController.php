<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\VoteProjectCreateRequest;
use App\Http\Requests\VoteProjectUpdateRequest;
use App\Contracts\Repositories\VoteProjectRepository;
use App\Validators\VoteProjectValidator;


class VoteProjectsController extends Controller
{

    /**
     * @var VoteProjectRepository
     */
    protected $repository;

    /**
     * @var VoteProjectValidator
     */
    protected $validator;

    public function __construct(VoteProjectRepository $repository, VoteProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $voteProjects = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voteProjects,
            ]);
        }

        return view('voteProjects.index', compact('voteProjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VoteProjectCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VoteProjectCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $voteProject = $this->repository->create($request->all());

            $response = [
                'message' => 'VoteProject created.',
                'data'    => $voteProject->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voteProject = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voteProject,
            ]);
        }

        return view('voteProjects.show', compact('voteProject'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $voteProject = $this->repository->find($id);

        return view('voteProjects.edit', compact('voteProject'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  VoteProjectUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(VoteProjectUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $voteProject = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'VoteProject updated.',
                'data'    => $voteProject->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'VoteProject deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'VoteProject deleted.');
    }
}
