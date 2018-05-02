<?php

namespace Ofcold\Presentable;

use ArrayAccess;
use IteratorAggregate;
use Ofcold\Presentable\Contracts\PresentableInterface;

/**
 *	Class Decorator
 *
 *	@link		https://ofcold.com
 *
 *	@author		Ofcold, Inc <support@ofcold.com>
 *	@author		Olivia Fu <olivia@ofcold.com>
 *	@author		Bill Li <bill.li@ofcold.com>
 *
 *	@package	Ofcold\Presentable\Decorator
 */
class Decorator
{
	/**
	 *	If this variable implements Ofcold\Presentable\PresentableInterface then turn it into a presenter.
	 *
	 *	@param		mixed		$value
	 *	@return		mixed		$value
	 */
	public function decorate($value)
	{
		if ( $value instanceof PresentableInterface )
		{
			return $value->getPresenter();
		}

		if ( is_array($value) || ($value instanceof IteratorAggregate && $value instanceof ArrayAccess) )
		{
			foreach ( $value as $k => $v )
			{
				$value[$k] = $this->decorate($v);
			}
		}

		return $value;
	}
}