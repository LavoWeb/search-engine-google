<?php
/**
 * @license see LICENSE
 */

namespace Serps\SearchEngine\Google\Parser\Raw;

use Serps\SearchEngine\Google\Page\GoogleDom;
use Serps\SearchEngine\Google\Parser\AbstractParser;
use Serps\SearchEngine\Google\Parser\Raw\Rule\Natural\ClassicalLargeVideo;
use Serps\SearchEngine\Google\Parser\Raw\Rule\Natural\ClassicalResult;
use Serps\SearchEngine\Google\Parser\Raw\Rule\Natural\ClassicalThumbVideo;
use Serps\SearchEngine\Google\Parser\Raw\Rule\Natural\ImageGroup;
use Serps\SearchEngine\Google\Parser\Raw\Rule\Natural\Map;

class NaturalParser extends AbstractParser
{

    /**
     * @inheritdoc
     */
    protected function generateRules()
    {
        return [
            new Map(),
            new ClassicalLargeVideo(),
            new ClassicalThumbVideo(),
            new ClassicalResult(),
            new ImageGroup()
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getParsableItems(GoogleDom $googleDom)
    {
        $xpathObject = $googleDom->getXpath();
        $xpathElementGroups =
            "//div[@id = 'ires']/descendant"
            . "::*[self::div or self::li][contains(concat(' ', normalize-space(@class), ' '), ' g ')]";
        return $xpathObject->query($xpathElementGroups);
    }
}
