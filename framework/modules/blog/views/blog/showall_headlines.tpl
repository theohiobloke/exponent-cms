{*
 * Copyright (c) 2004-2011 OIC Group, Inc.
 * Written and Designed by Adam Kessler
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

<div class="module blog showall-headlines">
    {if $config.enable_rss == true}
        <a class="rsslink" href="{rsslink}">{'Subscribe to'|gettext} {$config.feed_title}</a>
    {/if}
    {if $moduletitle}<h2>{$moduletitle}</h2>{/if}
    {permissions}
		<div clas="module-actions">
			{if $permissions.edit == 1}
				{icon class=add action=edit text="Add a new blog article"|gettext}
			{/if}
            {if $permissions.manage == 1}
                {icon class="manage" controller=expTag action=manage text="Manage Tags"|gettext}
            {/if}
		</div>
    {/permissions}
    <ul>
    {foreach from=$page->records item=record name="blogs"}
        {if $smarty.foreach.blogs.iteration <= $config.headcount}
        <li class="item">
            <a href="{link action=show title=$record->sef_url}">{$record->title}</a>
            {permissions}
                <div class="item-actions">
                    {if $permissions.edit == 1}
                        {icon action=edit record=$record}
                    {/if}
                    {if $permissions.delete == 1}
                        {icon action=delete record=$record}
                    {/if}
                </div>
            {/permissions}
        </li>
        {/if}
    {/foreach}
    </ul> 
</div>
