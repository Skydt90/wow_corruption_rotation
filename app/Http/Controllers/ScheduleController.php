<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use App\Services\Base\Schedule\ScheduleServiceInterface;
use App\Services\Base\Corruption\CorruptionServiceInterface;

class ScheduleController extends Controller
{
    private $corruptionService;
    private $scheduleService;
    private $rotationRepo;

    /**
     * ScheduleController constructor.
     *
     * @param ScheduleServiceInterface $scheduleService
     * @param CorruptionServiceInterface $corruptionService
     */
    public function __construct(ScheduleServiceInterface $scheduleService, CorruptionServiceInterface $corruptionService)
    {
        $this->scheduleService = $scheduleService;
        $this->corruptionService = $corruptionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $schedule = $this->scheduleService->getByIdWithRelations(1, ['rotation.corruptions']);
        //dd($schedule);
        return view('schedule.index', [
            "schedule" => $schedule,
            "end" => $schedule->end_date,
            "start" => $schedule->start_date,
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
