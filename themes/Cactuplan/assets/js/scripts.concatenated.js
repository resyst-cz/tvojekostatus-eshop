!function(t){function e(i){if(n[i])return n[i].exports;var r=n[i]={exports:{},id:i,loaded:!1};return t[i].call(r.exports,r,r.exports,e),r.loaded=!0,r.exports}var n={};return e.m=t,e.c=n,e.p="",e(0)}([function(t,e,n){t.exports=n(1)},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}n(2),n(4),n(5),n(6),n(7),n(10),n(11),n(12),n(15),n(16);var r=n(17),o=i(r),a=n(18),s=i(a),l=n(14),u=i(l),c=n(19),f=i(c),d=n(20),p=i(d),h=n(9),m=i(h),g=n(21),y=i(g);n(22),n(23),n(24);for(var v in y.default.prototype)m.default[v]=y.default.prototype[v];$(document).ready(function(){var t=$(".js-dropdown"),e=new s.default,n=$('.js-top-menu ul[data-depth="0"]'),i=new o.default(t),r=new p.default(n),a=new u.default,l=new f.default;i.init(),e.init(),r.init(),a.init(),l.init()})},function(t,e,n){(function(e){t.exports=e.Tether=n(3)}).call(e,function(){return this}())},function(t,e,n){var i,r;!function(o,a){i=a,r="function"==typeof i?i.call(e,n,e,t):i,!(void 0!==r&&(t.exports=r))}(this,function(t,e,n){"use strict";function i(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function r(t){var e=t.getBoundingClientRect(),n={};for(var i in e)n[i]=e[i];if(t.ownerDocument!==document){var o=t.ownerDocument.defaultView.frameElement;if(o){var a=r(o);n.top+=a.top,n.bottom+=a.top,n.left+=a.left,n.right+=a.left}}return n}function o(t){var e=getComputedStyle(t)||{},n=e.position,i=[];if("fixed"===n)return[t];for(var r=t;(r=r.parentNode)&&r&&1===r.nodeType;){var o=void 0;try{o=getComputedStyle(r)}catch(t){}if("undefined"==typeof o||null===o)return i.push(r),i;var a=o,s=a.overflow,l=a.overflowX,u=a.overflowY;/(auto|scroll)/.test(s+u+l)&&("absolute"!==n||["relative","absolute","fixed"].indexOf(o.position)>=0)&&i.push(r)}return i.push(t.ownerDocument.body),t.ownerDocument!==document&&i.push(t.ownerDocument.defaultView),i}function a(){C&&document.body.removeChild(C),C=null}function s(t){var e=void 0;t===document?(e=document,t=document.documentElement):e=t.ownerDocument;var n=e.documentElement,i=r(t),o=I();return i.top-=o.top,i.left-=o.left,"undefined"==typeof i.width&&(i.width=document.body.scrollWidth-i.left-i.right),"undefined"==typeof i.height&&(i.height=document.body.scrollHeight-i.top-i.bottom),i.top=i.top-n.clientTop,i.left=i.left-n.clientLeft,i.right=e.body.clientWidth-i.width-i.left,i.bottom=e.body.clientHeight-i.height-i.top,i}function l(t){return t.offsetParent||document.documentElement}function u(){if(O)return O;var t=document.createElement("div");t.style.width="100%",t.style.height="200px";var e=document.createElement("div");c(e.style,{position:"absolute",top:0,left:0,pointerEvents:"none",visibility:"hidden",width:"200px",height:"150px",overflow:"hidden"}),e.appendChild(t),document.body.appendChild(e);var n=t.offsetWidth;e.style.overflow="scroll";var i=t.offsetWidth;n===i&&(i=e.clientWidth),document.body.removeChild(e);var r=n-i;return O={width:r,height:r}}function c(){var t=arguments.length<=0||void 0===arguments[0]?{}:arguments[0],e=[];return Array.prototype.push.apply(e,arguments),e.slice(1).forEach(function(e){if(e)for(var n in e)({}).hasOwnProperty.call(e,n)&&(t[n]=e[n])}),t}function f(t,e){if("undefined"!=typeof t.classList)e.split(" ").forEach(function(e){e.trim()&&t.classList.remove(e)});else{var n=new RegExp("(^| )"+e.split(" ").join("|")+"( |$)","gi"),i=h(t).replace(n," ");m(t,i)}}function d(t,e){if("undefined"!=typeof t.classList)e.split(" ").forEach(function(e){e.trim()&&t.classList.add(e)});else{f(t,e);var n=h(t)+(" "+e);m(t,n)}}function p(t,e){if("undefined"!=typeof t.classList)return t.classList.contains(e);var n=h(t);return new RegExp("(^| )"+e+"( |$)","gi").test(n)}function h(t){return t.className instanceof t.ownerDocument.defaultView.SVGAnimatedString?t.className.baseVal:t.className}function m(t,e){t.setAttribute("class",e)}function g(t,e,n){n.forEach(function(n){e.indexOf(n)===-1&&p(t,n)&&f(t,n)}),e.forEach(function(e){p(t,e)||d(t,e)})}function i(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function y(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function v(t,e){var n=arguments.length<=2||void 0===arguments[2]?1:arguments[2];return t+n>=e&&e>=t-n}function b(){return"undefined"!=typeof performance&&"undefined"!=typeof performance.now?performance.now():+new Date}function _(){for(var t={top:0,left:0},e=arguments.length,n=Array(e),i=0;i<e;i++)n[i]=arguments[i];return n.forEach(function(e){var n=e.top,i=e.left;"string"==typeof n&&(n=parseFloat(n,10)),"string"==typeof i&&(i=parseFloat(i,10)),t.top+=n,t.left+=i}),t}function x(t,e){return"string"==typeof t.left&&t.left.indexOf("%")!==-1&&(t.left=parseFloat(t.left,10)/100*e.width),"string"==typeof t.top&&t.top.indexOf("%")!==-1&&(t.top=parseFloat(t.top,10)/100*e.height),t}function S(t,e){return"scrollParent"===e?e=t.scrollParents[0]:"window"===e&&(e=[pageXOffset,pageYOffset,innerWidth+pageXOffset,innerHeight+pageYOffset]),e===document&&(e=e.documentElement),"undefined"!=typeof e.nodeType&&!function(){var t=e,n=s(e),i=n,r=getComputedStyle(e);if(e=[i.left,i.top,n.width+i.left,n.height+i.top],t.ownerDocument!==document){var o=t.ownerDocument.defaultView;e[0]+=o.pageXOffset,e[1]+=o.pageYOffset,e[2]+=o.pageXOffset,e[3]+=o.pageYOffset}Y.forEach(function(t,n){t=t[0].toUpperCase()+t.substr(1),"Top"===t||"Left"===t?e[n]+=parseFloat(r["border"+t+"Width"]):e[n]-=parseFloat(r["border"+t+"Width"])})}(),e}var w=function(){function t(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,n,i){return n&&t(e.prototype,n),i&&t(e,i),e}}(),E=void 0;"undefined"==typeof E&&(E={modules:[]});var C=null,T=function(){var t=0;return function(){return++t}}(),A={},I=function(){var t=C;t&&document.body.contains(t)||(t=document.createElement("div"),t.setAttribute("data-tether-id",T()),c(t.style,{top:0,left:0,position:"absolute"}),document.body.appendChild(t),C=t);var e=t.getAttribute("data-tether-id");return"undefined"==typeof A[e]&&(A[e]=r(t),D(function(){delete A[e]})),A[e]},O=null,k=[],D=function(t){k.push(t)},N=function(){for(var t=void 0;t=k.pop();)t()},P=function(){function t(){i(this,t)}return w(t,[{key:"on",value:function(t,e,n){var i=!(arguments.length<=3||void 0===arguments[3])&&arguments[3];"undefined"==typeof this.bindings&&(this.bindings={}),"undefined"==typeof this.bindings[t]&&(this.bindings[t]=[]),this.bindings[t].push({handler:e,ctx:n,once:i})}},{key:"once",value:function(t,e,n){this.on(t,e,n,!0)}},{key:"off",value:function(t,e){if("undefined"!=typeof this.bindings&&"undefined"!=typeof this.bindings[t])if("undefined"==typeof e)delete this.bindings[t];else for(var n=0;n<this.bindings[t].length;)this.bindings[t][n].handler===e?this.bindings[t].splice(n,1):++n}},{key:"trigger",value:function(t){if("undefined"!=typeof this.bindings&&this.bindings[t]){for(var e=0,n=arguments.length,i=Array(n>1?n-1:0),r=1;r<n;r++)i[r-1]=arguments[r];for(;e<this.bindings[t].length;){var o=this.bindings[t][e],a=o.handler,s=o.ctx,l=o.once,u=s;"undefined"==typeof u&&(u=this),a.apply(u,i),l?this.bindings[t].splice(e,1):++e}}}}]),t}();E.Utils={getActualBoundingClientRect:r,getScrollParents:o,getBounds:s,getOffsetParent:l,extend:c,addClass:d,removeClass:f,hasClass:p,updateClasses:g,defer:D,flush:N,uniqueId:T,Evented:P,getScrollBarSize:u,removeUtilElements:a};var L=function(){function t(t,e){var n=[],i=!0,r=!1,o=void 0;try{for(var a,s=t[Symbol.iterator]();!(i=(a=s.next()).done)&&(n.push(a.value),!e||n.length!==e);i=!0);}catch(t){r=!0,o=t}finally{try{!i&&s.return&&s.return()}finally{if(r)throw o}}return n}return function(e,n){if(Array.isArray(e))return e;if(Symbol.iterator in Object(e))return t(e,n);throw new TypeError("Invalid attempt to destructure non-iterable instance")}}(),w=function(){function t(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,n,i){return n&&t(e.prototype,n),i&&t(e,i),e}}(),j=function(t,e,n){for(var i=!0;i;){var r=t,o=e,a=n;i=!1,null===r&&(r=Function.prototype);var s=Object.getOwnPropertyDescriptor(r,o);if(void 0!==s){if("value"in s)return s.value;var l=s.get;if(void 0===l)return;return l.call(a)}var u=Object.getPrototypeOf(r);if(null===u)return;t=u,e=o,n=a,i=!0,s=u=void 0}};if("undefined"==typeof E)throw new Error("You must include the utils.js file before tether.js");var B=E.Utils,o=B.getScrollParents,s=B.getBounds,l=B.getOffsetParent,c=B.extend,d=B.addClass,f=B.removeClass,g=B.updateClasses,D=B.defer,N=B.flush,u=B.getScrollBarSize,a=B.removeUtilElements,V=function(){if("undefined"==typeof document)return"";for(var t=document.createElement("div"),e=["transform","WebkitTransform","OTransform","MozTransform","msTransform"],n=0;n<e.length;++n){var i=e[n];if(void 0!==t.style[i])return i}}(),F=[],R=function(){F.forEach(function(t){t.position(!1)}),N()};!function(){var t=null,e=null,n=null,i=function i(){return"undefined"!=typeof e&&e>16?(e=Math.min(e-16,250),void(n=setTimeout(i,250))):void("undefined"!=typeof t&&b()-t<10||(null!=n&&(clearTimeout(n),n=null),t=b(),R(),e=b()-t))};"undefined"!=typeof window&&"undefined"!=typeof window.addEventListener&&["resize","scroll","touchmove"].forEach(function(t){window.addEventListener(t,i)})}();var M={center:"center",left:"right",right:"left"},H={middle:"middle",top:"bottom",bottom:"top"},W={top:0,left:0,middle:"50%",center:"50%",bottom:"100%",right:"100%"},U=function(t,e){var n=t.left,i=t.top;return"auto"===n&&(n=M[e.left]),"auto"===i&&(i=H[e.top]),{left:n,top:i}},z=function(t){var e=t.left,n=t.top;return"undefined"!=typeof W[t.left]&&(e=W[t.left]),"undefined"!=typeof W[t.top]&&(n=W[t.top]),{left:e,top:n}},$=function(t){var e=t.split(" "),n=L(e,2),i=n[0],r=n[1];return{top:i,left:r}},q=$,Q=function(t){function e(t){var n=this;i(this,e),j(Object.getPrototypeOf(e.prototype),"constructor",this).call(this),this.position=this.position.bind(this),F.push(this),this.history=[],this.setOptions(t,!1),E.modules.forEach(function(t){"undefined"!=typeof t.initialize&&t.initialize.call(n)}),this.position()}return y(e,t),w(e,[{key:"getClass",value:function(){var t=arguments.length<=0||void 0===arguments[0]?"":arguments[0],e=this.options.classes;return"undefined"!=typeof e&&e[t]?this.options.classes[t]:this.options.classPrefix?this.options.classPrefix+"-"+t:t}},{key:"setOptions",value:function(t){var e=this,n=arguments.length<=1||void 0===arguments[1]||arguments[1],i={offset:"0 0",targetOffset:"0 0",targetAttachment:"auto auto",classPrefix:"tether"};this.options=c(i,t);var r=this.options,a=r.element,s=r.target,l=r.targetModifier;if(this.element=a,this.target=s,this.targetModifier=l,"viewport"===this.target?(this.target=document.body,this.targetModifier="visible"):"scroll-handle"===this.target&&(this.target=document.body,this.targetModifier="scroll-handle"),["element","target"].forEach(function(t){if("undefined"==typeof e[t])throw new Error("Tether Error: Both element and target must be defined");"undefined"!=typeof e[t].jquery?e[t]=e[t][0]:"string"==typeof e[t]&&(e[t]=document.querySelector(e[t]))}),d(this.element,this.getClass("element")),this.options.addTargetClasses!==!1&&d(this.target,this.getClass("target")),!this.options.attachment)throw new Error("Tether Error: You must provide an attachment");this.targetAttachment=q(this.options.targetAttachment),this.attachment=q(this.options.attachment),this.offset=$(this.options.offset),this.targetOffset=$(this.options.targetOffset),"undefined"!=typeof this.scrollParents&&this.disable(),"scroll-handle"===this.targetModifier?this.scrollParents=[this.target]:this.scrollParents=o(this.target),this.options.enabled!==!1&&this.enable(n)}},{key:"getTargetBounds",value:function(){if("undefined"==typeof this.targetModifier)return s(this.target);if("visible"===this.targetModifier){if(this.target===document.body)return{top:pageYOffset,left:pageXOffset,height:innerHeight,width:innerWidth};var t=s(this.target),e={height:t.height,width:t.width,top:t.top,left:t.left};return e.height=Math.min(e.height,t.height-(pageYOffset-t.top)),e.height=Math.min(e.height,t.height-(t.top+t.height-(pageYOffset+innerHeight))),e.height=Math.min(innerHeight,e.height),e.height-=2,e.width=Math.min(e.width,t.width-(pageXOffset-t.left)),e.width=Math.min(e.width,t.width-(t.left+t.width-(pageXOffset+innerWidth))),e.width=Math.min(innerWidth,e.width),e.width-=2,e.top<pageYOffset&&(e.top=pageYOffset),e.left<pageXOffset&&(e.left=pageXOffset),e}if("scroll-handle"===this.targetModifier){var t=void 0,n=this.target;n===document.body?(n=document.documentElement,t={left:pageXOffset,top:pageYOffset,height:innerHeight,width:innerWidth}):t=s(n);var i=getComputedStyle(n),r=n.scrollWidth>n.clientWidth||[i.overflow,i.overflowX].indexOf("scroll")>=0||this.target!==document.body,o=0;r&&(o=15);var a=t.height-parseFloat(i.borderTopWidth)-parseFloat(i.borderBottomWidth)-o,e={width:15,height:.975*a*(a/n.scrollHeight),left:t.left+t.width-parseFloat(i.borderLeftWidth)-15},l=0;a<408&&this.target===document.body&&(l=-11e-5*Math.pow(a,2)-.00727*a+22.58),this.target!==document.body&&(e.height=Math.max(e.height,24));var u=this.target.scrollTop/(n.scrollHeight-a);return e.top=u*(a-e.height-l)+t.top+parseFloat(i.borderTopWidth),this.target===document.body&&(e.height=Math.max(e.height,24)),e}}},{key:"clearCache",value:function(){this._cache={}}},{key:"cache",value:function(t,e){return"undefined"==typeof this._cache&&(this._cache={}),"undefined"==typeof this._cache[t]&&(this._cache[t]=e.call(this)),this._cache[t]}},{key:"enable",value:function(){var t=this,e=arguments.length<=0||void 0===arguments[0]||arguments[0];this.options.addTargetClasses!==!1&&d(this.target,this.getClass("enabled")),d(this.element,this.getClass("enabled")),this.enabled=!0,this.scrollParents.forEach(function(e){e!==t.target.ownerDocument&&e.addEventListener("scroll",t.position)}),e&&this.position()}},{key:"disable",value:function(){var t=this;f(this.target,this.getClass("enabled")),f(this.element,this.getClass("enabled")),this.enabled=!1,"undefined"!=typeof this.scrollParents&&this.scrollParents.forEach(function(e){e.removeEventListener("scroll",t.position)})}},{key:"destroy",value:function(){var t=this;this.disable(),F.forEach(function(e,n){e===t&&F.splice(n,1)}),0===F.length&&a()}},{key:"updateAttachClasses",value:function(t,e){var n=this;t=t||this.attachment,e=e||this.targetAttachment;var i=["left","top","bottom","right","middle","center"];"undefined"!=typeof this._addAttachClasses&&this._addAttachClasses.length&&this._addAttachClasses.splice(0,this._addAttachClasses.length),"undefined"==typeof this._addAttachClasses&&(this._addAttachClasses=[]);var r=this._addAttachClasses;t.top&&r.push(this.getClass("element-attached")+"-"+t.top),t.left&&r.push(this.getClass("element-attached")+"-"+t.left),e.top&&r.push(this.getClass("target-attached")+"-"+e.top),e.left&&r.push(this.getClass("target-attached")+"-"+e.left);var o=[];i.forEach(function(t){o.push(n.getClass("element-attached")+"-"+t),o.push(n.getClass("target-attached")+"-"+t)}),D(function(){"undefined"!=typeof n._addAttachClasses&&(g(n.element,n._addAttachClasses,o),n.options.addTargetClasses!==!1&&g(n.target,n._addAttachClasses,o),delete n._addAttachClasses)})}},{key:"position",value:function(){var t=this,e=arguments.length<=0||void 0===arguments[0]||arguments[0];if(this.enabled){this.clearCache();var n=U(this.targetAttachment,this.attachment);this.updateAttachClasses(this.attachment,n);var i=this.cache("element-bounds",function(){return s(t.element)}),r=i.width,o=i.height;if(0===r&&0===o&&"undefined"!=typeof this.lastSize){var a=this.lastSize;r=a.width,o=a.height}else this.lastSize={width:r,height:o};var c=this.cache("target-bounds",function(){return t.getTargetBounds()}),f=c,d=x(z(this.attachment),{width:r,height:o}),p=x(z(n),f),h=x(this.offset,{width:r,height:o}),m=x(this.targetOffset,f);d=_(d,h),p=_(p,m);for(var g=c.left+p.left-d.left,y=c.top+p.top-d.top,v=0;v<E.modules.length;++v){var b=E.modules[v],S=b.position.call(this,{left:g,top:y,targetAttachment:n,targetPos:c,elementPos:i,offset:d,targetOffset:p,manualOffset:h,manualTargetOffset:m,scrollbarSize:A,attachment:this.attachment});if(S===!1)return!1;"undefined"!=typeof S&&"object"==typeof S&&(y=S.top,g=S.left)}var w={page:{top:y,left:g},viewport:{top:y-pageYOffset,bottom:pageYOffset-y-o+innerHeight,left:g-pageXOffset,right:pageXOffset-g-r+innerWidth}},C=this.target.ownerDocument,T=C.defaultView,A=void 0;return T.innerHeight>C.documentElement.clientHeight&&(A=this.cache("scrollbar-size",u),w.viewport.bottom-=A.height),T.innerWidth>C.documentElement.clientWidth&&(A=this.cache("scrollbar-size",u),w.viewport.right-=A.width),["","static"].indexOf(C.body.style.position)!==-1&&["","static"].indexOf(C.body.parentElement.style.position)!==-1||(w.page.bottom=C.body.scrollHeight-y-o,w.page.right=C.body.scrollWidth-g-r),"undefined"!=typeof this.options.optimizations&&this.options.optimizations.moveElement!==!1&&"undefined"==typeof this.targetModifier&&!function(){var e=t.cache("target-offsetparent",function(){return l(t.target)}),n=t.cache("target-offsetparent-bounds",function(){return s(e)}),i=getComputedStyle(e),r=n,o={};if(["Top","Left","Bottom","Right"].forEach(function(t){o[t.toLowerCase()]=parseFloat(i["border"+t+"Width"])}),n.right=C.body.scrollWidth-n.left-r.width+o.right,n.bottom=C.body.scrollHeight-n.top-r.height+o.bottom,w.page.top>=n.top+o.top&&w.page.bottom>=n.bottom&&w.page.left>=n.left+o.left&&w.page.right>=n.right){var a=e.scrollTop,u=e.scrollLeft;w.offset={top:w.page.top-n.top+a-o.top,left:w.page.left-n.left+u-o.left}}}(),this.move(w),this.history.unshift(w),this.history.length>3&&this.history.pop(),e&&N(),!0}}},{key:"move",value:function(t){var e=this;if("undefined"!=typeof this.element.parentNode){var n={};for(var i in t){n[i]={};for(var r in t[i]){for(var o=!1,a=0;a<this.history.length;++a){var s=this.history[a];if("undefined"!=typeof s[i]&&!v(s[i][r],t[i][r])){o=!0;break}}o||(n[i][r]=!0)}}var u={top:"",left:"",right:"",bottom:""},f=function(t,n){var i="undefined"!=typeof e.options.optimizations,r=i?e.options.optimizations.gpu:null;if(r!==!1){var o=void 0,a=void 0;if(t.top?(u.top=0,o=n.top):(u.bottom=0,o=-n.bottom),t.left?(u.left=0,a=n.left):(u.right=0,a=-n.right),window.matchMedia){var s=window.matchMedia("only screen and (min-resolution: 1.3dppx)").matches||window.matchMedia("only screen and (-webkit-min-device-pixel-ratio: 1.3)").matches;s||(a=Math.round(a),o=Math.round(o))}u[V]="translateX("+a+"px) translateY("+o+"px)","msTransform"!==V&&(u[V]+=" translateZ(0)")}else t.top?u.top=n.top+"px":u.bottom=n.bottom+"px",t.left?u.left=n.left+"px":u.right=n.right+"px"},d=!1;if((n.page.top||n.page.bottom)&&(n.page.left||n.page.right)?(u.position="absolute",f(n.page,t.page)):(n.viewport.top||n.viewport.bottom)&&(n.viewport.left||n.viewport.right)?(u.position="fixed",f(n.viewport,t.viewport)):"undefined"!=typeof n.offset&&n.offset.top&&n.offset.left?!function(){u.position="absolute";var i=e.cache("target-offsetparent",function(){return l(e.target)});l(e.element)!==i&&D(function(){e.element.parentNode.removeChild(e.element),i.appendChild(e.element)}),f(n.offset,t.offset),d=!0}():(u.position="absolute",f({top:!0,left:!0},t.page)),!d)if(this.options.bodyElement)this.options.bodyElement.appendChild(this.element);else{for(var p=!0,h=this.element.parentNode;h&&1===h.nodeType&&"BODY"!==h.tagName;){if("static"!==getComputedStyle(h).position){p=!1;break}h=h.parentNode}p||(this.element.parentNode.removeChild(this.element),this.element.ownerDocument.body.appendChild(this.element))}var m={},g=!1;for(var r in u){var y=u[r],b=this.element.style[r];b!==y&&(g=!0,m[r]=y)}g&&D(function(){c(e.element.style,m),e.trigger("repositioned")})}}}]),e}(P);Q.modules=[],E.position=R;var G=c(Q,E),L=function(){function t(t,e){var n=[],i=!0,r=!1,o=void 0;try{for(var a,s=t[Symbol.iterator]();!(i=(a=s.next()).done)&&(n.push(a.value),!e||n.length!==e);i=!0);}catch(t){r=!0,o=t}finally{try{!i&&s.return&&s.return()}finally{if(r)throw o}}return n}return function(e,n){if(Array.isArray(e))return e;if(Symbol.iterator in Object(e))return t(e,n);throw new TypeError("Invalid attempt to destructure non-iterable instance")}}(),B=E.Utils,s=B.getBounds,c=B.extend,g=B.updateClasses,D=B.defer,Y=["left","top","right","bottom"];E.modules.push({position:function(t){var e=this,n=t.top,i=t.left,r=t.targetAttachment;if(!this.options.constraints)return!0;var o=this.cache("element-bounds",function(){return s(e.element)}),a=o.height,l=o.width;if(0===l&&0===a&&"undefined"!=typeof this.lastSize){var u=this.lastSize;l=u.width,a=u.height}var f=this.cache("target-bounds",function(){return e.getTargetBounds()}),d=f.height,p=f.width,h=[this.getClass("pinned"),this.getClass("out-of-bounds")];this.options.constraints.forEach(function(t){var e=t.outOfBoundsClass,n=t.pinnedClass;e&&h.push(e),n&&h.push(n)}),h.forEach(function(t){["left","top","right","bottom"].forEach(function(e){h.push(t+"-"+e)})});var m=[],y=c({},r),v=c({},this.attachment);return this.options.constraints.forEach(function(t){var o=t.to,s=t.attachment,u=t.pin;"undefined"==typeof s&&(s="");var c=void 0,f=void 0;if(s.indexOf(" ")>=0){var h=s.split(" "),g=L(h,2);f=g[0],c=g[1]}else c=f=s;var b=S(e,o);"target"!==f&&"both"!==f||(n<b[1]&&"top"===y.top&&(n+=d,y.top="bottom"),n+a>b[3]&&"bottom"===y.top&&(n-=d,y.top="top")),"together"===f&&("top"===y.top&&("bottom"===v.top&&n<b[1]?(n+=d,y.top="bottom",n+=a,v.top="top"):"top"===v.top&&n+a>b[3]&&n-(a-d)>=b[1]&&(n-=a-d,y.top="bottom",v.top="bottom")),"bottom"===y.top&&("top"===v.top&&n+a>b[3]?(n-=d,y.top="top",n-=a,v.top="bottom"):"bottom"===v.top&&n<b[1]&&n+(2*a-d)<=b[3]&&(n+=a-d,y.top="top",v.top="top")),"middle"===y.top&&(n+a>b[3]&&"top"===v.top?(n-=a,v.top="bottom"):n<b[1]&&"bottom"===v.top&&(n+=a,v.top="top"))),"target"!==c&&"both"!==c||(i<b[0]&&"left"===y.left&&(i+=p,y.left="right"),i+l>b[2]&&"right"===y.left&&(i-=p,y.left="left")),"together"===c&&(i<b[0]&&"left"===y.left?"right"===v.left?(i+=p,y.left="right",i+=l,v.left="left"):"left"===v.left&&(i+=p,y.left="right",i-=l,v.left="right"):i+l>b[2]&&"right"===y.left?"left"===v.left?(i-=p,y.left="left",i-=l,v.left="right"):"right"===v.left&&(i-=p,y.left="left",i+=l,v.left="left"):"center"===y.left&&(i+l>b[2]&&"left"===v.left?(i-=l,v.left="right"):i<b[0]&&"right"===v.left&&(i+=l,v.left="left"))),"element"!==f&&"both"!==f||(n<b[1]&&"bottom"===v.top&&(n+=a,v.top="top"),n+a>b[3]&&"top"===v.top&&(n-=a,v.top="bottom")),"element"!==c&&"both"!==c||(i<b[0]&&("right"===v.left?(i+=l,v.left="left"):"center"===v.left&&(i+=l/2,v.left="left")),i+l>b[2]&&("left"===v.left?(i-=l,v.left="right"):"center"===v.left&&(i-=l/2,v.left="right"))),"string"==typeof u?u=u.split(",").map(function(t){return t.trim()}):u===!0&&(u=["top","left","right","bottom"]),u=u||[];var _=[],x=[];n<b[1]&&(u.indexOf("top")>=0?(n=b[1],_.push("top")):x.push("top")),n+a>b[3]&&(u.indexOf("bottom")>=0?(n=b[3]-a,_.push("bottom")):x.push("bottom")),i<b[0]&&(u.indexOf("left")>=0?(i=b[0],_.push("left")):x.push("left")),i+l>b[2]&&(u.indexOf("right")>=0?(i=b[2]-l,_.push("right")):x.push("right")),_.length&&!function(){var t=void 0;t="undefined"!=typeof e.options.pinnedClass?e.options.pinnedClass:e.getClass("pinned"),m.push(t),_.forEach(function(e){m.push(t+"-"+e)})}(),x.length&&!function(){var t=void 0;t="undefined"!=typeof e.options.outOfBoundsClass?e.options.outOfBoundsClass:e.getClass("out-of-bounds"),m.push(t),x.forEach(function(e){m.push(t+"-"+e)})}(),(_.indexOf("left")>=0||_.indexOf("right")>=0)&&(v.left=y.left=!1),(_.indexOf("top")>=0||_.indexOf("bottom")>=0)&&(v.top=y.top=!1),y.top===r.top&&y.left===r.left&&v.top===e.attachment.top&&v.left===e.attachment.left||(e.updateAttachClasses(v,y),e.trigger("update",{attachment:v,targetAttachment:y}))}),D(function(){e.options.addTargetClasses!==!1&&g(e.target,m,h),g(e.element,m,h)}),{top:n,left:i}}});var B=E.Utils,s=B.getBounds,g=B.updateClasses,D=B.defer;E.modules.push({position:function(t){var e=this,n=t.top,i=t.left,r=this.cache("element-bounds",function(){return s(e.element)}),o=r.height,a=r.width,l=this.getTargetBounds(),u=n+o,c=i+a,f=[];n<=l.bottom&&u>=l.top&&["left","right"].forEach(function(t){var e=l[t];e!==i&&e!==c||f.push(t)}),i<=l.right&&c>=l.left&&["top","bottom"].forEach(function(t){var e=l[t];e!==n&&e!==u||f.push(t)});var d=[],p=[],h=["left","top","right","bottom"];return d.push(this.getClass("abutted")),h.forEach(function(t){d.push(e.getClass("abutted")+"-"+t)}),f.length&&p.push(this.getClass("abutted")),f.forEach(function(t){p.push(e.getClass("abutted")+"-"+t)}),D(function(){e.options.addTargetClasses!==!1&&g(e.target,p,d),g(e.element,p,d)}),!0}});var L=function(){function t(t,e){var n=[],i=!0,r=!1,o=void 0;try{for(var a,s=t[Symbol.iterator]();!(i=(a=s.next()).done)&&(n.push(a.value),!e||n.length!==e);i=!0);}catch(t){r=!0,o=t}finally{try{!i&&s.return&&s.return()}finally{if(r)throw o}}return n}return function(e,n){if(Array.isArray(e))return e;if(Symbol.iterator in Object(e))return t(e,n);throw new TypeError("Invalid attempt to destructure non-iterable instance")}}();return E.modules.push({position:function(t){var e=t.top,n=t.left;if(this.options.shift){var i=this.options.shift;"function"==typeof this.options.shift&&(i=this.options.shift.call(this,{top:e,left:n}));var r=void 0,o=void 0;if("string"==typeof i){i=i.split(" "),i[1]=i[1]||i[0];var a=i,s=L(a,2);r=s[0],o=s[1],r=parseFloat(r,10),o=parseFloat(o,10)}else r=i.top,o=i.left;return e+=r,n+=o,{top:e,left:n}}}}),G})},function(t,e){if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(t){var e=t.fn.jquery.split(" ")[0].split(".");if(e[0]<2&&e[1]<9||1==e[0]&&9==e[1]&&e[2]<1||e[0]>=4)throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")}(jQuery),+function(){function t(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function e(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function n(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}var i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},r=function(){function t(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,n,i){return n&&t(e.prototype,n),i&&t(e,i),e}}(),o=function(t){function e(t){return{}.toString.call(t).match(/\s([a-zA-Z]+)/)[1].toLowerCase()}function n(t){return(t[0]||t).nodeType}function i(){return{bindType:s.end,delegateType:s.end,handle:function(e){if(t(e.target).is(this))return e.handleObj.handler.apply(this,arguments)}}}function r(){if(window.QUnit)return!1;var t=document.createElement("bootstrap");for(var e in u)if(void 0!==t.style[e])return{end:u[e]};return!1}function o(e){var n=this,i=!1;return t(this).one(c.TRANSITION_END,function(){i=!0}),setTimeout(function(){i||c.triggerTransitionEnd(n)},e),this}function a(){s=r(),t.fn.emulateTransitionEnd=o,c.supportsTransitionEnd()&&(t.event.special[c.TRANSITION_END]=i())}var s=!1,l=1e6,u={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"},c={TRANSITION_END:"bsTransitionEnd",getUID:function(t){do t+=~~(Math.random()*l);while(document.getElementById(t));return t},getSelectorFromElement:function(t){var e=t.getAttribute("data-target");return e||(e=t.getAttribute("href")||"",e=/^#[a-z]/i.test(e)?e:null),e},reflow:function(t){new Function("bs","return bs")(t.offsetHeight)},triggerTransitionEnd:function(e){t(e).trigger(s.end)},supportsTransitionEnd:function(){return Boolean(s)},typeCheckConfig:function(t,i,r){for(var o in r)if(r.hasOwnProperty(o)){var a=r[o],s=i[o],l=void 0;if(l=s&&n(s)?"element":e(s),!new RegExp(a).test(l))throw new Error(t.toUpperCase()+": "+('Option "'+o+'" provided type "'+l+'" ')+('but expected type "'+a+'".'))}}};return a(),c}(jQuery),a=(function(t){var e="alert",i="4.0.0-alpha.5",a="bs.alert",s="."+a,l=".data-api",u=t.fn[e],c=150,f={DISMISS:'[data-dismiss="alert"]'},d={CLOSE:"close"+s,CLOSED:"closed"+s,CLICK_DATA_API:"click"+s+l},p={ALERT:"alert",FADE:"fade",IN:"in"},h=function(){function e(t){n(this,e),this._element=t}return e.prototype.close=function(t){t=t||this._element;var e=this._getRootElement(t),n=this._triggerCloseEvent(e);n.isDefaultPrevented()||this._removeElement(e)},e.prototype.dispose=function(){t.removeData(this._element,a),this._element=null},e.prototype._getRootElement=function(e){var n=o.getSelectorFromElement(e),i=!1;return n&&(i=t(n)[0]),i||(i=t(e).closest("."+p.ALERT)[0]),i},e.prototype._triggerCloseEvent=function(e){var n=t.Event(d.CLOSE);return t(e).trigger(n),n},e.prototype._removeElement=function(e){return t(e).removeClass(p.IN),o.supportsTransitionEnd()&&t(e).hasClass(p.FADE)?void t(e).one(o.TRANSITION_END,t.proxy(this._destroyElement,this,e)).emulateTransitionEnd(c):void this._destroyElement(e)},e.prototype._destroyElement=function(e){t(e).detach().trigger(d.CLOSED).remove()},e._jQueryInterface=function(n){return this.each(function(){var i=t(this),r=i.data(a);r||(r=new e(this),i.data(a,r)),"close"===n&&r[n](this)})},e._handleDismiss=function(t){return function(e){e&&e.preventDefault(),t.close(this)}},r(e,null,[{key:"VERSION",get:function(){return i}}]),e}();return t(document).on(d.CLICK_DATA_API,f.DISMISS,h._handleDismiss(new h)),t.fn[e]=h._jQueryInterface,t.fn[e].Constructor=h,t.fn[e].noConflict=function(){return t.fn[e]=u,h._jQueryInterface},h}(jQuery),function(t){var e="button",i="4.0.0-alpha.5",o="bs.button",a="."+o,s=".data-api",l=t.fn[e],u={ACTIVE:"active",BUTTON:"btn",FOCUS:"focus"},c={DATA_TOGGLE_CARROT:'[data-toggle^="button"]',DATA_TOGGLE:'[data-toggle="buttons"]',INPUT:"input",ACTIVE:".active",BUTTON:".btn"},f={CLICK_DATA_API:"click"+a+s,FOCUS_BLUR_DATA_API:"focus"+a+s+" "+("blur"+a+s)},d=function(){function e(t){n(this,e),this._element=t}return e.prototype.toggle=function(){var e=!0,n=t(this._element).closest(c.DATA_TOGGLE)[0];if(n){var i=t(this._element).find(c.INPUT)[0];if(i){if("radio"===i.type)if(i.checked&&t(this._element).hasClass(u.ACTIVE))e=!1;else{var r=t(n).find(c.ACTIVE)[0];r&&t(r).removeClass(u.ACTIVE)}e&&(i.checked=!t(this._element).hasClass(u.ACTIVE),t(this._element).trigger("change")),i.focus()}}else this._element.setAttribute("aria-pressed",!t(this._element).hasClass(u.ACTIVE));e&&t(this._element).toggleClass(u.ACTIVE)},e.prototype.dispose=function(){t.removeData(this._element,o),this._element=null},e._jQueryInterface=function(n){return this.each(function(){var i=t(this).data(o);i||(i=new e(this),t(this).data(o,i)),"toggle"===n&&i[n]()})},r(e,null,[{key:"VERSION",get:function(){return i}}]),e}();return t(document).on(f.CLICK_DATA_API,c.DATA_TOGGLE_CARROT,function(e){e.preventDefault();var n=e.target;t(n).hasClass(u.BUTTON)||(n=t(n).closest(c.BUTTON)),d._jQueryInterface.call(t(n),"toggle")}).on(f.FOCUS_BLUR_DATA_API,c.DATA_TOGGLE_CARROT,function(e){var n=t(e.target).closest(c.BUTTON)[0];t(n).toggleClass(u.FOCUS,/^focus(in)?$/.test(e.type))}),t.fn[e]=d._jQueryInterface,t.fn[e].Constructor=d,t.fn[e].noConflict=function(){return t.fn[e]=l,d._jQueryInterface},d}(jQuery),function(t){
var e="carousel",a="4.0.0-alpha.5",s="bs.carousel",l="."+s,u=".data-api",c=t.fn[e],f=600,d=37,p=39,h={interval:5e3,keyboard:!0,slide:!1,pause:"hover",wrap:!0},m={interval:"(number|boolean)",keyboard:"boolean",slide:"(boolean|string)",pause:"(string|boolean)",wrap:"boolean"},g={NEXT:"next",PREVIOUS:"prev"},y={SLIDE:"slide"+l,SLID:"slid"+l,KEYDOWN:"keydown"+l,MOUSEENTER:"mouseenter"+l,MOUSELEAVE:"mouseleave"+l,LOAD_DATA_API:"load"+l+u,CLICK_DATA_API:"click"+l+u},v={CAROUSEL:"carousel",ACTIVE:"active",SLIDE:"slide",RIGHT:"right",LEFT:"left",ITEM:"carousel-item"},b={ACTIVE:".active",ACTIVE_ITEM:".active.carousel-item",ITEM:".carousel-item",NEXT_PREV:".next, .prev",INDICATORS:".carousel-indicators",DATA_SLIDE:"[data-slide], [data-slide-to]",DATA_RIDE:'[data-ride="carousel"]'},_=function(){function u(e,i){n(this,u),this._items=null,this._interval=null,this._activeElement=null,this._isPaused=!1,this._isSliding=!1,this._config=this._getConfig(i),this._element=t(e)[0],this._indicatorsElement=t(this._element).find(b.INDICATORS)[0],this._addEventListeners()}return u.prototype.next=function(){this._isSliding||this._slide(g.NEXT)},u.prototype.nextWhenVisible=function(){document.hidden||this.next()},u.prototype.prev=function(){this._isSliding||this._slide(g.PREVIOUS)},u.prototype.pause=function(e){e||(this._isPaused=!0),t(this._element).find(b.NEXT_PREV)[0]&&o.supportsTransitionEnd()&&(o.triggerTransitionEnd(this._element),this.cycle(!0)),clearInterval(this._interval),this._interval=null},u.prototype.cycle=function(e){e||(this._isPaused=!1),this._interval&&(clearInterval(this._interval),this._interval=null),this._config.interval&&!this._isPaused&&(this._interval=setInterval(t.proxy(document.visibilityState?this.nextWhenVisible:this.next,this),this._config.interval))},u.prototype.to=function(e){var n=this;this._activeElement=t(this._element).find(b.ACTIVE_ITEM)[0];var i=this._getItemIndex(this._activeElement);if(!(e>this._items.length-1||e<0)){if(this._isSliding)return void t(this._element).one(y.SLID,function(){return n.to(e)});if(i===e)return this.pause(),void this.cycle();var r=e>i?g.NEXT:g.PREVIOUS;this._slide(r,this._items[e])}},u.prototype.dispose=function(){t(this._element).off(l),t.removeData(this._element,s),this._items=null,this._config=null,this._element=null,this._interval=null,this._isPaused=null,this._isSliding=null,this._activeElement=null,this._indicatorsElement=null},u.prototype._getConfig=function(n){return n=t.extend({},h,n),o.typeCheckConfig(e,n,m),n},u.prototype._addEventListeners=function(){this._config.keyboard&&t(this._element).on(y.KEYDOWN,t.proxy(this._keydown,this)),"hover"!==this._config.pause||"ontouchstart"in document.documentElement||t(this._element).on(y.MOUSEENTER,t.proxy(this.pause,this)).on(y.MOUSELEAVE,t.proxy(this.cycle,this))},u.prototype._keydown=function(t){if(t.preventDefault(),!/input|textarea/i.test(t.target.tagName))switch(t.which){case d:this.prev();break;case p:this.next();break;default:return}},u.prototype._getItemIndex=function(e){return this._items=t.makeArray(t(e).parent().find(b.ITEM)),this._items.indexOf(e)},u.prototype._getItemByDirection=function(t,e){var n=t===g.NEXT,i=t===g.PREVIOUS,r=this._getItemIndex(e),o=this._items.length-1,a=i&&0===r||n&&r===o;if(a&&!this._config.wrap)return e;var s=t===g.PREVIOUS?-1:1,l=(r+s)%this._items.length;return l===-1?this._items[this._items.length-1]:this._items[l]},u.prototype._triggerSlideEvent=function(e,n){var i=t.Event(y.SLIDE,{relatedTarget:e,direction:n});return t(this._element).trigger(i),i},u.prototype._setActiveIndicatorElement=function(e){if(this._indicatorsElement){t(this._indicatorsElement).find(b.ACTIVE).removeClass(v.ACTIVE);var n=this._indicatorsElement.children[this._getItemIndex(e)];n&&t(n).addClass(v.ACTIVE)}},u.prototype._slide=function(e,n){var i=this,r=t(this._element).find(b.ACTIVE_ITEM)[0],a=n||r&&this._getItemByDirection(e,r),s=Boolean(this._interval),l=e===g.NEXT?v.LEFT:v.RIGHT;if(a&&t(a).hasClass(v.ACTIVE))return void(this._isSliding=!1);var u=this._triggerSlideEvent(a,l);if(!u.isDefaultPrevented()&&r&&a){this._isSliding=!0,s&&this.pause(),this._setActiveIndicatorElement(a);var c=t.Event(y.SLID,{relatedTarget:a,direction:l});o.supportsTransitionEnd()&&t(this._element).hasClass(v.SLIDE)?(t(a).addClass(e),o.reflow(a),t(r).addClass(l),t(a).addClass(l),t(r).one(o.TRANSITION_END,function(){t(a).removeClass(l).removeClass(e),t(a).addClass(v.ACTIVE),t(r).removeClass(v.ACTIVE).removeClass(e).removeClass(l),i._isSliding=!1,setTimeout(function(){return t(i._element).trigger(c)},0)}).emulateTransitionEnd(f)):(t(r).removeClass(v.ACTIVE),t(a).addClass(v.ACTIVE),this._isSliding=!1,t(this._element).trigger(c)),s&&this.cycle()}},u._jQueryInterface=function(e){return this.each(function(){var n=t(this).data(s),r=t.extend({},h,t(this).data());"object"===("undefined"==typeof e?"undefined":i(e))&&t.extend(r,e);var o="string"==typeof e?e:r.slide;if(n||(n=new u(this,r),t(this).data(s,n)),"number"==typeof e)n.to(e);else if("string"==typeof o){if(void 0===n[o])throw new Error('No method named "'+o+'"');n[o]()}else r.interval&&(n.pause(),n.cycle())})},u._dataApiClickHandler=function(e){var n=o.getSelectorFromElement(this);if(n){var i=t(n)[0];if(i&&t(i).hasClass(v.CAROUSEL)){var r=t.extend({},t(i).data(),t(this).data()),a=this.getAttribute("data-slide-to");a&&(r.interval=!1),u._jQueryInterface.call(t(i),r),a&&t(i).data(s).to(a),e.preventDefault()}}},r(u,null,[{key:"VERSION",get:function(){return a}},{key:"Default",get:function(){return h}}]),u}();return t(document).on(y.CLICK_DATA_API,b.DATA_SLIDE,_._dataApiClickHandler),t(window).on(y.LOAD_DATA_API,function(){t(b.DATA_RIDE).each(function(){var e=t(this);_._jQueryInterface.call(e,e.data())})}),t.fn[e]=_._jQueryInterface,t.fn[e].Constructor=_,t.fn[e].noConflict=function(){return t.fn[e]=c,_._jQueryInterface},_}(jQuery),function(t){var e="collapse",a="4.0.0-alpha.5",s="bs.collapse",l="."+s,u=".data-api",c=t.fn[e],f=600,d={toggle:!0,parent:""},p={toggle:"boolean",parent:"string"},h={SHOW:"show"+l,SHOWN:"shown"+l,HIDE:"hide"+l,HIDDEN:"hidden"+l,CLICK_DATA_API:"click"+l+u},m={IN:"in",COLLAPSE:"collapse",COLLAPSING:"collapsing",COLLAPSED:"collapsed"},g={WIDTH:"width",HEIGHT:"height"},y={ACTIVES:".card > .in, .card > .collapsing",DATA_TOGGLE:'[data-toggle="collapse"]'},v=function(){function l(e,i){n(this,l),this._isTransitioning=!1,this._element=e,this._config=this._getConfig(i),this._triggerArray=t.makeArray(t('[data-toggle="collapse"][href="#'+e.id+'"],'+('[data-toggle="collapse"][data-target="#'+e.id+'"]'))),this._parent=this._config.parent?this._getParent():null,this._config.parent||this._addAriaAndCollapsedClass(this._element,this._triggerArray),this._config.toggle&&this.toggle()}return l.prototype.toggle=function(){t(this._element).hasClass(m.IN)?this.hide():this.show()},l.prototype.show=function(){var e=this;if(!this._isTransitioning&&!t(this._element).hasClass(m.IN)){var n=void 0,i=void 0;if(this._parent&&(n=t.makeArray(t(y.ACTIVES)),n.length||(n=null)),!(n&&(i=t(n).data(s),i&&i._isTransitioning))){var r=t.Event(h.SHOW);if(t(this._element).trigger(r),!r.isDefaultPrevented()){n&&(l._jQueryInterface.call(t(n),"hide"),i||t(n).data(s,null));var a=this._getDimension();t(this._element).removeClass(m.COLLAPSE).addClass(m.COLLAPSING),this._element.style[a]=0,this._element.setAttribute("aria-expanded",!0),this._triggerArray.length&&t(this._triggerArray).removeClass(m.COLLAPSED).attr("aria-expanded",!0),this.setTransitioning(!0);var u=function(){t(e._element).removeClass(m.COLLAPSING).addClass(m.COLLAPSE).addClass(m.IN),e._element.style[a]="",e.setTransitioning(!1),t(e._element).trigger(h.SHOWN)};if(!o.supportsTransitionEnd())return void u();var c=a[0].toUpperCase()+a.slice(1),d="scroll"+c;t(this._element).one(o.TRANSITION_END,u).emulateTransitionEnd(f),this._element.style[a]=this._element[d]+"px"}}}},l.prototype.hide=function(){var e=this;if(!this._isTransitioning&&t(this._element).hasClass(m.IN)){var n=t.Event(h.HIDE);if(t(this._element).trigger(n),!n.isDefaultPrevented()){var i=this._getDimension(),r=i===g.WIDTH?"offsetWidth":"offsetHeight";this._element.style[i]=this._element[r]+"px",o.reflow(this._element),t(this._element).addClass(m.COLLAPSING).removeClass(m.COLLAPSE).removeClass(m.IN),this._element.setAttribute("aria-expanded",!1),this._triggerArray.length&&t(this._triggerArray).addClass(m.COLLAPSED).attr("aria-expanded",!1),this.setTransitioning(!0);var a=function(){e.setTransitioning(!1),t(e._element).removeClass(m.COLLAPSING).addClass(m.COLLAPSE).trigger(h.HIDDEN)};return this._element.style[i]="",o.supportsTransitionEnd()?void t(this._element).one(o.TRANSITION_END,a).emulateTransitionEnd(f):void a()}}},l.prototype.setTransitioning=function(t){this._isTransitioning=t},l.prototype.dispose=function(){t.removeData(this._element,s),this._config=null,this._parent=null,this._element=null,this._triggerArray=null,this._isTransitioning=null},l.prototype._getConfig=function(n){return n=t.extend({},d,n),n.toggle=Boolean(n.toggle),o.typeCheckConfig(e,n,p),n},l.prototype._getDimension=function(){var e=t(this._element).hasClass(g.WIDTH);return e?g.WIDTH:g.HEIGHT},l.prototype._getParent=function(){var e=this,n=t(this._config.parent)[0],i='[data-toggle="collapse"][data-parent="'+this._config.parent+'"]';return t(n).find(i).each(function(t,n){e._addAriaAndCollapsedClass(l._getTargetFromElement(n),[n])}),n},l.prototype._addAriaAndCollapsedClass=function(e,n){if(e){var i=t(e).hasClass(m.IN);e.setAttribute("aria-expanded",i),n.length&&t(n).toggleClass(m.COLLAPSED,!i).attr("aria-expanded",i)}},l._getTargetFromElement=function(e){var n=o.getSelectorFromElement(e);return n?t(n)[0]:null},l._jQueryInterface=function(e){return this.each(function(){var n=t(this),r=n.data(s),o=t.extend({},d,n.data(),"object"===("undefined"==typeof e?"undefined":i(e))&&e);if(!r&&o.toggle&&/show|hide/.test(e)&&(o.toggle=!1),r||(r=new l(this,o),n.data(s,r)),"string"==typeof e){if(void 0===r[e])throw new Error('No method named "'+e+'"');r[e]()}})},r(l,null,[{key:"VERSION",get:function(){return a}},{key:"Default",get:function(){return d}}]),l}();return t(document).on(h.CLICK_DATA_API,y.DATA_TOGGLE,function(e){e.preventDefault();var n=v._getTargetFromElement(this),i=t(n).data(s),r=i?"toggle":t(this).data();v._jQueryInterface.call(t(n),r)}),t.fn[e]=v._jQueryInterface,t.fn[e].Constructor=v,t.fn[e].noConflict=function(){return t.fn[e]=c,v._jQueryInterface},v}(jQuery),function(t){var e="dropdown",i="4.0.0-alpha.5",a="bs.dropdown",s="."+a,l=".data-api",u=t.fn[e],c=27,f=38,d=40,p=3,h={HIDE:"hide"+s,HIDDEN:"hidden"+s,SHOW:"show"+s,SHOWN:"shown"+s,CLICK:"click"+s,CLICK_DATA_API:"click"+s+l,KEYDOWN_DATA_API:"keydown"+s+l},m={BACKDROP:"dropdown-backdrop",DISABLED:"disabled",OPEN:"open"},g={BACKDROP:".dropdown-backdrop",DATA_TOGGLE:'[data-toggle="dropdown"]',FORM_CHILD:".dropdown form",ROLE_MENU:'[role="menu"]',ROLE_LISTBOX:'[role="listbox"]',NAVBAR_NAV:".navbar-nav",VISIBLE_ITEMS:'[role="menu"] li:not(.disabled) a, [role="listbox"] li:not(.disabled) a'},y=function(){function e(t){n(this,e),this._element=t,this._addEventListeners()}return e.prototype.toggle=function(){if(this.disabled||t(this).hasClass(m.DISABLED))return!1;var n=e._getParentFromElement(this),i=t(n).hasClass(m.OPEN);if(e._clearMenus(),i)return!1;if("ontouchstart"in document.documentElement&&!t(n).closest(g.NAVBAR_NAV).length){var r=document.createElement("div");r.className=m.BACKDROP,t(r).insertBefore(this),t(r).on("click",e._clearMenus)}var o={relatedTarget:this},a=t.Event(h.SHOW,o);return t(n).trigger(a),!a.isDefaultPrevented()&&(this.focus(),this.setAttribute("aria-expanded","true"),t(n).toggleClass(m.OPEN),t(n).trigger(t.Event(h.SHOWN,o)),!1)},e.prototype.dispose=function(){t.removeData(this._element,a),t(this._element).off(s),this._element=null},e.prototype._addEventListeners=function(){t(this._element).on(h.CLICK,this.toggle)},e._jQueryInterface=function(n){return this.each(function(){var i=t(this).data(a);if(i||t(this).data(a,i=new e(this)),"string"==typeof n){if(void 0===i[n])throw new Error('No method named "'+n+'"');i[n].call(this)}})},e._clearMenus=function(n){if(!n||n.which!==p){var i=t(g.BACKDROP)[0];i&&i.parentNode.removeChild(i);for(var r=t.makeArray(t(g.DATA_TOGGLE)),o=0;o<r.length;o++){var a=e._getParentFromElement(r[o]),s={relatedTarget:r[o]};if(t(a).hasClass(m.OPEN)&&!(n&&"click"===n.type&&/input|textarea/i.test(n.target.tagName)&&t.contains(a,n.target))){var l=t.Event(h.HIDE,s);t(a).trigger(l),l.isDefaultPrevented()||(r[o].setAttribute("aria-expanded","false"),t(a).removeClass(m.OPEN).trigger(t.Event(h.HIDDEN,s)))}}}},e._getParentFromElement=function(e){var n=void 0,i=o.getSelectorFromElement(e);return i&&(n=t(i)[0]),n||e.parentNode},e._dataApiKeydownHandler=function(n){if(/(38|40|27|32)/.test(n.which)&&!/input|textarea/i.test(n.target.tagName)&&(n.preventDefault(),n.stopPropagation(),!this.disabled&&!t(this).hasClass(m.DISABLED))){var i=e._getParentFromElement(this),r=t(i).hasClass(m.OPEN);if(!r&&n.which!==c||r&&n.which===c){if(n.which===c){var o=t(i).find(g.DATA_TOGGLE)[0];t(o).trigger("focus")}return void t(this).trigger("click")}var a=t.makeArray(t(g.VISIBLE_ITEMS));if(a=a.filter(function(t){return t.offsetWidth||t.offsetHeight}),a.length){var s=a.indexOf(n.target);n.which===f&&s>0&&s--,n.which===d&&s<a.length-1&&s++,s<0&&(s=0),a[s].focus()}}},r(e,null,[{key:"VERSION",get:function(){return i}}]),e}();return t(document).on(h.KEYDOWN_DATA_API,g.DATA_TOGGLE,y._dataApiKeydownHandler).on(h.KEYDOWN_DATA_API,g.ROLE_MENU,y._dataApiKeydownHandler).on(h.KEYDOWN_DATA_API,g.ROLE_LISTBOX,y._dataApiKeydownHandler).on(h.CLICK_DATA_API,y._clearMenus).on(h.CLICK_DATA_API,g.DATA_TOGGLE,y.prototype.toggle).on(h.CLICK_DATA_API,g.FORM_CHILD,function(t){t.stopPropagation()}),t.fn[e]=y._jQueryInterface,t.fn[e].Constructor=y,t.fn[e].noConflict=function(){return t.fn[e]=u,y._jQueryInterface},y}(jQuery),function(t){var e="modal",a="4.0.0-alpha.5",s="bs.modal",l="."+s,u=".data-api",c=t.fn[e],f=300,d=150,p=27,h={backdrop:!0,keyboard:!0,focus:!0,show:!0},m={backdrop:"(boolean|string)",keyboard:"boolean",focus:"boolean",show:"boolean"},g={HIDE:"hide"+l,HIDDEN:"hidden"+l,SHOW:"show"+l,SHOWN:"shown"+l,FOCUSIN:"focusin"+l,RESIZE:"resize"+l,CLICK_DISMISS:"click.dismiss"+l,KEYDOWN_DISMISS:"keydown.dismiss"+l,MOUSEUP_DISMISS:"mouseup.dismiss"+l,MOUSEDOWN_DISMISS:"mousedown.dismiss"+l,CLICK_DATA_API:"click"+l+u},y={SCROLLBAR_MEASURER:"modal-scrollbar-measure",BACKDROP:"modal-backdrop",OPEN:"modal-open",FADE:"fade",IN:"in"},v={DIALOG:".modal-dialog",DATA_TOGGLE:'[data-toggle="modal"]',DATA_DISMISS:'[data-dismiss="modal"]',FIXED_CONTENT:".navbar-fixed-top, .navbar-fixed-bottom, .is-fixed"},b=function(){function u(e,i){n(this,u),this._config=this._getConfig(i),this._element=e,this._dialog=t(e).find(v.DIALOG)[0],this._backdrop=null,this._isShown=!1,this._isBodyOverflowing=!1,this._ignoreBackdropClick=!1,this._originalBodyPadding=0,this._scrollbarWidth=0}return u.prototype.toggle=function(t){return this._isShown?this.hide():this.show(t)},u.prototype.show=function(e){var n=this,i=t.Event(g.SHOW,{relatedTarget:e});t(this._element).trigger(i),this._isShown||i.isDefaultPrevented()||(this._isShown=!0,this._checkScrollbar(),this._setScrollbar(),t(document.body).addClass(y.OPEN),this._setEscapeEvent(),this._setResizeEvent(),t(this._element).on(g.CLICK_DISMISS,v.DATA_DISMISS,t.proxy(this.hide,this)),t(this._dialog).on(g.MOUSEDOWN_DISMISS,function(){t(n._element).one(g.MOUSEUP_DISMISS,function(e){t(e.target).is(n._element)&&(n._ignoreBackdropClick=!0)})}),this._showBackdrop(t.proxy(this._showElement,this,e)))},u.prototype.hide=function(e){e&&e.preventDefault();var n=t.Event(g.HIDE);t(this._element).trigger(n),this._isShown&&!n.isDefaultPrevented()&&(this._isShown=!1,this._setEscapeEvent(),this._setResizeEvent(),t(document).off(g.FOCUSIN),t(this._element).removeClass(y.IN),t(this._element).off(g.CLICK_DISMISS),t(this._dialog).off(g.MOUSEDOWN_DISMISS),o.supportsTransitionEnd()&&t(this._element).hasClass(y.FADE)?t(this._element).one(o.TRANSITION_END,t.proxy(this._hideModal,this)).emulateTransitionEnd(f):this._hideModal())},u.prototype.dispose=function(){t.removeData(this._element,s),t(window).off(l),t(document).off(l),t(this._element).off(l),t(this._backdrop).off(l),this._config=null,this._element=null,this._dialog=null,this._backdrop=null,this._isShown=null,this._isBodyOverflowing=null,this._ignoreBackdropClick=null,this._originalBodyPadding=null,this._scrollbarWidth=null},u.prototype._getConfig=function(n){return n=t.extend({},h,n),o.typeCheckConfig(e,n,m),n},u.prototype._showElement=function(e){var n=this,i=o.supportsTransitionEnd()&&t(this._element).hasClass(y.FADE);this._element.parentNode&&this._element.parentNode.nodeType===Node.ELEMENT_NODE||document.body.appendChild(this._element),this._element.style.display="block",this._element.removeAttribute("aria-hidden"),this._element.scrollTop=0,i&&o.reflow(this._element),t(this._element).addClass(y.IN),this._config.focus&&this._enforceFocus();var r=t.Event(g.SHOWN,{relatedTarget:e}),a=function(){n._config.focus&&n._element.focus(),t(n._element).trigger(r)};i?t(this._dialog).one(o.TRANSITION_END,a).emulateTransitionEnd(f):a()},u.prototype._enforceFocus=function(){var e=this;t(document).off(g.FOCUSIN).on(g.FOCUSIN,function(n){document===n.target||e._element===n.target||t(e._element).has(n.target).length||e._element.focus()})},u.prototype._setEscapeEvent=function(){var e=this;this._isShown&&this._config.keyboard?t(this._element).on(g.KEYDOWN_DISMISS,function(t){t.which===p&&e.hide()}):this._isShown||t(this._element).off(g.KEYDOWN_DISMISS)},u.prototype._setResizeEvent=function(){this._isShown?t(window).on(g.RESIZE,t.proxy(this._handleUpdate,this)):t(window).off(g.RESIZE)},u.prototype._hideModal=function(){var e=this;this._element.style.display="none",this._element.setAttribute("aria-hidden","true"),this._showBackdrop(function(){t(document.body).removeClass(y.OPEN),e._resetAdjustments(),e._resetScrollbar(),t(e._element).trigger(g.HIDDEN)})},u.prototype._removeBackdrop=function(){this._backdrop&&(t(this._backdrop).remove(),this._backdrop=null)},u.prototype._showBackdrop=function(e){var n=this,i=t(this._element).hasClass(y.FADE)?y.FADE:"";if(this._isShown&&this._config.backdrop){var r=o.supportsTransitionEnd()&&i;if(this._backdrop=document.createElement("div"),this._backdrop.className=y.BACKDROP,i&&t(this._backdrop).addClass(i),t(this._backdrop).appendTo(document.body),t(this._element).on(g.CLICK_DISMISS,function(t){return n._ignoreBackdropClick?void(n._ignoreBackdropClick=!1):void(t.target===t.currentTarget&&("static"===n._config.backdrop?n._element.focus():n.hide()))}),r&&o.reflow(this._backdrop),t(this._backdrop).addClass(y.IN),!e)return;if(!r)return void e();t(this._backdrop).one(o.TRANSITION_END,e).emulateTransitionEnd(d)}else if(!this._isShown&&this._backdrop){t(this._backdrop).removeClass(y.IN);var a=function(){n._removeBackdrop(),e&&e()};o.supportsTransitionEnd()&&t(this._element).hasClass(y.FADE)?t(this._backdrop).one(o.TRANSITION_END,a).emulateTransitionEnd(d):a()}else e&&e()},u.prototype._handleUpdate=function(){this._adjustDialog()},u.prototype._adjustDialog=function(){var t=this._element.scrollHeight>document.documentElement.clientHeight;!this._isBodyOverflowing&&t&&(this._element.style.paddingLeft=this._scrollbarWidth+"px"),this._isBodyOverflowing&&!t&&(this._element.style.paddingRight=this._scrollbarWidth+"px")},u.prototype._resetAdjustments=function(){this._element.style.paddingLeft="",this._element.style.paddingRight=""},u.prototype._checkScrollbar=function(){this._isBodyOverflowing=document.body.clientWidth<window.innerWidth,this._scrollbarWidth=this._getScrollbarWidth()},u.prototype._setScrollbar=function(){var e=parseInt(t(v.FIXED_CONTENT).css("padding-right")||0,10);this._originalBodyPadding=document.body.style.paddingRight||"",this._isBodyOverflowing&&(document.body.style.paddingRight=e+this._scrollbarWidth+"px")},u.prototype._resetScrollbar=function(){document.body.style.paddingRight=this._originalBodyPadding},u.prototype._getScrollbarWidth=function(){var t=document.createElement("div");t.className=y.SCROLLBAR_MEASURER,document.body.appendChild(t);var e=t.offsetWidth-t.clientWidth;return document.body.removeChild(t),e},u._jQueryInterface=function(e,n){return this.each(function(){var r=t(this).data(s),o=t.extend({},u.Default,t(this).data(),"object"===("undefined"==typeof e?"undefined":i(e))&&e);if(r||(r=new u(this,o),t(this).data(s,r)),"string"==typeof e){if(void 0===r[e])throw new Error('No method named "'+e+'"');r[e](n)}else o.show&&r.show(n)})},r(u,null,[{key:"VERSION",get:function(){return a}},{key:"Default",get:function(){return h}}]),u}();return t(document).on(g.CLICK_DATA_API,v.DATA_TOGGLE,function(e){var n=this,i=void 0,r=o.getSelectorFromElement(this);r&&(i=t(r)[0]);var a=t(i).data(s)?"toggle":t.extend({},t(i).data(),t(this).data());"A"===this.tagName&&e.preventDefault();var l=t(i).one(g.SHOW,function(e){e.isDefaultPrevented()||l.one(g.HIDDEN,function(){t(n).is(":visible")&&n.focus()})});b._jQueryInterface.call(t(i),a,this)}),t.fn[e]=b._jQueryInterface,t.fn[e].Constructor=b,t.fn[e].noConflict=function(){return t.fn[e]=c,b._jQueryInterface},b}(jQuery),function(t){var e="scrollspy",a="4.0.0-alpha.5",s="bs.scrollspy",l="."+s,u=".data-api",c=t.fn[e],f={offset:10,method:"auto",target:""},d={offset:"number",method:"string",target:"(string|element)"},p={ACTIVATE:"activate"+l,SCROLL:"scroll"+l,LOAD_DATA_API:"load"+l+u},h={DROPDOWN_ITEM:"dropdown-item",DROPDOWN_MENU:"dropdown-menu",NAV_LINK:"nav-link",NAV:"nav",ACTIVE:"active"},m={DATA_SPY:'[data-spy="scroll"]',ACTIVE:".active",LIST_ITEM:".list-item",LI:"li",LI_DROPDOWN:"li.dropdown",NAV_LINKS:".nav-link",DROPDOWN:".dropdown",DROPDOWN_ITEMS:".dropdown-item",DROPDOWN_TOGGLE:".dropdown-toggle"},g={OFFSET:"offset",POSITION:"position"},y=function(){function u(e,i){n(this,u),this._element=e,this._scrollElement="BODY"===e.tagName?window:e,this._config=this._getConfig(i),this._selector=this._config.target+" "+m.NAV_LINKS+","+(this._config.target+" "+m.DROPDOWN_ITEMS),this._offsets=[],this._targets=[],this._activeTarget=null,this._scrollHeight=0,t(this._scrollElement).on(p.SCROLL,t.proxy(this._process,this)),this.refresh(),this._process()}return u.prototype.refresh=function(){var e=this,n=this._scrollElement!==this._scrollElement.window?g.POSITION:g.OFFSET,i="auto"===this._config.method?n:this._config.method,r=i===g.POSITION?this._getScrollTop():0;this._offsets=[],this._targets=[],this._scrollHeight=this._getScrollHeight();var a=t.makeArray(t(this._selector));a.map(function(e){var n=void 0,a=o.getSelectorFromElement(e);return a&&(n=t(a)[0]),n&&(n.offsetWidth||n.offsetHeight)?[t(n)[i]().top+r,a]:null}).filter(function(t){return t}).sort(function(t,e){return t[0]-e[0]}).forEach(function(t){e._offsets.push(t[0]),e._targets.push(t[1])})},u.prototype.dispose=function(){t.removeData(this._element,s),t(this._scrollElement).off(l),this._element=null,this._scrollElement=null,this._config=null,this._selector=null,this._offsets=null,this._targets=null,this._activeTarget=null,this._scrollHeight=null},u.prototype._getConfig=function(n){if(n=t.extend({},f,n),"string"!=typeof n.target){var i=t(n.target).attr("id");i||(i=o.getUID(e),t(n.target).attr("id",i)),n.target="#"+i}return o.typeCheckConfig(e,n,d),n},u.prototype._getScrollTop=function(){return this._scrollElement===window?this._scrollElement.scrollY:this._scrollElement.scrollTop},u.prototype._getScrollHeight=function(){return this._scrollElement.scrollHeight||Math.max(document.body.scrollHeight,document.documentElement.scrollHeight)},u.prototype._process=function(){var t=this._getScrollTop()+this._config.offset,e=this._getScrollHeight(),n=this._config.offset+e-this._scrollElement.offsetHeight;if(this._scrollHeight!==e&&this.refresh(),t>=n){var i=this._targets[this._targets.length-1];this._activeTarget!==i&&this._activate(i)}if(this._activeTarget&&t<this._offsets[0])return this._activeTarget=null,void this._clear();for(var r=this._offsets.length;r--;){var o=this._activeTarget!==this._targets[r]&&t>=this._offsets[r]&&(void 0===this._offsets[r+1]||t<this._offsets[r+1]);o&&this._activate(this._targets[r])}},u.prototype._activate=function(e){this._activeTarget=e,this._clear();var n=this._selector.split(",");n=n.map(function(t){return t+'[data-target="'+e+'"],'+(t+'[href="'+e+'"]')});var i=t(n.join(","));i.hasClass(h.DROPDOWN_ITEM)?(i.closest(m.DROPDOWN).find(m.DROPDOWN_TOGGLE).addClass(h.ACTIVE),i.addClass(h.ACTIVE)):i.parents(m.LI).find(m.NAV_LINKS).addClass(h.ACTIVE),t(this._scrollElement).trigger(p.ACTIVATE,{relatedTarget:e})},u.prototype._clear=function(){t(this._selector).filter(m.ACTIVE).removeClass(h.ACTIVE)},u._jQueryInterface=function(e){return this.each(function(){var n=t(this).data(s),r="object"===("undefined"==typeof e?"undefined":i(e))&&e||null;if(n||(n=new u(this,r),t(this).data(s,n)),"string"==typeof e){if(void 0===n[e])throw new Error('No method named "'+e+'"');n[e]()}})},r(u,null,[{key:"VERSION",get:function(){return a}},{key:"Default",get:function(){return f}}]),u}();return t(window).on(p.LOAD_DATA_API,function(){for(var e=t.makeArray(t(m.DATA_SPY)),n=e.length;n--;){var i=t(e[n]);y._jQueryInterface.call(i,i.data())}}),t.fn[e]=y._jQueryInterface,t.fn[e].Constructor=y,t.fn[e].noConflict=function(){return t.fn[e]=c,y._jQueryInterface},y}(jQuery),function(t){var e="tab",i="4.0.0-alpha.5",a="bs.tab",s="."+a,l=".data-api",u=t.fn[e],c=150,f={HIDE:"hide"+s,HIDDEN:"hidden"+s,SHOW:"show"+s,SHOWN:"shown"+s,CLICK_DATA_API:"click"+s+l},d={DROPDOWN_MENU:"dropdown-menu",ACTIVE:"active",FADE:"fade",IN:"in"},p={A:"a",LI:"li",DROPDOWN:".dropdown",UL:"ul:not(.dropdown-menu)",FADE_CHILD:"> .nav-item .fade, > .fade",ACTIVE:".active",ACTIVE_CHILD:"> .nav-item > .active, > .active",DATA_TOGGLE:'[data-toggle="tab"], [data-toggle="pill"]',DROPDOWN_TOGGLE:".dropdown-toggle",DROPDOWN_ACTIVE_CHILD:"> .dropdown-menu .active"},h=function(){function e(t){n(this,e),this._element=t}return e.prototype.show=function(){var e=this;if(!this._element.parentNode||this._element.parentNode.nodeType!==Node.ELEMENT_NODE||!t(this._element).hasClass(d.ACTIVE)){var n=void 0,i=void 0,r=t(this._element).closest(p.UL)[0],a=o.getSelectorFromElement(this._element);r&&(i=t.makeArray(t(r).find(p.ACTIVE)),i=i[i.length-1]);var s=t.Event(f.HIDE,{relatedTarget:this._element}),l=t.Event(f.SHOW,{relatedTarget:i});if(i&&t(i).trigger(s),t(this._element).trigger(l),!l.isDefaultPrevented()&&!s.isDefaultPrevented()){a&&(n=t(a)[0]),this._activate(this._element,r);var u=function(){var n=t.Event(f.HIDDEN,{relatedTarget:e._element}),r=t.Event(f.SHOWN,{relatedTarget:i});t(i).trigger(n),t(e._element).trigger(r)};n?this._activate(n,n.parentNode,u):u()}}},e.prototype.dispose=function(){t.removeClass(this._element,a),this._element=null},e.prototype._activate=function(e,n,i){var r=t(n).find(p.ACTIVE_CHILD)[0],a=i&&o.supportsTransitionEnd()&&(r&&t(r).hasClass(d.FADE)||Boolean(t(n).find(p.FADE_CHILD)[0])),s=t.proxy(this._transitionComplete,this,e,r,a,i);r&&a?t(r).one(o.TRANSITION_END,s).emulateTransitionEnd(c):s(),r&&t(r).removeClass(d.IN)},e.prototype._transitionComplete=function(e,n,i,r){if(n){t(n).removeClass(d.ACTIVE);var a=t(n).find(p.DROPDOWN_ACTIVE_CHILD)[0];a&&t(a).removeClass(d.ACTIVE),n.setAttribute("aria-expanded",!1)}if(t(e).addClass(d.ACTIVE),e.setAttribute("aria-expanded",!0),i?(o.reflow(e),t(e).addClass(d.IN)):t(e).removeClass(d.FADE),e.parentNode&&t(e.parentNode).hasClass(d.DROPDOWN_MENU)){var s=t(e).closest(p.DROPDOWN)[0];s&&t(s).find(p.DROPDOWN_TOGGLE).addClass(d.ACTIVE),e.setAttribute("aria-expanded",!0)}r&&r()},e._jQueryInterface=function(n){return this.each(function(){var i=t(this),r=i.data(a);if(r||(r=r=new e(this),i.data(a,r)),"string"==typeof n){if(void 0===r[n])throw new Error('No method named "'+n+'"');r[n]()}})},r(e,null,[{key:"VERSION",get:function(){return i}}]),e}();return t(document).on(f.CLICK_DATA_API,p.DATA_TOGGLE,function(e){e.preventDefault(),h._jQueryInterface.call(t(this),"show")}),t.fn[e]=h._jQueryInterface,t.fn[e].Constructor=h,t.fn[e].noConflict=function(){return t.fn[e]=u,h._jQueryInterface},h}(jQuery),function(t){if(void 0===window.Tether)throw new Error("Bootstrap tooltips require Tether (http://tether.io/)");var e="tooltip",a="4.0.0-alpha.5",s="bs.tooltip",l="."+s,u=t.fn[e],c=150,f="bs-tether",d={animation:!0,template:'<div class="tooltip" role="tooltip"><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,selector:!1,placement:"top",offset:"0 0",constraints:[]},p={animation:"boolean",template:"string",title:"(string|element|function)",trigger:"string",delay:"(number|object)",html:"boolean",selector:"(string|boolean)",placement:"(string|function)",offset:"string",constraints:"array"},h={TOP:"bottom center",RIGHT:"middle left",BOTTOM:"top center",LEFT:"middle right"},m={IN:"in",OUT:"out"},g={HIDE:"hide"+l,HIDDEN:"hidden"+l,SHOW:"show"+l,SHOWN:"shown"+l,INSERTED:"inserted"+l,CLICK:"click"+l,FOCUSIN:"focusin"+l,FOCUSOUT:"focusout"+l,MOUSEENTER:"mouseenter"+l,MOUSELEAVE:"mouseleave"+l},y={FADE:"fade",IN:"in"},v={TOOLTIP:".tooltip",TOOLTIP_INNER:".tooltip-inner"},b={element:!1,enabled:!1},_={HOVER:"hover",FOCUS:"focus",CLICK:"click",MANUAL:"manual"},x=function(){function u(t,e){n(this,u),this._isEnabled=!0,this._timeout=0,this._hoverState="",this._activeTrigger={},this._tether=null,this.element=t,this.config=this._getConfig(e),this.tip=null,this._setListeners()}return u.prototype.enable=function(){this._isEnabled=!0},u.prototype.disable=function(){this._isEnabled=!1},u.prototype.toggleEnabled=function(){this._isEnabled=!this._isEnabled},u.prototype.toggle=function(e){if(e){var n=this.constructor.DATA_KEY,i=t(e.currentTarget).data(n);i||(i=new this.constructor(e.currentTarget,this._getDelegateConfig()),t(e.currentTarget).data(n,i)),i._activeTrigger.click=!i._activeTrigger.click,i._isWithActiveTrigger()?i._enter(null,i):i._leave(null,i)}else{if(t(this.getTipElement()).hasClass(y.IN))return void this._leave(null,this);this._enter(null,this)}},u.prototype.dispose=function(){clearTimeout(this._timeout),this.cleanupTether(),t.removeData(this.element,this.constructor.DATA_KEY),t(this.element).off(this.constructor.EVENT_KEY),this.tip&&t(this.tip).remove(),this._isEnabled=null,this._timeout=null,this._hoverState=null,this._activeTrigger=null,this._tether=null,this.element=null,this.config=null,this.tip=null},u.prototype.show=function(){var e=this,n=t.Event(this.constructor.Event.SHOW);if(this.isWithContent()&&this._isEnabled){t(this.element).trigger(n);var i=t.contains(this.element.ownerDocument.documentElement,this.element);if(n.isDefaultPrevented()||!i)return;var r=this.getTipElement(),a=o.getUID(this.constructor.NAME);r.setAttribute("id",a),this.element.setAttribute("aria-describedby",a),this.setContent(),this.config.animation&&t(r).addClass(y.FADE);var s="function"==typeof this.config.placement?this.config.placement.call(this,r,this.element):this.config.placement,l=this._getAttachment(s);t(r).data(this.constructor.DATA_KEY,this).appendTo(document.body),t(this.element).trigger(this.constructor.Event.INSERTED),this._tether=new Tether({attachment:l,element:r,target:this.element,classes:b,classPrefix:f,offset:this.config.offset,constraints:this.config.constraints,addTargetClasses:!1}),o.reflow(r),this._tether.position(),t(r).addClass(y.IN);var c=function(){var n=e._hoverState;e._hoverState=null,t(e.element).trigger(e.constructor.Event.SHOWN),n===m.OUT&&e._leave(null,e)};if(o.supportsTransitionEnd()&&t(this.tip).hasClass(y.FADE))return void t(this.tip).one(o.TRANSITION_END,c).emulateTransitionEnd(u._TRANSITION_DURATION);c()}},u.prototype.hide=function(e){var n=this,i=this.getTipElement(),r=t.Event(this.constructor.Event.HIDE),a=function(){n._hoverState!==m.IN&&i.parentNode&&i.parentNode.removeChild(i),n.element.removeAttribute("aria-describedby"),t(n.element).trigger(n.constructor.Event.HIDDEN),n.cleanupTether(),e&&e()};t(this.element).trigger(r),
r.isDefaultPrevented()||(t(i).removeClass(y.IN),o.supportsTransitionEnd()&&t(this.tip).hasClass(y.FADE)?t(i).one(o.TRANSITION_END,a).emulateTransitionEnd(c):a(),this._hoverState="")},u.prototype.isWithContent=function(){return Boolean(this.getTitle())},u.prototype.getTipElement=function(){return this.tip=this.tip||t(this.config.template)[0]},u.prototype.setContent=function(){var e=t(this.getTipElement());this.setElementContent(e.find(v.TOOLTIP_INNER),this.getTitle()),e.removeClass(y.FADE).removeClass(y.IN),this.cleanupTether()},u.prototype.setElementContent=function(e,n){var r=this.config.html;"object"===("undefined"==typeof n?"undefined":i(n))&&(n.nodeType||n.jquery)?r?t(n).parent().is(e)||e.empty().append(n):e.text(t(n).text()):e[r?"html":"text"](n)},u.prototype.getTitle=function(){var t=this.element.getAttribute("data-original-title");return t||(t="function"==typeof this.config.title?this.config.title.call(this.element):this.config.title),t},u.prototype.cleanupTether=function(){this._tether&&this._tether.destroy()},u.prototype._getAttachment=function(t){return h[t.toUpperCase()]},u.prototype._setListeners=function(){var e=this,n=this.config.trigger.split(" ");n.forEach(function(n){if("click"===n)t(e.element).on(e.constructor.Event.CLICK,e.config.selector,t.proxy(e.toggle,e));else if(n!==_.MANUAL){var i=n===_.HOVER?e.constructor.Event.MOUSEENTER:e.constructor.Event.FOCUSIN,r=n===_.HOVER?e.constructor.Event.MOUSELEAVE:e.constructor.Event.FOCUSOUT;t(e.element).on(i,e.config.selector,t.proxy(e._enter,e)).on(r,e.config.selector,t.proxy(e._leave,e))}}),this.config.selector?this.config=t.extend({},this.config,{trigger:"manual",selector:""}):this._fixTitle()},u.prototype._fixTitle=function(){var t=i(this.element.getAttribute("data-original-title"));(this.element.getAttribute("title")||"string"!==t)&&(this.element.setAttribute("data-original-title",this.element.getAttribute("title")||""),this.element.setAttribute("title",""))},u.prototype._enter=function(e,n){var i=this.constructor.DATA_KEY;return n=n||t(e.currentTarget).data(i),n||(n=new this.constructor(e.currentTarget,this._getDelegateConfig()),t(e.currentTarget).data(i,n)),e&&(n._activeTrigger["focusin"===e.type?_.FOCUS:_.HOVER]=!0),t(n.getTipElement()).hasClass(y.IN)||n._hoverState===m.IN?void(n._hoverState=m.IN):(clearTimeout(n._timeout),n._hoverState=m.IN,n.config.delay&&n.config.delay.show?void(n._timeout=setTimeout(function(){n._hoverState===m.IN&&n.show()},n.config.delay.show)):void n.show())},u.prototype._leave=function(e,n){var i=this.constructor.DATA_KEY;if(n=n||t(e.currentTarget).data(i),n||(n=new this.constructor(e.currentTarget,this._getDelegateConfig()),t(e.currentTarget).data(i,n)),e&&(n._activeTrigger["focusout"===e.type?_.FOCUS:_.HOVER]=!1),!n._isWithActiveTrigger())return clearTimeout(n._timeout),n._hoverState=m.OUT,n.config.delay&&n.config.delay.hide?void(n._timeout=setTimeout(function(){n._hoverState===m.OUT&&n.hide()},n.config.delay.hide)):void n.hide()},u.prototype._isWithActiveTrigger=function(){for(var t in this._activeTrigger)if(this._activeTrigger[t])return!0;return!1},u.prototype._getConfig=function(n){return n=t.extend({},this.constructor.Default,t(this.element).data(),n),n.delay&&"number"==typeof n.delay&&(n.delay={show:n.delay,hide:n.delay}),o.typeCheckConfig(e,n,this.constructor.DefaultType),n},u.prototype._getDelegateConfig=function(){var t={};if(this.config)for(var e in this.config)this.constructor.Default[e]!==this.config[e]&&(t[e]=this.config[e]);return t},u._jQueryInterface=function(e){return this.each(function(){var n=t(this).data(s),r="object"===("undefined"==typeof e?"undefined":i(e))?e:null;if((n||!/dispose|hide/.test(e))&&(n||(n=new u(this,r),t(this).data(s,n)),"string"==typeof e)){if(void 0===n[e])throw new Error('No method named "'+e+'"');n[e]()}})},r(u,null,[{key:"VERSION",get:function(){return a}},{key:"Default",get:function(){return d}},{key:"NAME",get:function(){return e}},{key:"DATA_KEY",get:function(){return s}},{key:"Event",get:function(){return g}},{key:"EVENT_KEY",get:function(){return l}},{key:"DefaultType",get:function(){return p}}]),u}();return t.fn[e]=x._jQueryInterface,t.fn[e].Constructor=x,t.fn[e].noConflict=function(){return t.fn[e]=u,x._jQueryInterface},x}(jQuery));!function(o){var s="popover",l="4.0.0-alpha.5",u="bs.popover",c="."+u,f=o.fn[s],d=o.extend({},a.Default,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),p=o.extend({},a.DefaultType,{content:"(string|element|function)"}),h={FADE:"fade",IN:"in"},m={TITLE:".popover-title",CONTENT:".popover-content"},g={HIDE:"hide"+c,HIDDEN:"hidden"+c,SHOW:"show"+c,SHOWN:"shown"+c,INSERTED:"inserted"+c,CLICK:"click"+c,FOCUSIN:"focusin"+c,FOCUSOUT:"focusout"+c,MOUSEENTER:"mouseenter"+c,MOUSELEAVE:"mouseleave"+c},y=function(a){function f(){return n(this,f),t(this,a.apply(this,arguments))}return e(f,a),f.prototype.isWithContent=function(){return this.getTitle()||this._getContent()},f.prototype.getTipElement=function(){return this.tip=this.tip||o(this.config.template)[0]},f.prototype.setContent=function(){var t=o(this.getTipElement());this.setElementContent(t.find(m.TITLE),this.getTitle()),this.setElementContent(t.find(m.CONTENT),this._getContent()),t.removeClass(h.FADE).removeClass(h.IN),this.cleanupTether()},f.prototype._getContent=function(){return this.element.getAttribute("data-content")||("function"==typeof this.config.content?this.config.content.call(this.element):this.config.content)},f._jQueryInterface=function(t){return this.each(function(){var e=o(this).data(u),n="object"===("undefined"==typeof t?"undefined":i(t))?t:null;if((e||!/destroy|hide/.test(t))&&(e||(e=new f(this,n),o(this).data(u,e)),"string"==typeof t)){if(void 0===e[t])throw new Error('No method named "'+t+'"');e[t]()}})},r(f,null,[{key:"VERSION",get:function(){return l}},{key:"Default",get:function(){return d}},{key:"NAME",get:function(){return s}},{key:"DATA_KEY",get:function(){return u}},{key:"Event",get:function(){return g}},{key:"EVENT_KEY",get:function(){return c}},{key:"DefaultType",get:function(){return p}}]),f}(a);return o.fn[s]=y._jQueryInterface,o.fn[s].Constructor=y,o.fn[s].noConflict=function(){return o.fn[s]=f,y._jQueryInterface},y}(jQuery)}()},function(t,e,n){var i,i;!function(e){t.exports=e()}(function(){return function t(e,n,r){function o(s,l){if(!n[s]){if(!e[s]){var u="function"==typeof i&&i;if(!l&&u)return i(s,!0);if(a)return a(s,!0);var c=new Error("Cannot find module '"+s+"'");throw c.code="MODULE_NOT_FOUND",c}var f=n[s]={exports:{}};e[s][0].call(f.exports,function(t){var n=e[s][1][t];return o(n?n:t)},f,f.exports,t,e,n,r)}return n[s].exports}for(var a="function"==typeof i&&i,s=0;s<r.length;s++)o(r[s]);return o}({1:[function(t,e,n){e.exports=function(t){var e,n,i,r=-1;if(t.lines.length>1&&"flex-start"===t.style.alignContent)for(e=0;i=t.lines[++r];)i.crossStart=e,e+=i.cross;else if(t.lines.length>1&&"flex-end"===t.style.alignContent)for(e=t.flexStyle.crossSpace;i=t.lines[++r];)i.crossStart=e,e+=i.cross;else if(t.lines.length>1&&"center"===t.style.alignContent)for(e=t.flexStyle.crossSpace/2;i=t.lines[++r];)i.crossStart=e,e+=i.cross;else if(t.lines.length>1&&"space-between"===t.style.alignContent)for(n=t.flexStyle.crossSpace/(t.lines.length-1),e=0;i=t.lines[++r];)i.crossStart=e,e+=i.cross+n;else if(t.lines.length>1&&"space-around"===t.style.alignContent)for(n=2*t.flexStyle.crossSpace/(2*t.lines.length),e=n/2;i=t.lines[++r];)i.crossStart=e,e+=i.cross+n;else for(n=t.flexStyle.crossSpace/t.lines.length,e=t.flexStyle.crossInnerBefore;i=t.lines[++r];)i.crossStart=e,i.cross+=n,e+=i.cross}},{}],2:[function(t,e,n){e.exports=function(t){for(var e,n=-1;line=t.lines[++n];)for(e=-1;child=line.children[++e];){var i=child.style.alignSelf;"auto"===i&&(i=t.style.alignItems),"flex-start"===i?child.flexStyle.crossStart=line.crossStart:"flex-end"===i?child.flexStyle.crossStart=line.crossStart+line.cross-child.flexStyle.crossOuter:"center"===i?child.flexStyle.crossStart=line.crossStart+(line.cross-child.flexStyle.crossOuter)/2:(child.flexStyle.crossStart=line.crossStart,child.flexStyle.crossOuter=line.cross,child.flexStyle.cross=child.flexStyle.crossOuter-child.flexStyle.crossBefore-child.flexStyle.crossAfter)}}},{}],3:[function(t,e,n){e.exports=function t(e,t){var n="row"===t||"row-reverse"===t,i=e.mainAxis;if(i){var r=n&&"inline"===i||!n&&"block"===i;r||(e.flexStyle={main:e.flexStyle.cross,cross:e.flexStyle.main,mainOffset:e.flexStyle.crossOffset,crossOffset:e.flexStyle.mainOffset,mainBefore:e.flexStyle.crossBefore,mainAfter:e.flexStyle.crossAfter,crossBefore:e.flexStyle.mainBefore,crossAfter:e.flexStyle.mainAfter,mainInnerBefore:e.flexStyle.crossInnerBefore,mainInnerAfter:e.flexStyle.crossInnerAfter,crossInnerBefore:e.flexStyle.mainInnerBefore,crossInnerAfter:e.flexStyle.mainInnerAfter,mainBorderBefore:e.flexStyle.crossBorderBefore,mainBorderAfter:e.flexStyle.crossBorderAfter,crossBorderBefore:e.flexStyle.mainBorderBefore,crossBorderAfter:e.flexStyle.mainBorderAfter})}else n?e.flexStyle={main:e.style.width,cross:e.style.height,mainOffset:e.style.offsetWidth,crossOffset:e.style.offsetHeight,mainBefore:e.style.marginLeft,mainAfter:e.style.marginRight,crossBefore:e.style.marginTop,crossAfter:e.style.marginBottom,mainInnerBefore:e.style.paddingLeft,mainInnerAfter:e.style.paddingRight,crossInnerBefore:e.style.paddingTop,crossInnerAfter:e.style.paddingBottom,mainBorderBefore:e.style.borderLeftWidth,mainBorderAfter:e.style.borderRightWidth,crossBorderBefore:e.style.borderTopWidth,crossBorderAfter:e.style.borderBottomWidth}:e.flexStyle={main:e.style.height,cross:e.style.width,mainOffset:e.style.offsetHeight,crossOffset:e.style.offsetWidth,mainBefore:e.style.marginTop,mainAfter:e.style.marginBottom,crossBefore:e.style.marginLeft,crossAfter:e.style.marginRight,mainInnerBefore:e.style.paddingTop,mainInnerAfter:e.style.paddingBottom,crossInnerBefore:e.style.paddingLeft,crossInnerAfter:e.style.paddingRight,mainBorderBefore:e.style.borderTopWidth,mainBorderAfter:e.style.borderBottomWidth,crossBorderBefore:e.style.borderLeftWidth,crossBorderAfter:e.style.borderRightWidth},"content-box"===e.style.boxSizing&&("number"==typeof e.flexStyle.main&&(e.flexStyle.main+=e.flexStyle.mainInnerBefore+e.flexStyle.mainInnerAfter+e.flexStyle.mainBorderBefore+e.flexStyle.mainBorderAfter),"number"==typeof e.flexStyle.cross&&(e.flexStyle.cross+=e.flexStyle.crossInnerBefore+e.flexStyle.crossInnerAfter+e.flexStyle.crossBorderBefore+e.flexStyle.crossBorderAfter));e.mainAxis=n?"inline":"block",e.crossAxis=n?"block":"inline","number"==typeof e.style.flexBasis&&(e.flexStyle.main=e.style.flexBasis+e.flexStyle.mainInnerBefore+e.flexStyle.mainInnerAfter+e.flexStyle.mainBorderBefore+e.flexStyle.mainBorderAfter),e.flexStyle.mainOuter=e.flexStyle.main,e.flexStyle.crossOuter=e.flexStyle.cross,"auto"===e.flexStyle.mainOuter&&(e.flexStyle.mainOuter=e.flexStyle.mainOffset),"auto"===e.flexStyle.crossOuter&&(e.flexStyle.crossOuter=e.flexStyle.crossOffset),"number"==typeof e.flexStyle.mainBefore&&(e.flexStyle.mainOuter+=e.flexStyle.mainBefore),"number"==typeof e.flexStyle.mainAfter&&(e.flexStyle.mainOuter+=e.flexStyle.mainAfter),"number"==typeof e.flexStyle.crossBefore&&(e.flexStyle.crossOuter+=e.flexStyle.crossBefore),"number"==typeof e.flexStyle.crossAfter&&(e.flexStyle.crossOuter+=e.flexStyle.crossAfter)}},{}],4:[function(t,e,n){var i=t("../reduce");e.exports=function(t){if(t.mainSpace>0){var e=i(t.children,function(t,e){return t+parseFloat(e.style.flexGrow)},0);e>0&&(t.main=i(t.children,function(n,i){return"auto"===i.flexStyle.main?i.flexStyle.main=i.flexStyle.mainOffset+parseFloat(i.style.flexGrow)/e*t.mainSpace:i.flexStyle.main+=parseFloat(i.style.flexGrow)/e*t.mainSpace,i.flexStyle.mainOuter=i.flexStyle.main+i.flexStyle.mainBefore+i.flexStyle.mainAfter,n+i.flexStyle.mainOuter},0),t.mainSpace=0)}}},{"../reduce":12}],5:[function(t,e,n){var i=t("../reduce");e.exports=function(t){if(t.mainSpace<0){var e=i(t.children,function(t,e){return t+parseFloat(e.style.flexShrink)},0);e>0&&(t.main=i(t.children,function(n,i){return i.flexStyle.main+=parseFloat(i.style.flexShrink)/e*t.mainSpace,i.flexStyle.mainOuter=i.flexStyle.main+i.flexStyle.mainBefore+i.flexStyle.mainAfter,n+i.flexStyle.mainOuter},0),t.mainSpace=0)}}},{"../reduce":12}],6:[function(t,e,n){var i=t("../reduce");e.exports=function(t){var e;t.lines=[e={main:0,cross:0,children:[]}];for(var n,r=-1;n=t.children[++r];)"nowrap"===t.style.flexWrap||0===e.children.length||"auto"===t.flexStyle.main||t.flexStyle.main-t.flexStyle.mainInnerBefore-t.flexStyle.mainInnerAfter-t.flexStyle.mainBorderBefore-t.flexStyle.mainBorderAfter>=e.main+n.flexStyle.mainOuter?(e.main+=n.flexStyle.mainOuter,e.cross=Math.max(e.cross,n.flexStyle.crossOuter)):t.lines.push(e={main:n.flexStyle.mainOuter,cross:n.flexStyle.crossOuter,children:[]}),e.children.push(n);t.flexStyle.mainLines=i(t.lines,function(t,e){return Math.max(t,e.main)},0),t.flexStyle.crossLines=i(t.lines,function(t,e){return t+e.cross},0),"auto"===t.flexStyle.main&&(t.flexStyle.main=Math.max(t.flexStyle.mainOffset,t.flexStyle.mainLines+t.flexStyle.mainInnerBefore+t.flexStyle.mainInnerAfter+t.flexStyle.mainBorderBefore+t.flexStyle.mainBorderAfter)),"auto"===t.flexStyle.cross&&(t.flexStyle.cross=Math.max(t.flexStyle.crossOffset,t.flexStyle.crossLines+t.flexStyle.crossInnerBefore+t.flexStyle.crossInnerAfter+t.flexStyle.crossBorderBefore+t.flexStyle.crossBorderAfter)),t.flexStyle.crossSpace=t.flexStyle.cross-t.flexStyle.crossInnerBefore-t.flexStyle.crossInnerAfter-t.flexStyle.crossBorderBefore-t.flexStyle.crossBorderAfter-t.flexStyle.crossLines,t.flexStyle.mainOuter=t.flexStyle.main+t.flexStyle.mainBefore+t.flexStyle.mainAfter,t.flexStyle.crossOuter=t.flexStyle.cross+t.flexStyle.crossBefore+t.flexStyle.crossAfter}},{"../reduce":12}],7:[function(t,e,n){function i(e){for(var n,i=-1;n=e.children[++i];)t("./flex-direction")(n,e.style.flexDirection);t("./flex-direction")(e,e.style.flexDirection),t("./order")(e),t("./flexbox-lines")(e),t("./align-content")(e),i=-1;for(var r;r=e.lines[++i];)r.mainSpace=e.flexStyle.main-e.flexStyle.mainInnerBefore-e.flexStyle.mainInnerAfter-e.flexStyle.mainBorderBefore-e.flexStyle.mainBorderAfter-r.main,t("./flex-grow")(r),t("./flex-shrink")(r),t("./margin-main")(r),t("./margin-cross")(r),t("./justify-content")(r,e.style.justifyContent,e);t("./align-items")(e)}e.exports=i},{"./align-content":1,"./align-items":2,"./flex-direction":3,"./flex-grow":4,"./flex-shrink":5,"./flexbox-lines":6,"./justify-content":8,"./margin-cross":9,"./margin-main":10,"./order":11}],8:[function(t,e,n){e.exports=function(t,e,n){var i,r,o,a=n.flexStyle.mainInnerBefore,s=-1;if("flex-end"===e)for(i=t.mainSpace,i+=a;o=t.children[++s];)o.flexStyle.mainStart=i,i+=o.flexStyle.mainOuter;else if("center"===e)for(i=t.mainSpace/2,i+=a;o=t.children[++s];)o.flexStyle.mainStart=i,i+=o.flexStyle.mainOuter;else if("space-between"===e)for(r=t.mainSpace/(t.children.length-1),i=0,i+=a;o=t.children[++s];)o.flexStyle.mainStart=i,i+=o.flexStyle.mainOuter+r;else if("space-around"===e)for(r=2*t.mainSpace/(2*t.children.length),i=r/2,i+=a;o=t.children[++s];)o.flexStyle.mainStart=i,i+=o.flexStyle.mainOuter+r;else for(i=0,i+=a;o=t.children[++s];)o.flexStyle.mainStart=i,i+=o.flexStyle.mainOuter}},{}],9:[function(t,e,n){e.exports=function(t){for(var e,n=-1;e=t.children[++n];){var i=0;"auto"===e.flexStyle.crossBefore&&++i,"auto"===e.flexStyle.crossAfter&&++i;var r=t.cross-e.flexStyle.crossOuter;"auto"===e.flexStyle.crossBefore&&(e.flexStyle.crossBefore=r/i),"auto"===e.flexStyle.crossAfter&&(e.flexStyle.crossAfter=r/i),"auto"===e.flexStyle.cross?e.flexStyle.crossOuter=e.flexStyle.crossOffset+e.flexStyle.crossBefore+e.flexStyle.crossAfter:e.flexStyle.crossOuter=e.flexStyle.cross+e.flexStyle.crossBefore+e.flexStyle.crossAfter}}},{}],10:[function(t,e,n){e.exports=function(t){for(var e,n=0,i=-1;e=t.children[++i];)"auto"===e.flexStyle.mainBefore&&++n,"auto"===e.flexStyle.mainAfter&&++n;if(n>0){for(i=-1;e=t.children[++i];)"auto"===e.flexStyle.mainBefore&&(e.flexStyle.mainBefore=t.mainSpace/n),"auto"===e.flexStyle.mainAfter&&(e.flexStyle.mainAfter=t.mainSpace/n),"auto"===e.flexStyle.main?e.flexStyle.mainOuter=e.flexStyle.mainOffset+e.flexStyle.mainBefore+e.flexStyle.mainAfter:e.flexStyle.mainOuter=e.flexStyle.main+e.flexStyle.mainBefore+e.flexStyle.mainAfter;t.mainSpace=0}}},{}],11:[function(t,e,n){var i=/^(column|row)-reverse$/;e.exports=function(t){t.children.sort(function(t,e){return t.style.order-e.style.order||t.index-e.index}),i.test(t.style.flexDirection)&&t.children.reverse()}},{}],12:[function(t,e,n){function i(t,e,n){for(var i=t.length,r=-1;++r<i;)r in t&&(n=e(n,t[r],r));return n}e.exports=i},{}],13:[function(t,e,n){function i(t){s(a(t))}var r=t("./read"),o=t("./write"),a=t("./readAll"),s=t("./writeAll");e.exports=i,e.exports.read=r,e.exports.write=o,e.exports.readAll=a,e.exports.writeAll=s},{"./read":15,"./readAll":16,"./write":17,"./writeAll":18}],14:[function(t,e,n){function i(t,e){var n=String(t).match(o);if(!n)return t;var i=n[1],a=n[2];return"px"===a?1*i:"cm"===a?.3937*i*96:"in"===a?96*i:"mm"===a?.3937*i*96/10:"pc"===a?12*i*96/72:"pt"===a?96*i/72:"rem"===a?16*i:r(t,e)}function r(t,e){a.style.cssText="border:none!important;clip:rect(0 0 0 0)!important;display:block!important;font-size:1em!important;height:0!important;margin:0!important;padding:0!important;position:relative!important;width:"+t+"!important",e.parentNode.insertBefore(a,e.nextSibling);var n=a.offsetWidth;return e.parentNode.removeChild(a),n}e.exports=i;var o=/^([-+]?\d*\.?\d+)(%|[a-z]+)$/,a=document.createElement("div")},{}],15:[function(t,e,n){function i(t){var e={alignContent:"stretch",alignItems:"stretch",alignSelf:"auto",borderBottomWidth:0,borderLeftWidth:0,borderRightWidth:0,borderTopWidth:0,boxSizing:"content-box",display:"inline",flexBasis:"auto",flexDirection:"row",flexGrow:0,flexShrink:1,flexWrap:"nowrap",justifyContent:"flex-start",height:"auto",marginTop:0,marginRight:0,marginLeft:0,marginBottom:0,paddingTop:0,paddingRight:0,paddingLeft:0,paddingBottom:0,maxHeight:"none",maxWidth:"none",minHeight:0,minWidth:0,order:0,position:"static",width:"auto"},n=t instanceof Element;if(n){var i=t.hasAttribute("data-style"),s=i?t.getAttribute("data-style"):t.getAttribute("style")||"";i||t.setAttribute("data-style",s);var u=window.getComputedStyle&&getComputedStyle(t)||{};a(e,u);var c=t.currentStyle||{};r(e,c),o(e,s);for(var f in e)e[f]=l(e[f],t);var d=t.getBoundingClientRect();e.offsetHeight=d.height||t.offsetHeight,e.offsetWidth=d.width||t.offsetWidth}var p={element:t,style:e};return p}function r(t,e){for(var n in t){var i=n in e;if(i)t[n]=e[n];else{var r=n.replace(/[A-Z]/g,"-$&").toLowerCase(),o=r in e;o&&(t[n]=e[r])}}var a="-js-display"in e;a&&(t.display=e["-js-display"])}function o(t,e){for(var n;n=s.exec(e);){var i=n[1].toLowerCase().replace(/-[a-z]/g,function(t){return t.slice(1).toUpperCase()});t[i]=n[2]}}function a(t,e){for(var n in t){var i=n in e;i&&!/^(alignSelf|height|width)$/.test(n)&&(t[n]=e[n])}}e.exports=i;var s=/([^\s:;]+)\s*:\s*([^;]+?)\s*(;|$)/g,l=t("./getComputedLength")},{"./getComputedLength":14}],16:[function(t,e,n){function i(t){var e=[];return r(t,e),e}function r(t,e){for(var n,i=o(t),s=[],l=-1;n=t.childNodes[++l];){var u=3===n.nodeType&&!/^\s*$/.test(n.nodeValue);if(i&&u){var c=n;n=t.insertBefore(document.createElement("flex-item"),c),n.appendChild(c)}var f=n instanceof Element;if(f){var d=r(n,e);if(i){var p=n.style;p.display="inline-block",p.position="absolute",d.style=a(n).style,s.push(d)}}}var h={element:t,children:s};return i&&(h.style=a(t).style,e.push(h)),h}function o(t){var e=t instanceof Element,n=e&&t.getAttribute("data-style"),i=e&&t.currentStyle&&t.currentStyle["-js-display"],r=s.test(n)||l.test(i);return r}e.exports=i;var a=t("../read"),s=/(^|;)\s*display\s*:\s*(inline-)?flex\s*(;|$)/i,l=/^(inline-)?flex$/i},{"../read":15}],17:[function(t,e,n){function i(t){o(t);var e=t.element.style,n="inline"===t.mainAxis?["main","cross"]:["cross","main"];e.boxSizing="content-box",e.display="block",e.position="relative",e.width=r(t.flexStyle[n[0]]-t.flexStyle[n[0]+"InnerBefore"]-t.flexStyle[n[0]+"InnerAfter"]-t.flexStyle[n[0]+"BorderBefore"]-t.flexStyle[n[0]+"BorderAfter"]),e.height=r(t.flexStyle[n[1]]-t.flexStyle[n[1]+"InnerBefore"]-t.flexStyle[n[1]+"InnerAfter"]-t.flexStyle[n[1]+"BorderBefore"]-t.flexStyle[n[1]+"BorderAfter"]);for(var i,a=-1;i=t.children[++a];){var s=i.element.style,l="inline"===i.mainAxis?["main","cross"]:["cross","main"];s.boxSizing="content-box",s.display="block",s.position="absolute","auto"!==i.flexStyle[l[0]]&&(s.width=r(i.flexStyle[l[0]]-i.flexStyle[l[0]+"InnerBefore"]-i.flexStyle[l[0]+"InnerAfter"]-i.flexStyle[l[0]+"BorderBefore"]-i.flexStyle[l[0]+"BorderAfter"])),"auto"!==i.flexStyle[l[1]]&&(s.height=r(i.flexStyle[l[1]]-i.flexStyle[l[1]+"InnerBefore"]-i.flexStyle[l[1]+"InnerAfter"]-i.flexStyle[l[1]+"BorderBefore"]-i.flexStyle[l[1]+"BorderAfter"])),s.top=r(i.flexStyle[l[1]+"Start"]),s.left=r(i.flexStyle[l[0]+"Start"]),s.marginTop=r(i.flexStyle[l[1]+"Before"]),s.marginRight=r(i.flexStyle[l[0]+"After"]),s.marginBottom=r(i.flexStyle[l[1]+"After"]),s.marginLeft=r(i.flexStyle[l[0]+"Before"])}}function r(t){return"string"==typeof t?t:Math.max(t,0)+"px"}e.exports=i;var o=t("../flexbox")},{"../flexbox":7}],18:[function(t,e,n){function i(t){for(var e,n=-1;e=t[++n];)r(e)}e.exports=i;var r=t("../write")},{"../write":17}]},{},[13])(13)})},function(t,e){!function(t){"use strict";function e(t,e){return t+".touchspin_"+e}function n(n,i){return t.map(n,function(t){return e(t,i)})}var i=0;t.fn.TouchSpin=function(e){if("destroy"===e)return void this.each(function(){var e=t(this),i=e.data();t(document).off(n(["mouseup","touchend","touchcancel","mousemove","touchmove","scroll","scrollstart"],i.spinnerid).join(" "))});var r={min:0,max:100,initval:"",replacementval:"",step:1,decimals:0,stepinterval:100,forcestepdivisibility:"round",stepintervaldelay:500,verticalbuttons:!1,verticalupclass:"glyphicon glyphicon-chevron-up",verticaldownclass:"glyphicon glyphicon-chevron-down",prefix:"",postfix:"",prefix_extraclass:"",postfix_extraclass:"",booster:!0,boostat:10,maxboostedstep:!1,mousewheel:!0,buttondown_class:"btn btn-default",buttonup_class:"btn btn-default",buttondown_txt:"-",buttonup_txt:"+"},o={min:"min",max:"max",initval:"init-val",replacementval:"replacement-val",step:"step",decimals:"decimals",stepinterval:"step-interval",verticalbuttons:"vertical-buttons",verticalupclass:"vertical-up-class",verticaldownclass:"vertical-down-class",forcestepdivisibility:"force-step-divisibility",stepintervaldelay:"step-interval-delay",prefix:"prefix",postfix:"postfix",prefix_extraclass:"prefix-extra-class",postfix_extraclass:"postfix-extra-class",booster:"booster",boostat:"boostat",maxboostedstep:"max-boosted-step",mousewheel:"mouse-wheel",buttondown_class:"button-down-class",buttonup_class:"button-up-class",buttondown_txt:"button-down-txt",buttonup_txt:"button-up-txt"};return this.each(function(){function a(){j.data("alreadyinitialized")||(j.data("alreadyinitialized",!0),i+=1,j.data("spinnerid",i),j.is("input")&&(u(),s(),_(),d(),m(),g(),y(),v(),O.input.css("display","block")))}function s(){""!==A.initval&&""===j.val()&&j.val(A.initval)}function l(t){f(t),_();var e=O.input.val();""!==e&&(e=Number(O.input.val()),O.input.val(e.toFixed(A.decimals)))}function u(){A=t.extend({},r,B,c(),e)}function c(){var e={};return t.each(o,function(t,n){var i="bts-"+n;j.is("[data-"+i+"]")&&(e[t]=j.data(i))}),e}function f(e){A=t.extend({},A,e)}function d(){var t=j.val(),e=j.parent();""!==t&&(t=Number(t).toFixed(A.decimals)),j.data("initvalue",t).val(t),j.addClass("form-control"),e.hasClass("input-group")?p(e):h()}function p(e){e.addClass("bootstrap-touchspin");var n,i,r=j.prev(),o=j.next(),a='<span class="input-group-addon bootstrap-touchspin-prefix">'+A.prefix+"</span>",s='<span class="input-group-addon bootstrap-touchspin-postfix">'+A.postfix+"</span>";r.hasClass("input-group-btn")?(n='<button class="'+A.buttondown_class+' bootstrap-touchspin-down" type="button">'+A.buttondown_txt+"</button>",r.append(n)):(n='<span class="input-group-btn"><button class="'+A.buttondown_class+' bootstrap-touchspin-down" type="button">'+A.buttondown_txt+"</button></span>",t(n).insertBefore(j)),o.hasClass("input-group-btn")?(i='<button class="'+A.buttonup_class+' bootstrap-touchspin-up" type="button">'+A.buttonup_txt+"</button>",o.prepend(i)):(i='<span class="input-group-btn"><button class="'+A.buttonup_class+' bootstrap-touchspin-up" type="button">'+A.buttonup_txt+"</button></span>",t(i).insertAfter(j)),t(a).insertBefore(j),t(s).insertAfter(j),I=e}function h(){var e;e=A.verticalbuttons?'<div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix">'+A.prefix+'</span><span class="input-group-addon bootstrap-touchspin-postfix">'+A.postfix+'</span><span class="input-group-btn-vertical"><button class="'+A.buttondown_class+' bootstrap-touchspin-up" type="button"><i class="'+A.verticalupclass+'"></i></button><button class="'+A.buttonup_class+' bootstrap-touchspin-down" type="button"><i class="'+A.verticaldownclass+'"></i></button></span></div>':'<div class="input-group bootstrap-touchspin"><span class="input-group-btn"><button class="'+A.buttondown_class+' bootstrap-touchspin-down" type="button">'+A.buttondown_txt+'</button></span><span class="input-group-addon bootstrap-touchspin-prefix">'+A.prefix+'</span><span class="input-group-addon bootstrap-touchspin-postfix">'+A.postfix+'</span><span class="input-group-btn"><button class="'+A.buttonup_class+' bootstrap-touchspin-up" type="button">'+A.buttonup_txt+"</button></span></div>",I=t(e).insertBefore(j),t(".bootstrap-touchspin-prefix",I).after(j),j.hasClass("input-sm")?I.addClass("input-group-sm"):j.hasClass("input-lg")&&I.addClass("input-group-lg")}function m(){O={down:t(".bootstrap-touchspin-down",I),up:t(".bootstrap-touchspin-up",I),input:t("input",I),prefix:t(".bootstrap-touchspin-prefix",I).addClass(A.prefix_extraclass),postfix:t(".bootstrap-touchspin-postfix",I).addClass(A.postfix_extraclass)}}function g(){""===A.prefix&&O.prefix.hide(),""===A.postfix&&O.postfix.hide()}function y(){j.on("keydown",function(t){var e=t.keyCode||t.which;38===e?("up"!==F&&(S(),C()),t.preventDefault()):40===e&&("down"!==F&&(w(),E()),t.preventDefault())}),j.on("keyup",function(t){var e=t.keyCode||t.which;38===e?T():40===e&&T()}),j.on("blur",function(){_()}),O.down.on("keydown",function(t){var e=t.keyCode||t.which;32!==e&&13!==e||("down"!==F&&(w(),E()),t.preventDefault())}),O.down.on("keyup",function(t){var e=t.keyCode||t.which;32!==e&&13!==e||T()}),O.up.on("keydown",function(t){var e=t.keyCode||t.which;32!==e&&13!==e||("up"!==F&&(S(),C()),t.preventDefault())}),O.up.on("keyup",function(t){var e=t.keyCode||t.which;32!==e&&13!==e||T()}),O.down.on("mousedown.touchspin",function(t){O.down.off("touchstart.touchspin"),j.is(":disabled")||(w(),E(),t.preventDefault(),t.stopPropagation())}),O.down.on("touchstart.touchspin",function(t){O.down.off("mousedown.touchspin"),j.is(":disabled")||(w(),E(),t.preventDefault(),t.stopPropagation())}),O.up.on("mousedown.touchspin",function(t){O.up.off("touchstart.touchspin"),j.is(":disabled")||(S(),C(),t.preventDefault(),t.stopPropagation())}),O.up.on("touchstart.touchspin",function(t){O.up.off("mousedown.touchspin"),j.is(":disabled")||(S(),C(),t.preventDefault(),t.stopPropagation())}),O.up.on("mouseout touchleave touchend touchcancel",function(t){F&&(t.stopPropagation(),T())}),O.down.on("mouseout touchleave touchend touchcancel",function(t){F&&(t.stopPropagation(),T())}),O.down.on("mousemove touchmove",function(t){F&&(t.stopPropagation(),t.preventDefault())}),O.up.on("mousemove touchmove",function(t){F&&(t.stopPropagation(),t.preventDefault())}),t(document).on(n(["mouseup","touchend","touchcancel"],i).join(" "),function(t){F&&(t.preventDefault(),T())}),t(document).on(n(["mousemove","touchmove","scroll","scrollstart"],i).join(" "),function(t){F&&(t.preventDefault(),T())}),j.on("mousewheel DOMMouseScroll",function(t){if(A.mousewheel&&j.is(":focus")){var e=t.originalEvent.wheelDelta||-t.originalEvent.deltaY||-t.originalEvent.detail;t.stopPropagation(),t.preventDefault(),e<0?w():S()}})}function v(){j.on("touchspin.uponce",function(){T(),S()}),j.on("touchspin.downonce",function(){T(),w()}),j.on("touchspin.startupspin",function(){C()}),j.on("touchspin.startdownspin",function(){E()}),j.on("touchspin.stopspin",function(){T()}),j.on("touchspin.updatesettings",function(t,e){l(e)})}function b(t){switch(A.forcestepdivisibility){case"round":return(Math.round(t/A.step)*A.step).toFixed(A.decimals);case"floor":return(Math.floor(t/A.step)*A.step).toFixed(A.decimals);case"ceil":return(Math.ceil(t/A.step)*A.step).toFixed(A.decimals);default:return t}}function _(){var t,e,n;return t=j.val(),""===t?void(""!==A.replacementval&&(j.val(A.replacementval),j.trigger("change"))):void(A.decimals>0&&"."===t||(e=parseFloat(t),isNaN(e)&&(e=""!==A.replacementval?A.replacementval:0),n=e,e.toString()!==t&&(n=e),e<A.min&&(n=A.min),e>A.max&&(n=A.max),n=b(n),Number(t).toString()!==n.toString()&&(j.val(n),j.trigger("change"))))}function x(){if(A.booster){var t=Math.pow(2,Math.floor(V/A.boostat))*A.step;return A.maxboostedstep&&t>A.maxboostedstep&&(t=A.maxboostedstep,k=Math.round(k/t)*t),Math.max(A.step,t)}return A.step}function S(){_(),k=parseFloat(O.input.val()),isNaN(k)&&(k=0);var t=k,e=x();k+=e,k>A.max&&(k=A.max,j.trigger("touchspin.on.max"),T()),O.input.val(Number(k).toFixed(A.decimals)),t!==k&&j.trigger("change")}function w(){_(),k=parseFloat(O.input.val()),isNaN(k)&&(k=0);var t=k,e=x();k-=e,k<A.min&&(k=A.min,j.trigger("touchspin.on.min"),T()),O.input.val(k.toFixed(A.decimals)),t!==k&&j.trigger("change")}function E(){T(),V=0,F="down",j.trigger("touchspin.on.startspin"),j.trigger("touchspin.on.startdownspin"),P=setTimeout(function(){D=setInterval(function(){V++,w()},A.stepinterval)},A.stepintervaldelay)}function C(){T(),V=0,F="up",j.trigger("touchspin.on.startspin"),j.trigger("touchspin.on.startupspin"),L=setTimeout(function(){N=setInterval(function(){V++,S()},A.stepinterval)},A.stepintervaldelay)}function T(){switch(clearTimeout(P),clearTimeout(L),clearInterval(D),clearInterval(N),F){case"up":j.trigger("touchspin.on.stopupspin"),j.trigger("touchspin.on.stopspin");break;case"down":j.trigger("touchspin.on.stopdownspin"),j.trigger("touchspin.on.stopspin")}V=0,F=!1}var A,I,O,k,D,N,P,L,j=t(this),B=j.data(),V=0,F=!1;a()})}}(jQuery)},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(t,e){var n=e.children().detach();e.empty().append(t.children().detach()),t.append(n)}function o(){u.default.responsive.mobile?(0,s.default)("*[id^='_desktop_']").each(function(t,e){var n=(0,s.default)("#"+e.id.replace("_desktop_","_mobile_"));n.length&&r((0,s.default)(e),n)}):(0,s.default)("*[id^='_mobile_']").each(function(t,e){var n=(0,s.default)("#"+e.id.replace("_mobile_","_desktop_"));n.length&&r((0,s.default)(e),n)}),u.default.emit("responsive update",{mobile:u.default.responsive.mobile})}var a=n(8),s=i(a),l=n(9),u=i(l);u.default.responsive=u.default.responsive||{},u.default.responsive.current_width=window.innerWidth,u.default.responsive.min_width=992,u.default.responsive.mobile=u.default.responsive.current_width<u.default.responsive.min_width,(0,s.default)(window).on("resize",function(){var t=u.default.responsive.current_width,e=u.default.responsive.min_width,n=window.innerWidth,i=t>=e&&n<e||t<e&&n>=e;u.default.responsive.current_width=n,u.default.responsive.mobile=u.default.responsive.current_width<u.default.responsive.min_width,i&&o()}),(0,s.default)(document).ready(function(){u.default.responsive.mobile&&o()})},function(t,e){t.exports=jQuery},function(t,e){t.exports=prestashop},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(){0!==(0,s.default)(".js-cancel-address").length&&(0,s.default)(".checkout-step:not(.js-current-step) .step-title").addClass("not-allowed"),
(0,s.default)(".js-terms a").on("click",function(t){t.preventDefault();var e=(0,s.default)(t.target).attr("href");e&&(e+="?content_only=1",s.default.get(e,function(t){(0,s.default)("#modal").find(".js-modal-content").html((0,s.default)(t).find(".page-cms").contents())}).fail(function(t){u.default.emit("handleError",{eventType:"clickTerms",resp:t})})),(0,s.default)("#modal").modal("show")}),(0,s.default)(".js-gift-checkbox").on("click",function(t){(0,s.default)("#gift").collapse("toggle")})}function o(){(0,s.default)(".card-block .cart-summary-products p a").on("click",function(t){t=(0,s.default)(this).find("i.material-icons"),"expand_more"==t.text()?t.text("expand_less"):t.text("expand_more")})}var a=n(8),s=i(a),l=n(9),u=i(l);(0,s.default)(document).ready(function(){1===(0,s.default)("body#checkout").length&&(r(),o()),u.default.on("updatedDeliveryForm",function(t){"undefined"!=typeof t.deliveryOption&&0!==t.deliveryOption.length&&((0,s.default)(".carrier-extra-content").hide(),t.deliveryOption.next(".carrier-extra-content").slideDown())})})},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(){(0,s.default)("#order-return-form table thead input[type=checkbox]").on("click",function(){var t=(0,s.default)(this).prop("checked");(0,s.default)("#order-return-form table tbody input[type=checkbox]").each(function(e,n){(0,s.default)(n).prop("checked",t)})})}function o(){(0,s.default)("body#order-detail")&&r()}var a=n(8),s=i(a);(0,s.default)(document).ready(o)},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(t){(0,s.default)("#search_filters").replaceWith(t.rendered_facets),(0,s.default)("#js-active-search-filters").replaceWith(t.rendered_active_filters),(0,s.default)("#js-product-list-top").replaceWith(t.rendered_products_top),(0,s.default)("#js-product-list").replaceWith(t.rendered_products),(0,s.default)("#js-product-list-bottom").replaceWith(t.rendered_products_bottom),t.rendered_products_header&&(0,s.default)("#js-product-list-header").replaceWith(t.rendered_products_header);var e=new f.default;e.init()}function o(){(0,s.default)(".product-actions .add-to-cart-or-refresh").attr("action",(0,s.default)("#getCartLink").val()),(0,s.default)(".product-actions .add-to-cart-or-refresh #tokenId").attr("value",(0,s.default)("#getTokenId").val())}var a=n(8),s=i(a),l=n(9),u=i(l);n(13);var c=n(14),f=i(c);(0,s.default)(document).ready(function(){o(),u.default.on("clickQuickView",function(e){var n={action:"quickview",id_product:e.dataset.idProduct,id_product_attribute:e.dataset.idProductAttribute};s.default.post(u.default.urls.pages.product,n,null,"json").then(function(e){(0,s.default)("body").append(e.quickview_html);var n=(0,s.default)("#quickview-modal-"+e.product.id+"-"+e.product.id_product_attribute);n.modal("show"),t(n),n.on("hidden.bs.modal",function(){n.remove()}),additionalCarousel(".modal.quickview .additional-carousel")}).fail(function(t){u.default.emit("handleError",{eventType:"clickQuickView",resp:t})})});var t=function(t){var n=4,i=(0,s.default)(".js-arrows"),r=t.find(".js-qv-product-images");(0,s.default)(".js-thumb").on("click",function(t){(0,s.default)(".js-thumb").hasClass("selected")&&(0,s.default)(".js-thumb").removeClass("selected"),(0,s.default)(t.currentTarget).addClass("selected"),(0,s.default)(".js-qv-product-cover").attr("src",(0,s.default)(t.target).data("image-large-src"))}),r.find("li").length<=n?i.hide():i.on("click",function(t){(0,s.default)(t.target).hasClass("arrow-up")&&(0,s.default)(".js-qv-product-images").position().top<0?(e("up"),(0,s.default)(".arrow-down").css("opacity","1")):(0,s.default)(t.target).hasClass("arrow-down")&&r.position().top+r.height()>(0,s.default)(".js-qv-mask").height()&&(e("down"),(0,s.default)(".arrow-up").css("opacity","1"))}),t.find("#quantity_wanted").TouchSpin({verticalbuttons:!0,verticalupclass:"material-icons touchspin-up",verticaldownclass:"material-icons touchspin-down",buttondown_class:"btn btn-touchspin js-touchspin",buttonup_class:"btn btn-touchspin js-touchspin",min:1,max:1e6})},e=function(t){var e=20,n=(0,s.default)(".js-qv-product-images"),i=(0,s.default)(".js-qv-product-images li img").height()+e,r=n.position().top;n.velocity({translateY:"up"===t?r+i:r-i},function(){n.position().top>=0?(0,s.default)(".arrow-up").css("opacity",".2"):n.position().top+n.height()<=(0,s.default)(".js-qv-mask").height()&&(0,s.default)(".arrow-down").css("opacity",".2")})};(0,s.default)("body").on("click","#search_filter_toggler",function(){(0,s.default)("#search_filters_wrapper").removeClass("hidden-md-down"),(0,s.default)("#content-wrapper").addClass("hidden-md-down"),(0,s.default)("#footer").addClass("hidden-md-down")}),(0,s.default)("#search_filter_controls .clear").on("click",function(){(0,s.default)("#search_filters_wrapper").addClass("hidden-md-down"),(0,s.default)("#content-wrapper").removeClass("hidden-md-down"),(0,s.default)("#footer").removeClass("hidden-md-down")}),(0,s.default)("#search_filter_controls .ok").on("click",function(){(0,s.default)("#search_filters_wrapper").addClass("hidden-md-down"),(0,s.default)("#content-wrapper").removeClass("hidden-md-down"),(0,s.default)("#footer").removeClass("hidden-md-down")});var n=function(t){if(void 0!==t.target.dataset.searchUrl)return t.target.dataset.searchUrl;if(void 0===(0,s.default)(t.target).parent()[0].dataset.searchUrl)throw new Error("Can not parse search URL");return(0,s.default)(t.target).parent()[0].dataset.searchUrl};(0,s.default)("body").on("change","#search_filters input[data-search-url]",function(t){u.default.emit("updateFacets",n(t))}),(0,s.default)("body").on("click",".js-search-filters-clear-all",function(t){u.default.emit("updateFacets",n(t))}),(0,s.default)("body").on("click",".js-search-link",function(t){t.preventDefault(),u.default.emit("updateFacets",(0,s.default)(t.target).closest("a").get(0).href)}),(0,s.default)("body").on("change","#search_filters select",function(t){var e=(0,s.default)(t.target).closest("form");u.default.emit("updateFacets","?"+e.serialize())}),u.default.on("updateProductList",function(t){r(t),window.scrollTo(0,0),o();var e=s.default.totalStorage("display");e&&"grid"!=e?display(e):(0,s.default)(".display").find("li#grid").addClass("selected")})})},function(t,e,n){var i,r;!function(t){"use strict";function e(t){var e=t.length,i=n.type(t);return"function"!==i&&!n.isWindow(t)&&(!(1!==t.nodeType||!e)||("array"===i||0===e||"number"==typeof e&&e>0&&e-1 in t))}if(!t.jQuery){var n=function(t,e){return new n.fn.init(t,e)};n.isWindow=function(t){return t&&t===t.window},n.type=function(t){return t?"object"==typeof t||"function"==typeof t?r[a.call(t)]||"object":typeof t:t+""},n.isArray=Array.isArray||function(t){return"array"===n.type(t)},n.isPlainObject=function(t){var e;if(!t||"object"!==n.type(t)||t.nodeType||n.isWindow(t))return!1;try{if(t.constructor&&!o.call(t,"constructor")&&!o.call(t.constructor.prototype,"isPrototypeOf"))return!1}catch(t){return!1}for(e in t);return void 0===e||o.call(t,e)},n.each=function(t,n,i){var r,o=0,a=t.length,s=e(t);if(i){if(s)for(;o<a&&(r=n.apply(t[o],i),r!==!1);o++);else for(o in t)if(t.hasOwnProperty(o)&&(r=n.apply(t[o],i),r===!1))break}else if(s)for(;o<a&&(r=n.call(t[o],o,t[o]),r!==!1);o++);else for(o in t)if(t.hasOwnProperty(o)&&(r=n.call(t[o],o,t[o]),r===!1))break;return t},n.data=function(t,e,r){if(void 0===r){var o=t[n.expando],a=o&&i[o];if(void 0===e)return a;if(a&&e in a)return a[e]}else if(void 0!==e){var s=t[n.expando]||(t[n.expando]=++n.uuid);return i[s]=i[s]||{},i[s][e]=r,r}},n.removeData=function(t,e){var r=t[n.expando],o=r&&i[r];o&&(e?n.each(e,function(t,e){delete o[e]}):delete i[r])},n.extend=function(){var t,e,i,r,o,a,s=arguments[0]||{},l=1,u=arguments.length,c=!1;for("boolean"==typeof s&&(c=s,s=arguments[l]||{},l++),"object"!=typeof s&&"function"!==n.type(s)&&(s={}),l===u&&(s=this,l--);l<u;l++)if(o=arguments[l])for(r in o)o.hasOwnProperty(r)&&(t=s[r],i=o[r],s!==i&&(c&&i&&(n.isPlainObject(i)||(e=n.isArray(i)))?(e?(e=!1,a=t&&n.isArray(t)?t:[]):a=t&&n.isPlainObject(t)?t:{},s[r]=n.extend(c,a,i)):void 0!==i&&(s[r]=i)));return s},n.queue=function(t,i,r){function o(t,n){var i=n||[];return t&&(e(Object(t))?!function(t,e){for(var n=+e.length,i=0,r=t.length;i<n;)t[r++]=e[i++];if(n!==n)for(;void 0!==e[i];)t[r++]=e[i++];return t.length=r,t}(i,"string"==typeof t?[t]:t):[].push.call(i,t)),i}if(t){i=(i||"fx")+"queue";var a=n.data(t,i);return r?(!a||n.isArray(r)?a=n.data(t,i,o(r)):a.push(r),a):a||[]}},n.dequeue=function(t,e){n.each(t.nodeType?[t]:t,function(t,i){e=e||"fx";var r=n.queue(i,e),o=r.shift();"inprogress"===o&&(o=r.shift()),o&&("fx"===e&&r.unshift("inprogress"),o.call(i,function(){n.dequeue(i,e)}))})},n.fn=n.prototype={init:function(t){if(t.nodeType)return this[0]=t,this;throw new Error("Not a DOM node.")},offset:function(){var e=this[0].getBoundingClientRect?this[0].getBoundingClientRect():{top:0,left:0};return{top:e.top+(t.pageYOffset||document.scrollTop||0)-(document.clientTop||0),left:e.left+(t.pageXOffset||document.scrollLeft||0)-(document.clientLeft||0)}},position:function(){function t(t){for(var e=t.offsetParent;e&&"html"!==e.nodeName.toLowerCase()&&e.style&&"static"===e.style.position;)e=e.offsetParent;return e||document}var e=this[0],i=t(e),r=this.offset(),o=/^(?:body|html)$/i.test(i.nodeName)?{top:0,left:0}:n(i).offset();return r.top-=parseFloat(e.style.marginTop)||0,r.left-=parseFloat(e.style.marginLeft)||0,i.style&&(o.top+=parseFloat(i.style.borderTopWidth)||0,o.left+=parseFloat(i.style.borderLeftWidth)||0),{top:r.top-o.top,left:r.left-o.left}}};var i={};n.expando="velocity"+(new Date).getTime(),n.uuid=0;for(var r={},o=r.hasOwnProperty,a=r.toString,s="Boolean Number String Function Array Date RegExp Object Error".split(" "),l=0;l<s.length;l++)r["[object "+s[l]+"]"]=s[l].toLowerCase();n.fn.init.prototype=n.fn,t.Velocity={Utilities:n}}}(window),function(o){"use strict";"object"==typeof t&&"object"==typeof t.exports?t.exports=o():(i=o,r="function"==typeof i?i.call(e,n,e,t):i,!(void 0!==r&&(t.exports=r)))}(function(){"use strict";return function(t,e,n,i){function r(t){for(var e=-1,n=t?t.length:0,i=[];++e<n;){var r=t[e];r&&i.push(r)}return i}function o(t){return _.isWrapped(t)?t=v.call(t):_.isNode(t)&&(t=[t]),t}function a(t){var e=h.data(t,"velocity");return null===e?i:e}function s(t,e){var n=a(t);n&&n.delayTimer&&!n.delayPaused&&(n.delayRemaining=n.delay-e+n.delayBegin,n.delayPaused=!0,clearTimeout(n.delayTimer.setTimeout))}function l(t,e){var n=a(t);n&&n.delayTimer&&n.delayPaused&&(n.delayPaused=!1,n.delayTimer.setTimeout=setTimeout(n.delayTimer.next,n.delayRemaining))}function u(t){return function(e){return Math.round(e*t)*(1/t)}}function c(t,n,i,r){function o(t,e){return 1-3*e+3*t}function a(t,e){return 3*e-6*t}function s(t){return 3*t}function l(t,e,n){return((o(e,n)*t+a(e,n))*t+s(e))*t}function u(t,e,n){return 3*o(e,n)*t*t+2*a(e,n)*t+s(e)}function c(e,n){for(var r=0;r<m;++r){var o=u(n,t,i);if(0===o)return n;var a=l(n,t,i)-e;n-=a/o}return n}function f(){for(var e=0;e<b;++e)w[e]=l(e*_,t,i)}function d(e,n,r){var o,a,s=0;do a=n+(r-n)/2,o=l(a,t,i)-e,o>0?r=a:n=a;while(Math.abs(o)>y&&++s<v);return a}function p(e){for(var n=0,r=1,o=b-1;r!==o&&w[r]<=e;++r)n+=_;--r;var a=(e-w[r])/(w[r+1]-w[r]),s=n+a*_,l=u(s,t,i);return l>=g?c(e,s):0===l?s:d(e,n,n+_)}function h(){E=!0,t===n&&i===r||f()}var m=4,g=.001,y=1e-7,v=10,b=11,_=1/(b-1),x="Float32Array"in e;if(4!==arguments.length)return!1;for(var S=0;S<4;++S)if("number"!=typeof arguments[S]||isNaN(arguments[S])||!isFinite(arguments[S]))return!1;t=Math.min(t,1),i=Math.min(i,1),t=Math.max(t,0),i=Math.max(i,0);var w=x?new Float32Array(b):new Array(b),E=!1,C=function(e){return E||h(),t===n&&i===r?e:0===e?0:1===e?1:l(p(e),n,r)};C.getControlPoints=function(){return[{x:t,y:n},{x:i,y:r}]};var T="generateBezier("+[t,n,i,r]+")";return C.toString=function(){return T},C}function f(t,e){var n=t;return _.isString(t)?E.Easings[t]||(n=!1):n=_.isArray(t)&&1===t.length?u.apply(null,t):_.isArray(t)&&2===t.length?C.apply(null,t.concat([e])):!(!_.isArray(t)||4!==t.length)&&c.apply(null,t),n===!1&&(n=E.Easings[E.defaults.easing]?E.defaults.easing:w),n}function d(t){if(t){var e=E.timestamp&&t!==!0?t:y.now(),n=E.State.calls.length;n>1e4&&(E.State.calls=r(E.State.calls),n=E.State.calls.length);for(var o=0;o<n;o++)if(E.State.calls[o]){var s=E.State.calls[o],l=s[0],u=s[2],c=s[3],f=!!c,g=null,v=s[5],b=s[6];if(c||(c=E.State.calls[o][3]=e-16),v){if(v.resume!==!0)continue;c=s[3]=Math.round(e-b-16),s[5]=null}b=s[6]=e-c;for(var x=Math.min(b/u.duration,1),S=0,w=l.length;S<w;S++){var C=l[S],A=C.element;if(a(A)){var O=!1;if(u.display!==i&&null!==u.display&&"none"!==u.display){if("flex"===u.display){var k=["-webkit-box","-moz-box","-ms-flexbox","-webkit-flex"];h.each(k,function(t,e){T.setPropertyValue(A,"display",e)})}T.setPropertyValue(A,"display",u.display)}u.visibility!==i&&"hidden"!==u.visibility&&T.setPropertyValue(A,"visibility",u.visibility);for(var D in C)if(C.hasOwnProperty(D)&&"element"!==D){var N,P=C[D],L=_.isString(P.easing)?E.Easings[P.easing]:P.easing;if(_.isString(P.pattern)){var j=1===x?function(t,e,n){var i=P.endValue[e];return n?Math.round(i):i}:function(t,e,n){var i=P.startValue[e],r=P.endValue[e]-i,o=i+r*L(x,u,r);return n?Math.round(o):o};N=P.pattern.replace(/{(\d+)(!)?}/g,j)}else if(1===x)N=P.endValue;else{var B=P.endValue-P.startValue;N=P.startValue+B*L(x,u,B)}if(!f&&N===P.currentValue)continue;if(P.currentValue=N,"tween"===D)g=N;else{var V;if(T.Hooks.registered[D]){V=T.Hooks.getRoot(D);var F=a(A).rootPropertyValueCache[V];F&&(P.rootPropertyValue=F)}var R=T.setPropertyValue(A,D,P.currentValue+(m<9&&0===parseFloat(N)?"":P.unitType),P.rootPropertyValue,P.scrollData);T.Hooks.registered[D]&&(T.Normalizations.registered[V]?a(A).rootPropertyValueCache[V]=T.Normalizations.registered[V]("extract",null,R[1]):a(A).rootPropertyValueCache[V]=R[1]),"transform"===R[0]&&(O=!0)}}u.mobileHA&&a(A).transformCache.translate3d===i&&(a(A).transformCache.translate3d="(0px, 0px, 0px)",O=!0),O&&T.flushTransformCache(A)}}u.display!==i&&"none"!==u.display&&(E.State.calls[o][2].display=!1),u.visibility!==i&&"hidden"!==u.visibility&&(E.State.calls[o][2].visibility=!1),u.progress&&u.progress.call(s[1],s[1],x,Math.max(0,c+u.duration-e),c,g),1===x&&p(o)}}E.State.isTicking&&I(d)}function p(t,e){if(!E.State.calls[t])return!1;for(var n=E.State.calls[t][0],r=E.State.calls[t][1],o=E.State.calls[t][2],s=E.State.calls[t][4],l=!1,u=0,c=n.length;u<c;u++){var f=n[u].element;e||o.loop||("none"===o.display&&T.setPropertyValue(f,"display",o.display),"hidden"===o.visibility&&T.setPropertyValue(f,"visibility",o.visibility));var d=a(f);if(o.loop!==!0&&(h.queue(f)[1]===i||!/\.velocityQueueEntryFlag/i.test(h.queue(f)[1]))&&d){d.isAnimating=!1,d.rootPropertyValueCache={};var p=!1;h.each(T.Lists.transforms3D,function(t,e){var n=/^scale/.test(e)?1:0,r=d.transformCache[e];d.transformCache[e]!==i&&new RegExp("^\\("+n+"[^.]").test(r)&&(p=!0,delete d.transformCache[e])}),o.mobileHA&&(p=!0,delete d.transformCache.translate3d),p&&T.flushTransformCache(f),T.Values.removeClass(f,"velocity-animating")}if(!e&&o.complete&&!o.loop&&u===c-1)try{o.complete.call(r,r)}catch(t){setTimeout(function(){throw t},1)}s&&o.loop!==!0&&s(r),d&&o.loop===!0&&!e&&(h.each(d.tweensContainer,function(t,e){if(/^rotate/.test(t)&&(parseFloat(e.startValue)-parseFloat(e.endValue))%360===0){var n=e.startValue;e.startValue=e.endValue,e.endValue=n}/^backgroundPosition/.test(t)&&100===parseFloat(e.endValue)&&"%"===e.unitType&&(e.endValue=0,e.startValue=100)}),E(f,"reverse",{loop:!0,delay:o.delay})),o.queue!==!1&&h.dequeue(f,o.queue)}E.State.calls[t]=!1;for(var m=0,g=E.State.calls.length;m<g;m++)if(E.State.calls[m]!==!1){l=!0;break}l===!1&&(E.State.isTicking=!1,delete E.State.calls,E.State.calls=[])}var h,m=function(){if(n.documentMode)return n.documentMode;for(var t=7;t>4;t--){var e=n.createElement("div");if(e.innerHTML="<!--[if IE "+t+"]><span></span><![endif]-->",e.getElementsByTagName("span").length)return e=null,t}return i}(),g=function(){var t=0;return e.webkitRequestAnimationFrame||e.mozRequestAnimationFrame||function(e){var n,i=(new Date).getTime();return n=Math.max(0,16-(i-t)),t=i+n,setTimeout(function(){e(i+n)},n)}}(),y=function(){var t=e.performance||{};if("function"!=typeof t.now){var n=t.timing&&t.timing.navigationStart?t.timing.navigationStart:(new Date).getTime();t.now=function(){return(new Date).getTime()-n}}return t}(),v=function(){var t=Array.prototype.slice;try{return t.call(n.documentElement),t}catch(e){return function(e,n){var i=this.length;if("number"!=typeof e&&(e=0),"number"!=typeof n&&(n=i),this.slice)return t.call(this,e,n);var r,o=[],a=e>=0?e:Math.max(0,i+e),s=n<0?i+n:Math.min(n,i),l=s-a;if(l>0)if(o=new Array(l),this.charAt)for(r=0;r<l;r++)o[r]=this.charAt(a+r);else for(r=0;r<l;r++)o[r]=this[a+r];return o}}}(),b=function(){return Array.prototype.includes?function(t,e){return t.includes(e)}:Array.prototype.indexOf?function(t,e){return t.indexOf(e)>=0}:function(t,e){for(var n=0;n<t.length;n++)if(t[n]===e)return!0;return!1}},_={isNumber:function(t){return"number"==typeof t},isString:function(t){return"string"==typeof t},isArray:Array.isArray||function(t){return"[object Array]"===Object.prototype.toString.call(t)},isFunction:function(t){return"[object Function]"===Object.prototype.toString.call(t)},isNode:function(t){return t&&t.nodeType},isWrapped:function(t){return t&&t!==e&&_.isNumber(t.length)&&!_.isString(t)&&!_.isFunction(t)&&!_.isNode(t)&&(0===t.length||_.isNode(t[0]))},isSVG:function(t){return e.SVGElement&&t instanceof e.SVGElement},isEmptyObject:function(t){for(var e in t)if(t.hasOwnProperty(e))return!1;return!0}},x=!1;if(t.fn&&t.fn.jquery?(h=t,x=!0):h=e.Velocity.Utilities,m<=8&&!x)throw new Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");if(m<=7)return void(jQuery.fn.velocity=jQuery.fn.animate);var S=400,w="swing",E={State:{isMobile:/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),isAndroid:/Android/i.test(navigator.userAgent),isGingerbread:/Android 2\.3\.[3-7]/i.test(navigator.userAgent),isChrome:e.chrome,isFirefox:/Firefox/i.test(navigator.userAgent),prefixElement:n.createElement("div"),prefixMatches:{},scrollAnchor:null,scrollPropertyLeft:null,scrollPropertyTop:null,isTicking:!1,calls:[],delayedElements:{count:0}},CSS:{},Utilities:h,Redirects:{},Easings:{},Promise:e.Promise,defaults:{queue:"",duration:S,easing:w,begin:i,complete:i,progress:i,display:i,visibility:i,loop:!1,delay:!1,mobileHA:!0,_cacheValues:!0,promiseRejectEmpty:!0},init:function(t){h.data(t,"velocity",{isSVG:_.isSVG(t),isAnimating:!1,computedStyle:null,tweensContainer:null,rootPropertyValueCache:{},transformCache:{}})},hook:null,mock:!1,version:{major:1,minor:5,patch:0},debug:!1,timestamp:!0,pauseAll:function(t){var e=(new Date).getTime();h.each(E.State.calls,function(e,n){if(n){if(t!==i&&(n[2].queue!==t||n[2].queue===!1))return!0;n[5]={resume:!1}}}),h.each(E.State.delayedElements,function(t,n){n&&s(n,e)})},resumeAll:function(t){var e=(new Date).getTime();h.each(E.State.calls,function(e,n){if(n){if(t!==i&&(n[2].queue!==t||n[2].queue===!1))return!0;n[5]&&(n[5].resume=!0)}}),h.each(E.State.delayedElements,function(t,n){n&&l(n,e)})}};e.pageYOffset!==i?(E.State.scrollAnchor=e,E.State.scrollPropertyLeft="pageXOffset",E.State.scrollPropertyTop="pageYOffset"):(E.State.scrollAnchor=n.documentElement||n.body.parentNode||n.body,E.State.scrollPropertyLeft="scrollLeft",E.State.scrollPropertyTop="scrollTop");var C=function(){function t(t){return-t.tension*t.x-t.friction*t.v}function e(e,n,i){var r={x:e.x+i.dx*n,v:e.v+i.dv*n,tension:e.tension,friction:e.friction};return{dx:r.v,dv:t(r)}}function n(n,i){var r={dx:n.v,dv:t(n)},o=e(n,.5*i,r),a=e(n,.5*i,o),s=e(n,i,a),l=1/6*(r.dx+2*(o.dx+a.dx)+s.dx),u=1/6*(r.dv+2*(o.dv+a.dv)+s.dv);return n.x=n.x+l*i,n.v=n.v+u*i,n}return function t(e,i,r){var o,a,s,l={x:-1,v:0,tension:null,friction:null},u=[0],c=0,f=1e-4,d=.016;for(e=parseFloat(e)||500,i=parseFloat(i)||20,r=r||null,l.tension=e,l.friction=i,o=null!==r,o?(c=t(e,i),a=c/r*d):a=d;;)if(s=n(s||l,a),u.push(1+s.x),c+=16,!(Math.abs(s.x)>f&&Math.abs(s.v)>f))break;return o?function(t){return u[t*(u.length-1)|0]}:c}}();E.Easings={linear:function(t){return t},swing:function(t){return.5-Math.cos(t*Math.PI)/2},spring:function(t){return 1-Math.cos(4.5*t*Math.PI)*Math.exp(6*-t)}},h.each([["ease",[.25,.1,.25,1]],["ease-in",[.42,0,1,1]],["ease-out",[0,0,.58,1]],["ease-in-out",[.42,0,.58,1]],["easeInSine",[.47,0,.745,.715]],["easeOutSine",[.39,.575,.565,1]],["easeInOutSine",[.445,.05,.55,.95]],["easeInQuad",[.55,.085,.68,.53]],["easeOutQuad",[.25,.46,.45,.94]],["easeInOutQuad",[.455,.03,.515,.955]],["easeInCubic",[.55,.055,.675,.19]],["easeOutCubic",[.215,.61,.355,1]],["easeInOutCubic",[.645,.045,.355,1]],["easeInQuart",[.895,.03,.685,.22]],["easeOutQuart",[.165,.84,.44,1]],["easeInOutQuart",[.77,0,.175,1]],["easeInQuint",[.755,.05,.855,.06]],["easeOutQuint",[.23,1,.32,1]],["easeInOutQuint",[.86,0,.07,1]],["easeInExpo",[.95,.05,.795,.035]],["easeOutExpo",[.19,1,.22,1]],["easeInOutExpo",[1,0,0,1]],["easeInCirc",[.6,.04,.98,.335]],["easeOutCirc",[.075,.82,.165,1]],["easeInOutCirc",[.785,.135,.15,.86]]],function(t,e){E.Easings[e[0]]=c.apply(null,e[1])});var T=E.CSS={RegEx:{isHex:/^#([A-f\d]{3}){1,2}$/i,valueUnwrap:/^[A-z]+\((.*)\)$/i,wrappedValueAlreadyExtracted:/[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,valueSplit:/([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi},Lists:{colors:["fill","stroke","stopColor","color","backgroundColor","borderColor","borderTopColor","borderRightColor","borderBottomColor","borderLeftColor","outlineColor"],transformsBase:["translateX","translateY","scale","scaleX","scaleY","skewX","skewY","rotateZ"],transforms3D:["transformPerspective","translateZ","scaleZ","rotateX","rotateY"],units:["%","em","ex","ch","rem","vw","vh","vmin","vmax","cm","mm","Q","in","pc","pt","px","deg","grad","rad","turn","s","ms"],colorNames:{aliceblue:"240,248,255",antiquewhite:"250,235,215",aquamarine:"127,255,212",aqua:"0,255,255",azure:"240,255,255",beige:"245,245,220",bisque:"255,228,196",black:"0,0,0",blanchedalmond:"255,235,205",blueviolet:"138,43,226",blue:"0,0,255",brown:"165,42,42",burlywood:"222,184,135",cadetblue:"95,158,160",chartreuse:"127,255,0",chocolate:"210,105,30",coral:"255,127,80",cornflowerblue:"100,149,237",cornsilk:"255,248,220",crimson:"220,20,60",cyan:"0,255,255",darkblue:"0,0,139",darkcyan:"0,139,139",darkgoldenrod:"184,134,11",darkgray:"169,169,169",darkgrey:"169,169,169",darkgreen:"0,100,0",darkkhaki:"189,183,107",darkmagenta:"139,0,139",darkolivegreen:"85,107,47",darkorange:"255,140,0",darkorchid:"153,50,204",darkred:"139,0,0",darksalmon:"233,150,122",darkseagreen:"143,188,143",darkslateblue:"72,61,139",darkslategray:"47,79,79",darkturquoise:"0,206,209",darkviolet:"148,0,211",deeppink:"255,20,147",deepskyblue:"0,191,255",dimgray:"105,105,105",dimgrey:"105,105,105",dodgerblue:"30,144,255",firebrick:"178,34,34",floralwhite:"255,250,240",forestgreen:"34,139,34",fuchsia:"255,0,255",gainsboro:"220,220,220",ghostwhite:"248,248,255",gold:"255,215,0",goldenrod:"218,165,32",gray:"128,128,128",grey:"128,128,128",greenyellow:"173,255,47",green:"0,128,0",honeydew:"240,255,240",hotpink:"255,105,180",indianred:"205,92,92",indigo:"75,0,130",ivory:"255,255,240",khaki:"240,230,140",lavenderblush:"255,240,245",lavender:"230,230,250",lawngreen:"124,252,0",lemonchiffon:"255,250,205",lightblue:"173,216,230",lightcoral:"240,128,128",lightcyan:"224,255,255",lightgoldenrodyellow:"250,250,210",lightgray:"211,211,211",lightgrey:"211,211,211",lightgreen:"144,238,144",lightpink:"255,182,193",lightsalmon:"255,160,122",lightseagreen:"32,178,170",lightskyblue:"135,206,250",lightslategray:"119,136,153",lightsteelblue:"176,196,222",lightyellow:"255,255,224",limegreen:"50,205,50",lime:"0,255,0",linen:"250,240,230",magenta:"255,0,255",maroon:"128,0,0",mediumaquamarine:"102,205,170",mediumblue:"0,0,205",mediumorchid:"186,85,211",mediumpurple:"147,112,219",mediumseagreen:"60,179,113",mediumslateblue:"123,104,238",mediumspringgreen:"0,250,154",mediumturquoise:"72,209,204",mediumvioletred:"199,21,133",midnightblue:"25,25,112",mintcream:"245,255,250",mistyrose:"255,228,225",moccasin:"255,228,181",navajowhite:"255,222,173",navy:"0,0,128",oldlace:"253,245,230",olivedrab:"107,142,35",olive:"128,128,0",orangered:"255,69,0",orange:"255,165,0",orchid:"218,112,214",palegoldenrod:"238,232,170",palegreen:"152,251,152",paleturquoise:"175,238,238",palevioletred:"219,112,147",papayawhip:"255,239,213",peachpuff:"255,218,185",peru:"205,133,63",pink:"255,192,203",plum:"221,160,221",powderblue:"176,224,230",purple:"128,0,128",red:"255,0,0",rosybrown:"188,143,143",royalblue:"65,105,225",saddlebrown:"139,69,19",salmon:"250,128,114",sandybrown:"244,164,96",seagreen:"46,139,87",seashell:"255,245,238",sienna:"160,82,45",silver:"192,192,192",skyblue:"135,206,235",slateblue:"106,90,205",slategray:"112,128,144",snow:"255,250,250",springgreen:"0,255,127",steelblue:"70,130,180",tan:"210,180,140",teal:"0,128,128",thistle:"216,191,216",tomato:"255,99,71",turquoise:"64,224,208",violet:"238,130,238",wheat:"245,222,179",whitesmoke:"245,245,245",white:"255,255,255",yellowgreen:"154,205,50",yellow:"255,255,0"}},Hooks:{templates:{textShadow:["Color X Y Blur","black 0px 0px 0px"],boxShadow:["Color X Y Blur Spread","black 0px 0px 0px 0px"],clip:["Top Right Bottom Left","0px 0px 0px 0px"],backgroundPosition:["X Y","0% 0%"],transformOrigin:["X Y Z","50% 50% 0px"],perspectiveOrigin:["X Y","50% 50%"]},registered:{},register:function(){for(var t=0;t<T.Lists.colors.length;t++){var e="color"===T.Lists.colors[t]?"0 0 0 1":"255 255 255 1";T.Hooks.templates[T.Lists.colors[t]]=["Red Green Blue Alpha",e]}var n,i,r;if(m)for(n in T.Hooks.templates)if(T.Hooks.templates.hasOwnProperty(n)){i=T.Hooks.templates[n],r=i[0].split(" ");var o=i[1].match(T.RegEx.valueSplit);"Color"===r[0]&&(r.push(r.shift()),o.push(o.shift()),T.Hooks.templates[n]=[r.join(" "),o.join(" ")])}for(n in T.Hooks.templates)if(T.Hooks.templates.hasOwnProperty(n)){i=T.Hooks.templates[n],r=i[0].split(" ");for(var a in r)if(r.hasOwnProperty(a)){var s=n+r[a],l=a;T.Hooks.registered[s]=[n,l]}}},getRoot:function(t){var e=T.Hooks.registered[t];return e?e[0]:t},getUnit:function(t,e){var n=(t.substr(e||0,5).match(/^[a-z%]+/)||[])[0]||"";return n&&b(T.Lists.units,n)?n:""},fixColors:function(t){return t.replace(/(rgba?\(\s*)?(\b[a-z]+\b)/g,function(t,e,n){return T.Lists.colorNames.hasOwnProperty(n)?(e?e:"rgba(")+T.Lists.colorNames[n]+(e?"":",1)"):e+n})},cleanRootPropertyValue:function(t,e){return T.RegEx.valueUnwrap.test(e)&&(e=e.match(T.RegEx.valueUnwrap)[1]),T.Values.isCSSNullValue(e)&&(e=T.Hooks.templates[t][1]),e},extractValue:function(t,e){var n=T.Hooks.registered[t];if(n){var i=n[0],r=n[1];return e=T.Hooks.cleanRootPropertyValue(i,e),e.toString().match(T.RegEx.valueSplit)[r]}return e},injectValue:function(t,e,n){var i=T.Hooks.registered[t];if(i){var r,o,a=i[0],s=i[1];return n=T.Hooks.cleanRootPropertyValue(a,n),r=n.toString().match(T.RegEx.valueSplit),r[s]=e,o=r.join(" ")}return n}},Normalizations:{registered:{clip:function(t,e,n){switch(t){case"name":return"clip";case"extract":var i;return T.RegEx.wrappedValueAlreadyExtracted.test(n)?i=n:(i=n.toString().match(T.RegEx.valueUnwrap),i=i?i[1].replace(/,(\s+)?/g," "):n),i;case"inject":return"rect("+n+")"}},blur:function(t,e,n){switch(t){case"name":return E.State.isFirefox?"filter":"-webkit-filter";case"extract":var i=parseFloat(n);if(!i&&0!==i){var r=n.toString().match(/blur\(([0-9]+[A-z]+)\)/i);i=r?r[1]:0}return i;case"inject":return parseFloat(n)?"blur("+n+")":"none"}},opacity:function(t,e,n){if(m<=8)switch(t){case"name":return"filter";case"extract":var i=n.toString().match(/alpha\(opacity=(.*)\)/i);return n=i?i[1]/100:1;case"inject":return e.style.zoom=1,parseFloat(n)>=1?"":"alpha(opacity="+parseInt(100*parseFloat(n),10)+")"}else switch(t){case"name":return"opacity";case"extract":return n;case"inject":return n}}},register:function(){function t(t,e,n){var i="border-box"===T.getPropertyValue(e,"boxSizing").toString().toLowerCase();if(i===(n||!1)){var r,o,a=0,s="width"===t?["Left","Right"]:["Top","Bottom"],l=["padding"+s[0],"padding"+s[1],"border"+s[0]+"Width","border"+s[1]+"Width"];for(r=0;r<l.length;r++)o=parseFloat(T.getPropertyValue(e,l[r])),isNaN(o)||(a+=o);return n?-a:a}return 0}function e(e,n){return function(i,r,o){switch(i){case"name":return e;case"extract":return parseFloat(o)+t(e,r,n);case"inject":return parseFloat(o)-t(e,r,n)+"px"}}}m&&!(m>9)||E.State.isGingerbread||(T.Lists.transformsBase=T.Lists.transformsBase.concat(T.Lists.transforms3D));for(var n=0;n<T.Lists.transformsBase.length;n++)!function(){var t=T.Lists.transformsBase[n];T.Normalizations.registered[t]=function(e,n,r){switch(e){case"name":return"transform";case"extract":return a(n)===i||a(n).transformCache[t]===i?/^scale/i.test(t)?1:0:a(n).transformCache[t].replace(/[()]/g,"");case"inject":var o=!1;switch(t.substr(0,t.length-1)){case"translate":o=!/(%|px|em|rem|vw|vh|\d)$/i.test(r);break;case"scal":case"scale":E.State.isAndroid&&a(n).transformCache[t]===i&&r<1&&(r=1),o=!/(\d)$/i.test(r);break;case"skew":o=!/(deg|\d)$/i.test(r);break;case"rotate":o=!/(deg|\d)$/i.test(r)}return o||(a(n).transformCache[t]="("+r+")"),a(n).transformCache[t]}}}();for(var r=0;r<T.Lists.colors.length;r++)!function(){var t=T.Lists.colors[r];T.Normalizations.registered[t]=function(e,n,r){switch(e){case"name":return t;case"extract":var o;if(T.RegEx.wrappedValueAlreadyExtracted.test(r))o=r;else{var a,s={black:"rgb(0, 0, 0)",blue:"rgb(0, 0, 255)",gray:"rgb(128, 128, 128)",green:"rgb(0, 128, 0)",red:"rgb(255, 0, 0)",white:"rgb(255, 255, 255)"};/^[A-z]+$/i.test(r)?a=s[r]!==i?s[r]:s.black:T.RegEx.isHex.test(r)?a="rgb("+T.Values.hexToRgb(r).join(" ")+")":/^rgba?\(/i.test(r)||(a=s.black),o=(a||r).toString().match(T.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g," ")}return(!m||m>8)&&3===o.split(" ").length&&(o+=" 1"),o;case"inject":return/^rgb/.test(r)?r:(m<=8?4===r.split(" ").length&&(r=r.split(/\s+/).slice(0,3).join(" ")):3===r.split(" ").length&&(r+=" 1"),(m<=8?"rgb":"rgba")+"("+r.replace(/\s+/g,",").replace(/\.(\d)+(?=,)/g,"")+")")}}}();T.Normalizations.registered.innerWidth=e("width",!0),T.Normalizations.registered.innerHeight=e("height",!0),T.Normalizations.registered.outerWidth=e("width"),T.Normalizations.registered.outerHeight=e("height")}},Names:{camelCase:function(t){return t.replace(/-(\w)/g,function(t,e){return e.toUpperCase()})},SVGAttribute:function(t){var e="width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";return(m||E.State.isAndroid&&!E.State.isChrome)&&(e+="|transform"),new RegExp("^("+e+")$","i").test(t)},prefixCheck:function(t){if(E.State.prefixMatches[t])return[E.State.prefixMatches[t],!0];for(var e=["","Webkit","Moz","ms","O"],n=0,i=e.length;n<i;n++){var r;if(r=0===n?t:e[n]+t.replace(/^\w/,function(t){return t.toUpperCase()}),_.isString(E.State.prefixElement.style[r]))return E.State.prefixMatches[t]=r,[r,!0]}return[t,!1]}},Values:{hexToRgb:function(t){var e,n=/^#?([a-f\d])([a-f\d])([a-f\d])$/i,i=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i;return t=t.replace(n,function(t,e,n,i){return e+e+n+n+i+i}),e=i.exec(t),e?[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]:[0,0,0]},isCSSNullValue:function(t){return!t||/^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(t)},getUnitType:function(t){return/^(rotate|skew)/i.test(t)?"deg":/(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(t)?"":"px"},getDisplayType:function(t){var e=t&&t.tagName.toString().toLowerCase();return/^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(e)?"inline":/^(li)$/i.test(e)?"list-item":/^(tr)$/i.test(e)?"table-row":/^(table)$/i.test(e)?"table":/^(tbody)$/i.test(e)?"table-row-group":"block"},addClass:function(t,e){if(t)if(t.classList)t.classList.add(e);else if(_.isString(t.className))t.className+=(t.className.length?" ":"")+e;else{
var n=t.getAttribute(m<=7?"className":"class")||"";t.setAttribute("class",n+(n?" ":"")+e)}},removeClass:function(t,e){if(t)if(t.classList)t.classList.remove(e);else if(_.isString(t.className))t.className=t.className.toString().replace(new RegExp("(^|\\s)"+e.split(" ").join("|")+"(\\s|$)","gi")," ");else{var n=t.getAttribute(m<=7?"className":"class")||"";t.setAttribute("class",n.replace(new RegExp("(^|s)"+e.split(" ").join("|")+"(s|$)","gi")," "))}}},getPropertyValue:function(t,n,r,o){function s(t,n){var r=0;if(m<=8)r=h.css(t,n);else{var l=!1;/^(width|height)$/.test(n)&&0===T.getPropertyValue(t,"display")&&(l=!0,T.setPropertyValue(t,"display",T.Values.getDisplayType(t)));var u=function(){l&&T.setPropertyValue(t,"display","none")};if(!o){if("height"===n&&"border-box"!==T.getPropertyValue(t,"boxSizing").toString().toLowerCase()){var c=t.offsetHeight-(parseFloat(T.getPropertyValue(t,"borderTopWidth"))||0)-(parseFloat(T.getPropertyValue(t,"borderBottomWidth"))||0)-(parseFloat(T.getPropertyValue(t,"paddingTop"))||0)-(parseFloat(T.getPropertyValue(t,"paddingBottom"))||0);return u(),c}if("width"===n&&"border-box"!==T.getPropertyValue(t,"boxSizing").toString().toLowerCase()){var f=t.offsetWidth-(parseFloat(T.getPropertyValue(t,"borderLeftWidth"))||0)-(parseFloat(T.getPropertyValue(t,"borderRightWidth"))||0)-(parseFloat(T.getPropertyValue(t,"paddingLeft"))||0)-(parseFloat(T.getPropertyValue(t,"paddingRight"))||0);return u(),f}}var d;d=a(t)===i?e.getComputedStyle(t,null):a(t).computedStyle?a(t).computedStyle:a(t).computedStyle=e.getComputedStyle(t,null),"borderColor"===n&&(n="borderTopColor"),r=9===m&&"filter"===n?d.getPropertyValue(n):d[n],""!==r&&null!==r||(r=t.style[n]),u()}if("auto"===r&&/^(top|right|bottom|left)$/i.test(n)){var p=s(t,"position");("fixed"===p||"absolute"===p&&/top|left/i.test(n))&&(r=h(t).position()[n]+"px")}return r}var l;if(T.Hooks.registered[n]){var u=n,c=T.Hooks.getRoot(u);r===i&&(r=T.getPropertyValue(t,T.Names.prefixCheck(c)[0])),T.Normalizations.registered[c]&&(r=T.Normalizations.registered[c]("extract",t,r)),l=T.Hooks.extractValue(u,r)}else if(T.Normalizations.registered[n]){var f,d;f=T.Normalizations.registered[n]("name",t),"transform"!==f&&(d=s(t,T.Names.prefixCheck(f)[0]),T.Values.isCSSNullValue(d)&&T.Hooks.templates[n]&&(d=T.Hooks.templates[n][1])),l=T.Normalizations.registered[n]("extract",t,d)}if(!/^[\d-]/.test(l)){var p=a(t);if(p&&p.isSVG&&T.Names.SVGAttribute(n))if(/^(height|width)$/i.test(n))try{l=t.getBBox()[n]}catch(t){l=0}else l=t.getAttribute(n);else l=s(t,T.Names.prefixCheck(n)[0])}return T.Values.isCSSNullValue(l)&&(l=0),E.debug>=2,l},setPropertyValue:function(t,n,i,r,o){var s=n;if("scroll"===n)o.container?o.container["scroll"+o.direction]=i:"Left"===o.direction?e.scrollTo(i,o.alternateValue):e.scrollTo(o.alternateValue,i);else if(T.Normalizations.registered[n]&&"transform"===T.Normalizations.registered[n]("name",t))T.Normalizations.registered[n]("inject",t,i),s="transform",i=a(t).transformCache[n];else{if(T.Hooks.registered[n]){var l=n,u=T.Hooks.getRoot(n);r=r||T.getPropertyValue(t,u),i=T.Hooks.injectValue(l,i,r),n=u}if(T.Normalizations.registered[n]&&(i=T.Normalizations.registered[n]("inject",t,i),n=T.Normalizations.registered[n]("name",t)),s=T.Names.prefixCheck(n)[0],m<=8)try{t.style[s]=i}catch(t){E.debug}else{var c=a(t);c&&c.isSVG&&T.Names.SVGAttribute(n)?t.setAttribute(n,i):t.style[s]=i}E.debug>=2}return[s,i]},flushTransformCache:function(t){var e="",n=a(t);if((m||E.State.isAndroid&&!E.State.isChrome)&&n&&n.isSVG){var i=function(e){return parseFloat(T.getPropertyValue(t,e))},r={translate:[i("translateX"),i("translateY")],skewX:[i("skewX")],skewY:[i("skewY")],scale:1!==i("scale")?[i("scale"),i("scale")]:[i("scaleX"),i("scaleY")],rotate:[i("rotateZ"),0,0]};h.each(a(t).transformCache,function(t){/^translate/i.test(t)?t="translate":/^scale/i.test(t)?t="scale":/^rotate/i.test(t)&&(t="rotate"),r[t]&&(e+=t+"("+r[t].join(" ")+") ",delete r[t])})}else{var o,s;h.each(a(t).transformCache,function(n){return o=a(t).transformCache[n],"transformPerspective"===n?(s=o,!0):(9===m&&"rotateZ"===n&&(n="rotate"),void(e+=n+o+" "))}),s&&(e="perspective"+s+" "+e)}T.setPropertyValue(t,"transform",e)}};T.Hooks.register(),T.Normalizations.register(),E.hook=function(t,e,n){var r;return t=o(t),h.each(t,function(t,o){if(a(o)===i&&E.init(o),n===i)r===i&&(r=T.getPropertyValue(o,e));else{var s=T.setPropertyValue(o,e,n);"transform"===s[0]&&E.CSS.flushTransformCache(o),r=s}}),r};var A=function(){function t(){return c?C.promise||null:m}function r(t,r){function o(o){var c,p;if(l.begin&&0===O)try{l.begin.call(y,y)}catch(t){setTimeout(function(){throw t},1)}if("scroll"===N){var m,g,S,w=/^x$/i.test(l.axis)?"Left":"Top",A=parseFloat(l.offset)||0;l.container?_.isWrapped(l.container)||_.isNode(l.container)?(l.container=l.container[0]||l.container,m=l.container["scroll"+w],S=m+h(t).position()[w.toLowerCase()]+A):l.container=null:(m=E.State.scrollAnchor[E.State["scrollProperty"+w]],g=E.State.scrollAnchor[E.State["scrollProperty"+("Left"===w?"Top":"Left")]],S=h(t).offset()[w.toLowerCase()]+A),u={scroll:{rootPropertyValue:!1,startValue:m,currentValue:m,endValue:S,unitType:"",easing:l.easing,scrollData:{container:l.container,direction:w,alternateValue:g}},element:t},E.debug}else if("reverse"===N){if(c=a(t),!c)return;if(!c.tweensContainer)return void h.dequeue(t,l.queue);"none"===c.opts.display&&(c.opts.display="auto"),"hidden"===c.opts.visibility&&(c.opts.visibility="visible"),c.opts.loop=!1,c.opts.begin=null,c.opts.complete=null,x.easing||delete l.easing,x.duration||delete l.duration,l=h.extend({},c.opts,l),p=h.extend(!0,{},c?c.tweensContainer:null);for(var k in p)if(p.hasOwnProperty(k)&&"element"!==k){var D=p[k].startValue;p[k].startValue=p[k].currentValue=p[k].endValue,p[k].endValue=D,_.isEmptyObject(x)||(p[k].easing=l.easing),E.debug}u=p}else if("start"===N){c=a(t),c&&c.tweensContainer&&c.isAnimating===!0&&(p=c.tweensContainer);var P=function(e,n){var i,o,a;return _.isFunction(e)&&(e=e.call(t,r,I)),_.isArray(e)?(i=e[0],!_.isArray(e[1])&&/^[\d-]/.test(e[1])||_.isFunction(e[1])||T.RegEx.isHex.test(e[1])?a=e[1]:_.isString(e[1])&&!T.RegEx.isHex.test(e[1])&&E.Easings[e[1]]||_.isArray(e[1])?(o=n?e[1]:f(e[1],l.duration),a=e[2]):a=e[1]||e[2]):i=e,n||(o=o||l.easing),_.isFunction(i)&&(i=i.call(t,r,I)),_.isFunction(a)&&(a=a.call(t,r,I)),[i||0,o,a]},L=function(r,o){var a,f=T.Hooks.getRoot(r),d=!1,m=o[0],g=o[1],y=o[2];if(!(c&&c.isSVG||"tween"===f||T.Names.prefixCheck(f)[1]!==!1||T.Normalizations.registered[f]!==i))return void E.debug;(l.display!==i&&null!==l.display&&"none"!==l.display||l.visibility!==i&&"hidden"!==l.visibility)&&/opacity|filter/.test(r)&&!y&&0!==m&&(y=0),l._cacheValues&&p&&p[r]?(y===i&&(y=p[r].endValue+p[r].unitType),d=c.rootPropertyValueCache[f]):T.Hooks.registered[r]?y===i?(d=T.getPropertyValue(t,f),y=T.getPropertyValue(t,r,d)):d=T.Hooks.templates[f][1]:y===i&&(y=T.getPropertyValue(t,r));var v,b,x,S=!1,w=function(t,e){var n,i;return i=(e||"0").toString().toLowerCase().replace(/[%A-z]+$/,function(t){return n=t,""}),n||(n=T.Values.getUnitType(t)),[i,n]};if(y!==m&&_.isString(y)&&_.isString(m)){a="";var C=0,A=0,I=[],O=[],k=0,D=0,N=0;for(y=T.Hooks.fixColors(y),m=T.Hooks.fixColors(m);C<y.length&&A<m.length;){var P=y[C],L=m[A];if(/[\d\.-]/.test(P)&&/[\d\.-]/.test(L)){for(var j=P,B=L,V=".",R=".";++C<y.length;){if(P=y[C],P===V)V="..";else if(!/\d/.test(P))break;j+=P}for(;++A<m.length;){if(L=m[A],L===R)R="..";else if(!/\d/.test(L))break;B+=L}var M=T.Hooks.getUnit(y,C),H=T.Hooks.getUnit(m,A);if(C+=M.length,A+=H.length,M===H)j===B?a+=j+M:(a+="{"+I.length+(D?"!":"")+"}"+M,I.push(parseFloat(j)),O.push(parseFloat(B)));else{var W=parseFloat(j),U=parseFloat(B);a+=(k<5?"calc":"")+"("+(W?"{"+I.length+(D?"!":"")+"}":"0")+M+" + "+(U?"{"+(I.length+(W?1:0))+(D?"!":"")+"}":"0")+H+")",W&&(I.push(W),O.push(0)),U&&(I.push(0),O.push(U))}}else{if(P!==L){k=0;break}a+=P,C++,A++,0===k&&"c"===P||1===k&&"a"===P||2===k&&"l"===P||3===k&&"c"===P||k>=4&&"("===P?k++:(k&&k<5||k>=4&&")"===P&&--k<5)&&(k=0),0===D&&"r"===P||1===D&&"g"===P||2===D&&"b"===P||3===D&&"a"===P||D>=3&&"("===P?(3===D&&"a"===P&&(N=1),D++):N&&","===P?++N>3&&(D=N=0):(N&&D<(N?5:4)||D>=(N?4:3)&&")"===P&&--D<(N?5:4))&&(D=N=0)}}C===y.length&&A===m.length||(E.debug,a=i),a&&(I.length?(E.debug,y=I,m=O,b=x=""):a=i)}a||(v=w(r,y),y=v[0],x=v[1],v=w(r,m),m=v[0].replace(/^([+-\/*])=/,function(t,e){return S=e,""}),b=v[1],y=parseFloat(y)||0,m=parseFloat(m)||0,"%"===b&&(/^(fontSize|lineHeight)$/.test(r)?(m/=100,b="em"):/^scale/.test(r)?(m/=100,b=""):/(Red|Green|Blue)$/i.test(r)&&(m=m/100*255,b="")));var z=function(){var i={myParent:t.parentNode||n.body,position:T.getPropertyValue(t,"position"),fontSize:T.getPropertyValue(t,"fontSize")},r=i.position===F.lastPosition&&i.myParent===F.lastParent,o=i.fontSize===F.lastFontSize;F.lastParent=i.myParent,F.lastPosition=i.position,F.lastFontSize=i.fontSize;var a=100,s={};if(o&&r)s.emToPx=F.lastEmToPx,s.percentToPxWidth=F.lastPercentToPxWidth,s.percentToPxHeight=F.lastPercentToPxHeight;else{var l=c&&c.isSVG?n.createElementNS("http://www.w3.org/2000/svg","rect"):n.createElement("div");E.init(l),i.myParent.appendChild(l),h.each(["overflow","overflowX","overflowY"],function(t,e){E.CSS.setPropertyValue(l,e,"hidden")}),E.CSS.setPropertyValue(l,"position",i.position),E.CSS.setPropertyValue(l,"fontSize",i.fontSize),E.CSS.setPropertyValue(l,"boxSizing","content-box"),h.each(["minWidth","maxWidth","width","minHeight","maxHeight","height"],function(t,e){E.CSS.setPropertyValue(l,e,a+"%")}),E.CSS.setPropertyValue(l,"paddingLeft",a+"em"),s.percentToPxWidth=F.lastPercentToPxWidth=(parseFloat(T.getPropertyValue(l,"width",null,!0))||1)/a,s.percentToPxHeight=F.lastPercentToPxHeight=(parseFloat(T.getPropertyValue(l,"height",null,!0))||1)/a,s.emToPx=F.lastEmToPx=(parseFloat(T.getPropertyValue(l,"paddingLeft"))||1)/a,i.myParent.removeChild(l)}return null===F.remToPx&&(F.remToPx=parseFloat(T.getPropertyValue(n.body,"fontSize"))||16),null===F.vwToPx&&(F.vwToPx=parseFloat(e.innerWidth)/100,F.vhToPx=parseFloat(e.innerHeight)/100),s.remToPx=F.remToPx,s.vwToPx=F.vwToPx,s.vhToPx=F.vhToPx,E.debug>=1,s};if(/[\/*]/.test(S))b=x;else if(x!==b&&0!==y)if(0===m)b=x;else{s=s||z();var $=/margin|padding|left|right|width|text|word|letter/i.test(r)||/X$/.test(r)||"x"===r?"x":"y";switch(x){case"%":y*="x"===$?s.percentToPxWidth:s.percentToPxHeight;break;case"px":break;default:y*=s[x+"ToPx"]}switch(b){case"%":y*=1/("x"===$?s.percentToPxWidth:s.percentToPxHeight);break;case"px":break;default:y*=1/s[b+"ToPx"]}}switch(S){case"+":m=y+m;break;case"-":m=y-m;break;case"*":m*=y;break;case"/":m=y/m}u[r]={rootPropertyValue:d,startValue:y,currentValue:y,endValue:m,unitType:b,easing:g},a&&(u[r].pattern=a),E.debug};for(var j in v)if(v.hasOwnProperty(j)){var B=T.Names.camelCase(j),V=P(v[j]);if(b(T.Lists.colors,B)){var M=V[0],H=V[1],W=V[2];if(T.RegEx.isHex.test(M)){for(var U=["Red","Green","Blue"],z=T.Values.hexToRgb(M),$=W?T.Values.hexToRgb(W):i,q=0;q<U.length;q++){var Q=[z[q]];H&&Q.push(H),$!==i&&Q.push($[q]),L(B+U[q],Q)}continue}}L(B,V)}u.element=t}u.element&&(T.Values.addClass(t,"velocity-animating"),R.push(u),c=a(t),c&&(""===l.queue&&(c.tweensContainer=u,c.opts=l),c.isAnimating=!0),O===I-1?(E.State.calls.push([R,y,l,null,C.resolver,null,0]),E.State.isTicking===!1&&(E.State.isTicking=!0,d())):O++)}var s,l=h.extend({},E.defaults,x),u={};switch(a(t)===i&&E.init(t),parseFloat(l.delay)&&l.queue!==!1&&h.queue(t,l.queue,function(e){E.velocityQueueEntryFlag=!0;var n=E.State.delayedElements.count++;E.State.delayedElements[n]=t;var i=function(t){return function(){E.State.delayedElements[t]=!1,e()}}(n);a(t).delayBegin=(new Date).getTime(),a(t).delay=parseFloat(l.delay),a(t).delayTimer={setTimeout:setTimeout(e,parseFloat(l.delay)),next:i}}),l.duration.toString().toLowerCase()){case"fast":l.duration=200;break;case"normal":l.duration=S;break;case"slow":l.duration=600;break;default:l.duration=parseFloat(l.duration)||1}if(E.mock!==!1&&(E.mock===!0?l.duration=l.delay=1:(l.duration*=parseFloat(E.mock)||1,l.delay*=parseFloat(E.mock)||1)),l.easing=f(l.easing,l.duration),l.begin&&!_.isFunction(l.begin)&&(l.begin=null),l.progress&&!_.isFunction(l.progress)&&(l.progress=null),l.complete&&!_.isFunction(l.complete)&&(l.complete=null),l.display!==i&&null!==l.display&&(l.display=l.display.toString().toLowerCase(),"auto"===l.display&&(l.display=E.CSS.Values.getDisplayType(t))),l.visibility!==i&&null!==l.visibility&&(l.visibility=l.visibility.toString().toLowerCase()),l.mobileHA=l.mobileHA&&E.State.isMobile&&!E.State.isGingerbread,l.queue===!1)if(l.delay){var c=E.State.delayedElements.count++;E.State.delayedElements[c]=t;var p=function(t){return function(){E.State.delayedElements[t]=!1,o()}}(c);a(t).delayBegin=(new Date).getTime(),a(t).delay=parseFloat(l.delay),a(t).delayTimer={setTimeout:setTimeout(o,parseFloat(l.delay)),next:p}}else o();else h.queue(t,l.queue,function(t,e){return e===!0?(C.promise&&C.resolver(y),!0):(E.velocityQueueEntryFlag=!0,void o(t))});""!==l.queue&&"fx"!==l.queue||"inprogress"===h.queue(t)[0]||h.dequeue(t)}var u,c,m,g,y,v,x,w=arguments[0]&&(arguments[0].p||h.isPlainObject(arguments[0].properties)&&!arguments[0].properties.names||_.isString(arguments[0].properties));_.isWrapped(this)?(c=!1,g=0,y=this,m=this):(c=!0,g=1,y=w?arguments[0].elements||arguments[0].e:arguments[0]);var C={promise:null,resolver:null,rejecter:null};if(c&&E.Promise&&(C.promise=new E.Promise(function(t,e){C.resolver=t,C.rejecter=e})),w?(v=arguments[0].properties||arguments[0].p,x=arguments[0].options||arguments[0].o):(v=arguments[g],x=arguments[g+1]),y=o(y),!y)return void(C.promise&&(v&&x&&x.promiseRejectEmpty===!1?C.resolver():C.rejecter()));var I=y.length,O=0;if(!/^(stop|finish|finishAll|pause|resume)$/i.test(v)&&!h.isPlainObject(x)){var k=g+1;x={};for(var D=k;D<arguments.length;D++)_.isArray(arguments[D])||!/^(fast|normal|slow)$/i.test(arguments[D])&&!/^\d/.test(arguments[D])?_.isString(arguments[D])||_.isArray(arguments[D])?x.easing=arguments[D]:_.isFunction(arguments[D])&&(x.complete=arguments[D]):x.duration=arguments[D]}var N;switch(v){case"scroll":N="scroll";break;case"reverse":N="reverse";break;case"pause":var P=(new Date).getTime();return h.each(y,function(t,e){s(e,P)}),h.each(E.State.calls,function(t,e){var n=!1;e&&h.each(e[1],function(t,r){var o=x===i?"":x;return o!==!0&&e[2].queue!==o&&(x!==i||e[2].queue!==!1)||(h.each(y,function(t,i){if(i===r)return e[5]={resume:!1},n=!0,!1}),!n&&void 0)})}),t();case"resume":return h.each(y,function(t,e){l(e,P)}),h.each(E.State.calls,function(t,e){var n=!1;e&&h.each(e[1],function(t,r){var o=x===i?"":x;return o!==!0&&e[2].queue!==o&&(x!==i||e[2].queue!==!1)||(!e[5]||(h.each(y,function(t,i){if(i===r)return e[5].resume=!0,n=!0,!1}),!n&&void 0))})}),t();case"finish":case"finishAll":case"stop":h.each(y,function(t,e){a(e)&&a(e).delayTimer&&(clearTimeout(a(e).delayTimer.setTimeout),a(e).delayTimer.next&&a(e).delayTimer.next(),delete a(e).delayTimer),"finishAll"!==v||x!==!0&&!_.isString(x)||(h.each(h.queue(e,_.isString(x)?x:""),function(t,e){_.isFunction(e)&&e()}),h.queue(e,_.isString(x)?x:"",[]))});var L=[];return h.each(E.State.calls,function(t,e){e&&h.each(e[1],function(n,r){var o=x===i?"":x;return o!==!0&&e[2].queue!==o&&(x!==i||e[2].queue!==!1)||void h.each(y,function(n,i){if(i===r)if((x===!0||_.isString(x))&&(h.each(h.queue(i,_.isString(x)?x:""),function(t,e){_.isFunction(e)&&e(null,!0)}),h.queue(i,_.isString(x)?x:"",[])),"stop"===v){var s=a(i);s&&s.tweensContainer&&o!==!1&&h.each(s.tweensContainer,function(t,e){e.endValue=e.currentValue}),L.push(t)}else"finish"!==v&&"finishAll"!==v||(e[2].duration=1)})})}),"stop"===v&&(h.each(L,function(t,e){p(e,!0)}),C.promise&&C.resolver(y)),t();default:if(!h.isPlainObject(v)||_.isEmptyObject(v)){if(_.isString(v)&&E.Redirects[v]){u=h.extend({},x);var j=u.duration,B=u.delay||0;return u.backwards===!0&&(y=h.extend(!0,[],y).reverse()),h.each(y,function(t,e){parseFloat(u.stagger)?u.delay=B+parseFloat(u.stagger)*t:_.isFunction(u.stagger)&&(u.delay=B+u.stagger.call(e,t,I)),u.drag&&(u.duration=parseFloat(j)||(/^(callout|transition)/.test(v)?1e3:S),u.duration=Math.max(u.duration*(u.backwards?1-t/I:(t+1)/I),.75*u.duration,200)),E.Redirects[v].call(e,e,u||{},t,I,y,C.promise?C:i)}),t()}var V="Velocity: First argument ("+v+") was not a property map, a known action, or a registered redirect. Aborting.";return C.promise?C.rejecter(new Error(V)):e.console,t()}N="start"}var F={lastParent:null,lastPosition:null,lastFontSize:null,lastPercentToPxWidth:null,lastPercentToPxHeight:null,lastEmToPx:null,remToPx:null,vwToPx:null,vhToPx:null},R=[];h.each(y,function(t,e){_.isNode(e)&&r(e,t)}),u=h.extend({},E.defaults,x),u.loop=parseInt(u.loop,10);var M=2*u.loop-1;if(u.loop)for(var H=0;H<M;H++){var W={delay:u.delay,progress:u.progress};H===M-1&&(W.display=u.display,W.visibility=u.visibility,W.complete=u.complete),A(y,"reverse",W)}return t()};E=h.extend(A,E),E.animate=A;var I=e.requestAnimationFrame||g;if(!E.State.isMobile&&n.hidden!==i){var O=function(){n.hidden?(I=function(t){return setTimeout(function(){t(!0)},16)},d()):I=e.requestAnimationFrame||g};O(),n.addEventListener("visibilitychange",O)}return t.Velocity=E,t!==e&&(t.fn.velocity=A,t.fn.velocity.defaults=E.defaults),h.each(["Down","Up"],function(t,e){E.Redirects["slide"+e]=function(t,n,r,o,a,s){var l=h.extend({},n),u=l.begin,c=l.complete,f={},d={height:"",marginTop:"",marginBottom:"",paddingTop:"",paddingBottom:""};l.display===i&&(l.display="Down"===e?"inline"===E.CSS.Values.getDisplayType(t)?"inline-block":"block":"none"),l.begin=function(){0===r&&u&&u.call(a,a);for(var n in d)if(d.hasOwnProperty(n)){f[n]=t.style[n];var i=T.getPropertyValue(t,n);d[n]="Down"===e?[i,0]:[0,i]}f.overflow=t.style.overflow,t.style.overflow="hidden"},l.complete=function(){for(var e in f)f.hasOwnProperty(e)&&(t.style[e]=f[e]);r===o-1&&(c&&c.call(a,a),s&&s.resolver(a))},E(t,d,l)}}),h.each(["In","Out"],function(t,e){E.Redirects["fade"+e]=function(t,n,r,o,a,s){var l=h.extend({},n),u=l.complete,c={opacity:"In"===e?1:0};0!==r&&(l.begin=null),r!==o-1?l.complete=null:l.complete=function(){u&&u.call(a,a),s&&s.resolver(a)},l.display===i&&(l.display="In"===e?"auto":"none"),E(this,c,l)}}),E}(window.jQuery||window.Zepto||window,window,window?window.document:void 0)})},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var o=function(){function t(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,n,i){return n&&t(e.prototype,n),i&&t(e,i),e}}(),a=n(8),s=i(a),l=function(){function t(){r(this,t)}return o(t,[{key:"init",value:function(){(0,s.default)(".js-product-miniature").each(function(t,e){(0,s.default)(e).find(".color").length>5&&!function(){var t=0;(0,s.default)(e).find(".color").each(function(e,n){e>4&&((0,s.default)(n).hide(),t++)}),(0,s.default)(e).find(".js-count").append("+"+t)}()})}}]),t}();e.default=l,t.exports=e.default},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}var r=n(8),o=i(r),a=n(9),s=i(a);(0,o.default)(document).ready(function(){function t(){(0,o.default)(".js-thumb").on("click",function(t){(0,o.default)(".js-modal-product-cover").attr("src",(0,o.default)(t.target).data("image-large-src")),(0,o.default)(".selected").removeClass("selected"),(0,o.default)(t.target).addClass("selected"),(0,o.default)(".js-qv-product-cover").prop("src",(0,o.default)(t.currentTarget).data("image-large-src"))})}function e(){(0,o.default)(".js-file-input").on("change",function(t){var e=void 0,n=void 0;(e=(0,o.default)(t.currentTarget)[0])&&(n=e.files[0])&&(0,o.default)(e).prev().text(n.name)})}function n(){var t=(0,o.default)("#quantity_wanted");t.TouchSpin({verticalbuttons:!0,verticalupclass:"material-icons touchspin-up",verticaldownclass:"material-icons touchspin-down",buttondown_class:"btn btn-touchspin js-touchspin",buttonup_class:"btn btn-touchspin js-touchspin",min:parseInt(t.attr("min"),10),max:1e6}),(0,o.default)("body").on("change keyup","#quantity_wanted",function(t){(0,o.default)(t.currentTarget).trigger("touchspin.stopspin"),s.default.emit("updateProduct",{eventType:"updatedProductQuantity",event:t})})}n(),e(),t(),s.default.on("updatedProduct",function(n){if(e(),t(),n&&n.product_minimal_quantity){var i=parseInt(n.product_minimal_quantity,10),r="#quantity_wanted",a=(0,o.default)(r);a.trigger("touchspin.updatesettings",{min:i})}additionalCarousel("#main .additional-carousel"),additionalCarousel(".modal.quickview .additional-carousel"),(0,o.default)((0,o.default)(".tabs .nav-link.active").attr("href")).addClass("active").removeClass("fade"),(0,o.default)(".js-product-images-modal").replaceWith(n.product_images_modal)})})},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(){a.default.each((0,a.default)(u),function(t,e){(0,a.default)(e).TouchSpin({verticalbuttons:!0,verticalupclass:"material-icons touchspin-up",verticaldownclass:"material-icons touchspin-down",buttondown_class:"btn btn-touchspin js-touchspin js-increase-product-quantity",buttonup_class:"btn btn-touchspin js-touchspin js-decrease-product-quantity",min:parseInt((0,a.default)(e).attr("min"),10),max:1e6})}),p.switchErrorStat()}var o=n(8),a=i(o),s=n(9),l=i(s);l.default.cart=l.default.cart||{},l.default.cart.active_inputs=null;var u='input[name="product-quantity-spin"]',c=!1,f=!1,d="";(0,a.default)(document).ready(function(){function t(t){return"on.startupspin"===t||"on.startdownspin"===t}function e(t){return"on.startupspin"===t}function n(t){var e=t.parents(".bootstrap-touchspin").find(h);return e.is(":focus")?null:e}function i(t){var e=t.split("-"),n=void 0,i=void 0,r="";for(n=0;n<e.length;n++)i=e[n],0!==n&&(i=i.substring(0,1).toUpperCase()+i.substring(1)),r+=i;return r}function o(r,o){if(!t(o))return{url:r.attr("href"),type:i(r.data("link-action"))};var a=n(r);if(a){var s={};return s=e(o)?{url:a.data("up-url"),type:"increaseProductQuantity"}:{url:a.data("down-url"),type:"decreaseProductQuantity"}}}function s(t,e,n){return y(),a.default.ajax({url:t,method:"POST",data:e,dataType:"json",beforeSend:function(t){m.push(t)}}).then(function(t){p.checkUpdateOpertation(t),n.val(t.quantity);var e;e=n&&n.dataset?n.dataset:t,l.default.emit("updateCart",{reason:e})}).fail(function(t){l.default.emit("handleError",{eventType:"updateProductQuantityInCart",resp:t})})}function c(t){return{ajax:"1",qty:Math.abs(t),action:"update",op:f(t)}}function f(t){return t>0?"up":"down"}function d(t){var e=(0,a.default)(t.currentTarget),n=e.data("update-url"),i=e.attr("value"),r=e.val();if(r!=parseInt(r)||r<0||isNaN(r))return void e.val(i);var o=r-i;0!==o&&(e.attr("value",r),s(n,c(o),e))}var h=".js-cart-line-product-quantity",m=[];l.default.on("updateCart",function(){(0,a.default)(".quickview").modal("hide")}),l.default.on("updatedCart",function(){r()}),r();var g=(0,a.default)("body"),y=function(){for(var t;m.length>0;)t=m.pop(),t.abort()},v=function(t){return(0,a.default)(t.parents(".bootstrap-touchspin").find("input"))},b=function(t){t.preventDefault();var e=(0,a.default)(t.currentTarget),n=t.currentTarget.dataset,i=o(e,t.namespace),r={ajax:"1",action:"update"};"undefined"!=typeof i&&(y(),a.default.ajax({url:i.url,method:"POST",data:r,dataType:"json",beforeSend:function(t){m.push(t)}}).then(function(t){p.checkUpdateOpertation(t);var i=v(e);i.val(t.quantity),l.default.emit("updateCart",{reason:n})}).fail(function(t){l.default.emit("handleError",{eventType:"updateProductInCart",resp:t,cartAction:i.type})}))};g.on("click",'[data-link-action="delete-from-cart"], [data-link-action="remove-voucher"]',b),g.on("touchspin.on.startdownspin",u,b),g.on("touchspin.on.startupspin",u,b),g.on("focusout keyup",h,function(t){return"keyup"===t.type?(13===t.keyCode&&d(t),!1):void d(t)});var _=400;g.on("hidden.bs.collapse","#promo-code",function(){(0,a.default)(".display-promo").show(_)}),g.on("click",".promo-code-button",function(t){t.preventDefault(),(0,a.default)("#promo-code").collapse("toggle")}),g.on("click",".display-promo",function(t){(0,a.default)(t.currentTarget).hide(_)}),g.on("click",".js-discount .code",function(t){t.stopPropagation();var e=(0,a.default)(t.currentTarget),n=(0,a.default)("[name=discount_name]");return n.val(e.text()),(0,a.default)("#promo-code").collapse("show"),(0,a.default)(".display-promo").hide(_),!1})});var p={switchErrorStat:function(){var t=(0,a.default)(".checkout a");if(((0,a.default)("#notifications article.alert-danger").length||""!==d&&!c)&&t.addClass("disabled"),""!==d){var e=' <article class="alert alert-danger" role="alert" data-alert="danger"><ul><li>'+d+"</li></ul></article>";(0,a.default)("#notifications .container").html(e),d="",f=!1,c&&t.removeClass("disabled")}else!c&&f&&(c=!1,f=!1,(0,a.default)("#notifications .container").html(""),t.removeClass("disabled"))},checkUpdateOpertation:function(t){c=t.hasOwnProperty("hasError");var e=t.errors||"";d=e instanceof Array?e.join(" "):e,f=!0}}},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var o=function(){function t(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,n,i){return n&&t(e.prototype,n),i&&t(e,i),e}}(),a=n(8),s=i(a),l=function(){function t(e){r(this,t),this.el=e}return o(t,[{key:"init",value:function(){this.el.on("show.bs.dropdown",function(t,e){e?(0,s.default)("#"+e).find(".dropdown-menu").first().stop(!0,!0).slideDown():(0,s.default)(t.target).find(".dropdown-menu").first().stop(!0,!0).slideDown()}),this.el.on("hide.bs.dropdown",function(t,e){e?(0,s.default)("#"+e).find(".dropdown-menu").first().stop(!0,!0).slideUp():(0,s.default)(t.target).find(".dropdown-menu").first().stop(!0,!0).slideUp()}),this.el.find("select.link").each(function(t,e){(0,s.default)(e).on("change",function(t){window.location=(0,s.default)(this).val()})})}}]),t}();e.default=l,t.exports=e.default},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var o=function(){function t(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,n,i){return n&&t(e.prototype,n),i&&t(e,i),e}}(),a=n(8),s=i(a),l=function(){function t(){r(this,t)}return o(t,[{key:"init",value:function(){this.parentFocus(),this.togglePasswordVisibility()}},{key:"parentFocus",value:function(){(0,s.default)(".js-child-focus").focus(function(){(0,s.default)(this).closest(".js-parent-focus").addClass("focus")}),(0,s.default)(".js-child-focus").focusout(function(){(0,s.default)(this).closest(".js-parent-focus").removeClass("focus")})}},{key:"togglePasswordVisibility",value:function(){(0,s.default)('button[data-action="show-password"]').on("click",function(){var t=(0,s.default)(this).closest(".input-group").children("input.js-visible-password");"password"===t.attr("type")?(t.attr("type","text"),(0,s.default)(this).text((0,s.default)(this).data("textHide"))):(t.attr("type","password"),(0,s.default)(this).text((0,s.default)(this).data("textShow")))})}}]),t}();e.default=l,t.exports=e.default},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var o=function(){function t(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,n,i){return n&&t(e.prototype,n),i&&t(e,i),e}}(),a=n(8),s=i(a);n(13);var l=function(){function t(){r(this,t)}return o(t,[{key:"init",value:function(){var t=this,e=5,n=(0,s.default)(".js-modal-arrows"),i=(0,s.default)(".js-modal-product-images");(0,s.default)("body").on("click",".js-modal-thumb",function(t){(0,s.default)(".js-modal-thumb").hasClass("selected")&&(0,s.default)(".js-modal-thumb").removeClass("selected"),(0,s.default)(t.currentTarget).addClass("selected"),(0,s.default)(".js-modal-product-cover").attr("src",(0,s.default)(t.target).data("image-large-src")),(0,s.default)(".js-modal-product-cover").attr("title",(0,s.default)(t.target).attr("title")),(0,s.default)(".js-modal-product-cover").attr("alt",(0,s.default)(t.target).attr("alt"))}).on("click","aside#thumbnails",function(t){"thumbnails"==t.target.id&&(0,s.default)("#product-modal").modal("hide")}),(0,s.default)(".js-modal-product-images li").length<=e?n.css("opacity",".2"):n.on("click",function(e){(0,s.default)(e.target).hasClass("arrow-up")&&i.position().top<0?(t.move("up"),(0,s.default)(".js-modal-arrow-down").css("opacity","1")):(0,s.default)(e.target).hasClass("arrow-down")&&i.position().top+i.height()>(0,s.default)(".js-modal-mask").height()&&(t.move("down"),(0,s.default)(".js-modal-arrow-up").css("opacity","1"))})}},{key:"move",value:function(t){var e=10,n=(0,s.default)(".js-modal-product-images"),i=(0,s.default)(".js-modal-product-images li img").height()+e,r=n.position().top;n.velocity({translateY:"up"===t?r+i:r-i},function(){n.position().top>=0?(0,s.default)(".js-modal-arrow-up").css("opacity",".2"):n.position().top+n.height()<=(0,s.default)(".js-modal-mask").height()&&(0,s.default)(".js-modal-arrow-down").css("opacity",".2")})}}]),t}();e.default=l,t.exports=e.default},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var a=function(){function t(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,n,i){return n&&t(e.prototype,n),i&&t(e,i),e}}(),s=function(t,e,n){for(var i=!0;i;){var r=t,o=e,a=n;i=!1,null===r&&(r=Function.prototype);var s=Object.getOwnPropertyDescriptor(r,o);if(void 0!==s){if("value"in s)return s.value;var l=s.get;if(void 0===l)return;return l.call(a)}var u=Object.getPrototypeOf(r);if(null===u)return;t=u,e=o,n=a,i=!0,s=u=void 0}},l=n(8),u=i(l),c=n(17),f=i(c),d=function(t){function e(){r(this,e),s(Object.getPrototypeOf(e.prototype),"constructor",this).apply(this,arguments)}return o(e,t),a(e,[{key:"init",value:function(){var t=this,n=void 0,i=this;this.el.find("li").hover(function(e){t.el.parent().hasClass("mobile")||(n!==(0,u.default)(e.currentTarget).attr("id")&&(0===(0,u.default)(e.target).data("depth")&&(0,u.default)("#"+n+" .js-sub-menu").hide(),n=(0,u.default)(e.currentTarget).attr("id")),n&&0===(0,u.default)(e.target).data("depth")&&(0,u.default)("#"+n+" .js-sub-menu").show().css({top:(0,u.default)("#"+n).height()+(0,u.default)("#"+n).position().top}))}),(0,u.default)(".menu-icon").on("click",function(){(0,u.default)("#mobile_top_menu_wrapper").toggleClass("slide"),(0,u.default)(".menu-icon").toggleClass("active"),(0,u.default)("body").toggleClass("active"),(0,u.default)("#page").toggleClass("active"),i.toggleMobileMenu()}),(0,u.default)(".js-top-menu").mouseleave(function(){t.el.parent().hasClass("mobile")||(0,u.default)("#"+n+" .js-sub-menu").hide()}),this.el.on("click",function(e){
t.el.parent().hasClass("mobile")||e.stopPropagation()}),prestashop.on("responsive update",function(t){(0,u.default)(".js-sub-menu").removeAttr("style"),i.toggleMobileMenu()}),s(Object.getPrototypeOf(e.prototype),"init",this).call(this)}},{key:"toggleMobileMenu",value:function(){(0,u.default)("#mobile_top_menu_wrapper").is(":visible")}}]),e}(f.default);e.default=d,t.exports=e.default},function(t,e){function n(){this._events=this._events||{},this._maxListeners=this._maxListeners||void 0}function i(t){return"function"==typeof t}function r(t){return"number"==typeof t}function o(t){return"object"==typeof t&&null!==t}function a(t){return void 0===t}t.exports=n,n.EventEmitter=n,n.prototype._events=void 0,n.prototype._maxListeners=void 0,n.defaultMaxListeners=10,n.prototype.setMaxListeners=function(t){if(!r(t)||t<0||isNaN(t))throw TypeError("n must be a positive number");return this._maxListeners=t,this},n.prototype.emit=function(t){var e,n,r,s,l,u;if(this._events||(this._events={}),"error"===t&&(!this._events.error||o(this._events.error)&&!this._events.error.length)){if(e=arguments[1],e instanceof Error)throw e;var c=new Error('Uncaught, unspecified "error" event. ('+e+")");throw c.context=e,c}if(n=this._events[t],a(n))return!1;if(i(n))switch(arguments.length){case 1:n.call(this);break;case 2:n.call(this,arguments[1]);break;case 3:n.call(this,arguments[1],arguments[2]);break;default:s=Array.prototype.slice.call(arguments,1),n.apply(this,s)}else if(o(n))for(s=Array.prototype.slice.call(arguments,1),u=n.slice(),r=u.length,l=0;l<r;l++)u[l].apply(this,s);return!0},n.prototype.addListener=function(t,e){var r;if(!i(e))throw TypeError("listener must be a function");return this._events||(this._events={}),this._events.newListener&&this.emit("newListener",t,i(e.listener)?e.listener:e),this._events[t]?o(this._events[t])?this._events[t].push(e):this._events[t]=[this._events[t],e]:this._events[t]=e,o(this._events[t])&&!this._events[t].warned&&(r=a(this._maxListeners)?n.defaultMaxListeners:this._maxListeners,r&&r>0&&this._events[t].length>r&&(this._events[t].warned=!0,"function"==typeof console.trace)),this},n.prototype.on=n.prototype.addListener,n.prototype.once=function(t,e){function n(){this.removeListener(t,n),r||(r=!0,e.apply(this,arguments))}if(!i(e))throw TypeError("listener must be a function");var r=!1;return n.listener=e,this.on(t,n),this},n.prototype.removeListener=function(t,e){var n,r,a,s;if(!i(e))throw TypeError("listener must be a function");if(!this._events||!this._events[t])return this;if(n=this._events[t],a=n.length,r=-1,n===e||i(n.listener)&&n.listener===e)delete this._events[t],this._events.removeListener&&this.emit("removeListener",t,e);else if(o(n)){for(s=a;s-- >0;)if(n[s]===e||n[s].listener&&n[s].listener===e){r=s;break}if(r<0)return this;1===n.length?(n.length=0,delete this._events[t]):n.splice(r,1),this._events.removeListener&&this.emit("removeListener",t,e)}return this},n.prototype.removeAllListeners=function(t){var e,n;if(!this._events)return this;if(!this._events.removeListener)return 0===arguments.length?this._events={}:this._events[t]&&delete this._events[t],this;if(0===arguments.length){for(e in this._events)"removeListener"!==e&&this.removeAllListeners(e);return this.removeAllListeners("removeListener"),this._events={},this}if(n=this._events[t],i(n))this.removeListener(t,n);else if(n)for(;n.length;)this.removeListener(t,n[n.length-1]);return delete this._events[t],this},n.prototype.listeners=function(t){var e;return e=this._events&&this._events[t]?i(this._events[t])?[this._events[t]]:this._events[t].slice():[]},n.prototype.listenerCount=function(t){if(this._events){var e=this._events[t];if(i(e))return 1;if(e)return e.length}return 0},n.listenerCount=function(t,e){return t.listenerCount(e)}},function(t,e){"use strict";!function(t){var e=0,n=function(e,n){this.options=n,this.$elementFilestyle=[],this.$element=t(e)};n.prototype={clear:function(){this.$element.val(""),this.$elementFilestyle.find(":text").val(""),this.$elementFilestyle.find(".badge").remove()},destroy:function(){this.$element.removeAttr("style").removeData("filestyle"),this.$elementFilestyle.remove()},disabled:function(t){if(t===!0)this.options.disabled||(this.$element.attr("disabled","true"),this.$elementFilestyle.find("label").attr("disabled","true"),this.options.disabled=!0);else{if(t!==!1)return this.options.disabled;this.options.disabled&&(this.$element.removeAttr("disabled"),this.$elementFilestyle.find("label").removeAttr("disabled"),this.options.disabled=!1)}},buttonBefore:function(t){if(t===!0)this.options.buttonBefore||(this.options.buttonBefore=!0,this.options.input&&(this.$elementFilestyle.remove(),this.constructor(),this.pushNameFiles()));else{if(t!==!1)return this.options.buttonBefore;this.options.buttonBefore&&(this.options.buttonBefore=!1,this.options.input&&(this.$elementFilestyle.remove(),this.constructor(),this.pushNameFiles()))}},icon:function(t){if(t===!0)this.options.icon||(this.options.icon=!0,this.$elementFilestyle.find("label").prepend(this.htmlIcon()));else{if(t!==!1)return this.options.icon;this.options.icon&&(this.options.icon=!1,this.$elementFilestyle.find(".icon-span-filestyle").remove())}},input:function(t){if(t===!0)this.options.input||(this.options.input=!0,this.options.buttonBefore?this.$elementFilestyle.append(this.htmlInput()):this.$elementFilestyle.prepend(this.htmlInput()),this.$elementFilestyle.find(".badge").remove(),this.pushNameFiles(),this.$elementFilestyle.find(".group-span-filestyle").addClass("input-group-btn"));else{if(t!==!1)return this.options.input;if(this.options.input){this.options.input=!1,this.$elementFilestyle.find(":text").remove();var e=this.pushNameFiles();e.length>0&&this.options.badge&&this.$elementFilestyle.find("label").append(' <span class="badge">'+e.length+"</span>"),this.$elementFilestyle.find(".group-span-filestyle").removeClass("input-group-btn")}}},size:function(t){if(void 0===t)return this.options.size;var e=this.$elementFilestyle.find("label"),n=this.$elementFilestyle.find("input");e.removeClass("btn-lg btn-sm"),n.removeClass("input-lg input-sm"),"nr"!=t&&(e.addClass("btn-"+t),n.addClass("input-"+t))},placeholder:function(t){return void 0===t?this.options.placeholder:(this.options.placeholder=t,void this.$elementFilestyle.find("input").attr("placeholder",t))},buttonText:function(t){return void 0===t?this.options.buttonText:(this.options.buttonText=t,void this.$elementFilestyle.find("label .buttonText").html(this.options.buttonText))},buttonName:function(t){return void 0===t?this.options.buttonName:(this.options.buttonName=t,void this.$elementFilestyle.find("label").attr({class:"btn "+this.options.buttonName}))},iconName:function(t){return void 0===t?this.options.iconName:void this.$elementFilestyle.find(".icon-span-filestyle").attr({class:"icon-span-filestyle "+this.options.iconName})},htmlIcon:function(){return this.options.icon?'<span class="icon-span-filestyle '+this.options.iconName+'"></span> ':""},htmlInput:function(){return this.options.input?'<input type="text" class="form-control '+("nr"==this.options.size?"":"input-"+this.options.size)+'" placeholder="'+this.options.placeholder+'" disabled> ':""},pushNameFiles:function(){var t="",e=[];void 0===this.$element[0].files?e[0]={name:this.$element[0]&&this.$element[0].value}:e=this.$element[0].files;for(var n=0;n<e.length;n++)t+=e[n].name.split("\\").pop()+", ";return""!==t?this.$elementFilestyle.find(":text").val(t.replace(/\, $/g,"")):this.$elementFilestyle.find(":text").val(""),e},constructor:function(){var n=this,i="",r=n.$element.attr("id"),o="";""!==r&&r||(r="filestyle-"+e,n.$element.attr({id:r}),e++),o='<span class="group-span-filestyle '+(n.options.input?"input-group-btn":"")+'"><label for="'+r+'" class="btn '+n.options.buttonName+" "+("nr"==n.options.size?"":"btn-"+n.options.size)+'" '+(n.options.disabled?'disabled="true"':"")+">"+n.htmlIcon()+'<span class="buttonText">'+n.options.buttonText+"</span></label></span>",i=n.options.buttonBefore?o+n.htmlInput():n.htmlInput()+o,n.$elementFilestyle=t('<div class="bootstrap-filestyle input-group">'+i+"</div>"),n.$elementFilestyle.find(".group-span-filestyle").attr("tabindex","0").keypress(function(t){if(13===t.keyCode||32===t.charCode)return n.$elementFilestyle.find("label").click(),!1}),n.$element.css({position:"absolute",clip:"rect(0px 0px 0px 0px)"}).attr("tabindex","-1").after(n.$elementFilestyle),n.options.disabled&&n.$element.attr("disabled","true"),n.$element.change(function(){var t=n.pushNameFiles();0==n.options.input&&n.options.badge?0==n.$elementFilestyle.find(".badge").length?n.$elementFilestyle.find("label").append(' <span class="badge">'+t.length+"</span>"):0==t.length?n.$elementFilestyle.find(".badge").remove():n.$elementFilestyle.find(".badge").html(t.length):n.$elementFilestyle.find(".badge").remove()}),window.navigator.userAgent.search(/firefox/i)>-1&&n.$elementFilestyle.find("label").click(function(){return n.$element.click(),!1})}};var i=t.fn.filestyle;t.fn.filestyle=function(e,i){var r="",o=this.each(function(){if("file"===t(this).attr("type")){var o=t(this),a=o.data("filestyle"),s=t.extend({},t.fn.filestyle.defaults,e,"object"==typeof e&&e);a||(o.data("filestyle",a=new n(this,s)),a.constructor()),"string"==typeof e&&(r=a[e](i))}});return void 0!==typeof r?r:o},t.fn.filestyle.defaults={buttonText:"Choose file",iconName:"glyphicon glyphicon-folder-open",buttonName:"btn-default",size:"nr",input:!0,badge:!0,icon:!0,buttonBefore:!1,disabled:!1,placeholder:""},t.fn.filestyle.noConflict=function(){return t.fn.filestyle=i,this},t(function(){t(".filestyle").each(function(){var e=t(this),n={input:"false"!==e.attr("data-input"),icon:"false"!==e.attr("data-icon"),buttonBefore:"true"===e.attr("data-buttonBefore"),disabled:"true"===e.attr("data-disabled"),size:e.attr("data-size"),buttonText:e.attr("data-buttonText"),buttonName:e.attr("data-buttonName"),iconName:e.attr("data-iconName"),badge:"false"!==e.attr("data-badge"),placeholder:e.attr("data-placeholder")};e.filestyle(n)})})}(window.jQuery)},function(t,e){"use strict";!function(t){t.fn.scrollbox=function(e){var n={linear:!1,startDelay:2,delay:3,step:5,speed:32,switchItems:1,direction:"vertical",distance:"auto",autoPlay:!0,onMouseOverPause:!0,paused:!1,queue:null,listElement:"ul",listItemElement:"li",infiniteLoop:!0,switchAmount:0,afterForward:null,afterBackward:null,triggerStackable:!1};return e=t.extend(n,e),e.scrollOffset="vertical"===e.direction?"scrollTop":"scrollLeft",e.queue&&(e.queue=t("#"+e.queue)),this.each(function(){var n,i,r,o,a,s,l,u,c,f=t(this),d=null,p=null,h=!1,m=0,g=0;e.onMouseOverPause&&(f.bind("mouseover",function(){h=!0}),f.bind("mouseout",function(){h=!1})),n=f.children(e.listElement+":first-child"),e.infiniteLoop===!1&&0===e.switchAmount&&(e.switchAmount=n.children().length),s=function(){if(!h){var r,a,s,l,u;if(r=n.children(e.listItemElement+":first-child"),l="auto"!==e.distance?e.distance:"vertical"===e.direction?r.outerHeight(!0):r.outerWidth(!0),e.linear?s=Math.min(f[0][e.scrollOffset]+e.step,l):(u=Math.max(3,parseInt(.3*(l-f[0][e.scrollOffset]),10)),s=Math.min(f[0][e.scrollOffset]+u,l)),f[0][e.scrollOffset]=s,s>=l){for(a=0;a<e.switchItems;a++)e.queue&&e.queue.find(e.listItemElement).length>0?(n.append(e.queue.find(e.listItemElement)[0]),n.children(e.listItemElement+":first-child").remove()):n.append(n.children(e.listItemElement+":first-child")),++m;if(f[0][e.scrollOffset]=0,clearInterval(d),d=null,t.isFunction(e.afterForward)&&e.afterForward.call(f,{switchCount:m,currentFirstChild:n.children(e.listItemElement+":first-child")}),e.triggerStackable&&0!==g)return void i();if(e.infiniteLoop===!1&&m>=e.switchAmount)return;e.autoPlay&&(p=setTimeout(o,1e3*e.delay))}}},l=function(){if(!h){var r,a,s,l,u;if(0===f[0][e.scrollOffset]){for(a=0;a<e.switchItems;a++)n.children(e.listItemElement+":last-child").insertBefore(n.children(e.listItemElement+":first-child"));r=n.children(e.listItemElement+":first-child"),l="auto"!==e.distance?e.distance:"vertical"===e.direction?r.height():r.width(),f[0][e.scrollOffset]=l}if(e.linear?s=Math.max(f[0][e.scrollOffset]-e.step,0):(u=Math.max(3,parseInt(.3*f[0][e.scrollOffset],10)),s=Math.max(f[0][e.scrollOffset]-u,0)),f[0][e.scrollOffset]=s,0===s){if(--m,clearInterval(d),d=null,t.isFunction(e.afterBackward)&&e.afterBackward.call(f,{switchCount:m,currentFirstChild:n.children(e.listItemElement+":first-child")}),e.triggerStackable&&0!==g)return void i();e.autoPlay&&(p=setTimeout(o,1e3*e.delay))}}},i=function(){0!==g&&(g>0?(g--,p=setTimeout(o,0)):(g++,p=setTimeout(r,0)))},o=function(){clearInterval(d),d=setInterval(s,e.speed)},r=function(){clearInterval(d),d=setInterval(l,e.speed)},u=function(){e.autoPlay=!0,h=!1,clearInterval(d),d=setInterval(s,e.speed)},c=function(){h=!0},a=function(t){e.delay=t||e.delay,clearTimeout(p),e.autoPlay&&(p=setTimeout(o,1e3*e.delay))},e.autoPlay&&(p=setTimeout(o,1e3*e.startDelay)),f.bind("resetClock",function(t){a(t)}),f.bind("forward",function(){e.triggerStackable?null!==d?g++:o():(clearTimeout(p),o())}),f.bind("backward",function(){e.triggerStackable?null!==d?g--:r():(clearTimeout(p),r())}),f.bind("pauseHover",function(){c()}),f.bind("forwardHover",function(){u()}),f.bind("speedUp",function(t,n){"undefined"===n&&(n=Math.max(1,parseInt(e.speed/2,10))),e.speed=n}),f.bind("speedDown",function(t,n){"undefined"===n&&(n=2*e.speed),e.speed=n}),f.bind("updateConfig",function(n,i){e=t.extend(e,i)})})}}(jQuery)},function(t,e,n){"use strict";function i(t){return t&&t.__esModule?t:{default:t}}var r=n(9),o=i(r),a=n(8),s=i(a);o.default.blockcart=o.default.blockcart||{},o.default.blockcart.showModal=function(t){function e(){return(0,s.default)("#blockcart-modal")}var n=e();n.length&&n.remove(),(0,s.default)("body").append(t),n=e(),n.modal("show").on("hidden.bs.modal",function(t){o.default.emit("updateProduct",{reason:t.currentTarget.dataset,event:t})})}}]);
/*
 *  jQuery OwlCarousel v1.3.2
 *
 *  Copyright (c) 2013 Bartosz Wojciechowski
 *  http://www.owlgraphic.com/owlcarousel/
 *
 *  Licensed under MIT
 *
 */

/*JS Lint helpers: */
/*global dragMove: false, dragEnd: false, $, jQuery, alert, window, document */
/*jslint nomen: true, continue:true */

if (typeof Object.create !== "function") {
    Object.create = function (obj) {
        function F() {}
        F.prototype = obj;
        return new F();
    };
}
(function ($, window, document) {

    var Carousel = {
        init : function (options, el) {
            var base = this;

            base.$elem = $(el);
            base.options = $.extend({}, $.fn.owlCarousel.options, base.$elem.data(), options);

            base.userOptions = options;
            base.loadContent();
        },

        loadContent : function () {
            var base = this, url;

            function getData(data) {
                var i, content = "";
                if (typeof base.options.jsonSuccess === "function") {
                    base.options.jsonSuccess.apply(this, [data]);
                } else {
                    for (i in data.owl) {
                        if (data.owl.hasOwnProperty(i)) {
                            content += data.owl[i].item;
                        }
                    }
                    base.$elem.html(content);
                }
                base.logIn();
            }

            if (typeof base.options.beforeInit === "function") {
                base.options.beforeInit.apply(this, [base.$elem]);
            }

            if (typeof base.options.jsonPath === "string") {
                url = base.options.jsonPath;
                $.getJSON(url, getData);
            } else {
                base.logIn();
            }
        },

        logIn : function () {
            var base = this;

            base.$elem.data("owl-originalStyles", base.$elem.attr("style"))
                      .data("owl-originalClasses", base.$elem.attr("class"));

            base.$elem.css({opacity: 0});
            base.orignalItems = base.options.items;
            base.checkBrowser();
            base.wrapperWidth = 0;
            base.checkVisible = null;
            base.setVars();
        },

        setVars : function () {
            var base = this;
            if (base.$elem.children().length === 0) {return false; }
            base.baseClass();
            base.eventTypes();
            base.$userItems = base.$elem.children();
            base.itemsAmount = base.$userItems.length;
            base.wrapItems();
            base.$owlItems = base.$elem.find(".owl-item");
            base.$owlWrapper = base.$elem.find(".owl-wrapper");
            base.playDirection = "next";
            base.prevItem = 0;
            base.prevArr = [0];
            base.currentItem = 0;
            base.customEvents();
            base.onStartup();
        },

        onStartup : function () {
            var base = this;
            base.updateItems();
            base.calculateAll();
            base.buildControls();
            base.updateControls();
            base.response();
            base.moveEvents();
            base.stopOnHover();
            base.owlStatus();

            if (base.options.transitionStyle !== false) {
                base.transitionTypes(base.options.transitionStyle);
            }
            if (base.options.autoPlay === true) {
                base.options.autoPlay = 5000;
            }
            base.play();

            base.$elem.find(".owl-wrapper").css("display", "block");

            if (!base.$elem.is(":visible")) {
                base.watchVisibility();
            } else {
                base.$elem.css("opacity", 1);
            }
            base.onstartup = false;
            base.eachMoveUpdate();
            if (typeof base.options.afterInit === "function") {
                base.options.afterInit.apply(this, [base.$elem]);
            }
        },

        eachMoveUpdate : function () {
            var base = this;

            if (base.options.lazyLoad === true) {
                base.lazyLoad();
            }
            if (base.options.autoHeight === true) {
                base.autoHeight();
            }
            base.onVisibleItems();

            if (typeof base.options.afterAction === "function") {
                base.options.afterAction.apply(this, [base.$elem]);
            }
        },

        updateVars : function () {
            var base = this;
            if (typeof base.options.beforeUpdate === "function") {
                base.options.beforeUpdate.apply(this, [base.$elem]);
            }
            base.watchVisibility();
            base.updateItems();
            base.calculateAll();
            base.updatePosition();
            base.updateControls();
            base.eachMoveUpdate();
            if (typeof base.options.afterUpdate === "function") {
                base.options.afterUpdate.apply(this, [base.$elem]);
            }
        },

        reload : function () {
            var base = this;
            window.setTimeout(function () {
                base.updateVars();
            }, 0);
        },

        watchVisibility : function () {
            var base = this;

            if (base.$elem.is(":visible") === false) {
                base.$elem.css({opacity: 0});
                window.clearInterval(base.autoPlayInterval);
                window.clearInterval(base.checkVisible);
            } else {
                return false;
            }
            base.checkVisible = window.setInterval(function () {
                if (base.$elem.is(":visible")) {
                    base.reload();
                    base.$elem.animate({opacity: 1}, 200);
                    window.clearInterval(base.checkVisible);
                }
            }, 500);
        },

        wrapItems : function () {
            var base = this;
            base.$userItems.wrapAll("<div class=\"owl-wrapper\">").wrap("<div class=\"owl-item\"></div>");
            base.$elem.find(".owl-wrapper").wrap("<div class=\"owl-wrapper-outer\">");
            base.wrapperOuter = base.$elem.find(".owl-wrapper-outer");
            base.$elem.css("display", "block");
        },

        baseClass : function () {
            var base = this,
                hasBaseClass = base.$elem.hasClass(base.options.baseClass),
                hasThemeClass = base.$elem.hasClass(base.options.theme);

            if (!hasBaseClass) {
                base.$elem.addClass(base.options.baseClass);
            }

            if (!hasThemeClass) {
                base.$elem.addClass(base.options.theme);
            }
        },

        updateItems : function () {
            var base = this, width, i;

            if (base.options.responsive === false) {
                return false;
            }
            if (base.options.singleItem === true) {
                base.options.items = base.orignalItems = 1;
                base.options.itemsCustom = false;
                base.options.itemsDesktop = false;
                base.options.itemsDesktopSmall = false;
                base.options.itemsTablet = false;
                base.options.itemsTabletSmall = false;
                base.options.itemsMobile = false;
                return false;
            }

            width = $(base.options.responsiveBaseWidth).width();

            if (width > (base.options.itemsDesktop[0] || base.orignalItems)) {
                base.options.items = base.orignalItems;
            }
            if (base.options.itemsCustom !== false) {
                //Reorder array by screen size
                base.options.itemsCustom.sort(function (a, b) {return a[0] - b[0]; });

                for (i = 0; i < base.options.itemsCustom.length; i += 1) {
                    if (base.options.itemsCustom[i][0] <= width) {
                        base.options.items = base.options.itemsCustom[i][1];
                    }
                }

            } else {

                if (width <= base.options.itemsDesktop[0] && base.options.itemsDesktop !== false) {
                    base.options.items = base.options.itemsDesktop[1];
                }

                if (width <= base.options.itemsDesktopSmall[0] && base.options.itemsDesktopSmall !== false) {
                    base.options.items = base.options.itemsDesktopSmall[1];
                }

                if (width <= base.options.itemsTablet[0] && base.options.itemsTablet !== false) {
                    base.options.items = base.options.itemsTablet[1];
                }

                if (width <= base.options.itemsTabletSmall[0] && base.options.itemsTabletSmall !== false) {
                    base.options.items = base.options.itemsTabletSmall[1];
                }

                if (width <= base.options.itemsMobile[0] && base.options.itemsMobile !== false) {
                    base.options.items = base.options.itemsMobile[1];
                }
            }
			

            //if number of items is less than declared
            if (base.options.items > base.itemsAmount && base.options.itemsScaleUp === true) {
                base.options.items = base.itemsAmount;
            }
        },

        response : function () {
            var base = this,
                smallDelay,
                lastWindowWidth;

            if (base.options.responsive !== true) {
                return false;
            }
            lastWindowWidth = $(window).width();

            base.resizer = function () {
                if ($(window).width() !== lastWindowWidth) {
                    if (base.options.autoPlay !== false) {
                        window.clearInterval(base.autoPlayInterval);
                    }
                    window.clearTimeout(smallDelay);
                    smallDelay = window.setTimeout(function () {
                        lastWindowWidth = $(window).width();
                        base.updateVars();
                    }, base.options.responsiveRefreshRate);
                }
            };
            $(window).resize(base.resizer);
        },

        updatePosition : function () {
            var base = this;
            base.jumpTo(base.currentItem);
            if (base.options.autoPlay !== false) {
                base.checkAp();
            }
        },

        appendItemsSizes : function () {
            var base = this,
                roundPages = 0,
                lastItem = base.itemsAmount - base.options.items;

            base.$owlItems.each(function (index) {
                var $this = $(this);
                $this
                    .css({"width": base.itemWidth})
                    .data("owl-item", Number(index));

                if (index % base.options.items === 0 || index === lastItem) {
                    if (!(index > lastItem)) {
                        roundPages += 1;
                    }
                }
                $this.data("owl-roundPages", roundPages);
            });
        },

        appendWrapperSizes : function () {
            var base = this,
                width = base.$owlItems.length * base.itemWidth;

            base.$owlWrapper.css({
                "width": width * 2,
                "left": 0
            });
            base.appendItemsSizes();
        },

        calculateAll : function () {
            var base = this;
            base.calculateWidth();
            base.appendWrapperSizes();
            base.loops();
            base.max();
        },

        calculateWidth : function () {
            var base = this;
            base.itemWidth = Math.round(base.$elem.width() / base.options.items);
        },

        max : function () {
            var base = this,
                maximum = ((base.itemsAmount * base.itemWidth) - base.options.items * base.itemWidth) * -1;
            if (base.options.items > base.itemsAmount) {
                base.maximumItem = 0;
                maximum = 0;
                base.maximumPixels = 0;
            } else {
                base.maximumItem = base.itemsAmount - base.options.items;
                base.maximumPixels = maximum;
            }
            return maximum;
        },

        min : function () {
            return 0;
        },

        loops : function () {
            var base = this,
                prev = 0,
                elWidth = 0,
                i,
                item,
                roundPageNum;

            base.positionsInArray = [0];
            base.pagesInArray = [];

            for (i = 0; i < base.itemsAmount; i += 1) {
                elWidth += base.itemWidth;
                base.positionsInArray.push(-elWidth);

                if (base.options.scrollPerPage === true) {
                    item = $(base.$owlItems[i]);
                    roundPageNum = item.data("owl-roundPages");
                    if (roundPageNum !== prev) {
                        base.pagesInArray[prev] = base.positionsInArray[i];
                        prev = roundPageNum;
                    }
                }
            }
        },

        buildControls : function () {
            var base = this;
            if (base.options.navigation === true || base.options.pagination === true) {
                base.owlControls = $("<div class=\"owl-controls\"/>").toggleClass("clickable", !base.browser.isTouch).appendTo(base.$elem);
            }
            if (base.options.pagination === true) {
                base.buildPagination();
            }
            if (base.options.navigation === true) {
                base.buildButtons();
            }
        },

        buildButtons : function () {
            var base = this,
                buttonsWrapper = $("<div class=\"owl-buttons\"/>");
            base.owlControls.append(buttonsWrapper);

            base.buttonPrev = $("<div/>", {
                "class" : "owl-prev",
                "html" : base.options.navigationText[0] || ""
            });

            base.buttonNext = $("<div/>", {
                "class" : "owl-next",
                "html" : base.options.navigationText[1] || ""
            });

            buttonsWrapper
                .append(base.buttonPrev)
                .append(base.buttonNext);

            buttonsWrapper.on("touchstart.owlControls mousedown.owlControls", "div[class^=\"owl\"]", function (event) {
                event.preventDefault();
            });

            buttonsWrapper.on("touchend.owlControls mouseup.owlControls", "div[class^=\"owl\"]", function (event) {
                event.preventDefault();
                if ($(this).hasClass("owl-next")) {
                    base.next();
                } else {
                    base.prev();
                }
            });
        },

        buildPagination : function () {
            var base = this;

            base.paginationWrapper = $("<div class=\"owl-pagination\"/>");
            base.owlControls.append(base.paginationWrapper);

            base.paginationWrapper.on("touchend.owlControls mouseup.owlControls", ".owl-page", function (event) {
                event.preventDefault();
                if (Number($(this).data("owl-page")) !== base.currentItem) {
                    base.goTo(Number($(this).data("owl-page")), true);
                }
            });
        },

        updatePagination : function () {
            var base = this,
                counter,
                lastPage,
                lastItem,
                i,
                paginationButton,
                paginationButtonInner;

            if (base.options.pagination === false) {
                return false;
            }

            base.paginationWrapper.html("");

            counter = 0;
            lastPage = base.itemsAmount - base.itemsAmount % base.options.items;

            for (i = 0; i < base.itemsAmount; i += 1) {
                if (i % base.options.items === 0) {
                    counter += 1;
                    if (lastPage === i) {
                        lastItem = base.itemsAmount - base.options.items;
                    }
                    paginationButton = $("<div/>", {
                        "class" : "owl-page"
                    });
                    paginationButtonInner = $("<span></span>", {
                        "text": base.options.paginationNumbers === true ? counter : "",
                        "class": base.options.paginationNumbers === true ? "owl-numbers" : ""
                    });
                    paginationButton.append(paginationButtonInner);

                    paginationButton.data("owl-page", lastPage === i ? lastItem : i);
                    paginationButton.data("owl-roundPages", counter);

                    base.paginationWrapper.append(paginationButton);
                }
            }
            base.checkPagination();
        },
        checkPagination : function () {
            var base = this;
            if (base.options.pagination === false) {
                return false;
            }
            base.paginationWrapper.find(".owl-page").each(function () {
                if ($(this).data("owl-roundPages") === $(base.$owlItems[base.currentItem]).data("owl-roundPages")) {
                    base.paginationWrapper
                        .find(".owl-page")
                        .removeClass("active");
                    $(this).addClass("active");
                }
            });
        },

        checkNavigation : function () {
            var base = this;

            if (base.options.navigation === false) {
                return false;
            }
            if (base.options.rewindNav === false) {
                if (base.currentItem === 0 && base.maximumItem === 0) {
                    base.buttonPrev.addClass("disabled");
                    base.buttonNext.addClass("disabled");
                } else if (base.currentItem === 0 && base.maximumItem !== 0) {
                    base.buttonPrev.addClass("disabled");
                    base.buttonNext.removeClass("disabled");
                } else if (base.currentItem === base.maximumItem) {
                    base.buttonPrev.removeClass("disabled");
                    base.buttonNext.addClass("disabled");
                } else if (base.currentItem !== 0 && base.currentItem !== base.maximumItem) {
                    base.buttonPrev.removeClass("disabled");
                    base.buttonNext.removeClass("disabled");
                }
            }
        },

        updateControls : function () {
            var base = this;
            base.updatePagination();
            base.checkNavigation();
            if (base.owlControls) {
                if (base.options.items >= base.itemsAmount) {
                    base.owlControls.hide();
                } else {
                    base.owlControls.show();
                }
            }
        },

        destroyControls : function () {
            var base = this;
            if (base.owlControls) {
                base.owlControls.remove();
            }
        },

        next : function (speed) {
            var base = this;

            if (base.isTransition) {
                return false;
            }

            base.currentItem += base.options.scrollPerPage === true ? base.options.items : 1;
            if (base.currentItem > base.maximumItem + (base.options.scrollPerPage === true ? (base.options.items - 1) : 0)) {
                if (base.options.rewindNav === true) {
                    base.currentItem = 0;
                    speed = "rewind";
                } else {
                    base.currentItem = base.maximumItem;
                    return false;
                }
            }
            base.goTo(base.currentItem, speed);
        },

        prev : function (speed) {
            var base = this;

            if (base.isTransition) {
                return false;
            }

            if (base.options.scrollPerPage === true && base.currentItem > 0 && base.currentItem < base.options.items) {
                base.currentItem = 0;
            } else {
                base.currentItem -= base.options.scrollPerPage === true ? base.options.items : 1;
            }
            if (base.currentItem < 0) {
                if (base.options.rewindNav === true) {
                    base.currentItem = base.maximumItem;
                    speed = "rewind";
                } else {
                    base.currentItem = 0;
                    return false;
                }
            }
            base.goTo(base.currentItem, speed);
        },

        goTo : function (position, speed, drag) {
            var base = this,
                goToPixel;

            if (base.isTransition) {
                return false;
            }
            if (typeof base.options.beforeMove === "function") {
                base.options.beforeMove.apply(this, [base.$elem]);
            }
            if (position >= base.maximumItem) {
                position = base.maximumItem;
            } else if (position <= 0) {
                position = 0;
            }

            base.currentItem = base.owl.currentItem = position;
            if (base.options.transitionStyle !== false && drag !== "drag" && base.options.items === 1 && base.browser.support3d === true) {
                base.swapSpeed(0);
                if (base.browser.support3d === true) {
                    base.transition3d(base.positionsInArray[position]);
                } else {
                    base.css2slide(base.positionsInArray[position], 1);
                }
                base.afterGo();
                base.singleItemTransition();
                return false;
            }
            goToPixel = base.positionsInArray[position];

            if (base.browser.support3d === true) {
                base.isCss3Finish = false;

                if (speed === true) {
                    base.swapSpeed("paginationSpeed");
                    window.setTimeout(function () {
                        base.isCss3Finish = true;
                    }, base.options.paginationSpeed);

                } else if (speed === "rewind") {
                    base.swapSpeed(base.options.rewindSpeed);
                    window.setTimeout(function () {
                        base.isCss3Finish = true;
                    }, base.options.rewindSpeed);

                } else {
                    base.swapSpeed("slideSpeed");
                    window.setTimeout(function () {
                        base.isCss3Finish = true;
                    }, base.options.slideSpeed);
                }
                base.transition3d(goToPixel);
            } else {
                if (speed === true) {
                    base.css2slide(goToPixel, base.options.paginationSpeed);
                } else if (speed === "rewind") {
                    base.css2slide(goToPixel, base.options.rewindSpeed);
                } else {
                    base.css2slide(goToPixel, base.options.slideSpeed);
                }
            }
            base.afterGo();
        },

        jumpTo : function (position) {
            var base = this;
            if (typeof base.options.beforeMove === "function") {
                base.options.beforeMove.apply(this, [base.$elem]);
            }
            if (position >= base.maximumItem || position === -1) {
                position = base.maximumItem;
            } else if (position <= 0) {
                position = 0;
            }
            base.swapSpeed(0);
            if (base.browser.support3d === true) {
                base.transition3d(base.positionsInArray[position]);
            } else {
                base.css2slide(base.positionsInArray[position], 1);
            }
            base.currentItem = base.owl.currentItem = position;
            base.afterGo();
        },

        afterGo : function () {
            var base = this;

            base.prevArr.push(base.currentItem);
            base.prevItem = base.owl.prevItem = base.prevArr[base.prevArr.length - 2];
            base.prevArr.shift(0);

            if (base.prevItem !== base.currentItem) {
                base.checkPagination();
                base.checkNavigation();
                base.eachMoveUpdate();

                if (base.options.autoPlay !== false) {
                    base.checkAp();
                }
            }
            if (typeof base.options.afterMove === "function" && base.prevItem !== base.currentItem) {
                base.options.afterMove.apply(this, [base.$elem]);
            }
        },

        stop : function () {
            var base = this;
            base.apStatus = "stop";
            window.clearInterval(base.autoPlayInterval);
        },

        checkAp : function () {
            var base = this;
            if (base.apStatus !== "stop") {
                base.play();
            }
        },

        play : function () {
            var base = this;
            base.apStatus = "play";
            if (base.options.autoPlay === false) {
                return false;
            }
            window.clearInterval(base.autoPlayInterval);
            base.autoPlayInterval = window.setInterval(function () {
                base.next(true);
            }, base.options.autoPlay);
        },

        swapSpeed : function (action) {
            var base = this;
            if (action === "slideSpeed") {
                base.$owlWrapper.css(base.addCssSpeed(base.options.slideSpeed));
            } else if (action === "paginationSpeed") {
                base.$owlWrapper.css(base.addCssSpeed(base.options.paginationSpeed));
            } else if (typeof action !== "string") {
                base.$owlWrapper.css(base.addCssSpeed(action));
            }
        },

        addCssSpeed : function (speed) {
            return {
                "-webkit-transition": "all " + speed + "ms ease",
                "-moz-transition": "all " + speed + "ms ease",
                "-o-transition": "all " + speed + "ms ease",
                "transition": "all " + speed + "ms ease"
            };
        },

        removeTransition : function () {
            return {
                "-webkit-transition": "",
                "-moz-transition": "",
                "-o-transition": "",
                "transition": ""
            };
        },

        doTranslate : function (pixels) {
            return {
                "-webkit-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "-moz-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "-o-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "-ms-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "transform": "translate3d(" + pixels + "px, 0px,0px)"
            };
        },

        transition3d : function (value) {
            var base = this;
            base.$owlWrapper.css(base.doTranslate(value));
        },

        css2move : function (value) {
            var base = this;
            base.$owlWrapper.css({"left" : value});
        },

        css2slide : function (value, speed) {
            var base = this;

            base.isCssFinish = false;
            base.$owlWrapper.stop(true, true).animate({
                "left" : value
            }, {
                duration : speed || base.options.slideSpeed,
                complete : function () {
                    base.isCssFinish = true;
                }
            });
        },

        checkBrowser : function () {
            var base = this,
                translate3D = "translate3d(0px, 0px, 0px)",
                tempElem = document.createElement("div"),
                regex,
                asSupport,
                support3d,
                isTouch;

            tempElem.style.cssText = "  -moz-transform:" + translate3D +
                                  "; -ms-transform:"     + translate3D +
                                  "; -o-transform:"      + translate3D +
                                  "; -webkit-transform:" + translate3D +
                                  "; transform:"         + translate3D;
            regex = /translate3d\(0px, 0px, 0px\)/g;
            asSupport = tempElem.style.cssText.match(regex);
            support3d = (asSupport !== null && asSupport.length === 1);

            isTouch = "ontouchstart" in window || window.navigator.msMaxTouchPoints;

            base.browser = {
                "support3d" : support3d,
                "isTouch" : isTouch
            };
        },

        moveEvents : function () {
            var base = this;
            if (base.options.mouseDrag !== false || base.options.touchDrag !== false) {
                base.gestures();
                base.disabledEvents();
            }
        },

        eventTypes : function () {
            var base = this,
                types = ["s", "e", "x"];

            base.ev_types = {};

            if (base.options.mouseDrag === true && base.options.touchDrag === true) {
                types = [
                    "touchstart.owl mousedown.owl",
                    "touchmove.owl mousemove.owl",
                    "touchend.owl touchcancel.owl mouseup.owl"
                ];
            } else if (base.options.mouseDrag === false && base.options.touchDrag === true) {
                types = [
                    "touchstart.owl",
                    "touchmove.owl",
                    "touchend.owl touchcancel.owl"
                ];
            } else if (base.options.mouseDrag === true && base.options.touchDrag === false) {
                types = [
                    "mousedown.owl",
                    "mousemove.owl",
                    "mouseup.owl"
                ];
            }

            base.ev_types.start = types[0];
            base.ev_types.move = types[1];
            base.ev_types.end = types[2];
        },

        disabledEvents :  function () {
            var base = this;
            base.$elem.on("dragstart.owl", function (event) { event.preventDefault(); });
            base.$elem.on("mousedown.disableTextSelect", function (e) {
                return $(e.target).is('input, textarea, select, option');
            });
        },

        gestures : function () {
            /*jslint unparam: true*/
            var base = this,
                locals = {
                    offsetX : 0,
                    offsetY : 0,
                    baseElWidth : 0,
                    relativePos : 0,
                    position: null,
                    minSwipe : null,
                    maxSwipe: null,
                    sliding : null,
                    dargging: null,
                    targetElement : null
                };

            base.isCssFinish = true;

            function getTouches(event) {
                if (event.touches !== undefined) {
                    return {
                        x : event.touches[0].pageX,
                        y : event.touches[0].pageY
                    };
                }

                if (event.touches === undefined) {
                    if (event.pageX !== undefined) {
                        return {
                            x : event.pageX,
                            y : event.pageY
                        };
                    }
                    if (event.pageX === undefined) {
                        return {
                            x : event.clientX,
                            y : event.clientY
                        };
                    }
                }
            }

            function swapEvents(type) {
                if (type === "on") {
                    $(document).on(base.ev_types.move, dragMove);
                    $(document).on(base.ev_types.end, dragEnd);
                } else if (type === "off") {
                    $(document).off(base.ev_types.move);
                    $(document).off(base.ev_types.end);
                }
            }

            function dragStart(event) {
                var ev = event.originalEvent || event || window.event,
                    position;

                if (ev.which === 3) {
                    return false;
                }
                if (base.itemsAmount <= base.options.items) {
                    return;
                }
                if (base.isCssFinish === false && !base.options.dragBeforeAnimFinish) {
                    return false;
                }
                if (base.isCss3Finish === false && !base.options.dragBeforeAnimFinish) {
                    return false;
                }

                if (base.options.autoPlay !== false) {
                    window.clearInterval(base.autoPlayInterval);
                }

                if (base.browser.isTouch !== true && !base.$owlWrapper.hasClass("grabbing")) {
                    base.$owlWrapper.addClass("grabbing");
                }

                base.newPosX = 0;
                base.newRelativeX = 0;

                $(this).css(base.removeTransition());

                position = $(this).position();
                locals.relativePos = position.left;

                locals.offsetX = getTouches(ev).x - position.left;
                locals.offsetY = getTouches(ev).y - position.top;

                swapEvents("on");

                locals.sliding = false;
                locals.targetElement = ev.target || ev.srcElement;
            }

            function dragMove(event) {
                var ev = event.originalEvent || event || window.event,
                    minSwipe,
                    maxSwipe;

                base.newPosX = getTouches(ev).x - locals.offsetX;
                base.newPosY = getTouches(ev).y - locals.offsetY;
                base.newRelativeX = base.newPosX - locals.relativePos;

                if (typeof base.options.startDragging === "function" && locals.dragging !== true && base.newRelativeX !== 0) {
                    locals.dragging = true;
                    base.options.startDragging.apply(base, [base.$elem]);
                }

                if ((base.newRelativeX > 8 || base.newRelativeX < -8) && (base.browser.isTouch === true)) {
                    if (ev.preventDefault !== undefined) {
                        ev.preventDefault();
                    } else {
                        ev.returnValue = false;
                    }
                    locals.sliding = true;
                }

                if ((base.newPosY > 10 || base.newPosY < -10) && locals.sliding === false) {
                    $(document).off("touchmove.owl");
                }

                minSwipe = function () {
                    return base.newRelativeX / 5;
                };

                maxSwipe = function () {
                    return base.maximumPixels + base.newRelativeX / 5;
                };

                base.newPosX = Math.max(Math.min(base.newPosX, minSwipe()), maxSwipe());
                if (base.browser.support3d === true) {
                    base.transition3d(base.newPosX);
                } else {
                    base.css2move(base.newPosX);
                }
            }

            function dragEnd(event) {
                var ev = event.originalEvent || event || window.event,
                    newPosition,
                    handlers,
                    owlStopEvent;

                ev.target = ev.target || ev.srcElement;

                locals.dragging = false;

                if (base.browser.isTouch !== true) {
                    base.$owlWrapper.removeClass("grabbing");
                }

                if (base.newRelativeX < 0) {
                    base.dragDirection = base.owl.dragDirection = "left";
                } else {
                    base.dragDirection = base.owl.dragDirection = "right";
                }

                if (base.newRelativeX !== 0) {
                    newPosition = base.getNewPosition();
                    base.goTo(newPosition, false, "drag");
                    if (locals.targetElement === ev.target && base.browser.isTouch !== true) {
                        $(ev.target).on("click.disable", function (ev) {
                            ev.stopImmediatePropagation();
                            ev.stopPropagation();
                            ev.preventDefault();
                            $(ev.target).off("click.disable");
                        });
                        handlers = $._data(ev.target, "events").click;
                        owlStopEvent = handlers.pop();
                        handlers.splice(0, 0, owlStopEvent);
                    }
                }
                swapEvents("off");
            }
            base.$elem.on(base.ev_types.start, ".owl-wrapper", dragStart);
        },

        getNewPosition : function () {
            var base = this,
                newPosition = base.closestItem();

            if (newPosition > base.maximumItem) {
                base.currentItem = base.maximumItem;
                newPosition  = base.maximumItem;
            } else if (base.newPosX >= 0) {
                newPosition = 0;
                base.currentItem = 0;
            }
            return newPosition;
        },
        closestItem : function () {
            var base = this,
                array = base.options.scrollPerPage === true ? base.pagesInArray : base.positionsInArray,
                goal = base.newPosX,
                closest = null;

            $.each(array, function (i, v) {
                if (goal - (base.itemWidth / 20) > array[i + 1] && goal - (base.itemWidth / 20) < v && base.moveDirection() === "left") {
                    closest = v;
                    if (base.options.scrollPerPage === true) {
                        base.currentItem = $.inArray(closest, base.positionsInArray);
                    } else {
                        base.currentItem = i;
                    }
                } else if (goal + (base.itemWidth / 20) < v && goal + (base.itemWidth / 20) > (array[i + 1] || array[i] - base.itemWidth) && base.moveDirection() === "right") {
                    if (base.options.scrollPerPage === true) {
                        closest = array[i + 1] || array[array.length - 1];
                        base.currentItem = $.inArray(closest, base.positionsInArray);
                    } else {
                        closest = array[i + 1];
                        base.currentItem = i + 1;
                    }
                }
            });
            return base.currentItem;
        },

        moveDirection : function () {
            var base = this,
                direction;
            if (base.newRelativeX < 0) {
                direction = "right";
                base.playDirection = "next";
            } else {
                direction = "left";
                base.playDirection = "prev";
            }
            return direction;
        },

        customEvents : function () {
            /*jslint unparam: true*/
            var base = this;
            base.$elem.on("owl.next", function () {
                base.next();
            });
            base.$elem.on("owl.prev", function () {
                base.prev();
            });
            base.$elem.on("owl.play", function (event, speed) {
                base.options.autoPlay = speed;
                base.play();
                base.hoverStatus = "play";
            });
            base.$elem.on("owl.stop", function () {
                base.stop();
                base.hoverStatus = "stop";
            });
            base.$elem.on("owl.goTo", function (event, item) {
                base.goTo(item);
            });
            base.$elem.on("owl.jumpTo", function (event, item) {
                base.jumpTo(item);
            });
        },

        stopOnHover : function () {
            var base = this;
            if (base.options.stopOnHover === true && base.browser.isTouch !== true && base.options.autoPlay !== false) {
                base.$elem.on("mouseover", function () {
                    base.stop();
                });
                base.$elem.on("mouseout", function () {
                    if (base.hoverStatus !== "stop") {
                        base.play();
                    }
                });
            }
        },

        lazyLoad : function () {
            var base = this,
                i,
                $item,
                itemNumber,
                $lazyImg,
                follow;

            if (base.options.lazyLoad === false) {
                return false;
            }
            for (i = 0; i < base.itemsAmount; i += 1) {
                $item = $(base.$owlItems[i]);

                if ($item.data("owl-loaded") === "loaded") {
                    continue;
                }

                itemNumber = $item.data("owl-item");
                $lazyImg = $item.find(".lazyOwl");

                if (typeof $lazyImg.data("src") !== "string") {
                    $item.data("owl-loaded", "loaded");
                    continue;
                }
                if ($item.data("owl-loaded") === undefined) {
                    $lazyImg.hide();
                    $item.addClass("loading").data("owl-loaded", "checked");
                }
                if (base.options.lazyFollow === true) {
                    follow = itemNumber >= base.currentItem;
                } else {
                    follow = true;
                }
                if (follow && itemNumber < base.currentItem + base.options.items && $lazyImg.length) {
                    base.lazyPreload($item, $lazyImg);
                }
            }
        },

        lazyPreload : function ($item, $lazyImg) {
            var base = this,
                iterations = 0,
                isBackgroundImg;

            if ($lazyImg.prop("tagName") === "DIV") {
                $lazyImg.css("background-image", "url(" + $lazyImg.data("src") + ")");
                isBackgroundImg = true;
            } else {
                $lazyImg[0].src = $lazyImg.data("src");
            }

            function showImage() {
                $item.data("owl-loaded", "loaded").removeClass("loading");
                $lazyImg.removeAttr("data-src");
                if (base.options.lazyEffect === "fade") {
                    $lazyImg.fadeIn(400);
                } else {
                    $lazyImg.show();
                }
                if (typeof base.options.afterLazyLoad === "function") {
                    base.options.afterLazyLoad.apply(this, [base.$elem]);
                }
            }

            function checkLazyImage() {
                iterations += 1;
                if (base.completeImg($lazyImg.get(0)) || isBackgroundImg === true) {
                    showImage();
                } else if (iterations <= 100) {//if image loads in less than 10 seconds 
                    window.setTimeout(checkLazyImage, 100);
                } else {
                    showImage();
                }
            }

            checkLazyImage();
        },

        autoHeight : function () {
            var base = this,
                $currentimg = $(base.$owlItems[base.currentItem]).find("img"),
                iterations;

            function addHeight() {
                var $currentItem = $(base.$owlItems[base.currentItem]).height();
                base.wrapperOuter.css("height", $currentItem + "px");
                if (!base.wrapperOuter.hasClass("autoHeight")) {
                    window.setTimeout(function () {
                        base.wrapperOuter.addClass("autoHeight");
                    }, 0);
                }
            }

            function checkImage() {
                iterations += 1;
                if (base.completeImg($currentimg.get(0))) {
                    addHeight();
                } else if (iterations <= 100) { //if image loads in less than 10 seconds 
                    window.setTimeout(checkImage, 100);
                } else {
                    base.wrapperOuter.css("height", ""); //Else remove height attribute
                }
            }

            if ($currentimg.get(0) !== undefined) {
                iterations = 0;
                checkImage();
            } else {
                addHeight();
            }
        },

        completeImg : function (img) {
            var naturalWidthType;

            if (!img.complete) {
                return false;
            }
            naturalWidthType = typeof img.naturalWidth;
            if (naturalWidthType !== "undefined" && img.naturalWidth === 0) {
                return false;
            }
            return true;
        },

        onVisibleItems : function () {
            var base = this,
                i;

            if (base.options.addClassActive === true) {
                base.$owlItems.removeClass("active");
            }
            base.visibleItems = [];
            for (i = base.currentItem; i < base.currentItem + base.options.items; i += 1) {
                base.visibleItems.push(i);

                if (base.options.addClassActive === true) {
                    $(base.$owlItems[i]).addClass("active");
                }
            }
            base.owl.visibleItems = base.visibleItems;
        },

        transitionTypes : function (className) {
            var base = this;
            //Currently available: "fade", "backSlide", "goDown", "fadeUp"
            base.outClass = "owl-" + className + "-out";
            base.inClass = "owl-" + className + "-in";
        },

        singleItemTransition : function () {
            var base = this,
                outClass = base.outClass,
                inClass = base.inClass,
                $currentItem = base.$owlItems.eq(base.currentItem),
                $prevItem = base.$owlItems.eq(base.prevItem),
                prevPos = Math.abs(base.positionsInArray[base.currentItem]) + base.positionsInArray[base.prevItem],
                origin = Math.abs(base.positionsInArray[base.currentItem]) + base.itemWidth / 2,
                animEnd = 'webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend';

            base.isTransition = true;

            base.$owlWrapper
                .addClass('owl-origin')
                .css({
                    "-webkit-transform-origin" : origin + "px",
                    "-moz-perspective-origin" : origin + "px",
                    "perspective-origin" : origin + "px"
                });
            function transStyles(prevPos) {
                return {
                    "position" : "relative",
                    "left" : prevPos + "px"
                };
            }

            $prevItem
                .css(transStyles(prevPos, 10))
                .addClass(outClass)
                .on(animEnd, function () {
                    base.endPrev = true;
                    $prevItem.off(animEnd);
                    base.clearTransStyle($prevItem, outClass);
                });

            $currentItem
                .addClass(inClass)
                .on(animEnd, function () {
                    base.endCurrent = true;
                    $currentItem.off(animEnd);
                    base.clearTransStyle($currentItem, inClass);
                });
        },

        clearTransStyle : function (item, classToRemove) {
            var base = this;
            item.css({
                "position" : "",
                "left" : ""
            }).removeClass(classToRemove);

            if (base.endPrev && base.endCurrent) {
                base.$owlWrapper.removeClass('owl-origin');
                base.endPrev = false;
                base.endCurrent = false;
                base.isTransition = false;
            }
        },

        owlStatus : function () {
            var base = this;
            base.owl = {
                "userOptions"   : base.userOptions,
                "baseElement"   : base.$elem,
                "userItems"     : base.$userItems,
                "owlItems"      : base.$owlItems,
                "currentItem"   : base.currentItem,
                "prevItem"      : base.prevItem,
                "visibleItems"  : base.visibleItems,
                "isTouch"       : base.browser.isTouch,
                "browser"       : base.browser,
                "dragDirection" : base.dragDirection
            };
        },

        clearEvents : function () {
            var base = this;
            base.$elem.off(".owl owl mousedown.disableTextSelect");
            $(document).off(".owl owl");
            $(window).off("resize", base.resizer);
        },

        unWrap : function () {
            var base = this;
            if (base.$elem.children().length !== 0) {
                base.$owlWrapper.unwrap();
                base.$userItems.unwrap().unwrap();
                if (base.owlControls) {
                    base.owlControls.remove();
                }
            }
            base.clearEvents();
            base.$elem
                .attr("style", base.$elem.data("owl-originalStyles") || "")
                .attr("class", base.$elem.data("owl-originalClasses"));
        },

        destroy : function () {
            var base = this;
            base.stop();
            window.clearInterval(base.checkVisible);
            base.unWrap();
            base.$elem.removeData();
        },

        reinit : function (newOptions) {
            var base = this,
                options = $.extend({}, base.userOptions, newOptions);
            base.unWrap();
            base.init(options, base.$elem);
        },

        addItem : function (htmlString, targetPosition) {
            var base = this,
                position;

            if (!htmlString) {return false; }

            if (base.$elem.children().length === 0) {
                base.$elem.append(htmlString);
                base.setVars();
                return false;
            }
            base.unWrap();
            if (targetPosition === undefined || targetPosition === -1) {
                position = -1;
            } else {
                position = targetPosition;
            }
            if (position >= base.$userItems.length || position === -1) {
                base.$userItems.eq(-1).after(htmlString);
            } else {
                base.$userItems.eq(position).before(htmlString);
            }

            base.setVars();
        },

        removeItem : function (targetPosition) {
            var base = this,
                position;

            if (base.$elem.children().length === 0) {
                return false;
            }
            if (targetPosition === undefined || targetPosition === -1) {
                position = -1;
            } else {
                position = targetPosition;
            }

            base.unWrap();
            base.$userItems.eq(position).remove();
            base.setVars();
        }

    };

    $.fn.owlCarousel = function (options) {
        return this.each(function () {
            if ($(this).data("owl-init") === true) {
                return false;
            }
            $(this).data("owl-init", true);
            var carousel = Object.create(Carousel);
            carousel.init(options, this);
            $.data(this, "owlCarousel", carousel);
        });
    };

    $.fn.owlCarousel.options = {

        items : 5,
        itemsCustom : false,
        itemsDesktop : [1199, 4],
        itemsDesktopSmall : [979, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 1],
	     singleItem : false,
        itemsScaleUp : false,

        slideSpeed : 200,
        paginationSpeed : 800,
        rewindSpeed : 1000,

        autoPlay : false,
        stopOnHover : false,

        navigation : false,
        navigationText : ["prev", "next"],
        rewindNav : true,
        scrollPerPage : false,

        pagination : true,
        paginationNumbers : false,

        responsive : true,
        responsiveRefreshRate : 200,
        responsiveBaseWidth : window,

        baseClass : "owl-carousel",
        theme : "owl-theme",

        lazyLoad : false,
        lazyFollow : true,
        lazyEffect : "fade",

        autoHeight : false,

        jsonPath : false,
        jsonSuccess : false,

        dragBeforeAnimFinish : true,
        mouseDrag : true,
        touchDrag : true,

        addClassActive : false,
        transitionStyle : false,

        beforeUpdate : false,
        afterUpdate : false,
        beforeInit : false,
        afterInit : false,
        beforeMove : false,
        afterMove : false,
        afterAction : false,
        startDragging : false,
        afterLazyLoad: false
    };
}(jQuery, window, document));
/***** Total Storage Js *****/

(function($){var ls=window.localStorage;var supported;if(typeof ls=='undefined'||typeof window.JSON=='undefined'){supported=false;}else{supported=true;}
$.totalStorage=function(key,value,options){return $.totalStorage.impl.init(key,value);}
$.totalStorage.setItem=function(key,value){return $.totalStorage.impl.setItem(key,value);}
$.totalStorage.getItem=function(key){return $.totalStorage.impl.getItem(key);}
$.totalStorage.getAll=function(){return $.totalStorage.impl.getAll();}
$.totalStorage.deleteItem=function(key){return $.totalStorage.impl.deleteItem(key);}
$.totalStorage.impl={init:function(key,value){if(typeof value!='undefined'){return this.setItem(key,value);}else{return this.getItem(key);}},setItem:function(key,value){if(!supported){try{$.cookie(key,value);return value;}catch(e){console.log('Local Storage not supported by this browser. Install the cookie plugin on your site to take advantage of the same functionality. You can get it at https://github.com/carhartl/jquery-cookie');}}
var saver=JSON.stringify(value);ls.setItem(key,saver);return this.parseResult(saver);},getItem:function(key){if(!supported){try{return this.parseResult($.cookie(key));}catch(e){return null;}}
return this.parseResult(ls.getItem(key));},deleteItem:function(key){if(!supported){try{$.cookie(key,null);return true;}catch(e){return false;}}
ls.removeItem(key);return true;},getAll:function(){var items=new Array();if(!supported){try{var pairs=document.cookie.split(";");for(var i=0;i<pairs.length;i++){var pair=pairs[i].split('=');var key=pair[0];items.push({key:key,value:this.parseResult($.cookie(key))});}}catch(e){return null;}}else{for(var i in ls){if(i.length){items.push({key:i,value:this.parseResult(ls.getItem(i))});}}}
return items;},parseResult:function(res){var ret;try{ret=JSON.parse(res);if(ret=='true'){ret=true;}
if(ret=='false'){ret=false;}
if(parseFloat(ret)==ret&&typeof ret!="object"){ret=parseFloat(ret);}}catch(e){}
return ret;}}})(jQuery);
/*!
 * Lightbox v2.9.0
 * by Lokesh Dhakar
 *
 * More info:
 * http://lokeshdhakar.com/projects/lightbox2/
 *
 * Copyright 2007, 2015 Lokesh Dhakar
 * Released under the MIT license
 * https://github.com/lokesh/lightbox2/blob/master/LICENSE
 *
 * @preserve
 */

// Uses Node, AMD or browser globals to create a module.
(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node. Does not work with strict CommonJS, but
        // only CommonJS-like environments that support module.exports,
        // like Node.
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals (root is window)
        root.lightbox = factory(root.jQuery);
    }
}(this, function ($) {

  function Lightbox(options) {
    this.album = [];
    this.currentImageIndex = void 0;
    this.init();

    // options
    this.options = $.extend({}, this.constructor.defaults);
    this.option(options);
  }

  // Descriptions of all options available on the demo site:
  // http://lokeshdhakar.com/projects/lightbox2/index.html#options
  Lightbox.defaults = {
    albumLabel: 'Image %1 of %2',
    alwaysShowNavOnTouchDevices: false,
    fadeDuration: 600,
    fitImagesInViewport: true,
    imageFadeDuration: 600,
    // maxWidth: 800,
    // maxHeight: 600,
    positionFromTop: 50,
    resizeDuration: 700,
    showImageNumberLabel: true,
    wrapAround: false,
    disableScrolling: false,
    /*
    Sanitize Title
    If the caption data is trusted, for example you are hardcoding it in, then leave this to false.
    This will free you to add html tags, such as links, in the caption.

    If the caption data is user submitted or from some other untrusted source, then set this to true
    to prevent xss and other injection attacks.
     */
    sanitizeTitle: false
  };

  Lightbox.prototype.option = function(options) {
    $.extend(this.options, options);
  };

  Lightbox.prototype.imageCountLabel = function(currentImageNum, totalImages) {
    return this.options.albumLabel.replace(/%1/g, currentImageNum).replace(/%2/g, totalImages);
  };

  Lightbox.prototype.init = function() {
    var self = this;
    // Both enable and build methods require the body tag to be in the DOM.
    $(document).ready(function() {
      self.enable();
      self.build();
    });
  };

  // Loop through anchors and areamaps looking for either data-lightbox attributes or rel attributes
  // that contain 'lightbox'. When these are clicked, start lightbox.
  Lightbox.prototype.enable = function() {
    var self = this;
    $('body').on('click', 'a[rel^=lightbox], area[rel^=lightbox], a[data-lightbox], area[data-lightbox]', function(event) {
      self.start($(event.currentTarget));
      return false;
    });
  };

  // Build html for the lightbox and the overlay.
  // Attach event handlers to the new DOM elements. click click click
  Lightbox.prototype.build = function() {
    var self = this;
    $('<div id="lightboxOverlay" class="lightboxOverlay"></div><div id="lightbox" class="lightbox"><div class="lb-outerContainer"><div class="lb-container"><img class="lb-image" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" /><div class="lb-nav"><a class="lb-prev" href="" ></a><a class="lb-next" href="" ></a></div><div class="lb-loader"><a class="lb-cancel"></a></div></div></div><div class="lb-dataContainer"><div class="lb-data"><div class="lb-details"><span class="lb-caption"></span><span class="lb-number"></span></div><div class="lb-closeContainer"><a class="lb-close"></a></div></div></div></div>').appendTo($('body'));

    // Cache jQuery objects
    this.$lightbox       = $('#lightbox');
    this.$overlay        = $('#lightboxOverlay');
    this.$outerContainer = this.$lightbox.find('.lb-outerContainer');
    this.$container      = this.$lightbox.find('.lb-container');
    this.$image          = this.$lightbox.find('.lb-image');
    this.$nav            = this.$lightbox.find('.lb-nav');

    // Store css values for future lookup
    this.containerPadding = {
      top: parseInt(this.$container.css('padding-top'), 10),
      right: parseInt(this.$container.css('padding-right'), 10),
      bottom: parseInt(this.$container.css('padding-bottom'), 10),
      left: parseInt(this.$container.css('padding-left'), 10)
    };

    this.imageBorderWidth = {
      top: parseInt(this.$image.css('border-top-width'), 10),
      right: parseInt(this.$image.css('border-right-width'), 10),
      bottom: parseInt(this.$image.css('border-bottom-width'), 10),
      left: parseInt(this.$image.css('border-left-width'), 10)
    };

    // Attach event handlers to the newly minted DOM elements
    this.$overlay.hide().on('click', function() {
      self.end();
      return false;
    });

    this.$lightbox.hide().on('click', function(event) {
      if ($(event.target).attr('id') === 'lightbox') {
        self.end();
      }
      return false;
    });

    this.$outerContainer.on('click', function(event) {
      if ($(event.target).attr('id') === 'lightbox') {
        self.end();
      }
      return false;
    });

    this.$lightbox.find('.lb-prev').on('click', function() {
      if (self.currentImageIndex === 0) {
        self.changeImage(self.album.length - 1);
      } else {
        self.changeImage(self.currentImageIndex - 1);
      }
      return false;
    });

    this.$lightbox.find('.lb-next').on('click', function() {
      if (self.currentImageIndex === self.album.length - 1) {
        self.changeImage(0);
      } else {
        self.changeImage(self.currentImageIndex + 1);
      }
      return false;
    });

    /*
      Show context menu for image on right-click

      There is a div containing the navigation that spans the entire image and lives above of it. If
      you right-click, you are right clicking this div and not the image. This prevents users from
      saving the image or using other context menu actions with the image.

      To fix this, when we detect the right mouse button is pressed down, but not yet clicked, we
      set pointer-events to none on the nav div. This is so that the upcoming right-click event on
      the next mouseup will bubble down to the image. Once the right-click/contextmenu event occurs
      we set the pointer events back to auto for the nav div so it can capture hover and left-click
      events as usual.
     */
    this.$nav.on('mousedown', function(event) {
      if (event.which === 3) {
        self.$nav.css('pointer-events', 'none');

        self.$lightbox.one('contextmenu', function() {
          setTimeout(function() {
              this.$nav.css('pointer-events', 'auto');
          }.bind(self), 0);
        });
      }
    });


    this.$lightbox.find('.lb-loader, .lb-close').on('click', function() {
      self.end();
      return false;
    });
  };

  // Show overlay and lightbox. If the image is part of a set, add siblings to album array.
  Lightbox.prototype.start = function($link) {
    var self    = this;
    var $window = $(window);

    $window.on('resize', $.proxy(this.sizeOverlay, this));

    $('select, object, embed').css({
      visibility: 'hidden'
    });

    this.sizeOverlay();

    this.album = [];
    var imageNumber = 0;

    function addToAlbum($link) {
      self.album.push({
        link: $link.attr('href'),
        title: $link.attr('data-title') || $link.attr('title')
      });
    }

    // Support both data-lightbox attribute and rel attribute implementations
    var dataLightboxValue = $link.attr('data-lightbox');
    var $links;

    if (dataLightboxValue) {
      $links = $($link.prop('tagName') + '[data-lightbox="' + dataLightboxValue + '"]');
      for (var i = 0; i < $links.length; i = ++i) {
        addToAlbum($($links[i]));
        if ($links[i] === $link[0]) {
          imageNumber = i;
        }
      }
    } else {
      if ($link.attr('rel') === 'lightbox') {
        // If image is not part of a set
        addToAlbum($link);
      } else {
        // If image is part of a set
        $links = $($link.prop('tagName') + '[rel="' + $link.attr('rel') + '"]');
        for (var j = 0; j < $links.length; j = ++j) {
          addToAlbum($($links[j]));
          if ($links[j] === $link[0]) {
            imageNumber = j;
          }
        }
      }
    }

    // Position Lightbox
    var top  = $window.scrollTop() + this.options.positionFromTop;
    var left = $window.scrollLeft();
    this.$lightbox.css({
      top: top + 'px',
      left: left + 'px'
    }).fadeIn(this.options.fadeDuration);

    // Disable scrolling of the page while open
    if (this.options.disableScrolling) {
      $('body').addClass('lb-disable-scrolling');
    }

    this.changeImage(imageNumber);
  };

  // Hide most UI elements in preparation for the animated resizing of the lightbox.
  Lightbox.prototype.changeImage = function(imageNumber) {
    var self = this;

    this.disableKeyboardNav();
    var $image = this.$lightbox.find('.lb-image');

    this.$overlay.fadeIn(this.options.fadeDuration);

    $('.lb-loader').fadeIn('slow');
    this.$lightbox.find('.lb-image, .lb-nav, .lb-prev, .lb-next, .lb-dataContainer, .lb-numbers, .lb-caption').hide();

    this.$outerContainer.addClass('animating');

    // When image to show is preloaded, we send the width and height to sizeContainer()
    var preloader = new Image();
    preloader.onload = function() {
      var $preloader;
      var imageHeight;
      var imageWidth;
      var maxImageHeight;
      var maxImageWidth;
      var windowHeight;
      var windowWidth;

      $image.attr('src', self.album[imageNumber].link);

      $preloader = $(preloader);

      $image.width(preloader.width);
      $image.height(preloader.height);

      if (self.options.fitImagesInViewport) {
        // Fit image inside the viewport.
        // Take into account the border around the image and an additional 10px gutter on each side.

        windowWidth    = $(window).width();
        windowHeight   = $(window).height();
        maxImageWidth  = windowWidth - self.containerPadding.left - self.containerPadding.right - self.imageBorderWidth.left - self.imageBorderWidth.right - 20;
        maxImageHeight = windowHeight - self.containerPadding.top - self.containerPadding.bottom - self.imageBorderWidth.top - self.imageBorderWidth.bottom - 120;

        // Check if image size is larger then maxWidth|maxHeight in settings
        if (self.options.maxWidth && self.options.maxWidth < maxImageWidth) {
          maxImageWidth = self.options.maxWidth;
        }
        if (self.options.maxHeight && self.options.maxHeight < maxImageWidth) {
          maxImageHeight = self.options.maxHeight;
        }

        // Is the current image's width or height is greater than the maxImageWidth or maxImageHeight
        // option than we need to size down while maintaining the aspect ratio.
        if ((preloader.width > maxImageWidth) || (preloader.height > maxImageHeight)) {
          if ((preloader.width / maxImageWidth) > (preloader.height / maxImageHeight)) {
            imageWidth  = maxImageWidth;
            imageHeight = parseInt(preloader.height / (preloader.width / imageWidth), 10);
            $image.width(imageWidth);
            $image.height(imageHeight);
          } else {
            imageHeight = maxImageHeight;
            imageWidth = parseInt(preloader.width / (preloader.height / imageHeight), 10);
            $image.width(imageWidth);
            $image.height(imageHeight);
          }
        }
      }
      self.sizeContainer($image.width(), $image.height());
    };

    preloader.src          = this.album[imageNumber].link;
    this.currentImageIndex = imageNumber;
  };

  // Stretch overlay to fit the viewport
  Lightbox.prototype.sizeOverlay = function() {
    this.$overlay
      .width($(document).width())
      .height($(document).height());
  };

  // Animate the size of the lightbox to fit the image we are showing
  Lightbox.prototype.sizeContainer = function(imageWidth, imageHeight) {
    var self = this;

    var oldWidth  = this.$outerContainer.outerWidth();
    var oldHeight = this.$outerContainer.outerHeight();
    var newWidth  = imageWidth + this.containerPadding.left + this.containerPadding.right + this.imageBorderWidth.left + this.imageBorderWidth.right;
    var newHeight = imageHeight + this.containerPadding.top + this.containerPadding.bottom + this.imageBorderWidth.top + this.imageBorderWidth.bottom;

    function postResize() {
      self.$lightbox.find('.lb-dataContainer').width(newWidth);
      self.$lightbox.find('.lb-prevLink').height(newHeight);
      self.$lightbox.find('.lb-nextLink').height(newHeight);
      self.showImage();
    }

    if (oldWidth !== newWidth || oldHeight !== newHeight) {
      this.$outerContainer.animate({
        width: newWidth,
        height: newHeight
      }, this.options.resizeDuration, 'swing', function() {
        postResize();
      });
    } else {
      postResize();
    }
  };

  // Display the image and its details and begin preload neighboring images.
  Lightbox.prototype.showImage = function() {
    this.$lightbox.find('.lb-loader').stop(true).hide();
    this.$lightbox.find('.lb-image').fadeIn(this.options.imageFadeDuration);

    this.updateNav();
    this.updateDetails();
    this.preloadNeighboringImages();
    this.enableKeyboardNav();
  };

  // Display previous and next navigation if appropriate.
  Lightbox.prototype.updateNav = function() {
    // Check to see if the browser supports touch events. If so, we take the conservative approach
    // and assume that mouse hover events are not supported and always show prev/next navigation
    // arrows in image sets.
    var alwaysShowNav = false;
    try {
      document.createEvent('TouchEvent');
      alwaysShowNav = (this.options.alwaysShowNavOnTouchDevices) ? true : false;
    } catch (e) {}

    this.$lightbox.find('.lb-nav').show();

    if (this.album.length > 1) {
      if (this.options.wrapAround) {
        if (alwaysShowNav) {
          this.$lightbox.find('.lb-prev, .lb-next').css('opacity', '1');
        }
        this.$lightbox.find('.lb-prev, .lb-next').show();
      } else {
        if (this.currentImageIndex > 0) {
          this.$lightbox.find('.lb-prev').show();
          if (alwaysShowNav) {
            this.$lightbox.find('.lb-prev').css('opacity', '1');
          }
        }
        if (this.currentImageIndex < this.album.length - 1) {
          this.$lightbox.find('.lb-next').show();
          if (alwaysShowNav) {
            this.$lightbox.find('.lb-next').css('opacity', '1');
          }
        }
      }
    }
  };

  // Display caption, image number, and closing button.
  Lightbox.prototype.updateDetails = function() {
    var self = this;

    // Enable anchor clicks in the injected caption html.
    // Thanks Nate Wright for the fix. @https://github.com/NateWr
    if (typeof this.album[this.currentImageIndex].title !== 'undefined' &&
      this.album[this.currentImageIndex].title !== '') {
      var $caption = this.$lightbox.find('.lb-caption');
      if (this.options.sanitizeTitle) {
        $caption.text(this.album[this.currentImageIndex].title);
      } else {
        $caption.html(this.album[this.currentImageIndex].title);
      }
      $caption.fadeIn('fast')
        .find('a').on('click', function(event) {
          if ($(this).attr('target') !== undefined) {
            window.open($(this).attr('href'), $(this).attr('target'));
          } else {
            location.href = $(this).attr('href');
          }
        });
    }

    if (this.album.length > 1 && this.options.showImageNumberLabel) {
      var labelText = this.imageCountLabel(this.currentImageIndex + 1, this.album.length);
      this.$lightbox.find('.lb-number').text(labelText).fadeIn('fast');
    } else {
      this.$lightbox.find('.lb-number').hide();
    }

    this.$outerContainer.removeClass('animating');

    this.$lightbox.find('.lb-dataContainer').fadeIn(this.options.resizeDuration, function() {
      return self.sizeOverlay();
    });
  };

  // Preload previous and next images in set.
  Lightbox.prototype.preloadNeighboringImages = function() {
    if (this.album.length > this.currentImageIndex + 1) {
      var preloadNext = new Image();
      preloadNext.src = this.album[this.currentImageIndex + 1].link;
    }
    if (this.currentImageIndex > 0) {
      var preloadPrev = new Image();
      preloadPrev.src = this.album[this.currentImageIndex - 1].link;
    }
  };

  Lightbox.prototype.enableKeyboardNav = function() {
    $(document).on('keyup.keyboard', $.proxy(this.keyboardAction, this));
  };

  Lightbox.prototype.disableKeyboardNav = function() {
    $(document).off('.keyboard');
  };

  Lightbox.prototype.keyboardAction = function(event) {
    var KEYCODE_ESC        = 27;
    var KEYCODE_LEFTARROW  = 37;
    var KEYCODE_RIGHTARROW = 39;

    var keycode = event.keyCode;
    var key     = String.fromCharCode(keycode).toLowerCase();
    if (keycode === KEYCODE_ESC || key.match(/x|o|c/)) {
      this.end();
    } else if (key === 'p' || keycode === KEYCODE_LEFTARROW) {
      if (this.currentImageIndex !== 0) {
        this.changeImage(this.currentImageIndex - 1);
      } else if (this.options.wrapAround && this.album.length > 1) {
        this.changeImage(this.album.length - 1);
      }
    } else if (key === 'n' || keycode === KEYCODE_RIGHTARROW) {
      if (this.currentImageIndex !== this.album.length - 1) {
        this.changeImage(this.currentImageIndex + 1);
      } else if (this.options.wrapAround && this.album.length > 1) {
        this.changeImage(0);
      }
    }
  };

  // Closing time. :-(
  Lightbox.prototype.end = function() {
    this.disableKeyboardNav();
    $(window).off('resize', this.sizeOverlay);
    this.$lightbox.fadeOut(this.options.fadeDuration);
    this.$overlay.fadeOut(this.options.fadeDuration);
    $('select, object, embed').css({
      visibility: 'visible'
    });
    if (this.options.disableScrolling) {
      $('body').removeClass('lb-disable-scrolling');
    }
  };

  return new Lightbox();
}));

function additionalCarousel(sliderId){
	 /*======  curosol For Additional ==== */
	 var czadditional = $(sliderId);
      czadditional.owlCarousel({
     	 items : 4, //10 items above 1000px browser width
     	 itemsDesktop : [1199,3], 
     	 itemsDesktopSmall : [991,2], 
     	 itemsTablet: [480,2], 
     	 itemsMobile : [320,1] 
      });
      // Custom Navigation Events
      $(".additional_next").click(function(){
        czadditional.trigger('owl.next');
      })
      $(".additional_prev").click(function(){
        czadditional.trigger('owl.prev');
      });
}

$(document).ready(function(){
	
	bindGrid();
	additionalCarousel('#main .additional-carousel');
	$('h1.h1, h1.blog-heading').prependTo('.breadcrumb .container');

	$('.cart_block.dropdown-menu').on('click',function (e) {
		e.stopPropagation();
	});
	
	
	// Add/Remove acttive class on menu active in responsive  
	$('#menu-icon').on('click', function() {
		$(this).toggleClass('active');
	});
	
	$('input[name="email"], #search_widget input[type="text"]').focus(function(){
		$(this).data('placeholder',$(this).attr('placeholder')).attr('placeholder','');
	}).blur(function(){
		$(this).attr('placeholder',$(this).data('placeholder'));
	});
	
	
	$('#header .search_button').click(function(event){			
		$(this).toggleClass('active');		
		event.stopPropagation();		
		$('#header .search_toggle').toggle('medium');		
		$( "#header .search-widget form input[type=text]" ).focus();
	
	});
	
	$("#header .search_toggle").on("click", function (event) {
		event.stopPropagation();	
	});
	
	/*======  Parallax  ==== 
	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
	if(!isMobile) {
		if($(".parallax").length){  
			$(".parallax").sitManParallex({  invert: false });
		};
	}else{
		$(".parallax").sitManParallex({  invert: true });
	}*/

	
	
	/* ---------------- start more menu setting ---------------------- */
		var max_elem = 5;	
		var items = $('.menu ul#top-menu > li');	
		var surplus = items.slice(max_elem, items.length);
		
		surplus.wrapAll('<li class="category more_menu" id="more_menu"><div id="top_moremenu" class="popover sub-menu js-sub-menu collapse"><ul class="top-menu more_sub_menu">');
	
		$('.menu ul#top-menu .more_menu').prepend('<a href="#" class="dropdown-item" data-depth="0"><span class="pull-xs-right hidden-md-up"><span data-target="#top_moremenu" data-toggle="collapse" class="navbar-toggler collapse-icons"><i class="material-icons add">&#xE313;</i><i class="material-icons remove">&#xE316;</i></span></span></span>More</a>');
	
		$('.menu ul#top-menu .more_menu').mouseover(function(){
			$(this).children('div').css('display', 'block');
		})
		.mouseout(function(){
			$(this).children('div').css('display', 'none');
		});		
	/* ---------------- end more menu setting ----------------------	*/
	
});




	/*======  vertical slider for special products thumbnails  ==== */	
		var winwidth = $(window).width();
		$('.bxslider').bxSlider({
			mode: 'vertical',
			minSlides: (winwidth < 480) ? 2 : 3,
			moveSlides: 1,
			auto: true,
			speed: 800,
			pager: false,
			nextSelector: '.bxNext',
     		prevSelector: '.bxPrev',
			controls:  false
		});

// Loading image before flex slider load
	$(window).load(function() { 
		$(".loadingdiv").removeClass("spinner"); 
	});
	
// Nivo slider load
	$(window).load(function() {
		if($('#nivoslider').length > 0){
			$('#nivoslider').nivoSlider({
				effect: 'random',
				slices: 15,
				boxCols: 8,
				boxRows: 4,
				animSpeed: 500,
				pauseTime: 3000,
				startSlide: 0,
				directionNav: true,
				controlNav: true,
				controlNavThumbs: false,
				pauseOnHover: true,
				manualAdvance: false,
				prevText: '',
				nextText: ''
			});
		}
	});		


// Scroll page bottom to top
	$(window).scroll(function() {
		if ($(this).scrollTop() > 500) {
			$('.top_button').fadeIn(500);
		} else {
			$('.top_button').fadeOut(500);
		}
	});							
	$('.top_button').click(function(event) {
		event.preventDefault();		
		$('html, body').animate({scrollTop: 0}, 800);
	});
	
	/*======  Carousel Slider For catagory slider Product ==== */

	var catid_array = [];
	$('#czcategorytabs .product_slider_grid').each(function(){
		var catid = $(this).data('catid');
		var owlcarouselid = $('#czcategory' + catid + '-carousel');
		
		owlcarouselid.owlCarousel({
			items : 3, //10 items above 1000px browser width
			itemsDesktop : [1199,3], 
			itemsDesktopSmall : [991,2], 
			itemsTablet: [479,1], 
			itemsMobile : [319,1]  
		});	
		$('#tab_' + catid + ' .czcategory_next').click(function(){
			owlcarouselid.trigger('owl.next');
		})
		$('#tab_' + catid + ' .czcategory_prev').click(function(){
			owlcarouselid.trigger('owl.prev');
		});		
	});


/*======  Carousel Slider For Feature Product ==== */
	
	var czblog = $("#blog-carousel");
	czblog.owlCarousel({
		items : 3, //10 items above 1000px browser width
		itemsDesktop : [1199,2], 
		itemsDesktopSmall : [991,2], 
		itemsTablet: [575,1]
	});
	// Custom Navigation Events
	$(".blog_next").click(function(){
		czblog.trigger('owl.next');
	})
	$(".blog_prev").click(function(){
		czblog.trigger('owl.prev');
	});


/*======  Carousel Slider For Feature Product ==== */
	
	var czfeature = $("#feature-carousel");
	czfeature.owlCarousel({
		items : 2, //10 items above 1000px browser width
		itemsDesktop : [1199,2], 
		itemsDesktopSmall : [991,2], 
		itemsTablet: [575,1], 
		itemsMobile : [319,1] 
	});
	// Custom Navigation Events
	$(".feature_next").click(function(){
		czfeature.trigger('owl.next');
	})
	$(".feature_prev").click(function(){
		czfeature.trigger('owl.prev');
	});



/*======  Carousel Slider For New Product ==== */
	
	var cznewproduct = $("#newproduct-carousel");
	cznewproduct.owlCarousel({
		items : 3, //10 items above 1000px browser width
		itemsDesktop : [1199,3], 
		itemsDesktopSmall : [991,2], 
		itemsTablet: [479,1], 
		itemsMobile : [319,1] 
	});
	// Custom Navigation Events
	$(".newproduct_next").click(function(){
		cznewproduct.trigger('owl.next');
	})
	$(".newproduct_prev").click(function(){
		cznewproduct.trigger('owl.prev');
	});



/*======  Carousel Slider For Bestseller Product ==== */
	
	var czbestseller = $("#bestseller-carousel");
	czbestseller.owlCarousel({
		items : 3, //10 items above 1000px browser width
		itemsDesktop : [1199,3], 
		itemsDesktopSmall : [991,2], 
		itemsTablet: [479,1], 
		itemsMobile : [319,1] 
	});
	// Custom Navigation Events
	$(".bestseller_next").click(function(){
		czbestseller.trigger('owl.next');
	})
	$(".bestseller_prev").click(function(){
		czbestseller.trigger('owl.prev');
	});



/*======  Carousel Slider For Special Product ==== */
	var czspecial = $("#special-carousel");
	czspecial.owlCarousel({
		autoPlay: false,
		singleItem:true
	});
	// Custom Navigation Events
	$(".special_next").click(function(){
		czspecial.trigger('owl.next');
	})
	$(".special_prev").click(function(){
		czspecial.trigger('owl.prev');
	});


/*======  Carousel Slider For Accessories Product ==== */

	var czaccessories = $("#accessories-carousel");
	czaccessories.owlCarousel({
		items : 4, //10 items above 1000px browser width
		itemsDesktop : [1199,3], 
		itemsDesktopSmall : [991,2], 
		itemsTablet: [479,1], 
		itemsMobile : [319,1] 
	});
	// Custom Navigation Events
	$(".accessories_next").click(function(){
		czaccessories.trigger('owl.next');
	})
	$(".accessories_prev").click(function(){
		czaccessories.trigger('owl.prev');
	});


/*======  Carousel Slider For Category Product ==== */

	var czproductscategory = $("#productscategory-carousel");
	czproductscategory.owlCarousel({
		items : 4, //10 items above 1000px browser width
		itemsDesktop : [1199,3], 
		itemsDesktopSmall : [991,2], 
		itemsTablet: [479,1], 
		itemsMobile : [319,1] 
	});
	// Custom Navigation Events
	$(".productscategory_next").click(function(){
		czproductscategory.trigger('owl.next');
	})
	$(".productscategory_prev").click(function(){
		czproductscategory.trigger('owl.prev');
	});


/*======  Carousel Slider For Viewed Product ==== */

	var czviewed = $("#viewed-carousel");
	czviewed.owlCarousel({
		items : 4, //10 items above 1000px browser width
		itemsDesktop : [1199,3], 
		itemsDesktopSmall : [991,2], 
		itemsTablet: [479,1], 
		itemsMobile : [319,1] 
	});
	// Custom Navigation Events
	$(".viewed_next").click(function(){
		czviewed.trigger('owl.next');
	})
	$(".viewed_prev").click(function(){
		czviewed.trigger('owl.prev');
	});

/*======  Carousel Slider For Crosssell Product ==== */

	var czcrosssell = $("#crosssell-carousel");
	czcrosssell.owlCarousel({
		items : 4, //10 items above 1000px browser width
		itemsDesktop : [1199,3], 
		itemsDesktopSmall : [991,2], 
		itemsTablet: [479,1], 
		itemsMobile : [319,1] 
	});
	// Custom Navigation Events
	$(".crosssell_next").click(function(){
		czcrosssell.trigger('owl.next');
	})
	$(".crosssell_prev").click(function(){
		czcrosssell.trigger('owl.prev');
	});

/*======  curosol For Manufacture ==== */
	 var czbrand = $("#brand-carousel");
      czbrand.owlCarousel({
     	 items : 5, //10 items above 1000px browser width
     	 itemsDesktop : [1199,4], 
     	 itemsDesktopSmall : [991,3],
     	 itemsTablet: [480,2], 
     	 itemsMobile : [320,1] 
      });
      // Custom Navigation Events
      $(".brand_next").click(function(){
        czbrand.trigger('owl.next');
      })
      $(".brand_prev").click(function(){
        czbrand.trigger('owl.prev');
      });
	  
/*======  curosol For topseller Product ==== */

	  var czourcategory = $("#ourcategory-carousel");
      czourcategory.owlCarousel({
     	 items : 6, //10 items above 1000px browser width
     	 itemsDesktop : [1199,5], 
     	 itemsDesktopSmall : [991,4],
		 itemsTablet : [767,3], 
     	 itemsTabletSmall: [500,2], 
     	 itemsMobile : [400,1] 
      });
	  

/*======  curosol For Instagram images ==== */

	  var czinstagram = $("#instagram-carousel");
      czinstagram.owlCarousel({
     	 items : 6, //10 items above 1000px browser width
     	 itemsDesktop : [1399,5], 
     	 itemsDesktopSmall : [1199,4],
		 itemsTablet : [800,3], 
     	 itemsTabletSmall: [600,2], 
     	 itemsMobile : [400,1] 
      });
	  // Custom Navigation Events
      $(".instagram_next").click(function(){
        czinstagram.trigger('owl.next');
      })
      $(".instagram_prev").click(function(){
        czinstagram.trigger('owl.prev');
      });

/*======  Carousel Slider For For Tesimonial ==== */

	  var cztestimonial = $("#testimonial-carousel");
     	 cztestimonial.owlCarousel({
			 autoPlay: true,
			 singleItem:true,
			 pagination: true
      });

		/* Custom Navigation Events*/
      $(".cztestimonial_next").click(function(){
        cztestimonial.trigger('owl.next');
      });

      $(".cztestimonial_prev").click(function(){
        cztestimonial.trigger('owl.prev');
      });


function bindGrid()
{
	var view = $.totalStorage("display");

	if (view && view != 'grid')
		display(view);
	else
		$('.display').find('li#grid').addClass('selected');

	$(document).on('click', '#grid', function(e){
		e.preventDefault();
		display('grid');
	});

	$(document).on('click', '#list', function(e){
		e.preventDefault();
		display('list');		
	});	
}

function display(view)
{
	if (view == 'list')
	{
		$('#products ul.product_list').removeClass('grid').addClass('list row');
		$('#products .product_list > li').removeClass('col-xs-12 col-sm-6 col-md-6 col-lg-4').addClass('col-xs-12');
		
		
		$('#products .product_list > li').each(function(index, element) {
			var html = '';
			html = '<div class="product-miniature js-product-miniature" data-id-product="'+ $(element).find('.product-miniature').data('id-product') +'" data-id-product-attribute="'+ $(element).find('.product-miniature').data('id-product-attribute') +'" itemscope itemtype="http://schema.org/Product">';
				html += '<div class="thumbnail-container col-xs-4 col-xs-5 col-md-4">' + $(element).find('.thumbnail-container').html() + '</div>';
				
				html += '<div class="product-description center-block col-xs-4 col-xs-7 col-md-8">';
					html += '<h3 class="h3 product-title" itemprop="name">'+ $(element).find('h3').html() + '</h3>';
					
					var comment = $(element).find('.comments_note').html();       // check : Comment module is enabled
					if (comment != null) {
						html += '<div class="comments_note">'+ $(element).find('.comments_note').html() + '</div>';
					}

					var price = $(element).find('.product-price-and-shipping').html();       // check : catalog mode is enabled
					if (price != null) {
						html += '<div class="product-price-and-shipping">'+ price + '</div>';
					}
					
					html += '<div class="product-detail">'+ $(element).find('.product-detail').html() + '</div>';
					
					var colorList = $(element).find('.highlighted-informations').html();
					if (colorList != null) {
						html += '<div class="highlighted-informations">'+ colorList +'</div>';
					}
					
					html += '<div class="outer-functional">'+ $(element).find('.outer-functional').html() +'</div>';
					
				html += '</div>';
			html += '</div>';
		$(element).html(html);
		});
		$('.display').find('li#list').addClass('selected');
		$('.display').find('li#grid').removeAttr('class');
		$.totalStorage('display', 'list');
	}
	else
	{
		$('#products ul.product_list').removeClass('list').addClass('grid row');
		$('#products .product_list > li').removeClass('col-xs-12').addClass('col-xs-12 col-sm-6 col-md-6 col-lg-4');
		$('#products .product_list > li').each(function(index, element) {
		var html = '';
		html += '<div class="product-miniature js-product-miniature" data-id-product="'+ $(element).find('.product-miniature').data('id-product') +'" data-id-product-attribute="'+ $(element).find('.product-miniature').data('id-product-attribute') +'" itemscope itemtype="http://schema.org/Product">';
			html += '<div class="thumbnail-container">' + $(element).find('.thumbnail-container').html() +'</div>';
			
			html += '<div class="product-description">';

				var comment = $(element).find('.comments_note').html();       // check : Comment module is enabled
				if (comment != null) {
					html += '<div class="comments_note">'+ $(element).find('.comments_note').html() + '</div>';
				}

				html += '<h3 class="h3 product-title" itemprop="name">'+ $(element).find('h3').html() +'</h3>';
			
				var price = $(element).find('.product-price-and-shipping').html();       // check : catalog mode is enabled
				if (price != null) {
					html += '<div class="product-price-and-shipping">'+ price + '</div>';
				}
				
				//html += '<div class="product-actions">'+ $(element).find('.product-actions').html() +'</div>';
				
				html += '<div class="product-detail">'+ $(element).find('.product-detail').html() + '</div>';
				
				var colorList = $(element).find('.highlighted-informations').html();
				if (colorList != null) {
					html += '<div class="highlighted-informations">'+ colorList +'</div>';
				}
				
				html += '<div class="outer-functional">'+ $(element).find('.outer-functional').html() +'</div>';
				
			html += '</div>';
		html += '</div>';
		$(element).html(html);
		});
		$('.display').find('li#grid').addClass('selected');
		$('.display').find('li#list').removeAttr('class');
		$.totalStorage('display', 'grid');
	}
}


function responsivecolumn(){
	
	if ($(document).width() <= 991)
	{
		$('.container #columns_inner #left-column').appendTo('.container #columns_inner');
		// ---------------- Fixed header responsive ----------------------
		$(window).bind('scroll', function () {
			if ($(window).scrollTop() > 250) {
				$('.mobile-menu').addClass('fixed');
			} else {
				$('.mobile-menu').removeClass('fixed');
			}
		});
	}
	else if($(document).width() >= 992)
	{
		$('.container #columns_inner #left-column').prependTo('.container #columns_inner');
		$(window).bind('scroll', function () {
			if ($(window).scrollTop() > 250) {
				$('.header-top-wrapper').addClass('fixed');
			} else {
				$('.header-top-wrapper').removeClass('fixed');
			}
		});
	}
	
	$('#language-selector').appendTo('.user-info > ul.dropdown-menu');
	$('#currency-selector').appendTo('.user-info > ul.dropdown-menu');
	
}
$(document).ready(function(){responsivecolumn();});
$(window).resize(function(){responsivecolumn();});




$(document).ready(function () {
    $('#form-group-podnikatele input[name="company"]').on('change keyup', function () {
        setRequired($('#form-group-podnikatele input[name="dni"]'), $(this).val().length > 0);
    });
});

function setRequired(item, required) {
    if (required) {
        item.attr('required', true);
        item.parents('.form-group').find('.form-control-comment').text('povinné');
    } else {
        item.removeAttr('required');​​​​​
        item.parents('.form-group').find('.form-control-comment').text('nepovinné');
    }
}
