<?php

namespace Illuminate\Support;

use Doctrine\Common\Inflector\Inflector;

class Pluralizer
{
    /**
     * Uncountable word forms.
     *
     * @var array
     */
    public static $uncountable = [
        'access',
        'accommodation',
        'advice',
        'audio',
        'bison',
        'business',
        'carbon',
        'cash',
        'chassis',
        'chess',
        'commerce',
        'compensation',
        'content',        
        'coreopsis',
        'damage',
        'data',
        'deer',
        'distribution',
        'education',
        'emoji',
        'energy',
        'entertainment',
        'equipment',
        'evidence',
        'failure',
        'feedback',
        'firmware',
        'fish',
        'furniture',
        'garbage',
        'gold',
        'hardware',
        'information',
        'jedi',
        'knowledge',
        'logic',
        'love',
        'metadata',
        'management',
        'money',
        'moose',
        'news',
        'nutrition',
        'offspring',
        'plankton',
        'pokemon',
        'police',
        'quality',
        'quantity',
        'rain',
        'rice',
        'series',
        'sheep',
        'software',
        'speed',
        'species',
        'success',
        'swine',
        'time',
        'traffic',
        'usage',
        'wheat',
    ];

    /**
     * Get the plural form of an English word.
     *
     * @param  string  $value
     * @param  int     $count
     * @return string
     */
    public static function plural($value, $count = 2)
    {
        if ((int) $count === 1 || static::uncountable($value)) {
            return $value;
        }

        $plural = Inflector::pluralize($value);

        return static::matchCase($plural, $value);
    }

    /**
     * Get the singular form of an English word.
     *
     * @param  string  $value
     * @return string
     */
    public static function singular($value)
    {
        $singular = Inflector::singularize($value);

        return static::matchCase($singular, $value);
    }

    /**
     * Determine if the given value is uncountable.
     *
     * @param  string  $value
     * @return bool
     */
    protected static function uncountable($value)
    {
        return in_array(strtolower($value), static::$uncountable);
    }

    /**
     * Attempt to match the case on two strings.
     *
     * @param  string  $value
     * @param  string  $comparison
     * @return string
     */
    protected static function matchCase($value, $comparison)
    {
        $functions = ['mb_strtolower', 'mb_strtoupper', 'ucfirst', 'ucwords'];

        foreach ($functions as $function) {
            if (call_user_func($function, $comparison) === $comparison) {
                return call_user_func($function, $value);
            }
        }

        return $value;
    }
}
