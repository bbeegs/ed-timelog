<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ObservationsRecordsExport;
use App\Models\ObservationRecord;
use Illuminate\Http\Request;

class ObservationRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $start_date = '';
        $end_date = '';
        if(!$request->filled('start_date')){
            $ob_date = ObservationRecord::orderBy('observation_date', 'ASC')->first('observation_date');
            $start_date = $ob_date->observation_date ?? date("Y-m-d");
        }
        else{
            $start_date = $request->start_date;
        }

        if(!$request->filled('end_date')){
            $end_date = date("Y-m-d");
        }
        else{
            $end_date = $request->end_date;
        }

        $total_time  = ObservationRecord::orderBy('observation_date', 'DESC')->whereBetween('observation_date', [$start_date, $end_date ])->get('total_hours');
        $total_hours = 0;
        $total_mins = 0;
        foreach($total_time as $th){
            list($hour, $minute) = explode(':', $th->total_hours);
            $total_mins += $hour * 60;
            $total_mins += $minute;
        }
        $total_hours = floor($total_mins / 60);
        $total_mins -= $total_hours * 60;
        $calc_total = sprintf('%02d:%02d', $total_hours, $total_mins);

        return view('observations.index', [
            'observations' => ObservationRecord::orderBy('observation_date', 'DESC')->whereBetween('observation_date', [$start_date, $end_date ])->simplePaginate(10),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'total_hours' => $calc_total
        ]);
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

        $startTime = new \DateTime($this->FormatDatesAndTimes($validated['observation_date'],  $validated['start_time']));
        $endTime = new \DateTime($this->FormatDatesAndTimes($validated['observation_date'],  $validated['end_time']));
        if($endTime < $startTime){
            $endTime->modify('+1 day');
        }
        $diffTime = $endTime->diff($startTime)->format("%h:%i");
        $record = ObservationRecord::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'area' => $validated['area'],
            'observation_start' => $this->FormatDatesAndTimes($validated['observation_date'],  $validated['start_time']),
            'observation_end' => $this->FormatDatesAndTimes($validated['observation_date'],  $validated['end_time']),
            'observation_date' => $validated['observation_date'],
            'total_hours' => $diffTime
        ]);
        $record->save();
        return redirect()->back(); 
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
        return redirect()->back(); 
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
        return redirect()->back(); 
    }

    public function export(Request $request)
    {
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
        return Excel::download(new ObservationsRecordsExport($start_date, $end_date), 'ed-observations-test.xlsx');
    }

}
