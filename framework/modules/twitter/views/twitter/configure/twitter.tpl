{*
 * This file is part of Exponent Content Management System
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * @category   Exponent CMS
 * @copyright  2004-2011 OIC Group, Inc.
 * @license    GPL: http://www.gnu.org/licenses/gpl.txt
 * @link       http://www.exponent-docs.org/
 *}

{css unique="twitter-config"}
{literal}
.control.key input.text {
    width:100%;
}
{/literal}
{/css}

<h2>{"Configure this Module"|gettext}</h2>
<p>{'Log in to the Twitter Developer\'s'|gettext} <a href="https://dev.twitter.com/apps" target="_blank">{'website'|gettext}</a> {'with your twitter account.'|gettext}{br}
{'First create an application which will provide you the Consumer key and secret.'|gettext}{br}
{'Then you must create an Access token which will give you the Access token settings.'|gettext}{br}
<b>{'Give your application \'read\' & \'write\' access before requesting a token to also create tweets'|gettext}</b></p>
{control type="text" name="consumer_key" label="Consumer key"|gettext value=$config.consumer_key class=title}
{control type="text" name="consumer_secret" label="Consumer secret"|gettext value=$config.consumer_secret class=title}
{control type="text" name="oauth_token" label="Access token"|gettext value=$config.oauth_token class=title}
{control type="text" name="oauth_token_secret" label="Access token secret"|gettext value=$config.oauth_token_secret class=title}
{control type="text" name="twlimit" label="Number of tweets to show"|gettext size=3 filter=integer value=$config.twlimit|default:20}
{control type="radiogroup" name="typestatus" label="Pull Tweets from:"|gettext value=$config.typestatus|default:0 items="Home,User,Friends,Mentions,Public" values="0,1,2,3,4"}
{control type=checkbox name="showattrib" value=1 label="Show attribution"|gettext|cat:"?" checked=$config.showattrib|default:0}
{control type=checkbox name="showimage" value=1 label="Show user image"|gettext|cat:"?" checked=$config.showimage|default:0}
