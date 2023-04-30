<?php

namespace App\Imports;

use App\Models\Certificate;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CertImport implements ToCollection, WithStartRow, WithHeadingRow
{

    protected $category;

    public function __construct($category)
    {
        $this->category = $category;

    }

    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $config = [
                'table' => 'certificates',
                'field' => 'unique_code',
                'length' => 15,
                'prefix' => 'OAHF/AT/'.date('ym'),
                // 'reset_on_prefix_change' => true
            ];
            $unique_code = IdGenerator::generate($config);



           \App\Models\certificate::create([
                'title' => $row['title'],
                'name' => ucwords($row['name']),
                'email' => $row['email'],
                'type' => $this->category,
                'unique_code' => $unique_code,
                'hash' => sha1(rand()),
                'isActive' => 1
            ]);
        }
    }
}
