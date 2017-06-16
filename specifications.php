<?php
/**
 * Class ${NAME}
 */

require __DIR__ . '/vendor/autoload.php';

use ECommerce\Coupon\Address;
use ECommerce\Coupon\RestrictionSpecification\LifetimeRestrictionSpecification;
use ECommerce\Coupon\RestrictionSpecification\TerritoryRestrictionSpecification;
use ECommerce\Sale;
use Money\Money;
use ECommerce\Coupon\ValueCoupon;
use ECommerce\Coupon\RateCoupon;
use Money\Currency;


$addressUS = new Address('US');
$addressDE = new Address('DE');
$addressUK = new Address('UK');
$sale1 = new Sale(Money::EUR(15900), $addressDE);
$sale2 = new Sale(Money::EUR(1900), $addressUS);

$yesterday = new DateTime('2017-01-01');
$tomorrow = new DateTime('2017-08-08');

$specification = (new TerritoryRestrictionSpecification(
    ['EU', 'US', 'DE']
))->andX(new LifetimeRestrictionSpecification($yesterday, $tomorrow));
$specification2 = (new TerritoryRestrictionSpecification(
    ['EU', 'US', 'DE']
))->orX(new LifetimeRestrictionSpecification($yesterday, $tomorrow));


$coupon = new ValueCoupon('ABC281', new Money(5000, new Currency('EUR')));
$coupon2 = new RateCoupon('R123', .2);
if ($specification->isSatisfiedBy($sale1)) {
    echo "Coupon1 applied! \n";
    $sale1->discount($coupon->calculateDiscount($sale1));
} else {
    echo "Coupon1 not applied! \n";
}
if ($specification2->isSatisfiedBy($sale2)) {
    echo "Coupon2 applied! \n";
    $sale2->discount($coupon2->calculateDiscount($sale2));
} else {
    echo "Coupon2 not applied! \n";
}

echo '--- Pricing ---', "\n";
echo 'Sale 1 ', format_price($sale1->getTotalAmount()), "\n";
echo 'Sale 2 ', format_price($sale2->getTotalAmount()), "\n";

echo '--- Discounts ---', "\n";
echo 'Sale 1 ', format_price($sale1->getDiscount()), "\n";
echo 'Sale 2 ', format_price($sale2->getDiscount()), "\n";

function format_price(Money $price) : string
{
    $formatter = new \NumberFormatter('nl_NL', \NumberFormatter::CURRENCY);

    return $formatter->formatCurrency($price->getAmount() / 100, $price->getCurrency());
}
