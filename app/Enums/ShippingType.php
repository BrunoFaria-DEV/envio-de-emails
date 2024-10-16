<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ShippingType extends Enum
{
  const Immediate = "I";
  const Scheduled = "S";

  public static function getDescription($value): string
	{
		switch ($value) {
			case self::Immediate:
				return 'Imediato';
			break;

			case self::Scheduled:
				return 'Agendado';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}
