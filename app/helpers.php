<?php

use App\Models\User;

/**
 * Gets the currently authenticated user.
 * @return User|null The user if logged in; otherwise, null.
 */
function user(): User
{
    return auth()->user();
}

/**
 * Gets the abbreviated version of the number.
 * @param string|int|float $number
 * @return string The abbreviated number.
 */
function abbreaviate($number)
{
    if ($number < 1_000) {
        return $number;
    }

    $suffix = $number >= 1_000_000 ? 'm' : 'k';
    $number /= $suffix === 'm' ? 1_000_000 : 1_000;
    
    // floatval() to remove unwanted decimal zeros
    // substr() to only get 1 decimal place
    return floatval(substr($number, 0, strpos($number, '.') + 2)) . $suffix;
}

/**
 * Removes script tags from the provided html.
 * @param string $html The string to remove the script tags from.
 * @return void
 */
function preventXSS(string $html)
{
    $dom = new DOMDocument();
    $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED|LIBXML_HTML_NODEFDTD);

    $scriptTags = $dom->getElementsByTagName('script');

    foreach ($scriptTags as $script) {
        $script->parentNode->removeChild($script);
    }

    return $dom->saveHTML();
}