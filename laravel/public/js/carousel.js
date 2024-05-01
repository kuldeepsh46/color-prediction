(()=>{function t(e){return t="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},t(e)}function e(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){for(var i=0;i<e.length;i++){var n=e[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,s(n.key),n)}}function n(t,e,n){return e&&i(t.prototype,e),n&&i(t,n),Object.defineProperty(t,"prototype",{writable:!1}),t}function s(e){var i=function(e,i){if("object"!=t(e)||!e)return e;var n=e[Symbol.toPrimitive];if(void 0!==n){var s=n.call(e,i||"default");if("object"!=t(s))return s;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===i?String:Number)(e)}(e,"string");return"symbol"==t(i)?i:String(i)}var o=function(){function t(i,n,s,o){e(this,t),this.element=document.getElementById(i),this.itemsContainer=document.getElementById("".concat(i,"-items-container")),this.controllerPrevious=document.getElementById(n),this.controllerNext=document.getElementById(s),this.data=o,this.mount(),this.controllerPrevious&&this.controllerNext&&this.mountControllers()}return n(t,[{key:"mount",value:function(){var t,e;null===(t=this.element)||void 0===t||t.classList.add("carousel-container","h-100","m-0","p-0","d-flex","justify-content-between","align-items-center","mx-2","mx-md-4","px-sm-5","px-xl-4","user-select-none"),null===(e=this.itemsContainer)||void 0===e||e.classList.add("w-100","h-100","d-flex","order-1","justify-content-between","align-items-center","h-100"),this.mountItems(this.data),this.data.length>1?this.showControllers():(this.firstItem.position.value=1,this.hideControllers())}},{key:"mountItems",value:function(t){var e=this;t.forEach((function(t,i){var n=["first","second","third"][i],s=t.id,o=t.src,l=t.alt,u=t.callback,a={next:function(){return e.controllerNext?e.controllerNext.click():function(){}},previous:function(){return e.controllerPrevious?e.controllerPrevious.click():function(){}}};n&&(e["".concat(n,"Item")]=new r(s,i,o,l,u,a,(function(){return e.checkItemsStatus()})))})),this.secondItem.source||this.thirdItem.source||(this.firstItem.position.value=1,this.secondItem.position.value=2,this.thirdItem.position.value=0)}},{key:"mountControllers",value:function(){var t,e,i=this;null===(t=this.controllerPrevious)||void 0===t||t.classList.add("order-0","carousel-arrow-controller","previous","carousel-arrow-option","toggle-active","cursor-pointer","p-1","rounded");var n=document.createElement("div");null==n||n.classList.add("icon"),n.innerHTML='\n        <svg height="24" stroke-width="3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">\n              <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />\n        </svg>\n        ',this.controllerPrevious.appendChild(n),null===(e=this.controllerNext)||void 0===e||e.classList.add("order-2","carousel-arrow-controller","next","carousel-arrow-option","toggle-active","cursor-pointer","p-1","rounded");var s=document.createElement("div");null==s||s.classList.add("icon"),s.innerHTML='\n        <svg height="24" stroke-width="3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">\n              <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />\n        </svg>\n        ',this.controllerNext.appendChild(s),this.controllerPrevious.addEventListener("click",(function(){return i.move("previous")})),this.controllerNext.addEventListener("click",(function(){return i.move("next")}))}},{key:"unmount",value:function(){this.firstItem&&this.firstItem.unmount(),this.secondItem&&this.secondItem.unmount(),this.thirdItem&&this.thirdItem.unmount(),this.hideControllers()}},{key:"updateContent",value:function(){this.unmount(),this.mount()}},{key:"hideControllers",value:function(){var t,e;this.controllerPrevious&&this.controllerNext&&(null===(t=this.controllerPrevious)||void 0===t||t.classList.add("d-none"),null===(e=this.controllerNext)||void 0===e||e.classList.add("d-none"))}},{key:"showControllers",value:function(){var t,e;this.controllerPrevious&&this.controllerNext&&(null===(t=this.controllerPrevious)||void 0===t||t.classList.remove("d-none"),null===(e=this.controllerNext)||void 0===e||e.classList.remove("d-none"))}},{key:"checkItemsStatus",value:function(){(this.firstItem.status&&!this.secondItem.status&&!this.thirdItem.status||this.secondItem.status&&!this.firstItem.status&&!this.thirdItem.status||this.thirdItem.status&&!this.firstItem.status&&!this.secondItem.status)&&this.hideControllers()}},{key:"move",value:function(t){"next"===t&&this.next(),"previous"===t&&this.previous()}},{key:"next",value:function(){var t=--this.firstItem.position.value,e=--this.secondItem.position.value,i=--this.thirdItem.position.value;this.firstItem.position.value=t<0?2:t,this.secondItem.position.value=e<0?2:e,this.thirdItem.position.value=i<0?2:i,(!this.firstItem.status&&0===this.thirdItem.position.value||!this.secondItem.status&&0===this.firstItem.position.value||!this.thirdItem.status&&0===this.secondItem.position.value)&&this.next()}},{key:"previous",value:function(){var t=++this.firstItem.position.value,e=++this.secondItem.position.value,i=++this.thirdItem.position.value;this.firstItem.position.value=t>2?0:t,this.secondItem.position.value=e>2?0:e,this.thirdItem.position.value=i>2?0:i,(!this.firstItem.status&&0===this.thirdItem.position.value||!this.secondItem.status&&0===this.firstItem.position.value||!this.thirdItem.status&&0===this.secondItem.position.value)&&this.previous()}}]),t}(),r=function(){function t(i,n){var s=this,o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:"",l=arguments.length>4&&void 0!==arguments[4]?arguments[4]:function(){},u=arguments.length>5&&void 0!==arguments[5]?arguments[5]:{next:function(){},previous:function(){}},a=arguments.length>6&&void 0!==arguments[6]?arguments[6]:function(){};e(this,t),this.element=document.getElementById(i),this.content=document.getElementById("".concat(i,"-content")),this.status=!0,this.source=o,this.alt=r,this.callback=l,this.moveCallbacks=u,this.controllerCallback=a;this.position={valueInternal:n,set value(t){var e;this.valueInternal=t,e=t,s.order(s.element,s.content,e)},get value(){return this.valueInternal}},this.clickHandler=function(){return s.action()},this.mount()}return n(t,[{key:"mount",value:function(){var t,e,i,n,s=this;null===(t=this.element)||void 0===t||t.classList.add("d-flex","justify-content-center","position-relative","align-items-center");var o=document.createElement("img");o.src=this.source,o.alt=this.alt,o.style.maxHeight="100%",o.style.maxWidth="100%",o.addEventListener("error",(function(){s.status=!1,s.moveCallbacks={},s.unmount(),s.controllerCallback()})),this.content.appendChild(o),null===(e=this.content)||void 0===e||e.classList.add("d-flex","justify-content-center","align-items-center","h-100"),null===(i=this.element)||void 0===i||i.classList.add("order-".concat(this.position.value)),null===(n=this.element)||void 0===n||n.classList.add("item-view-".concat(1===this.position.value?"selected":"unselected"),"h-100"),this.element.addEventListener("click",this.clickHandler)}},{key:"unmount",value:function(){this.content.innerHTML="",this.element.removeEventListener("click",this.clickHandler)}},{key:"action",value:function(){var t;0===this.position.value&&this.status?this.moveCallbacks.previous():2===this.position.value&&this.status?null===(t=this.moveCallbacks)||void 0===t||t.next():1===this.position.value&&this.status&&this.callback()}},{key:"order",value:function(t,e,i){[0,1,2].forEach((function(e){e===i?null==t||t.classList.add("order-".concat(e)):null==t||t.classList.remove("order-".concat(e))})),1===i?(null==t||t.classList.remove("item-view-unselected"),null==t||t.classList.add("item-view-selected"),null==e||e.classList.add("w-100"),null==e||e.classList.remove("w-75")):(null==t||t.classList.remove("item-view-selected"),null==t||t.classList.add("item-view-unselected"),null==e||e.classList.add("w-75"),null==e||e.classList.remove("w-100"))}}]),t}();window.Carousel=o,window.CarouselItem=r})();