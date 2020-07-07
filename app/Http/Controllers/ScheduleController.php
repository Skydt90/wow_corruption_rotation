<?php

namespace App\Http\Controllers;

use App\Repositories\Base\Rotation\RotationRepoInterface;
use App\Services\Base\Corruption\CorruptionServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    private $corruptionService;
    private $rotationRepo;

    /**
     * ScheduleController constructor.
     *
     * @param $corruptionService
     */
    public function __construct(CorruptionServiceInterface $corruptionService, RotationRepoInterface $rotationRepo)
    {
        $this->corruptionService = $corruptionService;
        $this->rotationRepo = $rotationRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('schedule.index', [
            "rotation" => $this->rotationRepo->getByIdWithRelations(1, ['corruptions'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
