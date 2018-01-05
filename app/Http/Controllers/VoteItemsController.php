<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\VoteItemCreateRequest;
use App\Http\Requests\VoteItemUpdateRequest;
use App\Contracts\Repositories\VoteItemRepository;
use App\Validators\VoteItemValidator;


class VoteItemsController extends Controller
{

    /**
     * @var VoteItemRepository
     */
    protected $repository;

    /**
     * @var VoteItemValidator
     */
    protected $validator;

    public function __construct(VoteItemRepository $repository, VoteItemValidator $validator)
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
        $voteItems = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voteItems,
            ]);
        }

        return view('voteItems.index', compact('voteItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VoteItemCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VoteItemCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $voteItem = $this->repository->create($request->all());

            $response = [
                'message' => 'VoteItem created.',
                'data'    => $voteItem->toArray(),
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
        $voteItem = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voteItem,
            ]);
        }

        return view('voteItems.show', compact('voteItem'));
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

        $voteItem = $this->repository->find($id);

        return view('voteItems.edit', compact('voteItem'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  VoteItemUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(VoteItemUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $voteItem = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'VoteItem updated.',
                'data'    => $voteItem->toArray(),
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
                'message' => 'VoteItem deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'VoteItem deleted.');
    }
}
