{*
 * Copyright (c) 2004-2011 OIC Group, Inc.
 * Written and Designed by James Hunt
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * GPL: http://www.gnu.org/licenses/gpl.txt
 *
 *}
<h1>{'Manage Bots'|gettext}</h1>
<div class="form_header">{'Mange Bots'|gettext}</div><br /><br />
<hr size="1" />
<ul>
	{foreach from=$bots item=bot}
		<li>
			<span class="name">{$bot->name}</span>
			<span class="state">{$bot->state}</span>
			<span class="toggle">
				{if $bot->state > 0}
					<a href="{link id=$bot->id action="deactivate_bot"}">{'Turn off bot'|gettext}</a>
				{else}
					<a href="{link id=$bot->id action="activate_bot"}">{'Turn on bot'|gettext}</a>
				{/if}
			</span>
		</li>
	{/foreach}
</ul>
