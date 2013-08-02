/**
 * Isotope v1.5.25
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time license fee
 * http://metafizzy.co/#licenses
 *
 * Copyright 2012 David DeSandro / Metafizzy
 */
(function(a,b,c){"use strict";var d=a.document,e=a.Modernizr,f=function(a){return a.charAt(0).toUpperCase()+a.slice(1)},g="Moz Webkit O Ms".split(" "),h=function(a){var b=d.documentElement.style,c;if(typeof b[a]=="string")return a;a=f(a);for(var e=0,h=g.length;e<h;e++){c=g[e]+a;if(typeof b[c]=="string")return c}},i=h("transform"),j=h("transitionProperty"),k={csstransforms:function(){return!!i},csstransforms3d:function(){var a=!!h("perspective");if(a){var c=" -o- -moz- -ms- -webkit- -khtml- ".split(" "),d="@media ("+c.join("transform-3d),(")+"modernizr)",e=b("<style>"+d+"{#modernizr{height:3px}}"+"</style>").appendTo("head"),f=b('<div id="modernizr" />').appendTo("html");a=f.height()===3,f.remove(),e.remove()}return a},csstransitions:function(){return!!j}},l;if(e)for(l in k)e.hasOwnProperty(l)||e.addTest(l,k[l]);else{e=a.Modernizr={_version:"1.6ish: miniModernizr for Isotope"};var m=" ",n;for(l in k)n=k[l](),e[l]=n,m+=" "+(n?"":"no-")+l;b("html").addClass(m)}if(e.csstransforms){var o=e.csstransforms3d?{translate:function(a){return"translate3d("+a[0]+"px, "+a[1]+"px, 0) "},scale:function(a){return"scale3d("+a+", "+a+", 1) "}}:{translate:function(a){return"translate("+a[0]+"px, "+a[1]+"px) "},scale:function(a){return"scale("+a+") "}},p=function(a,c,d){var e=b.data(a,"isoTransform")||{},f={},g,h={},j;f[c]=d,b.extend(e,f);for(g in e)j=e[g],h[g]=o[g](j);var k=h.translate||"",l=h.scale||"",m=k+l;b.data(a,"isoTransform",e),a.style[i]=m};b.cssNumber.scale=!0,b.cssHooks.scale={set:function(a,b){p(a,"scale",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.scale?d.scale:1}},b.fx.step.scale=function(a){b.cssHooks.scale.set(a.elem,a.now+a.unit)},b.cssNumber.translate=!0,b.cssHooks.translate={set:function(a,b){p(a,"translate",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.translate?d.translate:[0,0]}}}var q,r;e.csstransitions&&(q={WebkitTransitionProperty:"webkitTransitionEnd",MozTransitionProperty:"transitionend",OTransitionProperty:"oTransitionEnd otransitionend",transitionProperty:"transitionend"}[j],r=h("transitionDuration"));var s=b.event,t=b.event.handle?"handle":"dispatch",u;s.special.smartresize={setup:function(){b(this).bind("resize",s.special.smartresize.handler)},teardown:function(){b(this).unbind("resize",s.special.smartresize.handler)},handler:function(a,b){var c=this,d=arguments;a.type="smartresize",u&&clearTimeout(u),u=setTimeout(function(){s[t].apply(c,d)},b==="execAsap"?0:100)}},b.fn.smartresize=function(a){return a?this.bind("smartresize",a):this.trigger("smartresize",["execAsap"])},b.Isotope=function(a,c,d){this.element=b(c),this._create(a),this._init(d)};var v=["width","height"],w=b(a);b.Isotope.settings={resizable:!0,layoutMode:"masonry",containerClass:"isotope",itemClass:"isotope-item",hiddenClass:"isotope-hidden",hiddenStyle:{opacity:0,scale:.001},visibleStyle:{opacity:1,scale:1},containerStyle:{position:"relative",overflow:"hidden"},animationEngine:"best-available",animationOptions:{queue:!1,duration:800},sortBy:"original-order",sortAscending:!0,resizesContainer:!0,transformsEnabled:!0,itemPositionDataEnabled:!1},b.Isotope.prototype={_create:function(a){this.options=b.extend({},b.Isotope.settings,a),this.styleQueue=[],this.elemCount=0;var c=this.element[0].style;this.originalStyle={};var d=v.slice(0);for(var e in this.options.containerStyle)d.push(e);for(var f=0,g=d.length;f<g;f++)e=d[f],this.originalStyle[e]=c[e]||"";this.element.css(this.options.containerStyle),this._updateAnimationEngine(),this._updateUsingTransforms();var h={"original-order":function(a,b){return b.elemCount++,b.elemCount},random:function(){return Math.random()}};this.options.getSortData=b.extend(this.options.getSortData,h),this.reloadItems(),this.offset={left:parseInt(this.element.css("padding-left")||0,10),top:parseInt(this.element.css("padding-top")||0,10)};var i=this;setTimeout(function(){i.element.addClass(i.options.containerClass)},0),this.options.resizable&&w.bind("smartresize.isotope",function(){i.resize()}),this.element.delegate("."+this.options.hiddenClass,"click",function(){return!1})},_getAtoms:function(a){var b=this.options.itemSelector,c=b?a.filter(b).add(a.find(b)):a,d={position:"absolute"};return c=c.filter(function(a,b){return b.nodeType===1}),this.usingTransforms&&(d.left=0,d.top=0),c.css(d).addClass(this.options.itemClass),this.updateSortData(c,!0),c},_init:function(a){this.$filteredAtoms=this._filter(this.$allAtoms),this._sort(),this.reLayout(a)},option:function(a){if(b.isPlainObject(a)){this.options=b.extend(!0,this.options,a);var c;for(var d in a)c="_update"+f(d),this[c]&&this[c]()}},_updateAnimationEngine:function(){var a=this.options.animationEngine.toLowerCase().replace(/[ _\-]/g,""),b;switch(a){case"css":case"none":b=!1;break;case"jquery":b=!0;break;default:b=!e.csstransitions}this.isUsingJQueryAnimation=b,this._updateUsingTransforms()},_updateTransformsEnabled:function(){this._updateUsingTransforms()},_updateUsingTransforms:function(){var a=this.usingTransforms=this.options.transformsEnabled&&e.csstransforms&&e.csstransitions&&!this.isUsingJQueryAnimation;a||(delete this.options.hiddenStyle.scale,delete this.options.visibleStyle.scale),this.getPositionStyles=a?this._translate:this._positionAbs},_filter:function(a){var b=this.options.filter===""?"*":this.options.filter;if(!b)return a;var c=this.options.hiddenClass,d="."+c,e=a.filter(d),f=e;if(b!=="*"){f=e.filter(b);var g=a.not(d).not(b).addClass(c);this.styleQueue.push({$el:g,style:this.options.hiddenStyle})}return this.styleQueue.push({$el:f,style:this.options.visibleStyle}),f.removeClass(c),a.filter(b)},updateSortData:function(a,c){var d=this,e=this.options.getSortData,f,g;a.each(function(){f=b(this),g={};for(var a in e)!c&&a==="original-order"?g[a]=b.data(this,"isotope-sort-data")[a]:g[a]=e[a](f,d);b.data(this,"isotope-sort-data",g)})},_sort:function(){var a=this.options.sortBy,b=this._getSorter,c=this.options.sortAscending?1:-1,d=function(d,e){var f=b(d,a),g=b(e,a);return f===g&&a!=="original-order"&&(f=b(d,"original-order"),g=b(e,"original-order")),(f>g?1:f<g?-1:0)*c};this.$filteredAtoms.sort(d)},_getSorter:function(a,c){return b.data(a,"isotope-sort-data")[c]},_translate:function(a,b){return{translate:[a,b]}},_positionAbs:function(a,b){return{left:a,top:b}},_pushPosition:function(a,b,c){b=Math.round(b+this.offset.left),c=Math.round(c+this.offset.top);var d=this.getPositionStyles(b,c);this.styleQueue.push({$el:a,style:d}),this.options.itemPositionDataEnabled&&a.data("isotope-item-position",{x:b,y:c})},layout:function(a,b){var c=this.options.layoutMode;this["_"+c+"Layout"](a);if(this.options.resizesContainer){var d=this["_"+c+"GetContainerSize"]();this.styleQueue.push({$el:this.element,style:d})}this._processStyleQueue(a,b),this.isLaidOut=!0},_processStyleQueue:function(a,c){var d=this.isLaidOut?this.isUsingJQueryAnimation?"animate":"css":"css",f=this.options.animationOptions,g=this.options.onLayout,h,i,j,k;i=function(a,b){b.$el[d](b.style,f)};if(this._isInserting&&this.isUsingJQueryAnimation)i=function(a,b){h=b.$el.hasClass("no-transition")?"css":d,b.$el[h](b.style,f)};else if(c||g||f.complete){var l=!1,m=[c,g,f.complete],n=this;j=!0,k=function(){if(l)return;var b;for(var c=0,d=m.length;c<d;c++)b=m[c],typeof b=="function"&&b.call(n.element,a,n);l=!0};if(this.isUsingJQueryAnimation&&d==="animate")f.complete=k,j=!1;else if(e.csstransitions){var o=0,p=this.styleQueue[0],s=p&&p.$el,t;while(!s||!s.length){t=this.styleQueue[o++];if(!t)return;s=t.$el}var u=parseFloat(getComputedStyle(s[0])[r]);u>0&&(i=function(a,b){b.$el[d](b.style,f).one(q,k)},j=!1)}}b.each(this.styleQueue,i),j&&k(),this.styleQueue=[]},resize:function(){this["_"+this.options.layoutMode+"ResizeChanged"]()&&this.reLayout()},reLayout:function(a){this["_"+this.options.layoutMode+"Reset"](),this.layout(this.$filteredAtoms,a)},addItems:function(a,b){var c=this._getAtoms(a);this.$allAtoms=this.$allAtoms.add(c),b&&b(c)},insert:function(a,b){this.element.append(a);var c=this;this.addItems(a,function(a){var d=c._filter(a);c._addHideAppended(d),c._sort(),c.reLayout(),c._revealAppended(d,b)})},appended:function(a,b){var c=this;this.addItems(a,function(a){c._addHideAppended(a),c.layout(a),c._revealAppended(a,b)})},_addHideAppended:function(a){this.$filteredAtoms=this.$filteredAtoms.add(a),a.addClass("no-transition"),this._isInserting=!0,this.styleQueue.push({$el:a,style:this.options.hiddenStyle})},_revealAppended:function(a,b){var c=this;setTimeout(function(){a.removeClass("no-transition"),c.styleQueue.push({$el:a,style:c.options.visibleStyle}),c._isInserting=!1,c._processStyleQueue(a,b)},10)},reloadItems:function(){this.$allAtoms=this._getAtoms(this.element.children())},remove:function(a,b){this.$allAtoms=this.$allAtoms.not(a),this.$filteredAtoms=this.$filteredAtoms.not(a);var c=this,d=function(){a.remove(),b&&b.call(c.element)};a.filter(":not(."+this.options.hiddenClass+")").length?(this.styleQueue.push({$el:a,style:this.options.hiddenStyle}),this._sort(),this.reLayout(d)):d()},shuffle:function(a){this.updateSortData(this.$allAtoms),this.options.sortBy="random",this._sort(),this.reLayout(a)},destroy:function(){var a=this.usingTransforms,b=this.options;this.$allAtoms.removeClass(b.hiddenClass+" "+b.itemClass).each(function(){var b=this.style;b.position="",b.top="",b.left="",b.opacity="",a&&(b[i]="")});var c=this.element[0].style;for(var d in this.originalStyle)c[d]=this.originalStyle[d];this.element.unbind(".isotope").undelegate("."+b.hiddenClass,"click").removeClass(b.containerClass).removeData("isotope"),w.unbind(".isotope")},_getSegments:function(a){var b=this.options.layoutMode,c=a?"rowHeight":"columnWidth",d=a?"height":"width",e=a?"rows":"cols",g=this.element[d](),h,i=this.options[b]&&this.options[b][c]||this.$filteredAtoms["outer"+f(d)](!0)||g;h=Math.floor(g/i),h=Math.max(h,1),this[b][e]=h,this[b][c]=i},_checkIfSegmentsChanged:function(a){var b=this.options.layoutMode,c=a?"rows":"cols",d=this[b][c];return this._getSegments(a),this[b][c]!==d},_masonryReset:function(){this.masonry={},this._getSegments();var a=this.masonry.cols;this.masonry.colYs=[];while(a--)this.masonry.colYs.push(0)},_masonryLayout:function(a){var c=this,d=c.masonry;a.each(function(){var a=b(this),e=Math.ceil(a.outerWidth(!0)/d.columnWidth);e=Math.min(e,d.cols);if(e===1)c._masonryPlaceBrick(a,d.colYs);else{var f=d.cols+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.colYs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryPlaceBrick(a,g)}})},_masonryPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=this.masonry.columnWidth*d,h=c;this._pushPosition(a,g,h);var i=c+a.outerHeight(!0),j=this.masonry.cols+1-f;for(e=0;e<j;e++)this.masonry.colYs[d+e]=i},_masonryGetContainerSize:function(){var a=Math.max.apply(Math,this.masonry.colYs);return{height:a}},_masonryResizeChanged:function(){return this._checkIfSegmentsChanged()},_fitRowsReset:function(){this.fitRows={x:0,y:0,height:0}},_fitRowsLayout:function(a){var c=this,d=this.element.width(),e=this.fitRows;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.x!==0&&f+e.x>d&&(e.x=0,e.y=e.height),c._pushPosition(a,e.x,e.y),e.height=Math.max(e.y+g,e.height),e.x+=f})},_fitRowsGetContainerSize:function(){return{height:this.fitRows.height}},_fitRowsResizeChanged:function(){return!0},_cellsByRowReset:function(){this.cellsByRow={index:0},this._getSegments(),this._getSegments(!0)},_cellsByRowLayout:function(a){var c=this,d=this.cellsByRow;a.each(function(){var a=b(this),e=d.index%d.cols,f=Math.floor(d.index/d.cols),g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByRowGetContainerSize:function(){return{height:Math.ceil(this.$filteredAtoms.length/this.cellsByRow.cols)*this.cellsByRow.rowHeight+this.offset.top}},_cellsByRowResizeChanged:function(){return this._checkIfSegmentsChanged()},_straightDownReset:function(){this.straightDown={y:0}},_straightDownLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,0,c.straightDown.y),c.straightDown.y+=d.outerHeight(!0)})},_straightDownGetContainerSize:function(){return{height:this.straightDown.y}},_straightDownResizeChanged:function(){return!0},_masonryHorizontalReset:function(){this.masonryHorizontal={},this._getSegments(!0);var a=this.masonryHorizontal.rows;this.masonryHorizontal.rowXs=[];while(a--)this.masonryHorizontal.rowXs.push(0)},_masonryHorizontalLayout:function(a){var c=this,d=c.masonryHorizontal;a.each(function(){var a=b(this),e=Math.ceil(a.outerHeight(!0)/d.rowHeight);e=Math.min(e,d.rows);if(e===1)c._masonryHorizontalPlaceBrick(a,d.rowXs);else{var f=d.rows+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.rowXs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryHorizontalPlaceBrick(a,g)}})},_masonryHorizontalPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=c,h=this.masonryHorizontal.rowHeight*d;this._pushPosition(a,g,h);var i=c+a.outerWidth(!0),j=this.masonryHorizontal.rows+1-f;for(e=0;e<j;e++)this.masonryHorizontal.rowXs[d+e]=i},_masonryHorizontalGetContainerSize:function(){var a=Math.max.apply(Math,this.masonryHorizontal.rowXs);return{width:a}},_masonryHorizontalResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_fitColumnsReset:function(){this.fitColumns={x:0,y:0,width:0}},_fitColumnsLayout:function(a){var c=this,d=this.element.height(),e=this.fitColumns;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.y!==0&&g+e.y>d&&(e.x=e.width,e.y=0),c._pushPosition(a,e.x,e.y),e.width=Math.max(e.x+f,e.width),e.y+=g})},_fitColumnsGetContainerSize:function(){return{width:this.fitColumns.width}},_fitColumnsResizeChanged:function(){return!0},_cellsByColumnReset:function(){this.cellsByColumn={index:0},this._getSegments(),this._getSegments(!0)},_cellsByColumnLayout:function(a){var c=this,d=this.cellsByColumn;a.each(function(){var a=b(this),e=Math.floor(d.index/d.rows),f=d.index%d.rows,g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByColumnGetContainerSize:function(){return{width:Math.ceil(this.$filteredAtoms.length/this.cellsByColumn.rows)*this.cellsByColumn.columnWidth}},_cellsByColumnResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_straightAcrossReset:function(){this.straightAcross={x:0}},_straightAcrossLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,c.straightAcross.x,0),c.straightAcross.x+=d.outerWidth(!0)})},_straightAcrossGetContainerSize:function(){return{width:this.straightAcross.x}},_straightAcrossResizeChanged:function(){return!0}},b.fn.imagesLoaded=function(a){function h(){a.call(c,d)}function i(a){var c=a.target;c.src!==f&&b.inArray(c,g)===-1&&(g.push(c),--e<=0&&(setTimeout(h),d.unbind(".imagesLoaded",i)))}var c=this,d=c.find("img").add(c.filter("img")),e=d.length,f="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",g=[];return e||h(),d.bind("load.imagesLoaded error.imagesLoaded",i).each(function(){var a=this.src;this.src=f,this.src=a}),c};var x=function(b){a.console&&a.console.error(b)};b.fn.isotope=function(a,c){if(typeof a=="string"){var d=Array.prototype.slice.call(arguments,1);this.each(function(){var c=b.data(this,"isotope");if(!c){x("cannot call methods on isotope prior to initialization; attempted to call method '"+a+"'");return}if(!b.isFunction(c[a])||a.charAt(0)==="_"){x("no such method '"+a+"' for isotope instance");return}c[a].apply(c,d)})}else this.each(function(){var d=b.data(this,"isotope");d?(d.option(a),d._init(c)):b.data(this,"isotope",new b.Isotope(a,this,c))});return this}})(window,jQuery);

