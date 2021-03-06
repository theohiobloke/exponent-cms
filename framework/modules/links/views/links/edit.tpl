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

<div class="module links edit">
    {if $record->id != ""}
    	<h1>{'Edit Information for'|gettext} {$modelname}</h1>
    {else}
    	<h1>{'New'|gettext} {$modelname}</h1>
    {/if}

    {form action=update}
    	{control name=id type=hidden value=$record->id}
        {control type="text" name="title" label="Title"|gettext value=$record->title}
        {control type="text" name="url" label="URL"|gettext value=$record->url}
        {control type="checkbox" name="new_window" label="Open in New Window"|gettext checked=$record->new_window value="1"}
        {control type="files" name="image" label="Image"|gettext value=$record->expFile limit=2}
        {control type="editor" name="body" label="URL Description"|gettext value=$record->body}
        {control type="buttongroup" submit="Save"|gettext cancel="Cancel"|gettext}
    {/form}
</div>