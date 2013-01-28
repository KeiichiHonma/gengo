<div id="pan">
{foreach from=$position key="key" item="array" name="position"}
{if $smarty.foreach.position.last}<strong>{$array.name|escape}</strong>{else}<a href="{$array.url}">{$array.name|escape}</a> > {/if}
{/foreach}
</div>
{include file="include/system/logout.inc"}