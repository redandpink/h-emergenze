<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version7 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('sensor_event', 'sensor_event_place_id_places_id', array(
             'name' => 'sensor_event_place_id_places_id',
             'local' => 'place_id',
             'foreign' => 'id',
             'foreignTable' => 'places',
             ));
        $this->addIndex('sensor_event', 'sensor_event_place_id', array(
             'fields' => 
             array(
              0 => 'place_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('sensor_event', 'sensor_event_place_id_places_id');
        $this->removeIndex('sensor_event', 'sensor_event_place_id', array(
             'fields' => 
             array(
              0 => 'place_id',
             ),
             ));
    }
}