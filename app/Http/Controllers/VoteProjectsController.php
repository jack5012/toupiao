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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voteProject = $this->repository->with(['voteItem'])->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voteProject,
            ]);
        }
        return view('vote-projects.show', compact('voteProject'));
    }
}
