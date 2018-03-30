



!function(t, e, i) {
    function n(t, e) {
        return typeof t === e
    }
    function s() {
        var t, e, i, s, o, r, a;
        for (var l in b)
            if (b.hasOwnProperty(l)) {
                if (t = [],
                e = b[l],
                e.name && (t.push(e.name.toLowerCase()),
                e.options && e.options.aliases && e.options.aliases.length))
                    for (i = 0; i < e.options.aliases.length; i++)
                        t.push(e.options.aliases[i].toLowerCase());
                for (s = n(e.fn, "function") ? e.fn() : e.fn,
                o = 0; o < t.length; o++)
                    r = t[o],
                    a = r.split("."),
                    1 === a.length ? w[a[0]] = s : (!w[a[0]] || w[a[0]]instanceof Boolean || (w[a[0]] = new Boolean(w[a[0]])),
                    w[a[0]][a[1]] = s),
                    y.push((s ? "" : "no-") + a.join("-"))
            }
    }
    function o(t) {
        var e = x.className
          , i = w._config.classPrefix || "";
        if (C && (e = e.baseVal),
        w._config.enableJSClass) {
            var n = new RegExp("(^|\\s)" + i + "no-js(\\s|$)");
            e = e.replace(n, "$1" + i + "js$2")
        }
        w._config.enableClasses && (e += " " + i + t.join(" " + i),
        C ? x.className.baseVal = e : x.className = e)
    }
    function r(t) {
        return t.replace(/([a-z])-([a-z])/g, function(t, e, i) {
            return e + i.toUpperCase()
        }).replace(/^-/, "")
    }
    function a(t, e) {
        return !!~("" + t).indexOf(e)
    }
    function l() {
        return "function" != typeof e.createElement ? e.createElement(arguments[0]) : C ? e.createElementNS.call(e, "http://www.w3.org/2000/svg", arguments[0]) : e.createElement.apply(e, arguments)
    }
    function c(t, e) {
        return function() {
            return t.apply(e, arguments)
        }
    }
    function u(t, e, i) {
        var s;
        for (var o in t)
            if (t[o]in e)
                return i === !1 ? t[o] : (s = e[t[o]],
                n(s, "function") ? c(s, i || e) : s);
        return !1
    }
    function h(t) {
        return t.replace(/([A-Z])/g, function(t, e) {
            return "-" + e.toLowerCase()
        }).replace(/^ms-/, "-ms-")
    }
    function d() {
        var t = e.body;
        return t || (t = l(C ? "svg" : "body"),
        t.fake = !0),
        t
    }
    function p(t, i, n, s) {
        var o, r, a, c, u = "modernizr", h = l("div"), p = d();
        if (parseInt(n, 10))
            for (; n--; )
                a = l("div"),
                a.id = s ? s[n] : u + (n + 1),
                h.appendChild(a);
        return o = l("style"),
        o.type = "text/css",
        o.id = "s" + u,
        (p.fake ? p : h).appendChild(o),
        p.appendChild(h),
        o.styleSheet ? o.styleSheet.cssText = t : o.appendChild(e.createTextNode(t)),
        h.id = u,
        p.fake && (p.style.background = "",
        p.style.overflow = "hidden",
        c = x.style.overflow,
        x.style.overflow = "hidden",
        x.appendChild(p)),
        r = i(h, t),
        p.fake ? (p.parentNode.removeChild(p),
        x.style.overflow = c,
        x.offsetHeight) : h.parentNode.removeChild(h),
        !!r
    }
    function f(e, n) {
        var s = e.length;
        if ("CSS"in t && "supports"in t.CSS) {
            for (; s--; )
                if (t.CSS.supports(h(e[s]), n))
                    return !0;
            return !1
        }
        if ("CSSSupportsRule"in t) {
            for (var o = []; s--; )
                o.push("(" + h(e[s]) + ":" + n + ")");
            return o = o.join(" or "),
            p("@supports (" + o + ") { #modernizr { position: absolute; } }", function(t) {
                return "absolute" == getComputedStyle(t, null).position
            })
        }
        return i
    }
    function m(t, e, s, o) {
        function c() {
            h && (delete E.style,
            delete E.modElem)
        }
        if (o = !n(o, "undefined") && o,
        !n(s, "undefined")) {
            var u = f(t, s);
            if (!n(u, "undefined"))
                return u
        }
        for (var h, d, p, m, g, v = ["modernizr", "tspan"]; !E.style; )
            h = !0,
            E.modElem = l(v.shift()),
            E.style = E.modElem.style;
        for (p = t.length,
        d = 0; p > d; d++)
            if (m = t[d],
            g = E.style[m],
            a(m, "-") && (m = r(m)),
            E.style[m] !== i) {
                if (o || n(s, "undefined"))
                    return c(),
                    "pfx" != e || m;
                try {
                    E.style[m] = s
                } catch (y) {}
                if (E.style[m] != g)
                    return c(),
                    "pfx" != e || m
            }
        return c(),
        !1
    }
    function g(t, e, i, s, o) {
        var r = t.charAt(0).toUpperCase() + t.slice(1)
          , a = (t + " " + T.join(r + " ") + r).split(" ");
        return n(e, "string") || n(e, "undefined") ? m(a, e, s, o) : (a = (t + " " + D.join(r + " ") + r).split(" "),
        u(a, e, i))
    }
    function v(t, e, n) {
        return g(t, i, i, e, n)
    }
    var y = []
      , b = []
      , _ = {
        _version: "3.3.1",
        _config: {
            classPrefix: "",
            enableClasses: !0,
            enableJSClass: !0,
            usePrefixes: !0
        },
        _q: [],
        on: function(t, e) {
            var i = this;
            setTimeout(function() {
                e(i[t])
            }, 0)
        },
        addTest: function(t, e, i) {
            b.push({
                name: t,
                fn: e,
                options: i
            })
        },
        addAsyncTest: function(t) {
            b.push({
                name: null,
                fn: t
            })
        }
    }
      , w = function() {};
    w.prototype = _,
    w = new w;
    var x = e.documentElement
      , C = "svg" === x.nodeName.toLowerCase()
      , k = "Moz O ms Webkit"
      , T = _._config.usePrefixes ? k.split(" ") : [];
    _._cssomPrefixes = T;
    var S = function(e) {
        var n, s = prefixes.length, o = t.CSSRule;
        if ("undefined" == typeof o)
            return i;
        if (!e)
            return !1;
        if (e = e.replace(/^@/, ""),
        n = e.replace(/-/g, "_").toUpperCase() + "_RULE",
        n in o)
            return "@" + e;
        for (var r = 0; s > r; r++) {
            var a = prefixes[r]
              , l = a.toUpperCase() + "_" + n;
            if (l in o)
                return "@-" + a.toLowerCase() + "-" + e
        }
        return !1
    };
    _.atRule = S;
    var D = _._config.usePrefixes ? k.toLowerCase().split(" ") : [];
    _._domPrefixes = D;
    var A = {
        elem: l("modernizr")
    };
    w._q.push(function() {
        delete A.elem
    });
    var E = {
        style: A.elem.style
    };
    w._q.unshift(function() {
        delete E.style
    }),
    _.testAllProps = g,
    _.prefixed = function(t, e, i) {
        return 0 === t.indexOf("@") ? S(t) : (-1 != t.indexOf("-") && (t = r(t)),
        e ? g(t, e, i) : g(t, "pfx"))
    }
    ,
    _.testAllProps = v,
    w.addTest("cssanimations", v("animationName", "a", !0)),
    s(),
    o(y),
    delete _.addTest,
    delete _.addAsyncTest;
    for (var N = 0; N < w._q.length; N++)
        w._q[N]();
    t.Modernizr = w
}(window, document)


