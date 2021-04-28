<?php

namespace App\Http\Controllers;

use App\Models\ObservationRecord;
use Illuminate\Http\Request;

class ObservationRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('observations.index', ['observations' => ObservationRecord::orderBy('observation_date', 'DESC')->simplePaginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('observations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'area' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'observation_date' => 'required'
        ]);

        $fff = new \DateTime($this->FormatDatesAndTimes($validated['observation_date'],  $validated['start_time']));
        $ccc = new \DateTime($this->FormatDatesAndTimes($validated['observation_date'],  $validated['end_time']));
        $bbb = $ccc->diff($fff);
        $record = ObservationRecord::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'area' => $validated['area'],
            'observation_start' => $this->FormatDatesAndTimes($validated['observation_date'],  $validated['start_time']),
            'observation_end' => $this->FormatDatesAndTimes($validated['observation_date'],  $validated['end_time']),
            'observation_date' => $validated['observation_date'],
            'total_hours' => $bbb->format("%H:%I:%S")
        ]);
        $record->save();
        return redirect("/observations");
    }

    public function FormatDatesAndTimes($date, $time){
        return date('Y-m-d H:i:s', strtotime("$date $time"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObservationRecord  $observationRecord
     * @return \Illuminate\Http\Response
     */
    public function show(ObservationRecord $observationRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObservationRecord  $observationRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(ObservationRecord $observation)
    {
        return view('observations.edit', ['observation' => $observation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObservationRecord  $observationRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObservationRecord $observation)
    {
        $validated = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'area' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'observation_date' => 'required'
        ]);
        $fff = new \DateTime($this->FormatDatesAndTimes($validated['observation_date'],  $validated['start_time']));
        $ccc = new \DateTime($this->FormatDatesAndTimes($validated['observation_date'],  $validated['end_time']));
        $bbb = $ccc->diff($fff);
        $record = $observation->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'area' => $validated['area'],
            'observation_start' => $this->FormatDatesAndTimes($validated['observation_date'],  $validated['start_time']),
            'observation_end' => $this->FormatDatesAndTimes($validated['observation_date'],  $validated['end_time']),
            'observation_date' => $validated['observation_date'],
            'total_hours' => $bbb->format("%H:%I:%S")
        ]);
        return redirect("/observations");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObservationRecord  $observationRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($observation)
    {
        ObservationRecord::destroy($observation);
        return redirect("/observations");
    }
}
