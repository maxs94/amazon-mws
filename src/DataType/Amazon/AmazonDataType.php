<?php declare(strict_types=1);

namespace Maxs94\AmazonMws\DataType\Amazon;

final class AmazonDataType 
{
    public const STRING = 'string';
    public const ARRAY = 'array';
    public const FEES_ESTIMATE_REQUEST = FeesEstimateRequestList::class;
    public const INT = 'integer';
    public const DATETIME = 'DateTime';
    public const ORDER_STATUS = ['PendingAvailability', 'Pending', 'Unshipped', 'PartiallyShipped', 'Shipped', 'Canceled', 'Unfulfillable'];
    public const EASY_SHIP_SHIPMENT_STATUS = ['PendingPickUp', 'LabelCanceled', 'PickedUp', 'OutForDelivery', 'Damaged', 'Delivered', 'RejectedByBuyer', 'Undeliverable', 'ReturnedToSeller', 'ReturningToSeller', 'Lost'];
    public const ID_TYPE = ['ASIN', 'GCID', 'SellerSKU', 'UPC', 'EAN', 'ISBN', 'JAN'];
    public const ITEM_CONDITION = ['Any', 'New', 'Used', 'Collectible', 'Refurbished', 'Club'];
}

