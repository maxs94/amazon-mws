<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Feeds;

use Maxs94\AmazonMws\DataType\Amazon\AmazonStringList;

class FeedTypeList extends AmazonStringList
{

    /**
     * @var array
     */
    protected $values;

    /**
     * parameter name
     */
    public const NAME = 'FeedTypeList';

    /**
     * @var string
     */
    protected $suffix = 'Type';

    public function __construct(array $values)
    {
       
        foreach ($values as $value) {
            if (!is_object($value) || get_class($value) != FeedType::class) {
                throw new \Exception('Invalid object, needs to be FeedType!');
            }

            $this->values[] = $value;
        }

    }



}