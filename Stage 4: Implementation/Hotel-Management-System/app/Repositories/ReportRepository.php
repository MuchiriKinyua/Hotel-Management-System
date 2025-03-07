<?php

namespace App\Repositories;

use App\Models\Report;
use App\Repositories\BaseRepository;

class ReportRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'report_type',
        'generated_by',
        'report_data'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Report::class;
    }
}
