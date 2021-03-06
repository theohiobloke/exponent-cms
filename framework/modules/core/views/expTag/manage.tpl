{*
 * Copyright (c) 2007-2008 OIC Group, Inc.
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

<div class="module expTags manage">
	<h1>{"Manage Tags"|gettext}</h1>
	{permissions}
    	{if $permissions.create == 1}
    		<a class="add" href="{link controller=$model_name action=create}">{"Create a new Tag"|gettext}</a>
    	{/if}
    {/permissions}
    {$page->links}
    <table border="0" cellspacing="0" cellpadding="0" class="exp-skin-table">
        <thead>
            <tr>
                <th>
                    {"Tag Name"|gettext}
                </th>
                <th>
                    {"Use Count"|gettext}
                </th>
                <th>
                    {"Used in"|gettext}
                </th>
                <th>
                    {"Actions"|gettext}
                </th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$page->records item=listing}
                <tr class="{cycle values="odd,even"}">
                    <td>
                        <strong>{$listing->title}</strong>
                    </td>
                    <td>
                        {$listing->attachedcount}
                    </td>
                    <td>
                        {foreach from=$listing->attached item="type" key=key name=types}
                            <strong>{$key}</strong><br />
                            {foreach from=$type item=ai name=ai}
                                <a href="{link controller=$key action="show" title=$ai->sef_url}">{$ai->title|truncate:50:"..."}</a>
                                <br />
                                <br />
                            {/foreach}
                        {/foreach}
                    </td>
                    <td>
                        {permissions}
                            {if $permissions.edit == 1}
                                {icon controller=$controller action=edit record=$listing title="Edit this tag"|gettext}
                            {/if}
                            {if $permissions.delete == 1}
                                {icon controller=$controller action=delete record=$listing title="Delete this tag"|gettext onclick="return confirm('"|cat:("Are you sure you want to delete this tag?"|gettext)|cat:"');"}
                            {/if}
                        {/permissions}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    {$page->links}
</div>
