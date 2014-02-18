<?php

/**
 * @file
 * Services callbacks.
 */

/**
 * Returns a form array based on form_id.
 *
 * @param $form_id
 *   The form_id of the form to retrieve.
 * @param $nid
 *   The nid of the node to edit.
 * @return
 *   The form array.
 */
function _uf_edit_retrieve($form_id, $nid) {
  // Load node form pages.
  module_load_include('inc', 'node', 'node.pages');

  // Load node so we can add it to the form.
  $node = node_load($nid);

  // Load the form.
  $form_state = array();
  $form_state['build_info']['args'] = array($node);
  drupal_build_form($form_id, $form_state);
  $values = $form_state['values'];
  unset($values['form_build_id']);
  unset($values['form_token']);

  // Modify the data structure based on $form_id.
  _uf_edit_format_values_retrieval($form_id, $values);

  return $values;
}

/**
 * Returns an array of form values based on uid.
 *
 * @param $uid
 *   The uid of the node to edit.
 * @return
 *   The form values array.
 */
function _uf_edit_user_retrieve($uid) {
  // Load user form pages.
  module_load_include('inc', 'user', 'user.pages');

  // Load user so we can add it to the form.
  $user = user_load($uid);

  // Load the form.
  $form_id = 'user_profile_form';
  $form_state = array();
  $form_state['build_info']['args'] = array($user);
  drupal_build_form($form_id, $form_state);
  $values = $form_state['values'];
  unset($values['form_build_id']);
  unset($values['form_token']);

  // Modify the data structure based on $form_id.
  _uf_edit_format_values_retrieval($form_id, $values);

  return $values;
}

/**
 * Format values array for retrieval.
 */
function _uf_edit_format_values_retrieval($form_id, &$values) {
  switch ($form_id) {
    case 'user_profile_form':
      // Create public img tag for avatar.
      $config = array(
        "style_name" => "medium",
        "path" => $values['field_avatar']['und'][0]['uri'],
        "height" => $values['field_avatar']['und'][0]['height'],
        "width" => $values['field_avatar']['und'][0]['width'],
       );
      $values['field_avatar']['und'][0]['html'] = theme_image_style($config);
      break;
    case 'project_profile_node_form':
      // Modify start time.
      $start_time = strtotime($values['field_start_date']['und'][0]['value']);
      $start_time = date('M j, Y', $start_time);
      $values['field_start_date']['und'][0]['value'] = array('date' => $start_time);
      // Modify start time.
      $end_time = strtotime($values['field_start_date']['und'][0]['value2']);
      $end_time = date('M j, Y', $end_time);
      $values['field_start_date']['und'][0]['value2'] = array('date' => $end_time);

      // Create public img tag for avatar.
      $config = array(
        "style_name" => "medium",
        "path" => $values['field_avatar']['und'][0]['uri'],
        "height" => $values['field_avatar']['und'][0]['height'],
        "width" => $values['field_avatar']['und'][0]['width'],
       );
      $values['field_avatar']['und'][0]['html'] = theme_image_style($config);

      // Explode values in array.
      $values['field_skill']['und'] = explode(', ', $values['field_skill']['und']);
      break;
  }
}

/**
 * Creates a new form submission based on submitted values.
 *
 * Note that this function uses drupal_form_submit() to create new submissions,
 * which may require very specific formatting. The full implications of this
 * are beyond the scope of this comment block. The Googles are your friend.
 *
 * @param $form_id
 *   The form_id we're submitting.
 * @param $nid
 *   The nid of the node to edit.
 * @param $values
 *   Array representing the form values.
 * @return
 *   An associative array contained the returned object.
 */
function _uf_edit_submit($form_id, $nid, $values) {
  // Load node form pages.
  module_load_include('inc', 'node', 'node.pages');

  // Load node so we can add it to the form.
  $node = node_load($nid);

  // Modify the values structure based on $form_id.
  _uf_edit_format_values_submission($form_id, $values);

  // Load the form.
  $form_state = array();
  $form_state['values'] = $values;
  $form_state['values']['op'] = t('Save');
  $form_state['build_info']['args'] = array($node);
  drupal_form_submit($form_id, $form_state, $node);

  // Submit form programmatically.
  // node_form_submit($form, $form_state);

  if ($errors = form_get_errors()) {
    return services_error(implode(" ", $errors), 406, array('form_errors' => $errors));
  }

  return drupal_get_messages();
}

/**
 * Format values array for submission.
 */
function _uf_edit_format_values_submission($form_id, &$values) {
  switch ($form_id) {
    case 'project_profile_node_form':
      // Modify start time.
      $start_time = strtotime($values['field_start_date']['und'][0]['value']['date']);
      $start_time = date('m/d/Y', $start_time);
      $values['field_start_date']['und'][0]['value']['date'] = $start_time;
      // Modify start time.
      $end_time = strtotime($values['field_start_date']['und'][0]['value2']['date']);
      $end_time = date('m/d/Y', $end_time);
      $values['field_start_date']['und'][0]['value2']['date'] = $end_time;

      // Modify taxonomy from array.
      $values['field_skill']['und'] = implode(', ', $values['field_skill']['und']);
      break;
  }

  // Update "changed".
  $values['changed'] = time();
}

/**
 * Format values array for submission.
 *
 * @param $field_ids
 *   String, seperated by comma of field ids to get.
 */
function _uf_field_retrieve($field_ids = '') {
  $field_ids = explode(',', $field_ids);
  $options = array();

  foreach (array_filter($field_ids) as $field_id) {
    $options[$field_id] = _uf_field_get_options($field_id);
  }

  return $options;
}

/**
 * Find options for particular fields.
 *
 * @param $field_id
 *   The field_id to get options for.
 */
function _uf_field_get_options($field_id) {
  $field = field_info_field($field_id);
  $options = array();

  switch ($field['type']) {
    case 'taxonomy_term_reference':
      $options = taxonomy_allowed_values($field);
    break;
  }

  return array_values($options);
}