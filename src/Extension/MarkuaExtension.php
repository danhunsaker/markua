<?php
namespace Danhunsaker\Markua\Extension;

use League\CommonMark\Block\Parser as BlockParser;
use League\CommonMark\Extension\CommonMarkCoreExtension;
use Danhunsaker\Markua\Block\Parser as MarkuaBlockParser;
use Danhunsaker\Markua\Block\Renderer\AsideRenderer;
use Danhunsaker\Markua\Block\Renderer\IconBlockRenderer;

class MarkuaExtension extends CommonMarkCoreExtension
{

    /**
     * {@inheritdoc}
     */
    public function getBlockParsers()
    {
        return array(
            // This order is important
            new BlockParser\IndentedCodeParser(),
            new BlockParser\LazyParagraphParser(),
            new BlockParser\BlockQuoteParser(),
            new MarkuaBlockParser\AsideParser(),
            new MarkuaBlockParser\IconBlockParser(),
            new BlockParser\ATXHeadingParser(),
            new BlockParser\FencedCodeParser(),
            new BlockParser\HtmlBlockParser(),
            new BlockParser\SetExtHeadingParser(),
            new BlockParser\ThematicBreakParser(),
            new BlockParser\ListParser(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockRenderers()
    {
        $renderers = parent::getBlockRenderers();
        $renderers['Danhunsaker\Markua\Block\Element\Aside'] = new AsideRenderer();
        $renderers['Danhunsaker\Markua\Block\Element\IconBlock'] = new IconBlockRenderer();
        return $renderers;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'markua';
    }
}
