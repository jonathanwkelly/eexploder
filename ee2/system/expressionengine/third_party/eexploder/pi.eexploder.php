<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
	'pi_name'        => 'EExploder',
	'pi_version'     => '1.0',
	'pi_author'      => 'Jonathan W. Kelly - Paramore | the digital agency',
	'pi_description' => 'Iterate through a delimited string of values.',
	'pi_usage'       => '{exp:exploder string="1|2|3" delimiter="|" var="my_id"}My ID for this iteration is {my_id}{/exp:exploder}'
);

class Eexploder {

	// --------------------------------------------------------------------
	// PROPERTIES
	// --------------------------------------------------------------------

	/**
	 * Plugin return data
	 */
	public $return_data;

	// --------------------------------------------------------------------
	// METHODS
	// --------------------------------------------------------------------

	/**
	 * Explode and iterate
	 */
	function __construct()
	{
		$str = ee()->TMPL->fetch_param('string');
		$delim = ee()->TMPL->fetch_param('delimiter');
		$var = ee()->TMPL->fetch_param('var', 'var');

		if(!$str || !$delim)
			return '';

		foreach(explode($delim, $str) as $item)
		{
			$this->return_data .= ee()->TMPL->parse_variables(
				ee()->TMPL->tagdata,
				array(array("{$var}" => $item))
			);
		}

		return $this->return_data;
	}

}
// END CLASS

/* End of file pi.eexploder.php */