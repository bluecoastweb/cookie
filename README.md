cookie
======

ExpressionEngine plugin to set and get cookies.

Set a cookie:

    {exp:cookie:set name="chocolate" value="chip" seconds="86400"}

The "seconds" parameter is optional, defaulting to "0":

    {exp:cookie:set name="chocolate" value="i am a session cookie"}

And retrieve it in one gulp:

    What a delicious {exp:cookie:get name="chocolate"}!

Or savour it, if you prefer:

    {exp:cookie:get_here name="peanut_butter"}

        The value of the exp_peanut_butter cookie is: {peanut_butter}

    {/exp:cookie:get_here}

The `name` parameter is sans the EE cookie prefix -- by default `exp_`.
You can ascertain the effective EE cookie prefix by viewing the output of the following tag:

    {exp:cookie:prefix}

By default the name of the interpolated variable is the same as that supplied to the `name` parameter.
If you'd prefer something different then specify a `variable` paramter.

    {exp:cookie:get_here name="username" variable="cookie"}

        Hello {username}, have a {cookie}!

    {/exp:cookie:get_here}

Delete a cookie:

    {exp:cookie:delete name='chocolate'}
