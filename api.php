<?php
/**
 * This file is part of "avvmonitor"
 *
 * @author Sebastian Antosch <s.antosch@i-san.de>
 * @copyright 2017 I-SAN.de Webdesign & Hosting GbR
 * @link http://i-san.de
 *
 * @license MIT
 *
 * @see http://data.linz.gv.at/katalog/linz_ag/linz_ag_linien/fahrplan/LINZ_LINIEN_Schnittstelle_EFA_V1.pdf
 */

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//ini_set('xdebug.var_display_max_depth', -1);
//error_reporting(E_ERROR);

/**
 * Class Departure
 */
class Departure
{
    /** @var int */
    public $line;

    /** @var string */
    public $type;

    /** @var string */
    public $stop;

    /** @var string */
    public $platform;

    /** @var int */
    public $countdown;

    /** @var string */
    public $time;

    /** @var string */
    public $direction;

    /** @var string */
    public $description;
}

/**
 * Class AvvMonitor
 */
class AvvMonitor
{

    /**
     * @var string
     */
    protected $haltestelle;

    /**
     * @var string
     */
    protected $sessionId;

    /**
     * @var array
     */
    protected $departures;

    /**
     * AvvMonitor constructor.
     * @param $haltestelle
     */
    public function __construct($haltestelle)
    {
        $this->haltestelle = $haltestelle;
    }

    /**
     * Generates the session id
     */
    protected function setupRequest()
    {
        $doc = simplexml_load_file('https://efa.avv-augsburg.de/avv2/XML_DM_REQUEST?sessionID=0&locationServerActive=1&type_dm=any&name_dm=' . $this->haltestelle. '&limit=10&anyObjFilter_dm=2');
        $this->sessionId = $doc->attributes()->sessionID;
    }

    /**
     * Fetches the info for the station
     */
    protected function fetchInfo()
    {
        $doc = simplexml_load_file('https://efa.avv-augsburg.de/avv2/XML_DM_REQUEST?sessionID=' . $this->sessionId . '&requestID=1&dmLineSelectionAll=1');
        $this->departures = $doc->itdDepartureMonitorRequest->itdDepartureList->children();
    }

    /**
     * Fetches the departures
     * @return Departure[]
     */
    public function getDepartures()
    {
        $this->setupRequest();
        $this->fetchInfo();
        $departures = [];
        foreach ($this->departures as $dep) {
            $d = new Departure();
            $d->line        = (int)$dep->itdServingLine->attributes()->number;
            $d->type        = (String)$dep->itdServingLine->itdNoTrain->attributes()->name;
            $d->stop        = (String)$dep->attributes()->stopName;
            $d->platform    = (String)$dep->attributes()->platformName;
            $d->countdown   = (String)$dep->attributes()->countdown;
            $d->time        = (String)$dep->itdDateTime->itdTime->attributes()->hour
                                . ':' . str_pad((String)$dep->itdDateTime->itdTime->attributes()->minute, 2, '0', STR_PAD_LEFT);
            $d->direction   = (String)$dep->itdServingLine->attributes()->direction;
            $d->description = (String)$dep->itdServingLine->itdRouteDescText;
            $departures[] = $d;
        }

        return $departures;
    }
}

$station = isset($_GET['station']) ? $_GET['station'] : 'Haunstetten West P+R';
$avvmon = new AvvMonitor($station);
header('Content-Type: application/json');
echo json_encode($avvmon->getDepartures(), JSON_PRETTY_PRINT);