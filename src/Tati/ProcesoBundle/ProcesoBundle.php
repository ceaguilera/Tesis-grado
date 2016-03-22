<?php

namespace Tati\ProcesoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProcesoBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
