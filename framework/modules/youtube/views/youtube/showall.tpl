{*
 * Copyright (c) 2007-2011 OIC Group, Inc.
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

<div class="module youtube showall">
    {if $moduletitle}<h1>{$moduletitle}</h1>{/if}
    {permissions}
        <div class="module-actions">
			{if $permissions.create == 1}
				{icon class=add action=edit rank=1 text="Add a YouTube Video at the Top"|gettext}
			{/if}
			{if $permissions.manage == 1}
				{ddrerank items=$page->records model="portfolio" label="YouTube Videos"|gettext}
			{/if}
        </div>
    {/permissions}    
    {pagelinks paginate=$page top=1}
    {foreach from=$items item=ytv name=items}
		<div class="item">
			{if $ytv->title}<h2>{$ytv->title}</h2>{/if}
			{permissions}
				<div class="item-actions">
					{if $permissions.edit == 1}
						{icon action=edit record=$ytv}
					{/if}
					{if $permissions.delete == 1}
						{icon action=delete record=$ytv}
					{/if}
				</div>
			{/permissions}
			<div class="embedcode">
				{$ytv->embed_code}
			</div>
			<div class="bodycopy">
				{$ytv->description}
			</div>
		</div>
		{permissions}
			<div class="module-actions">
				{if $permissions.create == 1}
					{icon class=add action=edit rank=$ytv->rank+1 text="Add a YouTube Video Here"|gettext}
				{/if}
			</div>
		{/permissions}
		{clear}
    {/foreach}
    {pagelinks paginate=$page bottom=1}
</div>
