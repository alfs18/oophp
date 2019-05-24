<?php
namespace Alfs\MyTextFilter;

use \Michelf\Markdown;

/**
 * Filter and format text content.
 *
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 * @SuppressWarnings(PHPMD.UnusedPrivateField)
 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class MyTextFilter
{
    /**
     * Helper, BBCode formatting converting to HTML.
     *
     * @param string $text The text to be converted.
     *
     * @return string The formatted text.
     */
    public function bbcode2html($text)
    {
        $search = [
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](.*?)\[\/img\]/is',
            '/\[url\](.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        ];

        $replace = [
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        ];

        return preg_replace($search, $replace, $text);
    }

    /**
     * Make clickable links from URLs in text.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string with formatted anchors.
     */
    public function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            function ($matches) {
                return "<a href=\"{$matches[0]}\">{$matches[0]}</a>";
            },
            $text
        );
    }

    /**
     * Format text according to Markdown syntax.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string as the formatted html text.
     */
    public function markdown($text)
    {
        return Markdown::defaultTransform($text);
    }

    /**
     * For convenience access to nl2br formatting of text.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string the formatted text.
     */
    public function nl2br($text)
    {
        // echo "smask: <br>" . $text . "<br><br>";
        return nl2br($text);
    }

    /**
     * Call each filter on the text and return the processed text.
     *
     * @param string $text  The text to filter.
     * @param array  $filter Array of filters to use.
     *
     * @return string with the formatted text.
     */
    public function parse($text, $filter)
    {
        // $res = "";
        foreach ($filter as $val) {
            if ($val == "bbcode") {
                $text = $this->bbcode2html($text);
            } elseif ($val == "link") {
                $text = $this->makeClickable($text);
            } elseif ($val == "markdown") {
                $text = $this->markdown($text);
            } elseif ($val == "nl2br") {
                $text = $this->nl2br($text);
            }
        }
        return $text;
    }

    /**
     * Show the process of the filters.
     *
     * @param string $text  The text to filter.
     * @param array  $filter Array of filters to use.
     *
     * @return string with the formatted text.
     */
    public function showParse($text, $filter)
    {
        $res = "";
        foreach ($filter as $val) {
            if ($val == "bbcode") {
                $res .= "<br><br>bbcode: <br>" . $this->bbcode2html($text);
            } elseif ($val == "link") {
                $res .= "<br><br>link: <br>". $this->makeClickable($text);
            } elseif ($val == "markdown") {
                $res .= "<br><br>markdown: <br>" . $this->markdown($text);
            } elseif ($val == "nl2br") {
                $res .= "<br><br>nl2br: <br>" . $this->nl2br($text);
            }
        }
        return $res;
    }
}
