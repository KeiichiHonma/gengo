{literal}
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
function tumblr(resp) {
    var posts = resp.posts;
    $('#g-navi-blog .loading').replaceWith('<ul/>');
    $ul = $('#g-navi-blog ul');
    for (var i=0; i<posts.length; i++) {
    var p = posts[i];
    //console.log(p);
    var title = p['regular-title'] || p['link-text'] || null;
    var time = p['unix-timestamp'] || '';

    var x = new Date;
    x.setTime(time * 1000);

    var year = x.getFullYear();
    var month = x.getMonth() + 1;
    var day = x.getDate();
    var date = year + '/' + month + '/' + day;  


    if (title)
    $ul.append('<li>'+date+'<br />'+'<a href="'+p['url']+'">'+title+'</a></li>');
    }
}
</script>
{/literal}