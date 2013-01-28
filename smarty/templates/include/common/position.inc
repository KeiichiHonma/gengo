<div class="topic-path">
{foreach from=$position key="key" item="array" name="position"}
{if $smarty.foreach.position.last}<strong>{$array.name}</strong>{else}<a href="{$array.url}">{$array.name}</a> &nbsp;&gt;&nbsp; {/if}
{/foreach}
</div><!-- #topicPath -->
