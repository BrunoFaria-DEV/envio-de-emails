<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ShippingEmailStatus extends Enum
{
  const Created = "C";
  const Success = "S";
  const Failed = "F";

  public static function getDescription($value): string
	{
		switch ($value) {
			case self::Created:
				return 'Criado';
			break;

			case self::Success:
				return 'Sucesso';
			break;

			case self::Failed:
				return 'Falhou';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}
