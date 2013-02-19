{*管理者のみ*}
{if $login_type == $smarty.const.TYPE_M_ADMIN}
<div id="subnavi">
<ul>
    <li class="{if $snavi == "manager"}on{else}off{/if}"><a href="{$smarty.const.GENGOURL}/system/manager/">マネージャー</a></li>
    <li class="{if $snavi == "user"}on{else}off{/if}"><a href="{$smarty.const.GENGOURL}/system/user/">ユーザー</a></li>
</ul>
</div>
    <br class="clear"/>
{/if}