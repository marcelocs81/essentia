(function ($) {
    function c2a (a) {
        var f;

        if (a && a.constructor == Array && a.length == 3) {
            return a;
        } else {
            f = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(a);
            if (f) {
                return [
                    parseInt(f[1]),
                    parseInt(f[2]),
                    parseInt(f[3])
                ]
            }

            f = /rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(a);
            if (f) {
                return [
                    2.55 * parseFloat(f[1]),
                    2.55 * parseFloat(f[2]),
                    2.55 * parseFloat(f[3])
                ]
            }

            f = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(a);
            if (f) {
                return [
                    parseInt(f[1], 16),
                    parseInt(f[2], 16),
                    parseInt(f[3], 16)
                ];
            }

            f = /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(a);
            if (f) {
                return [
                    parseInt(f[1] + f[1], 16),
                    parseInt(f[2] + f[2], 16),
                    parseInt(f[3] + f[3], 16)
                ];
            } else {
                if (/rgba\(0, 0, 0, 0\)/.exec(a)) {
                    return c.transparent || [255, 255, 255];
                }

                return c[d.trim(a).toLowerCase()];
            }
        }
    }

    $.each("backgroundColor borderTopColor borderLeftColor borderBottomColor borderRightColor color outlineColor".split(String.fromCharCode(32)), function (c, f) {
        $.fx.step[f] = function (c) {
            if (!c.colorInit) {
                var e = c.elem,
                    k = f,
                    g;

                do {
                    g = $.css(e, k);
                    if (new String() != g && g != "transparent" || $.nodeName(e, "body"))
                        break;

                    k = "backgroundColor"
                } while (e = e.parentNode);

                c.start = c2a(g);
                c.end = c2a(c.end);
                c.colorInit = true;
            }

            for (var i = 0, k = 2, r = 0, x, rgb = []; i <= k; ++i) {
                x = Math.max(Math.min(parseInt(c.pos * (c.end[i] - c.start[i]) + c.start[i]), 255), r);
                rgb.push(x);
            }

            c.elem.style[f] = "rgb("+ rgb.join() +")";
        }
    });

    var c = {
        transparent: [255, 255, 255]
    };
})(window.$ || jQuery);

function highlight (sel, to, from, duration, callback) {
    $(sel).css({
        backgroundColor: from
    }).animate({
        backgroundColor: to
    }, parseInt(duration || 2000, 10), function () {
        if (callback !== undefined) {
            callback.apply($(this), []);
        } else {
            var that = $(this);
            that.css('background-color', new String());
        }
    })
}