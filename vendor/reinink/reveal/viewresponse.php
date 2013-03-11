<?php
/**
 * An encapsulation class for handling PHP views.
 *
 * @package  Reveal
 * @version  1.0
 * @author   Jonathan Reinink <jonathan@reininks.com>
 * @link     https://github.com/reinink/Reveal
 */

namespace Reinink\Reveal;

use \Exception;

class ViewResponse extends Response
{
	/**
	 * Function for overriding the path.
	 *
	 * @var string
	 */
	public static $callback;

	/**
	 * The path to the view file.
	 *
	 * @var string
	 */
	private $path;

	/**
	 * Create a new View instance.
	 *
	 * @param	string	$path
	 */
	public function __construct($path, $code = 200, $headers = array())
	{
		if (is_callable(self::$callback))
		{
			$path = call_user_func_array(self::$callback, array($path));
		}

		if (!is_file($path))
		{
			throw new Exception('View not found: ' . $path);
		}

		$this->content = null;
		$this->code = $code;
		$this->headers = $headers;
		$this->path = $path;
	}

	/**
	 * Send the headers and content of the response to the browser.
	 *
	 * @return	void
	 */
	public function send()
	{
		$this->content = $this->render();

		parent::send();
	}

	/**
	 * Render the view.
	 *
	 * @return	string
	 */
	public function render()
	{
		ob_start();

		include($this->path);

		$output = ob_get_contents();

		ob_end_clean();

		return $output;
	}

	/**
	 * Insert another view inside the view.
	 *
	 * @param	string	$path
	 * @return	void
	 */
	private function insert($path)
	{
		if (is_callable(self::$callback))
		{
			$path = call_user_func_array(self::$callback, array($path));
		}

		if (!is_file($path))
		{
			throw new Exception('View not found: ' . $path);
		}

		include $path;
	}
}