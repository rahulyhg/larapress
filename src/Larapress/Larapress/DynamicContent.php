<?php

namespace Larapress\Larapress;

/**
 * This class recives the content string(usually from a database), converts it
 * into a XML object, scans for elements named $tag. It then returns an array
 * of template and content sections to be displayed in order.
 * 
 * So from the content block on the TinyMCE you can add a shortcode like this
 * "here is your content<partial view="plugin" id="2">ellement content</partial>"
 * which will include a view called plugin.blade.php in \Config->partials folder
 */
class DynamicContent {

    protected $exploder = '!*!'; //used to seperate content
    
    protected $package; //name of the package calling this dynamicContent
    
    protected $tag; //Tag in the content to use as the partializer

    public function __construct($raw, $package, $tag = 'partial') {
        $this->tag = $tag;

        $this->package = $package;
        
        $this->rawContent = $this->prepContent($raw);
    }

    /**
     * Assemble the content string to be valid XML, and formatted correctly
     * @param type $string
     * @return string
     */
    public function prepContent($string) {
        $string = str_replace('&lt;', '<', $string);
        $string = str_replace('&gt;', '>', $string);
        $string = str_replace('&nbsp;', ' ', $string);
        $string = str_replace('[' . $this->tag, '<' . $this->tag, $string);
        $string = str_replace('[/' . $this->tag . ']', '</' . $this->tag . '>', $string);
        $string = str_replace(']', '>', $string);
        $string = '<section>' . $string . '</section>';
        return $string;
    }

    /**
     * Check to see if tag as a view attribute with a specified package name,
     * if so, extract and create package_view attr else make to calling package
     * @param type $attrs
     */
    public function validateAttrs($attrs) {
        for($x=0; $x<count($attrs); $x++) {
            if (isset($attrs[$x]["view"]) && strpos($attrs[$x]["view"], '::')) {
                $tmp = explode('::', $attrs[$x]["view"]);
                $attrs[$x]["package_view"] = $tmp[0] . '::partials';
                $attrs[$x]["view"] = $tmp[1];
            }
            else{
                $attrs[$x]["package_view"] = $this->package.'::partials';
            }
        }
        return $attrs;
    }

    /**
     * Get all the tag attributes of all template elements
     * @param type $doc
     * @return array
     */
    protected function getTagDetails($doc) {
        $tags = array();
        $results = array();
        foreach ($doc->getElementsByTagName($this->tag) as $tag) {
            $tags["content"] = $tag->nodeValue;
            if ($tag->hasAttributes()) {
                foreach ($tag->attributes as $attr) {
                    $tags[$attr->nodeName] = $attr->nodeValue;
                }
            }
            array_push($results, $tags);
        }
        return $results;
    }

    /**
     * Create a DOM element of the content to be searched for elements
     * then validate before returning.
     * @param type $string
     * @return array
     */
    public function getPartials($string) {
        $doc = new \DOMDocument();
        $doc->loadXML($string);
        $attrs = $this->getTagDetails($doc);
        $results = $this->validateAttrs($attrs);
        return isset($results) ? $results : null;
    }

    /**
     * Convert the tags into obscure code to then be removed
     * @return string
     */
    public function replaceTags() {
        $reg = '#<' . $this->tag . '[^>]*>.*?</' . $this->tag . '>#si';
        return preg_replace($reg, $this->exploder, $this->rawContent);
    }

    /**
     * Return an array of all the content sections split by the partials
     * @return content
     */
    public function getContent() {
        return explode($this->exploder, $this->replaceTags());
    }

    /**
     * Start the class going, the main call
     */
    public function getDynamicContent() {
        $this->partials = $this->getPartials($this->rawContent);
        $this->contents = $this->getContent();
    }

}
