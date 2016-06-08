jQuery(document).ready(function ($) {

    $('.social a').attr('target', '_blank');

    if ($('.widget-box-blog').length) {
        $.ajax({
            url: 'https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=-1&callback=?&q=' + encodeURIComponent('https://blog.appemob.com/?feed=rss2'),
            dataType: 'json',
            success: function (data) {

                if (data.responseData.feed && data.responseData.feed.entries) {
                    for (var i = 0; i < 3; i++) {

                        console.log("------------------------");
                        console.log("title      : " + $(data.responseData.feed.entries)[i].title);
                        console.log("author     : " + $(data.responseData.feed.entries)[i].link);

                        $('.widget-box-blog').append(
                            '<div class="item"><p><a href="' + $(data.responseData.feed.entries)[i].link + '">' + $(data.responseData.feed.entries)[i].title + '</a></p></div>'
                        );
                    }
                }
            }
        });
    }
    $('.get-pdf').on('click', function (e) {
        var doc = new jsPDF();

        var specialElementHandlers = {
            '.article-footer': function (element, renderer) {
                return true;
            }
        };

        var source = $(e.target).parent('.article-footer').parent('article');

        //   source.remove('.article-footer');
        doc.fromHTML(source.get(0), 15, 15, {
            'width': 170,
            'elementHandlers': specialElementHandlers
        });

        doc.save(source.find('h1').text());
        console.log(source);

    });


    $("select").multipleSelect({
        selectAll: false
    });
    /*go UP*/
    $(document).bind('scroll', function () {
        if ($(document).scrollTop() > 500) {
            $('.go-up').show();
        } else if ($(document).scrollTop() < 500) {
            $('.go-up').hide();
        }
    });

    $('.go-up').bind('click', function () {
        $('html,body').animate({
            scrollTop: 0
        }, 1000);
    });

    /*pop-up control*/
    $('.blue-love').on('click', function () {
        $('.pop-up').show(100, function () {
            $(frame).attr('src', 'register.html').load(function () {
                $(frame).fadeIn(duration)
            });
        });
    });

    $('.pop-wrapper').on('click', function (e) {
        e.stopPropagation();

    });


    var frame = $('.pop-wrapper iframe'),
        duration = 200,
        popWrapper = $('.pop-wrapper');

    $('.do-pop').on('click', function (e) {
        $('.pop-up').show(100, function () {
            $(frame).attr('src', $(e.target).data('target')).load(function () {
                console.log($(frame).contents().find('.pop-body').height());
                $(popWrapper).height($(frame).contents().find('.pop-body').height());
                $(frame).height($(frame).contents().find('.pop-body').height());
                $(frame).fadeIn(duration)
            });
        });
        return false;
    });


    $('.pop-up').on('click', function (e) {
        $('.pop-close').trigger('click');
    });

    $('.pop-close').on('click', function (e) {
        //  $('.pop-wrapper iframe').fadeOut(duration, function () {
        $('.pop-up').fadeOut(duration);
        $('.pop-up iframe').attr('src', '');

        //});

        $(frame).contents().find('.do-frame').off('click');

    });


    $('.pop-wrapper iframe').load(function () {

        $(frame).contents().find('.do-frame').on('click', function (e) {
            //    $(frame).fadeOut(100, function () {
            $(this).attr('src', $(e.target).data('target')).fadeIn(duration)
            //    });

        });


        $(frame).contents().find('a.do-link').on('click', function (e) {

            document.location = $(this).attr('href');
            return false;
        });


    });

    $('nav  iframe').load(function () {
        $(this).contents().find('.do-frame').on('click', function (e) {
            $('.pop-up').show();
            //   $(frame).fadeOut(100, function () {
            $(this).attr('src', $(e.target).data('target')).fadeIn(duration)
            //    });

            return false;
        });
    })


    /* $('.sign-h').bind('mouseover', function (e) {

    if ($(e.target).siblings('.dropdown_menu').hasClass('opened')) {

    if (!$(e.target).siblings('.dropdown_menu').hasClass('clicked')) {
    $('.dropdown_menu.opened').hide();
    $('.dropdown_menu.opened').removeClass('opened');
    }
    } else {
    $(this).siblings('.dropdown_menu').addClass('opened').show();
    }
    });*/

    //$('.sign-h').bind('click', function (e) {
    //    console.log('click');
    //
    //
    //    var dropMenu = $(e.target).siblings('.dropdown_menu');
    //    var signInFrame = dropMenu.find('iframe');
    //
    //    if (!dropMenu.hasClass('clicked')) {
    //
    //        signInFrame.attr('src', signInFrame.data('target'));
    //        $('.dropdown_menu').addClass('opened clicked');
    //        $(e.target).siblings('.dropdown_menu').show(1, function () {
    //
    //            $('body').bind('click', function (e) {
    //                $('.dropdown_menu').hide();
    //                $('.dropdown_menu').removeClass('opened clicked');
    //                $('body').unbind('click');
    //            });
    //        });
    //
    //
    //    } else {
    //
    //        $('.dropdown_menu.opened').hide();
    //        $('.dropdown_menu.opened').removeClass('opened clicked');
    //
    //    }
    //
    //});

    $('.sign-in').bind('click', function (e) {
        e.stopPropagation();

    });


    $('.frm').bind('mouseover', function (e) {
        $(this).siblings('.dropdown_menu').addClass('opened').show();
    });
    $('.frm').bind('click', function (e) {
        e.stopPropagation();

    });
    $('.frm').bind('mouseleave', function (e) {

        if (!$('.dropdown_menu.opened.clicked').length) {
            $('.dropdown_menu.opened').hide();
            $('.dropdown_menu.opened').removeClass('opened');
        }


    });
    //$('.sign-h').bind('mouseleave', function (e) {
    //    if ((!$('.frm').is(":hover")) && (!$('.dropdown_menu.opened.clicked').length)) {
    //        $('.dropdown_menu.opened').hide();
    //        $('.dropdown_menu.opened').removeClass('opened');
    //    }
    //});

    $('a.dropdown').parent('li').addClass('relative');
    $('a.dropdown').bind('mouseover', function (e) {
        $(this).siblings('.dropdown_menu').show();

        $(this).parent('li').bind('mouseleave', function (e) {

            $(this).find('.dropdown_menu').hide();

        });

    });
    $(".sign-last-row input[type=checkbox]").bind('change', function (e) {

        $(this).parent('label').toggleClass('checked');

    });
    /*PAGES nav*/
    /*MONETIZE*/
    /*HASH navigation*/

    urlHash = function () {
        return window.location.hash.replace('#', '');
    };
    var pages = $('.pages section'),
        nav = $('.monetize-nav');
    if (nav.length > 0) {
        switch (urlHash()) {
            case 'apps':
                pages.eq(0).show();
                nav.find('a').eq(0).addClass('active');
                nav.find('a').eq(3).addClass('active');

                break;
            case 'websites':
                pages.eq(1).show();
                nav.find('a').eq(1).addClass('active');
                nav.find('a').eq(4).addClass('active');

                break;
            case 'media-partners':
                pages.eq(2).show();
                nav.find('a').eq(2).addClass('active');
                nav.find('a').eq(5).addClass('active');

                break;
            default:
                if (nav.hasClass('monetize1')) {
                    pages.eq(0).show();
                    nav.find('a').eq(0).addClass('active');
                    nav.find('a').eq(3).addClass('active');
                } else if (nav.hasClass('monetize2')) {
                    pages.eq(1).show();
                    nav.find('a').eq(1).addClass('active');
                    nav.find('a').eq(4).addClass('active');
                } else {
                    pages.eq(2).show();
                    nav.find('a').eq(2).addClass('active');
                    nav.find('a').eq(5).addClass('active');
                }

                break;
        }

        nav.find('a').bind('click', function (e) {
            nav.find('a').removeClass('active');
            nav.find('a').eq($(this).index()).addClass('active');
            nav.find('a').eq($(this).index() + 3).addClass('active');
            pages.hide();
            pages.eq($(this).index()).show();


            $('html,body').animate({
                scrollTop: 0
            }, 500);
        });

    }
    /*TERMS&POLICY*/
    /*TERMS nav*/
/*    if ($('main.terms').length > 0) {

        switch (urlHash()) {
            case 'advertisers':
                $('.content').hide().eq(0).show();
                $('.terms-nav a').removeClass('active').eq(0).addClass('active');
                break;
            case 'publishers':
                $('.content').hide().eq(1).show();
                $('.terms-nav a').removeClass('active').eq(1).addClass('active');
                break;
            default:
                $('.content').hide().eq(0).show();
                $('.terms-nav a').removeClass('active').eq(0).addClass('active');
                break;
        }


        $('.terms-nav').on('click', 'a', function (e) {

            $('.content').hide().eq($(e.target).index()).show();
            $('.terms-nav a ').removeClass('active').eq($(e.target).index()).addClass('active');

        });
        $('.policy').on('click', function (e) {

            $('.content').hide().eq(1).show();

            $('.terms-nav a').eq(0).removeClass('active');
            $('.terms-nav a').eq(1).addClass('active');

        });


    }*/
    /* index SLIDER */


    /*
    var cover = $('.slider.cover'),
    slides = $('.slide', cover);
    $('body').append('<img style="display:none;" class="slide-bg" src="s2.jpg"/>');
    $('body').append('<img style="display:none;" class="slide-bg" src="s3.jpg"/>');
    slides.hide();
    slides.eq(0).show();
    cover.append('<img class="slide-bg" src="' + slides.eq(0).data('img') + '"/>');
    $(cover.find('.slide-bg')).fadeIn(600);
    var speed = 600,
    interval = 5000;

    var slider = {
    change: function (n, direction) {

    n > slides.length - 1 ? n = 0 : n;

    if (direction == 'right') {
    var src = 'url(' + slides.eq(n).data('img') + ')';
    cover.append('<img class="slide-bg" src="' + slides.eq(n).data('img') + '"/>');
    cover.find('.slide-bg').eq(0).animate({left: '-100%'}, speed, function () {
    $(this).remove();
    });
    slides.hide();
    slides.eq(n).fadeIn(400);
    cover.find('.slide-bg').eq(1).show().css({right: '-100%'}).animate({right: '0'}, speed);

    } else {
    src = 'url(' + slides.eq(n).data('img') + ')';
    cover.append('<img class="slide-bg" src="' + slides.eq(n).data('img') + '"/>');
    cover.find('.slide-bg').eq(0).css({left: '0px'}).animate({left: '100%'}, speed, function () {
    $(this).remove();
    });
    slides.hide();
    slides.eq(n).fadeIn(400);
    cover.find('.slide-bg').eq(1).show().css({left: '-100%'}).animate({left: '0'}, speed);
    }
    },
    next: function () {
    var n = $('.slide:visible', cover).index() + 1;
    slider.change(n, 'left');
    },
    autoChange: function (n) {
    n = cover.find('.slide:visible').index() + 1;
    n > slides.length - 1 ? n = 0 : n;

    var src = 'url(' + slides.eq(n).data('img') + ')';
    cover.append('<img class="slide-bg" src="' + slides.eq(n).data('img') + '"/>');
    slides.hide();
    slides.eq(n).fadeIn(400);
    cover.find('.slide-bg').eq(0).fadeOut(speed, function () {
    $(this).remove();
    });
    cover.find('.slide-bg').eq(1).show().css({top: '100%'}).animate({top: '0'}, speed);

    }
    };

    //   var timer = setInterval(slider.autoChange, interval);

    $('.rotator-left', cover).bind('click', function () {
    //  clearInterval(timer);
    //  timer = setInterval(slider.autoChange, interval);
    slider.change(cover.find('.slide:visible').index() - 1, 'right');
    });
    $('.rotator-right', cover).bind('click', function () {
    //  clearInterval(timer);
    //   timer = setInterval(slider.autoChange, interval);
    slider.change(cover.find('.slide:visible').index() + 1, 'left');
    });


    var platformSlider = $('.platformSlider');
    $('.slide', platformSlider).hide().eq(0).show();

    for (var i = 0; i < $('.slide', platformSlider).length; i++) {
    $('.rotator-nav', platformSlider).append(' <a href="#"></a>');
    }

    $('.rotator-nav a', platformSlider).eq(0).addClass('active');


    var changeSlide = function (n) {
    n > $('.slide', platformSlider).length - 1 || n < 0 ? n = 0 : n;

    $('.slide', platformSlider).hide().eq(n).show();
    $('.rotator-nav a', platformSlider).removeClass('active').eq(n).addClass('active');
    };

    var platformInterval = setInterval(changeSlide(platformSlider.find('.slide:visible').index() + 1), 1000);


    $('.rotator-right', platformSlider).bind('click', function () {

    changeSlide(platformSlider.find('.slide:visible').index() + 1);
    });


    $('.rotator-left', platformSlider).bind('click', function () {
    changeSlide(platformSlider.find('.slide:visible').index() - 1);
    });
    */


    /*ZOOM*/

    $('.zoom-title, .zoom-cover').bind('click', function (e) {

        var cover = $(this).parent('.zoomBlock').html(),
            title = $(this).html();

        $('.pop-wrapper').hide();
        $('.pop-up .pop-close').addClass("zoom-close");
        $('.pop-up').show().append("<div class='pop-body zoomer'> <div class='pop-close clearfix'></div>" + cover + " </div>");
        $('html').css({ 'overflow': 'hidden' });
        $('.pop-up .pop-body.zoomer').show(0);
        $('.pop-up, .zoom-close').bind('click', function () {
            $('.zoomer').remove();
            $(this).hide();
            $('.pop-close').removeClass('zoom-close');
            $('html').css({ 'overflow': 'scroll' });

        });


    });

    /*Press Page*/
    $('article').each(function () {
        $('.text *', this).hide().eq(0).show()
        $('.text br').show();
    }
    );

    $('article').on('click', '.more', function (e) {
        $(e.target).parent('.article-footer').siblings('.text').parent('.entry').toggleClass('opened').find('.text *').slideDown(300);
        $(e.target).removeClass('more').addClass('less').html('Less...');


    });
    $('article').on('click', '.less', function (e) {
        $(e.target).parent('.article-footer').siblings('.text').parent('.entry').toggleClass('opened').find('.text *').not('p:first-child, br').slideUp(300);
        $(e.target).removeClass('less').addClass('more').html('More...');

    });


    $('.joinUp input').on('keyup', function (e) {
        var thisForm = $('.joinUp form');
        thisForm.find('input').each(function (e) {
            if ($(this).val().length < 5) {
                $(this).parent('.input').addClass('error');
            } else {
                $(this).parent('.input').removeClass('error');


            }
        });

        var reg = /[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$/,
            patt = new RegExp(reg);

        thisForm.find('input[type=email]').each(function () {
            if (!patt.test($(this).val())) {
                $(this).parent('.input').addClass('error');
            } else {
                $(this).parent('.input').removeClass('error');
            }
        });


        if ((thisForm.find('input[type=password]').eq(0).val() === thisForm.find('input[type=password]').eq(1).val()) && (thisForm.find('input[type=password]').eq(0).val().length >= 5)) {
            thisForm.find('input[type=password]').parent('.input').removeClass('error');
        } else {
            thisForm.find('input[type=password]').parent('.input').addClass('error');
        }


        if (thisForm.find('.input.error').length === 0) {
            thisForm.find('input[type=submit]').removeClass('disabled').addClass('enabled');
        } else {
            thisForm.find('.hint p').hide();
            thisForm.find('.hint p.obligatory').show();
            thisForm.find('input[type=submit]').addClass('disabled')

        }

        return false;
    });
    $('.joinUp').on('click', 'input[type=submit]', function (e) {
        $('.joinUp form input').trigger('keyup');
        return false;
    });

    $('.joinUp').on('click', 'input[type=submit].disabled', function (e) {

        return false;
    });


    $('.joinUp').on('click', 'input[type=submit].enabled', function (e) {

        var thisForm = $('.joinUp form');
        $(thisForm).slideUp(400, function () {
            $(thisForm).siblings('.sended').find('span').html(thisForm.find('input[type=email]').val());
            $(thisForm).siblings('.sended').slideDown(400);
        });

        return false;
    });


    $('.sendForm').on('click', function (e) {

        var thisForm = $(e.target).parent('form');
        var thisForm = $(e.target).parent('form');
        thisForm.find('input').each(function (e) {
            if ($(this).val().length < 5) {
                $(this).parent('.input').addClass('error');
            } else {
                $(this).parent('.input').removeClass('error');
            }
        });

        $(e.target).parent('form').find('textarea').each(function (e) {
            if ($(this).val().length < 5) {
                $(this).parent('.input').addClass('error');
            } else {
                $(this).parent('.input').removeClass('error');
            }
        });
        thisForm.find('.hint').remove();
        if (thisForm.find('.input.error').length === 0) {
            thisForm.append('<p class="hint success">Message sent successfully</p>')
        } else {
            thisForm.append('<p class="hint error text-right">Please fill the obligatory fields <span>*</span></p>')
        }

        return false;
    });


    if (!$('.video-block').find('iframe').length) {
        $('.video-block').hide();
        console.log($('.video-block').find('iframe').length)
    }

    var examples = $('.phone-rotator>img');

    examples.hide().eq(0).show();
    $('.monetise-links a').eq(0).addClass('active');

    $('.monetise-links a').on('click', function (e) {
        examples.hide().eq($(e.target).index()).show();
        $('.monetise-links a').removeClass('active').eq($(e.target).index()).addClass('active');
        e.preventDefault()
    });


    var peaces = function (n) {
        var source = 'content/developers_peace_' + n + '.jpg',
            img = $("<img />").attr('src', source).load(function () {

                console.log('Peace by next link  --  ' + source + '  are loaded');
                $(".devs8k").append(img);
                if (n <= 6) {
                    n++;
                    peaces(n);
                }
            });
    };

    if ($('.devs8k').length) {
        peaces(1);
    }

});
(function ($) {

    'use strict';

    function MultipleSelect($el, options) {
        var that = this,
            name = $el.attr('name') || options.name || ''

        $el.parent().hide();
        var elWidth = $el.css("width");
        $el.parent().show();
        if (elWidth == "0px") {
            elWidth = $el.outerWidth() + 20
        }

        this.$el = $el.hide();
        this.options = options;
        this.$parent = $('<div' + $.map(['class', 'title'], function (att) {
            var attValue = that.$el.attr(att) || '';
            attValue = (att === 'class' ? ('ms-parent' + (attValue ? ' ' : '')) : '') + attValue;
            return attValue ? (' ' + att + '="' + attValue + '"') : '';
        }).join('') + ' />');
        this.$choice = $('<button type="button" class="ms-choice"><span class="placeholder">' +
        options.placeholder + '</span><div></div></button>');
        this.$drop = $('<div class="ms-drop ' + options.position + '"></div>');
        this.$el.after(this.$parent);
        this.$parent.append(this.$choice);
        this.$parent.append(this.$drop);

        if (this.$el.prop('disabled')) {
            this.$choice.addClass('disabled');
        }
        this.$parent.css('width', options.width || elWidth);

        if (!this.options.keepOpen) {
            $('body').click(function (e) {
                if ($(e.target)[0] === that.$choice[0] ||
                    $(e.target).parents('.ms-choice')[0] === that.$choice[0]) {
                    return;
                }
                if (($(e.target)[0] === that.$drop[0] ||
                    $(e.target).parents('.ms-drop')[0] !== that.$drop[0]) &&
                    that.options.isOpen) {
                    that.close();
                }
            });
        }

        this.selectAllName = 'name="selectAll' + name + '"';
        this.selectGroupName = 'name="selectGroup' + name + '"';
        this.selectItemName = 'name="selectItem' + name + '"';
    }

    MultipleSelect.prototype = {
        constructor: MultipleSelect,

        init: function () {
            var that = this,
                html = [];
            if (this.options.filter) {
                html.push(
                    '<div class="ms-search">',
                    '<input type="text" autocomplete="off" autocorrect="off" autocapitilize="off" spellcheck="false">',
                    '</div>'
                );
            }
            html.push('<ul>');
            if (this.options.selectAll && !this.options.single) {
                html.push(
                    '<li class="ms-select-all">',
                    '<label>',
                    '<input type="checkbox" ' + this.selectAllName + ' /> ',
                    this.options.selectAllDelimiter[0] + this.options.selectAllText + this.options.selectAllDelimiter[1],
                    '</label>',
                    '</li>'
                );
            }
            $.each(this.$el.children(), function (i, elm) {
                html.push(that.optionToHtml(i, elm));
            });
            html.push('<li class="ms-no-results">' + this.options.noMatchesFound + '</li>');
            html.push('</ul>');
            this.$drop.html(html.join(''));

            this.$drop.find('ul').css('max-height', this.options.maxHeight + 'px');
            this.$drop.find('.multiple').css('width', this.options.multipleWidth + 'px');

            this.$searchInput = this.$drop.find('.ms-search input');
            this.$selectAll = this.$drop.find('input[' + this.selectAllName + ']');
            this.$selectGroups = this.$drop.find('input[' + this.selectGroupName + ']');
            this.$selectItems = this.$drop.find('input[' + this.selectItemName + ']:enabled');
            this.$disableItems = this.$drop.find('input[' + this.selectItemName + ']:disabled');
            this.$noResults = this.$drop.find('.ms-no-results');
            this.events();
            this.updateSelectAll(true);
            this.update(true);

            if (this.options.isOpen) {
                this.open();
            }
        },

        optionToHtml: function (i, elm, group, groupDisabled) {
            var that = this,
                $elm = $(elm),
                html = [],
                multiple = this.options.multiple,
                optAttributesToCopy = ['class', 'title'],
                clss = $.map(optAttributesToCopy, function (att, i) {
                    var isMultiple = att === 'class' && multiple;
                    var attValue = $elm.attr(att) || '';
                    return (isMultiple || attValue) ?
                        (' ' + att + '="' + (isMultiple ? ('multiple' + (attValue ? ' ' : '')) : '') + attValue + '"') :
                        '';
                }).join(''),
                disabled,
                type = this.options.single ? 'radio' : 'checkbox';

            if ($elm.is('option')) {
                var value = $elm.val(),
                    text = that.options.textTemplate($elm),
                    selected = (that.$el.attr('multiple') != undefined) ? $elm.prop('selected') : ($elm.attr('selected') == 'selected'),
                    style = this.options.styler(value) ? ' style="' + this.options.styler(value) + '"' : '';

                disabled = groupDisabled || $elm.prop('disabled');
                if ((this.options.blockSeparator > "") && (this.options.blockSeparator == $elm.val())) {
                    html.push(
                        '<li' + clss + style + '>',
                        '<label class="' + this.options.blockSeparator + (disabled ? 'disabled' : '') + '">',
                        text,
                        '</label>',
                        '</li>'
                    );
                } else {
                    html.push(
                        '<li' + clss + style + '>',
                        '<label' + (disabled ? ' class="disabled"' : '') + '>',
                        '<input type="' + type + '" ' + this.selectItemName + ' value="' + value + '"' +
                        (selected ? ' checked="checked"' : '') +
                        (disabled ? ' disabled="disabled"' : '') +
                        (group ? ' data-group="' + group + '"' : '') +
                        '/> ',
                        text,
                        '</label>',
                        '</li>'
                    );
                }
            } else if (!group && $elm.is('optgroup')) {
                var _group = 'group_' + i,
                    label = $elm.attr('label');

                disabled = $elm.prop('disabled');
                html.push(
                    '<li class="group">',
                    '<label class="optgroup' + (disabled ? ' disabled' : '') + '" data-group="' + _group + '">',
                    (this.options.hideOptgroupCheckboxes ? '' : '<input type="checkbox" ' + this.selectGroupName +
                    (disabled ? ' disabled="disabled"' : '') + ' /> '),
                    label,
                    '</label>',
                    '</li>');
                $.each($elm.children(), function (i, elm) {
                    html.push(that.optionToHtml(i, elm, _group, disabled));
                });
            }
            return html.join('');
        },

        events: function () {
            var that = this;

            function toggleOpen(e) {
                e.preventDefault();
                that[that.options.isOpen ? 'close' : 'open']();
            }

            var label = this.$el.parent().closest('label')[0] || $('label[for=' + this.$el.attr('id') + ']')[0];
            if (label) {
                $(label).off('click').on('click', function (e) {
                    if (e.target.nodeName.toLowerCase() !== 'label' || e.target !== this) {
                        return;
                    }
                    toggleOpen(e);
                    if (!that.options.filter || !that.options.isOpen) {
                        that.focus();
                    }
                    e.stopPropagation(); // Causes lost focus otherwise
                });
            }
            this.$choice.off('click').on('click', toggleOpen)
                .off('focus').on('focus', this.options.onFocus)
                .off('blur').on('blur', this.options.onBlur);

            this.$parent.off('keydown').on('keydown', function (e) {
                switch (e.which) {
                    case 27: // esc key
                        that.close();
                        that.$choice.focus();
                        break;
                }
            });
            this.$searchInput.off('keydown').on('keydown', function (e) {
                if (e.keyCode === 9 && e.shiftKey) { // Ensure shift-tab causes lost focus from filter as with clicking away
                    that.close();
                }
            }).off('keyup').on('keyup', function (e) {
                if (that.options.filterAcceptOnEnter &&
                    (e.which === 13 || e.which == 32) && // enter or space
                    that.$searchInput.val() // Avoid selecting/deselecting if no choices made
                ) {
                    that.$selectAll.click();
                    that.close();
                    that.focus();
                    return;
                }
                that.filter();
            });
            this.$selectAll.off('click').on('click', function () {
                var checked = $(this).prop('checked'),
                    $items = that.$selectItems.filter(':visible');
                if ($items.length === that.$selectItems.length) {
                    that[checked ? 'checkAll' : 'uncheckAll']();
                } else { // when the filter option is true
                    that.$selectGroups.prop('checked', checked);
                    $items.prop('checked', checked);
                    that.options[checked ? 'onCheckAll' : 'onUncheckAll']();
                    that.update();
                }
            });
            this.$selectGroups.off('click').on('click', function () {
                var group = $(this).parent().attr('data-group'),
                    $items = that.$selectItems.filter(':visible'),
                    $children = $items.filter('[data-group="' + group + '"]'),
                    checked = $children.length !== $children.filter(':checked').length;
                $children.prop('checked', checked);
                that.updateSelectAll();
                that.update();
                that.options.onOptgroupClick({
                    label: $(this).parent().text(),
                    checked: checked,
                    children: $children.get()
                });
            });
            this.$selectItems.off('click').on('click', function () {
                that.updateSelectAll();
                that.update();
                that.updateOptGroupSelect();
                that.options.onClick({
                    label: $(this).parent().text(),
                    value: $(this).val(),
                    checked: $(this).prop('checked')
                });

                if (that.options.single && that.options.isOpen && !that.options.keepOpen) {
                    that.close();
                }
            });
        },

        open: function () {
            if (this.$choice.hasClass('disabled')) {
                return;
            }
            this.options.isOpen = true;
            this.$choice.find('>div').addClass('open');
            this.$drop.show();

            // fix filter bug: no results show
            this.$selectAll.parent().show();
            this.$noResults.hide();

            // Fix #77: 'All selected' when no options
            if (this.$el.children().length === 0) {
                this.$selectAll.parent().hide();
                this.$noResults.show();
            }

            if (this.options.container) {
                var offset = this.$drop.offset();
                this.$drop.appendTo($(this.options.container));
                this.$drop.offset({top: offset.top, left: offset.left});
            }
            if (this.options.filter) {
                this.$searchInput.val('');
                this.$searchInput.focus();
                this.filter();
            }
            this.options.onOpen();
        },

        close: function () {
            this.options.isOpen = false;
            this.$choice.find('>div').removeClass('open');
            this.$drop.hide();
            if (this.options.container) {
                this.$parent.append(this.$drop);
                this.$drop.css({
                    'top': 'auto',
                    'left': 'auto'
                });
            }
            this.options.onClose();
        },

        update: function (isInit) {
            var selects = this.getSelects(),
                $span = this.$choice.find('>span');

            if (selects.length === 0) {
                $span.addClass('placeholder').html(this.options.placeholder);
            } else if (this.options.countSelected && selects.length < this.options.minimumCountSelected) {
                $span.removeClass('placeholder').html(
                    (this.options.displayValues ? selects : this.getSelects('text'))
                        .join(this.options.delimiter));
            } else if (this.options.allSelected &&
                selects.length === this.$selectItems.length + this.$disableItems.length) {
                $span.removeClass('placeholder').html(this.options.allSelected);
            } else if ((this.options.countSelected || this.options.etcaetera) && selects.length > this.options.minimumCountSelected) {
                if (this.options.etcaetera) {
                    $span.removeClass('placeholder').html((this.options.displayValues ? selects : this.getSelects('text').slice(0, this.options.minimumCountSelected)).join(this.options.delimiter) + '...');
                }
                else {
                    $span.removeClass('placeholder').html(this.options.countSelected
                        .replace('#', selects.length)
                        .replace('%', this.$selectItems.length + this.$disableItems.length));
                }
            } else {
                $span.removeClass('placeholder').html(
                    (this.options.displayValues ? selects : this.getSelects('text'))
                        .join(this.options.delimiter));
            }
            // set selects to select
            this.$el.val(this.getSelects());

            // add selected class to selected li
            this.$drop.find('li').removeClass('selected');
            this.$drop.find('input[' + this.selectItemName + ']:checked').each(function () {
                $(this).parents('li').first().addClass('selected');
            });

            // trigger <select> change event
            if (!isInit) {
                this.$el.trigger('change');
            }
        },

        updateSelectAll: function (Init) {
            var $items = this.$selectItems;
            if (!Init) {
                $items = $items.filter(':visible');
            }
            this.$selectAll.prop('checked', $items.length &&
            $items.length === $items.filter(':checked').length);
            if (this.$selectAll.prop('checked')) {
                this.options.onCheckAll();
            }
        },

        updateOptGroupSelect: function () {
            var $items = this.$selectItems.filter(':visible');
            $.each(this.$selectGroups, function (i, val) {
                var group = $(val).parent().attr('data-group'),
                    $children = $items.filter('[data-group="' + group + '"]');
                $(val).prop('checked', $children.length &&
                $children.length === $children.filter(':checked').length);
            });
        },

        //value or text, default: 'value'
        getSelects: function (type) {
            var that = this,
                texts = [],
                values = [];
            this.$drop.find('input[' + this.selectItemName + ']:checked').each(function () {
                texts.push($(this).parents('li').first().text());
                values.push($(this).val());
            });

            if (type === 'text' && this.$selectGroups.length) {
                texts = [];
                this.$selectGroups.each(function () {
                    var html = [],
                        text = $.trim($(this).parent().text()),
                        group = $(this).parent().data('group'),
                        $children = that.$drop.find('[' + that.selectItemName + '][data-group="' + group + '"]'),
                        $selected = $children.filter(':checked');

                    if ($selected.length === 0) {
                        return;
                    }

                    html.push('[');
                    html.push(text);
                    if ($children.length > $selected.length) {
                        var list = [];
                        $selected.each(function () {
                            list.push($(this).parent().text());
                        });
                        html.push(': ' + list.join(', '));
                    }
                    html.push(']');
                    texts.push(html.join(''));
                });
            }
            return type === 'text' ? texts : values;
        },

        setSelects: function (values) {
            var that = this;
            this.$selectItems.prop('checked', false);
            $.each(values, function (i, value) {
                that.$selectItems.filter('[value="' + value + '"]').prop('checked', true);
            });
            this.$selectAll.prop('checked', this.$selectItems.length ===
            this.$selectItems.filter(':checked').length);
            this.update();
        },

        enable: function () {
            this.$choice.removeClass('disabled');
        },

        disable: function () {
            this.$choice.addClass('disabled');
        },

        checkAll: function () {
            this.$selectItems.prop('checked', true);
            this.$selectGroups.prop('checked', true);
            this.$selectAll.prop('checked', true);
            this.update();
            this.options.onCheckAll();
        },

        uncheckAll: function () {
            this.$selectItems.prop('checked', false);
            this.$selectGroups.prop('checked', false);
            this.$selectAll.prop('checked', false);
            this.update();
            this.options.onUncheckAll();
        },

        focus: function () {
            this.$choice.focus();
            this.options.onFocus();
        },

        blur: function () {
            this.$choice.blur();
            this.options.onBlur();
        },

        refresh: function () {
            this.init();
        },

        filter: function () {
            var that = this,
                text = $.trim(this.$searchInput.val()).toLowerCase();
            if (text.length === 0) {
                this.$selectItems.parent().show();
                this.$disableItems.parent().show();
                this.$selectGroups.parent().show();
            } else {
                this.$selectItems.each(function () {
                    var $parent = $(this).parent();
                    $parent[$parent.text().toLowerCase().indexOf(text) < 0 ? 'hide' : 'show']();
                });
                this.$disableItems.parent().hide();
                this.$selectGroups.each(function () {
                    var $parent = $(this).parent();
                    var group = $parent.attr('data-group'),
                        $items = that.$selectItems.filter(':visible');
                    $parent[$items.filter('[data-group="' + group + '"]').length === 0 ? 'hide' : 'show']();
                });

                //Check if no matches found
                if (this.$selectItems.filter(':visible').length) {
                    this.$selectAll.parent().show();
                    this.$noResults.hide();
                } else {
                    this.$selectAll.parent().hide();
                    this.$noResults.show();
                }
            }
            this.updateOptGroupSelect();
            this.updateSelectAll();
        }
    };

    $.fn.multipleSelect = function () {
        var option = arguments[0],
            args = arguments,

            value,
            allowedMethods = [
                'getSelects', 'setSelects',
                'enable', 'disable',
                'checkAll', 'uncheckAll',
                'focus', 'blur',
                'refresh'
            ];

        this.each(function () {
            var $this = $(this),
                data = $this.data('multipleSelect'),
                options = $.extend({}, $.fn.multipleSelect.defaults,
                    $this.data(), typeof option === 'object' && option);

            if (!data) {
                data = new MultipleSelect($this, options);
                $this.data('multipleSelect', data);
            }

            if (typeof option === 'string') {
                if ($.inArray(option, allowedMethods) < 0) {
                    throw "Unknown method: " + option;
                }
                value = data[option](args[1]);
            } else {
                data.init();
                if (args[1]) {
                    value = data[args[1]].apply(data, [].slice.call(args, 2));
                }
            }
        });

        return value ? value : this;
    };

    $.fn.multipleSelect.defaults = {
        name: '',
        isOpen: false,
        placeholder: '',
        selectAll: true,
        selectAllText: 'Show all',
        selectAllDelimiter: ['[', ']'],
        allSelected: 'Show All',
        minimumCountSelected: 3,
        countSelected: '# of % selected',
        noMatchesFound: 'No matches found',
        multiple: false,
        multipleWidth: 80,
        single: false,
        filter: false,
        width: undefined,
        maxHeight: 250,
        container: null,
        position: 'bottom',
        keepOpen: false,
        blockSeparator: '',
        displayValues: false,
        delimiter: '; ',

        styler: function () {
            return false;
        },
        textTemplate: function ($elm) {
            return $elm.text();
        },

        onOpen: function () {
            return false;
        },
        onClose: function () {
            return false;
        },
        onCheckAll: function () {
            return false;
        },
        onUncheckAll: function () {
            return false;
        },
        onFocus: function () {
            return false;
        },
        onBlur: function () {
            return false;
        },
        onOptgroupClick: function () {
            return false;
        },
        onClick: function () {
            return false;
        }
    };
})(jQuery);



$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    }
    else {
        return results[1];
    }
}

$.addUrlRefToCookie = function () {
    var ref = $.trim($.urlParam('ref'))

    if (ref == null || ref == '') {
        return;
    }

    var date = new Date();
    var minutes = 30;
    date.setTime(date.getTime() + (minutes * 60 * 1000));

    $.cookie("ref", ref, { expires: date });
}

$.getUrlRefFromCookie = function () {
    var ref = $.cookie("ref");

    if (ref == null || ref == '') {
        return "";
    }

    return "?ref=" + ref;
}



