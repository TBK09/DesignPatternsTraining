<?php

require __DIR__ . '/vendor/autoload.php';

use ECommerce\Bundle;
use ECommerce\Product;
use Money\Money;
use Money\Currency;
use Math\Mass;

$currency = new Currency('EUR');

$productA = new Product('Prodct A', new Money(1200, $currency), new Mass(150));
$productB = new Product('Prodct B', new Money(4900, $currency), Mass::fromKilograms(1.23));
$productC = new Product('Prodct C', new Money(500, $currency), new Mass(900));

$bundle1 = new Bundle('Bundle1');
$bundle1->add($productA);
$bundle1->add($productB);


$bundle2 = new Bundle('Bundle2', new Money(60000, $currency));
$bundle2->add($bundle1);
$bundle2->add($productC);

echo '--- Pricing ---', "\n";
echo 'Product A ', format_price($productA->getPrice()), "\n";
echo 'Product B ', format_price($productB->getPrice()), "\n";
echo 'Product C ', format_price($productC->getPrice()), "\n";
echo 'Bundle A ', format_price($bundle1->getPrice()), "\n";
echo 'Bundle B ', format_price($bundle2->getPrice()), "\n";

echo '--- Masses ---', "\n";
echo 'Product A ', format_mass($productA->getMass()), "\n";
echo 'Product B ', format_mass($productB->getMass()), "\n";
echo 'Product C ', format_mass($productC->getMass()), "\n";
echo 'Bundle A ', format_mass($bundle1->getMass()), "\n";
echo 'Bundle B ', format_mass($bundle2->getMass()), "\n";

function format_price(Money $price) : string
{
    $formatter = new \NumberFormatter('nl_NL', \NumberFormatter::CURRENCY);

    return $formatter->formatCurrency($price->getAmount() / 100, $price->getCurrency());
}

function format_mass(Mass $mass) : string
{
    return sprintf('%u g', $mass->getValue());
}
