<?php

namespace App\Modules\Reports\Export;

use App\Modules\Orders\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportProfitsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $startDate = Carbon::parse($this->request->query('start_date'))->toDateTimeString();
        $endDate = Carbon::parse($this->request->query('end_date'))->toDateTimeString();
        $result = collect([]);
        $ordersDays = Order::query()
            ->selectRaw('
                DATE_FORMAT(orders.date_order, "%d.%m.%Y") as date_orders,
                (
                    SELECT
                        COUNT(orders_count.id) as count_orders
                    FROM orders as orders_count
                    WHERE DATE(orders_count.date_order) = DATE(orders.date_order)
                ) as count_orders,
                (
                    SELECT
                        SUM(products.price * orders_products.count) as sum_products
                    FROM orders as orders_sum
                     INNER JOIN orders_products ON orders_products.order_id = orders_sum.id
                     INNER JOIN products ON orders_products.product_id = products.id
                    WHERE DATE(orders_sum.date_order) = DATE(orders.date_order)
                ) as sum_orders
            ')
            ->whereBetween('orders.date_order', [
                $startDate,
                $endDate
            ])
            ->groupByRaw('date_orders')
            ->get();
        $ordersPeriod = Order::query()
            ->selectRaw('
                "Всего" as date_orders,
                COUNT(orders.id) as count_orders,
                (
                    SELECT
                        SUM(products.price * orders_products.count) AS sum_products
                    FROM
                        `orders`
                            INNER JOIN orders_products ON orders_products.order_id = orders.id
                            INNER JOIN products ON orders_products.product_id = products.id
                    WHERE
                        `orders`.`date_order` BETWEEN "' . $startDate . '"
                            AND "' . $endDate . '"
                      AND `orders`.`deleted_at` IS NULL
                ) AS sum_orders
            ')
            ->whereBetween('orders.date_order', [
                $startDate,
                $endDate
            ])
            ->get();

        $result = $result->merge($ordersDays)->merge($ordersPeriod);

        return $result;
    }

    public function headings(): array
    {
        return [
            'Дата',
            'Количество заявок',
            'Всего с заявок'
        ];
    }

    public function map($row): array
    {
        return [
            $row->date_orders,
            $row->count_orders,
            $row->sum_orders
        ];
    }
}
