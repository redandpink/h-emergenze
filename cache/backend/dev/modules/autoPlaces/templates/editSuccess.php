<?php use_helper('I18N', 'Date') ?>
<?php include_partial('places/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Places', array(), 'messages') ?></h1>

  <?php include_partial('places/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('places/form_header', array('places' => $places, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('places/form', array('places' => $places, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('places/form_footer', array('places' => $places, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
