<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\BaseRepository;

class ContactRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'message'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Contact::class;
    }
}
