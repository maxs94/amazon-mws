<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Products;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use Maxs94\AmazonMws\DataType\Amazon\DataType;
use Maxs94\AmazonMws\DataType\Marketplace;
use Maxs94\AmazonMws\DataType\Products\FeesEstimateRequest;

class FeesEstimateRequestList extends DataType
{

    /**
     * parameter name 
     */
    public const NAME = 'FeesEstimateRequestList';

    protected $maxValues = 20;

    /**
     * @var FeesEstimateRequest
     */
    protected $feesEstimateRequestList = [];

    
    public function __construct(array $feesEstimateRequests) 
    {
        if (count($feesEstimateRequests) > $this->maxValues) {
            throw new \Exception(sprintf('max allowed values is %d', $this->maxValues));
        }

        foreach ($feesEstimateRequests as $fer) {
            if (!is_object($fer) || get_class($fer) != FeesEstimateRequest::class) {
                throw new \Exception('Invalid object, need to be FeesEstimateRequest!');
            }

            $this->feesEstimateRequestList[] = $fer;
        }

    }

    /**
     * Flattens an nested array of translations.
     * 
     * borrowed from Symfony\Component\Translation\Loader\ArrayLoader
     *
     * The scheme used is:
     *   'key' => array('key2' => array('key3' => 'value'))
     * Becomes:
     *   'key.key2.key3' => 'value'
     *
     * This function takes an array by reference and will modify it
     *
     * @param array  &$messages The array that will be flattened
     * @param array  $subnode   Current subnode being parsed, used internally for recursive calls
     * @param string $path      Current path being parsed, used internally for recursive calls
     */
    private function flatten(array &$messages, array $subnode = null, $path = null)
    {
        if (null === $subnode) {
            $subnode = &$messages;
        }
        foreach ($subnode as $key => $value) {
            if (is_array($value)) {
                $nodePath = $path ? $path : $key;
                $this->flatten($messages, $value, $nodePath);
                if (null === $path) {
                    unset($messages[$key]);
                }
            } elseif (null !== $path) {
                $messages[$path.'.'.$key] = $value;
            }
        }
    }

    public function getKeyValuePair() : array
    {
        // build the assoc array 
        $arr = [];
        $num = 1;
        foreach ($this->feesEstimateRequestList as $ferl) {

            $keyString = sprintf('FeesEstimateRequestList.FeesEstimateRequest.%d', $num);

            $arr = array_merge($arr, [
                $keyString => [
                    $ferl->getMarketplace()->getKeyValuePair(),
                    $ferl->getIdType()->getKeyValuePair(),
                    ['IdValue' => urlencode($ferl->getIdValue())],
                    ['IsAmazonFulfilled' => $ferl->getIsAmazonFulfilled()],
                    ['Identifier' => urlencode($ferl->getIdentifier())],
                    $ferl->getPriceToEstimateFees()->getKeyValuePair()
                ]
            ]);

            $num++;
        }

        // flatten the array 
        $this->flatten($arr);

        return $arr;

    }

    public function getName() : string
    {
        return self::NAME;
    }


}