<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 */

namespace Nette\Loaders;

use Nette;


/**
 * Nette auto loader is responsible for loading Nette classes and interfaces.
 *
 * @author     David Grudl
 */
class NetteLoader
{
	/** @var NetteLoader */
	private static $instance;

	/** @var array */
	public $renamed = array(
		'Nette\Config\Configurator' => 'Nette\Configurator',
		'Nette\Config\CompilerExtension' => 'Nette\DI\CompilerExtension',
		'Nette\Http\User' => 'Nette\Security\User',
		'Nette\Templating\DefaultHelpers' => 'Nette\Templating\Helpers',
		'Nette\Templating\FilterException' => 'Latte\CompileException',
		'Nette\Utils\PhpGenerator\ClassType' => 'Nette\PhpGenerator\ClassType',
		'Nette\Utils\PhpGenerator\Helpers' => 'Nette\PhpGenerator\Helpers',
		'Nette\Utils\PhpGenerator\Method' => 'Nette\PhpGenerator\Method',
		'Nette\Utils\PhpGenerator\Parameter' => 'Nette\PhpGenerator\Parameter',
		'Nette\Utils\PhpGenerator\PhpLiteral' => 'Nette\PhpGenerator\PhpLiteral',
		'Nette\Utils\PhpGenerator\Property' => 'Nette\PhpGenerator\Property',
		'Nette\Diagnostics\Bar' => 'Tracy\Bar',
		'Nette\Diagnostics\BlueScreen' => 'Tracy\BlueScreen',
		'Nette\Diagnostics\Dumper' => 'Tracy\Dumper',
		'Nette\Diagnostics\FireLogger' => 'Tracy\FireLogger',
		'Nette\Diagnostics\Logger' => 'Tracy\Logger',
		'Nette\Diagnostics\OutputDebugger' => 'Tracy\OutputDebugger',
		'Nette\Latte\ParseException' => 'Latte\CompileException',
		'Nette\Latte\CompileException' => 'Latte\CompileException',
		'Nette\Latte\Compiler' => 'Latte\Compiler',
		'Nette\Latte\HtmlNode' => 'Latte\HtmlNode',
		'Nette\Latte\IMacro' => 'Latte\IMacro',
		'Nette\Latte\MacroNode' => 'Latte\MacroNode',
		'Nette\Latte\Parser' => 'Latte\Parser',
		'Nette\Latte\PhpWriter' => 'Latte\PhpWriter',
		'Nette\Latte\Token' => 'Latte\Token',
		'Nette\Latte\Macros\CoreMacros' => 'Latte\Macros\CoreMacros',
		'Nette\Latte\Macros\MacroSet' => 'Latte\Macros\MacroSet',
		'Nette\ArrayHash' => 'Nette\Utils\ArrayHash',
		'Nette\ArrayList' => 'Nette\Utils\ArrayList',
		'Nette\DateTime' => 'Nette\Utils\DateTime',
		'Nette\Image' => 'Nette\Utils\Image',
		'Nette\ObjectMixin' => 'Nette\Utils\ObjectMixin',
	);

