<?php
/**
 * @file
 * uf_feedback.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uf_feedback_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}