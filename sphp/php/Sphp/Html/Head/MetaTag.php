<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\EmptyTag;

/**
 * Implements an HTML &lt;meta&gt; tag
 *
 *  The &lt;meta&gt; tag provides metadata about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parsable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MetaTag extends EmptyTag implements MetaData {

  /**
   * Constructor
   * 
   * @param  string[] $meta an array of attribute name value pairs
   */
  public function __construct(array $meta = []) {
    parent::__construct('meta');
    $this->attributes()->merge($meta);
  }

  /**
   * Returns the meta data as an array
   * 
   * @return string[] meta data as an array
   */
  public function toArray(): array {
    return $this->attributes()->toArray();
  }

  public function overlapsWith(HeadContent $other): bool {
    if (!$other instanceof MetaData) {
      return false;
    }
    $same = array_intersect_assoc($this->toArray(), $other->toArray());
    return array_key_exists('name', $same) ||
            array_key_exists('http-equiv', $same) ||
            array_key_exists('charset', $same) ||
            array_key_exists('property', $same);
  }

}
