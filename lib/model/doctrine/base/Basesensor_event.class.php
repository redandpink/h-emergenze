<?php

/**
 * Basesensor_event
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property boolean $temp
 * @property boolean $water
 * @property boolean $gas
 * @property boolean $earthquake
 * @property string $description
 * @property integer $place_id
 * @property places $places
 * 
 * @method integer      getId()          Returns the current record's "id" value
 * @method boolean      getTemp()        Returns the current record's "temp" value
 * @method boolean      getWater()       Returns the current record's "water" value
 * @method boolean      getGas()         Returns the current record's "gas" value
 * @method boolean      getEarthquake()  Returns the current record's "earthquake" value
 * @method string       getDescription() Returns the current record's "description" value
 * @method integer      getPlaceId()     Returns the current record's "place_id" value
 * @method places       getPlaces()      Returns the current record's "places" value
 * @method sensor_event setId()          Sets the current record's "id" value
 * @method sensor_event setTemp()        Sets the current record's "temp" value
 * @method sensor_event setWater()       Sets the current record's "water" value
 * @method sensor_event setGas()         Sets the current record's "gas" value
 * @method sensor_event setEarthquake()  Sets the current record's "earthquake" value
 * @method sensor_event setDescription() Sets the current record's "description" value
 * @method sensor_event setPlaceId()     Sets the current record's "place_id" value
 * @method sensor_event setPlaces()      Sets the current record's "places" value
 * 
 * @package    h-emergenze
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basesensor_event extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sensor_event');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('temp', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('water', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('gas', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('earthquake', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('place_id', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('places', array(
             'local' => 'place_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}