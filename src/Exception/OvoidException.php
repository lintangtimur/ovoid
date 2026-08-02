<?php

declare(strict_types=1);

namespace Stelin\Exception;

use Exception;

/**
 * Base exception for everything this package throws. Catch this to handle any
 * ovoid-specific failure without depending on the more specific subclasses.
 */
class OvoidException extends Exception
{
}
