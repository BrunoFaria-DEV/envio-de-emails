<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ShippingEmailRead extends Enum
{
  const Read = "R";
  const Unread = null;
	public static function getDescription($value): string
	{
		switch ($value) {
			case self::Read:
				return 'Clicado';
			break;

			case self::Unread:
				return 'Não Clicado';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}
