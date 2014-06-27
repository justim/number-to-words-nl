<?php

/**
 * Get the verbal representation of a number in Dutch
 *
 * @author justim
 * @link https://github.com/justim/number-to-words-nl
 */
class NumberToWordsNl
{
	// names of all exponents
	// the leading spaces are intentionally to comply with the rules from `Het Groene Boekje`
	private static $_exponents = [
		0 => '',
		1 => 'duizend',
		2 => ' miljoen',
		3 => ' miljard',
		4 => ' biljoen',
		5 => ' biljard',
		6 => ' triljoen',
		7 => ' triljard',
		8 => ' quadriljoen',
		9 => ' quadriljard',
		10 => ' quintiljoen',
		11 => ' quintiljard',
		12 => ' sextiljoen',
		13 => ' sextiljard',
		14 => ' septiljoen',
		15 => ' septiljard',
		16 => ' octiljoen',
		17 => ' octiljard',
		18 => ' noniljoen',
		19 => ' noniljard',
		20 => ' deciljoen',
		21 => ' deciljard',
		22 => ' undeciljoen',
		23 => ' undeciljard',
		24 => ' duodeciljoen',
		25 => ' duodeciljard',
		26 => ' tredeciljoen',
		27 => ' tredeciljard',
		28 => ' quattuordeciljoen',
		29 => ' quattuordeciljard',
		30 => ' quindeciljoen',
		31 => ' quindeciljard',
		32 => ' sexdeciljoen',
		33 => ' sexdeciljard',
		34 => ' septendeciljoen',
		35 => ' septendeciljard',
		36 => ' octodeciljoen',
		37 => ' octodeciljard',
		38 => ' novemdeciljoen',
		39 => ' novemdeciljard',
		40 => ' vigintiljoen',
		41 => ' vigintiljard',
	];

	// names of all tens
	private static $_tens = [
		1 => 'tien',
		2 => 'twintig',
		3 => 'dertig',
		4 => 'veertig',
		5 => 'vijftig',
		6 => 'zestig',
		7 => 'zeventig',
		8 => 'tachtig',
		9 => 'negentig',
	];

	// names of all digits
	private static $_digits = [
		0 => 'nul',
		1 => 'een',
		2 => 'twee',
		3 => 'drie',
		4 => 'vier',
		5 => 'vijf',
		6 => 'zes',
		7 => 'zeven',
		8 => 'acht',
		9 => 'negen',
	];

	// some special cases in the dutch language
	private static $_specialCases = [
		11 => 'elf',
		12 => 'twaalf',
		13 => 'dertien',
		14 => 'veertien',
		15 => 'vijftien',
		16 => 'zestien',
		17 => 'zeventien',
		18 => 'achttien',
		19 => 'negentien',
	];

	/**
	 * Converts number to words
	 * @param string number to convert to words (strings because we want to process big numbers)
	 * @return string the corresponding word representation
	 * @throws InvalidArgumentException
	 */
	public static function toWords($input)
	{
		if (!preg_match('/^[+-]?\d*\.?\d*$/', $input))
		{
			throw new \InvalidArgumentException('Input is not a valid number: ' . $input);
		}

		// zero is not really a number, so we don't want to trouble our logic with it
		if ($input == 0)
		{
			return self::$_digits[0];
		}

		// negative number aren't that special, so just make the number absolute
		// and return it with a prefix
		if (strpos($input, '-') === 0)
		{
			return 'minus ' . self::_parse(substr($input, 1));
		}

		// lose the optional plus sign
		return self::_parse(ltrim($input, '+'));
	}

	/**
	 * Do the actual parsing of the number
	 * @param string Number to parse
	 * @return string The corresponding word representation
	 */
	private static function _parse($number)
	{
		// extract the parts for the number
		@list($integerPart, $fractionalPart) = explode('.', $number);

		// process both parts
		$integerPartResult = self::_handleIntegerPart($integerPart);
		$fractionalPartResult = self::_handleFractionalPart($fractionalPart);

		// special case for when we only have decimals
		if (empty($integerPartResult) && !empty($fractionalPartResult))
		{
			return self::$_digits[0] . $fractionalPartResult;
		}
		else
		{
			return $integerPartResult . $fractionalPartResult;
		}
	}

