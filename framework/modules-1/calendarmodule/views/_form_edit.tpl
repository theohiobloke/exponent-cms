{*
 * Copyright (c) 2004-2011 OIC Group, Inc.
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
 
{css unique="calendar-edit1" link="`$smarty.const.YUI2_PATH`assets/skins/sam/calendar.css"}

{/css}

{css unique="calendar-edit2" link="`$smarty.const.PATH_RELATIVE`framework/modules-1/calendarmodule/assets/css/cal-edit.css"}

{/css}

{css unique="calendar-edit3" link="`$smarty.const.PATH_RELATIVE`framework/core/assets/css/button.css"}

{/css}

<div class="module calendar edit">
	<div class="form_title">
		<h1>{if $is_edit == 1}{'Edit Calendar Event'|gettext}{else}{'Create New Calendar Event'|gettext}{/if}</h1>
	</div>
	<div class="form_header">
		<p>{'Enter the information about the calendar event (the date and times) below.<br /><br />Note: multiple day events are not supported.'|gettext}</p>
	</div>
	{$form_html}
</div>

