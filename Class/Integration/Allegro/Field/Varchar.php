<?php

namespace App\Integration\Allegro\Field;

use App\Integration\Allegro\Field;

class Varchar implements Field {

    private $id;
    private $value;

    public function __construct($id, $value) {
        $this->id = $id;
        $this->value = $value;
    }

    public function get() {
        return array(
            'fid' => $this->id,
            'fvalueString' => $this->value,
            'fvalueInt' => 0,
            'fvalueFloat' => 0,
            'fvalueImage' => 0,
            'fvalueDatetime' => 0,
            'fvalueDate' => '',
            'fvalueRangeInt' => array(
                'fvalueRangeIntMin' => 0,
                'fvalueRangeInt-max' => 0
            ),
            'fvalueRange-float' => array(
                'fvalueRangeFloatMin' => 0,
                'fvalueRangeFloatMax' => 0,
            ),
            'fvalueRange-date' => array(
                'fvalueRangeDateMin' => '',
                'fvalueRangeDateMax' => '',
            ),
        );
    }

}

?>