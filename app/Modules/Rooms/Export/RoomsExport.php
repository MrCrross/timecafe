<?php

namespace App\Modules\Rooms\Export;

use App\Modules\Rooms\Models\Room;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RoomsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{

    public function collection(): Collection
    {
        return Room::query()
            ->select(
                'rooms.name',
                'rooms_rates.name as rate_name',
                'rooms_rates.price as rate_price',
                'rooms.capacity'
            )
            ->join('rooms_rates', 'rooms_rates.id', '=', 'rooms.rate_id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Название',
            'Тариф',
            'Стоимость за час',
            'Вместимость'
        ];
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->rate_name,
            $row->rate_price,
            $row->capacity
        ];
    }
}
