<?php

namespace Drupal\oe_starter_content\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\oe_whitelabel_helper\Plugin\Field\FieldFormatter\AddressInlineFormatter;

/**
 * Format an address according condition if Is online .
 *
 * @FieldFormatter(
 *   id = "oe_starter_content_address_conditioned",
 *   label = @Translation("OE Starter Content - address conditioned"),
 *   field_types = {
 *     "address",
 *   },
 * )
 *
 * @see https://github.com/openeuropa/oe_theme/blob/3.x/modules/oe_theme_helper/src/Plugin/Field/FieldFormatter/AddressInlineFormatter.php
 */
class AddressConditionedFormatter extends AddressInlineFormatter {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $node = $items->getEntity();
    // Is NOT online.
    if ($node->hasField('field_era_boolean') && empty($node->get('field_era_boolean')->getString())) {
      // Empty address.
      if ($items->isEmpty()) {
        return [['#markup' => $this->t('To be announced')]];
      }
      else {
        // Return value (using OE Whitelabel inline format).
        return parent::viewElements($items, $langcode);
      }
    }
    else {
      // Is online.
      return [['#markup' => $this->t('Online')]];
    }
  }

}