<td colspan="7">
  <?php echo __('%%id%% - %%name%% - %%description%% - %%emergency%% - %%place_type%% - %%latitude%% - %%longitude%%', array('%%id%%' => link_to($places->getId(), 'places_edit', $places), '%%name%%' => $places->getName(), '%%description%%' => $places->getDescription(), '%%emergency%%' => get_partial('places/list_field_boolean', array('value' => $places->getEmergency())), '%%place_type%%' => $places->getPlaceType(), '%%latitude%%' => $places->getLatitude(), '%%longitude%%' => $places->getLongitude()), 'messages') ?>
</td>
