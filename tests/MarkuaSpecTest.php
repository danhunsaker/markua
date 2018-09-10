<?php
namespace Danhunsaker\Markua\Tests;

use Danhunsaker\Markua\MarkuaConverter;

/**
 * Tests the parser against the Markua spec
 */
class MarkuaSpecTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var MarkuaConverter
     */
    protected $convertor;

    /**
     * @var HtmlRenderer
     */
    protected $htmlRenderer;

    protected function setUp()
    {
        $this->convertor = new MarkuaConverter();
    }

    /**
     * @param string $markdown Markdown to parse
     * @param string $html     Expected result
     *
     * @dataProvider dataProvider
     */
    public function testExample($title, $markdown, $html)
    {
        $this->setName($title);
        $actualResult = $this->convertor->convertToHtml($markdown);

        $this->assertEquals($html, $actualResult);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        foreach (glob(__DIR__ . '/spec/markua/*.txt') as $spec) {
            $test = array();
            foreach (file($spec) as $line) {
                if (preg_match('/=== (.*?) ===/', trim($line), $matches)) {
                    $section = $matches[1];
                    if (strtolower($section) == 'end') {
                        $tests[] = $test;
                        $test = array();
                        continue;
                    }
                    $test[$section] = '';
                } elseif (strtolower($section) != 'end') {
                    $test[$section] .= $line;
                }
            }
        }

        return $tests;
    }
}