/*
    --------------------------------
    Infinite Scroll
    --------------------------------
    + https://github.com/paulirish/infinite-scroll
    + version 2.0b2.120519
    + Copyright 2011/12 Paul Irish & Luke Shumard
    + Licensed under the MIT license
    
    + Documentation: http://infinite-scroll.com/
    
*/

(function(o,i,k){i.infinitescroll=function z(D,F,E){this.element=i(E);if(!this._create(D,F)){this.failed=true}};i.infinitescroll.defaults={loading:{finished:k,finishedMsg:"<em>Congratulations, you've reached the end of the internet.</em>",img:"data:image/gif;base64,R0lGODlh3AATAPQeAPDy+MnQ6LW/4N3h8MzT6rjC4sTM5r/I5NHX7N7j8c7U6tvg8OLl8uXo9Ojr9b3G5MfP6Ovu9tPZ7PT1+vX2+tbb7vf4+8/W69jd7rC73vn5/O/x+K243ai02////wAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQECgD/ACwAAAAA3AATAAAF/6AnjmRpnmiqrmzrvnAsz3Rt33iu73zv/8CgcEj0BAScpHLJbDqf0Kh0Sq1ar9isdioItAKGw+MAKYMFhbF63CW438f0mg1R2O8EuXj/aOPtaHx7fn96goR4hmuId4qDdX95c4+RBIGCB4yAjpmQhZN0YGYGXitdZBIVGAsLoq4BBKQDswm1CQRkcG6ytrYKubq8vbfAcMK9v7q7EMO1ycrHvsW6zcTKsczNz8HZw9vG3cjTsMIYqQkCLBwHCgsMDQ4RDAYIqfYSFxDxEfz88/X38Onr16+Bp4ADCco7eC8hQYMAEe57yNCew4IVBU7EGNDiRn8Z831cGLHhSIgdFf9chIeBg7oA7gjaWUWTVQAGE3LqBDCTlc9WOHfm7PkTqNCh54rePDqB6M+lR536hCpUqs2gVZM+xbrTqtGoWqdy1emValeXKzggYBBB5y1acFNZmEvXAoN2cGfJrTv3bl69Ffj2xZt3L1+/fw3XRVw4sGDGcR0fJhxZsF3KtBTThZxZ8mLMgC3fRatCbYMNFCzwLEqLgE4NsDWs/tvqdezZf13Hvk2A9Szdu2X3pg18N+68xXn7rh1c+PLksI/Dhe6cuO3ow3NfV92bdArTqC2Ebd3A8vjf5QWfH6Bg7Nz17c2fj69+fnq+8N2Lty+fuP78/eV2X13neIcCeBRwxorbZrA1ANoCDGrgoG8RTshahQ9iSKEEzUmYIYfNWViUhheCGJyIP5E4oom7WWjgCeBFAJNv1DVV01MAdJhhjdkplWNzO/5oXI846njjVEIqR2OS2B1pE5PVscajkxhMycqLJghQSwT40PgfAl4GqNSXYdZXJn5gSkmmmmJu1aZYb14V51do+pTOCmA40AqVCIhG5IJ9PvYnhIFOxmdqhpaI6GeHCtpooisuutmg+Eg62KOMKuqoTaXgicQWoIYq6qiklmoqFV0UoeqqrLbq6quwxirrrLTWauutJ4QAACH5BAUKABwALAcABADOAAsAAAX/IPd0D2dyRCoUp/k8gpHOKtseR9yiSmGbuBykler9XLAhkbDavXTL5k2oqFqNOxzUZPU5YYZd1XsD72rZpBjbeh52mSNnMSC8lwblKZGwi+0QfIJ8CncnCoCDgoVnBHmKfByGJimPkIwtiAeBkH6ZHJaKmCeVnKKTHIihg5KNq4uoqmEtcRUtEREMBggtEr4QDrjCuRC8h7/BwxENeicSF8DKy82pyNLMOxzWygzFmdvD2L3P0dze4+Xh1Arkyepi7dfFvvTtLQkZBC0T/FX3CRgCMOBHsJ+EHYQY7OinAGECgQsB+Lu3AOK+CewcWjwxQeJBihtNGHSoQOE+iQ3//4XkwBBhRZMcUS6YSXOAwIL8PGqEaSJCiYt9SNoCmnJPAgUVLChdaoFBURN8MAzl2PQphwQLfDFd6lTowglHve6rKpbjhK7/pG5VinZP1qkiz1rl4+tr2LRwWU64cFEihwEtZgbgR1UiHaMVvxpOSwBA37kzGz9e8G+B5MIEKLutOGEsAH2ATQwYfTmuX8aETWdGPZmiZcccNSzeTCA1Sw0bdiitC7LBWgu8jQr8HRzqgpK6gX88QbrB14z/kF+ELpwB8eVQj/JkqdylAudji/+ts3039vEEfK8Vz2dlvxZKG0CmbkKDBvllRd6fCzDvBLKBDSCeffhRJEFebFk1k/Mv9jVIoIJZSeBggwUaNeB+Qk34IE0cXlihcfRxkOAJFFhwGmKlmWDiakZhUJtnLBpnWWcnKaAZcxI0piFGGLBm1mc90kajSCveeBVWKeYEoU2wqeaQi0PetoE+rr14EpVC7oAbAUHqhYExbn2XHHsVqbcVew9tx8+XJKk5AZsqqdlddGpqAKdbAYBn1pcczmSTdWvdmZ17c1b3FZ99vnTdCRFM8OEcAhLwm1NdXnWcBBSMRWmfkWZqVlsmLIiAp/o1gGV2vpS4lalGYsUOqXrddcKCmK61aZ8SjEpUpVFVoCpTj4r661Km7kBHjrDyc1RAIQAAIfkEBQoAGwAsBwAEAM4ACwAABf/gtmUCd4goQQgFKj6PYKi0yrrbc8i4ohQt12EHcal+MNSQiCP8gigdz7iCioaCIvUmZLp8QBzW0EN2vSlCuDtFKaq4RyHzQLEKZNdiQDhRDVooCwkbfm59EAmKi4SGIm+AjIsKjhsqB4mSjT2IOIOUnICeCaB/mZKFNTSRmqVpmJqklSqskq6PfYYCDwYHDC4REQwGCBLGxxIQDsHMwhAIX8bKzcENgSLGF9PU1j3Sy9zX2NrgzQziChLk1BHWxcjf7N046tvN82715czn9Pryz6Ilc4ACj4EBOCZM8KEnAYYADBRKnACAYUMFv1wotIhCEcaJCisqwJFgAUSQGyX/kCSVUUTIdKMwJlyo0oXHlhskwrTJciZHEXsgaqS4s6PJiCAr1uzYU8kBBSgnWFqpoMJMUjGtDmUwkmfVmVypakWhEKvXsS4nhLW5wNjVroJIoc05wSzTr0PtiigpYe4EC2vj4iWrFu5euWIMRBhacaVJhYQBEFjA9jHjyQ0xEABwGceGAZYjY0YBOrRLCxUp29QM+bRkx5s7ZyYgVbTqwwti2ybJ+vLtDYpycyZbYOlptxdx0kV+V7lC5iJAyyRrwYKxAdiz82ng0/jnAdMJFz0cPi104Ec1Vj9/M6F173vKL/feXv156dw11tlqeMMnv4V5Ap53GmjQQH97nFfg+IFiucfgRX5Z8KAgbUlQ4IULIlghhhdOSB6AgX0IVn8eReghen3NRIBsRgnH4l4LuEidZBjwRpt6NM5WGwoW0KSjCwX6yJSMab2GwwAPDXfaBCtWpluRTQqC5JM5oUZAjUNS+VeOLWpJEQ7VYQANW0INJSZVDFSnZphjSikfmzE5N4EEbQI1QJmnWXCmHulRp2edwDXF43txukenJwvI9xyg9Q26Z3MzGUcBYFEChZh6DVTq34AU8Iflh51Sd+CnKFYQ6mmZkhqfBKfSxZWqA9DZanWjxmhrWwi0qtCrt/43K6WqVjjpmhIqgEGvculaGKklKstAACEAACH5BAUKABwALAcABADOAAsAAAX/ICdyQmaMYyAUqPgIBiHPxNpy79kqRXH8wAPsRmDdXpAWgWdEIYm2llCHqjVHU+jjJkwqBTecwItShMXkEfNWSh8e1NGAcLgpDGlRgk7EJ/6Ae3VKfoF/fDuFhohVeDeCfXkcCQqDVQcQhn+VNDOYmpSWaoqBlUSfmowjEA+iEAEGDRGztAwGCDcXEA60tXEiCrq8vREMEBLIyRLCxMWSHMzExnbRvQ2Sy7vN0zvVtNfU2tLY3rPgLdnDvca4VQS/Cpk3ABwSLQkYAQwT/P309vcI7OvXr94jBQMJ/nskkGA/BQBRLNDncAIAiDcG6LsxAWOLiQzmeURBKWSLCQbv/1F0eDGinJUKR47YY1IEgQASKk7Yc7ACRwZm7mHweRJoz59BJUogisKCUaFMR0x4SlJBVBFTk8pZivTR0K73rN5wqlXEAq5Fy3IYgHbEzQ0nLy4QSoCjXLoom96VOJEeCosK5n4kkFfqXjl94wa+l1gvAcGICbewAOAxY8l/Ky/QhAGz4cUkGxu2HNozhwMGBnCUqUdBg9UuW9eUynqSwLHIBujePef1ZGQZXcM+OFuEBeBhi3OYgLyqcuaxbT9vLkf4SeqyWxSQpKGB2gQpm1KdWbu72rPRzR9Ne2Nu9Kzr/1Jqj0yD/fvqP4aXOt5sW/5qsXXVcv1Nsp8IBUAmgswGF3llGgeU1YVXXKTN1FlhWFXW3gIE+DVChApysACHHo7Q4A35lLichh+ROBmLKAzgYmYEYDAhCgxKGOOMn4WR4kkDaoBBOxJtdNKQxFmg5JIWIBnQc07GaORfUY4AEkdV6jHlCEISSZ5yTXpp1pbGZbkWmcuZmQCaE6iJ0FhjMaDjTMsgZaNEHFRAQVp3bqXnZED1qYcECOz5V6BhSWCoVJQIKuKQi2KFKEkEFAqoAo7uYSmO3jk61wUUMKmknJ4SGimBmAa0qVQBhAAAIfkEBQoAGwAsBwAEAM4ACwAABf/gJm5FmRlEqhJC+bywgK5pO4rHI0D3pii22+Mg6/0Ej96weCMAk7cDkXf7lZTTnrMl7eaYoy10JN0ZFdco0XAuvKI6qkgVFJXYNwjkIBcNBgR8TQoGfRsJCRuCYYQQiI+ICosiCoGOkIiKfSl8mJkHZ4U9kZMbKaI3pKGXmJKrngmug4WwkhA0lrCBWgYFCCMQFwoQDRHGxwwGCBLMzRLEx8iGzMMO0cYNeCMKzBDW19lnF9DXDIY/48Xg093f0Q3s1dcR8OLe8+Y91OTv5wrj7o7B+7VNQqABIoRVCMBggsOHE36kSoCBIcSH3EbFangxogJYFi8CkJhqQciLJEf/LDDJEeJIBT0GsOwYUYJGBS0fjpQAMidGmyVP6sx4Y6VQhzs9VUwkwqaCCh0tmKoFtSMDmBOf9phg4SrVrROuasRQAaxXpVUhdsU6IsECZlvX3kwLUWzRt0BHOLTbNlbZG3vZinArge5Dvn7wbqtQkSYAAgtKmnSsYKVKo2AfW048uaPmG386i4Q8EQMBAIAnfB7xBxBqvapJ9zX9WgRS2YMpnvYMGdPK3aMjt/3dUcNI4blpj7iwkMFWDXDvSmgAlijrt9RTR78+PS6z1uAJZIe93Q8g5zcsWCi/4Y+C8bah5zUv3vv89uft30QP23punGCx5954oBBwnwYaNCDY/wYrsYeggnM9B2Fpf8GG2CEUVWhbWAtGouEGDy7Y4IEJVrbSiXghqGKIo7z1IVcXIkKWWR361QOLWWnIhwERpLaaCCee5iMBGJQmJGyPFTnbkfHVZGRtIGrg5HALEJAZbu39BuUEUmq1JJQIPtZilY5hGeSWsSk52G9XqsmgljdIcABytq13HyIM6RcUA+r1qZ4EBF3WHWB29tBgAzRhEGhig8KmqKFv8SeCeo+mgsF7YFXa1qWSbkDpom/mqR1PmHCqJ3fwNRVXjC7S6CZhFVCQ2lWvZiirhQq42SACt25IK2hv8TprriUV1usGgeka7LFcNmCldMLi6qZMgFLgpw16Cipb7bC1knXsBiEAACH5BAUKABsALAcABADOAAsAAAX/4FZsJPkUmUGsLCEUTywXglFuSg7fW1xAvNWLF6sFFcPb42C8EZCj24EJdCp2yoegWsolS0Uu6fmamg8n8YYcLU2bXSiRaXMGvqV6/KAeJAh8VgZqCX+BexCFioWAYgqNi4qAR4ORhRuHY408jAeUhAmYYiuVlpiflqGZa5CWkzc5fKmbbhIpsAoQDRG8vQwQCBLCwxK6vb5qwhfGxxENahvCEA7NzskSy7vNzzzK09W/PNHF1NvX2dXcN8K55cfh69Luveol3vO8zwi4Yhj+AQwmCBw4IYclDAAJDlQggVOChAoLKkgFkSCAHDwWLKhIEOONARsDKryogFPIiAUb/95gJNIiw4wnI778GFPhzBKFOAq8qLJEhQpiNArjMcHCmlTCUDIouTKBhApELSxFWiGiVKY4E2CAekPgUphDu0742nRrVLJZnyrFSqKQ2ohoSYAMW6IoDpNJ4bLdILTnAj8KUF7UeENjAKuDyxIgOuGiOI0EBBMgLNew5AUrDTMGsFixwBIaNCQuAXJB57qNJ2OWm2Aj4skwCQCIyNkhhtMkdsIuodE0AN4LJDRgfLPtn5YDLdBlraAByuUbBgxQwICxMOnYpVOPej074OFdlfc0TqC62OIbcppHjV4o+LrieWhfT8JC/I/T6W8oCl29vQ0XjLdBaA3s1RcPBO7lFvpX8BVoG4O5jTXRQRDuJ6FDTzEWF1/BCZhgbyAKE9qICYLloQYOFtahVRsWYlZ4KQJHlwHS/IYaZ6sZd9tmu5HQm2xi1UaTbzxYwJk/wBF5g5EEYOBZeEfGZmNdFyFZmZIR4jikbLThlh5kUUVJGmRT7sekkziRWUIACABk3T4qCsedgO4xhgGcY7q5pHJ4klBBTQRJ0CeHcoYHHUh6wgfdn9uJdSdMiebGJ0zUPTcoS286FCkrZxnYoYYKWLkBowhQoBeaOlZAgVhLidrXqg2GiqpQpZ4apwSwRtjqrB3muoF9BboaXKmshlqWqsWiGt2wphJkQbAU5hoCACH5BAUKABsALAcABADOAAsAAAX/oGFw2WZuT5oZROsSQnGaKjRvilI893MItlNOJ5v5gDcFrHhKIWcEYu/xFEqNv6B1N62aclysF7fsZYe5aOx2yL5aAUGSaT1oTYMBwQ5VGCAJgYIJCnx1gIOBhXdwiIl7d0p2iYGQUAQBjoOFSQR/lIQHnZ+Ue6OagqYzSqSJi5eTpTxGcjcSChANEbu8DBAIEsHBChe5vL13G7fFuscRDcnKuM3H0La3EA7Oz8kKEsXazr7Cw9/Gztar5uHHvte47MjktznZ2w0G1+D3BgirAqJmJMAQgMGEgwgn5Ei0gKDBhBMALGRYEOJBb5QcWlQo4cbAihZz3GgIMqFEBSM1/4ZEOWPAgpIIJXYU+PIhRG8ja1qU6VHlzZknJNQ6UanCjQkWCIGSUGEjAwVLjc44+DTqUQtPPS5gejUrTa5TJ3g9sWCr1BNUWZI161StiQUDmLYdGfesibQ3XMq1OPYthrwuA2yU2LBs2cBHIypYQPPlYAKFD5cVvNPtW8eVGbdcQADATsiNO4cFAPkvHpedPzc8kUcPgNGgZ5RNDZG05reoE9s2vSEP79MEGiQGy1qP8LA4ZcdtsJE48ONoLTBtTV0B9LsTnPceoIDBDQvS7W7vfjVY3q3eZ4A339J4eaAmKqU/sV58HvJh2RcnIBsDUw0ABqhBA5aV5V9XUFGiHfVeAiWwoFgJJrIXRH1tEMiDFV4oHoAEGlaWhgIGSGBO2nFomYY3mKjVglidaNYJGJDkWW2xxTfbjCbVaOGNqoX2GloR8ZeTaECS9pthRGJH2g0b3Agbk6hNANtteHD2GJUucfajCQBy5OOTQ25ZgUPvaVVQmbKh9510/qQpwXx3SQdfk8tZJOd5b6JJFplT3ZnmmX3qd5l1eg5q00HrtUkUn0AKaiGjClSAgKLYZcgWXwocGRcCFGCKwSB6ceqphwmYRUFYT/1WKlOdUpipmxW0mlCqHjYkAaeoZlqrqZ4qd+upQKaapn/AmgAegZ8KUtYtFAQQAgAh+QQFCgAbACwHAAQAzgALAAAF/+C2PUcmiCiZGUTrEkKBis8jQEquKwU5HyXIbEPgyX7BYa5wTNmEMwWsSXsqFbEh8DYs9mrgGjdK6GkPY5GOeU6ryz7UFopSQEzygOGhJBjoIgMDBAcBM0V/CYqLCQqFOwobiYyKjn2TlI6GKC2YjJZknouaZAcQlJUHl6eooJwKooobqoewrJSEmyKdt59NhRKFMxLEEA4RyMkMEAjDEhfGycqAG8TQx9IRDRDE3d3R2ctD1RLg0ttKEnbY5wZD3+zJ6M7X2RHi9Oby7u/r9g38UFjTh2xZJBEBMDAboogAgwkQI07IMUORwocSJwCgWDFBAIwZOaJIsOBjRogKJP8wTODw5ESVHVtm3AhzpEeQElOuNDlTZ0ycEUWKWFASqEahGwYUPbnxoAgEdlYSqDBkgoUNClAlIHbSAoOsqCRQnQHxq1axVb06FWFxLIqyaze0Tft1JVqyE+pWXMD1pF6bYl3+HTqAWNW8cRUFzmih0ZAAB2oGKukSAAGGRHWJgLiR6AylBLpuHKKUMlMCngMpDSAa9QIUggZVVvDaJobLeC3XZpvgNgCmtPcuwP3WgmXSq4do0DC6o2/guzcseECtUoO0hmcsGKDgOt7ssBd07wqesAIGZC1YIBa7PQHvb1+SFo+++HrJSQfB33xfav3i5eX3Hnb4CTJgegEq8tH/YQEOcIJzbm2G2EoYRLgBXFpVmFYDcREV4HIcnmUhiGBRouEMJGJGzHIspqgdXxK0yCKHRNXoIX4uorCdTyjkyNtdPWrA4Up82EbAbzMRxxZRR54WXVLDIRmRcag5d2R6ugl3ZXzNhTecchpMhIGVAKAYpgJjjsSklBEd99maZoo535ZvdamjBEpusJyctg3h4X8XqodBMx0tiNeg/oGJaKGABpogS40KSqiaEgBqlQWLUtqoVQnytekEjzo0hHqhRorppOZt2p923M2AAV+oBtpAnnPNoB6HaU6mAAIU+IXmi3j2mtFXuUoHKwXpzVrsjcgGOauKEjQrwq157hitGq2NoWmjh7z6Wmxb0m5w66+2VRAuXN/yFUAIACH5BAUKABsALAcABADOAAsAAAX/4CZuRiaM45MZqBgIRbs9AqTcuFLE7VHLOh7KB5ERdjJaEaU4ClO/lgKWjKKcMiJQ8KgumcieVdQMD8cbBeuAkkC6LYLhOxoQ2PF5Ys9PKPBMen17f0CCg4VSh32JV4t8jSNqEIOEgJKPlkYBlJWRInKdiJdkmQlvKAsLBxdABA4RsbIMBggtEhcQsLKxDBC2TAS6vLENdJLDxMZAubu8vjIbzcQRtMzJz79S08oQEt/guNiyy7fcvMbh4OezdAvGrakLAQwyABsELQkY9BP+//ckyPDD4J9BfAMh1GsBoImMeQUN+lMgUJ9CiRMa5msxoB9Gh/o8GmxYMZXIgxtR/yQ46S/gQAURR0pDwYDfywoyLPip5AdnCwsMFPBU4BPFhKBDi444quCmDKZOfwZ9KEGpCKgcN1jdALSpPqIYsabS+nSqvqplvYqQYAeDPgwKwjaMtiDl0oaqUAyo+3TuWwUAMPpVCfee0cEjVBGQq2ABx7oTWmQk4FglZMGN9fGVDMCuiH2AOVOu/PmyxM630gwM0CCn6q8LjVJ8GXvpa5Uwn95OTC/nNxkda1/dLSK475IjCD6dHbK1ZOa4hXP9DXs5chJ00UpVm5xo2qRpoxptwF2E4/IbJpB/SDz9+q9b1aNfQH08+p4a8uvX8B53fLP+ycAfemjsRUBgp1H20K+BghHgVgt1GXZXZpZ5lt4ECjxYR4ScUWiShEtZqBiIInRGWnERNnjiBglw+JyGnxUmGowsyiiZg189lNtPGACjV2+S9UjbU0JWF6SPvEk3QZEqsZYTk3UAaRSUnznJI5LmESCdBVSyaOWUWLK4I5gDUYVeV1T9l+FZClCAUVA09uSmRHBCKAECFEhW51ht6rnmWBXkaR+NjuHpJ40D3DmnQXt2F+ihZxlqVKOfQRACACH5BAUKABwALAcABADOAAsAAAX/ICdyUCkUo/g8mUG8MCGkKgspeC6j6XEIEBpBUeCNfECaglBcOVfJFK7YQwZHQ6JRZBUqTrSuVEuD3nI45pYjFuWKvjjSkCoRaBUMWxkwBGgJCXspQ36Bh4EEB0oKhoiBgyNLjo8Ki4QElIiWfJqHnISNEI+Ql5J9o6SgkqKkgqYihamPkW6oNBgSfiMMDQkGCBLCwxIQDhHIyQwQCGMKxsnKVyPCF9DREQ3MxMPX0cu4wt7J2uHWx9jlKd3o39MiuefYEcvNkuLt5O8c1ePI2tyELXGQwoGDAQf+iEC2xByDCRAjTlAgIUWCBRgCPJQ4AQBFXAs0coT40WLIjRxL/47AcHLkxIomRXL0CHPERZkpa4q4iVKiyp0tR/7kwHMkTUBBJR5dOCEBAVcKKtCAyOHpowXCpk7goABqBZdcvWploACpBKkpIJI1q5OD2rIWE0R1uTZu1LFwbWL9OlKuWb4c6+o9i3dEgw0RCGDUG9KlRw56gDY2qmCByZBaASi+TACA0TucAaTteCcy0ZuOK3N2vJlx58+LRQyY3Xm0ZsgjZg+oPQLi7dUcNXi0LOJw1pgNtB7XG6CBy+U75SYfPTSQAgZTNUDnQHt67wnbZyvwLgKiMN3oCZB3C76tdewpLFgIP2C88rbi4Y+QT3+8S5USMICZXWj1pkEDeUU3lOYGB3alSoEiMIjgX4WlgNF2EibIwQIXauWXSRg2SAOHIU5IIIMoZkhhWiJaiFVbKo6AQEgQXrTAazO1JhkBrBG3Y2Y6EsUhaGn95hprSN0oWpFE7rhkeaQBchGOEWnwEmc0uKWZj0LeuNV3W4Y2lZHFlQCSRjTIl8uZ+kG5HU/3sRlnTG2ytyadytnD3HrmuRcSn+0h1dycexIK1KCjYaCnjCCVqOFFJTZ5GkUUjESWaUIKU2lgCmAKKQIUjHapXRKE+t2og1VgankNYnohqKJ2CmKplso6GKz7WYCgqxeuyoF8u9IQAgA7",msg:null,msgText:"<em>Loading the next set of posts...</em>",selector:null,speed:"fast",start:k},state:{isDuringAjax:false,isInvalidPage:false,isDestroyed:false,isDone:false,isPaused:false,currPage:1},debug:false,behavior:k,binder:i(o),nextSelector:"div.navigation a:first",navSelector:"div.navigation",contentSelector:null,extraScrollPx:150,itemSelector:"div.post",animate:false,pathParse:k,dataType:"html",appendCallback:true,bufferPx:40,errorCallback:function(){},infid:0,pixelsFromNavToBottom:k,path:k,prefill:false};i.infinitescroll.prototype={_binding:function g(F){var D=this,E=D.options;E.v="2.0b2.120520";if(!!E.behavior&&this["_binding_"+E.behavior]!==k){this["_binding_"+E.behavior].call(this);return}if(F!=="bind"&&F!=="unbind"){this._debug("Binding value  "+F+" not valid");return false}if(F==="unbind"){(this.options.binder).unbind("smartscroll.infscr."+D.options.infid)}else{(this.options.binder)[F]("smartscroll.infscr."+D.options.infid,function(){D.scroll()})}this._debug("Binding",F)},_create:function t(F,J){var G=i.extend(true,{},i.infinitescroll.defaults,F);this.options=G;var I=i(o);var D=this;if(!D._validate(F)){return false}var H=i(G.nextSelector).attr("href");if(!H){this._debug("Navigation selector not found");return false}G.path=G.path||this._determinepath(H);G.contentSelector=G.contentSelector||this.element;G.loading.selector=G.loading.selector||G.contentSelector;G.loading.msg=G.loading.msg||i('<div id="infscr-loading"><img alt="Loading..." src="'+G.loading.img+'" /><div>'+G.loading.msgText+"</div></div>");(new Image()).src=G.loading.img;if(G.pixelsFromNavToBottom===k){G.pixelsFromNavToBottom=i(document).height()-i(G.navSelector).offset().top}var E=this;G.loading.start=G.loading.start||function(){i(G.navSelector).hide();G.loading.msg.appendTo(G.loading.selector).show(G.loading.speed,i.proxy(function(){this.beginAjax(G)},E))};G.loading.finished=G.loading.finished||function(){G.loading.msg.fadeOut(G.loading.speed)};G.callback=function(K,M,L){if(!!G.behavior&&K["_callback_"+G.behavior]!==k){K["_callback_"+G.behavior].call(i(G.contentSelector)[0],M,L)}if(J){J.call(i(G.contentSelector)[0],M,G,L)}if(G.prefill){I.bind("resize.infinite-scroll",K._prefill)}};if(F.debug){if(Function.prototype.bind&&(typeof console==="object"||typeof console==="function")&&typeof console.log==="object"){["log","info","warn","error","assert","dir","clear","profile","profileEnd"].forEach(function(K){console[K]=this.call(console[K],console)},Function.prototype.bind)}}this._setup();if(G.prefill){this._prefill()}return true},_prefill:function n(){var D=this;var G=i(document);var F=i(o);function E(){return(G.height()<=F.height())}this._prefill=function(){if(E()){D.scroll()}F.bind("resize.infinite-scroll",function(){if(E()){F.unbind("resize.infinite-scroll");D.scroll()}})};this._prefill()},_debug:function q(){if(true!==this.options.debug){return}if(typeof console!=="undefined"&&typeof console.log==="function"){if((Array.prototype.slice.call(arguments)).length===1&&typeof Array.prototype.slice.call(arguments)[0]==="string"){console.log((Array.prototype.slice.call(arguments)).toString())}else{console.log(Array.prototype.slice.call(arguments))}}else{if(!Function.prototype.bind&&typeof console!=="undefined"&&typeof console.log==="object"){Function.prototype.call.call(console.log,console,Array.prototype.slice.call(arguments))}}},_determinepath:function A(E){var D=this.options;if(!!D.behavior&&this["_determinepath_"+D.behavior]!==k){return this["_determinepath_"+D.behavior].call(this,E)}if(!!D.pathParse){this._debug("pathParse manual");return D.pathParse(E,this.options.state.currPage+1)}else{if(E.match(/^(.*?)\b2\b(.*?$)/)){E=E.match(/^(.*?)\b2\b(.*?$)/).slice(1)}else{if(E.match(/^(.*?)2(.*?$)/)){if(E.match(/^(.*?page=)2(\/.*|$)/)){E=E.match(/^(.*?page=)2(\/.*|$)/).slice(1);return E}E=E.match(/^(.*?)2(.*?$)/).slice(1)}else{if(E.match(/^(.*?page=)1(\/.*|$)/)){E=E.match(/^(.*?page=)1(\/.*|$)/).slice(1);return E}else{this._debug("Sorry, we couldn't parse your Next (Previous Posts) URL. Verify your the css selector points to the correct A tag. If you still get this error: yell, scream, and kindly ask for help at infinite-scroll.com.");D.state.isInvalidPage=true}}}}this._debug("determinePath",E);return E},_error:function v(E){var D=this.options;if(!!D.behavior&&this["_error_"+D.behavior]!==k){this["_error_"+D.behavior].call(this,E);return}if(E!=="destroy"&&E!=="end"){E="unknown"}this._debug("Error",E);if(E==="end"){this._showdonemsg()}D.state.isDone=true;D.state.currPage=1;D.state.isPaused=false;this._binding("unbind")},_loadcallback:function c(H,G,E){var D=this.options,J=this.options.callback,L=(D.state.isDone)?"done":(!D.appendCallback)?"no-append":"append",K;if(!!D.behavior&&this["_loadcallback_"+D.behavior]!==k){this["_loadcallback_"+D.behavior].call(this,H,G);return}switch(L){case"done":this._showdonemsg();return false;case"no-append":if(D.dataType==="html"){G="<div>"+G+"</div>";G=i(G).find(D.itemSelector)}break;case"append":var F=H.children();if(F.length===0){return this._error("end")}K=document.createDocumentFragment();while(H[0].firstChild){K.appendChild(H[0].firstChild)}this._debug("contentSelector",i(D.contentSelector)[0]);i(D.contentSelector)[0].appendChild(K);G=F.get();break}D.loading.finished.call(i(D.contentSelector)[0],D);if(D.animate){var I=i(o).scrollTop()+i("#infscr-loading").height()+D.extraScrollPx+"px";i("html,body").animate({scrollTop:I},800,function(){D.state.isDuringAjax=false})}if(!D.animate){D.state.isDuringAjax=false}J(this,G,E);if(D.prefill){this._prefill()}},_nearbottom:function u(){var E=this.options,D=0+i(document).height()-(E.binder.scrollTop())-i(o).height();if(!!E.behavior&&this["_nearbottom_"+E.behavior]!==k){return this["_nearbottom_"+E.behavior].call(this)}this._debug("math:",D,E.pixelsFromNavToBottom);return(D-E.bufferPx<E.pixelsFromNavToBottom)},_pausing:function l(E){var D=this.options;if(!!D.behavior&&this["_pausing_"+D.behavior]!==k){this["_pausing_"+D.behavior].call(this,E);return}if(E!=="pause"&&E!=="resume"&&E!==null){this._debug("Invalid argument. Toggling pause value instead")}E=(E&&(E==="pause"||E==="resume"))?E:"toggle";switch(E){case"pause":D.state.isPaused=true;break;case"resume":D.state.isPaused=false;break;case"toggle":D.state.isPaused=!D.state.isPaused;break}this._debug("Paused",D.state.isPaused);return false},_setup:function r(){var D=this.options;if(!!D.behavior&&this["_setup_"+D.behavior]!==k){this["_setup_"+D.behavior].call(this);return}this._binding("bind");return false},_showdonemsg:function a(){var D=this.options;if(!!D.behavior&&this["_showdonemsg_"+D.behavior]!==k){this["_showdonemsg_"+D.behavior].call(this);return}D.loading.msg.find("img").hide().parent().find("div").html(D.loading.finishedMsg).animate({opacity:1},2000,function(){i(this).parent().fadeOut(D.loading.speed)});D.errorCallback.call(i(D.contentSelector)[0],"done")},_validate:function w(E){for(var D in E){if(D.indexOf&&D.indexOf("Selector")>-1&&i(E[D]).length===0){this._debug("Your "+D+" found no elements.");return false}}return true},bind:function p(){this._binding("bind")},destroy:function C(){this.options.state.isDestroyed=true;return this._error("destroy")},pause:function e(){this._pausing("pause")},resume:function h(){this._pausing("resume")},beginAjax:function B(G){var E=this,I=G.path,F,D,K,J;G.state.currPage++;F=i(G.contentSelector).is("table")?i("<tbody/>"):i("<div/>");D=(typeof I==="function")?I(G.state.currPage):I.join(G.state.currPage);E._debug("heading into ajax",D);K=(G.dataType==="html"||G.dataType==="json")?G.dataType:"html+callback";if(G.appendCallback&&G.dataType==="html"){K+="+callback"}switch(K){case"html+callback":E._debug("Using HTML via .load() method");F.load(D+" "+G.itemSelector,k,function H(L){E._loadcallback(F,L,D)});break;case"html":E._debug("Using "+(K.toUpperCase())+" via $.ajax() method");i.ajax({url:D,dataType:G.dataType,complete:function H(L,M){J=(typeof(L.isResolved)!=="undefined")?(L.isResolved()):(M==="success"||M==="notmodified");if(J){E._loadcallback(F,L.responseText,D)}else{E._error("end")}}});break;case"json":E._debug("Using "+(K.toUpperCase())+" via $.ajax() method");i.ajax({dataType:"json",type:"GET",url:D,success:function(N,O,M){J=(typeof(M.isResolved)!=="undefined")?(M.isResolved()):(O==="success"||O==="notmodified");if(G.appendCallback){if(G.template!==k){var L=G.template(N);F.append(L);if(J){E._loadcallback(F,L)}else{E._error("end")}}else{E._debug("template must be defined.");E._error("end")}}else{if(J){E._loadcallback(F,N,D)}else{E._error("end")}}},error:function(){E._debug("JSON ajax request failed.");E._error("end")}});break}},retrieve:function b(F){F=F||null;var D=this,E=D.options;if(!!E.behavior&&this["retrieve_"+E.behavior]!==k){this["retrieve_"+E.behavior].call(this,F);return}if(E.state.isDestroyed){this._debug("Instance is destroyed");return false}E.state.isDuringAjax=true;E.loading.start.call(i(E.contentSelector)[0],E)},scroll:function f(){var D=this.options,E=D.state;if(!!D.behavior&&this["scroll_"+D.behavior]!==k){this["scroll_"+D.behavior].call(this);return}if(E.isDuringAjax||E.isInvalidPage||E.isDone||E.isDestroyed||E.isPaused){return}if(!this._nearbottom()){return}this.retrieve()},toggle:function y(){this._pausing()},unbind:function m(){this._binding("unbind")},update:function j(D){if(i.isPlainObject(D)){this.options=i.extend(true,this.options,D)}}};i.fn.infinitescroll=function d(F,G){var E=typeof F;switch(E){case"string":var D=Array.prototype.slice.call(arguments,1);this.each(function(){var H=i.data(this,"infinitescroll");if(!H){return false}if(!i.isFunction(H[F])||F.charAt(0)==="_"){return false}H[F].apply(H,D)});break;case"object":this.each(function(){var H=i.data(this,"infinitescroll");if(H){H.update(F)}else{H=new i.infinitescroll(F,G,this);if(!H.failed){i.data(this,"infinitescroll",H)}}});break}return this};var x=i.event,s;x.special.smartscroll={setup:function(){i(this).bind("scroll",x.special.smartscroll.handler)},teardown:function(){i(this).unbind("scroll",x.special.smartscroll.handler)},handler:function(G,D){var F=this,E=arguments;G.type="smartscroll";if(s){clearTimeout(s)}s=setTimeout(function(){i.event.handle.apply(F,E)},D==="execAsap"?0:100)}};i.fn.smartscroll=function(D){return D?this.bind("smartscroll",D):this.trigger("smartscroll",["execAsap"])}})(window,jQuery);


