<?php

namespace VojtechDobes\NetteForms;

use Nette\DI;
use Nette\PhpGenerator;

if (!class_exists('Nette\DI\CompilerExtension')) {
	class_alias('Nette\Config\CompilerExtension', 'Nette\DI\CompilerExtension');
}
if (!class_exists('Nette\PhpGenerator\ClassType')) {
	class_alias('Nette\Utils\PhpGenerator\ClassType', 'Nette\PhpGenerator\ClassType');
}


/**
 * Registers macros and add helpers
 *
 * @author Vojtěch Dobeš
 */
class GpsPickerExtension extends DI\CompilerExtension
{

	public function loadConfiguration()
	{
		$container = $this->getContainerBuilder();

		$latte = $container->getDefinition('nette.latte');
		$latte->addSetup('VojtechDobes\NetteForms\GpsPickerMacros::install(?->compiler)', array('@self'));
	}



	public function afterCompile(PhpGenerator\ClassType $class)
	{
		$initialize = $class->methods['initialize'];
		$initialize->addBody('VojtechDobes\NetteForms\GpsPositionPicker::register();');
	}

}
