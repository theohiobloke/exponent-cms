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
 
{css unique="blog-comments" link="`$smarty.const.PATH_RELATIVE`framework/modules/core/assets/css/comments.css"}

{/css}
 
<div class="exp-comments">
	{if !$hidecomments && $comments|@count > 0}
	    <a id="exp-comments"></a>
	    {if $title}<h3>{$title}</h3>{/if}
	    
	    {if $unapproved > 0}
			<div class="unapproved msg-queue notice">
			    <div class="msg">
    				<a class="manage" href="{link action=manage content_id=$content_id content_type=$content_type}">{'Manage Comments'|gettext}</a> | {'There are'|gettext} {$unapproved} {'comments awaiting approval'|gettext}
			    </div>
			</div>
	    {/if}
        
        {if $comments->records|@count!=0}
	    <ol class="commentlist">		
        {foreach from=$comments->records item=cmt name=comments}
			<li class="comment">
				<cite>
					<span class="attribution">
						
						{if $cmt->name != ''}
							{$cmt->name}
						{else}
							{$cmt->username}
						{/if}
						
						{*$cmt->name *} says
					</span>
					<span class="comment-date">{$cmt->created_at|format_date:$smarty.const.DISPLAY_DATE_FORMAT}</span>
				</cite>
				<div class="comment-text bodycopy">	
					{img src=$cmt->image h=80}   
					{permissions}
					<div class="item-actions">
						{if $permissions.manage == 1}
							{icon action=edit record=$cmt content_id=$content_id title="Edit this comment"|gettext}
						{/if}
						{if $permissions.delete == 1}
							{icon action=delete record=$cmt title="Delete this comment"|gettext onclick="return confirm('"|cat:("Are you sure you want to delete this comment?"|gettext)|cat:"');"}
						{/if}
					<div>
					{/permissions}

					{$cmt->body}
				</div>
			</li>
    	{/foreach}
    	</ol>
    	{elseif $config.hidecomments==1}
        <div class="hide-comments">
            {"Comments have been disabled"|gettext}
        </div>
        {else}
        <div class="no-comments">
            {"No comments yet"|gettext}
        </div>
        {/if}
    	{*$comments->links* <-- We'll need to fix pagination*}
	{/if}
	{if $config.usescomments!=1}
	    {include file="edit.tpl"}
	{/if}
</div>
