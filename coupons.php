<?php
/**
 * Class ${NAME}
 */

require __DIR__ . '/vendor/autoload.php';

use ECommerce\Sale;
use ECommerce\Coupon\RateCoupon;
use ECommerce\Coupon\ValueCoupon;
use Money\Money;
use ECommerce\Coupon\Restriction\LimitedLifetimeRestriction;
use ECommerce\Coupon\Address;
use ECommerce\Coupon\Restriction\TerritoryRestriction;


$addressUS = new Address('US');
$addressDE = new Address('DE');
$addressUK = new Address('UK');
$sale1 = new Sale(Money::EUR(15900), $addressDE);
$sale2 = new Sale(Money::EUR(1900), $addressUS);
$sale3 = new Sale(Money::EUR(29180), $addressUK);

$coupon1 = new LimitedLifetimeRestriction(
    new ValueCoupon('F0012345', Money::EUR(2000)),
    new \DateTimeImmutable('now')
);

$coupon2 = new LimitedLifetimeRestriction(
    new RateCoupon('BA12245', .3),
    new \DateTimeImmutable('now')
);

$coupon3 = new TerritoryRestriction(
    new ValueCoupon('KO0023391', Money::EUR(2000)),
    ['DE', 'US', 'FR']
);

$sale1->discount($coupon1->calculateDiscount($sale1));
$sale2->discount($coupon2->calculateDiscount($sale2));
$sale3->discount($coupon3->calculateDiscount($sale3));


echo '--- Pricing ---', "\n";
echo 'Sale 1 ', format_price($sale1->getTotalAmount()), "\n";
echo 'Sale 2 ', format_price($sale2->getTotalAmount()), "\n";
echo 'Sale 3 ', format_price($sale3->getTotalAmount()), "\n";

echo '--- Discounts ---', "\n";
echo 'Sale 1 ', format_price($sale1->getDiscount()), "\n";
echo 'Sale 2 ', format_price($sale2->getDiscount()), "\n";
echo 'Sale 3 ', format_price($sale3->getDiscount()), "\n";

function format_price(Money $price) : string
{
    $formatter = new \NumberFormatter('nl_NL', \NumberFormatter::CURRENCY);

    return $formatter->formatCurrency($price->getAmount() / 100, $price->getCurrency());
}
