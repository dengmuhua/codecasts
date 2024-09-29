<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConfigRequest;
use App\Http\Requests\UpdateConfigRequest;
use App\Http\Resources\ConfigResource;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $configs = Config::query()->firstOrFail();
        return $this->success(data: new ConfigResource($configs));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConfigRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConfigRequest $request, Config $config)
    {
        //
        $config->fill($request->all())->save();
        return $this->success('配置项更新成功');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Config $config)
    {
        //
    }
}