	/** @var array */
	public $list = array(
		'Latte\CompileException' => 'Latte/exceptions',
		'Latte\Compiler' => 'Latte/Compiler',
		'Latte\Engine' => 'Latte/Engine',
		'Latte\Helpers' => 'Latte/Helpers',
		'Latte\HtmlNode' => 'Latte/HtmlNode',
		'Latte\ILoader' => 'Latte/ILoader',
		'Latte\IMacro' => 'Latte/IMacro',
		'Latte\Loaders\FileLoader' => 'Latte/Loaders/FileLoader',
		'Latte\Loaders\StringLoader' => 'Latte/Loaders/StringLoader',
		'Latte\MacroNode' => 'Latte/MacroNode',
		'Latte\MacroTokens' => 'Latte/MacroTokens',
		'Latte\Macros\BlockMacros' => 'Latte/Macros/BlockMacros',
		'Latte\Macros\CoreMacros' => 'Latte/Macros/CoreMacros',
		'Latte\Macros\MacroSet' => 'Latte/Macros/MacroSet',
		'Latte\Object' => 'Latte/Object',
		'Latte\Parser' => 'Latte/Parser',
		'Latte\PhpWriter' => 'Latte/PhpWriter',
		'Latte\RegexpException' => 'Latte/exceptions',
		'Latte\RuntimeException' => 'Latte/exceptions',
		'Latte\Runtime\CachingIterator' => 'Latte/Runtime/CachingIterator',
		'Latte\Runtime\Filters' => 'Latte/Runtime/Filters',
		'Latte\Runtime\Html' => 'Latte/Runtime/Html',
		'Latte\Runtime\IHtmlString' => 'Latte/Runtime/IHtmlString',
		'Latte\Template' => 'Latte/Template',
		'Latte\Token' => 'Latte/Token',
		'Latte\TokenIterator' => 'Latte/TokenIterator',
		'Latte\Tokenizer' => 'Latte/Tokenizer',
		'NetteModule\ErrorPresenter' => 'Application/ErrorPresenter',
		'NetteModule\MicroPresenter' => 'Application/MicroPresenter',
		'Nette\Application\AbortException' => 'Application/exceptions',
		'Nette\Application\ApplicationException' => 'Application/exceptions',
		'Nette\Application\BadRequestException' => 'Application/exceptions',
		'Nette\Application\ForbiddenRequestException' => 'Application/exceptions',
		'Nette\Application\InvalidPresenterException' => 'Application/exceptions',
		'Nette\ArgumentOutOfRangeException' => 'Utils/exceptions',
		'Nette\Caching\Storages\PhpFileStorage' => 'deprecated/Caching/PhpFileStorage',
		'Nette\Callback' => 'deprecated/Callback',
		'Nette\DI\Extensions\NetteAccessor' => 'deprecated/DI/NetteAccessor',
		'Nette\DI\MissingServiceException' => 'DI/exceptions',
		'Nette\DI\ServiceCreationException' => 'DI/exceptions',
		'Nette\Database\Reflection\AmbiguousReferenceKeyException' => 'Database/Reflection/exceptions',
		'Nette\Database\Reflection\MissingReferenceException' => 'Database/Reflection/exceptions',
		'Nette\DeprecatedException' => 'Utils/exceptions',
		'Nette\Diagnostics\Debugger' => 'deprecated/Diagnostics/Debugger',
		'Nette\Diagnostics\Helpers' => 'deprecated/Diagnostics/Helpers',
		'Nette\Diagnostics\IBarPanel' => 'deprecated/Diagnostics/IBarPanel',
		'Nette\DirectoryNotFoundException' => 'Utils/exceptions',
		'Nette\FileNotFoundException' => 'Utils/exceptions',
		'Nette\IOException' => 'Utils/exceptions',
		'Nette\InvalidArgumentException' => 'Utils/exceptions',
		'Nette\InvalidStateException' => 'Utils/exceptions',
		'Nette\Latte\Engine' => 'deprecated/Latte/Engine',
		'Nette\Loaders\RobotLoader' => 'RobotLoader/RobotLoader',
		'Nette\Localization\ITranslator' => 'Utils/ITranslator',
		'Nette\Mail\SmtpException' => 'Mail/SmtpMailer',
		'Nette\MemberAccessException' => 'Utils/exceptions',
		'Nette\NotImplementedException' => 'Utils/exceptions',
		'Nette\NotSupportedException' => 'Utils/exceptions',
		'Nette\Object' => 'Utils/Object',
		'Nette\OutOfRangeException' => 'Utils/exceptions',
		'Nette\StaticClassException' => 'Utils/exceptions',
		'Nette\Templating\FileTemplate' => 'deprecated/Templating/FileTemplate',
		'Nette\Templating\Helpers' => 'deprecated/Templating/Helpers',
		'Nette\Templating\IFileTemplate' => 'deprecated/Templating/IFileTemplate',
		'Nette\Templating\ITemplate' => 'deprecated/Templating/ITemplate',
		'Nette\Templating\Template' => 'deprecated/Templating/Template',
		'Nette\UnexpectedValueException' => 'Utils/exceptions',
		'Nette\Utils\AssertionException' => 'Utils/Validators',
		'Nette\Utils\CallbackFilterIterator' => 'Finder/CallbackFilterIterator',
		'Nette\Utils\Finder' => 'Finder/Finder',
		'Nette\Utils\JsonException' => 'Utils/Json',
		'Nette\Utils\LimitedScope' => 'deprecated/Utils/LimitedScope',
		'Nette\Utils\MimeTypeDetector' => 'deprecated/Utils/MimeTypeDetector',
		'Nette\Utils\Neon' => 'Neon/Neon',
		'Nette\Utils\NeonDecoder' => 'Neon/NeonDecoder',
		'Nette\Utils\NeonEntity' => 'Neon/NeonEntity',
		'Nette\Utils\NeonException' => 'Neon/NeonException',
		'Nette\Utils\RecursiveCallbackFilterIterator' => 'Finder/RecursiveCallbackFilterIterator',
		'Nette\Utils\RegexpException' => 'Utils/Strings',
		'Nette\Utils\SafeStream' => 'SafeStream/SafeStream',
		'Nette\Utils\TokenIterator' => 'Tokenizer/TokenIterator',
		'Nette\Utils\Tokenizer' => 'Tokenizer/Tokenizer',
		'Nette\Utils\TokenizerException' => 'Tokenizer/TokenizerException',
		'Nette\Utils\UnknownImageFileException' => 'Utils/Image',
		'Tracy\Bar' => 'Tracy/Bar',
		'Tracy\BlueScreen' => 'Tracy/BlueScreen',
		'Tracy\Debugger' => 'Tracy/Debugger',
		'Tracy\DefaultBarPanel' => 'Tracy/DefaultBarPanel',
		'Tracy\Dumper' => 'Tracy/Dumper',
		'Tracy\FireLogger' => 'Tracy/FireLogger',
		'Tracy\Helpers' => 'Tracy/Helpers',
		'Tracy\IBarPanel' => 'Tracy/IBarPanel',
		'Tracy\Logger' => 'Tracy/Logger',
		'Tracy\OutputDebugger' => 'Tracy/OutputDebugger',
	);


	/**
	 * Returns singleton instance with lazy instantiation.
	 * @return NetteLoader
	 */
	public static function getInstance()
	{
		if (self::$instance === NULL) {
			self::$instance = new static;
		}
		return self::$instance;
	}


	/**
	 * Register autoloader.
	 * @param  bool  prepend autoloader?
	 * @return void
	 */
	public function register($prepend = FALSE)
	{
		spl_autoload_register(array($this, 'tryLoad'), TRUE, (bool) $prepend);
	}


	/**
	 * Handles autoloading of classes or interfaces.
	 * @param  string
	 * @return void
	 */
	public function tryLoad($type)
	{
		$type = ltrim($type, '\\');
		if (isset($this->renamed[$type])) {
			class_alias($this->renamed[$type], $type);
			trigger_error("Class $type has been renamed to {$this->renamed[$type]}.", E_USER_WARNING);

		} elseif (isset($this->list[$type])) {
			require __DIR__ . '/../' . $this->list[$type] . '.php';

		} elseif (substr($type, 0, 6) === 'Nette\\' && is_file($file = __DIR__ . '/../' . strtr(substr($type, 5), '\\', '/') . '.php')) {
			require $file;
		}
	}

}
