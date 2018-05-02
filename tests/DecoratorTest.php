<?php

use Ofcold\Presentable\Decorator;
use Ofcold\Presentable\Presenter;
use Ofcold\Presentable\Contracts\PresentableInterface;

class DecoratorTest extends PHPUnit\Framework\TestCase {

	public function testPresentableToPresenter()
	{
		$decorator = new Decorator;
		$presenter = $decorator->decorate(new PresentableStub);

		$this->assertInstanceOf(Presenter::class, $presenter);
	}

	public function testPresentablesToPresenters()
	{
		$from = [
			'string' => 'string',
			'array' => ['test' => 'test'],
			'presentable' => new PresentableStub,
			'recurseMe' => [['presentable' => new PresentableStub]]
		];

		$decorator = new Decorator;
		$to = $decorator->decorate($from);

		$this->assertSame($from['string'], $to['string']);
		$this->assertSame($from['array'], $to['array']);
		$this->assertInstanceOf(Presenter::class, $to['presentable']);
		$this->assertInstanceOf(Presenter::class, $to['presentable']->presentableObject);
		$this->assertInstanceOf(Presenter::class, $to['presentable']->getPresentableObject());
		$this->assertInstanceOf(Presenter::class, $to['recurseMe'][0]['presentable']);
	}
}

class PresentableStub implements PresentableInterface {

	public $presentableObject;

	public function __construct()
	{
		$this->presentableObject = new SecondPresentableStub;
	}

	public function getPresentableObject()
	{
		return $this->presentableObject;
	}

	public function getPresenter()
	{
		return new FactoryPresenterStub($this);
	}
}

class SecondPresentableStub implements PresentableInterface {

    public function getPresenter()
    {
        return new FactoryPresenterStub($this);
    }
}

class FactoryPresenterStub extends Presenter
{
	// code...
}