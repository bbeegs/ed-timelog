<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\ObservationRecord;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ObservationsRecordsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $from, $to;

    public function __construct(String $from, String $to) {

        $this->from = $from;
        $this->to = $to;
    }
    public function collection()
    {
        return ObservationRecord::select(DB::raw ('observation_date, to_char(observation_start, "HH24:MM"), DATE_FORMAT(observation_end, "%H:%I"), total_hours, area, first_name, last_name'))->whereBetween('observation_date', [$this->from, $this->to ])->get();
    }

    public function headings(): array
    {
        return [
            [sprintf('Observation Breakdown From %s - %s', $this->from, $this->to)],
            [
            'Observation Date',
            'Start Time',
            'End Time',
            'Total Time',
            'Work Area',
            'First Name',
            'Last Name',]]
            ;
    }
}
