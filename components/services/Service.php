<?php
namespace infoweb\flexmail\components\services;

use Yii;

class Service
{    
    /**
     * Reove header/error codes from the response
     * 
     * @param   stdClass $response  The response from the API
     * @return  stdClass            The same stdClass without the header information
     */
    public static function stripHeader($response)
    {   
        if (!Yii::$app->flexmail->debugMode) {
            $valuesToStrip = ["header","errorCode","errorMessage"];

            foreach ($valuesToStrip as $value) {
                if (property_exists($response, $value)) {
                    unset ($response->$value);
                }
            }
        }
        
        return $response;
    } 
    
    /**
     * Convert two-(or-more)-dimensional arrays to an stdClass object
     * 
     * @param   array    $arr       The array to convert
     * @param   stdClass $parent    The object to convert it to
     * @return  stdClass            The converted array
     */
    protected function parseArray(array $arr, \stdClass $parent = null)
    {   
        if ($parent === null) {
            $parent = $this;
        }

        foreach ($arr as $key => $val) {
            if (is_array($val) AND $key != "custom" AND substr($key, -3) != "Ids") {
                $parent->$key = $this->parseArray($val, new \stdClass);
            } else {
                $parent->$key = $val;
            }
        }

        return $parent;
    }    
}