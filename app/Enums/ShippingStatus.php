<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ShippingStatus extends Enum
{
  const Created = "C";
  const InProgress = "I";
  const Sent = "S";
  const Failed = "F";

  public static function getDescription($value): string
	{
		switch ($value) {
			case self::Created:
				return 'Criado';
			break;

			case self::InProgress:
				return 'Em Processo';
			break;

			case self::Sent:
				return 'Enviado';
			break;

			case self::Failed:
				return 'Falhou';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}
