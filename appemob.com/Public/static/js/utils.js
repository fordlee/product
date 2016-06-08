function setCurrNav(channel) {
    $('#side li').removeClass('curr');
    $('#side li[data-c='+channel+']').addClass('curr');
}

function setSecNav(channel) {
    $('#side .nav-sec li').removeClass('scurr');
    $('#side .nav-sec li[data-c='+channel+']').addClass('scurr');
}

$(function() {
    $('.nav-f').click(function(e) {
        window.location.href =  $(this).parent().find('a:eq(1)').attr('href');
    });

    $('.multiads').change(function(e) {
        var val = $(this).val();
        var adt = '/adt/' + val;
        var url = window.location.href;
        url = url.replace('/adt/total', '')
                           .replace('/adt/sn', '')
                           .replace('/adt/sd', '')
                           .replace('/adt/banners', '')
                           .replace('/adt/intext', '')
                           .replace('/adt/inimage', '')
                           .replace('.html', '');
        url = url + adt;
        url = url.replace('//adt/', '/adt/')
                 .replace('.php/adt/', '.php/index/index/adt/')
                 .replace('adonads.com/adt/', 'adonads.com/index/index/adt/');
        window.location.href = url;
    });
});