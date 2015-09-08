$(document).ready(function ($) {

    $("#images > div:gt(0)").hide();
    $("#verbs > span").hide();
    cycleWords();

    /* Init values 6000 and 1000 */
    var cycleTime = 6000;
    var fadeTime = 1000;

    function cycleWords() {
        $('#verbs > span:first')
            .delay(1000)
            .fadeIn(fadeTime)
            .delay(3500)
            .fadeOut(fadeTime)
            .next()
            .end()
            .appendTo('#verbs');
    }

    function cycleBackgrounds() {
        $('#images > div:first')
            .fadeOut(fadeTime)
            .next()
            .fadeIn(fadeTime)
            .end()
            .appendTo('#images');
    }

    setInterval(cycleBackgrounds, cycleTime);
    setInterval(cycleWords, cycleTime);
    $("a.trigger").click(function (event) {
        event.preventDefault();
        linkLocation = $(this).attr("href");;
        console.log(linkLocation);
        $("body").fadeOut(1000, redirectPage);
    });

    function redirectPage() {
        console.log(linkLocation);
        window.location = linkLocation;
    }
    initSelectedNav();

    //toggle 3d navigation
    $('.cd-3d-nav-trigger').on('click', function () {
        toggle3dBlock(!$('.cd-header').hasClass('nav-is-visible'));
    });

    //select a new item from the 3d navigation
    $('.cd-3d-nav').on('click', 'a', function () {
        var selected = $(this);
        selected.parent('li').addClass('cd-selected').siblings('li').removeClass('cd-selected');
        updateSelectedNav('close');
    });

    $(window).on('resize', function () {
        window.requestAnimationFrame(updateSelectedNav);
    });

    function toggle3dBlock(addOrRemove) {
        if (typeof (addOrRemove) === 'undefined') addOrRemove = true;
        $('.cd-header').toggleClass('nav-is-visible', addOrRemove);
        $('.cd-3d-nav-container').toggleClass('nav-is-visible', addOrRemove);
        $('#content').toggleClass('nav-is-visible', addOrRemove).one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
            //fix marker position when opening the menu (after a window resize)
            addOrRemove && updateSelectedNav();
        });
    }

    function initSelectedNav() {
        var path = window.location.pathname;
        $('.cd-3d-nav li a').each(function () {
            if (this.getAttribute('href') == path) {
                $(this).parent().toggleClass('cd-selected');
                window.requestAnimationFrame(updateSelectedNav);
                return;
            }
        })
    };

    //this function update the .cd-marker position
    function updateSelectedNav(type) {
        var selectedItem = $('.cd-selected'),
            selectedItemPosition = selectedItem.index() + 1,
            leftPosition = selectedItem.offset().left,
            backgroundColor = selectedItem.data('color'),
            marker = $('.cd-marker');

        marker.removeClassPrefix('color').addClass('color-' + selectedItemPosition).css({
            'left': leftPosition,
        });
        if (type == 'close') {
            marker.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                toggle3dBlock(false);
            });
        }
    }

    $.fn.removeClassPrefix = function (prefix) {
        this.each(function (i, el) {
            var classes = el.className.split(" ").filter(function (c) {
                return c.lastIndexOf(prefix, 0) !== 0;
            });
            el.className = $.trim(classes.join(" "));
        });
        return this;
    };
});