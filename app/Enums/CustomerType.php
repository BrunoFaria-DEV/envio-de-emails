<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CustomerType extends Enum
{
  const Physical = 0;
  const Legal = 1;

  public static function getDescription($value): string
	{
		switch ($value) {
			case self::Physical:
				return 'Pessoa Física';
			break;

			case self::Legal:
				return 'Pessoa Jurídica';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}