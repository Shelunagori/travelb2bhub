(function($, window, document, undifined) {
    "use strict";
    var pluginName = "apPagination";
    /* Plugin Initialize
    -----------------------------------------------*/
    function Plugin(elem, options) {
        this.self = this;
        this.elem = elem;
        this.$elem = $(elem);
        this.opt = $.extend({}, $.fn[pluginName].defaults, options);
        this.inIt();
    };
    /* Plugin Prototype function
    -----------------------------------------------*/
    $.extend(Plugin.prototype, {
        inIt: function() {
            var self = this;
            // variable declration
            self.pageElem = self.opt.pageElem;
            self.container = self.opt.container
            self.pagesWrap = self.opt.pagesWrap;
            self.targets = self.opt.targets;
            self.perPage = self.opt.perPage;
            self.btnClass = self.opt.btnClass;
            self.prevClass = self.opt.prevClass;
            self.nextClass = self.opt.nextClass;
            self.nextText = self.opt.nextText;
            self.prevText = self.opt.prevText;
            self.loadPage = self.opt.loadPage;
            self.ulClass = self.opt.ulClass;

            self.$targets = $(self.opt.targets);
            self.MakePageHtml();
        },
        MakePageHtml: function() {
            var self = this;
            self.AllPage = Math.ceil(self.$targets.length / self.perPage);
            if (self.AllPage > 1) {
                var PaginationHtml = "";
                for (var i = 0; i < self.AllPage; i++) {
                    if (i == 0) {
                        PaginationHtml += '<li class="' + self.prevClass + '"><a href="#">' + self.prevText + ' </a></li>';
                        PaginationHtml += '<li class="' + self.btnClass + '" data-page="' + i + '"><a href="#" data-page="' + i + '"> ' + (i + 1) + ' </a></li>';
                    } else if (i == self.AllPage - 1) {
                        PaginationHtml += '<li class="' + self.btnClass + '" data-page="' + i + '"><a href="#" data-page="' + i + '"> ' + (i + 1) + ' </a></li>';
                        PaginationHtml += '<li class="' + self.nextClass + '"><a href="#"> ' + self.nextText + ' </a></li>';
                    } else if (i > 5) {
                        PaginationHtml += '<li class="hidden ' + self.btnClass + '" data-page="' + i + '"><a href="#" data-page="' + i + '"> ' + (i + 1) + ' </a></li>';
                    } else {
                        PaginationHtml += '<li class="' + self.btnClass + '" data-page="' + i + '"><a href="#" data-page="' + i + '"> ' + (i + 1) + ' </a></li>';
                    }
                }
                $(self.pagesWrap).html("<ul class='" + self.ulClass + "'>" + PaginationHtml + "</ul>");
            }
            self.MakePages();
        },
        MakePages: function() {
            var self = this;
            for (var i = 0; i < self.AllPage; i++) {
                self.pageElem.push(self.$targets.splice(0, self.perPage));
                $(self.pageElem[i]).addClass('page-' + i);
            }
            self.clickEvent();
            self.ChangePage(self.loadPage);
        },
        ChangePage: function(pageNo) {
            var self = this;
            if (pageNo < self.AllPage) {
                $(self.pageElem[pageNo]).fadeIn();
                $(self.targets).not($(self.pageElem[pageNo])).fadeOut("fast");
                var $ActiveBtn = $(self.pagesWrap + " ." + self.btnClass + "[data-page=" + pageNo + "]");
                $ActiveBtn.addClass("active").removeClass("hidden");
                var ActiveBtnPrev = $ActiveBtn.prevAll();
                var ActiveBtnNext = $ActiveBtn.nextAll();
                ActiveBtnPrev.map(function(ind, el) {
                    if (ind > 2) {
                        $(el).not(".prev").addClass("hidden");
                    } else {
                        $(el).removeClass("hidden");
                    }
                });
                ActiveBtnNext.map(function(ind, el) {
                    if (ind > 2) {
                        $(el).not(".next").addClass("hidden");
                    } else {
                        $(el).removeClass("hidden");
                    }
                });
                $(self.pagesWrap + " ." + self.btnClass).not($ActiveBtn).removeClass("active");
                pageNo == 0 ? $("li." + self.prevClass).hide() : $("li." + self.prevClass).show();
                pageNo == self.AllPage - 1 ? $("li." + self.nextClass).hide() : $("li." + self.nextClass).show();
            } else {
                console.error("Please enter currect page number in ApPagination.");
            }
        },
        clickEvent: function() {
            var self = this;
            $(self.pagesWrap + " ." + self.btnClass + " a").unbind('click').bind('click', function(event) {
                event.preventDefault();
                var activeClass = $(this).parent('li').hasClass("active");
                if (!activeClass) {
                    var attr = parseInt($(this).attr("data-page"));
                    self.ChangePage(attr);
                }
            });
            $(self.pagesWrap + " ." + self.nextClass + " a").unbind('click').bind('click', function(event) {
                event.preventDefault();
                var activeBtn = $(self.pagesWrap + " ." + self.btnClass + ".active");
                var nextBtn = activeBtn.next();
                var attr = parseInt(nextBtn.children("a").attr("data-page"));
                if (attr < self.AllPage) {
                    self.ChangePage(attr);
                }
            });
            $(self.pagesWrap + " ." + self.prevClass + " a").unbind('click').bind('click', function() {
                var activeBtn = $(self.pagesWrap + " ." + self.btnClass + ".active");
                var prveBtn = activeBtn.prev();
                var attr = parseInt(prveBtn.children("a").attr("data-page"));
                if (attr >= 0) {
                    self.ChangePage(attr);
                }
            });
        }
    });
    /* Function Initialize
    -----------------------------------------------*/
    $.fn[pluginName] = function(options) {
        return this.each(function() {
            new Plugin(this, options);
        });
    };
    /* Defaults Options
    -----------------------------------------------*/
    $.fn[pluginName].defaults = {
        pageElem: [],
        container: null,
        targets: null,
        pagesWrap: null,
        perPage: 2,
        btnClass: 'page-btn',
        prevClass: 'prev',
        nextClass: 'next',
        nextText: 'Next',
        prevText: 'Prev',
        loadPage: 0,
        ulClass: "ap-pagination"
    };
}(jQuery, window, document));