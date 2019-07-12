// Copyright 2012 Google Inc. All rights reserved.
(function () {

    var data = {
        "resource": {
            "version": "1",
            "macros": [],
            "tags": [],
            "predicates": [],
            "rules": []
        },
        "runtime": [
[], []
]



    };
    var aa, ba = this || self,
        ca = /^[\w+/_-]+[=]{0,2}$/,
        da = null;
    var fa = function () {},
        ha = function (a) {
            return "function" == typeof a
        },
        ia = function (a) {
            return "string" == typeof a
        },
        ja = function (a) {
            return "number" == typeof a && !isNaN(a)
        },
        ka = function (a) {
            return "[object Array]" == Object.prototype.toString.call(Object(a))
        },
        la = function (a, b) {
            if (Array.prototype.indexOf) {
                var c = a.indexOf(b);
                return "number" == typeof c ? c : -1
            }
            for (var d = 0; d < a.length; d++)
                if (a[d] === b) return d;
            return -1
        },
        ma = function (a, b) {
            if (a && ka(a))
                for (var c = 0; c < a.length; c++)
                    if (a[c] && b(a[c])) return a[c]
        },
        na = function (a, b) {
            if (!ja(a) ||
                !ja(b) || a > b) a = 0, b = 2147483647;
            return Math.floor(Math.random() * (b - a + 1) + a)
        },
        pa = function (a, b) {
            for (var c = new oa, d = 0; d < a.length; d++) c.set(a[d], !0);
            for (var e = 0; e < b.length; e++)
                if (c.get(b[e])) return !0;
            return !1
        },
        ra = function (a, b) {
            for (var c in a) Object.prototype.hasOwnProperty.call(a, c) && b(c, a[c])
        },
        sa = function (a) {
            return Math.round(Number(a)) || 0
        },
        ta = function (a) {
            return "false" == String(a).toLowerCase() ? !1 : !!a
        },
        ua = function (a) {
            var b = [];
            if (ka(a))
                for (var c = 0; c < a.length; c++) b.push(String(a[c]));
            return b
        },
        va = function (a) {
            return a ?
                a.replace(/^\s+|\s+$/g, "") : ""
        },
        wa = function () {
            return (new Date).getTime()
        },
        oa = function () {
            this.prefix = "gtm.";
            this.values = {}
        };
    oa.prototype.set = function (a, b) {
        this.values[this.prefix + a] = b
    };
    oa.prototype.get = function (a) {
        return this.values[this.prefix + a]
    };
    oa.prototype.contains = function (a) {
        return void 0 !== this.get(a)
    };
    var xa = function (a, b, c) {
            return a && a.hasOwnProperty(b) ? a[b] : c
        },
        ya = function (a) {
            var b = !1;
            return function () {
                if (!b) try {
                    a()
                } catch (c) {}
                b = !0
            }
        },
        za = function (a, b) {
            for (var c in b) b.hasOwnProperty(c) && (a[c] = b[c])
        },
        Aa = function (a) {
            for (var b in a)
                if (a.hasOwnProperty(b)) return !0;
            return !1
        },
        Ca = function (a, b) {
            for (var c = [], d = 0; d < a.length; d++) c.push(a[d]), c.push.apply(c, b[a[d]] || []);
            return c
        };
    /*
     jQuery v1.9.1 (c) 2005, 2012 jQuery Foundation, Inc. jquery.org/license. */
    var Da = /\[object (Boolean|Number|String|Function|Array|Date|RegExp)\]/,
        Ea = function (a) {
            if (null == a) return String(a);
            var b = Da.exec(Object.prototype.toString.call(Object(a)));
            return b ? b[1].toLowerCase() : "object"
        },
        Fa = function (a, b) {
            return Object.prototype.hasOwnProperty.call(Object(a), b)
        },
        Ga = function (a) {
            if (!a || "object" != Ea(a) || a.nodeType || a == a.window) return !1;
            try {
                if (a.constructor && !Fa(a, "constructor") && !Fa(a.constructor.prototype, "isPrototypeOf")) return !1
            } catch (c) {
                return !1
            }
            for (var b in a);
            return void 0 ===
                b || Fa(a, b)
        },
        Ha = function (a, b) {
            var c = b || ("array" == Ea(a) ? [] : {}),
                d;
            for (d in a)
                if (Fa(a, d)) {
                    var e = a[d];
                    "array" == Ea(e) ? ("array" != Ea(c[d]) && (c[d] = []), c[d] = Ha(e, c[d])) : Ga(e) ? (Ga(c[d]) || (c[d] = {}), c[d] = Ha(e, c[d])) : c[d] = e
                } return c
        };
    var f = window,
        u = document,
        Ia = navigator,
        Ka = u.currentScript && u.currentScript.src,
        La = function (a, b) {
            var c = f[a];
            f[a] = void 0 === c ? b : c;
            return f[a]
        },
        Ma = function (a, b) {
            b && (a.addEventListener ? a.onload = b : a.onreadystatechange = function () {
                a.readyState in {
                    loaded: 1,
                    complete: 1
                } && (a.onreadystatechange = null, b())
            })
        },
        Na = function (a, b, c) {
            var d = u.createElement("script");
            d.type = "text/javascript";
            d.async = !0;
            d.src = a;
            Ma(d, b);
            c && (d.onerror = c);
            var e;
            if (null === da) b: {
                var g = ba.document,
                    h = g.querySelector && g.querySelector("script[nonce]");
                if (h) {
                    var k = h.nonce || h.getAttribute("nonce");
                    if (k && ca.test(k)) {
                        da = k;
                        break b
                    }
                }
                da = ""
            }
            e = da;
            e && d.setAttribute("nonce", e);
            var l = u.getElementsByTagName("script")[0] || u.body || u.head;
            l.parentNode.insertBefore(d, l);
            return d
        },
        Oa = function () {
            if (Ka) {
                var a = Ka.toLowerCase();
                if (0 === a.indexOf("https://")) return 2;
                if (0 === a.indexOf("http://")) return 3
            }
            return 1
        },
        Pa = function (a, b) {
            var c = u.createElement("iframe");
            c.height = "0";
            c.width = "0";
            c.style.display = "none";
            c.style.visibility = "hidden";
            var d = u.body && u.body.lastChild ||
                u.body || u.head;
            d.parentNode.insertBefore(c, d);
            Ma(c, b);
            void 0 !== a && (c.src = a);
            return c
        },
        Qa = function (a, b, c) {
            var d = new Image(1, 1);
            d.onload = function () {
                d.onload = null;
                b && b()
            };
            d.onerror = function () {
                d.onerror = null;
                c && c()
            };
            d.src = a;
            return d
        },
        Ra = function (a, b, c, d) {
            a.addEventListener ? a.addEventListener(b, c, !!d) : a.attachEvent && a.attachEvent("on" + b, c)
        },
        Sa = function (a, b, c) {
            a.removeEventListener ? a.removeEventListener(b, c, !1) : a.detachEvent && a.detachEvent("on" + b, c)
        },
        A = function (a) {
            f.setTimeout(a, 0)
        },
        Ta = function (a, b) {
            return a &&
                b && a.attributes && a.attributes[b] ? a.attributes[b].value : null
        },
        Ua = function (a) {
            var b = a.innerText || a.textContent || "";
            b && " " != b && (b = b.replace(/^[\s\xa0]+|[\s\xa0]+$/g, ""));
            b && (b = b.replace(/(\xa0+|\s{2,}|\n|\r\t)/g, " "));
            return b
        },
        Va = function (a) {
            var b = u.createElement("div");
            b.innerHTML = "A<div>" + a + "</div>";
            b = b.lastChild;
            for (var c = []; b.firstChild;) c.push(b.removeChild(b.firstChild));
            return c
        },
        Wa = function (a, b, c) {
            c = c || 100;
            for (var d = {}, e = 0; e < b.length; e++) d[b[e]] = !0;
            for (var g = a, h = 0; g && h <= c; h++) {
                if (d[String(g.tagName).toLowerCase()]) return g;
                g = g.parentElement
            }
            return null
        },
        Xa = function (a, b) {
            var c = a[b];
            c && "string" === typeof c.animVal && (c = c.animVal);
            return c
        };
    var Ya = /^(?:(?:https?|mailto|ftp):|[^:/?#]*(?:[/?#]|$))/i;
    var Za = {},
        $a = function (a, b) {
            Za[a] = Za[a] || [];
            Za[a][b] = !0
        },
        bb = function (a) {
            for (var b = [], c = Za[a] || [], d = 0; d < c.length; d++) c[d] && (b[Math.floor(d / 6)] ^= 1 << d % 6);
            for (var e = 0; e < b.length; e++) b[e] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_".charAt(b[e] || 0);
            return b.join("")
        };
    var cb = /:[0-9]+$/,
        db = function (a, b, c) {
            for (var d = a.split("&"), e = 0; e < d.length; e++) {
                var g = d[e].split("=");
                if (decodeURIComponent(g[0]).replace(/\+/g, " ") === b) {
                    var h = g.slice(1).join("=");
                    return c ? h : decodeURIComponent(h).replace(/\+/g, " ")
                }
            }
        },
        gb = function (a, b, c, d, e) {
            b && (b = String(b).toLowerCase());
            if ("protocol" === b || "port" === b) a.protocol = eb(a.protocol) || eb(f.location.protocol);
            "port" === b ? a.port = String(Number(a.hostname ? a.port : f.location.port) || ("http" == a.protocol ? 80 : "https" == a.protocol ? 443 : "")) : "host" === b &&
                (a.hostname = (a.hostname || f.location.hostname).replace(cb, "").toLowerCase());
            var g = b,
                h, k = eb(a.protocol);
            g && (g = String(g).toLowerCase());
            switch (g) {
                case "url_no_fragment":
                    h = fb(a);
                    break;
                case "protocol":
                    h = k;
                    break;
                case "host":
                    h = a.hostname.replace(cb, "").toLowerCase();
                    if (c) {
                        var l = /^www\d*\./.exec(h);
                        l && l[0] && (h = h.substr(l[0].length))
                    }
                    break;
                case "port":
                    h = String(Number(a.port) || ("http" == k ? 80 : "https" == k ? 443 : ""));
                    break;
                case "path":
                    a.pathname || a.hostname || $a("TAGGING", 1);
                    h = "/" == a.pathname.substr(0, 1) ? a.pathname :
                        "/" + a.pathname;
                    var m = h.split("/");
                    0 <= la(d || [], m[m.length - 1]) && (m[m.length - 1] = "");
                    h = m.join("/");
                    break;
                case "query":
                    h = a.search.replace("?", "");
                    e && (h = db(h, e, void 0));
                    break;
                case "extension":
                    var n = a.pathname.split(".");
                    h = 1 < n.length ? n[n.length - 1] : "";
                    h = h.split("/")[0];
                    break;
                case "fragment":
                    h = a.hash.replace("#", "");
                    break;
                default:
                    h = a && a.href
            }
            return h
        },
        eb = function (a) {
            return a ? a.replace(":", "").toLowerCase() : ""
        },
        fb = function (a) {
            var b = "";
            if (a && a.href) {
                var c = a.href.indexOf("#");
                b = 0 > c ? a.href : a.href.substr(0, c)
            }
            return b
        },
        hb = function (a) {
            var b = u.createElement("a");
            a && (b.href = a);
            var c = b.pathname;
            "/" !== c[0] && (a || $a("TAGGING", 1), c = "/" + c);
            var d = b.hostname.replace(cb, "");
            return {
                href: b.href,
                protocol: b.protocol,
                host: b.host,
                hostname: d,
                pathname: c,
                search: b.search,
                hash: b.hash,
                port: b.port
            }
        };
    var ib = function (a, b, c) {
            for (var d = [], e = String(b || document.cookie).split(";"), g = 0; g < e.length; g++) {
                var h = e[g].split("="),
                    k = h[0].replace(/^\s*|\s*$/g, "");
                if (k && k == a) {
                    var l = h.slice(1).join("=").replace(/^\s*|\s*$/g, "");
                    l && c && (l = decodeURIComponent(l));
                    d.push(l)
                }
            }
            return d
        },
        lb = function (a, b, c, d) {
            var e = jb(a, d);
            if (1 === e.length) return e[0].id;
            if (0 !== e.length) {
                e = kb(e, function (g) {
                    return g.Cb
                }, b);
                if (1 === e.length) return e[0].id;
                e = kb(e, function (g) {
                    return g.Ua
                }, c);
                return e[0] ? e[0].id : void 0
            }
        };

    function mb(a, b, c) {
        var d = document.cookie;
        document.cookie = a;
        var e = document.cookie;
        return d != e || void 0 != c && 0 <= ib(b, e).indexOf(c)
    }
    var pb = function (a, b, c, d, e, g) {
        d = d || "auto";
        var h = {
            path: c || "/"
        };
        e && (h.expires = e);
        "none" !== d && (h.domain = d);
        var k;
        a: {
            var l = b,
                m;
            if (void 0 == l) m = a + "=deleted; expires=" + (new Date(0)).toUTCString();
            else {
                g && (l = encodeURIComponent(l));
                var n = l;
                n && 1200 < n.length && (n = n.substring(0, 1200));
                l = n;
                m = a + "=" + l
            }
            var p = void 0,
                t = void 0,
                q;
            for (q in h)
                if (h.hasOwnProperty(q)) {
                    var r = h[q];
                    if (null != r) switch (q) {
                        case "secure":
                            r && (m += "; secure");
                            break;
                        case "domain":
                            p = r;
                            break;
                        default:
                            "path" == q && (t = r), "expires" == q && r instanceof Date && (r =
                                r.toUTCString()), m += "; " + q + "=" + r
                    }
                } if ("auto" === p) {
                for (var w = nb(), v = 0; v < w.length; ++v) {
                    var y = "none" != w[v] ? w[v] : void 0;
                    if (!ob(y, t) && mb(m + (y ? "; domain=" + y : ""), a, l)) {
                        k = !0;
                        break a
                    }
                }
                k = !1
            } else p && "none" != p && (m += "; domain=" + p),
            k = !ob(p, t) && mb(m, a, l)
        }
        return k
    };

    function kb(a, b, c) {
        for (var d = [], e = [], g, h = 0; h < a.length; h++) {
            var k = a[h],
                l = b(k);
            l === c ? d.push(k) : void 0 === g || l < g ? (e = [k], g = l) : l === g && e.push(k)
        }
        return 0 < d.length ? d : e
    }

    function jb(a, b) {
        for (var c = [], d = ib(a), e = 0; e < d.length; e++) {
            var g = d[e].split("."),
                h = g.shift();
            if (!b || -1 !== b.indexOf(h)) {
                var k = g.shift();
                k && (k = k.split("-"), c.push({
                    id: g.join("."),
                    Cb: 1 * k[0] || 1,
                    Ua: 1 * k[1] || 1
                }))
            }
        }
        return c
    }
    var qb = /^(www\.)?google(\.com?)?(\.[a-z]{2})?$/,
        rb = /(^|\.)doubleclick\.net$/i,
        ob = function (a, b) {
            return rb.test(document.location.hostname) || "/" === b && qb.test(a)
        },
        nb = function () {
            var a = [],
                b = document.location.hostname.split(".");
            if (4 === b.length) {
                var c = b[b.length - 1];
                if (parseInt(c, 10).toString() === c) return ["none"]
            }
            for (var d = b.length - 2; 0 <= d; d--) a.push(b.slice(d).join("."));
            a.push("none");
            return a
        };
    var Pb = [],
        Qb = [],
        Rb = [],
        Sb = [],
        Tb = [],
        Ub = {},
        Vb, Wb, Xb, Yb = function (a, b) {
            var c = {};
            c["function"] = "__" + a;
            for (var d in b) b.hasOwnProperty(d) && (c["vtp_" + d] = b[d]);
            return c
        },
        Zb = function (a, b) {
            var c = a["function"];
            if (!c) throw Error("Error: No function name given for function call.");
            var d = !!Ub[c],
                e = {},
                g;
            for (g in a) a.hasOwnProperty(g) && 0 === g.indexOf("vtp_") && (e[d ? g : g.substr(4)] = a[g]);
            return d ? Ub[c](e) : (void 0)(c, e, b)
        },
        ac = function (a, b, c) {
            c = c || [];
            var d = {},
                e;
            for (e in a) a.hasOwnProperty(e) && (d[e] = $b(a[e], b, c));
            return d
        },
        bc = function (a) {
            var b = a["function"];
            if (!b) throw "Error: No function name given for function call.";
            var c = Ub[b];
            return c ? c.priorityOverride || 0 : 0
        },
        $b = function (a, b, c) {
            if (ka(a)) {
                var d;
                switch (a[0]) {
                    case "function_id":
                        return a[1];
                    case "list":
                        d = [];
                        for (var e = 1; e < a.length; e++) d.push($b(a[e], b, c));
                        return d;
                    case "macro":
                        var g = a[1];
                        if (c[g]) return;
                        var h = Pb[g];
                        if (!h || b.wc(h)) return;
                        c[g] = !0;
                        try {
                            var k = ac(h, b, c);
                            k.vtp_gtmEventId = b.id;
                            d = Zb(k, b);
                            Xb && (d = Xb.qf(d, k))
                        } catch (v) {
                            b.Pd && b.Pd(v, Number(g)), d = !1
                        }
                        c[g] = !1;
                        return d;
                    case "map":
                        d = {};
                        for (var l = 1; l < a.length; l += 2) d[$b(a[l], b, c)] = $b(a[l + 1], b, c);
                        return d;
                    case "template":
                        d = [];
                        for (var m = !1, n = 1; n < a.length; n++) {
                            var p = $b(a[n], b, c);
                            Wb && (m = m || p === Wb.rb);
                            d.push(p)
                        }
                        return Wb && m ? Wb.tf(d) : d.join("");
                    case "escape":
                        d = $b(a[1], b, c);
                        if (Wb && ka(a[1]) && "macro" === a[1][0] && Wb.Vf(a)) return Wb.eg(d);
                        d = String(d);
                        for (var t = 2; t < a.length; t++) tb[a[t]] && (d = tb[a[t]](d));
                        return d;
                    case "tag":
                        var q = a[1];
                        if (!Sb[q]) throw Error("Unable to resolve tag reference " + q + ".");
                        return d = {
                            Bd: a[2],
                            index: q
                        };
                    case "zb":
                        var r = {
                            arg0: a[2],
                            arg1: a[3],
                            ignore_case: a[5]
                        };
                        r["function"] = a[1];
                        var w = cc(r, b, c);
                        a[4] && (w = !w);
                        return w;
                    default:
                        throw Error("Attempting to expand unknown Value type: " + a[0] + ".");
                }
            }
            return a
        },
        cc = function (a, b, c) {
            try {
                return Vb(ac(a, b, c))
            } catch (d) {
                JSON.stringify(a)
            }
            return null
        };
    var dc = function () {
        var a = function (b) {
            return {
                toString: function () {
                    return b
                }
            }
        };
        return {
            Zc: a("convert_case_to"),
            $c: a("convert_false_to"),
            ad: a("convert_null_to"),
            bd: a("convert_true_to"),
            cd: a("convert_undefined_to"),
            ra: a("function"),
            Fe: a("instance_name"),
            Ge: a("live_only"),
            He: a("malware_disabled"),
            Ie: a("metadata"),
            Og: a("original_vendor_template_id"),
            Je: a("once_per_event"),
            rd: a("once_per_load"),
            sd: a("setup_tags"),
            td: a("tag_id"),
            ud: a("teardown_tags")
        }
    }();
    var ec = null,
        hc = function (a) {
            function b(p) {
                for (var t = 0; t < p.length; t++) d[p[t]] = !0
            }
            var c = [],
                d = [];
            ec = fc(a);
            for (var e = 0; e < Qb.length; e++) {
                var g = Qb[e],
                    h = gc(g);
                if (h) {
                    for (var k = g.add || [], l = 0; l < k.length; l++) c[k[l]] = !0;
                    b(g.block || [])
                } else null === h && b(g.block || [])
            }
            for (var m = [], n = 0; n < Sb.length; n++) c[n] && !d[n] && (m[n] = !0);
            return m
        },
        gc = function (a) {
            for (var b = a["if"] || [], c = 0; c < b.length; c++) {
                var d = ec(b[c]);
                if (!d) return null === d ? null : !1
            }
            for (var e = a.unless || [], g = 0; g < e.length; g++) {
                var h = ec(e[g]);
                if (null === h) return null;
                if (h) return !1
            }
            return !0
        },
        fc = function (a) {
            var b = [];
            return function (c) {
                void 0 === b[c] && (b[c] = cc(Rb[c], a));
                return b[c]
            }
        };
    /*
     Copyright (c) 2014 Derek Brans, MIT license https://github.com/krux/postscribe/blob/master/LICENSE. Portions derived from simplehtmlparser, which is licensed under the Apache License, Version 2.0 */
    var yc = {},
        zc = null,
        Ac = Math.random();
    yc.i = "UA-135612501-1";
    yc.vb = "651";
    var Bc = "www.googletagmanager.com/gtm.js";
    Bc = "www.googletagmanager.com/gtag/js";
    var Cc = Bc,
        Dc = null,
        Ec = null,
        Fc = null,
        Gc = "//www.googletagmanager.com/a?id=" + yc.i + "&cv=1",
        Hc = {},
        Ic = {},
        Jc = function () {
            var a = zc.sequence || 0;
            zc.sequence = a + 1;
            return a
        };
    var D = function (a, b, c, d) {
            return (2 === Kc() || d || "http:" != f.location.protocol ? a : b) + c
        },
        Kc = function () {
            var a = Oa(),
                b;
            if (1 === a) a: {
                var c = Cc;c = c.toLowerCase();
                for (var d = "https://" + c, e = "http://" + c, g = 1, h = u.getElementsByTagName("script"), k = 0; k < h.length && 100 > k; k++) {
                    var l = h[k].src;
                    if (l) {
                        l = l.toLowerCase();
                        if (0 === l.indexOf(e)) {
                            b = 3;
                            break a
                        }
                        1 === g && 0 === l.indexOf(d) && (g = 2)
                    }
                }
                b = g
            }
            else b = a;
            return b
        };
    var Lc = !1;
    var Mc = function (a, b, c, d) {
        if (c) {
            d = d || {};
            var e = f._googWcmImpl || function () {
                e.q = e.q || [];
                e.q.push(arguments)
            };
            f._googWcmImpl = e;
            void 0 === f._googWcmAk && (f._googWcmAk = a);
            Lc ? d.za && A(d.za) : (Na(D("https://", "http://", "www.gstatic.com/wcm/loader.js"), d.za, d.Sd), Lc = !0);
            var g = {
                ak: a,
                cl: b
            };
            void 0 === d.ee && (g.autoreplace = c);
            e(2, d.ee, g, c, 0, new Date, d.Jg)
        }
    };
    var Pc = function () {
            return "&tc=" + Sb.filter(function (a) {
                return a
            }).length
        },
        Yc = function () {
            Qc && (f.clearTimeout(Qc), Qc = void 0);
            void 0 === Rc || Sc[Rc] && !Tc || (Uc[Rc] || Vc.Xf() || 0 >= Wc-- ? ($a("GTM", 1), Uc[Rc] = !0) : (Vc.pg(), Qa(Xc()), Sc[Rc] = !0, Tc = ""))
        },
        Xc = function () {
            var a = Rc;
            if (void 0 === a) return "";
            var b = bb("GTM"),
                c = bb("TAGGING");
            return [Zc, Sc[a] ? "" : "&es=1", $c[a], b ? "&u=" + b : "", c ? "&ut=" + c : "", Pc(), Tc, "&z=0"].join("")
        },
        ad = function () {
            return [Gc, "&v=3&t=t", "&pid=" + na(), "&rv=" + yc.vb].join("")
        },
        bd = "0.005000" >
        Math.random(),
        Zc = ad(),
        cd = function () {
            Zc = ad()
        },
        Sc = {},
        Tc = "",
        Rc = void 0,
        $c = {},
        Uc = {},
        Qc = void 0,
        Vc = function (a, b) {
            var c = 0,
                d = 0;
            return {
                Xf: function () {
                    if (c < a) return !1;
                    wa() - d >= b && (c = 0);
                    return c >= a
                },
                pg: function () {
                    wa() - d >= b && (c = 0);
                    c++;
                    d = wa()
                }
            }
        }(2, 1E3),
        Wc = 1E3,
        dd = function (a, b) {
            if (bd && !Uc[a] && Rc !== a) {
                Yc();
                Rc = a;
                Tc = "";
                var c;
                c = 0 === b.indexOf("gtm.") ? encodeURIComponent(b) : "*";
                $c[a] = "&e=" + c + "&eid=" + a;
                Qc || (Qc = f.setTimeout(Yc, 500))
            }
        },
        ed = function (a, b, c) {
            if (bd && !Uc[a] && b) {
                a !== Rc && (Yc(), Rc = a);
                var d = String(b[dc.ra] || "").replace(/_/g,
                    "");
                0 === d.indexOf("cvt") && (d = "cvt");
                var e = c + d;
                Tc = Tc ? Tc + "." + e : "&tr=" + e;
                Qc || (Qc = f.setTimeout(Yc, 500));
                2022 <= Xc().length && Yc()
            }
        };
    var fd = {},
        gd = new oa,
        hd = {},
        id = {},
        md = {
            name: "dataLayer",
            set: function (a, b) {
                Ha(jd(a, b), hd);
                kd()
            },
            get: function (a) {
                return ld(a, 2)
            },
            reset: function () {
                gd = new oa;
                hd = {};
                kd()
            }
        },
        ld = function (a, b) {
            if (2 != b) {
                var c = gd.get(a);
                if (bd) {
                    var d = nd(a);
                    c !== d && $a("GTM", 5)
                }
                return c
            }
            return nd(a)
        },
        nd = function (a, b, c) {
            var d = a.split("."),
                e = !1,
                g = void 0;
            var h = function (k, l) {
                for (var m = 0; void 0 !== k && m < d.length; m++) {
                    if (null === k) return !1;
                    k = k[d[m]]
                }
                return void 0 !== k || 1 < m ? k : l.length ? h(od(l.pop()), l) : pd(d)
            };
            e = !0;
            g = h(hd.eventModel, [b, c]);
            return e ? g : pd(d)
        },
        pd = function (a) {
            for (var b = hd, c = 0; c < a.length; c++) {
                if (null === b) return !1;
                if (void 0 === b) break;
                b = b[a[c]]
            }
            return b
        };
    var qd = function (a, b) {
            return nd(a, b, void 0)
        },
        od = function (a) {
            if (a) {
                var b = pd(["gtag", "targets", a]);
                return Ga(b) ? b : void 0
            }
        },
        rd = function (a, b) {
            function c(g) {
                g && ra(g, function (h) {
                    d[h] = null
                })
            }
            var d = {};
            c(hd);
            delete d.eventModel;
            c(od(a));
            c(od(b));
            c(hd.eventModel);
            var e = [];
            ra(d, function (g) {
                e.push(g)
            });
            return e
        };
    var sd = function (a, b) {
            id.hasOwnProperty(a) || (gd.set(a, b), Ha(jd(a, b), hd), kd())
        },
        jd = function (a, b) {
            for (var c = {}, d = c, e = a.split("."), g = 0; g < e.length - 1; g++) d = d[e[g]] = {};
            d[e[e.length - 1]] = b;
            return c
        },
        kd = function (a) {
            ra(id, function (b, c) {
                gd.set(b, c);
                Ha(jd(b, void 0), hd);
                Ha(jd(b, c), hd);
                a && delete id[b]
            })
        },
        td = function (a, b, c) {
            fd[a] = fd[a] || {};
            var d = 1 !== c ? nd(b) : gd.get(b);
            "array" === Ea(d) || "object" === Ea(d) ? fd[a][b] = Ha(d) : fd[a][b] = d
        },
        ud = function (a, b) {
            if (fd[a]) return fd[a][b]
        };
    var vd = new RegExp(/^(.*\.)?(google|youtube|blogger|withgoogle)(\.com?)?(\.[a-z]{2})?\.?$/),
        wd = {
            cl: ["ecl"],
            customPixels: ["nonGooglePixels"],
            ecl: ["cl"],
            ehl: ["hl"],
            hl: ["ehl"],
            html: ["customScripts", "customPixels", "nonGooglePixels", "nonGoogleScripts", "nonGoogleIframes"],
            customScripts: ["html", "customPixels", "nonGooglePixels", "nonGoogleScripts", "nonGoogleIframes"],
            nonGooglePixels: [],
            nonGoogleScripts: ["nonGooglePixels"],
            nonGoogleIframes: ["nonGooglePixels"]
        },
        xd = {
            cl: ["ecl"],
            customPixels: ["customScripts", "html"],
            ecl: ["cl"],
            ehl: ["hl"],
            hl: ["ehl"],
            html: ["customScripts"],
            customScripts: ["html"],
            nonGooglePixels: ["customPixels", "customScripts", "html", "nonGoogleScripts", "nonGoogleIframes"],
            nonGoogleScripts: ["customScripts", "html"],
            nonGoogleIframes: ["customScripts", "html", "nonGoogleScripts"]
        },
        yd = "google customPixels customScripts html nonGooglePixels nonGoogleScripts nonGoogleIframes".split(" ");
    var Ad = function (a) {
            var b = ld("gtm.whitelist");
            b && $a("GTM", 9);
            b = "google gtagfl lcl zone oid op".split(" ");
            var c = b && Ca(ua(b), wd),
                d = ld("gtm.blacklist");
            d || (d = ld("tagTypeBlacklist")) && $a("GTM", 3);
            d ? $a("GTM", 8) : d = [];
            zd() && (d = ua(d), d.push("nonGooglePixels", "nonGoogleScripts"));
            0 <= la(ua(d), "google") && $a("GTM", 2);
            var e = d && Ca(ua(d), xd),
                g = {};
            return function (h) {
                var k = h && h[dc.ra];
                if (!k || "string" != typeof k) return !0;
                k = k.replace(/^_*/, "");
                if (void 0 !== g[k]) return g[k];
                var l = Ic[k] || [],
                    m = a(k);
                if (b) {
                    var n;
                    if (n = m) a: {
                        if (0 > la(c, k))
                            if (l && 0 < l.length)
                                for (var p = 0; p < l.length; p++) {
                                    if (0 >
                                        la(c, l[p])) {
                                        $a("GTM", 11);
                                        n = !1;
                                        break a
                                    }
                                } else {
                                    n = !1;
                                    break a
                                }
                        n = !0
                    }
                    m = n
                }
                var t = !1;
                if (d) {
                    var q = 0 <= la(e, k);
                    if (q) t = q;
                    else {
                        var r = pa(e, l || []);
                        r && $a("GTM", 10);
                        t = r
                    }
                }
                var w = !m || t;
                w || !(0 <= la(l, "sandboxedScripts")) || c && -1 !== la(c, "sandboxedScripts") || (w = pa(e, yd));
                return g[k] = w
            }
        },
        zd = function () {
            return vd.test(f.location && f.location.hostname)
        };
    var Bd = {
        qf: function (a, b) {
            b[dc.Zc] && "string" === typeof a && (a = 1 == b[dc.Zc] ? a.toLowerCase() : a.toUpperCase());
            b.hasOwnProperty(dc.ad) && null === a && (a = b[dc.ad]);
            b.hasOwnProperty(dc.cd) && void 0 === a && (a = b[dc.cd]);
            b.hasOwnProperty(dc.bd) && !0 === a && (a = b[dc.bd]);
            b.hasOwnProperty(dc.$c) && !1 === a && (a = b[dc.$c]);
            return a
        }
    };
    var Cd = {
            active: !0,
            isWhitelisted: function () {
                return !0
            }
        },
        Dd = function (a) {
            var b = zc.zones;
            !b && a && (b = zc.zones = a());
            return b
        };
    var Ed = !1,
        Fd = 0,
        Gd = [];

    function Hd(a) {
        if (!Ed) {
            var b = u.createEventObject,
                c = "complete" == u.readyState,
                d = "interactive" == u.readyState;
            if (!a || "readystatechange" != a.type || c || !b && d) {
                Ed = !0;
                for (var e = 0; e < Gd.length; e++) A(Gd[e])
            }
            Gd.push = function () {
                for (var g = 0; g < arguments.length; g++) A(arguments[g]);
                return 0
            }
        }
    }

    function Id() {
        if (!Ed && 140 > Fd) {
            Fd++;
            try {
                u.documentElement.doScroll("left"), Hd()
            } catch (a) {
                f.setTimeout(Id, 50)
            }
        }
    }
    var Jd = function (a) {
        Ed ? a() : Gd.push(a)
    };
    var Kd = {},
        Ld = {},
        Md = function (a, b, c) {
            if (!Ld[a]) return -1;
            var d = {};
            Ga(c) && (d = Ha(c, d));
            d.id = b;
            d.status = "timeout";
            return Ld[a].tags.push(d) - 1
        },
        Nd = function (a, b, c, d) {
            if (Ld[a]) {
                var e = Ld[a].tags[b];
                e && (e.status = c, e.executionTime = d)
            }
        };

    function Od(a) {
        for (var b = Kd[a] || [], c = 0; c < b.length; c++) b[c]();
        Kd[a] = {
            push: function (d) {
                var e = !1;
                d(yc.i, Ld[a]), e = !0;
                !e && d(yc.i)
            }
        }
    }
    var Rd = function (a, b, c) {
            Ld[a] = {
                tags: []
            };
            ha(b) && Pd(a, b);
            c && f.setTimeout(function () {
                return Od(a)
            }, Number(c));
            return Qd(a)
        },
        Pd = function (a, b) {
            Kd[a] = Kd[a] || [];
            Kd[a].push(ya(function () {
                return A(function () {
                    var c = !1;
                    b(yc.i, Ld[a]), c = !0;
                    !c && b(yc.i)
                })
            }))
        };

    function Qd(a) {
        var b = 0,
            c = 0,
            d = !1;
        return {
            add: function () {
                c++;
                return ya(function () {
                    b++;
                    d && b >= c && Od(a)
                })
            },
            Xe: function () {
                d = !0;
                b >= c && Od(a)
            }
        }
    };
    var Sd = function () {
        function a(d) {
            return !ja(d) || 0 > d ? 0 : d
        }
        if (!zc._li && f.performance && f.performance.timing) {
            var b = f.performance.timing.navigationStart,
                c = ja(md.get("gtm.start")) ? md.get("gtm.start") : 0;
            zc._li = {
                cst: a(c - b),
                cbt: a(Ec - b)
            }
        }
    };
    var Wd = !1,
        Xd = function () {
            return f.GoogleAnalyticsObject && f[f.GoogleAnalyticsObject]
        },
        Yd = !1;
    var Zd = function (a) {
            f.GoogleAnalyticsObject || (f.GoogleAnalyticsObject = a || "ga");
            var b = f.GoogleAnalyticsObject;
            if (f[b]) f.hasOwnProperty(b) || $a("GTM", 12);
            else {
                var c = function () {
                    c.q = c.q || [];
                    c.q.push(arguments)
                };
                c.l = Number(new Date);
                f[b] = c
            }
            Sd();
            return f[b]
        },
        $d = function (a, b, c, d) {
            b = String(b).replace(/\s+/g, "").split(",");
            var e = Xd();
            e(a + "require", "linker");
            e(a + "linker:autoLink", b, c, d)
        };
    var be = function () {},
        ae = function () {
            return f.GoogleAnalyticsObject || "ga"
        },
        ce = !1;
    var de = function (a, b, c) {
        if (b) {
            c = c || {};
            var d = f._gaPhoneImpl || function () {
                d.q = d.q || [];
                d.q.push(arguments)
            };
            f._gaPhoneImpl = d;
            void 0 === f.ga_wpid && (f.ga_wpid = a);
            ce ? c.za && A(c.za) : (Na(D("https://", "http://", "www.gstatic.com/gaphone/loader.js"), c.za, c.Sd), ce = !0);
            var e = {};
            void 0 !== c.Ed ? e.receiver = c.Ed : e.replace = b;
            e.ga_wpid = a;
            e.destination = b;
            d(2, new Date, e)
        }
    };
    var je = function (a) {};

    function ie(a, b) {
        a.containerId = yc.i;
        var c = {
            type: "GENERIC",
            value: a
        };
        b.length && (c.trace = b);
        return c
    };

    function ke(a, b, c, d) {
        var e = Sb[a],
            g = le(a, b, c, d);
        if (!g) return null;
        var h = $b(e[dc.sd], c, []);
        if (h && h.length) {
            var k = h[0];
            g = ke(k.index, {
                K: g,
                P: 1 === k.Bd ? b.terminate : g,
                terminate: b.terminate
            }, c, d)
        }
        return g
    }

    function le(a, b, c, d) {
        function e() {
            if (g[dc.He]) k();
            else {
                var v = ac(g, c, []),
                    y = Md(c.id, Number(g[dc.td]), v[dc.Ie]),
                    x = !1;
                v.vtp_gtmOnSuccess = function () {
                    if (!x) {
                        x = !0;
                        var C = wa() - B;
                        ed(c.id, Sb[a], "5");
                        Nd(c.id, y, "success", C);
                        h()
                    }
                };
                v.vtp_gtmOnFailure = function () {
                    if (!x) {
                        x = !0;
                        var C = wa() - B;
                        ed(c.id, Sb[a], "6");
                        Nd(c.id, y, "failure", C);
                        k()
                    }
                };
                v.vtp_gtmTagId = g.tag_id;
                v.vtp_gtmEventId =
                    c.id;
                ed(c.id, g, "1");
                var z = function (C) {
                    var E = wa() - B;
                    je(C);
                    ed(c.id, g, "7");
                    Nd(c.id, y, "exception", E);
                    x || (x = !0, k())
                };
                var B = wa();
                try {
                    Zb(v, c)
                } catch (C) {
                    z(C)
                }
            }
        }
        var g = Sb[a],
            h = b.K,
            k = b.P,
            l = b.terminate;
        if (c.wc(g)) return null;
        var m = $b(g[dc.ud], c, []);
        if (m && m.length) {
            var n = m[0],
                p = ke(n.index, {
                    K: h,
                    P: k,
                    terminate: l
                }, c, d);
            if (!p) return null;
            h = p;
            k = 2 === n.Bd ? l : p
        }
        if (g[dc.rd] || g[dc.Je]) {
            var t = g[dc.rd] ? Tb : c.Ag,
                q = h,
                r = k;
            if (!t[a]) {
                e = ya(e);
                var w = me(a, t, e);
                h = w.K;
                k = w.P
            }
            return function () {
                t[a](q, r)
            }
        }
        return e
    }

    function me(a, b, c) {
        var d = [],
            e = [];
        b[a] = ne(d, e, c);
        return {
            K: function () {
                b[a] = oe;
                for (var g = 0; g < d.length; g++) d[g]()
            },
            P: function () {
                b[a] = pe;
                for (var g = 0; g < e.length; g++) e[g]()
            }
        }
    }

    function ne(a, b, c) {
        return function (d, e) {
            a.push(d);
            b.push(e);
            c()
        }
    }

    function oe(a) {
        a()
    }

    function pe(a, b) {
        b()
    };
    var se = function (a, b) {
        for (var c = [], d = 0; d < Sb.length; d++)
            if (a.Ta[d]) {
                var e = Sb[d];
                var g = b.add();
                try {
                    var h = ke(d, {
                        K: g,
                        P: g,
                        terminate: g
                    }, a, d);
                    h ? c.push({
                        ce: d,
                        b: bc(e),
                        Bf: h
                    }) : (qe(d, a), g())
                } catch (l) {
                    g()
                }
            } b.Xe();
        c.sort(re);
        for (var k = 0; k < c.length; k++) c[k].Bf();
        return 0 < c.length
    };

    function re(a, b) {
        var c, d = b.b,
            e = a.b;
        c = d > e ? 1 : d < e ? -1 : 0;
        var g;
        if (0 !== c) g = c;
        else {
            var h = a.ce,
                k = b.ce;
            g = h > k ? 1 : h < k ? -1 : 0
        }
        return g
    }

    function qe(a, b) {
        if (!bd) return;
        var c = function (d) {
            var e = b.wc(Sb[d]) ? "3" : "4",
                g = $b(Sb[d][dc.sd], b, []);
            g && g.length && c(g[0].index);
            ed(b.id, Sb[d], e);
            var h = $b(Sb[d][dc.ud], b, []);
            h && h.length && c(h[0].index)
        };
        c(a);
    }
    var te = !1,
        ue = function (a, b, c, d, e) {
            if ("gtm.js" == b) {
                if (te) return !1;
                te = !0
            }
            dd(a, b);
            var g = Rd(a, d, e);
            td(a, "event", 1);
            td(a, "ecommerce", 1);
            td(a, "gtm");
            var h = {
                id: a,
                name: b,
                wc: Ad(c),
                Ta: [],
                Ag: [],
                Pd: function (p) {
                    $a("GTM", 6);
                    je(p)
                }
            };
            h.Ta = hc(h);
            var k = se(h, g);
            "gtm.js" !== b && "gtm.sync" !== b || be();
            if (!k) return k;
            for (var l = {
                    __cl: !0,
                    __ecl: !0,
                    __ehl: !0,
                    __evl: !0,
                    __fsl: !0,
                    __hl: !0,
                    __jel: !0,
                    __lcl: !0,
                    __sdl: !0,
                    __tl: !0,
                    __ytl: !0
                }, m = 0; m < h.Ta.length; m++)
                if (h.Ta[m]) {
                    var n = Sb[m];
                    if (n && !l[n[dc.ra]]) return !0
                } return !1
        };
    var ve = function (a, b) {
        var c = Yb(a, b);
        Sb.push(c);
        return Sb.length - 1
    };
    var G = {
        Sb: "event_callback",
        Ub: "event_timeout"
    };
    G.ba = "gtag.config", G.Pb = "page_view", G.fe = "user_engagement", G.T = "allow_ad_personalization_signals", G.he = "allow_custom_scripts", G.ie = "allow_display_features", G.je = "allow_enhanced_conversions", G.eb = "client_id", G.O = "cookie_domain", G.V = "cookie_expires", G.fb = "cookie_name", G.na = "cookie_path", G.me = "cookie_update", G.oa = "currency", G.gb = "custom_params", G.oe = "custom_map", G.Wb = "groups", G.Ia = "language", G.ne = "country", G.Ng = "non_interaction", G.mb = "page_location", G.nb = "page_referrer", G.nd = "page_title", G.Ka = "send_page_view",
        G.qa = "send_to", G.ob = "session_duration", G.ac = "session_engaged", G.pb = "session_id", G.bc = "session_number", G.De = "tracking_id", G.qb = "user_properties", G.Ja = "linker", G.jb = "accept_incoming", G.I = "domains", G.lb = "url_position", G.kb = "decorate_forms", G.$b = "phone_conversion_number", G.Yb = "phone_conversion_callback", G.Zb = "phone_conversion_css_class", G.od = "phone_conversion_options", G.dd = "aw_remarketing", G.ed = "aw_remarketing_only", G.da = "value", G.Be = "quantity", G.se = "affiliation", G.we = "tax", G.ve = "shipping", G.Rb = "list_name",
        G.md = "checkout_step", G.ld = "checkout_option", G.te = "coupon", G.ue = "promotions", G.La = "transaction_id", G.ca = "user_id", G.Ha = "conversion_linker", G.Ga = "conversion_cookie_prefix", G.H = "cookie_prefix", G.U = "items", G.Qb = "aw_merchant_id", G.gd = "aw_feed_country", G.hd = "aw_feed_language", G.fd = "discount", G.kd = "disable_merchant_reported_purchases", G.Xb = "new_customer", G.jd = "customer_lifetime_value", G.qe = "dc_natural_search", G.pe = "dc_custom_params", G.Ee = "trip_type", G.Ae = "passengers", G.ye = "method", G.Ce = "search_term", G.ke =
        "content_type", G.ze = "optimize_id", G.xe = "experiments", G.ib = "google_signals", G.Vb = "google_tld", G.hb = "ga_restrict_domain", G.Tb = "event_settings", G.pd = [G.T, G.O, G.V, G.fb, G.na, G.H, G.gb, G.Sb, G.Tb, G.Ub, G.hb, G.ib, G.Vb, G.Wb, G.qa, G.Ka, G.ob, G.ca, G.qb], G.Yc = [G.qa, G.dd, G.ed, G.gb, G.Ka, G.Ia, G.da, G.oa, G.La, G.ca, G.Ha, G.Ga, G.H, G.mb, G.nb, G.$b, G.Yb, G.Zb, G.od, G.U, G.Qb, G.gd, G.hd, G.fd, G.kd, G.Xb, G.jd, G.T];
    var we = {};
    var xe = /[A-Z]+/,
        ye = /\s/,
        ze = function (a) {
            if (ia(a) && (a = va(a), !ye.test(a))) {
                var b = a.indexOf("-");
                if (!(0 > b)) {
                    var c = a.substring(0, b);
                    if (xe.test(c)) {
                        for (var d = a.substring(b + 1).split("/"), e = 0; e < d.length; e++)
                            if (!d[e]) return;
                        return {
                            id: a,
                            prefix: c,
                            containerId: c + "-" + d[0],
                            fa: d
                        }
                    }
                }
            }
        },
        Be = function (a) {
            for (var b = {}, c = 0; c < a.length; ++c) {
                var d = ze(a[c]);
                d && (b[d.id] = d)
            }
            Ae(b);
            var e = [];
            ra(b, function (g, h) {
                e.push(h)
            });
            return e
        };

    function Ae(a) {
        var b = [],
            c;
        for (c in a)
            if (a.hasOwnProperty(c)) {
                var d = a[c];
                "AW" === d.prefix && d.fa[1] && b.push(d.containerId)
            } for (var e = 0; e < b.length; ++e) delete a[b[e]]
    };
    var Ce = null,
        De = {},
        Ee = {},
        Ge, He = function (a, b) {
            var c = {
                event: a
            };
            b && (c.eventModel = Ha(b), b[G.Sb] && (c.eventCallback = b[G.Sb]), b[G.Ub] && (c.eventTimeout = b[G.Ub]));
            return c
        };
    var Ie = function () {
            Ce = Ce || !zc.gtagRegistered;
            zc.gtagRegistered = !0;
            return Ce
        },
        Je = function (a) {
            if (void 0 === Ee[a.id]) {
                var b;
                switch (a.prefix) {
                    case "UA":
                        b = ve("gtagua", {
                            trackingId: a.id
                        });
                        break;
                    case "AW":
                        b = ve("gtagaw", {
                            conversionId: a
                        });
                        break;
                    case "DC":
                        b = ve("gtagfl", {
                            targetId: a.id
                        });
                        break;
                    case "GF":
                        b = ve("gtaggf", {
                            conversionId: a
                        });
                        break;
                    case "G":
                        b = ve("get", {
                            trackingId: a.id,
                            isAutoTag: !0
                        });
                        break;
                    case "HA":
                        b = ve("gtagha", {
                            conversionId: a
                        });
                        break;
                    default:
                        return
                }
                if (!Ge) {
                    var c = Yb("v", {
                        name: "send_to",
                        dataLayerVersion: 2
                    });
                    Pb.push(c);
                    Ge = ["macro", Pb.length - 1]
                }
                var d = {
                    arg0: Ge,
                    arg1: a.id,
                    ignore_case: !1
                };
                d[dc.ra] = "_lc";
                Rb.push(d);
                var e = {
                    "if": [Rb.length - 1],
                    add: [b]
                };
                e["if"] && (e.add || e.block) && Qb.push(e);
                Ee[a.id] = b
            }
        },
        Ke = function (a) {
            ra(De, function (b, c) {
                var d = la(c, a);
                0 <= d && c.splice(d, 1)
            })
        },
        Le = ya(function () {});
    var Me = {
            config: function (a) {
                var b = a[2] || {};
                if (2 > a.length || !ia(a[1]) || !Ga(b)) return;
                var c = ze(a[1]);
                if (!c) return;
                Ie() ? Je(c) : Le();
                Ke(c.id);
                var d = c.id,
                    e = b[G.Wb] || "default";
                e = e.toString().split(",");
                for (var g = 0; g < e.length; g++) De[e[g]] = De[e[g]] || [], De[e[g]].push(d);
                delete b[G.Wb];
                sd("gtag.targets." + c.id, void 0);
                sd("gtag.targets." + c.id, Ha(b));
                var h = {};
                h[G.qa] = c.id;
                return He(G.ba, h);
            },
            event: function (a) {
                var b = a[1];
                if (ia(b) && !(3 < a.length)) {
                    var c;
                    if (2 <
                        a.length) {
                        if (!Ga(a[2])) return;
                        c = a[2]
                    }
                    var d = He(b, c);
                    var e;
                    var g = c,
                        h = ld("gtag.fields.send_to", 2);
                    ia(h) || (h = G.qa);
                    var k = g && g[h];
                    void 0 === k && (k = ld(h, 2), void 0 === k && (k = "default"));
                    if (ia(k) || ka(k)) {
                        for (var l = k.toString().replace(/\s+/g, "").split(","), m = [], n = 0; n < l.length; n++) 0 <= l[n].indexOf("-") ? m.push(l[n]) : m = m.concat(De[l[n]] || []);
                        e = Be(m)
                    } else e = void 0;
                    var p = e;
                    if (!p) return;
                    var t = Ie();
                    t || Le();
                    for (var q = [], r = 0; t && r < p.length; r++) {
                        var w = p[r];
                        q.push(w.id);
                        Je(w)
                    }
                    d.eventModel = d.eventModel || {};
                    0 < p.length ? d.eventModel[G.qa] = q.join() : delete d.eventModel[G.qa];
                    return d
                }
            },
            js: function (a) {
                if (2 == a.length && a[1].getTime) return {
                    event: "gtm.js",
                    "gtm.start": a[1].getTime()
                }
            },
            policy: function (a) {
                if (3 === a.length) {
                    var b = a[1],
                        c = a[2];
                    we[b] || (we[b] = []);
                    we[b].push(c)
                }
            },
            set: function (a) {
                var b;
                2 == a.length && Ga(a[1]) ? b = Ha(a[1]) : 3 == a.length && ia(a[1]) && (b = {}, b[a[1]] = a[2]);
                if (b) return b.eventModel = Ha(b), b.event = "gtag.set", b._clear = !0, b
            }
        },
        Ne = {
            policy: !0
        };
    var Oe = function () {
        var a = !1;
        return a
    };
    var Qe = function (a) {
            return Pe ? u.querySelectorAll(a) : null
        },
        Re = function (a, b) {
            if (!Pe) return null;
            if (Element.prototype.closest) try {
                return a.closest(b)
            } catch (e) {
                return null
            }
            var c = Element.prototype.matches || Element.prototype.webkitMatchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector || Element.prototype.oMatchesSelector,
                d = a;
            if (!u.documentElement.contains(d)) return null;
            do {
                try {
                    if (c.call(d, b)) return d
                } catch (e) {
                    break
                }
                d = d.parentElement || d.parentNode
            } while (null !== d && 1 === d.nodeType);
            return null
        },
        Se = !1;
    if (u.querySelectorAll) try {
        var Te = u.querySelectorAll(":root");
        Te && 1 == Te.length && Te[0] == u.documentElement && (Se = !0)
    } catch (a) {}
    var Pe = Se;
    var $e = function (a) {
        if (Ze(a)) return a;
        this.Hg = a
    };
    $e.prototype.If = function () {
        return this.Hg
    };
    var Ze = function (a) {
        return !a || "object" !== Ea(a) || Ga(a) ? !1 : "getUntrustedUpdateValue" in a
    };
    $e.prototype.getUntrustedUpdateValue = $e.prototype.If;
    var af = !1,
        bf = [];

    function cf() {
        if (!af) {
            af = !0;
            for (var a = 0; a < bf.length; a++) A(bf[a])
        }
    }
    var df = function (a) {
        af ? A(a) : bf.push(a)
    };
    var ef = [],
        ff = !1,
        gf = function (a) {
            return f["dataLayer"].push(a)
        },
        hf = function (a) {
            var b = zc["dataLayer"],
                c = b ? b.subscribers : 1,
                d = 0;
            return function () {
                ++d === c && a()
            }
        },
        kf = function (a) {
            var b = a._clear;
            ra(a, function (g, h) {
                "_clear" !== g && (b && sd(g, void 0), sd(g, h))
            });
            Dc || (Dc = a["gtm.start"]);
            var c = a.event;
            if (!c) return !1;
            var d = a["gtm.uniqueEventId"];
            d || (d = Jc(), a["gtm.uniqueEventId"] = d, sd("gtm.uniqueEventId", d));
            Fc = c;
            var e = jf(a);
            Fc = null;
            return e
        };

    function jf(a) {
        var b = a.event,
            c = a["gtm.uniqueEventId"],
            d, e = zc.zones;
        d = e ? e.checkState(yc.i, c) : Cd;
        return d.active ? ue(c, b, d.isWhitelisted, a.eventCallback, a.eventTimeout) ? !0 : !1 : !1
    }
    var lf = function () {
            for (var a = !1; !ff && 0 < ef.length;) {
                ff = !0;
                delete hd.eventModel;
                kd();
                var b = ef.shift();
                if (null != b) {
                    var c = Ze(b);
                    if (c) {
                        var d = b;
                        b = Ze(d) ? d.getUntrustedUpdateValue() : void 0;
                        for (var e = ["gtm.whitelist", "gtm.blacklist", "tagTypeBlacklist"], g = 0; g < e.length; g++) {
                            var h = e[g],
                                k = ld(h, 1);
                            if (ka(k) || Ga(k)) k = Ha(k);
                            id[h] = k
                        }
                    }
                    try {
                        if (ha(b)) try {
                            b.call(md)
                        } catch (w) {} else if (ka(b)) {
                            var l = b;
                            if (ia(l[0])) {
                                var m =
                                    l[0].split("."),
                                    n = m.pop(),
                                    p = l.slice(1),
                                    t = ld(m.join("."), 2);
                                if (void 0 !== t && null !== t) try {
                                    t[n].apply(t, p)
                                } catch (w) {}
                            }
                        } else {
                            var q = b;
                            if (q && ("[object Arguments]" == Object.prototype.toString.call(q) || Object.prototype.hasOwnProperty.call(q, "callee"))) {
                                a: {
                                    if (b.length && ia(b[0])) {
                                        var r = Me[b[0]];
                                        if (r && (!c || !Ne[b[0]])) {
                                            b = r(b);
                                            break a
                                        }
                                    }
                                    b = void 0
                                }
                                if (!b) {
                                    ff = !1;
                                    continue
                                }
                            }
                            a = kf(b) || a
                        }
                    } finally {
                        c && kd(!0)
                    }
                }
                ff = !1
            }
            return !a
        },
        mf = function () {
            var a = lf();
            try {
                var b = yc.i,
                    c = f["dataLayer"].hide;
                if (c && void 0 !== c[b] && c.end) {
                    c[b] = !1;
                    var d = !0,
                        e;
                    for (e in c)
                        if (c.hasOwnProperty(e) && !0 === c[e]) {
                            d = !1;
                            break
                        } d && (c.end(), c.end = null)
                }
            } catch (g) {}
            return a
        },
        nf = function () {
            var a = La("dataLayer", []),
                b = La("google_tag_manager", {});
            b = b["dataLayer"] = b["dataLayer"] || {};
            Jd(function () {
                b.gtmDom || (b.gtmDom = !0, a.push({
                    event: "gtm.dom"
                }))
            });
            df(function () {
                b.gtmLoad || (b.gtmLoad = !0, a.push({
                    event: "gtm.load"
                }))
            });
            b.subscribers = (b.subscribers ||
                0) + 1;
            var c = a.push;
            a.push = function () {
                var d;
                if (0 < zc.SANDBOXED_JS_SEMAPHORE) {
                    d = [];
                    for (var e = 0; e < arguments.length; e++) d[e] = new $e(arguments[e])
                } else d = [].slice.call(arguments, 0);
                var g = c.apply(a, d);
                ef.push.apply(ef, d);
                if (300 < this.length)
                    for ($a("GTM", 4); 300 < this.length;) this.shift();
                var h = "boolean" !== typeof g || g;
                return lf() && h
            };
            ef.push.apply(ef, a.slice(0));
            A(mf)
        };
    var of ;
    var Kf = {};
    Kf.rb = new String("undefined");
    var Lf = function (a) {
        this.resolve = function (b) {
            for (var c = [], d = 0; d < a.length; d++) c.push(a[d] === Kf.rb ? b : a[d]);
            return c.join("")
        }
    };
    Lf.prototype.toString = function () {
        return this.resolve("undefined")
    };
    Lf.prototype.valueOf = Lf.prototype.toString;
    Kf.Ke = Lf;
    Kf.fc = {};
    Kf.tf = function (a) {
        return new Lf(a)
    };
    var Mf = {};
    Kf.qg = function (a, b) {
        var c = Jc();
        Mf[c] = [a, b];
        return c
    };
    Kf.zd = function (a) {
        var b = a ? 0 : 1;
        return function (c) {
            var d = Mf[c];
            if (d && "function" === typeof d[b]) d[b]();
            Mf[c] = void 0
        }
    };
    Kf.Vf = function (a) {
        for (var b = !1, c = !1,
                d = 2; d < a.length; d++) b = b || 8 === a[d], c = c || 16 === a[d];
        return b && c
    };
    Kf.eg = function (a) {
        if (a === Kf.rb) return a;
        var b = Jc();
        Kf.fc[b] = a;
        return 'google_tag_manager["' + yc.i + '"].macro(' + b + ")"
    };
    Kf.Zf = function (a, b, c) {
        a instanceof Kf.Ke && (a = a.resolve(Kf.qg(b, c)), b = fa);
        return {
            uc: a,
            K: b
        }
    };
    var Nf = function (a, b, c) {
            function d(g, h) {
                var k = g[h];
                return k
            }
            var e = {
                event: b,
                "gtm.element": a,
                "gtm.elementClasses": d(a, "className"),
                "gtm.elementId": a["for"] || Ta(a, "id") || "",
                "gtm.elementTarget": a.formTarget || d(a, "target") || ""
            };
            c && (e["gtm.triggers"] = c.join(","));
            e["gtm.elementUrl"] = (a.attributes && a.attributes.formaction ? a.formAction : "") || a.action || d(a, "href") || a.src || a.code || a.codebase ||
                "";
            return e
        },
        Of = function (a) {
            zc.hasOwnProperty("autoEventsSettings") || (zc.autoEventsSettings = {});
            var b = zc.autoEventsSettings;
            b.hasOwnProperty(a) || (b[a] = {});
            return b[a]
        },
        Pf = function (a, b, c) {
            Of(a)[b] = c
        },
        Qf = function (a, b, c, d) {
            var e = Of(a),
                g = xa(e, b, d);
            e[b] = c(g)
        },
        Rf = function (a, b, c) {
            var d = Of(a);
            return xa(d, b, c)
        };
    var Sf = function () {
            for (var a = Ia.userAgent + (u.cookie || "") + (u.referrer || ""), b = a.length, c = f.history.length; 0 < c;) a += c-- ^ b++;
            var d = 1,
                e, g, h;
            if (a)
                for (d = 0, g = a.length - 1; 0 <= g; g--) h = a.charCodeAt(g), d = (d << 6 & 268435455) + h + (h << 14), e = d & 266338304, d = 0 != e ? d ^ e >> 21 : d;
            return [Math.round(2147483647 * Math.random()) ^ d & 2147483647, Math.round(wa() / 1E3)].join(".")
        },
        Vf = function (a, b, c, d) {
            var e = Tf(b);
            return lb(a, e, Uf(c), d)
        },
        Tf = function (a) {
            if (!a) return 1;
            a = 0 === a.indexOf(".") ? a.substr(1) : a;
            return a.split(".").length
        },
        Uf = function (a) {
            if (!a ||
                "/" === a) return 1;
            "/" !== a[0] && (a = "/" + a);
            "/" !== a[a.length - 1] && (a += "/");
            return a.split("/").length - 1
        };

    function Wf(a, b) {
        var c = "" + Tf(a),
            d = Uf(b);
        1 < d && (c += "-" + d);
        return c
    };
    var Xf = ["1"],
        Yf = {},
        bg = function (a, b, c, d) {
            var e = Zf(a);
            Yf[e] || $f(e, b, c) || (ag(e, Sf(), b, c, d), $f(e, b, c))
        };

    function ag(a, b, c, d, e) {
        var g;
        g = ["1", Wf(d, c), b].join(".");
        pb(a, g, c, d, 0 == e ? void 0 : new Date(wa() + 1E3 * (void 0 == e ? 7776E3 : e)))
    }

    function $f(a, b, c) {
        var d = Vf(a, b, c, Xf);
        d && (Yf[a] = d);
        return d
    }

    function Zf(a) {
        return (a || "_gcl") + "_au"
    };
    var cg = function () {
        for (var a = [], b = u.cookie.split(";"), c = /^\s*_gac_(UA-\d+-\d+)=\s*(.+?)\s*$/, d = 0; d < b.length; d++) {
            var e = b[d].match(c);
            e && a.push({
                Rc: e[1],
                value: e[2]
            })
        }
        var g = {};
        if (!a || !a.length) return g;
        for (var h = 0; h < a.length; h++) {
            var k = a[h].value.split(".");
            "1" == k[0] && 3 == k.length && k[1] && (g[a[h].Rc] || (g[a[h].Rc] = []), g[a[h].Rc].push({
                timestamp: k[1],
                Ff: k[2]
            }))
        }
        return g
    };

    function dg() {
        for (var a = eg, b = {}, c = 0; c < a.length; ++c) b[a[c]] = c;
        return b
    }

    function fg() {
        var a = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        a += a.toLowerCase() + "0123456789-_";
        return a + "."
    }
    var eg, gg, hg = function (a) {
            eg = eg || fg();
            gg = gg || dg();
            for (var b = [], c = 0; c < a.length; c += 3) {
                var d = c + 1 < a.length,
                    e = c + 2 < a.length,
                    g = a.charCodeAt(c),
                    h = d ? a.charCodeAt(c + 1) : 0,
                    k = e ? a.charCodeAt(c + 2) : 0,
                    l = g >> 2,
                    m = (g & 3) << 4 | h >> 4,
                    n = (h & 15) << 2 | k >> 6,
                    p = k & 63;
                e || (p = 64, d || (n = 64));
                b.push(eg[l], eg[m], eg[n], eg[p])
            }
            return b.join("")
        },
        ig = function (a) {
            function b(l) {
                for (; d < a.length;) {
                    var m = a.charAt(d++),
                        n = gg[m];
                    if (null != n) return n;
                    if (!/^[\s\xa0]*$/.test(m)) throw Error("Unknown base64 encoding at char: " + m);
                }
                return l
            }
            eg = eg || fg();
            gg = gg ||
                dg();
            for (var c = "", d = 0;;) {
                var e = b(-1),
                    g = b(0),
                    h = b(64),
                    k = b(64);
                if (64 === k && -1 === e) return c;
                c += String.fromCharCode(e << 2 | g >> 4);
                64 != h && (c += String.fromCharCode(g << 4 & 240 | h >> 2), 64 != k && (c += String.fromCharCode(h << 6 & 192 | k)))
            }
        };
    var jg;

    function kg(a, b) {
        if (!a || b === u.location.hostname) return !1;
        for (var c = 0; c < a.length; c++)
            if (a[c] instanceof RegExp) {
                if (a[c].test(b)) return !0
            } else if (0 <= b.indexOf(a[c])) return !0;
        return !1
    }
    var og = function () {
            var a = lg,
                b = mg,
                c = ng(),
                d = function (h) {
                    a(h.target || h.srcElement || {})
                },
                e = function (h) {
                    b(h.target || h.srcElement || {})
                };
            if (!c.init) {
                Ra(u, "mousedown", d);
                Ra(u, "keyup", d);
                Ra(u, "submit", e);
                var g = HTMLFormElement.prototype.submit;
                HTMLFormElement.prototype.submit = function () {
                    b(this);
                    g.call(this)
                };
                c.init = !0
            }
        },
        ng = function () {
            var a = La("google_tag_data", {}),
                b = a.gl;
            b && b.decorators || (b = {
                decorators: []
            }, a.gl = b);
            return b
        };
    var pg = /(.*?)\*(.*?)\*(.*)/,
        qg = /^https?:\/\/([^\/]*?)\.?cdn\.ampproject\.org\/?(.*)/,
        rg = /^(?:www\.|m\.|amp\.)+/,
        sg = /([^?#]+)(\?[^#]*)?(#.*)?/,
        tg = /(.*?)(^|&)_gl=([^&]*)&?(.*)/,
        vg = function (a) {
            var b = [],
                c;
            for (c in a)
                if (a.hasOwnProperty(c)) {
                    var d = a[c];
                    void 0 !== d && d === d && null !== d && "[object Object]" !== d.toString() && (b.push(c), b.push(hg(String(d))))
                } var e = b.join("*");
            return ["1", ug(e), e].join("*")
        },
        ug = function (a, b) {
            var c = [window.navigator.userAgent, (new Date).getTimezoneOffset(), window.navigator.userLanguage ||
window.navigator.language, Math.floor((new Date).getTime() / 60 / 1E3) - (void 0 === b ? 0 : b), a].join("*"),
                d;
            if (!(d = jg)) {
                for (var e = Array(256), g = 0; 256 > g; g++) {
                    for (var h = g, k = 0; 8 > k; k++) h = h & 1 ? h >>> 1 ^ 3988292384 : h >>> 1;
                    e[g] = h
                }
                d = e
            }
            jg = d;
            for (var l = 4294967295, m = 0; m < c.length; m++) l = l >>> 8 ^ jg[(l ^ c.charCodeAt(m)) & 255];
            return ((l ^ -1) >>> 0).toString(36)
        },
        xg = function () {
            return function (a) {
                var b = hb(f.location.href),
                    c = b.search.replace("?", ""),
                    d = db(c, "_gl", !0) || "";
                a.query = wg(d) || {};
                var e = gb(b, "fragment").match(tg);
                a.fragment = wg(e && e[3] ||
                    "") || {}
            }
        },
        wg = function (a) {
            var b;
            b = void 0 === b ? 3 : b;
            try {
                if (a) {
                    var c;
                    a: {
                        for (var d = a, e = 0; 3 > e; ++e) {
                            var g = pg.exec(d);
                            if (g) {
                                c = g;
                                break a
                            }
                            d = decodeURIComponent(d)
                        }
                        c = void 0
                    }
                    var h = c;
                    if (h && "1" === h[1]) {
                        var k = h[3],
                            l;
                        a: {
                            for (var m = h[2], n = 0; n < b; ++n)
                                if (m === ug(k, n)) {
                                    l = !0;
                                    break a
                                } l = !1
                        }
                        if (l) {
                            for (var p = {}, t = k ? k.split("*") : [], q = 0; q < t.length; q += 2) p[t[q]] = ig(t[q + 1]);
                            return p
                        }
                    }
                }
            } catch (r) {}
        };

    function yg(a, b, c) {
        function d(m) {
            var n = m,
                p = tg.exec(n),
                t = n;
            if (p) {
                var q = p[2],
                    r = p[4];
                t = p[1];
                r && (t = t + q + r)
            }
            m = t;
            var w = m.charAt(m.length - 1);
            m && "&" !== w && (m += "&");
            return m + l
        }
        c = void 0 === c ? !1 : c;
        var e = sg.exec(b);
        if (!e) return "";
        var g = e[1],
            h = e[2] || "",
            k = e[3] || "",
            l = "_gl=" + a;
        c ? k = "#" + d(k.substring(1)) : h = "?" + d(h.substring(1));
        return "" + g + h + k
    }

    function zg(a, b, c) {
        for (var d = {}, e = {}, g = ng().decorators, h = 0; h < g.length; ++h) {
            var k = g[h];
            (!c || k.forms) && kg(k.domains, b) && (k.fragment ? za(e, k.callback()) : za(d, k.callback()))
        }
        if (Aa(d)) {
            var l = vg(d);
            if (c) {
                if (a && a.action) {
                    var m = (a.method || "").toLowerCase();
                    if ("get" === m) {
                        for (var n = a.childNodes || [], p = !1, t = 0; t < n.length; t++) {
                            var q = n[t];
                            if ("_gl" === q.name) {
                                q.setAttribute("value", l);
                                p = !0;
                                break
                            }
                        }
                        if (!p) {
                            var r = u.createElement("input");
                            r.setAttribute("type", "hidden");
                            r.setAttribute("name", "_gl");
                            r.setAttribute("value",
                                l);
                            a.appendChild(r)
                        }
                    } else if ("post" === m) {
                        var w = yg(l, a.action);
                        Ya.test(w) && (a.action = w)
                    }
                }
            } else Ag(l, a, !1)
        }
        if (!c && Aa(e)) {
            var v = vg(e);
            Ag(v, a, !0)
        }
    }

    function Ag(a, b, c) {
        if (b.href) {
            var d = yg(a, b.href, void 0 === c ? !1 : c);
            Ya.test(d) && (b.href = d)
        }
    }
    var lg = function (a) {
            try {
                var b;
                a: {
                    for (var c = a, d = 100; c && 0 < d;) {
                        if (c.href && c.nodeName.match(/^a(?:rea)?$/i)) {
                            b = c;
                            break a
                        }
                        c = c.parentNode;
                        d--
                    }
                    b = null
                }
                var e = b;
                if (e) {
                    var g = e.protocol;
                    "http:" !== g && "https:" !== g || zg(e, e.hostname, !1)
                }
            } catch (h) {}
        },
        mg = function (a) {
            try {
                if (a.action) {
                    var b = gb(hb(a.action), "host");
                    zg(a, b, !0)
                }
            } catch (c) {}
        },
        Bg = function (a, b, c, d) {
            og();
            var e = {
                callback: a,
                domains: b,
                fragment: "fragment" === c,
                forms: !!d
            };
            ng().decorators.push(e)
        },
        Cg = function () {
            var a = u.location.hostname,
                b = qg.exec(u.referrer);
            if (!b) return !1;
            var c = b[2],
                d = b[1],
                e = "";
            if (c) {
                var g = c.split("/"),
                    h = g[1];
                e = "s" === h ? decodeURIComponent(g[2]) : decodeURIComponent(h)
            } else if (d) {
                if (0 === d.indexOf("xn--")) return !1;
                e = d.replace(/-/g, ".").replace(/\.\./g, "-")
            }
            return a.replace(rg, "") === e.replace(rg, "")
        },
        Dg = function (a, b) {
            return !1 === a ? !1 : a || b || Cg()
        };
    var Eg = {};
    var Fg = /^\w+$/,
        Gg = /^[\w-]+$/,
        Hg = /^~?[\w-]+$/,
        Ig = {
            aw: "_aw",
            dc: "_dc",
            gf: "_gf",
            ha: "_ha"
        };

    function Jg(a) {
        return a && "string" == typeof a && a.match(Fg) ? a : "_gcl"
    }
    var Lg = function () {
        var a = hb(f.location.href),
            b = gb(a, "query", !1, void 0, "gclid"),
            c = gb(a, "query", !1, void 0, "gclsrc"),
            d = gb(a, "query", !1, void 0, "dclid");
        if (!b || !c) {
            var e = a.hash.replace("#", "");
            b = b || db(e, "gclid", void 0);
            c = c || db(e, "gclsrc", void 0)
        }
        return Kg(b, c, d)
    };

    function Kg(a, b, c) {
        var d = {},
            e = function (g, h) {
                d[h] || (d[h] = []);
                d[h].push(g)
            };
        if (void 0 !== a && a.match(Gg)) switch (b) {
            case void 0:
                e(a, "aw");
                break;
            case "aw.ds":
                e(a, "aw");
                e(a, "dc");
                break;
            case "ds":
                e(a, "dc");
                break;
            case "3p.ds":
                (void 0 == Eg.gtm_3pds ? 0 : Eg.gtm_3pds) && e(a, "dc");
                break;
            case "gf":
                e(a, "gf");
                break;
            case "ha":
                e(a, "ha")
        }
        c && e(c, "dc");
        return d
    }

    function Mg(a, b, c) {
        function d(p, t) {
            var q = Ng(p, e);
            q && pb(q, t, h, g, l, !0)
        }
        b = b || {};
        var e = Jg(b.prefix),
            g = b.domain || "auto",
            h = b.path || "/",
            k = void 0 == b.Qd ? 7776E3 : b.Qd;
        c = c || wa();
        var l = 0 == k ? void 0 : new Date(c + 1E3 * k),
            m = Math.round(c / 1E3),
            n = function (p) {
                return ["GCL", m, p].join(".")
            };
        a.aw && (!0 === b.nh ? d("aw", n("~" + a.aw[0])) : d("aw", n(a.aw[0])));
        a.dc && d("dc", n(a.dc[0]));
        a.gf && d("gf", n(a.gf[0]));
        a.ha && d("ha", n(a.ha[0]))
    }
    var Ng = function (a, b) {
            var c = Ig[a];
            if (void 0 !== c) return b + c
        },
        Og = function (a) {
            var b = a.split(".");
            return 3 !== b.length || "GCL" !== b[0] ? 0 : 1E3 * (Number(b[1]) || 0)
        };

    function Pg(a) {
        var b = a.split(".");
        if (3 == b.length && "GCL" == b[0] && b[1]) return b[2]
    }
    var Qg = function (a, b, c, d, e) {
            if (ka(b)) {
                var g = Jg(e);
                Bg(function () {
                    for (var h = {}, k = 0; k < a.length; ++k) {
                        var l = Ng(a[k], g);
                        if (l) {
                            var m = ib(l, u.cookie);
                            m.length && (h[l] = m.sort()[m.length - 1])
                        }
                    }
                    return h
                }, b, c, d)
            }
        },
        Rg = function (a) {
            return a.filter(function (b) {
                return Hg.test(b)
            })
        },
        Sg = function (a) {
            for (var b = ["aw", "dc"], c = Jg(a && a.prefix), d = {}, e = 0; e < b.length; e++) Ig[b[e]] && (d[b[e]] = Ig[b[e]]);
            ra(d, function (g, h) {
                var k = ib(c + h, u.cookie);
                if (k.length) {
                    var l = k[0],
                        m = Og(l),
                        n = {};
                    n[g] = [Pg(l)];
                    Mg(n, a, m)
                }
            })
        };
    var Tg = /^\d+\.fls\.doubleclick\.net$/;

    function Ug(a) {
        var b = hb(f.location.href),
            c = gb(b, "host", !1);
        if (c && c.match(Tg)) {
            var d = gb(b, "path").split(a + "=");
            if (1 < d.length) return d[1].split(";")[0].split("?")[0]
        }
    }

    function Vg(a, b) {
        if ("aw" == a || "dc" == a) {
            var c = Ug("gcl" + a);
            if (c) return c.split(".")
        }
        var d = Jg(b);
        if ("_gcl" == d) {
            var e;
            e = Lg()[a] || [];
            if (0 < e.length) return e
        }
        var g = Ng(a, d),
            h;
        if (g) {
            var k = [];
            if (u.cookie) {
                var l = ib(g, u.cookie);
                if (l && 0 != l.length) {
                    for (var m = 0; m < l.length; m++) {
                        var n = Pg(l[m]);
                        n && -1 === la(k, n) && k.push(n)
                    }
                    h = Rg(k)
                } else h = k
            } else h = k
        } else h = [];
        return h
    }
    var Wg = function () {
            var a = Ug("gac");
            if (a) return decodeURIComponent(a);
            var b = cg(),
                c = [];
            ra(b, function (d, e) {
                for (var g = [], h = 0; h < e.length; h++) g.push(e[h].Ff);
                g = Rg(g);
                g.length && c.push(d + ":" + g.join(","))
            });
            return c.join(";")
        },
        Xg = function (a, b, c, d, e) {
            bg(b, c, d, e);
            var g = Yf[Zf(b)],
                h = Lg().dc || [],
                k = !1;
            if (g && 0 < h.length) {
                var l = zc.joined_au = zc.joined_au || {},
                    m = b || "_gcl";
                if (!l[m])
                    for (var n = 0; n < h.length; n++) {
                        var p = "https://adservice.google.com/ddm/regclk",
                            t = p = p + "?gclid=" + h[n] + "&auiddc=" + g;
                        Ia.sendBeacon && Ia.sendBeacon(t) || Qa(t);
                        k = l[m] = !0
                    }
            }
            null == a && (a = k);
            if (a && g) {
                var q = Zf(b),
                    r = Yf[q];
                r && ag(q, r, c, d, e)
            }
        };
    var Yg;
    if (3 === yc.vb.length) Yg = "g";
    else {
        var Zg = "G";
        Zg = "g";
        Yg = Zg
    }
    var $g = {
            "": "n",
            UA: "u",
            AW: "a",
            DC: "d",
            G: "e",
            GF: "f",
            HA: "h",
            GTM: Yg,
            OPT: "o"
        },
        ah = function (a) {
            var b = yc.i.split("-"),
                c = b[0].toUpperCase(),
                d = $g[c] || "i",
                e = a && "GTM" === c ? b[1] : "OPT" === c ? b[1] : "",
                g;
            if (3 === yc.vb.length) {
                var h = void 0;
                h = h || (Oe() ? "s" : "o");
                g = "2" + (h || "w")
            } else g =
                "";
            return g + d + yc.vb + e
        };
    var bh = function (a) {
            return !(void 0 === a || null === a || 0 === (a + "").length)
        },
        ch = function (a, b) {
            var c;
            if (2 === b.N) return a("ord", na(1E11, 1E13)), !0;
            if (3 === b.N) return a("ord", "1"), a("num", na(1E11, 1E13)), !0;
            if (4 === b.N) return bh(b.sessionId) && a("ord", b.sessionId), !0;
            if (5 === b.N) c = "1";
            else if (6 === b.N) c = b.Lc;
            else return !1;
            bh(c) && a("qty", c);
            bh(b.yb) && a("cost", b.yb);
            bh(b.transactionId) && a("ord", b.transactionId);
            return !0
        },
        dh = encodeURIComponent,
        eh = function (a, b) {
            function c(n, p, t) {
                g.hasOwnProperty(n) || (p += "", e += ";" + n + "=" +
                    (t ? p : dh(p)))
            }
            var d = a.oc,
                e = a.protocol;
            e += a.Ib ? "//" + d + ".fls.doubleclick.net/activityi" : "//ad.doubleclick.net/activity";
            e += ";src=" + dh(d) + (";type=" + dh(a.sc)) + (";cat=" + dh(a.Oa));
            var g = a.vf || {};
            ra(g, function (n, p) {
                e += ";" + dh(n) + "=" + dh(p + "")
            });
            if (ch(c, a)) {
                bh(a.Nb) && c("u", a.Nb);
                bh(a.Mb) && c("tran", a.Mb);
                c("gtm", ah());
                !1 === a.Te && c("npa", "1");
                if (a.mc) {
                    var h = Vg("dc", a.wa);
                    h && h.length && c("gcldc", h.join("."));
                    var k = Vg("aw", a.wa);
                    k && k.length && c("gclaw", k.join("."));
                    var l = Wg();
                    l && c("gac", l);
                    bg(a.wa, void 0, a.rf, a.sf);
                    var m = Yf[Zf(a.wa)];
                    m && c("auiddc", m)
                }
                bh(a.Hc) && c("prd", a.Hc, !0);
                ra(a.Uc, function (n, p) {
                    c(n, p)
                });
                e += b || "";
                bh(a.Gb) && c("~oref", a.Gb);
                a.Ib ? Pa(e + "?", a.K) : Qa(e + "?", a.K, a.P)
            } else A(a.P)
        };
    var gh = function (a) {
            var b = "/pagead/conversion/" + fh(a.conversion_id) + "/?",
                c = fh(JSON.stringify(a.conversion_data)),
                d = "https://www.googletraveladservices.com/travel/flights/clk" + b + "conversion_data=" + c;
            if (a.conversionLinkerEnabled) {
                var e = Vg("gf", a.cookiePrefix);
                if (e && e.length)
                    for (var g = 0; g < e.length; g++) d += "&gclgf=" + fh(e[g])
            }
            Qa(d, a.onSuccess, a.onFailure)
        },
        fh = function (a) {
            return null === a || void 0 === a || 0 === String(a).length ? "" : encodeURIComponent(String(a))
        };
    var hh = !!f.MutationObserver,
        ih = void 0,
        jh = function (a) {
            if (!ih) {
                var b = function () {
                    var c = u.body;
                    if (c)
                        if (hh)(new MutationObserver(function () {
                            for (var e = 0; e < ih.length; e++) A(ih[e])
                        })).observe(c, {
                            childList: !0,
                            subtree: !0
                        });
                        else {
                            var d = !1;
                            Ra(c, "DOMNodeInserted", function () {
                                d || (d = !0, A(function () {
                                    d = !1;
                                    for (var e = 0; e < ih.length; e++) A(ih[e])
                                }))
                            })
                        }
                };
                ih = [];
                u.body ? b() : A(b)
            }
            ih.push(a)
        };
    var Jh = f.clearTimeout,
        Kh = f.setTimeout,
        H = function (a, b, c) {
            if (Oe()) {
                b && A(b)
            } else return Na(a, b, c)
        },
        Lh = function () {
            return new Date
        },
        Mh = function () {
            return f.location.href
        },
        Nh = function (a) {
            return gb(hb(a), "fragment")
        },
        Oh = function (a) {
            return fb(hb(a))
        },
        Ph = null;
    var Qh = function (a, b) {
            return ld(a, b || 2)
        },
        Rh = function (a, b, c) {
            b && (a.eventCallback = b, c && (a.eventTimeout = c));
            return gf(a)
        },
        Sh = function (a, b) {
            f[a] = b
        },
        K = function (a, b, c) {
            b && (void 0 === f[a] || c && !f[a]) && (f[a] = b);
            return f[a]
        },
        Th = function (a, b, c) {
            return ib(a, b, void 0 === c ? !0 : !!c)
        },
        Uh = function (a, b, c, d) {
            var e = {
                    prefix: a,
                    path: b,
                    domain: c,
                    Qd: d
                },
                g = Lg();
            Mg(g, e);
            Sg(e)
        },
        Vh = function (a, b, c, d, e) {
            var g = xg(),
                h = ng();
            h.data || (h.data = {
                query: {},
                fragment: {}
            }, g(h.data));
            var k = {},
                l = h.data;
            l &&
                (za(k, l.query), za(k, l.fragment));
            for (var m = Jg(b), n = 0; n < a.length; ++n) {
                var p = a[n];
                if (void 0 !== Ig[p]) {
                    var t = Ng(p, m),
                        q = k[t];
                    if (q) {
                        var r = Math.min(Og(q), wa()),
                            w;
                        b: {
                            for (var v = r, y = ib(t, u.cookie), x = 0; x < y.length; ++x)
                                if (Og(y[x]) > v) {
                                    w = !0;
                                    break b
                                } w = !1
                        }
                        w || pb(t, q, c, d, 0 == e ? void 0 : new Date(r + 1E3 * (null == e ? 7776E3 : e)), !0)
                    }
                }
            }
            var z = {
                prefix: b,
                path: c,
                domain: d
            };
            Mg(Kg(k.gclid, k.gclsrc), z);
        },
        Wh = function (a, b, c, d, e) {
            Qg(a, b, c, d, e);
        },
        Xh = function (a, b) {
            if (Oe()) {
                b && A(b)
            } else Pa(a, b)
        },
        Yh = function (a) {
            return !!Rf(a, "init", !1)
        },
        Zh = function (a) {
            Pf(a, "init", !0)
        },
        $h = function (a, b, c) {
            var d = (void 0 === c ? 0 : c) ? "www.googletagmanager.com/gtag/js" : Cc;
            d += "?id=" + encodeURIComponent(a) + "&l=dataLayer";
            b && ra(b, function (e, g) {
                g && (d += "&" + e + "=" + encodeURIComponent(g))
            });
            H(D("https://", "http://", d))
        },
        ai = function (a, b) {
            var c = a[b];
            return c
        };
    var bi = function (a, b, c, d, e, g) {
        var h = {
            config: a,
            gtm: ah()
        };
        c && (bg(d, void 0, e, g), h.auiddc = Yf[Zf(d)]);
        b && (h.loadInsecure = b);
        K("__dc_ns_processor", []).push(h);
        H((b ? "http" : "https") + "://www.googletagmanager.com/dclk/ns/v1.js")
    };
    var ci = Kf.Zf;
    var di = new oa,
        ei = function (a, b) {
            function c(h) {
                var k = hb(h),
                    l = gb(k, "protocol"),
                    m = gb(k, "host", !0),
                    n = gb(k, "port"),
                    p = gb(k, "path").toLowerCase().replace(/\/$/, "");
                if (void 0 === l || "http" == l && "80" == n || "https" == l && "443" == n) l = "web", n = "default";
                return [l, m, n, p]
            }
            for (var d = c(String(a)), e = c(String(b)), g = 0; g < d.length; g++)
                if (d[g] !== e[g]) return !1;
            return !0
        },
        fi = function (a) {
            var b = a.arg0,
                c = a.arg1;
            if (a.any_of && ka(c)) {
                for (var d = 0; d < c.length; d++)
                    if (fi({
                            "function": a["function"],
                            arg0: b,
                            arg1: c[d]
                        })) return !0;
                return !1
            }
            switch (a["function"]) {
                case "_cn":
                    return 0 <=
                        String(b).indexOf(String(c));
                case "_css":
                    var e;
                    a: {
                        if (b) {
                            var g = ["matches", "webkitMatchesSelector", "mozMatchesSelector", "msMatchesSelector", "oMatchesSelector"];
                            try {
                                for (var h = 0; h < g.length; h++)
                                    if (b[g[h]]) {
                                        e = b[g[h]](c);
                                        break a
                                    }
                            } catch (w) {}
                        }
                        e = !1
                    }
                    return e;
                case "_ew":
                    var k, l;
                    k = String(b);
                    l = String(c);
                    var m = k.length - l.length;
                    return 0 <= m && k.indexOf(l, m) == m;
                case "_eq":
                    return String(b) == String(c);
                case "_ge":
                    return Number(b) >= Number(c);
                case "_gt":
                    return Number(b) > Number(c);
                case "_lc":
                    var n;
                    n = String(b).split(",");
                    return 0 <= la(n, String(c));
                case "_le":
                    return Number(b) <= Number(c);
                case "_lt":
                    return Number(b) < Number(c);
                case "_re":
                    var p;
                    var t = a.ignore_case ? "i" : void 0;
                    try {
                        var q = String(c) + t,
                            r = di.get(q);
                        r || (r = new RegExp(c, t), di.set(q, r));
                        p = r.test(b)
                    } catch (w) {
                        p = !1
                    }
                    return p;
                case "_sw":
                    return 0 == String(b).indexOf(String(c));
                case "_um":
                    return ei(b, c)
            }
            return !1
        };
    var hi = function (a, b) {
        var c = function () {};
        c.prototype = a.prototype;
        var d = new c;
        a.apply(d, Array.prototype.slice.call(arguments, 1));
        return d
    };
    var ii = {},
        ji = encodeURI,
        L = encodeURIComponent,
        ki = Qa;
    var li = function (a, b) {
        if (!a) return !1;
        var c = gb(hb(a), "host");
        if (!c) return !1;
        for (var d = 0; b && d < b.length; d++) {
            var e = b[d] && b[d].toLowerCase();
            if (e) {
                var g = c.length - e.length;
                0 < g && "." != e.charAt(0) && (g--, e = "." + e);
                if (0 <= g && c.indexOf(e, g) == g) return !0
            }
        }
        return !1
    };
    var mi = function (a, b, c) {
        for (var d = {}, e = !1, g = 0; a && g < a.length; g++) a[g] && a[g].hasOwnProperty(b) && a[g].hasOwnProperty(c) && (d[a[g][b]] = a[g][c], e = !0);
        return e ? d : null
    };
    ii.Wf = function () {
        var a = !1;
        return a
    };
    var ni = function () {
        var a = !1;
        return a
    };
    var Xi = function (a, b, c, d) {
            this.n = a;
            this.t = b;
            this.p = c;
            this.d = d
        },
        Yi = function () {
            this.c = 1;
            this.e = [];
            this.p = null
        };

    function Zi(a) {
        var b = zc,
            c = b.gss = b.gss || {};
        return c[a] = c[a] || new Yi
    }
    var $i = function (a, b) {
            Zi(a).p = b
        },
        aj = function (a) {
            var b = Zi(a),
                c = b.p;
            if (c) {
                var d = b.e,
                    e = [];
                b.e = [];
                var g = function (h) {
                    for (var k = 0; k < h.length; k++) try {
                        var l = h[k];
                        l.d ? (l.d = !1, e.push(l)) : c(l.n, l.t, l.p)
                    } catch (m) {}
                };
                g(d);
                g(e)
            }
        };
    var cj = function () {
        var a = f.gaGlobal = f.gaGlobal || {};
        a.hid = a.hid || na();
        return a.hid
    };
    var rj = window,
        sj = document,
        tj = function (a) {
            var b = rj._gaUserPrefs;
            if (b && b.ioo && b.ioo() || a && !0 === rj["ga-disable-" + a]) return !0;
            try {
                var c = rj.external;
                if (c && c._gaUserPrefs && "oo" == c._gaUserPrefs) return !0
            } catch (g) {}
            for (var d = ib("AMP_TOKEN", sj.cookie, !0), e = 0; e < d.length; e++)
                if ("$OPT_OUT" == d[e]) return !0;
            return sj.getElementById("__gaOptOutExtension") ? !0 : !1
        };
    var Aj = function (a, b, c) {
            zj(a);
            var d = Math.floor(wa() / 1E3);
            Zi(a).e.push(new Xi(b, d, c, void 0));
            aj(a)
        },
        Bj = function (a, b, c) {
            zj(a);
            var d = Math.floor(wa() / 1E3);
            Zi(a).e.push(new Xi(b, d, c, !0))
        },
        zj = function (a) {
            if (1 === Zi(a).c && (Zi(a).c = 2, !Oe())) {
                var b = encodeURIComponent(a);
                Na(("http:" != f.location.protocol ? "https:" : "http:") + ("//www.googletagmanager.com/gtag/js?id=" + b + "&l=dataLayer&cx=c"))
            }
        },
        Dj = function (a, b) {},
        Cj = function (a,
            b) {};
    var Y = {
        a: {}
    };


    Y.a.gtagha = ["google"],
        function () {
            function a(h) {
                function k(m, n) {
                    void 0 !== n && l.push(m + "=" + n)
                }
                if (void 0 === h) return "";
                var l = [];
                k("hct_base_price", h.Hd);
                k("hct_booking_xref", h.Id);
                k("hct_checkin_date", h.Lf);
                k("hct_checkout_date", h.Mf);
                k("hct_currency_code", h.Nf);
                k("hct_partner_hotel_id", h.Jd);
                k("hct_total_price", h.Kd);
                return l.join(";")
            }

            function b(h, k, l, m) {
                var n = L(h),
                    p = L(a(k)),
                    t = "https://www.googletraveladservices.com/travel/clk/pagead/conversion/" + n + "/?data=" + p;
                l && (t += Vg("ha", m).map(function (q) {
                    return "&gclha=" +
                        L(q)
                }).join(""));
                return t
            }

            function c(h, k, l, m, n, p) {
                /^\d+$/.test(h) ? ki(b(h, k, l, m), n, p) : A(p)
            }

            function d(h, k, l, m) {
                var n = {};
                ia(h) ? n.Id = h : "number" === typeof h && (n.Id = String(h));
                ia(l) && (n.Nf = l);
                ia(k) ? n.Kd = n.Hd = k : "number" === typeof k && (n.Kd = n.Hd = String(k));
                if (!ka(m) || 0 == m.length) return n;
                var p = m[0];
                if (!Ga(p)) return n;
                ia(p.id) ? n.Jd = p.id : "number" === typeof p.id && (n.Jd = String(p.id));
                ia(p.start_date) && (n.Lf = p.start_date);
                ia(p.end_date) && (n.Mf = p.end_date);
                return n
            }

            function e(h) {
                var k = Fc,
                    l = h.vtp_gtmOnSuccess,
                    m = h.vtp_gtmOnFailure,
                    n = h.vtp_conversionId,
                    p = n.containerId,
                    t = function (z) {
                        return nd(z, p, n.id)
                    },
                    q = !1 !== t(G.Ha),
                    r = t(G.Ga) || t(G.H),
                    w = t(G.O),
                    v = t(G.V);
                if (k === G.ba) {
                    var y = t(G.Ja) || {};
                    q && (Dg(y[G.jb], !!y[G.I]) && Vh(g, r, void 0, w, v), Uh(r, void 0, w, v));
                    y[G.I] && Wh(g, y[G.I], y[G.lb], !!y[G.kb], r);
                    A(l)
                } else if ("purchase" === k) {
                    var x = d(t(G.La), t(G.da), t(G.oa), t(G.U));
                    c(n.fa[0], x, q, r, l, m)
                } else A(m)
            }
            var g = ["ha"];
            Y.__gtagha = e;
            Y.__gtagha.g = "gtagha";
            Y.__gtagha.h = !0;
            Y.__gtagha.b = 0;
        }();

    Y.a.e = ["google"],
        function () {
            (function (a) {
                Y.__e = a;
                Y.__e.g = "e";
                Y.__e.h = !0;
                Y.__e.b = 0
            })(function (a) {
                return String(ud(a.vtp_gtmEventId, "event"))
            })
        }();
    Y.a.v = ["google"],
        function () {
            (function (a) {
                Y.__v = a;
                Y.__v.g = "v";
                Y.__v.h = !0;
                Y.__v.b = 0
            })(function (a) {
                var b = a.vtp_name;
                if (!b || !b.replace) return !1;
                var c = Qh(b.replace(/\\\./g, "."), a.vtp_dataLayerVersion || 1);
                return void 0 !== c ? c : a.vtp_defaultValue
            })
        }();





    Y.a.gtagaw = ["google"],
        function () {
            var a = !1,
                b = [],
                c = ["aw", "dc"],
                d = function (m) {
                    var n = K("google_trackConversion"),
                        p = m.gtm_onFailure;
                    "function" == typeof n ? n(m) || p() : p()
                },
                e = function () {
                    for (; 0 < b.length;) d(b.shift())
                },
                g = function () {
                    a || (a = !0, Sd(), H(D("https://", "http://", "www.googleadservices.com/pagead/conversion_async.js"), function () {
                        e();
                        b = {
                            push: d
                        }
                    }, function () {
                        e();
                        a = !1
                    }))
                },
                h = function (m, n, p, t) {
                    if (Oe()) {} else {
                        ka(n) || (n = [n]);
                        for (var q =
                                0; q < n.length; q++) 1 > q && Mc(m.fa[0], m.fa[1], n[q], {
                            ee: p,
                            Jg: t
                        })
                    }
                },
                k = function (m) {
                    if (m) {
                        for (var n = [], p = 0; p < m.length; ++p) {
                            var t = m[p];
                            t && n.push({
                                item_id: t.id,
                                quantity: t.quantity,
                                value: t.price,
                                start_date: t.start_date,
                                end_date: t.end_date
                            })
                        }
                        return n
                    }
                },
                l = function (m) {
                    var n = m.vtp_conversionId,
                        p = Fc,
                        t = p == G.ba,
                        q = n.fa[0],
                        r = n.fa[1],
                        w = void 0 !== r,
                        v = n.containerId,
                        y = w ? n.id : void 0,
                        x = function (X) {
                            return nd(X, v, y)
                        },
                        z = !1 !== x(G.Ha),
                        B = x(G.Ga) || x(G.H),
                        C = x(G.O),
                        E = x(G.V);
                    if (t) {
                        var F = x(G.Ja) || {};
                        z && (Dg(F[G.jb], !!F[G.I]) && Vh(c, B, void 0,
                            C, E), Uh(B, void 0, C, E));
                        F[G.I] && Wh(c, F[G.I], F[G.lb], !!F[G.kb], B);
                        if (w) {
                            var Q = x(G.$b),
                                W = x(G.Yb),
                                R = x(G.Zb),
                                T = x(G.od);
                            h(n, Q, W || R, T)
                        }
                    }
                    var O = !1 === x(G.dd) || !1 === x(G.Ka);
                    if (!t || !w && !O)
                        if (!0 === x(G.ed) && (w = !1), !1 !== x(G.T) || w) {
                            var M = {
                                google_conversion_id: q,
                                google_remarketing_only: !w,
                                onload_callback: m.vtp_gtmOnSuccess,
                                gtm_onFailure: m.vtp_gtmOnFailure,
                                google_conversion_format: "3",
                                google_conversion_color: "ffffff",
                                google_conversion_domain: "",
                                google_conversion_label: r,
                                google_conversion_language: x(G.Ia),
                                google_conversion_value: x(G.da),
                                google_conversion_currency: x(G.oa),
                                google_conversion_order_id: x(G.La),
                                google_user_id: x(G.ca),
                                google_conversion_page_url: x(G.mb),
                                google_conversion_referrer_url: x(G.nb),
                                google_gtm: ah()
                            };
                            Oe() && (M.opt_image_generator = function () {
                                return new Image
                            }, M.google_enable_display_cookie_match = !1);
                            !1 === x(G.T) && (M.google_allow_ad_personalization_signals = !1);
                            M.google_read_gcl_cookie_opt_out = !z;
                            z && B && (M.google_gcl_cookie_prefix = B);
                            var I = function () {
                                var X = x(G.gb),
                                    V = {
                                        event: p
                                    };
                                if (ka(X)) {
                                    for (var ea = 0; ea < X.length; ++ea) {
                                        var U =
                                            X[ea],
                                            N = x(U);
                                        void 0 !== N && (V[U] = N)
                                    }
                                    return V
                                }
                                var Z = x("eventModel");
                                if (!Z) return null;
                                Ha(Z, V);
                                for (var qa = 0; qa < G.Yc.length; ++qa) delete V[G.Yc[qa]];
                                return V
                            }();
                            I && (M.google_custom_params = I);
                            !w && x(G.U) && (M.google_gtag_event_data = {
                                items: x(G.U),
                                value: x(G.da)
                            });
                            if (w && "purchase" == p) {
                                x(G.Qb) && (M.google_conversion_merchant_id = x(G.Qb), M.google_basket_feed_country = x(G.gd), M.google_basket_feed_language = x(G.hd), M.google_basket_discount = x(G.fd), M.google_basket_transaction_type = p, M.google_disable_merchant_reported_conversions = !0 === x(G.kd), Oe() && (M.google_disable_merchant_reported_conversions = !0));
                                var J = k(x(G.U));
                                J && (M.google_conversion_items = J)
                            }
                            var P = function (X, V) {
                                void 0 != V && "" !== V && (M.google_additional_conversion_params = M.google_additional_conversion_params || {}, M.google_additional_conversion_params[X] = V)
                            };
                            w && ("boolean" == typeof x(G.Xb) && P("vdnc", x(G.Xb)), P("vdltv", x(G.jd)));
                            var S = !0;
                            S && b.push(M)
                        } g()
                };
            Y.__gtagaw = l;
            Y.__gtagaw.g = "gtagaw";
            Y.__gtagaw.h = !0;
            Y.__gtagaw.b = 0
        }();


    Y.a.get = ["google"],
        function () {
            function a(b, c) {
                ra(c, function (e) {
                    "_" === e.charAt(0) && delete c[e]
                });
                var d = c[G.qb] || {};
                ra(d, function (e) {
                    "_" === e.charAt(0) && delete d[e]
                })
            }(function (b) {
                Y.__get = b;
                Y.__get.g = "get";
                Y.__get.h = !0;
                Y.__get.b = 0
            })(function (b) {
                if (b.vtp_isAutoTag) {
                    for (var c = String(b.vtp_trackingId), d = Fc || "", e = {}, g = G.pd, h = 0; h < g.length; h++) {
                        var k = qd(g[h], c);
                        void 0 !== k && (e[g[h]] = k)
                    }
                    var l = qd(G.gb, c);
                    if (ka(l))
                        for (var m = 0; m < l.length; m++) {
                            var n = l[m],
                                p = qd(n, c);
                            void 0 !== p && (e[n] = p)
                        } else {
                            var t = Qh("eventModel");
                            Ha(t, e)
                        }
                    if ("_" === d.charAt(0)) return;
                    a(d, e);
                    Aj(c, d, Ha(e))
                } else {
                    var q = b.vtp_settings,
                        r = q.eventParameters,
                        w = q.userProperties;
                    Ha(mi(b.vtp_eventParameters, "name", "value"), r);
                    Ha(mi(b.vtp_userProperties, "name", "value"), w);
                    r[G.qb] = w;
                    var v = String(b.vtp_eventName),
                        y = b.vtp_allowSystemNames;
                    if (!y && "_" === v.charAt(0)) return;
                    y || a(v, r);
                    (b.vtp_deferrable ? Bj : Aj)(String(q.streamId), v, r)
                }
                b.vtp_gtmOnSuccess()
            })
        }();



    Y.a.gtagfl = [],
        function () {
            function a(e) {
                var g = /^DC-(\d+)(\/([\w-]+)\/([\w-]+)\+(\w+))?$/.exec(e);
                if (g) {
                    var h = {
                        standard: 2,
                        unique: 3,
                        per_session: 4,
                        transactions: 5,
                        items_sold: 6,
                        "": 1
                    } [(g[5] || "").toLowerCase()];
                    if (h) return {
                        containerId: "DC-" + g[1],
                        de: g[3] ? e : "",
                        Ne: g[1],
                        Me: g[3] || "",
                        Oa: g[4] || "",
                        N: h
                    }
                }
            }

            function b(e, g) {
                function h(t, q, r) {
                    void 0 !== r && 0 !== (r + "").length && k.push(t + q + ":" + e(r + ""))
                }
                var k = [],
                    l = g(G.U) || [];
                if (ka(l))
                    for (var m = 0; m < l.length; m++) {
                        var n = l[m],
                            p = m + 1;
                        h("i", p, n.id);
                        h("p", p, n.price);
                        h("q", p, n.quantity);
                        h("c", p, g(G.ne));
                        h("l", p, g(G.Ia))
                    }
                return k.join("|")
            }

            function c(e, g, h) {
                var k = /^u([1-9]\d?|100)$/,
                    l = e(G.oe) || {},
                    m = rd(g, h),
                    n = {},
                    p = {};
                if (Ga(l))
                    for (var t in l)
                        if (l.hasOwnProperty(t) && k.test(t)) {
                            var q = l[t];
                            ia(q) && (n[t] = q)
                        } for (var r = 0; r < m.length; r++) {
                    var w = m[r];
                    k.test(w) && (n[w] = w)
                }
                for (var v in n) n.hasOwnProperty(v) && (p[v] = e(n[v]));
                return p
            }
            var d = ["aw", "dc"];
            (function (e) {
                Y.__gtagfl = e;
                Y.__gtagfl.g = "gtagfl";
                Y.__gtagfl.h = !0;
                Y.__gtagfl.b = 0
            })(function (e) {
                var g = e.vtp_gtmOnSuccess,
                    h = e.vtp_gtmOnFailure,
                    k = a(e.vtp_targetId);
                if (k) {
                    var l = function (R) {
                            return nd(R, k.containerId, k.de || void 0)
                        },
                        m = !1 !== l(G.Ha),
                        n = l(G.Ga) || l(G.H),
                        p = l(G.O),
                        t = l(G.V),
                        q = l(G.qe),
                        r = 3 === Kc();
                    if (Fc === G.ba) {
                        var w = l(G.Ja) || {},
                            v = l(G.me),
                            y = void 0 === v ? !0 : !!v;
                        m && (Dg(w[G.jb], !!w[G.I]) && Vh(d, n, void 0, p, t), Uh(n, void 0, p, t), Xg(y, n, void 0, p, t));
                        w[G.I] && Wh(d, w[G.I], w[G.lb], !!w[G.kb], n);
                        q && q.exclusion_parameters && q.engines && bi(q, r, m, n, p, t);
                        A(g)
                    } else {
                        var x = {},
                            z = l(G.pe);
                        if (Ga(z))
                            for (var B in z)
                                if (z.hasOwnProperty(B)) {
                                    var C = z[B];
                                    void 0 !== C && null !== C && (x[B] = C)
                                } var E =
                            "";
                        if (5 === k.N || 6 === k.N) E = b(L, l);
                        var F = c(l, k.containerId, k.de),
                            Q = !0 === l(G.he);
                        if (Oe() && Q) {
                            Q = !1
                        }
                        var W = {
                            Oa: k.Oa,
                            mc: m,
                            rf: p,
                            sf: t,
                            wa: n,
                            yb: l(G.da),
                            N: k.N,
                            vf: x,
                            oc: k.Ne,
                            sc: k.Me,
                            P: h,
                            K: g,
                            Gb: Oh(Mh()),
                            Hc: E,
                            protocol: r ? "http:" : "https:",
                            Lc: l(G.Be),
                            Ib: Q,
                            sessionId: l(G.pb),
                            Mb: void 0,
                            transactionId: l(G.La),
                            Nb: void 0,
                            Uc: F,
                            Te: !1 !== l(G.T)
                        };
                        eh(W)
                    }
                } else A(h)
            })
        }();

    Y.a.gtaggf = ["google"],
        function () {
            var a = /.*\.google\.com(:\d+)?\/booking\/flights.*/,
                b = function (c) {
                    if (c) {
                        for (var d = [], e = 0, g = 0; g < c.length; ++g) {
                            var h = c[g];
                            !h || void 0 !== h.category && "" !== h.category && "FlightSegment" !== h.category || (d[e] = {
                                cabin: h.travel_class,
                                fare_product: h.fare_product,
                                booking_code: h.booking_code,
                                flight_number: h.flight_number,
                                origin: h.origin,
                                destination: h.destination,
                                departure_date: h.start_date
                            }, e++)
                        }
                        return d
                    }
                };
            (function (c) {
                Y.__gtaggf = c;
                Y.__gtaggf.g = "gtaggf";
                Y.__gtaggf.h = !0;
                Y.__gtaggf.b =
                    0
            })(function (c) {
                var d = Fc,
                    e = c.vtp_gtmOnSuccess,
                    g = c.vtp_gtmOnFailure,
                    h = c.vtp_conversionId,
                    k = h.fa[0],
                    l = h.containerId,
                    m = function (x) {
                        return nd(x, l, h.id)
                    },
                    n = !1 !== m(G.Ha),
                    p = m(G.Ga) || m(G.H),
                    t = m(G.O),
                    q = m(G.V);
                if (d === G.ba) n && Uh(p, void 0, t, q), A(e);
                else {
                    var r = {
                        conversion_id: k,
                        onFailure: g,
                        onSuccess: e,
                        conversionLinkerEnabled: n,
                        cookiePrefix: p
                    };
                    if ("purchase" === d) {
                        var w = a.test(Mh()),
                            v = {
                                partner_id: k,
                                trip_type: m(G.Ee),
                                total_price: m(G.da),
                                currency: m(G.oa),
                                is_direct_booking: w,
                                flight_segment: b(m(G.U))
                            },
                            y = m(G.Ae);
                        y && "object" ===
                            typeof y && (v.passengers_total = y.total, v.passengers_adult = y.adult, v.passengers_child = y.child, v.passengers_infant_in_seat = y.infant_in_seat, v.passengers_infant_in_lap = y.infant_in_lap);
                        r.conversion_data = v
                    }
                    gh(r)
                }
            })
        }();


    Y.a.gtagua = ["google"],
        function () {
            var a, b = {
                    client_id: 1,
                    client_storage: "storage",
                    cookie_name: 1,
                    cookie_domain: 1,
                    cookie_expires: 1,
                    cookie_path: 1,
                    cookie_update: 1,
                    sample_rate: 1,
                    site_speed_sample_rate: 1,
                    use_amp_client_id: 1,
                    store_gac: 1,
                    conversion_linker: "storeGac"
                },
                c = {
                    anonymize_ip: 1,
                    app_id: 1,
                    app_installer_id: 1,
                    app_name: 1,
                    app_version: 1,
                    campaign: {
                        name: "campaignName",
                        source: "campaignSource",
                        medium: "campaignMedium",
                        term: "campaignTerm",
                        content: "campaignContent",
                        id: "campaignId"
                    },
                    currency: "currencyCode",
                    description: "exDescription",
                    fatal: "exFatal",
                    language: 1,
                    non_interaction: 1,
                    page_hostname: "hostname",
                    page_referrer: "referrer",
                    page_path: "page",
                    page_location: "location",
                    page_title: "title",
                    screen_name: 1,
                    transport_type: "transport",
                    user_id: 1
                },
                d = {
                    content_id: 1,
                    event_category: 1,
                    event_action: 1,
                    event_label: 1,
                    link_attribution: 1,
                    linker: 1,
                    method: 1,
                    name: 1,
                    send_page_view: 1,
                    value: 1
                },
                e = {
                    cookie_name: 1,
                    cookie_expires: "duration",
                    levels: 1
                },
                g = {
                    anonymize_ip: 1,
                    fatal: 1,
                    non_interaction: 1,
                    use_amp_client_id: 1,
                    send_page_view: 1,
                    store_gac: 1,
                    conversion_linker: 1
                },
                h = function (r, w, v, y) {
                    if (void 0 !== v)
                        if (g[w] && (v = ta(v)), "anonymize_ip" != w || v || (v = void 0), 1 === r) y[k(w)] = v;
                        else if (ia(r)) y[r] = v;
                    else
                        for (var x in r) r.hasOwnProperty(x) && void 0 !== v[x] && (y[r[x]] = v[x])
                },
                k = function (r) {
                    return r && ia(r) ? r.replace(/(_[a-z])/g, function (w) {
                        return w[1].toUpperCase()
                    }) : r
                },
                l = function (r, w, v) {
                    r.hasOwnProperty(w) || (r[w] = v)
                },
                m = function (r, w, v) {
                    var y = {},
                        x = {},
                        z = {},
                        B;
                    var C = qd(G.xe, r);
                    if (ka(C)) {
                        for (var E = [], F = 0; F < C.length; F++) {
                            var Q = C[F];
                            if (void 0 != Q) {
                                var W = Q.id,
                                    R = Q.variant;
                                void 0 != W && void 0 !=
                                    R && E.push(String(W) + "." + String(R))
                            }
                        }
                        B = 0 < E.length ? E.join("!") : void 0
                    } else B = void 0;
                    var T = B;
                    T && l(x, "exp", T);
                    var O = qd("custom_map", r);
                    if (Ga(O))
                        for (var M in O)
                            if (O.hasOwnProperty(M) && /^(dimension|metric)\d+$/.test(M) && void 0 != O[M]) {
                                var I = qd(String(O[M]), r);
                                void 0 !== I && l(x, M, I)
                            } for (var J = rd(r), P = 0; P < J.length; ++P) {
                        var S = J[P],
                            X = qd(S, r);
                        d.hasOwnProperty(S) ? h(d[S], S, X, y) : c.hasOwnProperty(S) ? h(c[S], S, X, x) : b.hasOwnProperty(S) ? h(b[S], S, X, z) : /^(dimension|metric|content_group)\d+$/.test(S) ? h(1, S, X, x) : S === G.H &&
                            0 > la(J, G.fb) && (z.cookieName = X + "_ga")
                    }
                    var V = String(Fc);
                    l(z, "cookieDomain", "auto");
                    l(x, "forceSSL", !0);
                    var ea = "general";
                    0 <= la("add_payment_info add_to_cart add_to_wishlist begin_checkout checkout_progress purchase refund remove_from_cart set_checkout_option".split(" "), V) ? ea = "ecommerce" : 0 <= la("generate_lead login search select_content share sign_up view_item view_item_list view_promotion view_search_results".split(" "), V) ? ea = "engagement" : "exception" == V && (ea = "error");
                    l(y, "eventCategory", ea);
                    0 <= la(["view_item",
"view_item_list", "view_promotion", "view_search_results"], V) && l(x, "nonInteraction", !0);
                    "login" == V || "sign_up" == V || "share" == V ? l(y, "eventLabel", qd(G.ye, r)) : "search" == V || "view_search_results" == V ? l(y, "eventLabel", qd(G.Ce, r)) : "select_content" == V && l(y, "eventLabel", qd(G.ke, r));
                    var U = y[G.Ja] || {},
                        N = U[G.jb];
                    N || 0 != N && U[G.I] ? z.allowLinker = !0 : !1 === N && l(z, "useAmpClientId", !1);
                    if (!1 === qd(G.ie, r) || !1 === qd(G.T, r)) x.allowAdFeatures = !1;
                    z.name = w;
                    x["&gtm"] = ah(!0);
                    x.hitCallback = v;
                    y.Y = x;
                    y.nc = z;
                    return y
                },
                n = function (r) {
                    function w(I) {
                        var J =
                            Ha(I);
                        J.list = I.list_name;
                        J.listPosition = I.list_position;
                        J.position = I.list_position || I.creative_slot;
                        J.creative = I.creative_name;
                        return J
                    }

                    function v(I) {
                        for (var J = [], P = 0; I && P < I.length; P++) I[P] && J.push(w(I[P]));
                        return J.length ? J : void 0
                    }

                    function y(I) {
                        return {
                            id: z(x.La),
                            affiliation: z(x.se),
                            revenue: z(x.da),
                            tax: z(x.we),
                            shipping: z(x.ve),
                            coupon: z(x.te),
                            list: z(x.Rb) || I
                        }
                    }
                    for (var x = G, z = function (I) {
                            return nd(I, r, void 0)
                        }, B = z(x.U), C, E = 0; B && E < B.length && !(C = B[E][x.Rb]); E++);
                    var F = z("custom_map");
                    if (Ga(F))
                        for (var Q =
                                0; B && Q < B.length; ++Q) {
                            var W = B[Q],
                                R;
                            for (R in F) F.hasOwnProperty(R) && /^(dimension|metric)\d+$/.test(R) && void 0 != F[R] && l(W, R, W[F[R]])
                        }
                    var T = null,
                        O = Fc,
                        M = z(x.ue);
                    "purchase" == O || "refund" == O ? T = {
                        action: O,
                        Na: y(),
                        Ba: v(B)
                    } : "add_to_cart" == O ? T = {
                        action: "add",
                        Ba: v(B)
                    } : "remove_from_cart" == O ? T = {
                        action: "remove",
                        Ba: v(B)
                    } : "view_item" == O ? T = {
                        action: "detail",
                        Na: y(C),
                        Ba: v(B)
                    } : "view_item_list" == O ? T = {
                        action: "impressions",
                        Qf: v(B)
                    } : "view_promotion" == O ? T = {
                        action: "promo_view",
                        Ic: v(M)
                    } : "select_content" == O && M && 0 < M.length ? T = {
                        action: "promo_click",
                        Ic: v(M)
                    } : "select_content" == O ? T = {
                        action: "click",
                        Na: {
                            list: z(x.Rb) || C
                        },
                        Ba: v(B)
                    } : "begin_checkout" == O || "checkout_progress" == O ? T = {
                        action: "checkout",
                        Ba: v(B),
                        Na: {
                            step: "begin_checkout" == O ? 1 : z(x.md),
                            option: z(x.ld)
                        }
                    } : "set_checkout_option" == O && (T = {
                        action: "checkout_option",
                        Na: {
                            step: z(x.md),
                            option: z(x.ld)
                        }
                    });
                    T && (T.Ug = z(x.oa));
                    return T
                },
                p = {},
                t = function (r, w) {
                    var v = p[r];
                    p[r] = Ha(w);
                    if (!v) return !1;
                    for (var y in w)
                        if (w.hasOwnProperty(y) && w[y] !== v[y]) return !0;
                    for (var x in v)
                        if (v.hasOwnProperty(x) && v[x] !== w[x]) return !0;
                    return !1
                },
                q = function (r) {
                    var w = r.vtp_trackingId,
                        v = "https://www.google-analytics.com/analytics.js",
                        y = Zd();
                    if (ha(y)) {
                        var x = "gtag_" + w.split("-").join("_"),
                            z = function (O) {
                                var M = [].slice.call(arguments, 0);
                                M[0] = x + "." + M[0];
                                y.apply(window, M)
                            },
                            B = function () {
                                var O = function (P, S) {
                                        for (var X = 0; S && X < S.length; X++) z(P, S[X])
                                    },
                                    M = n(w);
                                if (M) {
                                    var I = M.action;
                                    if ("impressions" == I) O("ec:addImpression", M.Qf);
                                    else if ("promo_click" == I || "promo_view" == I) {
                                        var J = M.Ic;
                                        O("ec:addPromo", M.Ic);
                                        J && 0 < J.length && "promo_click" == I && z("ec:setAction",
                                            I)
                                    } else O("ec:addProduct", M.Ba), z("ec:setAction", I, M.Na)
                                }
                            },
                            C = function () {
                                if (Oe()) {} else {
                                    var O = qd(G.ze, w);
                                    O && (z("require", O, {
                                        dataLayer: "dataLayer"
                                    }), z("require", "render"))
                                }
                            },
                            E = function () {
                                if (Oe()) {} else {
                                    var O = qd(G.$b, w),
                                        M = qd(G.Zb, w),
                                        I = qd(G.Yb, w),
                                        J;
                                    J = ka(O) ? O : [O];
                                    for (var P = 0; P < J.length; P++) 5 >
                                        P && de(w, J[P], {
                                            Ed: I || M
                                        });
                                }
                            },
                            F = m(w, x, r.vtp_gtmOnSuccess);
                        (function () {})();
                        t(x, F.nc) && y(function () {
                            Xd() && Xd().remove(x)
                        });
                        y("create", w, F.nc);
                        (function () {
                            var O = qd("custom_map", w);
                            y(function () {
                                if (Ga(O)) {
                                    var M = F.Y,
                                        I = Xd().getByName(x),
                                        J;
                                    for (J in O)
                                        if (O.hasOwnProperty(J) && /^(dimension|metric)\d+$/.test(J) && void 0 != O[J]) {
                                            var P = I.get(k(O[J]));
                                            l(M, J, P)
                                        }
                                }
                            })
                        })();
                        (function (O) {
                            if (O) {
                                var M = {};
                                if (Ga(O))
                                    for (var I in e) e.hasOwnProperty(I) && h(e[I], I, O[I], M);
                                z("require", "linkid", M)
                            }
                        })(F.linkAttribution);
                        var Q = F[G.Ja];
                        if (Q && Q[G.I]) {
                            var W = Q[G.lb];
                            $d(x + ".", Q[G.I], void 0 === W ? !!Q.use_anchor : "fragment" === W, !!Q[G.kb])
                        }
                        var R = function (O, M, I) {
                                I && (M = "" + M);
                                F.Y[O] = M
                            },
                            T = Fc;
                        T == G.Pb ? (C(), z("send", "pageview", F.Y)) : T == G.ba ? (C(), E(), 0 != F.sendPageView && z("send", "pageview", F.Y)) : "screen_view" == T ? z("send", "screenview", F.Y) : "timing_complete" == T ? (R("timingCategory", F.eventCategory,
                            !0), R("timingVar", F.name, !0), R("timingValue", sa(F.value)), void 0 !== F.eventLabel && R("timingLabel", F.eventLabel, !0), z("send", "timing", F.Y)) : "exception" == T ? z("send", "exception", F.Y) : "optimize.callback" != T && (0 <= la("view_item_list select_content view_item add_to_cart remove_from_cart begin_checkout set_checkout_option purchase refund view_promotion checkout_progress".split(" "), T) && (z("require", "ec", "ec.js"), B()), R("eventCategory", F.eventCategory, !0), R("eventAction", F.eventAction || T, !0), void 0 !== F.eventLabel &&
                            R("eventLabel", F.eventLabel, !0), void 0 !== F.value && R("eventValue", sa(F.value)), z("send", "event", F.Y));
                        a || (a = !0, Sd(), H(v, function () {
                            Xd().loaded || r.vtp_gtmOnFailure()
                        }, r.vtp_gtmOnFailure))
                    } else A(r.vtp_gtmOnFailure)
                };
            Y.__gtagua = q;
            Y.__gtagua.g = "gtagua";
            Y.__gtagua.h = !0;
            Y.__gtagua.b = 0
        }();

    var Ej = {};
    Ej.macro = function (a) {
        if (Kf.fc.hasOwnProperty(a)) return Kf.fc[a]
    }, Ej.onHtmlSuccess = Kf.zd(!0), Ej.onHtmlFailure = Kf.zd(!1);
    Ej.dataLayer = md;
    Ej.callback = function (a) {
        Hc.hasOwnProperty(a) && ha(Hc[a]) && Hc[a]();
        delete Hc[a]
    };
    Ej.bf = function () {
        zc[yc.i] = Ej;
        za(Ic, Y.a);
        Wb = Wb || Kf;
        Xb = Bd
    };
    Ej.Rf = function () {
        Eg.gtm_3pds = !0;
        zc = f.google_tag_manager = f.google_tag_manager || {};
        if (zc[yc.i]) {
            var a = zc.zones;
            a && a.unregisterChild(yc.i)
        } else {
            for (var b = data.resource || {}, c = b.macros || [], d = 0; d < c.length; d++) Pb.push(c[d]);
            for (var e = b.tags || [], g = 0; g < e.length; g++) Sb.push(e[g]);
            for (var h = b.predicates || [],
                    k = 0; k < h.length; k++) Rb.push(h[k]);
            for (var l = b.rules || [], m = 0; m < l.length; m++) {
                for (var n = l[m], p = {}, t = 0; t < n.length; t++) p[n[t][0]] = Array.prototype.slice.call(n[t], 1);
                Qb.push(p)
            }
            Ub = Y;
            Vb = fi;
            Ej.bf();
            nf();
            Ed = !1;
            Fd = 0;
            if ("interactive" == u.readyState && !u.createEventObject || "complete" == u.readyState) Hd();
            else {
                Ra(u, "DOMContentLoaded", Hd);
                Ra(u, "readystatechange", Hd);
                if (u.createEventObject && u.documentElement.doScroll) {
                    var q = !0;
                    try {
                        q = !f.frameElement
                    } catch (y) {}
                    q && Id()
                }
                Ra(f, "load", Hd)
            }
            af = !1;
            "complete" === u.readyState ? cf() :
                Ra(f, "load", cf);
            a: {
                if (!bd) break a;f.setInterval(cd, 864E5);
            }
            Ec = (new Date).getTime();
        }
    };
    (0, Ej.Rf)();

})()
