<?php

namespace Drupal\extraspace_filter\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Filters empty HTML tags and extra non-breaking spaces.
 *
 * @Filter(
 *   id = "extraspace_filter_filter",
 *   title = @Translation("Filter extra space"),
 *   description = @Translation("Filters empty HTML tags and extra non-breaking spaces."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE,
 * )
 */
class FilterExtraspace extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {

    // Remove empty paragraph tags.
    $text = preg_replace('/\<p(\s[^\>]*)*\>(\s|\xC2\xA0|&nbsp;)*\<\/p\>/i', '', $text);

    // Remove multiple non-breaking spaces.
    $text = preg_replace('/(&nbsp;)(\n|\r|\t|\s|\xC2\xA0|&nbsp;)+/i', '$1', $text);

    // Remove multiple line-breaks
    // Cleanup beginnings of paragraphs.
    $text = preg_replace('/(\<br\>|\<br \/\>|\<p\>)(\n|\r|\t|\s|\xC2\xA0|&nbsp;|\<br\>|\<br \/\>)+/i', '$1', $text);

    return new FilterProcessResult($text);

  }

}
