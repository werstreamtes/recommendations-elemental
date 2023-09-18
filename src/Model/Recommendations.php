<?php

namespace WSE\Elemental\Recommendations\Model;

use Content;
use DNADesign\Elemental\Forms\TextCheckboxGroupField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\ValidationException;

/**
 * @property mixed|null $ContentID
 * @method Content Content()
 */
class Recommendations extends BaseElement
{

    /**
     * @var string
     */
    private static string $icon = 'font-icon-dot-3';

    /**
     * @var string
     */
    private static string $table_name = 'RecommendationsElemental';

    /**
     * @var string
     */
    private static string $title = 'Recommendations';

    /**
     * @var string
     */
    private static string $description = 'Recommendations slider';

    /**
     * @var string
     */
    private static string $singular_name = 'Recommendation';

    /**
     * @var string
     */
    private static string $plural_name = 'Recommendations';

    /**
     * @var string[]
     */
    private static array $has_one = [
        'Content' => Content::class
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::$plural_name;
    }

    /**
     * @return bool
     */
    public function inlineEditable(): bool
    {
        return true;
    }

    /**
     * @return string|null
     */
    public function getElementLinkTarget(): ?string
    {
        if ($this->ContentID) {
            return sprintf('%s/wie-%s', $this->Content()->getURLString(), $this->ContentID);
        }
        return null;
    }

    /**
     * @return mixed|DataObject|DBField|string|null
     */
    public function getTitle() {
        return $this->getField('Title') ?? 'Das könnte dir auch gefallen';
    }

    /**
     * @return string|null
     */
    public function getElementLinkText(): ?string
    {
        return $this->ContentID ? 'alle anzeigen' : null;
    }

    /**
     * @return FieldList
     */
    public function getCMSFields(): FieldList
    {

        $fields = parent::getCMSFields();

        $fields->removeFieldsFromTab('Root.Main', [
            'ElementLinkTarget',
            'ElementLinkText',
            'ElementTitleLogo',
            'ElementDescription',
        ]);

        return $fields;

    }

    /**
     * @return string
     */
    public function NewTitle(): string
    {
        $title = $this->getField('Title');
        if ($this->ContentID) {
            $title = str_replace('%TITLE%', $this->Content()->Title, $title);
        }
        return $title;
    }

    /**
     * @return ArrayList
     */
    public function Results(): ArrayList
    {

        $items = ArrayList::create();

        // Check if a ContentID exists. If yes, get suggestions from the Content Object.
        if ($this->ContentID) {
            foreach ($this->Content()->SimilarContent() as $content) {
                $items->push($content);
            }
        } else {
            // Check whether a ContentID was passed as a request parameter to automatically load content.
            // There is no use-case yet because the detail page is not rendered with Elemental.
        }

        return $items;
    }

    /**
     * @return array
     * @throws ValidationException
     */
    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();
        if ($this->ContentID) {
            $blockSchema['content'] = "Vorschläge basierend auf „{$this->Content()->Title}”";
        }
        return $blockSchema;
    }

}