var support = {
    animations: Modernizr.cssanimations
}
  , animEndEventNames = {
    WebkitAnimation: "webkitAnimationEnd",
    OAnimation: "oAnimationEnd",
    msAnimation: "MSAnimationEnd",
    animation: "animationend"
}
  , animEndEventName = animEndEventNames[Modernizr.prefixed("animation")]
  , onEndAnimation = function(t, e) {
    var i = function(t) {
        if (support.animations) {
            if (t.target !== this)
                return;
            this.removeEventListener(animEndEventName, i)
        }
        e && "function" == typeof e && e.call()
    };
    support.animations ? t.addEventListener(animEndEventName, i) : i()
};


$(function() {
    function t() {
        var t = W.width();
        clearTimeout(H),
        H = setTimeout(function() {
            t < X ? Y.appendTo("#mobile-sublist-wrapper") : (F.removeClass("is-open"),
            q.removeClass("hidden"),
            Y.each(function(t, e) {
                R.find(">.item").eq(t).append($(this))
            }))
        }, 250)
    }
    function o() {
        var t = tt[J];
        void 0 !== t && (U.hide(),
        setTimeout(function() {
            U.show()
        }, 1500),
        R.find(".has-more").eq(t).click())
    }
    function r() {
        if (G || L.hasClass("pc"))
            return !1;
        G = !0;
        var t = $(this)
          , e = R.find(".has-more").index(t)
          , i = Y.eq(e).find(">.item").last();
        B.html(t.find(".title").html()),
        R.find(">.item").each(function(t, i) {
            i.style.WebkitAnimationDelay = i.style.animationDelay = parseInt(60 * Math.abs(e - t)) + "ms"
        }),
        q.addClass("hidden"),
        R.addClass("animate-out-to-left"),
        Y.eq(e).find(">.item").each(function(t, e) {
            e.style.WebkitAnimationDelay = e.style.animationDelay = 120 + 60 * (t + 1) + "ms"
        }),
        onEndAnimation(i[0], function() {
            R.removeClass("current-lv animate-out-to-left"),
            Y.eq(e).removeClass("animate-in-from-right").addClass("current-lv"),
            U.removeClass("animate-in-from-right").addClass("show").css({
                WebkitAnimationDelay: "0ms",
                animationDelay: "0ms"
            }),
            G = !1
        }),
        Y.eq(e).addClass("animate-in-from-right"),
        U.css({
            left: "0"
        }),
        U.css({
            WebkitAnimationDelay: "120ms",
            animationDelay: "120ms"
        }).addClass("animate-in-from-right")
    }
    function a() {
        if (G)
            return !1;
        G = !0;
        var t = R.find(">.item").last();
        U.removeClass("show").addClass("animate-out-to-right"),
        Y.filter(".current-lv").find(">.item").each(function(t, e) {
            e.style.WebkitAnimationDelay = e.style.animationDelay = 60 * (t + 1) + "ms"
        }),
        Y.filter(".current-lv").addClass("animate-out-to-right"),
        R.find(">.item").each(function(t, e) {
            e.style.WebkitAnimationDelay = e.style.animationDelay = 120 + 60 * (t + 1) + "ms"
        }),
        onEndAnimation(t[0], function() {
            Y.removeClass("current-lv animate-out-to-right"),
            R.removeClass("animate-in-from-left").addClass("current-lv"),
            U.css({
                left: "-9999px"
            }),
            U.removeClass("animate-out-to-right"),
            G = !1
        }),
        R.addClass("animate-in-from-left"),
        q.removeClass("hidden")
    }
    function l() {
        var t = $($(this).attr("href")).offset().top;
        return $("html, body").animate({
            scrollTop: t
        }, "100"),
        !1
    }
    function c(t) {
        var e = $(this);
        return ot.toggleClass("expend"),
        ot.hasClass("sp") && (ot.toggleClass("collapse"),
        e.text(function(t, i) {
            return i === e.data("resx-more") ? e.data("resx-less") : e.data("resx-more")
        })),
        !1
    }
    function u(t) {
        var e;
        t ? (e = $(t.target),
        e.val() && e.addClass("no-hint")) : rt.each(function() {
            e = $(this),
            e.val() && e.addClass("no-hint")
        })
    }
    function h() {
        $(".js-ratio-4-3").each(function() {
            $(this).height(.75 * $(this).width())
        })
    }
    function d() {
        var t, e = [];
        $(".js-ratio-square").each(function() {
            e.push($(this).width())
        }),
        t = Math.max.apply(null, e),
        $(".js-ratio-square").height(t)
    }
    function p() {
        var t = $(this)
          , e = O.clearAll || "Cancel"
          , i = !1;
        return t.hasClass("cancel") && (e = O.selectAll || "Select All",
        i = !0),
        t.parents(".js-condition-container").find("input").prop("checked", i).click(),
        t.toggleClass("cancel").text(e),
        !1
    }
    function f(t) {
        var e = ut.eq(t);
        e.hasClass("voice") ? dt.play() : dt && dt.pause(),
        ht.attr("src", ""),
        e.find(".media-iframe").attr("src", e.data("src"))
    }
    function m() {
        $(this).toggleClass("fullscreen"),
        $("#media-pano-wrapper").toggleClass("fullscreen")
    }
    function g() {
        "" !== vt.attr("src") ? $(".pano-show-blk").addClass("show") : $(".pano-show-blk").removeClass("show")
    }
    function v() {
        vt.attr("src", $(this).data("pano-src")),
        yt.addClass("show")
    }
    function y() {
        yt.removeClass("show"),
        vt.attr("src", "")
    }
    function b() {
        $(".js-animate-input").each(function() {
            var t = $(this);
            "" !== t.val() && t.addClass("focus")
        })
    }
    function _() {
        var t = $(this);
        t.addClass("focus")
    }
    function w() {
        "" === $(this).val() && $(this).removeClass("focus")
    }
    function x() {
        var t = $('input[name="captcha"]');
        return $("#captcha-img").attr("src", "/Captcha?key=" + (new Date).getTime()),
        t.val(""),
        setTimeout(function() {
            t.focus()
        }, 500),
        !1
    }
    
    
    function T() {
        var t, e, i;
        Tt.each(function() {
            t = $(this),
            e = t.data("text"),
            i = t.height(),
            t.find(".review").height() > i && t.append('<button class="btn-read-more js-expend">... ' + e + "</button>")
        }).find(".js-expend").on("click", function() {
            $(this).hide().parent().addClass("show")
        })
    }
    function S(t) {
        var e = '<div class="video-popup-blk" id="video-popup-blk">   <button class="btn-close" id="btn-popup-close"></button>\t<div class="video-popup-frame" id="video-popup-frame"></div></div>';
        $("body").append(e),
        $(this).siblings(".video").clone().appendTo("#video-popup-frame"),
        $("#video-popup-blk").on("click", D)
    }
    function D(t) {
        $(this).remove()
    }
    function A(t) {}
    function E(t) {}
    function N() {
        var t = $(this);
        t.hasClass("play") ? (t.removeClass("play").addClass("pause"),
        t.siblings(".js-audio-player")[0].pause()) : (Nt[0].pause(),
        At.filter(".play").removeClass("play"),
        Nt = t.siblings(".js-audio-player"),
        t.removeClass("pause").addClass("play"),
        Nt[0].play())
    }
    function M() {
        $("#month-wrap").toggleClass("show")
    }
    function I() {
        var t = ((new Date).getMonth() + 1,
        53)
          , e = $("#full-year-switch-blk");
        Q && (t = 72);
        new Waypoint.Sticky({
            element: e[0],
            offset: t
        })
    }
    function P() {
        var t = $(this).index();
        It.find(".item").eq(t).addClass("hover"),
        Mt.eq(t).addClass("hover")
    }
    function z() {
        var t = $(this).index();
        It.find(".item").eq(t).removeClass("hover"),
        Mt.eq(t).removeClass("hover")
    }
    var H, O, W = $(window), L = $("html"), j = $("body"), R = $("#main-nav-title-list"), F = $("#main-nav-wrapper"),q = $("#site-func-blk"), B = $("#current-unit-name"), Y = $(".nav-sub-list"), U = $("#menu-breadcrumb"), K = $("#member-func-blk"), V = j.data("root"), X = 1200, G = !1, Q = /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile/.test(navigator.userAgent), J = (/iP(hone|ad|od)/.test(navigator.userAgent),
    R.data("unit-name")), tt = {
        news: 0,
        activity: 0,
        exhibition: 0,
        event: 0,
        eventcalendar: 0,
        statisticalbulletin: 0,
        fun: 1,
        tour: 1,
        attraction: 2,
        shop: 3,
        accommodation: 4,
        information: 5,
        media: 6,
        video: 6,
        gallery: 6,
        pano: 6,
        publish: 6,
        audioguide: 6,
        publication: 6,
        featured: 6
    };
    t(),
    W.on("resize", t),

    R.find(".has-more").on("click", r),
    $("#btn-back-all").on("click", a),
    Q && o(),
    $(".js-scroll-anchor").on("click", l)
    
    var et = $("#header-wrapper");
    
    var it, nt = $("#index-banner-slider"), st = ($("#index-event-slider"),
    {
        cellAlign: "left",
        contain: !0,
        lazyLoad: 2,
        prevNextButtons: !1
    });
    0 !== nt.length && void 0 !== nt.flickity && (Q || (st.prevNextButtons = !0),
    nt.flickity(st),
    it = nt.data("flickity"),
    nt.on("settle ", function(t) {
        !Q && it.selectedIndex > 0 && "undefined" != typeof Dt && $.isArray(Dt) && $.each(Dt, function(t, e) {
            var i = [1, 3].indexOf(e.getPlayerState()) > -1;
            i && e.pauseVideo()
        })
    }));
    var ot = $("#condition-search-blk");
    $("#btn-show-adv").on("click", c);
    var rt = $(".date-ipt");
    rt.on("blur", u),
    u();
    
    W.on("resize", h),
    h(),
    W.on("resize", d),
    d(),
    $(".js-select-all").on("click", p),
    $(".btn-search-clear").on("click", function() {
        return $(this).parents("form").find('input:not([type="hidden"])').prop("checked", !1).change().filter('[type="text"]').val(""),
        !1
    });
    var ut = $("#media-switch-blk").find(".media-item")
      , ht = $(".media-iframe")
      , dt = document.getElementById("audio-player");
    dt && dt.setAttribute("controls", "")
    var pt = $("#spot-photo-slider")
      , ft = {
        cellAlign: "center",
        contain: !0,
        prevNextButtons: !1,
        lazyLoad: 3,
        initialIndex: 0,
        pageDots: !0
    };
    0 !== pt.length && void 0 !== pt.flickity && (Q || (ft.prevNextButtons = !0,
    ft.cellAlign = "left"),
    pt.flickity(ft)),
    $("#btn-toggle-fullscreen").on("click", m);
    var mt = $(".js-show-pano")
      , gt = $("#btn-close-pano")
      , vt = $("#pano-iframe")
      , yt = $("#pano-show-wrapper")
      , bt = $("#pano-overlay");
    vt.on("load", g),
    mt.on("click", v),
    gt.on("click", y),
    bt.on("click", y),
    $(".js-animate-input").on("focus", _),
    $(".js-animate-input").on("blur", w),
    $(".js-animate-input").on("change", w),
    b(),
    $("#btn-refresh-captcha").on("click", x);
    var _t, wt = 0, xt = $("#btn-more-recommend"), Ct = !0;
    $eventPromoteList = $("#event-promote-list")
   
    var kt = $("#main-container");
    var Tt = $(".js-tripadvisor-ellipsis");
    Tt.length > 0 && T(),
    $(".js-video-popup").on("click", S);
    var St = $(".ytPlayer")
      , Dt = [];
    St.length > 0 && ($("<script/>", {
        src: "https://www.youtube.com/iframe_api"
    }).appendTo("body"),
    window.onYouTubeIframeAPIReady = function() {
        $.each(St, function(t, e) {
            var i = $(e);
            Dt.push(new YT.Player(i.attr("id"),{
                videoId: i.data("video-id"),
                events: {
                    onReady: A,
                    onStateChange: E
                }
            }))
        })
    }
    );
    var At = $(".js-audio-play")
      , Et = $(".js-audio-player")
      , Nt = Et.eq(0);
    At.on("click", N),
    $(".js-audio-player").each(function() {
        var t = $(this);
        t[0].onended = function() {
            At.removeClass("play").addClass("pause")
        }
    }),
    $("#full-year-event-blk").length > 0 && (I(),
    $("#btn-show-month").on("click", M),
    $("#month-wrap .link").on("click", M));
    var Mt = $("#region-map-link-blk .link")
      , It = $("#region-list");
    Mt.on("mouseover", P),
    Mt.on("mouseout", z),
    It.find(".item").on("mouseover", P),
    It.find(".item").on("mouseout", z)
})



