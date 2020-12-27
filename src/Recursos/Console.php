<?php

namespace App\Recursos;

/**
 *
 * @version    1.0
 * @package    system
 * @subpackage system/libraries/concole
 * @author     Moshe Kolodny
 * @copyright  https://github.com/kolodny/Console.class.php
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 * 
 * @example 
 *
	// Métodos aceitos:
		log, dir, debug, info, warn, error 	
 	Console::time('test');
	Console::log('test%ding', 22);
	Console::dir($_SERVER);
	Console::log('test%cing', 'color: teal');
	Console::trace();
	Console::timeEnd('test');
 */


class Console {
	/**
	 * [backtrace description]
	 * @return [type] [description]
	 */
	private static function backtrace() {
		$backtrace = debug_backtrace();
		$backtrace = $backtrace[sizeof($backtrace)-1];
		$file = str_replace('\\', '/', $backtrace['file']);
		$vLine = file($file);
		$fLine = @addslashes(preg_replace('#\r|\n#', '', $vLine[$backtrace['line'] - 1]));
		
		$what_to_search_for = @$backtrace['class'] . @$backtrace['type'] . $backtrace['function'];
		preg_match('#' . $what_to_search_for . '\s*\((.*?)(\);)?$#i', $fLine, $everything_between_the_parens);
		$everything_between_the_parens = @trim($everything_between_the_parens[1]);
		
		return array(
			'args' => $everything_between_the_parens,
			'line' => $backtrace['line'],
			'file' => $file,
		);
	}
	
	/**
	 * [safeEcho description]
	 * @param  [type] $str [description]
	 * @return [type]      [description]
	 */
	private static function safeEcho($str) {
		if (headers_sent()) {
			echo $str;
		} else {
			register_shutdown_function(function () use ($str) {
				if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && stripos($_SERVER['HTTP_X_REQUESTED_WITH'], 'XMLHttp') !== false){
					return;
				}

				$headers = headers_list();
				foreach($headers as $header){
					if(stripos($header, 'content-type') !== false) {
						if (stripos($header, 'application/') !== false ||
							stripos($header, 'image/') !== false ||
							stripos($header, 'xml') !== false
						) 
						{ 
							return; 
						}
					}
				}
				echo $str;
			});
		}
	}

	/**
	 * [script description]
	 * @param  [type] $javascript [description]
	 * @return [type]             [description]
	 */
	private static function script($javascript) {
		$javascript = str_replace('</script>', '<\/script>', $javascript);
		return "<script>try { $javascript } catch(e){}</script>";
	}
	
	/**
	 * [getConsoleScriptString description]
	 * @param  [type] $function_name [description]
	 * @param  [type] $args_array    [description]
	 * @return [type]                [description]
	 */
	private static function getConsoleScriptString($function_name, $args_array) {
		$traced = self::backtrace();
		$args_string = $traced['args'] ? $traced['args'] : '';
		$line = $traced['line'] ? $traced['line'] : '';
		$file = $traced['file'] ? $traced['file'] : '';
		$multi = count($args_array) > 1;
		if (strlen($args_string) > 50) {
			$args_string = substr($args_string, 0, 50) . '...';
		}
		
		if ($multi) {
			$var = @json_encode($args_array); // Warning: json_encode(): recursion detected
			return "console.group('$args_string (called from $file line $line)');console.$function_name.apply(console, $var);console.groupEnd();";
		} else {
			$object = isset($args_array[0]) ? $args_array[0] : null;
			$json_value = @json_encode($object); // Warning: json_encode(): recursion detected
			$type = ucfirst(strtolower(gettype($object)));
			if (is_array($object) || is_object($object)) {
				$var = $json_value;
			} else {
				switch ($type) {
					case 'String':
						$var = "'(String)','" . $json_value . "'";
						break;
					
					case 'Null':
						$var = "'null'";
						break;
					
					case 'Boolean':
					case 'Interger':
					case 'Double':
					default:
						$var = "'($type)'," . $json_value;
						break;
				}
				
			}
			return "console.group('$args_string ($type, called from $file line $line)');console.$function_name($var);console.groupEnd();";
		}
	}
	
	/**
	 * [applyConsoleFunction description]
	 * @param  [type] $function_name [description]
	 * @param  [type] $arguments     [description]
	 * @return [type]                [description]
	 */
	private static function applyConsoleFunction($function_name, $arguments) {
		$json_arguments = json_encode($arguments);
		return "console.$function_name.apply(console, $json_arguments)";
	}
	
	/**
	 * [__callStatic description]
	 * @param  [type] $name      [description]
	 * @param  [type] $arguments [description]
	 * @return [type]            [description]
	 */
	public static function __callStatic($name, $arguments) {
		if (in_array($name, explode(' ', 'log dir debug info warn error'))) {
			self::safeEcho(self::script(self::getConsoleScriptString($name, $arguments)));
		} elseif (in_array($name, explode(' ', 'assert clear trace group groupCollapsed groupEnd time timeEnd timeStamp profile profileEnd count exception table'))) {
			self::safeEcho(self::script(self::applyConsoleFunction($name, $arguments)));
		} else {
			trigger_error("Call to undefined method " . __CLASS__ . "::$name()", E_USER_ERROR);
		}
	}
}