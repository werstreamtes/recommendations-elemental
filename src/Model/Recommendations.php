<?php

namespace WSE\Elemental\Recommendations\Model;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Extensions\ElementalAreasExtension;

class Recommendations extends BaseElement
{
    private static $icon = 'font-icon-block-file-list';

    private static $owns = [
        'Elements'
    ];

    private static $cascade_deletes = [
        'Elements'
    ];

    private static $cascade_duplicates = [
        'Elements'
    ];

    private static $extensions = [
        ElementalAreasExtension::class
    ];

    private static $table_name = 'RecommendationsElemental';

    private static $title = 'Grdffdoup';

    private static $description = 'Orderabfddffdle list of elements';

    private static $singular_name = 'lisfdfdfdt';

    private static $plural_name = 'lidfdfsts';

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'List');
    }

    public function inlineEditable()
    {
        return false;
    }
}
