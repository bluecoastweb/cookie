<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
    'pi_name'        => 'Cookie',
    'pi_version'     => '1.0.1',
    'pi_author'      => 'Steve Pedersen',
    'pi_author_url'  => 'http://www.bluecoastweb.com/',
    'pi_description' => "Who does't love a cookie?",
    'pi_usage'       => Cookie::usage()
);

class Cookie {
    public function __construct() {
        $this->EE =& get_instance();
    }

    public function set() {
        $name = $this->EE->TMPL->fetch_param('name');
        $value = $this->EE->TMPL->fetch_param('value');
        $seconds = $this->EE->TMPL->fetch_param('seconds', 0);
        if ($name && $value) {
            $this->EE->functions->set_cookie($name, $value, $seconds);
        }
    }

    public function get() {
        $name = $this->EE->TMPL->fetch_param('name');
        return $this->EE->input->cookie($name);
    }

    public function get_here() {
        $value = $this->get();
        $var = $this->EE->TMPL->fetch_param('variable');
        if (! $var) {
            $var = $this->EE->TMPL->fetch_param('name');
        }
        return str_replace('{'.$var.'}', $value, $this->EE->TMPL->tagdata);
    }

    public function delete() {
        $name = $this->EE->TMPL->fetch_param('name');
        $this->EE->functions->set_cookie($name, null, -1);
    }

    public function prefix() {
        $prefix = (! $this->EE->config->item('cookie_prefix')) ? 'exp_' : $this->EE->config->item('cookie_prefix').'_';
        return $prefix;
    }

    public static function usage() {
        ob_start();
?>

Set a cookie:

  {exp:cookie:set name="chocolate" value="chip" seconds="86400"}

The "seconds" parameter is optional, defaulting to "0":

  {exp:cookie:set name="chocolate" value="i am a session cookie"}

And get it:

What a delicious {exp:cookie:get name="chocolate"}!

Or savour it, if you prefer:

  {exp:cookie:get_here name="peanut_butter"}

    The value of the exp_peanut_butter cookie is: {peanut_butter}

  {/exp:cookie:get_here}

The "name" parameter is sans the EE cookie prefix (by default "exp_").
You can ascertain the effective EE cookie prefix by viewing the output of the following tag:

  {exp:cookie:prefix}

By default the name of the interpolated variable is the same as that supplied to the "name" parameter.
If you'd prefer something different then specify a "variable" paramter.

  {exp:cookie:get_here name="username" variable="cookie"}

    Hello {username}, have a {cookie}!

  {/exp:cookie:get_here}

Delete a cookie:

  {exp:cookie:delete name='chocolate'}

<?php
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    }
}

/* End of file pi.cookie.php */
/* Location: /system/expressionengine/third_party/cookie/pi.cookie.php */