/*-----------------------------------------------------------------------------------*/
/* Preloader & Initialize Masonry Script
/*-----------------------------------------------------------------------------------*/
jQuery.noConflict();

jQuery('.ajaxloading').fadeIn(500);
jQuery(window).load(function(){ 
	jQuery('.ajaxloading').fadeOut(500);
});

jQuery(window).load(function(){ 
    jQuery(".slideshowpreload").fadeOut('slow');     
});


/*-----------------------------------------------------------------------------------*/
/* Sticky Footer
/*-----------------------------------------------------------------------------------*/

(function($){
  var footer;
 
  $.fn.extend({
    stickyFooter: function(options) {
      footer = this;
       
      positionFooter();
 
      $(window)
        .scroll(positionFooter)
        .resize(positionFooter);
 
      function positionFooter() {
        var docHeight = $(document.body).height() - $("#sticky-footer-push").height();
        if(docHeight < $(window).height()){
          var diff = $(window).height() - docHeight;
          if (!$("#sticky-footer-push").length > 0) {
            $(footer).before('<div id="sticky-footer-push"></div>');
          }
          $("#sticky-footer-push").height(diff);
        }
      }
    }
  });
})(jQuery);



jQuery("#footer").stickyFooter();

/*-----------------------------------------------------------------------------------*/
/*  jQuery Isotope
/*-----------------------------------------------------------------------------------*/