	/**
	 * Process the integer part of the number
	 * @param string integer part
	 * @return string Word representation of the integer part
	 */
	private static function _handleIntegerPart($integerPart)
	{
		$output = [];

		// create exponent components, in reverse because we want to split from the right
		$components = str_split(strrev($integerPart), 3);

		// we loop through the components backwards, this way we can use the index as exponent
		foreach ($components as $exponent => $component)
		{
			// extract all the parts for this component, padding is needed for `undefined` errors
			list($hunderds, $tens, $digits) = str_split(str_pad(strrev($component), 3, '0', STR_PAD_LEFT), 1);

			$currentPart = self::_handleHundreds($hunderds);

			// special case detection
			if (!empty($tens) && isset(self::$_specialCases[$tens . $digits]))
			{
				$currentPart .= self::$_specialCases[$tens . $digits];
			}
			else
			{
				$currentPart .= self::_handleDigits($digits, !empty($tens));
				$currentPart .= self::_handleTens($tens);
			}

			$currentPart = self::_handleExponents($currentPart, $exponent);

			// ex. three zeros gives us an empty string
			if (!empty($currentPart))
			{
				$output[] = $currentPart;
			}
		}

		// we need to reverse the order and trim all unwanted spaces
		return trim(implode(' ', array_reverse($output)));
	}

	/**
	 * Handle the hunderd in a component
	 * @param int Hunderd part of the component
	 * @return string Hunderd part in words
	 */
	private static function _handleHundreds($hunderds)
	{
		$currentPart = '';

		if (!empty($hunderds))
		{
			// for one hunderd you don't have to specify the digit
			if ($hunderds != 1)
			{
				$currentPart = self::$_digits[$hunderds];
			}

			$currentPart .= 'honderd';
		}

		return $currentPart;
	}

	/**
	 * Handle the digit of a component
	 * @param int A digit
	 * @param boolean A suffix is needed (to connect with tens)
	 * @return string The digit in words
	 */
	private static function _handleDigits($digits, $suffix)
	{
		if (!empty($digits))
		{
			$digitsInWords = self::$_digits[$digits];

			if ($suffix)
			{
				// we need an umlaut in some words
				if (substr($digitsInWords, -1, 1) === 'e')
				{
					$digitsInWords .= 'ën';
				}
				else
				{
					$digitsInWords .= 'en';
				}
			}

			return $digitsInWords;
		}
		else
		{
			return '';
		}
	}

	/**
	 * Handle the ten of a component
	 * @param int A ten
	 * @return string The tens in words
	 */
	private static function _handleTens($tens)
	{
		if (!empty($tens))
		{
			return self::$_tens[$tens];
		}
		else
		{
			return '';
		}
	}

	/**
	 * Handles the exponent of a component
	 * @param string Current word representation of the component
	 * @param int Exponent
	 * @return string String representation of the complete component
	 * @throws OutOfBoundsException
	 */
	private static function _handleExponents($current, $exponent)
	{
		if (!isset(self::$_exponents[$exponent]))
		{
			throw new \OutOfBoundsException('Exponent to big');
		}

		$wordRepresentation = $current;

		if (!empty($current))
		{
			// the only exception for leaving out the digit
			if ($current == 'een' && $exponent == 1)
			{
				$wordRepresentation = self::$_exponents[$exponent];
			}
			else
			{
				$wordRepresentation .= self::$_exponents[$exponent];
			}
		}

		return $wordRepresentation;
	}

	/**
	 * Handle the fractional part of the number (the decimals)
	 * @param int Fractional part
	 * @return string Fractional part in words
	 */
	private static function _handleFractionalPart($fraction)
	{
		// does the number have a fractional part
		if (isset($fraction))
		{
			$decimals = [];

			// every decimal is separate
			foreach (str_split($fraction, 1) as $r)
			{
				$decimals[] = self::$_digits[$r];
			}

			return ' komma ' . implode(' ', $decimals);
		}
		else
		{
			return '';
		}
	}
}
