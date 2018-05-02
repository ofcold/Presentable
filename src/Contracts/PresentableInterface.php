<?php

namespace Ofcold\Presentable\Contracts;

/**
 *	Class PresentableInterface
 *
 *	@link		https://ofcold.com
 *
 *	@author		Ofcold, Inc <support@ofcold.com>
 *	@author		Olivia Fu <olivia@ofcold.com>
 *	@author		Bill Li <bill.li@ofcold.com>
 *
 *	@package	Ofcold\Presentable\Contracts\PresentableInterface
 */
interface PresentableInterface
{
	/**
	 *	Return a created presenter.
	 *
	 *	@return		Ofcold\Presentable\Presenter
	 */
	public function getPresenter();
}