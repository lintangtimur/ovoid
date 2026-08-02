<?php

declare(strict_types=1);

namespace Stelin\Exception;

/** Thrown client-side when a transfer amount fails a sanity check before hitting the API. */
class AmountException extends OvoidException
{
}
