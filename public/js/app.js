!function (e) {
	var t = {};

	function n(r) {
		if (t[r]) return t[r].exports;
		var i = t[r] = {i: r, l: !1, exports: {}};
		return e[r].call(i.exports, i, i.exports, n), i.l = !0, i.exports
	}

	n.m = e, n.c = t, n.d = function (e, t, r) {
		n.o(e, t) || Object.defineProperty(e, t, {configurable: !1, enumerable: !0, get: r})
	}, n.n = function (e) {
		var t = e && e.__esModule ? function () {
			return e.default
		} : function () {
			return e
		};
		return n.d(t, "a", t), t
	}, n.o = function (e, t) {
		return Object.prototype.hasOwnProperty.call(e, t)
	}, n.p = "/", n(n.s = 133)
}([function (e, t, n) {
	(function (e) {
		var t;
		t = function () {
			"use strict";
			var t, r;

			function i() {
				return t.apply(null, arguments)
			}

			function a(e) {
				return e instanceof Array || "[object Array]" === Object.prototype.toString.call(e)
			}

			function s(e) {
				return null != e && "[object Object]" === Object.prototype.toString.call(e)
			}

			function o(e) {
				return void 0 === e
			}

			function u(e) {
				return "number" == typeof e || "[object Number]" === Object.prototype.toString.call(e)
			}

			function d(e) {
				return e instanceof Date || "[object Date]" === Object.prototype.toString.call(e)
			}

			function l(e, t) {
				var n, r = [];
				for (n = 0; n < e.length; ++n) r.push(t(e[n], n));
				return r
			}

			function c(e, t) {
				return Object.prototype.hasOwnProperty.call(e, t)
			}

			function h(e, t) {
				for (var n in t) c(t, n) && (e[n] = t[n]);
				return c(t, "toString") && (e.toString = t.toString), c(t, "valueOf") && (e.valueOf = t.valueOf), e
			}

			function f(e, t, n, r) {
				return xt(e, t, n, r, !0).utc()
			}

			function _(e) {
				return null == e._pf && (e._pf = {
					empty: !1,
					unusedTokens: [],
					unusedInput: [],
					overflow: -2,
					charsLeftOver: 0,
					nullInput: !1,
					invalidMonth: null,
					invalidFormat: !1,
					userInvalidated: !1,
					iso: !1,
					parsedDateParts: [],
					meridiem: null,
					rfc2822: !1,
					weekdayMismatch: !1
				}), e._pf
			}

			function p(e) {
				if (null == e._isValid) {
					var t = _(e), n = r.call(t.parsedDateParts, function (e) {
							return null != e
						}),
						i = !isNaN(e._d.getTime()) && t.overflow < 0 && !t.empty && !t.invalidMonth && !t.invalidWeekday && !t.weekdayMismatch && !t.nullInput && !t.invalidFormat && !t.userInvalidated && (!t.meridiem || t.meridiem && n);
					if (e._strict && (i = i && 0 === t.charsLeftOver && 0 === t.unusedTokens.length && void 0 === t.bigHour), null != Object.isFrozen && Object.isFrozen(e)) return i;
					e._isValid = i
				}
				return e._isValid
			}

			function m(e) {
				var t = f(NaN);
				return null != e ? h(_(t), e) : _(t).userInvalidated = !0, t
			}

			r = Array.prototype.some ? Array.prototype.some : function (e) {
				for (var t = Object(this), n = t.length >>> 0, r = 0; r < n; r++) if (r in t && e.call(this, t[r], r, t)) return !0;
				return !1
			};
			var y = i.momentProperties = [];

			function g(e, t) {
				var n, r, i;
				if (o(t._isAMomentObject) || (e._isAMomentObject = t._isAMomentObject), o(t._i) || (e._i = t._i), o(t._f) || (e._f = t._f), o(t._l) || (e._l = t._l), o(t._strict) || (e._strict = t._strict), o(t._tzm) || (e._tzm = t._tzm), o(t._isUTC) || (e._isUTC = t._isUTC), o(t._offset) || (e._offset = t._offset), o(t._pf) || (e._pf = _(t)), o(t._locale) || (e._locale = t._locale), y.length > 0) for (n = 0; n < y.length; n++) o(i = t[r = y[n]]) || (e[r] = i);
				return e
			}

			var v = !1;

			function M(e) {
				g(this, e), this._d = new Date(null != e._d ? e._d.getTime() : NaN), this.isValid() || (this._d = new Date(NaN)), !1 === v && (v = !0, i.updateOffset(this), v = !1)
			}

			function L(e) {
				return e instanceof M || null != e && null != e._isAMomentObject
			}

			function w(e) {
				return e < 0 ? Math.ceil(e) || 0 : Math.floor(e)
			}

			function b(e) {
				var t = +e, n = 0;
				return 0 !== t && isFinite(t) && (n = w(t)), n
			}

			function Y(e, t, n) {
				var r, i = Math.min(e.length, t.length), a = Math.abs(e.length - t.length), s = 0;
				for (r = 0; r < i; r++) (n && e[r] !== t[r] || !n && b(e[r]) !== b(t[r])) && s++;
				return s + a
			}

			function k(e) {
				!1 === i.suppressDeprecationWarnings && "undefined" != typeof console && console.warn && console.warn("Deprecation warning: " + e)
			}

			function T(e, t) {
				var n = !0;
				return h(function () {
					if (null != i.deprecationHandler && i.deprecationHandler(null, e), n) {
						for (var r, a = [], s = 0; s < arguments.length; s++) {
							if (r = "", "object" == typeof arguments[s]) {
								for (var o in r += "\n[" + s + "] ", arguments[0]) r += o + ": " + arguments[0][o] + ", ";
								r = r.slice(0, -2)
							} else r = arguments[s];
							a.push(r)
						}
						k(e + "\nArguments: " + Array.prototype.slice.call(a).join("") + "\n" + (new Error).stack), n = !1
					}
					return t.apply(this, arguments)
				}, t)
			}

			var D, S = {};

			function x(e, t) {
				null != i.deprecationHandler && i.deprecationHandler(e, t), S[e] || (k(t), S[e] = !0)
			}

			function j(e) {
				return e instanceof Function || "[object Function]" === Object.prototype.toString.call(e)
			}

			function H(e, t) {
				var n, r = h({}, e);
				for (n in t) c(t, n) && (s(e[n]) && s(t[n]) ? (r[n] = {}, h(r[n], e[n]), h(r[n], t[n])) : null != t[n] ? r[n] = t[n] : delete r[n]);
				for (n in e) c(e, n) && !c(t, n) && s(e[n]) && (r[n] = h({}, r[n]));
				return r
			}

			function E(e) {
				null != e && this.set(e)
			}

			i.suppressDeprecationWarnings = !1, i.deprecationHandler = null, D = Object.keys ? Object.keys : function (e) {
				var t, n = [];
				for (t in e) c(e, t) && n.push(t);
				return n
			};
			var C = {};

			function A(e, t) {
				var n = e.toLowerCase();
				C[n] = C[n + "s"] = C[t] = e
			}

			function O(e) {
				return "string" == typeof e ? C[e] || C[e.toLowerCase()] : void 0
			}

			function P(e) {
				var t, n, r = {};
				for (n in e) c(e, n) && (t = O(n)) && (r[t] = e[n]);
				return r
			}

			var R = {};

			function W(e, t) {
				R[e] = t
			}

			function N(e, t, n) {
				var r = "" + Math.abs(e), i = t - r.length;
				return (e >= 0 ? n ? "+" : "" : "-") + Math.pow(10, Math.max(0, i)).toString().substr(1) + r
			}

			var I = /(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g,
				F = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g, z = {}, $ = {};

			function U(e, t, n, r) {
				var i = r;
				"string" == typeof r && (i = function () {
					return this[r]()
				}), e && ($[e] = i), t && ($[t[0]] = function () {
					return N(i.apply(this, arguments), t[1], t[2])
				}), n && ($[n] = function () {
					return this.localeData().ordinal(i.apply(this, arguments), e)
				})
			}

			function B(e, t) {
				return e.isValid() ? (t = q(t, e.localeData()), z[t] = z[t] || function (e) {
					var t, n, r, i = e.match(I);
					for (t = 0, n = i.length; t < n; t++) $[i[t]] ? i[t] = $[i[t]] : i[t] = (r = i[t]).match(/\[[\s\S]/) ? r.replace(/^\[|\]$/g, "") : r.replace(/\\/g, "");
					return function (t) {
						var r, a = "";
						for (r = 0; r < n; r++) a += j(i[r]) ? i[r].call(t, e) : i[r];
						return a
					}
				}(t), z[t](e)) : e.localeData().invalidDate()
			}

			function q(e, t) {
				var n = 5;

				function r(e) {
					return t.longDateFormat(e) || e
				}

				for (F.lastIndex = 0; n >= 0 && F.test(e);) e = e.replace(F, r), F.lastIndex = 0, n -= 1;
				return e
			}

			var J = /\d/, G = /\d\d/, V = /\d{3}/, K = /\d{4}/, X = /[+-]?\d{6}/, Z = /\d\d?/, Q = /\d\d\d\d?/,
				ee = /\d\d\d\d\d\d?/, te = /\d{1,3}/, ne = /\d{1,4}/, re = /[+-]?\d{1,6}/, ie = /\d+/, ae = /[+-]?\d+/,
				se = /Z|[+-]\d\d:?\d\d/gi, oe = /Z|[+-]\d\d(?::?\d\d)?/gi,
				ue = /[0-9]{0,256}['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFF07\uFF10-\uFFEF]{1,256}|[\u0600-\u06FF\/]{1,256}(\s*?[\u0600-\u06FF]{1,256}){1,2}/i,
				de = {};

			function le(e, t, n) {
				de[e] = j(t) ? t : function (e, r) {
					return e && n ? n : t
				}
			}

			function ce(e, t) {
				return c(de, e) ? de[e](t._strict, t._locale) : new RegExp(he(e.replace("\\", "").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function (e, t, n, r, i) {
					return t || n || r || i
				})))
			}

			function he(e) {
				return e.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&")
			}

			var fe = {};

			function _e(e, t) {
				var n, r = t;
				for ("string" == typeof e && (e = [e]), u(t) && (r = function (e, n) {
					n[t] = b(e)
				}), n = 0; n < e.length; n++) fe[e[n]] = r
			}

			function pe(e, t) {
				_e(e, function (e, n, r, i) {
					r._w = r._w || {}, t(e, r._w, r, i)
				})
			}

			function me(e, t, n) {
				null != t && c(fe, e) && fe[e](t, n._a, n, e)
			}

			var ye = 0, ge = 1, ve = 2, Me = 3, Le = 4, we = 5, be = 6, Ye = 7, ke = 8;

			function Te(e) {
				return De(e) ? 366 : 365
			}

			function De(e) {
				return e % 4 == 0 && e % 100 != 0 || e % 400 == 0
			}

			U("Y", 0, 0, function () {
				var e = this.year();
				return e <= 9999 ? "" + e : "+" + e
			}), U(0, ["YY", 2], 0, function () {
				return this.year() % 100
			}), U(0, ["YYYY", 4], 0, "year"), U(0, ["YYYYY", 5], 0, "year"), U(0, ["YYYYYY", 6, !0], 0, "year"), A("year", "y"), W("year", 1), le("Y", ae), le("YY", Z, G), le("YYYY", ne, K), le("YYYYY", re, X), le("YYYYYY", re, X), _e(["YYYYY", "YYYYYY"], ye), _e("YYYY", function (e, t) {
				t[ye] = 2 === e.length ? i.parseTwoDigitYear(e) : b(e)
			}), _e("YY", function (e, t) {
				t[ye] = i.parseTwoDigitYear(e)
			}), _e("Y", function (e, t) {
				t[ye] = parseInt(e, 10)
			}), i.parseTwoDigitYear = function (e) {
				return b(e) + (b(e) > 68 ? 1900 : 2e3)
			};
			var Se, xe = je("FullYear", !0);

			function je(e, t) {
				return function (n) {
					return null != n ? (Ee(this, e, n), i.updateOffset(this, t), this) : He(this, e)
				}
			}

			function He(e, t) {
				return e.isValid() ? e._d["get" + (e._isUTC ? "UTC" : "") + t]() : NaN
			}

			function Ee(e, t, n) {
				e.isValid() && !isNaN(n) && ("FullYear" === t && De(e.year()) && 1 === e.month() && 29 === e.date() ? e._d["set" + (e._isUTC ? "UTC" : "") + t](n, e.month(), Ce(n, e.month())) : e._d["set" + (e._isUTC ? "UTC" : "") + t](n))
			}

			function Ce(e, t) {
				if (isNaN(e) || isNaN(t)) return NaN;
				var n, r = (t % (n = 12) + n) % n;
				return e += (t - r) / 12, 1 === r ? De(e) ? 29 : 28 : 31 - r % 7 % 2
			}

			Se = Array.prototype.indexOf ? Array.prototype.indexOf : function (e) {
				var t;
				for (t = 0; t < this.length; ++t) if (this[t] === e) return t;
				return -1
			}, U("M", ["MM", 2], "Mo", function () {
				return this.month() + 1
			}), U("MMM", 0, 0, function (e) {
				return this.localeData().monthsShort(this, e)
			}), U("MMMM", 0, 0, function (e) {
				return this.localeData().months(this, e)
			}), A("month", "M"), W("month", 8), le("M", Z), le("MM", Z, G), le("MMM", function (e, t) {
				return t.monthsShortRegex(e)
			}), le("MMMM", function (e, t) {
				return t.monthsRegex(e)
			}), _e(["M", "MM"], function (e, t) {
				t[ge] = b(e) - 1
			}), _e(["MMM", "MMMM"], function (e, t, n, r) {
				var i = n._locale.monthsParse(e, r, n._strict);
				null != i ? t[ge] = i : _(n).invalidMonth = e
			});
			var Ae = /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/,
				Oe = "January_February_March_April_May_June_July_August_September_October_November_December".split("_");
			var Pe = "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_");

			function Re(e, t) {
				var n;
				if (!e.isValid()) return e;
				if ("string" == typeof t) if (/^\d+$/.test(t)) t = b(t); else if (!u(t = e.localeData().monthsParse(t))) return e;
				return n = Math.min(e.date(), Ce(e.year(), t)), e._d["set" + (e._isUTC ? "UTC" : "") + "Month"](t, n), e
			}

			function We(e) {
				return null != e ? (Re(this, e), i.updateOffset(this, !0), this) : He(this, "Month")
			}

			var Ne = ue;
			var Ie = ue;

			function Fe() {
				function e(e, t) {
					return t.length - e.length
				}

				var t, n, r = [], i = [], a = [];
				for (t = 0; t < 12; t++) n = f([2e3, t]), r.push(this.monthsShort(n, "")), i.push(this.months(n, "")), a.push(this.months(n, "")), a.push(this.monthsShort(n, ""));
				for (r.sort(e), i.sort(e), a.sort(e), t = 0; t < 12; t++) r[t] = he(r[t]), i[t] = he(i[t]);
				for (t = 0; t < 24; t++) a[t] = he(a[t]);
				this._monthsRegex = new RegExp("^(" + a.join("|") + ")", "i"), this._monthsShortRegex = this._monthsRegex, this._monthsStrictRegex = new RegExp("^(" + i.join("|") + ")", "i"), this._monthsShortStrictRegex = new RegExp("^(" + r.join("|") + ")", "i")
			}

			function ze(e) {
				var t = new Date(Date.UTC.apply(null, arguments));
				return e < 100 && e >= 0 && isFinite(t.getUTCFullYear()) && t.setUTCFullYear(e), t
			}

			function $e(e, t, n) {
				var r = 7 + t - n;
				return -((7 + ze(e, 0, r).getUTCDay() - t) % 7) + r - 1
			}

			function Ue(e, t, n, r, i) {
				var a, s, o = 1 + 7 * (t - 1) + (7 + n - r) % 7 + $e(e, r, i);
				return o <= 0 ? s = Te(a = e - 1) + o : o > Te(e) ? (a = e + 1, s = o - Te(e)) : (a = e, s = o), {
					year: a,
					dayOfYear: s
				}
			}

			function Be(e, t, n) {
				var r, i, a = $e(e.year(), t, n), s = Math.floor((e.dayOfYear() - a - 1) / 7) + 1;
				return s < 1 ? r = s + qe(i = e.year() - 1, t, n) : s > qe(e.year(), t, n) ? (r = s - qe(e.year(), t, n), i = e.year() + 1) : (i = e.year(), r = s), {
					week: r,
					year: i
				}
			}

			function qe(e, t, n) {
				var r = $e(e, t, n), i = $e(e + 1, t, n);
				return (Te(e) - r + i) / 7
			}

			U("w", ["ww", 2], "wo", "week"), U("W", ["WW", 2], "Wo", "isoWeek"), A("week", "w"), A("isoWeek", "W"), W("week", 5), W("isoWeek", 5), le("w", Z), le("ww", Z, G), le("W", Z), le("WW", Z, G), pe(["w", "ww", "W", "WW"], function (e, t, n, r) {
				t[r.substr(0, 1)] = b(e)
			});
			U("d", 0, "do", "day"), U("dd", 0, 0, function (e) {
				return this.localeData().weekdaysMin(this, e)
			}), U("ddd", 0, 0, function (e) {
				return this.localeData().weekdaysShort(this, e)
			}), U("dddd", 0, 0, function (e) {
				return this.localeData().weekdays(this, e)
			}), U("e", 0, 0, "weekday"), U("E", 0, 0, "isoWeekday"), A("day", "d"), A("weekday", "e"), A("isoWeekday", "E"), W("day", 11), W("weekday", 11), W("isoWeekday", 11), le("d", Z), le("e", Z), le("E", Z), le("dd", function (e, t) {
				return t.weekdaysMinRegex(e)
			}), le("ddd", function (e, t) {
				return t.weekdaysShortRegex(e)
			}), le("dddd", function (e, t) {
				return t.weekdaysRegex(e)
			}), pe(["dd", "ddd", "dddd"], function (e, t, n, r) {
				var i = n._locale.weekdaysParse(e, r, n._strict);
				null != i ? t.d = i : _(n).invalidWeekday = e
			}), pe(["d", "e", "E"], function (e, t, n, r) {
				t[r] = b(e)
			});
			var Je = "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_");
			var Ge = "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_");
			var Ve = "Su_Mo_Tu_We_Th_Fr_Sa".split("_");
			var Ke = ue;
			var Xe = ue;
			var Ze = ue;

			function Qe() {
				function e(e, t) {
					return t.length - e.length
				}

				var t, n, r, i, a, s = [], o = [], u = [], d = [];
				for (t = 0; t < 7; t++) n = f([2e3, 1]).day(t), r = this.weekdaysMin(n, ""), i = this.weekdaysShort(n, ""), a = this.weekdays(n, ""), s.push(r), o.push(i), u.push(a), d.push(r), d.push(i), d.push(a);
				for (s.sort(e), o.sort(e), u.sort(e), d.sort(e), t = 0; t < 7; t++) o[t] = he(o[t]), u[t] = he(u[t]), d[t] = he(d[t]);
				this._weekdaysRegex = new RegExp("^(" + d.join("|") + ")", "i"), this._weekdaysShortRegex = this._weekdaysRegex, this._weekdaysMinRegex = this._weekdaysRegex, this._weekdaysStrictRegex = new RegExp("^(" + u.join("|") + ")", "i"), this._weekdaysShortStrictRegex = new RegExp("^(" + o.join("|") + ")", "i"), this._weekdaysMinStrictRegex = new RegExp("^(" + s.join("|") + ")", "i")
			}

			function et() {
				return this.hours() % 12 || 12
			}

			function tt(e, t) {
				U(e, 0, 0, function () {
					return this.localeData().meridiem(this.hours(), this.minutes(), t)
				})
			}

			function nt(e, t) {
				return t._meridiemParse
			}

			U("H", ["HH", 2], 0, "hour"), U("h", ["hh", 2], 0, et), U("k", ["kk", 2], 0, function () {
				return this.hours() || 24
			}), U("hmm", 0, 0, function () {
				return "" + et.apply(this) + N(this.minutes(), 2)
			}), U("hmmss", 0, 0, function () {
				return "" + et.apply(this) + N(this.minutes(), 2) + N(this.seconds(), 2)
			}), U("Hmm", 0, 0, function () {
				return "" + this.hours() + N(this.minutes(), 2)
			}), U("Hmmss", 0, 0, function () {
				return "" + this.hours() + N(this.minutes(), 2) + N(this.seconds(), 2)
			}), tt("a", !0), tt("A", !1), A("hour", "h"), W("hour", 13), le("a", nt), le("A", nt), le("H", Z), le("h", Z), le("k", Z), le("HH", Z, G), le("hh", Z, G), le("kk", Z, G), le("hmm", Q), le("hmmss", ee), le("Hmm", Q), le("Hmmss", ee), _e(["H", "HH"], Me), _e(["k", "kk"], function (e, t, n) {
				var r = b(e);
				t[Me] = 24 === r ? 0 : r
			}), _e(["a", "A"], function (e, t, n) {
				n._isPm = n._locale.isPM(e), n._meridiem = e
			}), _e(["h", "hh"], function (e, t, n) {
				t[Me] = b(e), _(n).bigHour = !0
			}), _e("hmm", function (e, t, n) {
				var r = e.length - 2;
				t[Me] = b(e.substr(0, r)), t[Le] = b(e.substr(r)), _(n).bigHour = !0
			}), _e("hmmss", function (e, t, n) {
				var r = e.length - 4, i = e.length - 2;
				t[Me] = b(e.substr(0, r)), t[Le] = b(e.substr(r, 2)), t[we] = b(e.substr(i)), _(n).bigHour = !0
			}), _e("Hmm", function (e, t, n) {
				var r = e.length - 2;
				t[Me] = b(e.substr(0, r)), t[Le] = b(e.substr(r))
			}), _e("Hmmss", function (e, t, n) {
				var r = e.length - 4, i = e.length - 2;
				t[Me] = b(e.substr(0, r)), t[Le] = b(e.substr(r, 2)), t[we] = b(e.substr(i))
			});
			var rt, it = je("Hours", !0), at = {
				calendar: {
					sameDay: "[Today at] LT",
					nextDay: "[Tomorrow at] LT",
					nextWeek: "dddd [at] LT",
					lastDay: "[Yesterday at] LT",
					lastWeek: "[Last] dddd [at] LT",
					sameElse: "L"
				},
				longDateFormat: {
					LTS: "h:mm:ss A",
					LT: "h:mm A",
					L: "MM/DD/YYYY",
					LL: "MMMM D, YYYY",
					LLL: "MMMM D, YYYY h:mm A",
					LLLL: "dddd, MMMM D, YYYY h:mm A"
				},
				invalidDate: "Invalid date",
				ordinal: "%d",
				dayOfMonthOrdinalParse: /\d{1,2}/,
				relativeTime: {
					future: "in %s",
					past: "%s ago",
					s: "a few seconds",
					ss: "%d seconds",
					m: "a minute",
					mm: "%d minutes",
					h: "an hour",
					hh: "%d hours",
					d: "a day",
					dd: "%d days",
					M: "a month",
					MM: "%d months",
					y: "a year",
					yy: "%d years"
				},
				months: Oe,
				monthsShort: Pe,
				week: {dow: 0, doy: 6},
				weekdays: Je,
				weekdaysMin: Ve,
				weekdaysShort: Ge,
				meridiemParse: /[ap]\.?m?\.?/i
			}, st = {}, ot = {};

			function ut(e) {
				return e ? e.toLowerCase().replace("_", "-") : e
			}

			function dt(t) {
				var r = null;
				if (!st[t] && void 0 !== e && e && e.exports) try {
					r = rt._abbr;
					n(162)("./" + t), lt(r)
				} catch (e) {
				}
				return st[t]
			}

			function lt(e, t) {
				var n;
				return e && ((n = o(t) ? ht(e) : ct(e, t)) ? rt = n : "undefined" != typeof console && console.warn && console.warn("Locale " + e + " not found. Did you forget to load it?")), rt._abbr
			}

			function ct(e, t) {
				if (null !== t) {
					var n, r = at;
					if (t.abbr = e, null != st[e]) x("defineLocaleOverride", "use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."), r = st[e]._config; else if (null != t.parentLocale) if (null != st[t.parentLocale]) r = st[t.parentLocale]._config; else {
						if (null == (n = dt(t.parentLocale))) return ot[t.parentLocale] || (ot[t.parentLocale] = []), ot[t.parentLocale].push({
							name: e,
							config: t
						}), null;
						r = n._config
					}
					return st[e] = new E(H(r, t)), ot[e] && ot[e].forEach(function (e) {
						ct(e.name, e.config)
					}), lt(e), st[e]
				}
				return delete st[e], null
			}

			function ht(e) {
				var t;
				if (e && e._locale && e._locale._abbr && (e = e._locale._abbr), !e) return rt;
				if (!a(e)) {
					if (t = dt(e)) return t;
					e = [e]
				}
				return function (e) {
					for (var t, n, r, i, a = 0; a < e.length;) {
						for (t = (i = ut(e[a]).split("-")).length, n = (n = ut(e[a + 1])) ? n.split("-") : null; t > 0;) {
							if (r = dt(i.slice(0, t).join("-"))) return r;
							if (n && n.length >= t && Y(i, n, !0) >= t - 1) break;
							t--
						}
						a++
					}
					return rt
				}(e)
			}

			function ft(e) {
				var t, n = e._a;
				return n && -2 === _(e).overflow && (t = n[ge] < 0 || n[ge] > 11 ? ge : n[ve] < 1 || n[ve] > Ce(n[ye], n[ge]) ? ve : n[Me] < 0 || n[Me] > 24 || 24 === n[Me] && (0 !== n[Le] || 0 !== n[we] || 0 !== n[be]) ? Me : n[Le] < 0 || n[Le] > 59 ? Le : n[we] < 0 || n[we] > 59 ? we : n[be] < 0 || n[be] > 999 ? be : -1, _(e)._overflowDayOfYear && (t < ye || t > ve) && (t = ve), _(e)._overflowWeeks && -1 === t && (t = Ye), _(e)._overflowWeekday && -1 === t && (t = ke), _(e).overflow = t), e
			}

			function _t(e, t, n) {
				return null != e ? e : null != t ? t : n
			}

			function pt(e) {
				var t, n, r, a, s, o = [];
				if (!e._d) {
					for (r = function (e) {
						var t = new Date(i.now());
						return e._useUTC ? [t.getUTCFullYear(), t.getUTCMonth(), t.getUTCDate()] : [t.getFullYear(), t.getMonth(), t.getDate()]
					}(e), e._w && null == e._a[ve] && null == e._a[ge] && function (e) {
						var t, n, r, i, a, s, o, u;
						if (null != (t = e._w).GG || null != t.W || null != t.E) a = 1, s = 4, n = _t(t.GG, e._a[ye], Be(jt(), 1, 4).year), r = _t(t.W, 1), ((i = _t(t.E, 1)) < 1 || i > 7) && (u = !0); else {
							a = e._locale._week.dow, s = e._locale._week.doy;
							var d = Be(jt(), a, s);
							n = _t(t.gg, e._a[ye], d.year), r = _t(t.w, d.week), null != t.d ? ((i = t.d) < 0 || i > 6) && (u = !0) : null != t.e ? (i = t.e + a, (t.e < 0 || t.e > 6) && (u = !0)) : i = a
						}
						r < 1 || r > qe(n, a, s) ? _(e)._overflowWeeks = !0 : null != u ? _(e)._overflowWeekday = !0 : (o = Ue(n, r, i, a, s), e._a[ye] = o.year, e._dayOfYear = o.dayOfYear)
					}(e), null != e._dayOfYear && (s = _t(e._a[ye], r[ye]), (e._dayOfYear > Te(s) || 0 === e._dayOfYear) && (_(e)._overflowDayOfYear = !0), n = ze(s, 0, e._dayOfYear), e._a[ge] = n.getUTCMonth(), e._a[ve] = n.getUTCDate()), t = 0; t < 3 && null == e._a[t]; ++t) e._a[t] = o[t] = r[t];
					for (; t < 7; t++) e._a[t] = o[t] = null == e._a[t] ? 2 === t ? 1 : 0 : e._a[t];
					24 === e._a[Me] && 0 === e._a[Le] && 0 === e._a[we] && 0 === e._a[be] && (e._nextDay = !0, e._a[Me] = 0), e._d = (e._useUTC ? ze : function (e, t, n, r, i, a, s) {
						var o = new Date(e, t, n, r, i, a, s);
						return e < 100 && e >= 0 && isFinite(o.getFullYear()) && o.setFullYear(e), o
					}).apply(null, o), a = e._useUTC ? e._d.getUTCDay() : e._d.getDay(), null != e._tzm && e._d.setUTCMinutes(e._d.getUTCMinutes() - e._tzm), e._nextDay && (e._a[Me] = 24), e._w && void 0 !== e._w.d && e._w.d !== a && (_(e).weekdayMismatch = !0)
				}
			}

			var mt = /^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
				yt = /^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
				gt = /Z|[+-]\d\d(?::?\d\d)?/,
				vt = [["YYYYYY-MM-DD", /[+-]\d{6}-\d\d-\d\d/], ["YYYY-MM-DD", /\d{4}-\d\d-\d\d/], ["GGGG-[W]WW-E", /\d{4}-W\d\d-\d/], ["GGGG-[W]WW", /\d{4}-W\d\d/, !1], ["YYYY-DDD", /\d{4}-\d{3}/], ["YYYY-MM", /\d{4}-\d\d/, !1], ["YYYYYYMMDD", /[+-]\d{10}/], ["YYYYMMDD", /\d{8}/], ["GGGG[W]WWE", /\d{4}W\d{3}/], ["GGGG[W]WW", /\d{4}W\d{2}/, !1], ["YYYYDDD", /\d{7}/]],
				Mt = [["HH:mm:ss.SSSS", /\d\d:\d\d:\d\d\.\d+/], ["HH:mm:ss,SSSS", /\d\d:\d\d:\d\d,\d+/], ["HH:mm:ss", /\d\d:\d\d:\d\d/], ["HH:mm", /\d\d:\d\d/], ["HHmmss.SSSS", /\d\d\d\d\d\d\.\d+/], ["HHmmss,SSSS", /\d\d\d\d\d\d,\d+/], ["HHmmss", /\d\d\d\d\d\d/], ["HHmm", /\d\d\d\d/], ["HH", /\d\d/]],
				Lt = /^\/?Date\((\-?\d+)/i;

			function wt(e) {
				var t, n, r, i, a, s, o = e._i, u = mt.exec(o) || yt.exec(o);
				if (u) {
					for (_(e).iso = !0, t = 0, n = vt.length; t < n; t++) if (vt[t][1].exec(u[1])) {
						i = vt[t][0], r = !1 !== vt[t][2];
						break
					}
					if (null == i) return void(e._isValid = !1);
					if (u[3]) {
						for (t = 0, n = Mt.length; t < n; t++) if (Mt[t][1].exec(u[3])) {
							a = (u[2] || " ") + Mt[t][0];
							break
						}
						if (null == a) return void(e._isValid = !1)
					}
					if (!r && null != a) return void(e._isValid = !1);
					if (u[4]) {
						if (!gt.exec(u[4])) return void(e._isValid = !1);
						s = "Z"
					}
					e._f = i + (a || "") + (s || ""), Dt(e)
				} else e._isValid = !1
			}

			var bt = /^(?:(Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d{1,2})\s(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(\d{2,4})\s(\d\d):(\d\d)(?::(\d\d))?\s(?:(UT|GMT|[ECMP][SD]T)|([Zz])|([+-]\d{4}))$/;

			function Yt(e, t, n, r, i, a) {
				var s = [function (e) {
					var t = parseInt(e, 10);
					if (t <= 49) return 2e3 + t;
					if (t <= 999) return 1900 + t;
					return t
				}(e), Pe.indexOf(t), parseInt(n, 10), parseInt(r, 10), parseInt(i, 10)];
				return a && s.push(parseInt(a, 10)), s
			}

			var kt = {
				UT: 0,
				GMT: 0,
				EDT: -240,
				EST: -300,
				CDT: -300,
				CST: -360,
				MDT: -360,
				MST: -420,
				PDT: -420,
				PST: -480
			};

			function Tt(e) {
				var t = bt.exec(e._i.replace(/\([^)]*\)|[\n\t]/g, " ").replace(/(\s\s+)/g, " ").replace(/^\s\s*/, "").replace(/\s\s*$/, ""));
				if (t) {
					var n = Yt(t[4], t[3], t[2], t[5], t[6], t[7]);
					if (!function (e, t, n) {
						return !e || Ge.indexOf(e) === new Date(t[0], t[1], t[2]).getDay() || (_(n).weekdayMismatch = !0, n._isValid = !1, !1)
					}(t[1], n, e)) return;
					e._a = n, e._tzm = function (e, t, n) {
						if (e) return kt[e];
						if (t) return 0;
						var r = parseInt(n, 10), i = r % 100;
						return (r - i) / 100 * 60 + i
					}(t[8], t[9], t[10]), e._d = ze.apply(null, e._a), e._d.setUTCMinutes(e._d.getUTCMinutes() - e._tzm), _(e).rfc2822 = !0
				} else e._isValid = !1
			}

			function Dt(e) {
				if (e._f !== i.ISO_8601) if (e._f !== i.RFC_2822) {
					e._a = [], _(e).empty = !0;
					var t, n, r, a, s, o = "" + e._i, u = o.length, d = 0;
					for (r = q(e._f, e._locale).match(I) || [], t = 0; t < r.length; t++) a = r[t], (n = (o.match(ce(a, e)) || [])[0]) && ((s = o.substr(0, o.indexOf(n))).length > 0 && _(e).unusedInput.push(s), o = o.slice(o.indexOf(n) + n.length), d += n.length), $[a] ? (n ? _(e).empty = !1 : _(e).unusedTokens.push(a), me(a, n, e)) : e._strict && !n && _(e).unusedTokens.push(a);
					_(e).charsLeftOver = u - d, o.length > 0 && _(e).unusedInput.push(o), e._a[Me] <= 12 && !0 === _(e).bigHour && e._a[Me] > 0 && (_(e).bigHour = void 0), _(e).parsedDateParts = e._a.slice(0), _(e).meridiem = e._meridiem, e._a[Me] = function (e, t, n) {
						var r;
						if (null == n) return t;
						return null != e.meridiemHour ? e.meridiemHour(t, n) : null != e.isPM ? ((r = e.isPM(n)) && t < 12 && (t += 12), r || 12 !== t || (t = 0), t) : t
					}(e._locale, e._a[Me], e._meridiem), pt(e), ft(e)
				} else Tt(e); else wt(e)
			}

			function St(e) {
				var t = e._i, n = e._f;
				return e._locale = e._locale || ht(e._l), null === t || void 0 === n && "" === t ? m({nullInput: !0}) : ("string" == typeof t && (e._i = t = e._locale.preparse(t)), L(t) ? new M(ft(t)) : (d(t) ? e._d = t : a(n) ? function (e) {
					var t, n, r, i, a;
					if (0 === e._f.length) return _(e).invalidFormat = !0, void(e._d = new Date(NaN));
					for (i = 0; i < e._f.length; i++) a = 0, t = g({}, e), null != e._useUTC && (t._useUTC = e._useUTC), t._f = e._f[i], Dt(t), p(t) && (a += _(t).charsLeftOver, a += 10 * _(t).unusedTokens.length, _(t).score = a, (null == r || a < r) && (r = a, n = t));
					h(e, n || t)
				}(e) : n ? Dt(e) : function (e) {
					var t = e._i;
					o(t) ? e._d = new Date(i.now()) : d(t) ? e._d = new Date(t.valueOf()) : "string" == typeof t ? function (e) {
						var t = Lt.exec(e._i);
						null === t ? (wt(e), !1 === e._isValid && (delete e._isValid, Tt(e), !1 === e._isValid && (delete e._isValid, i.createFromInputFallback(e)))) : e._d = new Date(+t[1])
					}(e) : a(t) ? (e._a = l(t.slice(0), function (e) {
						return parseInt(e, 10)
					}), pt(e)) : s(t) ? function (e) {
						if (!e._d) {
							var t = P(e._i);
							e._a = l([t.year, t.month, t.day || t.date, t.hour, t.minute, t.second, t.millisecond], function (e) {
								return e && parseInt(e, 10)
							}), pt(e)
						}
					}(e) : u(t) ? e._d = new Date(t) : i.createFromInputFallback(e)
				}(e), p(e) || (e._d = null), e))
			}

			function xt(e, t, n, r, i) {
				var o, u = {};
				return !0 !== n && !1 !== n || (r = n, n = void 0), (s(e) && function (e) {
					if (Object.getOwnPropertyNames) return 0 === Object.getOwnPropertyNames(e).length;
					var t;
					for (t in e) if (e.hasOwnProperty(t)) return !1;
					return !0
				}(e) || a(e) && 0 === e.length) && (e = void 0), u._isAMomentObject = !0, u._useUTC = u._isUTC = i, u._l = n, u._i = e, u._f = t, u._strict = r, (o = new M(ft(St(u))))._nextDay && (o.add(1, "d"), o._nextDay = void 0), o
			}

			function jt(e, t, n, r) {
				return xt(e, t, n, r, !1)
			}

			i.createFromInputFallback = T("value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged and will be removed in an upcoming major release. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.", function (e) {
				e._d = new Date(e._i + (e._useUTC ? " UTC" : ""))
			}), i.ISO_8601 = function () {
			}, i.RFC_2822 = function () {
			};
			var Ht = T("moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/", function () {
					var e = jt.apply(null, arguments);
					return this.isValid() && e.isValid() ? e < this ? this : e : m()
				}),
				Et = T("moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/", function () {
					var e = jt.apply(null, arguments);
					return this.isValid() && e.isValid() ? e > this ? this : e : m()
				});

			function Ct(e, t) {
				var n, r;
				if (1 === t.length && a(t[0]) && (t = t[0]), !t.length) return jt();
				for (n = t[0], r = 1; r < t.length; ++r) t[r].isValid() && !t[r][e](n) || (n = t[r]);
				return n
			}

			var At = ["year", "quarter", "month", "week", "day", "hour", "minute", "second", "millisecond"];

			function Ot(e) {
				var t = P(e), n = t.year || 0, r = t.quarter || 0, i = t.month || 0, a = t.week || 0, s = t.day || 0,
					o = t.hour || 0, u = t.minute || 0, d = t.second || 0, l = t.millisecond || 0;
				this._isValid = function (e) {
					for (var t in e) if (-1 === Se.call(At, t) || null != e[t] && isNaN(e[t])) return !1;
					for (var n = !1, r = 0; r < At.length; ++r) if (e[At[r]]) {
						if (n) return !1;
						parseFloat(e[At[r]]) !== b(e[At[r]]) && (n = !0)
					}
					return !0
				}(t), this._milliseconds = +l + 1e3 * d + 6e4 * u + 1e3 * o * 60 * 60, this._days = +s + 7 * a, this._months = +i + 3 * r + 12 * n, this._data = {}, this._locale = ht(), this._bubble()
			}

			function Pt(e) {
				return e instanceof Ot
			}

			function Rt(e) {
				return e < 0 ? -1 * Math.round(-1 * e) : Math.round(e)
			}

			function Wt(e, t) {
				U(e, 0, 0, function () {
					var e = this.utcOffset(), n = "+";
					return e < 0 && (e = -e, n = "-"), n + N(~~(e / 60), 2) + t + N(~~e % 60, 2)
				})
			}

			Wt("Z", ":"), Wt("ZZ", ""), le("Z", oe), le("ZZ", oe), _e(["Z", "ZZ"], function (e, t, n) {
				n._useUTC = !0, n._tzm = It(oe, e)
			});
			var Nt = /([\+\-]|\d\d)/gi;

			function It(e, t) {
				var n = (t || "").match(e);
				if (null === n) return null;
				var r = ((n[n.length - 1] || []) + "").match(Nt) || ["-", 0, 0], i = 60 * r[1] + b(r[2]);
				return 0 === i ? 0 : "+" === r[0] ? i : -i
			}

			function Ft(e, t) {
				var n, r;
				return t._isUTC ? (n = t.clone(), r = (L(e) || d(e) ? e.valueOf() : jt(e).valueOf()) - n.valueOf(), n._d.setTime(n._d.valueOf() + r), i.updateOffset(n, !1), n) : jt(e).local()
			}

			function zt(e) {
				return 15 * -Math.round(e._d.getTimezoneOffset() / 15)
			}

			function $t() {
				return !!this.isValid() && (this._isUTC && 0 === this._offset)
			}

			i.updateOffset = function () {
			};
			var Ut = /^(\-|\+)?(?:(\d*)[. ])?(\d+)\:(\d+)(?:\:(\d+)(\.\d*)?)?$/,
				Bt = /^(-|\+)?P(?:([-+]?[0-9,.]*)Y)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)W)?(?:([-+]?[0-9,.]*)D)?(?:T(?:([-+]?[0-9,.]*)H)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)S)?)?$/;

			function qt(e, t) {
				var n, r, i, a = e, s = null;
				return Pt(e) ? a = {
					ms: e._milliseconds,
					d: e._days,
					M: e._months
				} : u(e) ? (a = {}, t ? a[t] = e : a.milliseconds = e) : (s = Ut.exec(e)) ? (n = "-" === s[1] ? -1 : 1, a = {
					y: 0,
					d: b(s[ve]) * n,
					h: b(s[Me]) * n,
					m: b(s[Le]) * n,
					s: b(s[we]) * n,
					ms: b(Rt(1e3 * s[be])) * n
				}) : (s = Bt.exec(e)) ? (n = "-" === s[1] ? -1 : (s[1], 1), a = {
					y: Jt(s[2], n),
					M: Jt(s[3], n),
					w: Jt(s[4], n),
					d: Jt(s[5], n),
					h: Jt(s[6], n),
					m: Jt(s[7], n),
					s: Jt(s[8], n)
				}) : null == a ? a = {} : "object" == typeof a && ("from" in a || "to" in a) && (i = function (e, t) {
					var n;
					if (!e.isValid() || !t.isValid()) return {milliseconds: 0, months: 0};
					t = Ft(t, e), e.isBefore(t) ? n = Gt(e, t) : ((n = Gt(t, e)).milliseconds = -n.milliseconds, n.months = -n.months);
					return n
				}(jt(a.from), jt(a.to)), (a = {}).ms = i.milliseconds, a.M = i.months), r = new Ot(a), Pt(e) && c(e, "_locale") && (r._locale = e._locale), r
			}

			function Jt(e, t) {
				var n = e && parseFloat(e.replace(",", "."));
				return (isNaN(n) ? 0 : n) * t
			}

			function Gt(e, t) {
				var n = {milliseconds: 0, months: 0};
				return n.months = t.month() - e.month() + 12 * (t.year() - e.year()), e.clone().add(n.months, "M").isAfter(t) && --n.months, n.milliseconds = +t - +e.clone().add(n.months, "M"), n
			}

			function Vt(e, t) {
				return function (n, r) {
					var i;
					return null === r || isNaN(+r) || (x(t, "moment()." + t + "(period, number) is deprecated. Please use moment()." + t + "(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."), i = n, n = r, r = i), Kt(this, qt(n = "string" == typeof n ? +n : n, r), e), this
				}
			}

			function Kt(e, t, n, r) {
				var a = t._milliseconds, s = Rt(t._days), o = Rt(t._months);
				e.isValid() && (r = null == r || r, o && Re(e, He(e, "Month") + o * n), s && Ee(e, "Date", He(e, "Date") + s * n), a && e._d.setTime(e._d.valueOf() + a * n), r && i.updateOffset(e, s || o))
			}

			qt.fn = Ot.prototype, qt.invalid = function () {
				return qt(NaN)
			};
			var Xt = Vt(1, "add"), Zt = Vt(-1, "subtract");

			function Qt(e, t) {
				var n = 12 * (t.year() - e.year()) + (t.month() - e.month()), r = e.clone().add(n, "months");
				return -(n + (t - r < 0 ? (t - r) / (r - e.clone().add(n - 1, "months")) : (t - r) / (e.clone().add(n + 1, "months") - r))) || 0
			}

			function en(e) {
				var t;
				return void 0 === e ? this._locale._abbr : (null != (t = ht(e)) && (this._locale = t), this)
			}

			i.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ", i.defaultFormatUtc = "YYYY-MM-DDTHH:mm:ss[Z]";
			var tn = T("moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.", function (e) {
				return void 0 === e ? this.localeData() : this.locale(e)
			});

			function nn() {
				return this._locale
			}

			function rn(e, t) {
				U(0, [e, e.length], 0, t)
			}

			function an(e, t, n, r, i) {
				var a;
				return null == e ? Be(this, r, i).year : (t > (a = qe(e, r, i)) && (t = a), function (e, t, n, r, i) {
					var a = Ue(e, t, n, r, i), s = ze(a.year, 0, a.dayOfYear);
					return this.year(s.getUTCFullYear()), this.month(s.getUTCMonth()), this.date(s.getUTCDate()), this
				}.call(this, e, t, n, r, i))
			}

			U(0, ["gg", 2], 0, function () {
				return this.weekYear() % 100
			}), U(0, ["GG", 2], 0, function () {
				return this.isoWeekYear() % 100
			}), rn("gggg", "weekYear"), rn("ggggg", "weekYear"), rn("GGGG", "isoWeekYear"), rn("GGGGG", "isoWeekYear"), A("weekYear", "gg"), A("isoWeekYear", "GG"), W("weekYear", 1), W("isoWeekYear", 1), le("G", ae), le("g", ae), le("GG", Z, G), le("gg", Z, G), le("GGGG", ne, K), le("gggg", ne, K), le("GGGGG", re, X), le("ggggg", re, X), pe(["gggg", "ggggg", "GGGG", "GGGGG"], function (e, t, n, r) {
				t[r.substr(0, 2)] = b(e)
			}), pe(["gg", "GG"], function (e, t, n, r) {
				t[r] = i.parseTwoDigitYear(e)
			}), U("Q", 0, "Qo", "quarter"), A("quarter", "Q"), W("quarter", 7), le("Q", J), _e("Q", function (e, t) {
				t[ge] = 3 * (b(e) - 1)
			}), U("D", ["DD", 2], "Do", "date"), A("date", "D"), W("date", 9), le("D", Z), le("DD", Z, G), le("Do", function (e, t) {
				return e ? t._dayOfMonthOrdinalParse || t._ordinalParse : t._dayOfMonthOrdinalParseLenient
			}), _e(["D", "DD"], ve), _e("Do", function (e, t) {
				t[ve] = b(e.match(Z)[0])
			});
			var sn = je("Date", !0);
			U("DDD", ["DDDD", 3], "DDDo", "dayOfYear"), A("dayOfYear", "DDD"), W("dayOfYear", 4), le("DDD", te), le("DDDD", V), _e(["DDD", "DDDD"], function (e, t, n) {
				n._dayOfYear = b(e)
			}), U("m", ["mm", 2], 0, "minute"), A("minute", "m"), W("minute", 14), le("m", Z), le("mm", Z, G), _e(["m", "mm"], Le);
			var on = je("Minutes", !1);
			U("s", ["ss", 2], 0, "second"), A("second", "s"), W("second", 15), le("s", Z), le("ss", Z, G), _e(["s", "ss"], we);
			var un, dn = je("Seconds", !1);
			for (U("S", 0, 0, function () {
				return ~~(this.millisecond() / 100)
			}), U(0, ["SS", 2], 0, function () {
				return ~~(this.millisecond() / 10)
			}), U(0, ["SSS", 3], 0, "millisecond"), U(0, ["SSSS", 4], 0, function () {
				return 10 * this.millisecond()
			}), U(0, ["SSSSS", 5], 0, function () {
				return 100 * this.millisecond()
			}), U(0, ["SSSSSS", 6], 0, function () {
				return 1e3 * this.millisecond()
			}), U(0, ["SSSSSSS", 7], 0, function () {
				return 1e4 * this.millisecond()
			}), U(0, ["SSSSSSSS", 8], 0, function () {
				return 1e5 * this.millisecond()
			}), U(0, ["SSSSSSSSS", 9], 0, function () {
				return 1e6 * this.millisecond()
			}), A("millisecond", "ms"), W("millisecond", 16), le("S", te, J), le("SS", te, G), le("SSS", te, V), un = "SSSS"; un.length <= 9; un += "S") le(un, ie);

			function ln(e, t) {
				t[be] = b(1e3 * ("0." + e))
			}

			for (un = "S"; un.length <= 9; un += "S") _e(un, ln);
			var cn = je("Milliseconds", !1);
			U("z", 0, 0, "zoneAbbr"), U("zz", 0, 0, "zoneName");
			var hn = M.prototype;

			function fn(e) {
				return e
			}

			hn.add = Xt, hn.calendar = function (e, t) {
				var n = e || jt(), r = Ft(n, this).startOf("day"), a = i.calendarFormat(this, r) || "sameElse",
					s = t && (j(t[a]) ? t[a].call(this, n) : t[a]);
				return this.format(s || this.localeData().calendar(a, this, jt(n)))
			}, hn.clone = function () {
				return new M(this)
			}, hn.diff = function (e, t, n) {
				var r, i, a;
				if (!this.isValid()) return NaN;
				if (!(r = Ft(e, this)).isValid()) return NaN;
				switch (i = 6e4 * (r.utcOffset() - this.utcOffset()), t = O(t)) {
					case"year":
						a = Qt(this, r) / 12;
						break;
					case"month":
						a = Qt(this, r);
						break;
					case"quarter":
						a = Qt(this, r) / 3;
						break;
					case"second":
						a = (this - r) / 1e3;
						break;
					case"minute":
						a = (this - r) / 6e4;
						break;
					case"hour":
						a = (this - r) / 36e5;
						break;
					case"day":
						a = (this - r - i) / 864e5;
						break;
					case"week":
						a = (this - r - i) / 6048e5;
						break;
					default:
						a = this - r
				}
				return n ? a : w(a)
			}, hn.endOf = function (e) {
				return void 0 === (e = O(e)) || "millisecond" === e ? this : ("date" === e && (e = "day"), this.startOf(e).add(1, "isoWeek" === e ? "week" : e).subtract(1, "ms"))
			}, hn.format = function (e) {
				e || (e = this.isUtc() ? i.defaultFormatUtc : i.defaultFormat);
				var t = B(this, e);
				return this.localeData().postformat(t)
			}, hn.from = function (e, t) {
				return this.isValid() && (L(e) && e.isValid() || jt(e).isValid()) ? qt({
					to: this,
					from: e
				}).locale(this.locale()).humanize(!t) : this.localeData().invalidDate()
			}, hn.fromNow = function (e) {
				return this.from(jt(), e)
			}, hn.to = function (e, t) {
				return this.isValid() && (L(e) && e.isValid() || jt(e).isValid()) ? qt({
					from: this,
					to: e
				}).locale(this.locale()).humanize(!t) : this.localeData().invalidDate()
			}, hn.toNow = function (e) {
				return this.to(jt(), e)
			}, hn.get = function (e) {
				return j(this[e = O(e)]) ? this[e]() : this
			}, hn.invalidAt = function () {
				return _(this).overflow
			}, hn.isAfter = function (e, t) {
				var n = L(e) ? e : jt(e);
				return !(!this.isValid() || !n.isValid()) && ("millisecond" === (t = O(o(t) ? "millisecond" : t)) ? this.valueOf() > n.valueOf() : n.valueOf() < this.clone().startOf(t).valueOf())
			}, hn.isBefore = function (e, t) {
				var n = L(e) ? e : jt(e);
				return !(!this.isValid() || !n.isValid()) && ("millisecond" === (t = O(o(t) ? "millisecond" : t)) ? this.valueOf() < n.valueOf() : this.clone().endOf(t).valueOf() < n.valueOf())
			}, hn.isBetween = function (e, t, n, r) {
				return ("(" === (r = r || "()")[0] ? this.isAfter(e, n) : !this.isBefore(e, n)) && (")" === r[1] ? this.isBefore(t, n) : !this.isAfter(t, n))
			}, hn.isSame = function (e, t) {
				var n, r = L(e) ? e : jt(e);
				return !(!this.isValid() || !r.isValid()) && ("millisecond" === (t = O(t || "millisecond")) ? this.valueOf() === r.valueOf() : (n = r.valueOf(), this.clone().startOf(t).valueOf() <= n && n <= this.clone().endOf(t).valueOf()))
			}, hn.isSameOrAfter = function (e, t) {
				return this.isSame(e, t) || this.isAfter(e, t)
			}, hn.isSameOrBefore = function (e, t) {
				return this.isSame(e, t) || this.isBefore(e, t)
			}, hn.isValid = function () {
				return p(this)
			}, hn.lang = tn, hn.locale = en, hn.localeData = nn, hn.max = Et, hn.min = Ht, hn.parsingFlags = function () {
				return h({}, _(this))
			}, hn.set = function (e, t) {
				if ("object" == typeof e) for (var n = function (e) {
					var t = [];
					for (var n in e) t.push({unit: n, priority: R[n]});
					return t.sort(function (e, t) {
						return e.priority - t.priority
					}), t
				}(e = P(e)), r = 0; r < n.length; r++) this[n[r].unit](e[n[r].unit]); else if (j(this[e = O(e)])) return this[e](t);
				return this
			}, hn.startOf = function (e) {
				switch (e = O(e)) {
					case"year":
						this.month(0);
					case"quarter":
					case"month":
						this.date(1);
					case"week":
					case"isoWeek":
					case"day":
					case"date":
						this.hours(0);
					case"hour":
						this.minutes(0);
					case"minute":
						this.seconds(0);
					case"second":
						this.milliseconds(0)
				}
				return "week" === e && this.weekday(0), "isoWeek" === e && this.isoWeekday(1), "quarter" === e && this.month(3 * Math.floor(this.month() / 3)), this
			}, hn.subtract = Zt, hn.toArray = function () {
				var e = this;
				return [e.year(), e.month(), e.date(), e.hour(), e.minute(), e.second(), e.millisecond()]
			}, hn.toObject = function () {
				var e = this;
				return {
					years: e.year(),
					months: e.month(),
					date: e.date(),
					hours: e.hours(),
					minutes: e.minutes(),
					seconds: e.seconds(),
					milliseconds: e.milliseconds()
				}
			}, hn.toDate = function () {
				return new Date(this.valueOf())
			}, hn.toISOString = function (e) {
				if (!this.isValid()) return null;
				var t = !0 !== e, n = t ? this.clone().utc() : this;
				return n.year() < 0 || n.year() > 9999 ? B(n, t ? "YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]" : "YYYYYY-MM-DD[T]HH:mm:ss.SSSZ") : j(Date.prototype.toISOString) ? t ? this.toDate().toISOString() : new Date(this.valueOf() + 60 * this.utcOffset() * 1e3).toISOString().replace("Z", B(n, "Z")) : B(n, t ? "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]" : "YYYY-MM-DD[T]HH:mm:ss.SSSZ")
			}, hn.inspect = function () {
				if (!this.isValid()) return "moment.invalid(/* " + this._i + " */)";
				var e = "moment", t = "";
				this.isLocal() || (e = 0 === this.utcOffset() ? "moment.utc" : "moment.parseZone", t = "Z");
				var n = "[" + e + '("]', r = 0 <= this.year() && this.year() <= 9999 ? "YYYY" : "YYYYYY",
					i = t + '[")]';
				return this.format(n + r + "-MM-DD[T]HH:mm:ss.SSS" + i)
			}, hn.toJSON = function () {
				return this.isValid() ? this.toISOString() : null
			}, hn.toString = function () {
				return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")
			}, hn.unix = function () {
				return Math.floor(this.valueOf() / 1e3)
			}, hn.valueOf = function () {
				return this._d.valueOf() - 6e4 * (this._offset || 0)
			}, hn.creationData = function () {
				return {input: this._i, format: this._f, locale: this._locale, isUTC: this._isUTC, strict: this._strict}
			}, hn.year = xe, hn.isLeapYear = function () {
				return De(this.year())
			}, hn.weekYear = function (e) {
				return an.call(this, e, this.week(), this.weekday(), this.localeData()._week.dow, this.localeData()._week.doy)
			}, hn.isoWeekYear = function (e) {
				return an.call(this, e, this.isoWeek(), this.isoWeekday(), 1, 4)
			}, hn.quarter = hn.quarters = function (e) {
				return null == e ? Math.ceil((this.month() + 1) / 3) : this.month(3 * (e - 1) + this.month() % 3)
			}, hn.month = We, hn.daysInMonth = function () {
				return Ce(this.year(), this.month())
			}, hn.week = hn.weeks = function (e) {
				var t = this.localeData().week(this);
				return null == e ? t : this.add(7 * (e - t), "d")
			}, hn.isoWeek = hn.isoWeeks = function (e) {
				var t = Be(this, 1, 4).week;
				return null == e ? t : this.add(7 * (e - t), "d")
			}, hn.weeksInYear = function () {
				var e = this.localeData()._week;
				return qe(this.year(), e.dow, e.doy)
			}, hn.isoWeeksInYear = function () {
				return qe(this.year(), 1, 4)
			}, hn.date = sn, hn.day = hn.days = function (e) {
				if (!this.isValid()) return null != e ? this : NaN;
				var t = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
				return null != e ? (e = function (e, t) {
					return "string" != typeof e ? e : isNaN(e) ? "number" == typeof(e = t.weekdaysParse(e)) ? e : null : parseInt(e, 10)
				}(e, this.localeData()), this.add(e - t, "d")) : t
			}, hn.weekday = function (e) {
				if (!this.isValid()) return null != e ? this : NaN;
				var t = (this.day() + 7 - this.localeData()._week.dow) % 7;
				return null == e ? t : this.add(e - t, "d")
			}, hn.isoWeekday = function (e) {
				if (!this.isValid()) return null != e ? this : NaN;
				if (null != e) {
					var t = function (e, t) {
						return "string" == typeof e ? t.weekdaysParse(e) % 7 || 7 : isNaN(e) ? null : e
					}(e, this.localeData());
					return this.day(this.day() % 7 ? t : t - 7)
				}
				return this.day() || 7
			}, hn.dayOfYear = function (e) {
				var t = Math.round((this.clone().startOf("day") - this.clone().startOf("year")) / 864e5) + 1;
				return null == e ? t : this.add(e - t, "d")
			}, hn.hour = hn.hours = it, hn.minute = hn.minutes = on, hn.second = hn.seconds = dn, hn.millisecond = hn.milliseconds = cn, hn.utcOffset = function (e, t, n) {
				var r, a = this._offset || 0;
				if (!this.isValid()) return null != e ? this : NaN;
				if (null != e) {
					if ("string" == typeof e) {
						if (null === (e = It(oe, e))) return this
					} else Math.abs(e) < 16 && !n && (e *= 60);
					return !this._isUTC && t && (r = zt(this)), this._offset = e, this._isUTC = !0, null != r && this.add(r, "m"), a !== e && (!t || this._changeInProgress ? Kt(this, qt(e - a, "m"), 1, !1) : this._changeInProgress || (this._changeInProgress = !0, i.updateOffset(this, !0), this._changeInProgress = null)), this
				}
				return this._isUTC ? a : zt(this)
			}, hn.utc = function (e) {
				return this.utcOffset(0, e)
			}, hn.local = function (e) {
				return this._isUTC && (this.utcOffset(0, e), this._isUTC = !1, e && this.subtract(zt(this), "m")), this
			}, hn.parseZone = function () {
				if (null != this._tzm) this.utcOffset(this._tzm, !1, !0); else if ("string" == typeof this._i) {
					var e = It(se, this._i);
					null != e ? this.utcOffset(e) : this.utcOffset(0, !0)
				}
				return this
			}, hn.hasAlignedHourOffset = function (e) {
				return !!this.isValid() && (e = e ? jt(e).utcOffset() : 0, (this.utcOffset() - e) % 60 == 0)
			}, hn.isDST = function () {
				return this.utcOffset() > this.clone().month(0).utcOffset() || this.utcOffset() > this.clone().month(5).utcOffset()
			}, hn.isLocal = function () {
				return !!this.isValid() && !this._isUTC
			}, hn.isUtcOffset = function () {
				return !!this.isValid() && this._isUTC
			}, hn.isUtc = $t, hn.isUTC = $t, hn.zoneAbbr = function () {
				return this._isUTC ? "UTC" : ""
			}, hn.zoneName = function () {
				return this._isUTC ? "Coordinated Universal Time" : ""
			}, hn.dates = T("dates accessor is deprecated. Use date instead.", sn), hn.months = T("months accessor is deprecated. Use month instead", We), hn.years = T("years accessor is deprecated. Use year instead", xe), hn.zone = T("moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/", function (e, t) {
				return null != e ? ("string" != typeof e && (e = -e), this.utcOffset(e, t), this) : -this.utcOffset()
			}), hn.isDSTShifted = T("isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information", function () {
				if (!o(this._isDSTShifted)) return this._isDSTShifted;
				var e = {};
				if (g(e, this), (e = St(e))._a) {
					var t = e._isUTC ? f(e._a) : jt(e._a);
					this._isDSTShifted = this.isValid() && Y(e._a, t.toArray()) > 0
				} else this._isDSTShifted = !1;
				return this._isDSTShifted
			});
			var _n = E.prototype;

			function pn(e, t, n, r) {
				var i = ht(), a = f().set(r, t);
				return i[n](a, e)
			}

			function mn(e, t, n) {
				if (u(e) && (t = e, e = void 0), e = e || "", null != t) return pn(e, t, n, "month");
				var r, i = [];
				for (r = 0; r < 12; r++) i[r] = pn(e, r, n, "month");
				return i
			}

			function yn(e, t, n, r) {
				"boolean" == typeof e ? (u(t) && (n = t, t = void 0), t = t || "") : (n = t = e, e = !1, u(t) && (n = t, t = void 0), t = t || "");
				var i, a = ht(), s = e ? a._week.dow : 0;
				if (null != n) return pn(t, (n + s) % 7, r, "day");
				var o = [];
				for (i = 0; i < 7; i++) o[i] = pn(t, (i + s) % 7, r, "day");
				return o
			}

			_n.calendar = function (e, t, n) {
				var r = this._calendar[e] || this._calendar.sameElse;
				return j(r) ? r.call(t, n) : r
			}, _n.longDateFormat = function (e) {
				var t = this._longDateFormat[e], n = this._longDateFormat[e.toUpperCase()];
				return t || !n ? t : (this._longDateFormat[e] = n.replace(/MMMM|MM|DD|dddd/g, function (e) {
					return e.slice(1)
				}), this._longDateFormat[e])
			}, _n.invalidDate = function () {
				return this._invalidDate
			}, _n.ordinal = function (e) {
				return this._ordinal.replace("%d", e)
			}, _n.preparse = fn, _n.postformat = fn, _n.relativeTime = function (e, t, n, r) {
				var i = this._relativeTime[n];
				return j(i) ? i(e, t, n, r) : i.replace(/%d/i, e)
			}, _n.pastFuture = function (e, t) {
				var n = this._relativeTime[e > 0 ? "future" : "past"];
				return j(n) ? n(t) : n.replace(/%s/i, t)
			}, _n.set = function (e) {
				var t, n;
				for (n in e) j(t = e[n]) ? this[n] = t : this["_" + n] = t;
				this._config = e, this._dayOfMonthOrdinalParseLenient = new RegExp((this._dayOfMonthOrdinalParse.source || this._ordinalParse.source) + "|" + /\d{1,2}/.source)
			}, _n.months = function (e, t) {
				return e ? a(this._months) ? this._months[e.month()] : this._months[(this._months.isFormat || Ae).test(t) ? "format" : "standalone"][e.month()] : a(this._months) ? this._months : this._months.standalone
			}, _n.monthsShort = function (e, t) {
				return e ? a(this._monthsShort) ? this._monthsShort[e.month()] : this._monthsShort[Ae.test(t) ? "format" : "standalone"][e.month()] : a(this._monthsShort) ? this._monthsShort : this._monthsShort.standalone
			}, _n.monthsParse = function (e, t, n) {
				var r, i, a;
				if (this._monthsParseExact) return function (e, t, n) {
					var r, i, a, s = e.toLocaleLowerCase();
					if (!this._monthsParse) for (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = [], r = 0; r < 12; ++r) a = f([2e3, r]), this._shortMonthsParse[r] = this.monthsShort(a, "").toLocaleLowerCase(), this._longMonthsParse[r] = this.months(a, "").toLocaleLowerCase();
					return n ? "MMM" === t ? -1 !== (i = Se.call(this._shortMonthsParse, s)) ? i : null : -1 !== (i = Se.call(this._longMonthsParse, s)) ? i : null : "MMM" === t ? -1 !== (i = Se.call(this._shortMonthsParse, s)) ? i : -1 !== (i = Se.call(this._longMonthsParse, s)) ? i : null : -1 !== (i = Se.call(this._longMonthsParse, s)) ? i : -1 !== (i = Se.call(this._shortMonthsParse, s)) ? i : null
				}.call(this, e, t, n);
				for (this._monthsParse || (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = []), r = 0; r < 12; r++) {
					if (i = f([2e3, r]), n && !this._longMonthsParse[r] && (this._longMonthsParse[r] = new RegExp("^" + this.months(i, "").replace(".", "") + "$", "i"), this._shortMonthsParse[r] = new RegExp("^" + this.monthsShort(i, "").replace(".", "") + "$", "i")), n || this._monthsParse[r] || (a = "^" + this.months(i, "") + "|^" + this.monthsShort(i, ""), this._monthsParse[r] = new RegExp(a.replace(".", ""), "i")), n && "MMMM" === t && this._longMonthsParse[r].test(e)) return r;
					if (n && "MMM" === t && this._shortMonthsParse[r].test(e)) return r;
					if (!n && this._monthsParse[r].test(e)) return r
				}
			}, _n.monthsRegex = function (e) {
				return this._monthsParseExact ? (c(this, "_monthsRegex") || Fe.call(this), e ? this._monthsStrictRegex : this._monthsRegex) : (c(this, "_monthsRegex") || (this._monthsRegex = Ie), this._monthsStrictRegex && e ? this._monthsStrictRegex : this._monthsRegex)
			}, _n.monthsShortRegex = function (e) {
				return this._monthsParseExact ? (c(this, "_monthsRegex") || Fe.call(this), e ? this._monthsShortStrictRegex : this._monthsShortRegex) : (c(this, "_monthsShortRegex") || (this._monthsShortRegex = Ne), this._monthsShortStrictRegex && e ? this._monthsShortStrictRegex : this._monthsShortRegex)
			}, _n.week = function (e) {
				return Be(e, this._week.dow, this._week.doy).week
			}, _n.firstDayOfYear = function () {
				return this._week.doy
			}, _n.firstDayOfWeek = function () {
				return this._week.dow
			}, _n.weekdays = function (e, t) {
				return e ? a(this._weekdays) ? this._weekdays[e.day()] : this._weekdays[this._weekdays.isFormat.test(t) ? "format" : "standalone"][e.day()] : a(this._weekdays) ? this._weekdays : this._weekdays.standalone
			}, _n.weekdaysMin = function (e) {
				return e ? this._weekdaysMin[e.day()] : this._weekdaysMin
			}, _n.weekdaysShort = function (e) {
				return e ? this._weekdaysShort[e.day()] : this._weekdaysShort
			}, _n.weekdaysParse = function (e, t, n) {
				var r, i, a;
				if (this._weekdaysParseExact) return function (e, t, n) {
					var r, i, a, s = e.toLocaleLowerCase();
					if (!this._weekdaysParse) for (this._weekdaysParse = [], this._shortWeekdaysParse = [], this._minWeekdaysParse = [], r = 0; r < 7; ++r) a = f([2e3, 1]).day(r), this._minWeekdaysParse[r] = this.weekdaysMin(a, "").toLocaleLowerCase(), this._shortWeekdaysParse[r] = this.weekdaysShort(a, "").toLocaleLowerCase(), this._weekdaysParse[r] = this.weekdays(a, "").toLocaleLowerCase();
					return n ? "dddd" === t ? -1 !== (i = Se.call(this._weekdaysParse, s)) ? i : null : "ddd" === t ? -1 !== (i = Se.call(this._shortWeekdaysParse, s)) ? i : null : -1 !== (i = Se.call(this._minWeekdaysParse, s)) ? i : null : "dddd" === t ? -1 !== (i = Se.call(this._weekdaysParse, s)) ? i : -1 !== (i = Se.call(this._shortWeekdaysParse, s)) ? i : -1 !== (i = Se.call(this._minWeekdaysParse, s)) ? i : null : "ddd" === t ? -1 !== (i = Se.call(this._shortWeekdaysParse, s)) ? i : -1 !== (i = Se.call(this._weekdaysParse, s)) ? i : -1 !== (i = Se.call(this._minWeekdaysParse, s)) ? i : null : -1 !== (i = Se.call(this._minWeekdaysParse, s)) ? i : -1 !== (i = Se.call(this._weekdaysParse, s)) ? i : -1 !== (i = Se.call(this._shortWeekdaysParse, s)) ? i : null
				}.call(this, e, t, n);
				for (this._weekdaysParse || (this._weekdaysParse = [], this._minWeekdaysParse = [], this._shortWeekdaysParse = [], this._fullWeekdaysParse = []), r = 0; r < 7; r++) {
					if (i = f([2e3, 1]).day(r), n && !this._fullWeekdaysParse[r] && (this._fullWeekdaysParse[r] = new RegExp("^" + this.weekdays(i, "").replace(".", "\\.?") + "$", "i"), this._shortWeekdaysParse[r] = new RegExp("^" + this.weekdaysShort(i, "").replace(".", "\\.?") + "$", "i"), this._minWeekdaysParse[r] = new RegExp("^" + this.weekdaysMin(i, "").replace(".", "\\.?") + "$", "i")), this._weekdaysParse[r] || (a = "^" + this.weekdays(i, "") + "|^" + this.weekdaysShort(i, "") + "|^" + this.weekdaysMin(i, ""), this._weekdaysParse[r] = new RegExp(a.replace(".", ""), "i")), n && "dddd" === t && this._fullWeekdaysParse[r].test(e)) return r;
					if (n && "ddd" === t && this._shortWeekdaysParse[r].test(e)) return r;
					if (n && "dd" === t && this._minWeekdaysParse[r].test(e)) return r;
					if (!n && this._weekdaysParse[r].test(e)) return r
				}
			}, _n.weekdaysRegex = function (e) {
				return this._weekdaysParseExact ? (c(this, "_weekdaysRegex") || Qe.call(this), e ? this._weekdaysStrictRegex : this._weekdaysRegex) : (c(this, "_weekdaysRegex") || (this._weekdaysRegex = Ke), this._weekdaysStrictRegex && e ? this._weekdaysStrictRegex : this._weekdaysRegex)
			}, _n.weekdaysShortRegex = function (e) {
				return this._weekdaysParseExact ? (c(this, "_weekdaysRegex") || Qe.call(this), e ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex) : (c(this, "_weekdaysShortRegex") || (this._weekdaysShortRegex = Xe), this._weekdaysShortStrictRegex && e ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex)
			}, _n.weekdaysMinRegex = function (e) {
				return this._weekdaysParseExact ? (c(this, "_weekdaysRegex") || Qe.call(this), e ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex) : (c(this, "_weekdaysMinRegex") || (this._weekdaysMinRegex = Ze), this._weekdaysMinStrictRegex && e ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex)
			}, _n.isPM = function (e) {
				return "p" === (e + "").toLowerCase().charAt(0)
			}, _n.meridiem = function (e, t, n) {
				return e > 11 ? n ? "pm" : "PM" : n ? "am" : "AM"
			}, lt("en", {
				dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/, ordinal: function (e) {
					var t = e % 10;
					return e + (1 === b(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
				}
			}), i.lang = T("moment.lang is deprecated. Use moment.locale instead.", lt), i.langData = T("moment.langData is deprecated. Use moment.localeData instead.", ht);
			var gn = Math.abs;

			function vn(e, t, n, r) {
				var i = qt(t, n);
				return e._milliseconds += r * i._milliseconds, e._days += r * i._days, e._months += r * i._months, e._bubble()
			}

			function Mn(e) {
				return e < 0 ? Math.floor(e) : Math.ceil(e)
			}

			function Ln(e) {
				return 4800 * e / 146097
			}

			function wn(e) {
				return 146097 * e / 4800
			}

			function bn(e) {
				return function () {
					return this.as(e)
				}
			}

			var Yn = bn("ms"), kn = bn("s"), Tn = bn("m"), Dn = bn("h"), Sn = bn("d"), xn = bn("w"), jn = bn("M"),
				Hn = bn("y");

			function En(e) {
				return function () {
					return this.isValid() ? this._data[e] : NaN
				}
			}

			var Cn = En("milliseconds"), An = En("seconds"), On = En("minutes"), Pn = En("hours"), Rn = En("days"),
				Wn = En("months"), Nn = En("years");
			var In = Math.round, Fn = {ss: 44, s: 45, m: 45, h: 22, d: 26, M: 11};
			var zn = Math.abs;

			function $n(e) {
				return (e > 0) - (e < 0) || +e
			}

			function Un() {
				if (!this.isValid()) return this.localeData().invalidDate();
				var e, t, n = zn(this._milliseconds) / 1e3, r = zn(this._days), i = zn(this._months);
				t = w((e = w(n / 60)) / 60), n %= 60, e %= 60;
				var a = w(i / 12), s = i %= 12, o = r, u = t, d = e, l = n ? n.toFixed(3).replace(/\.?0+$/, "") : "",
					c = this.asSeconds();
				if (!c) return "P0D";
				var h = c < 0 ? "-" : "", f = $n(this._months) !== $n(c) ? "-" : "",
					_ = $n(this._days) !== $n(c) ? "-" : "", p = $n(this._milliseconds) !== $n(c) ? "-" : "";
				return h + "P" + (a ? f + a + "Y" : "") + (s ? f + s + "M" : "") + (o ? _ + o + "D" : "") + (u || d || l ? "T" : "") + (u ? p + u + "H" : "") + (d ? p + d + "M" : "") + (l ? p + l + "S" : "")
			}

			var Bn = Ot.prototype;
			return Bn.isValid = function () {
				return this._isValid
			}, Bn.abs = function () {
				var e = this._data;
				return this._milliseconds = gn(this._milliseconds), this._days = gn(this._days), this._months = gn(this._months), e.milliseconds = gn(e.milliseconds), e.seconds = gn(e.seconds), e.minutes = gn(e.minutes), e.hours = gn(e.hours), e.months = gn(e.months), e.years = gn(e.years), this
			}, Bn.add = function (e, t) {
				return vn(this, e, t, 1)
			}, Bn.subtract = function (e, t) {
				return vn(this, e, t, -1)
			}, Bn.as = function (e) {
				if (!this.isValid()) return NaN;
				var t, n, r = this._milliseconds;
				if ("month" === (e = O(e)) || "year" === e) return t = this._days + r / 864e5, n = this._months + Ln(t), "month" === e ? n : n / 12;
				switch (t = this._days + Math.round(wn(this._months)), e) {
					case"week":
						return t / 7 + r / 6048e5;
					case"day":
						return t + r / 864e5;
					case"hour":
						return 24 * t + r / 36e5;
					case"minute":
						return 1440 * t + r / 6e4;
					case"second":
						return 86400 * t + r / 1e3;
					case"millisecond":
						return Math.floor(864e5 * t) + r;
					default:
						throw new Error("Unknown unit " + e)
				}
			}, Bn.asMilliseconds = Yn, Bn.asSeconds = kn, Bn.asMinutes = Tn, Bn.asHours = Dn, Bn.asDays = Sn, Bn.asWeeks = xn, Bn.asMonths = jn, Bn.asYears = Hn, Bn.valueOf = function () {
				return this.isValid() ? this._milliseconds + 864e5 * this._days + this._months % 12 * 2592e6 + 31536e6 * b(this._months / 12) : NaN
			}, Bn._bubble = function () {
				var e, t, n, r, i, a = this._milliseconds, s = this._days, o = this._months, u = this._data;
				return a >= 0 && s >= 0 && o >= 0 || a <= 0 && s <= 0 && o <= 0 || (a += 864e5 * Mn(wn(o) + s), s = 0, o = 0), u.milliseconds = a % 1e3, e = w(a / 1e3), u.seconds = e % 60, t = w(e / 60), u.minutes = t % 60, n = w(t / 60), u.hours = n % 24, o += i = w(Ln(s += w(n / 24))), s -= Mn(wn(i)), r = w(o / 12), o %= 12, u.days = s, u.months = o, u.years = r, this
			}, Bn.clone = function () {
				return qt(this)
			}, Bn.get = function (e) {
				return e = O(e), this.isValid() ? this[e + "s"]() : NaN
			}, Bn.milliseconds = Cn, Bn.seconds = An, Bn.minutes = On, Bn.hours = Pn, Bn.days = Rn, Bn.weeks = function () {
				return w(this.days() / 7)
			}, Bn.months = Wn, Bn.years = Nn, Bn.humanize = function (e) {
				if (!this.isValid()) return this.localeData().invalidDate();
				var t = this.localeData(), n = function (e, t, n) {
					var r = qt(e).abs(), i = In(r.as("s")), a = In(r.as("m")), s = In(r.as("h")), o = In(r.as("d")),
						u = In(r.as("M")), d = In(r.as("y")),
						l = i <= Fn.ss && ["s", i] || i < Fn.s && ["ss", i] || a <= 1 && ["m"] || a < Fn.m && ["mm", a] || s <= 1 && ["h"] || s < Fn.h && ["hh", s] || o <= 1 && ["d"] || o < Fn.d && ["dd", o] || u <= 1 && ["M"] || u < Fn.M && ["MM", u] || d <= 1 && ["y"] || ["yy", d];
					return l[2] = t, l[3] = +e > 0, l[4] = n, function (e, t, n, r, i) {
						return i.relativeTime(t || 1, !!n, e, r)
					}.apply(null, l)
				}(this, !e, t);
				return e && (n = t.pastFuture(+this, n)), t.postformat(n)
			}, Bn.toISOString = Un, Bn.toString = Un, Bn.toJSON = Un, Bn.locale = en, Bn.localeData = nn, Bn.toIsoString = T("toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)", Un), Bn.lang = tn, U("X", 0, 0, "unix"), U("x", 0, 0, "valueOf"), le("x", ae), le("X", /[+-]?\d+(\.\d{1,3})?/), _e("X", function (e, t, n) {
				n._d = new Date(1e3 * parseFloat(e, 10))
			}), _e("x", function (e, t, n) {
				n._d = new Date(b(e))
			}), i.version = "2.22.2", t = jt, i.fn = hn, i.min = function () {
				return Ct("isBefore", [].slice.call(arguments, 0))
			}, i.max = function () {
				return Ct("isAfter", [].slice.call(arguments, 0))
			}, i.now = function () {
				return Date.now ? Date.now() : +new Date
			}, i.utc = f, i.unix = function (e) {
				return jt(1e3 * e)
			}, i.months = function (e, t) {
				return mn(e, t, "months")
			}, i.isDate = d, i.locale = lt, i.invalid = m, i.duration = qt, i.isMoment = L, i.weekdays = function (e, t, n) {
				return yn(e, t, n, "weekdays")
			}, i.parseZone = function () {
				return jt.apply(null, arguments).parseZone()
			}, i.localeData = ht, i.isDuration = Pt, i.monthsShort = function (e, t) {
				return mn(e, t, "monthsShort")
			}, i.weekdaysMin = function (e, t, n) {
				return yn(e, t, n, "weekdaysMin")
			}, i.defineLocale = ct, i.updateLocale = function (e, t) {
				if (null != t) {
					var n, r, i = at;
					null != (r = dt(e)) && (i = r._config), (n = new E(t = H(i, t))).parentLocale = st[e], st[e] = n, lt(e)
				} else null != st[e] && (null != st[e].parentLocale ? st[e] = st[e].parentLocale : null != st[e] && delete st[e]);
				return st[e]
			}, i.locales = function () {
				return D(st)
			}, i.weekdaysShort = function (e, t, n) {
				return yn(e, t, n, "weekdaysShort")
			}, i.normalizeUnits = O, i.relativeTimeRounding = function (e) {
				return void 0 === e ? In : "function" == typeof e && (In = e, !0)
			}, i.relativeTimeThreshold = function (e, t) {
				return void 0 !== Fn[e] && (void 0 === t ? Fn[e] : (Fn[e] = t, "s" === e && (Fn.ss = t - 1), !0))
			}, i.calendarFormat = function (e, t) {
				var n = e.diff(t, "days", !0);
				return n < -6 ? "sameElse" : n < -1 ? "lastWeek" : n < 0 ? "lastDay" : n < 1 ? "sameDay" : n < 2 ? "nextDay" : n < 7 ? "nextWeek" : "sameElse"
			}, i.prototype = hn, i.HTML5_FMT = {
				DATETIME_LOCAL: "YYYY-MM-DDTHH:mm",
				DATETIME_LOCAL_SECONDS: "YYYY-MM-DDTHH:mm:ss",
				DATETIME_LOCAL_MS: "YYYY-MM-DDTHH:mm:ss.SSS",
				DATE: "YYYY-MM-DD",
				TIME: "HH:mm",
				TIME_SECONDS: "HH:mm:ss",
				TIME_MS: "HH:mm:ss.SSS",
				WEEK: "YYYY-[W]WW",
				MONTH: "YYYY-MM"
			}, i
		}, e.exports = t()
	}).call(t, n(4)(e))
}, function (e, t, n) {
	"use strict";
	var r = n(5), i = n(141), a = Object.prototype.toString;

	function s(e) {
		return "[object Array]" === a.call(e)
	}

	function o(e) {
		return null !== e && "object" == typeof e
	}

	function u(e) {
		return "[object Function]" === a.call(e)
	}

	function d(e, t) {
		if (null !== e && void 0 !== e) if ("object" != typeof e && (e = [e]), s(e)) for (var n = 0, r = e.length; n < r; n++) t.call(null, e[n], n, e); else for (var i in e) Object.prototype.hasOwnProperty.call(e, i) && t.call(null, e[i], i, e)
	}

	e.exports = {
		isArray: s, isArrayBuffer: function (e) {
			return "[object ArrayBuffer]" === a.call(e)
		}, isBuffer: i, isFormData: function (e) {
			return "undefined" != typeof FormData && e instanceof FormData
		}, isArrayBufferView: function (e) {
			return "undefined" != typeof ArrayBuffer && ArrayBuffer.isView ? ArrayBuffer.isView(e) : e && e.buffer && e.buffer instanceof ArrayBuffer
		}, isString: function (e) {
			return "string" == typeof e
		}, isNumber: function (e) {
			return "number" == typeof e
		}, isObject: o, isUndefined: function (e) {
			return void 0 === e
		}, isDate: function (e) {
			return "[object Date]" === a.call(e)
		}, isFile: function (e) {
			return "[object File]" === a.call(e)
		}, isBlob: function (e) {
			return "[object Blob]" === a.call(e)
		}, isFunction: u, isStream: function (e) {
			return o(e) && u(e.pipe)
		}, isURLSearchParams: function (e) {
			return "undefined" != typeof URLSearchParams && e instanceof URLSearchParams
		}, isStandardBrowserEnv: function () {
			return ("undefined" == typeof navigator || "ReactNative" !== navigator.product) && "undefined" != typeof window && "undefined" != typeof document
		}, forEach: d, merge: function e() {
			var t = {};

			function n(n, r) {
				"object" == typeof t[r] && "object" == typeof n ? t[r] = e(t[r], n) : t[r] = n
			}

			for (var r = 0, i = arguments.length; r < i; r++) d(arguments[r], n);
			return t
		}, extend: function (e, t, n) {
			return d(t, function (t, i) {
				e[i] = n && "function" == typeof t ? r(t, n) : t
			}), e
		}, trim: function (e) {
			return e.replace(/^\s*/, "").replace(/\s*$/, "")
		}
	}
}, function (e, t, n) {
	var r;
	!function (t, n) {
		"use strict";
		"object" == typeof e && "object" == typeof e.exports ? e.exports = t.document ? n(t, !0) : function (e) {
			if (!e.document) throw new Error("jQuery requires a window with a document");
			return n(e)
		} : n(t)
	}("undefined" != typeof window ? window : this, function (n, i) {
		"use strict";
		var a = [], s = n.document, o = Object.getPrototypeOf, u = a.slice, d = a.concat, l = a.push, c = a.indexOf,
			h = {}, f = h.toString, _ = h.hasOwnProperty, p = _.toString, m = p.call(Object), y = {}, g = function (e) {
				return "function" == typeof e && "number" != typeof e.nodeType
			}, v = function (e) {
				return null != e && e === e.window
			}, M = {type: !0, src: !0, noModule: !0};

		function L(e, t, n) {
			var r, i = (t = t || s).createElement("script");
			if (i.text = e, n) for (r in M) n[r] && (i[r] = n[r]);
			t.head.appendChild(i).parentNode.removeChild(i)
		}

		function w(e) {
			return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? h[f.call(e)] || "object" : typeof e
		}

		var b = function (e, t) {
			return new b.fn.init(e, t)
		}, Y = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;

		function k(e) {
			var t = !!e && "length" in e && e.length, n = w(e);
			return !g(e) && !v(e) && ("array" === n || 0 === t || "number" == typeof t && t > 0 && t - 1 in e)
		}

		b.fn = b.prototype = {
			jquery: "3.3.1", constructor: b, length: 0, toArray: function () {
				return u.call(this)
			}, get: function (e) {
				return null == e ? u.call(this) : e < 0 ? this[e + this.length] : this[e]
			}, pushStack: function (e) {
				var t = b.merge(this.constructor(), e);
				return t.prevObject = this, t
			}, each: function (e) {
				return b.each(this, e)
			}, map: function (e) {
				return this.pushStack(b.map(this, function (t, n) {
					return e.call(t, n, t)
				}))
			}, slice: function () {
				return this.pushStack(u.apply(this, arguments))
			}, first: function () {
				return this.eq(0)
			}, last: function () {
				return this.eq(-1)
			}, eq: function (e) {
				var t = this.length, n = +e + (e < 0 ? t : 0);
				return this.pushStack(n >= 0 && n < t ? [this[n]] : [])
			}, end: function () {
				return this.prevObject || this.constructor()
			}, push: l, sort: a.sort, splice: a.splice
		}, b.extend = b.fn.extend = function () {
			var e, t, n, r, i, a, s = arguments[0] || {}, o = 1, u = arguments.length, d = !1;
			for ("boolean" == typeof s && (d = s, s = arguments[o] || {}, o++), "object" == typeof s || g(s) || (s = {}), o === u && (s = this, o--); o < u; o++) if (null != (e = arguments[o])) for (t in e) n = s[t], s !== (r = e[t]) && (d && r && (b.isPlainObject(r) || (i = Array.isArray(r))) ? (i ? (i = !1, a = n && Array.isArray(n) ? n : []) : a = n && b.isPlainObject(n) ? n : {}, s[t] = b.extend(d, a, r)) : void 0 !== r && (s[t] = r));
			return s
		}, b.extend({
			expando: "jQuery" + ("3.3.1" + Math.random()).replace(/\D/g, ""),
			isReady: !0,
			error: function (e) {
				throw new Error(e)
			},
			noop: function () {
			},
			isPlainObject: function (e) {
				var t, n;
				return !(!e || "[object Object]" !== f.call(e)) && (!(t = o(e)) || "function" == typeof(n = _.call(t, "constructor") && t.constructor) && p.call(n) === m)
			},
			isEmptyObject: function (e) {
				var t;
				for (t in e) return !1;
				return !0
			},
			globalEval: function (e) {
				L(e)
			},
			each: function (e, t) {
				var n, r = 0;
				if (k(e)) for (n = e.length; r < n && !1 !== t.call(e[r], r, e[r]); r++) ; else for (r in e) if (!1 === t.call(e[r], r, e[r])) break;
				return e
			},
			trim: function (e) {
				return null == e ? "" : (e + "").replace(Y, "")
			},
			makeArray: function (e, t) {
				var n = t || [];
				return null != e && (k(Object(e)) ? b.merge(n, "string" == typeof e ? [e] : e) : l.call(n, e)), n
			},
			inArray: function (e, t, n) {
				return null == t ? -1 : c.call(t, e, n)
			},
			merge: function (e, t) {
				for (var n = +t.length, r = 0, i = e.length; r < n; r++) e[i++] = t[r];
				return e.length = i, e
			},
			grep: function (e, t, n) {
				for (var r = [], i = 0, a = e.length, s = !n; i < a; i++) !t(e[i], i) !== s && r.push(e[i]);
				return r
			},
			map: function (e, t, n) {
				var r, i, a = 0, s = [];
				if (k(e)) for (r = e.length; a < r; a++) null != (i = t(e[a], a, n)) && s.push(i); else for (a in e) null != (i = t(e[a], a, n)) && s.push(i);
				return d.apply([], s)
			},
			guid: 1,
			support: y
		}), "function" == typeof Symbol && (b.fn[Symbol.iterator] = a[Symbol.iterator]), b.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (e, t) {
			h["[object " + t + "]"] = t.toLowerCase()
		});
		var T = function (e) {
			var t, n, r, i, a, s, o, u, d, l, c, h, f, _, p, m, y, g, v, M = "sizzle" + 1 * new Date, L = e.document,
				w = 0, b = 0, Y = se(), k = se(), T = se(), D = function (e, t) {
					return e === t && (c = !0), 0
				}, S = {}.hasOwnProperty, x = [], j = x.pop, H = x.push, E = x.push, C = x.slice, A = function (e, t) {
					for (var n = 0, r = e.length; n < r; n++) if (e[n] === t) return n;
					return -1
				},
				O = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
				P = "[\\x20\\t\\r\\n\\f]", R = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
				W = "\\[" + P + "*(" + R + ")(?:" + P + "*([*^$|!~]?=)" + P + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + R + "))|)" + P + "*\\]",
				N = ":(" + R + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + W + ")*)|.*)\\)|)",
				I = new RegExp(P + "+", "g"), F = new RegExp("^" + P + "+|((?:^|[^\\\\])(?:\\\\.)*)" + P + "+$", "g"),
				z = new RegExp("^" + P + "*," + P + "*"), $ = new RegExp("^" + P + "*([>+~]|" + P + ")" + P + "*"),
				U = new RegExp("=" + P + "*([^\\]'\"]*?)" + P + "*\\]", "g"), B = new RegExp(N),
				q = new RegExp("^" + R + "$"), J = {
					ID: new RegExp("^#(" + R + ")"),
					CLASS: new RegExp("^\\.(" + R + ")"),
					TAG: new RegExp("^(" + R + "|[*])"),
					ATTR: new RegExp("^" + W),
					PSEUDO: new RegExp("^" + N),
					CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + P + "*(even|odd|(([+-]|)(\\d*)n|)" + P + "*(?:([+-]|)" + P + "*(\\d+)|))" + P + "*\\)|)", "i"),
					bool: new RegExp("^(?:" + O + ")$", "i"),
					needsContext: new RegExp("^" + P + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + P + "*((?:-\\d)?\\d*)" + P + "*\\)|)(?=[^-]|$)", "i")
				}, G = /^(?:input|select|textarea|button)$/i, V = /^h\d$/i, K = /^[^{]+\{\s*\[native \w/,
				X = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, Z = /[+~]/,
				Q = new RegExp("\\\\([\\da-f]{1,6}" + P + "?|(" + P + ")|.)", "ig"), ee = function (e, t, n) {
					var r = "0x" + t - 65536;
					return r != r || n ? t : r < 0 ? String.fromCharCode(r + 65536) : String.fromCharCode(r >> 10 | 55296, 1023 & r | 56320)
				}, te = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g, ne = function (e, t) {
					return t ? "\0" === e ? "�" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e
				}, re = function () {
					h()
				}, ie = ge(function (e) {
					return !0 === e.disabled && ("form" in e || "label" in e)
				}, {dir: "parentNode", next: "legend"});
			try {
				E.apply(x = C.call(L.childNodes), L.childNodes), x[L.childNodes.length].nodeType
			} catch (e) {
				E = {
					apply: x.length ? function (e, t) {
						H.apply(e, C.call(t))
					} : function (e, t) {
						for (var n = e.length, r = 0; e[n++] = t[r++];) ;
						e.length = n - 1
					}
				}
			}

			function ae(e, t, r, i) {
				var a, o, d, l, c, _, y, g = t && t.ownerDocument, w = t ? t.nodeType : 9;
				if (r = r || [], "string" != typeof e || !e || 1 !== w && 9 !== w && 11 !== w) return r;
				if (!i && ((t ? t.ownerDocument || t : L) !== f && h(t), t = t || f, p)) {
					if (11 !== w && (c = X.exec(e))) if (a = c[1]) {
						if (9 === w) {
							if (!(d = t.getElementById(a))) return r;
							if (d.id === a) return r.push(d), r
						} else if (g && (d = g.getElementById(a)) && v(t, d) && d.id === a) return r.push(d), r
					} else {
						if (c[2]) return E.apply(r, t.getElementsByTagName(e)), r;
						if ((a = c[3]) && n.getElementsByClassName && t.getElementsByClassName) return E.apply(r, t.getElementsByClassName(a)), r
					}
					if (n.qsa && !T[e + " "] && (!m || !m.test(e))) {
						if (1 !== w) g = t, y = e; else if ("object" !== t.nodeName.toLowerCase()) {
							for ((l = t.getAttribute("id")) ? l = l.replace(te, ne) : t.setAttribute("id", l = M), o = (_ = s(e)).length; o--;) _[o] = "#" + l + " " + ye(_[o]);
							y = _.join(","), g = Z.test(e) && pe(t.parentNode) || t
						}
						if (y) try {
							return E.apply(r, g.querySelectorAll(y)), r
						} catch (e) {
						} finally {
							l === M && t.removeAttribute("id")
						}
					}
				}
				return u(e.replace(F, "$1"), t, r, i)
			}

			function se() {
				var e = [];
				return function t(n, i) {
					return e.push(n + " ") > r.cacheLength && delete t[e.shift()], t[n + " "] = i
				}
			}

			function oe(e) {
				return e[M] = !0, e
			}

			function ue(e) {
				var t = f.createElement("fieldset");
				try {
					return !!e(t)
				} catch (e) {
					return !1
				} finally {
					t.parentNode && t.parentNode.removeChild(t), t = null
				}
			}

			function de(e, t) {
				for (var n = e.split("|"), i = n.length; i--;) r.attrHandle[n[i]] = t
			}

			function le(e, t) {
				var n = t && e, r = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
				if (r) return r;
				if (n) for (; n = n.nextSibling;) if (n === t) return -1;
				return e ? 1 : -1
			}

			function ce(e) {
				return function (t) {
					return "input" === t.nodeName.toLowerCase() && t.type === e
				}
			}

			function he(e) {
				return function (t) {
					var n = t.nodeName.toLowerCase();
					return ("input" === n || "button" === n) && t.type === e
				}
			}

			function fe(e) {
				return function (t) {
					return "form" in t ? t.parentNode && !1 === t.disabled ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === e : t.disabled === e : t.isDisabled === e || t.isDisabled !== !e && ie(t) === e : t.disabled === e : "label" in t && t.disabled === e
				}
			}

			function _e(e) {
				return oe(function (t) {
					return t = +t, oe(function (n, r) {
						for (var i, a = e([], n.length, t), s = a.length; s--;) n[i = a[s]] && (n[i] = !(r[i] = n[i]))
					})
				})
			}

			function pe(e) {
				return e && void 0 !== e.getElementsByTagName && e
			}

			for (t in n = ae.support = {}, a = ae.isXML = function (e) {
				var t = e && (e.ownerDocument || e).documentElement;
				return !!t && "HTML" !== t.nodeName
			}, h = ae.setDocument = function (e) {
				var t, i, s = e ? e.ownerDocument || e : L;
				return s !== f && 9 === s.nodeType && s.documentElement ? (_ = (f = s).documentElement, p = !a(f), L !== f && (i = f.defaultView) && i.top !== i && (i.addEventListener ? i.addEventListener("unload", re, !1) : i.attachEvent && i.attachEvent("onunload", re)), n.attributes = ue(function (e) {
					return e.className = "i", !e.getAttribute("className")
				}), n.getElementsByTagName = ue(function (e) {
					return e.appendChild(f.createComment("")), !e.getElementsByTagName("*").length
				}), n.getElementsByClassName = K.test(f.getElementsByClassName), n.getById = ue(function (e) {
					return _.appendChild(e).id = M, !f.getElementsByName || !f.getElementsByName(M).length
				}), n.getById ? (r.filter.ID = function (e) {
					var t = e.replace(Q, ee);
					return function (e) {
						return e.getAttribute("id") === t
					}
				}, r.find.ID = function (e, t) {
					if (void 0 !== t.getElementById && p) {
						var n = t.getElementById(e);
						return n ? [n] : []
					}
				}) : (r.filter.ID = function (e) {
					var t = e.replace(Q, ee);
					return function (e) {
						var n = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
						return n && n.value === t
					}
				}, r.find.ID = function (e, t) {
					if (void 0 !== t.getElementById && p) {
						var n, r, i, a = t.getElementById(e);
						if (a) {
							if ((n = a.getAttributeNode("id")) && n.value === e) return [a];
							for (i = t.getElementsByName(e), r = 0; a = i[r++];) if ((n = a.getAttributeNode("id")) && n.value === e) return [a]
						}
						return []
					}
				}), r.find.TAG = n.getElementsByTagName ? function (e, t) {
					return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : n.qsa ? t.querySelectorAll(e) : void 0
				} : function (e, t) {
					var n, r = [], i = 0, a = t.getElementsByTagName(e);
					if ("*" === e) {
						for (; n = a[i++];) 1 === n.nodeType && r.push(n);
						return r
					}
					return a
				}, r.find.CLASS = n.getElementsByClassName && function (e, t) {
					if (void 0 !== t.getElementsByClassName && p) return t.getElementsByClassName(e)
				}, y = [], m = [], (n.qsa = K.test(f.querySelectorAll)) && (ue(function (e) {
					_.appendChild(e).innerHTML = "<a id='" + M + "'></a><select id='" + M + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && m.push("[*^$]=" + P + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || m.push("\\[" + P + "*(?:value|" + O + ")"), e.querySelectorAll("[id~=" + M + "-]").length || m.push("~="), e.querySelectorAll(":checked").length || m.push(":checked"), e.querySelectorAll("a#" + M + "+*").length || m.push(".#.+[+~]")
				}), ue(function (e) {
					e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
					var t = f.createElement("input");
					t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && m.push("name" + P + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && m.push(":enabled", ":disabled"), _.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && m.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), m.push(",.*:")
				})), (n.matchesSelector = K.test(g = _.matches || _.webkitMatchesSelector || _.mozMatchesSelector || _.oMatchesSelector || _.msMatchesSelector)) && ue(function (e) {
					n.disconnectedMatch = g.call(e, "*"), g.call(e, "[s!='']:x"), y.push("!=", N)
				}), m = m.length && new RegExp(m.join("|")), y = y.length && new RegExp(y.join("|")), t = K.test(_.compareDocumentPosition), v = t || K.test(_.contains) ? function (e, t) {
					var n = 9 === e.nodeType ? e.documentElement : e, r = t && t.parentNode;
					return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r)))
				} : function (e, t) {
					if (t) for (; t = t.parentNode;) if (t === e) return !0;
					return !1
				}, D = t ? function (e, t) {
					if (e === t) return c = !0, 0;
					var r = !e.compareDocumentPosition - !t.compareDocumentPosition;
					return r || (1 & (r = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1) || !n.sortDetached && t.compareDocumentPosition(e) === r ? e === f || e.ownerDocument === L && v(L, e) ? -1 : t === f || t.ownerDocument === L && v(L, t) ? 1 : l ? A(l, e) - A(l, t) : 0 : 4 & r ? -1 : 1)
				} : function (e, t) {
					if (e === t) return c = !0, 0;
					var n, r = 0, i = e.parentNode, a = t.parentNode, s = [e], o = [t];
					if (!i || !a) return e === f ? -1 : t === f ? 1 : i ? -1 : a ? 1 : l ? A(l, e) - A(l, t) : 0;
					if (i === a) return le(e, t);
					for (n = e; n = n.parentNode;) s.unshift(n);
					for (n = t; n = n.parentNode;) o.unshift(n);
					for (; s[r] === o[r];) r++;
					return r ? le(s[r], o[r]) : s[r] === L ? -1 : o[r] === L ? 1 : 0
				}, f) : f
			}, ae.matches = function (e, t) {
				return ae(e, null, null, t)
			}, ae.matchesSelector = function (e, t) {
				if ((e.ownerDocument || e) !== f && h(e), t = t.replace(U, "='$1']"), n.matchesSelector && p && !T[t + " "] && (!y || !y.test(t)) && (!m || !m.test(t))) try {
					var r = g.call(e, t);
					if (r || n.disconnectedMatch || e.document && 11 !== e.document.nodeType) return r
				} catch (e) {
				}
				return ae(t, f, null, [e]).length > 0
			}, ae.contains = function (e, t) {
				return (e.ownerDocument || e) !== f && h(e), v(e, t)
			}, ae.attr = function (e, t) {
				(e.ownerDocument || e) !== f && h(e);
				var i = r.attrHandle[t.toLowerCase()],
					a = i && S.call(r.attrHandle, t.toLowerCase()) ? i(e, t, !p) : void 0;
				return void 0 !== a ? a : n.attributes || !p ? e.getAttribute(t) : (a = e.getAttributeNode(t)) && a.specified ? a.value : null
			}, ae.escape = function (e) {
				return (e + "").replace(te, ne)
			}, ae.error = function (e) {
				throw new Error("Syntax error, unrecognized expression: " + e)
			}, ae.uniqueSort = function (e) {
				var t, r = [], i = 0, a = 0;
				if (c = !n.detectDuplicates, l = !n.sortStable && e.slice(0), e.sort(D), c) {
					for (; t = e[a++];) t === e[a] && (i = r.push(a));
					for (; i--;) e.splice(r[i], 1)
				}
				return l = null, e
			}, i = ae.getText = function (e) {
				var t, n = "", r = 0, a = e.nodeType;
				if (a) {
					if (1 === a || 9 === a || 11 === a) {
						if ("string" == typeof e.textContent) return e.textContent;
						for (e = e.firstChild; e; e = e.nextSibling) n += i(e)
					} else if (3 === a || 4 === a) return e.nodeValue
				} else for (; t = e[r++];) n += i(t);
				return n
			}, (r = ae.selectors = {
				cacheLength: 50,
				createPseudo: oe,
				match: J,
				attrHandle: {},
				find: {},
				relative: {
					">": {dir: "parentNode", first: !0},
					" ": {dir: "parentNode"},
					"+": {dir: "previousSibling", first: !0},
					"~": {dir: "previousSibling"}
				},
				preFilter: {
					ATTR: function (e) {
						return e[1] = e[1].replace(Q, ee), e[3] = (e[3] || e[4] || e[5] || "").replace(Q, ee), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
					}, CHILD: function (e) {
						return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || ae.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && ae.error(e[0]), e
					}, PSEUDO: function (e) {
						var t, n = !e[6] && e[2];
						return J.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && B.test(n) && (t = s(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
					}
				},
				filter: {
					TAG: function (e) {
						var t = e.replace(Q, ee).toLowerCase();
						return "*" === e ? function () {
							return !0
						} : function (e) {
							return e.nodeName && e.nodeName.toLowerCase() === t
						}
					}, CLASS: function (e) {
						var t = Y[e + " "];
						return t || (t = new RegExp("(^|" + P + ")" + e + "(" + P + "|$)")) && Y(e, function (e) {
							return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "")
						})
					}, ATTR: function (e, t, n) {
						return function (r) {
							var i = ae.attr(r, e);
							return null == i ? "!=" === t : !t || (i += "", "=" === t ? i === n : "!=" === t ? i !== n : "^=" === t ? n && 0 === i.indexOf(n) : "*=" === t ? n && i.indexOf(n) > -1 : "$=" === t ? n && i.slice(-n.length) === n : "~=" === t ? (" " + i.replace(I, " ") + " ").indexOf(n) > -1 : "|=" === t && (i === n || i.slice(0, n.length + 1) === n + "-"))
						}
					}, CHILD: function (e, t, n, r, i) {
						var a = "nth" !== e.slice(0, 3), s = "last" !== e.slice(-4), o = "of-type" === t;
						return 1 === r && 0 === i ? function (e) {
							return !!e.parentNode
						} : function (t, n, u) {
							var d, l, c, h, f, _, p = a !== s ? "nextSibling" : "previousSibling", m = t.parentNode,
								y = o && t.nodeName.toLowerCase(), g = !u && !o, v = !1;
							if (m) {
								if (a) {
									for (; p;) {
										for (h = t; h = h[p];) if (o ? h.nodeName.toLowerCase() === y : 1 === h.nodeType) return !1;
										_ = p = "only" === e && !_ && "nextSibling"
									}
									return !0
								}
								if (_ = [s ? m.firstChild : m.lastChild], s && g) {
									for (v = (f = (d = (l = (c = (h = m)[M] || (h[M] = {}))[h.uniqueID] || (c[h.uniqueID] = {}))[e] || [])[0] === w && d[1]) && d[2], h = f && m.childNodes[f]; h = ++f && h && h[p] || (v = f = 0) || _.pop();) if (1 === h.nodeType && ++v && h === t) {
										l[e] = [w, f, v];
										break
									}
								} else if (g && (v = f = (d = (l = (c = (h = t)[M] || (h[M] = {}))[h.uniqueID] || (c[h.uniqueID] = {}))[e] || [])[0] === w && d[1]), !1 === v) for (; (h = ++f && h && h[p] || (v = f = 0) || _.pop()) && ((o ? h.nodeName.toLowerCase() !== y : 1 !== h.nodeType) || !++v || (g && ((l = (c = h[M] || (h[M] = {}))[h.uniqueID] || (c[h.uniqueID] = {}))[e] = [w, v]), h !== t));) ;
								return (v -= i) === r || v % r == 0 && v / r >= 0
							}
						}
					}, PSEUDO: function (e, t) {
						var n,
							i = r.pseudos[e] || r.setFilters[e.toLowerCase()] || ae.error("unsupported pseudo: " + e);
						return i[M] ? i(t) : i.length > 1 ? (n = [e, e, "", t], r.setFilters.hasOwnProperty(e.toLowerCase()) ? oe(function (e, n) {
							for (var r, a = i(e, t), s = a.length; s--;) e[r = A(e, a[s])] = !(n[r] = a[s])
						}) : function (e) {
							return i(e, 0, n)
						}) : i
					}
				},
				pseudos: {
					not: oe(function (e) {
						var t = [], n = [], r = o(e.replace(F, "$1"));
						return r[M] ? oe(function (e, t, n, i) {
							for (var a, s = r(e, null, i, []), o = e.length; o--;) (a = s[o]) && (e[o] = !(t[o] = a))
						}) : function (e, i, a) {
							return t[0] = e, r(t, null, a, n), t[0] = null, !n.pop()
						}
					}), has: oe(function (e) {
						return function (t) {
							return ae(e, t).length > 0
						}
					}), contains: oe(function (e) {
						return e = e.replace(Q, ee), function (t) {
							return (t.textContent || t.innerText || i(t)).indexOf(e) > -1
						}
					}), lang: oe(function (e) {
						return q.test(e || "") || ae.error("unsupported lang: " + e), e = e.replace(Q, ee).toLowerCase(), function (t) {
							var n;
							do {
								if (n = p ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")) return (n = n.toLowerCase()) === e || 0 === n.indexOf(e + "-")
							} while ((t = t.parentNode) && 1 === t.nodeType);
							return !1
						}
					}), target: function (t) {
						var n = e.location && e.location.hash;
						return n && n.slice(1) === t.id
					}, root: function (e) {
						return e === _
					}, focus: function (e) {
						return e === f.activeElement && (!f.hasFocus || f.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
					}, enabled: fe(!1), disabled: fe(!0), checked: function (e) {
						var t = e.nodeName.toLowerCase();
						return "input" === t && !!e.checked || "option" === t && !!e.selected
					}, selected: function (e) {
						return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
					}, empty: function (e) {
						for (e = e.firstChild; e; e = e.nextSibling) if (e.nodeType < 6) return !1;
						return !0
					}, parent: function (e) {
						return !r.pseudos.empty(e)
					}, header: function (e) {
						return V.test(e.nodeName)
					}, input: function (e) {
						return G.test(e.nodeName)
					}, button: function (e) {
						var t = e.nodeName.toLowerCase();
						return "input" === t && "button" === e.type || "button" === t
					}, text: function (e) {
						var t;
						return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
					}, first: _e(function () {
						return [0]
					}), last: _e(function (e, t) {
						return [t - 1]
					}), eq: _e(function (e, t, n) {
						return [n < 0 ? n + t : n]
					}), even: _e(function (e, t) {
						for (var n = 0; n < t; n += 2) e.push(n);
						return e
					}), odd: _e(function (e, t) {
						for (var n = 1; n < t; n += 2) e.push(n);
						return e
					}), lt: _e(function (e, t, n) {
						for (var r = n < 0 ? n + t : n; --r >= 0;) e.push(r);
						return e
					}), gt: _e(function (e, t, n) {
						for (var r = n < 0 ? n + t : n; ++r < t;) e.push(r);
						return e
					})
				}
			}).pseudos.nth = r.pseudos.eq, {
				radio: !0,
				checkbox: !0,
				file: !0,
				password: !0,
				image: !0
			}) r.pseudos[t] = ce(t);
			for (t in{submit: !0, reset: !0}) r.pseudos[t] = he(t);

			function me() {
			}

			function ye(e) {
				for (var t = 0, n = e.length, r = ""; t < n; t++) r += e[t].value;
				return r
			}

			function ge(e, t, n) {
				var r = t.dir, i = t.next, a = i || r, s = n && "parentNode" === a, o = b++;
				return t.first ? function (t, n, i) {
					for (; t = t[r];) if (1 === t.nodeType || s) return e(t, n, i);
					return !1
				} : function (t, n, u) {
					var d, l, c, h = [w, o];
					if (u) {
						for (; t = t[r];) if ((1 === t.nodeType || s) && e(t, n, u)) return !0
					} else for (; t = t[r];) if (1 === t.nodeType || s) if (l = (c = t[M] || (t[M] = {}))[t.uniqueID] || (c[t.uniqueID] = {}), i && i === t.nodeName.toLowerCase()) t = t[r] || t; else {
						if ((d = l[a]) && d[0] === w && d[1] === o) return h[2] = d[2];
						if (l[a] = h, h[2] = e(t, n, u)) return !0
					}
					return !1
				}
			}

			function ve(e) {
				return e.length > 1 ? function (t, n, r) {
					for (var i = e.length; i--;) if (!e[i](t, n, r)) return !1;
					return !0
				} : e[0]
			}

			function Me(e, t, n, r, i) {
				for (var a, s = [], o = 0, u = e.length, d = null != t; o < u; o++) (a = e[o]) && (n && !n(a, r, i) || (s.push(a), d && t.push(o)));
				return s
			}

			function Le(e, t, n, r, i, a) {
				return r && !r[M] && (r = Le(r)), i && !i[M] && (i = Le(i, a)), oe(function (a, s, o, u) {
					var d, l, c, h = [], f = [], _ = s.length, p = a || function (e, t, n) {
							for (var r = 0, i = t.length; r < i; r++) ae(e, t[r], n);
							return n
						}(t || "*", o.nodeType ? [o] : o, []), m = !e || !a && t ? p : Me(p, h, e, o, u),
						y = n ? i || (a ? e : _ || r) ? [] : s : m;
					if (n && n(m, y, o, u), r) for (d = Me(y, f), r(d, [], o, u), l = d.length; l--;) (c = d[l]) && (y[f[l]] = !(m[f[l]] = c));
					if (a) {
						if (i || e) {
							if (i) {
								for (d = [], l = y.length; l--;) (c = y[l]) && d.push(m[l] = c);
								i(null, y = [], d, u)
							}
							for (l = y.length; l--;) (c = y[l]) && (d = i ? A(a, c) : h[l]) > -1 && (a[d] = !(s[d] = c))
						}
					} else y = Me(y === s ? y.splice(_, y.length) : y), i ? i(null, s, y, u) : E.apply(s, y)
				})
			}

			function we(e) {
				for (var t, n, i, a = e.length, s = r.relative[e[0].type], o = s || r.relative[" "], u = s ? 1 : 0, l = ge(function (e) {
					return e === t
				}, o, !0), c = ge(function (e) {
					return A(t, e) > -1
				}, o, !0), h = [function (e, n, r) {
					var i = !s && (r || n !== d) || ((t = n).nodeType ? l(e, n, r) : c(e, n, r));
					return t = null, i
				}]; u < a; u++) if (n = r.relative[e[u].type]) h = [ge(ve(h), n)]; else {
					if ((n = r.filter[e[u].type].apply(null, e[u].matches))[M]) {
						for (i = ++u; i < a && !r.relative[e[i].type]; i++) ;
						return Le(u > 1 && ve(h), u > 1 && ye(e.slice(0, u - 1).concat({value: " " === e[u - 2].type ? "*" : ""})).replace(F, "$1"), n, u < i && we(e.slice(u, i)), i < a && we(e = e.slice(i)), i < a && ye(e))
					}
					h.push(n)
				}
				return ve(h)
			}

			return me.prototype = r.filters = r.pseudos, r.setFilters = new me, s = ae.tokenize = function (e, t) {
				var n, i, a, s, o, u, d, l = k[e + " "];
				if (l) return t ? 0 : l.slice(0);
				for (o = e, u = [], d = r.preFilter; o;) {
					for (s in n && !(i = z.exec(o)) || (i && (o = o.slice(i[0].length) || o), u.push(a = [])), n = !1, (i = $.exec(o)) && (n = i.shift(), a.push({
						value: n,
						type: i[0].replace(F, " ")
					}), o = o.slice(n.length)), r.filter) !(i = J[s].exec(o)) || d[s] && !(i = d[s](i)) || (n = i.shift(), a.push({
						value: n,
						type: s,
						matches: i
					}), o = o.slice(n.length));
					if (!n) break
				}
				return t ? o.length : o ? ae.error(e) : k(e, u).slice(0)
			}, o = ae.compile = function (e, t) {
				var n, i = [], a = [], o = T[e + " "];
				if (!o) {
					for (t || (t = s(e)), n = t.length; n--;) (o = we(t[n]))[M] ? i.push(o) : a.push(o);
					(o = T(e, function (e, t) {
						var n = t.length > 0, i = e.length > 0, a = function (a, s, o, u, l) {
							var c, _, m, y = 0, g = "0", v = a && [], M = [], L = d, b = a || i && r.find.TAG("*", l),
								Y = w += null == L ? 1 : Math.random() || .1, k = b.length;
							for (l && (d = s === f || s || l); g !== k && null != (c = b[g]); g++) {
								if (i && c) {
									for (_ = 0, s || c.ownerDocument === f || (h(c), o = !p); m = e[_++];) if (m(c, s || f, o)) {
										u.push(c);
										break
									}
									l && (w = Y)
								}
								n && ((c = !m && c) && y--, a && v.push(c))
							}
							if (y += g, n && g !== y) {
								for (_ = 0; m = t[_++];) m(v, M, s, o);
								if (a) {
									if (y > 0) for (; g--;) v[g] || M[g] || (M[g] = j.call(u));
									M = Me(M)
								}
								E.apply(u, M), l && !a && M.length > 0 && y + t.length > 1 && ae.uniqueSort(u)
							}
							return l && (w = Y, d = L), v
						};
						return n ? oe(a) : a
					}(a, i))).selector = e
				}
				return o
			}, u = ae.select = function (e, t, n, i) {
				var a, u, d, l, c, h = "function" == typeof e && e, f = !i && s(e = h.selector || e);
				if (n = n || [], 1 === f.length) {
					if ((u = f[0] = f[0].slice(0)).length > 2 && "ID" === (d = u[0]).type && 9 === t.nodeType && p && r.relative[u[1].type]) {
						if (!(t = (r.find.ID(d.matches[0].replace(Q, ee), t) || [])[0])) return n;
						h && (t = t.parentNode), e = e.slice(u.shift().value.length)
					}
					for (a = J.needsContext.test(e) ? 0 : u.length; a-- && (d = u[a], !r.relative[l = d.type]);) if ((c = r.find[l]) && (i = c(d.matches[0].replace(Q, ee), Z.test(u[0].type) && pe(t.parentNode) || t))) {
						if (u.splice(a, 1), !(e = i.length && ye(u))) return E.apply(n, i), n;
						break
					}
				}
				return (h || o(e, f))(i, t, !p, n, !t || Z.test(e) && pe(t.parentNode) || t), n
			}, n.sortStable = M.split("").sort(D).join("") === M, n.detectDuplicates = !!c, h(), n.sortDetached = ue(function (e) {
				return 1 & e.compareDocumentPosition(f.createElement("fieldset"))
			}), ue(function (e) {
				return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
			}) || de("type|href|height|width", function (e, t, n) {
				if (!n) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
			}), n.attributes && ue(function (e) {
				return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
			}) || de("value", function (e, t, n) {
				if (!n && "input" === e.nodeName.toLowerCase()) return e.defaultValue
			}), ue(function (e) {
				return null == e.getAttribute("disabled")
			}) || de(O, function (e, t, n) {
				var r;
				if (!n) return !0 === e[t] ? t.toLowerCase() : (r = e.getAttributeNode(t)) && r.specified ? r.value : null
			}), ae
		}(n);
		b.find = T, b.expr = T.selectors, b.expr[":"] = b.expr.pseudos, b.uniqueSort = b.unique = T.uniqueSort, b.text = T.getText, b.isXMLDoc = T.isXML, b.contains = T.contains, b.escapeSelector = T.escape;
		var D = function (e, t, n) {
			for (var r = [], i = void 0 !== n; (e = e[t]) && 9 !== e.nodeType;) if (1 === e.nodeType) {
				if (i && b(e).is(n)) break;
				r.push(e)
			}
			return r
		}, S = function (e, t) {
			for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
			return n
		}, x = b.expr.match.needsContext;

		function j(e, t) {
			return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
		}

		var H = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;

		function E(e, t, n) {
			return g(t) ? b.grep(e, function (e, r) {
				return !!t.call(e, r, e) !== n
			}) : t.nodeType ? b.grep(e, function (e) {
				return e === t !== n
			}) : "string" != typeof t ? b.grep(e, function (e) {
				return c.call(t, e) > -1 !== n
			}) : b.filter(t, e, n)
		}

		b.filter = function (e, t, n) {
			var r = t[0];
			return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === r.nodeType ? b.find.matchesSelector(r, e) ? [r] : [] : b.find.matches(e, b.grep(t, function (e) {
				return 1 === e.nodeType
			}))
		}, b.fn.extend({
			find: function (e) {
				var t, n, r = this.length, i = this;
				if ("string" != typeof e) return this.pushStack(b(e).filter(function () {
					for (t = 0; t < r; t++) if (b.contains(i[t], this)) return !0
				}));
				for (n = this.pushStack([]), t = 0; t < r; t++) b.find(e, i[t], n);
				return r > 1 ? b.uniqueSort(n) : n
			}, filter: function (e) {
				return this.pushStack(E(this, e || [], !1))
			}, not: function (e) {
				return this.pushStack(E(this, e || [], !0))
			}, is: function (e) {
				return !!E(this, "string" == typeof e && x.test(e) ? b(e) : e || [], !1).length
			}
		});
		var C, A = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
		(b.fn.init = function (e, t, n) {
			var r, i;
			if (!e) return this;
			if (n = n || C, "string" == typeof e) {
				if (!(r = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [null, e, null] : A.exec(e)) || !r[1] && t) return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
				if (r[1]) {
					if (t = t instanceof b ? t[0] : t, b.merge(this, b.parseHTML(r[1], t && t.nodeType ? t.ownerDocument || t : s, !0)), H.test(r[1]) && b.isPlainObject(t)) for (r in t) g(this[r]) ? this[r](t[r]) : this.attr(r, t[r]);
					return this
				}
				return (i = s.getElementById(r[2])) && (this[0] = i, this.length = 1), this
			}
			return e.nodeType ? (this[0] = e, this.length = 1, this) : g(e) ? void 0 !== n.ready ? n.ready(e) : e(b) : b.makeArray(e, this)
		}).prototype = b.fn, C = b(s);
		var O = /^(?:parents|prev(?:Until|All))/, P = {children: !0, contents: !0, next: !0, prev: !0};

		function R(e, t) {
			for (; (e = e[t]) && 1 !== e.nodeType;) ;
			return e
		}

		b.fn.extend({
			has: function (e) {
				var t = b(e, this), n = t.length;
				return this.filter(function () {
					for (var e = 0; e < n; e++) if (b.contains(this, t[e])) return !0
				})
			}, closest: function (e, t) {
				var n, r = 0, i = this.length, a = [], s = "string" != typeof e && b(e);
				if (!x.test(e)) for (; r < i; r++) for (n = this[r]; n && n !== t; n = n.parentNode) if (n.nodeType < 11 && (s ? s.index(n) > -1 : 1 === n.nodeType && b.find.matchesSelector(n, e))) {
					a.push(n);
					break
				}
				return this.pushStack(a.length > 1 ? b.uniqueSort(a) : a)
			}, index: function (e) {
				return e ? "string" == typeof e ? c.call(b(e), this[0]) : c.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
			}, add: function (e, t) {
				return this.pushStack(b.uniqueSort(b.merge(this.get(), b(e, t))))
			}, addBack: function (e) {
				return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
			}
		}), b.each({
			parent: function (e) {
				var t = e.parentNode;
				return t && 11 !== t.nodeType ? t : null
			}, parents: function (e) {
				return D(e, "parentNode")
			}, parentsUntil: function (e, t, n) {
				return D(e, "parentNode", n)
			}, next: function (e) {
				return R(e, "nextSibling")
			}, prev: function (e) {
				return R(e, "previousSibling")
			}, nextAll: function (e) {
				return D(e, "nextSibling")
			}, prevAll: function (e) {
				return D(e, "previousSibling")
			}, nextUntil: function (e, t, n) {
				return D(e, "nextSibling", n)
			}, prevUntil: function (e, t, n) {
				return D(e, "previousSibling", n)
			}, siblings: function (e) {
				return S((e.parentNode || {}).firstChild, e)
			}, children: function (e) {
				return S(e.firstChild)
			}, contents: function (e) {
				return j(e, "iframe") ? e.contentDocument : (j(e, "template") && (e = e.content || e), b.merge([], e.childNodes))
			}
		}, function (e, t) {
			b.fn[e] = function (n, r) {
				var i = b.map(this, t, n);
				return "Until" !== e.slice(-5) && (r = n), r && "string" == typeof r && (i = b.filter(r, i)), this.length > 1 && (P[e] || b.uniqueSort(i), O.test(e) && i.reverse()), this.pushStack(i)
			}
		});
		var W = /[^\x20\t\r\n\f]+/g;

		function N(e) {
			return e
		}

		function I(e) {
			throw e
		}

		function F(e, t, n, r) {
			var i;
			try {
				e && g(i = e.promise) ? i.call(e).done(t).fail(n) : e && g(i = e.then) ? i.call(e, t, n) : t.apply(void 0, [e].slice(r))
			} catch (e) {
				n.apply(void 0, [e])
			}
		}

		b.Callbacks = function (e) {
			e = "string" == typeof e ? function (e) {
				var t = {};
				return b.each(e.match(W) || [], function (e, n) {
					t[n] = !0
				}), t
			}(e) : b.extend({}, e);
			var t, n, r, i, a = [], s = [], o = -1, u = function () {
				for (i = i || e.once, r = t = !0; s.length; o = -1) for (n = s.shift(); ++o < a.length;) !1 === a[o].apply(n[0], n[1]) && e.stopOnFalse && (o = a.length, n = !1);
				e.memory || (n = !1), t = !1, i && (a = n ? [] : "")
			}, d = {
				add: function () {
					return a && (n && !t && (o = a.length - 1, s.push(n)), function t(n) {
						b.each(n, function (n, r) {
							g(r) ? e.unique && d.has(r) || a.push(r) : r && r.length && "string" !== w(r) && t(r)
						})
					}(arguments), n && !t && u()), this
				}, remove: function () {
					return b.each(arguments, function (e, t) {
						for (var n; (n = b.inArray(t, a, n)) > -1;) a.splice(n, 1), n <= o && o--
					}), this
				}, has: function (e) {
					return e ? b.inArray(e, a) > -1 : a.length > 0
				}, empty: function () {
					return a && (a = []), this
				}, disable: function () {
					return i = s = [], a = n = "", this
				}, disabled: function () {
					return !a
				}, lock: function () {
					return i = s = [], n || t || (a = n = ""), this
				}, locked: function () {
					return !!i
				}, fireWith: function (e, n) {
					return i || (n = [e, (n = n || []).slice ? n.slice() : n], s.push(n), t || u()), this
				}, fire: function () {
					return d.fireWith(this, arguments), this
				}, fired: function () {
					return !!r
				}
			};
			return d
		}, b.extend({
			Deferred: function (e) {
				var t = [["notify", "progress", b.Callbacks("memory"), b.Callbacks("memory"), 2], ["resolve", "done", b.Callbacks("once memory"), b.Callbacks("once memory"), 0, "resolved"], ["reject", "fail", b.Callbacks("once memory"), b.Callbacks("once memory"), 1, "rejected"]],
					r = "pending", i = {
						state: function () {
							return r
						}, always: function () {
							return a.done(arguments).fail(arguments), this
						}, catch: function (e) {
							return i.then(null, e)
						}, pipe: function () {
							var e = arguments;
							return b.Deferred(function (n) {
								b.each(t, function (t, r) {
									var i = g(e[r[4]]) && e[r[4]];
									a[r[1]](function () {
										var e = i && i.apply(this, arguments);
										e && g(e.promise) ? e.promise().progress(n.notify).done(n.resolve).fail(n.reject) : n[r[0] + "With"](this, i ? [e] : arguments)
									})
								}), e = null
							}).promise()
						}, then: function (e, r, i) {
							var a = 0;

							function s(e, t, r, i) {
								return function () {
									var o = this, u = arguments, d = function () {
										var n, d;
										if (!(e < a)) {
											if ((n = r.apply(o, u)) === t.promise()) throw new TypeError("Thenable self-resolution");
											d = n && ("object" == typeof n || "function" == typeof n) && n.then, g(d) ? i ? d.call(n, s(a, t, N, i), s(a, t, I, i)) : (a++, d.call(n, s(a, t, N, i), s(a, t, I, i), s(a, t, N, t.notifyWith))) : (r !== N && (o = void 0, u = [n]), (i || t.resolveWith)(o, u))
										}
									}, l = i ? d : function () {
										try {
											d()
										} catch (n) {
											b.Deferred.exceptionHook && b.Deferred.exceptionHook(n, l.stackTrace), e + 1 >= a && (r !== I && (o = void 0, u = [n]), t.rejectWith(o, u))
										}
									};
									e ? l() : (b.Deferred.getStackHook && (l.stackTrace = b.Deferred.getStackHook()), n.setTimeout(l))
								}
							}

							return b.Deferred(function (n) {
								t[0][3].add(s(0, n, g(i) ? i : N, n.notifyWith)), t[1][3].add(s(0, n, g(e) ? e : N)), t[2][3].add(s(0, n, g(r) ? r : I))
							}).promise()
						}, promise: function (e) {
							return null != e ? b.extend(e, i) : i
						}
					}, a = {};
				return b.each(t, function (e, n) {
					var s = n[2], o = n[5];
					i[n[1]] = s.add, o && s.add(function () {
						r = o
					}, t[3 - e][2].disable, t[3 - e][3].disable, t[0][2].lock, t[0][3].lock), s.add(n[3].fire), a[n[0]] = function () {
						return a[n[0] + "With"](this === a ? void 0 : this, arguments), this
					}, a[n[0] + "With"] = s.fireWith
				}), i.promise(a), e && e.call(a, a), a
			}, when: function (e) {
				var t = arguments.length, n = t, r = Array(n), i = u.call(arguments), a = b.Deferred(),
					s = function (e) {
						return function (n) {
							r[e] = this, i[e] = arguments.length > 1 ? u.call(arguments) : n, --t || a.resolveWith(r, i)
						}
					};
				if (t <= 1 && (F(e, a.done(s(n)).resolve, a.reject, !t), "pending" === a.state() || g(i[n] && i[n].then))) return a.then();
				for (; n--;) F(i[n], s(n), a.reject);
				return a.promise()
			}
		});
		var z = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
		b.Deferred.exceptionHook = function (e, t) {
			n.console && n.console.warn && e && z.test(e.name) && n.console.warn("jQuery.Deferred exception: " + e.message, e.stack, t)
		}, b.readyException = function (e) {
			n.setTimeout(function () {
				throw e
			})
		};
		var $ = b.Deferred();

		function U() {
			s.removeEventListener("DOMContentLoaded", U), n.removeEventListener("load", U), b.ready()
		}

		b.fn.ready = function (e) {
			return $.then(e).catch(function (e) {
				b.readyException(e)
			}), this
		}, b.extend({
			isReady: !1, readyWait: 1, ready: function (e) {
				(!0 === e ? --b.readyWait : b.isReady) || (b.isReady = !0, !0 !== e && --b.readyWait > 0 || $.resolveWith(s, [b]))
			}
		}), b.ready.then = $.then, "complete" === s.readyState || "loading" !== s.readyState && !s.documentElement.doScroll ? n.setTimeout(b.ready) : (s.addEventListener("DOMContentLoaded", U), n.addEventListener("load", U));
		var B = function (e, t, n, r, i, a, s) {
			var o = 0, u = e.length, d = null == n;
			if ("object" === w(n)) for (o in i = !0, n) B(e, t, o, n[o], !0, a, s); else if (void 0 !== r && (i = !0, g(r) || (s = !0), d && (s ? (t.call(e, r), t = null) : (d = t, t = function (e, t, n) {
				return d.call(b(e), n)
			})), t)) for (; o < u; o++) t(e[o], n, s ? r : r.call(e[o], o, t(e[o], n)));
			return i ? e : d ? t.call(e) : u ? t(e[0], n) : a
		}, q = /^-ms-/, J = /-([a-z])/g;

		function G(e, t) {
			return t.toUpperCase()
		}

		function V(e) {
			return e.replace(q, "ms-").replace(J, G)
		}

		var K = function (e) {
			return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
		};

		function X() {
			this.expando = b.expando + X.uid++
		}

		X.uid = 1, X.prototype = {
			cache: function (e) {
				var t = e[this.expando];
				return t || (t = {}, K(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
					value: t,
					configurable: !0
				}))), t
			}, set: function (e, t, n) {
				var r, i = this.cache(e);
				if ("string" == typeof t) i[V(t)] = n; else for (r in t) i[V(r)] = t[r];
				return i
			}, get: function (e, t) {
				return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][V(t)]
			}, access: function (e, t, n) {
				return void 0 === t || t && "string" == typeof t && void 0 === n ? this.get(e, t) : (this.set(e, t, n), void 0 !== n ? n : t)
			}, remove: function (e, t) {
				var n, r = e[this.expando];
				if (void 0 !== r) {
					if (void 0 !== t) {
						n = (t = Array.isArray(t) ? t.map(V) : (t = V(t)) in r ? [t] : t.match(W) || []).length;
						for (; n--;) delete r[t[n]]
					}
					(void 0 === t || b.isEmptyObject(r)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando])
				}
			}, hasData: function (e) {
				var t = e[this.expando];
				return void 0 !== t && !b.isEmptyObject(t)
			}
		};
		var Z = new X, Q = new X, ee = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, te = /[A-Z]/g;

		function ne(e, t, n) {
			var r;
			if (void 0 === n && 1 === e.nodeType) if (r = "data-" + t.replace(te, "-$&").toLowerCase(), "string" == typeof(n = e.getAttribute(r))) {
				try {
					n = function (e) {
						return "true" === e || "false" !== e && ("null" === e ? null : e === +e + "" ? +e : ee.test(e) ? JSON.parse(e) : e)
					}(n)
				} catch (e) {
				}
				Q.set(e, t, n)
			} else n = void 0;
			return n
		}

		b.extend({
			hasData: function (e) {
				return Q.hasData(e) || Z.hasData(e)
			}, data: function (e, t, n) {
				return Q.access(e, t, n)
			}, removeData: function (e, t) {
				Q.remove(e, t)
			}, _data: function (e, t, n) {
				return Z.access(e, t, n)
			}, _removeData: function (e, t) {
				Z.remove(e, t)
			}
		}), b.fn.extend({
			data: function (e, t) {
				var n, r, i, a = this[0], s = a && a.attributes;
				if (void 0 === e) {
					if (this.length && (i = Q.get(a), 1 === a.nodeType && !Z.get(a, "hasDataAttrs"))) {
						for (n = s.length; n--;) s[n] && 0 === (r = s[n].name).indexOf("data-") && (r = V(r.slice(5)), ne(a, r, i[r]));
						Z.set(a, "hasDataAttrs", !0)
					}
					return i
				}
				return "object" == typeof e ? this.each(function () {
					Q.set(this, e)
				}) : B(this, function (t) {
					var n;
					if (a && void 0 === t) return void 0 !== (n = Q.get(a, e)) ? n : void 0 !== (n = ne(a, e)) ? n : void 0;
					this.each(function () {
						Q.set(this, e, t)
					})
				}, null, t, arguments.length > 1, null, !0)
			}, removeData: function (e) {
				return this.each(function () {
					Q.remove(this, e)
				})
			}
		}), b.extend({
			queue: function (e, t, n) {
				var r;
				if (e) return t = (t || "fx") + "queue", r = Z.get(e, t), n && (!r || Array.isArray(n) ? r = Z.access(e, t, b.makeArray(n)) : r.push(n)), r || []
			}, dequeue: function (e, t) {
				t = t || "fx";
				var n = b.queue(e, t), r = n.length, i = n.shift(), a = b._queueHooks(e, t);
				"inprogress" === i && (i = n.shift(), r--), i && ("fx" === t && n.unshift("inprogress"), delete a.stop, i.call(e, function () {
					b.dequeue(e, t)
				}, a)), !r && a && a.empty.fire()
			}, _queueHooks: function (e, t) {
				var n = t + "queueHooks";
				return Z.get(e, n) || Z.access(e, n, {
					empty: b.Callbacks("once memory").add(function () {
						Z.remove(e, [t + "queue", n])
					})
				})
			}
		}), b.fn.extend({
			queue: function (e, t) {
				var n = 2;
				return "string" != typeof e && (t = e, e = "fx", n--), arguments.length < n ? b.queue(this[0], e) : void 0 === t ? this : this.each(function () {
					var n = b.queue(this, e, t);
					b._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && b.dequeue(this, e)
				})
			}, dequeue: function (e) {
				return this.each(function () {
					b.dequeue(this, e)
				})
			}, clearQueue: function (e) {
				return this.queue(e || "fx", [])
			}, promise: function (e, t) {
				var n, r = 1, i = b.Deferred(), a = this, s = this.length, o = function () {
					--r || i.resolveWith(a, [a])
				};
				for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; s--;) (n = Z.get(a[s], e + "queueHooks")) && n.empty && (r++, n.empty.add(o));
				return o(), i.promise(t)
			}
		});
		var re = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
			ie = new RegExp("^(?:([+-])=|)(" + re + ")([a-z%]*)$", "i"), ae = ["Top", "Right", "Bottom", "Left"],
			se = function (e, t) {
				return "none" === (e = t || e).style.display || "" === e.style.display && b.contains(e.ownerDocument, e) && "none" === b.css(e, "display")
			}, oe = function (e, t, n, r) {
				var i, a, s = {};
				for (a in t) s[a] = e.style[a], e.style[a] = t[a];
				for (a in i = n.apply(e, r || []), t) e.style[a] = s[a];
				return i
			};

		function ue(e, t, n, r) {
			var i, a, s = 20, o = r ? function () {
					return r.cur()
				} : function () {
					return b.css(e, t, "")
				}, u = o(), d = n && n[3] || (b.cssNumber[t] ? "" : "px"),
				l = (b.cssNumber[t] || "px" !== d && +u) && ie.exec(b.css(e, t));
			if (l && l[3] !== d) {
				for (u /= 2, d = d || l[3], l = +u || 1; s--;) b.style(e, t, l + d), (1 - a) * (1 - (a = o() / u || .5)) <= 0 && (s = 0), l /= a;
				l *= 2, b.style(e, t, l + d), n = n || []
			}
			return n && (l = +l || +u || 0, i = n[1] ? l + (n[1] + 1) * n[2] : +n[2], r && (r.unit = d, r.start = l, r.end = i)), i
		}

		var de = {};

		function le(e) {
			var t, n = e.ownerDocument, r = e.nodeName, i = de[r];
			return i || (t = n.body.appendChild(n.createElement(r)), i = b.css(t, "display"), t.parentNode.removeChild(t), "none" === i && (i = "block"), de[r] = i, i)
		}

		function ce(e, t) {
			for (var n, r, i = [], a = 0, s = e.length; a < s; a++) (r = e[a]).style && (n = r.style.display, t ? ("none" === n && (i[a] = Z.get(r, "display") || null, i[a] || (r.style.display = "")), "" === r.style.display && se(r) && (i[a] = le(r))) : "none" !== n && (i[a] = "none", Z.set(r, "display", n)));
			for (a = 0; a < s; a++) null != i[a] && (e[a].style.display = i[a]);
			return e
		}

		b.fn.extend({
			show: function () {
				return ce(this, !0)
			}, hide: function () {
				return ce(this)
			}, toggle: function (e) {
				return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
					se(this) ? b(this).show() : b(this).hide()
				})
			}
		});
		var he = /^(?:checkbox|radio)$/i, fe = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i,
			_e = /^$|^module$|\/(?:java|ecma)script/i, pe = {
				option: [1, "<select multiple='multiple'>", "</select>"],
				thead: [1, "<table>", "</table>"],
				col: [2, "<table><colgroup>", "</colgroup></table>"],
				tr: [2, "<table><tbody>", "</tbody></table>"],
				td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
				_default: [0, "", ""]
			};

		function me(e, t) {
			var n;
			return n = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && j(e, t) ? b.merge([e], n) : n
		}

		function ye(e, t) {
			for (var n = 0, r = e.length; n < r; n++) Z.set(e[n], "globalEval", !t || Z.get(t[n], "globalEval"))
		}

		pe.optgroup = pe.option, pe.tbody = pe.tfoot = pe.colgroup = pe.caption = pe.thead, pe.th = pe.td;
		var ge, ve, Me = /<|&#?\w+;/;

		function Le(e, t, n, r, i) {
			for (var a, s, o, u, d, l, c = t.createDocumentFragment(), h = [], f = 0, _ = e.length; f < _; f++) if ((a = e[f]) || 0 === a) if ("object" === w(a)) b.merge(h, a.nodeType ? [a] : a); else if (Me.test(a)) {
				for (s = s || c.appendChild(t.createElement("div")), o = (fe.exec(a) || ["", ""])[1].toLowerCase(), u = pe[o] || pe._default, s.innerHTML = u[1] + b.htmlPrefilter(a) + u[2], l = u[0]; l--;) s = s.lastChild;
				b.merge(h, s.childNodes), (s = c.firstChild).textContent = ""
			} else h.push(t.createTextNode(a));
			for (c.textContent = "", f = 0; a = h[f++];) if (r && b.inArray(a, r) > -1) i && i.push(a); else if (d = b.contains(a.ownerDocument, a), s = me(c.appendChild(a), "script"), d && ye(s), n) for (l = 0; a = s[l++];) _e.test(a.type || "") && n.push(a);
			return c
		}

		ge = s.createDocumentFragment().appendChild(s.createElement("div")), (ve = s.createElement("input")).setAttribute("type", "radio"), ve.setAttribute("checked", "checked"), ve.setAttribute("name", "t"), ge.appendChild(ve), y.checkClone = ge.cloneNode(!0).cloneNode(!0).lastChild.checked, ge.innerHTML = "<textarea>x</textarea>", y.noCloneChecked = !!ge.cloneNode(!0).lastChild.defaultValue;
		var we = s.documentElement, be = /^key/, Ye = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
			ke = /^([^.]*)(?:\.(.+)|)/;

		function Te() {
			return !0
		}

		function De() {
			return !1
		}

		function Se() {
			try {
				return s.activeElement
			} catch (e) {
			}
		}

		function xe(e, t, n, r, i, a) {
			var s, o;
			if ("object" == typeof t) {
				for (o in"string" != typeof n && (r = r || n, n = void 0), t) xe(e, o, n, r, t[o], a);
				return e
			}
			if (null == r && null == i ? (i = n, r = n = void 0) : null == i && ("string" == typeof n ? (i = r, r = void 0) : (i = r, r = n, n = void 0)), !1 === i) i = De; else if (!i) return e;
			return 1 === a && (s = i, (i = function (e) {
				return b().off(e), s.apply(this, arguments)
			}).guid = s.guid || (s.guid = b.guid++)), e.each(function () {
				b.event.add(this, t, i, r, n)
			})
		}

		b.event = {
			global: {}, add: function (e, t, n, r, i) {
				var a, s, o, u, d, l, c, h, f, _, p, m = Z.get(e);
				if (m) for (n.handler && (n = (a = n).handler, i = a.selector), i && b.find.matchesSelector(we, i), n.guid || (n.guid = b.guid++), (u = m.events) || (u = m.events = {}), (s = m.handle) || (s = m.handle = function (t) {
					return void 0 !== b && b.event.triggered !== t.type ? b.event.dispatch.apply(e, arguments) : void 0
				}), d = (t = (t || "").match(W) || [""]).length; d--;) f = p = (o = ke.exec(t[d]) || [])[1], _ = (o[2] || "").split(".").sort(), f && (c = b.event.special[f] || {}, f = (i ? c.delegateType : c.bindType) || f, c = b.event.special[f] || {}, l = b.extend({
					type: f,
					origType: p,
					data: r,
					handler: n,
					guid: n.guid,
					selector: i,
					needsContext: i && b.expr.match.needsContext.test(i),
					namespace: _.join(".")
				}, a), (h = u[f]) || ((h = u[f] = []).delegateCount = 0, c.setup && !1 !== c.setup.call(e, r, _, s) || e.addEventListener && e.addEventListener(f, s)), c.add && (c.add.call(e, l), l.handler.guid || (l.handler.guid = n.guid)), i ? h.splice(h.delegateCount++, 0, l) : h.push(l), b.event.global[f] = !0)
			}, remove: function (e, t, n, r, i) {
				var a, s, o, u, d, l, c, h, f, _, p, m = Z.hasData(e) && Z.get(e);
				if (m && (u = m.events)) {
					for (d = (t = (t || "").match(W) || [""]).length; d--;) if (f = p = (o = ke.exec(t[d]) || [])[1], _ = (o[2] || "").split(".").sort(), f) {
						for (c = b.event.special[f] || {}, h = u[f = (r ? c.delegateType : c.bindType) || f] || [], o = o[2] && new RegExp("(^|\\.)" + _.join("\\.(?:.*\\.|)") + "(\\.|$)"), s = a = h.length; a--;) l = h[a], !i && p !== l.origType || n && n.guid !== l.guid || o && !o.test(l.namespace) || r && r !== l.selector && ("**" !== r || !l.selector) || (h.splice(a, 1), l.selector && h.delegateCount--, c.remove && c.remove.call(e, l));
						s && !h.length && (c.teardown && !1 !== c.teardown.call(e, _, m.handle) || b.removeEvent(e, f, m.handle), delete u[f])
					} else for (f in u) b.event.remove(e, f + t[d], n, r, !0);
					b.isEmptyObject(u) && Z.remove(e, "handle events")
				}
			}, dispatch: function (e) {
				var t, n, r, i, a, s, o = b.event.fix(e), u = new Array(arguments.length),
					d = (Z.get(this, "events") || {})[o.type] || [], l = b.event.special[o.type] || {};
				for (u[0] = o, t = 1; t < arguments.length; t++) u[t] = arguments[t];
				if (o.delegateTarget = this, !l.preDispatch || !1 !== l.preDispatch.call(this, o)) {
					for (s = b.event.handlers.call(this, o, d), t = 0; (i = s[t++]) && !o.isPropagationStopped();) for (o.currentTarget = i.elem, n = 0; (a = i.handlers[n++]) && !o.isImmediatePropagationStopped();) o.rnamespace && !o.rnamespace.test(a.namespace) || (o.handleObj = a, o.data = a.data, void 0 !== (r = ((b.event.special[a.origType] || {}).handle || a.handler).apply(i.elem, u)) && !1 === (o.result = r) && (o.preventDefault(), o.stopPropagation()));
					return l.postDispatch && l.postDispatch.call(this, o), o.result
				}
			}, handlers: function (e, t) {
				var n, r, i, a, s, o = [], u = t.delegateCount, d = e.target;
				if (u && d.nodeType && !("click" === e.type && e.button >= 1)) for (; d !== this; d = d.parentNode || this) if (1 === d.nodeType && ("click" !== e.type || !0 !== d.disabled)) {
					for (a = [], s = {}, n = 0; n < u; n++) void 0 === s[i = (r = t[n]).selector + " "] && (s[i] = r.needsContext ? b(i, this).index(d) > -1 : b.find(i, this, null, [d]).length), s[i] && a.push(r);
					a.length && o.push({elem: d, handlers: a})
				}
				return d = this, u < t.length && o.push({elem: d, handlers: t.slice(u)}), o
			}, addProp: function (e, t) {
				Object.defineProperty(b.Event.prototype, e, {
					enumerable: !0, configurable: !0, get: g(t) ? function () {
						if (this.originalEvent) return t(this.originalEvent)
					} : function () {
						if (this.originalEvent) return this.originalEvent[e]
					}, set: function (t) {
						Object.defineProperty(this, e, {enumerable: !0, configurable: !0, writable: !0, value: t})
					}
				})
			}, fix: function (e) {
				return e[b.expando] ? e : new b.Event(e)
			}, special: {
				load: {noBubble: !0}, focus: {
					trigger: function () {
						if (this !== Se() && this.focus) return this.focus(), !1
					}, delegateType: "focusin"
				}, blur: {
					trigger: function () {
						if (this === Se() && this.blur) return this.blur(), !1
					}, delegateType: "focusout"
				}, click: {
					trigger: function () {
						if ("checkbox" === this.type && this.click && j(this, "input")) return this.click(), !1
					}, _default: function (e) {
						return j(e.target, "a")
					}
				}, beforeunload: {
					postDispatch: function (e) {
						void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
					}
				}
			}
		}, b.removeEvent = function (e, t, n) {
			e.removeEventListener && e.removeEventListener(t, n)
		}, b.Event = function (e, t) {
			if (!(this instanceof b.Event)) return new b.Event(e, t);
			e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? Te : De, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && b.extend(this, t), this.timeStamp = e && e.timeStamp || Date.now(), this[b.expando] = !0
		}, b.Event.prototype = {
			constructor: b.Event,
			isDefaultPrevented: De,
			isPropagationStopped: De,
			isImmediatePropagationStopped: De,
			isSimulated: !1,
			preventDefault: function () {
				var e = this.originalEvent;
				this.isDefaultPrevented = Te, e && !this.isSimulated && e.preventDefault()
			},
			stopPropagation: function () {
				var e = this.originalEvent;
				this.isPropagationStopped = Te, e && !this.isSimulated && e.stopPropagation()
			},
			stopImmediatePropagation: function () {
				var e = this.originalEvent;
				this.isImmediatePropagationStopped = Te, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation()
			}
		}, b.each({
			altKey: !0,
			bubbles: !0,
			cancelable: !0,
			changedTouches: !0,
			ctrlKey: !0,
			detail: !0,
			eventPhase: !0,
			metaKey: !0,
			pageX: !0,
			pageY: !0,
			shiftKey: !0,
			view: !0,
			char: !0,
			charCode: !0,
			key: !0,
			keyCode: !0,
			button: !0,
			buttons: !0,
			clientX: !0,
			clientY: !0,
			offsetX: !0,
			offsetY: !0,
			pointerId: !0,
			pointerType: !0,
			screenX: !0,
			screenY: !0,
			targetTouches: !0,
			toElement: !0,
			touches: !0,
			which: function (e) {
				var t = e.button;
				return null == e.which && be.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && Ye.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which
			}
		}, b.event.addProp), b.each({
			mouseenter: "mouseover",
			mouseleave: "mouseout",
			pointerenter: "pointerover",
			pointerleave: "pointerout"
		}, function (e, t) {
			b.event.special[e] = {
				delegateType: t, bindType: t, handle: function (e) {
					var n, r = e.relatedTarget, i = e.handleObj;
					return r && (r === this || b.contains(this, r)) || (e.type = i.origType, n = i.handler.apply(this, arguments), e.type = t), n
				}
			}
		}), b.fn.extend({
			on: function (e, t, n, r) {
				return xe(this, e, t, n, r)
			}, one: function (e, t, n, r) {
				return xe(this, e, t, n, r, 1)
			}, off: function (e, t, n) {
				var r, i;
				if (e && e.preventDefault && e.handleObj) return r = e.handleObj, b(e.delegateTarget).off(r.namespace ? r.origType + "." + r.namespace : r.origType, r.selector, r.handler), this;
				if ("object" == typeof e) {
					for (i in e) this.off(i, t, e[i]);
					return this
				}
				return !1 !== t && "function" != typeof t || (n = t, t = void 0), !1 === n && (n = De), this.each(function () {
					b.event.remove(this, e, n, t)
				})
			}
		});
		var je = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
			He = /<script|<style|<link/i, Ee = /checked\s*(?:[^=]|=\s*.checked.)/i,
			Ce = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

		function Ae(e, t) {
			return j(e, "table") && j(11 !== t.nodeType ? t : t.firstChild, "tr") && b(e).children("tbody")[0] || e
		}

		function Oe(e) {
			return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
		}

		function Pe(e) {
			return "true/" === (e.type || "").slice(0, 5) ? e.type = e.type.slice(5) : e.removeAttribute("type"), e
		}

		function Re(e, t) {
			var n, r, i, a, s, o, u, d;
			if (1 === t.nodeType) {
				if (Z.hasData(e) && (a = Z.access(e), s = Z.set(t, a), d = a.events)) for (i in delete s.handle, s.events = {}, d) for (n = 0, r = d[i].length; n < r; n++) b.event.add(t, i, d[i][n]);
				Q.hasData(e) && (o = Q.access(e), u = b.extend({}, o), Q.set(t, u))
			}
		}

		function We(e, t, n, r) {
			t = d.apply([], t);
			var i, a, s, o, u, l, c = 0, h = e.length, f = h - 1, _ = t[0], p = g(_);
			if (p || h > 1 && "string" == typeof _ && !y.checkClone && Ee.test(_)) return e.each(function (i) {
				var a = e.eq(i);
				p && (t[0] = _.call(this, i, a.html())), We(a, t, n, r)
			});
			if (h && (a = (i = Le(t, e[0].ownerDocument, !1, e, r)).firstChild, 1 === i.childNodes.length && (i = a), a || r)) {
				for (o = (s = b.map(me(i, "script"), Oe)).length; c < h; c++) u = i, c !== f && (u = b.clone(u, !0, !0), o && b.merge(s, me(u, "script"))), n.call(e[c], u, c);
				if (o) for (l = s[s.length - 1].ownerDocument, b.map(s, Pe), c = 0; c < o; c++) u = s[c], _e.test(u.type || "") && !Z.access(u, "globalEval") && b.contains(l, u) && (u.src && "module" !== (u.type || "").toLowerCase() ? b._evalUrl && b._evalUrl(u.src) : L(u.textContent.replace(Ce, ""), l, u))
			}
			return e
		}

		function Ne(e, t, n) {
			for (var r, i = t ? b.filter(t, e) : e, a = 0; null != (r = i[a]); a++) n || 1 !== r.nodeType || b.cleanData(me(r)), r.parentNode && (n && b.contains(r.ownerDocument, r) && ye(me(r, "script")), r.parentNode.removeChild(r));
			return e
		}

		b.extend({
			htmlPrefilter: function (e) {
				return e.replace(je, "<$1></$2>")
			}, clone: function (e, t, n) {
				var r, i, a, s, o, u, d, l = e.cloneNode(!0), c = b.contains(e.ownerDocument, e);
				if (!(y.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || b.isXMLDoc(e))) for (s = me(l), r = 0, i = (a = me(e)).length; r < i; r++) o = a[r], u = s[r], void 0, "input" === (d = u.nodeName.toLowerCase()) && he.test(o.type) ? u.checked = o.checked : "input" !== d && "textarea" !== d || (u.defaultValue = o.defaultValue);
				if (t) if (n) for (a = a || me(e), s = s || me(l), r = 0, i = a.length; r < i; r++) Re(a[r], s[r]); else Re(e, l);
				return (s = me(l, "script")).length > 0 && ye(s, !c && me(e, "script")), l
			}, cleanData: function (e) {
				for (var t, n, r, i = b.event.special, a = 0; void 0 !== (n = e[a]); a++) if (K(n)) {
					if (t = n[Z.expando]) {
						if (t.events) for (r in t.events) i[r] ? b.event.remove(n, r) : b.removeEvent(n, r, t.handle);
						n[Z.expando] = void 0
					}
					n[Q.expando] && (n[Q.expando] = void 0)
				}
			}
		}), b.fn.extend({
			detach: function (e) {
				return Ne(this, e, !0)
			}, remove: function (e) {
				return Ne(this, e)
			}, text: function (e) {
				return B(this, function (e) {
					return void 0 === e ? b.text(this) : this.empty().each(function () {
						1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e)
					})
				}, null, e, arguments.length)
			}, append: function () {
				return We(this, arguments, function (e) {
					1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || Ae(this, e).appendChild(e)
				})
			}, prepend: function () {
				return We(this, arguments, function (e) {
					if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
						var t = Ae(this, e);
						t.insertBefore(e, t.firstChild)
					}
				})
			}, before: function () {
				return We(this, arguments, function (e) {
					this.parentNode && this.parentNode.insertBefore(e, this)
				})
			}, after: function () {
				return We(this, arguments, function (e) {
					this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
				})
			}, empty: function () {
				for (var e, t = 0; null != (e = this[t]); t++) 1 === e.nodeType && (b.cleanData(me(e, !1)), e.textContent = "");
				return this
			}, clone: function (e, t) {
				return e = null != e && e, t = null == t ? e : t, this.map(function () {
					return b.clone(this, e, t)
				})
			}, html: function (e) {
				return B(this, function (e) {
					var t = this[0] || {}, n = 0, r = this.length;
					if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
					if ("string" == typeof e && !He.test(e) && !pe[(fe.exec(e) || ["", ""])[1].toLowerCase()]) {
						e = b.htmlPrefilter(e);
						try {
							for (; n < r; n++) 1 === (t = this[n] || {}).nodeType && (b.cleanData(me(t, !1)), t.innerHTML = e);
							t = 0
						} catch (e) {
						}
					}
					t && this.empty().append(e)
				}, null, e, arguments.length)
			}, replaceWith: function () {
				var e = [];
				return We(this, arguments, function (t) {
					var n = this.parentNode;
					b.inArray(this, e) < 0 && (b.cleanData(me(this)), n && n.replaceChild(t, this))
				}, e)
			}
		}), b.each({
			appendTo: "append",
			prependTo: "prepend",
			insertBefore: "before",
			insertAfter: "after",
			replaceAll: "replaceWith"
		}, function (e, t) {
			b.fn[e] = function (e) {
				for (var n, r = [], i = b(e), a = i.length - 1, s = 0; s <= a; s++) n = s === a ? this : this.clone(!0), b(i[s])[t](n), l.apply(r, n.get());
				return this.pushStack(r)
			}
		});
		var Ie = new RegExp("^(" + re + ")(?!px)[a-z%]+$", "i"), Fe = function (e) {
			var t = e.ownerDocument.defaultView;
			return t && t.opener || (t = n), t.getComputedStyle(e)
		}, ze = new RegExp(ae.join("|"), "i");

		function $e(e, t, n) {
			var r, i, a, s, o = e.style;
			return (n = n || Fe(e)) && ("" !== (s = n.getPropertyValue(t) || n[t]) || b.contains(e.ownerDocument, e) || (s = b.style(e, t)), !y.pixelBoxStyles() && Ie.test(s) && ze.test(t) && (r = o.width, i = o.minWidth, a = o.maxWidth, o.minWidth = o.maxWidth = o.width = s, s = n.width, o.width = r, o.minWidth = i, o.maxWidth = a)), void 0 !== s ? s + "" : s
		}

		function Ue(e, t) {
			return {
				get: function () {
					if (!e()) return (this.get = t).apply(this, arguments);
					delete this.get
				}
			}
		}

		!function () {
			function e() {
				if (l) {
					d.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0", l.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%", we.appendChild(d).appendChild(l);
					var e = n.getComputedStyle(l);
					r = "1%" !== e.top, u = 12 === t(e.marginLeft), l.style.right = "60%", o = 36 === t(e.right), i = 36 === t(e.width), l.style.position = "absolute", a = 36 === l.offsetWidth || "absolute", we.removeChild(d), l = null
				}
			}

			function t(e) {
				return Math.round(parseFloat(e))
			}

			var r, i, a, o, u, d = s.createElement("div"), l = s.createElement("div");
			l.style && (l.style.backgroundClip = "content-box", l.cloneNode(!0).style.backgroundClip = "", y.clearCloneStyle = "content-box" === l.style.backgroundClip, b.extend(y, {
				boxSizingReliable: function () {
					return e(), i
				}, pixelBoxStyles: function () {
					return e(), o
				}, pixelPosition: function () {
					return e(), r
				}, reliableMarginLeft: function () {
					return e(), u
				}, scrollboxSize: function () {
					return e(), a
				}
			}))
		}();
		var Be = /^(none|table(?!-c[ea]).+)/, qe = /^--/,
			Je = {position: "absolute", visibility: "hidden", display: "block"},
			Ge = {letterSpacing: "0", fontWeight: "400"}, Ve = ["Webkit", "Moz", "ms"],
			Ke = s.createElement("div").style;

		function Xe(e) {
			var t = b.cssProps[e];
			return t || (t = b.cssProps[e] = function (e) {
				if (e in Ke) return e;
				for (var t = e[0].toUpperCase() + e.slice(1), n = Ve.length; n--;) if ((e = Ve[n] + t) in Ke) return e
			}(e) || e), t
		}

		function Ze(e, t, n) {
			var r = ie.exec(t);
			return r ? Math.max(0, r[2] - (n || 0)) + (r[3] || "px") : t
		}

		function Qe(e, t, n, r, i, a) {
			var s = "width" === t ? 1 : 0, o = 0, u = 0;
			if (n === (r ? "border" : "content")) return 0;
			for (; s < 4; s += 2) "margin" === n && (u += b.css(e, n + ae[s], !0, i)), r ? ("content" === n && (u -= b.css(e, "padding" + ae[s], !0, i)), "margin" !== n && (u -= b.css(e, "border" + ae[s] + "Width", !0, i))) : (u += b.css(e, "padding" + ae[s], !0, i), "padding" !== n ? u += b.css(e, "border" + ae[s] + "Width", !0, i) : o += b.css(e, "border" + ae[s] + "Width", !0, i));
			return !r && a >= 0 && (u += Math.max(0, Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - a - u - o - .5))), u
		}

		function et(e, t, n) {
			var r = Fe(e), i = $e(e, t, r), a = "border-box" === b.css(e, "boxSizing", !1, r), s = a;
			if (Ie.test(i)) {
				if (!n) return i;
				i = "auto"
			}
			return s = s && (y.boxSizingReliable() || i === e.style[t]), ("auto" === i || !parseFloat(i) && "inline" === b.css(e, "display", !1, r)) && (i = e["offset" + t[0].toUpperCase() + t.slice(1)], s = !0), (i = parseFloat(i) || 0) + Qe(e, t, n || (a ? "border" : "content"), s, r, i) + "px"
		}

		function tt(e, t, n, r, i) {
			return new tt.prototype.init(e, t, n, r, i)
		}

		b.extend({
			cssHooks: {
				opacity: {
					get: function (e, t) {
						if (t) {
							var n = $e(e, "opacity");
							return "" === n ? "1" : n
						}
					}
				}
			},
			cssNumber: {
				animationIterationCount: !0,
				columnCount: !0,
				fillOpacity: !0,
				flexGrow: !0,
				flexShrink: !0,
				fontWeight: !0,
				lineHeight: !0,
				opacity: !0,
				order: !0,
				orphans: !0,
				widows: !0,
				zIndex: !0,
				zoom: !0
			},
			cssProps: {},
			style: function (e, t, n, r) {
				if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
					var i, a, s, o = V(t), u = qe.test(t), d = e.style;
					if (u || (t = Xe(o)), s = b.cssHooks[t] || b.cssHooks[o], void 0 === n) return s && "get" in s && void 0 !== (i = s.get(e, !1, r)) ? i : d[t];
					"string" === (a = typeof n) && (i = ie.exec(n)) && i[1] && (n = ue(e, t, i), a = "number"), null != n && n == n && ("number" === a && (n += i && i[3] || (b.cssNumber[o] ? "" : "px")), y.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (d[t] = "inherit"), s && "set" in s && void 0 === (n = s.set(e, n, r)) || (u ? d.setProperty(t, n) : d[t] = n))
				}
			},
			css: function (e, t, n, r) {
				var i, a, s, o = V(t);
				return qe.test(t) || (t = Xe(o)), (s = b.cssHooks[t] || b.cssHooks[o]) && "get" in s && (i = s.get(e, !0, n)), void 0 === i && (i = $e(e, t, r)), "normal" === i && t in Ge && (i = Ge[t]), "" === n || n ? (a = parseFloat(i), !0 === n || isFinite(a) ? a || 0 : i) : i
			}
		}), b.each(["height", "width"], function (e, t) {
			b.cssHooks[t] = {
				get: function (e, n, r) {
					if (n) return !Be.test(b.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? et(e, t, r) : oe(e, Je, function () {
						return et(e, t, r)
					})
				}, set: function (e, n, r) {
					var i, a = Fe(e), s = "border-box" === b.css(e, "boxSizing", !1, a), o = r && Qe(e, t, r, s, a);
					return s && y.scrollboxSize() === a.position && (o -= Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - parseFloat(a[t]) - Qe(e, t, "border", !1, a) - .5)), o && (i = ie.exec(n)) && "px" !== (i[3] || "px") && (e.style[t] = n, n = b.css(e, t)), Ze(0, n, o)
				}
			}
		}), b.cssHooks.marginLeft = Ue(y.reliableMarginLeft, function (e, t) {
			if (t) return (parseFloat($e(e, "marginLeft")) || e.getBoundingClientRect().left - oe(e, {marginLeft: 0}, function () {
				return e.getBoundingClientRect().left
			})) + "px"
		}), b.each({margin: "", padding: "", border: "Width"}, function (e, t) {
			b.cssHooks[e + t] = {
				expand: function (n) {
					for (var r = 0, i = {}, a = "string" == typeof n ? n.split(" ") : [n]; r < 4; r++) i[e + ae[r] + t] = a[r] || a[r - 2] || a[0];
					return i
				}
			}, "margin" !== e && (b.cssHooks[e + t].set = Ze)
		}), b.fn.extend({
			css: function (e, t) {
				return B(this, function (e, t, n) {
					var r, i, a = {}, s = 0;
					if (Array.isArray(t)) {
						for (r = Fe(e), i = t.length; s < i; s++) a[t[s]] = b.css(e, t[s], !1, r);
						return a
					}
					return void 0 !== n ? b.style(e, t, n) : b.css(e, t)
				}, e, t, arguments.length > 1)
			}
		}), b.Tween = tt, tt.prototype = {
			constructor: tt, init: function (e, t, n, r, i, a) {
				this.elem = e, this.prop = n, this.easing = i || b.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = a || (b.cssNumber[n] ? "" : "px")
			}, cur: function () {
				var e = tt.propHooks[this.prop];
				return e && e.get ? e.get(this) : tt.propHooks._default.get(this)
			}, run: function (e) {
				var t, n = tt.propHooks[this.prop];
				return this.options.duration ? this.pos = t = b.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : tt.propHooks._default.set(this), this
			}
		}, tt.prototype.init.prototype = tt.prototype, tt.propHooks = {
			_default: {
				get: function (e) {
					var t;
					return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = b.css(e.elem, e.prop, "")) && "auto" !== t ? t : 0
				}, set: function (e) {
					b.fx.step[e.prop] ? b.fx.step[e.prop](e) : 1 !== e.elem.nodeType || null == e.elem.style[b.cssProps[e.prop]] && !b.cssHooks[e.prop] ? e.elem[e.prop] = e.now : b.style(e.elem, e.prop, e.now + e.unit)
				}
			}
		}, tt.propHooks.scrollTop = tt.propHooks.scrollLeft = {
			set: function (e) {
				e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
			}
		}, b.easing = {
			linear: function (e) {
				return e
			}, swing: function (e) {
				return .5 - Math.cos(e * Math.PI) / 2
			}, _default: "swing"
		}, b.fx = tt.prototype.init, b.fx.step = {};
		var nt, rt, it = /^(?:toggle|show|hide)$/, at = /queueHooks$/;

		function st() {
			rt && (!1 === s.hidden && n.requestAnimationFrame ? n.requestAnimationFrame(st) : n.setTimeout(st, b.fx.interval), b.fx.tick())
		}

		function ot() {
			return n.setTimeout(function () {
				nt = void 0
			}), nt = Date.now()
		}

		function ut(e, t) {
			var n, r = 0, i = {height: e};
			for (t = t ? 1 : 0; r < 4; r += 2 - t) i["margin" + (n = ae[r])] = i["padding" + n] = e;
			return t && (i.opacity = i.width = e), i
		}

		function dt(e, t, n) {
			for (var r, i = (lt.tweeners[t] || []).concat(lt.tweeners["*"]), a = 0, s = i.length; a < s; a++) if (r = i[a].call(n, t, e)) return r
		}

		function lt(e, t, n) {
			var r, i, a = 0, s = lt.prefilters.length, o = b.Deferred().always(function () {
				delete u.elem
			}), u = function () {
				if (i) return !1;
				for (var t = nt || ot(), n = Math.max(0, d.startTime + d.duration - t), r = 1 - (n / d.duration || 0), a = 0, s = d.tweens.length; a < s; a++) d.tweens[a].run(r);
				return o.notifyWith(e, [d, r, n]), r < 1 && s ? n : (s || o.notifyWith(e, [d, 1, 0]), o.resolveWith(e, [d]), !1)
			}, d = o.promise({
				elem: e,
				props: b.extend({}, t),
				opts: b.extend(!0, {specialEasing: {}, easing: b.easing._default}, n),
				originalProperties: t,
				originalOptions: n,
				startTime: nt || ot(),
				duration: n.duration,
				tweens: [],
				createTween: function (t, n) {
					var r = b.Tween(e, d.opts, t, n, d.opts.specialEasing[t] || d.opts.easing);
					return d.tweens.push(r), r
				},
				stop: function (t) {
					var n = 0, r = t ? d.tweens.length : 0;
					if (i) return this;
					for (i = !0; n < r; n++) d.tweens[n].run(1);
					return t ? (o.notifyWith(e, [d, 1, 0]), o.resolveWith(e, [d, t])) : o.rejectWith(e, [d, t]), this
				}
			}), l = d.props;
			for (!function (e, t) {
				var n, r, i, a, s;
				for (n in e) if (i = t[r = V(n)], a = e[n], Array.isArray(a) && (i = a[1], a = e[n] = a[0]), n !== r && (e[r] = a, delete e[n]), (s = b.cssHooks[r]) && "expand" in s) for (n in a = s.expand(a), delete e[r], a) n in e || (e[n] = a[n], t[n] = i); else t[r] = i
			}(l, d.opts.specialEasing); a < s; a++) if (r = lt.prefilters[a].call(d, e, l, d.opts)) return g(r.stop) && (b._queueHooks(d.elem, d.opts.queue).stop = r.stop.bind(r)), r;
			return b.map(l, dt, d), g(d.opts.start) && d.opts.start.call(e, d), d.progress(d.opts.progress).done(d.opts.done, d.opts.complete).fail(d.opts.fail).always(d.opts.always), b.fx.timer(b.extend(u, {
				elem: e,
				anim: d,
				queue: d.opts.queue
			})), d
		}

		b.Animation = b.extend(lt, {
			tweeners: {
				"*": [function (e, t) {
					var n = this.createTween(e, t);
					return ue(n.elem, e, ie.exec(t), n), n
				}]
			}, tweener: function (e, t) {
				g(e) ? (t = e, e = ["*"]) : e = e.match(W);
				for (var n, r = 0, i = e.length; r < i; r++) n = e[r], lt.tweeners[n] = lt.tweeners[n] || [], lt.tweeners[n].unshift(t)
			}, prefilters: [function (e, t, n) {
				var r, i, a, s, o, u, d, l, c = "width" in t || "height" in t, h = this, f = {}, _ = e.style,
					p = e.nodeType && se(e), m = Z.get(e, "fxshow");
				for (r in n.queue || (null == (s = b._queueHooks(e, "fx")).unqueued && (s.unqueued = 0, o = s.empty.fire, s.empty.fire = function () {
					s.unqueued || o()
				}), s.unqueued++, h.always(function () {
					h.always(function () {
						s.unqueued--, b.queue(e, "fx").length || s.empty.fire()
					})
				})), t) if (i = t[r], it.test(i)) {
					if (delete t[r], a = a || "toggle" === i, i === (p ? "hide" : "show")) {
						if ("show" !== i || !m || void 0 === m[r]) continue;
						p = !0
					}
					f[r] = m && m[r] || b.style(e, r)
				}
				if ((u = !b.isEmptyObject(t)) || !b.isEmptyObject(f)) for (r in c && 1 === e.nodeType && (n.overflow = [_.overflow, _.overflowX, _.overflowY], null == (d = m && m.display) && (d = Z.get(e, "display")), "none" === (l = b.css(e, "display")) && (d ? l = d : (ce([e], !0), d = e.style.display || d, l = b.css(e, "display"), ce([e]))), ("inline" === l || "inline-block" === l && null != d) && "none" === b.css(e, "float") && (u || (h.done(function () {
					_.display = d
				}), null == d && (l = _.display, d = "none" === l ? "" : l)), _.display = "inline-block")), n.overflow && (_.overflow = "hidden", h.always(function () {
					_.overflow = n.overflow[0], _.overflowX = n.overflow[1], _.overflowY = n.overflow[2]
				})), u = !1, f) u || (m ? "hidden" in m && (p = m.hidden) : m = Z.access(e, "fxshow", {display: d}), a && (m.hidden = !p), p && ce([e], !0), h.done(function () {
					for (r in p || ce([e]), Z.remove(e, "fxshow"), f) b.style(e, r, f[r])
				})), u = dt(p ? m[r] : 0, r, h), r in m || (m[r] = u.start, p && (u.end = u.start, u.start = 0))
			}], prefilter: function (e, t) {
				t ? lt.prefilters.unshift(e) : lt.prefilters.push(e)
			}
		}), b.speed = function (e, t, n) {
			var r = e && "object" == typeof e ? b.extend({}, e) : {
				complete: n || !n && t || g(e) && e,
				duration: e,
				easing: n && t || t && !g(t) && t
			};
			return b.fx.off ? r.duration = 0 : "number" != typeof r.duration && (r.duration in b.fx.speeds ? r.duration = b.fx.speeds[r.duration] : r.duration = b.fx.speeds._default), null != r.queue && !0 !== r.queue || (r.queue = "fx"), r.old = r.complete, r.complete = function () {
				g(r.old) && r.old.call(this), r.queue && b.dequeue(this, r.queue)
			}, r
		}, b.fn.extend({
			fadeTo: function (e, t, n, r) {
				return this.filter(se).css("opacity", 0).show().end().animate({opacity: t}, e, n, r)
			}, animate: function (e, t, n, r) {
				var i = b.isEmptyObject(e), a = b.speed(t, n, r), s = function () {
					var t = lt(this, b.extend({}, e), a);
					(i || Z.get(this, "finish")) && t.stop(!0)
				};
				return s.finish = s, i || !1 === a.queue ? this.each(s) : this.queue(a.queue, s)
			}, stop: function (e, t, n) {
				var r = function (e) {
					var t = e.stop;
					delete e.stop, t(n)
				};
				return "string" != typeof e && (n = t, t = e, e = void 0), t && !1 !== e && this.queue(e || "fx", []), this.each(function () {
					var t = !0, i = null != e && e + "queueHooks", a = b.timers, s = Z.get(this);
					if (i) s[i] && s[i].stop && r(s[i]); else for (i in s) s[i] && s[i].stop && at.test(i) && r(s[i]);
					for (i = a.length; i--;) a[i].elem !== this || null != e && a[i].queue !== e || (a[i].anim.stop(n), t = !1, a.splice(i, 1));
					!t && n || b.dequeue(this, e)
				})
			}, finish: function (e) {
				return !1 !== e && (e = e || "fx"), this.each(function () {
					var t, n = Z.get(this), r = n[e + "queue"], i = n[e + "queueHooks"], a = b.timers,
						s = r ? r.length : 0;
					for (n.finish = !0, b.queue(this, e, []), i && i.stop && i.stop.call(this, !0), t = a.length; t--;) a[t].elem === this && a[t].queue === e && (a[t].anim.stop(!0), a.splice(t, 1));
					for (t = 0; t < s; t++) r[t] && r[t].finish && r[t].finish.call(this);
					delete n.finish
				})
			}
		}), b.each(["toggle", "show", "hide"], function (e, t) {
			var n = b.fn[t];
			b.fn[t] = function (e, r, i) {
				return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(ut(t, !0), e, r, i)
			}
		}), b.each({
			slideDown: ut("show"),
			slideUp: ut("hide"),
			slideToggle: ut("toggle"),
			fadeIn: {opacity: "show"},
			fadeOut: {opacity: "hide"},
			fadeToggle: {opacity: "toggle"}
		}, function (e, t) {
			b.fn[e] = function (e, n, r) {
				return this.animate(t, e, n, r)
			}
		}), b.timers = [], b.fx.tick = function () {
			var e, t = 0, n = b.timers;
			for (nt = Date.now(); t < n.length; t++) (e = n[t])() || n[t] !== e || n.splice(t--, 1);
			n.length || b.fx.stop(), nt = void 0
		}, b.fx.timer = function (e) {
			b.timers.push(e), b.fx.start()
		}, b.fx.interval = 13, b.fx.start = function () {
			rt || (rt = !0, st())
		}, b.fx.stop = function () {
			rt = null
		}, b.fx.speeds = {slow: 600, fast: 200, _default: 400}, b.fn.delay = function (e, t) {
			return e = b.fx && b.fx.speeds[e] || e, t = t || "fx", this.queue(t, function (t, r) {
				var i = n.setTimeout(t, e);
				r.stop = function () {
					n.clearTimeout(i)
				}
			})
		}, function () {
			var e = s.createElement("input"), t = s.createElement("select").appendChild(s.createElement("option"));
			e.type = "checkbox", y.checkOn = "" !== e.value, y.optSelected = t.selected, (e = s.createElement("input")).value = "t", e.type = "radio", y.radioValue = "t" === e.value
		}();
		var ct, ht = b.expr.attrHandle;
		b.fn.extend({
			attr: function (e, t) {
				return B(this, b.attr, e, t, arguments.length > 1)
			}, removeAttr: function (e) {
				return this.each(function () {
					b.removeAttr(this, e)
				})
			}
		}), b.extend({
			attr: function (e, t, n) {
				var r, i, a = e.nodeType;
				if (3 !== a && 8 !== a && 2 !== a) return void 0 === e.getAttribute ? b.prop(e, t, n) : (1 === a && b.isXMLDoc(e) || (i = b.attrHooks[t.toLowerCase()] || (b.expr.match.bool.test(t) ? ct : void 0)), void 0 !== n ? null === n ? void b.removeAttr(e, t) : i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : (e.setAttribute(t, n + ""), n) : i && "get" in i && null !== (r = i.get(e, t)) ? r : null == (r = b.find.attr(e, t)) ? void 0 : r)
			}, attrHooks: {
				type: {
					set: function (e, t) {
						if (!y.radioValue && "radio" === t && j(e, "input")) {
							var n = e.value;
							return e.setAttribute("type", t), n && (e.value = n), t
						}
					}
				}
			}, removeAttr: function (e, t) {
				var n, r = 0, i = t && t.match(W);
				if (i && 1 === e.nodeType) for (; n = i[r++];) e.removeAttribute(n)
			}
		}), ct = {
			set: function (e, t, n) {
				return !1 === t ? b.removeAttr(e, n) : e.setAttribute(n, n), n
			}
		}, b.each(b.expr.match.bool.source.match(/\w+/g), function (e, t) {
			var n = ht[t] || b.find.attr;
			ht[t] = function (e, t, r) {
				var i, a, s = t.toLowerCase();
				return r || (a = ht[s], ht[s] = i, i = null != n(e, t, r) ? s : null, ht[s] = a), i
			}
		});
		var ft = /^(?:input|select|textarea|button)$/i, _t = /^(?:a|area)$/i;

		function pt(e) {
			return (e.match(W) || []).join(" ")
		}

		function mt(e) {
			return e.getAttribute && e.getAttribute("class") || ""
		}

		function yt(e) {
			return Array.isArray(e) ? e : "string" == typeof e && e.match(W) || []
		}

		b.fn.extend({
			prop: function (e, t) {
				return B(this, b.prop, e, t, arguments.length > 1)
			}, removeProp: function (e) {
				return this.each(function () {
					delete this[b.propFix[e] || e]
				})
			}
		}), b.extend({
			prop: function (e, t, n) {
				var r, i, a = e.nodeType;
				if (3 !== a && 8 !== a && 2 !== a) return 1 === a && b.isXMLDoc(e) || (t = b.propFix[t] || t, i = b.propHooks[t]), void 0 !== n ? i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : e[t] = n : i && "get" in i && null !== (r = i.get(e, t)) ? r : e[t]
			}, propHooks: {
				tabIndex: {
					get: function (e) {
						var t = b.find.attr(e, "tabindex");
						return t ? parseInt(t, 10) : ft.test(e.nodeName) || _t.test(e.nodeName) && e.href ? 0 : -1
					}
				}
			}, propFix: {for: "htmlFor", class: "className"}
		}), y.optSelected || (b.propHooks.selected = {
			get: function (e) {
				var t = e.parentNode;
				return t && t.parentNode && t.parentNode.selectedIndex, null
			}, set: function (e) {
				var t = e.parentNode;
				t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
			}
		}), b.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
			b.propFix[this.toLowerCase()] = this
		}), b.fn.extend({
			addClass: function (e) {
				var t, n, r, i, a, s, o, u = 0;
				if (g(e)) return this.each(function (t) {
					b(this).addClass(e.call(this, t, mt(this)))
				});
				if ((t = yt(e)).length) for (; n = this[u++];) if (i = mt(n), r = 1 === n.nodeType && " " + pt(i) + " ") {
					for (s = 0; a = t[s++];) r.indexOf(" " + a + " ") < 0 && (r += a + " ");
					i !== (o = pt(r)) && n.setAttribute("class", o)
				}
				return this
			}, removeClass: function (e) {
				var t, n, r, i, a, s, o, u = 0;
				if (g(e)) return this.each(function (t) {
					b(this).removeClass(e.call(this, t, mt(this)))
				});
				if (!arguments.length) return this.attr("class", "");
				if ((t = yt(e)).length) for (; n = this[u++];) if (i = mt(n), r = 1 === n.nodeType && " " + pt(i) + " ") {
					for (s = 0; a = t[s++];) for (; r.indexOf(" " + a + " ") > -1;) r = r.replace(" " + a + " ", " ");
					i !== (o = pt(r)) && n.setAttribute("class", o)
				}
				return this
			}, toggleClass: function (e, t) {
				var n = typeof e, r = "string" === n || Array.isArray(e);
				return "boolean" == typeof t && r ? t ? this.addClass(e) : this.removeClass(e) : g(e) ? this.each(function (n) {
					b(this).toggleClass(e.call(this, n, mt(this), t), t)
				}) : this.each(function () {
					var t, i, a, s;
					if (r) for (i = 0, a = b(this), s = yt(e); t = s[i++];) a.hasClass(t) ? a.removeClass(t) : a.addClass(t); else void 0 !== e && "boolean" !== n || ((t = mt(this)) && Z.set(this, "__className__", t), this.setAttribute && this.setAttribute("class", t || !1 === e ? "" : Z.get(this, "__className__") || ""))
				})
			}, hasClass: function (e) {
				var t, n, r = 0;
				for (t = " " + e + " "; n = this[r++];) if (1 === n.nodeType && (" " + pt(mt(n)) + " ").indexOf(t) > -1) return !0;
				return !1
			}
		});
		var gt = /\r/g;
		b.fn.extend({
			val: function (e) {
				var t, n, r, i = this[0];
				return arguments.length ? (r = g(e), this.each(function (n) {
					var i;
					1 === this.nodeType && (null == (i = r ? e.call(this, n, b(this).val()) : e) ? i = "" : "number" == typeof i ? i += "" : Array.isArray(i) && (i = b.map(i, function (e) {
						return null == e ? "" : e + ""
					})), (t = b.valHooks[this.type] || b.valHooks[this.nodeName.toLowerCase()]) && "set" in t && void 0 !== t.set(this, i, "value") || (this.value = i))
				})) : i ? (t = b.valHooks[i.type] || b.valHooks[i.nodeName.toLowerCase()]) && "get" in t && void 0 !== (n = t.get(i, "value")) ? n : "string" == typeof(n = i.value) ? n.replace(gt, "") : null == n ? "" : n : void 0
			}
		}), b.extend({
			valHooks: {
				option: {
					get: function (e) {
						var t = b.find.attr(e, "value");
						return null != t ? t : pt(b.text(e))
					}
				}, select: {
					get: function (e) {
						var t, n, r, i = e.options, a = e.selectedIndex, s = "select-one" === e.type, o = s ? null : [],
							u = s ? a + 1 : i.length;
						for (r = a < 0 ? u : s ? a : 0; r < u; r++) if (((n = i[r]).selected || r === a) && !n.disabled && (!n.parentNode.disabled || !j(n.parentNode, "optgroup"))) {
							if (t = b(n).val(), s) return t;
							o.push(t)
						}
						return o
					}, set: function (e, t) {
						for (var n, r, i = e.options, a = b.makeArray(t), s = i.length; s--;) ((r = i[s]).selected = b.inArray(b.valHooks.option.get(r), a) > -1) && (n = !0);
						return n || (e.selectedIndex = -1), a
					}
				}
			}
		}), b.each(["radio", "checkbox"], function () {
			b.valHooks[this] = {
				set: function (e, t) {
					if (Array.isArray(t)) return e.checked = b.inArray(b(e).val(), t) > -1
				}
			}, y.checkOn || (b.valHooks[this].get = function (e) {
				return null === e.getAttribute("value") ? "on" : e.value
			})
		}), y.focusin = "onfocusin" in n;
		var vt = /^(?:focusinfocus|focusoutblur)$/, Mt = function (e) {
			e.stopPropagation()
		};
		b.extend(b.event, {
			trigger: function (e, t, r, i) {
				var a, o, u, d, l, c, h, f, p = [r || s], m = _.call(e, "type") ? e.type : e,
					y = _.call(e, "namespace") ? e.namespace.split(".") : [];
				if (o = f = u = r = r || s, 3 !== r.nodeType && 8 !== r.nodeType && !vt.test(m + b.event.triggered) && (m.indexOf(".") > -1 && (m = (y = m.split(".")).shift(), y.sort()), l = m.indexOf(":") < 0 && "on" + m, (e = e[b.expando] ? e : new b.Event(m, "object" == typeof e && e)).isTrigger = i ? 2 : 3, e.namespace = y.join("."), e.rnamespace = e.namespace ? new RegExp("(^|\\.)" + y.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = r), t = null == t ? [e] : b.makeArray(t, [e]), h = b.event.special[m] || {}, i || !h.trigger || !1 !== h.trigger.apply(r, t))) {
					if (!i && !h.noBubble && !v(r)) {
						for (d = h.delegateType || m, vt.test(d + m) || (o = o.parentNode); o; o = o.parentNode) p.push(o), u = o;
						u === (r.ownerDocument || s) && p.push(u.defaultView || u.parentWindow || n)
					}
					for (a = 0; (o = p[a++]) && !e.isPropagationStopped();) f = o, e.type = a > 1 ? d : h.bindType || m, (c = (Z.get(o, "events") || {})[e.type] && Z.get(o, "handle")) && c.apply(o, t), (c = l && o[l]) && c.apply && K(o) && (e.result = c.apply(o, t), !1 === e.result && e.preventDefault());
					return e.type = m, i || e.isDefaultPrevented() || h._default && !1 !== h._default.apply(p.pop(), t) || !K(r) || l && g(r[m]) && !v(r) && ((u = r[l]) && (r[l] = null), b.event.triggered = m, e.isPropagationStopped() && f.addEventListener(m, Mt), r[m](), e.isPropagationStopped() && f.removeEventListener(m, Mt), b.event.triggered = void 0, u && (r[l] = u)), e.result
				}
			}, simulate: function (e, t, n) {
				var r = b.extend(new b.Event, n, {type: e, isSimulated: !0});
				b.event.trigger(r, null, t)
			}
		}), b.fn.extend({
			trigger: function (e, t) {
				return this.each(function () {
					b.event.trigger(e, t, this)
				})
			}, triggerHandler: function (e, t) {
				var n = this[0];
				if (n) return b.event.trigger(e, t, n, !0)
			}
		}), y.focusin || b.each({focus: "focusin", blur: "focusout"}, function (e, t) {
			var n = function (e) {
				b.event.simulate(t, e.target, b.event.fix(e))
			};
			b.event.special[t] = {
				setup: function () {
					var r = this.ownerDocument || this, i = Z.access(r, t);
					i || r.addEventListener(e, n, !0), Z.access(r, t, (i || 0) + 1)
				}, teardown: function () {
					var r = this.ownerDocument || this, i = Z.access(r, t) - 1;
					i ? Z.access(r, t, i) : (r.removeEventListener(e, n, !0), Z.remove(r, t))
				}
			}
		});
		var Lt = n.location, wt = Date.now(), bt = /\?/;
		b.parseXML = function (e) {
			var t;
			if (!e || "string" != typeof e) return null;
			try {
				t = (new n.DOMParser).parseFromString(e, "text/xml")
			} catch (e) {
				t = void 0
			}
			return t && !t.getElementsByTagName("parsererror").length || b.error("Invalid XML: " + e), t
		};
		var Yt = /\[\]$/, kt = /\r?\n/g, Tt = /^(?:submit|button|image|reset|file)$/i,
			Dt = /^(?:input|select|textarea|keygen)/i;

		function St(e, t, n, r) {
			var i;
			if (Array.isArray(t)) b.each(t, function (t, i) {
				n || Yt.test(e) ? r(e, i) : St(e + "[" + ("object" == typeof i && null != i ? t : "") + "]", i, n, r)
			}); else if (n || "object" !== w(t)) r(e, t); else for (i in t) St(e + "[" + i + "]", t[i], n, r)
		}

		b.param = function (e, t) {
			var n, r = [], i = function (e, t) {
				var n = g(t) ? t() : t;
				r[r.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n)
			};
			if (Array.isArray(e) || e.jquery && !b.isPlainObject(e)) b.each(e, function () {
				i(this.name, this.value)
			}); else for (n in e) St(n, e[n], t, i);
			return r.join("&")
		}, b.fn.extend({
			serialize: function () {
				return b.param(this.serializeArray())
			}, serializeArray: function () {
				return this.map(function () {
					var e = b.prop(this, "elements");
					return e ? b.makeArray(e) : this
				}).filter(function () {
					var e = this.type;
					return this.name && !b(this).is(":disabled") && Dt.test(this.nodeName) && !Tt.test(e) && (this.checked || !he.test(e))
				}).map(function (e, t) {
					var n = b(this).val();
					return null == n ? null : Array.isArray(n) ? b.map(n, function (e) {
						return {name: t.name, value: e.replace(kt, "\r\n")}
					}) : {name: t.name, value: n.replace(kt, "\r\n")}
				}).get()
			}
		});
		var xt = /%20/g, jt = /#.*$/, Ht = /([?&])_=[^&]*/, Et = /^(.*?):[ \t]*([^\r\n]*)$/gm, Ct = /^(?:GET|HEAD)$/,
			At = /^\/\//, Ot = {}, Pt = {}, Rt = "*/".concat("*"), Wt = s.createElement("a");

		function Nt(e) {
			return function (t, n) {
				"string" != typeof t && (n = t, t = "*");
				var r, i = 0, a = t.toLowerCase().match(W) || [];
				if (g(n)) for (; r = a[i++];) "+" === r[0] ? (r = r.slice(1) || "*", (e[r] = e[r] || []).unshift(n)) : (e[r] = e[r] || []).push(n)
			}
		}

		function It(e, t, n, r) {
			var i = {}, a = e === Pt;

			function s(o) {
				var u;
				return i[o] = !0, b.each(e[o] || [], function (e, o) {
					var d = o(t, n, r);
					return "string" != typeof d || a || i[d] ? a ? !(u = d) : void 0 : (t.dataTypes.unshift(d), s(d), !1)
				}), u
			}

			return s(t.dataTypes[0]) || !i["*"] && s("*")
		}

		function Ft(e, t) {
			var n, r, i = b.ajaxSettings.flatOptions || {};
			for (n in t) void 0 !== t[n] && ((i[n] ? e : r || (r = {}))[n] = t[n]);
			return r && b.extend(!0, e, r), e
		}

		Wt.href = Lt.href, b.extend({
			active: 0,
			lastModified: {},
			etag: {},
			ajaxSettings: {
				url: Lt.href,
				type: "GET",
				isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(Lt.protocol),
				global: !0,
				processData: !0,
				async: !0,
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				accepts: {
					"*": Rt,
					text: "text/plain",
					html: "text/html",
					xml: "application/xml, text/xml",
					json: "application/json, text/javascript"
				},
				contents: {xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/},
				responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
				converters: {"* text": String, "text html": !0, "text json": JSON.parse, "text xml": b.parseXML},
				flatOptions: {url: !0, context: !0}
			},
			ajaxSetup: function (e, t) {
				return t ? Ft(Ft(e, b.ajaxSettings), t) : Ft(b.ajaxSettings, e)
			},
			ajaxPrefilter: Nt(Ot),
			ajaxTransport: Nt(Pt),
			ajax: function (e, t) {
				"object" == typeof e && (t = e, e = void 0), t = t || {};
				var r, i, a, o, u, d, l, c, h, f, _ = b.ajaxSetup({}, t), p = _.context || _,
					m = _.context && (p.nodeType || p.jquery) ? b(p) : b.event, y = b.Deferred(),
					g = b.Callbacks("once memory"), v = _.statusCode || {}, M = {}, L = {}, w = "canceled", Y = {
						readyState: 0, getResponseHeader: function (e) {
							var t;
							if (l) {
								if (!o) for (o = {}; t = Et.exec(a);) o[t[1].toLowerCase()] = t[2];
								t = o[e.toLowerCase()]
							}
							return null == t ? null : t
						}, getAllResponseHeaders: function () {
							return l ? a : null
						}, setRequestHeader: function (e, t) {
							return null == l && (e = L[e.toLowerCase()] = L[e.toLowerCase()] || e, M[e] = t), this
						}, overrideMimeType: function (e) {
							return null == l && (_.mimeType = e), this
						}, statusCode: function (e) {
							var t;
							if (e) if (l) Y.always(e[Y.status]); else for (t in e) v[t] = [v[t], e[t]];
							return this
						}, abort: function (e) {
							var t = e || w;
							return r && r.abort(t), k(0, t), this
						}
					};
				if (y.promise(Y), _.url = ((e || _.url || Lt.href) + "").replace(At, Lt.protocol + "//"), _.type = t.method || t.type || _.method || _.type, _.dataTypes = (_.dataType || "*").toLowerCase().match(W) || [""], null == _.crossDomain) {
					d = s.createElement("a");
					try {
						d.href = _.url, d.href = d.href, _.crossDomain = Wt.protocol + "//" + Wt.host != d.protocol + "//" + d.host
					} catch (e) {
						_.crossDomain = !0
					}
				}
				if (_.data && _.processData && "string" != typeof _.data && (_.data = b.param(_.data, _.traditional)), It(Ot, _, t, Y), l) return Y;
				for (h in(c = b.event && _.global) && 0 == b.active++ && b.event.trigger("ajaxStart"), _.type = _.type.toUpperCase(), _.hasContent = !Ct.test(_.type), i = _.url.replace(jt, ""), _.hasContent ? _.data && _.processData && 0 === (_.contentType || "").indexOf("application/x-www-form-urlencoded") && (_.data = _.data.replace(xt, "+")) : (f = _.url.slice(i.length), _.data && (_.processData || "string" == typeof _.data) && (i += (bt.test(i) ? "&" : "?") + _.data, delete _.data), !1 === _.cache && (i = i.replace(Ht, "$1"), f = (bt.test(i) ? "&" : "?") + "_=" + wt++ + f), _.url = i + f), _.ifModified && (b.lastModified[i] && Y.setRequestHeader("If-Modified-Since", b.lastModified[i]), b.etag[i] && Y.setRequestHeader("If-None-Match", b.etag[i])), (_.data && _.hasContent && !1 !== _.contentType || t.contentType) && Y.setRequestHeader("Content-Type", _.contentType), Y.setRequestHeader("Accept", _.dataTypes[0] && _.accepts[_.dataTypes[0]] ? _.accepts[_.dataTypes[0]] + ("*" !== _.dataTypes[0] ? ", " + Rt + "; q=0.01" : "") : _.accepts["*"]), _.headers) Y.setRequestHeader(h, _.headers[h]);
				if (_.beforeSend && (!1 === _.beforeSend.call(p, Y, _) || l)) return Y.abort();
				if (w = "abort", g.add(_.complete), Y.done(_.success), Y.fail(_.error), r = It(Pt, _, t, Y)) {
					if (Y.readyState = 1, c && m.trigger("ajaxSend", [Y, _]), l) return Y;
					_.async && _.timeout > 0 && (u = n.setTimeout(function () {
						Y.abort("timeout")
					}, _.timeout));
					try {
						l = !1, r.send(M, k)
					} catch (e) {
						if (l) throw e;
						k(-1, e)
					}
				} else k(-1, "No Transport");

				function k(e, t, s, o) {
					var d, h, f, M, L, w = t;
					l || (l = !0, u && n.clearTimeout(u), r = void 0, a = o || "", Y.readyState = e > 0 ? 4 : 0, d = e >= 200 && e < 300 || 304 === e, s && (M = function (e, t, n) {
						for (var r, i, a, s, o = e.contents, u = e.dataTypes; "*" === u[0];) u.shift(), void 0 === r && (r = e.mimeType || t.getResponseHeader("Content-Type"));
						if (r) for (i in o) if (o[i] && o[i].test(r)) {
							u.unshift(i);
							break
						}
						if (u[0] in n) a = u[0]; else {
							for (i in n) {
								if (!u[0] || e.converters[i + " " + u[0]]) {
									a = i;
									break
								}
								s || (s = i)
							}
							a = a || s
						}
						if (a) return a !== u[0] && u.unshift(a), n[a]
					}(_, Y, s)), M = function (e, t, n, r) {
						var i, a, s, o, u, d = {}, l = e.dataTypes.slice();
						if (l[1]) for (s in e.converters) d[s.toLowerCase()] = e.converters[s];
						for (a = l.shift(); a;) if (e.responseFields[a] && (n[e.responseFields[a]] = t), !u && r && e.dataFilter && (t = e.dataFilter(t, e.dataType)), u = a, a = l.shift()) if ("*" === a) a = u; else if ("*" !== u && u !== a) {
							if (!(s = d[u + " " + a] || d["* " + a])) for (i in d) if ((o = i.split(" "))[1] === a && (s = d[u + " " + o[0]] || d["* " + o[0]])) {
								!0 === s ? s = d[i] : !0 !== d[i] && (a = o[0], l.unshift(o[1]));
								break
							}
							if (!0 !== s) if (s && e.throws) t = s(t); else try {
								t = s(t)
							} catch (e) {
								return {state: "parsererror", error: s ? e : "No conversion from " + u + " to " + a}
							}
						}
						return {state: "success", data: t}
					}(_, M, Y, d), d ? (_.ifModified && ((L = Y.getResponseHeader("Last-Modified")) && (b.lastModified[i] = L), (L = Y.getResponseHeader("etag")) && (b.etag[i] = L)), 204 === e || "HEAD" === _.type ? w = "nocontent" : 304 === e ? w = "notmodified" : (w = M.state, h = M.data, d = !(f = M.error))) : (f = w, !e && w || (w = "error", e < 0 && (e = 0))), Y.status = e, Y.statusText = (t || w) + "", d ? y.resolveWith(p, [h, w, Y]) : y.rejectWith(p, [Y, w, f]), Y.statusCode(v), v = void 0, c && m.trigger(d ? "ajaxSuccess" : "ajaxError", [Y, _, d ? h : f]), g.fireWith(p, [Y, w]), c && (m.trigger("ajaxComplete", [Y, _]), --b.active || b.event.trigger("ajaxStop")))
				}

				return Y
			},
			getJSON: function (e, t, n) {
				return b.get(e, t, n, "json")
			},
			getScript: function (e, t) {
				return b.get(e, void 0, t, "script")
			}
		}), b.each(["get", "post"], function (e, t) {
			b[t] = function (e, n, r, i) {
				return g(n) && (i = i || r, r = n, n = void 0), b.ajax(b.extend({
					url: e,
					type: t,
					dataType: i,
					data: n,
					success: r
				}, b.isPlainObject(e) && e))
			}
		}), b._evalUrl = function (e) {
			return b.ajax({url: e, type: "GET", dataType: "script", cache: !0, async: !1, global: !1, throws: !0})
		}, b.fn.extend({
			wrapAll: function (e) {
				var t;
				return this[0] && (g(e) && (e = e.call(this[0])), t = b(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
					for (var e = this; e.firstElementChild;) e = e.firstElementChild;
					return e
				}).append(this)), this
			}, wrapInner: function (e) {
				return g(e) ? this.each(function (t) {
					b(this).wrapInner(e.call(this, t))
				}) : this.each(function () {
					var t = b(this), n = t.contents();
					n.length ? n.wrapAll(e) : t.append(e)
				})
			}, wrap: function (e) {
				var t = g(e);
				return this.each(function (n) {
					b(this).wrapAll(t ? e.call(this, n) : e)
				})
			}, unwrap: function (e) {
				return this.parent(e).not("body").each(function () {
					b(this).replaceWith(this.childNodes)
				}), this
			}
		}), b.expr.pseudos.hidden = function (e) {
			return !b.expr.pseudos.visible(e)
		}, b.expr.pseudos.visible = function (e) {
			return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length)
		}, b.ajaxSettings.xhr = function () {
			try {
				return new n.XMLHttpRequest
			} catch (e) {
			}
		};
		var zt = {0: 200, 1223: 204}, $t = b.ajaxSettings.xhr();
		y.cors = !!$t && "withCredentials" in $t, y.ajax = $t = !!$t, b.ajaxTransport(function (e) {
			var t, r;
			if (y.cors || $t && !e.crossDomain) return {
				send: function (i, a) {
					var s, o = e.xhr();
					if (o.open(e.type, e.url, e.async, e.username, e.password), e.xhrFields) for (s in e.xhrFields) o[s] = e.xhrFields[s];
					for (s in e.mimeType && o.overrideMimeType && o.overrideMimeType(e.mimeType), e.crossDomain || i["X-Requested-With"] || (i["X-Requested-With"] = "XMLHttpRequest"), i) o.setRequestHeader(s, i[s]);
					t = function (e) {
						return function () {
							t && (t = r = o.onload = o.onerror = o.onabort = o.ontimeout = o.onreadystatechange = null, "abort" === e ? o.abort() : "error" === e ? "number" != typeof o.status ? a(0, "error") : a(o.status, o.statusText) : a(zt[o.status] || o.status, o.statusText, "text" !== (o.responseType || "text") || "string" != typeof o.responseText ? {binary: o.response} : {text: o.responseText}, o.getAllResponseHeaders()))
						}
					}, o.onload = t(), r = o.onerror = o.ontimeout = t("error"), void 0 !== o.onabort ? o.onabort = r : o.onreadystatechange = function () {
						4 === o.readyState && n.setTimeout(function () {
							t && r()
						})
					}, t = t("abort");
					try {
						o.send(e.hasContent && e.data || null)
					} catch (e) {
						if (t) throw e
					}
				}, abort: function () {
					t && t()
				}
			}
		}), b.ajaxPrefilter(function (e) {
			e.crossDomain && (e.contents.script = !1)
		}), b.ajaxSetup({
			accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
			contents: {script: /\b(?:java|ecma)script\b/},
			converters: {
				"text script": function (e) {
					return b.globalEval(e), e
				}
			}
		}), b.ajaxPrefilter("script", function (e) {
			void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
		}), b.ajaxTransport("script", function (e) {
			var t, n;
			if (e.crossDomain) return {
				send: function (r, i) {
					t = b("<script>").prop({charset: e.scriptCharset, src: e.url}).on("load error", n = function (e) {
						t.remove(), n = null, e && i("error" === e.type ? 404 : 200, e.type)
					}), s.head.appendChild(t[0])
				}, abort: function () {
					n && n()
				}
			}
		});
		var Ut, Bt = [], qt = /(=)\?(?=&|$)|\?\?/;
		b.ajaxSetup({
			jsonp: "callback", jsonpCallback: function () {
				var e = Bt.pop() || b.expando + "_" + wt++;
				return this[e] = !0, e
			}
		}), b.ajaxPrefilter("json jsonp", function (e, t, r) {
			var i, a, s,
				o = !1 !== e.jsonp && (qt.test(e.url) ? "url" : "string" == typeof e.data && 0 === (e.contentType || "").indexOf("application/x-www-form-urlencoded") && qt.test(e.data) && "data");
			if (o || "jsonp" === e.dataTypes[0]) return i = e.jsonpCallback = g(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, o ? e[o] = e[o].replace(qt, "$1" + i) : !1 !== e.jsonp && (e.url += (bt.test(e.url) ? "&" : "?") + e.jsonp + "=" + i), e.converters["script json"] = function () {
				return s || b.error(i + " was not called"), s[0]
			}, e.dataTypes[0] = "json", a = n[i], n[i] = function () {
				s = arguments
			}, r.always(function () {
				void 0 === a ? b(n).removeProp(i) : n[i] = a, e[i] && (e.jsonpCallback = t.jsonpCallback, Bt.push(i)), s && g(a) && a(s[0]), s = a = void 0
			}), "script"
		}), y.createHTMLDocument = ((Ut = s.implementation.createHTMLDocument("").body).innerHTML = "<form></form><form></form>", 2 === Ut.childNodes.length), b.parseHTML = function (e, t, n) {
			return "string" != typeof e ? [] : ("boolean" == typeof t && (n = t, t = !1), t || (y.createHTMLDocument ? ((r = (t = s.implementation.createHTMLDocument("")).createElement("base")).href = s.location.href, t.head.appendChild(r)) : t = s), i = H.exec(e), a = !n && [], i ? [t.createElement(i[1])] : (i = Le([e], t, a), a && a.length && b(a).remove(), b.merge([], i.childNodes)));
			var r, i, a
		}, b.fn.load = function (e, t, n) {
			var r, i, a, s = this, o = e.indexOf(" ");
			return o > -1 && (r = pt(e.slice(o)), e = e.slice(0, o)), g(t) ? (n = t, t = void 0) : t && "object" == typeof t && (i = "POST"), s.length > 0 && b.ajax({
				url: e,
				type: i || "GET",
				dataType: "html",
				data: t
			}).done(function (e) {
				a = arguments, s.html(r ? b("<div>").append(b.parseHTML(e)).find(r) : e)
			}).always(n && function (e, t) {
				s.each(function () {
					n.apply(this, a || [e.responseText, t, e])
				})
			}), this
		}, b.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
			b.fn[t] = function (e) {
				return this.on(t, e)
			}
		}), b.expr.pseudos.animated = function (e) {
			return b.grep(b.timers, function (t) {
				return e === t.elem
			}).length
		}, b.offset = {
			setOffset: function (e, t, n) {
				var r, i, a, s, o, u, d = b.css(e, "position"), l = b(e), c = {};
				"static" === d && (e.style.position = "relative"), o = l.offset(), a = b.css(e, "top"), u = b.css(e, "left"), ("absolute" === d || "fixed" === d) && (a + u).indexOf("auto") > -1 ? (s = (r = l.position()).top, i = r.left) : (s = parseFloat(a) || 0, i = parseFloat(u) || 0), g(t) && (t = t.call(e, n, b.extend({}, o))), null != t.top && (c.top = t.top - o.top + s), null != t.left && (c.left = t.left - o.left + i), "using" in t ? t.using.call(e, c) : l.css(c)
			}
		}, b.fn.extend({
			offset: function (e) {
				if (arguments.length) return void 0 === e ? this : this.each(function (t) {
					b.offset.setOffset(this, e, t)
				});
				var t, n, r = this[0];
				return r ? r.getClientRects().length ? (t = r.getBoundingClientRect(), n = r.ownerDocument.defaultView, {
					top: t.top + n.pageYOffset,
					left: t.left + n.pageXOffset
				}) : {top: 0, left: 0} : void 0
			}, position: function () {
				if (this[0]) {
					var e, t, n, r = this[0], i = {top: 0, left: 0};
					if ("fixed" === b.css(r, "position")) t = r.getBoundingClientRect(); else {
						for (t = this.offset(), n = r.ownerDocument, e = r.offsetParent || n.documentElement; e && (e === n.body || e === n.documentElement) && "static" === b.css(e, "position");) e = e.parentNode;
						e && e !== r && 1 === e.nodeType && ((i = b(e).offset()).top += b.css(e, "borderTopWidth", !0), i.left += b.css(e, "borderLeftWidth", !0))
					}
					return {
						top: t.top - i.top - b.css(r, "marginTop", !0),
						left: t.left - i.left - b.css(r, "marginLeft", !0)
					}
				}
			}, offsetParent: function () {
				return this.map(function () {
					for (var e = this.offsetParent; e && "static" === b.css(e, "position");) e = e.offsetParent;
					return e || we
				})
			}
		}), b.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (e, t) {
			var n = "pageYOffset" === t;
			b.fn[e] = function (r) {
				return B(this, function (e, r, i) {
					var a;
					if (v(e) ? a = e : 9 === e.nodeType && (a = e.defaultView), void 0 === i) return a ? a[t] : e[r];
					a ? a.scrollTo(n ? a.pageXOffset : i, n ? i : a.pageYOffset) : e[r] = i
				}, e, r, arguments.length)
			}
		}), b.each(["top", "left"], function (e, t) {
			b.cssHooks[t] = Ue(y.pixelPosition, function (e, n) {
				if (n) return n = $e(e, t), Ie.test(n) ? b(e).position()[t] + "px" : n
			})
		}), b.each({Height: "height", Width: "width"}, function (e, t) {
			b.each({padding: "inner" + e, content: t, "": "outer" + e}, function (n, r) {
				b.fn[r] = function (i, a) {
					var s = arguments.length && (n || "boolean" != typeof i),
						o = n || (!0 === i || !0 === a ? "margin" : "border");
					return B(this, function (t, n, i) {
						var a;
						return v(t) ? 0 === r.indexOf("outer") ? t["inner" + e] : t.document.documentElement["client" + e] : 9 === t.nodeType ? (a = t.documentElement, Math.max(t.body["scroll" + e], a["scroll" + e], t.body["offset" + e], a["offset" + e], a["client" + e])) : void 0 === i ? b.css(t, n, o) : b.style(t, n, i, o)
					}, t, s ? i : void 0, s)
				}
			})
		}), b.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function (e, t) {
			b.fn[t] = function (e, n) {
				return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
			}
		}), b.fn.extend({
			hover: function (e, t) {
				return this.mouseenter(e).mouseleave(t || e)
			}
		}), b.fn.extend({
			bind: function (e, t, n) {
				return this.on(e, null, t, n)
			}, unbind: function (e, t) {
				return this.off(e, null, t)
			}, delegate: function (e, t, n, r) {
				return this.on(t, e, n, r)
			}, undelegate: function (e, t, n) {
				return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
			}
		}), b.proxy = function (e, t) {
			var n, r, i;
			if ("string" == typeof t && (n = e[t], t = e, e = n), g(e)) return r = u.call(arguments, 2), (i = function () {
				return e.apply(t || this, r.concat(u.call(arguments)))
			}).guid = e.guid = e.guid || b.guid++, i
		}, b.holdReady = function (e) {
			e ? b.readyWait++ : b.ready(!0)
		}, b.isArray = Array.isArray, b.parseJSON = JSON.parse, b.nodeName = j, b.isFunction = g, b.isWindow = v, b.camelCase = V, b.type = w, b.now = Date.now, b.isNumeric = function (e) {
			var t = b.type(e);
			return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e))
		}, void 0 === (r = function () {
			return b
		}.apply(t, [])) || (e.exports = r);
		var Jt = n.jQuery, Gt = n.$;
		return b.noConflict = function (e) {
			return n.$ === b && (n.$ = Gt), e && n.jQuery === b && (n.jQuery = Jt), b
		}, i || (n.jQuery = n.$ = b), b
	})
}, function (e, t, n) {
	"use strict";
	(function (t) {
		var r = n(1), i = n(144), a = {"Content-Type": "application/x-www-form-urlencoded"};

		function s(e, t) {
			!r.isUndefined(e) && r.isUndefined(e["Content-Type"]) && (e["Content-Type"] = t)
		}

		var o, u = {
			adapter: ("undefined" != typeof XMLHttpRequest ? o = n(6) : void 0 !== t && (o = n(6)), o),
			transformRequest: [function (e, t) {
				return i(t, "Content-Type"), r.isFormData(e) || r.isArrayBuffer(e) || r.isBuffer(e) || r.isStream(e) || r.isFile(e) || r.isBlob(e) ? e : r.isArrayBufferView(e) ? e.buffer : r.isURLSearchParams(e) ? (s(t, "application/x-www-form-urlencoded;charset=utf-8"), e.toString()) : r.isObject(e) ? (s(t, "application/json;charset=utf-8"), JSON.stringify(e)) : e
			}],
			transformResponse: [function (e) {
				if ("string" == typeof e) try {
					e = JSON.parse(e)
				} catch (e) {
				}
				return e
			}],
			timeout: 0,
			xsrfCookieName: "XSRF-TOKEN",
			xsrfHeaderName: "X-XSRF-TOKEN",
			maxContentLength: -1,
			validateStatus: function (e) {
				return e >= 200 && e < 300
			}
		};
		u.headers = {common: {Accept: "application/json, text/plain, */*"}}, r.forEach(["delete", "get", "head"], function (e) {
			u.headers[e] = {}
		}), r.forEach(["post", "put", "patch"], function (e) {
			u.headers[e] = r.merge(a)
		}), e.exports = u
	}).call(t, n(143))
}, function (e, t) {
	e.exports = function (e) {
		return e.webpackPolyfill || (e.deprecate = function () {
		}, e.paths = [], e.children || (e.children = []), Object.defineProperty(e, "loaded", {
			enumerable: !0,
			get: function () {
				return e.l
			}
		}), Object.defineProperty(e, "id", {
			enumerable: !0, get: function () {
				return e.i
			}
		}), e.webpackPolyfill = 1), e
	}
}, function (e, t, n) {
	"use strict";
	e.exports = function (e, t) {
		return function () {
			for (var n = new Array(arguments.length), r = 0; r < n.length; r++) n[r] = arguments[r];
			return e.apply(t, n)
		}
	}
}, function (e, t, n) {
	"use strict";
	var r = n(1), i = n(145), a = n(147), s = n(148), o = n(149), u = n(7),
		d = "undefined" != typeof window && window.btoa && window.btoa.bind(window) || n(150);
	e.exports = function (e) {
		return new Promise(function (t, l) {
			var c = e.data, h = e.headers;
			r.isFormData(c) && delete h["Content-Type"];
			var f = new XMLHttpRequest, _ = "onreadystatechange", p = !1;
			if ("undefined" == typeof window || !window.XDomainRequest || "withCredentials" in f || o(e.url) || (f = new window.XDomainRequest, _ = "onload", p = !0, f.onprogress = function () {
			}, f.ontimeout = function () {
			}), e.auth) {
				var m = e.auth.username || "", y = e.auth.password || "";
				h.Authorization = "Basic " + d(m + ":" + y)
			}
			if (f.open(e.method.toUpperCase(), a(e.url, e.params, e.paramsSerializer), !0), f.timeout = e.timeout, f[_] = function () {
				if (f && (4 === f.readyState || p) && (0 !== f.status || f.responseURL && 0 === f.responseURL.indexOf("file:"))) {
					var n = "getAllResponseHeaders" in f ? s(f.getAllResponseHeaders()) : null, r = {
						data: e.responseType && "text" !== e.responseType ? f.response : f.responseText,
						status: 1223 === f.status ? 204 : f.status,
						statusText: 1223 === f.status ? "No Content" : f.statusText,
						headers: n,
						config: e,
						request: f
					};
					i(t, l, r), f = null
				}
			}, f.onerror = function () {
				l(u("Network Error", e, null, f)), f = null
			}, f.ontimeout = function () {
				l(u("timeout of " + e.timeout + "ms exceeded", e, "ECONNABORTED", f)), f = null
			}, r.isStandardBrowserEnv()) {
				var g = n(151),
					v = (e.withCredentials || o(e.url)) && e.xsrfCookieName ? g.read(e.xsrfCookieName) : void 0;
				v && (h[e.xsrfHeaderName] = v)
			}
			if ("setRequestHeader" in f && r.forEach(h, function (e, t) {
				void 0 === c && "content-type" === t.toLowerCase() ? delete h[t] : f.setRequestHeader(t, e)
			}), e.withCredentials && (f.withCredentials = !0), e.responseType) try {
				f.responseType = e.responseType
			} catch (t) {
				if ("json" !== e.responseType) throw t
			}
			"function" == typeof e.onDownloadProgress && f.addEventListener("progress", e.onDownloadProgress), "function" == typeof e.onUploadProgress && f.upload && f.upload.addEventListener("progress", e.onUploadProgress), e.cancelToken && e.cancelToken.promise.then(function (e) {
				f && (f.abort(), l(e), f = null)
			}), void 0 === c && (c = null), f.send(c)
		})
	}
}, function (e, t, n) {
	"use strict";
	var r = n(146);
	e.exports = function (e, t, n, i, a) {
		var s = new Error(e);
		return r(s, t, n, i, a)
	}
}, function (e, t, n) {
	"use strict";
	e.exports = function (e) {
		return !(!e || !e.__CANCEL__)
	}
}, function (e, t, n) {
	"use strict";

	function r(e) {
		this.message = e
	}

	r.prototype.toString = function () {
		return "Cancel" + (this.message ? ": " + this.message : "")
	}, r.prototype.__CANCEL__ = !0, e.exports = r
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("af", {
			months: "Januarie_Februarie_Maart_April_Mei_Junie_Julie_Augustus_September_Oktober_November_Desember".split("_"),
			monthsShort: "Jan_Feb_Mrt_Apr_Mei_Jun_Jul_Aug_Sep_Okt_Nov_Des".split("_"),
			weekdays: "Sondag_Maandag_Dinsdag_Woensdag_Donderdag_Vrydag_Saterdag".split("_"),
			weekdaysShort: "Son_Maa_Din_Woe_Don_Vry_Sat".split("_"),
			weekdaysMin: "So_Ma_Di_Wo_Do_Vr_Sa".split("_"),
			meridiemParse: /vm|nm/i,
			isPM: function (e) {
				return /^nm$/i.test(e)
			},
			meridiem: function (e, t, n) {
				return e < 12 ? n ? "vm" : "VM" : n ? "nm" : "NM"
			},
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Vandag om] LT",
				nextDay: "[Môre om] LT",
				nextWeek: "dddd [om] LT",
				lastDay: "[Gister om] LT",
				lastWeek: "[Laas] dddd [om] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "oor %s",
				past: "%s gelede",
				s: "'n paar sekondes",
				ss: "%d sekondes",
				m: "'n minuut",
				mm: "%d minute",
				h: "'n uur",
				hh: "%d ure",
				d: "'n dag",
				dd: "%d dae",
				M: "'n maand",
				MM: "%d maande",
				y: "'n jaar",
				yy: "%d jaar"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(ste|de)/,
			ordinal: function (e) {
				return e + (1 === e || 8 === e || e >= 20 ? "ste" : "de")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "١", 2: "٢", 3: "٣", 4: "٤", 5: "٥", 6: "٦", 7: "٧", 8: "٨", 9: "٩", 0: "٠"},
			n = {"١": "1", "٢": "2", "٣": "3", "٤": "4", "٥": "5", "٦": "6", "٧": "7", "٨": "8", "٩": "9", "٠": "0"},
			r = function (e) {
				return 0 === e ? 0 : 1 === e ? 1 : 2 === e ? 2 : e % 100 >= 3 && e % 100 <= 10 ? 3 : e % 100 >= 11 ? 4 : 5
			}, i = {
				s: ["أقل من ثانية", "ثانية واحدة", ["ثانيتان", "ثانيتين"], "%d ثوان", "%d ثانية", "%d ثانية"],
				m: ["أقل من دقيقة", "دقيقة واحدة", ["دقيقتان", "دقيقتين"], "%d دقائق", "%d دقيقة", "%d دقيقة"],
				h: ["أقل من ساعة", "ساعة واحدة", ["ساعتان", "ساعتين"], "%d ساعات", "%d ساعة", "%d ساعة"],
				d: ["أقل من يوم", "يوم واحد", ["يومان", "يومين"], "%d أيام", "%d يومًا", "%d يوم"],
				M: ["أقل من شهر", "شهر واحد", ["شهران", "شهرين"], "%d أشهر", "%d شهرا", "%d شهر"],
				y: ["أقل من عام", "عام واحد", ["عامان", "عامين"], "%d أعوام", "%d عامًا", "%d عام"]
			}, a = function (e) {
				return function (t, n, a, s) {
					var o = r(t), u = i[e][r(t)];
					return 2 === o && (u = u[n ? 0 : 1]), u.replace(/%d/i, t)
				}
			},
			s = ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];
		e.defineLocale("ar", {
			months: s,
			monthsShort: s,
			weekdays: "الأحد_الإثنين_الثلاثاء_الأربعاء_الخميس_الجمعة_السبت".split("_"),
			weekdaysShort: "أحد_إثنين_ثلاثاء_أربعاء_خميس_جمعة_سبت".split("_"),
			weekdaysMin: "ح_ن_ث_ر_خ_ج_س".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "D/‏M/‏YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			meridiemParse: /ص|م/,
			isPM: function (e) {
				return "م" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "ص" : "م"
			},
			calendar: {
				sameDay: "[اليوم عند الساعة] LT",
				nextDay: "[غدًا عند الساعة] LT",
				nextWeek: "dddd [عند الساعة] LT",
				lastDay: "[أمس عند الساعة] LT",
				lastWeek: "dddd [عند الساعة] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "بعد %s",
				past: "منذ %s",
				s: a("s"),
				ss: a("s"),
				m: a("m"),
				mm: a("m"),
				h: a("h"),
				hh: a("h"),
				d: a("d"),
				dd: a("d"),
				M: a("M"),
				MM: a("M"),
				y: a("y"),
				yy: a("y")
			},
			preparse: function (e) {
				return e.replace(/[١٢٣٤٥٦٧٨٩٠]/g, function (e) {
					return n[e]
				}).replace(/،/g, ",")
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				}).replace(/,/g, "،")
			},
			week: {dow: 6, doy: 12}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ar-dz", {
			months: "جانفي_فيفري_مارس_أفريل_ماي_جوان_جويلية_أوت_سبتمبر_أكتوبر_نوفمبر_ديسمبر".split("_"),
			monthsShort: "جانفي_فيفري_مارس_أفريل_ماي_جوان_جويلية_أوت_سبتمبر_أكتوبر_نوفمبر_ديسمبر".split("_"),
			weekdays: "الأحد_الإثنين_الثلاثاء_الأربعاء_الخميس_الجمعة_السبت".split("_"),
			weekdaysShort: "احد_اثنين_ثلاثاء_اربعاء_خميس_جمعة_سبت".split("_"),
			weekdaysMin: "أح_إث_ثلا_أر_خم_جم_سب".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[اليوم على الساعة] LT",
				nextDay: "[غدا على الساعة] LT",
				nextWeek: "dddd [على الساعة] LT",
				lastDay: "[أمس على الساعة] LT",
				lastWeek: "dddd [على الساعة] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "في %s",
				past: "منذ %s",
				s: "ثوان",
				ss: "%d ثانية",
				m: "دقيقة",
				mm: "%d دقائق",
				h: "ساعة",
				hh: "%d ساعات",
				d: "يوم",
				dd: "%d أيام",
				M: "شهر",
				MM: "%d أشهر",
				y: "سنة",
				yy: "%d سنوات"
			},
			week: {dow: 0, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ar-kw", {
			months: "يناير_فبراير_مارس_أبريل_ماي_يونيو_يوليوز_غشت_شتنبر_أكتوبر_نونبر_دجنبر".split("_"),
			monthsShort: "يناير_فبراير_مارس_أبريل_ماي_يونيو_يوليوز_غشت_شتنبر_أكتوبر_نونبر_دجنبر".split("_"),
			weekdays: "الأحد_الإتنين_الثلاثاء_الأربعاء_الخميس_الجمعة_السبت".split("_"),
			weekdaysShort: "احد_اتنين_ثلاثاء_اربعاء_خميس_جمعة_سبت".split("_"),
			weekdaysMin: "ح_ن_ث_ر_خ_ج_س".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[اليوم على الساعة] LT",
				nextDay: "[غدا على الساعة] LT",
				nextWeek: "dddd [على الساعة] LT",
				lastDay: "[أمس على الساعة] LT",
				lastWeek: "dddd [على الساعة] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "في %s",
				past: "منذ %s",
				s: "ثوان",
				ss: "%d ثانية",
				m: "دقيقة",
				mm: "%d دقائق",
				h: "ساعة",
				hh: "%d ساعات",
				d: "يوم",
				dd: "%d أيام",
				M: "شهر",
				MM: "%d أشهر",
				y: "سنة",
				yy: "%d سنوات"
			},
			week: {dow: 0, doy: 12}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "1", 2: "2", 3: "3", 4: "4", 5: "5", 6: "6", 7: "7", 8: "8", 9: "9", 0: "0"}, n = function (e) {
				return 0 === e ? 0 : 1 === e ? 1 : 2 === e ? 2 : e % 100 >= 3 && e % 100 <= 10 ? 3 : e % 100 >= 11 ? 4 : 5
			}, r = {
				s: ["أقل من ثانية", "ثانية واحدة", ["ثانيتان", "ثانيتين"], "%d ثوان", "%d ثانية", "%d ثانية"],
				m: ["أقل من دقيقة", "دقيقة واحدة", ["دقيقتان", "دقيقتين"], "%d دقائق", "%d دقيقة", "%d دقيقة"],
				h: ["أقل من ساعة", "ساعة واحدة", ["ساعتان", "ساعتين"], "%d ساعات", "%d ساعة", "%d ساعة"],
				d: ["أقل من يوم", "يوم واحد", ["يومان", "يومين"], "%d أيام", "%d يومًا", "%d يوم"],
				M: ["أقل من شهر", "شهر واحد", ["شهران", "شهرين"], "%d أشهر", "%d شهرا", "%d شهر"],
				y: ["أقل من عام", "عام واحد", ["عامان", "عامين"], "%d أعوام", "%d عامًا", "%d عام"]
			}, i = function (e) {
				return function (t, i, a, s) {
					var o = n(t), u = r[e][n(t)];
					return 2 === o && (u = u[i ? 0 : 1]), u.replace(/%d/i, t)
				}
			},
			a = ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];
		e.defineLocale("ar-ly", {
			months: a,
			monthsShort: a,
			weekdays: "الأحد_الإثنين_الثلاثاء_الأربعاء_الخميس_الجمعة_السبت".split("_"),
			weekdaysShort: "أحد_إثنين_ثلاثاء_أربعاء_خميس_جمعة_سبت".split("_"),
			weekdaysMin: "ح_ن_ث_ر_خ_ج_س".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "D/‏M/‏YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			meridiemParse: /ص|م/,
			isPM: function (e) {
				return "م" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "ص" : "م"
			},
			calendar: {
				sameDay: "[اليوم عند الساعة] LT",
				nextDay: "[غدًا عند الساعة] LT",
				nextWeek: "dddd [عند الساعة] LT",
				lastDay: "[أمس عند الساعة] LT",
				lastWeek: "dddd [عند الساعة] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "بعد %s",
				past: "منذ %s",
				s: i("s"),
				ss: i("s"),
				m: i("m"),
				mm: i("m"),
				h: i("h"),
				hh: i("h"),
				d: i("d"),
				dd: i("d"),
				M: i("M"),
				MM: i("M"),
				y: i("y"),
				yy: i("y")
			},
			preparse: function (e) {
				return e.replace(/،/g, ",")
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				}).replace(/,/g, "،")
			},
			week: {dow: 6, doy: 12}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ar-ma", {
			months: "يناير_فبراير_مارس_أبريل_ماي_يونيو_يوليوز_غشت_شتنبر_أكتوبر_نونبر_دجنبر".split("_"),
			monthsShort: "يناير_فبراير_مارس_أبريل_ماي_يونيو_يوليوز_غشت_شتنبر_أكتوبر_نونبر_دجنبر".split("_"),
			weekdays: "الأحد_الإتنين_الثلاثاء_الأربعاء_الخميس_الجمعة_السبت".split("_"),
			weekdaysShort: "احد_اتنين_ثلاثاء_اربعاء_خميس_جمعة_سبت".split("_"),
			weekdaysMin: "ح_ن_ث_ر_خ_ج_س".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[اليوم على الساعة] LT",
				nextDay: "[غدا على الساعة] LT",
				nextWeek: "dddd [على الساعة] LT",
				lastDay: "[أمس على الساعة] LT",
				lastWeek: "dddd [على الساعة] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "في %s",
				past: "منذ %s",
				s: "ثوان",
				ss: "%d ثانية",
				m: "دقيقة",
				mm: "%d دقائق",
				h: "ساعة",
				hh: "%d ساعات",
				d: "يوم",
				dd: "%d أيام",
				M: "شهر",
				MM: "%d أشهر",
				y: "سنة",
				yy: "%d سنوات"
			},
			week: {dow: 6, doy: 12}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "١", 2: "٢", 3: "٣", 4: "٤", 5: "٥", 6: "٦", 7: "٧", 8: "٨", 9: "٩", 0: "٠"},
			n = {"١": "1", "٢": "2", "٣": "3", "٤": "4", "٥": "5", "٦": "6", "٧": "7", "٨": "8", "٩": "9", "٠": "0"};
		e.defineLocale("ar-sa", {
			months: "يناير_فبراير_مارس_أبريل_مايو_يونيو_يوليو_أغسطس_سبتمبر_أكتوبر_نوفمبر_ديسمبر".split("_"),
			monthsShort: "يناير_فبراير_مارس_أبريل_مايو_يونيو_يوليو_أغسطس_سبتمبر_أكتوبر_نوفمبر_ديسمبر".split("_"),
			weekdays: "الأحد_الإثنين_الثلاثاء_الأربعاء_الخميس_الجمعة_السبت".split("_"),
			weekdaysShort: "أحد_إثنين_ثلاثاء_أربعاء_خميس_جمعة_سبت".split("_"),
			weekdaysMin: "ح_ن_ث_ر_خ_ج_س".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			meridiemParse: /ص|م/,
			isPM: function (e) {
				return "م" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "ص" : "م"
			},
			calendar: {
				sameDay: "[اليوم على الساعة] LT",
				nextDay: "[غدا على الساعة] LT",
				nextWeek: "dddd [على الساعة] LT",
				lastDay: "[أمس على الساعة] LT",
				lastWeek: "dddd [على الساعة] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "في %s",
				past: "منذ %s",
				s: "ثوان",
				ss: "%d ثانية",
				m: "دقيقة",
				mm: "%d دقائق",
				h: "ساعة",
				hh: "%d ساعات",
				d: "يوم",
				dd: "%d أيام",
				M: "شهر",
				MM: "%d أشهر",
				y: "سنة",
				yy: "%d سنوات"
			},
			preparse: function (e) {
				return e.replace(/[١٢٣٤٥٦٧٨٩٠]/g, function (e) {
					return n[e]
				}).replace(/،/g, ",")
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				}).replace(/,/g, "،")
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ar-tn", {
			months: "جانفي_فيفري_مارس_أفريل_ماي_جوان_جويلية_أوت_سبتمبر_أكتوبر_نوفمبر_ديسمبر".split("_"),
			monthsShort: "جانفي_فيفري_مارس_أفريل_ماي_جوان_جويلية_أوت_سبتمبر_أكتوبر_نوفمبر_ديسمبر".split("_"),
			weekdays: "الأحد_الإثنين_الثلاثاء_الأربعاء_الخميس_الجمعة_السبت".split("_"),
			weekdaysShort: "أحد_إثنين_ثلاثاء_أربعاء_خميس_جمعة_سبت".split("_"),
			weekdaysMin: "ح_ن_ث_ر_خ_ج_س".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[اليوم على الساعة] LT",
				nextDay: "[غدا على الساعة] LT",
				nextWeek: "dddd [على الساعة] LT",
				lastDay: "[أمس على الساعة] LT",
				lastWeek: "dddd [على الساعة] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "في %s",
				past: "منذ %s",
				s: "ثوان",
				ss: "%d ثانية",
				m: "دقيقة",
				mm: "%d دقائق",
				h: "ساعة",
				hh: "%d ساعات",
				d: "يوم",
				dd: "%d أيام",
				M: "شهر",
				MM: "%d أشهر",
				y: "سنة",
				yy: "%d سنوات"
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {
			1: "-inci",
			5: "-inci",
			8: "-inci",
			70: "-inci",
			80: "-inci",
			2: "-nci",
			7: "-nci",
			20: "-nci",
			50: "-nci",
			3: "-üncü",
			4: "-üncü",
			100: "-üncü",
			6: "-ncı",
			9: "-uncu",
			10: "-uncu",
			30: "-uncu",
			60: "-ıncı",
			90: "-ıncı"
		};
		e.defineLocale("az", {
			months: "yanvar_fevral_mart_aprel_may_iyun_iyul_avqust_sentyabr_oktyabr_noyabr_dekabr".split("_"),
			monthsShort: "yan_fev_mar_apr_may_iyn_iyl_avq_sen_okt_noy_dek".split("_"),
			weekdays: "Bazar_Bazar ertəsi_Çərşənbə axşamı_Çərşənbə_Cümə axşamı_Cümə_Şənbə".split("_"),
			weekdaysShort: "Baz_BzE_ÇAx_Çər_CAx_Cüm_Şən".split("_"),
			weekdaysMin: "Bz_BE_ÇA_Çə_CA_Cü_Şə".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[bugün saat] LT",
				nextDay: "[sabah saat] LT",
				nextWeek: "[gələn həftə] dddd [saat] LT",
				lastDay: "[dünən] LT",
				lastWeek: "[keçən həftə] dddd [saat] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s sonra",
				past: "%s əvvəl",
				s: "birneçə saniyə",
				ss: "%d saniyə",
				m: "bir dəqiqə",
				mm: "%d dəqiqə",
				h: "bir saat",
				hh: "%d saat",
				d: "bir gün",
				dd: "%d gün",
				M: "bir ay",
				MM: "%d ay",
				y: "bir il",
				yy: "%d il"
			},
			meridiemParse: /gecə|səhər|gündüz|axşam/,
			isPM: function (e) {
				return /^(gündüz|axşam)$/.test(e)
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "gecə" : e < 12 ? "səhər" : e < 17 ? "gündüz" : "axşam"
			},
			dayOfMonthOrdinalParse: /\d{1,2}-(ıncı|inci|nci|üncü|ncı|uncu)/,
			ordinal: function (e) {
				if (0 === e) return e + "-ıncı";
				var n = e % 10;
				return e + (t[n] || t[e % 100 - n] || t[e >= 100 ? 100 : null])
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n) {
			var r, i;
			return "m" === n ? t ? "хвіліна" : "хвіліну" : "h" === n ? t ? "гадзіна" : "гадзіну" : e + " " + (r = +e, i = {
				ss: t ? "секунда_секунды_секунд" : "секунду_секунды_секунд",
				mm: t ? "хвіліна_хвіліны_хвілін" : "хвіліну_хвіліны_хвілін",
				hh: t ? "гадзіна_гадзіны_гадзін" : "гадзіну_гадзіны_гадзін",
				dd: "дзень_дні_дзён",
				MM: "месяц_месяцы_месяцаў",
				yy: "год_гады_гадоў"
			}[n].split("_"), r % 10 == 1 && r % 100 != 11 ? i[0] : r % 10 >= 2 && r % 10 <= 4 && (r % 100 < 10 || r % 100 >= 20) ? i[1] : i[2])
		}

		e.defineLocale("be", {
			months: {
				format: "студзеня_лютага_сакавіка_красавіка_траўня_чэрвеня_ліпеня_жніўня_верасня_кастрычніка_лістапада_снежня".split("_"),
				standalone: "студзень_люты_сакавік_красавік_травень_чэрвень_ліпень_жнівень_верасень_кастрычнік_лістапад_снежань".split("_")
			},
			monthsShort: "студ_лют_сак_крас_трав_чэрв_ліп_жнів_вер_каст_ліст_снеж".split("_"),
			weekdays: {
				format: "нядзелю_панядзелак_аўторак_сераду_чацвер_пятніцу_суботу".split("_"),
				standalone: "нядзеля_панядзелак_аўторак_серада_чацвер_пятніца_субота".split("_"),
				isFormat: /\[ ?[Ууў] ?(?:мінулую|наступную)? ?\] ?dddd/
			},
			weekdaysShort: "нд_пн_ат_ср_чц_пт_сб".split("_"),
			weekdaysMin: "нд_пн_ат_ср_чц_пт_сб".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY г.",
				LLL: "D MMMM YYYY г., HH:mm",
				LLLL: "dddd, D MMMM YYYY г., HH:mm"
			},
			calendar: {
				sameDay: "[Сёння ў] LT",
				nextDay: "[Заўтра ў] LT",
				lastDay: "[Учора ў] LT",
				nextWeek: function () {
					return "[У] dddd [ў] LT"
				},
				lastWeek: function () {
					switch (this.day()) {
						case 0:
						case 3:
						case 5:
						case 6:
							return "[У мінулую] dddd [ў] LT";
						case 1:
						case 2:
						case 4:
							return "[У мінулы] dddd [ў] LT"
					}
				},
				sameElse: "L"
			},
			relativeTime: {
				future: "праз %s",
				past: "%s таму",
				s: "некалькі секунд",
				m: t,
				mm: t,
				h: t,
				hh: t,
				d: "дзень",
				dd: t,
				M: "месяц",
				MM: t,
				y: "год",
				yy: t
			},
			meridiemParse: /ночы|раніцы|дня|вечара/,
			isPM: function (e) {
				return /^(дня|вечара)$/.test(e)
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "ночы" : e < 12 ? "раніцы" : e < 17 ? "дня" : "вечара"
			},
			dayOfMonthOrdinalParse: /\d{1,2}-(і|ы|га)/,
			ordinal: function (e, t) {
				switch (t) {
					case"M":
					case"d":
					case"DDD":
					case"w":
					case"W":
						return e % 10 != 2 && e % 10 != 3 || e % 100 == 12 || e % 100 == 13 ? e + "-ы" : e + "-і";
					case"D":
						return e + "-га";
					default:
						return e
				}
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("bg", {
			months: "януари_февруари_март_април_май_юни_юли_август_септември_октомври_ноември_декември".split("_"),
			monthsShort: "янр_фев_мар_апр_май_юни_юли_авг_сеп_окт_ное_дек".split("_"),
			weekdays: "неделя_понеделник_вторник_сряда_четвъртък_петък_събота".split("_"),
			weekdaysShort: "нед_пон_вто_сря_чет_пет_съб".split("_"),
			weekdaysMin: "нд_пн_вт_ср_чт_пт_сб".split("_"),
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "D.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY H:mm",
				LLLL: "dddd, D MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[Днес в] LT",
				nextDay: "[Утре в] LT",
				nextWeek: "dddd [в] LT",
				lastDay: "[Вчера в] LT",
				lastWeek: function () {
					switch (this.day()) {
						case 0:
						case 3:
						case 6:
							return "[В изминалата] dddd [в] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[В изминалия] dddd [в] LT"
					}
				},
				sameElse: "L"
			},
			relativeTime: {
				future: "след %s",
				past: "преди %s",
				s: "няколко секунди",
				ss: "%d секунди",
				m: "минута",
				mm: "%d минути",
				h: "час",
				hh: "%d часа",
				d: "ден",
				dd: "%d дни",
				M: "месец",
				MM: "%d месеца",
				y: "година",
				yy: "%d години"
			},
			dayOfMonthOrdinalParse: /\d{1,2}-(ев|ен|ти|ви|ри|ми)/,
			ordinal: function (e) {
				var t = e % 10, n = e % 100;
				return 0 === e ? e + "-ев" : 0 === n ? e + "-ен" : n > 10 && n < 20 ? e + "-ти" : 1 === t ? e + "-ви" : 2 === t ? e + "-ри" : 7 === t || 8 === t ? e + "-ми" : e + "-ти"
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("bm", {
			months: "Zanwuyekalo_Fewuruyekalo_Marisikalo_Awirilikalo_Mɛkalo_Zuwɛnkalo_Zuluyekalo_Utikalo_Sɛtanburukalo_ɔkutɔburukalo_Nowanburukalo_Desanburukalo".split("_"),
			monthsShort: "Zan_Few_Mar_Awi_Mɛ_Zuw_Zul_Uti_Sɛt_ɔku_Now_Des".split("_"),
			weekdays: "Kari_Ntɛnɛn_Tarata_Araba_Alamisa_Juma_Sibiri".split("_"),
			weekdaysShort: "Kar_Ntɛ_Tar_Ara_Ala_Jum_Sib".split("_"),
			weekdaysMin: "Ka_Nt_Ta_Ar_Al_Ju_Si".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "MMMM [tile] D [san] YYYY",
				LLL: "MMMM [tile] D [san] YYYY [lɛrɛ] HH:mm",
				LLLL: "dddd MMMM [tile] D [san] YYYY [lɛrɛ] HH:mm"
			},
			calendar: {
				sameDay: "[Bi lɛrɛ] LT",
				nextDay: "[Sini lɛrɛ] LT",
				nextWeek: "dddd [don lɛrɛ] LT",
				lastDay: "[Kunu lɛrɛ] LT",
				lastWeek: "dddd [tɛmɛnen lɛrɛ] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s kɔnɔ",
				past: "a bɛ %s bɔ",
				s: "sanga dama dama",
				ss: "sekondi %d",
				m: "miniti kelen",
				mm: "miniti %d",
				h: "lɛrɛ kelen",
				hh: "lɛrɛ %d",
				d: "tile kelen",
				dd: "tile %d",
				M: "kalo kelen",
				MM: "kalo %d",
				y: "san kelen",
				yy: "san %d"
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "১", 2: "২", 3: "৩", 4: "৪", 5: "৫", 6: "৬", 7: "৭", 8: "৮", 9: "৯", 0: "০"},
			n = {"১": "1", "২": "2", "৩": "3", "৪": "4", "৫": "5", "৬": "6", "৭": "7", "৮": "8", "৯": "9", "০": "0"};
		e.defineLocale("bn", {
			months: "জানুয়ারী_ফেব্রুয়ারি_মার্চ_এপ্রিল_মে_জুন_জুলাই_আগস্ট_সেপ্টেম্বর_অক্টোবর_নভেম্বর_ডিসেম্বর".split("_"),
			monthsShort: "জানু_ফেব_মার্চ_এপ্র_মে_জুন_জুল_আগ_সেপ্ট_অক্টো_নভে_ডিসে".split("_"),
			weekdays: "রবিবার_সোমবার_মঙ্গলবার_বুধবার_বৃহস্পতিবার_শুক্রবার_শনিবার".split("_"),
			weekdaysShort: "রবি_সোম_মঙ্গল_বুধ_বৃহস্পতি_শুক্র_শনি".split("_"),
			weekdaysMin: "রবি_সোম_মঙ্গ_বুধ_বৃহঃ_শুক্র_শনি".split("_"),
			longDateFormat: {
				LT: "A h:mm সময়",
				LTS: "A h:mm:ss সময়",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, A h:mm সময়",
				LLLL: "dddd, D MMMM YYYY, A h:mm সময়"
			},
			calendar: {
				sameDay: "[আজ] LT",
				nextDay: "[আগামীকাল] LT",
				nextWeek: "dddd, LT",
				lastDay: "[গতকাল] LT",
				lastWeek: "[গত] dddd, LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s পরে",
				past: "%s আগে",
				s: "কয়েক সেকেন্ড",
				ss: "%d সেকেন্ড",
				m: "এক মিনিট",
				mm: "%d মিনিট",
				h: "এক ঘন্টা",
				hh: "%d ঘন্টা",
				d: "এক দিন",
				dd: "%d দিন",
				M: "এক মাস",
				MM: "%d মাস",
				y: "এক বছর",
				yy: "%d বছর"
			},
			preparse: function (e) {
				return e.replace(/[১২৩৪৫৬৭৮৯০]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			meridiemParse: /রাত|সকাল|দুপুর|বিকাল|রাত/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "রাত" === t && e >= 4 || "দুপুর" === t && e < 5 || "বিকাল" === t ? e + 12 : e
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "রাত" : e < 10 ? "সকাল" : e < 17 ? "দুপুর" : e < 20 ? "বিকাল" : "রাত"
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "༡", 2: "༢", 3: "༣", 4: "༤", 5: "༥", 6: "༦", 7: "༧", 8: "༨", 9: "༩", 0: "༠"},
			n = {"༡": "1", "༢": "2", "༣": "3", "༤": "4", "༥": "5", "༦": "6", "༧": "7", "༨": "8", "༩": "9", "༠": "0"};
		e.defineLocale("bo", {
			months: "ཟླ་བ་དང་པོ_ཟླ་བ་གཉིས་པ_ཟླ་བ་གསུམ་པ_ཟླ་བ་བཞི་པ_ཟླ་བ་ལྔ་པ_ཟླ་བ་དྲུག་པ_ཟླ་བ་བདུན་པ_ཟླ་བ་བརྒྱད་པ_ཟླ་བ་དགུ་པ_ཟླ་བ་བཅུ་པ_ཟླ་བ་བཅུ་གཅིག་པ_ཟླ་བ་བཅུ་གཉིས་པ".split("_"),
			monthsShort: "ཟླ་བ་དང་པོ_ཟླ་བ་གཉིས་པ_ཟླ་བ་གསུམ་པ_ཟླ་བ་བཞི་པ_ཟླ་བ་ལྔ་པ_ཟླ་བ་དྲུག་པ_ཟླ་བ་བདུན་པ_ཟླ་བ་བརྒྱད་པ_ཟླ་བ་དགུ་པ_ཟླ་བ་བཅུ་པ_ཟླ་བ་བཅུ་གཅིག་པ_ཟླ་བ་བཅུ་གཉིས་པ".split("_"),
			weekdays: "གཟའ་ཉི་མ་_གཟའ་ཟླ་བ་_གཟའ་མིག་དམར་_གཟའ་ལྷག་པ་_གཟའ་ཕུར་བུ_གཟའ་པ་སངས་_གཟའ་སྤེན་པ་".split("_"),
			weekdaysShort: "ཉི་མ་_ཟླ་བ་_མིག་དམར་_ལྷག་པ་_ཕུར་བུ_པ་སངས་_སྤེན་པ་".split("_"),
			weekdaysMin: "ཉི་མ་_ཟླ་བ་_མིག་དམར་_ལྷག་པ་_ཕུར་བུ_པ་སངས་_སྤེན་པ་".split("_"),
			longDateFormat: {
				LT: "A h:mm",
				LTS: "A h:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, A h:mm",
				LLLL: "dddd, D MMMM YYYY, A h:mm"
			},
			calendar: {
				sameDay: "[དི་རིང] LT",
				nextDay: "[སང་ཉིན] LT",
				nextWeek: "[བདུན་ཕྲག་རྗེས་མ], LT",
				lastDay: "[ཁ་སང] LT",
				lastWeek: "[བདུན་ཕྲག་མཐའ་མ] dddd, LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s ལ་",
				past: "%s སྔན་ལ",
				s: "ལམ་སང",
				ss: "%d སྐར་ཆ།",
				m: "སྐར་མ་གཅིག",
				mm: "%d སྐར་མ",
				h: "ཆུ་ཚོད་གཅིག",
				hh: "%d ཆུ་ཚོད",
				d: "ཉིན་གཅིག",
				dd: "%d ཉིན་",
				M: "ཟླ་བ་གཅིག",
				MM: "%d ཟླ་བ",
				y: "ལོ་གཅིག",
				yy: "%d ལོ"
			},
			preparse: function (e) {
				return e.replace(/[༡༢༣༤༥༦༧༨༩༠]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			meridiemParse: /མཚན་མོ|ཞོགས་ཀས|ཉིན་གུང|དགོང་དག|མཚན་མོ/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "མཚན་མོ" === t && e >= 4 || "ཉིན་གུང" === t && e < 5 || "དགོང་དག" === t ? e + 12 : e
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "མཚན་མོ" : e < 10 ? "ཞོགས་ཀས" : e < 17 ? "ཉིན་གུང" : e < 20 ? "དགོང་དག" : "མཚན་མོ"
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n) {
			return e + " " + function (e, t) {
				if (2 === t) return function (e) {
					var t = {m: "v", b: "v", d: "z"};
					if (void 0 === t[e.charAt(0)]) return e;
					return t[e.charAt(0)] + e.substring(1)
				}(e);
				return e
			}({mm: "munutenn", MM: "miz", dd: "devezh"}[n], e)
		}

		e.defineLocale("br", {
			months: "Genver_C'hwevrer_Meurzh_Ebrel_Mae_Mezheven_Gouere_Eost_Gwengolo_Here_Du_Kerzu".split("_"),
			monthsShort: "Gen_C'hwe_Meu_Ebr_Mae_Eve_Gou_Eos_Gwe_Her_Du_Ker".split("_"),
			weekdays: "Sul_Lun_Meurzh_Merc'her_Yaou_Gwener_Sadorn".split("_"),
			weekdaysShort: "Sul_Lun_Meu_Mer_Yao_Gwe_Sad".split("_"),
			weekdaysMin: "Su_Lu_Me_Mer_Ya_Gw_Sa".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "h[e]mm A",
				LTS: "h[e]mm:ss A",
				L: "DD/MM/YYYY",
				LL: "D [a viz] MMMM YYYY",
				LLL: "D [a viz] MMMM YYYY h[e]mm A",
				LLLL: "dddd, D [a viz] MMMM YYYY h[e]mm A"
			},
			calendar: {
				sameDay: "[Hiziv da] LT",
				nextDay: "[Warc'hoazh da] LT",
				nextWeek: "dddd [da] LT",
				lastDay: "[Dec'h da] LT",
				lastWeek: "dddd [paset da] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "a-benn %s",
				past: "%s 'zo",
				s: "un nebeud segondennoù",
				ss: "%d eilenn",
				m: "ur vunutenn",
				mm: t,
				h: "un eur",
				hh: "%d eur",
				d: "un devezh",
				dd: t,
				M: "ur miz",
				MM: t,
				y: "ur bloaz",
				yy: function (e) {
					switch (function e(t) {
						return t > 9 ? e(t % 10) : t
					}(e)) {
						case 1:
						case 3:
						case 4:
						case 5:
						case 9:
							return e + " bloaz";
						default:
							return e + " vloaz"
					}
				}
			},
			dayOfMonthOrdinalParse: /\d{1,2}(añ|vet)/,
			ordinal: function (e) {
				return e + (1 === e ? "añ" : "vet")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n) {
			var r = e + " ";
			switch (n) {
				case"ss":
					return r += 1 === e ? "sekunda" : 2 === e || 3 === e || 4 === e ? "sekunde" : "sekundi";
				case"m":
					return t ? "jedna minuta" : "jedne minute";
				case"mm":
					return r += 1 === e ? "minuta" : 2 === e || 3 === e || 4 === e ? "minute" : "minuta";
				case"h":
					return t ? "jedan sat" : "jednog sata";
				case"hh":
					return r += 1 === e ? "sat" : 2 === e || 3 === e || 4 === e ? "sata" : "sati";
				case"dd":
					return r += 1 === e ? "dan" : "dana";
				case"MM":
					return r += 1 === e ? "mjesec" : 2 === e || 3 === e || 4 === e ? "mjeseca" : "mjeseci";
				case"yy":
					return r += 1 === e ? "godina" : 2 === e || 3 === e || 4 === e ? "godine" : "godina"
			}
		}

		e.defineLocale("bs", {
			months: "januar_februar_mart_april_maj_juni_juli_august_septembar_oktobar_novembar_decembar".split("_"),
			monthsShort: "jan._feb._mar._apr._maj._jun._jul._aug._sep._okt._nov._dec.".split("_"),
			monthsParseExact: !0,
			weekdays: "nedjelja_ponedjeljak_utorak_srijeda_četvrtak_petak_subota".split("_"),
			weekdaysShort: "ned._pon._uto._sri._čet._pet._sub.".split("_"),
			weekdaysMin: "ne_po_ut_sr_če_pe_su".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm",
				LLLL: "dddd, D. MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[danas u] LT", nextDay: "[sutra u] LT", nextWeek: function () {
					switch (this.day()) {
						case 0:
							return "[u] [nedjelju] [u] LT";
						case 3:
							return "[u] [srijedu] [u] LT";
						case 6:
							return "[u] [subotu] [u] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[u] dddd [u] LT"
					}
				}, lastDay: "[jučer u] LT", lastWeek: function () {
					switch (this.day()) {
						case 0:
						case 3:
							return "[prošlu] dddd [u] LT";
						case 6:
							return "[prošle] [subote] [u] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[prošli] dddd [u] LT"
					}
				}, sameElse: "L"
			},
			relativeTime: {
				future: "za %s",
				past: "prije %s",
				s: "par sekundi",
				ss: t,
				m: t,
				mm: t,
				h: t,
				hh: t,
				d: "dan",
				dd: t,
				M: "mjesec",
				MM: t,
				y: "godinu",
				yy: t
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ca", {
			months: {
				standalone: "gener_febrer_març_abril_maig_juny_juliol_agost_setembre_octubre_novembre_desembre".split("_"),
				format: "de gener_de febrer_de març_d'abril_de maig_de juny_de juliol_d'agost_de setembre_d'octubre_de novembre_de desembre".split("_"),
				isFormat: /D[oD]?(\s)+MMMM/
			},
			monthsShort: "gen._febr._març_abr._maig_juny_jul._ag._set._oct._nov._des.".split("_"),
			monthsParseExact: !0,
			weekdays: "diumenge_dilluns_dimarts_dimecres_dijous_divendres_dissabte".split("_"),
			weekdaysShort: "dg._dl._dt._dc._dj._dv._ds.".split("_"),
			weekdaysMin: "dg_dl_dt_dc_dj_dv_ds".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM [de] YYYY",
				ll: "D MMM YYYY",
				LLL: "D MMMM [de] YYYY [a les] H:mm",
				lll: "D MMM YYYY, H:mm",
				LLLL: "dddd D MMMM [de] YYYY [a les] H:mm",
				llll: "ddd D MMM YYYY, H:mm"
			},
			calendar: {
				sameDay: function () {
					return "[avui a " + (1 !== this.hours() ? "les" : "la") + "] LT"
				}, nextDay: function () {
					return "[demà a " + (1 !== this.hours() ? "les" : "la") + "] LT"
				}, nextWeek: function () {
					return "dddd [a " + (1 !== this.hours() ? "les" : "la") + "] LT"
				}, lastDay: function () {
					return "[ahir a " + (1 !== this.hours() ? "les" : "la") + "] LT"
				}, lastWeek: function () {
					return "[el] dddd [passat a " + (1 !== this.hours() ? "les" : "la") + "] LT"
				}, sameElse: "L"
			},
			relativeTime: {
				future: "d'aquí %s",
				past: "fa %s",
				s: "uns segons",
				ss: "%d segons",
				m: "un minut",
				mm: "%d minuts",
				h: "una hora",
				hh: "%d hores",
				d: "un dia",
				dd: "%d dies",
				M: "un mes",
				MM: "%d mesos",
				y: "un any",
				yy: "%d anys"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(r|n|t|è|a)/,
			ordinal: function (e, t) {
				var n = 1 === e ? "r" : 2 === e ? "n" : 3 === e ? "r" : 4 === e ? "t" : "è";
				return "w" !== t && "W" !== t || (n = "a"), e + n
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "leden_únor_březen_duben_květen_červen_červenec_srpen_září_říjen_listopad_prosinec".split("_"),
			n = "led_úno_bře_dub_kvě_čvn_čvc_srp_zář_říj_lis_pro".split("_");

		function r(e) {
			return e > 1 && e < 5 && 1 != ~~(e / 10)
		}

		function i(e, t, n, i) {
			var a = e + " ";
			switch (n) {
				case"s":
					return t || i ? "pár sekund" : "pár sekundami";
				case"ss":
					return t || i ? a + (r(e) ? "sekundy" : "sekund") : a + "sekundami";
				case"m":
					return t ? "minuta" : i ? "minutu" : "minutou";
				case"mm":
					return t || i ? a + (r(e) ? "minuty" : "minut") : a + "minutami";
				case"h":
					return t ? "hodina" : i ? "hodinu" : "hodinou";
				case"hh":
					return t || i ? a + (r(e) ? "hodiny" : "hodin") : a + "hodinami";
				case"d":
					return t || i ? "den" : "dnem";
				case"dd":
					return t || i ? a + (r(e) ? "dny" : "dní") : a + "dny";
				case"M":
					return t || i ? "měsíc" : "měsícem";
				case"MM":
					return t || i ? a + (r(e) ? "měsíce" : "měsíců") : a + "měsíci";
				case"y":
					return t || i ? "rok" : "rokem";
				case"yy":
					return t || i ? a + (r(e) ? "roky" : "let") : a + "lety"
			}
		}

		e.defineLocale("cs", {
			months: t,
			monthsShort: n,
			monthsParse: function (e, t) {
				var n, r = [];
				for (n = 0; n < 12; n++) r[n] = new RegExp("^" + e[n] + "$|^" + t[n] + "$", "i");
				return r
			}(t, n),
			shortMonthsParse: function (e) {
				var t, n = [];
				for (t = 0; t < 12; t++) n[t] = new RegExp("^" + e[t] + "$", "i");
				return n
			}(n),
			longMonthsParse: function (e) {
				var t, n = [];
				for (t = 0; t < 12; t++) n[t] = new RegExp("^" + e[t] + "$", "i");
				return n
			}(t),
			weekdays: "neděle_pondělí_úterý_středa_čtvrtek_pátek_sobota".split("_"),
			weekdaysShort: "ne_po_út_st_čt_pá_so".split("_"),
			weekdaysMin: "ne_po_út_st_čt_pá_so".split("_"),
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm",
				LLLL: "dddd D. MMMM YYYY H:mm",
				l: "D. M. YYYY"
			},
			calendar: {
				sameDay: "[dnes v] LT", nextDay: "[zítra v] LT", nextWeek: function () {
					switch (this.day()) {
						case 0:
							return "[v neděli v] LT";
						case 1:
						case 2:
							return "[v] dddd [v] LT";
						case 3:
							return "[ve středu v] LT";
						case 4:
							return "[ve čtvrtek v] LT";
						case 5:
							return "[v pátek v] LT";
						case 6:
							return "[v sobotu v] LT"
					}
				}, lastDay: "[včera v] LT", lastWeek: function () {
					switch (this.day()) {
						case 0:
							return "[minulou neděli v] LT";
						case 1:
						case 2:
							return "[minulé] dddd [v] LT";
						case 3:
							return "[minulou středu v] LT";
						case 4:
						case 5:
							return "[minulý] dddd [v] LT";
						case 6:
							return "[minulou sobotu v] LT"
					}
				}, sameElse: "L"
			},
			relativeTime: {
				future: "za %s",
				past: "před %s",
				s: i,
				ss: i,
				m: i,
				mm: i,
				h: i,
				hh: i,
				d: i,
				dd: i,
				M: i,
				MM: i,
				y: i,
				yy: i
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("cv", {
			months: "кӑрлач_нарӑс_пуш_ака_май_ҫӗртме_утӑ_ҫурла_авӑн_юпа_чӳк_раштав".split("_"),
			monthsShort: "кӑр_нар_пуш_ака_май_ҫӗр_утӑ_ҫур_авн_юпа_чӳк_раш".split("_"),
			weekdays: "вырсарникун_тунтикун_ытларикун_юнкун_кӗҫнерникун_эрнекун_шӑматкун".split("_"),
			weekdaysShort: "выр_тун_ытл_юн_кӗҫ_эрн_шӑм".split("_"),
			weekdaysMin: "вр_тн_ыт_юн_кҫ_эр_шм".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD-MM-YYYY",
				LL: "YYYY [ҫулхи] MMMM [уйӑхӗн] D[-мӗшӗ]",
				LLL: "YYYY [ҫулхи] MMMM [уйӑхӗн] D[-мӗшӗ], HH:mm",
				LLLL: "dddd, YYYY [ҫулхи] MMMM [уйӑхӗн] D[-мӗшӗ], HH:mm"
			},
			calendar: {
				sameDay: "[Паян] LT [сехетре]",
				nextDay: "[Ыран] LT [сехетре]",
				lastDay: "[Ӗнер] LT [сехетре]",
				nextWeek: "[Ҫитес] dddd LT [сехетре]",
				lastWeek: "[Иртнӗ] dddd LT [сехетре]",
				sameElse: "L"
			},
			relativeTime: {
				future: function (e) {
					return e + (/сехет$/i.exec(e) ? "рен" : /ҫул$/i.exec(e) ? "тан" : "ран")
				},
				past: "%s каялла",
				s: "пӗр-ик ҫеккунт",
				ss: "%d ҫеккунт",
				m: "пӗр минут",
				mm: "%d минут",
				h: "пӗр сехет",
				hh: "%d сехет",
				d: "пӗр кун",
				dd: "%d кун",
				M: "пӗр уйӑх",
				MM: "%d уйӑх",
				y: "пӗр ҫул",
				yy: "%d ҫул"
			},
			dayOfMonthOrdinalParse: /\d{1,2}-мӗш/,
			ordinal: "%d-мӗш",
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("cy", {
			months: "Ionawr_Chwefror_Mawrth_Ebrill_Mai_Mehefin_Gorffennaf_Awst_Medi_Hydref_Tachwedd_Rhagfyr".split("_"),
			monthsShort: "Ion_Chwe_Maw_Ebr_Mai_Meh_Gor_Aws_Med_Hyd_Tach_Rhag".split("_"),
			weekdays: "Dydd Sul_Dydd Llun_Dydd Mawrth_Dydd Mercher_Dydd Iau_Dydd Gwener_Dydd Sadwrn".split("_"),
			weekdaysShort: "Sul_Llun_Maw_Mer_Iau_Gwe_Sad".split("_"),
			weekdaysMin: "Su_Ll_Ma_Me_Ia_Gw_Sa".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Heddiw am] LT",
				nextDay: "[Yfory am] LT",
				nextWeek: "dddd [am] LT",
				lastDay: "[Ddoe am] LT",
				lastWeek: "dddd [diwethaf am] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "mewn %s",
				past: "%s yn ôl",
				s: "ychydig eiliadau",
				ss: "%d eiliad",
				m: "munud",
				mm: "%d munud",
				h: "awr",
				hh: "%d awr",
				d: "diwrnod",
				dd: "%d diwrnod",
				M: "mis",
				MM: "%d mis",
				y: "blwyddyn",
				yy: "%d flynedd"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(fed|ain|af|il|ydd|ed|eg)/,
			ordinal: function (e) {
				var t = "";
				return e > 20 ? t = 40 === e || 50 === e || 60 === e || 80 === e || 100 === e ? "fed" : "ain" : e > 0 && (t = ["", "af", "il", "ydd", "ydd", "ed", "ed", "ed", "fed", "fed", "fed", "eg", "fed", "eg", "eg", "fed", "eg", "eg", "fed", "eg", "fed"][e]), e + t
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("da", {
			months: "januar_februar_marts_april_maj_juni_juli_august_september_oktober_november_december".split("_"),
			monthsShort: "jan_feb_mar_apr_maj_jun_jul_aug_sep_okt_nov_dec".split("_"),
			weekdays: "søndag_mandag_tirsdag_onsdag_torsdag_fredag_lørdag".split("_"),
			weekdaysShort: "søn_man_tir_ons_tor_fre_lør".split("_"),
			weekdaysMin: "sø_ma_ti_on_to_fr_lø".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY HH:mm",
				LLLL: "dddd [d.] D. MMMM YYYY [kl.] HH:mm"
			},
			calendar: {
				sameDay: "[i dag kl.] LT",
				nextDay: "[i morgen kl.] LT",
				nextWeek: "på dddd [kl.] LT",
				lastDay: "[i går kl.] LT",
				lastWeek: "[i] dddd[s kl.] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "om %s",
				past: "%s siden",
				s: "få sekunder",
				ss: "%d sekunder",
				m: "et minut",
				mm: "%d minutter",
				h: "en time",
				hh: "%d timer",
				d: "en dag",
				dd: "%d dage",
				M: "en måned",
				MM: "%d måneder",
				y: "et år",
				yy: "%d år"
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n, r) {
			var i = {
				m: ["eine Minute", "einer Minute"],
				h: ["eine Stunde", "einer Stunde"],
				d: ["ein Tag", "einem Tag"],
				dd: [e + " Tage", e + " Tagen"],
				M: ["ein Monat", "einem Monat"],
				MM: [e + " Monate", e + " Monaten"],
				y: ["ein Jahr", "einem Jahr"],
				yy: [e + " Jahre", e + " Jahren"]
			};
			return t ? i[n][0] : i[n][1]
		}

		e.defineLocale("de", {
			months: "Januar_Februar_März_April_Mai_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
			monthsShort: "Jan._Feb._März_Apr._Mai_Juni_Juli_Aug._Sep._Okt._Nov._Dez.".split("_"),
			monthsParseExact: !0,
			weekdays: "Sonntag_Montag_Dienstag_Mittwoch_Donnerstag_Freitag_Samstag".split("_"),
			weekdaysShort: "So._Mo._Di._Mi._Do._Fr._Sa.".split("_"),
			weekdaysMin: "So_Mo_Di_Mi_Do_Fr_Sa".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY HH:mm",
				LLLL: "dddd, D. MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[heute um] LT [Uhr]",
				sameElse: "L",
				nextDay: "[morgen um] LT [Uhr]",
				nextWeek: "dddd [um] LT [Uhr]",
				lastDay: "[gestern um] LT [Uhr]",
				lastWeek: "[letzten] dddd [um] LT [Uhr]"
			},
			relativeTime: {
				future: "in %s",
				past: "vor %s",
				s: "ein paar Sekunden",
				ss: "%d Sekunden",
				m: t,
				mm: "%d Minuten",
				h: t,
				hh: "%d Stunden",
				d: t,
				dd: t,
				M: t,
				MM: t,
				y: t,
				yy: t
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n, r) {
			var i = {
				m: ["eine Minute", "einer Minute"],
				h: ["eine Stunde", "einer Stunde"],
				d: ["ein Tag", "einem Tag"],
				dd: [e + " Tage", e + " Tagen"],
				M: ["ein Monat", "einem Monat"],
				MM: [e + " Monate", e + " Monaten"],
				y: ["ein Jahr", "einem Jahr"],
				yy: [e + " Jahre", e + " Jahren"]
			};
			return t ? i[n][0] : i[n][1]
		}

		e.defineLocale("de-at", {
			months: "Jänner_Februar_März_April_Mai_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
			monthsShort: "Jän._Feb._März_Apr._Mai_Juni_Juli_Aug._Sep._Okt._Nov._Dez.".split("_"),
			monthsParseExact: !0,
			weekdays: "Sonntag_Montag_Dienstag_Mittwoch_Donnerstag_Freitag_Samstag".split("_"),
			weekdaysShort: "So._Mo._Di._Mi._Do._Fr._Sa.".split("_"),
			weekdaysMin: "So_Mo_Di_Mi_Do_Fr_Sa".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY HH:mm",
				LLLL: "dddd, D. MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[heute um] LT [Uhr]",
				sameElse: "L",
				nextDay: "[morgen um] LT [Uhr]",
				nextWeek: "dddd [um] LT [Uhr]",
				lastDay: "[gestern um] LT [Uhr]",
				lastWeek: "[letzten] dddd [um] LT [Uhr]"
			},
			relativeTime: {
				future: "in %s",
				past: "vor %s",
				s: "ein paar Sekunden",
				ss: "%d Sekunden",
				m: t,
				mm: "%d Minuten",
				h: t,
				hh: "%d Stunden",
				d: t,
				dd: t,
				M: t,
				MM: t,
				y: t,
				yy: t
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n, r) {
			var i = {
				m: ["eine Minute", "einer Minute"],
				h: ["eine Stunde", "einer Stunde"],
				d: ["ein Tag", "einem Tag"],
				dd: [e + " Tage", e + " Tagen"],
				M: ["ein Monat", "einem Monat"],
				MM: [e + " Monate", e + " Monaten"],
				y: ["ein Jahr", "einem Jahr"],
				yy: [e + " Jahre", e + " Jahren"]
			};
			return t ? i[n][0] : i[n][1]
		}

		e.defineLocale("de-ch", {
			months: "Januar_Februar_März_April_Mai_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
			monthsShort: "Jan._Feb._März_Apr._Mai_Juni_Juli_Aug._Sep._Okt._Nov._Dez.".split("_"),
			monthsParseExact: !0,
			weekdays: "Sonntag_Montag_Dienstag_Mittwoch_Donnerstag_Freitag_Samstag".split("_"),
			weekdaysShort: "So_Mo_Di_Mi_Do_Fr_Sa".split("_"),
			weekdaysMin: "So_Mo_Di_Mi_Do_Fr_Sa".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY HH:mm",
				LLLL: "dddd, D. MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[heute um] LT [Uhr]",
				sameElse: "L",
				nextDay: "[morgen um] LT [Uhr]",
				nextWeek: "dddd [um] LT [Uhr]",
				lastDay: "[gestern um] LT [Uhr]",
				lastWeek: "[letzten] dddd [um] LT [Uhr]"
			},
			relativeTime: {
				future: "in %s",
				past: "vor %s",
				s: "ein paar Sekunden",
				ss: "%d Sekunden",
				m: t,
				mm: "%d Minuten",
				h: t,
				hh: "%d Stunden",
				d: t,
				dd: t,
				M: t,
				MM: t,
				y: t,
				yy: t
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = ["ޖެނުއަރީ", "ފެބްރުއަރީ", "މާރިޗު", "އޭޕްރީލު", "މޭ", "ޖޫން", "ޖުލައި", "އޯގަސްޓު", "ސެޕްޓެމްބަރު", "އޮކްޓޯބަރު", "ނޮވެމްބަރު", "ޑިސެމްބަރު"],
			n = ["އާދިއްތަ", "ހޯމަ", "އަންގާރަ", "ބުދަ", "ބުރާސްފަތި", "ހުކުރު", "ހޮނިހިރު"];
		e.defineLocale("dv", {
			months: t,
			monthsShort: t,
			weekdays: n,
			weekdaysShort: n,
			weekdaysMin: "އާދި_ހޯމަ_އަން_ބުދަ_ބުރާ_ހުކު_ހޮނި".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "D/M/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			meridiemParse: /މކ|މފ/,
			isPM: function (e) {
				return "މފ" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "މކ" : "މފ"
			},
			calendar: {
				sameDay: "[މިއަދު] LT",
				nextDay: "[މާދަމާ] LT",
				nextWeek: "dddd LT",
				lastDay: "[އިއްޔެ] LT",
				lastWeek: "[ފާއިތުވި] dddd LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "ތެރޭގައި %s",
				past: "ކުރިން %s",
				s: "ސިކުންތުކޮޅެއް",
				ss: "d% ސިކުންތު",
				m: "މިނިޓެއް",
				mm: "މިނިޓު %d",
				h: "ގަޑިއިރެއް",
				hh: "ގަޑިއިރު %d",
				d: "ދުވަހެއް",
				dd: "ދުވަސް %d",
				M: "މަހެއް",
				MM: "މަސް %d",
				y: "އަހަރެއް",
				yy: "އަހަރު %d"
			},
			preparse: function (e) {
				return e.replace(/،/g, ",")
			},
			postformat: function (e) {
				return e.replace(/,/g, "،")
			},
			week: {dow: 7, doy: 12}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("el", {
			monthsNominativeEl: "Ιανουάριος_Φεβρουάριος_Μάρτιος_Απρίλιος_Μάιος_Ιούνιος_Ιούλιος_Αύγουστος_Σεπτέμβριος_Οκτώβριος_Νοέμβριος_Δεκέμβριος".split("_"),
			monthsGenitiveEl: "Ιανουαρίου_Φεβρουαρίου_Μαρτίου_Απριλίου_Μαΐου_Ιουνίου_Ιουλίου_Αυγούστου_Σεπτεμβρίου_Οκτωβρίου_Νοεμβρίου_Δεκεμβρίου".split("_"),
			months: function (e, t) {
				return e ? "string" == typeof t && /D/.test(t.substring(0, t.indexOf("MMMM"))) ? this._monthsGenitiveEl[e.month()] : this._monthsNominativeEl[e.month()] : this._monthsNominativeEl
			},
			monthsShort: "Ιαν_Φεβ_Μαρ_Απρ_Μαϊ_Ιουν_Ιουλ_Αυγ_Σεπ_Οκτ_Νοε_Δεκ".split("_"),
			weekdays: "Κυριακή_Δευτέρα_Τρίτη_Τετάρτη_Πέμπτη_Παρασκευή_Σάββατο".split("_"),
			weekdaysShort: "Κυρ_Δευ_Τρι_Τετ_Πεμ_Παρ_Σαβ".split("_"),
			weekdaysMin: "Κυ_Δε_Τρ_Τε_Πε_Πα_Σα".split("_"),
			meridiem: function (e, t, n) {
				return e > 11 ? n ? "μμ" : "ΜΜ" : n ? "πμ" : "ΠΜ"
			},
			isPM: function (e) {
				return "μ" === (e + "").toLowerCase()[0]
			},
			meridiemParse: /[ΠΜ]\.?Μ?\.?/i,
			longDateFormat: {
				LT: "h:mm A",
				LTS: "h:mm:ss A",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY h:mm A",
				LLLL: "dddd, D MMMM YYYY h:mm A"
			},
			calendarEl: {
				sameDay: "[Σήμερα {}] LT",
				nextDay: "[Αύριο {}] LT",
				nextWeek: "dddd [{}] LT",
				lastDay: "[Χθες {}] LT",
				lastWeek: function () {
					switch (this.day()) {
						case 6:
							return "[το προηγούμενο] dddd [{}] LT";
						default:
							return "[την προηγούμενη] dddd [{}] LT"
					}
				},
				sameElse: "L"
			},
			calendar: function (e, t) {
				var n, r = this._calendarEl[e], i = t && t.hours();
				return ((n = r) instanceof Function || "[object Function]" === Object.prototype.toString.call(n)) && (r = r.apply(t)), r.replace("{}", i % 12 == 1 ? "στη" : "στις")
			},
			relativeTime: {
				future: "σε %s",
				past: "%s πριν",
				s: "λίγα δευτερόλεπτα",
				ss: "%d δευτερόλεπτα",
				m: "ένα λεπτό",
				mm: "%d λεπτά",
				h: "μία ώρα",
				hh: "%d ώρες",
				d: "μία μέρα",
				dd: "%d μέρες",
				M: "ένας μήνας",
				MM: "%d μήνες",
				y: "ένας χρόνος",
				yy: "%d χρόνια"
			},
			dayOfMonthOrdinalParse: /\d{1,2}η/,
			ordinal: "%dη",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("en-au", {
			months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
			monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
			weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
			weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
			weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
			longDateFormat: {
				LT: "h:mm A",
				LTS: "h:mm:ss A",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY h:mm A",
				LLLL: "dddd, D MMMM YYYY h:mm A"
			},
			calendar: {
				sameDay: "[Today at] LT",
				nextDay: "[Tomorrow at] LT",
				nextWeek: "dddd [at] LT",
				lastDay: "[Yesterday at] LT",
				lastWeek: "[Last] dddd [at] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "in %s",
				past: "%s ago",
				s: "a few seconds",
				ss: "%d seconds",
				m: "a minute",
				mm: "%d minutes",
				h: "an hour",
				hh: "%d hours",
				d: "a day",
				dd: "%d days",
				M: "a month",
				MM: "%d months",
				y: "a year",
				yy: "%d years"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
			ordinal: function (e) {
				var t = e % 10;
				return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("en-ca", {
			months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
			monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
			weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
			weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
			weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
			longDateFormat: {
				LT: "h:mm A",
				LTS: "h:mm:ss A",
				L: "YYYY-MM-DD",
				LL: "MMMM D, YYYY",
				LLL: "MMMM D, YYYY h:mm A",
				LLLL: "dddd, MMMM D, YYYY h:mm A"
			},
			calendar: {
				sameDay: "[Today at] LT",
				nextDay: "[Tomorrow at] LT",
				nextWeek: "dddd [at] LT",
				lastDay: "[Yesterday at] LT",
				lastWeek: "[Last] dddd [at] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "in %s",
				past: "%s ago",
				s: "a few seconds",
				ss: "%d seconds",
				m: "a minute",
				mm: "%d minutes",
				h: "an hour",
				hh: "%d hours",
				d: "a day",
				dd: "%d days",
				M: "a month",
				MM: "%d months",
				y: "a year",
				yy: "%d years"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
			ordinal: function (e) {
				var t = e % 10;
				return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("en-gb", {
			months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
			monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
			weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
			weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
			weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Today at] LT",
				nextDay: "[Tomorrow at] LT",
				nextWeek: "dddd [at] LT",
				lastDay: "[Yesterday at] LT",
				lastWeek: "[Last] dddd [at] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "in %s",
				past: "%s ago",
				s: "a few seconds",
				ss: "%d seconds",
				m: "a minute",
				mm: "%d minutes",
				h: "an hour",
				hh: "%d hours",
				d: "a day",
				dd: "%d days",
				M: "a month",
				MM: "%d months",
				y: "a year",
				yy: "%d years"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
			ordinal: function (e) {
				var t = e % 10;
				return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("en-ie", {
			months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
			monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
			weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
			weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
			weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD-MM-YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Today at] LT",
				nextDay: "[Tomorrow at] LT",
				nextWeek: "dddd [at] LT",
				lastDay: "[Yesterday at] LT",
				lastWeek: "[Last] dddd [at] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "in %s",
				past: "%s ago",
				s: "a few seconds",
				ss: "%d seconds",
				m: "a minute",
				mm: "%d minutes",
				h: "an hour",
				hh: "%d hours",
				d: "a day",
				dd: "%d days",
				M: "a month",
				MM: "%d months",
				y: "a year",
				yy: "%d years"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
			ordinal: function (e) {
				var t = e % 10;
				return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("en-il", {
			months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
			monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
			weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
			weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
			weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Today at] LT",
				nextDay: "[Tomorrow at] LT",
				nextWeek: "dddd [at] LT",
				lastDay: "[Yesterday at] LT",
				lastWeek: "[Last] dddd [at] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "in %s",
				past: "%s ago",
				s: "a few seconds",
				m: "a minute",
				mm: "%d minutes",
				h: "an hour",
				hh: "%d hours",
				d: "a day",
				dd: "%d days",
				M: "a month",
				MM: "%d months",
				y: "a year",
				yy: "%d years"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
			ordinal: function (e) {
				var t = e % 10;
				return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("en-nz", {
			months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
			monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
			weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
			weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
			weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
			longDateFormat: {
				LT: "h:mm A",
				LTS: "h:mm:ss A",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY h:mm A",
				LLLL: "dddd, D MMMM YYYY h:mm A"
			},
			calendar: {
				sameDay: "[Today at] LT",
				nextDay: "[Tomorrow at] LT",
				nextWeek: "dddd [at] LT",
				lastDay: "[Yesterday at] LT",
				lastWeek: "[Last] dddd [at] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "in %s",
				past: "%s ago",
				s: "a few seconds",
				ss: "%d seconds",
				m: "a minute",
				mm: "%d minutes",
				h: "an hour",
				hh: "%d hours",
				d: "a day",
				dd: "%d days",
				M: "a month",
				MM: "%d months",
				y: "a year",
				yy: "%d years"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
			ordinal: function (e) {
				var t = e % 10;
				return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("eo", {
			months: "januaro_februaro_marto_aprilo_majo_junio_julio_aŭgusto_septembro_oktobro_novembro_decembro".split("_"),
			monthsShort: "jan_feb_mar_apr_maj_jun_jul_aŭg_sep_okt_nov_dec".split("_"),
			weekdays: "dimanĉo_lundo_mardo_merkredo_ĵaŭdo_vendredo_sabato".split("_"),
			weekdaysShort: "dim_lun_mard_merk_ĵaŭ_ven_sab".split("_"),
			weekdaysMin: "di_lu_ma_me_ĵa_ve_sa".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY-MM-DD",
				LL: "D[-a de] MMMM, YYYY",
				LLL: "D[-a de] MMMM, YYYY HH:mm",
				LLLL: "dddd, [la] D[-a de] MMMM, YYYY HH:mm"
			},
			meridiemParse: /[ap]\.t\.m/i,
			isPM: function (e) {
				return "p" === e.charAt(0).toLowerCase()
			},
			meridiem: function (e, t, n) {
				return e > 11 ? n ? "p.t.m." : "P.T.M." : n ? "a.t.m." : "A.T.M."
			},
			calendar: {
				sameDay: "[Hodiaŭ je] LT",
				nextDay: "[Morgaŭ je] LT",
				nextWeek: "dddd [je] LT",
				lastDay: "[Hieraŭ je] LT",
				lastWeek: "[pasinta] dddd [je] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "post %s",
				past: "antaŭ %s",
				s: "sekundoj",
				ss: "%d sekundoj",
				m: "minuto",
				mm: "%d minutoj",
				h: "horo",
				hh: "%d horoj",
				d: "tago",
				dd: "%d tagoj",
				M: "monato",
				MM: "%d monatoj",
				y: "jaro",
				yy: "%d jaroj"
			},
			dayOfMonthOrdinalParse: /\d{1,2}a/,
			ordinal: "%da",
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "ene._feb._mar._abr._may._jun._jul._ago._sep._oct._nov._dic.".split("_"),
			n = "ene_feb_mar_abr_may_jun_jul_ago_sep_oct_nov_dic".split("_"),
			r = [/^ene/i, /^feb/i, /^mar/i, /^abr/i, /^may/i, /^jun/i, /^jul/i, /^ago/i, /^sep/i, /^oct/i, /^nov/i, /^dic/i],
			i = /^(enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre|ene\.?|feb\.?|mar\.?|abr\.?|may\.?|jun\.?|jul\.?|ago\.?|sep\.?|oct\.?|nov\.?|dic\.?)/i;
		e.defineLocale("es", {
			months: "enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split("_"),
			monthsShort: function (e, r) {
				return e ? /-MMM-/.test(r) ? n[e.month()] : t[e.month()] : t
			},
			monthsRegex: i,
			monthsShortRegex: i,
			monthsStrictRegex: /^(enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre)/i,
			monthsShortStrictRegex: /^(ene\.?|feb\.?|mar\.?|abr\.?|may\.?|jun\.?|jul\.?|ago\.?|sep\.?|oct\.?|nov\.?|dic\.?)/i,
			monthsParse: r,
			longMonthsParse: r,
			shortMonthsParse: r,
			weekdays: "domingo_lunes_martes_miércoles_jueves_viernes_sábado".split("_"),
			weekdaysShort: "dom._lun._mar._mié._jue._vie._sáb.".split("_"),
			weekdaysMin: "do_lu_ma_mi_ju_vi_sá".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D [de] MMMM [de] YYYY",
				LLL: "D [de] MMMM [de] YYYY H:mm",
				LLLL: "dddd, D [de] MMMM [de] YYYY H:mm"
			},
			calendar: {
				sameDay: function () {
					return "[hoy a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, nextDay: function () {
					return "[mañana a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, nextWeek: function () {
					return "dddd [a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, lastDay: function () {
					return "[ayer a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, lastWeek: function () {
					return "[el] dddd [pasado a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, sameElse: "L"
			},
			relativeTime: {
				future: "en %s",
				past: "hace %s",
				s: "unos segundos",
				ss: "%d segundos",
				m: "un minuto",
				mm: "%d minutos",
				h: "una hora",
				hh: "%d horas",
				d: "un día",
				dd: "%d días",
				M: "un mes",
				MM: "%d meses",
				y: "un año",
				yy: "%d años"
			},
			dayOfMonthOrdinalParse: /\d{1,2}º/,
			ordinal: "%dº",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "ene._feb._mar._abr._may._jun._jul._ago._sep._oct._nov._dic.".split("_"),
			n = "ene_feb_mar_abr_may_jun_jul_ago_sep_oct_nov_dic".split("_"),
			r = [/^ene/i, /^feb/i, /^mar/i, /^abr/i, /^may/i, /^jun/i, /^jul/i, /^ago/i, /^sep/i, /^oct/i, /^nov/i, /^dic/i],
			i = /^(enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre|ene\.?|feb\.?|mar\.?|abr\.?|may\.?|jun\.?|jul\.?|ago\.?|sep\.?|oct\.?|nov\.?|dic\.?)/i;
		e.defineLocale("es-do", {
			months: "enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split("_"),
			monthsShort: function (e, r) {
				return e ? /-MMM-/.test(r) ? n[e.month()] : t[e.month()] : t
			},
			monthsRegex: i,
			monthsShortRegex: i,
			monthsStrictRegex: /^(enero|febrero|marzo|abril|mayo|junio|julio|agosto|septiembre|octubre|noviembre|diciembre)/i,
			monthsShortStrictRegex: /^(ene\.?|feb\.?|mar\.?|abr\.?|may\.?|jun\.?|jul\.?|ago\.?|sep\.?|oct\.?|nov\.?|dic\.?)/i,
			monthsParse: r,
			longMonthsParse: r,
			shortMonthsParse: r,
			weekdays: "domingo_lunes_martes_miércoles_jueves_viernes_sábado".split("_"),
			weekdaysShort: "dom._lun._mar._mié._jue._vie._sáb.".split("_"),
			weekdaysMin: "do_lu_ma_mi_ju_vi_sá".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "h:mm A",
				LTS: "h:mm:ss A",
				L: "DD/MM/YYYY",
				LL: "D [de] MMMM [de] YYYY",
				LLL: "D [de] MMMM [de] YYYY h:mm A",
				LLLL: "dddd, D [de] MMMM [de] YYYY h:mm A"
			},
			calendar: {
				sameDay: function () {
					return "[hoy a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, nextDay: function () {
					return "[mañana a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, nextWeek: function () {
					return "dddd [a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, lastDay: function () {
					return "[ayer a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, lastWeek: function () {
					return "[el] dddd [pasado a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, sameElse: "L"
			},
			relativeTime: {
				future: "en %s",
				past: "hace %s",
				s: "unos segundos",
				ss: "%d segundos",
				m: "un minuto",
				mm: "%d minutos",
				h: "una hora",
				hh: "%d horas",
				d: "un día",
				dd: "%d días",
				M: "un mes",
				MM: "%d meses",
				y: "un año",
				yy: "%d años"
			},
			dayOfMonthOrdinalParse: /\d{1,2}º/,
			ordinal: "%dº",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "ene._feb._mar._abr._may._jun._jul._ago._sep._oct._nov._dic.".split("_"),
			n = "ene_feb_mar_abr_may_jun_jul_ago_sep_oct_nov_dic".split("_");
		e.defineLocale("es-us", {
			months: "enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split("_"),
			monthsShort: function (e, r) {
				return e ? /-MMM-/.test(r) ? n[e.month()] : t[e.month()] : t
			},
			monthsParseExact: !0,
			weekdays: "domingo_lunes_martes_miércoles_jueves_viernes_sábado".split("_"),
			weekdaysShort: "dom._lun._mar._mié._jue._vie._sáb.".split("_"),
			weekdaysMin: "do_lu_ma_mi_ju_vi_sá".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "h:mm A",
				LTS: "h:mm:ss A",
				L: "MM/DD/YYYY",
				LL: "MMMM [de] D [de] YYYY",
				LLL: "MMMM [de] D [de] YYYY h:mm A",
				LLLL: "dddd, MMMM [de] D [de] YYYY h:mm A"
			},
			calendar: {
				sameDay: function () {
					return "[hoy a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, nextDay: function () {
					return "[mañana a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, nextWeek: function () {
					return "dddd [a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, lastDay: function () {
					return "[ayer a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, lastWeek: function () {
					return "[el] dddd [pasado a la" + (1 !== this.hours() ? "s" : "") + "] LT"
				}, sameElse: "L"
			},
			relativeTime: {
				future: "en %s",
				past: "hace %s",
				s: "unos segundos",
				ss: "%d segundos",
				m: "un minuto",
				mm: "%d minutos",
				h: "una hora",
				hh: "%d horas",
				d: "un día",
				dd: "%d días",
				M: "un mes",
				MM: "%d meses",
				y: "un año",
				yy: "%d años"
			},
			dayOfMonthOrdinalParse: /\d{1,2}º/,
			ordinal: "%dº",
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n, r) {
			var i = {
				s: ["mõne sekundi", "mõni sekund", "paar sekundit"],
				ss: [e + "sekundi", e + "sekundit"],
				m: ["ühe minuti", "üks minut"],
				mm: [e + " minuti", e + " minutit"],
				h: ["ühe tunni", "tund aega", "üks tund"],
				hh: [e + " tunni", e + " tundi"],
				d: ["ühe päeva", "üks päev"],
				M: ["kuu aja", "kuu aega", "üks kuu"],
				MM: [e + " kuu", e + " kuud"],
				y: ["ühe aasta", "aasta", "üks aasta"],
				yy: [e + " aasta", e + " aastat"]
			};
			return t ? i[n][2] ? i[n][2] : i[n][1] : r ? i[n][0] : i[n][1]
		}

		e.defineLocale("et", {
			months: "jaanuar_veebruar_märts_aprill_mai_juuni_juuli_august_september_oktoober_november_detsember".split("_"),
			monthsShort: "jaan_veebr_märts_apr_mai_juuni_juuli_aug_sept_okt_nov_dets".split("_"),
			weekdays: "pühapäev_esmaspäev_teisipäev_kolmapäev_neljapäev_reede_laupäev".split("_"),
			weekdaysShort: "P_E_T_K_N_R_L".split("_"),
			weekdaysMin: "P_E_T_K_N_R_L".split("_"),
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm",
				LLLL: "dddd, D. MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[Täna,] LT",
				nextDay: "[Homme,] LT",
				nextWeek: "[Järgmine] dddd LT",
				lastDay: "[Eile,] LT",
				lastWeek: "[Eelmine] dddd LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s pärast",
				past: "%s tagasi",
				s: t,
				ss: t,
				m: t,
				mm: t,
				h: t,
				hh: t,
				d: t,
				dd: "%d päeva",
				M: t,
				MM: t,
				y: t,
				yy: t
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("eu", {
			months: "urtarrila_otsaila_martxoa_apirila_maiatza_ekaina_uztaila_abuztua_iraila_urria_azaroa_abendua".split("_"),
			monthsShort: "urt._ots._mar._api._mai._eka._uzt._abu._ira._urr._aza._abe.".split("_"),
			monthsParseExact: !0,
			weekdays: "igandea_astelehena_asteartea_asteazkena_osteguna_ostirala_larunbata".split("_"),
			weekdaysShort: "ig._al._ar._az._og._ol._lr.".split("_"),
			weekdaysMin: "ig_al_ar_az_og_ol_lr".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY-MM-DD",
				LL: "YYYY[ko] MMMM[ren] D[a]",
				LLL: "YYYY[ko] MMMM[ren] D[a] HH:mm",
				LLLL: "dddd, YYYY[ko] MMMM[ren] D[a] HH:mm",
				l: "YYYY-M-D",
				ll: "YYYY[ko] MMM D[a]",
				lll: "YYYY[ko] MMM D[a] HH:mm",
				llll: "ddd, YYYY[ko] MMM D[a] HH:mm"
			},
			calendar: {
				sameDay: "[gaur] LT[etan]",
				nextDay: "[bihar] LT[etan]",
				nextWeek: "dddd LT[etan]",
				lastDay: "[atzo] LT[etan]",
				lastWeek: "[aurreko] dddd LT[etan]",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s barru",
				past: "duela %s",
				s: "segundo batzuk",
				ss: "%d segundo",
				m: "minutu bat",
				mm: "%d minutu",
				h: "ordu bat",
				hh: "%d ordu",
				d: "egun bat",
				dd: "%d egun",
				M: "hilabete bat",
				MM: "%d hilabete",
				y: "urte bat",
				yy: "%d urte"
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "۱", 2: "۲", 3: "۳", 4: "۴", 5: "۵", 6: "۶", 7: "۷", 8: "۸", 9: "۹", 0: "۰"},
			n = {"۱": "1", "۲": "2", "۳": "3", "۴": "4", "۵": "5", "۶": "6", "۷": "7", "۸": "8", "۹": "9", "۰": "0"};
		e.defineLocale("fa", {
			months: "ژانویه_فوریه_مارس_آوریل_مه_ژوئن_ژوئیه_اوت_سپتامبر_اکتبر_نوامبر_دسامبر".split("_"),
			monthsShort: "ژانویه_فوریه_مارس_آوریل_مه_ژوئن_ژوئیه_اوت_سپتامبر_اکتبر_نوامبر_دسامبر".split("_"),
			weekdays: "یک‌شنبه_دوشنبه_سه‌شنبه_چهارشنبه_پنج‌شنبه_جمعه_شنبه".split("_"),
			weekdaysShort: "یک‌شنبه_دوشنبه_سه‌شنبه_چهارشنبه_پنج‌شنبه_جمعه_شنبه".split("_"),
			weekdaysMin: "ی_د_س_چ_پ_ج_ش".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			meridiemParse: /قبل از ظهر|بعد از ظهر/,
			isPM: function (e) {
				return /بعد از ظهر/.test(e)
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "قبل از ظهر" : "بعد از ظهر"
			},
			calendar: {
				sameDay: "[امروز ساعت] LT",
				nextDay: "[فردا ساعت] LT",
				nextWeek: "dddd [ساعت] LT",
				lastDay: "[دیروز ساعت] LT",
				lastWeek: "dddd [پیش] [ساعت] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "در %s",
				past: "%s پیش",
				s: "چند ثانیه",
				ss: "ثانیه d%",
				m: "یک دقیقه",
				mm: "%d دقیقه",
				h: "یک ساعت",
				hh: "%d ساعت",
				d: "یک روز",
				dd: "%d روز",
				M: "یک ماه",
				MM: "%d ماه",
				y: "یک سال",
				yy: "%d سال"
			},
			preparse: function (e) {
				return e.replace(/[۰-۹]/g, function (e) {
					return n[e]
				}).replace(/،/g, ",")
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				}).replace(/,/g, "،")
			},
			dayOfMonthOrdinalParse: /\d{1,2}م/,
			ordinal: "%dم",
			week: {dow: 6, doy: 12}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "nolla yksi kaksi kolme neljä viisi kuusi seitsemän kahdeksan yhdeksän".split(" "),
			n = ["nolla", "yhden", "kahden", "kolmen", "neljän", "viiden", "kuuden", t[7], t[8], t[9]];

		function r(e, r, i, a) {
			var s = "";
			switch (i) {
				case"s":
					return a ? "muutaman sekunnin" : "muutama sekunti";
				case"ss":
					return a ? "sekunnin" : "sekuntia";
				case"m":
					return a ? "minuutin" : "minuutti";
				case"mm":
					s = a ? "minuutin" : "minuuttia";
					break;
				case"h":
					return a ? "tunnin" : "tunti";
				case"hh":
					s = a ? "tunnin" : "tuntia";
					break;
				case"d":
					return a ? "päivän" : "päivä";
				case"dd":
					s = a ? "päivän" : "päivää";
					break;
				case"M":
					return a ? "kuukauden" : "kuukausi";
				case"MM":
					s = a ? "kuukauden" : "kuukautta";
					break;
				case"y":
					return a ? "vuoden" : "vuosi";
				case"yy":
					s = a ? "vuoden" : "vuotta"
			}
			return s = function (e, r) {
				return e < 10 ? r ? n[e] : t[e] : e
			}(e, a) + " " + s
		}

		e.defineLocale("fi", {
			months: "tammikuu_helmikuu_maaliskuu_huhtikuu_toukokuu_kesäkuu_heinäkuu_elokuu_syyskuu_lokakuu_marraskuu_joulukuu".split("_"),
			monthsShort: "tammi_helmi_maalis_huhti_touko_kesä_heinä_elo_syys_loka_marras_joulu".split("_"),
			weekdays: "sunnuntai_maanantai_tiistai_keskiviikko_torstai_perjantai_lauantai".split("_"),
			weekdaysShort: "su_ma_ti_ke_to_pe_la".split("_"),
			weekdaysMin: "su_ma_ti_ke_to_pe_la".split("_"),
			longDateFormat: {
				LT: "HH.mm",
				LTS: "HH.mm.ss",
				L: "DD.MM.YYYY",
				LL: "Do MMMM[ta] YYYY",
				LLL: "Do MMMM[ta] YYYY, [klo] HH.mm",
				LLLL: "dddd, Do MMMM[ta] YYYY, [klo] HH.mm",
				l: "D.M.YYYY",
				ll: "Do MMM YYYY",
				lll: "Do MMM YYYY, [klo] HH.mm",
				llll: "ddd, Do MMM YYYY, [klo] HH.mm"
			},
			calendar: {
				sameDay: "[tänään] [klo] LT",
				nextDay: "[huomenna] [klo] LT",
				nextWeek: "dddd [klo] LT",
				lastDay: "[eilen] [klo] LT",
				lastWeek: "[viime] dddd[na] [klo] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s päästä",
				past: "%s sitten",
				s: r,
				ss: r,
				m: r,
				mm: r,
				h: r,
				hh: r,
				d: r,
				dd: r,
				M: r,
				MM: r,
				y: r,
				yy: r
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("fo", {
			months: "januar_februar_mars_apríl_mai_juni_juli_august_september_oktober_november_desember".split("_"),
			monthsShort: "jan_feb_mar_apr_mai_jun_jul_aug_sep_okt_nov_des".split("_"),
			weekdays: "sunnudagur_mánadagur_týsdagur_mikudagur_hósdagur_fríggjadagur_leygardagur".split("_"),
			weekdaysShort: "sun_mán_týs_mik_hós_frí_ley".split("_"),
			weekdaysMin: "su_má_tý_mi_hó_fr_le".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D. MMMM, YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Í dag kl.] LT",
				nextDay: "[Í morgin kl.] LT",
				nextWeek: "dddd [kl.] LT",
				lastDay: "[Í gjár kl.] LT",
				lastWeek: "[síðstu] dddd [kl] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "um %s",
				past: "%s síðani",
				s: "fá sekund",
				ss: "%d sekundir",
				m: "ein minutt",
				mm: "%d minuttir",
				h: "ein tími",
				hh: "%d tímar",
				d: "ein dagur",
				dd: "%d dagar",
				M: "ein mánaði",
				MM: "%d mánaðir",
				y: "eitt ár",
				yy: "%d ár"
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("fr", {
			months: "janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre".split("_"),
			monthsShort: "janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.".split("_"),
			monthsParseExact: !0,
			weekdays: "dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi".split("_"),
			weekdaysShort: "dim._lun._mar._mer._jeu._ven._sam.".split("_"),
			weekdaysMin: "di_lu_ma_me_je_ve_sa".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Aujourd’hui à] LT",
				nextDay: "[Demain à] LT",
				nextWeek: "dddd [à] LT",
				lastDay: "[Hier à] LT",
				lastWeek: "dddd [dernier à] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "dans %s",
				past: "il y a %s",
				s: "quelques secondes",
				ss: "%d secondes",
				m: "une minute",
				mm: "%d minutes",
				h: "une heure",
				hh: "%d heures",
				d: "un jour",
				dd: "%d jours",
				M: "un mois",
				MM: "%d mois",
				y: "un an",
				yy: "%d ans"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(er|)/,
			ordinal: function (e, t) {
				switch (t) {
					case"D":
						return e + (1 === e ? "er" : "");
					default:
					case"M":
					case"Q":
					case"DDD":
					case"d":
						return e + (1 === e ? "er" : "e");
					case"w":
					case"W":
						return e + (1 === e ? "re" : "e")
				}
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("fr-ca", {
			months: "janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre".split("_"),
			monthsShort: "janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.".split("_"),
			monthsParseExact: !0,
			weekdays: "dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi".split("_"),
			weekdaysShort: "dim._lun._mar._mer._jeu._ven._sam.".split("_"),
			weekdaysMin: "di_lu_ma_me_je_ve_sa".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY-MM-DD",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Aujourd’hui à] LT",
				nextDay: "[Demain à] LT",
				nextWeek: "dddd [à] LT",
				lastDay: "[Hier à] LT",
				lastWeek: "dddd [dernier à] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "dans %s",
				past: "il y a %s",
				s: "quelques secondes",
				ss: "%d secondes",
				m: "une minute",
				mm: "%d minutes",
				h: "une heure",
				hh: "%d heures",
				d: "un jour",
				dd: "%d jours",
				M: "un mois",
				MM: "%d mois",
				y: "un an",
				yy: "%d ans"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(er|e)/,
			ordinal: function (e, t) {
				switch (t) {
					default:
					case"M":
					case"Q":
					case"D":
					case"DDD":
					case"d":
						return e + (1 === e ? "er" : "e");
					case"w":
					case"W":
						return e + (1 === e ? "re" : "e")
				}
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("fr-ch", {
			months: "janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre".split("_"),
			monthsShort: "janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.".split("_"),
			monthsParseExact: !0,
			weekdays: "dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi".split("_"),
			weekdaysShort: "dim._lun._mar._mer._jeu._ven._sam.".split("_"),
			weekdaysMin: "di_lu_ma_me_je_ve_sa".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Aujourd’hui à] LT",
				nextDay: "[Demain à] LT",
				nextWeek: "dddd [à] LT",
				lastDay: "[Hier à] LT",
				lastWeek: "dddd [dernier à] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "dans %s",
				past: "il y a %s",
				s: "quelques secondes",
				ss: "%d secondes",
				m: "une minute",
				mm: "%d minutes",
				h: "une heure",
				hh: "%d heures",
				d: "un jour",
				dd: "%d jours",
				M: "un mois",
				MM: "%d mois",
				y: "un an",
				yy: "%d ans"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(er|e)/,
			ordinal: function (e, t) {
				switch (t) {
					default:
					case"M":
					case"Q":
					case"D":
					case"DDD":
					case"d":
						return e + (1 === e ? "er" : "e");
					case"w":
					case"W":
						return e + (1 === e ? "re" : "e")
				}
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "jan._feb._mrt._apr._mai_jun._jul._aug._sep._okt._nov._des.".split("_"),
			n = "jan_feb_mrt_apr_mai_jun_jul_aug_sep_okt_nov_des".split("_");
		e.defineLocale("fy", {
			months: "jannewaris_febrewaris_maart_april_maaie_juny_july_augustus_septimber_oktober_novimber_desimber".split("_"),
			monthsShort: function (e, r) {
				return e ? /-MMM-/.test(r) ? n[e.month()] : t[e.month()] : t
			},
			monthsParseExact: !0,
			weekdays: "snein_moandei_tiisdei_woansdei_tongersdei_freed_sneon".split("_"),
			weekdaysShort: "si._mo._ti._wo._to._fr._so.".split("_"),
			weekdaysMin: "Si_Mo_Ti_Wo_To_Fr_So".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD-MM-YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[hjoed om] LT",
				nextDay: "[moarn om] LT",
				nextWeek: "dddd [om] LT",
				lastDay: "[juster om] LT",
				lastWeek: "[ôfrûne] dddd [om] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "oer %s",
				past: "%s lyn",
				s: "in pear sekonden",
				ss: "%d sekonden",
				m: "ien minút",
				mm: "%d minuten",
				h: "ien oere",
				hh: "%d oeren",
				d: "ien dei",
				dd: "%d dagen",
				M: "ien moanne",
				MM: "%d moannen",
				y: "ien jier",
				yy: "%d jierren"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(ste|de)/,
			ordinal: function (e) {
				return e + (1 === e || 8 === e || e >= 20 ? "ste" : "de")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("gd", {
			months: ["Am Faoilleach", "An Gearran", "Am Màrt", "An Giblean", "An Cèitean", "An t-Ògmhios", "An t-Iuchar", "An Lùnastal", "An t-Sultain", "An Dàmhair", "An t-Samhain", "An Dùbhlachd"],
			monthsShort: ["Faoi", "Gear", "Màrt", "Gibl", "Cèit", "Ògmh", "Iuch", "Lùn", "Sult", "Dàmh", "Samh", "Dùbh"],
			monthsParseExact: !0,
			weekdays: ["Didòmhnaich", "Diluain", "Dimàirt", "Diciadain", "Diardaoin", "Dihaoine", "Disathairne"],
			weekdaysShort: ["Did", "Dil", "Dim", "Dic", "Dia", "Dih", "Dis"],
			weekdaysMin: ["Dò", "Lu", "Mà", "Ci", "Ar", "Ha", "Sa"],
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[An-diugh aig] LT",
				nextDay: "[A-màireach aig] LT",
				nextWeek: "dddd [aig] LT",
				lastDay: "[An-dè aig] LT",
				lastWeek: "dddd [seo chaidh] [aig] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "ann an %s",
				past: "bho chionn %s",
				s: "beagan diogan",
				ss: "%d diogan",
				m: "mionaid",
				mm: "%d mionaidean",
				h: "uair",
				hh: "%d uairean",
				d: "latha",
				dd: "%d latha",
				M: "mìos",
				MM: "%d mìosan",
				y: "bliadhna",
				yy: "%d bliadhna"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(d|na|mh)/,
			ordinal: function (e) {
				return e + (1 === e ? "d" : e % 10 == 2 ? "na" : "mh")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("gl", {
			months: "xaneiro_febreiro_marzo_abril_maio_xuño_xullo_agosto_setembro_outubro_novembro_decembro".split("_"),
			monthsShort: "xan._feb._mar._abr._mai._xuñ._xul._ago._set._out._nov._dec.".split("_"),
			monthsParseExact: !0,
			weekdays: "domingo_luns_martes_mércores_xoves_venres_sábado".split("_"),
			weekdaysShort: "dom._lun._mar._mér._xov._ven._sáb.".split("_"),
			weekdaysMin: "do_lu_ma_mé_xo_ve_sá".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D [de] MMMM [de] YYYY",
				LLL: "D [de] MMMM [de] YYYY H:mm",
				LLLL: "dddd, D [de] MMMM [de] YYYY H:mm"
			},
			calendar: {
				sameDay: function () {
					return "[hoxe " + (1 !== this.hours() ? "ás" : "á") + "] LT"
				}, nextDay: function () {
					return "[mañá " + (1 !== this.hours() ? "ás" : "á") + "] LT"
				}, nextWeek: function () {
					return "dddd [" + (1 !== this.hours() ? "ás" : "a") + "] LT"
				}, lastDay: function () {
					return "[onte " + (1 !== this.hours() ? "á" : "a") + "] LT"
				}, lastWeek: function () {
					return "[o] dddd [pasado " + (1 !== this.hours() ? "ás" : "a") + "] LT"
				}, sameElse: "L"
			},
			relativeTime: {
				future: function (e) {
					return 0 === e.indexOf("un") ? "n" + e : "en " + e
				},
				past: "hai %s",
				s: "uns segundos",
				ss: "%d segundos",
				m: "un minuto",
				mm: "%d minutos",
				h: "unha hora",
				hh: "%d horas",
				d: "un día",
				dd: "%d días",
				M: "un mes",
				MM: "%d meses",
				y: "un ano",
				yy: "%d anos"
			},
			dayOfMonthOrdinalParse: /\d{1,2}º/,
			ordinal: "%dº",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n, r) {
			var i = {
				s: ["thodde secondanim", "thodde second"],
				ss: [e + " secondanim", e + " second"],
				m: ["eka mintan", "ek minute"],
				mm: [e + " mintanim", e + " mintam"],
				h: ["eka horan", "ek hor"],
				hh: [e + " horanim", e + " horam"],
				d: ["eka disan", "ek dis"],
				dd: [e + " disanim", e + " dis"],
				M: ["eka mhoinean", "ek mhoino"],
				MM: [e + " mhoineanim", e + " mhoine"],
				y: ["eka vorsan", "ek voros"],
				yy: [e + " vorsanim", e + " vorsam"]
			};
			return t ? i[n][0] : i[n][1]
		}

		e.defineLocale("gom-latn", {
			months: "Janer_Febrer_Mars_Abril_Mai_Jun_Julai_Agost_Setembr_Otubr_Novembr_Dezembr".split("_"),
			monthsShort: "Jan._Feb._Mars_Abr._Mai_Jun_Jul._Ago._Set._Otu._Nov._Dez.".split("_"),
			monthsParseExact: !0,
			weekdays: "Aitar_Somar_Mongllar_Budvar_Brestar_Sukrar_Son'var".split("_"),
			weekdaysShort: "Ait._Som._Mon._Bud._Bre._Suk._Son.".split("_"),
			weekdaysMin: "Ai_Sm_Mo_Bu_Br_Su_Sn".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "A h:mm [vazta]",
				LTS: "A h:mm:ss [vazta]",
				L: "DD-MM-YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY A h:mm [vazta]",
				LLLL: "dddd, MMMM[achea] Do, YYYY, A h:mm [vazta]",
				llll: "ddd, D MMM YYYY, A h:mm [vazta]"
			},
			calendar: {
				sameDay: "[Aiz] LT",
				nextDay: "[Faleam] LT",
				nextWeek: "[Ieta to] dddd[,] LT",
				lastDay: "[Kal] LT",
				lastWeek: "[Fatlo] dddd[,] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s",
				past: "%s adim",
				s: t,
				ss: t,
				m: t,
				mm: t,
				h: t,
				hh: t,
				d: t,
				dd: t,
				M: t,
				MM: t,
				y: t,
				yy: t
			},
			dayOfMonthOrdinalParse: /\d{1,2}(er)/,
			ordinal: function (e, t) {
				switch (t) {
					case"D":
						return e + "er";
					default:
					case"M":
					case"Q":
					case"DDD":
					case"d":
					case"w":
					case"W":
						return e
				}
			},
			week: {dow: 1, doy: 4},
			meridiemParse: /rati|sokalli|donparam|sanje/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "rati" === t ? e < 4 ? e : e + 12 : "sokalli" === t ? e : "donparam" === t ? e > 12 ? e : e + 12 : "sanje" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "rati" : e < 12 ? "sokalli" : e < 16 ? "donparam" : e < 20 ? "sanje" : "rati"
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "૧", 2: "૨", 3: "૩", 4: "૪", 5: "૫", 6: "૬", 7: "૭", 8: "૮", 9: "૯", 0: "૦"},
			n = {"૧": "1", "૨": "2", "૩": "3", "૪": "4", "૫": "5", "૬": "6", "૭": "7", "૮": "8", "૯": "9", "૦": "0"};
		e.defineLocale("gu", {
			months: "જાન્યુઆરી_ફેબ્રુઆરી_માર્ચ_એપ્રિલ_મે_જૂન_જુલાઈ_ઑગસ્ટ_સપ્ટેમ્બર_ઑક્ટ્બર_નવેમ્બર_ડિસેમ્બર".split("_"),
			monthsShort: "જાન્યુ._ફેબ્રુ._માર્ચ_એપ્રિ._મે_જૂન_જુલા._ઑગ._સપ્ટે._ઑક્ટ્._નવે._ડિસે.".split("_"),
			monthsParseExact: !0,
			weekdays: "રવિવાર_સોમવાર_મંગળવાર_બુધ્વાર_ગુરુવાર_શુક્રવાર_શનિવાર".split("_"),
			weekdaysShort: "રવિ_સોમ_મંગળ_બુધ્_ગુરુ_શુક્ર_શનિ".split("_"),
			weekdaysMin: "ર_સો_મં_બુ_ગુ_શુ_શ".split("_"),
			longDateFormat: {
				LT: "A h:mm વાગ્યે",
				LTS: "A h:mm:ss વાગ્યે",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, A h:mm વાગ્યે",
				LLLL: "dddd, D MMMM YYYY, A h:mm વાગ્યે"
			},
			calendar: {
				sameDay: "[આજ] LT",
				nextDay: "[કાલે] LT",
				nextWeek: "dddd, LT",
				lastDay: "[ગઇકાલે] LT",
				lastWeek: "[પાછલા] dddd, LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s મા",
				past: "%s પેહલા",
				s: "અમુક પળો",
				ss: "%d સેકંડ",
				m: "એક મિનિટ",
				mm: "%d મિનિટ",
				h: "એક કલાક",
				hh: "%d કલાક",
				d: "એક દિવસ",
				dd: "%d દિવસ",
				M: "એક મહિનો",
				MM: "%d મહિનો",
				y: "એક વર્ષ",
				yy: "%d વર્ષ"
			},
			preparse: function (e) {
				return e.replace(/[૧૨૩૪૫૬૭૮૯૦]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			meridiemParse: /રાત|બપોર|સવાર|સાંજ/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "રાત" === t ? e < 4 ? e : e + 12 : "સવાર" === t ? e : "બપોર" === t ? e >= 10 ? e : e + 12 : "સાંજ" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "રાત" : e < 10 ? "સવાર" : e < 17 ? "બપોર" : e < 20 ? "સાંજ" : "રાત"
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("he", {
			months: "ינואר_פברואר_מרץ_אפריל_מאי_יוני_יולי_אוגוסט_ספטמבר_אוקטובר_נובמבר_דצמבר".split("_"),
			monthsShort: "ינו׳_פבר׳_מרץ_אפר׳_מאי_יוני_יולי_אוג׳_ספט׳_אוק׳_נוב׳_דצמ׳".split("_"),
			weekdays: "ראשון_שני_שלישי_רביעי_חמישי_שישי_שבת".split("_"),
			weekdaysShort: "א׳_ב׳_ג׳_ד׳_ה׳_ו׳_ש׳".split("_"),
			weekdaysMin: "א_ב_ג_ד_ה_ו_ש".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D [ב]MMMM YYYY",
				LLL: "D [ב]MMMM YYYY HH:mm",
				LLLL: "dddd, D [ב]MMMM YYYY HH:mm",
				l: "D/M/YYYY",
				ll: "D MMM YYYY",
				lll: "D MMM YYYY HH:mm",
				llll: "ddd, D MMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[היום ב־]LT",
				nextDay: "[מחר ב־]LT",
				nextWeek: "dddd [בשעה] LT",
				lastDay: "[אתמול ב־]LT",
				lastWeek: "[ביום] dddd [האחרון בשעה] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "בעוד %s",
				past: "לפני %s",
				s: "מספר שניות",
				ss: "%d שניות",
				m: "דקה",
				mm: "%d דקות",
				h: "שעה",
				hh: function (e) {
					return 2 === e ? "שעתיים" : e + " שעות"
				},
				d: "יום",
				dd: function (e) {
					return 2 === e ? "יומיים" : e + " ימים"
				},
				M: "חודש",
				MM: function (e) {
					return 2 === e ? "חודשיים" : e + " חודשים"
				},
				y: "שנה",
				yy: function (e) {
					return 2 === e ? "שנתיים" : e % 10 == 0 && 10 !== e ? e + " שנה" : e + " שנים"
				}
			},
			meridiemParse: /אחה"צ|לפנה"צ|אחרי הצהריים|לפני הצהריים|לפנות בוקר|בבוקר|בערב/i,
			isPM: function (e) {
				return /^(אחה"צ|אחרי הצהריים|בערב)$/.test(e)
			},
			meridiem: function (e, t, n) {
				return e < 5 ? "לפנות בוקר" : e < 10 ? "בבוקר" : e < 12 ? n ? 'לפנה"צ' : "לפני הצהריים" : e < 18 ? n ? 'אחה"צ' : "אחרי הצהריים" : "בערב"
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "१", 2: "२", 3: "३", 4: "४", 5: "५", 6: "६", 7: "७", 8: "८", 9: "९", 0: "०"},
			n = {"१": "1", "२": "2", "३": "3", "४": "4", "५": "5", "६": "6", "७": "7", "८": "8", "९": "9", "०": "0"};
		e.defineLocale("hi", {
			months: "जनवरी_फ़रवरी_मार्च_अप्रैल_मई_जून_जुलाई_अगस्त_सितम्बर_अक्टूबर_नवम्बर_दिसम्बर".split("_"),
			monthsShort: "जन._फ़र._मार्च_अप्रै._मई_जून_जुल._अग._सित._अक्टू._नव._दिस.".split("_"),
			monthsParseExact: !0,
			weekdays: "रविवार_सोमवार_मंगलवार_बुधवार_गुरूवार_शुक्रवार_शनिवार".split("_"),
			weekdaysShort: "रवि_सोम_मंगल_बुध_गुरू_शुक्र_शनि".split("_"),
			weekdaysMin: "र_सो_मं_बु_गु_शु_श".split("_"),
			longDateFormat: {
				LT: "A h:mm बजे",
				LTS: "A h:mm:ss बजे",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, A h:mm बजे",
				LLLL: "dddd, D MMMM YYYY, A h:mm बजे"
			},
			calendar: {
				sameDay: "[आज] LT",
				nextDay: "[कल] LT",
				nextWeek: "dddd, LT",
				lastDay: "[कल] LT",
				lastWeek: "[पिछले] dddd, LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s में",
				past: "%s पहले",
				s: "कुछ ही क्षण",
				ss: "%d सेकंड",
				m: "एक मिनट",
				mm: "%d मिनट",
				h: "एक घंटा",
				hh: "%d घंटे",
				d: "एक दिन",
				dd: "%d दिन",
				M: "एक महीने",
				MM: "%d महीने",
				y: "एक वर्ष",
				yy: "%d वर्ष"
			},
			preparse: function (e) {
				return e.replace(/[१२३४५६७८९०]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			meridiemParse: /रात|सुबह|दोपहर|शाम/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "रात" === t ? e < 4 ? e : e + 12 : "सुबह" === t ? e : "दोपहर" === t ? e >= 10 ? e : e + 12 : "शाम" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "रात" : e < 10 ? "सुबह" : e < 17 ? "दोपहर" : e < 20 ? "शाम" : "रात"
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n) {
			var r = e + " ";
			switch (n) {
				case"ss":
					return r += 1 === e ? "sekunda" : 2 === e || 3 === e || 4 === e ? "sekunde" : "sekundi";
				case"m":
					return t ? "jedna minuta" : "jedne minute";
				case"mm":
					return r += 1 === e ? "minuta" : 2 === e || 3 === e || 4 === e ? "minute" : "minuta";
				case"h":
					return t ? "jedan sat" : "jednog sata";
				case"hh":
					return r += 1 === e ? "sat" : 2 === e || 3 === e || 4 === e ? "sata" : "sati";
				case"dd":
					return r += 1 === e ? "dan" : "dana";
				case"MM":
					return r += 1 === e ? "mjesec" : 2 === e || 3 === e || 4 === e ? "mjeseca" : "mjeseci";
				case"yy":
					return r += 1 === e ? "godina" : 2 === e || 3 === e || 4 === e ? "godine" : "godina"
			}
		}

		e.defineLocale("hr", {
			months: {
				format: "siječnja_veljače_ožujka_travnja_svibnja_lipnja_srpnja_kolovoza_rujna_listopada_studenoga_prosinca".split("_"),
				standalone: "siječanj_veljača_ožujak_travanj_svibanj_lipanj_srpanj_kolovoz_rujan_listopad_studeni_prosinac".split("_")
			},
			monthsShort: "sij._velj._ožu._tra._svi._lip._srp._kol._ruj._lis._stu._pro.".split("_"),
			monthsParseExact: !0,
			weekdays: "nedjelja_ponedjeljak_utorak_srijeda_četvrtak_petak_subota".split("_"),
			weekdaysShort: "ned._pon._uto._sri._čet._pet._sub.".split("_"),
			weekdaysMin: "ne_po_ut_sr_če_pe_su".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm",
				LLLL: "dddd, D. MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[danas u] LT", nextDay: "[sutra u] LT", nextWeek: function () {
					switch (this.day()) {
						case 0:
							return "[u] [nedjelju] [u] LT";
						case 3:
							return "[u] [srijedu] [u] LT";
						case 6:
							return "[u] [subotu] [u] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[u] dddd [u] LT"
					}
				}, lastDay: "[jučer u] LT", lastWeek: function () {
					switch (this.day()) {
						case 0:
						case 3:
							return "[prošlu] dddd [u] LT";
						case 6:
							return "[prošle] [subote] [u] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[prošli] dddd [u] LT"
					}
				}, sameElse: "L"
			},
			relativeTime: {
				future: "za %s",
				past: "prije %s",
				s: "par sekundi",
				ss: t,
				m: t,
				mm: t,
				h: t,
				hh: t,
				d: "dan",
				dd: t,
				M: "mjesec",
				MM: t,
				y: "godinu",
				yy: t
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "vasárnap hétfőn kedden szerdán csütörtökön pénteken szombaton".split(" ");

		function n(e, t, n, r) {
			var i = e;
			switch (n) {
				case"s":
					return r || t ? "néhány másodperc" : "néhány másodperce";
				case"ss":
					return i + (r || t) ? " másodperc" : " másodperce";
				case"m":
					return "egy" + (r || t ? " perc" : " perce");
				case"mm":
					return i + (r || t ? " perc" : " perce");
				case"h":
					return "egy" + (r || t ? " óra" : " órája");
				case"hh":
					return i + (r || t ? " óra" : " órája");
				case"d":
					return "egy" + (r || t ? " nap" : " napja");
				case"dd":
					return i + (r || t ? " nap" : " napja");
				case"M":
					return "egy" + (r || t ? " hónap" : " hónapja");
				case"MM":
					return i + (r || t ? " hónap" : " hónapja");
				case"y":
					return "egy" + (r || t ? " év" : " éve");
				case"yy":
					return i + (r || t ? " év" : " éve")
			}
			return ""
		}

		function r(e) {
			return (e ? "" : "[múlt] ") + "[" + t[this.day()] + "] LT[-kor]"
		}

		e.defineLocale("hu", {
			months: "január_február_március_április_május_június_július_augusztus_szeptember_október_november_december".split("_"),
			monthsShort: "jan_feb_márc_ápr_máj_jún_júl_aug_szept_okt_nov_dec".split("_"),
			weekdays: "vasárnap_hétfő_kedd_szerda_csütörtök_péntek_szombat".split("_"),
			weekdaysShort: "vas_hét_kedd_sze_csüt_pén_szo".split("_"),
			weekdaysMin: "v_h_k_sze_cs_p_szo".split("_"),
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "YYYY.MM.DD.",
				LL: "YYYY. MMMM D.",
				LLL: "YYYY. MMMM D. H:mm",
				LLLL: "YYYY. MMMM D., dddd H:mm"
			},
			meridiemParse: /de|du/i,
			isPM: function (e) {
				return "u" === e.charAt(1).toLowerCase()
			},
			meridiem: function (e, t, n) {
				return e < 12 ? !0 === n ? "de" : "DE" : !0 === n ? "du" : "DU"
			},
			calendar: {
				sameDay: "[ma] LT[-kor]", nextDay: "[holnap] LT[-kor]", nextWeek: function () {
					return r.call(this, !0)
				}, lastDay: "[tegnap] LT[-kor]", lastWeek: function () {
					return r.call(this, !1)
				}, sameElse: "L"
			},
			relativeTime: {
				future: "%s múlva",
				past: "%s",
				s: n,
				ss: n,
				m: n,
				mm: n,
				h: n,
				hh: n,
				d: n,
				dd: n,
				M: n,
				MM: n,
				y: n,
				yy: n
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("hy-am", {
			months: {
				format: "հունվարի_փետրվարի_մարտի_ապրիլի_մայիսի_հունիսի_հուլիսի_օգոստոսի_սեպտեմբերի_հոկտեմբերի_նոյեմբերի_դեկտեմբերի".split("_"),
				standalone: "հունվար_փետրվար_մարտ_ապրիլ_մայիս_հունիս_հուլիս_օգոստոս_սեպտեմբեր_հոկտեմբեր_նոյեմբեր_դեկտեմբեր".split("_")
			},
			monthsShort: "հնվ_փտր_մրտ_ապր_մյս_հնս_հլս_օգս_սպտ_հկտ_նմբ_դկտ".split("_"),
			weekdays: "կիրակի_երկուշաբթի_երեքշաբթի_չորեքշաբթի_հինգշաբթի_ուրբաթ_շաբաթ".split("_"),
			weekdaysShort: "կրկ_երկ_երք_չրք_հնգ_ուրբ_շբթ".split("_"),
			weekdaysMin: "կրկ_երկ_երք_չրք_հնգ_ուրբ_շբթ".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY թ.",
				LLL: "D MMMM YYYY թ., HH:mm",
				LLLL: "dddd, D MMMM YYYY թ., HH:mm"
			},
			calendar: {
				sameDay: "[այսօր] LT", nextDay: "[վաղը] LT", lastDay: "[երեկ] LT", nextWeek: function () {
					return "dddd [օրը ժամը] LT"
				}, lastWeek: function () {
					return "[անցած] dddd [օրը ժամը] LT"
				}, sameElse: "L"
			},
			relativeTime: {
				future: "%s հետո",
				past: "%s առաջ",
				s: "մի քանի վայրկյան",
				ss: "%d վայրկյան",
				m: "րոպե",
				mm: "%d րոպե",
				h: "ժամ",
				hh: "%d ժամ",
				d: "օր",
				dd: "%d օր",
				M: "ամիս",
				MM: "%d ամիս",
				y: "տարի",
				yy: "%d տարի"
			},
			meridiemParse: /գիշերվա|առավոտվա|ցերեկվա|երեկոյան/,
			isPM: function (e) {
				return /^(ցերեկվա|երեկոյան)$/.test(e)
			},
			meridiem: function (e) {
				return e < 4 ? "գիշերվա" : e < 12 ? "առավոտվա" : e < 17 ? "ցերեկվա" : "երեկոյան"
			},
			dayOfMonthOrdinalParse: /\d{1,2}|\d{1,2}-(ին|րդ)/,
			ordinal: function (e, t) {
				switch (t) {
					case"DDD":
					case"w":
					case"W":
					case"DDDo":
						return 1 === e ? e + "-ին" : e + "-րդ";
					default:
						return e
				}
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("id", {
			months: "Januari_Februari_Maret_April_Mei_Juni_Juli_Agustus_September_Oktober_November_Desember".split("_"),
			monthsShort: "Jan_Feb_Mar_Apr_Mei_Jun_Jul_Agt_Sep_Okt_Nov_Des".split("_"),
			weekdays: "Minggu_Senin_Selasa_Rabu_Kamis_Jumat_Sabtu".split("_"),
			weekdaysShort: "Min_Sen_Sel_Rab_Kam_Jum_Sab".split("_"),
			weekdaysMin: "Mg_Sn_Sl_Rb_Km_Jm_Sb".split("_"),
			longDateFormat: {
				LT: "HH.mm",
				LTS: "HH.mm.ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY [pukul] HH.mm",
				LLLL: "dddd, D MMMM YYYY [pukul] HH.mm"
			},
			meridiemParse: /pagi|siang|sore|malam/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "pagi" === t ? e : "siang" === t ? e >= 11 ? e : e + 12 : "sore" === t || "malam" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 11 ? "pagi" : e < 15 ? "siang" : e < 19 ? "sore" : "malam"
			},
			calendar: {
				sameDay: "[Hari ini pukul] LT",
				nextDay: "[Besok pukul] LT",
				nextWeek: "dddd [pukul] LT",
				lastDay: "[Kemarin pukul] LT",
				lastWeek: "dddd [lalu pukul] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "dalam %s",
				past: "%s yang lalu",
				s: "beberapa detik",
				ss: "%d detik",
				m: "semenit",
				mm: "%d menit",
				h: "sejam",
				hh: "%d jam",
				d: "sehari",
				dd: "%d hari",
				M: "sebulan",
				MM: "%d bulan",
				y: "setahun",
				yy: "%d tahun"
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e) {
			return e % 100 == 11 || e % 10 != 1
		}

		function n(e, n, r, i) {
			var a = e + " ";
			switch (r) {
				case"s":
					return n || i ? "nokkrar sekúndur" : "nokkrum sekúndum";
				case"ss":
					return t(e) ? a + (n || i ? "sekúndur" : "sekúndum") : a + "sekúnda";
				case"m":
					return n ? "mínúta" : "mínútu";
				case"mm":
					return t(e) ? a + (n || i ? "mínútur" : "mínútum") : n ? a + "mínúta" : a + "mínútu";
				case"hh":
					return t(e) ? a + (n || i ? "klukkustundir" : "klukkustundum") : a + "klukkustund";
				case"d":
					return n ? "dagur" : i ? "dag" : "degi";
				case"dd":
					return t(e) ? n ? a + "dagar" : a + (i ? "daga" : "dögum") : n ? a + "dagur" : a + (i ? "dag" : "degi");
				case"M":
					return n ? "mánuður" : i ? "mánuð" : "mánuði";
				case"MM":
					return t(e) ? n ? a + "mánuðir" : a + (i ? "mánuði" : "mánuðum") : n ? a + "mánuður" : a + (i ? "mánuð" : "mánuði");
				case"y":
					return n || i ? "ár" : "ári";
				case"yy":
					return t(e) ? a + (n || i ? "ár" : "árum") : a + (n || i ? "ár" : "ári")
			}
		}

		e.defineLocale("is", {
			months: "janúar_febrúar_mars_apríl_maí_júní_júlí_ágúst_september_október_nóvember_desember".split("_"),
			monthsShort: "jan_feb_mar_apr_maí_jún_júl_ágú_sep_okt_nóv_des".split("_"),
			weekdays: "sunnudagur_mánudagur_þriðjudagur_miðvikudagur_fimmtudagur_föstudagur_laugardagur".split("_"),
			weekdaysShort: "sun_mán_þri_mið_fim_fös_lau".split("_"),
			weekdaysMin: "Su_Má_Þr_Mi_Fi_Fö_La".split("_"),
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY [kl.] H:mm",
				LLLL: "dddd, D. MMMM YYYY [kl.] H:mm"
			},
			calendar: {
				sameDay: "[í dag kl.] LT",
				nextDay: "[á morgun kl.] LT",
				nextWeek: "dddd [kl.] LT",
				lastDay: "[í gær kl.] LT",
				lastWeek: "[síðasta] dddd [kl.] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "eftir %s",
				past: "fyrir %s síðan",
				s: n,
				ss: n,
				m: n,
				mm: n,
				h: "klukkustund",
				hh: n,
				d: n,
				dd: n,
				M: n,
				MM: n,
				y: n,
				yy: n
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("it", {
			months: "gennaio_febbraio_marzo_aprile_maggio_giugno_luglio_agosto_settembre_ottobre_novembre_dicembre".split("_"),
			monthsShort: "gen_feb_mar_apr_mag_giu_lug_ago_set_ott_nov_dic".split("_"),
			weekdays: "domenica_lunedì_martedì_mercoledì_giovedì_venerdì_sabato".split("_"),
			weekdaysShort: "dom_lun_mar_mer_gio_ven_sab".split("_"),
			weekdaysMin: "do_lu_ma_me_gi_ve_sa".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Oggi alle] LT",
				nextDay: "[Domani alle] LT",
				nextWeek: "dddd [alle] LT",
				lastDay: "[Ieri alle] LT",
				lastWeek: function () {
					switch (this.day()) {
						case 0:
							return "[la scorsa] dddd [alle] LT";
						default:
							return "[lo scorso] dddd [alle] LT"
					}
				},
				sameElse: "L"
			},
			relativeTime: {
				future: function (e) {
					return (/^[0-9].+$/.test(e) ? "tra" : "in") + " " + e
				},
				past: "%s fa",
				s: "alcuni secondi",
				ss: "%d secondi",
				m: "un minuto",
				mm: "%d minuti",
				h: "un'ora",
				hh: "%d ore",
				d: "un giorno",
				dd: "%d giorni",
				M: "un mese",
				MM: "%d mesi",
				y: "un anno",
				yy: "%d anni"
			},
			dayOfMonthOrdinalParse: /\d{1,2}º/,
			ordinal: "%dº",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ja", {
			months: "1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"),
			monthsShort: "1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"),
			weekdays: "日曜日_月曜日_火曜日_水曜日_木曜日_金曜日_土曜日".split("_"),
			weekdaysShort: "日_月_火_水_木_金_土".split("_"),
			weekdaysMin: "日_月_火_水_木_金_土".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY/MM/DD",
				LL: "YYYY年M月D日",
				LLL: "YYYY年M月D日 HH:mm",
				LLLL: "YYYY年M月D日 dddd HH:mm",
				l: "YYYY/MM/DD",
				ll: "YYYY年M月D日",
				lll: "YYYY年M月D日 HH:mm",
				llll: "YYYY年M月D日(ddd) HH:mm"
			},
			meridiemParse: /午前|午後/i,
			isPM: function (e) {
				return "午後" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "午前" : "午後"
			},
			calendar: {
				sameDay: "[今日] LT", nextDay: "[明日] LT", nextWeek: function (e) {
					return e.week() < this.week() ? "[来週]dddd LT" : "dddd LT"
				}, lastDay: "[昨日] LT", lastWeek: function (e) {
					return this.week() < e.week() ? "[先週]dddd LT" : "dddd LT"
				}, sameElse: "L"
			},
			dayOfMonthOrdinalParse: /\d{1,2}日/,
			ordinal: function (e, t) {
				switch (t) {
					case"d":
					case"D":
					case"DDD":
						return e + "日";
					default:
						return e
				}
			},
			relativeTime: {
				future: "%s後",
				past: "%s前",
				s: "数秒",
				ss: "%d秒",
				m: "1分",
				mm: "%d分",
				h: "1時間",
				hh: "%d時間",
				d: "1日",
				dd: "%d日",
				M: "1ヶ月",
				MM: "%dヶ月",
				y: "1年",
				yy: "%d年"
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("jv", {
			months: "Januari_Februari_Maret_April_Mei_Juni_Juli_Agustus_September_Oktober_Nopember_Desember".split("_"),
			monthsShort: "Jan_Feb_Mar_Apr_Mei_Jun_Jul_Ags_Sep_Okt_Nop_Des".split("_"),
			weekdays: "Minggu_Senen_Seloso_Rebu_Kemis_Jemuwah_Septu".split("_"),
			weekdaysShort: "Min_Sen_Sel_Reb_Kem_Jem_Sep".split("_"),
			weekdaysMin: "Mg_Sn_Sl_Rb_Km_Jm_Sp".split("_"),
			longDateFormat: {
				LT: "HH.mm",
				LTS: "HH.mm.ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY [pukul] HH.mm",
				LLLL: "dddd, D MMMM YYYY [pukul] HH.mm"
			},
			meridiemParse: /enjing|siyang|sonten|ndalu/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "enjing" === t ? e : "siyang" === t ? e >= 11 ? e : e + 12 : "sonten" === t || "ndalu" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 11 ? "enjing" : e < 15 ? "siyang" : e < 19 ? "sonten" : "ndalu"
			},
			calendar: {
				sameDay: "[Dinten puniko pukul] LT",
				nextDay: "[Mbenjang pukul] LT",
				nextWeek: "dddd [pukul] LT",
				lastDay: "[Kala wingi pukul] LT",
				lastWeek: "dddd [kepengker pukul] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "wonten ing %s",
				past: "%s ingkang kepengker",
				s: "sawetawis detik",
				ss: "%d detik",
				m: "setunggal menit",
				mm: "%d menit",
				h: "setunggal jam",
				hh: "%d jam",
				d: "sedinten",
				dd: "%d dinten",
				M: "sewulan",
				MM: "%d wulan",
				y: "setaun",
				yy: "%d taun"
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ka", {
			months: {
				standalone: "იანვარი_თებერვალი_მარტი_აპრილი_მაისი_ივნისი_ივლისი_აგვისტო_სექტემბერი_ოქტომბერი_ნოემბერი_დეკემბერი".split("_"),
				format: "იანვარს_თებერვალს_მარტს_აპრილის_მაისს_ივნისს_ივლისს_აგვისტს_სექტემბერს_ოქტომბერს_ნოემბერს_დეკემბერს".split("_")
			},
			monthsShort: "იან_თებ_მარ_აპრ_მაი_ივნ_ივლ_აგვ_სექ_ოქტ_ნოე_დეკ".split("_"),
			weekdays: {
				standalone: "კვირა_ორშაბათი_სამშაბათი_ოთხშაბათი_ხუთშაბათი_პარასკევი_შაბათი".split("_"),
				format: "კვირას_ორშაბათს_სამშაბათს_ოთხშაბათს_ხუთშაბათს_პარასკევს_შაბათს".split("_"),
				isFormat: /(წინა|შემდეგ)/
			},
			weekdaysShort: "კვი_ორშ_სამ_ოთხ_ხუთ_პარ_შაბ".split("_"),
			weekdaysMin: "კვ_ორ_სა_ოთ_ხუ_პა_შა".split("_"),
			longDateFormat: {
				LT: "h:mm A",
				LTS: "h:mm:ss A",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY h:mm A",
				LLLL: "dddd, D MMMM YYYY h:mm A"
			},
			calendar: {
				sameDay: "[დღეს] LT[-ზე]",
				nextDay: "[ხვალ] LT[-ზე]",
				lastDay: "[გუშინ] LT[-ზე]",
				nextWeek: "[შემდეგ] dddd LT[-ზე]",
				lastWeek: "[წინა] dddd LT-ზე",
				sameElse: "L"
			},
			relativeTime: {
				future: function (e) {
					return /(წამი|წუთი|საათი|წელი)/.test(e) ? e.replace(/ი$/, "ში") : e + "ში"
				},
				past: function (e) {
					return /(წამი|წუთი|საათი|დღე|თვე)/.test(e) ? e.replace(/(ი|ე)$/, "ის წინ") : /წელი/.test(e) ? e.replace(/წელი$/, "წლის წინ") : void 0
				},
				s: "რამდენიმე წამი",
				ss: "%d წამი",
				m: "წუთი",
				mm: "%d წუთი",
				h: "საათი",
				hh: "%d საათი",
				d: "დღე",
				dd: "%d დღე",
				M: "თვე",
				MM: "%d თვე",
				y: "წელი",
				yy: "%d წელი"
			},
			dayOfMonthOrdinalParse: /0|1-ლი|მე-\d{1,2}|\d{1,2}-ე/,
			ordinal: function (e) {
				return 0 === e ? e : 1 === e ? e + "-ლი" : e < 20 || e <= 100 && e % 20 == 0 || e % 100 == 0 ? "მე-" + e : e + "-ე"
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {
			0: "-ші",
			1: "-ші",
			2: "-ші",
			3: "-ші",
			4: "-ші",
			5: "-ші",
			6: "-шы",
			7: "-ші",
			8: "-ші",
			9: "-шы",
			10: "-шы",
			20: "-шы",
			30: "-шы",
			40: "-шы",
			50: "-ші",
			60: "-шы",
			70: "-ші",
			80: "-ші",
			90: "-шы",
			100: "-ші"
		};
		e.defineLocale("kk", {
			months: "қаңтар_ақпан_наурыз_сәуір_мамыр_маусым_шілде_тамыз_қыркүйек_қазан_қараша_желтоқсан".split("_"),
			monthsShort: "қаң_ақп_нау_сәу_мам_мау_шіл_там_қыр_қаз_қар_жел".split("_"),
			weekdays: "жексенбі_дүйсенбі_сейсенбі_сәрсенбі_бейсенбі_жұма_сенбі".split("_"),
			weekdaysShort: "жек_дүй_сей_сәр_бей_жұм_сен".split("_"),
			weekdaysMin: "жк_дй_сй_ср_бй_жм_сн".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Бүгін сағат] LT",
				nextDay: "[Ертең сағат] LT",
				nextWeek: "dddd [сағат] LT",
				lastDay: "[Кеше сағат] LT",
				lastWeek: "[Өткен аптаның] dddd [сағат] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s ішінде",
				past: "%s бұрын",
				s: "бірнеше секунд",
				ss: "%d секунд",
				m: "бір минут",
				mm: "%d минут",
				h: "бір сағат",
				hh: "%d сағат",
				d: "бір күн",
				dd: "%d күн",
				M: "бір ай",
				MM: "%d ай",
				y: "бір жыл",
				yy: "%d жыл"
			},
			dayOfMonthOrdinalParse: /\d{1,2}-(ші|шы)/,
			ordinal: function (e) {
				return e + (t[e] || t[e % 10] || t[e >= 100 ? 100 : null])
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "១", 2: "២", 3: "៣", 4: "៤", 5: "៥", 6: "៦", 7: "៧", 8: "៨", 9: "៩", 0: "០"},
			n = {"១": "1", "២": "2", "៣": "3", "៤": "4", "៥": "5", "៦": "6", "៧": "7", "៨": "8", "៩": "9", "០": "0"};
		e.defineLocale("km", {
			months: "មករា_កុម្ភៈ_មីនា_មេសា_ឧសភា_មិថុនា_កក្កដា_សីហា_កញ្ញា_តុលា_វិច្ឆិកា_ធ្នូ".split("_"),
			monthsShort: "មករា_កុម្ភៈ_មីនា_មេសា_ឧសភា_មិថុនា_កក្កដា_សីហា_កញ្ញា_តុលា_វិច្ឆិកា_ធ្នូ".split("_"),
			weekdays: "អាទិត្យ_ច័ន្ទ_អង្គារ_ពុធ_ព្រហស្បតិ៍_សុក្រ_សៅរ៍".split("_"),
			weekdaysShort: "អា_ច_អ_ព_ព្រ_សុ_ស".split("_"),
			weekdaysMin: "អា_ច_អ_ព_ព្រ_សុ_ស".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			meridiemParse: /ព្រឹក|ល្ងាច/,
			isPM: function (e) {
				return "ល្ងាច" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "ព្រឹក" : "ល្ងាច"
			},
			calendar: {
				sameDay: "[ថ្ងៃនេះ ម៉ោង] LT",
				nextDay: "[ស្អែក ម៉ោង] LT",
				nextWeek: "dddd [ម៉ោង] LT",
				lastDay: "[ម្សិលមិញ ម៉ោង] LT",
				lastWeek: "dddd [សប្តាហ៍មុន] [ម៉ោង] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%sទៀត",
				past: "%sមុន",
				s: "ប៉ុន្មានវិនាទី",
				ss: "%d វិនាទី",
				m: "មួយនាទី",
				mm: "%d នាទី",
				h: "មួយម៉ោង",
				hh: "%d ម៉ោង",
				d: "មួយថ្ងៃ",
				dd: "%d ថ្ងៃ",
				M: "មួយខែ",
				MM: "%d ខែ",
				y: "មួយឆ្នាំ",
				yy: "%d ឆ្នាំ"
			},
			dayOfMonthOrdinalParse: /ទី\d{1,2}/,
			ordinal: "ទី%d",
			preparse: function (e) {
				return e.replace(/[១២៣៤៥៦៧៨៩០]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "೧", 2: "೨", 3: "೩", 4: "೪", 5: "೫", 6: "೬", 7: "೭", 8: "೮", 9: "೯", 0: "೦"},
			n = {"೧": "1", "೨": "2", "೩": "3", "೪": "4", "೫": "5", "೬": "6", "೭": "7", "೮": "8", "೯": "9", "೦": "0"};
		e.defineLocale("kn", {
			months: "ಜನವರಿ_ಫೆಬ್ರವರಿ_ಮಾರ್ಚ್_ಏಪ್ರಿಲ್_ಮೇ_ಜೂನ್_ಜುಲೈ_ಆಗಸ್ಟ್_ಸೆಪ್ಟೆಂಬರ್_ಅಕ್ಟೋಬರ್_ನವೆಂಬರ್_ಡಿಸೆಂಬರ್".split("_"),
			monthsShort: "ಜನ_ಫೆಬ್ರ_ಮಾರ್ಚ್_ಏಪ್ರಿಲ್_ಮೇ_ಜೂನ್_ಜುಲೈ_ಆಗಸ್ಟ್_ಸೆಪ್ಟೆಂ_ಅಕ್ಟೋ_ನವೆಂ_ಡಿಸೆಂ".split("_"),
			monthsParseExact: !0,
			weekdays: "ಭಾನುವಾರ_ಸೋಮವಾರ_ಮಂಗಳವಾರ_ಬುಧವಾರ_ಗುರುವಾರ_ಶುಕ್ರವಾರ_ಶನಿವಾರ".split("_"),
			weekdaysShort: "ಭಾನು_ಸೋಮ_ಮಂಗಳ_ಬುಧ_ಗುರು_ಶುಕ್ರ_ಶನಿ".split("_"),
			weekdaysMin: "ಭಾ_ಸೋ_ಮಂ_ಬು_ಗು_ಶು_ಶ".split("_"),
			longDateFormat: {
				LT: "A h:mm",
				LTS: "A h:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, A h:mm",
				LLLL: "dddd, D MMMM YYYY, A h:mm"
			},
			calendar: {
				sameDay: "[ಇಂದು] LT",
				nextDay: "[ನಾಳೆ] LT",
				nextWeek: "dddd, LT",
				lastDay: "[ನಿನ್ನೆ] LT",
				lastWeek: "[ಕೊನೆಯ] dddd, LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s ನಂತರ",
				past: "%s ಹಿಂದೆ",
				s: "ಕೆಲವು ಕ್ಷಣಗಳು",
				ss: "%d ಸೆಕೆಂಡುಗಳು",
				m: "ಒಂದು ನಿಮಿಷ",
				mm: "%d ನಿಮಿಷ",
				h: "ಒಂದು ಗಂಟೆ",
				hh: "%d ಗಂಟೆ",
				d: "ಒಂದು ದಿನ",
				dd: "%d ದಿನ",
				M: "ಒಂದು ತಿಂಗಳು",
				MM: "%d ತಿಂಗಳು",
				y: "ಒಂದು ವರ್ಷ",
				yy: "%d ವರ್ಷ"
			},
			preparse: function (e) {
				return e.replace(/[೧೨೩೪೫೬೭೮೯೦]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			meridiemParse: /ರಾತ್ರಿ|ಬೆಳಿಗ್ಗೆ|ಮಧ್ಯಾಹ್ನ|ಸಂಜೆ/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "ರಾತ್ರಿ" === t ? e < 4 ? e : e + 12 : "ಬೆಳಿಗ್ಗೆ" === t ? e : "ಮಧ್ಯಾಹ್ನ" === t ? e >= 10 ? e : e + 12 : "ಸಂಜೆ" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "ರಾತ್ರಿ" : e < 10 ? "ಬೆಳಿಗ್ಗೆ" : e < 17 ? "ಮಧ್ಯಾಹ್ನ" : e < 20 ? "ಸಂಜೆ" : "ರಾತ್ರಿ"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(ನೇ)/,
			ordinal: function (e) {
				return e + "ನೇ"
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ko", {
			months: "1월_2월_3월_4월_5월_6월_7월_8월_9월_10월_11월_12월".split("_"),
			monthsShort: "1월_2월_3월_4월_5월_6월_7월_8월_9월_10월_11월_12월".split("_"),
			weekdays: "일요일_월요일_화요일_수요일_목요일_금요일_토요일".split("_"),
			weekdaysShort: "일_월_화_수_목_금_토".split("_"),
			weekdaysMin: "일_월_화_수_목_금_토".split("_"),
			longDateFormat: {
				LT: "A h:mm",
				LTS: "A h:mm:ss",
				L: "YYYY.MM.DD.",
				LL: "YYYY년 MMMM D일",
				LLL: "YYYY년 MMMM D일 A h:mm",
				LLLL: "YYYY년 MMMM D일 dddd A h:mm",
				l: "YYYY.MM.DD.",
				ll: "YYYY년 MMMM D일",
				lll: "YYYY년 MMMM D일 A h:mm",
				llll: "YYYY년 MMMM D일 dddd A h:mm"
			},
			calendar: {
				sameDay: "오늘 LT",
				nextDay: "내일 LT",
				nextWeek: "dddd LT",
				lastDay: "어제 LT",
				lastWeek: "지난주 dddd LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s 후",
				past: "%s 전",
				s: "몇 초",
				ss: "%d초",
				m: "1분",
				mm: "%d분",
				h: "한 시간",
				hh: "%d시간",
				d: "하루",
				dd: "%d일",
				M: "한 달",
				MM: "%d달",
				y: "일 년",
				yy: "%d년"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(일|월|주)/,
			ordinal: function (e, t) {
				switch (t) {
					case"d":
					case"D":
					case"DDD":
						return e + "일";
					case"M":
						return e + "월";
					case"w":
					case"W":
						return e + "주";
					default:
						return e
				}
			},
			meridiemParse: /오전|오후/,
			isPM: function (e) {
				return "오후" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "오전" : "오후"
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {
			0: "-чү",
			1: "-чи",
			2: "-чи",
			3: "-чү",
			4: "-чү",
			5: "-чи",
			6: "-чы",
			7: "-чи",
			8: "-чи",
			9: "-чу",
			10: "-чу",
			20: "-чы",
			30: "-чу",
			40: "-чы",
			50: "-чү",
			60: "-чы",
			70: "-чи",
			80: "-чи",
			90: "-чу",
			100: "-чү"
		};
		e.defineLocale("ky", {
			months: "январь_февраль_март_апрель_май_июнь_июль_август_сентябрь_октябрь_ноябрь_декабрь".split("_"),
			monthsShort: "янв_фев_март_апр_май_июнь_июль_авг_сен_окт_ноя_дек".split("_"),
			weekdays: "Жекшемби_Дүйшөмбү_Шейшемби_Шаршемби_Бейшемби_Жума_Ишемби".split("_"),
			weekdaysShort: "Жек_Дүй_Шей_Шар_Бей_Жум_Ише".split("_"),
			weekdaysMin: "Жк_Дй_Шй_Шр_Бй_Жм_Иш".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Бүгүн саат] LT",
				nextDay: "[Эртең саат] LT",
				nextWeek: "dddd [саат] LT",
				lastDay: "[Кече саат] LT",
				lastWeek: "[Өткен аптанын] dddd [күнү] [саат] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s ичинде",
				past: "%s мурун",
				s: "бирнече секунд",
				ss: "%d секунд",
				m: "бир мүнөт",
				mm: "%d мүнөт",
				h: "бир саат",
				hh: "%d саат",
				d: "бир күн",
				dd: "%d күн",
				M: "бир ай",
				MM: "%d ай",
				y: "бир жыл",
				yy: "%d жыл"
			},
			dayOfMonthOrdinalParse: /\d{1,2}-(чи|чы|чү|чу)/,
			ordinal: function (e) {
				return e + (t[e] || t[e % 10] || t[e >= 100 ? 100 : null])
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n, r) {
			var i = {
				m: ["eng Minutt", "enger Minutt"],
				h: ["eng Stonn", "enger Stonn"],
				d: ["een Dag", "engem Dag"],
				M: ["ee Mount", "engem Mount"],
				y: ["ee Joer", "engem Joer"]
			};
			return t ? i[n][0] : i[n][1]
		}

		function n(e) {
			if (e = parseInt(e, 10), isNaN(e)) return !1;
			if (e < 0) return !0;
			if (e < 10) return 4 <= e && e <= 7;
			if (e < 100) {
				var t = e % 10;
				return n(0 === t ? e / 10 : t)
			}
			if (e < 1e4) {
				for (; e >= 10;) e /= 10;
				return n(e)
			}
			return n(e /= 1e3)
		}

		e.defineLocale("lb", {
			months: "Januar_Februar_Mäerz_Abrëll_Mee_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
			monthsShort: "Jan._Febr._Mrz._Abr._Mee_Jun._Jul._Aug._Sept._Okt._Nov._Dez.".split("_"),
			monthsParseExact: !0,
			weekdays: "Sonndeg_Méindeg_Dënschdeg_Mëttwoch_Donneschdeg_Freideg_Samschdeg".split("_"),
			weekdaysShort: "So._Mé._Dë._Më._Do._Fr._Sa.".split("_"),
			weekdaysMin: "So_Mé_Dë_Më_Do_Fr_Sa".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm [Auer]",
				LTS: "H:mm:ss [Auer]",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm [Auer]",
				LLLL: "dddd, D. MMMM YYYY H:mm [Auer]"
			},
			calendar: {
				sameDay: "[Haut um] LT",
				sameElse: "L",
				nextDay: "[Muer um] LT",
				nextWeek: "dddd [um] LT",
				lastDay: "[Gëschter um] LT",
				lastWeek: function () {
					switch (this.day()) {
						case 2:
						case 4:
							return "[Leschten] dddd [um] LT";
						default:
							return "[Leschte] dddd [um] LT"
					}
				}
			},
			relativeTime: {
				future: function (e) {
					return n(e.substr(0, e.indexOf(" "))) ? "a " + e : "an " + e
				},
				past: function (e) {
					return n(e.substr(0, e.indexOf(" "))) ? "viru " + e : "virun " + e
				},
				s: "e puer Sekonnen",
				ss: "%d Sekonnen",
				m: t,
				mm: "%d Minutten",
				h: t,
				hh: "%d Stonnen",
				d: t,
				dd: "%d Deeg",
				M: t,
				MM: "%d Méint",
				y: t,
				yy: "%d Joer"
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("lo", {
			months: "ມັງກອນ_ກຸມພາ_ມີນາ_ເມສາ_ພຶດສະພາ_ມິຖຸນາ_ກໍລະກົດ_ສິງຫາ_ກັນຍາ_ຕຸລາ_ພະຈິກ_ທັນວາ".split("_"),
			monthsShort: "ມັງກອນ_ກຸມພາ_ມີນາ_ເມສາ_ພຶດສະພາ_ມິຖຸນາ_ກໍລະກົດ_ສິງຫາ_ກັນຍາ_ຕຸລາ_ພະຈິກ_ທັນວາ".split("_"),
			weekdays: "ອາທິດ_ຈັນ_ອັງຄານ_ພຸດ_ພະຫັດ_ສຸກ_ເສົາ".split("_"),
			weekdaysShort: "ທິດ_ຈັນ_ອັງຄານ_ພຸດ_ພະຫັດ_ສຸກ_ເສົາ".split("_"),
			weekdaysMin: "ທ_ຈ_ອຄ_ພ_ພຫ_ສກ_ສ".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "ວັນdddd D MMMM YYYY HH:mm"
			},
			meridiemParse: /ຕອນເຊົ້າ|ຕອນແລງ/,
			isPM: function (e) {
				return "ຕອນແລງ" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "ຕອນເຊົ້າ" : "ຕອນແລງ"
			},
			calendar: {
				sameDay: "[ມື້ນີ້ເວລາ] LT",
				nextDay: "[ມື້ອື່ນເວລາ] LT",
				nextWeek: "[ວັນ]dddd[ໜ້າເວລາ] LT",
				lastDay: "[ມື້ວານນີ້ເວລາ] LT",
				lastWeek: "[ວັນ]dddd[ແລ້ວນີ້ເວລາ] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "ອີກ %s",
				past: "%sຜ່ານມາ",
				s: "ບໍ່ເທົ່າໃດວິນາທີ",
				ss: "%d ວິນາທີ",
				m: "1 ນາທີ",
				mm: "%d ນາທີ",
				h: "1 ຊົ່ວໂມງ",
				hh: "%d ຊົ່ວໂມງ",
				d: "1 ມື້",
				dd: "%d ມື້",
				M: "1 ເດືອນ",
				MM: "%d ເດືອນ",
				y: "1 ປີ",
				yy: "%d ປີ"
			},
			dayOfMonthOrdinalParse: /(ທີ່)\d{1,2}/,
			ordinal: function (e) {
				return "ທີ່" + e
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {
			ss: "sekundė_sekundžių_sekundes",
			m: "minutė_minutės_minutę",
			mm: "minutės_minučių_minutes",
			h: "valanda_valandos_valandą",
			hh: "valandos_valandų_valandas",
			d: "diena_dienos_dieną",
			dd: "dienos_dienų_dienas",
			M: "mėnuo_mėnesio_mėnesį",
			MM: "mėnesiai_mėnesių_mėnesius",
			y: "metai_metų_metus",
			yy: "metai_metų_metus"
		};

		function n(e, t, n, r) {
			return t ? i(n)[0] : r ? i(n)[1] : i(n)[2]
		}

		function r(e) {
			return e % 10 == 0 || e > 10 && e < 20
		}

		function i(e) {
			return t[e].split("_")
		}

		function a(e, t, a, s) {
			var o = e + " ";
			return 1 === e ? o + n(0, t, a[0], s) : t ? o + (r(e) ? i(a)[1] : i(a)[0]) : s ? o + i(a)[1] : o + (r(e) ? i(a)[1] : i(a)[2])
		}

		e.defineLocale("lt", {
			months: {
				format: "sausio_vasario_kovo_balandžio_gegužės_birželio_liepos_rugpjūčio_rugsėjo_spalio_lapkričio_gruodžio".split("_"),
				standalone: "sausis_vasaris_kovas_balandis_gegužė_birželis_liepa_rugpjūtis_rugsėjis_spalis_lapkritis_gruodis".split("_"),
				isFormat: /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?|MMMM?(\[[^\[\]]*\]|\s)+D[oD]?/
			},
			monthsShort: "sau_vas_kov_bal_geg_bir_lie_rgp_rgs_spa_lap_grd".split("_"),
			weekdays: {
				format: "sekmadienį_pirmadienį_antradienį_trečiadienį_ketvirtadienį_penktadienį_šeštadienį".split("_"),
				standalone: "sekmadienis_pirmadienis_antradienis_trečiadienis_ketvirtadienis_penktadienis_šeštadienis".split("_"),
				isFormat: /dddd HH:mm/
			},
			weekdaysShort: "Sek_Pir_Ant_Tre_Ket_Pen_Šeš".split("_"),
			weekdaysMin: "S_P_A_T_K_Pn_Š".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY-MM-DD",
				LL: "YYYY [m.] MMMM D [d.]",
				LLL: "YYYY [m.] MMMM D [d.], HH:mm [val.]",
				LLLL: "YYYY [m.] MMMM D [d.], dddd, HH:mm [val.]",
				l: "YYYY-MM-DD",
				ll: "YYYY [m.] MMMM D [d.]",
				lll: "YYYY [m.] MMMM D [d.], HH:mm [val.]",
				llll: "YYYY [m.] MMMM D [d.], ddd, HH:mm [val.]"
			},
			calendar: {
				sameDay: "[Šiandien] LT",
				nextDay: "[Rytoj] LT",
				nextWeek: "dddd LT",
				lastDay: "[Vakar] LT",
				lastWeek: "[Praėjusį] dddd LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "po %s", past: "prieš %s", s: function (e, t, n, r) {
					return t ? "kelios sekundės" : r ? "kelių sekundžių" : "kelias sekundes"
				}, ss: a, m: n, mm: a, h: n, hh: a, d: n, dd: a, M: n, MM: a, y: n, yy: a
			},
			dayOfMonthOrdinalParse: /\d{1,2}-oji/,
			ordinal: function (e) {
				return e + "-oji"
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {
			ss: "sekundes_sekundēm_sekunde_sekundes".split("_"),
			m: "minūtes_minūtēm_minūte_minūtes".split("_"),
			mm: "minūtes_minūtēm_minūte_minūtes".split("_"),
			h: "stundas_stundām_stunda_stundas".split("_"),
			hh: "stundas_stundām_stunda_stundas".split("_"),
			d: "dienas_dienām_diena_dienas".split("_"),
			dd: "dienas_dienām_diena_dienas".split("_"),
			M: "mēneša_mēnešiem_mēnesis_mēneši".split("_"),
			MM: "mēneša_mēnešiem_mēnesis_mēneši".split("_"),
			y: "gada_gadiem_gads_gadi".split("_"),
			yy: "gada_gadiem_gads_gadi".split("_")
		};

		function n(e, t, n) {
			return n ? t % 10 == 1 && t % 100 != 11 ? e[2] : e[3] : t % 10 == 1 && t % 100 != 11 ? e[0] : e[1]
		}

		function r(e, r, i) {
			return e + " " + n(t[i], e, r)
		}

		function i(e, r, i) {
			return n(t[i], e, r)
		}

		e.defineLocale("lv", {
			months: "janvāris_februāris_marts_aprīlis_maijs_jūnijs_jūlijs_augusts_septembris_oktobris_novembris_decembris".split("_"),
			monthsShort: "jan_feb_mar_apr_mai_jūn_jūl_aug_sep_okt_nov_dec".split("_"),
			weekdays: "svētdiena_pirmdiena_otrdiena_trešdiena_ceturtdiena_piektdiena_sestdiena".split("_"),
			weekdaysShort: "Sv_P_O_T_C_Pk_S".split("_"),
			weekdaysMin: "Sv_P_O_T_C_Pk_S".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY.",
				LL: "YYYY. [gada] D. MMMM",
				LLL: "YYYY. [gada] D. MMMM, HH:mm",
				LLLL: "YYYY. [gada] D. MMMM, dddd, HH:mm"
			},
			calendar: {
				sameDay: "[Šodien pulksten] LT",
				nextDay: "[Rīt pulksten] LT",
				nextWeek: "dddd [pulksten] LT",
				lastDay: "[Vakar pulksten] LT",
				lastWeek: "[Pagājušā] dddd [pulksten] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "pēc %s", past: "pirms %s", s: function (e, t) {
					return t ? "dažas sekundes" : "dažām sekundēm"
				}, ss: r, m: i, mm: r, h: i, hh: r, d: i, dd: r, M: i, MM: r, y: i, yy: r
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {
			words: {
				ss: ["sekund", "sekunda", "sekundi"],
				m: ["jedan minut", "jednog minuta"],
				mm: ["minut", "minuta", "minuta"],
				h: ["jedan sat", "jednog sata"],
				hh: ["sat", "sata", "sati"],
				dd: ["dan", "dana", "dana"],
				MM: ["mjesec", "mjeseca", "mjeseci"],
				yy: ["godina", "godine", "godina"]
			}, correctGrammaticalCase: function (e, t) {
				return 1 === e ? t[0] : e >= 2 && e <= 4 ? t[1] : t[2]
			}, translate: function (e, n, r) {
				var i = t.words[r];
				return 1 === r.length ? n ? i[0] : i[1] : e + " " + t.correctGrammaticalCase(e, i)
			}
		};
		e.defineLocale("me", {
			months: "januar_februar_mart_april_maj_jun_jul_avgust_septembar_oktobar_novembar_decembar".split("_"),
			monthsShort: "jan._feb._mar._apr._maj_jun_jul_avg._sep._okt._nov._dec.".split("_"),
			monthsParseExact: !0,
			weekdays: "nedjelja_ponedjeljak_utorak_srijeda_četvrtak_petak_subota".split("_"),
			weekdaysShort: "ned._pon._uto._sri._čet._pet._sub.".split("_"),
			weekdaysMin: "ne_po_ut_sr_če_pe_su".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm",
				LLLL: "dddd, D. MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[danas u] LT", nextDay: "[sjutra u] LT", nextWeek: function () {
					switch (this.day()) {
						case 0:
							return "[u] [nedjelju] [u] LT";
						case 3:
							return "[u] [srijedu] [u] LT";
						case 6:
							return "[u] [subotu] [u] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[u] dddd [u] LT"
					}
				}, lastDay: "[juče u] LT", lastWeek: function () {
					return ["[prošle] [nedjelje] [u] LT", "[prošlog] [ponedjeljka] [u] LT", "[prošlog] [utorka] [u] LT", "[prošle] [srijede] [u] LT", "[prošlog] [četvrtka] [u] LT", "[prošlog] [petka] [u] LT", "[prošle] [subote] [u] LT"][this.day()]
				}, sameElse: "L"
			},
			relativeTime: {
				future: "za %s",
				past: "prije %s",
				s: "nekoliko sekundi",
				ss: t.translate,
				m: t.translate,
				mm: t.translate,
				h: t.translate,
				hh: t.translate,
				d: "dan",
				dd: t.translate,
				M: "mjesec",
				MM: t.translate,
				y: "godinu",
				yy: t.translate
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("mi", {
			months: "Kohi-tāte_Hui-tanguru_Poutū-te-rangi_Paenga-whāwhā_Haratua_Pipiri_Hōngoingoi_Here-turi-kōkā_Mahuru_Whiringa-ā-nuku_Whiringa-ā-rangi_Hakihea".split("_"),
			monthsShort: "Kohi_Hui_Pou_Pae_Hara_Pipi_Hōngoi_Here_Mahu_Whi-nu_Whi-ra_Haki".split("_"),
			monthsRegex: /(?:['a-z\u0101\u014D\u016B]+\-?){1,3}/i,
			monthsStrictRegex: /(?:['a-z\u0101\u014D\u016B]+\-?){1,3}/i,
			monthsShortRegex: /(?:['a-z\u0101\u014D\u016B]+\-?){1,3}/i,
			monthsShortStrictRegex: /(?:['a-z\u0101\u014D\u016B]+\-?){1,2}/i,
			weekdays: "Rātapu_Mane_Tūrei_Wenerei_Tāite_Paraire_Hātarei".split("_"),
			weekdaysShort: "Ta_Ma_Tū_We_Tāi_Pa_Hā".split("_"),
			weekdaysMin: "Ta_Ma_Tū_We_Tāi_Pa_Hā".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY [i] HH:mm",
				LLLL: "dddd, D MMMM YYYY [i] HH:mm"
			},
			calendar: {
				sameDay: "[i teie mahana, i] LT",
				nextDay: "[apopo i] LT",
				nextWeek: "dddd [i] LT",
				lastDay: "[inanahi i] LT",
				lastWeek: "dddd [whakamutunga i] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "i roto i %s",
				past: "%s i mua",
				s: "te hēkona ruarua",
				ss: "%d hēkona",
				m: "he meneti",
				mm: "%d meneti",
				h: "te haora",
				hh: "%d haora",
				d: "he ra",
				dd: "%d ra",
				M: "he marama",
				MM: "%d marama",
				y: "he tau",
				yy: "%d tau"
			},
			dayOfMonthOrdinalParse: /\d{1,2}º/,
			ordinal: "%dº",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("mk", {
			months: "јануари_февруари_март_април_мај_јуни_јули_август_септември_октомври_ноември_декември".split("_"),
			monthsShort: "јан_фев_мар_апр_мај_јун_јул_авг_сеп_окт_ное_дек".split("_"),
			weekdays: "недела_понеделник_вторник_среда_четврток_петок_сабота".split("_"),
			weekdaysShort: "нед_пон_вто_сре_чет_пет_саб".split("_"),
			weekdaysMin: "нe_пo_вт_ср_че_пе_сa".split("_"),
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "D.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY H:mm",
				LLLL: "dddd, D MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[Денес во] LT",
				nextDay: "[Утре во] LT",
				nextWeek: "[Во] dddd [во] LT",
				lastDay: "[Вчера во] LT",
				lastWeek: function () {
					switch (this.day()) {
						case 0:
						case 3:
						case 6:
							return "[Изминатата] dddd [во] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[Изминатиот] dddd [во] LT"
					}
				},
				sameElse: "L"
			},
			relativeTime: {
				future: "после %s",
				past: "пред %s",
				s: "неколку секунди",
				ss: "%d секунди",
				m: "минута",
				mm: "%d минути",
				h: "час",
				hh: "%d часа",
				d: "ден",
				dd: "%d дена",
				M: "месец",
				MM: "%d месеци",
				y: "година",
				yy: "%d години"
			},
			dayOfMonthOrdinalParse: /\d{1,2}-(ев|ен|ти|ви|ри|ми)/,
			ordinal: function (e) {
				var t = e % 10, n = e % 100;
				return 0 === e ? e + "-ев" : 0 === n ? e + "-ен" : n > 10 && n < 20 ? e + "-ти" : 1 === t ? e + "-ви" : 2 === t ? e + "-ри" : 7 === t || 8 === t ? e + "-ми" : e + "-ти"
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ml", {
			months: "ജനുവരി_ഫെബ്രുവരി_മാർച്ച്_ഏപ്രിൽ_മേയ്_ജൂൺ_ജൂലൈ_ഓഗസ്റ്റ്_സെപ്റ്റംബർ_ഒക്ടോബർ_നവംബർ_ഡിസംബർ".split("_"),
			monthsShort: "ജനു._ഫെബ്രു._മാർ._ഏപ്രി._മേയ്_ജൂൺ_ജൂലൈ._ഓഗ._സെപ്റ്റ._ഒക്ടോ._നവം._ഡിസം.".split("_"),
			monthsParseExact: !0,
			weekdays: "ഞായറാഴ്ച_തിങ്കളാഴ്ച_ചൊവ്വാഴ്ച_ബുധനാഴ്ച_വ്യാഴാഴ്ച_വെള്ളിയാഴ്ച_ശനിയാഴ്ച".split("_"),
			weekdaysShort: "ഞായർ_തിങ്കൾ_ചൊവ്വ_ബുധൻ_വ്യാഴം_വെള്ളി_ശനി".split("_"),
			weekdaysMin: "ഞാ_തി_ചൊ_ബു_വ്യാ_വെ_ശ".split("_"),
			longDateFormat: {
				LT: "A h:mm -നു",
				LTS: "A h:mm:ss -നു",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, A h:mm -നു",
				LLLL: "dddd, D MMMM YYYY, A h:mm -നു"
			},
			calendar: {
				sameDay: "[ഇന്ന്] LT",
				nextDay: "[നാളെ] LT",
				nextWeek: "dddd, LT",
				lastDay: "[ഇന്നലെ] LT",
				lastWeek: "[കഴിഞ്ഞ] dddd, LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s കഴിഞ്ഞ്",
				past: "%s മുൻപ്",
				s: "അൽപ നിമിഷങ്ങൾ",
				ss: "%d സെക്കൻഡ്",
				m: "ഒരു മിനിറ്റ്",
				mm: "%d മിനിറ്റ്",
				h: "ഒരു മണിക്കൂർ",
				hh: "%d മണിക്കൂർ",
				d: "ഒരു ദിവസം",
				dd: "%d ദിവസം",
				M: "ഒരു മാസം",
				MM: "%d മാസം",
				y: "ഒരു വർഷം",
				yy: "%d വർഷം"
			},
			meridiemParse: /രാത്രി|രാവിലെ|ഉച്ച കഴിഞ്ഞ്|വൈകുന്നേരം|രാത്രി/i,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "രാത്രി" === t && e >= 4 || "ഉച്ച കഴിഞ്ഞ്" === t || "വൈകുന്നേരം" === t ? e + 12 : e
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "രാത്രി" : e < 12 ? "രാവിലെ" : e < 17 ? "ഉച്ച കഴിഞ്ഞ്" : e < 20 ? "വൈകുന്നേരം" : "രാത്രി"
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n, r) {
			switch (n) {
				case"s":
					return t ? "хэдхэн секунд" : "хэдхэн секундын";
				case"ss":
					return e + (t ? " секунд" : " секундын");
				case"m":
				case"mm":
					return e + (t ? " минут" : " минутын");
				case"h":
				case"hh":
					return e + (t ? " цаг" : " цагийн");
				case"d":
				case"dd":
					return e + (t ? " өдөр" : " өдрийн");
				case"M":
				case"MM":
					return e + (t ? " сар" : " сарын");
				case"y":
				case"yy":
					return e + (t ? " жил" : " жилийн");
				default:
					return e
			}
		}

		e.defineLocale("mn", {
			months: "Нэгдүгээр сар_Хоёрдугаар сар_Гуравдугаар сар_Дөрөвдүгээр сар_Тавдугаар сар_Зургадугаар сар_Долдугаар сар_Наймдугаар сар_Есдүгээр сар_Аравдугаар сар_Арван нэгдүгээр сар_Арван хоёрдугаар сар".split("_"),
			monthsShort: "1 сар_2 сар_3 сар_4 сар_5 сар_6 сар_7 сар_8 сар_9 сар_10 сар_11 сар_12 сар".split("_"),
			monthsParseExact: !0,
			weekdays: "Ням_Даваа_Мягмар_Лхагва_Пүрэв_Баасан_Бямба".split("_"),
			weekdaysShort: "Ням_Дав_Мяг_Лха_Пүр_Баа_Бям".split("_"),
			weekdaysMin: "Ня_Да_Мя_Лх_Пү_Ба_Бя".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY-MM-DD",
				LL: "YYYY оны MMMMын D",
				LLL: "YYYY оны MMMMын D HH:mm",
				LLLL: "dddd, YYYY оны MMMMын D HH:mm"
			},
			meridiemParse: /ҮӨ|ҮХ/i,
			isPM: function (e) {
				return "ҮХ" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "ҮӨ" : "ҮХ"
			},
			calendar: {
				sameDay: "[Өнөөдөр] LT",
				nextDay: "[Маргааш] LT",
				nextWeek: "[Ирэх] dddd LT",
				lastDay: "[Өчигдөр] LT",
				lastWeek: "[Өнгөрсөн] dddd LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s дараа",
				past: "%s өмнө",
				s: t,
				ss: t,
				m: t,
				mm: t,
				h: t,
				hh: t,
				d: t,
				dd: t,
				M: t,
				MM: t,
				y: t,
				yy: t
			},
			dayOfMonthOrdinalParse: /\d{1,2} өдөр/,
			ordinal: function (e, t) {
				switch (t) {
					case"d":
					case"D":
					case"DDD":
						return e + " өдөр";
					default:
						return e
				}
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "१", 2: "२", 3: "३", 4: "४", 5: "५", 6: "६", 7: "७", 8: "८", 9: "९", 0: "०"},
			n = {"१": "1", "२": "2", "३": "3", "४": "4", "५": "5", "६": "6", "७": "7", "८": "8", "९": "9", "०": "0"};

		function r(e, t, n, r) {
			var i = "";
			if (t) switch (n) {
				case"s":
					i = "काही सेकंद";
					break;
				case"ss":
					i = "%d सेकंद";
					break;
				case"m":
					i = "एक मिनिट";
					break;
				case"mm":
					i = "%d मिनिटे";
					break;
				case"h":
					i = "एक तास";
					break;
				case"hh":
					i = "%d तास";
					break;
				case"d":
					i = "एक दिवस";
					break;
				case"dd":
					i = "%d दिवस";
					break;
				case"M":
					i = "एक महिना";
					break;
				case"MM":
					i = "%d महिने";
					break;
				case"y":
					i = "एक वर्ष";
					break;
				case"yy":
					i = "%d वर्षे"
			} else switch (n) {
				case"s":
					i = "काही सेकंदां";
					break;
				case"ss":
					i = "%d सेकंदां";
					break;
				case"m":
					i = "एका मिनिटा";
					break;
				case"mm":
					i = "%d मिनिटां";
					break;
				case"h":
					i = "एका तासा";
					break;
				case"hh":
					i = "%d तासां";
					break;
				case"d":
					i = "एका दिवसा";
					break;
				case"dd":
					i = "%d दिवसां";
					break;
				case"M":
					i = "एका महिन्या";
					break;
				case"MM":
					i = "%d महिन्यां";
					break;
				case"y":
					i = "एका वर्षा";
					break;
				case"yy":
					i = "%d वर्षां"
			}
			return i.replace(/%d/i, e)
		}

		e.defineLocale("mr", {
			months: "जानेवारी_फेब्रुवारी_मार्च_एप्रिल_मे_जून_जुलै_ऑगस्ट_सप्टेंबर_ऑक्टोबर_नोव्हेंबर_डिसेंबर".split("_"),
			monthsShort: "जाने._फेब्रु._मार्च._एप्रि._मे._जून._जुलै._ऑग._सप्टें._ऑक्टो._नोव्हें._डिसें.".split("_"),
			monthsParseExact: !0,
			weekdays: "रविवार_सोमवार_मंगळवार_बुधवार_गुरूवार_शुक्रवार_शनिवार".split("_"),
			weekdaysShort: "रवि_सोम_मंगळ_बुध_गुरू_शुक्र_शनि".split("_"),
			weekdaysMin: "र_सो_मं_बु_गु_शु_श".split("_"),
			longDateFormat: {
				LT: "A h:mm वाजता",
				LTS: "A h:mm:ss वाजता",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, A h:mm वाजता",
				LLLL: "dddd, D MMMM YYYY, A h:mm वाजता"
			},
			calendar: {
				sameDay: "[आज] LT",
				nextDay: "[उद्या] LT",
				nextWeek: "dddd, LT",
				lastDay: "[काल] LT",
				lastWeek: "[मागील] dddd, LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%sमध्ये",
				past: "%sपूर्वी",
				s: r,
				ss: r,
				m: r,
				mm: r,
				h: r,
				hh: r,
				d: r,
				dd: r,
				M: r,
				MM: r,
				y: r,
				yy: r
			},
			preparse: function (e) {
				return e.replace(/[१२३४५६७८९०]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			meridiemParse: /रात्री|सकाळी|दुपारी|सायंकाळी/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "रात्री" === t ? e < 4 ? e : e + 12 : "सकाळी" === t ? e : "दुपारी" === t ? e >= 10 ? e : e + 12 : "सायंकाळी" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "रात्री" : e < 10 ? "सकाळी" : e < 17 ? "दुपारी" : e < 20 ? "सायंकाळी" : "रात्री"
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ms", {
			months: "Januari_Februari_Mac_April_Mei_Jun_Julai_Ogos_September_Oktober_November_Disember".split("_"),
			monthsShort: "Jan_Feb_Mac_Apr_Mei_Jun_Jul_Ogs_Sep_Okt_Nov_Dis".split("_"),
			weekdays: "Ahad_Isnin_Selasa_Rabu_Khamis_Jumaat_Sabtu".split("_"),
			weekdaysShort: "Ahd_Isn_Sel_Rab_Kha_Jum_Sab".split("_"),
			weekdaysMin: "Ah_Is_Sl_Rb_Km_Jm_Sb".split("_"),
			longDateFormat: {
				LT: "HH.mm",
				LTS: "HH.mm.ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY [pukul] HH.mm",
				LLLL: "dddd, D MMMM YYYY [pukul] HH.mm"
			},
			meridiemParse: /pagi|tengahari|petang|malam/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "pagi" === t ? e : "tengahari" === t ? e >= 11 ? e : e + 12 : "petang" === t || "malam" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 11 ? "pagi" : e < 15 ? "tengahari" : e < 19 ? "petang" : "malam"
			},
			calendar: {
				sameDay: "[Hari ini pukul] LT",
				nextDay: "[Esok pukul] LT",
				nextWeek: "dddd [pukul] LT",
				lastDay: "[Kelmarin pukul] LT",
				lastWeek: "dddd [lepas pukul] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "dalam %s",
				past: "%s yang lepas",
				s: "beberapa saat",
				ss: "%d saat",
				m: "seminit",
				mm: "%d minit",
				h: "sejam",
				hh: "%d jam",
				d: "sehari",
				dd: "%d hari",
				M: "sebulan",
				MM: "%d bulan",
				y: "setahun",
				yy: "%d tahun"
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ms-my", {
			months: "Januari_Februari_Mac_April_Mei_Jun_Julai_Ogos_September_Oktober_November_Disember".split("_"),
			monthsShort: "Jan_Feb_Mac_Apr_Mei_Jun_Jul_Ogs_Sep_Okt_Nov_Dis".split("_"),
			weekdays: "Ahad_Isnin_Selasa_Rabu_Khamis_Jumaat_Sabtu".split("_"),
			weekdaysShort: "Ahd_Isn_Sel_Rab_Kha_Jum_Sab".split("_"),
			weekdaysMin: "Ah_Is_Sl_Rb_Km_Jm_Sb".split("_"),
			longDateFormat: {
				LT: "HH.mm",
				LTS: "HH.mm.ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY [pukul] HH.mm",
				LLLL: "dddd, D MMMM YYYY [pukul] HH.mm"
			},
			meridiemParse: /pagi|tengahari|petang|malam/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "pagi" === t ? e : "tengahari" === t ? e >= 11 ? e : e + 12 : "petang" === t || "malam" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 11 ? "pagi" : e < 15 ? "tengahari" : e < 19 ? "petang" : "malam"
			},
			calendar: {
				sameDay: "[Hari ini pukul] LT",
				nextDay: "[Esok pukul] LT",
				nextWeek: "dddd [pukul] LT",
				lastDay: "[Kelmarin pukul] LT",
				lastWeek: "dddd [lepas pukul] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "dalam %s",
				past: "%s yang lepas",
				s: "beberapa saat",
				ss: "%d saat",
				m: "seminit",
				mm: "%d minit",
				h: "sejam",
				hh: "%d jam",
				d: "sehari",
				dd: "%d hari",
				M: "sebulan",
				MM: "%d bulan",
				y: "setahun",
				yy: "%d tahun"
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("mt", {
			months: "Jannar_Frar_Marzu_April_Mejju_Ġunju_Lulju_Awwissu_Settembru_Ottubru_Novembru_Diċembru".split("_"),
			monthsShort: "Jan_Fra_Mar_Apr_Mej_Ġun_Lul_Aww_Set_Ott_Nov_Diċ".split("_"),
			weekdays: "Il-Ħadd_It-Tnejn_It-Tlieta_L-Erbgħa_Il-Ħamis_Il-Ġimgħa_Is-Sibt".split("_"),
			weekdaysShort: "Ħad_Tne_Tli_Erb_Ħam_Ġim_Sib".split("_"),
			weekdaysMin: "Ħa_Tn_Tl_Er_Ħa_Ġi_Si".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Illum fil-]LT",
				nextDay: "[Għada fil-]LT",
				nextWeek: "dddd [fil-]LT",
				lastDay: "[Il-bieraħ fil-]LT",
				lastWeek: "dddd [li għadda] [fil-]LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "f’ %s",
				past: "%s ilu",
				s: "ftit sekondi",
				ss: "%d sekondi",
				m: "minuta",
				mm: "%d minuti",
				h: "siegħa",
				hh: "%d siegħat",
				d: "ġurnata",
				dd: "%d ġranet",
				M: "xahar",
				MM: "%d xhur",
				y: "sena",
				yy: "%d sni"
			},
			dayOfMonthOrdinalParse: /\d{1,2}º/,
			ordinal: "%dº",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "၁", 2: "၂", 3: "၃", 4: "၄", 5: "၅", 6: "၆", 7: "၇", 8: "၈", 9: "၉", 0: "၀"},
			n = {"၁": "1", "၂": "2", "၃": "3", "၄": "4", "၅": "5", "၆": "6", "၇": "7", "၈": "8", "၉": "9", "၀": "0"};
		e.defineLocale("my", {
			months: "ဇန်နဝါရီ_ဖေဖော်ဝါရီ_မတ်_ဧပြီ_မေ_ဇွန်_ဇူလိုင်_သြဂုတ်_စက်တင်ဘာ_အောက်တိုဘာ_နိုဝင်ဘာ_ဒီဇင်ဘာ".split("_"),
			monthsShort: "ဇန်_ဖေ_မတ်_ပြီ_မေ_ဇွန်_လိုင်_သြ_စက်_အောက်_နို_ဒီ".split("_"),
			weekdays: "တနင်္ဂနွေ_တနင်္လာ_အင်္ဂါ_ဗုဒ္ဓဟူး_ကြာသပတေး_သောကြာ_စနေ".split("_"),
			weekdaysShort: "နွေ_လာ_ဂါ_ဟူး_ကြာ_သော_နေ".split("_"),
			weekdaysMin: "နွေ_လာ_ဂါ_ဟူး_ကြာ_သော_နေ".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[ယနေ.] LT [မှာ]",
				nextDay: "[မနက်ဖြန်] LT [မှာ]",
				nextWeek: "dddd LT [မှာ]",
				lastDay: "[မနေ.က] LT [မှာ]",
				lastWeek: "[ပြီးခဲ့သော] dddd LT [မှာ]",
				sameElse: "L"
			},
			relativeTime: {
				future: "လာမည့် %s မှာ",
				past: "လွန်ခဲ့သော %s က",
				s: "စက္ကန်.အနည်းငယ်",
				ss: "%d စက္ကန့်",
				m: "တစ်မိနစ်",
				mm: "%d မိနစ်",
				h: "တစ်နာရီ",
				hh: "%d နာရီ",
				d: "တစ်ရက်",
				dd: "%d ရက်",
				M: "တစ်လ",
				MM: "%d လ",
				y: "တစ်နှစ်",
				yy: "%d နှစ်"
			},
			preparse: function (e) {
				return e.replace(/[၁၂၃၄၅၆၇၈၉၀]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("nb", {
			months: "januar_februar_mars_april_mai_juni_juli_august_september_oktober_november_desember".split("_"),
			monthsShort: "jan._feb._mars_april_mai_juni_juli_aug._sep._okt._nov._des.".split("_"),
			monthsParseExact: !0,
			weekdays: "søndag_mandag_tirsdag_onsdag_torsdag_fredag_lørdag".split("_"),
			weekdaysShort: "sø._ma._ti._on._to._fr._lø.".split("_"),
			weekdaysMin: "sø_ma_ti_on_to_fr_lø".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY [kl.] HH:mm",
				LLLL: "dddd D. MMMM YYYY [kl.] HH:mm"
			},
			calendar: {
				sameDay: "[i dag kl.] LT",
				nextDay: "[i morgen kl.] LT",
				nextWeek: "dddd [kl.] LT",
				lastDay: "[i går kl.] LT",
				lastWeek: "[forrige] dddd [kl.] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "om %s",
				past: "%s siden",
				s: "noen sekunder",
				ss: "%d sekunder",
				m: "ett minutt",
				mm: "%d minutter",
				h: "en time",
				hh: "%d timer",
				d: "en dag",
				dd: "%d dager",
				M: "en måned",
				MM: "%d måneder",
				y: "ett år",
				yy: "%d år"
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "१", 2: "२", 3: "३", 4: "४", 5: "५", 6: "६", 7: "७", 8: "८", 9: "९", 0: "०"},
			n = {"१": "1", "२": "2", "३": "3", "४": "4", "५": "5", "६": "6", "७": "7", "८": "8", "९": "9", "०": "0"};
		e.defineLocale("ne", {
			months: "जनवरी_फेब्रुवरी_मार्च_अप्रिल_मई_जुन_जुलाई_अगष्ट_सेप्टेम्बर_अक्टोबर_नोभेम्बर_डिसेम्बर".split("_"),
			monthsShort: "जन._फेब्रु._मार्च_अप्रि._मई_जुन_जुलाई._अग._सेप्ट._अक्टो._नोभे._डिसे.".split("_"),
			monthsParseExact: !0,
			weekdays: "आइतबार_सोमबार_मङ्गलबार_बुधबार_बिहिबार_शुक्रबार_शनिबार".split("_"),
			weekdaysShort: "आइत._सोम._मङ्गल._बुध._बिहि._शुक्र._शनि.".split("_"),
			weekdaysMin: "आ._सो._मं._बु._बि._शु._श.".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "Aको h:mm बजे",
				LTS: "Aको h:mm:ss बजे",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, Aको h:mm बजे",
				LLLL: "dddd, D MMMM YYYY, Aको h:mm बजे"
			},
			preparse: function (e) {
				return e.replace(/[१२३४५६७८९०]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			meridiemParse: /राति|बिहान|दिउँसो|साँझ/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "राति" === t ? e < 4 ? e : e + 12 : "बिहान" === t ? e : "दिउँसो" === t ? e >= 10 ? e : e + 12 : "साँझ" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 3 ? "राति" : e < 12 ? "बिहान" : e < 16 ? "दिउँसो" : e < 20 ? "साँझ" : "राति"
			},
			calendar: {
				sameDay: "[आज] LT",
				nextDay: "[भोलि] LT",
				nextWeek: "[आउँदो] dddd[,] LT",
				lastDay: "[हिजो] LT",
				lastWeek: "[गएको] dddd[,] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%sमा",
				past: "%s अगाडि",
				s: "केही क्षण",
				ss: "%d सेकेण्ड",
				m: "एक मिनेट",
				mm: "%d मिनेट",
				h: "एक घण्टा",
				hh: "%d घण्टा",
				d: "एक दिन",
				dd: "%d दिन",
				M: "एक महिना",
				MM: "%d महिना",
				y: "एक बर्ष",
				yy: "%d बर्ष"
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "jan._feb._mrt._apr._mei_jun._jul._aug._sep._okt._nov._dec.".split("_"),
			n = "jan_feb_mrt_apr_mei_jun_jul_aug_sep_okt_nov_dec".split("_"),
			r = [/^jan/i, /^feb/i, /^maart|mrt.?$/i, /^apr/i, /^mei$/i, /^jun[i.]?$/i, /^jul[i.]?$/i, /^aug/i, /^sep/i, /^okt/i, /^nov/i, /^dec/i],
			i = /^(januari|februari|maart|april|mei|april|ju[nl]i|augustus|september|oktober|november|december|jan\.?|feb\.?|mrt\.?|apr\.?|ju[nl]\.?|aug\.?|sep\.?|okt\.?|nov\.?|dec\.?)/i;
		e.defineLocale("nl", {
			months: "januari_februari_maart_april_mei_juni_juli_augustus_september_oktober_november_december".split("_"),
			monthsShort: function (e, r) {
				return e ? /-MMM-/.test(r) ? n[e.month()] : t[e.month()] : t
			},
			monthsRegex: i,
			monthsShortRegex: i,
			monthsStrictRegex: /^(januari|februari|maart|mei|ju[nl]i|april|augustus|september|oktober|november|december)/i,
			monthsShortStrictRegex: /^(jan\.?|feb\.?|mrt\.?|apr\.?|mei|ju[nl]\.?|aug\.?|sep\.?|okt\.?|nov\.?|dec\.?)/i,
			monthsParse: r,
			longMonthsParse: r,
			shortMonthsParse: r,
			weekdays: "zondag_maandag_dinsdag_woensdag_donderdag_vrijdag_zaterdag".split("_"),
			weekdaysShort: "zo._ma._di._wo._do._vr._za.".split("_"),
			weekdaysMin: "zo_ma_di_wo_do_vr_za".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD-MM-YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[vandaag om] LT",
				nextDay: "[morgen om] LT",
				nextWeek: "dddd [om] LT",
				lastDay: "[gisteren om] LT",
				lastWeek: "[afgelopen] dddd [om] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "over %s",
				past: "%s geleden",
				s: "een paar seconden",
				ss: "%d seconden",
				m: "één minuut",
				mm: "%d minuten",
				h: "één uur",
				hh: "%d uur",
				d: "één dag",
				dd: "%d dagen",
				M: "één maand",
				MM: "%d maanden",
				y: "één jaar",
				yy: "%d jaar"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(ste|de)/,
			ordinal: function (e) {
				return e + (1 === e || 8 === e || e >= 20 ? "ste" : "de")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "jan._feb._mrt._apr._mei_jun._jul._aug._sep._okt._nov._dec.".split("_"),
			n = "jan_feb_mrt_apr_mei_jun_jul_aug_sep_okt_nov_dec".split("_"),
			r = [/^jan/i, /^feb/i, /^maart|mrt.?$/i, /^apr/i, /^mei$/i, /^jun[i.]?$/i, /^jul[i.]?$/i, /^aug/i, /^sep/i, /^okt/i, /^nov/i, /^dec/i],
			i = /^(januari|februari|maart|april|mei|april|ju[nl]i|augustus|september|oktober|november|december|jan\.?|feb\.?|mrt\.?|apr\.?|ju[nl]\.?|aug\.?|sep\.?|okt\.?|nov\.?|dec\.?)/i;
		e.defineLocale("nl-be", {
			months: "januari_februari_maart_april_mei_juni_juli_augustus_september_oktober_november_december".split("_"),
			monthsShort: function (e, r) {
				return e ? /-MMM-/.test(r) ? n[e.month()] : t[e.month()] : t
			},
			monthsRegex: i,
			monthsShortRegex: i,
			monthsStrictRegex: /^(januari|februari|maart|mei|ju[nl]i|april|augustus|september|oktober|november|december)/i,
			monthsShortStrictRegex: /^(jan\.?|feb\.?|mrt\.?|apr\.?|mei|ju[nl]\.?|aug\.?|sep\.?|okt\.?|nov\.?|dec\.?)/i,
			monthsParse: r,
			longMonthsParse: r,
			shortMonthsParse: r,
			weekdays: "zondag_maandag_dinsdag_woensdag_donderdag_vrijdag_zaterdag".split("_"),
			weekdaysShort: "zo._ma._di._wo._do._vr._za.".split("_"),
			weekdaysMin: "zo_ma_di_wo_do_vr_za".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[vandaag om] LT",
				nextDay: "[morgen om] LT",
				nextWeek: "dddd [om] LT",
				lastDay: "[gisteren om] LT",
				lastWeek: "[afgelopen] dddd [om] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "over %s",
				past: "%s geleden",
				s: "een paar seconden",
				ss: "%d seconden",
				m: "één minuut",
				mm: "%d minuten",
				h: "één uur",
				hh: "%d uur",
				d: "één dag",
				dd: "%d dagen",
				M: "één maand",
				MM: "%d maanden",
				y: "één jaar",
				yy: "%d jaar"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(ste|de)/,
			ordinal: function (e) {
				return e + (1 === e || 8 === e || e >= 20 ? "ste" : "de")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("nn", {
			months: "januar_februar_mars_april_mai_juni_juli_august_september_oktober_november_desember".split("_"),
			monthsShort: "jan_feb_mar_apr_mai_jun_jul_aug_sep_okt_nov_des".split("_"),
			weekdays: "sundag_måndag_tysdag_onsdag_torsdag_fredag_laurdag".split("_"),
			weekdaysShort: "sun_mån_tys_ons_tor_fre_lau".split("_"),
			weekdaysMin: "su_må_ty_on_to_fr_lø".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY [kl.] H:mm",
				LLLL: "dddd D. MMMM YYYY [kl.] HH:mm"
			},
			calendar: {
				sameDay: "[I dag klokka] LT",
				nextDay: "[I morgon klokka] LT",
				nextWeek: "dddd [klokka] LT",
				lastDay: "[I går klokka] LT",
				lastWeek: "[Føregåande] dddd [klokka] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "om %s",
				past: "%s sidan",
				s: "nokre sekund",
				ss: "%d sekund",
				m: "eit minutt",
				mm: "%d minutt",
				h: "ein time",
				hh: "%d timar",
				d: "ein dag",
				dd: "%d dagar",
				M: "ein månad",
				MM: "%d månader",
				y: "eit år",
				yy: "%d år"
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "੧", 2: "੨", 3: "੩", 4: "੪", 5: "੫", 6: "੬", 7: "੭", 8: "੮", 9: "੯", 0: "੦"},
			n = {"੧": "1", "੨": "2", "੩": "3", "੪": "4", "੫": "5", "੬": "6", "੭": "7", "੮": "8", "੯": "9", "੦": "0"};
		e.defineLocale("pa-in", {
			months: "ਜਨਵਰੀ_ਫ਼ਰਵਰੀ_ਮਾਰਚ_ਅਪ੍ਰੈਲ_ਮਈ_ਜੂਨ_ਜੁਲਾਈ_ਅਗਸਤ_ਸਤੰਬਰ_ਅਕਤੂਬਰ_ਨਵੰਬਰ_ਦਸੰਬਰ".split("_"),
			monthsShort: "ਜਨਵਰੀ_ਫ਼ਰਵਰੀ_ਮਾਰਚ_ਅਪ੍ਰੈਲ_ਮਈ_ਜੂਨ_ਜੁਲਾਈ_ਅਗਸਤ_ਸਤੰਬਰ_ਅਕਤੂਬਰ_ਨਵੰਬਰ_ਦਸੰਬਰ".split("_"),
			weekdays: "ਐਤਵਾਰ_ਸੋਮਵਾਰ_ਮੰਗਲਵਾਰ_ਬੁਧਵਾਰ_ਵੀਰਵਾਰ_ਸ਼ੁੱਕਰਵਾਰ_ਸ਼ਨੀਚਰਵਾਰ".split("_"),
			weekdaysShort: "ਐਤ_ਸੋਮ_ਮੰਗਲ_ਬੁਧ_ਵੀਰ_ਸ਼ੁਕਰ_ਸ਼ਨੀ".split("_"),
			weekdaysMin: "ਐਤ_ਸੋਮ_ਮੰਗਲ_ਬੁਧ_ਵੀਰ_ਸ਼ੁਕਰ_ਸ਼ਨੀ".split("_"),
			longDateFormat: {
				LT: "A h:mm ਵਜੇ",
				LTS: "A h:mm:ss ਵਜੇ",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, A h:mm ਵਜੇ",
				LLLL: "dddd, D MMMM YYYY, A h:mm ਵਜੇ"
			},
			calendar: {
				sameDay: "[ਅਜ] LT",
				nextDay: "[ਕਲ] LT",
				nextWeek: "[ਅਗਲਾ] dddd, LT",
				lastDay: "[ਕਲ] LT",
				lastWeek: "[ਪਿਛਲੇ] dddd, LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s ਵਿੱਚ",
				past: "%s ਪਿਛਲੇ",
				s: "ਕੁਝ ਸਕਿੰਟ",
				ss: "%d ਸਕਿੰਟ",
				m: "ਇਕ ਮਿੰਟ",
				mm: "%d ਮਿੰਟ",
				h: "ਇੱਕ ਘੰਟਾ",
				hh: "%d ਘੰਟੇ",
				d: "ਇੱਕ ਦਿਨ",
				dd: "%d ਦਿਨ",
				M: "ਇੱਕ ਮਹੀਨਾ",
				MM: "%d ਮਹੀਨੇ",
				y: "ਇੱਕ ਸਾਲ",
				yy: "%d ਸਾਲ"
			},
			preparse: function (e) {
				return e.replace(/[੧੨੩੪੫੬੭੮੯੦]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			meridiemParse: /ਰਾਤ|ਸਵੇਰ|ਦੁਪਹਿਰ|ਸ਼ਾਮ/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "ਰਾਤ" === t ? e < 4 ? e : e + 12 : "ਸਵੇਰ" === t ? e : "ਦੁਪਹਿਰ" === t ? e >= 10 ? e : e + 12 : "ਸ਼ਾਮ" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "ਰਾਤ" : e < 10 ? "ਸਵੇਰ" : e < 17 ? "ਦੁਪਹਿਰ" : e < 20 ? "ਸ਼ਾਮ" : "ਰਾਤ"
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "styczeń_luty_marzec_kwiecień_maj_czerwiec_lipiec_sierpień_wrzesień_październik_listopad_grudzień".split("_"),
			n = "stycznia_lutego_marca_kwietnia_maja_czerwca_lipca_sierpnia_września_października_listopada_grudnia".split("_");

		function r(e) {
			return e % 10 < 5 && e % 10 > 1 && ~~(e / 10) % 10 != 1
		}

		function i(e, t, n) {
			var i = e + " ";
			switch (n) {
				case"ss":
					return i + (r(e) ? "sekundy" : "sekund");
				case"m":
					return t ? "minuta" : "minutę";
				case"mm":
					return i + (r(e) ? "minuty" : "minut");
				case"h":
					return t ? "godzina" : "godzinę";
				case"hh":
					return i + (r(e) ? "godziny" : "godzin");
				case"MM":
					return i + (r(e) ? "miesiące" : "miesięcy");
				case"yy":
					return i + (r(e) ? "lata" : "lat")
			}
		}

		e.defineLocale("pl", {
			months: function (e, r) {
				return e ? "" === r ? "(" + n[e.month()] + "|" + t[e.month()] + ")" : /D MMMM/.test(r) ? n[e.month()] : t[e.month()] : t
			},
			monthsShort: "sty_lut_mar_kwi_maj_cze_lip_sie_wrz_paź_lis_gru".split("_"),
			weekdays: "niedziela_poniedziałek_wtorek_środa_czwartek_piątek_sobota".split("_"),
			weekdaysShort: "ndz_pon_wt_śr_czw_pt_sob".split("_"),
			weekdaysMin: "Nd_Pn_Wt_Śr_Cz_Pt_So".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Dziś o] LT", nextDay: "[Jutro o] LT", nextWeek: function () {
					switch (this.day()) {
						case 0:
							return "[W niedzielę o] LT";
						case 2:
							return "[We wtorek o] LT";
						case 3:
							return "[W środę o] LT";
						case 6:
							return "[W sobotę o] LT";
						default:
							return "[W] dddd [o] LT"
					}
				}, lastDay: "[Wczoraj o] LT", lastWeek: function () {
					switch (this.day()) {
						case 0:
							return "[W zeszłą niedzielę o] LT";
						case 3:
							return "[W zeszłą środę o] LT";
						case 6:
							return "[W zeszłą sobotę o] LT";
						default:
							return "[W zeszły] dddd [o] LT"
					}
				}, sameElse: "L"
			},
			relativeTime: {
				future: "za %s",
				past: "%s temu",
				s: "kilka sekund",
				ss: i,
				m: i,
				mm: i,
				h: i,
				hh: i,
				d: "1 dzień",
				dd: "%d dni",
				M: "miesiąc",
				MM: i,
				y: "rok",
				yy: i
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("pt", {
			months: "janeiro_fevereiro_março_abril_maio_junho_julho_agosto_setembro_outubro_novembro_dezembro".split("_"),
			monthsShort: "jan_fev_mar_abr_mai_jun_jul_ago_set_out_nov_dez".split("_"),
			weekdays: "Domingo_Segunda-feira_Terça-feira_Quarta-feira_Quinta-feira_Sexta-feira_Sábado".split("_"),
			weekdaysShort: "Dom_Seg_Ter_Qua_Qui_Sex_Sáb".split("_"),
			weekdaysMin: "Do_2ª_3ª_4ª_5ª_6ª_Sá".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D [de] MMMM [de] YYYY",
				LLL: "D [de] MMMM [de] YYYY HH:mm",
				LLLL: "dddd, D [de] MMMM [de] YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Hoje às] LT",
				nextDay: "[Amanhã às] LT",
				nextWeek: "dddd [às] LT",
				lastDay: "[Ontem às] LT",
				lastWeek: function () {
					return 0 === this.day() || 6 === this.day() ? "[Último] dddd [às] LT" : "[Última] dddd [às] LT"
				},
				sameElse: "L"
			},
			relativeTime: {
				future: "em %s",
				past: "há %s",
				s: "segundos",
				ss: "%d segundos",
				m: "um minuto",
				mm: "%d minutos",
				h: "uma hora",
				hh: "%d horas",
				d: "um dia",
				dd: "%d dias",
				M: "um mês",
				MM: "%d meses",
				y: "um ano",
				yy: "%d anos"
			},
			dayOfMonthOrdinalParse: /\d{1,2}º/,
			ordinal: "%dº",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("pt-br", {
			months: "janeiro_fevereiro_março_abril_maio_junho_julho_agosto_setembro_outubro_novembro_dezembro".split("_"),
			monthsShort: "jan_fev_mar_abr_mai_jun_jul_ago_set_out_nov_dez".split("_"),
			weekdays: "Domingo_Segunda-feira_Terça-feira_Quarta-feira_Quinta-feira_Sexta-feira_Sábado".split("_"),
			weekdaysShort: "Dom_Seg_Ter_Qua_Qui_Sex_Sáb".split("_"),
			weekdaysMin: "Do_2ª_3ª_4ª_5ª_6ª_Sá".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D [de] MMMM [de] YYYY",
				LLL: "D [de] MMMM [de] YYYY [às] HH:mm",
				LLLL: "dddd, D [de] MMMM [de] YYYY [às] HH:mm"
			},
			calendar: {
				sameDay: "[Hoje às] LT",
				nextDay: "[Amanhã às] LT",
				nextWeek: "dddd [às] LT",
				lastDay: "[Ontem às] LT",
				lastWeek: function () {
					return 0 === this.day() || 6 === this.day() ? "[Último] dddd [às] LT" : "[Última] dddd [às] LT"
				},
				sameElse: "L"
			},
			relativeTime: {
				future: "em %s",
				past: "há %s",
				s: "poucos segundos",
				ss: "%d segundos",
				m: "um minuto",
				mm: "%d minutos",
				h: "uma hora",
				hh: "%d horas",
				d: "um dia",
				dd: "%d dias",
				M: "um mês",
				MM: "%d meses",
				y: "um ano",
				yy: "%d anos"
			},
			dayOfMonthOrdinalParse: /\d{1,2}º/,
			ordinal: "%dº"
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n) {
			var r = " ";
			return (e % 100 >= 20 || e >= 100 && e % 100 == 0) && (r = " de "), e + r + {
				ss: "secunde",
				mm: "minute",
				hh: "ore",
				dd: "zile",
				MM: "luni",
				yy: "ani"
			}[n]
		}

		e.defineLocale("ro", {
			months: "ianuarie_februarie_martie_aprilie_mai_iunie_iulie_august_septembrie_octombrie_noiembrie_decembrie".split("_"),
			monthsShort: "ian._febr._mart._apr._mai_iun._iul._aug._sept._oct._nov._dec.".split("_"),
			monthsParseExact: !0,
			weekdays: "duminică_luni_marți_miercuri_joi_vineri_sâmbătă".split("_"),
			weekdaysShort: "Dum_Lun_Mar_Mie_Joi_Vin_Sâm".split("_"),
			weekdaysMin: "Du_Lu_Ma_Mi_Jo_Vi_Sâ".split("_"),
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY H:mm",
				LLLL: "dddd, D MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[azi la] LT",
				nextDay: "[mâine la] LT",
				nextWeek: "dddd [la] LT",
				lastDay: "[ieri la] LT",
				lastWeek: "[fosta] dddd [la] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "peste %s",
				past: "%s în urmă",
				s: "câteva secunde",
				ss: t,
				m: "un minut",
				mm: t,
				h: "o oră",
				hh: t,
				d: "o zi",
				dd: t,
				M: "o lună",
				MM: t,
				y: "un an",
				yy: t
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n) {
			var r, i;
			return "m" === n ? t ? "минута" : "минуту" : e + " " + (r = +e, i = {
				ss: t ? "секунда_секунды_секунд" : "секунду_секунды_секунд",
				mm: t ? "минута_минуты_минут" : "минуту_минуты_минут",
				hh: "час_часа_часов",
				dd: "день_дня_дней",
				MM: "месяц_месяца_месяцев",
				yy: "год_года_лет"
			}[n].split("_"), r % 10 == 1 && r % 100 != 11 ? i[0] : r % 10 >= 2 && r % 10 <= 4 && (r % 100 < 10 || r % 100 >= 20) ? i[1] : i[2])
		}

		var n = [/^янв/i, /^фев/i, /^мар/i, /^апр/i, /^ма[йя]/i, /^июн/i, /^июл/i, /^авг/i, /^сен/i, /^окт/i, /^ноя/i, /^дек/i];
		e.defineLocale("ru", {
			months: {
				format: "января_февраля_марта_апреля_мая_июня_июля_августа_сентября_октября_ноября_декабря".split("_"),
				standalone: "январь_февраль_март_апрель_май_июнь_июль_август_сентябрь_октябрь_ноябрь_декабрь".split("_")
			},
			monthsShort: {
				format: "янв._февр._мар._апр._мая_июня_июля_авг._сент._окт._нояб._дек.".split("_"),
				standalone: "янв._февр._март_апр._май_июнь_июль_авг._сент._окт._нояб._дек.".split("_")
			},
			weekdays: {
				standalone: "воскресенье_понедельник_вторник_среда_четверг_пятница_суббота".split("_"),
				format: "воскресенье_понедельник_вторник_среду_четверг_пятницу_субботу".split("_"),
				isFormat: /\[ ?[Вв] ?(?:прошлую|следующую|эту)? ?\] ?dddd/
			},
			weekdaysShort: "вс_пн_вт_ср_чт_пт_сб".split("_"),
			weekdaysMin: "вс_пн_вт_ср_чт_пт_сб".split("_"),
			monthsParse: n,
			longMonthsParse: n,
			shortMonthsParse: n,
			monthsRegex: /^(январ[ья]|янв\.?|феврал[ья]|февр?\.?|марта?|мар\.?|апрел[ья]|апр\.?|ма[йя]|июн[ья]|июн\.?|июл[ья]|июл\.?|августа?|авг\.?|сентябр[ья]|сент?\.?|октябр[ья]|окт\.?|ноябр[ья]|нояб?\.?|декабр[ья]|дек\.?)/i,
			monthsShortRegex: /^(январ[ья]|янв\.?|феврал[ья]|февр?\.?|марта?|мар\.?|апрел[ья]|апр\.?|ма[йя]|июн[ья]|июн\.?|июл[ья]|июл\.?|августа?|авг\.?|сентябр[ья]|сент?\.?|октябр[ья]|окт\.?|ноябр[ья]|нояб?\.?|декабр[ья]|дек\.?)/i,
			monthsStrictRegex: /^(январ[яь]|феврал[яь]|марта?|апрел[яь]|ма[яй]|июн[яь]|июл[яь]|августа?|сентябр[яь]|октябр[яь]|ноябр[яь]|декабр[яь])/i,
			monthsShortStrictRegex: /^(янв\.|февр?\.|мар[т.]|апр\.|ма[яй]|июн[ья.]|июл[ья.]|авг\.|сент?\.|окт\.|нояб?\.|дек\.)/i,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY г.",
				LLL: "D MMMM YYYY г., H:mm",
				LLLL: "dddd, D MMMM YYYY г., H:mm"
			},
			calendar: {
				sameDay: "[Сегодня, в] LT",
				nextDay: "[Завтра, в] LT",
				lastDay: "[Вчера, в] LT",
				nextWeek: function (e) {
					if (e.week() === this.week()) return 2 === this.day() ? "[Во] dddd, [в] LT" : "[В] dddd, [в] LT";
					switch (this.day()) {
						case 0:
							return "[В следующее] dddd, [в] LT";
						case 1:
						case 2:
						case 4:
							return "[В следующий] dddd, [в] LT";
						case 3:
						case 5:
						case 6:
							return "[В следующую] dddd, [в] LT"
					}
				},
				lastWeek: function (e) {
					if (e.week() === this.week()) return 2 === this.day() ? "[Во] dddd, [в] LT" : "[В] dddd, [в] LT";
					switch (this.day()) {
						case 0:
							return "[В прошлое] dddd, [в] LT";
						case 1:
						case 2:
						case 4:
							return "[В прошлый] dddd, [в] LT";
						case 3:
						case 5:
						case 6:
							return "[В прошлую] dddd, [в] LT"
					}
				},
				sameElse: "L"
			},
			relativeTime: {
				future: "через %s",
				past: "%s назад",
				s: "несколько секунд",
				ss: t,
				m: t,
				mm: t,
				h: "час",
				hh: t,
				d: "день",
				dd: t,
				M: "месяц",
				MM: t,
				y: "год",
				yy: t
			},
			meridiemParse: /ночи|утра|дня|вечера/i,
			isPM: function (e) {
				return /^(дня|вечера)$/.test(e)
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "ночи" : e < 12 ? "утра" : e < 17 ? "дня" : "вечера"
			},
			dayOfMonthOrdinalParse: /\d{1,2}-(й|го|я)/,
			ordinal: function (e, t) {
				switch (t) {
					case"M":
					case"d":
					case"DDD":
						return e + "-й";
					case"D":
						return e + "-го";
					case"w":
					case"W":
						return e + "-я";
					default:
						return e
				}
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = ["جنوري", "فيبروري", "مارچ", "اپريل", "مئي", "جون", "جولاءِ", "آگسٽ", "سيپٽمبر", "آڪٽوبر", "نومبر", "ڊسمبر"],
			n = ["آچر", "سومر", "اڱارو", "اربع", "خميس", "جمع", "ڇنڇر"];
		e.defineLocale("sd", {
			months: t,
			monthsShort: t,
			weekdays: n,
			weekdaysShort: n,
			weekdaysMin: n,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd، D MMMM YYYY HH:mm"
			},
			meridiemParse: /صبح|شام/,
			isPM: function (e) {
				return "شام" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "صبح" : "شام"
			},
			calendar: {
				sameDay: "[اڄ] LT",
				nextDay: "[سڀاڻي] LT",
				nextWeek: "dddd [اڳين هفتي تي] LT",
				lastDay: "[ڪالهه] LT",
				lastWeek: "[گزريل هفتي] dddd [تي] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s پوء",
				past: "%s اڳ",
				s: "چند سيڪنڊ",
				ss: "%d سيڪنڊ",
				m: "هڪ منٽ",
				mm: "%d منٽ",
				h: "هڪ ڪلاڪ",
				hh: "%d ڪلاڪ",
				d: "هڪ ڏينهن",
				dd: "%d ڏينهن",
				M: "هڪ مهينو",
				MM: "%d مهينا",
				y: "هڪ سال",
				yy: "%d سال"
			},
			preparse: function (e) {
				return e.replace(/،/g, ",")
			},
			postformat: function (e) {
				return e.replace(/,/g, "،")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("se", {
			months: "ođđajagemánnu_guovvamánnu_njukčamánnu_cuoŋománnu_miessemánnu_geassemánnu_suoidnemánnu_borgemánnu_čakčamánnu_golggotmánnu_skábmamánnu_juovlamánnu".split("_"),
			monthsShort: "ođđj_guov_njuk_cuo_mies_geas_suoi_borg_čakč_golg_skáb_juov".split("_"),
			weekdays: "sotnabeaivi_vuossárga_maŋŋebárga_gaskavahkku_duorastat_bearjadat_lávvardat".split("_"),
			weekdaysShort: "sotn_vuos_maŋ_gask_duor_bear_láv".split("_"),
			weekdaysMin: "s_v_m_g_d_b_L".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "MMMM D. [b.] YYYY",
				LLL: "MMMM D. [b.] YYYY [ti.] HH:mm",
				LLLL: "dddd, MMMM D. [b.] YYYY [ti.] HH:mm"
			},
			calendar: {
				sameDay: "[otne ti] LT",
				nextDay: "[ihttin ti] LT",
				nextWeek: "dddd [ti] LT",
				lastDay: "[ikte ti] LT",
				lastWeek: "[ovddit] dddd [ti] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s geažes",
				past: "maŋit %s",
				s: "moadde sekunddat",
				ss: "%d sekunddat",
				m: "okta minuhta",
				mm: "%d minuhtat",
				h: "okta diimmu",
				hh: "%d diimmut",
				d: "okta beaivi",
				dd: "%d beaivvit",
				M: "okta mánnu",
				MM: "%d mánut",
				y: "okta jahki",
				yy: "%d jagit"
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("si", {
			months: "ජනවාරි_පෙබරවාරි_මාර්තු_අප්‍රේල්_මැයි_ජූනි_ජූලි_අගෝස්තු_සැප්තැම්බර්_ඔක්තෝබර්_නොවැම්බර්_දෙසැම්බර්".split("_"),
			monthsShort: "ජන_පෙබ_මාර්_අප්_මැයි_ජූනි_ජූලි_අගෝ_සැප්_ඔක්_නොවැ_දෙසැ".split("_"),
			weekdays: "ඉරිදා_සඳුදා_අඟහරුවාදා_බදාදා_බ්‍රහස්පතින්දා_සිකුරාදා_සෙනසුරාදා".split("_"),
			weekdaysShort: "ඉරි_සඳු_අඟ_බදා_බ්‍රහ_සිකු_සෙන".split("_"),
			weekdaysMin: "ඉ_ස_අ_බ_බ්‍ර_සි_සෙ".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "a h:mm",
				LTS: "a h:mm:ss",
				L: "YYYY/MM/DD",
				LL: "YYYY MMMM D",
				LLL: "YYYY MMMM D, a h:mm",
				LLLL: "YYYY MMMM D [වැනි] dddd, a h:mm:ss"
			},
			calendar: {
				sameDay: "[අද] LT[ට]",
				nextDay: "[හෙට] LT[ට]",
				nextWeek: "dddd LT[ට]",
				lastDay: "[ඊයේ] LT[ට]",
				lastWeek: "[පසුගිය] dddd LT[ට]",
				sameElse: "L"
			},
			relativeTime: {
				future: "%sකින්",
				past: "%sකට පෙර",
				s: "තත්පර කිහිපය",
				ss: "තත්පර %d",
				m: "මිනිත්තුව",
				mm: "මිනිත්තු %d",
				h: "පැය",
				hh: "පැය %d",
				d: "දිනය",
				dd: "දින %d",
				M: "මාසය",
				MM: "මාස %d",
				y: "වසර",
				yy: "වසර %d"
			},
			dayOfMonthOrdinalParse: /\d{1,2} වැනි/,
			ordinal: function (e) {
				return e + " වැනි"
			},
			meridiemParse: /පෙර වරු|පස් වරු|පෙ.ව|ප.ව./,
			isPM: function (e) {
				return "ප.ව." === e || "පස් වරු" === e
			},
			meridiem: function (e, t, n) {
				return e > 11 ? n ? "ප.ව." : "පස් වරු" : n ? "පෙ.ව." : "පෙර වරු"
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "január_február_marec_apríl_máj_jún_júl_august_september_október_november_december".split("_"),
			n = "jan_feb_mar_apr_máj_jún_júl_aug_sep_okt_nov_dec".split("_");

		function r(e) {
			return e > 1 && e < 5
		}

		function i(e, t, n, i) {
			var a = e + " ";
			switch (n) {
				case"s":
					return t || i ? "pár sekúnd" : "pár sekundami";
				case"ss":
					return t || i ? a + (r(e) ? "sekundy" : "sekúnd") : a + "sekundami";
				case"m":
					return t ? "minúta" : i ? "minútu" : "minútou";
				case"mm":
					return t || i ? a + (r(e) ? "minúty" : "minút") : a + "minútami";
				case"h":
					return t ? "hodina" : i ? "hodinu" : "hodinou";
				case"hh":
					return t || i ? a + (r(e) ? "hodiny" : "hodín") : a + "hodinami";
				case"d":
					return t || i ? "deň" : "dňom";
				case"dd":
					return t || i ? a + (r(e) ? "dni" : "dní") : a + "dňami";
				case"M":
					return t || i ? "mesiac" : "mesiacom";
				case"MM":
					return t || i ? a + (r(e) ? "mesiace" : "mesiacov") : a + "mesiacmi";
				case"y":
					return t || i ? "rok" : "rokom";
				case"yy":
					return t || i ? a + (r(e) ? "roky" : "rokov") : a + "rokmi"
			}
		}

		e.defineLocale("sk", {
			months: t,
			monthsShort: n,
			weekdays: "nedeľa_pondelok_utorok_streda_štvrtok_piatok_sobota".split("_"),
			weekdaysShort: "ne_po_ut_st_št_pi_so".split("_"),
			weekdaysMin: "ne_po_ut_st_št_pi_so".split("_"),
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm",
				LLLL: "dddd D. MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[dnes o] LT", nextDay: "[zajtra o] LT", nextWeek: function () {
					switch (this.day()) {
						case 0:
							return "[v nedeľu o] LT";
						case 1:
						case 2:
							return "[v] dddd [o] LT";
						case 3:
							return "[v stredu o] LT";
						case 4:
							return "[vo štvrtok o] LT";
						case 5:
							return "[v piatok o] LT";
						case 6:
							return "[v sobotu o] LT"
					}
				}, lastDay: "[včera o] LT", lastWeek: function () {
					switch (this.day()) {
						case 0:
							return "[minulú nedeľu o] LT";
						case 1:
						case 2:
							return "[minulý] dddd [o] LT";
						case 3:
							return "[minulú stredu o] LT";
						case 4:
						case 5:
							return "[minulý] dddd [o] LT";
						case 6:
							return "[minulú sobotu o] LT"
					}
				}, sameElse: "L"
			},
			relativeTime: {
				future: "za %s",
				past: "pred %s",
				s: i,
				ss: i,
				m: i,
				mm: i,
				h: i,
				hh: i,
				d: i,
				dd: i,
				M: i,
				MM: i,
				y: i,
				yy: i
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n, r) {
			var i = e + " ";
			switch (n) {
				case"s":
					return t || r ? "nekaj sekund" : "nekaj sekundami";
				case"ss":
					return i += 1 === e ? t ? "sekundo" : "sekundi" : 2 === e ? t || r ? "sekundi" : "sekundah" : e < 5 ? t || r ? "sekunde" : "sekundah" : "sekund";
				case"m":
					return t ? "ena minuta" : "eno minuto";
				case"mm":
					return i += 1 === e ? t ? "minuta" : "minuto" : 2 === e ? t || r ? "minuti" : "minutama" : e < 5 ? t || r ? "minute" : "minutami" : t || r ? "minut" : "minutami";
				case"h":
					return t ? "ena ura" : "eno uro";
				case"hh":
					return i += 1 === e ? t ? "ura" : "uro" : 2 === e ? t || r ? "uri" : "urama" : e < 5 ? t || r ? "ure" : "urami" : t || r ? "ur" : "urami";
				case"d":
					return t || r ? "en dan" : "enim dnem";
				case"dd":
					return i += 1 === e ? t || r ? "dan" : "dnem" : 2 === e ? t || r ? "dni" : "dnevoma" : t || r ? "dni" : "dnevi";
				case"M":
					return t || r ? "en mesec" : "enim mesecem";
				case"MM":
					return i += 1 === e ? t || r ? "mesec" : "mesecem" : 2 === e ? t || r ? "meseca" : "mesecema" : e < 5 ? t || r ? "mesece" : "meseci" : t || r ? "mesecev" : "meseci";
				case"y":
					return t || r ? "eno leto" : "enim letom";
				case"yy":
					return i += 1 === e ? t || r ? "leto" : "letom" : 2 === e ? t || r ? "leti" : "letoma" : e < 5 ? t || r ? "leta" : "leti" : t || r ? "let" : "leti"
			}
		}

		e.defineLocale("sl", {
			months: "januar_februar_marec_april_maj_junij_julij_avgust_september_oktober_november_december".split("_"),
			monthsShort: "jan._feb._mar._apr._maj._jun._jul._avg._sep._okt._nov._dec.".split("_"),
			monthsParseExact: !0,
			weekdays: "nedelja_ponedeljek_torek_sreda_četrtek_petek_sobota".split("_"),
			weekdaysShort: "ned._pon._tor._sre._čet._pet._sob.".split("_"),
			weekdaysMin: "ne_po_to_sr_če_pe_so".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm",
				LLLL: "dddd, D. MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[danes ob] LT", nextDay: "[jutri ob] LT", nextWeek: function () {
					switch (this.day()) {
						case 0:
							return "[v] [nedeljo] [ob] LT";
						case 3:
							return "[v] [sredo] [ob] LT";
						case 6:
							return "[v] [soboto] [ob] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[v] dddd [ob] LT"
					}
				}, lastDay: "[včeraj ob] LT", lastWeek: function () {
					switch (this.day()) {
						case 0:
							return "[prejšnjo] [nedeljo] [ob] LT";
						case 3:
							return "[prejšnjo] [sredo] [ob] LT";
						case 6:
							return "[prejšnjo] [soboto] [ob] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[prejšnji] dddd [ob] LT"
					}
				}, sameElse: "L"
			},
			relativeTime: {
				future: "čez %s",
				past: "pred %s",
				s: t,
				ss: t,
				m: t,
				mm: t,
				h: t,
				hh: t,
				d: t,
				dd: t,
				M: t,
				MM: t,
				y: t,
				yy: t
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("sq", {
			months: "Janar_Shkurt_Mars_Prill_Maj_Qershor_Korrik_Gusht_Shtator_Tetor_Nëntor_Dhjetor".split("_"),
			monthsShort: "Jan_Shk_Mar_Pri_Maj_Qer_Kor_Gus_Sht_Tet_Nën_Dhj".split("_"),
			weekdays: "E Diel_E Hënë_E Martë_E Mërkurë_E Enjte_E Premte_E Shtunë".split("_"),
			weekdaysShort: "Die_Hën_Mar_Mër_Enj_Pre_Sht".split("_"),
			weekdaysMin: "D_H_Ma_Më_E_P_Sh".split("_"),
			weekdaysParseExact: !0,
			meridiemParse: /PD|MD/,
			isPM: function (e) {
				return "M" === e.charAt(0)
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "PD" : "MD"
			},
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Sot në] LT",
				nextDay: "[Nesër në] LT",
				nextWeek: "dddd [në] LT",
				lastDay: "[Dje në] LT",
				lastWeek: "dddd [e kaluar në] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "në %s",
				past: "%s më parë",
				s: "disa sekonda",
				ss: "%d sekonda",
				m: "një minutë",
				mm: "%d minuta",
				h: "një orë",
				hh: "%d orë",
				d: "një ditë",
				dd: "%d ditë",
				M: "një muaj",
				MM: "%d muaj",
				y: "një vit",
				yy: "%d vite"
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {
			words: {
				ss: ["sekunda", "sekunde", "sekundi"],
				m: ["jedan minut", "jedne minute"],
				mm: ["minut", "minute", "minuta"],
				h: ["jedan sat", "jednog sata"],
				hh: ["sat", "sata", "sati"],
				dd: ["dan", "dana", "dana"],
				MM: ["mesec", "meseca", "meseci"],
				yy: ["godina", "godine", "godina"]
			}, correctGrammaticalCase: function (e, t) {
				return 1 === e ? t[0] : e >= 2 && e <= 4 ? t[1] : t[2]
			}, translate: function (e, n, r) {
				var i = t.words[r];
				return 1 === r.length ? n ? i[0] : i[1] : e + " " + t.correctGrammaticalCase(e, i)
			}
		};
		e.defineLocale("sr", {
			months: "januar_februar_mart_april_maj_jun_jul_avgust_septembar_oktobar_novembar_decembar".split("_"),
			monthsShort: "jan._feb._mar._apr._maj_jun_jul_avg._sep._okt._nov._dec.".split("_"),
			monthsParseExact: !0,
			weekdays: "nedelja_ponedeljak_utorak_sreda_četvrtak_petak_subota".split("_"),
			weekdaysShort: "ned._pon._uto._sre._čet._pet._sub.".split("_"),
			weekdaysMin: "ne_po_ut_sr_če_pe_su".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm",
				LLLL: "dddd, D. MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[danas u] LT", nextDay: "[sutra u] LT", nextWeek: function () {
					switch (this.day()) {
						case 0:
							return "[u] [nedelju] [u] LT";
						case 3:
							return "[u] [sredu] [u] LT";
						case 6:
							return "[u] [subotu] [u] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[u] dddd [u] LT"
					}
				}, lastDay: "[juče u] LT", lastWeek: function () {
					return ["[prošle] [nedelje] [u] LT", "[prošlog] [ponedeljka] [u] LT", "[prošlog] [utorka] [u] LT", "[prošle] [srede] [u] LT", "[prošlog] [četvrtka] [u] LT", "[prošlog] [petka] [u] LT", "[prošle] [subote] [u] LT"][this.day()]
				}, sameElse: "L"
			},
			relativeTime: {
				future: "za %s",
				past: "pre %s",
				s: "nekoliko sekundi",
				ss: t.translate,
				m: t.translate,
				mm: t.translate,
				h: t.translate,
				hh: t.translate,
				d: "dan",
				dd: t.translate,
				M: "mesec",
				MM: t.translate,
				y: "godinu",
				yy: t.translate
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {
			words: {
				ss: ["секунда", "секунде", "секунди"],
				m: ["један минут", "једне минуте"],
				mm: ["минут", "минуте", "минута"],
				h: ["један сат", "једног сата"],
				hh: ["сат", "сата", "сати"],
				dd: ["дан", "дана", "дана"],
				MM: ["месец", "месеца", "месеци"],
				yy: ["година", "године", "година"]
			}, correctGrammaticalCase: function (e, t) {
				return 1 === e ? t[0] : e >= 2 && e <= 4 ? t[1] : t[2]
			}, translate: function (e, n, r) {
				var i = t.words[r];
				return 1 === r.length ? n ? i[0] : i[1] : e + " " + t.correctGrammaticalCase(e, i)
			}
		};
		e.defineLocale("sr-cyrl", {
			months: "јануар_фебруар_март_април_мај_јун_јул_август_септембар_октобар_новембар_децембар".split("_"),
			monthsShort: "јан._феб._мар._апр._мај_јун_јул_авг._сеп._окт._нов._дец.".split("_"),
			monthsParseExact: !0,
			weekdays: "недеља_понедељак_уторак_среда_четвртак_петак_субота".split("_"),
			weekdaysShort: "нед._пон._уто._сре._чет._пет._суб.".split("_"),
			weekdaysMin: "не_по_ут_ср_че_пе_су".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM YYYY",
				LLL: "D. MMMM YYYY H:mm",
				LLLL: "dddd, D. MMMM YYYY H:mm"
			},
			calendar: {
				sameDay: "[данас у] LT", nextDay: "[сутра у] LT", nextWeek: function () {
					switch (this.day()) {
						case 0:
							return "[у] [недељу] [у] LT";
						case 3:
							return "[у] [среду] [у] LT";
						case 6:
							return "[у] [суботу] [у] LT";
						case 1:
						case 2:
						case 4:
						case 5:
							return "[у] dddd [у] LT"
					}
				}, lastDay: "[јуче у] LT", lastWeek: function () {
					return ["[прошле] [недеље] [у] LT", "[прошлог] [понедељка] [у] LT", "[прошлог] [уторка] [у] LT", "[прошле] [среде] [у] LT", "[прошлог] [четвртка] [у] LT", "[прошлог] [петка] [у] LT", "[прошле] [суботе] [у] LT"][this.day()]
				}, sameElse: "L"
			},
			relativeTime: {
				future: "за %s",
				past: "пре %s",
				s: "неколико секунди",
				ss: t.translate,
				m: t.translate,
				mm: t.translate,
				h: t.translate,
				hh: t.translate,
				d: "дан",
				dd: t.translate,
				M: "месец",
				MM: t.translate,
				y: "годину",
				yy: t.translate
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ss", {
			months: "Bhimbidvwane_Indlovana_Indlov'lenkhulu_Mabasa_Inkhwekhweti_Inhlaba_Kholwane_Ingci_Inyoni_Imphala_Lweti_Ingongoni".split("_"),
			monthsShort: "Bhi_Ina_Inu_Mab_Ink_Inh_Kho_Igc_Iny_Imp_Lwe_Igo".split("_"),
			weekdays: "Lisontfo_Umsombuluko_Lesibili_Lesitsatfu_Lesine_Lesihlanu_Umgcibelo".split("_"),
			weekdaysShort: "Lis_Umb_Lsb_Les_Lsi_Lsh_Umg".split("_"),
			weekdaysMin: "Li_Us_Lb_Lt_Ls_Lh_Ug".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "h:mm A",
				LTS: "h:mm:ss A",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY h:mm A",
				LLLL: "dddd, D MMMM YYYY h:mm A"
			},
			calendar: {
				sameDay: "[Namuhla nga] LT",
				nextDay: "[Kusasa nga] LT",
				nextWeek: "dddd [nga] LT",
				lastDay: "[Itolo nga] LT",
				lastWeek: "dddd [leliphelile] [nga] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "nga %s",
				past: "wenteka nga %s",
				s: "emizuzwana lomcane",
				ss: "%d mzuzwana",
				m: "umzuzu",
				mm: "%d emizuzu",
				h: "lihora",
				hh: "%d emahora",
				d: "lilanga",
				dd: "%d emalanga",
				M: "inyanga",
				MM: "%d tinyanga",
				y: "umnyaka",
				yy: "%d iminyaka"
			},
			meridiemParse: /ekuseni|emini|entsambama|ebusuku/,
			meridiem: function (e, t, n) {
				return e < 11 ? "ekuseni" : e < 15 ? "emini" : e < 19 ? "entsambama" : "ebusuku"
			},
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "ekuseni" === t ? e : "emini" === t ? e >= 11 ? e : e + 12 : "entsambama" === t || "ebusuku" === t ? 0 === e ? 0 : e + 12 : void 0
			},
			dayOfMonthOrdinalParse: /\d{1,2}/,
			ordinal: "%d",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("sv", {
			months: "januari_februari_mars_april_maj_juni_juli_augusti_september_oktober_november_december".split("_"),
			monthsShort: "jan_feb_mar_apr_maj_jun_jul_aug_sep_okt_nov_dec".split("_"),
			weekdays: "söndag_måndag_tisdag_onsdag_torsdag_fredag_lördag".split("_"),
			weekdaysShort: "sön_mån_tis_ons_tor_fre_lör".split("_"),
			weekdaysMin: "sö_må_ti_on_to_fr_lö".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY-MM-DD",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY [kl.] HH:mm",
				LLLL: "dddd D MMMM YYYY [kl.] HH:mm",
				lll: "D MMM YYYY HH:mm",
				llll: "ddd D MMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Idag] LT",
				nextDay: "[Imorgon] LT",
				lastDay: "[Igår] LT",
				nextWeek: "[På] dddd LT",
				lastWeek: "[I] dddd[s] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "om %s",
				past: "för %s sedan",
				s: "några sekunder",
				ss: "%d sekunder",
				m: "en minut",
				mm: "%d minuter",
				h: "en timme",
				hh: "%d timmar",
				d: "en dag",
				dd: "%d dagar",
				M: "en månad",
				MM: "%d månader",
				y: "ett år",
				yy: "%d år"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(e|a)/,
			ordinal: function (e) {
				var t = e % 10;
				return e + (1 == ~~(e % 100 / 10) ? "e" : 1 === t ? "a" : 2 === t ? "a" : "e")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("sw", {
			months: "Januari_Februari_Machi_Aprili_Mei_Juni_Julai_Agosti_Septemba_Oktoba_Novemba_Desemba".split("_"),
			monthsShort: "Jan_Feb_Mac_Apr_Mei_Jun_Jul_Ago_Sep_Okt_Nov_Des".split("_"),
			weekdays: "Jumapili_Jumatatu_Jumanne_Jumatano_Alhamisi_Ijumaa_Jumamosi".split("_"),
			weekdaysShort: "Jpl_Jtat_Jnne_Jtan_Alh_Ijm_Jmos".split("_"),
			weekdaysMin: "J2_J3_J4_J5_Al_Ij_J1".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[leo saa] LT",
				nextDay: "[kesho saa] LT",
				nextWeek: "[wiki ijayo] dddd [saat] LT",
				lastDay: "[jana] LT",
				lastWeek: "[wiki iliyopita] dddd [saat] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s baadaye",
				past: "tokea %s",
				s: "hivi punde",
				ss: "sekunde %d",
				m: "dakika moja",
				mm: "dakika %d",
				h: "saa limoja",
				hh: "masaa %d",
				d: "siku moja",
				dd: "masiku %d",
				M: "mwezi mmoja",
				MM: "miezi %d",
				y: "mwaka mmoja",
				yy: "miaka %d"
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {1: "௧", 2: "௨", 3: "௩", 4: "௪", 5: "௫", 6: "௬", 7: "௭", 8: "௮", 9: "௯", 0: "௦"},
			n = {"௧": "1", "௨": "2", "௩": "3", "௪": "4", "௫": "5", "௬": "6", "௭": "7", "௮": "8", "௯": "9", "௦": "0"};
		e.defineLocale("ta", {
			months: "ஜனவரி_பிப்ரவரி_மார்ச்_ஏப்ரல்_மே_ஜூன்_ஜூலை_ஆகஸ்ட்_செப்டெம்பர்_அக்டோபர்_நவம்பர்_டிசம்பர்".split("_"),
			monthsShort: "ஜனவரி_பிப்ரவரி_மார்ச்_ஏப்ரல்_மே_ஜூன்_ஜூலை_ஆகஸ்ட்_செப்டெம்பர்_அக்டோபர்_நவம்பர்_டிசம்பர்".split("_"),
			weekdays: "ஞாயிற்றுக்கிழமை_திங்கட்கிழமை_செவ்வாய்கிழமை_புதன்கிழமை_வியாழக்கிழமை_வெள்ளிக்கிழமை_சனிக்கிழமை".split("_"),
			weekdaysShort: "ஞாயிறு_திங்கள்_செவ்வாய்_புதன்_வியாழன்_வெள்ளி_சனி".split("_"),
			weekdaysMin: "ஞா_தி_செ_பு_வி_வெ_ச".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, HH:mm",
				LLLL: "dddd, D MMMM YYYY, HH:mm"
			},
			calendar: {
				sameDay: "[இன்று] LT",
				nextDay: "[நாளை] LT",
				nextWeek: "dddd, LT",
				lastDay: "[நேற்று] LT",
				lastWeek: "[கடந்த வாரம்] dddd, LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s இல்",
				past: "%s முன்",
				s: "ஒரு சில விநாடிகள்",
				ss: "%d விநாடிகள்",
				m: "ஒரு நிமிடம்",
				mm: "%d நிமிடங்கள்",
				h: "ஒரு மணி நேரம்",
				hh: "%d மணி நேரம்",
				d: "ஒரு நாள்",
				dd: "%d நாட்கள்",
				M: "ஒரு மாதம்",
				MM: "%d மாதங்கள்",
				y: "ஒரு வருடம்",
				yy: "%d ஆண்டுகள்"
			},
			dayOfMonthOrdinalParse: /\d{1,2}வது/,
			ordinal: function (e) {
				return e + "வது"
			},
			preparse: function (e) {
				return e.replace(/[௧௨௩௪௫௬௭௮௯௦]/g, function (e) {
					return n[e]
				})
			},
			postformat: function (e) {
				return e.replace(/\d/g, function (e) {
					return t[e]
				})
			},
			meridiemParse: /யாமம்|வைகறை|காலை|நண்பகல்|எற்பாடு|மாலை/,
			meridiem: function (e, t, n) {
				return e < 2 ? " யாமம்" : e < 6 ? " வைகறை" : e < 10 ? " காலை" : e < 14 ? " நண்பகல்" : e < 18 ? " எற்பாடு" : e < 22 ? " மாலை" : " யாமம்"
			},
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "யாமம்" === t ? e < 2 ? e : e + 12 : "வைகறை" === t || "காலை" === t ? e : "நண்பகல்" === t && e >= 10 ? e : e + 12
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("te", {
			months: "జనవరి_ఫిబ్రవరి_మార్చి_ఏప్రిల్_మే_జూన్_జూలై_ఆగస్టు_సెప్టెంబర్_అక్టోబర్_నవంబర్_డిసెంబర్".split("_"),
			monthsShort: "జన._ఫిబ్ర._మార్చి_ఏప్రి._మే_జూన్_జూలై_ఆగ._సెప్._అక్టో._నవ._డిసె.".split("_"),
			monthsParseExact: !0,
			weekdays: "ఆదివారం_సోమవారం_మంగళవారం_బుధవారం_గురువారం_శుక్రవారం_శనివారం".split("_"),
			weekdaysShort: "ఆది_సోమ_మంగళ_బుధ_గురు_శుక్ర_శని".split("_"),
			weekdaysMin: "ఆ_సో_మం_బు_గు_శు_శ".split("_"),
			longDateFormat: {
				LT: "A h:mm",
				LTS: "A h:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY, A h:mm",
				LLLL: "dddd, D MMMM YYYY, A h:mm"
			},
			calendar: {
				sameDay: "[నేడు] LT",
				nextDay: "[రేపు] LT",
				nextWeek: "dddd, LT",
				lastDay: "[నిన్న] LT",
				lastWeek: "[గత] dddd, LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s లో",
				past: "%s క్రితం",
				s: "కొన్ని క్షణాలు",
				ss: "%d సెకన్లు",
				m: "ఒక నిమిషం",
				mm: "%d నిమిషాలు",
				h: "ఒక గంట",
				hh: "%d గంటలు",
				d: "ఒక రోజు",
				dd: "%d రోజులు",
				M: "ఒక నెల",
				MM: "%d నెలలు",
				y: "ఒక సంవత్సరం",
				yy: "%d సంవత్సరాలు"
			},
			dayOfMonthOrdinalParse: /\d{1,2}వ/,
			ordinal: "%dవ",
			meridiemParse: /రాత్రి|ఉదయం|మధ్యాహ్నం|సాయంత్రం/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "రాత్రి" === t ? e < 4 ? e : e + 12 : "ఉదయం" === t ? e : "మధ్యాహ్నం" === t ? e >= 10 ? e : e + 12 : "సాయంత్రం" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "రాత్రి" : e < 10 ? "ఉదయం" : e < 17 ? "మధ్యాహ్నం" : e < 20 ? "సాయంత్రం" : "రాత్రి"
			},
			week: {dow: 0, doy: 6}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("tet", {
			months: "Janeiru_Fevereiru_Marsu_Abril_Maiu_Juñu_Jullu_Agustu_Setembru_Outubru_Novembru_Dezembru".split("_"),
			monthsShort: "Jan_Fev_Mar_Abr_Mai_Jun_Jul_Ago_Set_Out_Nov_Dez".split("_"),
			weekdays: "Domingu_Segunda_Tersa_Kuarta_Kinta_Sesta_Sabadu".split("_"),
			weekdaysShort: "Dom_Seg_Ters_Kua_Kint_Sest_Sab".split("_"),
			weekdaysMin: "Do_Seg_Te_Ku_Ki_Ses_Sa".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Ohin iha] LT",
				nextDay: "[Aban iha] LT",
				nextWeek: "dddd [iha] LT",
				lastDay: "[Horiseik iha] LT",
				lastWeek: "dddd [semana kotuk] [iha] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "iha %s",
				past: "%s liuba",
				s: "minutu balun",
				ss: "minutu %d",
				m: "minutu ida",
				mm: "minutu %d",
				h: "oras ida",
				hh: "oras %d",
				d: "loron ida",
				dd: "loron %d",
				M: "fulan ida",
				MM: "fulan %d",
				y: "tinan ida",
				yy: "tinan %d"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
			ordinal: function (e) {
				var t = e % 10;
				return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {
			0: "-ум",
			1: "-ум",
			2: "-юм",
			3: "-юм",
			4: "-ум",
			5: "-ум",
			6: "-ум",
			7: "-ум",
			8: "-ум",
			9: "-ум",
			10: "-ум",
			12: "-ум",
			13: "-ум",
			20: "-ум",
			30: "-юм",
			40: "-ум",
			50: "-ум",
			60: "-ум",
			70: "-ум",
			80: "-ум",
			90: "-ум",
			100: "-ум"
		};
		e.defineLocale("tg", {
			months: "январ_феврал_март_апрел_май_июн_июл_август_сентябр_октябр_ноябр_декабр".split("_"),
			monthsShort: "янв_фев_мар_апр_май_июн_июл_авг_сен_окт_ноя_дек".split("_"),
			weekdays: "якшанбе_душанбе_сешанбе_чоршанбе_панҷшанбе_ҷумъа_шанбе".split("_"),
			weekdaysShort: "яшб_дшб_сшб_чшб_пшб_ҷум_шнб".split("_"),
			weekdaysMin: "яш_дш_сш_чш_пш_ҷм_шб".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Имрӯз соати] LT",
				nextDay: "[Пагоҳ соати] LT",
				lastDay: "[Дирӯз соати] LT",
				nextWeek: "dddd[и] [ҳафтаи оянда соати] LT",
				lastWeek: "dddd[и] [ҳафтаи гузашта соати] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "баъди %s",
				past: "%s пеш",
				s: "якчанд сония",
				m: "як дақиқа",
				mm: "%d дақиқа",
				h: "як соат",
				hh: "%d соат",
				d: "як рӯз",
				dd: "%d рӯз",
				M: "як моҳ",
				MM: "%d моҳ",
				y: "як сол",
				yy: "%d сол"
			},
			meridiemParse: /шаб|субҳ|рӯз|бегоҳ/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "шаб" === t ? e < 4 ? e : e + 12 : "субҳ" === t ? e : "рӯз" === t ? e >= 11 ? e : e + 12 : "бегоҳ" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "шаб" : e < 11 ? "субҳ" : e < 16 ? "рӯз" : e < 19 ? "бегоҳ" : "шаб"
			},
			dayOfMonthOrdinalParse: /\d{1,2}-(ум|юм)/,
			ordinal: function (e) {
				return e + (t[e] || t[e % 10] || t[e >= 100 ? 100 : null])
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("th", {
			months: "มกราคม_กุมภาพันธ์_มีนาคม_เมษายน_พฤษภาคม_มิถุนายน_กรกฎาคม_สิงหาคม_กันยายน_ตุลาคม_พฤศจิกายน_ธันวาคม".split("_"),
			monthsShort: "ม.ค._ก.พ._มี.ค._เม.ย._พ.ค._มิ.ย._ก.ค._ส.ค._ก.ย._ต.ค._พ.ย._ธ.ค.".split("_"),
			monthsParseExact: !0,
			weekdays: "อาทิตย์_จันทร์_อังคาร_พุธ_พฤหัสบดี_ศุกร์_เสาร์".split("_"),
			weekdaysShort: "อาทิตย์_จันทร์_อังคาร_พุธ_พฤหัส_ศุกร์_เสาร์".split("_"),
			weekdaysMin: "อา._จ._อ._พ._พฤ._ศ._ส.".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "H:mm",
				LTS: "H:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY เวลา H:mm",
				LLLL: "วันddddที่ D MMMM YYYY เวลา H:mm"
			},
			meridiemParse: /ก่อนเที่ยง|หลังเที่ยง/,
			isPM: function (e) {
				return "หลังเที่ยง" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "ก่อนเที่ยง" : "หลังเที่ยง"
			},
			calendar: {
				sameDay: "[วันนี้ เวลา] LT",
				nextDay: "[พรุ่งนี้ เวลา] LT",
				nextWeek: "dddd[หน้า เวลา] LT",
				lastDay: "[เมื่อวานนี้ เวลา] LT",
				lastWeek: "[วัน]dddd[ที่แล้ว เวลา] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "อีก %s",
				past: "%sที่แล้ว",
				s: "ไม่กี่วินาที",
				ss: "%d วินาที",
				m: "1 นาที",
				mm: "%d นาที",
				h: "1 ชั่วโมง",
				hh: "%d ชั่วโมง",
				d: "1 วัน",
				dd: "%d วัน",
				M: "1 เดือน",
				MM: "%d เดือน",
				y: "1 ปี",
				yy: "%d ปี"
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("tl-ph", {
			months: "Enero_Pebrero_Marso_Abril_Mayo_Hunyo_Hulyo_Agosto_Setyembre_Oktubre_Nobyembre_Disyembre".split("_"),
			monthsShort: "Ene_Peb_Mar_Abr_May_Hun_Hul_Ago_Set_Okt_Nob_Dis".split("_"),
			weekdays: "Linggo_Lunes_Martes_Miyerkules_Huwebes_Biyernes_Sabado".split("_"),
			weekdaysShort: "Lin_Lun_Mar_Miy_Huw_Biy_Sab".split("_"),
			weekdaysMin: "Li_Lu_Ma_Mi_Hu_Bi_Sab".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "MM/D/YYYY",
				LL: "MMMM D, YYYY",
				LLL: "MMMM D, YYYY HH:mm",
				LLLL: "dddd, MMMM DD, YYYY HH:mm"
			},
			calendar: {
				sameDay: "LT [ngayong araw]",
				nextDay: "[Bukas ng] LT",
				nextWeek: "LT [sa susunod na] dddd",
				lastDay: "LT [kahapon]",
				lastWeek: "LT [noong nakaraang] dddd",
				sameElse: "L"
			},
			relativeTime: {
				future: "sa loob ng %s",
				past: "%s ang nakalipas",
				s: "ilang segundo",
				ss: "%d segundo",
				m: "isang minuto",
				mm: "%d minuto",
				h: "isang oras",
				hh: "%d oras",
				d: "isang araw",
				dd: "%d araw",
				M: "isang buwan",
				MM: "%d buwan",
				y: "isang taon",
				yy: "%d taon"
			},
			dayOfMonthOrdinalParse: /\d{1,2}/,
			ordinal: function (e) {
				return e
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = "pagh_wa’_cha’_wej_loS_vagh_jav_Soch_chorgh_Hut".split("_");

		function n(e, n, r, i) {
			var a = function (e) {
				var n = Math.floor(e % 1e3 / 100), r = Math.floor(e % 100 / 10), i = e % 10, a = "";
				n > 0 && (a += t[n] + "vatlh");
				r > 0 && (a += ("" !== a ? " " : "") + t[r] + "maH");
				i > 0 && (a += ("" !== a ? " " : "") + t[i]);
				return "" === a ? "pagh" : a
			}(e);
			switch (r) {
				case"ss":
					return a + " lup";
				case"mm":
					return a + " tup";
				case"hh":
					return a + " rep";
				case"dd":
					return a + " jaj";
				case"MM":
					return a + " jar";
				case"yy":
					return a + " DIS"
			}
		}

		e.defineLocale("tlh", {
			months: "tera’ jar wa’_tera’ jar cha’_tera’ jar wej_tera’ jar loS_tera’ jar vagh_tera’ jar jav_tera’ jar Soch_tera’ jar chorgh_tera’ jar Hut_tera’ jar wa’maH_tera’ jar wa’maH wa’_tera’ jar wa’maH cha’".split("_"),
			monthsShort: "jar wa’_jar cha’_jar wej_jar loS_jar vagh_jar jav_jar Soch_jar chorgh_jar Hut_jar wa’maH_jar wa’maH wa’_jar wa’maH cha’".split("_"),
			monthsParseExact: !0,
			weekdays: "lojmItjaj_DaSjaj_povjaj_ghItlhjaj_loghjaj_buqjaj_ghInjaj".split("_"),
			weekdaysShort: "lojmItjaj_DaSjaj_povjaj_ghItlhjaj_loghjaj_buqjaj_ghInjaj".split("_"),
			weekdaysMin: "lojmItjaj_DaSjaj_povjaj_ghItlhjaj_loghjaj_buqjaj_ghInjaj".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[DaHjaj] LT",
				nextDay: "[wa’leS] LT",
				nextWeek: "LLL",
				lastDay: "[wa’Hu’] LT",
				lastWeek: "LLL",
				sameElse: "L"
			},
			relativeTime: {
				future: function (e) {
					var t = e;
					return t = -1 !== e.indexOf("jaj") ? t.slice(0, -3) + "leS" : -1 !== e.indexOf("jar") ? t.slice(0, -3) + "waQ" : -1 !== e.indexOf("DIS") ? t.slice(0, -3) + "nem" : t + " pIq"
				},
				past: function (e) {
					var t = e;
					return t = -1 !== e.indexOf("jaj") ? t.slice(0, -3) + "Hu’" : -1 !== e.indexOf("jar") ? t.slice(0, -3) + "wen" : -1 !== e.indexOf("DIS") ? t.slice(0, -3) + "ben" : t + " ret"
				},
				s: "puS lup",
				ss: n,
				m: "wa’ tup",
				mm: n,
				h: "wa’ rep",
				hh: n,
				d: "wa’ jaj",
				dd: n,
				M: "wa’ jar",
				MM: n,
				y: "wa’ DIS",
				yy: n
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = {
			1: "'inci",
			5: "'inci",
			8: "'inci",
			70: "'inci",
			80: "'inci",
			2: "'nci",
			7: "'nci",
			20: "'nci",
			50: "'nci",
			3: "'üncü",
			4: "'üncü",
			100: "'üncü",
			6: "'ncı",
			9: "'uncu",
			10: "'uncu",
			30: "'uncu",
			60: "'ıncı",
			90: "'ıncı"
		};
		e.defineLocale("tr", {
			months: "Ocak_Şubat_Mart_Nisan_Mayıs_Haziran_Temmuz_Ağustos_Eylül_Ekim_Kasım_Aralık".split("_"),
			monthsShort: "Oca_Şub_Mar_Nis_May_Haz_Tem_Ağu_Eyl_Eki_Kas_Ara".split("_"),
			weekdays: "Pazar_Pazartesi_Salı_Çarşamba_Perşembe_Cuma_Cumartesi".split("_"),
			weekdaysShort: "Paz_Pts_Sal_Çar_Per_Cum_Cts".split("_"),
			weekdaysMin: "Pz_Pt_Sa_Ça_Pe_Cu_Ct".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[bugün saat] LT",
				nextDay: "[yarın saat] LT",
				nextWeek: "[gelecek] dddd [saat] LT",
				lastDay: "[dün] LT",
				lastWeek: "[geçen] dddd [saat] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s sonra",
				past: "%s önce",
				s: "birkaç saniye",
				ss: "%d saniye",
				m: "bir dakika",
				mm: "%d dakika",
				h: "bir saat",
				hh: "%d saat",
				d: "bir gün",
				dd: "%d gün",
				M: "bir ay",
				MM: "%d ay",
				y: "bir yıl",
				yy: "%d yıl"
			},
			ordinal: function (e, n) {
				switch (n) {
					case"d":
					case"D":
					case"Do":
					case"DD":
						return e;
					default:
						if (0 === e) return e + "'ıncı";
						var r = e % 10;
						return e + (t[r] || t[e % 100 - r] || t[e >= 100 ? 100 : null])
				}
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n, r) {
			var i = {
				s: ["viensas secunds", "'iensas secunds"],
				ss: [e + " secunds", e + " secunds"],
				m: ["'n míut", "'iens míut"],
				mm: [e + " míuts", e + " míuts"],
				h: ["'n þora", "'iensa þora"],
				hh: [e + " þoras", e + " þoras"],
				d: ["'n ziua", "'iensa ziua"],
				dd: [e + " ziuas", e + " ziuas"],
				M: ["'n mes", "'iens mes"],
				MM: [e + " mesen", e + " mesen"],
				y: ["'n ar", "'iens ar"],
				yy: [e + " ars", e + " ars"]
			};
			return r ? i[n][0] : t ? i[n][0] : i[n][1]
		}

		e.defineLocale("tzl", {
			months: "Januar_Fevraglh_Març_Avrïu_Mai_Gün_Julia_Guscht_Setemvar_Listopäts_Noemvar_Zecemvar".split("_"),
			monthsShort: "Jan_Fev_Mar_Avr_Mai_Gün_Jul_Gus_Set_Lis_Noe_Zec".split("_"),
			weekdays: "Súladi_Lúneçi_Maitzi_Márcuri_Xhúadi_Viénerçi_Sáturi".split("_"),
			weekdaysShort: "Súl_Lún_Mai_Már_Xhú_Vié_Sát".split("_"),
			weekdaysMin: "Sú_Lú_Ma_Má_Xh_Vi_Sá".split("_"),
			longDateFormat: {
				LT: "HH.mm",
				LTS: "HH.mm.ss",
				L: "DD.MM.YYYY",
				LL: "D. MMMM [dallas] YYYY",
				LLL: "D. MMMM [dallas] YYYY HH.mm",
				LLLL: "dddd, [li] D. MMMM [dallas] YYYY HH.mm"
			},
			meridiemParse: /d\'o|d\'a/i,
			isPM: function (e) {
				return "d'o" === e.toLowerCase()
			},
			meridiem: function (e, t, n) {
				return e > 11 ? n ? "d'o" : "D'O" : n ? "d'a" : "D'A"
			},
			calendar: {
				sameDay: "[oxhi à] LT",
				nextDay: "[demà à] LT",
				nextWeek: "dddd [à] LT",
				lastDay: "[ieiri à] LT",
				lastWeek: "[sür el] dddd [lasteu à] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "osprei %s",
				past: "ja%s",
				s: t,
				ss: t,
				m: t,
				mm: t,
				h: t,
				hh: t,
				d: t,
				dd: t,
				M: t,
				MM: t,
				y: t,
				yy: t
			},
			dayOfMonthOrdinalParse: /\d{1,2}\./,
			ordinal: "%d.",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("tzm", {
			months: "ⵉⵏⵏⴰⵢⵔ_ⴱⵕⴰⵢⵕ_ⵎⴰⵕⵚ_ⵉⴱⵔⵉⵔ_ⵎⴰⵢⵢⵓ_ⵢⵓⵏⵢⵓ_ⵢⵓⵍⵢⵓⵣ_ⵖⵓⵛⵜ_ⵛⵓⵜⴰⵏⴱⵉⵔ_ⴽⵟⵓⴱⵕ_ⵏⵓⵡⴰⵏⴱⵉⵔ_ⴷⵓⵊⵏⴱⵉⵔ".split("_"),
			monthsShort: "ⵉⵏⵏⴰⵢⵔ_ⴱⵕⴰⵢⵕ_ⵎⴰⵕⵚ_ⵉⴱⵔⵉⵔ_ⵎⴰⵢⵢⵓ_ⵢⵓⵏⵢⵓ_ⵢⵓⵍⵢⵓⵣ_ⵖⵓⵛⵜ_ⵛⵓⵜⴰⵏⴱⵉⵔ_ⴽⵟⵓⴱⵕ_ⵏⵓⵡⴰⵏⴱⵉⵔ_ⴷⵓⵊⵏⴱⵉⵔ".split("_"),
			weekdays: "ⴰⵙⴰⵎⴰⵙ_ⴰⵢⵏⴰⵙ_ⴰⵙⵉⵏⴰⵙ_ⴰⴽⵔⴰⵙ_ⴰⴽⵡⴰⵙ_ⴰⵙⵉⵎⵡⴰⵙ_ⴰⵙⵉⴹⵢⴰⵙ".split("_"),
			weekdaysShort: "ⴰⵙⴰⵎⴰⵙ_ⴰⵢⵏⴰⵙ_ⴰⵙⵉⵏⴰⵙ_ⴰⴽⵔⴰⵙ_ⴰⴽⵡⴰⵙ_ⴰⵙⵉⵎⵡⴰⵙ_ⴰⵙⵉⴹⵢⴰⵙ".split("_"),
			weekdaysMin: "ⴰⵙⴰⵎⴰⵙ_ⴰⵢⵏⴰⵙ_ⴰⵙⵉⵏⴰⵙ_ⴰⴽⵔⴰⵙ_ⴰⴽⵡⴰⵙ_ⴰⵙⵉⵎⵡⴰⵙ_ⴰⵙⵉⴹⵢⴰⵙ".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[ⴰⵙⴷⵅ ⴴ] LT",
				nextDay: "[ⴰⵙⴽⴰ ⴴ] LT",
				nextWeek: "dddd [ⴴ] LT",
				lastDay: "[ⴰⵚⴰⵏⵜ ⴴ] LT",
				lastWeek: "dddd [ⴴ] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "ⴷⴰⴷⵅ ⵙ ⵢⴰⵏ %s",
				past: "ⵢⴰⵏ %s",
				s: "ⵉⵎⵉⴽ",
				ss: "%d ⵉⵎⵉⴽ",
				m: "ⵎⵉⵏⵓⴺ",
				mm: "%d ⵎⵉⵏⵓⴺ",
				h: "ⵙⴰⵄⴰ",
				hh: "%d ⵜⴰⵙⵙⴰⵄⵉⵏ",
				d: "ⴰⵙⵙ",
				dd: "%d oⵙⵙⴰⵏ",
				M: "ⴰⵢoⵓⵔ",
				MM: "%d ⵉⵢⵢⵉⵔⵏ",
				y: "ⴰⵙⴳⴰⵙ",
				yy: "%d ⵉⵙⴳⴰⵙⵏ"
			},
			week: {dow: 6, doy: 12}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("tzm-latn", {
			months: "innayr_brˤayrˤ_marˤsˤ_ibrir_mayyw_ywnyw_ywlywz_ɣwšt_šwtanbir_ktˤwbrˤ_nwwanbir_dwjnbir".split("_"),
			monthsShort: "innayr_brˤayrˤ_marˤsˤ_ibrir_mayyw_ywnyw_ywlywz_ɣwšt_šwtanbir_ktˤwbrˤ_nwwanbir_dwjnbir".split("_"),
			weekdays: "asamas_aynas_asinas_akras_akwas_asimwas_asiḍyas".split("_"),
			weekdaysShort: "asamas_aynas_asinas_akras_akwas_asimwas_asiḍyas".split("_"),
			weekdaysMin: "asamas_aynas_asinas_akras_akwas_asimwas_asiḍyas".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[asdkh g] LT",
				nextDay: "[aska g] LT",
				nextWeek: "dddd [g] LT",
				lastDay: "[assant g] LT",
				lastWeek: "dddd [g] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "dadkh s yan %s",
				past: "yan %s",
				s: "imik",
				ss: "%d imik",
				m: "minuḍ",
				mm: "%d minuḍ",
				h: "saɛa",
				hh: "%d tassaɛin",
				d: "ass",
				dd: "%d ossan",
				M: "ayowr",
				MM: "%d iyyirn",
				y: "asgas",
				yy: "%d isgasn"
			},
			week: {dow: 6, doy: 12}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("ug-cn", {
			months: "يانۋار_فېۋرال_مارت_ئاپرېل_ماي_ئىيۇن_ئىيۇل_ئاۋغۇست_سېنتەبىر_ئۆكتەبىر_نويابىر_دېكابىر".split("_"),
			monthsShort: "يانۋار_فېۋرال_مارت_ئاپرېل_ماي_ئىيۇن_ئىيۇل_ئاۋغۇست_سېنتەبىر_ئۆكتەبىر_نويابىر_دېكابىر".split("_"),
			weekdays: "يەكشەنبە_دۈشەنبە_سەيشەنبە_چارشەنبە_پەيشەنبە_جۈمە_شەنبە".split("_"),
			weekdaysShort: "يە_دۈ_سە_چا_پە_جۈ_شە".split("_"),
			weekdaysMin: "يە_دۈ_سە_چا_پە_جۈ_شە".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY-MM-DD",
				LL: "YYYY-يىلىM-ئاينىڭD-كۈنى",
				LLL: "YYYY-يىلىM-ئاينىڭD-كۈنى، HH:mm",
				LLLL: "dddd، YYYY-يىلىM-ئاينىڭD-كۈنى، HH:mm"
			},
			meridiemParse: /يېرىم كېچە|سەھەر|چۈشتىن بۇرۇن|چۈش|چۈشتىن كېيىن|كەچ/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "يېرىم كېچە" === t || "سەھەر" === t || "چۈشتىن بۇرۇن" === t ? e : "چۈشتىن كېيىن" === t || "كەچ" === t ? e + 12 : e >= 11 ? e : e + 12
			},
			meridiem: function (e, t, n) {
				var r = 100 * e + t;
				return r < 600 ? "يېرىم كېچە" : r < 900 ? "سەھەر" : r < 1130 ? "چۈشتىن بۇرۇن" : r < 1230 ? "چۈش" : r < 1800 ? "چۈشتىن كېيىن" : "كەچ"
			},
			calendar: {
				sameDay: "[بۈگۈن سائەت] LT",
				nextDay: "[ئەتە سائەت] LT",
				nextWeek: "[كېلەركى] dddd [سائەت] LT",
				lastDay: "[تۆنۈگۈن] LT",
				lastWeek: "[ئالدىنقى] dddd [سائەت] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s كېيىن",
				past: "%s بۇرۇن",
				s: "نەچچە سېكونت",
				ss: "%d سېكونت",
				m: "بىر مىنۇت",
				mm: "%d مىنۇت",
				h: "بىر سائەت",
				hh: "%d سائەت",
				d: "بىر كۈن",
				dd: "%d كۈن",
				M: "بىر ئاي",
				MM: "%d ئاي",
				y: "بىر يىل",
				yy: "%d يىل"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(-كۈنى|-ئاي|-ھەپتە)/,
			ordinal: function (e, t) {
				switch (t) {
					case"d":
					case"D":
					case"DDD":
						return e + "-كۈنى";
					case"w":
					case"W":
						return e + "-ھەپتە";
					default:
						return e
				}
			},
			preparse: function (e) {
				return e.replace(/،/g, ",")
			},
			postformat: function (e) {
				return e.replace(/,/g, "،")
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";

		function t(e, t, n) {
			var r, i;
			return "m" === n ? t ? "хвилина" : "хвилину" : "h" === n ? t ? "година" : "годину" : e + " " + (r = +e, i = {
				ss: t ? "секунда_секунди_секунд" : "секунду_секунди_секунд",
				mm: t ? "хвилина_хвилини_хвилин" : "хвилину_хвилини_хвилин",
				hh: t ? "година_години_годин" : "годину_години_годин",
				dd: "день_дні_днів",
				MM: "місяць_місяці_місяців",
				yy: "рік_роки_років"
			}[n].split("_"), r % 10 == 1 && r % 100 != 11 ? i[0] : r % 10 >= 2 && r % 10 <= 4 && (r % 100 < 10 || r % 100 >= 20) ? i[1] : i[2])
		}

		function n(e) {
			return function () {
				return e + "о" + (11 === this.hours() ? "б" : "") + "] LT"
			}
		}

		e.defineLocale("uk", {
			months: {
				format: "січня_лютого_березня_квітня_травня_червня_липня_серпня_вересня_жовтня_листопада_грудня".split("_"),
				standalone: "січень_лютий_березень_квітень_травень_червень_липень_серпень_вересень_жовтень_листопад_грудень".split("_")
			},
			monthsShort: "січ_лют_бер_квіт_трав_черв_лип_серп_вер_жовт_лист_груд".split("_"),
			weekdays: function (e, t) {
				var n = {
					nominative: "неділя_понеділок_вівторок_середа_четвер_п’ятниця_субота".split("_"),
					accusative: "неділю_понеділок_вівторок_середу_четвер_п’ятницю_суботу".split("_"),
					genitive: "неділі_понеділка_вівторка_середи_четверга_п’ятниці_суботи".split("_")
				};
				return e ? n[/(\[[ВвУу]\]) ?dddd/.test(t) ? "accusative" : /\[?(?:минулої|наступної)? ?\] ?dddd/.test(t) ? "genitive" : "nominative"][e.day()] : n.nominative
			},
			weekdaysShort: "нд_пн_вт_ср_чт_пт_сб".split("_"),
			weekdaysMin: "нд_пн_вт_ср_чт_пт_сб".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD.MM.YYYY",
				LL: "D MMMM YYYY р.",
				LLL: "D MMMM YYYY р., HH:mm",
				LLLL: "dddd, D MMMM YYYY р., HH:mm"
			},
			calendar: {
				sameDay: n("[Сьогодні "),
				nextDay: n("[Завтра "),
				lastDay: n("[Вчора "),
				nextWeek: n("[У] dddd ["),
				lastWeek: function () {
					switch (this.day()) {
						case 0:
						case 3:
						case 5:
						case 6:
							return n("[Минулої] dddd [").call(this);
						case 1:
						case 2:
						case 4:
							return n("[Минулого] dddd [").call(this)
					}
				},
				sameElse: "L"
			},
			relativeTime: {
				future: "за %s",
				past: "%s тому",
				s: "декілька секунд",
				ss: t,
				m: t,
				mm: t,
				h: "годину",
				hh: t,
				d: "день",
				dd: t,
				M: "місяць",
				MM: t,
				y: "рік",
				yy: t
			},
			meridiemParse: /ночі|ранку|дня|вечора/,
			isPM: function (e) {
				return /^(дня|вечора)$/.test(e)
			},
			meridiem: function (e, t, n) {
				return e < 4 ? "ночі" : e < 12 ? "ранку" : e < 17 ? "дня" : "вечора"
			},
			dayOfMonthOrdinalParse: /\d{1,2}-(й|го)/,
			ordinal: function (e, t) {
				switch (t) {
					case"M":
					case"d":
					case"DDD":
					case"w":
					case"W":
						return e + "-й";
					case"D":
						return e + "-го";
					default:
						return e
				}
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		var t = ["جنوری", "فروری", "مارچ", "اپریل", "مئی", "جون", "جولائی", "اگست", "ستمبر", "اکتوبر", "نومبر", "دسمبر"],
			n = ["اتوار", "پیر", "منگل", "بدھ", "جمعرات", "جمعہ", "ہفتہ"];
		e.defineLocale("ur", {
			months: t,
			monthsShort: t,
			weekdays: n,
			weekdaysShort: n,
			weekdaysMin: n,
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd، D MMMM YYYY HH:mm"
			},
			meridiemParse: /صبح|شام/,
			isPM: function (e) {
				return "شام" === e
			},
			meridiem: function (e, t, n) {
				return e < 12 ? "صبح" : "شام"
			},
			calendar: {
				sameDay: "[آج بوقت] LT",
				nextDay: "[کل بوقت] LT",
				nextWeek: "dddd [بوقت] LT",
				lastDay: "[گذشتہ روز بوقت] LT",
				lastWeek: "[گذشتہ] dddd [بوقت] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s بعد",
				past: "%s قبل",
				s: "چند سیکنڈ",
				ss: "%d سیکنڈ",
				m: "ایک منٹ",
				mm: "%d منٹ",
				h: "ایک گھنٹہ",
				hh: "%d گھنٹے",
				d: "ایک دن",
				dd: "%d دن",
				M: "ایک ماہ",
				MM: "%d ماہ",
				y: "ایک سال",
				yy: "%d سال"
			},
			preparse: function (e) {
				return e.replace(/،/g, ",")
			},
			postformat: function (e) {
				return e.replace(/,/g, "،")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("uz", {
			months: "январ_феврал_март_апрел_май_июн_июл_август_сентябр_октябр_ноябр_декабр".split("_"),
			monthsShort: "янв_фев_мар_апр_май_июн_июл_авг_сен_окт_ноя_дек".split("_"),
			weekdays: "Якшанба_Душанба_Сешанба_Чоршанба_Пайшанба_Жума_Шанба".split("_"),
			weekdaysShort: "Якш_Душ_Сеш_Чор_Пай_Жум_Шан".split("_"),
			weekdaysMin: "Як_Ду_Се_Чо_Па_Жу_Ша".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "D MMMM YYYY, dddd HH:mm"
			},
			calendar: {
				sameDay: "[Бугун соат] LT [да]",
				nextDay: "[Эртага] LT [да]",
				nextWeek: "dddd [куни соат] LT [да]",
				lastDay: "[Кеча соат] LT [да]",
				lastWeek: "[Утган] dddd [куни соат] LT [да]",
				sameElse: "L"
			},
			relativeTime: {
				future: "Якин %s ичида",
				past: "Бир неча %s олдин",
				s: "фурсат",
				ss: "%d фурсат",
				m: "бир дакика",
				mm: "%d дакика",
				h: "бир соат",
				hh: "%d соат",
				d: "бир кун",
				dd: "%d кун",
				M: "бир ой",
				MM: "%d ой",
				y: "бир йил",
				yy: "%d йил"
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("uz-latn", {
			months: "Yanvar_Fevral_Mart_Aprel_May_Iyun_Iyul_Avgust_Sentabr_Oktabr_Noyabr_Dekabr".split("_"),
			monthsShort: "Yan_Fev_Mar_Apr_May_Iyun_Iyul_Avg_Sen_Okt_Noy_Dek".split("_"),
			weekdays: "Yakshanba_Dushanba_Seshanba_Chorshanba_Payshanba_Juma_Shanba".split("_"),
			weekdaysShort: "Yak_Dush_Sesh_Chor_Pay_Jum_Shan".split("_"),
			weekdaysMin: "Ya_Du_Se_Cho_Pa_Ju_Sha".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "D MMMM YYYY, dddd HH:mm"
			},
			calendar: {
				sameDay: "[Bugun soat] LT [da]",
				nextDay: "[Ertaga] LT [da]",
				nextWeek: "dddd [kuni soat] LT [da]",
				lastDay: "[Kecha soat] LT [da]",
				lastWeek: "[O'tgan] dddd [kuni soat] LT [da]",
				sameElse: "L"
			},
			relativeTime: {
				future: "Yaqin %s ichida",
				past: "Bir necha %s oldin",
				s: "soniya",
				ss: "%d soniya",
				m: "bir daqiqa",
				mm: "%d daqiqa",
				h: "bir soat",
				hh: "%d soat",
				d: "bir kun",
				dd: "%d kun",
				M: "bir oy",
				MM: "%d oy",
				y: "bir yil",
				yy: "%d yil"
			},
			week: {dow: 1, doy: 7}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("vi", {
			months: "tháng 1_tháng 2_tháng 3_tháng 4_tháng 5_tháng 6_tháng 7_tháng 8_tháng 9_tháng 10_tháng 11_tháng 12".split("_"),
			monthsShort: "Th01_Th02_Th03_Th04_Th05_Th06_Th07_Th08_Th09_Th10_Th11_Th12".split("_"),
			monthsParseExact: !0,
			weekdays: "chủ nhật_thứ hai_thứ ba_thứ tư_thứ năm_thứ sáu_thứ bảy".split("_"),
			weekdaysShort: "CN_T2_T3_T4_T5_T6_T7".split("_"),
			weekdaysMin: "CN_T2_T3_T4_T5_T6_T7".split("_"),
			weekdaysParseExact: !0,
			meridiemParse: /sa|ch/i,
			isPM: function (e) {
				return /^ch$/i.test(e)
			},
			meridiem: function (e, t, n) {
				return e < 12 ? n ? "sa" : "SA" : n ? "ch" : "CH"
			},
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "DD/MM/YYYY",
				LL: "D MMMM [năm] YYYY",
				LLL: "D MMMM [năm] YYYY HH:mm",
				LLLL: "dddd, D MMMM [năm] YYYY HH:mm",
				l: "DD/M/YYYY",
				ll: "D MMM YYYY",
				lll: "D MMM YYYY HH:mm",
				llll: "ddd, D MMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[Hôm nay lúc] LT",
				nextDay: "[Ngày mai lúc] LT",
				nextWeek: "dddd [tuần tới lúc] LT",
				lastDay: "[Hôm qua lúc] LT",
				lastWeek: "dddd [tuần rồi lúc] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "%s tới",
				past: "%s trước",
				s: "vài giây",
				ss: "%d giây",
				m: "một phút",
				mm: "%d phút",
				h: "một giờ",
				hh: "%d giờ",
				d: "một ngày",
				dd: "%d ngày",
				M: "một tháng",
				MM: "%d tháng",
				y: "một năm",
				yy: "%d năm"
			},
			dayOfMonthOrdinalParse: /\d{1,2}/,
			ordinal: function (e) {
				return e
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("x-pseudo", {
			months: "J~áñúá~rý_F~ébrú~árý_~Márc~h_Áp~ríl_~Máý_~Júñé~_Júl~ý_Áú~gúst~_Sép~témb~ér_Ó~ctób~ér_Ñ~óvém~bér_~Décé~mbér".split("_"),
			monthsShort: "J~áñ_~Féb_~Már_~Ápr_~Máý_~Júñ_~Júl_~Áúg_~Sép_~Óct_~Ñóv_~Déc".split("_"),
			monthsParseExact: !0,
			weekdays: "S~úñdá~ý_Mó~ñdáý~_Túé~sdáý~_Wéd~ñésd~áý_T~húrs~dáý_~Fríd~áý_S~átúr~dáý".split("_"),
			weekdaysShort: "S~úñ_~Móñ_~Túé_~Wéd_~Thú_~Frí_~Sát".split("_"),
			weekdaysMin: "S~ú_Mó~_Tú_~Wé_T~h_Fr~_Sá".split("_"),
			weekdaysParseExact: !0,
			longDateFormat: {
				LT: "HH:mm",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY HH:mm",
				LLLL: "dddd, D MMMM YYYY HH:mm"
			},
			calendar: {
				sameDay: "[T~ódá~ý át] LT",
				nextDay: "[T~ómó~rró~w át] LT",
				nextWeek: "dddd [át] LT",
				lastDay: "[Ý~ést~érdá~ý át] LT",
				lastWeek: "[L~ást] dddd [át] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "í~ñ %s",
				past: "%s á~gó",
				s: "á ~féw ~sécó~ñds",
				ss: "%d s~écóñ~ds",
				m: "á ~míñ~úté",
				mm: "%d m~íñú~tés",
				h: "á~ñ hó~úr",
				hh: "%d h~óúrs",
				d: "á ~dáý",
				dd: "%d d~áýs",
				M: "á ~móñ~th",
				MM: "%d m~óñt~hs",
				y: "á ~ýéár",
				yy: "%d ý~éárs"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/,
			ordinal: function (e) {
				var t = e % 10;
				return e + (1 == ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th")
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("yo", {
			months: "Sẹ́rẹ́_Èrèlè_Ẹrẹ̀nà_Ìgbé_Èbibi_Òkùdu_Agẹmo_Ògún_Owewe_Ọ̀wàrà_Bélú_Ọ̀pẹ̀̀".split("_"),
			monthsShort: "Sẹ́r_Èrl_Ẹrn_Ìgb_Èbi_Òkù_Agẹ_Ògú_Owe_Ọ̀wà_Bél_Ọ̀pẹ̀̀".split("_"),
			weekdays: "Àìkú_Ajé_Ìsẹ́gun_Ọjọ́rú_Ọjọ́bọ_Ẹtì_Àbámẹ́ta".split("_"),
			weekdaysShort: "Àìk_Ajé_Ìsẹ́_Ọjr_Ọjb_Ẹtì_Àbá".split("_"),
			weekdaysMin: "Àì_Aj_Ìs_Ọr_Ọb_Ẹt_Àb".split("_"),
			longDateFormat: {
				LT: "h:mm A",
				LTS: "h:mm:ss A",
				L: "DD/MM/YYYY",
				LL: "D MMMM YYYY",
				LLL: "D MMMM YYYY h:mm A",
				LLLL: "dddd, D MMMM YYYY h:mm A"
			},
			calendar: {
				sameDay: "[Ònì ni] LT",
				nextDay: "[Ọ̀la ni] LT",
				nextWeek: "dddd [Ọsẹ̀ tón'bọ] [ni] LT",
				lastDay: "[Àna ni] LT",
				lastWeek: "dddd [Ọsẹ̀ tólọ́] [ni] LT",
				sameElse: "L"
			},
			relativeTime: {
				future: "ní %s",
				past: "%s kọjá",
				s: "ìsẹjú aayá die",
				ss: "aayá %d",
				m: "ìsẹjú kan",
				mm: "ìsẹjú %d",
				h: "wákati kan",
				hh: "wákati %d",
				d: "ọjọ́ kan",
				dd: "ọjọ́ %d",
				M: "osù kan",
				MM: "osù %d",
				y: "ọdún kan",
				yy: "ọdún %d"
			},
			dayOfMonthOrdinalParse: /ọjọ́\s\d{1,2}/,
			ordinal: "ọjọ́ %d",
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("zh-cn", {
			months: "一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月".split("_"),
			monthsShort: "1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"),
			weekdays: "星期日_星期一_星期二_星期三_星期四_星期五_星期六".split("_"),
			weekdaysShort: "周日_周一_周二_周三_周四_周五_周六".split("_"),
			weekdaysMin: "日_一_二_三_四_五_六".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY/MM/DD",
				LL: "YYYY年M月D日",
				LLL: "YYYY年M月D日Ah点mm分",
				LLLL: "YYYY年M月D日ddddAh点mm分",
				l: "YYYY/M/D",
				ll: "YYYY年M月D日",
				lll: "YYYY年M月D日 HH:mm",
				llll: "YYYY年M月D日dddd HH:mm"
			},
			meridiemParse: /凌晨|早上|上午|中午|下午|晚上/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "凌晨" === t || "早上" === t || "上午" === t ? e : "下午" === t || "晚上" === t ? e + 12 : e >= 11 ? e : e + 12
			},
			meridiem: function (e, t, n) {
				var r = 100 * e + t;
				return r < 600 ? "凌晨" : r < 900 ? "早上" : r < 1130 ? "上午" : r < 1230 ? "中午" : r < 1800 ? "下午" : "晚上"
			},
			calendar: {
				sameDay: "[今天]LT",
				nextDay: "[明天]LT",
				nextWeek: "[下]ddddLT",
				lastDay: "[昨天]LT",
				lastWeek: "[上]ddddLT",
				sameElse: "L"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(日|月|周)/,
			ordinal: function (e, t) {
				switch (t) {
					case"d":
					case"D":
					case"DDD":
						return e + "日";
					case"M":
						return e + "月";
					case"w":
					case"W":
						return e + "周";
					default:
						return e
				}
			},
			relativeTime: {
				future: "%s内",
				past: "%s前",
				s: "几秒",
				ss: "%d 秒",
				m: "1 分钟",
				mm: "%d 分钟",
				h: "1 小时",
				hh: "%d 小时",
				d: "1 天",
				dd: "%d 天",
				M: "1 个月",
				MM: "%d 个月",
				y: "1 年",
				yy: "%d 年"
			},
			week: {dow: 1, doy: 4}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("zh-hk", {
			months: "一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月".split("_"),
			monthsShort: "1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"),
			weekdays: "星期日_星期一_星期二_星期三_星期四_星期五_星期六".split("_"),
			weekdaysShort: "週日_週一_週二_週三_週四_週五_週六".split("_"),
			weekdaysMin: "日_一_二_三_四_五_六".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY/MM/DD",
				LL: "YYYY年M月D日",
				LLL: "YYYY年M月D日 HH:mm",
				LLLL: "YYYY年M月D日dddd HH:mm",
				l: "YYYY/M/D",
				ll: "YYYY年M月D日",
				lll: "YYYY年M月D日 HH:mm",
				llll: "YYYY年M月D日dddd HH:mm"
			},
			meridiemParse: /凌晨|早上|上午|中午|下午|晚上/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "凌晨" === t || "早上" === t || "上午" === t ? e : "中午" === t ? e >= 11 ? e : e + 12 : "下午" === t || "晚上" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				var r = 100 * e + t;
				return r < 600 ? "凌晨" : r < 900 ? "早上" : r < 1130 ? "上午" : r < 1230 ? "中午" : r < 1800 ? "下午" : "晚上"
			},
			calendar: {
				sameDay: "[今天]LT",
				nextDay: "[明天]LT",
				nextWeek: "[下]ddddLT",
				lastDay: "[昨天]LT",
				lastWeek: "[上]ddddLT",
				sameElse: "L"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(日|月|週)/,
			ordinal: function (e, t) {
				switch (t) {
					case"d":
					case"D":
					case"DDD":
						return e + "日";
					case"M":
						return e + "月";
					case"w":
					case"W":
						return e + "週";
					default:
						return e
				}
			},
			relativeTime: {
				future: "%s內",
				past: "%s前",
				s: "幾秒",
				ss: "%d 秒",
				m: "1 分鐘",
				mm: "%d 分鐘",
				h: "1 小時",
				hh: "%d 小時",
				d: "1 天",
				dd: "%d 天",
				M: "1 個月",
				MM: "%d 個月",
				y: "1 年",
				yy: "%d 年"
			}
		})
	})(n(0))
}, function (e, t, n) {
	(function (e) {
		"use strict";
		e.defineLocale("zh-tw", {
			months: "一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月".split("_"),
			monthsShort: "1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"),
			weekdays: "星期日_星期一_星期二_星期三_星期四_星期五_星期六".split("_"),
			weekdaysShort: "週日_週一_週二_週三_週四_週五_週六".split("_"),
			weekdaysMin: "日_一_二_三_四_五_六".split("_"),
			longDateFormat: {
				LT: "HH:mm",
				LTS: "HH:mm:ss",
				L: "YYYY/MM/DD",
				LL: "YYYY年M月D日",
				LLL: "YYYY年M月D日 HH:mm",
				LLLL: "YYYY年M月D日dddd HH:mm",
				l: "YYYY/M/D",
				ll: "YYYY年M月D日",
				lll: "YYYY年M月D日 HH:mm",
				llll: "YYYY年M月D日dddd HH:mm"
			},
			meridiemParse: /凌晨|早上|上午|中午|下午|晚上/,
			meridiemHour: function (e, t) {
				return 12 === e && (e = 0), "凌晨" === t || "早上" === t || "上午" === t ? e : "中午" === t ? e >= 11 ? e : e + 12 : "下午" === t || "晚上" === t ? e + 12 : void 0
			},
			meridiem: function (e, t, n) {
				var r = 100 * e + t;
				return r < 600 ? "凌晨" : r < 900 ? "早上" : r < 1130 ? "上午" : r < 1230 ? "中午" : r < 1800 ? "下午" : "晚上"
			},
			calendar: {
				sameDay: "[今天] LT",
				nextDay: "[明天] LT",
				nextWeek: "[下]dddd LT",
				lastDay: "[昨天] LT",
				lastWeek: "[上]dddd LT",
				sameElse: "L"
			},
			dayOfMonthOrdinalParse: /\d{1,2}(日|月|週)/,
			ordinal: function (e, t) {
				switch (t) {
					case"d":
					case"D":
					case"DDD":
						return e + "日";
					case"M":
						return e + "月";
					case"w":
					case"W":
						return e + "週";
					default:
						return e
				}
			},
			relativeTime: {
				future: "%s內",
				past: "%s前",
				s: "幾秒",
				ss: "%d 秒",
				m: "1 分鐘",
				mm: "%d 分鐘",
				h: "1 小時",
				hh: "%d 小時",
				d: "1 天",
				dd: "%d 天",
				M: "1 個月",
				MM: "%d 個月",
				y: "1 年",
				yy: "%d 年"
			}
		})
	})(n(0))
}, function (e, t, n) {
	n(134), n(167), e.exports = n(168)
}, function (e, t, n) {
	n(135), window.slimScroll = n(160), window.textareaAutoSize = n(161), window.moment = n(0), window.toastr = n(163), window.markdown = n(165), window.easyPieChart = n(166)
}, function (e, t, n) {
	window._ = n(136);
	try {
		window.$ = window.jQuery = n(2), n(138)
	} catch (e) {
	}
	window.axios = n(139), window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
	var r = document.head.querySelector('meta[name="csrf-token"]');
	r ? window.axios.defaults.headers.common["X-CSRF-TOKEN"] = r.content : console.error("CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"), window.Pusher = n(159)
}, function (e, t, n) {
	(function (e, r) {
		var i;
		(function () {
			var a, s = 200, o = "Unsupported core-js use. Try https://npms.io/search?q=ponyfill.",
				u = "Expected a function", d = "__lodash_hash_undefined__", l = 500, c = "__lodash_placeholder__",
				h = 1, f = 2, _ = 4, p = 1, m = 2, y = 1, g = 2, v = 4, M = 8, L = 16, w = 32, b = 64, Y = 128, k = 256,
				T = 512, D = 30, S = "...", x = 800, j = 16, H = 1, E = 2, C = 1 / 0, A = 9007199254740991,
				O = 1.7976931348623157e308, P = NaN, R = 4294967295, W = R - 1, N = R >>> 1,
				I = [["ary", Y], ["bind", y], ["bindKey", g], ["curry", M], ["curryRight", L], ["flip", T], ["partial", w], ["partialRight", b], ["rearg", k]],
				F = "[object Arguments]", z = "[object Array]", $ = "[object AsyncFunction]", U = "[object Boolean]",
				B = "[object Date]", q = "[object DOMException]", J = "[object Error]", G = "[object Function]",
				V = "[object GeneratorFunction]", K = "[object Map]", X = "[object Number]", Z = "[object Null]",
				Q = "[object Object]", ee = "[object Proxy]", te = "[object RegExp]", ne = "[object Set]",
				re = "[object String]", ie = "[object Symbol]", ae = "[object Undefined]", se = "[object WeakMap]",
				oe = "[object WeakSet]", ue = "[object ArrayBuffer]", de = "[object DataView]",
				le = "[object Float32Array]", ce = "[object Float64Array]", he = "[object Int8Array]",
				fe = "[object Int16Array]", _e = "[object Int32Array]", pe = "[object Uint8Array]",
				me = "[object Uint8ClampedArray]", ye = "[object Uint16Array]", ge = "[object Uint32Array]",
				ve = /\b__p \+= '';/g, Me = /\b(__p \+=) '' \+/g, Le = /(__e\(.*?\)|\b__t\)) \+\n'';/g,
				we = /&(?:amp|lt|gt|quot|#39);/g, be = /[&<>"']/g, Ye = RegExp(we.source), ke = RegExp(be.source),
				Te = /<%-([\s\S]+?)%>/g, De = /<%([\s\S]+?)%>/g, Se = /<%=([\s\S]+?)%>/g,
				xe = /\.|\[(?:[^[\]]*|(["'])(?:(?!\1)[^\\]|\\.)*?\1)\]/, je = /^\w*$/,
				He = /[^.[\]]+|\[(?:(-?\d+(?:\.\d+)?)|(["'])((?:(?!\2)[^\\]|\\.)*?)\2)\]|(?=(?:\.|\[\])(?:\.|\[\]|$))/g,
				Ee = /[\\^$.*+?()[\]{}|]/g, Ce = RegExp(Ee.source), Ae = /^\s+|\s+$/g, Oe = /^\s+/, Pe = /\s+$/,
				Re = /\{(?:\n\/\* \[wrapped with .+\] \*\/)?\n?/, We = /\{\n\/\* \[wrapped with (.+)\] \*/,
				Ne = /,? & /, Ie = /[^\x00-\x2f\x3a-\x40\x5b-\x60\x7b-\x7f]+/g, Fe = /\\(\\)?/g,
				ze = /\$\{([^\\}]*(?:\\.[^\\}]*)*)\}/g, $e = /\w*$/, Ue = /^[-+]0x[0-9a-f]+$/i, Be = /^0b[01]+$/i,
				qe = /^\[object .+?Constructor\]$/, Je = /^0o[0-7]+$/i, Ge = /^(?:0|[1-9]\d*)$/,
				Ve = /[\xc0-\xd6\xd8-\xf6\xf8-\xff\u0100-\u017f]/g, Ke = /($^)/, Xe = /['\n\r\u2028\u2029\\]/g,
				Ze = "\\u0300-\\u036f\\ufe20-\\ufe2f\\u20d0-\\u20ff",
				Qe = "\\xac\\xb1\\xd7\\xf7\\x00-\\x2f\\x3a-\\x40\\x5b-\\x60\\x7b-\\xbf\\u2000-\\u206f \\t\\x0b\\f\\xa0\\ufeff\\n\\r\\u2028\\u2029\\u1680\\u180e\\u2000\\u2001\\u2002\\u2003\\u2004\\u2005\\u2006\\u2007\\u2008\\u2009\\u200a\\u202f\\u205f\\u3000",
				et = "[\\ud800-\\udfff]", tt = "[" + Qe + "]", nt = "[" + Ze + "]", rt = "\\d+",
				it = "[\\u2700-\\u27bf]", at = "[a-z\\xdf-\\xf6\\xf8-\\xff]",
				st = "[^\\ud800-\\udfff" + Qe + rt + "\\u2700-\\u27bfa-z\\xdf-\\xf6\\xf8-\\xffA-Z\\xc0-\\xd6\\xd8-\\xde]",
				ot = "\\ud83c[\\udffb-\\udfff]", ut = "[^\\ud800-\\udfff]", dt = "(?:\\ud83c[\\udde6-\\uddff]){2}",
				lt = "[\\ud800-\\udbff][\\udc00-\\udfff]", ct = "[A-Z\\xc0-\\xd6\\xd8-\\xde]",
				ht = "(?:" + at + "|" + st + ")", ft = "(?:" + ct + "|" + st + ")",
				_t = "(?:" + nt + "|" + ot + ")" + "?",
				pt = "[\\ufe0e\\ufe0f]?" + _t + ("(?:\\u200d(?:" + [ut, dt, lt].join("|") + ")[\\ufe0e\\ufe0f]?" + _t + ")*"),
				mt = "(?:" + [it, dt, lt].join("|") + ")" + pt,
				yt = "(?:" + [ut + nt + "?", nt, dt, lt, et].join("|") + ")", gt = RegExp("['’]", "g"),
				vt = RegExp(nt, "g"), Mt = RegExp(ot + "(?=" + ot + ")|" + yt + pt, "g"),
				Lt = RegExp([ct + "?" + at + "+(?:['’](?:d|ll|m|re|s|t|ve))?(?=" + [tt, ct, "$"].join("|") + ")", ft + "+(?:['’](?:D|LL|M|RE|S|T|VE))?(?=" + [tt, ct + ht, "$"].join("|") + ")", ct + "?" + ht + "+(?:['’](?:d|ll|m|re|s|t|ve))?", ct + "+(?:['’](?:D|LL|M|RE|S|T|VE))?", "\\d*(?:1ST|2ND|3RD|(?![123])\\dTH)(?=\\b|[a-z_])", "\\d*(?:1st|2nd|3rd|(?![123])\\dth)(?=\\b|[A-Z_])", rt, mt].join("|"), "g"),
				wt = RegExp("[\\u200d\\ud800-\\udfff" + Ze + "\\ufe0e\\ufe0f]"),
				bt = /[a-z][A-Z]|[A-Z]{2}[a-z]|[0-9][a-zA-Z]|[a-zA-Z][0-9]|[^a-zA-Z0-9 ]/,
				Yt = ["Array", "Buffer", "DataView", "Date", "Error", "Float32Array", "Float64Array", "Function", "Int8Array", "Int16Array", "Int32Array", "Map", "Math", "Object", "Promise", "RegExp", "Set", "String", "Symbol", "TypeError", "Uint8Array", "Uint8ClampedArray", "Uint16Array", "Uint32Array", "WeakMap", "_", "clearTimeout", "isFinite", "parseInt", "setTimeout"],
				kt = -1, Tt = {};
			Tt[le] = Tt[ce] = Tt[he] = Tt[fe] = Tt[_e] = Tt[pe] = Tt[me] = Tt[ye] = Tt[ge] = !0, Tt[F] = Tt[z] = Tt[ue] = Tt[U] = Tt[de] = Tt[B] = Tt[J] = Tt[G] = Tt[K] = Tt[X] = Tt[Q] = Tt[te] = Tt[ne] = Tt[re] = Tt[se] = !1;
			var Dt = {};
			Dt[F] = Dt[z] = Dt[ue] = Dt[de] = Dt[U] = Dt[B] = Dt[le] = Dt[ce] = Dt[he] = Dt[fe] = Dt[_e] = Dt[K] = Dt[X] = Dt[Q] = Dt[te] = Dt[ne] = Dt[re] = Dt[ie] = Dt[pe] = Dt[me] = Dt[ye] = Dt[ge] = !0, Dt[J] = Dt[G] = Dt[se] = !1;
			var St = {"\\": "\\", "'": "'", "\n": "n", "\r": "r", "\u2028": "u2028", "\u2029": "u2029"},
				xt = parseFloat, jt = parseInt, Ht = "object" == typeof e && e && e.Object === Object && e,
				Et = "object" == typeof self && self && self.Object === Object && self,
				Ct = Ht || Et || Function("return this")(), At = "object" == typeof t && t && !t.nodeType && t,
				Ot = At && "object" == typeof r && r && !r.nodeType && r, Pt = Ot && Ot.exports === At,
				Rt = Pt && Ht.process, Wt = function () {
					try {
						var e = Ot && Ot.require && Ot.require("util").types;
						return e || Rt && Rt.binding && Rt.binding("util")
					} catch (e) {
					}
				}(), Nt = Wt && Wt.isArrayBuffer, It = Wt && Wt.isDate, Ft = Wt && Wt.isMap, zt = Wt && Wt.isRegExp,
				$t = Wt && Wt.isSet, Ut = Wt && Wt.isTypedArray;

			function Bt(e, t, n) {
				switch (n.length) {
					case 0:
						return e.call(t);
					case 1:
						return e.call(t, n[0]);
					case 2:
						return e.call(t, n[0], n[1]);
					case 3:
						return e.call(t, n[0], n[1], n[2])
				}
				return e.apply(t, n)
			}

			function qt(e, t, n, r) {
				for (var i = -1, a = null == e ? 0 : e.length; ++i < a;) {
					var s = e[i];
					t(r, s, n(s), e)
				}
				return r
			}

			function Jt(e, t) {
				for (var n = -1, r = null == e ? 0 : e.length; ++n < r && !1 !== t(e[n], n, e);) ;
				return e
			}

			function Gt(e, t) {
				for (var n = null == e ? 0 : e.length; n-- && !1 !== t(e[n], n, e);) ;
				return e
			}

			function Vt(e, t) {
				for (var n = -1, r = null == e ? 0 : e.length; ++n < r;) if (!t(e[n], n, e)) return !1;
				return !0
			}

			function Kt(e, t) {
				for (var n = -1, r = null == e ? 0 : e.length, i = 0, a = []; ++n < r;) {
					var s = e[n];
					t(s, n, e) && (a[i++] = s)
				}
				return a
			}

			function Xt(e, t) {
				return !!(null == e ? 0 : e.length) && un(e, t, 0) > -1
			}

			function Zt(e, t, n) {
				for (var r = -1, i = null == e ? 0 : e.length; ++r < i;) if (n(t, e[r])) return !0;
				return !1
			}

			function Qt(e, t) {
				for (var n = -1, r = null == e ? 0 : e.length, i = Array(r); ++n < r;) i[n] = t(e[n], n, e);
				return i
			}

			function en(e, t) {
				for (var n = -1, r = t.length, i = e.length; ++n < r;) e[i + n] = t[n];
				return e
			}

			function tn(e, t, n, r) {
				var i = -1, a = null == e ? 0 : e.length;
				for (r && a && (n = e[++i]); ++i < a;) n = t(n, e[i], i, e);
				return n
			}

			function nn(e, t, n, r) {
				var i = null == e ? 0 : e.length;
				for (r && i && (n = e[--i]); i--;) n = t(n, e[i], i, e);
				return n
			}

			function rn(e, t) {
				for (var n = -1, r = null == e ? 0 : e.length; ++n < r;) if (t(e[n], n, e)) return !0;
				return !1
			}

			var an = hn("length");

			function sn(e, t, n) {
				var r;
				return n(e, function (e, n, i) {
					if (t(e, n, i)) return r = n, !1
				}), r
			}

			function on(e, t, n, r) {
				for (var i = e.length, a = n + (r ? 1 : -1); r ? a-- : ++a < i;) if (t(e[a], a, e)) return a;
				return -1
			}

			function un(e, t, n) {
				return t == t ? function (e, t, n) {
					var r = n - 1, i = e.length;
					for (; ++r < i;) if (e[r] === t) return r;
					return -1
				}(e, t, n) : on(e, ln, n)
			}

			function dn(e, t, n, r) {
				for (var i = n - 1, a = e.length; ++i < a;) if (r(e[i], t)) return i;
				return -1
			}

			function ln(e) {
				return e != e
			}

			function cn(e, t) {
				var n = null == e ? 0 : e.length;
				return n ? pn(e, t) / n : P
			}

			function hn(e) {
				return function (t) {
					return null == t ? a : t[e]
				}
			}

			function fn(e) {
				return function (t) {
					return null == e ? a : e[t]
				}
			}

			function _n(e, t, n, r, i) {
				return i(e, function (e, i, a) {
					n = r ? (r = !1, e) : t(n, e, i, a)
				}), n
			}

			function pn(e, t) {
				for (var n, r = -1, i = e.length; ++r < i;) {
					var s = t(e[r]);
					s !== a && (n = n === a ? s : n + s)
				}
				return n
			}

			function mn(e, t) {
				for (var n = -1, r = Array(e); ++n < e;) r[n] = t(n);
				return r
			}

			function yn(e) {
				return function (t) {
					return e(t)
				}
			}

			function gn(e, t) {
				return Qt(t, function (t) {
					return e[t]
				})
			}

			function vn(e, t) {
				return e.has(t)
			}

			function Mn(e, t) {
				for (var n = -1, r = e.length; ++n < r && un(t, e[n], 0) > -1;) ;
				return n
			}

			function Ln(e, t) {
				for (var n = e.length; n-- && un(t, e[n], 0) > -1;) ;
				return n
			}

			var wn = fn({
				"À": "A",
				"Á": "A",
				"Â": "A",
				"Ã": "A",
				"Ä": "A",
				"Å": "A",
				"à": "a",
				"á": "a",
				"â": "a",
				"ã": "a",
				"ä": "a",
				"å": "a",
				"Ç": "C",
				"ç": "c",
				"Ð": "D",
				"ð": "d",
				"È": "E",
				"É": "E",
				"Ê": "E",
				"Ë": "E",
				"è": "e",
				"é": "e",
				"ê": "e",
				"ë": "e",
				"Ì": "I",
				"Í": "I",
				"Î": "I",
				"Ï": "I",
				"ì": "i",
				"í": "i",
				"î": "i",
				"ï": "i",
				"Ñ": "N",
				"ñ": "n",
				"Ò": "O",
				"Ó": "O",
				"Ô": "O",
				"Õ": "O",
				"Ö": "O",
				"Ø": "O",
				"ò": "o",
				"ó": "o",
				"ô": "o",
				"õ": "o",
				"ö": "o",
				"ø": "o",
				"Ù": "U",
				"Ú": "U",
				"Û": "U",
				"Ü": "U",
				"ù": "u",
				"ú": "u",
				"û": "u",
				"ü": "u",
				"Ý": "Y",
				"ý": "y",
				"ÿ": "y",
				"Æ": "Ae",
				"æ": "ae",
				"Þ": "Th",
				"þ": "th",
				"ß": "ss",
				"Ā": "A",
				"Ă": "A",
				"Ą": "A",
				"ā": "a",
				"ă": "a",
				"ą": "a",
				"Ć": "C",
				"Ĉ": "C",
				"Ċ": "C",
				"Č": "C",
				"ć": "c",
				"ĉ": "c",
				"ċ": "c",
				"č": "c",
				"Ď": "D",
				"Đ": "D",
				"ď": "d",
				"đ": "d",
				"Ē": "E",
				"Ĕ": "E",
				"Ė": "E",
				"Ę": "E",
				"Ě": "E",
				"ē": "e",
				"ĕ": "e",
				"ė": "e",
				"ę": "e",
				"ě": "e",
				"Ĝ": "G",
				"Ğ": "G",
				"Ġ": "G",
				"Ģ": "G",
				"ĝ": "g",
				"ğ": "g",
				"ġ": "g",
				"ģ": "g",
				"Ĥ": "H",
				"Ħ": "H",
				"ĥ": "h",
				"ħ": "h",
				"Ĩ": "I",
				"Ī": "I",
				"Ĭ": "I",
				"Į": "I",
				"İ": "I",
				"ĩ": "i",
				"ī": "i",
				"ĭ": "i",
				"į": "i",
				"ı": "i",
				"Ĵ": "J",
				"ĵ": "j",
				"Ķ": "K",
				"ķ": "k",
				"ĸ": "k",
				"Ĺ": "L",
				"Ļ": "L",
				"Ľ": "L",
				"Ŀ": "L",
				"Ł": "L",
				"ĺ": "l",
				"ļ": "l",
				"ľ": "l",
				"ŀ": "l",
				"ł": "l",
				"Ń": "N",
				"Ņ": "N",
				"Ň": "N",
				"Ŋ": "N",
				"ń": "n",
				"ņ": "n",
				"ň": "n",
				"ŋ": "n",
				"Ō": "O",
				"Ŏ": "O",
				"Ő": "O",
				"ō": "o",
				"ŏ": "o",
				"ő": "o",
				"Ŕ": "R",
				"Ŗ": "R",
				"Ř": "R",
				"ŕ": "r",
				"ŗ": "r",
				"ř": "r",
				"Ś": "S",
				"Ŝ": "S",
				"Ş": "S",
				"Š": "S",
				"ś": "s",
				"ŝ": "s",
				"ş": "s",
				"š": "s",
				"Ţ": "T",
				"Ť": "T",
				"Ŧ": "T",
				"ţ": "t",
				"ť": "t",
				"ŧ": "t",
				"Ũ": "U",
				"Ū": "U",
				"Ŭ": "U",
				"Ů": "U",
				"Ű": "U",
				"Ų": "U",
				"ũ": "u",
				"ū": "u",
				"ŭ": "u",
				"ů": "u",
				"ű": "u",
				"ų": "u",
				"Ŵ": "W",
				"ŵ": "w",
				"Ŷ": "Y",
				"ŷ": "y",
				"Ÿ": "Y",
				"Ź": "Z",
				"Ż": "Z",
				"Ž": "Z",
				"ź": "z",
				"ż": "z",
				"ž": "z",
				"Ĳ": "IJ",
				"ĳ": "ij",
				"Œ": "Oe",
				"œ": "oe",
				"ŉ": "'n",
				"ſ": "s"
			}), bn = fn({"&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;"});

			function Yn(e) {
				return "\\" + St[e]
			}

			function kn(e) {
				return wt.test(e)
			}

			function Tn(e) {
				var t = -1, n = Array(e.size);
				return e.forEach(function (e, r) {
					n[++t] = [r, e]
				}), n
			}

			function Dn(e, t) {
				return function (n) {
					return e(t(n))
				}
			}

			function Sn(e, t) {
				for (var n = -1, r = e.length, i = 0, a = []; ++n < r;) {
					var s = e[n];
					s !== t && s !== c || (e[n] = c, a[i++] = n)
				}
				return a
			}

			function xn(e) {
				var t = -1, n = Array(e.size);
				return e.forEach(function (e) {
					n[++t] = e
				}), n
			}

			function jn(e) {
				var t = -1, n = Array(e.size);
				return e.forEach(function (e) {
					n[++t] = [e, e]
				}), n
			}

			function Hn(e) {
				return kn(e) ? function (e) {
					var t = Mt.lastIndex = 0;
					for (; Mt.test(e);) ++t;
					return t
				}(e) : an(e)
			}

			function En(e) {
				return kn(e) ? function (e) {
					return e.match(Mt) || []
				}(e) : function (e) {
					return e.split("")
				}(e)
			}

			var Cn = fn({"&amp;": "&", "&lt;": "<", "&gt;": ">", "&quot;": '"', "&#39;": "'"});
			var An = function e(t) {
				var n, r = (t = null == t ? Ct : An.defaults(Ct.Object(), t, An.pick(Ct, Yt))).Array, i = t.Date,
					Ze = t.Error, Qe = t.Function, et = t.Math, tt = t.Object, nt = t.RegExp, rt = t.String,
					it = t.TypeError, at = r.prototype, st = Qe.prototype, ot = tt.prototype,
					ut = t["__core-js_shared__"], dt = st.toString, lt = ot.hasOwnProperty, ct = 0,
					ht = (n = /[^.]+$/.exec(ut && ut.keys && ut.keys.IE_PROTO || "")) ? "Symbol(src)_1." + n : "",
					ft = ot.toString, _t = dt.call(tt), pt = Ct._,
					mt = nt("^" + dt.call(lt).replace(Ee, "\\$&").replace(/hasOwnProperty|(function).*?(?=\\\()| for .+?(?=\\\])/g, "$1.*?") + "$"),
					yt = Pt ? t.Buffer : a, Mt = t.Symbol, wt = t.Uint8Array, St = yt ? yt.allocUnsafe : a,
					Ht = Dn(tt.getPrototypeOf, tt), Et = tt.create, At = ot.propertyIsEnumerable, Ot = at.splice,
					Rt = Mt ? Mt.isConcatSpreadable : a, Wt = Mt ? Mt.iterator : a, an = Mt ? Mt.toStringTag : a,
					fn = function () {
						try {
							var e = Wa(tt, "defineProperty");
							return e({}, "", {}), e
						} catch (e) {
						}
					}(), On = t.clearTimeout !== Ct.clearTimeout && t.clearTimeout,
					Pn = i && i.now !== Ct.Date.now && i.now, Rn = t.setTimeout !== Ct.setTimeout && t.setTimeout,
					Wn = et.ceil, Nn = et.floor, In = tt.getOwnPropertySymbols, Fn = yt ? yt.isBuffer : a,
					zn = t.isFinite, $n = at.join, Un = Dn(tt.keys, tt), Bn = et.max, qn = et.min, Jn = i.now,
					Gn = t.parseInt, Vn = et.random, Kn = at.reverse, Xn = Wa(t, "DataView"), Zn = Wa(t, "Map"),
					Qn = Wa(t, "Promise"), er = Wa(t, "Set"), tr = Wa(t, "WeakMap"), nr = Wa(tt, "create"),
					rr = tr && new tr, ir = {}, ar = ls(Xn), sr = ls(Zn), or = ls(Qn), ur = ls(er), dr = ls(tr),
					lr = Mt ? Mt.prototype : a, cr = lr ? lr.valueOf : a, hr = lr ? lr.toString : a;

				function fr(e) {
					if (So(e) && !yo(e) && !(e instanceof yr)) {
						if (e instanceof mr) return e;
						if (lt.call(e, "__wrapped__")) return cs(e)
					}
					return new mr(e)
				}

				var _r = function () {
					function e() {
					}

					return function (t) {
						if (!Do(t)) return {};
						if (Et) return Et(t);
						e.prototype = t;
						var n = new e;
						return e.prototype = a, n
					}
				}();

				function pr() {
				}

				function mr(e, t) {
					this.__wrapped__ = e, this.__actions__ = [], this.__chain__ = !!t, this.__index__ = 0, this.__values__ = a
				}

				function yr(e) {
					this.__wrapped__ = e, this.__actions__ = [], this.__dir__ = 1, this.__filtered__ = !1, this.__iteratees__ = [], this.__takeCount__ = R, this.__views__ = []
				}

				function gr(e) {
					var t = -1, n = null == e ? 0 : e.length;
					for (this.clear(); ++t < n;) {
						var r = e[t];
						this.set(r[0], r[1])
					}
				}

				function vr(e) {
					var t = -1, n = null == e ? 0 : e.length;
					for (this.clear(); ++t < n;) {
						var r = e[t];
						this.set(r[0], r[1])
					}
				}

				function Mr(e) {
					var t = -1, n = null == e ? 0 : e.length;
					for (this.clear(); ++t < n;) {
						var r = e[t];
						this.set(r[0], r[1])
					}
				}

				function Lr(e) {
					var t = -1, n = null == e ? 0 : e.length;
					for (this.__data__ = new Mr; ++t < n;) this.add(e[t])
				}

				function wr(e) {
					var t = this.__data__ = new vr(e);
					this.size = t.size
				}

				function br(e, t) {
					var n = yo(e), r = !n && mo(e), i = !n && !r && Lo(e), a = !n && !r && !i && Po(e),
						s = n || r || i || a, o = s ? mn(e.length, rt) : [], u = o.length;
					for (var d in e) !t && !lt.call(e, d) || s && ("length" == d || i && ("offset" == d || "parent" == d) || a && ("buffer" == d || "byteLength" == d || "byteOffset" == d) || Ba(d, u)) || o.push(d);
					return o
				}

				function Yr(e) {
					var t = e.length;
					return t ? e[Li(0, t - 1)] : a
				}

				function kr(e, t) {
					return os(na(e), Ar(t, 0, e.length))
				}

				function Tr(e) {
					return os(na(e))
				}

				function Dr(e, t, n) {
					(n === a || fo(e[t], n)) && (n !== a || t in e) || Er(e, t, n)
				}

				function Sr(e, t, n) {
					var r = e[t];
					lt.call(e, t) && fo(r, n) && (n !== a || t in e) || Er(e, t, n)
				}

				function xr(e, t) {
					for (var n = e.length; n--;) if (fo(e[n][0], t)) return n;
					return -1
				}

				function jr(e, t, n, r) {
					return Nr(e, function (e, i, a) {
						t(r, e, n(e), a)
					}), r
				}

				function Hr(e, t) {
					return e && ra(t, iu(t), e)
				}

				function Er(e, t, n) {
					"__proto__" == t && fn ? fn(e, t, {
						configurable: !0,
						enumerable: !0,
						value: n,
						writable: !0
					}) : e[t] = n
				}

				function Cr(e, t) {
					for (var n = -1, i = t.length, s = r(i), o = null == e; ++n < i;) s[n] = o ? a : Qo(e, t[n]);
					return s
				}

				function Ar(e, t, n) {
					return e == e && (n !== a && (e = e <= n ? e : n), t !== a && (e = e >= t ? e : t)), e
				}

				function Or(e, t, n, r, i, s) {
					var o, u = t & h, d = t & f, l = t & _;
					if (n && (o = i ? n(e, r, i, s) : n(e)), o !== a) return o;
					if (!Do(e)) return e;
					var c = yo(e);
					if (c) {
						if (o = function (e) {
							var t = e.length, n = new e.constructor(t);
							return t && "string" == typeof e[0] && lt.call(e, "index") && (n.index = e.index, n.input = e.input), n
						}(e), !u) return na(e, o)
					} else {
						var p = Fa(e), m = p == G || p == V;
						if (Lo(e)) return Ki(e, u);
						if (p == Q || p == F || m && !i) {
							if (o = d || m ? {} : $a(e), !u) return d ? function (e, t) {
								return ra(e, Ia(e), t)
							}(e, function (e, t) {
								return e && ra(t, au(t), e)
							}(o, e)) : function (e, t) {
								return ra(e, Na(e), t)
							}(e, Hr(o, e))
						} else {
							if (!Dt[p]) return i ? e : {};
							o = function (e, t, n) {
								var r, i, a, s = e.constructor;
								switch (t) {
									case ue:
										return Xi(e);
									case U:
									case B:
										return new s(+e);
									case de:
										return function (e, t) {
											var n = t ? Xi(e.buffer) : e.buffer;
											return new e.constructor(n, e.byteOffset, e.byteLength)
										}(e, n);
									case le:
									case ce:
									case he:
									case fe:
									case _e:
									case pe:
									case me:
									case ye:
									case ge:
										return Zi(e, n);
									case K:
										return new s;
									case X:
									case re:
										return new s(e);
									case te:
										return (a = new (i = e).constructor(i.source, $e.exec(i))).lastIndex = i.lastIndex, a;
									case ne:
										return new s;
									case ie:
										return r = e, cr ? tt(cr.call(r)) : {}
								}
							}(e, p, u)
						}
					}
					s || (s = new wr);
					var y = s.get(e);
					if (y) return y;
					if (s.set(e, o), Co(e)) return e.forEach(function (r) {
						o.add(Or(r, t, n, r, e, s))
					}), o;
					if (xo(e)) return e.forEach(function (r, i) {
						o.set(i, Or(r, t, n, i, e, s))
					}), o;
					var g = c ? a : (l ? d ? Ha : ja : d ? au : iu)(e);
					return Jt(g || e, function (r, i) {
						g && (r = e[i = r]), Sr(o, i, Or(r, t, n, i, e, s))
					}), o
				}

				function Pr(e, t, n) {
					var r = n.length;
					if (null == e) return !r;
					for (e = tt(e); r--;) {
						var i = n[r], s = t[i], o = e[i];
						if (o === a && !(i in e) || !s(o)) return !1
					}
					return !0
				}

				function Rr(e, t, n) {
					if ("function" != typeof e) throw new it(u);
					return rs(function () {
						e.apply(a, n)
					}, t)
				}

				function Wr(e, t, n, r) {
					var i = -1, a = Xt, o = !0, u = e.length, d = [], l = t.length;
					if (!u) return d;
					n && (t = Qt(t, yn(n))), r ? (a = Zt, o = !1) : t.length >= s && (a = vn, o = !1, t = new Lr(t));
					e:for (; ++i < u;) {
						var c = e[i], h = null == n ? c : n(c);
						if (c = r || 0 !== c ? c : 0, o && h == h) {
							for (var f = l; f--;) if (t[f] === h) continue e;
							d.push(c)
						} else a(t, h, r) || d.push(c)
					}
					return d
				}

				fr.templateSettings = {
					escape: Te,
					evaluate: De,
					interpolate: Se,
					variable: "",
					imports: {_: fr}
				}, fr.prototype = pr.prototype, fr.prototype.constructor = fr, mr.prototype = _r(pr.prototype), mr.prototype.constructor = mr, yr.prototype = _r(pr.prototype), yr.prototype.constructor = yr, gr.prototype.clear = function () {
					this.__data__ = nr ? nr(null) : {}, this.size = 0
				}, gr.prototype.delete = function (e) {
					var t = this.has(e) && delete this.__data__[e];
					return this.size -= t ? 1 : 0, t
				}, gr.prototype.get = function (e) {
					var t = this.__data__;
					if (nr) {
						var n = t[e];
						return n === d ? a : n
					}
					return lt.call(t, e) ? t[e] : a
				}, gr.prototype.has = function (e) {
					var t = this.__data__;
					return nr ? t[e] !== a : lt.call(t, e)
				}, gr.prototype.set = function (e, t) {
					var n = this.__data__;
					return this.size += this.has(e) ? 0 : 1, n[e] = nr && t === a ? d : t, this
				}, vr.prototype.clear = function () {
					this.__data__ = [], this.size = 0
				}, vr.prototype.delete = function (e) {
					var t = this.__data__, n = xr(t, e);
					return !(n < 0 || (n == t.length - 1 ? t.pop() : Ot.call(t, n, 1), --this.size, 0))
				}, vr.prototype.get = function (e) {
					var t = this.__data__, n = xr(t, e);
					return n < 0 ? a : t[n][1]
				}, vr.prototype.has = function (e) {
					return xr(this.__data__, e) > -1
				}, vr.prototype.set = function (e, t) {
					var n = this.__data__, r = xr(n, e);
					return r < 0 ? (++this.size, n.push([e, t])) : n[r][1] = t, this
				}, Mr.prototype.clear = function () {
					this.size = 0, this.__data__ = {hash: new gr, map: new (Zn || vr), string: new gr}
				}, Mr.prototype.delete = function (e) {
					var t = Pa(this, e).delete(e);
					return this.size -= t ? 1 : 0, t
				}, Mr.prototype.get = function (e) {
					return Pa(this, e).get(e)
				}, Mr.prototype.has = function (e) {
					return Pa(this, e).has(e)
				}, Mr.prototype.set = function (e, t) {
					var n = Pa(this, e), r = n.size;
					return n.set(e, t), this.size += n.size == r ? 0 : 1, this
				}, Lr.prototype.add = Lr.prototype.push = function (e) {
					return this.__data__.set(e, d), this
				}, Lr.prototype.has = function (e) {
					return this.__data__.has(e)
				}, wr.prototype.clear = function () {
					this.__data__ = new vr, this.size = 0
				}, wr.prototype.delete = function (e) {
					var t = this.__data__, n = t.delete(e);
					return this.size = t.size, n
				}, wr.prototype.get = function (e) {
					return this.__data__.get(e)
				}, wr.prototype.has = function (e) {
					return this.__data__.has(e)
				}, wr.prototype.set = function (e, t) {
					var n = this.__data__;
					if (n instanceof vr) {
						var r = n.__data__;
						if (!Zn || r.length < s - 1) return r.push([e, t]), this.size = ++n.size, this;
						n = this.__data__ = new Mr(r)
					}
					return n.set(e, t), this.size = n.size, this
				};
				var Nr = sa(Jr), Ir = sa(Gr, !0);

				function Fr(e, t) {
					var n = !0;
					return Nr(e, function (e, r, i) {
						return n = !!t(e, r, i)
					}), n
				}

				function zr(e, t, n) {
					for (var r = -1, i = e.length; ++r < i;) {
						var s = e[r], o = t(s);
						if (null != o && (u === a ? o == o && !Oo(o) : n(o, u))) var u = o, d = s
					}
					return d
				}

				function $r(e, t) {
					var n = [];
					return Nr(e, function (e, r, i) {
						t(e, r, i) && n.push(e)
					}), n
				}

				function Ur(e, t, n, r, i) {
					var a = -1, s = e.length;
					for (n || (n = Ua), i || (i = []); ++a < s;) {
						var o = e[a];
						t > 0 && n(o) ? t > 1 ? Ur(o, t - 1, n, r, i) : en(i, o) : r || (i[i.length] = o)
					}
					return i
				}

				var Br = oa(), qr = oa(!0);

				function Jr(e, t) {
					return e && Br(e, t, iu)
				}

				function Gr(e, t) {
					return e && qr(e, t, iu)
				}

				function Vr(e, t) {
					return Kt(t, function (t) {
						return Yo(e[t])
					})
				}

				function Kr(e, t) {
					for (var n = 0, r = (t = qi(t, e)).length; null != e && n < r;) e = e[ds(t[n++])];
					return n && n == r ? e : a
				}

				function Xr(e, t, n) {
					var r = t(e);
					return yo(e) ? r : en(r, n(e))
				}

				function Zr(e) {
					return null == e ? e === a ? ae : Z : an && an in tt(e) ? function (e) {
						var t = lt.call(e, an), n = e[an];
						try {
							e[an] = a;
							var r = !0
						} catch (e) {
						}
						var i = ft.call(e);
						return r && (t ? e[an] = n : delete e[an]), i
					}(e) : function (e) {
						return ft.call(e)
					}(e)
				}

				function Qr(e, t) {
					return e > t
				}

				function ei(e, t) {
					return null != e && lt.call(e, t)
				}

				function ti(e, t) {
					return null != e && t in tt(e)
				}

				function ni(e, t, n) {
					for (var i = n ? Zt : Xt, s = e[0].length, o = e.length, u = o, d = r(o), l = 1 / 0, c = []; u--;) {
						var h = e[u];
						u && t && (h = Qt(h, yn(t))), l = qn(h.length, l), d[u] = !n && (t || s >= 120 && h.length >= 120) ? new Lr(u && h) : a
					}
					h = e[0];
					var f = -1, _ = d[0];
					e:for (; ++f < s && c.length < l;) {
						var p = h[f], m = t ? t(p) : p;
						if (p = n || 0 !== p ? p : 0, !(_ ? vn(_, m) : i(c, m, n))) {
							for (u = o; --u;) {
								var y = d[u];
								if (!(y ? vn(y, m) : i(e[u], m, n))) continue e
							}
							_ && _.push(m), c.push(p)
						}
					}
					return c
				}

				function ri(e, t, n) {
					var r = null == (e = es(e, t = qi(t, e))) ? e : e[ds(ws(t))];
					return null == r ? a : Bt(r, e, n)
				}

				function ii(e) {
					return So(e) && Zr(e) == F
				}

				function ai(e, t, n, r, i) {
					return e === t || (null == e || null == t || !So(e) && !So(t) ? e != e && t != t : function (e, t, n, r, i, s) {
						var o = yo(e), u = yo(t), d = o ? z : Fa(e), l = u ? z : Fa(t), c = (d = d == F ? Q : d) == Q,
							h = (l = l == F ? Q : l) == Q, f = d == l;
						if (f && Lo(e)) {
							if (!Lo(t)) return !1;
							o = !0, c = !1
						}
						if (f && !c) return s || (s = new wr), o || Po(e) ? Sa(e, t, n, r, i, s) : function (e, t, n, r, i, a, s) {
							switch (n) {
								case de:
									if (e.byteLength != t.byteLength || e.byteOffset != t.byteOffset) return !1;
									e = e.buffer, t = t.buffer;
								case ue:
									return !(e.byteLength != t.byteLength || !a(new wt(e), new wt(t)));
								case U:
								case B:
								case X:
									return fo(+e, +t);
								case J:
									return e.name == t.name && e.message == t.message;
								case te:
								case re:
									return e == t + "";
								case K:
									var o = Tn;
								case ne:
									var u = r & p;
									if (o || (o = xn), e.size != t.size && !u) return !1;
									var d = s.get(e);
									if (d) return d == t;
									r |= m, s.set(e, t);
									var l = Sa(o(e), o(t), r, i, a, s);
									return s.delete(e), l;
								case ie:
									if (cr) return cr.call(e) == cr.call(t)
							}
							return !1
						}(e, t, d, n, r, i, s);
						if (!(n & p)) {
							var _ = c && lt.call(e, "__wrapped__"), y = h && lt.call(t, "__wrapped__");
							if (_ || y) {
								var g = _ ? e.value() : e, v = y ? t.value() : t;
								return s || (s = new wr), i(g, v, n, r, s)
							}
						}
						return !!f && (s || (s = new wr), function (e, t, n, r, i, s) {
							var o = n & p, u = ja(e), d = u.length, l = ja(t).length;
							if (d != l && !o) return !1;
							for (var c = d; c--;) {
								var h = u[c];
								if (!(o ? h in t : lt.call(t, h))) return !1
							}
							var f = s.get(e);
							if (f && s.get(t)) return f == t;
							var _ = !0;
							s.set(e, t), s.set(t, e);
							for (var m = o; ++c < d;) {
								h = u[c];
								var y = e[h], g = t[h];
								if (r) var v = o ? r(g, y, h, t, e, s) : r(y, g, h, e, t, s);
								if (!(v === a ? y === g || i(y, g, n, r, s) : v)) {
									_ = !1;
									break
								}
								m || (m = "constructor" == h)
							}
							if (_ && !m) {
								var M = e.constructor, L = t.constructor;
								M != L && "constructor" in e && "constructor" in t && !("function" == typeof M && M instanceof M && "function" == typeof L && L instanceof L) && (_ = !1)
							}
							return s.delete(e), s.delete(t), _
						}(e, t, n, r, i, s))
					}(e, t, n, r, ai, i))
				}

				function si(e, t, n, r) {
					var i = n.length, s = i, o = !r;
					if (null == e) return !s;
					for (e = tt(e); i--;) {
						var u = n[i];
						if (o && u[2] ? u[1] !== e[u[0]] : !(u[0] in e)) return !1
					}
					for (; ++i < s;) {
						var d = (u = n[i])[0], l = e[d], c = u[1];
						if (o && u[2]) {
							if (l === a && !(d in e)) return !1
						} else {
							var h = new wr;
							if (r) var f = r(l, c, d, e, t, h);
							if (!(f === a ? ai(c, l, p | m, r, h) : f)) return !1
						}
					}
					return !0
				}

				function oi(e) {
					return !(!Do(e) || ht && ht in e) && (Yo(e) ? mt : qe).test(ls(e))
				}

				function ui(e) {
					return "function" == typeof e ? e : null == e ? ju : "object" == typeof e ? yo(e) ? _i(e[0], e[1]) : fi(e) : Nu(e)
				}

				function di(e) {
					if (!Ka(e)) return Un(e);
					var t = [];
					for (var n in tt(e)) lt.call(e, n) && "constructor" != n && t.push(n);
					return t
				}

				function li(e) {
					if (!Do(e)) return function (e) {
						var t = [];
						if (null != e) for (var n in tt(e)) t.push(n);
						return t
					}(e);
					var t = Ka(e), n = [];
					for (var r in e) ("constructor" != r || !t && lt.call(e, r)) && n.push(r);
					return n
				}

				function ci(e, t) {
					return e < t
				}

				function hi(e, t) {
					var n = -1, i = vo(e) ? r(e.length) : [];
					return Nr(e, function (e, r, a) {
						i[++n] = t(e, r, a)
					}), i
				}

				function fi(e) {
					var t = Ra(e);
					return 1 == t.length && t[0][2] ? Za(t[0][0], t[0][1]) : function (n) {
						return n === e || si(n, e, t)
					}
				}

				function _i(e, t) {
					return Ja(e) && Xa(t) ? Za(ds(e), t) : function (n) {
						var r = Qo(n, e);
						return r === a && r === t ? eu(n, e) : ai(t, r, p | m)
					}
				}

				function pi(e, t, n, r, i) {
					e !== t && Br(t, function (s, o) {
						if (Do(s)) i || (i = new wr), function (e, t, n, r, i, s, o) {
							var u = ts(e, n), d = ts(t, n), l = o.get(d);
							if (l) Dr(e, n, l); else {
								var c = s ? s(u, d, n + "", e, t, o) : a, h = c === a;
								if (h) {
									var f = yo(d), _ = !f && Lo(d), p = !f && !_ && Po(d);
									c = d, f || _ || p ? yo(u) ? c = u : Mo(u) ? c = na(u) : _ ? (h = !1, c = Ki(d, !0)) : p ? (h = !1, c = Zi(d, !0)) : c = [] : Ho(d) || mo(d) ? (c = u, mo(u) ? c = Uo(u) : Do(u) && !Yo(u) || (c = $a(d))) : h = !1
								}
								h && (o.set(d, c), i(c, d, r, s, o), o.delete(d)), Dr(e, n, c)
							}
						}(e, t, o, n, pi, r, i); else {
							var u = r ? r(ts(e, o), s, o + "", e, t, i) : a;
							u === a && (u = s), Dr(e, o, u)
						}
					}, au)
				}

				function mi(e, t) {
					var n = e.length;
					if (n) return Ba(t += t < 0 ? n : 0, n) ? e[t] : a
				}

				function yi(e, t, n) {
					var r = -1;
					return t = Qt(t.length ? t : [ju], yn(Oa())), function (e, t) {
						var n = e.length;
						for (e.sort(t); n--;) e[n] = e[n].value;
						return e
					}(hi(e, function (e, n, i) {
						return {
							criteria: Qt(t, function (t) {
								return t(e)
							}), index: ++r, value: e
						}
					}), function (e, t) {
						return function (e, t, n) {
							for (var r = -1, i = e.criteria, a = t.criteria, s = i.length, o = n.length; ++r < s;) {
								var u = Qi(i[r], a[r]);
								if (u) {
									if (r >= o) return u;
									var d = n[r];
									return u * ("desc" == d ? -1 : 1)
								}
							}
							return e.index - t.index
						}(e, t, n)
					})
				}

				function gi(e, t, n) {
					for (var r = -1, i = t.length, a = {}; ++r < i;) {
						var s = t[r], o = Kr(e, s);
						n(o, s) && Ti(a, qi(s, e), o)
					}
					return a
				}

				function vi(e, t, n, r) {
					var i = r ? dn : un, a = -1, s = t.length, o = e;
					for (e === t && (t = na(t)), n && (o = Qt(e, yn(n))); ++a < s;) for (var u = 0, d = t[a], l = n ? n(d) : d; (u = i(o, l, u, r)) > -1;) o !== e && Ot.call(o, u, 1), Ot.call(e, u, 1);
					return e
				}

				function Mi(e, t) {
					for (var n = e ? t.length : 0, r = n - 1; n--;) {
						var i = t[n];
						if (n == r || i !== a) {
							var a = i;
							Ba(i) ? Ot.call(e, i, 1) : Wi(e, i)
						}
					}
					return e
				}

				function Li(e, t) {
					return e + Nn(Vn() * (t - e + 1))
				}

				function wi(e, t) {
					var n = "";
					if (!e || t < 1 || t > A) return n;
					do {
						t % 2 && (n += e), (t = Nn(t / 2)) && (e += e)
					} while (t);
					return n
				}

				function bi(e, t) {
					return is(Qa(e, t, ju), e + "")
				}

				function Yi(e) {
					return Yr(fu(e))
				}

				function ki(e, t) {
					var n = fu(e);
					return os(n, Ar(t, 0, n.length))
				}

				function Ti(e, t, n, r) {
					if (!Do(e)) return e;
					for (var i = -1, s = (t = qi(t, e)).length, o = s - 1, u = e; null != u && ++i < s;) {
						var d = ds(t[i]), l = n;
						if (i != o) {
							var c = u[d];
							(l = r ? r(c, d, u) : a) === a && (l = Do(c) ? c : Ba(t[i + 1]) ? [] : {})
						}
						Sr(u, d, l), u = u[d]
					}
					return e
				}

				var Di = rr ? function (e, t) {
					return rr.set(e, t), e
				} : ju, Si = fn ? function (e, t) {
					return fn(e, "toString", {configurable: !0, enumerable: !1, value: Du(t), writable: !0})
				} : ju;

				function xi(e) {
					return os(fu(e))
				}

				function ji(e, t, n) {
					var i = -1, a = e.length;
					t < 0 && (t = -t > a ? 0 : a + t), (n = n > a ? a : n) < 0 && (n += a), a = t > n ? 0 : n - t >>> 0, t >>>= 0;
					for (var s = r(a); ++i < a;) s[i] = e[i + t];
					return s
				}

				function Hi(e, t) {
					var n;
					return Nr(e, function (e, r, i) {
						return !(n = t(e, r, i))
					}), !!n
				}

				function Ei(e, t, n) {
					var r = 0, i = null == e ? r : e.length;
					if ("number" == typeof t && t == t && i <= N) {
						for (; r < i;) {
							var a = r + i >>> 1, s = e[a];
							null !== s && !Oo(s) && (n ? s <= t : s < t) ? r = a + 1 : i = a
						}
						return i
					}
					return Ci(e, t, ju, n)
				}

				function Ci(e, t, n, r) {
					t = n(t);
					for (var i = 0, s = null == e ? 0 : e.length, o = t != t, u = null === t, d = Oo(t), l = t === a; i < s;) {
						var c = Nn((i + s) / 2), h = n(e[c]), f = h !== a, _ = null === h, p = h == h, m = Oo(h);
						if (o) var y = r || p; else y = l ? p && (r || f) : u ? p && f && (r || !_) : d ? p && f && !_ && (r || !m) : !_ && !m && (r ? h <= t : h < t);
						y ? i = c + 1 : s = c
					}
					return qn(s, W)
				}

				function Ai(e, t) {
					for (var n = -1, r = e.length, i = 0, a = []; ++n < r;) {
						var s = e[n], o = t ? t(s) : s;
						if (!n || !fo(o, u)) {
							var u = o;
							a[i++] = 0 === s ? 0 : s
						}
					}
					return a
				}

				function Oi(e) {
					return "number" == typeof e ? e : Oo(e) ? P : +e
				}

				function Pi(e) {
					if ("string" == typeof e) return e;
					if (yo(e)) return Qt(e, Pi) + "";
					if (Oo(e)) return hr ? hr.call(e) : "";
					var t = e + "";
					return "0" == t && 1 / e == -C ? "-0" : t
				}

				function Ri(e, t, n) {
					var r = -1, i = Xt, a = e.length, o = !0, u = [], d = u;
					if (n) o = !1, i = Zt; else if (a >= s) {
						var l = t ? null : wa(e);
						if (l) return xn(l);
						o = !1, i = vn, d = new Lr
					} else d = t ? [] : u;
					e:for (; ++r < a;) {
						var c = e[r], h = t ? t(c) : c;
						if (c = n || 0 !== c ? c : 0, o && h == h) {
							for (var f = d.length; f--;) if (d[f] === h) continue e;
							t && d.push(h), u.push(c)
						} else i(d, h, n) || (d !== u && d.push(h), u.push(c))
					}
					return u
				}

				function Wi(e, t) {
					return null == (e = es(e, t = qi(t, e))) || delete e[ds(ws(t))]
				}

				function Ni(e, t, n, r) {
					return Ti(e, t, n(Kr(e, t)), r)
				}

				function Ii(e, t, n, r) {
					for (var i = e.length, a = r ? i : -1; (r ? a-- : ++a < i) && t(e[a], a, e);) ;
					return n ? ji(e, r ? 0 : a, r ? a + 1 : i) : ji(e, r ? a + 1 : 0, r ? i : a)
				}

				function Fi(e, t) {
					var n = e;
					return n instanceof yr && (n = n.value()), tn(t, function (e, t) {
						return t.func.apply(t.thisArg, en([e], t.args))
					}, n)
				}

				function zi(e, t, n) {
					var i = e.length;
					if (i < 2) return i ? Ri(e[0]) : [];
					for (var a = -1, s = r(i); ++a < i;) for (var o = e[a], u = -1; ++u < i;) u != a && (s[a] = Wr(s[a] || o, e[u], t, n));
					return Ri(Ur(s, 1), t, n)
				}

				function $i(e, t, n) {
					for (var r = -1, i = e.length, s = t.length, o = {}; ++r < i;) {
						var u = r < s ? t[r] : a;
						n(o, e[r], u)
					}
					return o
				}

				function Ui(e) {
					return Mo(e) ? e : []
				}

				function Bi(e) {
					return "function" == typeof e ? e : ju
				}

				function qi(e, t) {
					return yo(e) ? e : Ja(e, t) ? [e] : us(Bo(e))
				}

				var Ji = bi;

				function Gi(e, t, n) {
					var r = e.length;
					return n = n === a ? r : n, !t && n >= r ? e : ji(e, t, n)
				}

				var Vi = On || function (e) {
					return Ct.clearTimeout(e)
				};

				function Ki(e, t) {
					if (t) return e.slice();
					var n = e.length, r = St ? St(n) : new e.constructor(n);
					return e.copy(r), r
				}

				function Xi(e) {
					var t = new e.constructor(e.byteLength);
					return new wt(t).set(new wt(e)), t
				}

				function Zi(e, t) {
					var n = t ? Xi(e.buffer) : e.buffer;
					return new e.constructor(n, e.byteOffset, e.length)
				}

				function Qi(e, t) {
					if (e !== t) {
						var n = e !== a, r = null === e, i = e == e, s = Oo(e), o = t !== a, u = null === t, d = t == t,
							l = Oo(t);
						if (!u && !l && !s && e > t || s && o && d && !u && !l || r && o && d || !n && d || !i) return 1;
						if (!r && !s && !l && e < t || l && n && i && !r && !s || u && n && i || !o && i || !d) return -1
					}
					return 0
				}

				function ea(e, t, n, i) {
					for (var a = -1, s = e.length, o = n.length, u = -1, d = t.length, l = Bn(s - o, 0), c = r(d + l), h = !i; ++u < d;) c[u] = t[u];
					for (; ++a < o;) (h || a < s) && (c[n[a]] = e[a]);
					for (; l--;) c[u++] = e[a++];
					return c
				}

				function ta(e, t, n, i) {
					for (var a = -1, s = e.length, o = -1, u = n.length, d = -1, l = t.length, c = Bn(s - u, 0), h = r(c + l), f = !i; ++a < c;) h[a] = e[a];
					for (var _ = a; ++d < l;) h[_ + d] = t[d];
					for (; ++o < u;) (f || a < s) && (h[_ + n[o]] = e[a++]);
					return h
				}

				function na(e, t) {
					var n = -1, i = e.length;
					for (t || (t = r(i)); ++n < i;) t[n] = e[n];
					return t
				}

				function ra(e, t, n, r) {
					var i = !n;
					n || (n = {});
					for (var s = -1, o = t.length; ++s < o;) {
						var u = t[s], d = r ? r(n[u], e[u], u, n, e) : a;
						d === a && (d = e[u]), i ? Er(n, u, d) : Sr(n, u, d)
					}
					return n
				}

				function ia(e, t) {
					return function (n, r) {
						var i = yo(n) ? qt : jr, a = t ? t() : {};
						return i(n, e, Oa(r, 2), a)
					}
				}

				function aa(e) {
					return bi(function (t, n) {
						var r = -1, i = n.length, s = i > 1 ? n[i - 1] : a, o = i > 2 ? n[2] : a;
						for (s = e.length > 3 && "function" == typeof s ? (i--, s) : a, o && qa(n[0], n[1], o) && (s = i < 3 ? a : s, i = 1), t = tt(t); ++r < i;) {
							var u = n[r];
							u && e(t, u, r, s)
						}
						return t
					})
				}

				function sa(e, t) {
					return function (n, r) {
						if (null == n) return n;
						if (!vo(n)) return e(n, r);
						for (var i = n.length, a = t ? i : -1, s = tt(n); (t ? a-- : ++a < i) && !1 !== r(s[a], a, s);) ;
						return n
					}
				}

				function oa(e) {
					return function (t, n, r) {
						for (var i = -1, a = tt(t), s = r(t), o = s.length; o--;) {
							var u = s[e ? o : ++i];
							if (!1 === n(a[u], u, a)) break
						}
						return t
					}
				}

				function ua(e) {
					return function (t) {
						var n = kn(t = Bo(t)) ? En(t) : a, r = n ? n[0] : t.charAt(0),
							i = n ? Gi(n, 1).join("") : t.slice(1);
						return r[e]() + i
					}
				}

				function da(e) {
					return function (t) {
						return tn(Yu(mu(t).replace(gt, "")), e, "")
					}
				}

				function la(e) {
					return function () {
						var t = arguments;
						switch (t.length) {
							case 0:
								return new e;
							case 1:
								return new e(t[0]);
							case 2:
								return new e(t[0], t[1]);
							case 3:
								return new e(t[0], t[1], t[2]);
							case 4:
								return new e(t[0], t[1], t[2], t[3]);
							case 5:
								return new e(t[0], t[1], t[2], t[3], t[4]);
							case 6:
								return new e(t[0], t[1], t[2], t[3], t[4], t[5]);
							case 7:
								return new e(t[0], t[1], t[2], t[3], t[4], t[5], t[6])
						}
						var n = _r(e.prototype), r = e.apply(n, t);
						return Do(r) ? r : n
					}
				}

				function ca(e) {
					return function (t, n, r) {
						var i = tt(t);
						if (!vo(t)) {
							var s = Oa(n, 3);
							t = iu(t), n = function (e) {
								return s(i[e], e, i)
							}
						}
						var o = e(t, n, r);
						return o > -1 ? i[s ? t[o] : o] : a
					}
				}

				function ha(e) {
					return xa(function (t) {
						var n = t.length, r = n, i = mr.prototype.thru;
						for (e && t.reverse(); r--;) {
							var s = t[r];
							if ("function" != typeof s) throw new it(u);
							if (i && !o && "wrapper" == Ca(s)) var o = new mr([], !0)
						}
						for (r = o ? r : n; ++r < n;) {
							var d = Ca(s = t[r]), l = "wrapper" == d ? Ea(s) : a;
							o = l && Ga(l[0]) && l[1] == (Y | M | w | k) && !l[4].length && 1 == l[9] ? o[Ca(l[0])].apply(o, l[3]) : 1 == s.length && Ga(s) ? o[d]() : o.thru(s)
						}
						return function () {
							var e = arguments, r = e[0];
							if (o && 1 == e.length && yo(r)) return o.plant(r).value();
							for (var i = 0, a = n ? t[i].apply(this, e) : r; ++i < n;) a = t[i].call(this, a);
							return a
						}
					})
				}

				function fa(e, t, n, i, s, o, u, d, l, c) {
					var h = t & Y, f = t & y, _ = t & g, p = t & (M | L), m = t & T, v = _ ? a : la(e);
					return function y() {
						for (var g = arguments.length, M = r(g), L = g; L--;) M[L] = arguments[L];
						if (p) var w = Aa(y), b = function (e, t) {
							for (var n = e.length, r = 0; n--;) e[n] === t && ++r;
							return r
						}(M, w);
						if (i && (M = ea(M, i, s, p)), o && (M = ta(M, o, u, p)), g -= b, p && g < c) {
							var Y = Sn(M, w);
							return Ma(e, t, fa, y.placeholder, n, M, Y, d, l, c - g)
						}
						var k = f ? n : this, T = _ ? k[e] : e;
						return g = M.length, d ? M = function (e, t) {
							for (var n = e.length, r = qn(t.length, n), i = na(e); r--;) {
								var s = t[r];
								e[r] = Ba(s, n) ? i[s] : a
							}
							return e
						}(M, d) : m && g > 1 && M.reverse(), h && l < g && (M.length = l), this && this !== Ct && this instanceof y && (T = v || la(T)), T.apply(k, M)
					}
				}

				function _a(e, t) {
					return function (n, r) {
						return function (e, t, n, r) {
							return Jr(e, function (e, i, a) {
								t(r, n(e), i, a)
							}), r
						}(n, e, t(r), {})
					}
				}

				function pa(e, t) {
					return function (n, r) {
						var i;
						if (n === a && r === a) return t;
						if (n !== a && (i = n), r !== a) {
							if (i === a) return r;
							"string" == typeof n || "string" == typeof r ? (n = Pi(n), r = Pi(r)) : (n = Oi(n), r = Oi(r)), i = e(n, r)
						}
						return i
					}
				}

				function ma(e) {
					return xa(function (t) {
						return t = Qt(t, yn(Oa())), bi(function (n) {
							var r = this;
							return e(t, function (e) {
								return Bt(e, r, n)
							})
						})
					})
				}

				function ya(e, t) {
					var n = (t = t === a ? " " : Pi(t)).length;
					if (n < 2) return n ? wi(t, e) : t;
					var r = wi(t, Wn(e / Hn(t)));
					return kn(t) ? Gi(En(r), 0, e).join("") : r.slice(0, e)
				}

				function ga(e) {
					return function (t, n, i) {
						return i && "number" != typeof i && qa(t, n, i) && (n = i = a), t = Io(t), n === a ? (n = t, t = 0) : n = Io(n), function (e, t, n, i) {
							for (var a = -1, s = Bn(Wn((t - e) / (n || 1)), 0), o = r(s); s--;) o[i ? s : ++a] = e, e += n;
							return o
						}(t, n, i = i === a ? t < n ? 1 : -1 : Io(i), e)
					}
				}

				function va(e) {
					return function (t, n) {
						return "string" == typeof t && "string" == typeof n || (t = $o(t), n = $o(n)), e(t, n)
					}
				}

				function Ma(e, t, n, r, i, s, o, u, d, l) {
					var c = t & M;
					t |= c ? w : b, (t &= ~(c ? b : w)) & v || (t &= ~(y | g));
					var h = [e, t, i, c ? s : a, c ? o : a, c ? a : s, c ? a : o, u, d, l], f = n.apply(a, h);
					return Ga(e) && ns(f, h), f.placeholder = r, as(f, e, t)
				}

				function La(e) {
					var t = et[e];
					return function (e, n) {
						if (e = $o(e), n = null == n ? 0 : qn(Fo(n), 292)) {
							var r = (Bo(e) + "e").split("e");
							return +((r = (Bo(t(r[0] + "e" + (+r[1] + n))) + "e").split("e"))[0] + "e" + (+r[1] - n))
						}
						return t(e)
					}
				}

				var wa = er && 1 / xn(new er([, -0]))[1] == C ? function (e) {
					return new er(e)
				} : Ou;

				function ba(e) {
					return function (t) {
						var n = Fa(t);
						return n == K ? Tn(t) : n == ne ? jn(t) : function (e, t) {
							return Qt(t, function (t) {
								return [t, e[t]]
							})
						}(t, e(t))
					}
				}

				function Ya(e, t, n, i, s, o, d, l) {
					var h = t & g;
					if (!h && "function" != typeof e) throw new it(u);
					var f = i ? i.length : 0;
					if (f || (t &= ~(w | b), i = s = a), d = d === a ? d : Bn(Fo(d), 0), l = l === a ? l : Fo(l), f -= s ? s.length : 0, t & b) {
						var _ = i, p = s;
						i = s = a
					}
					var m = h ? a : Ea(e), T = [e, t, n, i, s, _, p, o, d, l];
					if (m && function (e, t) {
						var n = e[1], r = t[1], i = n | r, a = i < (y | g | Y),
							s = r == Y && n == M || r == Y && n == k && e[7].length <= t[8] || r == (Y | k) && t[7].length <= t[8] && n == M;
						if (!a && !s) return e;
						r & y && (e[2] = t[2], i |= n & y ? 0 : v);
						var o = t[3];
						if (o) {
							var u = e[3];
							e[3] = u ? ea(u, o, t[4]) : o, e[4] = u ? Sn(e[3], c) : t[4]
						}
						(o = t[5]) && (u = e[5], e[5] = u ? ta(u, o, t[6]) : o, e[6] = u ? Sn(e[5], c) : t[6]), (o = t[7]) && (e[7] = o), r & Y && (e[8] = null == e[8] ? t[8] : qn(e[8], t[8])), null == e[9] && (e[9] = t[9]), e[0] = t[0], e[1] = i
					}(T, m), e = T[0], t = T[1], n = T[2], i = T[3], s = T[4], !(l = T[9] = T[9] === a ? h ? 0 : e.length : Bn(T[9] - f, 0)) && t & (M | L) && (t &= ~(M | L)), t && t != y) D = t == M || t == L ? function (e, t, n) {
						var i = la(e);
						return function s() {
							for (var o = arguments.length, u = r(o), d = o, l = Aa(s); d--;) u[d] = arguments[d];
							var c = o < 3 && u[0] !== l && u[o - 1] !== l ? [] : Sn(u, l);
							return (o -= c.length) < n ? Ma(e, t, fa, s.placeholder, a, u, c, a, a, n - o) : Bt(this && this !== Ct && this instanceof s ? i : e, this, u)
						}
					}(e, t, l) : t != w && t != (y | w) || s.length ? fa.apply(a, T) : function (e, t, n, i) {
						var a = t & y, s = la(e);
						return function t() {
							for (var o = -1, u = arguments.length, d = -1, l = i.length, c = r(l + u), h = this && this !== Ct && this instanceof t ? s : e; ++d < l;) c[d] = i[d];
							for (; u--;) c[d++] = arguments[++o];
							return Bt(h, a ? n : this, c)
						}
					}(e, t, n, i); else var D = function (e, t, n) {
						var r = t & y, i = la(e);
						return function t() {
							return (this && this !== Ct && this instanceof t ? i : e).apply(r ? n : this, arguments)
						}
					}(e, t, n);
					return as((m ? Di : ns)(D, T), e, t)
				}

				function ka(e, t, n, r) {
					return e === a || fo(e, ot[n]) && !lt.call(r, n) ? t : e
				}

				function Ta(e, t, n, r, i, s) {
					return Do(e) && Do(t) && (s.set(t, e), pi(e, t, a, Ta, s), s.delete(t)), e
				}

				function Da(e) {
					return Ho(e) ? a : e
				}

				function Sa(e, t, n, r, i, s) {
					var o = n & p, u = e.length, d = t.length;
					if (u != d && !(o && d > u)) return !1;
					var l = s.get(e);
					if (l && s.get(t)) return l == t;
					var c = -1, h = !0, f = n & m ? new Lr : a;
					for (s.set(e, t), s.set(t, e); ++c < u;) {
						var _ = e[c], y = t[c];
						if (r) var g = o ? r(y, _, c, t, e, s) : r(_, y, c, e, t, s);
						if (g !== a) {
							if (g) continue;
							h = !1;
							break
						}
						if (f) {
							if (!rn(t, function (e, t) {
								if (!vn(f, t) && (_ === e || i(_, e, n, r, s))) return f.push(t)
							})) {
								h = !1;
								break
							}
						} else if (_ !== y && !i(_, y, n, r, s)) {
							h = !1;
							break
						}
					}
					return s.delete(e), s.delete(t), h
				}

				function xa(e) {
					return is(Qa(e, a, ys), e + "")
				}

				function ja(e) {
					return Xr(e, iu, Na)
				}

				function Ha(e) {
					return Xr(e, au, Ia)
				}

				var Ea = rr ? function (e) {
					return rr.get(e)
				} : Ou;

				function Ca(e) {
					for (var t = e.name + "", n = ir[t], r = lt.call(ir, t) ? n.length : 0; r--;) {
						var i = n[r], a = i.func;
						if (null == a || a == e) return i.name
					}
					return t
				}

				function Aa(e) {
					return (lt.call(fr, "placeholder") ? fr : e).placeholder
				}

				function Oa() {
					var e = fr.iteratee || Hu;
					return e = e === Hu ? ui : e, arguments.length ? e(arguments[0], arguments[1]) : e
				}

				function Pa(e, t) {
					var n, r, i = e.__data__;
					return ("string" == (r = typeof(n = t)) || "number" == r || "symbol" == r || "boolean" == r ? "__proto__" !== n : null === n) ? i["string" == typeof t ? "string" : "hash"] : i.map
				}

				function Ra(e) {
					for (var t = iu(e), n = t.length; n--;) {
						var r = t[n], i = e[r];
						t[n] = [r, i, Xa(i)]
					}
					return t
				}

				function Wa(e, t) {
					var n = function (e, t) {
						return null == e ? a : e[t]
					}(e, t);
					return oi(n) ? n : a
				}

				var Na = In ? function (e) {
					return null == e ? [] : (e = tt(e), Kt(In(e), function (t) {
						return At.call(e, t)
					}))
				} : zu, Ia = In ? function (e) {
					for (var t = []; e;) en(t, Na(e)), e = Ht(e);
					return t
				} : zu, Fa = Zr;

				function za(e, t, n) {
					for (var r = -1, i = (t = qi(t, e)).length, a = !1; ++r < i;) {
						var s = ds(t[r]);
						if (!(a = null != e && n(e, s))) break;
						e = e[s]
					}
					return a || ++r != i ? a : !!(i = null == e ? 0 : e.length) && To(i) && Ba(s, i) && (yo(e) || mo(e))
				}

				function $a(e) {
					return "function" != typeof e.constructor || Ka(e) ? {} : _r(Ht(e))
				}

				function Ua(e) {
					return yo(e) || mo(e) || !!(Rt && e && e[Rt])
				}

				function Ba(e, t) {
					var n = typeof e;
					return !!(t = null == t ? A : t) && ("number" == n || "symbol" != n && Ge.test(e)) && e > -1 && e % 1 == 0 && e < t
				}

				function qa(e, t, n) {
					if (!Do(n)) return !1;
					var r = typeof t;
					return !!("number" == r ? vo(n) && Ba(t, n.length) : "string" == r && t in n) && fo(n[t], e)
				}

				function Ja(e, t) {
					if (yo(e)) return !1;
					var n = typeof e;
					return !("number" != n && "symbol" != n && "boolean" != n && null != e && !Oo(e)) || je.test(e) || !xe.test(e) || null != t && e in tt(t)
				}

				function Ga(e) {
					var t = Ca(e), n = fr[t];
					if ("function" != typeof n || !(t in yr.prototype)) return !1;
					if (e === n) return !0;
					var r = Ea(n);
					return !!r && e === r[0]
				}

				(Xn && Fa(new Xn(new ArrayBuffer(1))) != de || Zn && Fa(new Zn) != K || Qn && "[object Promise]" != Fa(Qn.resolve()) || er && Fa(new er) != ne || tr && Fa(new tr) != se) && (Fa = function (e) {
					var t = Zr(e), n = t == Q ? e.constructor : a, r = n ? ls(n) : "";
					if (r) switch (r) {
						case ar:
							return de;
						case sr:
							return K;
						case or:
							return "[object Promise]";
						case ur:
							return ne;
						case dr:
							return se
					}
					return t
				});
				var Va = ut ? Yo : $u;

				function Ka(e) {
					var t = e && e.constructor;
					return e === ("function" == typeof t && t.prototype || ot)
				}

				function Xa(e) {
					return e == e && !Do(e)
				}

				function Za(e, t) {
					return function (n) {
						return null != n && n[e] === t && (t !== a || e in tt(n))
					}
				}

				function Qa(e, t, n) {
					return t = Bn(t === a ? e.length - 1 : t, 0), function () {
						for (var i = arguments, a = -1, s = Bn(i.length - t, 0), o = r(s); ++a < s;) o[a] = i[t + a];
						a = -1;
						for (var u = r(t + 1); ++a < t;) u[a] = i[a];
						return u[t] = n(o), Bt(e, this, u)
					}
				}

				function es(e, t) {
					return t.length < 2 ? e : Kr(e, ji(t, 0, -1))
				}

				function ts(e, t) {
					if ("__proto__" != t) return e[t]
				}

				var ns = ss(Di), rs = Rn || function (e, t) {
					return Ct.setTimeout(e, t)
				}, is = ss(Si);

				function as(e, t, n) {
					var r = t + "";
					return is(e, function (e, t) {
						var n = t.length;
						if (!n) return e;
						var r = n - 1;
						return t[r] = (n > 1 ? "& " : "") + t[r], t = t.join(n > 2 ? ", " : " "), e.replace(Re, "{\n/* [wrapped with " + t + "] */\n")
					}(r, function (e, t) {
						return Jt(I, function (n) {
							var r = "_." + n[0];
							t & n[1] && !Xt(e, r) && e.push(r)
						}), e.sort()
					}(function (e) {
						var t = e.match(We);
						return t ? t[1].split(Ne) : []
					}(r), n)))
				}

				function ss(e) {
					var t = 0, n = 0;
					return function () {
						var r = Jn(), i = j - (r - n);
						if (n = r, i > 0) {
							if (++t >= x) return arguments[0]
						} else t = 0;
						return e.apply(a, arguments)
					}
				}

				function os(e, t) {
					var n = -1, r = e.length, i = r - 1;
					for (t = t === a ? r : t; ++n < t;) {
						var s = Li(n, i), o = e[s];
						e[s] = e[n], e[n] = o
					}
					return e.length = t, e
				}

				var us = function (e) {
					var t = so(e, function (e) {
						return n.size === l && n.clear(), e
					}), n = t.cache;
					return t
				}(function (e) {
					var t = [];
					return 46 === e.charCodeAt(0) && t.push(""), e.replace(He, function (e, n, r, i) {
						t.push(r ? i.replace(Fe, "$1") : n || e)
					}), t
				});

				function ds(e) {
					if ("string" == typeof e || Oo(e)) return e;
					var t = e + "";
					return "0" == t && 1 / e == -C ? "-0" : t
				}

				function ls(e) {
					if (null != e) {
						try {
							return dt.call(e)
						} catch (e) {
						}
						try {
							return e + ""
						} catch (e) {
						}
					}
					return ""
				}

				function cs(e) {
					if (e instanceof yr) return e.clone();
					var t = new mr(e.__wrapped__, e.__chain__);
					return t.__actions__ = na(e.__actions__), t.__index__ = e.__index__, t.__values__ = e.__values__, t
				}

				var hs = bi(function (e, t) {
					return Mo(e) ? Wr(e, Ur(t, 1, Mo, !0)) : []
				}), fs = bi(function (e, t) {
					var n = ws(t);
					return Mo(n) && (n = a), Mo(e) ? Wr(e, Ur(t, 1, Mo, !0), Oa(n, 2)) : []
				}), _s = bi(function (e, t) {
					var n = ws(t);
					return Mo(n) && (n = a), Mo(e) ? Wr(e, Ur(t, 1, Mo, !0), a, n) : []
				});

				function ps(e, t, n) {
					var r = null == e ? 0 : e.length;
					if (!r) return -1;
					var i = null == n ? 0 : Fo(n);
					return i < 0 && (i = Bn(r + i, 0)), on(e, Oa(t, 3), i)
				}

				function ms(e, t, n) {
					var r = null == e ? 0 : e.length;
					if (!r) return -1;
					var i = r - 1;
					return n !== a && (i = Fo(n), i = n < 0 ? Bn(r + i, 0) : qn(i, r - 1)), on(e, Oa(t, 3), i, !0)
				}

				function ys(e) {
					return null != e && e.length ? Ur(e, 1) : []
				}

				function gs(e) {
					return e && e.length ? e[0] : a
				}

				var vs = bi(function (e) {
					var t = Qt(e, Ui);
					return t.length && t[0] === e[0] ? ni(t) : []
				}), Ms = bi(function (e) {
					var t = ws(e), n = Qt(e, Ui);
					return t === ws(n) ? t = a : n.pop(), n.length && n[0] === e[0] ? ni(n, Oa(t, 2)) : []
				}), Ls = bi(function (e) {
					var t = ws(e), n = Qt(e, Ui);
					return (t = "function" == typeof t ? t : a) && n.pop(), n.length && n[0] === e[0] ? ni(n, a, t) : []
				});

				function ws(e) {
					var t = null == e ? 0 : e.length;
					return t ? e[t - 1] : a
				}

				var bs = bi(Ys);

				function Ys(e, t) {
					return e && e.length && t && t.length ? vi(e, t) : e
				}

				var ks = xa(function (e, t) {
					var n = null == e ? 0 : e.length, r = Cr(e, t);
					return Mi(e, Qt(t, function (e) {
						return Ba(e, n) ? +e : e
					}).sort(Qi)), r
				});

				function Ts(e) {
					return null == e ? e : Kn.call(e)
				}

				var Ds = bi(function (e) {
					return Ri(Ur(e, 1, Mo, !0))
				}), Ss = bi(function (e) {
					var t = ws(e);
					return Mo(t) && (t = a), Ri(Ur(e, 1, Mo, !0), Oa(t, 2))
				}), xs = bi(function (e) {
					var t = ws(e);
					return t = "function" == typeof t ? t : a, Ri(Ur(e, 1, Mo, !0), a, t)
				});

				function js(e) {
					if (!e || !e.length) return [];
					var t = 0;
					return e = Kt(e, function (e) {
						if (Mo(e)) return t = Bn(e.length, t), !0
					}), mn(t, function (t) {
						return Qt(e, hn(t))
					})
				}

				function Hs(e, t) {
					if (!e || !e.length) return [];
					var n = js(e);
					return null == t ? n : Qt(n, function (e) {
						return Bt(t, a, e)
					})
				}

				var Es = bi(function (e, t) {
					return Mo(e) ? Wr(e, t) : []
				}), Cs = bi(function (e) {
					return zi(Kt(e, Mo))
				}), As = bi(function (e) {
					var t = ws(e);
					return Mo(t) && (t = a), zi(Kt(e, Mo), Oa(t, 2))
				}), Os = bi(function (e) {
					var t = ws(e);
					return t = "function" == typeof t ? t : a, zi(Kt(e, Mo), a, t)
				}), Ps = bi(js);
				var Rs = bi(function (e) {
					var t = e.length, n = t > 1 ? e[t - 1] : a;
					return Hs(e, n = "function" == typeof n ? (e.pop(), n) : a)
				});

				function Ws(e) {
					var t = fr(e);
					return t.__chain__ = !0, t
				}

				function Ns(e, t) {
					return t(e)
				}

				var Is = xa(function (e) {
					var t = e.length, n = t ? e[0] : 0, r = this.__wrapped__, i = function (t) {
						return Cr(t, e)
					};
					return !(t > 1 || this.__actions__.length) && r instanceof yr && Ba(n) ? ((r = r.slice(n, +n + (t ? 1 : 0))).__actions__.push({
						func: Ns,
						args: [i],
						thisArg: a
					}), new mr(r, this.__chain__).thru(function (e) {
						return t && !e.length && e.push(a), e
					})) : this.thru(i)
				});
				var Fs = ia(function (e, t, n) {
					lt.call(e, n) ? ++e[n] : Er(e, n, 1)
				});
				var zs = ca(ps), $s = ca(ms);

				function Us(e, t) {
					return (yo(e) ? Jt : Nr)(e, Oa(t, 3))
				}

				function Bs(e, t) {
					return (yo(e) ? Gt : Ir)(e, Oa(t, 3))
				}

				var qs = ia(function (e, t, n) {
					lt.call(e, n) ? e[n].push(t) : Er(e, n, [t])
				});
				var Js = bi(function (e, t, n) {
					var i = -1, a = "function" == typeof t, s = vo(e) ? r(e.length) : [];
					return Nr(e, function (e) {
						s[++i] = a ? Bt(t, e, n) : ri(e, t, n)
					}), s
				}), Gs = ia(function (e, t, n) {
					Er(e, n, t)
				});

				function Vs(e, t) {
					return (yo(e) ? Qt : hi)(e, Oa(t, 3))
				}

				var Ks = ia(function (e, t, n) {
					e[n ? 0 : 1].push(t)
				}, function () {
					return [[], []]
				});
				var Xs = bi(function (e, t) {
					if (null == e) return [];
					var n = t.length;
					return n > 1 && qa(e, t[0], t[1]) ? t = [] : n > 2 && qa(t[0], t[1], t[2]) && (t = [t[0]]), yi(e, Ur(t, 1), [])
				}), Zs = Pn || function () {
					return Ct.Date.now()
				};

				function Qs(e, t, n) {
					return t = n ? a : t, t = e && null == t ? e.length : t, Ya(e, Y, a, a, a, a, t)
				}

				function eo(e, t) {
					var n;
					if ("function" != typeof t) throw new it(u);
					return e = Fo(e), function () {
						return --e > 0 && (n = t.apply(this, arguments)), e <= 1 && (t = a), n
					}
				}

				var to = bi(function (e, t, n) {
					var r = y;
					if (n.length) {
						var i = Sn(n, Aa(to));
						r |= w
					}
					return Ya(e, r, t, n, i)
				}), no = bi(function (e, t, n) {
					var r = y | g;
					if (n.length) {
						var i = Sn(n, Aa(no));
						r |= w
					}
					return Ya(t, r, e, n, i)
				});

				function ro(e, t, n) {
					var r, i, s, o, d, l, c = 0, h = !1, f = !1, _ = !0;
					if ("function" != typeof e) throw new it(u);

					function p(t) {
						var n = r, s = i;
						return r = i = a, c = t, o = e.apply(s, n)
					}

					function m(e) {
						var n = e - l;
						return l === a || n >= t || n < 0 || f && e - c >= s
					}

					function y() {
						var e = Zs();
						if (m(e)) return g(e);
						d = rs(y, function (e) {
							var n = t - (e - l);
							return f ? qn(n, s - (e - c)) : n
						}(e))
					}

					function g(e) {
						return d = a, _ && r ? p(e) : (r = i = a, o)
					}

					function v() {
						var e = Zs(), n = m(e);
						if (r = arguments, i = this, l = e, n) {
							if (d === a) return function (e) {
								return c = e, d = rs(y, t), h ? p(e) : o
							}(l);
							if (f) return d = rs(y, t), p(l)
						}
						return d === a && (d = rs(y, t)), o
					}

					return t = $o(t) || 0, Do(n) && (h = !!n.leading, s = (f = "maxWait" in n) ? Bn($o(n.maxWait) || 0, t) : s, _ = "trailing" in n ? !!n.trailing : _), v.cancel = function () {
						d !== a && Vi(d), c = 0, r = l = i = d = a
					}, v.flush = function () {
						return d === a ? o : g(Zs())
					}, v
				}

				var io = bi(function (e, t) {
					return Rr(e, 1, t)
				}), ao = bi(function (e, t, n) {
					return Rr(e, $o(t) || 0, n)
				});

				function so(e, t) {
					if ("function" != typeof e || null != t && "function" != typeof t) throw new it(u);
					var n = function () {
						var r = arguments, i = t ? t.apply(this, r) : r[0], a = n.cache;
						if (a.has(i)) return a.get(i);
						var s = e.apply(this, r);
						return n.cache = a.set(i, s) || a, s
					};
					return n.cache = new (so.Cache || Mr), n
				}

				function oo(e) {
					if ("function" != typeof e) throw new it(u);
					return function () {
						var t = arguments;
						switch (t.length) {
							case 0:
								return !e.call(this);
							case 1:
								return !e.call(this, t[0]);
							case 2:
								return !e.call(this, t[0], t[1]);
							case 3:
								return !e.call(this, t[0], t[1], t[2])
						}
						return !e.apply(this, t)
					}
				}

				so.Cache = Mr;
				var uo = Ji(function (e, t) {
					var n = (t = 1 == t.length && yo(t[0]) ? Qt(t[0], yn(Oa())) : Qt(Ur(t, 1), yn(Oa()))).length;
					return bi(function (r) {
						for (var i = -1, a = qn(r.length, n); ++i < a;) r[i] = t[i].call(this, r[i]);
						return Bt(e, this, r)
					})
				}), lo = bi(function (e, t) {
					var n = Sn(t, Aa(lo));
					return Ya(e, w, a, t, n)
				}), co = bi(function (e, t) {
					var n = Sn(t, Aa(co));
					return Ya(e, b, a, t, n)
				}), ho = xa(function (e, t) {
					return Ya(e, k, a, a, a, t)
				});

				function fo(e, t) {
					return e === t || e != e && t != t
				}

				var _o = va(Qr), po = va(function (e, t) {
					return e >= t
				}), mo = ii(function () {
					return arguments
				}()) ? ii : function (e) {
					return So(e) && lt.call(e, "callee") && !At.call(e, "callee")
				}, yo = r.isArray, go = Nt ? yn(Nt) : function (e) {
					return So(e) && Zr(e) == ue
				};

				function vo(e) {
					return null != e && To(e.length) && !Yo(e)
				}

				function Mo(e) {
					return So(e) && vo(e)
				}

				var Lo = Fn || $u, wo = It ? yn(It) : function (e) {
					return So(e) && Zr(e) == B
				};

				function bo(e) {
					if (!So(e)) return !1;
					var t = Zr(e);
					return t == J || t == q || "string" == typeof e.message && "string" == typeof e.name && !Ho(e)
				}

				function Yo(e) {
					if (!Do(e)) return !1;
					var t = Zr(e);
					return t == G || t == V || t == $ || t == ee
				}

				function ko(e) {
					return "number" == typeof e && e == Fo(e)
				}

				function To(e) {
					return "number" == typeof e && e > -1 && e % 1 == 0 && e <= A
				}

				function Do(e) {
					var t = typeof e;
					return null != e && ("object" == t || "function" == t)
				}

				function So(e) {
					return null != e && "object" == typeof e
				}

				var xo = Ft ? yn(Ft) : function (e) {
					return So(e) && Fa(e) == K
				};

				function jo(e) {
					return "number" == typeof e || So(e) && Zr(e) == X
				}

				function Ho(e) {
					if (!So(e) || Zr(e) != Q) return !1;
					var t = Ht(e);
					if (null === t) return !0;
					var n = lt.call(t, "constructor") && t.constructor;
					return "function" == typeof n && n instanceof n && dt.call(n) == _t
				}

				var Eo = zt ? yn(zt) : function (e) {
					return So(e) && Zr(e) == te
				};
				var Co = $t ? yn($t) : function (e) {
					return So(e) && Fa(e) == ne
				};

				function Ao(e) {
					return "string" == typeof e || !yo(e) && So(e) && Zr(e) == re
				}

				function Oo(e) {
					return "symbol" == typeof e || So(e) && Zr(e) == ie
				}

				var Po = Ut ? yn(Ut) : function (e) {
					return So(e) && To(e.length) && !!Tt[Zr(e)]
				};
				var Ro = va(ci), Wo = va(function (e, t) {
					return e <= t
				});

				function No(e) {
					if (!e) return [];
					if (vo(e)) return Ao(e) ? En(e) : na(e);
					if (Wt && e[Wt]) return function (e) {
						for (var t, n = []; !(t = e.next()).done;) n.push(t.value);
						return n
					}(e[Wt]());
					var t = Fa(e);
					return (t == K ? Tn : t == ne ? xn : fu)(e)
				}

				function Io(e) {
					return e ? (e = $o(e)) === C || e === -C ? (e < 0 ? -1 : 1) * O : e == e ? e : 0 : 0 === e ? e : 0
				}

				function Fo(e) {
					var t = Io(e), n = t % 1;
					return t == t ? n ? t - n : t : 0
				}

				function zo(e) {
					return e ? Ar(Fo(e), 0, R) : 0
				}

				function $o(e) {
					if ("number" == typeof e) return e;
					if (Oo(e)) return P;
					if (Do(e)) {
						var t = "function" == typeof e.valueOf ? e.valueOf() : e;
						e = Do(t) ? t + "" : t
					}
					if ("string" != typeof e) return 0 === e ? e : +e;
					e = e.replace(Ae, "");
					var n = Be.test(e);
					return n || Je.test(e) ? jt(e.slice(2), n ? 2 : 8) : Ue.test(e) ? P : +e
				}

				function Uo(e) {
					return ra(e, au(e))
				}

				function Bo(e) {
					return null == e ? "" : Pi(e)
				}

				var qo = aa(function (e, t) {
					if (Ka(t) || vo(t)) ra(t, iu(t), e); else for (var n in t) lt.call(t, n) && Sr(e, n, t[n])
				}), Jo = aa(function (e, t) {
					ra(t, au(t), e)
				}), Go = aa(function (e, t, n, r) {
					ra(t, au(t), e, r)
				}), Vo = aa(function (e, t, n, r) {
					ra(t, iu(t), e, r)
				}), Ko = xa(Cr);
				var Xo = bi(function (e, t) {
					e = tt(e);
					var n = -1, r = t.length, i = r > 2 ? t[2] : a;
					for (i && qa(t[0], t[1], i) && (r = 1); ++n < r;) for (var s = t[n], o = au(s), u = -1, d = o.length; ++u < d;) {
						var l = o[u], c = e[l];
						(c === a || fo(c, ot[l]) && !lt.call(e, l)) && (e[l] = s[l])
					}
					return e
				}), Zo = bi(function (e) {
					return e.push(a, Ta), Bt(ou, a, e)
				});

				function Qo(e, t, n) {
					var r = null == e ? a : Kr(e, t);
					return r === a ? n : r
				}

				function eu(e, t) {
					return null != e && za(e, t, ti)
				}

				var tu = _a(function (e, t, n) {
					null != t && "function" != typeof t.toString && (t = ft.call(t)), e[t] = n
				}, Du(ju)), nu = _a(function (e, t, n) {
					null != t && "function" != typeof t.toString && (t = ft.call(t)), lt.call(e, t) ? e[t].push(n) : e[t] = [n]
				}, Oa), ru = bi(ri);

				function iu(e) {
					return vo(e) ? br(e) : di(e)
				}

				function au(e) {
					return vo(e) ? br(e, !0) : li(e)
				}

				var su = aa(function (e, t, n) {
					pi(e, t, n)
				}), ou = aa(function (e, t, n, r) {
					pi(e, t, n, r)
				}), uu = xa(function (e, t) {
					var n = {};
					if (null == e) return n;
					var r = !1;
					t = Qt(t, function (t) {
						return t = qi(t, e), r || (r = t.length > 1), t
					}), ra(e, Ha(e), n), r && (n = Or(n, h | f | _, Da));
					for (var i = t.length; i--;) Wi(n, t[i]);
					return n
				});
				var du = xa(function (e, t) {
					return null == e ? {} : function (e, t) {
						return gi(e, t, function (t, n) {
							return eu(e, n)
						})
					}(e, t)
				});

				function lu(e, t) {
					if (null == e) return {};
					var n = Qt(Ha(e), function (e) {
						return [e]
					});
					return t = Oa(t), gi(e, n, function (e, n) {
						return t(e, n[0])
					})
				}

				var cu = ba(iu), hu = ba(au);

				function fu(e) {
					return null == e ? [] : gn(e, iu(e))
				}

				var _u = da(function (e, t, n) {
					return t = t.toLowerCase(), e + (n ? pu(t) : t)
				});

				function pu(e) {
					return bu(Bo(e).toLowerCase())
				}

				function mu(e) {
					return (e = Bo(e)) && e.replace(Ve, wn).replace(vt, "")
				}

				var yu = da(function (e, t, n) {
					return e + (n ? "-" : "") + t.toLowerCase()
				}), gu = da(function (e, t, n) {
					return e + (n ? " " : "") + t.toLowerCase()
				}), vu = ua("toLowerCase");
				var Mu = da(function (e, t, n) {
					return e + (n ? "_" : "") + t.toLowerCase()
				});
				var Lu = da(function (e, t, n) {
					return e + (n ? " " : "") + bu(t)
				});
				var wu = da(function (e, t, n) {
					return e + (n ? " " : "") + t.toUpperCase()
				}), bu = ua("toUpperCase");

				function Yu(e, t, n) {
					return e = Bo(e), (t = n ? a : t) === a ? function (e) {
						return bt.test(e)
					}(e) ? function (e) {
						return e.match(Lt) || []
					}(e) : function (e) {
						return e.match(Ie) || []
					}(e) : e.match(t) || []
				}

				var ku = bi(function (e, t) {
					try {
						return Bt(e, a, t)
					} catch (e) {
						return bo(e) ? e : new Ze(e)
					}
				}), Tu = xa(function (e, t) {
					return Jt(t, function (t) {
						t = ds(t), Er(e, t, to(e[t], e))
					}), e
				});

				function Du(e) {
					return function () {
						return e
					}
				}

				var Su = ha(), xu = ha(!0);

				function ju(e) {
					return e
				}

				function Hu(e) {
					return ui("function" == typeof e ? e : Or(e, h))
				}

				var Eu = bi(function (e, t) {
					return function (n) {
						return ri(n, e, t)
					}
				}), Cu = bi(function (e, t) {
					return function (n) {
						return ri(e, n, t)
					}
				});

				function Au(e, t, n) {
					var r = iu(t), i = Vr(t, r);
					null != n || Do(t) && (i.length || !r.length) || (n = t, t = e, e = this, i = Vr(t, iu(t)));
					var a = !(Do(n) && "chain" in n && !n.chain), s = Yo(e);
					return Jt(i, function (n) {
						var r = t[n];
						e[n] = r, s && (e.prototype[n] = function () {
							var t = this.__chain__;
							if (a || t) {
								var n = e(this.__wrapped__);
								return (n.__actions__ = na(this.__actions__)).push({
									func: r,
									args: arguments,
									thisArg: e
								}), n.__chain__ = t, n
							}
							return r.apply(e, en([this.value()], arguments))
						})
					}), e
				}

				function Ou() {
				}

				var Pu = ma(Qt), Ru = ma(Vt), Wu = ma(rn);

				function Nu(e) {
					return Ja(e) ? hn(ds(e)) : function (e) {
						return function (t) {
							return Kr(t, e)
						}
					}(e)
				}

				var Iu = ga(), Fu = ga(!0);

				function zu() {
					return []
				}

				function $u() {
					return !1
				}

				var Uu = pa(function (e, t) {
					return e + t
				}, 0), Bu = La("ceil"), qu = pa(function (e, t) {
					return e / t
				}, 1), Ju = La("floor");
				var Gu, Vu = pa(function (e, t) {
					return e * t
				}, 1), Ku = La("round"), Xu = pa(function (e, t) {
					return e - t
				}, 0);
				return fr.after = function (e, t) {
					if ("function" != typeof t) throw new it(u);
					return e = Fo(e), function () {
						if (--e < 1) return t.apply(this, arguments)
					}
				}, fr.ary = Qs, fr.assign = qo, fr.assignIn = Jo, fr.assignInWith = Go, fr.assignWith = Vo, fr.at = Ko, fr.before = eo, fr.bind = to, fr.bindAll = Tu, fr.bindKey = no, fr.castArray = function () {
					if (!arguments.length) return [];
					var e = arguments[0];
					return yo(e) ? e : [e]
				}, fr.chain = Ws, fr.chunk = function (e, t, n) {
					t = (n ? qa(e, t, n) : t === a) ? 1 : Bn(Fo(t), 0);
					var i = null == e ? 0 : e.length;
					if (!i || t < 1) return [];
					for (var s = 0, o = 0, u = r(Wn(i / t)); s < i;) u[o++] = ji(e, s, s += t);
					return u
				}, fr.compact = function (e) {
					for (var t = -1, n = null == e ? 0 : e.length, r = 0, i = []; ++t < n;) {
						var a = e[t];
						a && (i[r++] = a)
					}
					return i
				}, fr.concat = function () {
					var e = arguments.length;
					if (!e) return [];
					for (var t = r(e - 1), n = arguments[0], i = e; i--;) t[i - 1] = arguments[i];
					return en(yo(n) ? na(n) : [n], Ur(t, 1))
				}, fr.cond = function (e) {
					var t = null == e ? 0 : e.length, n = Oa();
					return e = t ? Qt(e, function (e) {
						if ("function" != typeof e[1]) throw new it(u);
						return [n(e[0]), e[1]]
					}) : [], bi(function (n) {
						for (var r = -1; ++r < t;) {
							var i = e[r];
							if (Bt(i[0], this, n)) return Bt(i[1], this, n)
						}
					})
				}, fr.conforms = function (e) {
					return function (e) {
						var t = iu(e);
						return function (n) {
							return Pr(n, e, t)
						}
					}(Or(e, h))
				}, fr.constant = Du, fr.countBy = Fs, fr.create = function (e, t) {
					var n = _r(e);
					return null == t ? n : Hr(n, t)
				}, fr.curry = function e(t, n, r) {
					var i = Ya(t, M, a, a, a, a, a, n = r ? a : n);
					return i.placeholder = e.placeholder, i
				}, fr.curryRight = function e(t, n, r) {
					var i = Ya(t, L, a, a, a, a, a, n = r ? a : n);
					return i.placeholder = e.placeholder, i
				}, fr.debounce = ro, fr.defaults = Xo, fr.defaultsDeep = Zo, fr.defer = io, fr.delay = ao, fr.difference = hs, fr.differenceBy = fs, fr.differenceWith = _s, fr.drop = function (e, t, n) {
					var r = null == e ? 0 : e.length;
					return r ? ji(e, (t = n || t === a ? 1 : Fo(t)) < 0 ? 0 : t, r) : []
				}, fr.dropRight = function (e, t, n) {
					var r = null == e ? 0 : e.length;
					return r ? ji(e, 0, (t = r - (t = n || t === a ? 1 : Fo(t))) < 0 ? 0 : t) : []
				}, fr.dropRightWhile = function (e, t) {
					return e && e.length ? Ii(e, Oa(t, 3), !0, !0) : []
				}, fr.dropWhile = function (e, t) {
					return e && e.length ? Ii(e, Oa(t, 3), !0) : []
				}, fr.fill = function (e, t, n, r) {
					var i = null == e ? 0 : e.length;
					return i ? (n && "number" != typeof n && qa(e, t, n) && (n = 0, r = i), function (e, t, n, r) {
						var i = e.length;
						for ((n = Fo(n)) < 0 && (n = -n > i ? 0 : i + n), (r = r === a || r > i ? i : Fo(r)) < 0 && (r += i), r = n > r ? 0 : zo(r); n < r;) e[n++] = t;
						return e
					}(e, t, n, r)) : []
				}, fr.filter = function (e, t) {
					return (yo(e) ? Kt : $r)(e, Oa(t, 3))
				}, fr.flatMap = function (e, t) {
					return Ur(Vs(e, t), 1)
				}, fr.flatMapDeep = function (e, t) {
					return Ur(Vs(e, t), C)
				}, fr.flatMapDepth = function (e, t, n) {
					return n = n === a ? 1 : Fo(n), Ur(Vs(e, t), n)
				}, fr.flatten = ys, fr.flattenDeep = function (e) {
					return null != e && e.length ? Ur(e, C) : []
				}, fr.flattenDepth = function (e, t) {
					return null != e && e.length ? Ur(e, t = t === a ? 1 : Fo(t)) : []
				}, fr.flip = function (e) {
					return Ya(e, T)
				}, fr.flow = Su, fr.flowRight = xu, fr.fromPairs = function (e) {
					for (var t = -1, n = null == e ? 0 : e.length, r = {}; ++t < n;) {
						var i = e[t];
						r[i[0]] = i[1]
					}
					return r
				}, fr.functions = function (e) {
					return null == e ? [] : Vr(e, iu(e))
				}, fr.functionsIn = function (e) {
					return null == e ? [] : Vr(e, au(e))
				}, fr.groupBy = qs, fr.initial = function (e) {
					return null != e && e.length ? ji(e, 0, -1) : []
				}, fr.intersection = vs, fr.intersectionBy = Ms, fr.intersectionWith = Ls, fr.invert = tu, fr.invertBy = nu, fr.invokeMap = Js, fr.iteratee = Hu, fr.keyBy = Gs, fr.keys = iu, fr.keysIn = au, fr.map = Vs, fr.mapKeys = function (e, t) {
					var n = {};
					return t = Oa(t, 3), Jr(e, function (e, r, i) {
						Er(n, t(e, r, i), e)
					}), n
				}, fr.mapValues = function (e, t) {
					var n = {};
					return t = Oa(t, 3), Jr(e, function (e, r, i) {
						Er(n, r, t(e, r, i))
					}), n
				}, fr.matches = function (e) {
					return fi(Or(e, h))
				}, fr.matchesProperty = function (e, t) {
					return _i(e, Or(t, h))
				}, fr.memoize = so, fr.merge = su, fr.mergeWith = ou, fr.method = Eu, fr.methodOf = Cu, fr.mixin = Au, fr.negate = oo, fr.nthArg = function (e) {
					return e = Fo(e), bi(function (t) {
						return mi(t, e)
					})
				}, fr.omit = uu, fr.omitBy = function (e, t) {
					return lu(e, oo(Oa(t)))
				}, fr.once = function (e) {
					return eo(2, e)
				}, fr.orderBy = function (e, t, n, r) {
					return null == e ? [] : (yo(t) || (t = null == t ? [] : [t]), yo(n = r ? a : n) || (n = null == n ? [] : [n]), yi(e, t, n))
				}, fr.over = Pu, fr.overArgs = uo, fr.overEvery = Ru, fr.overSome = Wu, fr.partial = lo, fr.partialRight = co, fr.partition = Ks, fr.pick = du, fr.pickBy = lu, fr.property = Nu, fr.propertyOf = function (e) {
					return function (t) {
						return null == e ? a : Kr(e, t)
					}
				}, fr.pull = bs, fr.pullAll = Ys, fr.pullAllBy = function (e, t, n) {
					return e && e.length && t && t.length ? vi(e, t, Oa(n, 2)) : e
				}, fr.pullAllWith = function (e, t, n) {
					return e && e.length && t && t.length ? vi(e, t, a, n) : e
				}, fr.pullAt = ks, fr.range = Iu, fr.rangeRight = Fu, fr.rearg = ho, fr.reject = function (e, t) {
					return (yo(e) ? Kt : $r)(e, oo(Oa(t, 3)))
				}, fr.remove = function (e, t) {
					var n = [];
					if (!e || !e.length) return n;
					var r = -1, i = [], a = e.length;
					for (t = Oa(t, 3); ++r < a;) {
						var s = e[r];
						t(s, r, e) && (n.push(s), i.push(r))
					}
					return Mi(e, i), n
				}, fr.rest = function (e, t) {
					if ("function" != typeof e) throw new it(u);
					return bi(e, t = t === a ? t : Fo(t))
				}, fr.reverse = Ts,fr.sampleSize = function (e, t, n) {
					return t = (n ? qa(e, t, n) : t === a) ? 1 : Fo(t), (yo(e) ? kr : ki)(e, t)
				},fr.set = function (e, t, n) {
					return null == e ? e : Ti(e, t, n)
				},fr.setWith = function (e, t, n, r) {
					return r = "function" == typeof r ? r : a, null == e ? e : Ti(e, t, n, r)
				},fr.shuffle = function (e) {
					return (yo(e) ? Tr : xi)(e)
				},fr.slice = function (e, t, n) {
					var r = null == e ? 0 : e.length;
					return r ? (n && "number" != typeof n && qa(e, t, n) ? (t = 0, n = r) : (t = null == t ? 0 : Fo(t), n = n === a ? r : Fo(n)), ji(e, t, n)) : []
				},fr.sortBy = Xs,fr.sortedUniq = function (e) {
					return e && e.length ? Ai(e) : []
				},fr.sortedUniqBy = function (e, t) {
					return e && e.length ? Ai(e, Oa(t, 2)) : []
				},fr.split = function (e, t, n) {
					return n && "number" != typeof n && qa(e, t, n) && (t = n = a), (n = n === a ? R : n >>> 0) ? (e = Bo(e)) && ("string" == typeof t || null != t && !Eo(t)) && !(t = Pi(t)) && kn(e) ? Gi(En(e), 0, n) : e.split(t, n) : []
				},fr.spread = function (e, t) {
					if ("function" != typeof e) throw new it(u);
					return t = null == t ? 0 : Bn(Fo(t), 0), bi(function (n) {
						var r = n[t], i = Gi(n, 0, t);
						return r && en(i, r), Bt(e, this, i)
					})
				},fr.tail = function (e) {
					var t = null == e ? 0 : e.length;
					return t ? ji(e, 1, t) : []
				},fr.take = function (e, t, n) {
					return e && e.length ? ji(e, 0, (t = n || t === a ? 1 : Fo(t)) < 0 ? 0 : t) : []
				},fr.takeRight = function (e, t, n) {
					var r = null == e ? 0 : e.length;
					return r ? ji(e, (t = r - (t = n || t === a ? 1 : Fo(t))) < 0 ? 0 : t, r) : []
				},fr.takeRightWhile = function (e, t) {
					return e && e.length ? Ii(e, Oa(t, 3), !1, !0) : []
				},fr.takeWhile = function (e, t) {
					return e && e.length ? Ii(e, Oa(t, 3)) : []
				},fr.tap = function (e, t) {
					return t(e), e
				},fr.throttle = function (e, t, n) {
					var r = !0, i = !0;
					if ("function" != typeof e) throw new it(u);
					return Do(n) && (r = "leading" in n ? !!n.leading : r, i = "trailing" in n ? !!n.trailing : i), ro(e, t, {
						leading: r,
						maxWait: t,
						trailing: i
					})
				},fr.thru = Ns,fr.toArray = No,fr.toPairs = cu,fr.toPairsIn = hu,fr.toPath = function (e) {
					return yo(e) ? Qt(e, ds) : Oo(e) ? [e] : na(us(Bo(e)))
				},fr.toPlainObject = Uo,fr.transform = function (e, t, n) {
					var r = yo(e), i = r || Lo(e) || Po(e);
					if (t = Oa(t, 4), null == n) {
						var a = e && e.constructor;
						n = i ? r ? new a : [] : Do(e) && Yo(a) ? _r(Ht(e)) : {}
					}
					return (i ? Jt : Jr)(e, function (e, r, i) {
						return t(n, e, r, i)
					}), n
				},fr.unary = function (e) {
					return Qs(e, 1)
				},fr.union = Ds,fr.unionBy = Ss,fr.unionWith = xs,fr.uniq = function (e) {
					return e && e.length ? Ri(e) : []
				},fr.uniqBy = function (e, t) {
					return e && e.length ? Ri(e, Oa(t, 2)) : []
				},fr.uniqWith = function (e, t) {
					return t = "function" == typeof t ? t : a, e && e.length ? Ri(e, a, t) : []
				},fr.unset = function (e, t) {
					return null == e || Wi(e, t)
				},fr.unzip = js,fr.unzipWith = Hs,fr.update = function (e, t, n) {
					return null == e ? e : Ni(e, t, Bi(n))
				},fr.updateWith = function (e, t, n, r) {
					return r = "function" == typeof r ? r : a, null == e ? e : Ni(e, t, Bi(n), r)
				},fr.values = fu,fr.valuesIn = function (e) {
					return null == e ? [] : gn(e, au(e))
				},fr.without = Es,fr.words = Yu,fr.wrap = function (e, t) {
					return lo(Bi(t), e)
				},fr.xor = Cs,fr.xorBy = As,fr.xorWith = Os,fr.zip = Ps,fr.zipObject = function (e, t) {
					return $i(e || [], t || [], Sr)
				},fr.zipObjectDeep = function (e, t) {
					return $i(e || [], t || [], Ti)
				},fr.zipWith = Rs,fr.entries = cu,fr.entriesIn = hu,fr.extend = Jo,fr.extendWith = Go,Au(fr, fr),fr.add = Uu,fr.attempt = ku,fr.camelCase = _u,fr.capitalize = pu,fr.ceil = Bu,fr.clamp = function (e, t, n) {
					return n === a && (n = t, t = a), n !== a && (n = (n = $o(n)) == n ? n : 0), t !== a && (t = (t = $o(t)) == t ? t : 0), Ar($o(e), t, n)
				},fr.clone = function (e) {
					return Or(e, _)
				},fr.cloneDeep = function (e) {
					return Or(e, h | _)
				},fr.cloneDeepWith = function (e, t) {
					return Or(e, h | _, t = "function" == typeof t ? t : a)
				},fr.cloneWith = function (e, t) {
					return Or(e, _, t = "function" == typeof t ? t : a)
				},fr.conformsTo = function (e, t) {
					return null == t || Pr(e, t, iu(t))
				},fr.deburr = mu,fr.defaultTo = function (e, t) {
					return null == e || e != e ? t : e
				},fr.divide = qu,fr.endsWith = function (e, t, n) {
					e = Bo(e), t = Pi(t);
					var r = e.length, i = n = n === a ? r : Ar(Fo(n), 0, r);
					return (n -= t.length) >= 0 && e.slice(n, i) == t
				},fr.eq = fo,fr.escape = function (e) {
					return (e = Bo(e)) && ke.test(e) ? e.replace(be, bn) : e
				},fr.escapeRegExp = function (e) {
					return (e = Bo(e)) && Ce.test(e) ? e.replace(Ee, "\\$&") : e
				},fr.every = function (e, t, n) {
					var r = yo(e) ? Vt : Fr;
					return n && qa(e, t, n) && (t = a), r(e, Oa(t, 3))
				},fr.find = zs,fr.findIndex = ps,fr.findKey = function (e, t) {
					return sn(e, Oa(t, 3), Jr)
				},fr.findLast = $s,fr.findLastIndex = ms,fr.findLastKey = function (e, t) {
					return sn(e, Oa(t, 3), Gr)
				},fr.floor = Ju,fr.forEach = Us,fr.forEachRight = Bs,fr.forIn = function (e, t) {
					return null == e ? e : Br(e, Oa(t, 3), au)
				},fr.forInRight = function (e, t) {
					return null == e ? e : qr(e, Oa(t, 3), au)
				},fr.forOwn = function (e, t) {
					return e && Jr(e, Oa(t, 3))
				},fr.forOwnRight = function (e, t) {
					return e && Gr(e, Oa(t, 3))
				},fr.get = Qo,fr.gt = _o,fr.gte = po,fr.has = function (e, t) {
					return null != e && za(e, t, ei)
				},fr.hasIn = eu,fr.head = gs,fr.identity = ju,fr.includes = function (e, t, n, r) {
					e = vo(e) ? e : fu(e), n = n && !r ? Fo(n) : 0;
					var i = e.length;
					return n < 0 && (n = Bn(i + n, 0)), Ao(e) ? n <= i && e.indexOf(t, n) > -1 : !!i && un(e, t, n) > -1
				},fr.indexOf = function (e, t, n) {
					var r = null == e ? 0 : e.length;
					if (!r) return -1;
					var i = null == n ? 0 : Fo(n);
					return i < 0 && (i = Bn(r + i, 0)), un(e, t, i)
				},fr.inRange = function (e, t, n) {
					return t = Io(t), n === a ? (n = t, t = 0) : n = Io(n), function (e, t, n) {
						return e >= qn(t, n) && e < Bn(t, n)
					}(e = $o(e), t, n)
				},fr.invoke = ru,fr.isArguments = mo,fr.isArray = yo,fr.isArrayBuffer = go,fr.isArrayLike = vo,fr.isArrayLikeObject = Mo,fr.isBoolean = function (e) {
					return !0 === e || !1 === e || So(e) && Zr(e) == U
				},fr.isBuffer = Lo,fr.isDate = wo,fr.isElement = function (e) {
					return So(e) && 1 === e.nodeType && !Ho(e)
				},fr.isEmpty = function (e) {
					if (null == e) return !0;
					if (vo(e) && (yo(e) || "string" == typeof e || "function" == typeof e.splice || Lo(e) || Po(e) || mo(e))) return !e.length;
					var t = Fa(e);
					if (t == K || t == ne) return !e.size;
					if (Ka(e)) return !di(e).length;
					for (var n in e) if (lt.call(e, n)) return !1;
					return !0
				},fr.isEqual = function (e, t) {
					return ai(e, t)
				},fr.isEqualWith = function (e, t, n) {
					var r = (n = "function" == typeof n ? n : a) ? n(e, t) : a;
					return r === a ? ai(e, t, a, n) : !!r
				},fr.isError = bo,fr.isFinite = function (e) {
					return "number" == typeof e && zn(e)
				},fr.isFunction = Yo,fr.isInteger = ko,fr.isLength = To,fr.isMap = xo,fr.isMatch = function (e, t) {
					return e === t || si(e, t, Ra(t))
				},fr.isMatchWith = function (e, t, n) {
					return n = "function" == typeof n ? n : a, si(e, t, Ra(t), n)
				},fr.isNaN = function (e) {
					return jo(e) && e != +e
				},fr.isNative = function (e) {
					if (Va(e)) throw new Ze(o);
					return oi(e)
				},fr.isNil = function (e) {
					return null == e
				},fr.isNull = function (e) {
					return null === e
				},fr.isNumber = jo,fr.isObject = Do,fr.isObjectLike = So,fr.isPlainObject = Ho,fr.isRegExp = Eo,fr.isSafeInteger = function (e) {
					return ko(e) && e >= -A && e <= A
				},fr.isSet = Co,fr.isString = Ao,fr.isSymbol = Oo,fr.isTypedArray = Po,fr.isUndefined = function (e) {
					return e === a
				},fr.isWeakMap = function (e) {
					return So(e) && Fa(e) == se
				},fr.isWeakSet = function (e) {
					return So(e) && Zr(e) == oe
				},fr.join = function (e, t) {
					return null == e ? "" : $n.call(e, t)
				},fr.kebabCase = yu,fr.last = ws,fr.lastIndexOf = function (e, t, n) {
					var r = null == e ? 0 : e.length;
					if (!r) return -1;
					var i = r;
					return n !== a && (i = (i = Fo(n)) < 0 ? Bn(r + i, 0) : qn(i, r - 1)), t == t ? function (e, t, n) {
						for (var r = n + 1; r--;) if (e[r] === t) return r;
						return r
					}(e, t, i) : on(e, ln, i, !0)
				},fr.lowerCase = gu,fr.lowerFirst = vu,fr.lt = Ro,fr.lte = Wo,fr.max = function (e) {
					return e && e.length ? zr(e, ju, Qr) : a
				},fr.maxBy = function (e, t) {
					return e && e.length ? zr(e, Oa(t, 2), Qr) : a
				},fr.mean = function (e) {
					return cn(e, ju)
				},fr.meanBy = function (e, t) {
					return cn(e, Oa(t, 2))
				},fr.min = function (e) {
					return e && e.length ? zr(e, ju, ci) : a
				},fr.minBy = function (e, t) {
					return e && e.length ? zr(e, Oa(t, 2), ci) : a
				},fr.stubArray = zu,fr.stubFalse = $u,fr.stubObject = function () {
					return {}
				},fr.stubString = function () {
					return ""
				},fr.stubTrue = function () {
					return !0
				},fr.multiply = Vu,fr.nth = function (e, t) {
					return e && e.length ? mi(e, Fo(t)) : a
				},fr.noConflict = function () {
					return Ct._ === this && (Ct._ = pt), this
				},fr.noop = Ou,fr.now = Zs,fr.pad = function (e, t, n) {
					e = Bo(e);
					var r = (t = Fo(t)) ? Hn(e) : 0;
					if (!t || r >= t) return e;
					var i = (t - r) / 2;
					return ya(Nn(i), n) + e + ya(Wn(i), n)
				},fr.padEnd = function (e, t, n) {
					e = Bo(e);
					var r = (t = Fo(t)) ? Hn(e) : 0;
					return t && r < t ? e + ya(t - r, n) : e
				},fr.padStart = function (e, t, n) {
					e = Bo(e);
					var r = (t = Fo(t)) ? Hn(e) : 0;
					return t && r < t ? ya(t - r, n) + e : e
				},fr.parseInt = function (e, t, n) {
					return n || null == t ? t = 0 : t && (t = +t), Gn(Bo(e).replace(Oe, ""), t || 0)
				},fr.random = function (e, t, n) {
					if (n && "boolean" != typeof n && qa(e, t, n) && (t = n = a), n === a && ("boolean" == typeof t ? (n = t, t = a) : "boolean" == typeof e && (n = e, e = a)), e === a && t === a ? (e = 0, t = 1) : (e = Io(e), t === a ? (t = e, e = 0) : t = Io(t)), e > t) {
						var r = e;
						e = t, t = r
					}
					if (n || e % 1 || t % 1) {
						var i = Vn();
						return qn(e + i * (t - e + xt("1e-" + ((i + "").length - 1))), t)
					}
					return Li(e, t)
				},fr.reduce = function (e, t, n) {
					var r = yo(e) ? tn : _n, i = arguments.length < 3;
					return r(e, Oa(t, 4), n, i, Nr)
				},fr.reduceRight = function (e, t, n) {
					var r = yo(e) ? nn : _n, i = arguments.length < 3;
					return r(e, Oa(t, 4), n, i, Ir)
				},fr.repeat = function (e, t, n) {
					return t = (n ? qa(e, t, n) : t === a) ? 1 : Fo(t), wi(Bo(e), t)
				},fr.replace = function () {
					var e = arguments, t = Bo(e[0]);
					return e.length < 3 ? t : t.replace(e[1], e[2])
				},fr.result = function (e, t, n) {
					var r = -1, i = (t = qi(t, e)).length;
					for (i || (i = 1, e = a); ++r < i;) {
						var s = null == e ? a : e[ds(t[r])];
						s === a && (r = i, s = n), e = Yo(s) ? s.call(e) : s
					}
					return e
				},fr.round = Ku,fr.runInContext = e,fr.sample = function (e) {
					return (yo(e) ? Yr : Yi)(e)
				},fr.size = function (e) {
					if (null == e) return 0;
					if (vo(e)) return Ao(e) ? Hn(e) : e.length;
					var t = Fa(e);
					return t == K || t == ne ? e.size : di(e).length
				},fr.snakeCase = Mu,fr.some = function (e, t, n) {
					var r = yo(e) ? rn : Hi;
					return n && qa(e, t, n) && (t = a), r(e, Oa(t, 3))
				},fr.sortedIndex = function (e, t) {
					return Ei(e, t)
				},fr.sortedIndexBy = function (e, t, n) {
					return Ci(e, t, Oa(n, 2))
				},fr.sortedIndexOf = function (e, t) {
					var n = null == e ? 0 : e.length;
					if (n) {
						var r = Ei(e, t);
						if (r < n && fo(e[r], t)) return r
					}
					return -1
				},fr.sortedLastIndex = function (e, t) {
					return Ei(e, t, !0)
				},fr.sortedLastIndexBy = function (e, t, n) {
					return Ci(e, t, Oa(n, 2), !0)
				},fr.sortedLastIndexOf = function (e, t) {
					if (null != e && e.length) {
						var n = Ei(e, t, !0) - 1;
						if (fo(e[n], t)) return n
					}
					return -1
				},fr.startCase = Lu,fr.startsWith = function (e, t, n) {
					return e = Bo(e), n = null == n ? 0 : Ar(Fo(n), 0, e.length), t = Pi(t), e.slice(n, n + t.length) == t
				},fr.subtract = Xu,fr.sum = function (e) {
					return e && e.length ? pn(e, ju) : 0
				},fr.sumBy = function (e, t) {
					return e && e.length ? pn(e, Oa(t, 2)) : 0
				},fr.template = function (e, t, n) {
					var r = fr.templateSettings;
					n && qa(e, t, n) && (t = a), e = Bo(e), t = Go({}, t, r, ka);
					var i, s, o = Go({}, t.imports, r.imports, ka), u = iu(o), d = gn(o, u), l = 0,
						c = t.interpolate || Ke, h = "__p += '",
						f = nt((t.escape || Ke).source + "|" + c.source + "|" + (c === Se ? ze : Ke).source + "|" + (t.evaluate || Ke).source + "|$", "g"),
						_ = "//# sourceURL=" + ("sourceURL" in t ? t.sourceURL : "lodash.templateSources[" + ++kt + "]") + "\n";
					e.replace(f, function (t, n, r, a, o, u) {
						return r || (r = a), h += e.slice(l, u).replace(Xe, Yn), n && (i = !0, h += "' +\n__e(" + n + ") +\n'"), o && (s = !0, h += "';\n" + o + ";\n__p += '"), r && (h += "' +\n((__t = (" + r + ")) == null ? '' : __t) +\n'"), l = u + t.length, t
					}), h += "';\n";
					var p = t.variable;
					p || (h = "with (obj) {\n" + h + "\n}\n"), h = (s ? h.replace(ve, "") : h).replace(Me, "$1").replace(Le, "$1;"), h = "function(" + (p || "obj") + ") {\n" + (p ? "" : "obj || (obj = {});\n") + "var __t, __p = ''" + (i ? ", __e = _.escape" : "") + (s ? ", __j = Array.prototype.join;\nfunction print() { __p += __j.call(arguments, '') }\n" : ";\n") + h + "return __p\n}";
					var m = ku(function () {
						return Qe(u, _ + "return " + h).apply(a, d)
					});
					if (m.source = h, bo(m)) throw m;
					return m
				},fr.times = function (e, t) {
					if ((e = Fo(e)) < 1 || e > A) return [];
					var n = R, r = qn(e, R);
					t = Oa(t), e -= R;
					for (var i = mn(r, t); ++n < e;) t(n);
					return i
				},fr.toFinite = Io,fr.toInteger = Fo,fr.toLength = zo,fr.toLower = function (e) {
					return Bo(e).toLowerCase()
				},fr.toNumber = $o,fr.toSafeInteger = function (e) {
					return e ? Ar(Fo(e), -A, A) : 0 === e ? e : 0
				},fr.toString = Bo,fr.toUpper = function (e) {
					return Bo(e).toUpperCase()
				},fr.trim = function (e, t, n) {
					if ((e = Bo(e)) && (n || t === a)) return e.replace(Ae, "");
					if (!e || !(t = Pi(t))) return e;
					var r = En(e), i = En(t);
					return Gi(r, Mn(r, i), Ln(r, i) + 1).join("")
				},fr.trimEnd = function (e, t, n) {
					if ((e = Bo(e)) && (n || t === a)) return e.replace(Pe, "");
					if (!e || !(t = Pi(t))) return e;
					var r = En(e);
					return Gi(r, 0, Ln(r, En(t)) + 1).join("")
				},fr.trimStart = function (e, t, n) {
					if ((e = Bo(e)) && (n || t === a)) return e.replace(Oe, "");
					if (!e || !(t = Pi(t))) return e;
					var r = En(e);
					return Gi(r, Mn(r, En(t))).join("")
				},fr.truncate = function (e, t) {
					var n = D, r = S;
					if (Do(t)) {
						var i = "separator" in t ? t.separator : i;
						n = "length" in t ? Fo(t.length) : n, r = "omission" in t ? Pi(t.omission) : r
					}
					var s = (e = Bo(e)).length;
					if (kn(e)) {
						var o = En(e);
						s = o.length
					}
					if (n >= s) return e;
					var u = n - Hn(r);
					if (u < 1) return r;
					var d = o ? Gi(o, 0, u).join("") : e.slice(0, u);
					if (i === a) return d + r;
					if (o && (u += d.length - u), Eo(i)) {
						if (e.slice(u).search(i)) {
							var l, c = d;
							for (i.global || (i = nt(i.source, Bo($e.exec(i)) + "g")), i.lastIndex = 0; l = i.exec(c);) var h = l.index;
							d = d.slice(0, h === a ? u : h)
						}
					} else if (e.indexOf(Pi(i), u) != u) {
						var f = d.lastIndexOf(i);
						f > -1 && (d = d.slice(0, f))
					}
					return d + r
				},fr.unescape = function (e) {
					return (e = Bo(e)) && Ye.test(e) ? e.replace(we, Cn) : e
				},fr.uniqueId = function (e) {
					var t = ++ct;
					return Bo(e) + t
				},fr.upperCase = wu,fr.upperFirst = bu,fr.each = Us,fr.eachRight = Bs,fr.first = gs,Au(fr, (Gu = {}, Jr(fr, function (e, t) {
					lt.call(fr.prototype, t) || (Gu[t] = e)
				}), Gu), {chain: !1}),fr.VERSION = "4.17.11",Jt(["bind", "bindKey", "curry", "curryRight", "partial", "partialRight"], function (e) {
					fr[e].placeholder = fr
				}),Jt(["drop", "take"], function (e, t) {
					yr.prototype[e] = function (n) {
						n = n === a ? 1 : Bn(Fo(n), 0);
						var r = this.__filtered__ && !t ? new yr(this) : this.clone();
						return r.__filtered__ ? r.__takeCount__ = qn(n, r.__takeCount__) : r.__views__.push({
							size: qn(n, R),
							type: e + (r.__dir__ < 0 ? "Right" : "")
						}), r
					}, yr.prototype[e + "Right"] = function (t) {
						return this.reverse()[e](t).reverse()
					}
				}),Jt(["filter", "map", "takeWhile"], function (e, t) {
					var n = t + 1, r = n == H || 3 == n;
					yr.prototype[e] = function (e) {
						var t = this.clone();
						return t.__iteratees__.push({
							iteratee: Oa(e, 3),
							type: n
						}), t.__filtered__ = t.__filtered__ || r, t
					}
				}),Jt(["head", "last"], function (e, t) {
					var n = "take" + (t ? "Right" : "");
					yr.prototype[e] = function () {
						return this[n](1).value()[0]
					}
				}),Jt(["initial", "tail"], function (e, t) {
					var n = "drop" + (t ? "" : "Right");
					yr.prototype[e] = function () {
						return this.__filtered__ ? new yr(this) : this[n](1)
					}
				}),yr.prototype.compact = function () {
					return this.filter(ju)
				},yr.prototype.find = function (e) {
					return this.filter(e).head()
				},yr.prototype.findLast = function (e) {
					return this.reverse().find(e)
				},yr.prototype.invokeMap = bi(function (e, t) {
					return "function" == typeof e ? new yr(this) : this.map(function (n) {
						return ri(n, e, t)
					})
				}),yr.prototype.reject = function (e) {
					return this.filter(oo(Oa(e)))
				},yr.prototype.slice = function (e, t) {
					e = Fo(e);
					var n = this;
					return n.__filtered__ && (e > 0 || t < 0) ? new yr(n) : (e < 0 ? n = n.takeRight(-e) : e && (n = n.drop(e)), t !== a && (n = (t = Fo(t)) < 0 ? n.dropRight(-t) : n.take(t - e)), n)
				},yr.prototype.takeRightWhile = function (e) {
					return this.reverse().takeWhile(e).reverse()
				},yr.prototype.toArray = function () {
					return this.take(R)
				},Jr(yr.prototype, function (e, t) {
					var n = /^(?:filter|find|map|reject)|While$/.test(t), r = /^(?:head|last)$/.test(t),
						i = fr[r ? "take" + ("last" == t ? "Right" : "") : t], s = r || /^find/.test(t);
					i && (fr.prototype[t] = function () {
						var t = this.__wrapped__, o = r ? [1] : arguments, u = t instanceof yr, d = o[0],
							l = u || yo(t), c = function (e) {
								var t = i.apply(fr, en([e], o));
								return r && h ? t[0] : t
							};
						l && n && "function" == typeof d && 1 != d.length && (u = l = !1);
						var h = this.__chain__, f = !!this.__actions__.length, _ = s && !h, p = u && !f;
						if (!s && l) {
							t = p ? t : new yr(this);
							var m = e.apply(t, o);
							return m.__actions__.push({func: Ns, args: [c], thisArg: a}), new mr(m, h)
						}
						return _ && p ? e.apply(this, o) : (m = this.thru(c), _ ? r ? m.value()[0] : m.value() : m)
					})
				}),Jt(["pop", "push", "shift", "sort", "splice", "unshift"], function (e) {
					var t = at[e], n = /^(?:push|sort|unshift)$/.test(e) ? "tap" : "thru",
						r = /^(?:pop|shift)$/.test(e);
					fr.prototype[e] = function () {
						var e = arguments;
						if (r && !this.__chain__) {
							var i = this.value();
							return t.apply(yo(i) ? i : [], e)
						}
						return this[n](function (n) {
							return t.apply(yo(n) ? n : [], e)
						})
					}
				}),Jr(yr.prototype, function (e, t) {
					var n = fr[t];
					if (n) {
						var r = n.name + "";
						(ir[r] || (ir[r] = [])).push({name: t, func: n})
					}
				}),ir[fa(a, g).name] = [{name: "wrapper", func: a}],yr.prototype.clone = function () {
					var e = new yr(this.__wrapped__);
					return e.__actions__ = na(this.__actions__), e.__dir__ = this.__dir__, e.__filtered__ = this.__filtered__, e.__iteratees__ = na(this.__iteratees__), e.__takeCount__ = this.__takeCount__, e.__views__ = na(this.__views__), e
				},yr.prototype.reverse = function () {
					if (this.__filtered__) {
						var e = new yr(this);
						e.__dir__ = -1, e.__filtered__ = !0
					} else (e = this.clone()).__dir__ *= -1;
					return e
				},yr.prototype.value = function () {
					var e = this.__wrapped__.value(), t = this.__dir__, n = yo(e), r = t < 0, i = n ? e.length : 0,
						a = function (e, t, n) {
							for (var r = -1, i = n.length; ++r < i;) {
								var a = n[r], s = a.size;
								switch (a.type) {
									case"drop":
										e += s;
										break;
									case"dropRight":
										t -= s;
										break;
									case"take":
										t = qn(t, e + s);
										break;
									case"takeRight":
										e = Bn(e, t - s)
								}
							}
							return {start: e, end: t}
						}(0, i, this.__views__), s = a.start, o = a.end, u = o - s, d = r ? o : s - 1,
						l = this.__iteratees__, c = l.length, h = 0, f = qn(u, this.__takeCount__);
					if (!n || !r && i == u && f == u) return Fi(e, this.__actions__);
					var _ = [];
					e:for (; u-- && h < f;) {
						for (var p = -1, m = e[d += t]; ++p < c;) {
							var y = l[p], g = y.iteratee, v = y.type, M = g(m);
							if (v == E) m = M; else if (!M) {
								if (v == H) continue e;
								break e
							}
						}
						_[h++] = m
					}
					return _
				},fr.prototype.at = Is,fr.prototype.chain = function () {
					return Ws(this)
				},fr.prototype.commit = function () {
					return new mr(this.value(), this.__chain__)
				},fr.prototype.next = function () {
					this.__values__ === a && (this.__values__ = No(this.value()));
					var e = this.__index__ >= this.__values__.length;
					return {done: e, value: e ? a : this.__values__[this.__index__++]}
				},fr.prototype.plant = function (e) {
					for (var t, n = this; n instanceof pr;) {
						var r = cs(n);
						r.__index__ = 0, r.__values__ = a, t ? i.__wrapped__ = r : t = r;
						var i = r;
						n = n.__wrapped__
					}
					return i.__wrapped__ = e, t
				},fr.prototype.reverse = function () {
					var e = this.__wrapped__;
					if (e instanceof yr) {
						var t = e;
						return this.__actions__.length && (t = new yr(this)), (t = t.reverse()).__actions__.push({
							func: Ns,
							args: [Ts],
							thisArg: a
						}), new mr(t, this.__chain__)
					}
					return this.thru(Ts)
				},fr.prototype.toJSON = fr.prototype.valueOf = fr.prototype.value = function () {
					return Fi(this.__wrapped__, this.__actions__)
				},fr.prototype.first = fr.prototype.head,Wt && (fr.prototype[Wt] = function () {
					return this
				}),fr
			}();
			Ct._ = An, (i = function () {
				return An
			}.call(t, n, t, r)) === a || (r.exports = i)
		}).call(this)
	}).call(t, n(137), n(4)(e))
}, function (e, t) {
	var n;
	n = function () {
		return this
	}();
	try {
		n = n || Function("return this")() || (0, eval)("this")
	} catch (e) {
		"object" == typeof window && (n = window)
	}
	e.exports = n
}, function (e, t) {
	if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");
	!function (e) {
		"use strict";
		var t = e.fn.jquery.split(" ")[0].split(".");
		if (t[0] < 2 && t[1] < 9 || 1 == t[0] && 9 == t[1] && t[2] < 1 || t[0] > 3) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")
	}(jQuery), function (e) {
		"use strict";
		e.fn.emulateTransitionEnd = function (t) {
			var n = !1, r = this;
			e(this).one("bsTransitionEnd", function () {
				n = !0
			});
			return setTimeout(function () {
				n || e(r).trigger(e.support.transition.end)
			}, t), this
		}, e(function () {
			e.support.transition = function () {
				var e = document.createElement("bootstrap"), t = {
					WebkitTransition: "webkitTransitionEnd",
					MozTransition: "transitionend",
					OTransition: "oTransitionEnd otransitionend",
					transition: "transitionend"
				};
				for (var n in t) if (void 0 !== e.style[n]) return {end: t[n]};
				return !1
			}(), e.support.transition && (e.event.special.bsTransitionEnd = {
				bindType: e.support.transition.end,
				delegateType: e.support.transition.end,
				handle: function (t) {
					if (e(t.target).is(this)) return t.handleObj.handler.apply(this, arguments)
				}
			})
		})
	}(jQuery), function (e) {
		"use strict";
		var t = '[data-dismiss="alert"]', n = function (n) {
			e(n).on("click", t, this.close)
		};
		n.VERSION = "3.3.7", n.TRANSITION_DURATION = 150, n.prototype.close = function (t) {
			var r = e(this), i = r.attr("data-target");
			i || (i = (i = r.attr("href")) && i.replace(/.*(?=#[^\s]*$)/, ""));
			var a = e("#" === i ? [] : i);

			function s() {
				a.detach().trigger("closed.bs.alert").remove()
			}

			t && t.preventDefault(), a.length || (a = r.closest(".alert")), a.trigger(t = e.Event("close.bs.alert")), t.isDefaultPrevented() || (a.removeClass("in"), e.support.transition && a.hasClass("fade") ? a.one("bsTransitionEnd", s).emulateTransitionEnd(n.TRANSITION_DURATION) : s())
		};
		var r = e.fn.alert;
		e.fn.alert = function (t) {
			return this.each(function () {
				var r = e(this), i = r.data("bs.alert");
				i || r.data("bs.alert", i = new n(this)), "string" == typeof t && i[t].call(r)
			})
		}, e.fn.alert.Constructor = n, e.fn.alert.noConflict = function () {
			return e.fn.alert = r, this
		}, e(document).on("click.bs.alert.data-api", t, n.prototype.close)
	}(jQuery), function (e) {
		"use strict";
		var t = function (n, r) {
			this.$element = e(n), this.options = e.extend({}, t.DEFAULTS, r), this.isLoading = !1
		};

		function n(n) {
			return this.each(function () {
				var r = e(this), i = r.data("bs.button"), a = "object" == typeof n && n;
				i || r.data("bs.button", i = new t(this, a)), "toggle" == n ? i.toggle() : n && i.setState(n)
			})
		}

		t.VERSION = "3.3.7", t.DEFAULTS = {loadingText: "loading..."}, t.prototype.setState = function (t) {
			var n = "disabled", r = this.$element, i = r.is("input") ? "val" : "html", a = r.data();
			t += "Text", null == a.resetText && r.data("resetText", r[i]()), setTimeout(e.proxy(function () {
				r[i](null == a[t] ? this.options[t] : a[t]), "loadingText" == t ? (this.isLoading = !0, r.addClass(n).attr(n, n).prop(n, !0)) : this.isLoading && (this.isLoading = !1, r.removeClass(n).removeAttr(n).prop(n, !1))
			}, this), 0)
		}, t.prototype.toggle = function () {
			var e = !0, t = this.$element.closest('[data-toggle="buttons"]');
			if (t.length) {
				var n = this.$element.find("input");
				"radio" == n.prop("type") ? (n.prop("checked") && (e = !1), t.find(".active").removeClass("active"), this.$element.addClass("active")) : "checkbox" == n.prop("type") && (n.prop("checked") !== this.$element.hasClass("active") && (e = !1), this.$element.toggleClass("active")), n.prop("checked", this.$element.hasClass("active")), e && n.trigger("change")
			} else this.$element.attr("aria-pressed", !this.$element.hasClass("active")), this.$element.toggleClass("active")
		};
		var r = e.fn.button;
		e.fn.button = n, e.fn.button.Constructor = t, e.fn.button.noConflict = function () {
			return e.fn.button = r, this
		}, e(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (t) {
			var r = e(t.target).closest(".btn");
			n.call(r, "toggle"), e(t.target).is('input[type="radio"], input[type="checkbox"]') || (t.preventDefault(), r.is("input,button") ? r.trigger("focus") : r.find("input:visible,button:visible").first().trigger("focus"))
		}).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (t) {
			e(t.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(t.type))
		})
	}(jQuery), function (e) {
		"use strict";
		var t = function (t, n) {
			this.$element = e(t), this.$indicators = this.$element.find(".carousel-indicators"), this.options = n, this.paused = null, this.sliding = null, this.interval = null, this.$active = null, this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", e.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", e.proxy(this.pause, this)).on("mouseleave.bs.carousel", e.proxy(this.cycle, this))
		};

		function n(n) {
			return this.each(function () {
				var r = e(this), i = r.data("bs.carousel"),
					a = e.extend({}, t.DEFAULTS, r.data(), "object" == typeof n && n),
					s = "string" == typeof n ? n : a.slide;
				i || r.data("bs.carousel", i = new t(this, a)), "number" == typeof n ? i.to(n) : s ? i[s]() : a.interval && i.pause().cycle()
			})
		}

		t.VERSION = "3.3.7", t.TRANSITION_DURATION = 600, t.DEFAULTS = {
			interval: 5e3,
			pause: "hover",
			wrap: !0,
			keyboard: !0
		}, t.prototype.keydown = function (e) {
			if (!/input|textarea/i.test(e.target.tagName)) {
				switch (e.which) {
					case 37:
						this.prev();
						break;
					case 39:
						this.next();
						break;
					default:
						return
				}
				e.preventDefault()
			}
		}, t.prototype.cycle = function (t) {
			return t || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(e.proxy(this.next, this), this.options.interval)), this
		}, t.prototype.getItemIndex = function (e) {
			return this.$items = e.parent().children(".item"), this.$items.index(e || this.$active)
		}, t.prototype.getItemForDirection = function (e, t) {
			var n = this.getItemIndex(t);
			if (("prev" == e && 0 === n || "next" == e && n == this.$items.length - 1) && !this.options.wrap) return t;
			var r = (n + ("prev" == e ? -1 : 1)) % this.$items.length;
			return this.$items.eq(r)
		}, t.prototype.to = function (e) {
			var t = this, n = this.getItemIndex(this.$active = this.$element.find(".item.active"));
			if (!(e > this.$items.length - 1 || e < 0)) return this.sliding ? this.$element.one("slid.bs.carousel", function () {
				t.to(e)
			}) : n == e ? this.pause().cycle() : this.slide(e > n ? "next" : "prev", this.$items.eq(e))
		}, t.prototype.pause = function (t) {
			return t || (this.paused = !0), this.$element.find(".next, .prev").length && e.support.transition && (this.$element.trigger(e.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
		}, t.prototype.next = function () {
			if (!this.sliding) return this.slide("next")
		}, t.prototype.prev = function () {
			if (!this.sliding) return this.slide("prev")
		}, t.prototype.slide = function (n, r) {
			var i = this.$element.find(".item.active"), a = r || this.getItemForDirection(n, i), s = this.interval,
				o = "next" == n ? "left" : "right", u = this;
			if (a.hasClass("active")) return this.sliding = !1;
			var d = a[0], l = e.Event("slide.bs.carousel", {relatedTarget: d, direction: o});
			if (this.$element.trigger(l), !l.isDefaultPrevented()) {
				if (this.sliding = !0, s && this.pause(), this.$indicators.length) {
					this.$indicators.find(".active").removeClass("active");
					var c = e(this.$indicators.children()[this.getItemIndex(a)]);
					c && c.addClass("active")
				}
				var h = e.Event("slid.bs.carousel", {relatedTarget: d, direction: o});
				return e.support.transition && this.$element.hasClass("slide") ? (a.addClass(n), a[0].offsetWidth, i.addClass(o), a.addClass(o), i.one("bsTransitionEnd", function () {
					a.removeClass([n, o].join(" ")).addClass("active"), i.removeClass(["active", o].join(" ")), u.sliding = !1, setTimeout(function () {
						u.$element.trigger(h)
					}, 0)
				}).emulateTransitionEnd(t.TRANSITION_DURATION)) : (i.removeClass("active"), a.addClass("active"), this.sliding = !1, this.$element.trigger(h)), s && this.cycle(), this
			}
		};
		var r = e.fn.carousel;
		e.fn.carousel = n, e.fn.carousel.Constructor = t, e.fn.carousel.noConflict = function () {
			return e.fn.carousel = r, this
		};
		var i = function (t) {
			var r, i = e(this), a = e(i.attr("data-target") || (r = i.attr("href")) && r.replace(/.*(?=#[^\s]+$)/, ""));
			if (a.hasClass("carousel")) {
				var s = e.extend({}, a.data(), i.data()), o = i.attr("data-slide-to");
				o && (s.interval = !1), n.call(a, s), o && a.data("bs.carousel").to(o), t.preventDefault()
			}
		};
		e(document).on("click.bs.carousel.data-api", "[data-slide]", i).on("click.bs.carousel.data-api", "[data-slide-to]", i), e(window).on("load", function () {
			e('[data-ride="carousel"]').each(function () {
				var t = e(this);
				n.call(t, t.data())
			})
		})
	}(jQuery), function (e) {
		"use strict";
		var t = function (n, r) {
			this.$element = e(n), this.options = e.extend({}, t.DEFAULTS, r), this.$trigger = e('[data-toggle="collapse"][href="#' + n.id + '"],[data-toggle="collapse"][data-target="#' + n.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
		};

		function n(t) {
			var n, r = t.attr("data-target") || (n = t.attr("href")) && n.replace(/.*(?=#[^\s]+$)/, "");
			return e(r)
		}

		function r(n) {
			return this.each(function () {
				var r = e(this), i = r.data("bs.collapse"),
					a = e.extend({}, t.DEFAULTS, r.data(), "object" == typeof n && n);
				!i && a.toggle && /show|hide/.test(n) && (a.toggle = !1), i || r.data("bs.collapse", i = new t(this, a)), "string" == typeof n && i[n]()
			})
		}

		t.VERSION = "3.3.7", t.TRANSITION_DURATION = 350, t.DEFAULTS = {toggle: !0}, t.prototype.dimension = function () {
			return this.$element.hasClass("width") ? "width" : "height"
		}, t.prototype.show = function () {
			if (!this.transitioning && !this.$element.hasClass("in")) {
				var n, i = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
				if (!(i && i.length && (n = i.data("bs.collapse")) && n.transitioning)) {
					var a = e.Event("show.bs.collapse");
					if (this.$element.trigger(a), !a.isDefaultPrevented()) {
						i && i.length && (r.call(i, "hide"), n || i.data("bs.collapse", null));
						var s = this.dimension();
						this.$element.removeClass("collapse").addClass("collapsing")[s](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
						var o = function () {
							this.$element.removeClass("collapsing").addClass("collapse in")[s](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
						};
						if (!e.support.transition) return o.call(this);
						var u = e.camelCase(["scroll", s].join("-"));
						this.$element.one("bsTransitionEnd", e.proxy(o, this)).emulateTransitionEnd(t.TRANSITION_DURATION)[s](this.$element[0][u])
					}
				}
			}
		}, t.prototype.hide = function () {
			if (!this.transitioning && this.$element.hasClass("in")) {
				var n = e.Event("hide.bs.collapse");
				if (this.$element.trigger(n), !n.isDefaultPrevented()) {
					var r = this.dimension();
					this.$element[r](this.$element[r]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
					var i = function () {
						this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
					};
					if (!e.support.transition) return i.call(this);
					this.$element[r](0).one("bsTransitionEnd", e.proxy(i, this)).emulateTransitionEnd(t.TRANSITION_DURATION)
				}
			}
		}, t.prototype.toggle = function () {
			this[this.$element.hasClass("in") ? "hide" : "show"]()
		}, t.prototype.getParent = function () {
			return e(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(e.proxy(function (t, r) {
				var i = e(r);
				this.addAriaAndCollapsedClass(n(i), i)
			}, this)).end()
		}, t.prototype.addAriaAndCollapsedClass = function (e, t) {
			var n = e.hasClass("in");
			e.attr("aria-expanded", n), t.toggleClass("collapsed", !n).attr("aria-expanded", n)
		};
		var i = e.fn.collapse;
		e.fn.collapse = r, e.fn.collapse.Constructor = t, e.fn.collapse.noConflict = function () {
			return e.fn.collapse = i, this
		}, e(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (t) {
			var i = e(this);
			i.attr("data-target") || t.preventDefault();
			var a = n(i), s = a.data("bs.collapse") ? "toggle" : i.data();
			r.call(a, s)
		})
	}(jQuery), function (e) {
		"use strict";
		var t = ".dropdown-backdrop", n = '[data-toggle="dropdown"]', r = function (t) {
			e(t).on("click.bs.dropdown", this.toggle)
		};

		function i(t) {
			var n = t.attr("data-target");
			n || (n = (n = t.attr("href")) && /#[A-Za-z]/.test(n) && n.replace(/.*(?=#[^\s]*$)/, ""));
			var r = n && e(n);
			return r && r.length ? r : t.parent()
		}

		function a(r) {
			r && 3 === r.which || (e(t).remove(), e(n).each(function () {
				var t = e(this), n = i(t), a = {relatedTarget: this};
				n.hasClass("open") && (r && "click" == r.type && /input|textarea/i.test(r.target.tagName) && e.contains(n[0], r.target) || (n.trigger(r = e.Event("hide.bs.dropdown", a)), r.isDefaultPrevented() || (t.attr("aria-expanded", "false"), n.removeClass("open").trigger(e.Event("hidden.bs.dropdown", a)))))
			}))
		}

		r.VERSION = "3.3.7", r.prototype.toggle = function (t) {
			var n = e(this);
			if (!n.is(".disabled, :disabled")) {
				var r = i(n), s = r.hasClass("open");
				if (a(), !s) {
					"ontouchstart" in document.documentElement && !r.closest(".navbar-nav").length && e(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(e(this)).on("click", a);
					var o = {relatedTarget: this};
					if (r.trigger(t = e.Event("show.bs.dropdown", o)), t.isDefaultPrevented()) return;
					n.trigger("focus").attr("aria-expanded", "true"), r.toggleClass("open").trigger(e.Event("shown.bs.dropdown", o))
				}
				return !1
			}
		}, r.prototype.keydown = function (t) {
			if (/(38|40|27|32)/.test(t.which) && !/input|textarea/i.test(t.target.tagName)) {
				var r = e(this);
				if (t.preventDefault(), t.stopPropagation(), !r.is(".disabled, :disabled")) {
					var a = i(r), s = a.hasClass("open");
					if (!s && 27 != t.which || s && 27 == t.which) return 27 == t.which && a.find(n).trigger("focus"), r.trigger("click");
					var o = a.find(".dropdown-menu li:not(.disabled):visible a");
					if (o.length) {
						var u = o.index(t.target);
						38 == t.which && u > 0 && u--, 40 == t.which && u < o.length - 1 && u++, ~u || (u = 0), o.eq(u).trigger("focus")
					}
				}
			}
		};
		var s = e.fn.dropdown;
		e.fn.dropdown = function (t) {
			return this.each(function () {
				var n = e(this), i = n.data("bs.dropdown");
				i || n.data("bs.dropdown", i = new r(this)), "string" == typeof t && i[t].call(n)
			})
		}, e.fn.dropdown.Constructor = r, e.fn.dropdown.noConflict = function () {
			return e.fn.dropdown = s, this
		}, e(document).on("click.bs.dropdown.data-api", a).on("click.bs.dropdown.data-api", ".dropdown form", function (e) {
			e.stopPropagation()
		}).on("click.bs.dropdown.data-api", n, r.prototype.toggle).on("keydown.bs.dropdown.data-api", n, r.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", r.prototype.keydown)
	}(jQuery), function (e) {
		"use strict";
		var t = function (t, n) {
			this.options = n, this.$body = e(document.body), this.$element = e(t), this.$dialog = this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown = null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !1, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, e.proxy(function () {
				this.$element.trigger("loaded.bs.modal")
			}, this))
		};

		function n(n, r) {
			return this.each(function () {
				var i = e(this), a = i.data("bs.modal"),
					s = e.extend({}, t.DEFAULTS, i.data(), "object" == typeof n && n);
				a || i.data("bs.modal", a = new t(this, s)), "string" == typeof n ? a[n](r) : s.show && a.show(r)
			})
		}

		t.VERSION = "3.3.7", t.TRANSITION_DURATION = 300, t.BACKDROP_TRANSITION_DURATION = 150, t.DEFAULTS = {
			backdrop: !0,
			keyboard: !0,
			show: !0
		}, t.prototype.toggle = function (e) {
			return this.isShown ? this.hide() : this.show(e)
		}, t.prototype.show = function (n) {
			var r = this, i = e.Event("show.bs.modal", {relatedTarget: n});
			this.$element.trigger(i), this.isShown || i.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', e.proxy(this.hide, this)), this.$dialog.on("mousedown.dismiss.bs.modal", function () {
				r.$element.one("mouseup.dismiss.bs.modal", function (t) {
					e(t.target).is(r.$element) && (r.ignoreBackdropClick = !0)
				})
			}), this.backdrop(function () {
				var i = e.support.transition && r.$element.hasClass("fade");
				r.$element.parent().length || r.$element.appendTo(r.$body), r.$element.show().scrollTop(0), r.adjustDialog(), i && r.$element[0].offsetWidth, r.$element.addClass("in"), r.enforceFocus();
				var a = e.Event("shown.bs.modal", {relatedTarget: n});
				i ? r.$dialog.one("bsTransitionEnd", function () {
					r.$element.trigger("focus").trigger(a)
				}).emulateTransitionEnd(t.TRANSITION_DURATION) : r.$element.trigger("focus").trigger(a)
			}))
		}, t.prototype.hide = function (n) {
			n && n.preventDefault(), n = e.Event("hide.bs.modal"), this.$element.trigger(n), this.isShown && !n.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), e(document).off("focusin.bs.modal"), this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this.$dialog.off("mousedown.dismiss.bs.modal"), e.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", e.proxy(this.hideModal, this)).emulateTransitionEnd(t.TRANSITION_DURATION) : this.hideModal())
		}, t.prototype.enforceFocus = function () {
			e(document).off("focusin.bs.modal").on("focusin.bs.modal", e.proxy(function (e) {
				document === e.target || this.$element[0] === e.target || this.$element.has(e.target).length || this.$element.trigger("focus")
			}, this))
		}, t.prototype.escape = function () {
			this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", e.proxy(function (e) {
				27 == e.which && this.hide()
			}, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
		}, t.prototype.resize = function () {
			this.isShown ? e(window).on("resize.bs.modal", e.proxy(this.handleUpdate, this)) : e(window).off("resize.bs.modal")
		}, t.prototype.hideModal = function () {
			var e = this;
			this.$element.hide(), this.backdrop(function () {
				e.$body.removeClass("modal-open"), e.resetAdjustments(), e.resetScrollbar(), e.$element.trigger("hidden.bs.modal")
			})
		}, t.prototype.removeBackdrop = function () {
			this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
		}, t.prototype.backdrop = function (n) {
			var r = this, i = this.$element.hasClass("fade") ? "fade" : "";
			if (this.isShown && this.options.backdrop) {
				var a = e.support.transition && i;
				if (this.$backdrop = e(document.createElement("div")).addClass("modal-backdrop " + i).appendTo(this.$body), this.$element.on("click.dismiss.bs.modal", e.proxy(function (e) {
					this.ignoreBackdropClick ? this.ignoreBackdropClick = !1 : e.target === e.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide())
				}, this)), a && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !n) return;
				a ? this.$backdrop.one("bsTransitionEnd", n).emulateTransitionEnd(t.BACKDROP_TRANSITION_DURATION) : n()
			} else if (!this.isShown && this.$backdrop) {
				this.$backdrop.removeClass("in");
				var s = function () {
					r.removeBackdrop(), n && n()
				};
				e.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", s).emulateTransitionEnd(t.BACKDROP_TRANSITION_DURATION) : s()
			} else n && n()
		}, t.prototype.handleUpdate = function () {
			this.adjustDialog()
		}, t.prototype.adjustDialog = function () {
			var e = this.$element[0].scrollHeight > document.documentElement.clientHeight;
			this.$element.css({
				paddingLeft: !this.bodyIsOverflowing && e ? this.scrollbarWidth : "",
				paddingRight: this.bodyIsOverflowing && !e ? this.scrollbarWidth : ""
			})
		}, t.prototype.resetAdjustments = function () {
			this.$element.css({paddingLeft: "", paddingRight: ""})
		}, t.prototype.checkScrollbar = function () {
			var e = window.innerWidth;
			if (!e) {
				var t = document.documentElement.getBoundingClientRect();
				e = t.right - Math.abs(t.left)
			}
			this.bodyIsOverflowing = document.body.clientWidth < e, this.scrollbarWidth = this.measureScrollbar()
		}, t.prototype.setScrollbar = function () {
			var e = parseInt(this.$body.css("padding-right") || 0, 10);
			this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing && this.$body.css("padding-right", e + this.scrollbarWidth)
		}, t.prototype.resetScrollbar = function () {
			this.$body.css("padding-right", this.originalBodyPad)
		}, t.prototype.measureScrollbar = function () {
			var e = document.createElement("div");
			e.className = "modal-scrollbar-measure", this.$body.append(e);
			var t = e.offsetWidth - e.clientWidth;
			return this.$body[0].removeChild(e), t
		};
		var r = e.fn.modal;
		e.fn.modal = n, e.fn.modal.Constructor = t, e.fn.modal.noConflict = function () {
			return e.fn.modal = r, this
		}, e(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (t) {
			var r = e(this), i = r.attr("href"), a = e(r.attr("data-target") || i && i.replace(/.*(?=#[^\s]+$)/, "")),
				s = a.data("bs.modal") ? "toggle" : e.extend({remote: !/#/.test(i) && i}, a.data(), r.data());
			r.is("a") && t.preventDefault(), a.one("show.bs.modal", function (e) {
				e.isDefaultPrevented() || a.one("hidden.bs.modal", function () {
					r.is(":visible") && r.trigger("focus")
				})
			}), n.call(a, s, this)
		})
	}(jQuery), function (e) {
		"use strict";
		var t = function (e, t) {
			this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", e, t)
		};
		t.VERSION = "3.3.7", t.TRANSITION_DURATION = 150, t.DEFAULTS = {
			animation: !0,
			placement: "top",
			selector: !1,
			template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
			trigger: "hover focus",
			title: "",
			delay: 0,
			html: !1,
			container: !1,
			viewport: {selector: "body", padding: 0}
		}, t.prototype.init = function (t, n, r) {
			if (this.enabled = !0, this.type = t, this.$element = e(n), this.options = this.getOptions(r), this.$viewport = this.options.viewport && e(e.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = {
				click: !1,
				hover: !1,
				focus: !1
			}, this.$element[0] instanceof document.constructor && !this.options.selector) throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
			for (var i = this.options.trigger.split(" "), a = i.length; a--;) {
				var s = i[a];
				if ("click" == s) this.$element.on("click." + this.type, this.options.selector, e.proxy(this.toggle, this)); else if ("manual" != s) {
					var o = "hover" == s ? "mouseenter" : "focusin", u = "hover" == s ? "mouseleave" : "focusout";
					this.$element.on(o + "." + this.type, this.options.selector, e.proxy(this.enter, this)), this.$element.on(u + "." + this.type, this.options.selector, e.proxy(this.leave, this))
				}
			}
			this.options.selector ? this._options = e.extend({}, this.options, {
				trigger: "manual",
				selector: ""
			}) : this.fixTitle()
		}, t.prototype.getDefaults = function () {
			return t.DEFAULTS
		}, t.prototype.getOptions = function (t) {
			return (t = e.extend({}, this.getDefaults(), this.$element.data(), t)).delay && "number" == typeof t.delay && (t.delay = {
				show: t.delay,
				hide: t.delay
			}), t
		}, t.prototype.getDelegateOptions = function () {
			var t = {}, n = this.getDefaults();
			return this._options && e.each(this._options, function (e, r) {
				n[e] != r && (t[e] = r)
			}), t
		}, t.prototype.enter = function (t) {
			var n = t instanceof this.constructor ? t : e(t.currentTarget).data("bs." + this.type);
			if (n || (n = new this.constructor(t.currentTarget, this.getDelegateOptions()), e(t.currentTarget).data("bs." + this.type, n)), t instanceof e.Event && (n.inState["focusin" == t.type ? "focus" : "hover"] = !0), n.tip().hasClass("in") || "in" == n.hoverState) n.hoverState = "in"; else {
				if (clearTimeout(n.timeout), n.hoverState = "in", !n.options.delay || !n.options.delay.show) return n.show();
				n.timeout = setTimeout(function () {
					"in" == n.hoverState && n.show()
				}, n.options.delay.show)
			}
		}, t.prototype.isInStateTrue = function () {
			for (var e in this.inState) if (this.inState[e]) return !0;
			return !1
		}, t.prototype.leave = function (t) {
			var n = t instanceof this.constructor ? t : e(t.currentTarget).data("bs." + this.type);
			if (n || (n = new this.constructor(t.currentTarget, this.getDelegateOptions()), e(t.currentTarget).data("bs." + this.type, n)), t instanceof e.Event && (n.inState["focusout" == t.type ? "focus" : "hover"] = !1), !n.isInStateTrue()) {
				if (clearTimeout(n.timeout), n.hoverState = "out", !n.options.delay || !n.options.delay.hide) return n.hide();
				n.timeout = setTimeout(function () {
					"out" == n.hoverState && n.hide()
				}, n.options.delay.hide)
			}
		}, t.prototype.show = function () {
			var n = e.Event("show.bs." + this.type);
			if (this.hasContent() && this.enabled) {
				this.$element.trigger(n);
				var r = e.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
				if (n.isDefaultPrevented() || !r) return;
				var i = this, a = this.tip(), s = this.getUID(this.type);
				this.setContent(), a.attr("id", s), this.$element.attr("aria-describedby", s), this.options.animation && a.addClass("fade");
				var o = "function" == typeof this.options.placement ? this.options.placement.call(this, a[0], this.$element[0]) : this.options.placement,
					u = /\s?auto?\s?/i, d = u.test(o);
				d && (o = o.replace(u, "") || "top"), a.detach().css({
					top: 0,
					left: 0,
					display: "block"
				}).addClass(o).data("bs." + this.type, this), this.options.container ? a.appendTo(this.options.container) : a.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);
				var l = this.getPosition(), c = a[0].offsetWidth, h = a[0].offsetHeight;
				if (d) {
					var f = o, _ = this.getPosition(this.$viewport);
					o = "bottom" == o && l.bottom + h > _.bottom ? "top" : "top" == o && l.top - h < _.top ? "bottom" : "right" == o && l.right + c > _.width ? "left" : "left" == o && l.left - c < _.left ? "right" : o, a.removeClass(f).addClass(o)
				}
				var p = this.getCalculatedOffset(o, l, c, h);
				this.applyPlacement(p, o);
				var m = function () {
					var e = i.hoverState;
					i.$element.trigger("shown.bs." + i.type), i.hoverState = null, "out" == e && i.leave(i)
				};
				e.support.transition && this.$tip.hasClass("fade") ? a.one("bsTransitionEnd", m).emulateTransitionEnd(t.TRANSITION_DURATION) : m()
			}
		}, t.prototype.applyPlacement = function (t, n) {
			var r = this.tip(), i = r[0].offsetWidth, a = r[0].offsetHeight, s = parseInt(r.css("margin-top"), 10),
				o = parseInt(r.css("margin-left"), 10);
			isNaN(s) && (s = 0), isNaN(o) && (o = 0), t.top += s, t.left += o, e.offset.setOffset(r[0], e.extend({
				using: function (e) {
					r.css({top: Math.round(e.top), left: Math.round(e.left)})
				}
			}, t), 0), r.addClass("in");
			var u = r[0].offsetWidth, d = r[0].offsetHeight;
			"top" == n && d != a && (t.top = t.top + a - d);
			var l = this.getViewportAdjustedDelta(n, t, u, d);
			l.left ? t.left += l.left : t.top += l.top;
			var c = /top|bottom/.test(n), h = c ? 2 * l.left - i + u : 2 * l.top - a + d,
				f = c ? "offsetWidth" : "offsetHeight";
			r.offset(t), this.replaceArrow(h, r[0][f], c)
		}, t.prototype.replaceArrow = function (e, t, n) {
			this.arrow().css(n ? "left" : "top", 50 * (1 - e / t) + "%").css(n ? "top" : "left", "")
		}, t.prototype.setContent = function () {
			var e = this.tip(), t = this.getTitle();
			e.find(".tooltip-inner")[this.options.html ? "html" : "text"](t), e.removeClass("fade in top bottom left right")
		}, t.prototype.hide = function (n) {
			var r = this, i = e(this.$tip), a = e.Event("hide.bs." + this.type);

			function s() {
				"in" != r.hoverState && i.detach(), r.$element && r.$element.removeAttr("aria-describedby").trigger("hidden.bs." + r.type), n && n()
			}

			if (this.$element.trigger(a), !a.isDefaultPrevented()) return i.removeClass("in"), e.support.transition && i.hasClass("fade") ? i.one("bsTransitionEnd", s).emulateTransitionEnd(t.TRANSITION_DURATION) : s(), this.hoverState = null, this
		}, t.prototype.fixTitle = function () {
			var e = this.$element;
			(e.attr("title") || "string" != typeof e.attr("data-original-title")) && e.attr("data-original-title", e.attr("title") || "").attr("title", "")
		}, t.prototype.hasContent = function () {
			return this.getTitle()
		}, t.prototype.getPosition = function (t) {
			var n = (t = t || this.$element)[0], r = "BODY" == n.tagName, i = n.getBoundingClientRect();
			null == i.width && (i = e.extend({}, i, {width: i.right - i.left, height: i.bottom - i.top}));
			var a = window.SVGElement && n instanceof window.SVGElement,
				s = r ? {top: 0, left: 0} : a ? null : t.offset(),
				o = {scroll: r ? document.documentElement.scrollTop || document.body.scrollTop : t.scrollTop()},
				u = r ? {width: e(window).width(), height: e(window).height()} : null;
			return e.extend({}, i, o, u, s)
		}, t.prototype.getCalculatedOffset = function (e, t, n, r) {
			return "bottom" == e ? {
				top: t.top + t.height,
				left: t.left + t.width / 2 - n / 2
			} : "top" == e ? {
				top: t.top - r,
				left: t.left + t.width / 2 - n / 2
			} : "left" == e ? {
				top: t.top + t.height / 2 - r / 2,
				left: t.left - n
			} : {top: t.top + t.height / 2 - r / 2, left: t.left + t.width}
		}, t.prototype.getViewportAdjustedDelta = function (e, t, n, r) {
			var i = {top: 0, left: 0};
			if (!this.$viewport) return i;
			var a = this.options.viewport && this.options.viewport.padding || 0, s = this.getPosition(this.$viewport);
			if (/right|left/.test(e)) {
				var o = t.top - a - s.scroll, u = t.top + a - s.scroll + r;
				o < s.top ? i.top = s.top - o : u > s.top + s.height && (i.top = s.top + s.height - u)
			} else {
				var d = t.left - a, l = t.left + a + n;
				d < s.left ? i.left = s.left - d : l > s.right && (i.left = s.left + s.width - l)
			}
			return i
		}, t.prototype.getTitle = function () {
			var e = this.$element, t = this.options;
			return e.attr("data-original-title") || ("function" == typeof t.title ? t.title.call(e[0]) : t.title)
		}, t.prototype.getUID = function (e) {
			do {
				e += ~~(1e6 * Math.random())
			} while (document.getElementById(e));
			return e
		}, t.prototype.tip = function () {
			if (!this.$tip && (this.$tip = e(this.options.template), 1 != this.$tip.length)) throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");
			return this.$tip
		}, t.prototype.arrow = function () {
			return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
		}, t.prototype.enable = function () {
			this.enabled = !0
		}, t.prototype.disable = function () {
			this.enabled = !1
		}, t.prototype.toggleEnabled = function () {
			this.enabled = !this.enabled
		}, t.prototype.toggle = function (t) {
			var n = this;
			t && ((n = e(t.currentTarget).data("bs." + this.type)) || (n = new this.constructor(t.currentTarget, this.getDelegateOptions()), e(t.currentTarget).data("bs." + this.type, n))), t ? (n.inState.click = !n.inState.click, n.isInStateTrue() ? n.enter(n) : n.leave(n)) : n.tip().hasClass("in") ? n.leave(n) : n.enter(n)
		}, t.prototype.destroy = function () {
			var e = this;
			clearTimeout(this.timeout), this.hide(function () {
				e.$element.off("." + e.type).removeData("bs." + e.type), e.$tip && e.$tip.detach(), e.$tip = null, e.$arrow = null, e.$viewport = null, e.$element = null
			})
		};
		var n = e.fn.tooltip;
		e.fn.tooltip = function (n) {
			return this.each(function () {
				var r = e(this), i = r.data("bs.tooltip"), a = "object" == typeof n && n;
				!i && /destroy|hide/.test(n) || (i || r.data("bs.tooltip", i = new t(this, a)), "string" == typeof n && i[n]())
			})
		}, e.fn.tooltip.Constructor = t, e.fn.tooltip.noConflict = function () {
			return e.fn.tooltip = n, this
		}
	}(jQuery), function (e) {
		"use strict";
		var t = function (e, t) {
			this.init("popover", e, t)
		};
		if (!e.fn.tooltip) throw new Error("Popover requires tooltip.js");
		t.VERSION = "3.3.7", t.DEFAULTS = e.extend({}, e.fn.tooltip.Constructor.DEFAULTS, {
			placement: "right",
			trigger: "click",
			content: "",
			template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
		}), t.prototype = e.extend({}, e.fn.tooltip.Constructor.prototype), t.prototype.constructor = t, t.prototype.getDefaults = function () {
			return t.DEFAULTS
		}, t.prototype.setContent = function () {
			var e = this.tip(), t = this.getTitle(), n = this.getContent();
			e.find(".popover-title")[this.options.html ? "html" : "text"](t), e.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof n ? "html" : "append" : "text"](n), e.removeClass("fade top bottom left right in"), e.find(".popover-title").html() || e.find(".popover-title").hide()
		}, t.prototype.hasContent = function () {
			return this.getTitle() || this.getContent()
		}, t.prototype.getContent = function () {
			var e = this.$element, t = this.options;
			return e.attr("data-content") || ("function" == typeof t.content ? t.content.call(e[0]) : t.content)
		}, t.prototype.arrow = function () {
			return this.$arrow = this.$arrow || this.tip().find(".arrow")
		};
		var n = e.fn.popover;
		e.fn.popover = function (n) {
			return this.each(function () {
				var r = e(this), i = r.data("bs.popover"), a = "object" == typeof n && n;
				!i && /destroy|hide/.test(n) || (i || r.data("bs.popover", i = new t(this, a)), "string" == typeof n && i[n]())
			})
		}, e.fn.popover.Constructor = t, e.fn.popover.noConflict = function () {
			return e.fn.popover = n, this
		}
	}(jQuery), function (e) {
		"use strict";

		function t(n, r) {
			this.$body = e(document.body), this.$scrollElement = e(n).is(document.body) ? e(window) : e(n), this.options = e.extend({}, t.DEFAULTS, r), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", e.proxy(this.process, this)), this.refresh(), this.process()
		}

		function n(n) {
			return this.each(function () {
				var r = e(this), i = r.data("bs.scrollspy"), a = "object" == typeof n && n;
				i || r.data("bs.scrollspy", i = new t(this, a)), "string" == typeof n && i[n]()
			})
		}

		t.VERSION = "3.3.7", t.DEFAULTS = {offset: 10}, t.prototype.getScrollHeight = function () {
			return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
		}, t.prototype.refresh = function () {
			var t = this, n = "offset", r = 0;
			this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), e.isWindow(this.$scrollElement[0]) || (n = "position", r = this.$scrollElement.scrollTop()), this.$body.find(this.selector).map(function () {
				var t = e(this), i = t.data("target") || t.attr("href"), a = /^#./.test(i) && e(i);
				return a && a.length && a.is(":visible") && [[a[n]().top + r, i]] || null
			}).sort(function (e, t) {
				return e[0] - t[0]
			}).each(function () {
				t.offsets.push(this[0]), t.targets.push(this[1])
			})
		}, t.prototype.process = function () {
			var e, t = this.$scrollElement.scrollTop() + this.options.offset, n = this.getScrollHeight(),
				r = this.options.offset + n - this.$scrollElement.height(), i = this.offsets, a = this.targets,
				s = this.activeTarget;
			if (this.scrollHeight != n && this.refresh(), t >= r) return s != (e = a[a.length - 1]) && this.activate(e);
			if (s && t < i[0]) return this.activeTarget = null, this.clear();
			for (e = i.length; e--;) s != a[e] && t >= i[e] && (void 0 === i[e + 1] || t < i[e + 1]) && this.activate(a[e])
		}, t.prototype.activate = function (t) {
			this.activeTarget = t, this.clear();
			var n = this.selector + '[data-target="' + t + '"],' + this.selector + '[href="' + t + '"]',
				r = e(n).parents("li").addClass("active");
			r.parent(".dropdown-menu").length && (r = r.closest("li.dropdown").addClass("active")), r.trigger("activate.bs.scrollspy")
		}, t.prototype.clear = function () {
			e(this.selector).parentsUntil(this.options.target, ".active").removeClass("active")
		};
		var r = e.fn.scrollspy;
		e.fn.scrollspy = n, e.fn.scrollspy.Constructor = t, e.fn.scrollspy.noConflict = function () {
			return e.fn.scrollspy = r, this
		}, e(window).on("load.bs.scrollspy.data-api", function () {
			e('[data-spy="scroll"]').each(function () {
				var t = e(this);
				n.call(t, t.data())
			})
		})
	}(jQuery), function (e) {
		"use strict";
		var t = function (t) {
			this.element = e(t)
		};

		function n(n) {
			return this.each(function () {
				var r = e(this), i = r.data("bs.tab");
				i || r.data("bs.tab", i = new t(this)), "string" == typeof n && i[n]()
			})
		}

		t.VERSION = "3.3.7", t.TRANSITION_DURATION = 150, t.prototype.show = function () {
			var t = this.element, n = t.closest("ul:not(.dropdown-menu)"), r = t.data("target");
			if (r || (r = (r = t.attr("href")) && r.replace(/.*(?=#[^\s]*$)/, "")), !t.parent("li").hasClass("active")) {
				var i = n.find(".active:last a"), a = e.Event("hide.bs.tab", {relatedTarget: t[0]}),
					s = e.Event("show.bs.tab", {relatedTarget: i[0]});
				if (i.trigger(a), t.trigger(s), !s.isDefaultPrevented() && !a.isDefaultPrevented()) {
					var o = e(r);
					this.activate(t.closest("li"), n), this.activate(o, o.parent(), function () {
						i.trigger({type: "hidden.bs.tab", relatedTarget: t[0]}), t.trigger({
							type: "shown.bs.tab",
							relatedTarget: i[0]
						})
					})
				}
			}
		}, t.prototype.activate = function (n, r, i) {
			var a = r.find("> .active"),
				s = i && e.support.transition && (a.length && a.hasClass("fade") || !!r.find("> .fade").length);

			function o() {
				a.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), n.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), s ? (n[0].offsetWidth, n.addClass("in")) : n.removeClass("fade"), n.parent(".dropdown-menu").length && n.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), i && i()
			}

			a.length && s ? a.one("bsTransitionEnd", o).emulateTransitionEnd(t.TRANSITION_DURATION) : o(), a.removeClass("in")
		};
		var r = e.fn.tab;
		e.fn.tab = n, e.fn.tab.Constructor = t, e.fn.tab.noConflict = function () {
			return e.fn.tab = r, this
		};
		var i = function (t) {
			t.preventDefault(), n.call(e(this), "show")
		};
		e(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', i).on("click.bs.tab.data-api", '[data-toggle="pill"]', i)
	}(jQuery), function (e) {
		"use strict";
		var t = function (n, r) {
			this.options = e.extend({}, t.DEFAULTS, r), this.$target = e(this.options.target).on("scroll.bs.affix.data-api", e.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", e.proxy(this.checkPositionWithEventLoop, this)), this.$element = e(n), this.affixed = null, this.unpin = null, this.pinnedOffset = null, this.checkPosition()
		};

		function n(n) {
			return this.each(function () {
				var r = e(this), i = r.data("bs.affix"), a = "object" == typeof n && n;
				i || r.data("bs.affix", i = new t(this, a)), "string" == typeof n && i[n]()
			})
		}

		t.VERSION = "3.3.7", t.RESET = "affix affix-top affix-bottom", t.DEFAULTS = {
			offset: 0,
			target: window
		}, t.prototype.getState = function (e, t, n, r) {
			var i = this.$target.scrollTop(), a = this.$element.offset(), s = this.$target.height();
			if (null != n && "top" == this.affixed) return i < n && "top";
			if ("bottom" == this.affixed) return null != n ? !(i + this.unpin <= a.top) && "bottom" : !(i + s <= e - r) && "bottom";
			var o = null == this.affixed, u = o ? i : a.top;
			return null != n && i <= n ? "top" : null != r && u + (o ? s : t) >= e - r && "bottom"
		}, t.prototype.getPinnedOffset = function () {
			if (this.pinnedOffset) return this.pinnedOffset;
			this.$element.removeClass(t.RESET).addClass("affix");
			var e = this.$target.scrollTop(), n = this.$element.offset();
			return this.pinnedOffset = n.top - e
		}, t.prototype.checkPositionWithEventLoop = function () {
			setTimeout(e.proxy(this.checkPosition, this), 1)
		}, t.prototype.checkPosition = function () {
			if (this.$element.is(":visible")) {
				var n = this.$element.height(), r = this.options.offset, i = r.top, a = r.bottom,
					s = Math.max(e(document).height(), e(document.body).height());
				"object" != typeof r && (a = i = r), "function" == typeof i && (i = r.top(this.$element)), "function" == typeof a && (a = r.bottom(this.$element));
				var o = this.getState(s, n, i, a);
				if (this.affixed != o) {
					null != this.unpin && this.$element.css("top", "");
					var u = "affix" + (o ? "-" + o : ""), d = e.Event(u + ".bs.affix");
					if (this.$element.trigger(d), d.isDefaultPrevented()) return;
					this.affixed = o, this.unpin = "bottom" == o ? this.getPinnedOffset() : null, this.$element.removeClass(t.RESET).addClass(u).trigger(u.replace("affix", "affixed") + ".bs.affix")
				}
				"bottom" == o && this.$element.offset({top: s - n - a})
			}
		};
		var r = e.fn.affix;
		e.fn.affix = n, e.fn.affix.Constructor = t, e.fn.affix.noConflict = function () {
			return e.fn.affix = r, this
		}, e(window).on("load", function () {
			e('[data-spy="affix"]').each(function () {
				var t = e(this), r = t.data();
				r.offset = r.offset || {}, null != r.offsetBottom && (r.offset.bottom = r.offsetBottom), null != r.offsetTop && (r.offset.top = r.offsetTop), n.call(t, r)
			})
		})
	}(jQuery)
}, function (e, t, n) {
	e.exports = n(140)
}, function (e, t, n) {
	"use strict";
	var r = n(1), i = n(5), a = n(142), s = n(3);

	function o(e) {
		var t = new a(e), n = i(a.prototype.request, t);
		return r.extend(n, a.prototype, t), r.extend(n, t), n
	}

	var u = o(s);
	u.Axios = a, u.create = function (e) {
		return o(r.merge(s, e))
	}, u.Cancel = n(9), u.CancelToken = n(157), u.isCancel = n(8), u.all = function (e) {
		return Promise.all(e)
	}, u.spread = n(158), e.exports = u, e.exports.default = u
}, function (e, t) {
	function n(e) {
		return !!e.constructor && "function" == typeof e.constructor.isBuffer && e.constructor.isBuffer(e)
	}

	e.exports = function (e) {
		return null != e && (n(e) || function (e) {
			return "function" == typeof e.readFloatLE && "function" == typeof e.slice && n(e.slice(0, 0))
		}(e) || !!e._isBuffer)
	}
}, function (e, t, n) {
	"use strict";
	var r = n(3), i = n(1), a = n(152), s = n(153);

	function o(e) {
		this.defaults = e, this.interceptors = {request: new a, response: new a}
	}

	o.prototype.request = function (e) {
		"string" == typeof e && (e = i.merge({url: arguments[0]}, arguments[1])), (e = i.merge(r, {method: "get"}, this.defaults, e)).method = e.method.toLowerCase();
		var t = [s, void 0], n = Promise.resolve(e);
		for (this.interceptors.request.forEach(function (e) {
			t.unshift(e.fulfilled, e.rejected)
		}), this.interceptors.response.forEach(function (e) {
			t.push(e.fulfilled, e.rejected)
		}); t.length;) n = n.then(t.shift(), t.shift());
		return n
	}, i.forEach(["delete", "get", "head", "options"], function (e) {
		o.prototype[e] = function (t, n) {
			return this.request(i.merge(n || {}, {method: e, url: t}))
		}
	}), i.forEach(["post", "put", "patch"], function (e) {
		o.prototype[e] = function (t, n, r) {
			return this.request(i.merge(r || {}, {method: e, url: t, data: n}))
		}
	}), e.exports = o
}, function (e, t) {
	var n, r, i = e.exports = {};

	function a() {
		throw new Error("setTimeout has not been defined")
	}

	function s() {
		throw new Error("clearTimeout has not been defined")
	}

	function o(e) {
		if (n === setTimeout) return setTimeout(e, 0);
		if ((n === a || !n) && setTimeout) return n = setTimeout, setTimeout(e, 0);
		try {
			return n(e, 0)
		} catch (t) {
			try {
				return n.call(null, e, 0)
			} catch (t) {
				return n.call(this, e, 0)
			}
		}
	}

	!function () {
		try {
			n = "function" == typeof setTimeout ? setTimeout : a
		} catch (e) {
			n = a
		}
		try {
			r = "function" == typeof clearTimeout ? clearTimeout : s
		} catch (e) {
			r = s
		}
	}();
	var u, d = [], l = !1, c = -1;

	function h() {
		l && u && (l = !1, u.length ? d = u.concat(d) : c = -1, d.length && f())
	}

	function f() {
		if (!l) {
			var e = o(h);
			l = !0;
			for (var t = d.length; t;) {
				for (u = d, d = []; ++c < t;) u && u[c].run();
				c = -1, t = d.length
			}
			u = null, l = !1, function (e) {
				if (r === clearTimeout) return clearTimeout(e);
				if ((r === s || !r) && clearTimeout) return r = clearTimeout, clearTimeout(e);
				try {
					r(e)
				} catch (t) {
					try {
						return r.call(null, e)
					} catch (t) {
						return r.call(this, e)
					}
				}
			}(e)
		}
	}

	function _(e, t) {
		this.fun = e, this.array = t
	}

	function p() {
	}

	i.nextTick = function (e) {
		var t = new Array(arguments.length - 1);
		if (arguments.length > 1) for (var n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
		d.push(new _(e, t)), 1 !== d.length || l || o(f)
	}, _.prototype.run = function () {
		this.fun.apply(null, this.array)
	}, i.title = "browser", i.browser = !0, i.env = {}, i.argv = [], i.version = "", i.versions = {}, i.on = p, i.addListener = p, i.once = p, i.off = p, i.removeListener = p, i.removeAllListeners = p, i.emit = p, i.prependListener = p, i.prependOnceListener = p, i.listeners = function (e) {
		return []
	}, i.binding = function (e) {
		throw new Error("process.binding is not supported")
	}, i.cwd = function () {
		return "/"
	}, i.chdir = function (e) {
		throw new Error("process.chdir is not supported")
	}, i.umask = function () {
		return 0
	}
}, function (e, t, n) {
	"use strict";
	var r = n(1);
	e.exports = function (e, t) {
		r.forEach(e, function (n, r) {
			r !== t && r.toUpperCase() === t.toUpperCase() && (e[t] = n, delete e[r])
		})
	}
}, function (e, t, n) {
	"use strict";
	var r = n(7);
	e.exports = function (e, t, n) {
		var i = n.config.validateStatus;
		n.status && i && !i(n.status) ? t(r("Request failed with status code " + n.status, n.config, null, n.request, n)) : e(n)
	}
}, function (e, t, n) {
	"use strict";
	e.exports = function (e, t, n, r, i) {
		return e.config = t, n && (e.code = n), e.request = r, e.response = i, e
	}
}, function (e, t, n) {
	"use strict";
	var r = n(1);

	function i(e) {
		return encodeURIComponent(e).replace(/%40/gi, "@").replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]")
	}

	e.exports = function (e, t, n) {
		if (!t) return e;
		var a;
		if (n) a = n(t); else if (r.isURLSearchParams(t)) a = t.toString(); else {
			var s = [];
			r.forEach(t, function (e, t) {
				null !== e && void 0 !== e && (r.isArray(e) ? t += "[]" : e = [e], r.forEach(e, function (e) {
					r.isDate(e) ? e = e.toISOString() : r.isObject(e) && (e = JSON.stringify(e)), s.push(i(t) + "=" + i(e))
				}))
			}), a = s.join("&")
		}
		return a && (e += (-1 === e.indexOf("?") ? "?" : "&") + a), e
	}
}, function (e, t, n) {
	"use strict";
	var r = n(1),
		i = ["age", "authorization", "content-length", "content-type", "etag", "expires", "from", "host", "if-modified-since", "if-unmodified-since", "last-modified", "location", "max-forwards", "proxy-authorization", "referer", "retry-after", "user-agent"];
	e.exports = function (e) {
		var t, n, a, s = {};
		return e ? (r.forEach(e.split("\n"), function (e) {
			if (a = e.indexOf(":"), t = r.trim(e.substr(0, a)).toLowerCase(), n = r.trim(e.substr(a + 1)), t) {
				if (s[t] && i.indexOf(t) >= 0) return;
				s[t] = "set-cookie" === t ? (s[t] ? s[t] : []).concat([n]) : s[t] ? s[t] + ", " + n : n
			}
		}), s) : s
	}
}, function (e, t, n) {
	"use strict";
	var r = n(1);
	e.exports = r.isStandardBrowserEnv() ? function () {
		var e, t = /(msie|trident)/i.test(navigator.userAgent), n = document.createElement("a");

		function i(e) {
			var r = e;
			return t && (n.setAttribute("href", r), r = n.href), n.setAttribute("href", r), {
				href: n.href,
				protocol: n.protocol ? n.protocol.replace(/:$/, "") : "",
				host: n.host,
				search: n.search ? n.search.replace(/^\?/, "") : "",
				hash: n.hash ? n.hash.replace(/^#/, "") : "",
				hostname: n.hostname,
				port: n.port,
				pathname: "/" === n.pathname.charAt(0) ? n.pathname : "/" + n.pathname
			}
		}

		return e = i(window.location.href), function (t) {
			var n = r.isString(t) ? i(t) : t;
			return n.protocol === e.protocol && n.host === e.host
		}
	}() : function () {
		return !0
	}
}, function (e, t, n) {
	"use strict";
	var r = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

	function i() {
		this.message = "String contains an invalid character"
	}

	i.prototype = new Error, i.prototype.code = 5, i.prototype.name = "InvalidCharacterError", e.exports = function (e) {
		for (var t, n, a = String(e), s = "", o = 0, u = r; a.charAt(0 | o) || (u = "=", o % 1); s += u.charAt(63 & t >> 8 - o % 1 * 8)) {
			if ((n = a.charCodeAt(o += .75)) > 255) throw new i;
			t = t << 8 | n
		}
		return s
	}
}, function (e, t, n) {
	"use strict";
	var r = n(1);
	e.exports = r.isStandardBrowserEnv() ? {
		write: function (e, t, n, i, a, s) {
			var o = [];
			o.push(e + "=" + encodeURIComponent(t)), r.isNumber(n) && o.push("expires=" + new Date(n).toGMTString()), r.isString(i) && o.push("path=" + i), r.isString(a) && o.push("domain=" + a), !0 === s && o.push("secure"), document.cookie = o.join("; ")
		}, read: function (e) {
			var t = document.cookie.match(new RegExp("(^|;\\s*)(" + e + ")=([^;]*)"));
			return t ? decodeURIComponent(t[3]) : null
		}, remove: function (e) {
			this.write(e, "", Date.now() - 864e5)
		}
	} : {
		write: function () {
		}, read: function () {
			return null
		}, remove: function () {
		}
	}
}, function (e, t, n) {
	"use strict";
	var r = n(1);

	function i() {
		this.handlers = []
	}

	i.prototype.use = function (e, t) {
		return this.handlers.push({fulfilled: e, rejected: t}), this.handlers.length - 1
	}, i.prototype.eject = function (e) {
		this.handlers[e] && (this.handlers[e] = null)
	}, i.prototype.forEach = function (e) {
		r.forEach(this.handlers, function (t) {
			null !== t && e(t)
		})
	}, e.exports = i
}, function (e, t, n) {
	"use strict";
	var r = n(1), i = n(154), a = n(8), s = n(3), o = n(155), u = n(156);

	function d(e) {
		e.cancelToken && e.cancelToken.throwIfRequested()
	}

	e.exports = function (e) {
		return d(e), e.baseURL && !o(e.url) && (e.url = u(e.baseURL, e.url)), e.headers = e.headers || {}, e.data = i(e.data, e.headers, e.transformRequest), e.headers = r.merge(e.headers.common || {}, e.headers[e.method] || {}, e.headers || {}), r.forEach(["delete", "get", "head", "post", "put", "patch", "common"], function (t) {
			delete e.headers[t]
		}), (e.adapter || s.adapter)(e).then(function (t) {
			return d(e), t.data = i(t.data, t.headers, e.transformResponse), t
		}, function (t) {
			return a(t) || (d(e), t && t.response && (t.response.data = i(t.response.data, t.response.headers, e.transformResponse))), Promise.reject(t)
		})
	}
}, function (e, t, n) {
	"use strict";
	var r = n(1);
	e.exports = function (e, t, n) {
		return r.forEach(n, function (n) {
			e = n(e, t)
		}), e
	}
}, function (e, t, n) {
	"use strict";
	e.exports = function (e) {
		return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(e)
	}
}, function (e, t, n) {
	"use strict";
	e.exports = function (e, t) {
		return t ? e.replace(/\/+$/, "") + "/" + t.replace(/^\/+/, "") : e
	}
}, function (e, t, n) {
	"use strict";
	var r = n(9);

	function i(e) {
		if ("function" != typeof e) throw new TypeError("executor must be a function.");
		var t;
		this.promise = new Promise(function (e) {
			t = e
		});
		var n = this;
		e(function (e) {
			n.reason || (n.reason = new r(e), t(n.reason))
		})
	}

	i.prototype.throwIfRequested = function () {
		if (this.reason) throw this.reason
	}, i.source = function () {
		var e;
		return {
			token: new i(function (t) {
				e = t
			}), cancel: e
		}
	}, e.exports = i
}, function (e, t, n) {
	"use strict";
	e.exports = function (e) {
		return function (t) {
			return e.apply(null, t)
		}
	}
}, function (e, t, n) {
	var r;
	r = function () {
		return function (e) {
			var t = {};

			function n(r) {
				if (t[r]) return t[r].exports;
				var i = t[r] = {exports: {}, id: r, loaded: !1};
				return e[r].call(i.exports, i, i.exports, n), i.loaded = !0, i.exports
			}

			return n.m = e, n.c = t, n.p = "", n(0)
		}([function (e, t, n) {
			"use strict";
			var r = n(1);
			e.exports = r.default
		}, function (e, t, n) {
			"use strict";
			var r = n(2), i = n(9), a = n(24), s = n(39), o = n(40), u = n(41), d = n(12), l = n(5), c = n(71),
				h = n(8), f = n(43), _ = n(14), p = function () {
					function e(t, n) {
						var d = this;
						if (function (e) {
							if (null === e || void 0 === e) throw"You must pass your app key when you instantiate Pusher."
						}(t), !(n = n || {}).cluster && !n.wsHost && !n.httpHost) {
							var p = _.default.buildLogSuffix("javascriptQuickStart");
							h.default.warn("You should always specify a cluster when connecting. " + p)
						}
						this.key = t, this.config = i.extend(c.getGlobalConfig(), n.cluster ? c.getClusterConfig(n.cluster) : {}, n), this.channels = f.default.createChannels(), this.global_emitter = new a.default, this.sessionID = Math.floor(1e9 * Math.random()), this.timeline = new s.default(this.key, this.sessionID, {
							cluster: this.config.cluster,
							features: e.getClientFeatures(),
							params: this.config.timelineParams || {},
							limit: 50,
							level: o.default.INFO,
							version: l.default.VERSION
						}), this.config.disableStats || (this.timelineSender = f.default.createTimelineSender(this.timeline, {
							host: this.config.statsHost,
							path: "/timeline/v2/" + r.default.TimelineTransport.name
						}));
						this.connection = f.default.createConnectionManager(this.key, i.extend({
							getStrategy: function (e) {
								var t = i.extend({}, d.config, e);
								return u.build(r.default.getDefaultStrategy(t), t)
							},
							timeline: this.timeline,
							activityTimeout: this.config.activity_timeout,
							pongTimeout: this.config.pong_timeout,
							unavailableTimeout: this.config.unavailable_timeout
						}, this.config, {useTLS: this.shouldUseTLS()})), this.connection.bind("connected", function () {
							d.subscribeAll(), d.timelineSender && d.timelineSender.send(d.connection.isUsingTLS())
						}), this.connection.bind("message", function (e) {
							var t = 0 === e.event.indexOf("pusher_internal:");
							if (e.channel) {
								var n = d.channel(e.channel);
								n && n.handleEvent(e.event, e.data)
							}
							t || d.global_emitter.emit(e.event, e.data)
						}), this.connection.bind("connecting", function () {
							d.channels.disconnect()
						}), this.connection.bind("disconnected", function () {
							d.channels.disconnect()
						}), this.connection.bind("error", function (e) {
							h.default.warn("Error", e)
						}), e.instances.push(this), this.timeline.info({instances: e.instances.length}), e.isReady && this.connect()
					}

					return e.ready = function () {
						e.isReady = !0;
						for (var t = 0, n = e.instances.length; t < n; t++) e.instances[t].connect()
					}, e.log = function (t) {
						e.logToConsole && window.console && window.console.log && window.console.log(t)
					}, e.getClientFeatures = function () {
						return i.keys(i.filterObject({ws: r.default.Transports.ws}, function (e) {
							return e.isSupported({})
						}))
					}, e.prototype.channel = function (e) {
						return this.channels.find(e)
					}, e.prototype.allChannels = function () {
						return this.channels.all()
					}, e.prototype.connect = function () {
						if (this.connection.connect(), this.timelineSender && !this.timelineSenderTimer) {
							var e = this.connection.isUsingTLS(), t = this.timelineSender;
							this.timelineSenderTimer = new d.PeriodicTimer(6e4, function () {
								t.send(e)
							})
						}
					}, e.prototype.disconnect = function () {
						this.connection.disconnect(), this.timelineSenderTimer && (this.timelineSenderTimer.ensureAborted(), this.timelineSenderTimer = null)
					}, e.prototype.bind = function (e, t, n) {
						return this.global_emitter.bind(e, t, n), this
					}, e.prototype.unbind = function (e, t, n) {
						return this.global_emitter.unbind(e, t, n), this
					}, e.prototype.bind_global = function (e) {
						return this.global_emitter.bind_global(e), this
					}, e.prototype.unbind_global = function (e) {
						return this.global_emitter.unbind_global(e), this
					}, e.prototype.unbind_all = function (e) {
						return this.global_emitter.unbind_all(), this
					}, e.prototype.subscribeAll = function () {
						var e;
						for (e in this.channels.channels) this.channels.channels.hasOwnProperty(e) && this.subscribe(e)
					}, e.prototype.subscribe = function (e) {
						var t = this.channels.add(e, this);
						return t.subscriptionPending && t.subscriptionCancelled ? t.reinstateSubscription() : t.subscriptionPending || "connected" !== this.connection.state || t.subscribe(), t
					}, e.prototype.unsubscribe = function (e) {
						var t = this.channels.find(e);
						t && t.subscriptionPending ? t.cancelSubscription() : (t = this.channels.remove(e)) && "connected" === this.connection.state && t.unsubscribe()
					}, e.prototype.send_event = function (e, t, n) {
						return this.connection.send_event(e, t, n)
					}, e.prototype.shouldUseTLS = function () {
						return "https:" === r.default.getProtocol() || (!0 === this.config.forceTLS || Boolean(this.config.encrypted))
					}, e.instances = [], e.isReady = !1, e.logToConsole = !1, e.Runtime = r.default, e.ScriptReceivers = r.default.ScriptReceivers, e.DependenciesReceivers = r.default.DependenciesReceivers, e.auth_callbacks = r.default.auth_callbacks, e
				}();
			t.__esModule = !0, t.default = p, r.default.setup(p)
		}, function (e, t, n) {
			"use strict";
			var r = n(3), i = n(7), a = n(15), s = n(16), o = n(17), u = n(4), d = n(18), l = n(19), c = n(26),
				h = n(27), f = n(28), _ = n(29), p = {
					nextAuthCallbackID: 1,
					auth_callbacks: {},
					ScriptReceivers: u.ScriptReceivers,
					DependenciesReceivers: r.DependenciesReceivers,
					getDefaultStrategy: h.default,
					Transports: l.default,
					transportConnectionInitializer: f.default,
					HTTPFactory: _.default,
					TimelineTransport: d.default,
					getXHRAPI: function () {
						return window.XMLHttpRequest
					},
					getWebSocketAPI: function () {
						return window.WebSocket || window.MozWebSocket
					},
					setup: function (e) {
						var t = this;
						window.Pusher = e;
						var n = function () {
							t.onDocumentBody(e.ready)
						};
						window.JSON ? n() : r.Dependencies.load("json2", {}, n)
					},
					getDocument: function () {
						return document
					},
					getProtocol: function () {
						return this.getDocument().location.protocol
					},
					getAuthorizers: function () {
						return {ajax: i.default, jsonp: a.default}
					},
					onDocumentBody: function (e) {
						var t = this;
						document.body ? e() : setTimeout(function () {
							t.onDocumentBody(e)
						}, 0)
					},
					createJSONPRequest: function (e, t) {
						return new o.default(e, t)
					},
					createScriptRequest: function (e) {
						return new s.default(e)
					},
					getLocalStorage: function () {
						try {
							return window.localStorage
						} catch (e) {
							return
						}
					},
					createXHR: function () {
						return this.getXHRAPI() ? this.createXMLHttpRequest() : this.createMicrosoftXHR()
					},
					createXMLHttpRequest: function () {
						return new (this.getXHRAPI())
					},
					createMicrosoftXHR: function () {
						return new ActiveXObject("Microsoft.XMLHTTP")
					},
					getNetwork: function () {
						return c.Network
					},
					createWebSocket: function (e) {
						return new (this.getWebSocketAPI())(e)
					},
					createSocketRequest: function (e, t) {
						if (this.isXHRSupported()) return this.HTTPFactory.createXHR(e, t);
						if (this.isXDRSupported(0 === t.indexOf("https:"))) return this.HTTPFactory.createXDR(e, t);
						throw"Cross-origin HTTP requests are not supported"
					},
					isXHRSupported: function () {
						var e = this.getXHRAPI();
						return Boolean(e) && void 0 !== (new e).withCredentials
					},
					isXDRSupported: function (e) {
						var t = e ? "https:" : "http:", n = this.getProtocol();
						return Boolean(window.XDomainRequest) && n === t
					},
					addUnloadListener: function (e) {
						void 0 !== window.addEventListener ? window.addEventListener("unload", e, !1) : void 0 !== window.attachEvent && window.attachEvent("onunload", e)
					},
					removeUnloadListener: function (e) {
						void 0 !== window.addEventListener ? window.removeEventListener("unload", e, !1) : void 0 !== window.detachEvent && window.detachEvent("onunload", e)
					}
				};
			t.__esModule = !0, t.default = p
		}, function (e, t, n) {
			"use strict";
			var r = n(4), i = n(5), a = n(6);
			t.DependenciesReceivers = new r.ScriptReceiverFactory("_pusher_dependencies", "Pusher.DependenciesReceivers"), t.Dependencies = new a.default({
				cdn_http: i.default.cdn_http,
				cdn_https: i.default.cdn_https,
				version: i.default.VERSION,
				suffix: i.default.dependency_suffix,
				receivers: t.DependenciesReceivers
			})
		}, function (e, t) {
			"use strict";
			var n = function () {
				function e(e, t) {
					this.lastId = 0, this.prefix = e, this.name = t
				}

				return e.prototype.create = function (e) {
					this.lastId++;
					var t = this.lastId, n = this.prefix + t, r = this.name + "[" + t + "]", i = !1, a = function () {
						i || (e.apply(null, arguments), i = !0)
					};
					return this[t] = a, {number: t, id: n, name: r, callback: a}
				}, e.prototype.remove = function (e) {
					delete this[e.number]
				}, e
			}();
			t.ScriptReceiverFactory = n, t.ScriptReceivers = new n("_pusher_script_", "Pusher.ScriptReceivers")
		}, function (e, t) {
			"use strict";
			t.__esModule = !0, t.default = {
				VERSION: "4.3.1",
				PROTOCOL: 7,
				host: "ws.pusherapp.com",
				ws_port: 80,
				wss_port: 443,
				ws_path: "",
				sockjs_host: "sockjs.pusher.com",
				sockjs_http_port: 80,
				sockjs_https_port: 443,
				sockjs_path: "/pusher",
				stats_host: "stats.pusher.com",
				channel_auth_endpoint: "/pusher/auth",
				channel_auth_transport: "ajax",
				activity_timeout: 12e4,
				pong_timeout: 3e4,
				unavailable_timeout: 1e4,
				cdn_http: "http://js.pusher.com",
				cdn_https: "https://js.pusher.com",
				dependency_suffix: ""
			}
		}, function (e, t, n) {
			"use strict";
			var r = n(4), i = n(2), a = function () {
				function e(e) {
					this.options = e, this.receivers = e.receivers || r.ScriptReceivers, this.loading = {}
				}

				return e.prototype.load = function (e, t, n) {
					var r = this;
					if (r.loading[e] && r.loading[e].length > 0) r.loading[e].push(n); else {
						r.loading[e] = [n];
						var a = i.default.createScriptRequest(r.getPath(e, t)), s = r.receivers.create(function (t) {
							if (r.receivers.remove(s), r.loading[e]) {
								var n = r.loading[e];
								delete r.loading[e];
								for (var i = function (e) {
									e || a.cleanup()
								}, o = 0; o < n.length; o++) n[o](t, i)
							}
						});
						a.send(s)
					}
				}, e.prototype.getRoot = function (e) {
					var t = i.default.getDocument().location.protocol;
					return (e && e.useTLS || "https:" === t ? this.options.cdn_https : this.options.cdn_http).replace(/\/*$/, "") + "/" + this.options.version
				}, e.prototype.getPath = function (e, t) {
					return this.getRoot(t) + "/" + e + this.options.suffix + ".js"
				}, e
			}();
			t.__esModule = !0, t.default = a
		}, function (e, t, n) {
			"use strict";
			var r = n(8), i = n(2), a = n(14);
			t.__esModule = !0, t.default = function (e, t, n) {
				var s;
				for (var o in(s = i.default.createXHR()).open("POST", this.options.authEndpoint, !0), s.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), this.authOptions.headers) s.setRequestHeader(o, this.authOptions.headers[o]);
				return s.onreadystatechange = function () {
					if (4 === s.readyState) if (200 === s.status) {
						var e, t = !1;
						try {
							e = JSON.parse(s.responseText), t = !0
						} catch (e) {
							n(!0, "JSON returned from webapp was invalid, yet status code was 200. Data was: " + s.responseText)
						}
						t && n(!1, e)
					} else {
						var i = a.default.buildLogSuffix("authenticationEndpoint");
						r.default.warn("Couldn't retrieve authentication info. " + s.status + "Clients must be authenticated to join private or presence channels. " + i), n(!0, s.status)
					}
				}, s.send(this.composeQuery(t)), s
			}
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = n(1), a = {
				debug: function () {
					for (var e = [], t = 0; t < arguments.length; t++) e[t - 0] = arguments[t];
					i.default.log && i.default.log(r.stringify.apply(this, arguments))
				}, warn: function () {
					for (var e = [], t = 0; t < arguments.length; t++) e[t - 0] = arguments[t];
					var n = r.stringify.apply(this, arguments);
					i.default.log ? i.default.log(n) : window.console && (window.console.warn ? window.console.warn(n) : window.console.log && window.console.log(n))
				}
			};
			t.__esModule = !0, t.default = a
		}, function (e, t, n) {
			"use strict";
			var r = n(10), i = n(11);

			function a(e, t) {
				for (var n in e) Object.prototype.hasOwnProperty.call(e, n) && t(e[n], n, e)
			}

			function s(e, t) {
				for (var n = [], r = 0; r < e.length; r++) n.push(t(e[r], r, e, n));
				return n
			}

			function o(e, t) {
				var n = {};
				return a(e, function (e, r) {
					n[r] = t(e)
				}), n
			}

			function u(e, t) {
				var n = {};
				return a(e, function (r, i) {
					(t && t(r, i, e, n) || Boolean(r)) && (n[i] = r)
				}), n
			}

			function d(e) {
				var t = [];
				return a(e, function (e, n) {
					t.push([n, e])
				}), t
			}

			function l(e) {
				return o(e, function (e) {
					return "object" == typeof e && (e = h(e)), encodeURIComponent(r.default(e.toString()))
				})
			}

			function c(e) {
				var t = [], n = [];
				return function e(r, i) {
					var a, s, o;
					switch (typeof r) {
						case"object":
							if (!r) return null;
							for (a = 0; a < t.length; a += 1) if (t[a] === r) return {$ref: n[a]};
							if (t.push(r), n.push(i), "[object Array]" === Object.prototype.toString.apply(r)) for (o = [], a = 0; a < r.length; a += 1) o[a] = e(r[a], i + "[" + a + "]"); else for (s in o = {}, r) Object.prototype.hasOwnProperty.call(r, s) && (o[s] = e(r[s], i + "[" + JSON.stringify(s) + "]"));
							return o;
						case"number":
						case"string":
						case"boolean":
							return r
					}
				}(e, "$")
			}

			function h(e) {
				try {
					return JSON.stringify(e)
				} catch (t) {
					return JSON.stringify(c(e))
				}
			}

			t.extend = function e(t) {
				for (var n = [], r = 1; r < arguments.length; r++) n[r - 1] = arguments[r];
				for (var i = 0; i < n.length; i++) {
					var a = n[i];
					for (var s in a) a[s] && a[s].constructor && a[s].constructor === Object ? t[s] = e(t[s] || {}, a[s]) : t[s] = a[s]
				}
				return t
			}, t.stringify = function () {
				for (var e = ["Pusher"], t = 0; t < arguments.length; t++) "string" == typeof arguments[t] ? e.push(arguments[t]) : e.push(h(arguments[t]));
				return e.join(" : ")
			}, t.arrayIndexOf = function (e, t) {
				var n = Array.prototype.indexOf;
				if (null === e) return -1;
				if (n && e.indexOf === n) return e.indexOf(t);
				for (var r = 0, i = e.length; r < i; r++) if (e[r] === t) return r;
				return -1
			}, t.objectApply = a, t.keys = function (e) {
				var t = [];
				return a(e, function (e, n) {
					t.push(n)
				}), t
			}, t.values = function (e) {
				var t = [];
				return a(e, function (e) {
					t.push(e)
				}), t
			}, t.apply = function (e, t, n) {
				for (var r = 0; r < e.length; r++) t.call(n || window, e[r], r, e)
			}, t.map = s, t.mapObject = o, t.filter = function (e, t) {
				t = t || function (e) {
					return !!e
				};
				for (var n = [], r = 0; r < e.length; r++) t(e[r], r, e, n) && n.push(e[r]);
				return n
			}, t.filterObject = u, t.flatten = d, t.any = function (e, t) {
				for (var n = 0; n < e.length; n++) if (t(e[n], n, e)) return !0;
				return !1
			}, t.all = function (e, t) {
				for (var n = 0; n < e.length; n++) if (!t(e[n], n, e)) return !1;
				return !0
			}, t.encodeParamsObject = l, t.buildQueryString = function (e) {
				return s(d(l(u(e, function (e) {
					return void 0 !== e
				}))), i.default.method("join", "=")).join("&")
			}, t.decycleObject = c, t.safeJSONStringify = h
		}, function (e, t, n) {
			"use strict";
			t.__esModule = !0, t.default = function (e) {
				return c(d(e))
			};
			for (var r = String.fromCharCode, i = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", a = {}, s = 0, o = i.length; s < o; s++) a[i.charAt(s)] = s;
			var u = function (e) {
				var t = e.charCodeAt(0);
				return t < 128 ? e : t < 2048 ? r(192 | t >>> 6) + r(128 | 63 & t) : r(224 | t >>> 12 & 15) + r(128 | t >>> 6 & 63) + r(128 | 63 & t)
			}, d = function (e) {
				return e.replace(/[^\x00-\x7F]/g, u)
			}, l = function (e) {
				var t = [0, 2, 1][e.length % 3],
					n = e.charCodeAt(0) << 16 | (e.length > 1 ? e.charCodeAt(1) : 0) << 8 | (e.length > 2 ? e.charCodeAt(2) : 0);
				return [i.charAt(n >>> 18), i.charAt(n >>> 12 & 63), t >= 2 ? "=" : i.charAt(n >>> 6 & 63), t >= 1 ? "=" : i.charAt(63 & n)].join("")
			}, c = window.btoa || function (e) {
				return e.replace(/[\s\S]{1,3}/g, l)
			}
		}, function (e, t, n) {
			"use strict";
			var r = n(12), i = {
				now: function () {
					return Date.now ? Date.now() : (new Date).valueOf()
				}, defer: function (e) {
					return new r.OneOffTimer(0, e)
				}, method: function (e) {
					for (var t = [], n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
					var r = Array.prototype.slice.call(arguments, 1);
					return function (t) {
						return t[e].apply(t, r.concat(arguments))
					}
				}
			};
			t.__esModule = !0, t.default = i
		}, function (e, t, n) {
			"use strict";
			var r = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, i = n(13);

			function a(e) {
				window.clearTimeout(e)
			}

			function s(e) {
				window.clearInterval(e)
			}

			var o = function (e) {
				function t(t, n) {
					e.call(this, setTimeout, a, t, function (e) {
						return n(), null
					})
				}

				return r(t, e), t
			}(i.default);
			t.OneOffTimer = o;
			var u = function (e) {
				function t(t, n) {
					e.call(this, setInterval, s, t, function (e) {
						return n(), e
					})
				}

				return r(t, e), t
			}(i.default);
			t.PeriodicTimer = u
		}, function (e, t) {
			"use strict";
			var n = function () {
				function e(e, t, n, r) {
					var i = this;
					this.clear = t, this.timer = e(function () {
						i.timer && (i.timer = r(i.timer))
					}, n)
				}

				return e.prototype.isRunning = function () {
					return null !== this.timer
				}, e.prototype.ensureAborted = function () {
					this.timer && (this.clear(this.timer), this.timer = null)
				}, e
			}();
			t.__esModule = !0, t.default = n
		}, function (e, t) {
			"use strict";
			var n = {
				baseUrl: "https://pusher.com",
				urls: {
					authenticationEndpoint: {path: "/docs/authenticating_users"},
					javascriptQuickStart: {path: "/docs/javascript_quick_start"}
				}
			};
			t.__esModule = !0, t.default = {
				buildLogSuffix: function (e) {
					var t, r = n.urls[e];
					return r ? (r.fullUrl ? t = r.fullUrl : r.path && (t = n.baseUrl + r.path), t ? "See: " + t : "") : ""
				}
			}
		}, function (e, t, n) {
			"use strict";
			var r = n(8);
			t.__esModule = !0, t.default = function (e, t, n) {
				void 0 !== this.authOptions.headers && r.default.warn("Warn", "To send headers with the auth request, you must use AJAX, rather than JSONP.");
				var i = e.nextAuthCallbackID.toString();
				e.nextAuthCallbackID++;
				var a = e.getDocument(), s = a.createElement("script");
				e.auth_callbacks[i] = function (e) {
					n(!1, e)
				};
				var o = "Pusher.auth_callbacks['" + i + "']";
				s.src = this.options.authEndpoint + "?callback=" + encodeURIComponent(o) + "&" + this.composeQuery(t);
				var u = a.getElementsByTagName("head")[0] || a.documentElement;
				u.insertBefore(s, u.firstChild)
			}
		}, function (e, t) {
			"use strict";
			var n = function () {
				function e(e) {
					this.src = e
				}

				return e.prototype.send = function (e) {
					var t = this, n = "Error loading " + t.src;
					t.script = document.createElement("script"), t.script.id = e.id, t.script.src = t.src, t.script.type = "text/javascript", t.script.charset = "UTF-8", t.script.addEventListener ? (t.script.onerror = function () {
						e.callback(n)
					}, t.script.onload = function () {
						e.callback(null)
					}) : t.script.onreadystatechange = function () {
						"loaded" !== t.script.readyState && "complete" !== t.script.readyState || e.callback(null)
					}, void 0 === t.script.async && document.attachEvent && /opera/i.test(navigator.userAgent) ? (t.errorScript = document.createElement("script"), t.errorScript.id = e.id + "_error", t.errorScript.text = e.name + "('" + n + "');", t.script.async = t.errorScript.async = !1) : t.script.async = !0;
					var r = document.getElementsByTagName("head")[0];
					r.insertBefore(t.script, r.firstChild), t.errorScript && r.insertBefore(t.errorScript, t.script.nextSibling)
				}, e.prototype.cleanup = function () {
					this.script && (this.script.onload = this.script.onerror = null, this.script.onreadystatechange = null), this.script && this.script.parentNode && this.script.parentNode.removeChild(this.script), this.errorScript && this.errorScript.parentNode && this.errorScript.parentNode.removeChild(this.errorScript), this.script = null, this.errorScript = null
				}, e
			}();
			t.__esModule = !0, t.default = n
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = n(2), a = function () {
				function e(e, t) {
					this.url = e, this.data = t
				}

				return e.prototype.send = function (e) {
					if (!this.request) {
						var t = r.buildQueryString(this.data), n = this.url + "/" + e.number + "?" + t;
						this.request = i.default.createScriptRequest(n), this.request.send(e)
					}
				}, e.prototype.cleanup = function () {
					this.request && this.request.cleanup()
				}, e
			}();
			t.__esModule = !0, t.default = a
		}, function (e, t, n) {
			"use strict";
			var r = n(2), i = n(4), a = {
				name: "jsonp", getAgent: function (e, t) {
					return function (n, a) {
						var s = "http" + (t ? "s" : "") + "://" + (e.host || e.options.host) + e.options.path,
							o = r.default.createJSONPRequest(s, n),
							u = r.default.ScriptReceivers.create(function (t, n) {
								i.ScriptReceivers.remove(u), o.cleanup(), n && n.host && (e.host = n.host), a && a(t, n)
							});
						o.send(u)
					}
				}
			};
			t.__esModule = !0, t.default = a
		}, function (e, t, n) {
			"use strict";
			var r = n(20), i = n(22), a = n(21), s = n(2), o = n(3), u = n(9), d = new i.default({
					file: "sockjs",
					urls: a.sockjs,
					handlesActivityChecks: !0,
					supportsPing: !1,
					isSupported: function () {
						return !0
					},
					isInitialized: function () {
						return void 0 !== window.SockJS
					},
					getSocket: function (e, t) {
						return new window.SockJS(e, null, {
							js_path: o.Dependencies.getPath("sockjs", {useTLS: t.useTLS}),
							ignore_null_origin: t.ignoreNullOrigin
						})
					},
					beforeOpen: function (e, t) {
						e.send(JSON.stringify({path: t}))
					}
				}), l = {
					isSupported: function (e) {
						return s.default.isXDRSupported(e.useTLS)
					}
				}, c = new i.default(u.extend({}, r.streamingConfiguration, l)),
				h = new i.default(u.extend({}, r.pollingConfiguration, l));
			r.default.xdr_streaming = c, r.default.xdr_polling = h, r.default.sockjs = d, t.__esModule = !0, t.default = r.default
		}, function (e, t, n) {
			"use strict";
			var r = n(21), i = n(22), a = n(9), s = n(2), o = new i.default({
				urls: r.ws, handlesActivityChecks: !1, supportsPing: !1, isInitialized: function () {
					return Boolean(s.default.getWebSocketAPI())
				}, isSupported: function () {
					return Boolean(s.default.getWebSocketAPI())
				}, getSocket: function (e) {
					return s.default.createWebSocket(e)
				}
			}), u = {
				urls: r.http, handlesActivityChecks: !1, supportsPing: !0, isInitialized: function () {
					return !0
				}
			};
			t.streamingConfiguration = a.extend({
				getSocket: function (e) {
					return s.default.HTTPFactory.createStreamingSocket(e)
				}
			}, u), t.pollingConfiguration = a.extend({
				getSocket: function (e) {
					return s.default.HTTPFactory.createPollingSocket(e)
				}
			}, u);
			var d = {
				isSupported: function () {
					return s.default.isXHRSupported()
				}
			}, l = {
				ws: o,
				xhr_streaming: new i.default(a.extend({}, t.streamingConfiguration, d)),
				xhr_polling: new i.default(a.extend({}, t.pollingConfiguration, d))
			};
			t.__esModule = !0, t.default = l
		}, function (e, t, n) {
			"use strict";
			var r = n(5);

			function i(e, t, n) {
				return e + (t.useTLS ? "s" : "") + "://" + (t.useTLS ? t.hostTLS : t.hostNonTLS) + n
			}

			function a(e, t) {
				return "/app/" + e + ("?protocol=" + r.default.PROTOCOL + "&client=js&version=" + r.default.VERSION + (t ? "&" + t : ""))
			}

			t.ws = {
				getInitial: function (e, t) {
					return i("ws", t, (t.httpPath || "") + a(e, "flash=false"))
				}
			}, t.http = {
				getInitial: function (e, t) {
					return i("http", t, (t.httpPath || "/pusher") + a(e))
				}
			}, t.sockjs = {
				getInitial: function (e, t) {
					return i("http", t, t.httpPath || "/pusher")
				}, getPath: function (e, t) {
					return a(e)
				}
			}
		}, function (e, t, n) {
			"use strict";
			var r = n(23), i = function () {
				function e(e) {
					this.hooks = e
				}

				return e.prototype.isSupported = function (e) {
					return this.hooks.isSupported(e)
				}, e.prototype.createConnection = function (e, t, n, i) {
					return new r.default(this.hooks, e, t, n, i)
				}, e
			}();
			t.__esModule = !0, t.default = i
		}, function (e, t, n) {
			"use strict";
			var r = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, i = n(11), a = n(9), s = n(24), o = n(8), u = n(2), d = function (e) {
				function t(t, n, r, i, a) {
					e.call(this), this.initialize = u.default.transportConnectionInitializer, this.hooks = t, this.name = n, this.priority = r, this.key = i, this.options = a, this.state = "new", this.timeline = a.timeline, this.activityTimeout = a.activityTimeout, this.id = this.timeline.generateUniqueID()
				}

				return r(t, e), t.prototype.handlesActivityChecks = function () {
					return Boolean(this.hooks.handlesActivityChecks)
				}, t.prototype.supportsPing = function () {
					return Boolean(this.hooks.supportsPing)
				}, t.prototype.connect = function () {
					var e = this;
					if (this.socket || "initialized" !== this.state) return !1;
					var t = this.hooks.urls.getInitial(this.key, this.options);
					try {
						this.socket = this.hooks.getSocket(t, this.options)
					} catch (t) {
						return i.default.defer(function () {
							e.onError(t), e.changeState("closed")
						}), !1
					}
					return this.bindListeners(), o.default.debug("Connecting", {
						transport: this.name,
						url: t
					}), this.changeState("connecting"), !0
				}, t.prototype.close = function () {
					return !!this.socket && (this.socket.close(), !0)
				}, t.prototype.send = function (e) {
					var t = this;
					return "open" === this.state && (i.default.defer(function () {
						t.socket && t.socket.send(e)
					}), !0)
				}, t.prototype.ping = function () {
					"open" === this.state && this.supportsPing() && this.socket.ping()
				}, t.prototype.onOpen = function () {
					this.hooks.beforeOpen && this.hooks.beforeOpen(this.socket, this.hooks.urls.getPath(this.key, this.options)), this.changeState("open"), this.socket.onopen = void 0
				}, t.prototype.onError = function (e) {
					this.emit("error", {
						type: "WebSocketError",
						error: e
					}), this.timeline.error(this.buildTimelineMessage({error: e.toString()}))
				}, t.prototype.onClose = function (e) {
					e ? this.changeState("closed", {
						code: e.code,
						reason: e.reason,
						wasClean: e.wasClean
					}) : this.changeState("closed"), this.unbindListeners(), this.socket = void 0
				}, t.prototype.onMessage = function (e) {
					this.emit("message", e)
				}, t.prototype.onActivity = function () {
					this.emit("activity")
				}, t.prototype.bindListeners = function () {
					var e = this;
					this.socket.onopen = function () {
						e.onOpen()
					}, this.socket.onerror = function (t) {
						e.onError(t)
					}, this.socket.onclose = function (t) {
						e.onClose(t)
					}, this.socket.onmessage = function (t) {
						e.onMessage(t)
					}, this.supportsPing() && (this.socket.onactivity = function () {
						e.onActivity()
					})
				}, t.prototype.unbindListeners = function () {
					this.socket && (this.socket.onopen = void 0, this.socket.onerror = void 0, this.socket.onclose = void 0, this.socket.onmessage = void 0, this.supportsPing() && (this.socket.onactivity = void 0))
				}, t.prototype.changeState = function (e, t) {
					this.state = e, this.timeline.info(this.buildTimelineMessage({
						state: e,
						params: t
					})), this.emit(e, t)
				}, t.prototype.buildTimelineMessage = function (e) {
					return a.extend({cid: this.id}, e)
				}, t
			}(s.default);
			t.__esModule = !0, t.default = d
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = n(25), a = function () {
				function e(e) {
					this.callbacks = new i.default, this.global_callbacks = [], this.failThrough = e
				}

				return e.prototype.bind = function (e, t, n) {
					return this.callbacks.add(e, t, n), this
				}, e.prototype.bind_global = function (e) {
					return this.global_callbacks.push(e), this
				}, e.prototype.unbind = function (e, t, n) {
					return this.callbacks.remove(e, t, n), this
				}, e.prototype.unbind_global = function (e) {
					return e ? (this.global_callbacks = r.filter(this.global_callbacks || [], function (t) {
						return t !== e
					}), this) : (this.global_callbacks = [], this)
				}, e.prototype.unbind_all = function () {
					return this.unbind(), this.unbind_global(), this
				}, e.prototype.emit = function (e, t) {
					var n;
					for (n = 0; n < this.global_callbacks.length; n++) this.global_callbacks[n](e, t);
					var r = this.callbacks.get(e);
					if (r && r.length > 0) for (n = 0; n < r.length; n++) r[n].fn.call(r[n].context || window, t); else this.failThrough && this.failThrough(e, t);
					return this
				}, e
			}();
			t.__esModule = !0, t.default = a
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = function () {
				function e() {
					this._callbacks = {}
				}

				return e.prototype.get = function (e) {
					return this._callbacks[a(e)]
				}, e.prototype.add = function (e, t, n) {
					var r = a(e);
					this._callbacks[r] = this._callbacks[r] || [], this._callbacks[r].push({fn: t, context: n})
				}, e.prototype.remove = function (e, t, n) {
					if (e || t || n) {
						var i = e ? [a(e)] : r.keys(this._callbacks);
						t || n ? this.removeCallback(i, t, n) : this.removeAllCallbacks(i)
					} else this._callbacks = {}
				}, e.prototype.removeCallback = function (e, t, n) {
					r.apply(e, function (e) {
						this._callbacks[e] = r.filter(this._callbacks[e] || [], function (e) {
							return t && t !== e.fn || n && n !== e.context
						}), 0 === this._callbacks[e].length && delete this._callbacks[e]
					}, this)
				}, e.prototype.removeAllCallbacks = function (e) {
					r.apply(e, function (e) {
						delete this._callbacks[e]
					}, this)
				}, e
			}();

			function a(e) {
				return "_" + e
			}

			t.__esModule = !0, t.default = i
		}, function (e, t, n) {
			"use strict";
			var r = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, i = function (e) {
				function t() {
					e.call(this);
					var t = this;
					void 0 !== window.addEventListener && (window.addEventListener("online", function () {
						t.emit("online")
					}, !1), window.addEventListener("offline", function () {
						t.emit("offline")
					}, !1))
				}

				return r(t, e), t.prototype.isOnline = function () {
					return void 0 === window.navigator.onLine || window.navigator.onLine
				}, t
			}(n(24).default);
			t.NetInfo = i, t.Network = new i
		}, function (e, t) {
			"use strict";
			t.__esModule = !0, t.default = function (e) {
				var t;
				return t = e.useTLS ? [":best_connected_ever", ":ws_loop", [":delayed", 2e3, [":http_fallback_loop"]]] : [":best_connected_ever", ":ws_loop", [":delayed", 2e3, [":wss_loop"]], [":delayed", 5e3, [":http_fallback_loop"]]], [[":def", "ws_options", {
					hostNonTLS: e.wsHost + ":" + e.wsPort,
					hostTLS: e.wsHost + ":" + e.wssPort,
					httpPath: e.wsPath
				}], [":def", "wss_options", [":extend", ":ws_options", {useTLS: !0}]], [":def", "sockjs_options", {
					hostNonTLS: e.httpHost + ":" + e.httpPort,
					hostTLS: e.httpHost + ":" + e.httpsPort,
					httpPath: e.httpPath
				}], [":def", "timeouts", {
					loop: !0,
					timeout: 15e3,
					timeoutLimit: 6e4
				}], [":def", "ws_manager", [":transport_manager", {
					lives: 2,
					minPingDelay: 1e4,
					maxPingDelay: e.activity_timeout
				}]], [":def", "streaming_manager", [":transport_manager", {
					lives: 2,
					minPingDelay: 1e4,
					maxPingDelay: e.activity_timeout
				}]], [":def_transport", "ws", "ws", 3, ":ws_options", ":ws_manager"], [":def_transport", "wss", "ws", 3, ":wss_options", ":ws_manager"], [":def_transport", "sockjs", "sockjs", 1, ":sockjs_options"], [":def_transport", "xhr_streaming", "xhr_streaming", 1, ":sockjs_options", ":streaming_manager"], [":def_transport", "xdr_streaming", "xdr_streaming", 1, ":sockjs_options", ":streaming_manager"], [":def_transport", "xhr_polling", "xhr_polling", 1, ":sockjs_options"], [":def_transport", "xdr_polling", "xdr_polling", 1, ":sockjs_options"], [":def", "ws_loop", [":sequential", ":timeouts", ":ws"]], [":def", "wss_loop", [":sequential", ":timeouts", ":wss"]], [":def", "sockjs_loop", [":sequential", ":timeouts", ":sockjs"]], [":def", "streaming_loop", [":sequential", ":timeouts", [":if", [":is_supported", ":xhr_streaming"], ":xhr_streaming", ":xdr_streaming"]]], [":def", "polling_loop", [":sequential", ":timeouts", [":if", [":is_supported", ":xhr_polling"], ":xhr_polling", ":xdr_polling"]]], [":def", "http_loop", [":if", [":is_supported", ":streaming_loop"], [":best_connected_ever", ":streaming_loop", [":delayed", 4e3, [":polling_loop"]]], [":polling_loop"]]], [":def", "http_fallback_loop", [":if", [":is_supported", ":http_loop"], [":http_loop"], [":sockjs_loop"]]], [":def", "strategy", [":cached", 18e5, [":first_connected", [":if", [":is_supported", ":ws"], t, ":http_fallback_loop"]]]]]
			}
		}, function (e, t, n) {
			"use strict";
			var r = n(3);
			t.__esModule = !0, t.default = function () {
				var e = this;
				e.timeline.info(e.buildTimelineMessage({transport: e.name + (e.options.useTLS ? "s" : "")})), e.hooks.isInitialized() ? e.changeState("initialized") : e.hooks.file ? (e.changeState("initializing"), r.Dependencies.load(e.hooks.file, {useTLS: e.options.useTLS}, function (t, n) {
					e.hooks.isInitialized() ? (e.changeState("initialized"), n(!0)) : (t && e.onError(t), e.onClose(), n(!1))
				})) : e.onClose()
			}
		}, function (e, t, n) {
			"use strict";
			var r = n(30), i = n(32);
			i.default.createXDR = function (e, t) {
				return this.createRequest(r.default, e, t)
			}, t.__esModule = !0, t.default = i.default
		}, function (e, t, n) {
			"use strict";
			var r = n(31), i = {
				getRequest: function (e) {
					var t = new window.XDomainRequest;
					return t.ontimeout = function () {
						e.emit("error", new r.RequestTimedOut), e.close()
					}, t.onerror = function (t) {
						e.emit("error", t), e.close()
					}, t.onprogress = function () {
						t.responseText && t.responseText.length > 0 && e.onChunk(200, t.responseText)
					}, t.onload = function () {
						t.responseText && t.responseText.length > 0 && e.onChunk(200, t.responseText), e.emit("finished", 200), e.close()
					}, t
				}, abortRequest: function (e) {
					e.ontimeout = e.onerror = e.onprogress = e.onload = null, e.abort()
				}
			};
			t.__esModule = !0, t.default = i
		}, function (e, t) {
			"use strict";
			var n = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, r = function (e) {
				function t() {
					e.apply(this, arguments)
				}

				return n(t, e), t
			}(Error);
			t.BadEventName = r;
			var i = function (e) {
				function t() {
					e.apply(this, arguments)
				}

				return n(t, e), t
			}(Error);
			t.RequestTimedOut = i;
			var a = function (e) {
				function t() {
					e.apply(this, arguments)
				}

				return n(t, e), t
			}(Error);
			t.TransportPriorityTooLow = a;
			var s = function (e) {
				function t() {
					e.apply(this, arguments)
				}

				return n(t, e), t
			}(Error);
			t.TransportClosed = s;
			var o = function (e) {
				function t() {
					e.apply(this, arguments)
				}

				return n(t, e), t
			}(Error);
			t.UnsupportedFeature = o;
			var u = function (e) {
				function t() {
					e.apply(this, arguments)
				}

				return n(t, e), t
			}(Error);
			t.UnsupportedTransport = u;
			var d = function (e) {
				function t() {
					e.apply(this, arguments)
				}

				return n(t, e), t
			}(Error);
			t.UnsupportedStrategy = d
		}, function (e, t, n) {
			"use strict";
			var r = n(33), i = n(34), a = n(36), s = n(37), o = n(38), u = {
				createStreamingSocket: function (e) {
					return this.createSocket(a.default, e)
				}, createPollingSocket: function (e) {
					return this.createSocket(s.default, e)
				}, createSocket: function (e, t) {
					return new i.default(e, t)
				}, createXHR: function (e, t) {
					return this.createRequest(o.default, e, t)
				}, createRequest: function (e, t, n) {
					return new r.default(e, t, n)
				}
			};
			t.__esModule = !0, t.default = u
		}, function (e, t, n) {
			"use strict";
			var r = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, i = n(2), a = function (e) {
				function t(t, n, r) {
					e.call(this), this.hooks = t, this.method = n, this.url = r
				}

				return r(t, e), t.prototype.start = function (e) {
					var t = this;
					this.position = 0, this.xhr = this.hooks.getRequest(this), this.unloader = function () {
						t.close()
					}, i.default.addUnloadListener(this.unloader), this.xhr.open(this.method, this.url, !0), this.xhr.setRequestHeader && this.xhr.setRequestHeader("Content-Type", "application/json"), this.xhr.send(e)
				}, t.prototype.close = function () {
					this.unloader && (i.default.removeUnloadListener(this.unloader), this.unloader = null), this.xhr && (this.hooks.abortRequest(this.xhr), this.xhr = null)
				}, t.prototype.onChunk = function (e, t) {
					for (; ;) {
						var n = this.advanceBuffer(t);
						if (!n) break;
						this.emit("chunk", {status: e, data: n})
					}
					this.isBufferTooLong(t) && this.emit("buffer_too_long")
				}, t.prototype.advanceBuffer = function (e) {
					var t = e.slice(this.position), n = t.indexOf("\n");
					return -1 !== n ? (this.position += n + 1, t.slice(0, n)) : null
				}, t.prototype.isBufferTooLong = function (e) {
					return this.position === e.length && e.length > 262144
				}, t
			}(n(24).default);
			t.__esModule = !0, t.default = a
		}, function (e, t, n) {
			"use strict";
			var r = n(35), i = n(11), a = n(2), s = 1, o = function () {
				function e(e, t) {
					this.hooks = e, this.session = d(1e3) + "/" + function (e) {
						for (var t = [], n = 0; n < e; n++) t.push(d(32).toString(32));
						return t.join("")
					}(8), this.location = function (e) {
						var t = /([^\?]*)\/*(\??.*)/.exec(e);
						return {base: t[1], queryString: t[2]}
					}(t), this.readyState = r.default.CONNECTING, this.openStream()
				}

				return e.prototype.send = function (e) {
					return this.sendRaw(JSON.stringify([e]))
				}, e.prototype.ping = function () {
					this.hooks.sendHeartbeat(this)
				}, e.prototype.close = function (e, t) {
					this.onClose(e, t, !0)
				}, e.prototype.sendRaw = function (e) {
					if (this.readyState !== r.default.OPEN) return !1;
					try {
						return a.default.createSocketRequest("POST", u((t = this.location, n = this.session, t.base + "/" + n + "/xhr_send"))).start(e), !0
					} catch (e) {
						return !1
					}
					var t, n
				}, e.prototype.reconnect = function () {
					this.closeStream(), this.openStream()
				}, e.prototype.onClose = function (e, t, n) {
					this.closeStream(), this.readyState = r.default.CLOSED, this.onclose && this.onclose({
						code: e,
						reason: t,
						wasClean: n
					})
				}, e.prototype.onChunk = function (e) {
					var t;
					if (200 === e.status) switch (this.readyState === r.default.OPEN && this.onActivity(), e.data.slice(0, 1)) {
						case"o":
							t = JSON.parse(e.data.slice(1) || "{}"), this.onOpen(t);
							break;
						case"a":
							t = JSON.parse(e.data.slice(1) || "[]");
							for (var n = 0; n < t.length; n++) this.onEvent(t[n]);
							break;
						case"m":
							t = JSON.parse(e.data.slice(1) || "null"), this.onEvent(t);
							break;
						case"h":
							this.hooks.onHeartbeat(this);
							break;
						case"c":
							t = JSON.parse(e.data.slice(1) || "[]"), this.onClose(t[0], t[1], !0)
					}
				}, e.prototype.onOpen = function (e) {
					var t, n, i;
					this.readyState === r.default.CONNECTING ? (e && e.hostname && (this.location.base = (t = this.location.base, n = e.hostname, (i = /(https?:\/\/)([^\/:]+)((\/|:)?.*)/.exec(t))[1] + n + i[3])), this.readyState = r.default.OPEN, this.onopen && this.onopen()) : this.onClose(1006, "Server lost session", !0)
				}, e.prototype.onEvent = function (e) {
					this.readyState === r.default.OPEN && this.onmessage && this.onmessage({data: e})
				}, e.prototype.onActivity = function () {
					this.onactivity && this.onactivity()
				}, e.prototype.onError = function (e) {
					this.onerror && this.onerror(e)
				}, e.prototype.openStream = function () {
					var e = this;
					this.stream = a.default.createSocketRequest("POST", u(this.hooks.getReceiveURL(this.location, this.session))), this.stream.bind("chunk", function (t) {
						e.onChunk(t)
					}), this.stream.bind("finished", function (t) {
						e.hooks.onFinished(e, t)
					}), this.stream.bind("buffer_too_long", function () {
						e.reconnect()
					});
					try {
						this.stream.start()
					} catch (t) {
						i.default.defer(function () {
							e.onError(t), e.onClose(1006, "Could not start streaming", !1)
						})
					}
				}, e.prototype.closeStream = function () {
					this.stream && (this.stream.unbind_all(), this.stream.close(), this.stream = null)
				}, e
			}();

			function u(e) {
				return e + (-1 === e.indexOf("?") ? "?" : "&") + "t=" + +new Date + "&n=" + s++
			}

			function d(e) {
				return Math.floor(Math.random() * e)
			}

			t.__esModule = !0, t.default = o
		}, function (e, t) {
			"use strict";
			var n;
			!function (e) {
				e[e.CONNECTING = 0] = "CONNECTING", e[e.OPEN = 1] = "OPEN", e[e.CLOSED = 3] = "CLOSED"
			}(n || (n = {})), t.__esModule = !0, t.default = n
		}, function (e, t) {
			"use strict";
			t.__esModule = !0, t.default = {
				getReceiveURL: function (e, t) {
					return e.base + "/" + t + "/xhr_streaming" + e.queryString
				}, onHeartbeat: function (e) {
					e.sendRaw("[]")
				}, sendHeartbeat: function (e) {
					e.sendRaw("[]")
				}, onFinished: function (e, t) {
					e.onClose(1006, "Connection interrupted (" + t + ")", !1)
				}
			}
		}, function (e, t) {
			"use strict";
			t.__esModule = !0, t.default = {
				getReceiveURL: function (e, t) {
					return e.base + "/" + t + "/xhr" + e.queryString
				}, onHeartbeat: function () {
				}, sendHeartbeat: function (e) {
					e.sendRaw("[]")
				}, onFinished: function (e, t) {
					200 === t ? e.reconnect() : e.onClose(1006, "Connection interrupted (" + t + ")", !1)
				}
			}
		}, function (e, t, n) {
			"use strict";
			var r = n(2), i = {
				getRequest: function (e) {
					var t = new (r.default.getXHRAPI());
					return t.onreadystatechange = t.onprogress = function () {
						switch (t.readyState) {
							case 3:
								t.responseText && t.responseText.length > 0 && e.onChunk(t.status, t.responseText);
								break;
							case 4:
								t.responseText && t.responseText.length > 0 && e.onChunk(t.status, t.responseText), e.emit("finished", t.status), e.close()
						}
					}, t
				}, abortRequest: function (e) {
					e.onreadystatechange = null, e.abort()
				}
			};
			t.__esModule = !0, t.default = i
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = n(11), a = n(40), s = function () {
				function e(e, t, n) {
					this.key = e, this.session = t, this.events = [], this.options = n || {}, this.sent = 0, this.uniqueID = 0
				}

				return e.prototype.log = function (e, t) {
					e <= this.options.level && (this.events.push(r.extend({}, t, {timestamp: i.default.now()})), this.options.limit && this.events.length > this.options.limit && this.events.shift())
				}, e.prototype.error = function (e) {
					this.log(a.default.ERROR, e)
				}, e.prototype.info = function (e) {
					this.log(a.default.INFO, e)
				}, e.prototype.debug = function (e) {
					this.log(a.default.DEBUG, e)
				}, e.prototype.isEmpty = function () {
					return 0 === this.events.length
				}, e.prototype.send = function (e, t) {
					var n = this, i = r.extend({
						session: this.session,
						bundle: this.sent + 1,
						key: this.key,
						lib: "js",
						version: this.options.version,
						cluster: this.options.cluster,
						features: this.options.features,
						timeline: this.events
					}, this.options.params);
					return this.events = [], e(i, function (e, r) {
						e || n.sent++, t && t(e, r)
					}), !0
				}, e.prototype.generateUniqueID = function () {
					return this.uniqueID++, this.uniqueID
				}, e
			}();
			t.__esModule = !0, t.default = s
		}, function (e, t) {
			"use strict";
			var n;
			!function (e) {
				e[e.ERROR = 3] = "ERROR", e[e.INFO = 6] = "INFO", e[e.DEBUG = 7] = "DEBUG"
			}(n || (n = {})), t.__esModule = !0, t.default = n
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = n(11), a = n(42), s = n(31), o = n(64), u = n(65), d = n(66), l = n(67), c = n(68),
				h = n(69), f = n(70), _ = n(2).default.Transports;
			t.build = function (e, t) {
				return L(e, r.extend({}, y, t))[1].strategy
			};
			var p = {
				isSupported: function () {
					return !1
				}, connect: function (e, t) {
					var n = i.default.defer(function () {
						t(new s.UnsupportedStrategy)
					});
					return {
						abort: function () {
							n.ensureAborted()
						}, forceMinPriority: function () {
						}
					}
				}
			};

			function m(e) {
				return function (t) {
					return [e.apply(this, arguments), t]
				}
			}

			var y = {
				extend: function (e, t, n) {
					return [r.extend({}, t, n), e]
				}, def: function (e, t, n) {
					if (void 0 !== e[t]) throw"Redefining symbol " + t;
					return e[t] = n, [void 0, e]
				}, def_transport: function (e, t, n, i, a, u) {
					var d, l = _[n];
					if (!l) throw new s.UnsupportedTransport(n);
					d = !(e.enabledTransports && -1 === r.arrayIndexOf(e.enabledTransports, t) || e.disabledTransports && -1 !== r.arrayIndexOf(e.disabledTransports, t)) ? new o.default(t, i, u ? u.getAssistant(l) : l, r.extend({
						key: e.key,
						useTLS: e.useTLS,
						timeline: e.timeline,
						ignoreNullOrigin: e.ignoreNullOrigin
					}, a)) : p;
					var c = e.def(e, t, d)[1];
					return c.Transports = e.Transports || {}, c.Transports[t] = d, [void 0, c]
				}, transport_manager: m(function (e, t) {
					return new a.default(t)
				}), sequential: m(function (e, t) {
					var n = Array.prototype.slice.call(arguments, 2);
					return new u.default(n, t)
				}), cached: m(function (e, t, n) {
					return new l.default(n, e.Transports, {ttl: t, timeline: e.timeline, useTLS: e.useTLS})
				}), first_connected: m(function (e, t) {
					return new f.default(t)
				}), best_connected_ever: m(function () {
					var e = Array.prototype.slice.call(arguments, 1);
					return new d.default(e)
				}), delayed: m(function (e, t, n) {
					return new c.default(n, {delay: t})
				}), if: m(function (e, t, n, r) {
					return new h.default(t, n, r)
				}), is_supported: m(function (e, t) {
					return function () {
						return t.isSupported()
					}
				})
			};

			function g(e) {
				return "string" == typeof e && ":" === e.charAt(0)
			}

			function v(e, t) {
				return t[e.slice(1)]
			}

			function M(e, t) {
				if (g(e[0])) {
					var n = v(e[0], t);
					if (e.length > 1) {
						if ("function" != typeof n) throw"Calling non-function " + e[0];
						var i = [r.extend({}, t)].concat(r.map(e.slice(1), function (e) {
							return L(e, r.extend({}, t))[0]
						}));
						return n.apply(this, i)
					}
					return [n, t]
				}
				return function e(t, n) {
					if (0 === t.length) return [[], n];
					var r = L(t[0], n), i = e(t.slice(1), r[1]);
					return [[r[0]].concat(i[0]), i[1]]
				}(e, t)
			}

			function L(e, t) {
				return "string" == typeof e ? function (e, t) {
					if (!g(e)) return [e, t];
					var n = v(e, t);
					if (void 0 === n) throw"Undefined symbol " + e;
					return [n, t]
				}(e, t) : "object" == typeof e && e instanceof Array && e.length > 0 ? M(e, t) : [e, t]
			}
		}, function (e, t, n) {
			"use strict";
			var r = n(43), i = function () {
				function e(e) {
					this.options = e || {}, this.livesLeft = this.options.lives || 1 / 0
				}

				return e.prototype.getAssistant = function (e) {
					return r.default.createAssistantToTheTransportManager(this, e, {
						minPingDelay: this.options.minPingDelay,
						maxPingDelay: this.options.maxPingDelay
					})
				}, e.prototype.isAlive = function () {
					return this.livesLeft > 0
				}, e.prototype.reportDeath = function () {
					this.livesLeft -= 1
				}, e
			}();
			t.__esModule = !0, t.default = i
		}, function (e, t, n) {
			"use strict";
			var r = n(44), i = n(45), a = n(48), s = n(49), o = n(50), u = n(51), d = n(54), l = n(52), c = n(62),
				h = n(63), f = {
					createChannels: function () {
						return new h.default
					}, createConnectionManager: function (e, t) {
						return new c.default(e, t)
					}, createChannel: function (e, t) {
						return new l.default(e, t)
					}, createPrivateChannel: function (e, t) {
						return new u.default(e, t)
					}, createPresenceChannel: function (e, t) {
						return new o.default(e, t)
					}, createEncryptedChannel: function (e, t) {
						return new d.default(e, t)
					}, createTimelineSender: function (e, t) {
						return new s.default(e, t)
					}, createAuthorizer: function (e, t) {
						return t.authorizer ? t.authorizer(e, t) : new a.default(e, t)
					}, createHandshake: function (e, t) {
						return new i.default(e, t)
					}, createAssistantToTheTransportManager: function (e, t, n) {
						return new r.default(e, t, n)
					}
				};
			t.__esModule = !0, t.default = f
		}, function (e, t, n) {
			"use strict";
			var r = n(11), i = n(9), a = function () {
				function e(e, t, n) {
					this.manager = e, this.transport = t, this.minPingDelay = n.minPingDelay, this.maxPingDelay = n.maxPingDelay, this.pingDelay = void 0
				}

				return e.prototype.createConnection = function (e, t, n, a) {
					var s = this;
					a = i.extend({}, a, {activityTimeout: this.pingDelay});
					var o = this.transport.createConnection(e, t, n, a), u = null, d = function () {
						o.unbind("open", d), o.bind("closed", l), u = r.default.now()
					}, l = function (e) {
						if (o.unbind("closed", l), 1002 === e.code || 1003 === e.code) s.manager.reportDeath(); else if (!e.wasClean && u) {
							var t = r.default.now() - u;
							t < 2 * s.maxPingDelay && (s.manager.reportDeath(), s.pingDelay = Math.max(t / 2, s.minPingDelay))
						}
					};
					return o.bind("open", d), o
				}, e.prototype.isSupported = function (e) {
					return this.manager.isAlive() && this.transport.isSupported(e)
				}, e
			}();
			t.__esModule = !0, t.default = a
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = n(46), a = n(47), s = function () {
				function e(e, t) {
					this.transport = e, this.callback = t, this.bindListeners()
				}

				return e.prototype.close = function () {
					this.unbindListeners(), this.transport.close()
				}, e.prototype.bindListeners = function () {
					var e = this;
					this.onMessage = function (t) {
						var n;
						e.unbindListeners();
						try {
							n = i.processHandshake(t)
						} catch (t) {
							return e.finish("error", {error: t}), void e.transport.close()
						}
						"connected" === n.action ? e.finish("connected", {
							connection: new a.default(n.id, e.transport),
							activityTimeout: n.activityTimeout
						}) : (e.finish(n.action, {error: n.error}), e.transport.close())
					}, this.onClosed = function (t) {
						e.unbindListeners();
						var n = i.getCloseAction(t) || "backoff", r = i.getCloseError(t);
						e.finish(n, {error: r})
					}, this.transport.bind("message", this.onMessage), this.transport.bind("closed", this.onClosed)
				}, e.prototype.unbindListeners = function () {
					this.transport.unbind("message", this.onMessage), this.transport.unbind("closed", this.onClosed)
				}, e.prototype.finish = function (e, t) {
					this.callback(r.extend({transport: this.transport, action: e}, t))
				}, e
			}();
			t.__esModule = !0, t.default = s
		}, function (e, t) {
			"use strict";
			t.decodeMessage = function (e) {
				try {
					var t = JSON.parse(e.data);
					if ("string" == typeof t.data) try {
						t.data = JSON.parse(t.data)
					} catch (e) {
						if (!(e instanceof SyntaxError)) throw e
					}
					return t
				} catch (t) {
					throw{type: "MessageParseError", error: t, data: e.data}
				}
			}, t.encodeMessage = function (e) {
				return JSON.stringify(e)
			}, t.processHandshake = function (e) {
				if ("pusher:connection_established" === (e = t.decodeMessage(e)).event) {
					if (!e.data.activity_timeout) throw"No activity timeout specified in handshake";
					return {action: "connected", id: e.data.socket_id, activityTimeout: 1e3 * e.data.activity_timeout}
				}
				if ("pusher:error" === e.event) return {
					action: this.getCloseAction(e.data),
					error: this.getCloseError(e.data)
				};
				throw"Invalid handshake"
			}, t.getCloseAction = function (e) {
				return e.code < 4e3 ? e.code >= 1002 && e.code <= 1004 ? "backoff" : null : 4e3 === e.code ? "tls_only" : e.code < 4100 ? "refused" : e.code < 4200 ? "backoff" : e.code < 4300 ? "retry" : "refused"
			}, t.getCloseError = function (e) {
				return 1e3 !== e.code && 1001 !== e.code ? {
					type: "PusherError",
					data: {code: e.code, message: e.reason || e.message}
				} : null
			}
		}, function (e, t, n) {
			"use strict";
			var r = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, i = n(9), a = n(24), s = n(46), o = n(8), u = function (e) {
				function t(t, n) {
					e.call(this), this.id = t, this.transport = n, this.activityTimeout = n.activityTimeout, this.bindListeners()
				}

				return r(t, e), t.prototype.handlesActivityChecks = function () {
					return this.transport.handlesActivityChecks()
				}, t.prototype.send = function (e) {
					return this.transport.send(e)
				}, t.prototype.send_event = function (e, t, n) {
					var r = {event: e, data: t};
					return n && (r.channel = n), o.default.debug("Event sent", r), this.send(s.encodeMessage(r))
				}, t.prototype.ping = function () {
					this.transport.supportsPing() ? this.transport.ping() : this.send_event("pusher:ping", {})
				}, t.prototype.close = function () {
					this.transport.close()
				}, t.prototype.bindListeners = function () {
					var e = this, t = {
						message: function (t) {
							var n;
							try {
								n = s.decodeMessage(t)
							} catch (n) {
								e.emit("error", {type: "MessageParseError", error: n, data: t.data})
							}
							if (void 0 !== n) {
								switch (o.default.debug("Event recd", n), n.event) {
									case"pusher:error":
										e.emit("error", {type: "PusherError", data: n.data});
										break;
									case"pusher:ping":
										e.emit("ping");
										break;
									case"pusher:pong":
										e.emit("pong")
								}
								e.emit("message", n)
							}
						}, activity: function () {
							e.emit("activity")
						}, error: function (t) {
							e.emit("error", {type: "WebSocketError", error: t})
						}, closed: function (t) {
							n(), t && t.code && e.handleCloseEvent(t), e.transport = null, e.emit("closed")
						}
					}, n = function () {
						i.objectApply(t, function (t, n) {
							e.transport.unbind(n, t)
						})
					};
					i.objectApply(t, function (t, n) {
						e.transport.bind(n, t)
					})
				}, t.prototype.handleCloseEvent = function (e) {
					var t = s.getCloseAction(e), n = s.getCloseError(e);
					n && this.emit("error", n), t && this.emit(t, {action: t, error: n})
				}, t
			}(a.default);
			t.__esModule = !0, t.default = u
		}, function (e, t, n) {
			"use strict";
			var r = n(2), i = function () {
				function e(e, t) {
					this.channel = e;
					var n = t.authTransport;
					if (void 0 === r.default.getAuthorizers()[n]) throw"'" + n + "' is not a recognized auth transport";
					this.type = n, this.options = t, this.authOptions = (t || {}).auth || {}
				}

				return e.prototype.composeQuery = function (e) {
					var t = "socket_id=" + encodeURIComponent(e) + "&channel_name=" + encodeURIComponent(this.channel.name);
					for (var n in this.authOptions.params) t += "&" + encodeURIComponent(n) + "=" + encodeURIComponent(this.authOptions.params[n]);
					return t
				}, e.prototype.authorize = function (t, n) {
					return e.authorizers = e.authorizers || r.default.getAuthorizers(), e.authorizers[this.type].call(this, r.default, t, n)
				}, e
			}();
			t.__esModule = !0, t.default = i
		}, function (e, t, n) {
			"use strict";
			var r = n(2), i = function () {
				function e(e, t) {
					this.timeline = e, this.options = t || {}
				}

				return e.prototype.send = function (e, t) {
					this.timeline.isEmpty() || this.timeline.send(r.default.TimelineTransport.getAgent(this, e), t)
				}, e
			}();
			t.__esModule = !0, t.default = i
		}, function (e, t, n) {
			"use strict";
			var r = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, i = n(51), a = n(8), s = n(53), o = n(14), u = function (e) {
				function t(t, n) {
					e.call(this, t, n), this.members = new s.default
				}

				return r(t, e), t.prototype.authorize = function (t, n) {
					var r = this;
					e.prototype.authorize.call(this, t, function (e, t) {
						if (!e) {
							if (void 0 === t.channel_data) {
								var i = o.default.buildLogSuffix("authenticationEndpoint");
								return a.default.warn("Invalid auth response for channel '" + r.name + "',expected 'channel_data' field. " + i), void n("Invalid auth response")
							}
							var s = JSON.parse(t.channel_data);
							r.members.setMyID(s.user_id)
						}
						n(e, t)
					})
				}, t.prototype.handleEvent = function (e, t) {
					switch (e) {
						case"pusher_internal:subscription_succeeded":
							this.subscriptionPending = !1, this.subscribed = !0, this.subscriptionCancelled ? this.pusher.unsubscribe(this.name) : (this.members.onSubscription(t), this.emit("pusher:subscription_succeeded", this.members));
							break;
						case"pusher_internal:member_added":
							var n = this.members.addMember(t);
							this.emit("pusher:member_added", n);
							break;
						case"pusher_internal:member_removed":
							var r = this.members.removeMember(t);
							r && this.emit("pusher:member_removed", r);
							break;
						default:
							i.default.prototype.handleEvent.call(this, e, t)
					}
				}, t.prototype.disconnect = function () {
					this.members.reset(), e.prototype.disconnect.call(this)
				}, t
			}(i.default);
			t.__esModule = !0, t.default = u
		}, function (e, t, n) {
			"use strict";
			var r = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, i = n(43), a = function (e) {
				function t() {
					e.apply(this, arguments)
				}

				return r(t, e), t.prototype.authorize = function (e, t) {
					return i.default.createAuthorizer(this, this.pusher.config).authorize(e, t)
				}, t
			}(n(52).default);
			t.__esModule = !0, t.default = a
		}, function (e, t, n) {
			"use strict";
			var r = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, i = n(24), a = n(31), s = n(8), o = function (e) {
				function t(t, n) {
					e.call(this, function (e, n) {
						s.default.debug("No callbacks on " + t + " for " + e)
					}), this.name = t, this.pusher = n, this.subscribed = !1, this.subscriptionPending = !1, this.subscriptionCancelled = !1
				}

				return r(t, e), t.prototype.authorize = function (e, t) {
					return t(!1, {})
				}, t.prototype.trigger = function (e, t) {
					if (0 !== e.indexOf("client-")) throw new a.BadEventName("Event '" + e + "' does not start with 'client-'");
					return this.pusher.send_event(e, t, this.name)
				}, t.prototype.disconnect = function () {
					this.subscribed = !1, this.subscriptionPending = !1
				}, t.prototype.handleEvent = function (e, t) {
					0 === e.indexOf("pusher_internal:") ? "pusher_internal:subscription_succeeded" === e && (this.subscriptionPending = !1, this.subscribed = !0, this.subscriptionCancelled ? this.pusher.unsubscribe(this.name) : this.emit("pusher:subscription_succeeded", t)) : this.emit(e, t)
				}, t.prototype.subscribe = function () {
					var e = this;
					this.subscribed || (this.subscriptionPending = !0, this.subscriptionCancelled = !1, this.authorize(this.pusher.connection.socket_id, function (t, n) {
						t ? e.handleEvent("pusher:subscription_error", n) : e.pusher.send_event("pusher:subscribe", {
							auth: n.auth,
							channel_data: n.channel_data,
							channel: e.name
						})
					}))
				}, t.prototype.unsubscribe = function () {
					this.subscribed = !1, this.pusher.send_event("pusher:unsubscribe", {channel: this.name})
				}, t.prototype.cancelSubscription = function () {
					this.subscriptionCancelled = !0
				}, t.prototype.reinstateSubscription = function () {
					this.subscriptionCancelled = !1
				}, t
			}(i.default);
			t.__esModule = !0, t.default = o
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = function () {
				function e() {
					this.reset()
				}

				return e.prototype.get = function (e) {
					return Object.prototype.hasOwnProperty.call(this.members, e) ? {id: e, info: this.members[e]} : null
				}, e.prototype.each = function (e) {
					var t = this;
					r.objectApply(this.members, function (n, r) {
						e(t.get(r))
					})
				}, e.prototype.setMyID = function (e) {
					this.myID = e
				}, e.prototype.onSubscription = function (e) {
					this.members = e.presence.hash, this.count = e.presence.count, this.me = this.get(this.myID)
				}, e.prototype.addMember = function (e) {
					return null === this.get(e.user_id) && this.count++, this.members[e.user_id] = e.user_info, this.get(e.user_id)
				}, e.prototype.removeMember = function (e) {
					var t = this.get(e.user_id);
					return t && (delete this.members[e.user_id], this.count--), t
				}, e.prototype.reset = function () {
					this.members = {}, this.count = 0, this.myID = null, this.me = null
				}, e
			}();
			t.__esModule = !0, t.default = i
		}, function (e, t, n) {
			"use strict";
			var r = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, i = n(51), a = n(31), s = n(8), o = n(55), u = n(57), d = function (e) {
				function t() {
					e.apply(this, arguments), this.key = null
				}

				return r(t, e), t.prototype.authorize = function (t, n) {
					var r = this;
					e.prototype.authorize.call(this, t, function (e, t) {
						if (e) n(!0, t); else {
							var i = t.shared_secret;
							if (!i) {
								var a = "No shared_secret key in auth payload for encrypted channel: " + r.name;
								return n(!0, a), void s.default.warn("Error: " + a)
							}
							r.key = u.decodeBase64(i), delete t.shared_secret, n(!1, t)
						}
					})
				}, t.prototype.trigger = function (e, t) {
					throw new a.UnsupportedFeature("Client events are not currently supported for encrypted channels")
				}, t.prototype.handleEvent = function (t, n) {
					0 !== t.indexOf("pusher_internal:") && 0 !== t.indexOf("pusher:") ? this.handleEncryptedEvent(t, n) : e.prototype.handleEvent.call(this, t, n)
				}, t.prototype.handleEncryptedEvent = function (e, t) {
					var n = this;
					if (this.key) if (t.ciphertext && t.nonce) {
						var r = u.decodeBase64(t.ciphertext);
						if (r.length < o.secretbox.overheadLength) s.default.warn("Expected encrypted event ciphertext length to be " + o.secretbox.overheadLength + ", got: " + r.length); else {
							var i = u.decodeBase64(t.nonce);
							if (i.length < o.secretbox.nonceLength) s.default.warn("Expected encrypted event nonce length to be " + o.secretbox.nonceLength + ", got: " + i.length); else {
								var a = o.secretbox.open(r, i, this.key);
								if (null === a) return s.default.debug("Failed to decrypted an event, probably because it was encrypted with a different key. Fetching a new key from the authEndpoint..."), void this.authorize(this.pusher.connection.socket_id, function (t, d) {
									t ? s.default.warn("Failed to make a request to the authEndpoint: " + d + ". Unable to fetch new key, so dropping encrypted event") : null !== (a = o.secretbox.open(r, i, n.key)) ? n.emitJSON(e, u.encodeUTF8(a)) : s.default.warn("Failed to decrypt event with new key. Dropping encrypted event")
								});
								this.emitJSON(e, u.encodeUTF8(a))
							}
						}
					} else s.default.warn("Unexpected format for encrypted event, expected object with `ciphertext` and `nonce` fields, got: " + t); else s.default.debug("Received encrypted event before key has been retrieved from the authEndpoint")
				}, t.prototype.emitJSON = function (e, t) {
					try {
						this.emit(e, JSON.parse(t))
					} catch (n) {
						this.emit(e, t)
					}
					return this
				}, t
			}(i.default);
			t.__esModule = !0, t.default = d
		}, function (e, t, n) {
			!function (e) {
				"use strict";
				var t = function (e) {
					var t, n = new Float64Array(16);
					if (e) for (t = 0; t < e.length; t++) n[t] = e[t];
					return n
				}, r = function () {
					throw new Error("no PRNG")
				}, i = new Uint8Array(16), a = new Uint8Array(32);
				a[0] = 9;
				var s = t(), o = t([1]), u = t([56129, 1]),
					d = t([30883, 4953, 19914, 30187, 55467, 16705, 2637, 112, 59544, 30585, 16505, 36039, 65139, 11119, 27886, 20995]),
					l = t([61785, 9906, 39828, 60374, 45398, 33411, 5274, 224, 53552, 61171, 33010, 6542, 64743, 22239, 55772, 9222]),
					c = t([54554, 36645, 11616, 51542, 42930, 38181, 51040, 26924, 56412, 64982, 57905, 49316, 21502, 52590, 14035, 8553]),
					h = t([26200, 26214, 26214, 26214, 26214, 26214, 26214, 26214, 26214, 26214, 26214, 26214, 26214, 26214, 26214, 26214]),
					f = t([41136, 18958, 6951, 50414, 58488, 44335, 6150, 12099, 55207, 15867, 153, 11085, 57099, 20417, 9344, 11139]);

				function _(e, t, n, r) {
					e[t] = n >> 24 & 255, e[t + 1] = n >> 16 & 255, e[t + 2] = n >> 8 & 255, e[t + 3] = 255 & n, e[t + 4] = r >> 24 & 255, e[t + 5] = r >> 16 & 255, e[t + 6] = r >> 8 & 255, e[t + 7] = 255 & r
				}

				function p(e, t, n, r, i) {
					var a, s = 0;
					for (a = 0; a < i; a++) s |= e[t + a] ^ n[r + a];
					return (1 & s - 1 >>> 8) - 1
				}

				function m(e, t, n, r) {
					return p(e, t, n, r, 16)
				}

				function y(e, t, n, r) {
					return p(e, t, n, r, 32)
				}

				function g(e, t, n, r) {
					!function (e, t, n, r) {
						for (var i, a = 255 & r[0] | (255 & r[1]) << 8 | (255 & r[2]) << 16 | (255 & r[3]) << 24, s = 255 & n[0] | (255 & n[1]) << 8 | (255 & n[2]) << 16 | (255 & n[3]) << 24, o = 255 & n[4] | (255 & n[5]) << 8 | (255 & n[6]) << 16 | (255 & n[7]) << 24, u = 255 & n[8] | (255 & n[9]) << 8 | (255 & n[10]) << 16 | (255 & n[11]) << 24, d = 255 & n[12] | (255 & n[13]) << 8 | (255 & n[14]) << 16 | (255 & n[15]) << 24, l = 255 & r[4] | (255 & r[5]) << 8 | (255 & r[6]) << 16 | (255 & r[7]) << 24, c = 255 & t[0] | (255 & t[1]) << 8 | (255 & t[2]) << 16 | (255 & t[3]) << 24, h = 255 & t[4] | (255 & t[5]) << 8 | (255 & t[6]) << 16 | (255 & t[7]) << 24, f = 255 & t[8] | (255 & t[9]) << 8 | (255 & t[10]) << 16 | (255 & t[11]) << 24, _ = 255 & t[12] | (255 & t[13]) << 8 | (255 & t[14]) << 16 | (255 & t[15]) << 24, p = 255 & r[8] | (255 & r[9]) << 8 | (255 & r[10]) << 16 | (255 & r[11]) << 24, m = 255 & n[16] | (255 & n[17]) << 8 | (255 & n[18]) << 16 | (255 & n[19]) << 24, y = 255 & n[20] | (255 & n[21]) << 8 | (255 & n[22]) << 16 | (255 & n[23]) << 24, g = 255 & n[24] | (255 & n[25]) << 8 | (255 & n[26]) << 16 | (255 & n[27]) << 24, v = 255 & n[28] | (255 & n[29]) << 8 | (255 & n[30]) << 16 | (255 & n[31]) << 24, M = 255 & r[12] | (255 & r[13]) << 8 | (255 & r[14]) << 16 | (255 & r[15]) << 24, L = a, w = s, b = o, Y = u, k = d, T = l, D = c, S = h, x = f, j = _, H = p, E = m, C = y, A = g, O = v, P = M, R = 0; R < 20; R += 2) L ^= (i = (C ^= (i = (x ^= (i = (k ^= (i = L + C | 0) << 7 | i >>> 25) + L | 0) << 9 | i >>> 23) + k | 0) << 13 | i >>> 19) + x | 0) << 18 | i >>> 14, T ^= (i = (w ^= (i = (A ^= (i = (j ^= (i = T + w | 0) << 7 | i >>> 25) + T | 0) << 9 | i >>> 23) + j | 0) << 13 | i >>> 19) + A | 0) << 18 | i >>> 14, H ^= (i = (D ^= (i = (b ^= (i = (O ^= (i = H + D | 0) << 7 | i >>> 25) + H | 0) << 9 | i >>> 23) + O | 0) << 13 | i >>> 19) + b | 0) << 18 | i >>> 14, P ^= (i = (E ^= (i = (S ^= (i = (Y ^= (i = P + E | 0) << 7 | i >>> 25) + P | 0) << 9 | i >>> 23) + Y | 0) << 13 | i >>> 19) + S | 0) << 18 | i >>> 14, L ^= (i = (Y ^= (i = (b ^= (i = (w ^= (i = L + Y | 0) << 7 | i >>> 25) + L | 0) << 9 | i >>> 23) + w | 0) << 13 | i >>> 19) + b | 0) << 18 | i >>> 14, T ^= (i = (k ^= (i = (S ^= (i = (D ^= (i = T + k | 0) << 7 | i >>> 25) + T | 0) << 9 | i >>> 23) + D | 0) << 13 | i >>> 19) + S | 0) << 18 | i >>> 14, H ^= (i = (j ^= (i = (x ^= (i = (E ^= (i = H + j | 0) << 7 | i >>> 25) + H | 0) << 9 | i >>> 23) + E | 0) << 13 | i >>> 19) + x | 0) << 18 | i >>> 14, P ^= (i = (O ^= (i = (A ^= (i = (C ^= (i = P + O | 0) << 7 | i >>> 25) + P | 0) << 9 | i >>> 23) + C | 0) << 13 | i >>> 19) + A | 0) << 18 | i >>> 14;
						L = L + a | 0, w = w + s | 0, b = b + o | 0, Y = Y + u | 0, k = k + d | 0, T = T + l | 0, D = D + c | 0, S = S + h | 0, x = x + f | 0, j = j + _ | 0, H = H + p | 0, E = E + m | 0, C = C + y | 0, A = A + g | 0, O = O + v | 0, P = P + M | 0, e[0] = L >>> 0 & 255, e[1] = L >>> 8 & 255, e[2] = L >>> 16 & 255, e[3] = L >>> 24 & 255, e[4] = w >>> 0 & 255, e[5] = w >>> 8 & 255, e[6] = w >>> 16 & 255, e[7] = w >>> 24 & 255, e[8] = b >>> 0 & 255, e[9] = b >>> 8 & 255, e[10] = b >>> 16 & 255, e[11] = b >>> 24 & 255, e[12] = Y >>> 0 & 255, e[13] = Y >>> 8 & 255, e[14] = Y >>> 16 & 255, e[15] = Y >>> 24 & 255, e[16] = k >>> 0 & 255, e[17] = k >>> 8 & 255, e[18] = k >>> 16 & 255, e[19] = k >>> 24 & 255, e[20] = T >>> 0 & 255, e[21] = T >>> 8 & 255, e[22] = T >>> 16 & 255, e[23] = T >>> 24 & 255, e[24] = D >>> 0 & 255, e[25] = D >>> 8 & 255, e[26] = D >>> 16 & 255, e[27] = D >>> 24 & 255, e[28] = S >>> 0 & 255, e[29] = S >>> 8 & 255, e[30] = S >>> 16 & 255, e[31] = S >>> 24 & 255, e[32] = x >>> 0 & 255, e[33] = x >>> 8 & 255, e[34] = x >>> 16 & 255, e[35] = x >>> 24 & 255, e[36] = j >>> 0 & 255, e[37] = j >>> 8 & 255, e[38] = j >>> 16 & 255, e[39] = j >>> 24 & 255, e[40] = H >>> 0 & 255, e[41] = H >>> 8 & 255, e[42] = H >>> 16 & 255, e[43] = H >>> 24 & 255, e[44] = E >>> 0 & 255, e[45] = E >>> 8 & 255, e[46] = E >>> 16 & 255, e[47] = E >>> 24 & 255, e[48] = C >>> 0 & 255, e[49] = C >>> 8 & 255, e[50] = C >>> 16 & 255, e[51] = C >>> 24 & 255, e[52] = A >>> 0 & 255, e[53] = A >>> 8 & 255, e[54] = A >>> 16 & 255, e[55] = A >>> 24 & 255, e[56] = O >>> 0 & 255, e[57] = O >>> 8 & 255, e[58] = O >>> 16 & 255, e[59] = O >>> 24 & 255, e[60] = P >>> 0 & 255, e[61] = P >>> 8 & 255, e[62] = P >>> 16 & 255, e[63] = P >>> 24 & 255
					}(e, t, n, r)
				}

				function v(e, t, n, r) {
					!function (e, t, n, r) {
						for (var i, a = 255 & r[0] | (255 & r[1]) << 8 | (255 & r[2]) << 16 | (255 & r[3]) << 24, s = 255 & n[0] | (255 & n[1]) << 8 | (255 & n[2]) << 16 | (255 & n[3]) << 24, o = 255 & n[4] | (255 & n[5]) << 8 | (255 & n[6]) << 16 | (255 & n[7]) << 24, u = 255 & n[8] | (255 & n[9]) << 8 | (255 & n[10]) << 16 | (255 & n[11]) << 24, d = 255 & n[12] | (255 & n[13]) << 8 | (255 & n[14]) << 16 | (255 & n[15]) << 24, l = 255 & r[4] | (255 & r[5]) << 8 | (255 & r[6]) << 16 | (255 & r[7]) << 24, c = 255 & t[0] | (255 & t[1]) << 8 | (255 & t[2]) << 16 | (255 & t[3]) << 24, h = 255 & t[4] | (255 & t[5]) << 8 | (255 & t[6]) << 16 | (255 & t[7]) << 24, f = 255 & t[8] | (255 & t[9]) << 8 | (255 & t[10]) << 16 | (255 & t[11]) << 24, _ = 255 & t[12] | (255 & t[13]) << 8 | (255 & t[14]) << 16 | (255 & t[15]) << 24, p = 255 & r[8] | (255 & r[9]) << 8 | (255 & r[10]) << 16 | (255 & r[11]) << 24, m = 255 & n[16] | (255 & n[17]) << 8 | (255 & n[18]) << 16 | (255 & n[19]) << 24, y = 255 & n[20] | (255 & n[21]) << 8 | (255 & n[22]) << 16 | (255 & n[23]) << 24, g = 255 & n[24] | (255 & n[25]) << 8 | (255 & n[26]) << 16 | (255 & n[27]) << 24, v = 255 & n[28] | (255 & n[29]) << 8 | (255 & n[30]) << 16 | (255 & n[31]) << 24, M = 255 & r[12] | (255 & r[13]) << 8 | (255 & r[14]) << 16 | (255 & r[15]) << 24, L = 0; L < 20; L += 2) a ^= (i = (y ^= (i = (f ^= (i = (d ^= (i = a + y | 0) << 7 | i >>> 25) + a | 0) << 9 | i >>> 23) + d | 0) << 13 | i >>> 19) + f | 0) << 18 | i >>> 14, l ^= (i = (s ^= (i = (g ^= (i = (_ ^= (i = l + s | 0) << 7 | i >>> 25) + l | 0) << 9 | i >>> 23) + _ | 0) << 13 | i >>> 19) + g | 0) << 18 | i >>> 14, p ^= (i = (c ^= (i = (o ^= (i = (v ^= (i = p + c | 0) << 7 | i >>> 25) + p | 0) << 9 | i >>> 23) + v | 0) << 13 | i >>> 19) + o | 0) << 18 | i >>> 14, M ^= (i = (m ^= (i = (h ^= (i = (u ^= (i = M + m | 0) << 7 | i >>> 25) + M | 0) << 9 | i >>> 23) + u | 0) << 13 | i >>> 19) + h | 0) << 18 | i >>> 14, a ^= (i = (u ^= (i = (o ^= (i = (s ^= (i = a + u | 0) << 7 | i >>> 25) + a | 0) << 9 | i >>> 23) + s | 0) << 13 | i >>> 19) + o | 0) << 18 | i >>> 14, l ^= (i = (d ^= (i = (h ^= (i = (c ^= (i = l + d | 0) << 7 | i >>> 25) + l | 0) << 9 | i >>> 23) + c | 0) << 13 | i >>> 19) + h | 0) << 18 | i >>> 14, p ^= (i = (_ ^= (i = (f ^= (i = (m ^= (i = p + _ | 0) << 7 | i >>> 25) + p | 0) << 9 | i >>> 23) + m | 0) << 13 | i >>> 19) + f | 0) << 18 | i >>> 14, M ^= (i = (v ^= (i = (g ^= (i = (y ^= (i = M + v | 0) << 7 | i >>> 25) + M | 0) << 9 | i >>> 23) + y | 0) << 13 | i >>> 19) + g | 0) << 18 | i >>> 14;
						e[0] = a >>> 0 & 255, e[1] = a >>> 8 & 255, e[2] = a >>> 16 & 255, e[3] = a >>> 24 & 255, e[4] = l >>> 0 & 255, e[5] = l >>> 8 & 255, e[6] = l >>> 16 & 255, e[7] = l >>> 24 & 255, e[8] = p >>> 0 & 255, e[9] = p >>> 8 & 255, e[10] = p >>> 16 & 255, e[11] = p >>> 24 & 255, e[12] = M >>> 0 & 255, e[13] = M >>> 8 & 255, e[14] = M >>> 16 & 255, e[15] = M >>> 24 & 255, e[16] = c >>> 0 & 255, e[17] = c >>> 8 & 255, e[18] = c >>> 16 & 255, e[19] = c >>> 24 & 255, e[20] = h >>> 0 & 255, e[21] = h >>> 8 & 255, e[22] = h >>> 16 & 255, e[23] = h >>> 24 & 255, e[24] = f >>> 0 & 255, e[25] = f >>> 8 & 255, e[26] = f >>> 16 & 255, e[27] = f >>> 24 & 255, e[28] = _ >>> 0 & 255, e[29] = _ >>> 8 & 255, e[30] = _ >>> 16 & 255, e[31] = _ >>> 24 & 255
					}(e, t, n, r)
				}

				var M = new Uint8Array([101, 120, 112, 97, 110, 100, 32, 51, 50, 45, 98, 121, 116, 101, 32, 107]);

				function L(e, t, n, r, i, a, s) {
					var o, u, d = new Uint8Array(16), l = new Uint8Array(64);
					for (u = 0; u < 16; u++) d[u] = 0;
					for (u = 0; u < 8; u++) d[u] = a[u];
					for (; i >= 64;) {
						for (g(l, d, s, M), u = 0; u < 64; u++) e[t + u] = n[r + u] ^ l[u];
						for (o = 1, u = 8; u < 16; u++) o = o + (255 & d[u]) | 0, d[u] = 255 & o, o >>>= 8;
						i -= 64, t += 64, r += 64
					}
					if (i > 0) for (g(l, d, s, M), u = 0; u < i; u++) e[t + u] = n[r + u] ^ l[u];
					return 0
				}

				function w(e, t, n, r, i) {
					var a, s, o = new Uint8Array(16), u = new Uint8Array(64);
					for (s = 0; s < 16; s++) o[s] = 0;
					for (s = 0; s < 8; s++) o[s] = r[s];
					for (; n >= 64;) {
						for (g(u, o, i, M), s = 0; s < 64; s++) e[t + s] = u[s];
						for (a = 1, s = 8; s < 16; s++) a = a + (255 & o[s]) | 0, o[s] = 255 & a, a >>>= 8;
						n -= 64, t += 64
					}
					if (n > 0) for (g(u, o, i, M), s = 0; s < n; s++) e[t + s] = u[s];
					return 0
				}

				function b(e, t, n, r, i) {
					var a = new Uint8Array(32);
					v(a, r, i, M);
					for (var s = new Uint8Array(8), o = 0; o < 8; o++) s[o] = r[o + 16];
					return w(e, t, n, s, a)
				}

				function Y(e, t, n, r, i, a, s) {
					var o = new Uint8Array(32);
					v(o, a, s, M);
					for (var u = new Uint8Array(8), d = 0; d < 8; d++) u[d] = a[d + 16];
					return L(e, t, n, r, i, u, o)
				}

				var k = function (e) {
					var t, n, r, i, a, s, o, u;
					this.buffer = new Uint8Array(16), this.r = new Uint16Array(10), this.h = new Uint16Array(10), this.pad = new Uint16Array(8), this.leftover = 0, this.fin = 0, t = 255 & e[0] | (255 & e[1]) << 8, this.r[0] = 8191 & t, n = 255 & e[2] | (255 & e[3]) << 8, this.r[1] = 8191 & (t >>> 13 | n << 3), r = 255 & e[4] | (255 & e[5]) << 8, this.r[2] = 7939 & (n >>> 10 | r << 6), i = 255 & e[6] | (255 & e[7]) << 8, this.r[3] = 8191 & (r >>> 7 | i << 9), a = 255 & e[8] | (255 & e[9]) << 8, this.r[4] = 255 & (i >>> 4 | a << 12), this.r[5] = a >>> 1 & 8190, s = 255 & e[10] | (255 & e[11]) << 8, this.r[6] = 8191 & (a >>> 14 | s << 2), o = 255 & e[12] | (255 & e[13]) << 8, this.r[7] = 8065 & (s >>> 11 | o << 5), u = 255 & e[14] | (255 & e[15]) << 8, this.r[8] = 8191 & (o >>> 8 | u << 8), this.r[9] = u >>> 5 & 127, this.pad[0] = 255 & e[16] | (255 & e[17]) << 8, this.pad[1] = 255 & e[18] | (255 & e[19]) << 8, this.pad[2] = 255 & e[20] | (255 & e[21]) << 8, this.pad[3] = 255 & e[22] | (255 & e[23]) << 8, this.pad[4] = 255 & e[24] | (255 & e[25]) << 8, this.pad[5] = 255 & e[26] | (255 & e[27]) << 8, this.pad[6] = 255 & e[28] | (255 & e[29]) << 8, this.pad[7] = 255 & e[30] | (255 & e[31]) << 8
				};

				function T(e, t, n, r, i, a) {
					var s = new k(a);
					return s.update(n, r, i), s.finish(e, t), 0
				}

				function D(e, t, n, r, i, a) {
					var s = new Uint8Array(16);
					return T(s, 0, n, r, i, a), m(e, t, s, 0)
				}

				function S(e, t, n, r, i) {
					var a;
					if (n < 32) return -1;
					for (Y(e, 0, t, 0, n, r, i), T(e, 16, e, 32, n - 32, e), a = 0; a < 16; a++) e[a] = 0;
					return 0
				}

				function x(e, t, n, r, i) {
					var a, s = new Uint8Array(32);
					if (n < 32) return -1;
					if (b(s, 0, 32, r, i), 0 !== D(t, 16, t, 32, n - 32, s)) return -1;
					for (Y(e, 0, t, 0, n, r, i), a = 0; a < 32; a++) e[a] = 0;
					return 0
				}

				function j(e, t) {
					var n;
					for (n = 0; n < 16; n++) e[n] = 0 | t[n]
				}

				function H(e) {
					var t, n, r = 1;
					for (t = 0; t < 16; t++) n = e[t] + r + 65535, r = Math.floor(n / 65536), e[t] = n - 65536 * r;
					e[0] += r - 1 + 37 * (r - 1)
				}

				function E(e, t, n) {
					for (var r, i = ~(n - 1), a = 0; a < 16; a++) r = i & (e[a] ^ t[a]), e[a] ^= r, t[a] ^= r
				}

				function C(e, n) {
					var r, i, a, s = t(), o = t();
					for (r = 0; r < 16; r++) o[r] = n[r];
					for (H(o), H(o), H(o), i = 0; i < 2; i++) {
						for (s[0] = o[0] - 65517, r = 1; r < 15; r++) s[r] = o[r] - 65535 - (s[r - 1] >> 16 & 1), s[r - 1] &= 65535;
						s[15] = o[15] - 32767 - (s[14] >> 16 & 1), a = s[15] >> 16 & 1, s[14] &= 65535, E(o, s, 1 - a)
					}
					for (r = 0; r < 16; r++) e[2 * r] = 255 & o[r], e[2 * r + 1] = o[r] >> 8
				}

				function A(e, t) {
					var n = new Uint8Array(32), r = new Uint8Array(32);
					return C(n, e), C(r, t), y(n, 0, r, 0)
				}

				function O(e) {
					var t = new Uint8Array(32);
					return C(t, e), 1 & t[0]
				}

				function P(e, t) {
					var n;
					for (n = 0; n < 16; n++) e[n] = t[2 * n] + (t[2 * n + 1] << 8);
					e[15] &= 32767
				}

				function R(e, t, n) {
					for (var r = 0; r < 16; r++) e[r] = t[r] + n[r]
				}

				function W(e, t, n) {
					for (var r = 0; r < 16; r++) e[r] = t[r] - n[r]
				}

				function N(e, t, n) {
					var r, i, a = 0, s = 0, o = 0, u = 0, d = 0, l = 0, c = 0, h = 0, f = 0, _ = 0, p = 0, m = 0, y = 0,
						g = 0, v = 0, M = 0, L = 0, w = 0, b = 0, Y = 0, k = 0, T = 0, D = 0, S = 0, x = 0, j = 0,
						H = 0, E = 0, C = 0, A = 0, O = 0, P = n[0], R = n[1], W = n[2], N = n[3], I = n[4], F = n[5],
						z = n[6], $ = n[7], U = n[8], B = n[9], q = n[10], J = n[11], G = n[12], V = n[13], K = n[14],
						X = n[15];
					a += (r = t[0]) * P, s += r * R, o += r * W, u += r * N, d += r * I, l += r * F, c += r * z, h += r * $, f += r * U, _ += r * B, p += r * q, m += r * J, y += r * G, g += r * V, v += r * K, M += r * X, s += (r = t[1]) * P, o += r * R, u += r * W, d += r * N, l += r * I, c += r * F, h += r * z, f += r * $, _ += r * U, p += r * B, m += r * q, y += r * J, g += r * G, v += r * V, M += r * K, L += r * X, o += (r = t[2]) * P, u += r * R, d += r * W, l += r * N, c += r * I, h += r * F, f += r * z, _ += r * $, p += r * U, m += r * B, y += r * q, g += r * J, v += r * G, M += r * V, L += r * K, w += r * X, u += (r = t[3]) * P, d += r * R, l += r * W, c += r * N, h += r * I, f += r * F, _ += r * z, p += r * $, m += r * U, y += r * B, g += r * q, v += r * J, M += r * G, L += r * V, w += r * K, b += r * X, d += (r = t[4]) * P, l += r * R, c += r * W, h += r * N, f += r * I, _ += r * F, p += r * z, m += r * $, y += r * U, g += r * B, v += r * q, M += r * J, L += r * G, w += r * V, b += r * K, Y += r * X, l += (r = t[5]) * P, c += r * R, h += r * W, f += r * N, _ += r * I, p += r * F, m += r * z, y += r * $, g += r * U, v += r * B, M += r * q, L += r * J, w += r * G, b += r * V, Y += r * K, k += r * X, c += (r = t[6]) * P, h += r * R, f += r * W, _ += r * N, p += r * I,m += r * F,y += r * z,g += r * $,v += r * U,M += r * B,L += r * q,w += r * J,b += r * G,Y += r * V,k += r * K,T += r * X,h += (r = t[7]) * P,f += r * R,_ += r * W,p += r * N,m += r * I,y += r * F,g += r * z,v += r * $,M += r * U,L += r * B,w += r * q,b += r * J,Y += r * G,k += r * V,T += r * K,D += r * X,f += (r = t[8]) * P,_ += r * R,p += r * W,m += r * N,y += r * I,g += r * F,v += r * z,M += r * $,L += r * U,w += r * B,b += r * q,Y += r * J,k += r * G,T += r * V,D += r * K,S += r * X,_ += (r = t[9]) * P,p += r * R,m += r * W,y += r * N,g += r * I,v += r * F,M += r * z,L += r * $,w += r * U,b += r * B,Y += r * q,k += r * J,T += r * G,D += r * V,S += r * K,x += r * X,p += (r = t[10]) * P,m += r * R,y += r * W,g += r * N,v += r * I,M += r * F,L += r * z,w += r * $,b += r * U,Y += r * B,k += r * q,T += r * J,D += r * G,S += r * V,x += r * K,j += r * X,m += (r = t[11]) * P,y += r * R,g += r * W,v += r * N,M += r * I,L += r * F,w += r * z,b += r * $,Y += r * U,k += r * B,T += r * q,D += r * J,S += r * G,x += r * V,j += r * K,H += r * X,y += (r = t[12]) * P,g += r * R,v += r * W,M += r * N,L += r * I,w += r * F,b += r * z,Y += r * $,k += r * U,T += r * B,D += r * q,S += r * J,x += r * G,j += r * V,H += r * K,E += r * X,g += (r = t[13]) * P,v += r * R,M += r * W,L += r * N,w += r * I,b += r * F,Y += r * z,k += r * $,T += r * U,D += r * B,S += r * q,x += r * J,j += r * G,H += r * V,E += r * K,C += r * X,v += (r = t[14]) * P,M += r * R,L += r * W,w += r * N,b += r * I,Y += r * F,k += r * z,T += r * $,D += r * U,S += r * B,x += r * q,j += r * J,H += r * G,E += r * V,C += r * K,A += r * X,M += (r = t[15]) * P,s += 38 * (w += r * W),o += 38 * (b += r * N),u += 38 * (Y += r * I),d += 38 * (k += r * F),l += 38 * (T += r * z),c += 38 * (D += r * $),h += 38 * (S += r * U),f += 38 * (x += r * B),_ += 38 * (j += r * q),p += 38 * (H += r * J),m += 38 * (E += r * G),y += 38 * (C += r * V),g += 38 * (A += r * K),v += 38 * (O += r * X),a = (r = (a += 38 * (L += r * R)) + (i = 1) + 65535) - 65536 * (i = Math.floor(r / 65536)),s = (r = s + i + 65535) - 65536 * (i = Math.floor(r / 65536)),o = (r = o + i + 65535) - 65536 * (i = Math.floor(r / 65536)),u = (r = u + i + 65535) - 65536 * (i = Math.floor(r / 65536)),d = (r = d + i + 65535) - 65536 * (i = Math.floor(r / 65536)),l = (r = l + i + 65535) - 65536 * (i = Math.floor(r / 65536)),c = (r = c + i + 65535) - 65536 * (i = Math.floor(r / 65536)),h = (r = h + i + 65535) - 65536 * (i = Math.floor(r / 65536)),f = (r = f + i + 65535) - 65536 * (i = Math.floor(r / 65536)),_ = (r = _ + i + 65535) - 65536 * (i = Math.floor(r / 65536)),p = (r = p + i + 65535) - 65536 * (i = Math.floor(r / 65536)),m = (r = m + i + 65535) - 65536 * (i = Math.floor(r / 65536)),y = (r = y + i + 65535) - 65536 * (i = Math.floor(r / 65536)),g = (r = g + i + 65535) - 65536 * (i = Math.floor(r / 65536)),v = (r = v + i + 65535) - 65536 * (i = Math.floor(r / 65536)),M = (r = M + i + 65535) - 65536 * (i = Math.floor(r / 65536)),a = (r = (a += i - 1 + 37 * (i - 1)) + (i = 1) + 65535) - 65536 * (i = Math.floor(r / 65536)),s = (r = s + i + 65535) - 65536 * (i = Math.floor(r / 65536)),o = (r = o + i + 65535) - 65536 * (i = Math.floor(r / 65536)),u = (r = u + i + 65535) - 65536 * (i = Math.floor(r / 65536)),d = (r = d + i + 65535) - 65536 * (i = Math.floor(r / 65536)),l = (r = l + i + 65535) - 65536 * (i = Math.floor(r / 65536)),c = (r = c + i + 65535) - 65536 * (i = Math.floor(r / 65536)),h = (r = h + i + 65535) - 65536 * (i = Math.floor(r / 65536)),f = (r = f + i + 65535) - 65536 * (i = Math.floor(r / 65536)),_ = (r = _ + i + 65535) - 65536 * (i = Math.floor(r / 65536)),p = (r = p + i + 65535) - 65536 * (i = Math.floor(r / 65536)),m = (r = m + i + 65535) - 65536 * (i = Math.floor(r / 65536)),y = (r = y + i + 65535) - 65536 * (i = Math.floor(r / 65536)),g = (r = g + i + 65535) - 65536 * (i = Math.floor(r / 65536)),v = (r = v + i + 65535) - 65536 * (i = Math.floor(r / 65536)),M = (r = M + i + 65535) - 65536 * (i = Math.floor(r / 65536)),a += i - 1 + 37 * (i - 1),e[0] = a,e[1] = s,e[2] = o,e[3] = u,e[4] = d,e[5] = l,e[6] = c,e[7] = h,e[8] = f,e[9] = _,e[10] = p,e[11] = m,e[12] = y,e[13] = g,e[14] = v,e[15] = M
				}

				function I(e, t) {
					N(e, t, t)
				}

				function F(e, n) {
					var r, i = t();
					for (r = 0; r < 16; r++) i[r] = n[r];
					for (r = 253; r >= 0; r--) I(i, i), 2 !== r && 4 !== r && N(i, i, n);
					for (r = 0; r < 16; r++) e[r] = i[r]
				}

				function z(e, n, r) {
					var i, a, s = new Uint8Array(32), o = new Float64Array(80), d = t(), l = t(), c = t(), h = t(),
						f = t(), _ = t();
					for (a = 0; a < 31; a++) s[a] = n[a];
					for (s[31] = 127 & n[31] | 64, s[0] &= 248, P(o, r), a = 0; a < 16; a++) l[a] = o[a], h[a] = d[a] = c[a] = 0;
					for (d[0] = h[0] = 1, a = 254; a >= 0; --a) E(d, l, i = s[a >>> 3] >>> (7 & a) & 1), E(c, h, i), R(f, d, c), W(d, d, c), R(c, l, h), W(l, l, h), I(h, f), I(_, d), N(d, c, d), N(c, l, f), R(f, d, c), W(d, d, c), I(l, d), W(c, h, _), N(d, c, u), R(d, d, h), N(c, c, d), N(d, h, _), N(h, l, o), I(l, f), E(d, l, i), E(c, h, i);
					for (a = 0; a < 16; a++) o[a + 16] = d[a], o[a + 32] = c[a], o[a + 48] = l[a], o[a + 64] = h[a];
					var p = o.subarray(32), m = o.subarray(16);
					return F(p, p), N(m, m, p), C(e, m), 0
				}

				function $(e, t) {
					return z(e, t, a)
				}

				function U(e, t) {
					return r(t, 32), $(e, t)
				}

				function B(e, t, n) {
					var r = new Uint8Array(32);
					return z(r, n, t), v(e, i, r, M)
				}

				k.prototype.blocks = function (e, t, n) {
					for (var r, i, a, s, o, u, d, l, c, h, f, _, p, m, y, g, v, M, L, w = this.fin ? 0 : 2048, b = this.h[0], Y = this.h[1], k = this.h[2], T = this.h[3], D = this.h[4], S = this.h[5], x = this.h[6], j = this.h[7], H = this.h[8], E = this.h[9], C = this.r[0], A = this.r[1], O = this.r[2], P = this.r[3], R = this.r[4], W = this.r[5], N = this.r[6], I = this.r[7], F = this.r[8], z = this.r[9]; n >= 16;) b += 8191 & (r = 255 & e[t + 0] | (255 & e[t + 1]) << 8), Y += 8191 & (r >>> 13 | (i = 255 & e[t + 2] | (255 & e[t + 3]) << 8) << 3), k += 8191 & (i >>> 10 | (a = 255 & e[t + 4] | (255 & e[t + 5]) << 8) << 6), T += 8191 & (a >>> 7 | (s = 255 & e[t + 6] | (255 & e[t + 7]) << 8) << 9), D += 8191 & (s >>> 4 | (o = 255 & e[t + 8] | (255 & e[t + 9]) << 8) << 12), S += o >>> 1 & 8191, x += 8191 & (o >>> 14 | (u = 255 & e[t + 10] | (255 & e[t + 11]) << 8) << 2), j += 8191 & (u >>> 11 | (d = 255 & e[t + 12] | (255 & e[t + 13]) << 8) << 5), l = 255 & e[t + 14] | (255 & e[t + 15]) << 8, h = c = 0, h += b * C, h += Y * (5 * z), h += k * (5 * F), h += T * (5 * I), c = (h += D * (5 * N)) >>> 13, h &= 8191, h += S * (5 * W), h += x * (5 * R), h += j * (5 * P), h += (H += 8191 & (d >>> 8 | l << 8)) * (5 * O), f = c += (h += (E += l >>> 5 | w) * (5 * A)) >>> 13, f += b * A, f += Y * C, f += k * (5 * z), f += T * (5 * F), c = (f += D * (5 * I)) >>> 13, f &= 8191, f += S * (5 * N), f += x * (5 * W), f += j * (5 * R), f += H * (5 * P), c += (f += E * (5 * O)) >>> 13, f &= 8191, _ = c, _ += b * O, _ += Y * A, _ += k * C, _ += T * (5 * z), c = (_ += D * (5 * F)) >>> 13, _ &= 8191, _ += S * (5 * I), _ += x * (5 * N), _ += j * (5 * W), _ += H * (5 * R), p = c += (_ += E * (5 * P)) >>> 13, p += b * P, p += Y * O, p += k * A, p += T * C, c = (p += D * (5 * z)) >>> 13, p &= 8191, p += S * (5 * F), p += x * (5 * I), p += j * (5 * N), p += H * (5 * W), m = c += (p += E * (5 * R)) >>> 13, m += b * R, m += Y * P, m += k * O, m += T * A, c = (m += D * C) >>> 13, m &= 8191, m += S * (5 * z), m += x * (5 * F), m += j * (5 * I), m += H * (5 * N), y = c += (m += E * (5 * W)) >>> 13, y += b * W, y += Y * R, y += k * P, y += T * O, c = (y += D * A) >>> 13, y &= 8191, y += S * C, y += x * (5 * z), y += j * (5 * F), y += H * (5 * I), g = c += (y += E * (5 * N)) >>> 13, g += b * N, g += Y * W, g += k * R, g += T * P, c = (g += D * O) >>> 13, g &= 8191, g += S * A, g += x * C, g += j * (5 * z), g += H * (5 * F), v = c += (g += E * (5 * I)) >>> 13, v += b * I, v += Y * N, v += k * W, v += T * R, c = (v += D * P) >>> 13, v &= 8191, v += S * O, v += x * A, v += j * C, v += H * (5 * z), M = c += (v += E * (5 * F)) >>> 13, M += b * F,M += Y * I,M += k * N,M += T * W,c = (M += D * R) >>> 13,M &= 8191,M += S * P,M += x * O,M += j * A,M += H * C,L = c += (M += E * (5 * z)) >>> 13,L += b * z,L += Y * F,L += k * I,L += T * N,c = (L += D * W) >>> 13,L &= 8191,L += S * R,L += x * P,L += j * O,L += H * A,b = h = 8191 & (c = (c = ((c += (L += E * C) >>> 13) << 2) + c | 0) + (h &= 8191) | 0),Y = f += c >>>= 13,k = _ &= 8191,T = p &= 8191,D = m &= 8191,S = y &= 8191,x = g &= 8191,j = v &= 8191,H = M &= 8191,E = L &= 8191,t += 16,n -= 16;
					this.h[0] = b, this.h[1] = Y, this.h[2] = k, this.h[3] = T, this.h[4] = D, this.h[5] = S, this.h[6] = x, this.h[7] = j, this.h[8] = H, this.h[9] = E
				}, k.prototype.finish = function (e, t) {
					var n, r, i, a, s = new Uint16Array(10);
					if (this.leftover) {
						for (a = this.leftover, this.buffer[a++] = 1; a < 16; a++) this.buffer[a] = 0;
						this.fin = 1, this.blocks(this.buffer, 0, 16)
					}
					for (n = this.h[1] >>> 13, this.h[1] &= 8191, a = 2; a < 10; a++) this.h[a] += n, n = this.h[a] >>> 13, this.h[a] &= 8191;
					for (this.h[0] += 5 * n, n = this.h[0] >>> 13, this.h[0] &= 8191, this.h[1] += n, n = this.h[1] >>> 13, this.h[1] &= 8191, this.h[2] += n, s[0] = this.h[0] + 5, n = s[0] >>> 13, s[0] &= 8191, a = 1; a < 10; a++) s[a] = this.h[a] + n, n = s[a] >>> 13, s[a] &= 8191;
					for (s[9] -= 8192, r = (1 ^ n) - 1, a = 0; a < 10; a++) s[a] &= r;
					for (r = ~r, a = 0; a < 10; a++) this.h[a] = this.h[a] & r | s[a];
					for (this.h[0] = 65535 & (this.h[0] | this.h[1] << 13), this.h[1] = 65535 & (this.h[1] >>> 3 | this.h[2] << 10), this.h[2] = 65535 & (this.h[2] >>> 6 | this.h[3] << 7), this.h[3] = 65535 & (this.h[3] >>> 9 | this.h[4] << 4), this.h[4] = 65535 & (this.h[4] >>> 12 | this.h[5] << 1 | this.h[6] << 14), this.h[5] = 65535 & (this.h[6] >>> 2 | this.h[7] << 11), this.h[6] = 65535 & (this.h[7] >>> 5 | this.h[8] << 8), this.h[7] = 65535 & (this.h[8] >>> 8 | this.h[9] << 5), i = this.h[0] + this.pad[0], this.h[0] = 65535 & i, a = 1; a < 8; a++) i = (this.h[a] + this.pad[a] | 0) + (i >>> 16) | 0, this.h[a] = 65535 & i;
					e[t + 0] = this.h[0] >>> 0 & 255, e[t + 1] = this.h[0] >>> 8 & 255, e[t + 2] = this.h[1] >>> 0 & 255, e[t + 3] = this.h[1] >>> 8 & 255, e[t + 4] = this.h[2] >>> 0 & 255, e[t + 5] = this.h[2] >>> 8 & 255, e[t + 6] = this.h[3] >>> 0 & 255, e[t + 7] = this.h[3] >>> 8 & 255, e[t + 8] = this.h[4] >>> 0 & 255, e[t + 9] = this.h[4] >>> 8 & 255, e[t + 10] = this.h[5] >>> 0 & 255, e[t + 11] = this.h[5] >>> 8 & 255, e[t + 12] = this.h[6] >>> 0 & 255, e[t + 13] = this.h[6] >>> 8 & 255, e[t + 14] = this.h[7] >>> 0 & 255, e[t + 15] = this.h[7] >>> 8 & 255
				}, k.prototype.update = function (e, t, n) {
					var r, i;
					if (this.leftover) {
						for ((i = 16 - this.leftover) > n && (i = n), r = 0; r < i; r++) this.buffer[this.leftover + r] = e[t + r];
						if (n -= i, t += i, this.leftover += i, this.leftover < 16) return;
						this.blocks(this.buffer, 0, 16), this.leftover = 0
					}
					if (n >= 16 && (i = n - n % 16, this.blocks(e, t, i), t += i, n -= i), n) {
						for (r = 0; r < n; r++) this.buffer[this.leftover + r] = e[t + r];
						this.leftover += n
					}
				};
				var q = S, J = x;
				var G = [1116352408, 3609767458, 1899447441, 602891725, 3049323471, 3964484399, 3921009573, 2173295548, 961987163, 4081628472, 1508970993, 3053834265, 2453635748, 2937671579, 2870763221, 3664609560, 3624381080, 2734883394, 310598401, 1164996542, 607225278, 1323610764, 1426881987, 3590304994, 1925078388, 4068182383, 2162078206, 991336113, 2614888103, 633803317, 3248222580, 3479774868, 3835390401, 2666613458, 4022224774, 944711139, 264347078, 2341262773, 604807628, 2007800933, 770255983, 1495990901, 1249150122, 1856431235, 1555081692, 3175218132, 1996064986, 2198950837, 2554220882, 3999719339, 2821834349, 766784016, 2952996808, 2566594879, 3210313671, 3203337956, 3336571891, 1034457026, 3584528711, 2466948901, 113926993, 3758326383, 338241895, 168717936, 666307205, 1188179964, 773529912, 1546045734, 1294757372, 1522805485, 1396182291, 2643833823, 1695183700, 2343527390, 1986661051, 1014477480, 2177026350, 1206759142, 2456956037, 344077627, 2730485921, 1290863460, 2820302411, 3158454273, 3259730800, 3505952657, 3345764771, 106217008, 3516065817, 3606008344, 3600352804, 1432725776, 4094571909, 1467031594, 275423344, 851169720, 430227734, 3100823752, 506948616, 1363258195, 659060556, 3750685593, 883997877, 3785050280, 958139571, 3318307427, 1322822218, 3812723403, 1537002063, 2003034995, 1747873779, 3602036899, 1955562222, 1575990012, 2024104815, 1125592928, 2227730452, 2716904306, 2361852424, 442776044, 2428436474, 593698344, 2756734187, 3733110249, 3204031479, 2999351573, 3329325298, 3815920427, 3391569614, 3928383900, 3515267271, 566280711, 3940187606, 3454069534, 4118630271, 4000239992, 116418474, 1914138554, 174292421, 2731055270, 289380356, 3203993006, 460393269, 320620315, 685471733, 587496836, 852142971, 1086792851, 1017036298, 365543100, 1126000580, 2618297676, 1288033470, 3409855158, 1501505948, 4234509866, 1607167915, 987167468, 1816402316, 1246189591];

				function V(e, t, n, r) {
					for (var i, a, s, o, u, d, l, c, h, f, _, p, m, y, g, v, M, L, w, b, Y, k, T, D, S, x, j = new Int32Array(16), H = new Int32Array(16), E = e[0], C = e[1], A = e[2], O = e[3], P = e[4], R = e[5], W = e[6], N = e[7], I = t[0], F = t[1], z = t[2], $ = t[3], U = t[4], B = t[5], q = t[6], J = t[7], V = 0; r >= 128;) {
						for (w = 0; w < 16; w++) b = 8 * w + V, j[w] = n[b + 0] << 24 | n[b + 1] << 16 | n[b + 2] << 8 | n[b + 3], H[w] = n[b + 4] << 24 | n[b + 5] << 16 | n[b + 6] << 8 | n[b + 7];
						for (w = 0; w < 80; w++) if (i = E, a = C, s = A, o = O, u = P, d = R, l = W, c = N, h = I, f = F, _ = z, p = $, m = U, y = B, g = q, v = J, T = 65535 & (k = J), D = k >>> 16, S = 65535 & (Y = N), x = Y >>> 16, T += 65535 & (k = (U >>> 14 | P << 18) ^ (U >>> 18 | P << 14) ^ (P >>> 9 | U << 23)), D += k >>> 16, S += 65535 & (Y = (P >>> 14 | U << 18) ^ (P >>> 18 | U << 14) ^ (U >>> 9 | P << 23)), x += Y >>> 16, T += 65535 & (k = U & B ^ ~U & q), D += k >>> 16, S += 65535 & (Y = P & R ^ ~P & W), x += Y >>> 16, Y = G[2 * w], T += 65535 & (k = G[2 * w + 1]), D += k >>> 16, S += 65535 & Y, x += Y >>> 16, Y = j[w % 16], D += (k = H[w % 16]) >>> 16, S += 65535 & Y, x += Y >>> 16, S += (D += (T += 65535 & k) >>> 16) >>> 16, T = 65535 & (k = L = 65535 & T | D << 16), D = k >>> 16, S = 65535 & (Y = M = 65535 & S | (x += S >>> 16) << 16), x = Y >>> 16, T += 65535 & (k = (I >>> 28 | E << 4) ^ (E >>> 2 | I << 30) ^ (E >>> 7 | I << 25)), D += k >>> 16, S += 65535 & (Y = (E >>> 28 | I << 4) ^ (I >>> 2 | E << 30) ^ (I >>> 7 | E << 25)), x += Y >>> 16, D += (k = I & F ^ I & z ^ F & z) >>> 16, S += 65535 & (Y = E & C ^ E & A ^ C & A), x += Y >>> 16, c = 65535 & (S += (D += (T += 65535 & k) >>> 16) >>> 16) | (x += S >>> 16) << 16, v = 65535 & T | D << 16, T = 65535 & (k = p), D = k >>> 16, S = 65535 & (Y = o), x = Y >>> 16, D += (k = L) >>> 16, S += 65535 & (Y = M), x += Y >>> 16, C = i, A = a, O = s, P = o = 65535 & (S += (D += (T += 65535 & k) >>> 16) >>> 16) | (x += S >>> 16) << 16, R = u, W = d, N = l, E = c, F = h, z = f, $ = _, U = p = 65535 & T | D << 16, B = m, q = y, J = g, I = v, w % 16 == 15) for (b = 0; b < 16; b++) Y = j[b], T = 65535 & (k = H[b]), D = k >>> 16, S = 65535 & Y, x = Y >>> 16, Y = j[(b + 9) % 16], T += 65535 & (k = H[(b + 9) % 16]), D += k >>> 16, S += 65535 & Y, x += Y >>> 16, M = j[(b + 1) % 16], T += 65535 & (k = ((L = H[(b + 1) % 16]) >>> 1 | M << 31) ^ (L >>> 8 | M << 24) ^ (L >>> 7 | M << 25)), D += k >>> 16, S += 65535 & (Y = (M >>> 1 | L << 31) ^ (M >>> 8 | L << 24) ^ M >>> 7), x += Y >>> 16, M = j[(b + 14) % 16], D += (k = ((L = H[(b + 14) % 16]) >>> 19 | M << 13) ^ (M >>> 29 | L << 3) ^ (L >>> 6 | M << 26)) >>> 16, S += 65535 & (Y = (M >>> 19 | L << 13) ^ (L >>> 29 | M << 3) ^ M >>> 6), x += Y >>> 16, x += (S += (D += (T += 65535 & k) >>> 16) >>> 16) >>> 16, j[b] = 65535 & S | x << 16, H[b] = 65535 & T | D << 16;
						T = 65535 & (k = I), D = k >>> 16, S = 65535 & (Y = E), x = Y >>> 16, Y = e[0], D += (k = t[0]) >>> 16, S += 65535 & Y, x += Y >>> 16, x += (S += (D += (T += 65535 & k) >>> 16) >>> 16) >>> 16, e[0] = E = 65535 & S | x << 16, t[0] = I = 65535 & T | D << 16, T = 65535 & (k = F), D = k >>> 16, S = 65535 & (Y = C), x = Y >>> 16, Y = e[1], D += (k = t[1]) >>> 16, S += 65535 & Y, x += Y >>> 16, x += (S += (D += (T += 65535 & k) >>> 16) >>> 16) >>> 16, e[1] = C = 65535 & S | x << 16, t[1] = F = 65535 & T | D << 16, T = 65535 & (k = z), D = k >>> 16, S = 65535 & (Y = A), x = Y >>> 16, Y = e[2], D += (k = t[2]) >>> 16, S += 65535 & Y, x += Y >>> 16, x += (S += (D += (T += 65535 & k) >>> 16) >>> 16) >>> 16, e[2] = A = 65535 & S | x << 16, t[2] = z = 65535 & T | D << 16, T = 65535 & (k = $), D = k >>> 16, S = 65535 & (Y = O), x = Y >>> 16, Y = e[3], D += (k = t[3]) >>> 16, S += 65535 & Y, x += Y >>> 16, x += (S += (D += (T += 65535 & k) >>> 16) >>> 16) >>> 16, e[3] = O = 65535 & S | x << 16, t[3] = $ = 65535 & T | D << 16, T = 65535 & (k = U), D = k >>> 16, S = 65535 & (Y = P), x = Y >>> 16, Y = e[4], D += (k = t[4]) >>> 16, S += 65535 & Y, x += Y >>> 16, x += (S += (D += (T += 65535 & k) >>> 16) >>> 16) >>> 16, e[4] = P = 65535 & S | x << 16, t[4] = U = 65535 & T | D << 16, T = 65535 & (k = B), D = k >>> 16, S = 65535 & (Y = R), x = Y >>> 16, Y = e[5], D += (k = t[5]) >>> 16, S += 65535 & Y, x += Y >>> 16, x += (S += (D += (T += 65535 & k) >>> 16) >>> 16) >>> 16, e[5] = R = 65535 & S | x << 16, t[5] = B = 65535 & T | D << 16, T = 65535 & (k = q), D = k >>> 16, S = 65535 & (Y = W), x = Y >>> 16, Y = e[6], D += (k = t[6]) >>> 16, S += 65535 & Y, x += Y >>> 16, x += (S += (D += (T += 65535 & k) >>> 16) >>> 16) >>> 16, e[6] = W = 65535 & S | x << 16, t[6] = q = 65535 & T | D << 16, T = 65535 & (k = J), D = k >>> 16, S = 65535 & (Y = N), x = Y >>> 16, Y = e[7], D += (k = t[7]) >>> 16, S += 65535 & Y, x += Y >>> 16, x += (S += (D += (T += 65535 & k) >>> 16) >>> 16) >>> 16, e[7] = N = 65535 & S | x << 16, t[7] = J = 65535 & T | D << 16, V += 128, r -= 128
					}
					return r
				}

				function K(e, t, n) {
					var r, i = new Int32Array(8), a = new Int32Array(8), s = new Uint8Array(256), o = n;
					for (i[0] = 1779033703, i[1] = 3144134277, i[2] = 1013904242, i[3] = 2773480762, i[4] = 1359893119, i[5] = 2600822924, i[6] = 528734635, i[7] = 1541459225, a[0] = 4089235720, a[1] = 2227873595, a[2] = 4271175723, a[3] = 1595750129, a[4] = 2917565137, a[5] = 725511199, a[6] = 4215389547, a[7] = 327033209, V(i, a, t, n), n %= 128, r = 0; r < n; r++) s[r] = t[o - n + r];
					for (s[n] = 128, s[(n = 256 - 128 * (n < 112 ? 1 : 0)) - 9] = 0, _(s, n - 8, o / 536870912 | 0, o << 3), V(i, a, s, n), r = 0; r < 8; r++) _(e, 8 * r, i[r], a[r]);
					return 0
				}

				function X(e, n) {
					var r = t(), i = t(), a = t(), s = t(), o = t(), u = t(), d = t(), c = t(), h = t();
					W(r, e[1], e[0]), W(h, n[1], n[0]), N(r, r, h), R(i, e[0], e[1]), R(h, n[0], n[1]), N(i, i, h), N(a, e[3], n[3]), N(a, a, l), N(s, e[2], n[2]), R(s, s, s), W(o, i, r), W(u, s, a), R(d, s, a), R(c, i, r), N(e[0], o, u), N(e[1], c, d), N(e[2], d, u), N(e[3], o, c)
				}

				function Z(e, t, n) {
					var r;
					for (r = 0; r < 4; r++) E(e[r], t[r], n)
				}

				function Q(e, n) {
					var r = t(), i = t(), a = t();
					F(a, n[2]), N(r, n[0], a), N(i, n[1], a), C(e, i), e[31] ^= O(r) << 7
				}

				function ee(e, t, n) {
					var r, i;
					for (j(e[0], s), j(e[1], o), j(e[2], o), j(e[3], s), i = 255; i >= 0; --i) Z(e, t, r = n[i / 8 | 0] >> (7 & i) & 1), X(t, e), X(e, e), Z(e, t, r)
				}

				function te(e, n) {
					var r = [t(), t(), t(), t()];
					j(r[0], c), j(r[1], h), j(r[2], o), N(r[3], c, h), ee(e, r, n)
				}

				function ne(e, n, i) {
					var a, s = new Uint8Array(64), o = [t(), t(), t(), t()];
					for (i || r(n, 32), K(s, n, 32), s[0] &= 248, s[31] &= 127, s[31] |= 64, te(o, s), Q(e, o), a = 0; a < 32; a++) n[a + 32] = e[a];
					return 0
				}

				var re = new Float64Array([237, 211, 245, 92, 26, 99, 18, 88, 214, 156, 247, 162, 222, 249, 222, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 16]);

				function ie(e, t) {
					var n, r, i, a;
					for (r = 63; r >= 32; --r) {
						for (n = 0, i = r - 32, a = r - 12; i < a; ++i) t[i] += n - 16 * t[r] * re[i - (r - 32)], n = t[i] + 128 >> 8, t[i] -= 256 * n;
						t[i] += n, t[r] = 0
					}
					for (n = 0, i = 0; i < 32; i++) t[i] += n - (t[31] >> 4) * re[i], n = t[i] >> 8, t[i] &= 255;
					for (i = 0; i < 32; i++) t[i] -= n * re[i];
					for (r = 0; r < 32; r++) t[r + 1] += t[r] >> 8, e[r] = 255 & t[r]
				}

				function ae(e) {
					var t, n = new Float64Array(64);
					for (t = 0; t < 64; t++) n[t] = e[t];
					for (t = 0; t < 64; t++) e[t] = 0;
					ie(e, n)
				}

				function se(e, n, r, i) {
					var a, s, o = new Uint8Array(64), u = new Uint8Array(64), d = new Uint8Array(64),
						l = new Float64Array(64), c = [t(), t(), t(), t()];
					K(o, i, 32), o[0] &= 248, o[31] &= 127, o[31] |= 64;
					var h = r + 64;
					for (a = 0; a < r; a++) e[64 + a] = n[a];
					for (a = 0; a < 32; a++) e[32 + a] = o[32 + a];
					for (K(d, e.subarray(32), r + 32), ae(d), te(c, d), Q(e, c), a = 32; a < 64; a++) e[a] = i[a];
					for (K(u, e, r + 64), ae(u), a = 0; a < 64; a++) l[a] = 0;
					for (a = 0; a < 32; a++) l[a] = d[a];
					for (a = 0; a < 32; a++) for (s = 0; s < 32; s++) l[a + s] += u[a] * o[s];
					return ie(e.subarray(32), l), h
				}

				function oe(e, n) {
					var r = t(), i = t(), a = t(), u = t(), l = t(), c = t(), h = t();
					return j(e[2], o), P(e[1], n), I(a, e[1]), N(u, a, d), W(a, a, e[2]), R(u, e[2], u), I(l, u), I(c, l), N(h, c, l), N(r, h, a), N(r, r, u), function (e, n) {
						var r, i = t();
						for (r = 0; r < 16; r++) i[r] = n[r];
						for (r = 250; r >= 0; r--) I(i, i), 1 !== r && N(i, i, n);
						for (r = 0; r < 16; r++) e[r] = i[r]
					}(r, r), N(r, r, a), N(r, r, u), N(r, r, u), N(e[0], r, u), I(i, e[0]), N(i, i, u), A(i, a) && N(e[0], e[0], f), I(i, e[0]), N(i, i, u), A(i, a) ? -1 : (O(e[0]) === n[31] >> 7 && W(e[0], s, e[0]), N(e[3], e[0], e[1]), 0)
				}

				function ue(e, n, r, i) {
					var a, s = new Uint8Array(32), o = new Uint8Array(64), u = [t(), t(), t(), t()],
						d = [t(), t(), t(), t()];
					if (-1, r < 64) return -1;
					if (oe(d, i)) return -1;
					for (a = 0; a < r; a++) e[a] = n[a];
					for (a = 0; a < 32; a++) e[a + 32] = i[a];
					if (K(o, e, r), ae(o), ee(u, d, o), te(d, n.subarray(32)), X(u, d), Q(s, u), r -= 64, y(n, 0, s, 0)) {
						for (a = 0; a < r; a++) e[a] = 0;
						return -1
					}
					for (a = 0; a < r; a++) e[a] = n[a + 64];
					return r
				}

				var de = 32, le = 24, ce = 32, he = 32, fe = le;

				function _e(e, t) {
					if (e.length !== de) throw new Error("bad key size");
					if (t.length !== le) throw new Error("bad nonce size")
				}

				function pe() {
					for (var e = 0; e < arguments.length; e++) if (!(arguments[e] instanceof Uint8Array)) throw new TypeError("unexpected type, use Uint8Array")
				}

				function me(e) {
					for (var t = 0; t < e.length; t++) e[t] = 0
				}

				e.lowlevel = {
					crypto_core_hsalsa20: v,
					crypto_stream_xor: Y,
					crypto_stream: b,
					crypto_stream_salsa20_xor: L,
					crypto_stream_salsa20: w,
					crypto_onetimeauth: T,
					crypto_onetimeauth_verify: D,
					crypto_verify_16: m,
					crypto_verify_32: y,
					crypto_secretbox: S,
					crypto_secretbox_open: x,
					crypto_scalarmult: z,
					crypto_scalarmult_base: $,
					crypto_box_beforenm: B,
					crypto_box_afternm: q,
					crypto_box: function (e, t, n, r, i, a) {
						var s = new Uint8Array(32);
						return B(s, i, a), q(e, t, n, r, s)
					},
					crypto_box_open: function (e, t, n, r, i, a) {
						var s = new Uint8Array(32);
						return B(s, i, a), J(e, t, n, r, s)
					},
					crypto_box_keypair: U,
					crypto_hash: K,
					crypto_sign: se,
					crypto_sign_keypair: ne,
					crypto_sign_open: ue,
					crypto_secretbox_KEYBYTES: de,
					crypto_secretbox_NONCEBYTES: le,
					crypto_secretbox_ZEROBYTES: 32,
					crypto_secretbox_BOXZEROBYTES: 16,
					crypto_scalarmult_BYTES: 32,
					crypto_scalarmult_SCALARBYTES: 32,
					crypto_box_PUBLICKEYBYTES: ce,
					crypto_box_SECRETKEYBYTES: he,
					crypto_box_BEFORENMBYTES: 32,
					crypto_box_NONCEBYTES: fe,
					crypto_box_ZEROBYTES: 32,
					crypto_box_BOXZEROBYTES: 16,
					crypto_sign_BYTES: 64,
					crypto_sign_PUBLICKEYBYTES: 32,
					crypto_sign_SECRETKEYBYTES: 64,
					crypto_sign_SEEDBYTES: 32,
					crypto_hash_BYTES: 64
				}, e.randomBytes = function (e) {
					var t = new Uint8Array(e);
					return r(t, e), t
				}, e.secretbox = function (e, t, n) {
					pe(e, t, n), _e(n, t);
					for (var r = new Uint8Array(32 + e.length), i = new Uint8Array(r.length), a = 0; a < e.length; a++) r[a + 32] = e[a];
					return S(i, r, r.length, t, n), i.subarray(16)
				}, e.secretbox.open = function (e, t, n) {
					pe(e, t, n), _e(n, t);
					for (var r = new Uint8Array(16 + e.length), i = new Uint8Array(r.length), a = 0; a < e.length; a++) r[a + 16] = e[a];
					return r.length < 32 ? null : 0 !== x(i, r, r.length, t, n) ? null : i.subarray(32)
				}, e.secretbox.keyLength = de, e.secretbox.nonceLength = le, e.secretbox.overheadLength = 16, e.scalarMult = function (e, t) {
					if (pe(e, t), 32 !== e.length) throw new Error("bad n size");
					if (32 !== t.length) throw new Error("bad p size");
					var n = new Uint8Array(32);
					return z(n, e, t), n
				}, e.scalarMult.base = function (e) {
					if (pe(e), 32 !== e.length) throw new Error("bad n size");
					var t = new Uint8Array(32);
					return $(t, e), t
				}, e.scalarMult.scalarLength = 32, e.scalarMult.groupElementLength = 32, e.box = function (t, n, r, i) {
					var a = e.box.before(r, i);
					return e.secretbox(t, n, a)
				}, e.box.before = function (e, t) {
					pe(e, t), function (e, t) {
						if (e.length !== ce) throw new Error("bad public key size");
						if (t.length !== he) throw new Error("bad secret key size")
					}(e, t);
					var n = new Uint8Array(32);
					return B(n, e, t), n
				}, e.box.after = e.secretbox, e.box.open = function (t, n, r, i) {
					var a = e.box.before(r, i);
					return e.secretbox.open(t, n, a)
				}, e.box.open.after = e.secretbox.open, e.box.keyPair = function () {
					var e = new Uint8Array(ce), t = new Uint8Array(he);
					return U(e, t), {publicKey: e, secretKey: t}
				}, e.box.keyPair.fromSecretKey = function (e) {
					if (pe(e), e.length !== he) throw new Error("bad secret key size");
					var t = new Uint8Array(ce);
					return $(t, e), {publicKey: t, secretKey: new Uint8Array(e)}
				}, e.box.publicKeyLength = ce, e.box.secretKeyLength = he, e.box.sharedKeyLength = 32, e.box.nonceLength = fe, e.box.overheadLength = e.secretbox.overheadLength, e.sign = function (e, t) {
					if (pe(e, t), 64 !== t.length) throw new Error("bad secret key size");
					var n = new Uint8Array(64 + e.length);
					return se(n, e, e.length, t), n
				}, e.sign.open = function (e, t) {
					if (pe(e, t), 32 !== t.length) throw new Error("bad public key size");
					var n = new Uint8Array(e.length), r = ue(n, e, e.length, t);
					if (r < 0) return null;
					for (var i = new Uint8Array(r), a = 0; a < i.length; a++) i[a] = n[a];
					return i
				}, e.sign.detached = function (t, n) {
					for (var r = e.sign(t, n), i = new Uint8Array(64), a = 0; a < i.length; a++) i[a] = r[a];
					return i
				}, e.sign.detached.verify = function (e, t, n) {
					if (pe(e, t, n), 64 !== t.length) throw new Error("bad signature size");
					if (32 !== n.length) throw new Error("bad public key size");
					var r, i = new Uint8Array(64 + e.length), a = new Uint8Array(64 + e.length);
					for (r = 0; r < 64; r++) i[r] = t[r];
					for (r = 0; r < e.length; r++) i[r + 64] = e[r];
					return ue(a, i, i.length, n) >= 0
				}, e.sign.keyPair = function () {
					var e = new Uint8Array(32), t = new Uint8Array(64);
					return ne(e, t), {publicKey: e, secretKey: t}
				}, e.sign.keyPair.fromSecretKey = function (e) {
					if (pe(e), 64 !== e.length) throw new Error("bad secret key size");
					for (var t = new Uint8Array(32), n = 0; n < t.length; n++) t[n] = e[32 + n];
					return {publicKey: t, secretKey: new Uint8Array(e)}
				}, e.sign.keyPair.fromSeed = function (e) {
					if (pe(e), 32 !== e.length) throw new Error("bad seed size");
					for (var t = new Uint8Array(32), n = new Uint8Array(64), r = 0; r < 32; r++) n[r] = e[r];
					return ne(t, n, !0), {publicKey: t, secretKey: n}
				}, e.sign.publicKeyLength = 32, e.sign.secretKeyLength = 64, e.sign.seedLength = 32, e.sign.signatureLength = 64, e.hash = function (e) {
					pe(e);
					var t = new Uint8Array(64);
					return K(t, e, e.length), t
				}, e.hash.hashLength = 64, e.verify = function (e, t) {
					return pe(e, t), 0 !== e.length && 0 !== t.length && (e.length === t.length && 0 === p(e, 0, t, 0, e.length))
				}, e.setPRNG = function (e) {
					r = e
				}, function () {
					var t = "undefined" != typeof self ? self.crypto || self.msCrypto : null;
					if (t && t.getRandomValues) {
						e.setPRNG(function (e, n) {
							var r, i = new Uint8Array(n);
							for (r = 0; r < n; r += 65536) t.getRandomValues(i.subarray(r, r + Math.min(n - r, 65536)));
							for (r = 0; r < n; r++) e[r] = i[r];
							me(i)
						})
					} else (t = n(56)) && t.randomBytes && e.setPRNG(function (e, n) {
						var r, i = t.randomBytes(n);
						for (r = 0; r < n; r++) e[r] = i[r];
						me(i)
					})
				}()
			}(void 0 !== e && e.exports ? e.exports : self.nacl = self.nacl || {})
		}, function (e, t) {
		}, function (e, t, n) {
			(function (t) {
				!function (t, n) {
					"use strict";
					void 0 !== e && e.exports ? e.exports = n() : t.nacl ? t.nacl.util = n() : (t.nacl = {}, t.nacl.util = n())
				}(this, function () {
					"use strict";
					var e = {};

					function n(e) {
						if (!/^(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=)?$/.test(e)) throw new TypeError("invalid encoding")
					}

					return e.decodeUTF8 = function (e) {
						if ("string" != typeof e) throw new TypeError("expected string");
						var t, n = unescape(encodeURIComponent(e)), r = new Uint8Array(n.length);
						for (t = 0; t < n.length; t++) r[t] = n.charCodeAt(t);
						return r
					}, e.encodeUTF8 = function (e) {
						var t, n = [];
						for (t = 0; t < e.length; t++) n.push(String.fromCharCode(e[t]));
						return decodeURIComponent(escape(n.join("")))
					}, "undefined" == typeof atob ? void 0 !== t.from ? (e.encodeBase64 = function (e) {
						return t.from(e).toString("base64")
					}, e.decodeBase64 = function (e) {
						return n(e), new Uint8Array(Array.prototype.slice.call(t.from(e, "base64"), 0))
					}) : (e.encodeBase64 = function (e) {
						return new t(e).toString("base64")
					}, e.decodeBase64 = function (e) {
						return n(e), new Uint8Array(Array.prototype.slice.call(new t(e, "base64"), 0))
					}) : (e.encodeBase64 = function (e) {
						var t, n = [], r = e.length;
						for (t = 0; t < r; t++) n.push(String.fromCharCode(e[t]));
						return btoa(n.join(""))
					}, e.decodeBase64 = function (e) {
						n(e);
						var t, r = atob(e), i = new Uint8Array(r.length);
						for (t = 0; t < r.length; t++) i[t] = r.charCodeAt(t);
						return i
					}), e
				})
			}).call(t, n(58).Buffer)
		}, function (e, t, n) {
			"use strict";
			var r = n(59), i = n(60), a = n(61);

			function s() {
				return u.TYPED_ARRAY_SUPPORT ? 2147483647 : 1073741823
			}

			function o(e, t) {
				if (s() < t) throw new RangeError("Invalid typed array length");
				return u.TYPED_ARRAY_SUPPORT ? (e = new Uint8Array(t)).__proto__ = u.prototype : (null === e && (e = new u(t)), e.length = t), e
			}

			function u(e, t, n) {
				if (!(u.TYPED_ARRAY_SUPPORT || this instanceof u)) return new u(e, t, n);
				if ("number" == typeof e) {
					if ("string" == typeof t) throw new Error("If encoding is specified then the first argument must be a string");
					return c(this, e)
				}
				return d(this, e, t, n)
			}

			function d(e, t, n, r) {
				if ("number" == typeof t) throw new TypeError('"value" argument must not be a number');
				return "undefined" != typeof ArrayBuffer && t instanceof ArrayBuffer ? function (e, t, n, r) {
					if (t.byteLength, n < 0 || t.byteLength < n) throw new RangeError("'offset' is out of bounds");
					if (t.byteLength < n + (r || 0)) throw new RangeError("'length' is out of bounds");
					t = void 0 === n && void 0 === r ? new Uint8Array(t) : void 0 === r ? new Uint8Array(t, n) : new Uint8Array(t, n, r);
					u.TYPED_ARRAY_SUPPORT ? (e = t).__proto__ = u.prototype : e = h(e, t);
					return e
				}(e, t, n, r) : "string" == typeof t ? function (e, t, n) {
					"string" == typeof n && "" !== n || (n = "utf8");
					if (!u.isEncoding(n)) throw new TypeError('"encoding" must be a valid string encoding');
					var r = 0 | _(t, n), i = (e = o(e, r)).write(t, n);
					i !== r && (e = e.slice(0, i));
					return e
				}(e, t, n) : function (e, t) {
					if (u.isBuffer(t)) {
						var n = 0 | f(t.length);
						return 0 === (e = o(e, n)).length ? e : (t.copy(e, 0, 0, n), e)
					}
					if (t) {
						if ("undefined" != typeof ArrayBuffer && t.buffer instanceof ArrayBuffer || "length" in t) return "number" != typeof t.length || (r = t.length) != r ? o(e, 0) : h(e, t);
						if ("Buffer" === t.type && a(t.data)) return h(e, t.data)
					}
					var r;
					throw new TypeError("First argument must be a string, Buffer, ArrayBuffer, Array, or array-like object.")
				}(e, t)
			}

			function l(e) {
				if ("number" != typeof e) throw new TypeError('"size" argument must be a number');
				if (e < 0) throw new RangeError('"size" argument must not be negative')
			}

			function c(e, t) {
				if (l(t), e = o(e, t < 0 ? 0 : 0 | f(t)), !u.TYPED_ARRAY_SUPPORT) for (var n = 0; n < t; ++n) e[n] = 0;
				return e
			}

			function h(e, t) {
				var n = t.length < 0 ? 0 : 0 | f(t.length);
				e = o(e, n);
				for (var r = 0; r < n; r += 1) e[r] = 255 & t[r];
				return e
			}

			function f(e) {
				if (e >= s()) throw new RangeError("Attempt to allocate Buffer larger than maximum size: 0x" + s().toString(16) + " bytes");
				return 0 | e
			}

			function _(e, t) {
				if (u.isBuffer(e)) return e.length;
				if ("undefined" != typeof ArrayBuffer && "function" == typeof ArrayBuffer.isView && (ArrayBuffer.isView(e) || e instanceof ArrayBuffer)) return e.byteLength;
				"string" != typeof e && (e = "" + e);
				var n = e.length;
				if (0 === n) return 0;
				for (var r = !1; ;) switch (t) {
					case"ascii":
					case"latin1":
					case"binary":
						return n;
					case"utf8":
					case"utf-8":
					case void 0:
						return I(e).length;
					case"ucs2":
					case"ucs-2":
					case"utf16le":
					case"utf-16le":
						return 2 * n;
					case"hex":
						return n >>> 1;
					case"base64":
						return F(e).length;
					default:
						if (r) return I(e).length;
						t = ("" + t).toLowerCase(), r = !0
				}
			}

			function p(e, t, n) {
				var r = e[t];
				e[t] = e[n], e[n] = r
			}

			function m(e, t, n, r, i) {
				if (0 === e.length) return -1;
				if ("string" == typeof n ? (r = n, n = 0) : n > 2147483647 ? n = 2147483647 : n < -2147483648 && (n = -2147483648), n = +n, isNaN(n) && (n = i ? 0 : e.length - 1), n < 0 && (n = e.length + n), n >= e.length) {
					if (i) return -1;
					n = e.length - 1
				} else if (n < 0) {
					if (!i) return -1;
					n = 0
				}
				if ("string" == typeof t && (t = u.from(t, r)), u.isBuffer(t)) return 0 === t.length ? -1 : y(e, t, n, r, i);
				if ("number" == typeof t) return t &= 255, u.TYPED_ARRAY_SUPPORT && "function" == typeof Uint8Array.prototype.indexOf ? i ? Uint8Array.prototype.indexOf.call(e, t, n) : Uint8Array.prototype.lastIndexOf.call(e, t, n) : y(e, [t], n, r, i);
				throw new TypeError("val must be string, number or Buffer")
			}

			function y(e, t, n, r, i) {
				var a, s = 1, o = e.length, u = t.length;
				if (void 0 !== r && ("ucs2" === (r = String(r).toLowerCase()) || "ucs-2" === r || "utf16le" === r || "utf-16le" === r)) {
					if (e.length < 2 || t.length < 2) return -1;
					s = 2, o /= 2, u /= 2, n /= 2
				}

				function d(e, t) {
					return 1 === s ? e[t] : e.readUInt16BE(t * s)
				}

				if (i) {
					var l = -1;
					for (a = n; a < o; a++) if (d(e, a) === d(t, -1 === l ? 0 : a - l)) {
						if (-1 === l && (l = a), a - l + 1 === u) return l * s
					} else -1 !== l && (a -= a - l), l = -1
				} else for (n + u > o && (n = o - u), a = n; a >= 0; a--) {
					for (var c = !0, h = 0; h < u; h++) if (d(e, a + h) !== d(t, h)) {
						c = !1;
						break
					}
					if (c) return a
				}
				return -1
			}

			function g(e, t, n, r) {
				n = Number(n) || 0;
				var i = e.length - n;
				r ? (r = Number(r)) > i && (r = i) : r = i;
				var a = t.length;
				if (a % 2 != 0) throw new TypeError("Invalid hex string");
				r > a / 2 && (r = a / 2);
				for (var s = 0; s < r; ++s) {
					var o = parseInt(t.substr(2 * s, 2), 16);
					if (isNaN(o)) return s;
					e[n + s] = o
				}
				return s
			}

			function v(e, t, n, r) {
				return z(I(t, e.length - n), e, n, r)
			}

			function M(e, t, n, r) {
				return z(function (e) {
					for (var t = [], n = 0; n < e.length; ++n) t.push(255 & e.charCodeAt(n));
					return t
				}(t), e, n, r)
			}

			function L(e, t, n, r) {
				return M(e, t, n, r)
			}

			function w(e, t, n, r) {
				return z(F(t), e, n, r)
			}

			function b(e, t, n, r) {
				return z(function (e, t) {
					for (var n, r, i, a = [], s = 0; s < e.length && !((t -= 2) < 0); ++s) n = e.charCodeAt(s), r = n >> 8, i = n % 256, a.push(i), a.push(r);
					return a
				}(t, e.length - n), e, n, r)
			}

			function Y(e, t, n) {
				return 0 === t && n === e.length ? r.fromByteArray(e) : r.fromByteArray(e.slice(t, n))
			}

			function k(e, t, n) {
				n = Math.min(e.length, n);
				for (var r = [], i = t; i < n;) {
					var a, s, o, u, d = e[i], l = null, c = d > 239 ? 4 : d > 223 ? 3 : d > 191 ? 2 : 1;
					if (i + c <= n) switch (c) {
						case 1:
							d < 128 && (l = d);
							break;
						case 2:
							128 == (192 & (a = e[i + 1])) && (u = (31 & d) << 6 | 63 & a) > 127 && (l = u);
							break;
						case 3:
							a = e[i + 1], s = e[i + 2], 128 == (192 & a) && 128 == (192 & s) && (u = (15 & d) << 12 | (63 & a) << 6 | 63 & s) > 2047 && (u < 55296 || u > 57343) && (l = u);
							break;
						case 4:
							a = e[i + 1], s = e[i + 2], o = e[i + 3], 128 == (192 & a) && 128 == (192 & s) && 128 == (192 & o) && (u = (15 & d) << 18 | (63 & a) << 12 | (63 & s) << 6 | 63 & o) > 65535 && u < 1114112 && (l = u)
					}
					null === l ? (l = 65533, c = 1) : l > 65535 && (l -= 65536, r.push(l >>> 10 & 1023 | 55296), l = 56320 | 1023 & l), r.push(l), i += c
				}
				return function (e) {
					var t = e.length;
					if (t <= T) return String.fromCharCode.apply(String, e);
					var n = "", r = 0;
					for (; r < t;) n += String.fromCharCode.apply(String, e.slice(r, r += T));
					return n
				}(r)
			}

			t.Buffer = u, t.SlowBuffer = function (e) {
				+e != e && (e = 0);
				return u.alloc(+e)
			}, t.INSPECT_MAX_BYTES = 50, u.TYPED_ARRAY_SUPPORT = void 0 !== window.TYPED_ARRAY_SUPPORT ? window.TYPED_ARRAY_SUPPORT : function () {
				try {
					var e = new Uint8Array(1);
					return e.__proto__ = {
						__proto__: Uint8Array.prototype, foo: function () {
							return 42
						}
					}, 42 === e.foo() && "function" == typeof e.subarray && 0 === e.subarray(1, 1).byteLength
				} catch (e) {
					return !1
				}
			}(), t.kMaxLength = s(), u.poolSize = 8192, u._augment = function (e) {
				return e.__proto__ = u.prototype, e
			}, u.from = function (e, t, n) {
				return d(null, e, t, n)
			}, u.TYPED_ARRAY_SUPPORT && (u.prototype.__proto__ = Uint8Array.prototype, u.__proto__ = Uint8Array, "undefined" != typeof Symbol && Symbol.species && u[Symbol.species] === u && Object.defineProperty(u, Symbol.species, {
				value: null,
				configurable: !0
			})), u.alloc = function (e, t, n) {
				return function (e, t, n, r) {
					return l(t), t <= 0 ? o(e, t) : void 0 !== n ? "string" == typeof r ? o(e, t).fill(n, r) : o(e, t).fill(n) : o(e, t)
				}(null, e, t, n)
			}, u.allocUnsafe = function (e) {
				return c(null, e)
			}, u.allocUnsafeSlow = function (e) {
				return c(null, e)
			}, u.isBuffer = function (e) {
				return !(null == e || !e._isBuffer)
			}, u.compare = function (e, t) {
				if (!u.isBuffer(e) || !u.isBuffer(t)) throw new TypeError("Arguments must be Buffers");
				if (e === t) return 0;
				for (var n = e.length, r = t.length, i = 0, a = Math.min(n, r); i < a; ++i) if (e[i] !== t[i]) {
					n = e[i], r = t[i];
					break
				}
				return n < r ? -1 : r < n ? 1 : 0
			}, u.isEncoding = function (e) {
				switch (String(e).toLowerCase()) {
					case"hex":
					case"utf8":
					case"utf-8":
					case"ascii":
					case"latin1":
					case"binary":
					case"base64":
					case"ucs2":
					case"ucs-2":
					case"utf16le":
					case"utf-16le":
						return !0;
					default:
						return !1
				}
			}, u.concat = function (e, t) {
				if (!a(e)) throw new TypeError('"list" argument must be an Array of Buffers');
				if (0 === e.length) return u.alloc(0);
				var n;
				if (void 0 === t) for (t = 0, n = 0; n < e.length; ++n) t += e[n].length;
				var r = u.allocUnsafe(t), i = 0;
				for (n = 0; n < e.length; ++n) {
					var s = e[n];
					if (!u.isBuffer(s)) throw new TypeError('"list" argument must be an Array of Buffers');
					s.copy(r, i), i += s.length
				}
				return r
			}, u.byteLength = _, u.prototype._isBuffer = !0, u.prototype.swap16 = function () {
				var e = this.length;
				if (e % 2 != 0) throw new RangeError("Buffer size must be a multiple of 16-bits");
				for (var t = 0; t < e; t += 2) p(this, t, t + 1);
				return this
			}, u.prototype.swap32 = function () {
				var e = this.length;
				if (e % 4 != 0) throw new RangeError("Buffer size must be a multiple of 32-bits");
				for (var t = 0; t < e; t += 4) p(this, t, t + 3), p(this, t + 1, t + 2);
				return this
			}, u.prototype.swap64 = function () {
				var e = this.length;
				if (e % 8 != 0) throw new RangeError("Buffer size must be a multiple of 64-bits");
				for (var t = 0; t < e; t += 8) p(this, t, t + 7), p(this, t + 1, t + 6), p(this, t + 2, t + 5), p(this, t + 3, t + 4);
				return this
			}, u.prototype.toString = function () {
				var e = 0 | this.length;
				return 0 === e ? "" : 0 === arguments.length ? k(this, 0, e) : function (e, t, n) {
					var r = !1;
					if ((void 0 === t || t < 0) && (t = 0), t > this.length) return "";
					if ((void 0 === n || n > this.length) && (n = this.length), n <= 0) return "";
					if ((n >>>= 0) <= (t >>>= 0)) return "";
					for (e || (e = "utf8"); ;) switch (e) {
						case"hex":
							return x(this, t, n);
						case"utf8":
						case"utf-8":
							return k(this, t, n);
						case"ascii":
							return D(this, t, n);
						case"latin1":
						case"binary":
							return S(this, t, n);
						case"base64":
							return Y(this, t, n);
						case"ucs2":
						case"ucs-2":
						case"utf16le":
						case"utf-16le":
							return j(this, t, n);
						default:
							if (r) throw new TypeError("Unknown encoding: " + e);
							e = (e + "").toLowerCase(), r = !0
					}
				}.apply(this, arguments)
			}, u.prototype.equals = function (e) {
				if (!u.isBuffer(e)) throw new TypeError("Argument must be a Buffer");
				return this === e || 0 === u.compare(this, e)
			}, u.prototype.inspect = function () {
				var e = "", n = t.INSPECT_MAX_BYTES;
				return this.length > 0 && (e = this.toString("hex", 0, n).match(/.{2}/g).join(" "), this.length > n && (e += " ... ")), "<Buffer " + e + ">"
			}, u.prototype.compare = function (e, t, n, r, i) {
				if (!u.isBuffer(e)) throw new TypeError("Argument must be a Buffer");
				if (void 0 === t && (t = 0), void 0 === n && (n = e ? e.length : 0), void 0 === r && (r = 0), void 0 === i && (i = this.length), t < 0 || n > e.length || r < 0 || i > this.length) throw new RangeError("out of range index");
				if (r >= i && t >= n) return 0;
				if (r >= i) return -1;
				if (t >= n) return 1;
				if (t >>>= 0, n >>>= 0, r >>>= 0, i >>>= 0, this === e) return 0;
				for (var a = i - r, s = n - t, o = Math.min(a, s), d = this.slice(r, i), l = e.slice(t, n), c = 0; c < o; ++c) if (d[c] !== l[c]) {
					a = d[c], s = l[c];
					break
				}
				return a < s ? -1 : s < a ? 1 : 0
			}, u.prototype.includes = function (e, t, n) {
				return -1 !== this.indexOf(e, t, n)
			}, u.prototype.indexOf = function (e, t, n) {
				return m(this, e, t, n, !0)
			}, u.prototype.lastIndexOf = function (e, t, n) {
				return m(this, e, t, n, !1)
			}, u.prototype.write = function (e, t, n, r) {
				if (void 0 === t) r = "utf8", n = this.length, t = 0; else if (void 0 === n && "string" == typeof t) r = t, n = this.length, t = 0; else {
					if (!isFinite(t)) throw new Error("Buffer.write(string, encoding, offset[, length]) is no longer supported");
					t |= 0, isFinite(n) ? (n |= 0, void 0 === r && (r = "utf8")) : (r = n, n = void 0)
				}
				var i = this.length - t;
				if ((void 0 === n || n > i) && (n = i), e.length > 0 && (n < 0 || t < 0) || t > this.length) throw new RangeError("Attempt to write outside buffer bounds");
				r || (r = "utf8");
				for (var a = !1; ;) switch (r) {
					case"hex":
						return g(this, e, t, n);
					case"utf8":
					case"utf-8":
						return v(this, e, t, n);
					case"ascii":
						return M(this, e, t, n);
					case"latin1":
					case"binary":
						return L(this, e, t, n);
					case"base64":
						return w(this, e, t, n);
					case"ucs2":
					case"ucs-2":
					case"utf16le":
					case"utf-16le":
						return b(this, e, t, n);
					default:
						if (a) throw new TypeError("Unknown encoding: " + r);
						r = ("" + r).toLowerCase(), a = !0
				}
			}, u.prototype.toJSON = function () {
				return {type: "Buffer", data: Array.prototype.slice.call(this._arr || this, 0)}
			};
			var T = 4096;

			function D(e, t, n) {
				var r = "";
				n = Math.min(e.length, n);
				for (var i = t; i < n; ++i) r += String.fromCharCode(127 & e[i]);
				return r
			}

			function S(e, t, n) {
				var r = "";
				n = Math.min(e.length, n);
				for (var i = t; i < n; ++i) r += String.fromCharCode(e[i]);
				return r
			}

			function x(e, t, n) {
				var r = e.length;
				(!t || t < 0) && (t = 0), (!n || n < 0 || n > r) && (n = r);
				for (var i = "", a = t; a < n; ++a) i += N(e[a]);
				return i
			}

			function j(e, t, n) {
				for (var r = e.slice(t, n), i = "", a = 0; a < r.length; a += 2) i += String.fromCharCode(r[a] + 256 * r[a + 1]);
				return i
			}

			function H(e, t, n) {
				if (e % 1 != 0 || e < 0) throw new RangeError("offset is not uint");
				if (e + t > n) throw new RangeError("Trying to access beyond buffer length")
			}

			function E(e, t, n, r, i, a) {
				if (!u.isBuffer(e)) throw new TypeError('"buffer" argument must be a Buffer instance');
				if (t > i || t < a) throw new RangeError('"value" argument is out of bounds');
				if (n + r > e.length) throw new RangeError("Index out of range")
			}

			function C(e, t, n, r) {
				t < 0 && (t = 65535 + t + 1);
				for (var i = 0, a = Math.min(e.length - n, 2); i < a; ++i) e[n + i] = (t & 255 << 8 * (r ? i : 1 - i)) >>> 8 * (r ? i : 1 - i)
			}

			function A(e, t, n, r) {
				t < 0 && (t = 4294967295 + t + 1);
				for (var i = 0, a = Math.min(e.length - n, 4); i < a; ++i) e[n + i] = t >>> 8 * (r ? i : 3 - i) & 255
			}

			function O(e, t, n, r, i, a) {
				if (n + r > e.length) throw new RangeError("Index out of range");
				if (n < 0) throw new RangeError("Index out of range")
			}

			function P(e, t, n, r, a) {
				return a || O(e, 0, n, 4), i.write(e, t, n, r, 23, 4), n + 4
			}

			function R(e, t, n, r, a) {
				return a || O(e, 0, n, 8), i.write(e, t, n, r, 52, 8), n + 8
			}

			u.prototype.slice = function (e, t) {
				var n, r = this.length;
				if (e = ~~e, t = void 0 === t ? r : ~~t, e < 0 ? (e += r) < 0 && (e = 0) : e > r && (e = r), t < 0 ? (t += r) < 0 && (t = 0) : t > r && (t = r), t < e && (t = e), u.TYPED_ARRAY_SUPPORT) (n = this.subarray(e, t)).__proto__ = u.prototype; else {
					var i = t - e;
					n = new u(i, void 0);
					for (var a = 0; a < i; ++a) n[a] = this[a + e]
				}
				return n
			}, u.prototype.readUIntLE = function (e, t, n) {
				e |= 0, t |= 0, n || H(e, t, this.length);
				for (var r = this[e], i = 1, a = 0; ++a < t && (i *= 256);) r += this[e + a] * i;
				return r
			}, u.prototype.readUIntBE = function (e, t, n) {
				e |= 0, t |= 0, n || H(e, t, this.length);
				for (var r = this[e + --t], i = 1; t > 0 && (i *= 256);) r += this[e + --t] * i;
				return r
			}, u.prototype.readUInt8 = function (e, t) {
				return t || H(e, 1, this.length), this[e]
			}, u.prototype.readUInt16LE = function (e, t) {
				return t || H(e, 2, this.length), this[e] | this[e + 1] << 8
			}, u.prototype.readUInt16BE = function (e, t) {
				return t || H(e, 2, this.length), this[e] << 8 | this[e + 1]
			}, u.prototype.readUInt32LE = function (e, t) {
				return t || H(e, 4, this.length), (this[e] | this[e + 1] << 8 | this[e + 2] << 16) + 16777216 * this[e + 3]
			}, u.prototype.readUInt32BE = function (e, t) {
				return t || H(e, 4, this.length), 16777216 * this[e] + (this[e + 1] << 16 | this[e + 2] << 8 | this[e + 3])
			}, u.prototype.readIntLE = function (e, t, n) {
				e |= 0, t |= 0, n || H(e, t, this.length);
				for (var r = this[e], i = 1, a = 0; ++a < t && (i *= 256);) r += this[e + a] * i;
				return r >= (i *= 128) && (r -= Math.pow(2, 8 * t)), r
			}, u.prototype.readIntBE = function (e, t, n) {
				e |= 0, t |= 0, n || H(e, t, this.length);
				for (var r = t, i = 1, a = this[e + --r]; r > 0 && (i *= 256);) a += this[e + --r] * i;
				return a >= (i *= 128) && (a -= Math.pow(2, 8 * t)), a
			}, u.prototype.readInt8 = function (e, t) {
				return t || H(e, 1, this.length), 128 & this[e] ? -1 * (255 - this[e] + 1) : this[e]
			}, u.prototype.readInt16LE = function (e, t) {
				t || H(e, 2, this.length);
				var n = this[e] | this[e + 1] << 8;
				return 32768 & n ? 4294901760 | n : n
			}, u.prototype.readInt16BE = function (e, t) {
				t || H(e, 2, this.length);
				var n = this[e + 1] | this[e] << 8;
				return 32768 & n ? 4294901760 | n : n
			}, u.prototype.readInt32LE = function (e, t) {
				return t || H(e, 4, this.length), this[e] | this[e + 1] << 8 | this[e + 2] << 16 | this[e + 3] << 24
			}, u.prototype.readInt32BE = function (e, t) {
				return t || H(e, 4, this.length), this[e] << 24 | this[e + 1] << 16 | this[e + 2] << 8 | this[e + 3]
			}, u.prototype.readFloatLE = function (e, t) {
				return t || H(e, 4, this.length), i.read(this, e, !0, 23, 4)
			}, u.prototype.readFloatBE = function (e, t) {
				return t || H(e, 4, this.length), i.read(this, e, !1, 23, 4)
			}, u.prototype.readDoubleLE = function (e, t) {
				return t || H(e, 8, this.length), i.read(this, e, !0, 52, 8)
			}, u.prototype.readDoubleBE = function (e, t) {
				return t || H(e, 8, this.length), i.read(this, e, !1, 52, 8)
			}, u.prototype.writeUIntLE = function (e, t, n, r) {
				(e = +e, t |= 0, n |= 0, r) || E(this, e, t, n, Math.pow(2, 8 * n) - 1, 0);
				var i = 1, a = 0;
				for (this[t] = 255 & e; ++a < n && (i *= 256);) this[t + a] = e / i & 255;
				return t + n
			}, u.prototype.writeUIntBE = function (e, t, n, r) {
				(e = +e, t |= 0, n |= 0, r) || E(this, e, t, n, Math.pow(2, 8 * n) - 1, 0);
				var i = n - 1, a = 1;
				for (this[t + i] = 255 & e; --i >= 0 && (a *= 256);) this[t + i] = e / a & 255;
				return t + n
			}, u.prototype.writeUInt8 = function (e, t, n) {
				return e = +e, t |= 0, n || E(this, e, t, 1, 255, 0), u.TYPED_ARRAY_SUPPORT || (e = Math.floor(e)), this[t] = 255 & e, t + 1
			}, u.prototype.writeUInt16LE = function (e, t, n) {
				return e = +e, t |= 0, n || E(this, e, t, 2, 65535, 0), u.TYPED_ARRAY_SUPPORT ? (this[t] = 255 & e, this[t + 1] = e >>> 8) : C(this, e, t, !0), t + 2
			}, u.prototype.writeUInt16BE = function (e, t, n) {
				return e = +e, t |= 0, n || E(this, e, t, 2, 65535, 0), u.TYPED_ARRAY_SUPPORT ? (this[t] = e >>> 8, this[t + 1] = 255 & e) : C(this, e, t, !1), t + 2
			}, u.prototype.writeUInt32LE = function (e, t, n) {
				return e = +e, t |= 0, n || E(this, e, t, 4, 4294967295, 0), u.TYPED_ARRAY_SUPPORT ? (this[t + 3] = e >>> 24, this[t + 2] = e >>> 16, this[t + 1] = e >>> 8, this[t] = 255 & e) : A(this, e, t, !0), t + 4
			}, u.prototype.writeUInt32BE = function (e, t, n) {
				return e = +e, t |= 0, n || E(this, e, t, 4, 4294967295, 0), u.TYPED_ARRAY_SUPPORT ? (this[t] = e >>> 24, this[t + 1] = e >>> 16, this[t + 2] = e >>> 8, this[t + 3] = 255 & e) : A(this, e, t, !1), t + 4
			}, u.prototype.writeIntLE = function (e, t, n, r) {
				if (e = +e, t |= 0, !r) {
					var i = Math.pow(2, 8 * n - 1);
					E(this, e, t, n, i - 1, -i)
				}
				var a = 0, s = 1, o = 0;
				for (this[t] = 255 & e; ++a < n && (s *= 256);) e < 0 && 0 === o && 0 !== this[t + a - 1] && (o = 1), this[t + a] = (e / s >> 0) - o & 255;
				return t + n
			}, u.prototype.writeIntBE = function (e, t, n, r) {
				if (e = +e, t |= 0, !r) {
					var i = Math.pow(2, 8 * n - 1);
					E(this, e, t, n, i - 1, -i)
				}
				var a = n - 1, s = 1, o = 0;
				for (this[t + a] = 255 & e; --a >= 0 && (s *= 256);) e < 0 && 0 === o && 0 !== this[t + a + 1] && (o = 1), this[t + a] = (e / s >> 0) - o & 255;
				return t + n
			}, u.prototype.writeInt8 = function (e, t, n) {
				return e = +e, t |= 0, n || E(this, e, t, 1, 127, -128), u.TYPED_ARRAY_SUPPORT || (e = Math.floor(e)), e < 0 && (e = 255 + e + 1), this[t] = 255 & e, t + 1
			}, u.prototype.writeInt16LE = function (e, t, n) {
				return e = +e, t |= 0, n || E(this, e, t, 2, 32767, -32768), u.TYPED_ARRAY_SUPPORT ? (this[t] = 255 & e, this[t + 1] = e >>> 8) : C(this, e, t, !0), t + 2
			}, u.prototype.writeInt16BE = function (e, t, n) {
				return e = +e, t |= 0, n || E(this, e, t, 2, 32767, -32768), u.TYPED_ARRAY_SUPPORT ? (this[t] = e >>> 8, this[t + 1] = 255 & e) : C(this, e, t, !1), t + 2
			}, u.prototype.writeInt32LE = function (e, t, n) {
				return e = +e, t |= 0, n || E(this, e, t, 4, 2147483647, -2147483648), u.TYPED_ARRAY_SUPPORT ? (this[t] = 255 & e, this[t + 1] = e >>> 8, this[t + 2] = e >>> 16, this[t + 3] = e >>> 24) : A(this, e, t, !0), t + 4
			}, u.prototype.writeInt32BE = function (e, t, n) {
				return e = +e, t |= 0, n || E(this, e, t, 4, 2147483647, -2147483648), e < 0 && (e = 4294967295 + e + 1), u.TYPED_ARRAY_SUPPORT ? (this[t] = e >>> 24, this[t + 1] = e >>> 16, this[t + 2] = e >>> 8, this[t + 3] = 255 & e) : A(this, e, t, !1), t + 4
			}, u.prototype.writeFloatLE = function (e, t, n) {
				return P(this, e, t, !0, n)
			}, u.prototype.writeFloatBE = function (e, t, n) {
				return P(this, e, t, !1, n)
			}, u.prototype.writeDoubleLE = function (e, t, n) {
				return R(this, e, t, !0, n)
			}, u.prototype.writeDoubleBE = function (e, t, n) {
				return R(this, e, t, !1, n)
			}, u.prototype.copy = function (e, t, n, r) {
				if (n || (n = 0), r || 0 === r || (r = this.length), t >= e.length && (t = e.length), t || (t = 0), r > 0 && r < n && (r = n), r === n) return 0;
				if (0 === e.length || 0 === this.length) return 0;
				if (t < 0) throw new RangeError("targetStart out of bounds");
				if (n < 0 || n >= this.length) throw new RangeError("sourceStart out of bounds");
				if (r < 0) throw new RangeError("sourceEnd out of bounds");
				r > this.length && (r = this.length), e.length - t < r - n && (r = e.length - t + n);
				var i, a = r - n;
				if (this === e && n < t && t < r) for (i = a - 1; i >= 0; --i) e[i + t] = this[i + n]; else if (a < 1e3 || !u.TYPED_ARRAY_SUPPORT) for (i = 0; i < a; ++i) e[i + t] = this[i + n]; else Uint8Array.prototype.set.call(e, this.subarray(n, n + a), t);
				return a
			}, u.prototype.fill = function (e, t, n, r) {
				if ("string" == typeof e) {
					if ("string" == typeof t ? (r = t, t = 0, n = this.length) : "string" == typeof n && (r = n, n = this.length), 1 === e.length) {
						var i = e.charCodeAt(0);
						i < 256 && (e = i)
					}
					if (void 0 !== r && "string" != typeof r) throw new TypeError("encoding must be a string");
					if ("string" == typeof r && !u.isEncoding(r)) throw new TypeError("Unknown encoding: " + r)
				} else "number" == typeof e && (e &= 255);
				if (t < 0 || this.length < t || this.length < n) throw new RangeError("Out of range index");
				if (n <= t) return this;
				var a;
				if (t >>>= 0, n = void 0 === n ? this.length : n >>> 0, e || (e = 0), "number" == typeof e) for (a = t; a < n; ++a) this[a] = e; else {
					var s = u.isBuffer(e) ? e : I(new u(e, r).toString()), o = s.length;
					for (a = 0; a < n - t; ++a) this[a + t] = s[a % o]
				}
				return this
			};
			var W = /[^+\/0-9A-Za-z-_]/g;

			function N(e) {
				return e < 16 ? "0" + e.toString(16) : e.toString(16)
			}

			function I(e, t) {
				var n;
				t = t || 1 / 0;
				for (var r = e.length, i = null, a = [], s = 0; s < r; ++s) {
					if ((n = e.charCodeAt(s)) > 55295 && n < 57344) {
						if (!i) {
							if (n > 56319) {
								(t -= 3) > -1 && a.push(239, 191, 189);
								continue
							}
							if (s + 1 === r) {
								(t -= 3) > -1 && a.push(239, 191, 189);
								continue
							}
							i = n;
							continue
						}
						if (n < 56320) {
							(t -= 3) > -1 && a.push(239, 191, 189), i = n;
							continue
						}
						n = 65536 + (i - 55296 << 10 | n - 56320)
					} else i && (t -= 3) > -1 && a.push(239, 191, 189);
					if (i = null, n < 128) {
						if ((t -= 1) < 0) break;
						a.push(n)
					} else if (n < 2048) {
						if ((t -= 2) < 0) break;
						a.push(n >> 6 | 192, 63 & n | 128)
					} else if (n < 65536) {
						if ((t -= 3) < 0) break;
						a.push(n >> 12 | 224, n >> 6 & 63 | 128, 63 & n | 128)
					} else {
						if (!(n < 1114112)) throw new Error("Invalid code point");
						if ((t -= 4) < 0) break;
						a.push(n >> 18 | 240, n >> 12 & 63 | 128, n >> 6 & 63 | 128, 63 & n | 128)
					}
				}
				return a
			}

			function F(e) {
				return r.toByteArray(function (e) {
					if ((e = function (e) {
						return e.trim ? e.trim() : e.replace(/^\s+|\s+$/g, "")
					}(e).replace(W, "")).length < 2) return "";
					for (; e.length % 4 != 0;) e += "=";
					return e
				}(e))
			}

			function z(e, t, n, r) {
				for (var i = 0; i < r && !(i + n >= t.length || i >= e.length); ++i) t[i + n] = e[i];
				return i
			}
		}, function (e, t) {
			"use strict";
			t.byteLength = function (e) {
				var t = u(e), n = t[0], r = t[1];
				return 3 * (n + r) / 4 - r
			}, t.toByteArray = function (e) {
				for (var t, n = u(e), a = n[0], s = n[1], o = new i(function (e, t, n) {
					return 3 * (t + n) / 4 - n
				}(0, a, s)), d = 0, l = s > 0 ? a - 4 : a, c = 0; c < l; c += 4) t = r[e.charCodeAt(c)] << 18 | r[e.charCodeAt(c + 1)] << 12 | r[e.charCodeAt(c + 2)] << 6 | r[e.charCodeAt(c + 3)], o[d++] = t >> 16 & 255, o[d++] = t >> 8 & 255, o[d++] = 255 & t;
				2 === s && (t = r[e.charCodeAt(c)] << 2 | r[e.charCodeAt(c + 1)] >> 4, o[d++] = 255 & t);
				1 === s && (t = r[e.charCodeAt(c)] << 10 | r[e.charCodeAt(c + 1)] << 4 | r[e.charCodeAt(c + 2)] >> 2, o[d++] = t >> 8 & 255, o[d++] = 255 & t);
				return o
			}, t.fromByteArray = function (e) {
				for (var t, r = e.length, i = r % 3, a = [], s = 0, o = r - i; s < o; s += 16383) a.push(d(e, s, s + 16383 > o ? o : s + 16383));
				1 === i ? (t = e[r - 1], a.push(n[t >> 2] + n[t << 4 & 63] + "==")) : 2 === i && (t = (e[r - 2] << 8) + e[r - 1], a.push(n[t >> 10] + n[t >> 4 & 63] + n[t << 2 & 63] + "="));
				return a.join("")
			};
			for (var n = [], r = [], i = "undefined" != typeof Uint8Array ? Uint8Array : Array, a = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", s = 0, o = a.length; s < o; ++s) n[s] = a[s], r[a.charCodeAt(s)] = s;

			function u(e) {
				var t = e.length;
				if (t % 4 > 0) throw new Error("Invalid string. Length must be a multiple of 4");
				var n = e.indexOf("=");
				return -1 === n && (n = t), [n, n === t ? 0 : 4 - n % 4]
			}

			function d(e, t, r) {
				for (var i, a, s = [], o = t; o < r; o += 3) i = (e[o] << 16 & 16711680) + (e[o + 1] << 8 & 65280) + (255 & e[o + 2]), s.push(n[(a = i) >> 18 & 63] + n[a >> 12 & 63] + n[a >> 6 & 63] + n[63 & a]);
				return s.join("")
			}

			r["-".charCodeAt(0)] = 62, r["_".charCodeAt(0)] = 63
		}, function (e, t) {
			t.read = function (e, t, n, r, i) {
				var a, s, o = 8 * i - r - 1, u = (1 << o) - 1, d = u >> 1, l = -7, c = n ? i - 1 : 0, h = n ? -1 : 1,
					f = e[t + c];
				for (c += h, a = f & (1 << -l) - 1, f >>= -l, l += o; l > 0; a = 256 * a + e[t + c], c += h, l -= 8) ;
				for (s = a & (1 << -l) - 1, a >>= -l, l += r; l > 0; s = 256 * s + e[t + c], c += h, l -= 8) ;
				if (0 === a) a = 1 - d; else {
					if (a === u) return s ? NaN : 1 / 0 * (f ? -1 : 1);
					s += Math.pow(2, r), a -= d
				}
				return (f ? -1 : 1) * s * Math.pow(2, a - r)
			}, t.write = function (e, t, n, r, i, a) {
				var s, o, u, d = 8 * a - i - 1, l = (1 << d) - 1, c = l >> 1,
					h = 23 === i ? Math.pow(2, -24) - Math.pow(2, -77) : 0, f = r ? 0 : a - 1, _ = r ? 1 : -1,
					p = t < 0 || 0 === t && 1 / t < 0 ? 1 : 0;
				for (t = Math.abs(t), isNaN(t) || t === 1 / 0 ? (o = isNaN(t) ? 1 : 0, s = l) : (s = Math.floor(Math.log(t) / Math.LN2), t * (u = Math.pow(2, -s)) < 1 && (s--, u *= 2), (t += s + c >= 1 ? h / u : h * Math.pow(2, 1 - c)) * u >= 2 && (s++, u /= 2), s + c >= l ? (o = 0, s = l) : s + c >= 1 ? (o = (t * u - 1) * Math.pow(2, i), s += c) : (o = t * Math.pow(2, c - 1) * Math.pow(2, i), s = 0)); i >= 8; e[n + f] = 255 & o, f += _, o /= 256, i -= 8) ;
				for (s = s << i | o, d += i; d > 0; e[n + f] = 255 & s, f += _, s /= 256, d -= 8) ;
				e[n + f - _] |= 128 * p
			}
		}, function (e, t) {
			var n = {}.toString;
			e.exports = Array.isArray || function (e) {
				return "[object Array]" == n.call(e)
			}
		}, function (e, t, n) {
			"use strict";
			var r = this && this.__extends || function (e, t) {
				for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);

				function r() {
					this.constructor = e
				}

				e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype, new r)
			}, i = n(24), a = n(12), s = n(8), o = n(9), u = n(2), d = function (e) {
				function t(t, n) {
					var r = this;
					e.call(this), this.key = t, this.options = n || {}, this.state = "initialized", this.connection = null, this.usingTLS = !!n.useTLS, this.timeline = this.options.timeline, this.errorCallbacks = this.buildErrorCallbacks(), this.connectionCallbacks = this.buildConnectionCallbacks(this.errorCallbacks), this.handshakeCallbacks = this.buildHandshakeCallbacks(this.errorCallbacks);
					var i = u.default.getNetwork();
					i.bind("online", function () {
						r.timeline.info({netinfo: "online"}), "connecting" !== r.state && "unavailable" !== r.state || r.retryIn(0)
					}), i.bind("offline", function () {
						r.timeline.info({netinfo: "offline"}), r.connection && r.sendActivityCheck()
					}), this.updateStrategy()
				}

				return r(t, e), t.prototype.connect = function () {
					this.connection || this.runner || (this.strategy.isSupported() ? (this.updateState("connecting"), this.startConnecting(), this.setUnavailableTimer()) : this.updateState("failed"))
				}, t.prototype.send = function (e) {
					return !!this.connection && this.connection.send(e)
				}, t.prototype.send_event = function (e, t, n) {
					return !!this.connection && this.connection.send_event(e, t, n)
				}, t.prototype.disconnect = function () {
					this.disconnectInternally(), this.updateState("disconnected")
				}, t.prototype.isUsingTLS = function () {
					return this.usingTLS
				}, t.prototype.startConnecting = function () {
					var e = this, t = function (n, r) {
						n ? e.runner = e.strategy.connect(0, t) : "error" === r.action ? (e.emit("error", {
							type: "HandshakeError",
							error: r.error
						}), e.timeline.error({handshakeError: r.error})) : (e.abortConnecting(), e.handshakeCallbacks[r.action](r))
					};
					this.runner = this.strategy.connect(0, t)
				}, t.prototype.abortConnecting = function () {
					this.runner && (this.runner.abort(), this.runner = null)
				}, t.prototype.disconnectInternally = function () {
					(this.abortConnecting(), this.clearRetryTimer(), this.clearUnavailableTimer(), this.connection) && this.abandonConnection().close()
				}, t.prototype.updateStrategy = function () {
					this.strategy = this.options.getStrategy({
						key: this.key,
						timeline: this.timeline,
						useTLS: this.usingTLS
					})
				}, t.prototype.retryIn = function (e) {
					var t = this;
					this.timeline.info({
						action: "retry",
						delay: e
					}), e > 0 && this.emit("connecting_in", Math.round(e / 1e3)), this.retryTimer = new a.OneOffTimer(e || 0, function () {
						t.disconnectInternally(), t.connect()
					})
				}, t.prototype.clearRetryTimer = function () {
					this.retryTimer && (this.retryTimer.ensureAborted(), this.retryTimer = null)
				}, t.prototype.setUnavailableTimer = function () {
					var e = this;
					this.unavailableTimer = new a.OneOffTimer(this.options.unavailableTimeout, function () {
						e.updateState("unavailable")
					})
				}, t.prototype.clearUnavailableTimer = function () {
					this.unavailableTimer && this.unavailableTimer.ensureAborted()
				}, t.prototype.sendActivityCheck = function () {
					var e = this;
					this.stopActivityCheck(), this.connection.ping(), this.activityTimer = new a.OneOffTimer(this.options.pongTimeout, function () {
						e.timeline.error({pong_timed_out: e.options.pongTimeout}), e.retryIn(0)
					})
				}, t.prototype.resetActivityCheck = function () {
					var e = this;
					this.stopActivityCheck(), this.connection && !this.connection.handlesActivityChecks() && (this.activityTimer = new a.OneOffTimer(this.activityTimeout, function () {
						e.sendActivityCheck()
					}))
				}, t.prototype.stopActivityCheck = function () {
					this.activityTimer && this.activityTimer.ensureAborted()
				}, t.prototype.buildConnectionCallbacks = function (e) {
					var t = this;
					return o.extend({}, e, {
						message: function (e) {
							t.resetActivityCheck(), t.emit("message", e)
						}, ping: function () {
							t.send_event("pusher:pong", {})
						}, activity: function () {
							t.resetActivityCheck()
						}, error: function (e) {
							t.emit("error", {type: "WebSocketError", error: e})
						}, closed: function () {
							t.abandonConnection(), t.shouldRetry() && t.retryIn(1e3)
						}
					})
				}, t.prototype.buildHandshakeCallbacks = function (e) {
					var t = this;
					return o.extend({}, e, {
						connected: function (e) {
							t.activityTimeout = Math.min(t.options.activityTimeout, e.activityTimeout, e.connection.activityTimeout || 1 / 0), t.clearUnavailableTimer(), t.setConnection(e.connection), t.socket_id = t.connection.id, t.updateState("connected", {socket_id: t.socket_id})
						}
					})
				}, t.prototype.buildErrorCallbacks = function () {
					var e = this, t = function (t) {
						return function (n) {
							n.error && e.emit("error", {type: "WebSocketError", error: n.error}), t(n)
						}
					};
					return {
						tls_only: t(function () {
							e.usingTLS = !0, e.updateStrategy(), e.retryIn(0)
						}), refused: t(function () {
							e.disconnect()
						}), backoff: t(function () {
							e.retryIn(1e3)
						}), retry: t(function () {
							e.retryIn(0)
						})
					}
				}, t.prototype.setConnection = function (e) {
					for (var t in this.connection = e, this.connectionCallbacks) this.connection.bind(t, this.connectionCallbacks[t]);
					this.resetActivityCheck()
				}, t.prototype.abandonConnection = function () {
					if (this.connection) {
						for (var e in this.stopActivityCheck(), this.connectionCallbacks) this.connection.unbind(e, this.connectionCallbacks[e]);
						var t = this.connection;
						return this.connection = null, t
					}
				}, t.prototype.updateState = function (e, t) {
					var n = this.state;
					if (this.state = e, n !== e) {
						var r = e;
						"connected" === r && (r += " with new socket ID " + t.socket_id), s.default.debug("State changed", n + " -> " + r), this.timeline.info({
							state: e,
							params: t
						}), this.emit("state_change", {previous: n, current: e}), this.emit(e, t)
					}
				}, t.prototype.shouldRetry = function () {
					return "connecting" === this.state || "connected" === this.state
				}, t
			}(i.default);
			t.__esModule = !0, t.default = d
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = n(43), a = n(31), s = function () {
				function e() {
					this.channels = {}
				}

				return e.prototype.add = function (e, t) {
					return this.channels[e] || (this.channels[e] = function (e, t) {
						if (0 === e.indexOf("private-encrypted-")) {
							if ("ReactNative" == navigator.product) {
								throw new a.UnsupportedFeature("Encrypted channels are not yet supported when using React Native builds.")
							}
							return i.default.createEncryptedChannel(e, t)
						}
						return 0 === e.indexOf("private-") ? i.default.createPrivateChannel(e, t) : 0 === e.indexOf("presence-") ? i.default.createPresenceChannel(e, t) : i.default.createChannel(e, t)
					}(e, t)), this.channels[e]
				}, e.prototype.all = function () {
					return r.values(this.channels)
				}, e.prototype.find = function (e) {
					return this.channels[e]
				}, e.prototype.remove = function (e) {
					var t = this.channels[e];
					return delete this.channels[e], t
				}, e.prototype.disconnect = function () {
					r.objectApply(this.channels, function (e) {
						e.disconnect()
					})
				}, e
			}();
			t.__esModule = !0, t.default = s
		}, function (e, t, n) {
			"use strict";
			var r = n(43), i = n(11), a = n(31), s = n(9), o = function () {
				function e(e, t, n, r) {
					this.name = e, this.priority = t, this.transport = n, this.options = r || {}
				}

				return e.prototype.isSupported = function () {
					return this.transport.isSupported({useTLS: this.options.useTLS})
				}, e.prototype.connect = function (e, t) {
					var n = this;
					if (!this.isSupported()) return u(new a.UnsupportedStrategy, t);
					if (this.priority < e) return u(new a.TransportPriorityTooLow, t);
					var i = !1,
						o = this.transport.createConnection(this.name, this.priority, this.options.key, this.options),
						d = null, l = function () {
							o.unbind("initialized", l), o.connect()
						}, c = function () {
							d = r.default.createHandshake(o, function (e) {
								i = !0, _(), t(null, e)
							})
						}, h = function (e) {
							_(), t(e)
						}, f = function () {
							var e;
							_(), e = s.safeJSONStringify(o), t(new a.TransportClosed(e))
						}, _ = function () {
							o.unbind("initialized", l), o.unbind("open", c), o.unbind("error", h), o.unbind("closed", f)
						};
					return o.bind("initialized", l), o.bind("open", c), o.bind("error", h), o.bind("closed", f), o.initialize(), {
						abort: function () {
							i || (_(), d ? d.close() : o.close())
						}, forceMinPriority: function (e) {
							i || n.priority < e && (d ? d.close() : o.close())
						}
					}
				}, e
			}();

			function u(e, t) {
				return i.default.defer(function () {
					t(e)
				}), {
					abort: function () {
					}, forceMinPriority: function () {
					}
				}
			}

			t.__esModule = !0, t.default = o
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = n(11), a = n(12), s = function () {
				function e(e, t) {
					this.strategies = e, this.loop = Boolean(t.loop), this.failFast = Boolean(t.failFast), this.timeout = t.timeout, this.timeoutLimit = t.timeoutLimit
				}

				return e.prototype.isSupported = function () {
					return r.any(this.strategies, i.default.method("isSupported"))
				}, e.prototype.connect = function (e, t) {
					var n = this, r = this.strategies, i = 0, a = this.timeout, s = null, o = function (u, d) {
						d ? t(null, d) : (i += 1, n.loop && (i %= r.length), i < r.length ? (a && (a *= 2, n.timeoutLimit && (a = Math.min(a, n.timeoutLimit))), s = n.tryStrategy(r[i], e, {
							timeout: a,
							failFast: n.failFast
						}, o)) : t(!0))
					};
					return s = this.tryStrategy(r[i], e, {
						timeout: a,
						failFast: this.failFast
					}, o), {
						abort: function () {
							s.abort()
						}, forceMinPriority: function (t) {
							e = t, s && s.forceMinPriority(t)
						}
					}
				}, e.prototype.tryStrategy = function (e, t, n, r) {
					var i = null, s = null;
					return n.timeout > 0 && (i = new a.OneOffTimer(n.timeout, function () {
						s.abort(), r(!0)
					})), s = e.connect(t, function (e, t) {
						e && i && i.isRunning() && !n.failFast || (i && i.ensureAborted(), r(e, t))
					}), {
						abort: function () {
							i && i.ensureAborted(), s.abort()
						}, forceMinPriority: function (e) {
							s.forceMinPriority(e)
						}
					}
				}, e
			}();
			t.__esModule = !0, t.default = s
		}, function (e, t, n) {
			"use strict";
			var r = n(9), i = n(11), a = function () {
				function e(e) {
					this.strategies = e
				}

				return e.prototype.isSupported = function () {
					return r.any(this.strategies, i.default.method("isSupported"))
				}, e.prototype.connect = function (e, t) {
					return function (e, t, n) {
						var i = r.map(e, function (e, r, i, a) {
							return e.connect(t, n(r, a))
						});
						return {
							abort: function () {
								r.apply(i, s)
							}, forceMinPriority: function (e) {
								r.apply(i, function (t) {
									t.forceMinPriority(e)
								})
							}
						}
					}(this.strategies, e, function (e, n) {
						return function (i, a) {
							n[e].error = i, i ? function (e) {
								return r.all(e, function (e) {
									return Boolean(e.error)
								})
							}(n) && t(!0) : (r.apply(n, function (e) {
								e.forceMinPriority(a.transport.priority)
							}), t(null, a))
						}
					})
				}, e
			}();

			function s(e) {
				e.error || e.aborted || (e.abort(), e.aborted = !0)
			}

			t.__esModule = !0, t.default = a
		}, function (e, t, n) {
			"use strict";
			var r = n(11), i = n(2), a = n(65), s = n(9), o = function () {
				function e(e, t, n) {
					this.strategy = e, this.transports = t, this.ttl = n.ttl || 18e5, this.usingTLS = n.useTLS, this.timeline = n.timeline
				}

				return e.prototype.isSupported = function () {
					return this.strategy.isSupported()
				}, e.prototype.connect = function (e, t) {
					var n = this.usingTLS, o = function (e) {
						var t = i.default.getLocalStorage();
						if (t) try {
							var n = t[u(e)];
							if (n) return JSON.parse(n)
						} catch (t) {
							d(e)
						}
						return null
					}(n), l = [this.strategy];
					if (o && o.timestamp + this.ttl >= r.default.now()) {
						var c = this.transports[o.transport];
						c && (this.timeline.info({
							cached: !0,
							transport: o.transport,
							latency: o.latency
						}), l.push(new a.default([c], {timeout: 2 * o.latency + 1e3, failFast: !0})))
					}
					var h = r.default.now(), f = l.pop().connect(e, function a(o, c) {
						o ? (d(n), l.length > 0 ? (h = r.default.now(), f = l.pop().connect(e, a)) : t(o)) : (!function (e, t, n) {
							var a = i.default.getLocalStorage();
							if (a) try {
								a[u(e)] = s.safeJSONStringify({timestamp: r.default.now(), transport: t, latency: n})
							} catch (e) {
							}
						}(n, c.transport.name, r.default.now() - h), t(null, c))
					});
					return {
						abort: function () {
							f.abort()
						}, forceMinPriority: function (t) {
							e = t, f && f.forceMinPriority(t)
						}
					}
				}, e
			}();

			function u(e) {
				return "pusherTransport" + (e ? "TLS" : "NonTLS")
			}

			function d(e) {
				var t = i.default.getLocalStorage();
				if (t) try {
					delete t[u(e)]
				} catch (e) {
				}
			}

			t.__esModule = !0, t.default = o
		}, function (e, t, n) {
			"use strict";
			var r = n(12), i = function () {
				function e(e, t) {
					var n = t.delay;
					this.strategy = e, this.options = {delay: n}
				}

				return e.prototype.isSupported = function () {
					return this.strategy.isSupported()
				}, e.prototype.connect = function (e, t) {
					var n, i = this.strategy, a = new r.OneOffTimer(this.options.delay, function () {
						n = i.connect(e, t)
					});
					return {
						abort: function () {
							a.ensureAborted(), n && n.abort()
						}, forceMinPriority: function (t) {
							e = t, n && n.forceMinPriority(t)
						}
					}
				}, e
			}();
			t.__esModule = !0, t.default = i
		}, function (e, t) {
			"use strict";
			var n = function () {
				function e(e, t, n) {
					this.test = e, this.trueBranch = t, this.falseBranch = n
				}

				return e.prototype.isSupported = function () {
					return (this.test() ? this.trueBranch : this.falseBranch).isSupported()
				}, e.prototype.connect = function (e, t) {
					return (this.test() ? this.trueBranch : this.falseBranch).connect(e, t)
				}, e
			}();
			t.__esModule = !0, t.default = n
		}, function (e, t) {
			"use strict";
			var n = function () {
				function e(e) {
					this.strategy = e
				}

				return e.prototype.isSupported = function () {
					return this.strategy.isSupported()
				}, e.prototype.connect = function (e, t) {
					var n = this.strategy.connect(e, function (e, r) {
						r && n.abort(), t(e, r)
					});
					return n
				}, e
			}();
			t.__esModule = !0, t.default = n
		}, function (e, t, n) {
			"use strict";
			var r = n(5);
			t.getGlobalConfig = function () {
				return {
					wsHost: r.default.host,
					wsPort: r.default.ws_port,
					wssPort: r.default.wss_port,
					wsPath: r.default.ws_path,
					httpHost: r.default.sockjs_host,
					httpPort: r.default.sockjs_http_port,
					httpsPort: r.default.sockjs_https_port,
					httpPath: r.default.sockjs_path,
					statsHost: r.default.stats_host,
					authEndpoint: r.default.channel_auth_endpoint,
					authTransport: r.default.channel_auth_transport,
					activity_timeout: r.default.activity_timeout,
					pong_timeout: r.default.pong_timeout,
					unavailable_timeout: r.default.unavailable_timeout
				}
			}, t.getClusterConfig = function (e) {
				return {wsHost: "ws-" + e + ".pusher.com", httpHost: "sockjs-" + e + ".pusher.com"}
			}
		}])
	}, e.exports = r()
}, function (e, n) {
	var r;
	(r = jQuery).fn.extend({
		slimScroll: function (e) {
			var n = r.extend({
				width: "auto",
				height: "250px",
				size: "7px",
				color: "#000",
				position: "right",
				distance: "1px",
				start: "top",
				opacity: .4,
				alwaysVisible: !1,
				disableFadeOut: !1,
				railVisible: !1,
				railColor: "#333",
				railOpacity: .2,
				railDraggable: !0,
				railClass: "slimScrollRail",
				barClass: "slimScrollBar",
				wrapperClass: "slimScrollDiv",
				allowPageScroll: !1,
				wheelStep: 20,
				touchScrollStep: 200,
				borderRadius: "7px",
				railBorderRadius: "7px"
			}, e);
			return this.each(function () {
				var i, a, s, o, u, d, l, c, h = "<div></div>", f = 30, _ = !1, p = r(this);
				if (p.parent().hasClass(n.wrapperClass)) {
					var m = p.scrollTop();
					if (w = p.siblings("." + n.barClass), L = p.siblings("." + n.railClass), T(), r.isPlainObject(e)) {
						if ("height" in e && "auto" == e.height) {
							p.parent().css("height", "auto"), p.css("height", "auto");
							var y = p.parent().parent().height();
							p.parent().css("height", y), p.css("height", y)
						} else if ("height" in e) {
							var g = e.height;
							p.parent().css("height", g), p.css("height", g)
						}
						if ("scrollTo" in e) m = parseInt(n.scrollTo); else if ("scrollBy" in e) m += parseInt(n.scrollBy); else if ("destroy" in e) return w.remove(), L.remove(), void p.unwrap();
						k(m, !1, !0)
					}
				} else if (!(r.isPlainObject(e) && "destroy" in e)) {
					n.height = "auto" == n.height ? p.parent().height() : n.height;
					var v = r(h).addClass(n.wrapperClass).css({
						position: "relative",
						overflow: "hidden",
						width: n.width,
						height: n.height
					});
					p.css({overflow: "hidden", width: n.width, height: n.height});
					var M, L = r(h).addClass(n.railClass).css({
						width: n.size,
						height: "100%",
						position: "absolute",
						top: 0,
						display: n.alwaysVisible && n.railVisible ? "block" : "none",
						"border-radius": n.railBorderRadius,
						background: n.railColor,
						opacity: n.railOpacity,
						zIndex: 90
					}), w = r(h).addClass(n.barClass).css({
						background: n.color,
						width: n.size,
						position: "absolute",
						top: 0,
						opacity: n.opacity,
						display: n.alwaysVisible ? "block" : "none",
						"border-radius": n.borderRadius,
						BorderRadius: n.borderRadius,
						MozBorderRadius: n.borderRadius,
						WebkitBorderRadius: n.borderRadius,
						zIndex: 99
					}), b = "right" == n.position ? {right: n.distance} : {left: n.distance};
					L.css(b), w.css(b), p.wrap(v), p.parent().append(w), p.parent().append(L), n.railDraggable && w.bind("mousedown", function (e) {
						var n = r(document);
						return s = !0, t = parseFloat(w.css("top")), pageY = e.pageY, n.bind("mousemove.slimscroll", function (e) {
							currTop = t + e.pageY - pageY, w.css("top", currTop), k(0, w.position().top, !1)
						}), n.bind("mouseup.slimscroll", function (e) {
							s = !1, S(), n.unbind(".slimscroll")
						}), !1
					}).bind("selectstart.slimscroll", function (e) {
						return e.stopPropagation(), e.preventDefault(), !1
					}), L.hover(function () {
						D()
					}, function () {
						S()
					}), w.hover(function () {
						a = !0
					}, function () {
						a = !1
					}), p.hover(function () {
						i = !0, D(), S()
					}, function () {
						i = !1, S()
					}), p.bind("touchstart", function (e, t) {
						e.originalEvent.touches.length && (u = e.originalEvent.touches[0].pageY)
					}), p.bind("touchmove", function (e) {
						_ || e.originalEvent.preventDefault(), e.originalEvent.touches.length && (k((u - e.originalEvent.touches[0].pageY) / n.touchScrollStep, !0), u = e.originalEvent.touches[0].pageY)
					}), T(), "bottom" === n.start ? (w.css({top: p.outerHeight() - w.outerHeight()}), k(0, !0)) : "top" !== n.start && (k(r(n.start).position().top, null, !0), n.alwaysVisible || w.hide()), M = this, window.addEventListener ? (M.addEventListener("DOMMouseScroll", Y, !1), M.addEventListener("mousewheel", Y, !1)) : document.attachEvent("onmousewheel", Y)
				}

				function Y(e) {
					if (i) {
						var t = 0;
						(e = e || window.event).wheelDelta && (t = -e.wheelDelta / 120), e.detail && (t = e.detail / 3);
						var a = e.target || e.srcTarget || e.srcElement;
						r(a).closest("." + n.wrapperClass).is(p.parent()) && k(t, !0), e.preventDefault && !_ && e.preventDefault(), _ || (e.returnValue = !1)
					}
				}

				function k(e, t, r) {
					_ = !1;
					var i = e, a = p.outerHeight() - w.outerHeight();
					if (t && (i = parseInt(w.css("top")) + e * parseInt(n.wheelStep) / 100 * w.outerHeight(), i = Math.min(Math.max(i, 0), a), i = e > 0 ? Math.ceil(i) : Math.floor(i), w.css({top: i + "px"})), i = (l = parseInt(w.css("top")) / (p.outerHeight() - w.outerHeight())) * (p[0].scrollHeight - p.outerHeight()), r) {
						var s = (i = e) / p[0].scrollHeight * p.outerHeight();
						s = Math.min(Math.max(s, 0), a), w.css({top: s + "px"})
					}
					p.scrollTop(i), p.trigger("slimscrolling", ~~i), D(), S()
				}

				function T() {
					d = Math.max(p.outerHeight() / p[0].scrollHeight * p.outerHeight(), f), w.css({height: d + "px"});
					var e = d == p.outerHeight() ? "none" : "block";
					w.css({display: e})
				}

				function D() {
					if (T(), clearTimeout(o), l == ~~l) {
						if (_ = n.allowPageScroll, c != l) {
							var e = 0 == ~~l ? "top" : "bottom";
							p.trigger("slimscroll", e)
						}
					} else _ = !1;
					c = l, d >= p.outerHeight() ? _ = !0 : (w.stop(!0, !0).fadeIn("fast"), n.railVisible && L.stop(!0, !0).fadeIn("fast"))
				}

				function S() {
					n.alwaysVisible || (o = setTimeout(function () {
						n.disableFadeOut && i || a || s || (w.fadeOut("slow"), L.fadeOut("slow"))
					}, 1e3))
				}
			}), this
		}
	}), r.fn.extend({slimscroll: r.fn.slimScroll})
}, function (e, t) {
	!function (e, t, n, r) {
		function i(t, n) {
			this.element = t, this.$element = e(t), this.init()
		}

		i.prototype = {
			init: function () {
				this.$element.outerHeight();
				var n = parseInt(this.$element.css("paddingBottom")) + parseInt(this.$element.css("paddingTop")) || 0;
				this.element.value.replace(/\s/g, "").length > 0 && this.$element.height(this.element.scrollHeight - n), this.$element.on("input keyup", function (r) {
					var i = e(t), a = i.scrollTop();
					e(this).height(0).height(this.scrollHeight - n), i.scrollTop(a)
				})
			}
		}, e.fn.textareaAutoSize = function (t) {
			return this.each(function () {
				e.data(this, "plugin_textareaAutoSize") || e.data(this, "plugin_textareaAutoSize", new i(this, t))
			}), this
		}
	}(jQuery, window, document)
}, function (e, t, n) {
	var r = {
		"./af": 10,
		"./af.js": 10,
		"./ar": 11,
		"./ar-dz": 12,
		"./ar-dz.js": 12,
		"./ar-kw": 13,
		"./ar-kw.js": 13,
		"./ar-ly": 14,
		"./ar-ly.js": 14,
		"./ar-ma": 15,
		"./ar-ma.js": 15,
		"./ar-sa": 16,
		"./ar-sa.js": 16,
		"./ar-tn": 17,
		"./ar-tn.js": 17,
		"./ar.js": 11,
		"./az": 18,
		"./az.js": 18,
		"./be": 19,
		"./be.js": 19,
		"./bg": 20,
		"./bg.js": 20,
		"./bm": 21,
		"./bm.js": 21,
		"./bn": 22,
		"./bn.js": 22,
		"./bo": 23,
		"./bo.js": 23,
		"./br": 24,
		"./br.js": 24,
		"./bs": 25,
		"./bs.js": 25,
		"./ca": 26,
		"./ca.js": 26,
		"./cs": 27,
		"./cs.js": 27,
		"./cv": 28,
		"./cv.js": 28,
		"./cy": 29,
		"./cy.js": 29,
		"./da": 30,
		"./da.js": 30,
		"./de": 31,
		"./de-at": 32,
		"./de-at.js": 32,
		"./de-ch": 33,
		"./de-ch.js": 33,
		"./de.js": 31,
		"./dv": 34,
		"./dv.js": 34,
		"./el": 35,
		"./el.js": 35,
		"./en-au": 36,
		"./en-au.js": 36,
		"./en-ca": 37,
		"./en-ca.js": 37,
		"./en-gb": 38,
		"./en-gb.js": 38,
		"./en-ie": 39,
		"./en-ie.js": 39,
		"./en-il": 40,
		"./en-il.js": 40,
		"./en-nz": 41,
		"./en-nz.js": 41,
		"./eo": 42,
		"./eo.js": 42,
		"./es": 43,
		"./es-do": 44,
		"./es-do.js": 44,
		"./es-us": 45,
		"./es-us.js": 45,
		"./es.js": 43,
		"./et": 46,
		"./et.js": 46,
		"./eu": 47,
		"./eu.js": 47,
		"./fa": 48,
		"./fa.js": 48,
		"./fi": 49,
		"./fi.js": 49,
		"./fo": 50,
		"./fo.js": 50,
		"./fr": 51,
		"./fr-ca": 52,
		"./fr-ca.js": 52,
		"./fr-ch": 53,
		"./fr-ch.js": 53,
		"./fr.js": 51,
		"./fy": 54,
		"./fy.js": 54,
		"./gd": 55,
		"./gd.js": 55,
		"./gl": 56,
		"./gl.js": 56,
		"./gom-latn": 57,
		"./gom-latn.js": 57,
		"./gu": 58,
		"./gu.js": 58,
		"./he": 59,
		"./he.js": 59,
		"./hi": 60,
		"./hi.js": 60,
		"./hr": 61,
		"./hr.js": 61,
		"./hu": 62,
		"./hu.js": 62,
		"./hy-am": 63,
		"./hy-am.js": 63,
		"./id": 64,
		"./id.js": 64,
		"./is": 65,
		"./is.js": 65,
		"./it": 66,
		"./it.js": 66,
		"./ja": 67,
		"./ja.js": 67,
		"./jv": 68,
		"./jv.js": 68,
		"./ka": 69,
		"./ka.js": 69,
		"./kk": 70,
		"./kk.js": 70,
		"./km": 71,
		"./km.js": 71,
		"./kn": 72,
		"./kn.js": 72,
		"./ko": 73,
		"./ko.js": 73,
		"./ky": 74,
		"./ky.js": 74,
		"./lb": 75,
		"./lb.js": 75,
		"./lo": 76,
		"./lo.js": 76,
		"./lt": 77,
		"./lt.js": 77,
		"./lv": 78,
		"./lv.js": 78,
		"./me": 79,
		"./me.js": 79,
		"./mi": 80,
		"./mi.js": 80,
		"./mk": 81,
		"./mk.js": 81,
		"./ml": 82,
		"./ml.js": 82,
		"./mn": 83,
		"./mn.js": 83,
		"./mr": 84,
		"./mr.js": 84,
		"./ms": 85,
		"./ms-my": 86,
		"./ms-my.js": 86,
		"./ms.js": 85,
		"./mt": 87,
		"./mt.js": 87,
		"./my": 88,
		"./my.js": 88,
		"./nb": 89,
		"./nb.js": 89,
		"./ne": 90,
		"./ne.js": 90,
		"./nl": 91,
		"./nl-be": 92,
		"./nl-be.js": 92,
		"./nl.js": 91,
		"./nn": 93,
		"./nn.js": 93,
		"./pa-in": 94,
		"./pa-in.js": 94,
		"./pl": 95,
		"./pl.js": 95,
		"./pt": 96,
		"./pt-br": 97,
		"./pt-br.js": 97,
		"./pt.js": 96,
		"./ro": 98,
		"./ro.js": 98,
		"./ru": 99,
		"./ru.js": 99,
		"./sd": 100,
		"./sd.js": 100,
		"./se": 101,
		"./se.js": 101,
		"./si": 102,
		"./si.js": 102,
		"./sk": 103,
		"./sk.js": 103,
		"./sl": 104,
		"./sl.js": 104,
		"./sq": 105,
		"./sq.js": 105,
		"./sr": 106,
		"./sr-cyrl": 107,
		"./sr-cyrl.js": 107,
		"./sr.js": 106,
		"./ss": 108,
		"./ss.js": 108,
		"./sv": 109,
		"./sv.js": 109,
		"./sw": 110,
		"./sw.js": 110,
		"./ta": 111,
		"./ta.js": 111,
		"./te": 112,
		"./te.js": 112,
		"./tet": 113,
		"./tet.js": 113,
		"./tg": 114,
		"./tg.js": 114,
		"./th": 115,
		"./th.js": 115,
		"./tl-ph": 116,
		"./tl-ph.js": 116,
		"./tlh": 117,
		"./tlh.js": 117,
		"./tr": 118,
		"./tr.js": 118,
		"./tzl": 119,
		"./tzl.js": 119,
		"./tzm": 120,
		"./tzm-latn": 121,
		"./tzm-latn.js": 121,
		"./tzm.js": 120,
		"./ug-cn": 122,
		"./ug-cn.js": 122,
		"./uk": 123,
		"./uk.js": 123,
		"./ur": 124,
		"./ur.js": 124,
		"./uz": 125,
		"./uz-latn": 126,
		"./uz-latn.js": 126,
		"./uz.js": 125,
		"./vi": 127,
		"./vi.js": 127,
		"./x-pseudo": 128,
		"./x-pseudo.js": 128,
		"./yo": 129,
		"./yo.js": 129,
		"./zh-cn": 130,
		"./zh-cn.js": 130,
		"./zh-hk": 131,
		"./zh-hk.js": 131,
		"./zh-tw": 132,
		"./zh-tw.js": 132
	};

	function i(e) {
		return n(a(e))
	}

	function a(e) {
		var t = r[e];
		if (!(t + 1)) throw new Error("Cannot find module '" + e + "'.");
		return t
	}

	i.keys = function () {
		return Object.keys(r)
	}, i.resolve = a, e.exports = i, i.id = 162
}, function (e, t, n) {
	var r, i;
	n(164), r = [n(2)], void 0 === (i = function (e) {
		return function () {
			var t, n, r, i = 0, a = {error: "error", info: "info", success: "success", warning: "warning"}, s = {
				clear: function (n, r) {
					var i = c();
					t || o(i), u(n, i, r) || function (n) {
						for (var r = t.children(), i = r.length - 1; i >= 0; i--) u(e(r[i]), n)
					}(i)
				}, remove: function (n) {
					var r = c();
					t || o(r), n && 0 === e(":focus", n).length ? h(n) : t.children().length && t.remove()
				}, error: function (e, t, n) {
					return l({
						type: a.error,
						iconClass: c().iconClasses.error,
						message: e,
						optionsOverride: n,
						title: t
					})
				}, getContainer: o, info: function (e, t, n) {
					return l({
						type: a.info,
						iconClass: c().iconClasses.info,
						message: e,
						optionsOverride: n,
						title: t
					})
				}, options: {}, subscribe: function (e) {
					n = e
				}, success: function (e, t, n) {
					return l({
						type: a.success,
						iconClass: c().iconClasses.success,
						message: e,
						optionsOverride: n,
						title: t
					})
				}, version: "2.1.4", warning: function (e, t, n) {
					return l({
						type: a.warning,
						iconClass: c().iconClasses.warning,
						message: e,
						optionsOverride: n,
						title: t
					})
				}
			};
			return s;

			function o(n, r) {
				return n || (n = c()), (t = e("#" + n.containerId)).length ? t : (r && (t = function (n) {
					return (t = e("<div/>").attr("id", n.containerId).addClass(n.positionClass)).appendTo(e(n.target)), t
				}(n)), t)
			}

			function u(t, n, r) {
				var i = !(!r || !r.force) && r.force;
				return !(!t || !i && 0 !== e(":focus", t).length || (t[n.hideMethod]({
					duration: n.hideDuration,
					easing: n.hideEasing,
					complete: function () {
						h(t)
					}
				}), 0))
			}

			function d(e) {
				n && n(e)
			}

			function l(n) {
				var a = c(), s = n.iconClass || a.iconClass;
				if (void 0 !== n.optionsOverride && (a = e.extend(a, n.optionsOverride), s = n.optionsOverride.iconClass || s), !function (e, t) {
					if (e.preventDuplicates) {
						if (t.message === r) return !0;
						r = t.message
					}
					return !1
				}(a, n)) {
					i++, t = o(a, !0);
					var u = null, l = e("<div/>"), f = e("<div/>"), _ = e("<div/>"), p = e("<div/>"),
						m = e(a.closeHtml), y = {intervalId: null, hideEta: null, maxHideTime: null},
						g = {toastId: i, state: "visible", startTime: new Date, options: a, map: n};
					return n.iconClass && l.addClass(a.toastClass).addClass(s), function () {
						if (n.title) {
							var e = n.title;
							a.escapeHtml && (e = v(n.title)), f.append(e).addClass(a.titleClass), l.append(f)
						}
					}(), function () {
						if (n.message) {
							var e = n.message;
							a.escapeHtml && (e = v(n.message)), _.append(e).addClass(a.messageClass), l.append(_)
						}
					}(), a.closeButton && (m.addClass(a.closeClass).attr("role", "button"), l.prepend(m)), a.progressBar && (p.addClass(a.progressClass), l.prepend(p)), a.rtl && l.addClass("rtl"), a.newestOnTop ? t.prepend(l) : t.append(l), function () {
						var e = "";
						switch (n.iconClass) {
							case"toast-success":
							case"toast-info":
								e = "polite";
								break;
							default:
								e = "assertive"
						}
						l.attr("aria-live", e)
					}(), l.hide(), l[a.showMethod]({
						duration: a.showDuration,
						easing: a.showEasing,
						complete: a.onShown
					}), a.timeOut > 0 && (u = setTimeout(M, a.timeOut), y.maxHideTime = parseFloat(a.timeOut), y.hideEta = (new Date).getTime() + y.maxHideTime, a.progressBar && (y.intervalId = setInterval(b, 10))), a.closeOnHover && l.hover(w, L), !a.onclick && a.tapToDismiss && l.click(M), a.closeButton && m && m.click(function (e) {
						e.stopPropagation ? e.stopPropagation() : void 0 !== e.cancelBubble && !0 !== e.cancelBubble && (e.cancelBubble = !0), a.onCloseClick && a.onCloseClick(e), M(!0)
					}), a.onclick && l.click(function (e) {
						a.onclick(e), M()
					}), d(g), a.debug && console && console.log(g), l
				}

				function v(e) {
					return null == e && (e = ""), e.replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/'/g, "&#39;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
				}

				function M(t) {
					var n = t && !1 !== a.closeMethod ? a.closeMethod : a.hideMethod,
						r = t && !1 !== a.closeDuration ? a.closeDuration : a.hideDuration,
						i = t && !1 !== a.closeEasing ? a.closeEasing : a.hideEasing;
					if (!e(":focus", l).length || t) return clearTimeout(y.intervalId), l[n]({
						duration: r,
						easing: i,
						complete: function () {
							h(l), clearTimeout(u), a.onHidden && "hidden" !== g.state && a.onHidden(), g.state = "hidden", g.endTime = new Date, d(g)
						}
					})
				}

				function L() {
					(a.timeOut > 0 || a.extendedTimeOut > 0) && (u = setTimeout(M, a.extendedTimeOut), y.maxHideTime = parseFloat(a.extendedTimeOut), y.hideEta = (new Date).getTime() + y.maxHideTime)
				}

				function w() {
					clearTimeout(u), y.hideEta = 0, l.stop(!0, !0)[a.showMethod]({
						duration: a.showDuration,
						easing: a.showEasing
					})
				}

				function b() {
					var e = (y.hideEta - (new Date).getTime()) / y.maxHideTime * 100;
					p.width(e + "%")
				}
			}

			function c() {
				return e.extend({}, {
					tapToDismiss: !0,
					toastClass: "toast",
					containerId: "toast-container",
					debug: !1,
					showMethod: "fadeIn",
					showDuration: 300,
					showEasing: "swing",
					onShown: void 0,
					hideMethod: "fadeOut",
					hideDuration: 1e3,
					hideEasing: "swing",
					onHidden: void 0,
					closeMethod: !1,
					closeDuration: !1,
					closeEasing: !1,
					closeOnHover: !0,
					extendedTimeOut: 1e3,
					iconClasses: {
						error: "toast-error",
						info: "toast-info",
						success: "toast-success",
						warning: "toast-warning"
					},
					iconClass: "toast-info",
					positionClass: "toast-top-right",
					timeOut: 5e3,
					titleClass: "toast-title",
					messageClass: "toast-message",
					escapeHtml: !1,
					target: "body",
					closeHtml: '<button type="button">&times;</button>',
					closeClass: "toast-close-button",
					newestOnTop: !0,
					preventDuplicates: !1,
					progressBar: !1,
					progressClass: "toast-progress",
					rtl: !1
				}, s.options)
			}

			function h(e) {
				t || (t = o()), e.is(":visible") || (e.remove(), e = null, 0 === t.children().length && (t.remove(), r = void 0))
			}
		}()
	}.apply(t, r)) || (e.exports = i)
}, function (e, t) {
	e.exports = function () {
		throw new Error("define cannot be used indirect")
	}
}, function (e, t, n) {
	var r, i, a, s;
	s = function (e) {
		"use strict";
		var t = function (t, n) {
			e.each(["autofocus", "savable", "hideable", "width", "height", "resize", "iconlibrary", "language", "footer", "fullscreen", "hiddenButtons", "disabledButtons"], function (r, i) {
				void 0 !== e(t).data(i) && ((n = "object" == typeof n ? n : {})[i] = e(t).data(i))
			}), this.$ns = "bootstrap-markdown", this.$element = e(t), this.$editable = {
				el: null,
				type: null,
				attrKeys: [],
				attrValues: [],
				content: null
			}, this.$options = e.extend(!0, {}, e.fn.markdown.defaults, n, this.$element.data("options")), this.$oldContent = null, this.$isPreview = !1, this.$isFullscreen = !1, this.$editor = null, this.$textarea = null, this.$handler = [], this.$callback = [], this.$nextTab = [], this.showEditor()
		};
		t.prototype = {
			constructor: t, __alterButtons: function (t, n) {
				var r = this.$handler, i = "all" == t, a = this;
				e.each(r, function (e, r) {
					!1 === (!i && r.indexOf(t) < 0) && n(a.$editor.find('button[data-handler="' + r + '"]'))
				})
			}, __buildButtons: function (t, n) {
				var r, i = this.$ns, a = this.$handler, s = this.$callback;
				for (r = 0; r < t.length; r++) {
					var o, u = t[r];
					for (o = 0; o < u.length; o++) {
						var d, l = u[o].data, c = e("<div/>", {class: "btn-group mr-2"});
						for (d = 0; d < l.length; d++) {
							var h, f, _ = l[d], p = i + "-" + _.name, m = this.__getIcon(_),
								y = _.btnText ? _.btnText : "", g = _.btnClass ? _.btnClass : "btn",
								v = _.tabIndex ? _.tabIndex : "-1", M = void 0 !== _.hotkey ? _.hotkey : "",
								L = void 0 !== jQuery.hotkeys && "" !== M ? " (" + M + ")" : "";
							(h = e("<button></button>")).text(" " + this.__localize(y)).addClass("btn-default btn-sm").addClass(g), g.match(/btn\-(primary|success|info|warning|danger|link)/) && h.removeClass("btn-default"), h.attr({
								type: "button",
								title: this.__localize(_.title) + L,
								tabindex: v,
								"data-provider": i,
								"data-handler": p,
								"data-hotkey": M
							}), !0 === _.toggle && h.attr("data-toggle", "button"), (f = e("<span/>")).addClass(m), f.prependTo(h), c.append(h), a.push(p), s.push(_.callback)
						}
						n.append(c)
					}
				}
				return n
			}, __setListener: function () {
				var e = void 0 !== this.$textarea.attr("rows"),
					t = this.$textarea.val().split("\n").length > 5 ? this.$textarea.val().split("\n").length : "5",
					n = e ? this.$textarea.attr("rows") : t;
				this.$textarea.attr("rows", n), this.$options.resize && this.$textarea.css("resize", this.$options.resize), this.$textarea.data("markdown", this)
			}, __setEventListeners: function () {
				this.$textarea.on({
					focus: e.proxy(this.focus, this),
					keyup: e.proxy(this.keyup, this),
					change: e.proxy(this.change, this),
					select: e.proxy(this.select, this)
				}), this.eventSupported("keydown") && this.$textarea.on("keydown", e.proxy(this.keydown, this)), this.eventSupported("keypress") && this.$textarea.on("keypress", e.proxy(this.keypress, this))
			}, __handle: function (t) {
				var n = e(t.currentTarget), r = this.$handler, i = this.$callback, a = n.attr("data-handler"),
					s = i[r.indexOf(a)];
				e(t.currentTarget).focus(), s(this), this.change(this), a.indexOf("cmdSave") < 0 && this.$textarea.focus(), t.preventDefault()
			}, __localize: function (t) {
				var n = e.fn.markdown.messages, r = this.$options.language;
				return void 0 !== n && void 0 !== n[r] && void 0 !== n[r][t] ? n[r][t] : t
			}, __getIcon: function (e) {
				if ("object" == typeof e) {
					var t = this.$options.customIcons[e.name];
					return void 0 === t ? e.icon[this.$options.iconlibrary] : t
				}
				return e
			}, setFullscreen: function (t) {
				var n = this.$editor, r = this.$textarea;
				!0 === t ? (n.addClass("md-fullscreen-mode"), e("body").addClass("md-nooverflow"), this.$options.onFullscreen(this)) : (n.removeClass("md-fullscreen-mode"), e("body").removeClass("md-nooverflow"), this.$options.onFullscreenExit(this), !0 === this.$isPreview && this.hidePreview().showPreview()), this.$isFullscreen = t, r.focus()
			}, showEditor: function () {
				var t, n = this, r = this.$ns, i = this.$element, a = (i.css("height"), i.css("width"), this.$editable),
					s = this.$handler, o = this.$callback, u = this.$options, d = e("<div/>", {
						class: "md-editor", click: function () {
							n.focus()
						}
					});
				if (null === this.$editor) {
					var l = e("<div/>", {class: "md-header btn-toolbar"}), c = [];
					if (u.buttons.length > 0 && (c = c.concat(u.buttons[0])), u.additionalButtons.length > 0 && e.each(u.additionalButtons[0], function (t, n) {
						var r = e.grep(c, function (e, t) {
							return e.name === n.name
						});
						r.length > 0 ? r[0].data = r[0].data.concat(n.data) : c.push(u.additionalButtons[0][t])
					}), u.reorderButtonGroups.length > 0 && (c = c.filter(function (e) {
						return u.reorderButtonGroups.indexOf(e.name) > -1
					}).sort(function (e, t) {
						return u.reorderButtonGroups.indexOf(e.name) < u.reorderButtonGroups.indexOf(t.name) ? -1 : u.reorderButtonGroups.indexOf(e.name) > u.reorderButtonGroups.indexOf(t.name) ? 1 : 0
					})), c.length > 0 && (l = this.__buildButtons([c], l)), u.fullscreen.enable && l.append('<div class="md-controls"><a class="md-control md-control-fullscreen" href="#"><span class="' + this.__getIcon(u.fullscreen.icons.fullscreenOn) + '"></span></a></div>').on("click", ".md-control-fullscreen", function (e) {
						e.preventDefault(), n.setFullscreen(!0)
					}), d.append(l), i.is("textarea")) i.before(d), (t = i).addClass("md-input"), d.append(t); else {
						var h = "function" == typeof toMarkdown ? toMarkdown(i.html()) : i.html(), f = e.trim(h);
						t = e("<textarea/>", {
							class: "md-input",
							val: f
						}), d.append(t), a.el = i, a.type = i.prop("tagName").toLowerCase(), a.content = i.html(), e(i[0].attributes).each(function () {
							a.attrKeys.push(this.nodeName), a.attrValues.push(this.nodeValue)
						}), i.replaceWith(d)
					}
					var _, p = e("<div/>", {class: "md-footer"}), m = !1;
					if (u.savable) {
						m = !0;
						s.push("cmdSave"), o.push(u.onSave), p.append('<button class="btn btn-success" data-provider="' + r + '" data-handler="cmdSave"><i class="icon icon-white icon-ok"></i> ' + this.__localize("Save") + "</button>")
					}
					if (_ = "function" == typeof u.footer ? u.footer(this) : u.footer, "" !== e.trim(_) && (m = !0, p.append(_)), m && d.append(p), u.width && "inherit" !== u.width && (jQuery.isNumeric(u.width) ? (d.css("display", "table"), t.css("width", u.width + "px")) : d.addClass(u.width)), u.height && "inherit" !== u.height) if (jQuery.isNumeric(u.height)) {
						var y = u.height;
						l && (y = Math.max(0, y - l.outerHeight())), p && (y = Math.max(0, y - p.outerHeight())), t.css("height", y + "px")
					} else d.addClass(u.height);
					this.$editor = d, this.$textarea = t, this.$editable = a, this.$oldContent = this.getContent(), this.__setListener(), this.__setEventListeners(), this.$editor.attr("id", (new Date).getTime()), this.$editor.on("click", '[data-provider="bootstrap-markdown"]', e.proxy(this.__handle, this)), (this.$element.is(":disabled") || this.$element.is("[readonly]")) && (this.$editor.addClass("md-editor-disabled"), this.disableButtons("all")), this.eventSupported("keydown") && "object" == typeof jQuery.hotkeys && l.find('[data-provider="bootstrap-markdown"]').each(function () {
						var n = e(this), r = n.attr("data-hotkey");
						"" !== r.toLowerCase() && t.bind("keydown", r, function () {
							return n.trigger("click"), !1
						})
					}), "preview" === u.initialstate ? this.showPreview() : "fullscreen" === u.initialstate && u.fullscreen.enable && this.setFullscreen(!0)
				} else this.$editor.show();
				return u.autofocus && (this.$textarea.focus(), this.$editor.addClass("active")), u.fullscreen.enable && !1 !== u.fullscreen && (this.$editor.append('<div class="md-fullscreen-controls"><a href="#" class="exit-fullscreen" title="Exit fullscreen"><span class="' + this.__getIcon(u.fullscreen.icons.fullscreenOff) + '"></span></a></div>'), this.$editor.on("click", ".exit-fullscreen", function (e) {
					e.preventDefault(), n.setFullscreen(!1)
				})), this.hideButtons(u.hiddenButtons), this.disableButtons(u.disabledButtons), u.dropZoneOptions && (this.$editor.dropzone ? (u.dropZoneOptions.init || (u.dropZoneOptions.init = function () {
					var e = 0;
					this.on("drop", function (n) {
						e = t.prop("selectionStart")
					}), this.on("success", function (n, r) {
						var i = t.val();
						t.val(i.substring(0, e) + "\n![description](" + r + ")\n" + i.substring(e))
					}), this.on("error", function (e, t, n) {
						console.log("Error:", t)
					})
				}), this.$editor.addClass("dropzone"), this.$editor.dropzone(u.dropZoneOptions)) : console.log("dropZoneOptions was configured, but DropZone was not detected.")), !0 === u.enableDropDataUri && this.$editor.on("drop", function (n) {
					var r = t.prop("selectionStart");
					n.stopPropagation(), n.preventDefault(), e.each(n.originalEvent.dataTransfer.files, function (e, n) {
						var i = new FileReader;
						i.onload = function (e) {
							var n = e.type.split("/")[0];
							return function (i) {
								var a = t.val();
								"image" === n ? t.val(a.substring(0, r) + '\n<img src="' + i.target.result + '" />\n' + a.substring(r)) : t.val(a.substring(0, r) + '\n<a href="' + i.target.result + '">Download ' + e.name + "</a>\n" + a.substring(r))
							}
						}(n), i.readAsDataURL(n)
					})
				}), u.onShow(this), this
			}, parseContent: function (e) {
				return e = e || this.$textarea.val(), this.$options.parser ? this.$options.parser(e) : "object" == typeof markdown ? markdown.toHTML(e) : "function" == typeof marked ? marked(e) : e
			}, showPreview: function () {
				var t, n, r = this.$options, i = this.$textarea, a = i.next(),
					s = e("<div/>", {class: "md-preview", "data-provider": "markdown-preview"});
				return !0 === this.$isPreview ? this : (this.$isPreview = !0, this.disableButtons("all").enableButtons("cmdPreview"), t = "string" == typeof(n = r.onPreview(this, s)) ? n : this.parseContent(), s.html(t), a && "md-footer" == a.attr("class") ? s.insertBefore(a) : i.parent().append(s), s.css({
					width: i.outerWidth() + "px",
					"min-height": i.outerHeight() + "px",
					height: "auto"
				}), this.$options.resize && s.css("resize", this.$options.resize), i.hide(), s.data("markdown", this), (this.$element.is(":disabled") || this.$element.is("[readonly]")) && (this.$editor.addClass("md-editor-disabled"), this.disableButtons("all")), this)
			}, hidePreview: function () {
				return this.$isPreview = !1, this.$editor.find('div[data-provider="markdown-preview"]').remove(), this.enableButtons("all"), this.disableButtons(this.$options.disabledButtons), this.$options.onPreviewEnd(this), this.$textarea.show(), this.__setListener(), this
			}, isDirty: function () {
				return this.$oldContent != this.getContent()
			}, getContent: function () {
				return this.$textarea.val()
			}, setContent: function (e) {
				return this.$textarea.val(e), this
			}, findSelection: function (e) {
				var t;
				if ((t = this.getContent().indexOf(e)) >= 0 && e.length > 0) {
					var n, r = this.getSelection();
					return this.setSelection(t, t + e.length), n = this.getSelection(), this.setSelection(r.start, r.end), n
				}
				return null
			}, getSelection: function () {
				var e = this.$textarea[0];
				return ("selectionStart" in e && function () {
					var t = e.selectionEnd - e.selectionStart;
					return {
						start: e.selectionStart,
						end: e.selectionEnd,
						length: t,
						text: e.value.substr(e.selectionStart, t)
					}
				} || function () {
					return null
				})()
			}, setSelection: function (e, t) {
				var n = this.$textarea[0];
				return ("selectionStart" in n && function () {
					n.selectionStart = e, n.selectionEnd = t
				} || function () {
					return null
				})()
			}, replaceSelection: function (e) {
				var t = this.$textarea[0];
				return ("selectionStart" in t && function () {
					return t.value = t.value.substr(0, t.selectionStart) + e + t.value.substr(t.selectionEnd, t.value.length), t.selectionStart = t.value.length, this
				} || function () {
					return t.value += e, jQuery(t)
				})()
			}, getNextTab: function () {
				if (0 === this.$nextTab.length) return null;
				var e, t = this.$nextTab.shift();
				return "function" == typeof t ? e = t() : "object" == typeof t && t.length > 0 && (e = t), e
			}, setNextTab: function (e, t) {
				if ("string" == typeof e) {
					var n = this;
					this.$nextTab.push(function () {
						return n.findSelection(e)
					})
				} else if ("number" == typeof e && "number" == typeof t) {
					var r = this.getSelection();
					this.setSelection(e, t), this.$nextTab.push(this.getSelection()), this.setSelection(r.start, r.end)
				}
			}, __parseButtonNameParam: function (e) {
				return "string" == typeof e ? e.split(" ") : e
			}, enableButtons: function (t) {
				var n = this.__parseButtonNameParam(t), r = this;
				return e.each(n, function (e, t) {
					r.__alterButtons(n[e], function (e) {
						e.removeAttr("disabled")
					})
				}), this
			}, disableButtons: function (t) {
				var n = this.__parseButtonNameParam(t), r = this;
				return e.each(n, function (e, t) {
					r.__alterButtons(n[e], function (e) {
						e.attr("disabled", "disabled")
					})
				}), this
			}, hideButtons: function (t) {
				var n = this.__parseButtonNameParam(t), r = this;
				return e.each(n, function (e, t) {
					r.__alterButtons(n[e], function (e) {
						e.addClass("hidden")
					})
				}), this
			}, showButtons: function (t) {
				var n = this.__parseButtonNameParam(t), r = this;
				return e.each(n, function (e, t) {
					r.__alterButtons(n[e], function (e) {
						e.removeClass("hidden")
					})
				}), this
			}, eventSupported: function (e) {
				var t = e in this.$element;
				return t || (this.$element.setAttribute(e, "return;"), t = "function" == typeof this.$element[e]), t
			}, keyup: function (t) {
				var n = !1;
				switch (t.keyCode) {
					case 40:
					case 38:
					case 16:
					case 17:
					case 18:
						break;
					case 9:
						var r;
						if (null !== (r = this.getNextTab())) {
							var i = this;
							setTimeout(function () {
								i.setSelection(r.start, r.end)
							}, 500), n = !0
						} else {
							var a = this.getSelection();
							a.start == a.end && a.end == this.getContent().length ? n = !1 : (this.setSelection(this.getContent().length, this.getContent().length), n = !0)
						}
						break;
					case 13:
						n = !1;
						for (var s = this.getContent().split(""), o = this.getSelection().start, u = -1, d = o - 2; d >= 0; d--) if ("\n" === s[d]) {
							u = d;
							break
						}
						var l = s[u + 1];
						if ("-" === l) this.addBullet(o); else if (e.isNumeric(l)) {
							var c = this.getBulletNumber(u + 1);
							c && this.addNumberedBullet(o, c)
						}
						break;
					case 27:
						this.$isFullscreen && this.setFullscreen(!1), n = !1;
						break;
					default:
						n = !1
				}
				n && (t.stopPropagation(), t.preventDefault()), this.$options.onChange(this)
			}, insertContent: function (e, t) {
				var n = this.getContent().slice(0, e), r = this.getContent().slice(e + 1);
				this.setContent(n.concat(t).concat(r))
			}, addBullet: function (e) {
				this.insertContent(e, "- \n"), this.setSelection(e + 2, e + 2)
			}, addNumberedBullet: function (e, t) {
				var n = t + 1 + ". \n";
				this.insertContent(e, n);
				var r = t.toString().length + 2;
				this.setSelection(e + r, e + r)
			}, getBulletNumber: function (t) {
				var n = this.getContent().slice(t).split(".")[0];
				return e.isNumeric(n) ? parseInt(n) : null
			}, change: function (e) {
				return this.$options.onChange(this), this
			}, select: function (e) {
				return this.$options.onSelect(this), this
			}, focus: function (t) {
				var n = this.$options, r = (n.hideable, this.$editor);
				return r.addClass("active"), e(document).find(".md-editor").each(function () {
					var t;
					e(this).attr("id") !== r.attr("id") && (null === (t = e(this).find("textarea").data("markdown")) && (t = e(this).find('div[data-provider="markdown-preview"]').data("markdown")), t && t.blur())
				}), n.onFocus(this), this
			}, blur: function (t) {
				var n = this.$options, r = n.hideable, i = this.$editor, a = this.$editable;
				if (i.hasClass("active") || 0 === this.$element.parent().length) {
					if (i.removeClass("active"), r) if (null !== a.el) {
						var s = e("<" + a.type + "/>"), o = this.getContent(), u = this.parseContent(o);
						e(a.attrKeys).each(function (e, t) {
							s.attr(a.attrKeys[e], a.attrValues[e])
						}), s.html(u), i.replaceWith(s)
					} else i.hide();
					n.onBlur(this)
				}
				return this
			}
		};
		var n = e.fn.markdown;
		e.fn.markdown = function (n) {
			return this.each(function () {
				var r = e(this), i = r.data("markdown"), a = "object" == typeof n && n;
				i || r.data("markdown", i = new t(this, a))
			})
		}, e.fn.markdown.messages = {}, e.fn.markdown.defaults = {
			autofocus: !1,
			hideable: !1,
			savable: !1,
			width: "inherit",
			height: "inherit",
			resize: !0,
			iconlibrary: "fa",
			language: "en",
			initialstate: "editor",
			parser: null,
			dropZoneOptions: null,
			enableDropDataUri: !1,
			buttons: [[{
				name: "groupFont",
				data: [{
					name: "cmdBold",
					hotkey: "Ctrl+B",
					title: "Bold",
					icon: {fa: "fas fa-bold"},
					callback: function (e) {
						var t, n, r = e.getSelection(), i = e.getContent();
						t = 0 === r.length ? e.__localize("strong text") : r.text, "**" === i.substr(r.start - 2, 2) && "**" === i.substr(r.end, 2) ? (e.setSelection(r.start - 2, r.end + 2), e.replaceSelection(t), n = r.start - 2) : (e.replaceSelection("**" + t + "**"), n = r.start + 2), e.setSelection(n, n + t.length)
					}
				}, {
					name: "cmdItalic",
					title: "Italic",
					hotkey: "Ctrl+I",
					icon: {fa: "fas fa-italic"},
					callback: function (e) {
						var t, n, r = e.getSelection(), i = e.getContent();
						t = 0 === r.length ? e.__localize("emphasized text") : r.text, "_" === i.substr(r.start - 1, 1) && "_" === i.substr(r.end, 1) ? (e.setSelection(r.start - 1, r.end + 1), e.replaceSelection(t), n = r.start - 1) : (e.replaceSelection("_" + t + "_"), n = r.start + 1), e.setSelection(n, n + t.length)
					}
				}, {
					name: "cmdHeading",
					title: "Heading",
					hotkey: "Ctrl+H",
					icon: {fa: "fas fa-heading"},
					callback: function (e) {
						var t, n, r, i, a = e.getSelection(), s = e.getContent();
						t = 0 === a.length ? e.__localize("heading text") : a.text + "\n", r = 4, "### " === s.substr(a.start - r, r) || (r = 3, "###" === s.substr(a.start - r, r)) ? (e.setSelection(a.start - r, a.end), e.replaceSelection(t), n = a.start - r) : a.start > 0 && ((i = s.substr(a.start - 1, 1)) && "\n" != i) ? (e.replaceSelection("\n\n### " + t), n = a.start + 6) : (e.replaceSelection("### " + t), n = a.start + 4), e.setSelection(n, n + t.length)
					}
				}]
			}, {
				name: "groupLink",
				data: [{
					name: "cmdUrl",
					title: "URL/Link",
					hotkey: "Ctrl+L",
					icon: {fa: "fas fa-link"},
					callback: function (t) {
						var n, r, i, a = t.getSelection();
						t.getContent();
						n = 0 === a.length ? t.__localize("enter link description here") : a.text, i = prompt(t.__localize("Insert Hyperlink"), "http://");
						var s = new RegExp("^((http|https)://|(mailto:)|(//))[a-z0-9]", "i");
						if (null !== i && "" !== i && "http://" !== i && s.test(i)) {
							var o = e("<div>" + i + "</div>").text();
							t.replaceSelection("[" + n + "](" + o + ")"), r = a.start + 1, t.setSelection(r, r + n.length)
						}
					}
				}, {
					name: "cmdImage",
					title: "Image",
					hotkey: "Ctrl+G",
					icon: {fa: "fas fa-image"},
					callback: function (t) {
						var n, r, i, a = t.getSelection();
						t.getContent();
						n = 0 === a.length ? t.__localize("enter image description here") : a.text, i = prompt(t.__localize("Insert Image Hyperlink"), "http://");
						var s = new RegExp("^((http|https)://|(//))[a-z0-9]", "i");
						if (null !== i && "" !== i && "http://" !== i && s.test(i)) {
							var o = e("<div>" + i + "</div>").text();
							t.replaceSelection("![" + n + "](" + o + ' "' + t.__localize("enter image title here") + '")'), r = a.start + 2, t.setNextTab(t.__localize("enter image title here")), t.setSelection(r, r + n.length)
						}
					}
				}]
			}, {
				name: "groupMisc",
				data: [{
					name: "cmdList",
					hotkey: "Ctrl+U",
					title: "Unordered List",
					icon: {fa: "fas fa-list"},
					callback: function (t) {
						var n, r, i = t.getSelection();
						t.getContent();
						if (0 === i.length) n = t.__localize("list text here"), t.replaceSelection("- " + n), r = i.start + 2; else if (i.text.indexOf("\n") < 0) n = i.text, t.replaceSelection("- " + n), r = i.start + 2; else {
							var a = [];
							n = (a = i.text.split("\n"))[0], e.each(a, function (e, t) {
								a[e] = "- " + t
							}), t.replaceSelection("\n\n" + a.join("\n")), r = i.start + 4
						}
						t.setSelection(r, r + n.length)
					}
				}, {
					name: "cmdListO",
					hotkey: "Ctrl+O",
					title: "Ordered List",
					icon: {fa: "fas fa-list-ol"},
					callback: function (t) {
						var n, r, i = t.getSelection();
						t.getContent();
						if (0 === i.length) n = t.__localize("list text here"), t.replaceSelection("1. " + n), r = i.start + 3; else if (i.text.indexOf("\n") < 0) n = i.text, t.replaceSelection("1. " + n), r = i.start + 3; else {
							var a = 1, s = [];
							n = (s = i.text.split("\n"))[0], e.each(s, function (e, t) {
								s[e] = a + ". " + t, a++
							}), t.replaceSelection("\n\n" + s.join("\n")), r = i.start + 5
						}
						t.setSelection(r, r + n.length)
					}
				}, {
					name: "cmdCode",
					hotkey: "Ctrl+K",
					title: "Code",
					icon: {fa: "fas fa-code"},
					callback: function (e) {
						var t, n, r = e.getSelection(), i = e.getContent();
						t = 0 === r.length ? e.__localize("code text here") : r.text, "```\n" === i.substr(r.start - 4, 4) && "\n```" === i.substr(r.end, 4) ? (e.setSelection(r.start - 4, r.end + 4), e.replaceSelection(t), n = r.start - 4) : "`" === i.substr(r.start - 1, 1) && "`" === i.substr(r.end, 1) ? (e.setSelection(r.start - 1, r.end + 1), e.replaceSelection(t), n = r.start - 1) : i.indexOf("\n") > -1 ? (e.replaceSelection("```\n" + t + "\n```"), n = r.start + 4) : (e.replaceSelection("`" + t + "`"), n = r.start + 1), e.setSelection(n, n + t.length)
					}
				}, {
					name: "cmdQuote",
					hotkey: "Ctrl+Q",
					title: "Quote",
					icon: {fa: "fas fa-quote-left"},
					callback: function (t) {
						var n, r, i = t.getSelection();
						t.getContent();
						if (0 === i.length) n = t.__localize("quote here"), t.replaceSelection("> " + n), r = i.start + 2; else if (i.text.indexOf("\n") < 0) n = i.text, t.replaceSelection("> " + n), r = i.start + 2; else {
							var a = [];
							n = (a = i.text.split("\n"))[0], e.each(a, function (e, t) {
								a[e] = "> " + t
							}), t.replaceSelection("\n\n" + a.join("\n")), r = i.start + 4
						}
						t.setSelection(r, r + n.length)
					}
				}]
			}, {
				name: "groupUtil",
				data: [{
					name: "cmdPreview",
					toggle: !0,
					hotkey: "Ctrl+P",
					title: "Preview",
					btnText: "Preview",
					btnClass: "btn btn-primary btn-sm",
					icon: {fa: "fas fa-search"},
					callback: function (e) {
						!1 === e.$isPreview ? e.showPreview() : e.hidePreview()
					}
				}]
			}]],
			customIcons: {},
			additionalButtons: [],
			reorderButtonGroups: [],
			hiddenButtons: [],
			disabledButtons: [],
			footer: "",
			fullscreen: {
				enable: !1,
				icons: {
					fullscreenOn: {name: "fullscreenOn", icon: {fa: "fas fa-expand"}},
					fullscreenOff: {name: "fullscreenOff", icon: {fa: "fas fa-compress"}}
				}
			},
			onShow: function (e) {
			},
			onPreview: function (e) {
			},
			onPreviewEnd: function (e) {
			},
			onSave: function (e) {
			},
			onBlur: function (e) {
			},
			onFocus: function (e) {
			},
			onChange: function (e) {
			},
			onFullscreen: function (e) {
			},
			onFullscreenExit: function (e) {
			},
			onSelect: function (e) {
			}
		}, e.fn.markdown.Constructor = t, e.fn.markdown.noConflict = function () {
			return e.fn.markdown = n, this
		};
		var r = function (e) {
			var t = e;
			t.data("markdown") ? t.data("markdown").showEditor() : t.markdown()
		};
		e(document).on("click.markdown.data-api", '[data-provide="markdown-editable"]', function (t) {
			r(e(this)), t.preventDefault()
		}).on("click focusin", function (t) {
			var n;
			n = e(document.activeElement), e(document).find(".md-editor").each(function () {
				var t = e(this), r = n.closest(".md-editor")[0] === this,
					i = t.find("textarea").data("markdown") || t.find('div[data-provider="markdown-preview"]').data("markdown");
				i && !r && i.blur()
			})
		}).ready(function () {
			e('textarea[data-provide="markdown"]').each(function () {
				r(e(this))
			})
		})
	}, i = [n(2)], void 0 === (a = "function" == typeof(r = s) ? r.apply(t, i) : r) || (e.exports = a)
}, function (e, t) {
	var n;
	(n = jQuery).easyPieChart = function (e, t) {
		var r, i, a, s, o, u, d, l, c = this;
		return this.el = e, this.$el = n(e), this.$el.data("easyPieChart", this), this.init = function () {
			var e, r;
			return c.options = n.extend({}, n.easyPieChart.defaultOptions, t), e = parseInt(c.$el.data("percent"), 10), c.percentage = 0, c.canvas = n("<canvas width='" + c.options.size + "' height='" + c.options.size + "'></canvas>").get(0), c.$el.append(c.canvas), "undefined" != typeof G_vmlCanvasManager && null !== G_vmlCanvasManager && G_vmlCanvasManager.initElement(c.canvas), c.ctx = c.canvas.getContext("2d"), window.devicePixelRatio > 1 && (r = window.devicePixelRatio, n(c.canvas).css({
				width: c.options.size,
				height: c.options.size
			}), c.canvas.width *= r, c.canvas.height *= r, c.ctx.scale(r, r)), c.ctx.translate(c.options.size / 2, c.options.size / 2), c.ctx.rotate(c.options.rotate * Math.PI / 180), c.$el.addClass("easyPieChart"), c.$el.css({
				width: c.options.size,
				height: c.options.size,
				lineHeight: c.options.size + "px"
			}), c.update(e), c
		}, this.update = function (e) {
			return e = parseFloat(e) || 0, !1 === c.options.animate ? a(e) : c.options.delay ? (i(c.percentage, 0), setTimeout(function () {
				return i(c.percentage, e)
			}, c.options.delay)) : i(c.percentage, e), c
		}, d = function () {
			var e, t, n;
			for (c.ctx.fillStyle = c.options.scaleColor, c.ctx.lineWidth = 1, n = [], e = t = 0; t <= 24; e = ++t) n.push(r(e));
			return n
		}, r = function (e) {
			var t;
			t = e % 6 == 0 ? 0 : .017 * c.options.size, c.ctx.save(), c.ctx.rotate(e * Math.PI / 12), c.ctx.fillRect(c.options.size / 2 - t, 0, .05 * -c.options.size + t, 1), c.ctx.restore()
		}, l = function () {
			var e;
			e = c.options.size / 2 - c.options.lineWidth / 2, !1 !== c.options.scaleColor && (e -= .08 * c.options.size), c.ctx.beginPath(), c.ctx.arc(0, 0, e, 0, 2 * Math.PI, !0), c.ctx.closePath(), c.ctx.strokeStyle = c.options.trackColor, c.ctx.lineWidth = c.options.lineWidth, c.ctx.stroke()
		}, u = function () {
			!1 !== c.options.scaleColor && d(), !1 !== c.options.trackColor && l()
		}, a = function (e) {
			var t;
			u(), c.ctx.strokeStyle = n.isFunction(c.options.barColor) ? c.options.barColor(e) : c.options.barColor, c.ctx.lineCap = c.options.lineCap, c.ctx.lineWidth = c.options.lineWidth, t = c.options.size / 2 - c.options.lineWidth / 2, !1 !== c.options.scaleColor && (t -= .08 * c.options.size), c.ctx.save(), c.ctx.rotate(-Math.PI / 2), c.ctx.beginPath(), c.ctx.arc(0, 0, t, 0, 2 * Math.PI * e / 100, !1), c.ctx.stroke(), c.ctx.restore()
		}, o = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function (e) {
			return window.setTimeout(e, 1e3 / 60)
		}, i = function (e, t) {
			var n, r;
			c.options.onStart.call(c), c.percentage = t, Date.now || (Date.now = function () {
				return +new Date
			}), r = Date.now(), o(n = function () {
				var i, d;
				return d = Math.min(Date.now() - r, c.options.animate), c.ctx.clearRect(-c.options.size / 2, -c.options.size / 2, c.options.size, c.options.size), u.call(c), i = [s(d, e, t - e, c.options.animate)], c.options.onStep.call(c, i), a.call(c, i), d >= c.options.animate ? c.options.onStop.call(c, i, t) : o(n)
			})
		}, s = function (e, t, n, r) {
			var i;
			return i = function (e) {
				return Math.pow(e, 2)
			}, n / 2 * function (e) {
				return e < 1 ? i(e) : 2 - i(e / 2 * -2 + 2)
			}(e /= r / 2) + t
		}, this.init()
	}, n.easyPieChart.defaultOptions = {
		barColor: "#ef1e25",
		trackColor: "#f2f2f2",
		scaleColor: "#dfe0e0",
		lineCap: "round",
		rotate: 0,
		size: 110,
		lineWidth: 3,
		animate: !1,
		delay: !1,
		onStart: n.noop,
		onStop: n.noop,
		onStep: n.noop
	}, n.fn.easyPieChart = function (e) {
		return n.each(this, function (t, r) {
			var i, a;
			if (!(i = n(r)).data("easyPieChart")) return a = n.extend({}, e, i.data()), i.data("easyPieChart", new n.easyPieChart(r, a))
		})
	}
}, function (e, t) {
}, function (e, t) {
}]);