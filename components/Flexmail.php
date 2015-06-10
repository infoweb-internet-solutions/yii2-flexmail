<?php
namespace infoweb\flexmail\components;

use Yii;

class Flexmail extends \yii\base\Component
{
    /**
     * The Flexmail API user id
     * @var int
     */
    public $userId;
    
    /**
     * The Flexmail API user token
     * @var string
     */
    public $userToken;
    
    /**
     * The location of the Flexmail API WSDL file
     * @var string
     */
    public $wsdlLocation = 'http://soap.flexmail.eu/3.0.0/flexmail.wsdl';
    
    /**
     * The entry-script of the Flexmail API
     * @var string
     */
    public $serviceLocation = 'http://soap.flexmail.eu/3.0.0/flexmail.php';
    
    /**
     * Debug mode toggle
     * @var boolean
     */
    public $debugMode = false;
    
    /**
     * @var SoapClient
     */
    protected $soapClient = null;
    
    public function init()
    {
        if (!$this->userId) {
            throw new \Exception('The Flexmail API user id is not set');
        } elseif (!$this->userToken) {
            throw new \Exception('The Flexmail API user token is not set');
        }
        
        parent::init();    
    }
    
    /**
     * Get the request Service Instance
     * 
     * @param   string $service Requested service name
     * @return  object          An instance of the requested service
     */
    public function service($service)
    {          
        return Yii::createObject("infoweb\\flexmail\\components\\services\\{$service}");
    }
    
    /**
     * Execute the requested call
     * 
     * @param   string $service     The name of the service to execute
     * @param   array  $parameters  All parameter in an assiociative array
     * @return  type
     * @throws  Exception
     */
    public function execute($service, $parameters)
    {
        // make sure a SOAP client exists
        if (is_null($this->soapClient)) {
            $this->createSoapClient();
        }

        // create a request object (an stdClass) from the parameters array
        $request = (object) $parameters;
        
        // add authentication to the request object
        $request->header = $this->getRequestHeader();
        
        // execute the call
        $response = $this->soapClient->__soapCall($service, array($request));
        
        // return the response
        return $response;
    }
    
    /**
     * Create a new SOAP Client
     * 
     * @returns void
     */
    private function createSoapClient()
    {
        // create a new SoapClient instance
        $this->soapClient = new \SoapClient(
            $this->wsdlLocation,
            array("location" => $this->serviceLocation,
                  "uri"      => $this->serviceLocation,
                  "trace"    => 1,
            )
        );
    }

    /**
     * Function to create the user's personal request header
     * 
     * @return stdClass The user's personal header
     */
    private function getRequestHeader ()
    {
        $header = new \stdClass;
        
        $header->userId    = $this->userId;
        $header->userToken = $this->userToken;
        
        return $header;
    }   
}