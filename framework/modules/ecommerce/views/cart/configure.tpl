<div class="module cart configure">
    <h1>{gettext str="Configure Shopping Cart"}</h1>    
    {form action=saveconfig}
    {control type="text" name="min_order" label="Minimum order amount to require" value=$config.min_order}
    {control type="html" name="policy" label="Policies" value=$config.policy}
    {control type="buttongroup" submit="Save Store Configuration"|gettext cancel="Cancel"|gettext}
    {/form}
</div>