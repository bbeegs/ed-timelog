<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\ObservationRecord;
use Maatwebsite\Excel\Concerns\FromCollection;

class ObservationsRecordsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ObservationRecord::select('observation_date', 'observation_start', 'observation_end', 'total_hours', 'area', 'first_name', 'last_name')->orderBy('observation_date', 'DESC')->get();
    }

    public function headings(): array
    {
        return [
            'Observation Date',
            'Start Time',
            'End Time',
            'Total Time',
            'Work Area',
            'First Name',
            'Last Name',
        ];
    }
}
