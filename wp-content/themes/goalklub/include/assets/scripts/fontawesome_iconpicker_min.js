! function(a, b) {
    function c(a, b, c) {
        return [parseFloat(a[0]) * (n.test(a[0]) ? b / 100 : 1), parseFloat(a[1]) * (n.test(a[1]) ? c / 100 : 1)]
    }

    function d(b, c) {
        return parseInt(a.css(b, c), 10) || 0
    }

    function e(b) {
        var c = b[0];
        return 9 === c.nodeType ? {
            width: b.width(),
            height: b.height(),
            offset: {
                top: 0,
                left: 0
            }
        } : a.isWindow(c) ? {
            width: b.width(),
            height: b.height(),
            offset: {
                top: b.scrollTop(),
                left: b.scrollLeft()
            }
        } : c.preventDefault ? {
            width: 0,
            height: 0,
            offset: {
                top: c.pageY,
                left: c.pageX
            }
        } : {
            width: b.outerWidth(),
            height: b.outerHeight(),
            offset: b.offset()
        }
    }
    a.ui = a.ui || {};
    var f, g = Math.max,
        h = Math.abs,
        i = Math.round,
        j = /left|center|right/,
        k = /top|center|bottom/,
        l = /[\+\-]\d+(\.[\d]+)?%?/,
        m = /^\w+/,
        n = /%$/,
        o = a.fn.pos;
    a.pos = {
            scrollbarWidth: function() {
                if (f !== b) return f;
                var c, d, e = a("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                    g = e.children()[0];
                return a("body").append(e), c = g.offsetWidth, e.css("overflow", "scroll"), d = g.offsetWidth, c === d && (d = e[0].clientWidth), e.remove(), f = c - d
            },
            getScrollInfo: function(b) {
                var c = b.isWindow || b.isDocument ? "" : b.element.css("overflow-x"),
                    d = b.isWindow || b.isDocument ? "" : b.element.css("overflow-y"),
                    e = "scroll" === c || "auto" === c && b.width < b.element[0].scrollWidth,
                    f = "scroll" === d || "auto" === d && b.height < b.element[0].scrollHeight;
                return {
                    width: f ? a.pos.scrollbarWidth() : 0,
                    height: e ? a.pos.scrollbarWidth() : 0
                }
            },
            getWithinInfo: function(b) {
                var c = a(b || window),
                    d = a.isWindow(c[0]),
                    e = !!c[0] && 9 === c[0].nodeType;
                return {
                    element: c,
                    isWindow: d,
                    isDocument: e,
                    offset: c.offset() || {
                        left: 0,
                        top: 0
                    },
                    scrollLeft: c.scrollLeft(),
                    scrollTop: c.scrollTop(),
                    width: d ? c.width() : c.outerWidth(),
                    height: d ? c.height() : c.outerHeight()
                }
            }
        }, a.fn.pos = function(b) {
            if (!b || !b.of) return o.apply(this, arguments);
            b = a.extend({}, b);
            var f, n, p, q, r, s, t = a(b.of),
                u = a.pos.getWithinInfo(b.within),
                v = a.pos.getScrollInfo(u),
                w = (b.collision || "flip").split(" "),
                x = {};
            return s = e(t), t[0].preventDefault && (b.at = "left top"), n = s.width, p = s.height, q = s.offset, r = a.extend({}, q), a.each(["my", "at"], function() {
                var a, c, d = (b[this] || "").split(" ");
                1 === d.length && (d = j.test(d[0]) ? d.concat(["center"]) : k.test(d[0]) ? ["center"].concat(d) : ["center", "center"]), d[0] = j.test(d[0]) ? d[0] : "center", d[1] = k.test(d[1]) ? d[1] : "center", a = l.exec(d[0]), c = l.exec(d[1]), x[this] = [a ? a[0] : 0, c ? c[0] : 0], b[this] = [m.exec(d[0])[0], m.exec(d[1])[0]]
            }), 1 === w.length && (w[1] = w[0]), "right" === b.at[0] ? r.left += n : "center" === b.at[0] && (r.left += n / 2), "bottom" === b.at[1] ? r.top += p : "center" === b.at[1] && (r.top += p / 2), f = c(x.at, n, p), r.left += f[0], r.top += f[1], this.each(function() {
                var e, j, k = a(this),
                    l = k.outerWidth(),
                    m = k.outerHeight(),
                    o = d(this, "marginLeft"),
                    s = d(this, "marginTop"),
                    y = l + o + d(this, "marginRight") + v.width,
                    z = m + s + d(this, "marginBottom") + v.height,
                    A = a.extend({}, r),
                    B = c(x.my, k.outerWidth(), k.outerHeight());
                "right" === b.my[0] ? A.left -= l : "center" === b.my[0] && (A.left -= l / 2), "bottom" === b.my[1] ? A.top -= m : "center" === b.my[1] && (A.top -= m / 2), A.left += B[0], A.top += B[1], a.support.offsetFractions || (A.left = i(A.left), A.top = i(A.top)), e = {
                    marginLeft: o,
                    marginTop: s
                }, a.each(["left", "top"], function(c, d) {
                    a.ui.pos[w[c]] && a.ui.pos[w[c]][d](A, {
                        targetWidth: n,
                        targetHeight: p,
                        elemWidth: l,
                        elemHeight: m,
                        collisionPosition: e,
                        collisionWidth: y,
                        collisionHeight: z,
                        offset: [f[0] + B[0], f[1] + B[1]],
                        my: b.my,
                        at: b.at,
                        within: u,
                        elem: k
                    })
                }), b.using && (j = function(a) {
                    var c = q.left - A.left,
                        d = c + n - l,
                        e = q.top - A.top,
                        f = e + p - m,
                        i = {
                            target: {
                                element: t,
                                left: q.left,
                                top: q.top,
                                width: n,
                                height: p
                            },
                            element: {
                                element: k,
                                left: A.left,
                                top: A.top,
                                width: l,
                                height: m
                            },
                            horizontal: 0 > d ? "left" : c > 0 ? "right" : "center",
                            vertical: 0 > f ? "top" : e > 0 ? "bottom" : "middle"
                        };
                    l > n && h(c + d) < n && (i.horizontal = "center"), m > p && h(e + f) < p && (i.vertical = "middle"), i.important = g(h(c), h(d)) > g(h(e), h(f)) ? "horizontal" : "vertical", b.using.call(this, a, i)
                }), k.offset(a.extend(A, {
                    using: j
                }))
            })
        }, a.ui.pos = {
            _trigger: function(a, b, c, d) {
                b.elem && b.elem.trigger({
                    type: c,
                    position: a,
                    positionData: b,
                    triggered: d
                })
            },
            fit: {
                left: function(b, c) {
                    a.ui.pos._trigger(b, c, "posCollide", "fitLeft");
                    var d, e = c.within,
                        f = e.isWindow ? e.scrollLeft : e.offset.left,
                        h = e.width,
                        i = b.left - c.collisionPosition.marginLeft,
                        j = f - i,
                        k = i + c.collisionWidth - h - f;
                    c.collisionWidth > h ? j > 0 && 0 >= k ? (d = b.left + j + c.collisionWidth - h - f, b.left += j - d) : b.left = k > 0 && 0 >= j ? f : j > k ? f + h - c.collisionWidth : f : j > 0 ? b.left += j : k > 0 ? b.left -= k : b.left = g(b.left - i, b.left), a.ui.pos._trigger(b, c, "posCollided", "fitLeft")
                },
                top: function(b, c) {
                    a.ui.pos._trigger(b, c, "posCollide", "fitTop");
                    var d, e = c.within,
                        f = e.isWindow ? e.scrollTop : e.offset.top,
                        h = c.within.height,
                        i = b.top - c.collisionPosition.marginTop,
                        j = f - i,
                        k = i + c.collisionHeight - h - f;
                    c.collisionHeight > h ? j > 0 && 0 >= k ? (d = b.top + j + c.collisionHeight - h - f, b.top += j - d) : b.top = k > 0 && 0 >= j ? f : j > k ? f + h - c.collisionHeight : f : j > 0 ? b.top += j : k > 0 ? b.top -= k : b.top = g(b.top - i, b.top), a.ui.pos._trigger(b, c, "posCollided", "fitTop")
                }
            },
            flip: {
                left: function(b, c) {
                    a.ui.pos._trigger(b, c, "posCollide", "flipLeft");
                    var d, e, f = c.within,
                        g = f.offset.left + f.scrollLeft,
                        i = f.width,
                        j = f.isWindow ? f.scrollLeft : f.offset.left,
                        k = b.left - c.collisionPosition.marginLeft,
                        l = k - j,
                        m = k + c.collisionWidth - i - j,
                        n = "left" === c.my[0] ? -c.elemWidth : "right" === c.my[0] ? c.elemWidth : 0,
                        o = "left" === c.at[0] ? c.targetWidth : "right" === c.at[0] ? -c.targetWidth : 0,
                        p = -2 * c.offset[0];
                    0 > l ? (d = b.left + n + o + p + c.collisionWidth - i - g, (0 > d || d < h(l)) && (b.left += n + o + p)) : m > 0 && (e = b.left - c.collisionPosition.marginLeft + n + o + p - j, (e > 0 || h(e) < m) && (b.left += n + o + p)), a.ui.pos._trigger(b, c, "posCollided", "flipLeft")
                },
                top: function(b, c) {
                    a.ui.pos._trigger(b, c, "posCollide", "flipTop");
                    var d, e, f = c.within,
                        g = f.offset.top + f.scrollTop,
                        i = f.height,
                        j = f.isWindow ? f.scrollTop : f.offset.top,
                        k = b.top - c.collisionPosition.marginTop,
                        l = k - j,
                        m = k + c.collisionHeight - i - j,
                        n = "top" === c.my[1],
                        o = n ? -c.elemHeight : "bottom" === c.my[1] ? c.elemHeight : 0,
                        p = "top" === c.at[1] ? c.targetHeight : "bottom" === c.at[1] ? -c.targetHeight : 0,
                        q = -2 * c.offset[1];
                    0 > l ? (e = b.top + o + p + q + c.collisionHeight - i - g, b.top + o + p + q > l && (0 > e || e < h(l)) && (b.top += o + p + q)) : m > 0 && (d = b.top - c.collisionPosition.marginTop + o + p + q - j, b.top + o + p + q > m && (d > 0 || h(d) < m) && (b.top += o + p + q)), a.ui.pos._trigger(b, c, "posCollided", "flipTop")
                }
            },
            flipfit: {
                left: function() {
                    a.ui.pos.flip.left.apply(this, arguments), a.ui.pos.fit.left.apply(this, arguments)
                },
                top: function() {
                    a.ui.pos.flip.top.apply(this, arguments), a.ui.pos.fit.top.apply(this, arguments)
                }
            }
        },
        function() {
            var b, c, d, e, f, g = document.getElementsByTagName("body")[0],
                h = document.createElement("div");
            b = document.createElement(g ? "div" : "body"), d = {
                visibility: "hidden",
                width: 0,
                height: 0,
                border: 0,
                margin: 0,
                background: "none"
            }, g && a.extend(d, {
                position: "absolute",
                left: "-1000px",
                top: "-1000px"
            });
            for (f in d) b.style[f] = d[f];
            b.appendChild(h), c = g || document.documentElement, c.insertBefore(b, c.firstChild), h.style.cssText = "position: absolute; left: 10.7432222px;", e = a(h).offset().left, a.support.offsetFractions = e > 10 && 11 > e, b.innerHTML = "", c.removeChild(b)
        }()
}(jQuery),
function(a) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], a) : window.jQuery && !window.jQuery.fn.iconpicker && a(window.jQuery)
}(function(a) {
    "use strict";
    var b = {
            isEmpty: function(a) {
                return a === !1 || "" === a || null === a || void 0 === a
            },
            isEmptyObject: function(a) {
                return this.isEmpty(a) === !0 || 0 === a.length
            },
            isElement: function(b) {
                return a(b).length > 0
            },
            isString: function(a) {
                return "string" == typeof a || a instanceof String
            },
            isArray: function(b) {
                return a.isArray(b)
            },
            inArray: function(b, c) {
                return -1 !== a.inArray(b, c)
            },
            throwError: function(a) {
                throw "Font Awesome Icon Picker Exception: " + a
            }
        },
        c = function(d, e) {
            this._id = c._idCounter++, this.element = a(d).addClass("iconpicker-element"), this._trigger("iconpickerCreate"), this.options = a.extend({}, c.defaultOptions, this.element.data(), e), this.options.templates = a.extend({}, c.defaultOptions.templates, this.options.templates), this.options.originalPlacement = this.options.placement, this.container = b.isElement(this.options.container) ? a(this.options.container) : !1, this.container === !1 && (this.container = this.element.is("input") ? this.element.parent() : this.element), this.container.addClass("iconpicker-container").is(".dropdown-menu") && (this.options.placement = "inline"), this.input = this.element.is("input") ? this.element.addClass("iconpicker-input") : !1, this.input === !1 && (this.input = this.container.find(this.options.input)), this.component = this.container.find(this.options.component).addClass("iconpicker-component"), 0 === this.component.length ? this.component = !1 : this.component.find("i").addClass(this.options.iconComponentBaseClass), this._createPopover(), this._createIconpicker(), 0 === this.getAcceptButton().length && (this.options.mustAccept = !1), this.container.is(".input-group") ? this.container.parent().append(this.popover) : this.container.append(this.popover), this._bindElementEvents(), this._bindWindowEvents(), this.update(this.options.selected), this.isInline() && this.show(), this._trigger("iconpickerCreated")
        };
    c._idCounter = 0, c.defaultOptions = {
        title: !1,
        selected: !1,
        defaultValue: !1,
        placement: "bottom",
        collision: "none",
        animation: !0,
        hideOnSelect: !1,
        showFooter: !1,
        searchInFooter: !1,
        mustAccept: !1,
        selectedCustomClass: "bg-primary",
        icons: [],
        iconBaseClass: "fa",
        iconComponentBaseClass: "icon-fw",
        iconClassPrefix: "fa-",
        input: "input",
        component: ".input-group-addon",
        container: !1,
        templates: {
            popover: '<div class="iconpicker-popover popover"><div class="arrow"></div><div class="popover-title"></div><div class="popover-content"></div></div>',
            footer: '<div class="popover-footer"></div>',
            buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button> <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
            search: '<input type="search" name="search[]" class="form-control iconpicker-search" placeholder="Type to filter" />',
            iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
            iconpickerItem: '<div class="iconpicker-item"><i></i></div>'
        }
    }, c.batch = function(b, c) {
        var d = Array.prototype.slice.call(arguments, 2);
        return a(b).each(function() {
            var b = a(this).data("iconpicker");
            b && b[c].apply(b, d)
        })
    }, c.prototype = {
        constructor: c,
        options: {},
        _id: 0,
        _trigger: function(b, c) {
            c = c || {}, this.element.trigger(a.extend({
                type: b,
                iconpickerInstance: this
            }, c))
        },
        _createPopover: function() {
            this.popover = a(this.options.templates.popover);
            var c = this.popover.find(".popover-title");
            if (this.options.title && c.append(a('<div class="popover-title-text">' + this.options.title + "</div>")), this.options.searchInFooter || b.isEmpty(this.options.templates.buttons) ? this.options.title || c.remove() : c.append(this.options.templates.search), this.options.showFooter && !b.isEmpty(this.options.templates.footer)) {
                var d = a(this.options.templates.footer);
                !b.isEmpty(this.options.templates.search) && this.options.searchInFooter && d.append(a(this.options.templates.search)), b.isEmpty(this.options.templates.buttons) || d.append(a(this.options.templates.buttons)), this.popover.append(d)
            }
            return this.options.animation === !0 && this.popover.addClass("fade"), this.popover
        },
        _createIconpicker: function() {
            var b = this;
            this.iconpicker = a(this.options.templates.iconpicker);
            var c = function() {
                var c = a(this);
                c.is("." + b.options.iconBaseClass) && (c = c.parent()), b._trigger("iconpickerSelect", {
                    iconpickerItem: c,
                    iconpickerValue: b.iconpickerValue
                }), b.options.mustAccept === !1 ? (b.update(c.data("iconpickerValue")), b._trigger("iconpickerSelected", {
                    iconpickerItem: this,
                    iconpickerValue: b.iconpickerValue
                })) : b.update(c.data("iconpickerValue"), !0), b.options.hideOnSelect && b.options.mustAccept === !1 && b.hide()
            };
            for (var d in this.options.icons) {
                var e = a(this.options.templates.iconpickerItem);
                e.find("i").addClass(b.options.iconBaseClass + " " + this.options.iconClassPrefix + this.options.icons[d]), e.data("iconpickerValue", this.options.icons[d]).on("click.iconpicker", c), this.iconpicker.find(".iconpicker-items").append(e.attr("title", "." + this.getValue(this.options.icons[d])))
            }
            return this.popover.find(".popover-content").append(this.iconpicker), this.iconpicker
        },
        _isEventInsideIconpicker: function(b) {
            var c = a(b.target);
            return c.hasClass("iconpicker-element") && (!c.hasClass("iconpicker-element") || c.is(this.element)) || 0 !== c.parents(".iconpicker-popover").length ? !0 : !1
        },
        _bindElementEvents: function() {
            var c = this;
            this.getSearchInput().on("keyup", function() {
                c.filter(a(this).val().toLowerCase())
            }), this.getAcceptButton().on("click.iconpicker", function() {
                var a = c.iconpicker.find(".iconpicker-selected").get(0);
                c.update(c.iconpickerValue), c._trigger("iconpickerSelected", {
                    iconpickerItem: a,
                    iconpickerValue: c.iconpickerValue
                }), c.isInline() || c.hide()
            }), this.getCancelButton().on("click.iconpicker", function() {
                c.isInline() || c.hide()
            }), this.element.on("focus.iconpicker", function(a) {
                c.show(), a.stopPropagation()
            }), this.hasComponent() && this.component.on("click.iconpicker", function() {
                c.toggle()
            }), this.hasInput() && this.input.on("keyup.iconpicker", function(a) {
                b.inArray(a.keyCode, [38, 40, 37, 39, 16, 17, 18, 9, 8, 91, 93, 20, 46, 186, 190, 46, 78, 188, 44, 86]) ? c._updateFormGroupStatus(c.getValid(this.value) !== !1) : c.update()
            })
        },
        _bindWindowEvents: function() {
            var b = a(window.document),
                c = this,
                d = ".iconpicker.inst" + this._id;
            return a(window).on("resize.iconpicker" + d + " orientationchange.iconpicker" + d, function() {
                c.popover.hasClass("in") && c.updatePlacement()
            }), c.isInline() || b.on("mouseup" + d, function(a) {
                return c._isEventInsideIconpicker(a) || c.isInline() || c.hide(), a.stopPropagation(), a.preventDefault(), !1
            }), !1
        },
        _unbindElementEvents: function() {
            this.popover.off(".iconpicker"), this.element.off(".iconpicker"), this.hasInput() && this.input.off(".iconpicker"), this.hasComponent() && this.component.off(".iconpicker"), this.hasContainer() && this.container.off(".iconpicker")
        },
        _unbindWindowEvents: function() {
            a(window).off(".iconpicker.inst" + this._id), a(window.document).off(".iconpicker.inst" + this._id)
        },
        updatePlacement: function(b, c) {
            b = b || this.options.placement, this.options.placement = b, c = c || this.options.collision, c = c === !0 ? "flip" : c;
            var d = {
                at: "right bottom",
                my: "right top",
                of: this.hasInput() ? this.input : this.container,
                collision: c === !0 ? "flip" : c,
                within: window
            };
            if (this.popover.removeClass("inline topLeftCorner topLeft top topRight topRightCorner rightTop right rightBottom bottomRight bottomRightCorner bottom bottomLeft bottomLeftCorner leftBottom left leftTop"), "object" == typeof b) return this.popover.pos(a.extend({}, d, b));
            switch (b) {
                case "inline":
                    d = !1;
                    break;
                case "topLeftCorner":
                    d.my = "right bottom", d.at = "left top";
                    break;
                case "topLeft":
                    d.my = "left bottom", d.at = "left top";
                    break;
                case "top":
                    d.my = "center bottom", d.at = "center top";
                    break;
                case "topRight":
                    d.my = "right bottom", d.at = "right top";
                    break;
                case "topRightCorner":
                    d.my = "left bottom", d.at = "right top";
                    break;
                case "rightTop":
                    d.my = "left bottom", d.at = "right center";
                    break;
                case "right":
                    d.my = "left center", d.at = "right center";
                    break;
                case "rightBottom":
                    d.my = "left top", d.at = "right center";
                    break;
                case "bottomRightCorner":
                    d.my = "left top", d.at = "right bottom";
                    break;
                case "bottomRight":
                    d.my = "right top", d.at = "right bottom";
                    break;
                case "bottom":
                    d.my = "center top", d.at = "center bottom";
                    break;
                case "bottomLeft":
                    d.my = "left top", d.at = "left bottom";
                    break;
                case "bottomLeftCorner":
                    d.my = "right top", d.at = "left bottom";
                    break;
                case "leftBottom":
                    d.my = "right top", d.at = "left center";
                    break;
                case "left":
                    d.my = "right center", d.at = "left center";
                    break;
                case "leftTop":
                    d.my = "right bottom", d.at = "left center";
                    break;
                default:
                    return !1
            }
            return this.popover.css({
                display: "inline" === this.options.placement ? "" : "block"
            }), d !== !1 ? this.popover.pos(d).css("maxWidth", a(window).width() - this.container.offset().left - 5) : this.popover.css({
                top: "auto",
                right: "auto",
                bottom: "auto",
                left: "auto",
                maxWidth: "none"
            }), this.popover.addClass(this.options.placement), !0
        },
        _updateComponents: function() {
            if (this.iconpicker.find(".iconpicker-item.iconpicker-selected").removeClass("iconpicker-selected " + this.options.selectedCustomClass), this.iconpicker.find("." + this.options.iconBaseClass + "." + this.options.iconClassPrefix + this.iconpickerValue).parent().addClass("iconpicker-selected " + this.options.selectedCustomClass), this.hasComponent()) {
                var a = this.component.find("i");
                a.length > 0 ? a.attr("class", this.options.iconComponentBaseClass + " " + this.getValue()) : this.component.html(this.getValueHtml())
            }
        },
        _updateFormGroupStatus: function(a) {
            return this.hasInput() ? (a !== !1 ? this.input.parents(".form-group:first").removeClass("has-error") : this.input.parents(".form-group:first").addClass("has-error"), !0) : !1
        },
        getValid: function(c) {
            b.isString(c) || (c = "");
            var d = "" === c;
            return c = a.trim(c.replace(this.options.iconClassPrefix, "")), b.inArray(c, this.options.icons) || d ? c : !1
        },
        setValue: function(a) {
            var b = this.getValid(a);
            return b !== !1 ? (this.iconpickerValue = b, this._trigger("iconpickerSetValue", {
                iconpickerValue: b
            }), this.iconpickerValue) : (this._trigger("iconpickerInvalid", {
                iconpickerValue: a
            }), !1)
        },
        getValue: function(a) {
            return this.options.iconClassPrefix + (a ? a : this.iconpickerValue)
        },
        getValueHtml: function() {
            return '<i class="' + this.options.iconBaseClass + " " + this.getValue() + '"></i>'
        },
        setSourceValue: function(a) {
            return a = this.setValue(a), a !== !1 && "" !== a && (this.hasInput() ? this.input.val(this.getValue()) : this.element.data("iconpickerValue", this.getValue()), this._trigger("iconpickerSetSourceValue", {
                iconpickerValue: a
            })), a
        },
        getSourceValue: function(a) {
            a = a || this.options.defaultValue;
            var b = a;
            return b = this.hasInput() ? this.input.val() : this.element.data("iconpickerValue"), (void 0 === b || "" === b || null === b || b === !1) && (b = a), b
        },
        hasInput: function() {
            return this.input !== !1
        },
        hasComponent: function() {
            return this.component !== !1
        },
        hasContainer: function() {
            return this.container !== !1
        },
        getAcceptButton: function() {
            return this.popover.find(".iconpicker-btn-accept")
        },
        getCancelButton: function() {
            return this.popover.find(".iconpicker-btn-cancel")
        },
        getSearchInput: function() {
            return this.popover.find(".iconpicker-search")
        },
        filter: function(c) {
            if (b.isEmpty(c)) return this.iconpicker.find(".iconpicker-item").show(), a(!1);
            var d = [];
            return this.iconpicker.find(".iconpicker-item").each(function() {
                var b = a(this),
                    e = b.attr("title").toLowerCase(),
                    f = !1;
                try {
                    f = new RegExp(c, "g")
                } catch (g) {
                    f = !1
                }
                f !== !1 && e.match(f) ? (d.push(b), b.show()) : b.hide()
            }), d
        },
        show: function() {
            return this.popover.hasClass("in") ? !1 : (a.iconpicker.batch(a(".iconpicker-popover.in:not(.inline)").not(this.popover), "hide"), this._trigger("iconpickerShow"), this.updatePlacement(), this.popover.addClass("in"), void setTimeout(a.proxy(function() {
                this.popover.css("display", this.isInline() ? "" : "block"), this._trigger("iconpickerShown")
            }, this), this.options.animation ? 300 : 1))
        },
        hide: function() {
            return this.popover.hasClass("in") ? (this._trigger("iconpickerHide"), this.popover.removeClass("in"), void setTimeout(a.proxy(function() {
                this.popover.css("display", "none"), this.getSearchInput().val(""), this.filter(""), this._trigger("iconpickerHidden")
            }, this), this.options.animation ? 300 : 1)) : !1
        },
        toggle: function() {
            this.popover.is(":visible") ? this.hide() : this.show(!0)
        },
        update: function(a, b) {
            return a = a ? a : this.getSourceValue(this.iconpickerValue), this._trigger("iconpickerUpdate"), b === !0 ? a = this.setValue(a) : (a = this.setSourceValue(a), this._updateFormGroupStatus(a !== !1)), a !== !1 && this._updateComponents(), this._trigger("iconpickerUpdated"), a
        },
        destroy: function() {
            this._trigger("iconpickerDestroy"), this.element.removeData("iconpicker").removeData("iconpickerValue").removeClass("iconpicker-element"), this._unbindElementEvents(), this._unbindWindowEvents(), a(this.popover).remove(), this._trigger("iconpickerDestroyed")
        },
        disable: function() {
            return this.hasInput() ? (this.input.prop("disabled", !0), !0) : !1
        },
        enable: function() {
            return this.hasInput() ? (this.input.prop("disabled", !1), !0) : !1
        },
        isDisabled: function() {
            return this.hasInput() ? this.input.prop("disabled") === !0 : !1
        },
        isInline: function() {
            return "inline" === this.options.placement || this.popover.hasClass("inline")
        }
    }, a.iconpicker = c, a.fn.iconpicker = function(b) {
        return this.each(function() {
            var d = a(this);
            d.data("iconpicker") || d.data("iconpicker", new c(this, "object" == typeof b ? b : {}))
        })
    }, c.defaultOptions.icons = ["adjust", "adn", "align-center", "align-justify", "align-left", "align-right", "ambulance", "anchor", "android", "angle-double-down", "angle-double-left", "angle-double-right", "angle-double-up", "angle-down", "angle-left", "angle-right", "angle-up", "apple", "archive", "arrow-circle-down", "arrow-circle-left", "arrow-circle-o-down", "arrow-circle-o-left", "arrow-circle-o-right", "arrow-circle-o-up", "arrow-circle-right", "arrow-circle-up", "arrow-down", "arrow-left", "arrow-right", "arrow-up", "arrows", "arrows-alt", "arrows-h", "arrows-v", "asterisk", "automobile", "backward", "ban", "bank", "bar-chart-o", "barcode", "bars", "beer", "behance", "behance-square", "bell", "bell-o", "bitbucket", "bitbucket-square", "bitcoin", "bold", "bolt", "bomb", "book", "bookmark", "bookmark-o", "briefcase", "btc", "bug", "building", "building-o", "bullhorn", "bullseye", "cab", "calendar", "calendar-o", "camera", "camera-retro", "car", "caret-down", "caret-left", "caret-right", "caret-square-o-down", "caret-square-o-left", "caret-square-o-right", "caret-square-o-up", "caret-up", "certificate", "chain", "chain-broken", "check", "check-circle", "check-circle-o", "check-square", "check-square-o", "chevron-circle-down", "chevron-circle-left", "chevron-circle-right", "chevron-circle-up", "chevron-down", "chevron-left", "chevron-right", "chevron-up", "child", "circle", "circle-o", "circle-o-notch", "circle-thin", "clipboard", "clock-o", "cloud", "cloud-download", "cloud-upload", "cny", "code", "code-fork", "codepen", "coffee", "cog", "cogs", "columns", "comment", "comment-o", "comments", "comments-o", "compass", "compress", "copy", "credit-card", "crop", "crosshairs", "css3", "cube", "cubes", "cut", "cutlery", "dashboard", "database", "dedent", "delicious", "desktop", "deviantart", "digg", "dollar", "dot-circle-o", "download", "dribbble", "dropbox", "drupal", "edit", "eject", "ellipsis-h", "ellipsis-v", "empire", "envelope", "envelope-o", "envelope-square", "eraser", "eur", "euro", "exchange", "exclamation", "exclamation-circle", "exclamation-triangle", "expand", "external-link", "external-link-square", "eye", "eye-slash", "facebook", "facebook-square", "fast-backward", "fast-forward", "fax", "female", "fighter-jet", "file", "file-archive-o", "file-audio-o", "file-code-o", "file-excel-o", "file-image-o", "file-movie-o", "file-o", "file-pdf-o", "file-photo-o", "file-picture-o", "file-powerpoint-o", "file-sound-o", "file-text", "file-text-o", "file-video-o", "file-word-o", "file-zip-o", "files-o", "film", "filter", "fire", "fire-extinguisher", "flag", "flag-checkered", "flag-o", "flash", "flask", "flickr", "floppy-o", "folder", "folder-o", "folder-open", "folder-open-o", "font", "forward", "foursquare", "frown-o", "gamepad", "gavel", "gbp", "ge", "gear", "gears", "gift", "git", "git-square", "github", "github-alt", "github-square", "gittip", "glass", "globe", "google", "google-plus", "google-plus-square", "graduation-cap", "group", "h-square", "hacker-news", "hand-o-down", "hand-o-left", "hand-o-right", "hand-o-up", "hdd-o", "header", "headphones", "heart", "heart-o", "history", "home", "hospital-o", "html5", "image", "inbox", "indent", "info", "info-circle", "inr", "instagram", "institution", "italic", "joomla", "jpy", "jsfiddle", "key", "keyboard-o", "krw", "language", "laptop", "leaf", "legal", "lemon-o", "level-down", "level-up", "life-bouy", "life-ring", "life-saver", "lightbulb-o", "link", "linkedin", "linkedin-square", "linux", "list", "list-alt", "list-ol", "list-ul", "location-arrow", "lock", "long-arrow-down", "long-arrow-left", "long-arrow-right", "long-arrow-up", "magic", "magnet", "mail-forward", "mail-reply", "mail-reply-all", "male", "map-marker", "maxcdn", "medkit", "meh-o", "microphone", "microphone-slash", "minus", "minus-circle", "minus-square", "minus-square-o", "mobile", "mobile-phone", "money", "moon-o", "mortar-board", "music", "navicon", "openid", "outdent", "pagelines", "paper-plane", "paper-plane-o", "paperclip", "paragraph", "paste", "pause", "paw", "pencil", "pencil-square", "pencil-square-o", "phone", "phone-square", "photo", "picture-o", "pied-piper", "pied-piper-alt", "pied-piper-square", "pinterest", "pinterest-square", "plane", "play", "play-circle", "play-circle-o", "plus", "plus-circle", "plus-square", "plus-square-o", "power-off", "print", "puzzle-piece", "qq", "qrcode", "question", "question-circle", "quote-left", "quote-right", "ra", "random", "rebel", "recycle", "reddit", "reddit-square", "refresh", "renren", "reorder", "repeat", "reply", "reply-all", "retweet", "rmb", "road", "rocket", "rotate-left", "rotate-right", "rouble", "rss", "rss-square", "rub", "ruble", "rupee", "save", "scissors", "search", "search-minus", "search-plus", "send", "send-o", "share", "share-alt", "share-alt-square", "share-square", "share-square-o", "shield", "shopping-cart", "sign-in", "sign-out", "signal", "sitemap", "skype", "slack", "sliders", "smile-o", "sort", "sort-alpha-asc", "sort-alpha-desc", "sort-amount-asc", "sort-amount-desc", "sort-asc", "sort-desc", "sort-down", "sort-numeric-asc", "sort-numeric-desc", "sort-up", "soundcloud", "space-shuttle", "spinner", "spoon", "spotify", "square", "square-o", "stack-exchange", "stack-overflow", "star", "star-half", "star-half-empty", "star-half-full", "star-half-o", "star-o", "steam", "steam-square", "step-backward", "step-forward", "stethoscope", "stop", "strikethrough", "stumbleupon", "stumbleupon-circle", "subscript", "suitcase", "sun-o", "superscript", "support", "table", "tablet", "tachometer", "tag", "tags", "tasks", "taxi", "tencent-weibo", "terminal", "text-height", "text-width", "th", "th-large", "th-list", "thumb-tack", "thumbs-down", "thumbs-o-down", "thumbs-o-up", "thumbs-up", "ticket", "times", "times-circle", "times-circle-o", "tint", "toggle-down", "toggle-left", "toggle-right", "toggle-up", "trash-o", "tree", "trello", "trophy", "truck", "try", "tumblr", "tumblr-square", "turkish-lira", "twitter", "twitter-square", "umbrella", "underline", "undo", "university", "unlink", "unlock", "unlock-alt", "unsorted", "upload", "usd", "user", "user-md", "users", "video-camera", "vimeo-square", "vine", "vk", "volume-down", "volume-off", "volume-up", "warning", "wechat", "weibo", "weixin", "wheelchair", "windows", "won", "wordpress", "wrench", "xing", "xing-square", "yahoo", "yen", "youtube", "youtube-play", "youtube-square"]
});