if(jQuery().isotope) {

var $selectedthing,
	$nextitem,
	$previtem,
	$nextId,
	$prevId,
	$filterstyle = '<?php echo (get_option('of_filter_action')) ? get_option('of_filter_action') : 'Fade'; ?>';

 	// Find Next Portfolio Posts Function
    function findnext($this, $fade) {
    	if($this) {
    		if ($fade !== 'Fade') { // Check for filter style
		    	$nextitem = $this.closest('.portfolioitem').next('.portfolioitem').find('a.homeportlink');
		       	while ($nextitem.closest('.portfolioitem').hasClass('isotope-hidden') && $nextitem.length) {
					$nextitem = $nextitem.closest('.portfolioitem').next('.portfolioitem').find('a.homeportlink');
				} 
			} else {
				$nextitem = $this.closest('.portfolioitem').next('.portfolioitem').find('a.homeportlink');
				while ($nextitem.closest('.portfolioitem').find('.disable').css('display') === 'block' && $nextitem.length) {
					$nextitem = $nextitem.closest('.portfolioitem').next('.portfolioitem').find('a.homeportlink');
				}
			}
		}
		return $nextitem;
    }

    // Find Previous Portfolio Posts Function
    function findprev($this, $fade) {
    	if($this){
    		if ($fade !== 'Fade') { // Check for filter style
		    	$previtem = $this.closest('.portfolioitem').prev('.portfolioitem').find('a.homeportlink');
		       	while ($previtem.closest('.portfolioitem').hasClass('isotope-hidden') && $previtem.length) {
					$previtem = $previtem.closest('.portfolioitem').prev('.portfolioitem').find('a.homeportlink');
				} 
			} else {
				$previtem = $this.closest('.portfolioitem').prev('.portfolioitem').find('a.homeportlink');
				while ($previtem.closest('.portfolioitem').find('.disable').css('display') === 'block' && $previtem.length) {
					$previtem = $previtem.closest('.portfolioitem').prev('.portfolioitem').find('a.homeportlink');
				} 
			}
		}
		return $previtem;
    }

    function findprevnext($this, $filter, $fade) {

	    $nextitem = findnext($this, $filter);
		$previtem = findprev($this, $filter);

		if ($previtem) {
            $prevId = $previtem.attr('data-url');
    	}
    	if ($nextitem) {
			$nextId = $nextitem.attr('data-url');
		}

		if ($fade != 'none'){
	        if(typeof $prevId  == 'string') {
	        	jQuery('a#prev-port').stop().fadeIn(500);
	        } else {
	        	jQuery('a#prev-port').stop().fadeOut(500);
	        }
	        if(typeof $nextId  == 'string') {
	        	jQuery('a#next-port').stop().fadeIn(500);
	        } else {
	        	jQuery('a#next-port').stop().fadeOut(500);
	        }
    	} else {
    		if(typeof $prevId  == 'string') {
	        	jQuery('a#prev-port').stop().css('display', 'block');
	        } else {
	        	jQuery('a#prev-port').stop().css('display', 'none');
	        }
	        if(typeof $nextId  == 'string') {
	        	jQuery('a#next-port').stop().css('display', 'block');
	        } else {
	        	jQuery('a#next-port').stop().css('display', 'none');
	        }
    	}
    }

var $selector = '*';
      
    jQuery(window).load(function($){
        var $container = jQuery('div.isotopecontainer');  

        $container.each(function($) {
            var $this = jQuery(this),
                columnNumber = $this.attr('data-value'),
                isoBrick = jQuery('.isobrick'),
                $colnum2;

                isoBrick.css({
                    'margin-left': 0,
                    'margin-right': 0 
                });
          
              /* Calculate column number */
              /*====================================*/

              if ($this.width() < 500 ) {
                $colnum2 = 2;
              } else {
                $colnum2 = columnNumber;
              }

              /* Call Isotope with selected Columns */
              /*====================================*/

              if (columnNumber != '1') {

                  $this.isotope({
                  masonry: {
                      columnWidth: $this.width() / $colnum2
                    },
                    itemSelector : '.isobrick',
                    layoutMode : 'masonry'
                  });

                }


              /* Run Isotope on Resize Event */
              /*=============================*/

              jQuery(window).resize(function () {

                 if ($this.width() < 500 ) {
                    $colnum2 = 2;
                  } else {
                    $colnum2 = columnNumber;
                  }


                if (columnNumber != '1') {
                      /* Resize Isotope Container */
                      $this.isotope({
                          // update columnWidth to a percentage of container width
                          masonry: { 
                            columnWidth: $this.width() / $colnum2
                           },
                          itemSelector : '.isobrick',
                          layoutMode : 'masonry'
                      });
                }   
                  
              });

              /* Filter when link is clicked */
              /*=============================*/

                jQuery('.filtershuffle a').click(function(){
                    jQuery('.filtershuffle li').removeClass("active");
                	jQuery(this).closest('li').addClass('active');
                    $selector = jQuery(this).attr('data-value');
                      
                          jQuery('.filtershuffle a').each(function() {
                              $filterselect = jQuery(this).attr('data-value');
                              $filterselect = '.'+$filterselect;
                              if ($filterselect == '.'+$selector){
                                jQuery(this).addClass("active");
                              }
                          });

                      if ($selector != '*') {
						  $selector = '.'+$selector;
					  }
                      $this.isotope({ filter: $selector }, function() {
                      	findprevnext($selectedthing, $filterstyle);
                      });
                      return false;
                });

              /* Run Infinite Scroll         */
              /*=============================*/

                $this.infinitescroll({
                    navSelector  : '.more-posts',    // selector for the paged navigation 
                    nextSelector : '.more-posts a',  // selector for the NEXT link (to page 2)
                    itemSelector : '.isobrick',     // selector for all items you'll retrieve
                    loading: {
                        finishedMsg: '',
                        img: 'http://localhost/identity/wp-content/themes/district/images/loader.gif',
                        msgText: ''
                      }
                    },
                    // call Isotope as a callback
                    function( newElements ) {
                        jQuery('.more-posts').fadeIn('slow');
                        $this.isotope( 'insert', jQuery( newElements ), function(){
                            $this.isotope('reLayout');   
                            hover_overlay_portfolio();   
                        }); 
                    }
                );

                // kill scroll binding for manual clicking of button
                jQuery(window).unbind('.infscr');

                jQuery('.more-posts a').click(function(){ 
                    jQuery(document).trigger('retrieve.infscr');
                    $this.infinitescroll('retrieve'); 
                    return false; 
                });

        }); // End Each

    }); // End Window Load

} // if isotope


