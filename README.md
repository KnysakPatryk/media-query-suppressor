# Media Query Suppressor [![Build Status](https://travis-ci.org/KnysakPatryk/media-query-suppressor.png)](https://travis-ci.org/KnysakPatryk/media-query-suppressor)
This library helps you to "suppress" media queries in your dynamic content.
Why would you do that? You have to do that if your site is responsive (for example based on Bootstrap) and you want to create non-responsive (classic) version of your site for mobile devices.

## Attention
Many people creates media queries in many ways. For example they set them up to fire and achieve classic-like appearance, so the base CSS without media queries will be not full (classic) website, but (e.g.) mobile version. Website design should be coded in another way. Base CSS without media queries should be classic, desktop version and all media queries should apply to fit other devices. Wrongly coded website enforce us to:

1. rewrite all media queries (this can be painful)
2. or cleverly choose suppression strategy to overcome the issue (but it's not always possible)

## Installation

Edit your project's composer.json file to require knysakpatryk/media-query-suppressor
```javascript
"require": {
    "knysakpatryk/media-query-suppressor": "0.1.*"
}
```

## Usage
```php
$suppressionStrategy = new KnysakPatryk\MediaQuerySuppressor\Strategy\ReduceStrategy();
$mediaQuerySuppressor = new KnysakPatryk\MediaQuerySuppressor\Suppressor($suppressionStrategy);

echo $mediaQuerySuppressor->one('string');
// or
print_r($mediaQuerySuppressor->many(['string 1', 'string 2']));
```

## Suppression strategies

#### ReduceStrategy *(recommended)*
This strategy is upgraded *CutStrategy*. It sets *max-width* directives to *1px* (because desktop version of site should not have upper width limits) and replaces min-width directives with corresponding replacement starting from *1px*. By this, you can overcome the override issue of *CutStrategy*.

#### CutStrategy
It sets *max-width* directives to *1px* and *min-width* directives to *2px*. This strategy works in the most simple cases, but can go wrong with complicated ones - because you can accidentally override other media query (which was not intended).

## Example use case
Our client has website based on Bootstrap.
He wants to add classic version of the site - just by clicking on the button in the bottom of the page.
Classic version should not vary on different devices/screen sizes (non-responsive).

##### How can we do that?

1. First, we create another, non-responsive css spreadsheet for classic version (this step can be also done by this library).
2. Next, we use this library to "suppress" any other media queries from dynamic content (for example loaded from database).
3. Lastly, we add button at the bottom of the page, to switch website version.

In real world scenario, it's not going to be that easy, but this is only a simple use case example.

## License
The library is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
