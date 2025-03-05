<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreRequestServiceRequest;
use App\Http\Requests\UpdateRequestServiceRequest;
use App\Models\RequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RequestServiceController extends ApiController
{
    public function index()
    {
        $response = Gate::allows('viewAny', RequestService::class)
            ? RequestService::all()
            : auth()->user()->requestServices()->get();

        return $this->responseSuccess(compact('response'));
    }

    public function store(StoreRequestServiceRequest $request)
    {
        if (Gate::denies('create', RequestService::class)) {
            return $this->responseError(message: 'Only users can create request services', status: 403);
        }
        $requestService = RequestService::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);
        return $this->responseSuccess(compact('requestService'));
    }
    public function show($id)
    {
        $requestService = RequestService::find($id);
        Gate::authorize('view', $requestService);
        return $this->responseSuccess(compact('requestService'));
    }

    public function update(UpdateRequestServiceRequest $request, $id)
    {
        $requestService = RequestService::find($id);
        if (Gate::denies('update', $requestService)) {
            return $this->responseError(message: 'Not found', status: 404);
        }
        $requestService->update($request->all());
        $request = RequestService::find($id);
        return $this->responseSuccess(data: compact('request'), message: 'Updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $requestService = RequestService::whereId($id)->first();
        if (Gate::denies('delete', $requestService)) {
            return $this->responseError(message: 'Not found', status: 404);
        }
        $requestService->delete();
        return $this->responseSuccess(message: 'Deleted successfully');
    }
}
