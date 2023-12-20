<?php

namespace App\Modules\Products\Export;

use App\Modules\Products\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{

    public function collection(): Collection
    {
        return Product::with('type')->get();
    }

    public function headings(): array
    {
        return [
            'Название',
            'Тип товара',
            'Стоимость',
        ];
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->type->name,
            $row->price
        ];
    }
}