/*-----------------------------------------------------------------------------------*/
/* Superfish Initialization
/*-----------------------------------------------------------------------------------*/


	jQuery(function() { 
        jQuery('ul.sf-menu').superfish({ 
            autoArrows:  true
        }); 
    }); 

/*-----------------------------------------------------------------------------------*/
/* Tabs
/*-----------------------------------------------------------------------------------*/
    if(jQuery() .tabs) {	 
		jQuery( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
		jQuery( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
		jQuery( "#tabs" ).tabs({ fx: { opacity: 'toggle' } });
	};
	
/*-----------------------------------------------------------------------------------*/
/* Pretty Photo
/*-----------------------------------------------------------------------------------*/
	
	jQuery(function(){
	   jQuery("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: false, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: '<?php  if ($ppskin = get_option('of_prettyphoto_skin')) { echo $ppskin; } else { echo 'light_square'; } ?>', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true
			});
	});
	
	
/*-----------------------------------------------------------------------------------*/
/* Hover Effects
/*-----------------------------------------------------------------------------------*/
	

	jQuery('.portfolioitem').addClass('darkbg');
	jQuery('ul.slides').css('opacity',0);
	jQuery('.8-virtual-tour').removeClass('darkbg');
	jQuery('.8-virtual-tour .slides').css('opacity',1);	


	function hover_overlay() {
       
         jQuery('.flexslider .slides').each(function() {
                 var $this = jQuery(this),
                 	 $background = $this.closest('.portfolioitem');
                  $this.hover( function() {

                    jQuery($this).stop().animate({opacity : 1}, 500, function(){
                    	$background.removeClass('darkbg');
                    });
              
                }, function() {

                  	  $background.addClass('darkbg');
                      jQuery($this).stop().animate({opacity : 0.1}, 500);

                });
         });
    }
   
   
    hover_overlay();

       function hover_overlay_slide() {
        
        jQuery('.video').hover( function() {
            jQuery(this).stop().animate({opacity : 1}, 100);
        }, function() {
            jQuery(this).stop().animate({opacity : .9}, 100);
        });
    }
    
    hover_overlay_slide();
    
    function hover_overlay_images() {
        
        jQuery('a img').hover( function() {
            jQuery(this).stop().animate({opacity : 0.7}, 500);
        }, function() {
            jQuery(this).stop().animate({opacity : 1}, 500);
        });
    }
    
    hover_overlay_images();
    
 
/*-----------------------------------------------------------------------------------*/
/*  Portfolio Mini Flexible Slideshow
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function() {	
		jQuery('.flexslider').each(function() {
        var $this = jQuery(this);
        $this.flexslider({
					animation: "fade",              //String: Select your animation type, "fade" or "slide"
					slideDirection: "vertical",   //String: Select the sliding direction, "horizontal" or "vertical"
					slideshow: <?php if ($autoplay = get_option('of_autoplay')) { echo $autoplay; } else { echo 'true'; } ?>,                //Boolean: Animate slider automatically
					slideshowSpeed: Math.floor(Math.random()*10001) + 3000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
					animationDuration: 2000,         //Integer: Set the speed of animations, in milliseconds
					directionNav: false,             //Boolean: Create navigation for previous/next navigation? (true/false)
					controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
					keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
					mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
					prevText: "Previous",           //String: Set the text for the "previous" directionNav item
					nextText: "Next",               //String: Set the text for the "next" directionNav item
					pausePlay: false,               //Boolean: Create pause/play dynamic element
					pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
					playText: 'Play',               //String: Set the text for the "play" pausePlay item
					randomize: false,               //Boolean: Randomize slide order
					slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
					animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
					pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
					pauseOnHover: true,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
					controlsContainer: "",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
					manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
					start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
					before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
					after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
					end: function(){}               //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)					
										
			});
		});
	});


		

/*-----------------------------------------------------------------------------------*/
/*  Scroll to Top by Andre Gagnon
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function() {
						   
jQuery(window).scroll(function () {
						   
 	var y_scroll_pos = window.pageYOffset;
    var scroll_pos_test = 50;             // set to whatever you want it to be
	
    if(y_scroll_pos > scroll_pos_test) {
        jQuery('.top').fadeIn(1000);
        jQuery('.iphone').children('.top').css('display', 'none !important');
		} else { jQuery('.top').fadeOut(500);
         }
	});

	jQuery('.top').click(function(){
			
			jQuery('html, body').animate({scrollTop:0}, 500, 'easeOutCubic');
			return false;
	});
});


/*-----------------------------------------------------------------------------------*/
/*  Top Widgets Drawer by Andre Gagnon
/*-----------------------------------------------------------------------------------*/
    
  jQuery(function($) {
	var height = $('#top_panel_content').height();
	$('#top_panel_button').click(function() {
		var docHeight = $(document).height();
		var windowHeight = $(window).height();
		var scrollPos = docHeight - windowHeight + height;
		$('#top_panel_content').animate({ height: "toggle"}, 500, 'easeOutCubic');
        $('#toggle_button').toggleClass("downarrow");
        jQuery('#top_panel').removeClass('active');
					jQuery(this).addClass('active');
	});
});


/*-----------------------------------------------------------------------------------*/
/*  Ajax Load Post
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function($){

    $.ajaxSetup({cache:false});
    
    /* Declare Variables */
    var ajaxouter = jQuery('#ajaxouter'), /* Outer Container (with data id = post id) */
        url = jQuery('#ajaxinner').attr('data-url'), /* Set the post ID from the outer container */
    	$this = null,
    	$state = 'closed';

    // Function to scroll the viewport
    function scrollwindow($here) {
    	if ( $.browser.msie && $.browser.version == '7.0') {			
            $('html,body').parent().animate({scrollTop: $($here).offset().top}, 2000, 'easeOutCubic');  
        } else {
			$('html,body').animate({scrollTop: $($here).offset().top}, 2000, 'easeOutCubic');  
        }
    }
     
    $(".flexslider ul.slides li a").live('click', function(e){ e.preventDefault();
       
       /*Set Function Variables */       
        $this = $(this);
        $selectedthing = $this;
        $postId = $($this).attr('data-url');

        // Find Previous and Next Portfolio Items
        findprevnext($selectedthing, $filterstyle);

        $('.ajaxloading').fadeIn(500);

        // Scroll to the Loading Container
        scrollwindow('#loadingcontainer');
       
                if ($state !== 'closed'){ 
                $('#ajaxcontainer').animate({ height: "toggle"}, 500, 'easeOutCubic');
                }
                ajaxouter.load(url, {
			    id: $postId
			     }, 
                 	function() {
        				if ($state == 'closed'){   
        					
                            $('#ajaxcontainer').animate({ height: "toggle"}, 500, 'easeOutCubic'); 
                                   
                                   /* If there's a previous */
                                    if(typeof $prevId  == 'string') {
                                   		$('a#prev-port').css('display', 'block');
                                    } else {
                                    	$('a#prev-port').css('display', 'none');
                                    } 
                                    
                                    /* If there's a Next*/
                                    if(typeof $nextId  == 'string') {
                                    	$('a#next-port').css('display', 'block');
                                    } else {
                                    	$('a#next-port').css('display', 'none');
                                    }
                                       
        	     		 $state = 'open';
                         
              		 } else {
                     
                    		$('#ajaxcontainer').animate({ height: "toggle"}, 500, 'easeOutCubic');

									/* If there's a previous */
                                    if(typeof $prevId  == 'string') {
                                    	$('a#prev-port').css('display', 'block');
                                    } else {
                                    	$('a#prev-port').css('display', 'none');
                                    } 
                                    
                                    /* If there's a Next*/
                                    if(typeof $nextId  == 'string') {
                                    	$('a#next-port').css('display', 'block');
                                    } else {
                                    	$('a#next-port').css('display', 'none');
                                    } 
                                     
                     }
                     
                       $('.ajaxloading').fadeOut(500);
           		}
            ); 
            
        return false; 
});


jQuery('a#next-port').live('click', function(e){ e.preventDefault();
    
    if(typeof $nextId  == 'string') {
   
   		jQuery('.ajaxloading').fadeIn(500);
    	jQuery('#ajaxcontainer').animate({ height: "toggle"}, 500, 'easeOutCubic');
        
    	     	ajaxouter.load(url, { id: $nextId   }, 
                 	function() {
         				$this = $nextitem;
         				$selectedthing = $this;
         				findprevnext($selectedthing, $filterstyle, 'none');
                    
					jQuery('#ajaxcontainer').animate({ height: "toggle"}, 500, 'easeOutCubic');
        			jQuery('.ajaxloading').fadeOut(500);
                    
          });     
    } 
   
});

jQuery('a#prev-port').live('click', function(e){ e.preventDefault();
    
    if(typeof $prevId  == 'string') {
    
   		jQuery('.ajaxloading').fadeIn(500);
    	jQuery('#ajaxcontainer').animate({ height: "toggle"}, 500, 'easeOutCubic');
    	     	
                ajaxouter.load(url, { id: $prevId   },
                 	function() {
                 	$this = $previtem;
                 	$selectedthing = $this;
                    findprevnext($selectedthing, $filterstyle, 'none');
                    
                    jQuery('#ajaxcontainer').animate({ height: "toggle"}, 500, 'easeOutCubic');
					jQuery('.ajaxloading').fadeOut(500);
                    
           });     
    }
   
});


jQuery('a.portfolio-close').live('click', function(e){ 
        e.preventDefault();
        $state = 'closed'; 
        
        // Scroll to the Loading Container
        scrollwindow('body');
        
		jQuery('#ajaxcontainer').animate({ height: "toggle"}, 500, 'easeOutCubic', function(){        
           jQuery('.ajaxslider').remove(); // so videos stop playing
        });		
});

	<?php if (($slidestate = get_option('of_slideshow_state')) == 'Open') { ?>
    
    	$this = jQuery('.slideshow .portfolioitem:first').find('a.homeportlink');
        $initialopen = jQuery('.slideshow .portfolioitem:first').find('a.homeportlink').attr('data-url');
        findprevnext($this, $filterstyle);
        
	  		jQuery('.ajaxloading').fadeIn(500);
     			
                ajaxouter.load(url, {
			    id: $initialopen
			     }, 
                 	function() {
        				if ($state == 'closed'){   
        					jQuery('#ajaxcontainer').animate({ height: "toggle"}, 500, 'easeOutCubic'); 
        	     		 $state = 'open';
                         jQuery('a#prev-port').css('display', 'none');
                         jQuery('.ajaxloading').fadeOut(500);
              		 } // endif 
           		} //end function
            ); //ajaxouter   

    <?php } ?>

});


