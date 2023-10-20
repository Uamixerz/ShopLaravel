<?php

namespace App\Http\Controllers\HomeLabel;
use App\Http\Requests\HomeLabel\StoreRequest;
use App\Http\Requests\HomeLabel\UpdateRequest;
use App\Models\HomeProductLabels;

class HomeLabelController extends BaseController
{

    public function index()
    {
        $labels = HomeProductLabels::all();

        return view('admin.homeLabel.show', compact('labels'));
    }
    public function destroy(HomeProductLabels $label){
        $this->service->destroy($label);
        return redirect()->route('homeLabel.index');
    }
    public function create()
    {
        $products = $this->service->create();
        return view('admin.homeLabel.create', compact('products'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('homeLabel.index');
    }

    public function edit(HomeProductLabels $label){
        $products = $this->service->edit();
        return view('admin.homeLabel.edit', compact('label','products'));
    }
    public function update(UpdateRequest $request,HomeProductLabels $label){
        $data = $request->validated();
        $this->service->update($label, $data);
        return redirect()->route('homeLabel.index');
    }
}
