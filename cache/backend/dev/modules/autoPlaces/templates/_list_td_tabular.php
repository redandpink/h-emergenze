<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($places->getId(), 'places_edit', $places) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $places->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $places->getDescription() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_emergency">
  <?php echo get_partial('places/list_field_boolean', array('value' => $places->getEmergency())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_place_type">
  <?php echo $places->getPlaceType() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_latitude">
  <?php echo $places->getLatitude() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_longitude">
  <?php echo $places->getLongitude() ?>
</td>