/*-----------------------------------------------------------------------------------*/
/* Fade Filter Portfolio
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function() {
	jQuery('ul.filterfade a').click(function() {
		var HasBeenViewed = false;
		jQuery(this).css('outline','none');
		jQuery('ul.filter .active').removeClass('active');
		jQuery(this).parent().addClass('active');

		var filterVal = jQuery(this).text().toLowerCase().replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-');  
        
		if(jQuery(this).hasClass('filterall')) {
			jQuery('.portfolioitem .disable').stop().animate({opacity: 0}, 500, function(){
	            jQuery(this).css('display', 'none');
				//Check for previous and next arrows
				window.setTimeout(function() {
					if(!HasBeenViewed) {
						findprevnext($selectedthing, $filterstyle);
						HasBeenViewed = true; 
					}
				}, 501);
            });
            
		} else {
			jQuery('.portfolioitem .disable').each(function() {
				if(!jQuery(this).hasClass(filterVal)) {
					jQuery(this).css('display', 'block');
					jQuery(this).stop().animate({opacity: .95}, 500, function(){
						//Check for previous and next arrows
						window.setTimeout(function() {
							if(!HasBeenViewed) {
							findprevnext($selectedthing, $filterstyle);
							HasBeenViewed = true; 
							}
						}, 501);
												
					});
				} else {
					jQuery(this).stop().animate({opacity: 0}, 500, function(){
						jQuery(this).css('display', 'none');
						//Check for previous and next arrows
						window.setTimeout(function() {
							if(!HasBeenViewed) {
							findprevnext($selectedthing, $filterstyle);
							HasBeenViewed = true; 
							}
						}, 501);
					});  
				}
			});
		}
		return false;
	});
});

/*-----------------------------------------------------------------------------------*/
/* Portfolio Flexible Slider
/*-----------------------------------------------------------------------------------*/

