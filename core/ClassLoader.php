<?php

class ClassLoader
{
	protected $dirs;

	public function register(): void
	{
		spl_autoload_register([$this, 'loadClass']);
	}

	public function registerDir($dir): void
	{
		$this->dirs[] = $dir;
	}

	public function loadClass($class): void
	{
		foreach ($this->dirs as $dir){
			$file = $dir . DIRECTORY_SEPARATOR . $class . '.php';
			if (is_readable($file)) {
				require $file;

				return;
			}
		}
	}
}
