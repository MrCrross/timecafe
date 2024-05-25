<?php

namespace App\Modules\Reports\Export;

use App\Models\UsersAuthorization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportAttendanceExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
        $authDays = UsersAuthorization::query()
            ->with('user')
            ->selectRaw('
                DATE_FORMAT(users_authorization.created_at, "%d.%m.%Y") as created,
                (
                    SELECT
                        COUNT(ua_count.id) as count_ua
                    FROM users_authorization as ua_count
                    WHERE DATE(ua_count.created_at) = DATE(users_authorization.created_at) AND ua_count.is_admin = 0
                ) as count_ua_no_admin,
                (
                    SELECT
                        COUNT(ua_count.id) as count_ua
                    FROM users_authorization as ua_count
                    WHERE DATE(ua_count.created_at) = DATE(users_authorization.created_at) AND ua_count.is_admin = 1
                ) as count_ua_admin
            ')
            ->whereBetween('users_authorization.created_at', [
                $startDate,
                $endDate
            ])
            ->groupByRaw('created')
            ->get();

        $authPeriod = UsersAuthorization::query()
            ->with('user')
            ->selectRaw('
                "Всего" as created,
                SUM(IF(users_authorization.is_admin = 0, 1, 0)) as count_ua_no_admin,
                SUM(IF(users_authorization.is_admin = 1, 1, 0)) as count_ua_admin
            ')
            ->whereBetween('users_authorization.created_at', [
                $startDate,
                $endDate
            ])
            ->get();

        $result = $result->merge($authDays)->merge($authPeriod);

        return $result;
    }

    public function headings(): array
    {
        return [
            'Дата',
            'Количество авторизаций сотрудников',
            'Количество авторизаций клиентов',
        ];
    }

    public function map($row): array
    {
        return [
            $row->created,
            $row->count_ua_admin,
            $row->count_ua_no_admin,
        ];
    }
}
