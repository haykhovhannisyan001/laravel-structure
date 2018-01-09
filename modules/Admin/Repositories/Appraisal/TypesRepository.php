<?php

namespace Modules\Admin\Repositories\Appraisal;

use App\Models\Appraisal\Type;

class TypesRepository
{
    private $type;

    /**
     * TypesRepository constructor.
     */
    public function __construct()
    {
        $this->type = new Type();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTypes()
    {
        return $this->type->all();
    }

    /**
     * create assoc array by types id
     *
     * @return array
     */
    public function createTypesArray()
    {
        $types = $this->getTypes();
        $typesArray = [];
        foreach ($types as $type) {
            $typesArray[$type->id] = $type->form ? ($type->form . ' - ' . $type->descrip) : $type->descrip;
        }

        return $typesArray;
    }

    /**
     * @param $heads
     * @return array
     */
    public function getTypesForSampleTemplate($heads)
    {
        $types = $this->createTypesArray();
        $lines[] = $heads;
        foreach ($types as $typeId => $type) {
            $lines[] = [
                $typeId.'|'.$type,
                "0.00",
                "0.00",
            ];
        }

        return $lines;
    }
}