jQuery('.projectslideshow').wmuSlider({
    animation: 'fade',
	animationDuration: 600,
	slideshow: <?php if ($portautoplay = get_option('of_portfolio_autoplay')) { echo $portautoplay; } else { echo 'true'; } ?>, 
	slideshowSpeed: <?php if ($portautoplaydelay = get_option('of_project_autoplay_delay')) { echo $portautoplaydelay.'000'; } else { echo '7000'; } ?>,
	slideToStart: 0,
	navigationControl: true,
	paginationControl: true,
	previousText: 'Previous',
	nextText: 'Next',
	touch: true,
	slide: 'span'
}); 

/*-----------------------------------------------------------------------------------*/
/* FitVid Fluid Video
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function(){
    jQuery(".videocontainer").fitVids();
});


/*-----------------------------------------------------------------------------------*/
/* Coda Slider
/*-----------------------------------------------------------------------------------*/
if(jQuery() .codaSlider){ 	
       jQuery('#coda-slider-1').codaSlider({
           dynamicArrows: false,
           dynamicTabs: false
       });
   };
 
/*-----------------------------------------------------------------------------------*/
/* Form Validation
/*-----------------------------------------------------------------------------------*/
 
jQuery(document).ready(function(){
	jQuery("#contactform").validate();
	jQuery("#quoteform").validate();
	jQuery("#quickform").validate();
    jQuery("#commentsubmit").validate();
});