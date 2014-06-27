<?php

class NumberToWordsNlTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testExceptionIsRaisedForInvalidConstructorArguments()
	{
		NumberToWordsNl::toWords('abc');
	}

	public function testMinusVijfduizendZeshonderdachtenzeventig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('-5678'), 'minus vijfduizend zeshonderdachtenzeventig');
	}

	public function testNulKommaEen()
	{
		$this->assertEquals(NumberToWordsNl::toWords('0.1'), 'nul komma een');
	}

	public function testMinusTien()
	{
		$this->assertEquals(NumberToWordsNl::toWords('-10'), 'minus tien');
	}

	public function testNul()
	{
		$this->assertEquals(NumberToWordsNl::toWords('0'), 'nul');
	}

	public function testEen()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1'), 'een');
	}

	public function testEenKommaEen()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1.1'), 'een komma een');
	}

	public function testEenKommaNulNul()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1.00'), 'een komma nul nul');
	}

	public function testTien()
	{
		$this->assertEquals(NumberToWordsNl::toWords('10'), 'tien');
	}

	public function testElf()
	{
		$this->assertEquals(NumberToWordsNl::toWords('11'), 'elf');
	}

	public function testZeventien()
	{
		$this->assertEquals(NumberToWordsNl::toWords('17'), 'zeventien');
	}

	public function testTwintig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('20'), 'twintig');
	}

	public function testEenentwintig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('21'), 'eenentwintig');
	}

	public function testTweeëntwintig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('22'), 'tweeëntwintig');
	}

	public function testDertig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('30'), 'dertig');
	}

	public function testVijfendertig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('35'), 'vijfendertig');
	}

	public function testVijfenzestig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('65'), 'vijfenzestig');
	}

	public function testNegenennegentig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('99'), 'negenennegentig');
	}

	public function testHonderdelf()
	{
		$this->assertEquals(NumberToWordsNl::toWords('111'), 'honderdelf');
	}

	public function testHonderdzevenentachtig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('187'), 'honderdzevenentachtig');
	}

	public function testTweehonderdtweeëntwintig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('222'), 'tweehonderdtweeëntwintig');
	}

	public function testDriehonderdeenenveertig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('341'), 'driehonderdeenenveertig');
	}

	public function testNegenhonderdnegenennegentig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('999'), 'negenhonderdnegenennegentig');
	}

	public function testDuizend()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1000'), 'duizend');
	}

	public function testDuizendEen()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1001'), 'duizend een');
	}

	public function testDuizendHonderdelf()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1111'), 'duizend honderdelf');
	}

	public function testDrieduizendVeertien()
	{
		$this->assertEquals(NumberToWordsNl::toWords('3014'), 'drieduizend veertien');
	}

	public function testVijfduizendVierhonderdtweeëndertig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('5432'), 'vijfduizend vierhonderdtweeëndertig');
	}

	public function testVijftienduizend()
	{
		$this->assertEquals(NumberToWordsNl::toWords('15000'), 'vijftienduizend');
	}

	public function testVijftienduizendEen()
	{
		$this->assertEquals(NumberToWordsNl::toWords('15001'), 'vijftienduizend een');
	}

	public function testHonderdduizend()
	{
		$this->assertEquals(NumberToWordsNl::toWords('100000'), 'honderdduizend');
	}

	public function testHonderdelfduizendHonderdelf()
	{
		$this->assertEquals(NumberToWordsNl::toWords('111111'), 'honderdelfduizend honderdelf');
	}

	public function testTweehonderdachtentwintigduizendAchthonderdvijfenzestig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('228865'), 'tweehonderdachtentwintigduizend achthonderdvijfenzestig');
	}

	public function testEenMiljoen()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1000000'), 'een miljoen');
	}

	public function testEenMiljoenDuizend()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1001000'), 'een miljoen duizend');
	}

	public function testEenMiljoenDuizendEen()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1001001'), 'een miljoen duizend een');
	}

	public function testTweeMiljoen()
	{
		$this->assertEquals(NumberToWordsNl::toWords('2000000'), 'twee miljoen');
	}

	public function testTweeMiljoenVijftien()
	{
		$this->assertEquals(NumberToWordsNl::toWords('2000015'), 'twee miljoen vijftien');
	}

	public function testTienMiljoenDuizend()
	{
		$this->assertEquals(NumberToWordsNl::toWords('10001000'), 'tien miljoen duizend');
	}

	public function testTwaalfMiljoenDriehonderdvijfenveertigduizendZeshonderdachtenzeventig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('12345678'), 'twaalf miljoen driehonderdvijfenveertigduizend zeshonderdachtenzeventig');
	}

	public function testEenMiljardEenMiljoen()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1001000000'), 'een miljard een miljoen');
	}

	public function testEenMiljardTweehonderdvierendertigMiljoenVijfhonderdzevenenzestigduizendAchthonderdnegentig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('1234567890'), 'een miljard tweehonderdvierendertig miljoen vijfhonderdzevenenzestigduizend achthonderdnegentig');
	}

	public function testVijfenveertigQuadriljardZeshonderdachtenzeventigQuadriljoenNegenhonderdnegenTriljardAchthonderdzesenzeventigTriljoenVijfhonderdvierendertigBiljardVijfhonderdzevenenzestigBiljoenAchthonderdachtennegentigMiljardZevenhonderdvijfenzestigMiljoenVierhonderdvierendertigduizendVijfhonderdzevenenzestig()
	{
		$this->assertEquals(NumberToWordsNl::toWords('45678909876534567898765434567'), 'vijfenveertig quadriljard zeshonderdachtenzeventig quadriljoen negenhonderdnegen triljard achthonderdzesenzeventig triljoen vijfhonderdvierendertig biljard vijfhonderdzevenenzestig biljoen achthonderdachtennegentig miljard zevenhonderdvijfenzestig miljoen vierhonderdvierendertigduizend vijfhonderdzevenenzestig');
	}

	/**
	 * @expectedException \OutOfBoundsException
	 */
	public function testExponentOutOfBounds()
	{
		// biggest possible + 1
		NumberToWordsNl::toWords('1000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000');
	}
}
