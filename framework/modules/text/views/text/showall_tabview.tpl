{*
 * Copyright (c) 2007-2011 OIC Group, Inc.
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
 
{uniqueid assign="id"}

<div class="module text showall-tabview">
    {if $moduletitle}<h1>{$moduletitle}</h1>{/if}
    {permissions}
        <div class="module-actions">
            {if $permissions.create == 1}
                {icon class=add action=edit rank=1 text="Add Tab"|gettext}
            {/if}
            {if $permissions.manage == 1}
                {ddrerank items=$items model="text" label="Text Items"|gettext}
            {/if}
        </div>
    {/permissions}
    <div id="{$id}" class="yui-navset exp-skin-tabview hide">
        <ul>
            {foreach from=$items item=tab name=tabs}
                <li><a href="#tab{$smarty.foreach.items.iteration}">{$tab->title}</a></li>
            {/foreach}
        </ul>
        <div>
            {foreach from=$items item=text name=items}
                <div id="tab{$smarty.foreach.items.iteration}">
                    {permissions}
						<div class="item-actions">
						   {if $permissions.edit == 1}
								{icon action=edit record=$text}
							{/if}
							{if $permissions.delete == 1}
								{icon action=delete record=$text}
							{/if}
						</div>
                    {/permissions}
                    <div class="bodycopy">
                        {filedisplayer view="`$config.filedisplay`" files=$text->expFile id=$text->id}
                        {$text->body}
                    </div>
					{permissions}
						<div class="module-actions">
							{if $permissions.create == 1}
								{icon class=add action=edit rank=$text->rank+1 text="Add another tab after this one"|gettext}
							{/if}
						</div>
					{/permissions}
                </div>
            {/foreach}
        </div>
    </div>
    <div class="loadingdiv">{'Loading'|gettext}</div>
</div>

{script unique="`$id`" yui3mods="1"}
{literal}
	YUI(EXPONENT.YUI3_CONFIG).use('tabview', function(Y) {
	    var tabview = new Y.TabView({srcNode:'#{/literal}{$id}{literal}'});
	    tabview.render();
		Y.one('#{/literal}{$id}{literal}').removeClass('hide');
		Y.one('.loadingdiv').remove();
	});
{/literal}
{/script}
