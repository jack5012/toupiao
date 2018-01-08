<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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


    public function ranking($id)
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $voteRanking = $this->repository->with(['voteItem'])->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voteRanking,
            ]);
        }

        return view('vote-projects.ranking', compact('voteRanking'));
    }

    public function search(Request $request,$id)
    {
        if ($request->isMethod('POST')){
            $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
            $voteSearch = $this->repository->with(
                ['voteItem' => function ($query) use($request) {
                    $search =  $request->input('search');
                    $query->where('id', '=', $search);
                    $query->orWhere('name', 'like', '%'.$search.'%');
                    $query->orderBy('created_at', 'desc');
                }])->find($id);
            if (request()->wantsJson()) {
                return response()->json([
                    'data' => $voteSearch,
                ]);
            }
        }
        return view('vote-projects.search', compact('voteSearch'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $voteProject = $this->repository->with(['voteItem'])->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voteProject,
            ]);
        }
        return view('vote-projects.index', compact('voteProject'));
    }

    public function register(Request $request, $id)
    {
        $voteProject = $this->repository->with(['voteItem'])->find($id);

        if (request()->wantsJson()) {
            foreach($request->file('images') as $file) {
                $file = $request->file('image');
                $path = $file->store('avatars', 'uploads');
            }

            return response()->json([
                'data' => $voteProject,
            ]);
        }
        return view('vote-projects.register', compact('voteProject'));
    }


}
