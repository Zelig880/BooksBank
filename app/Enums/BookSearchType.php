<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BookSearchType extends Enum
{
    const ISBN =   'isbn';
    const Title =   'title';
    const Author = 'author';
}
