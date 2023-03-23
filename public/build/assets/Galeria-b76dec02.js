import{s as P,F as N,R as C,a as L}from"./button.esm-256f0b79.js";import{D as h,Z as S,z as x,o as r,f as d,a as m,e as b,n as f,h as c,c as v,B as g,F as _,k,A as I,R as B,U as E,y,b as V,w,T as D,H as O,g as R}from"./app-1b8d8cba.js";import{_ as z}from"./_plugin-vue_export-helper-c27b6911.js";function H(e,t){t===void 0&&(t={});var i=t.insertAt;if(!(!e||typeof document>"u")){var l=document.head||document.getElementsByTagName("head")[0],a=document.createElement("style");a.type="text/css",i==="top"&&l.firstChild?l.insertBefore(a,l.firstChild):l.appendChild(a),a.styleSheet?a.styleSheet.cssText=e:a.appendChild(document.createTextNode(e))}}var j=`
.p-carousel {
    display: flex;
    flex-direction: column;
}
.p-carousel-content {
    display: flex;
    flex-direction: column;
    overflow: auto;
}
.p-carousel-prev,
.p-carousel-next {
    align-self: center;
    flex-grow: 0;
    flex-shrink: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    position: relative;
}
.p-carousel-container {
    display: flex;
    flex-direction: row;
}
.p-carousel-items-content {
    overflow: hidden;
    width: 100%;
}
.p-carousel-items-container {
    display: flex;
    flex-direction: row;
}
.p-carousel-indicators {
    display: flex;
    flex-direction: row;
    justify-content: center;
    flex-wrap: wrap;
}
.p-carousel-indicator > button {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Vertical */
.p-carousel-vertical .p-carousel-container {
    flex-direction: column;
}
.p-carousel-vertical .p-carousel-items-container {
    flex-direction: column;
    height: 100%;
}

/* Keyboard Support */
.p-items-hidden .p-carousel-item {
    visibility: hidden;
}
.p-items-hidden .p-carousel-item.p-carousel-item-active {
    visibility: visible;
}
`;H(j);var $={name:"GalleriaItem",emits:["start-slideshow","stop-slideshow","update:activeIndex"],props:{circular:{type:Boolean,default:!1},activeIndex:{type:Number,default:0},value:{type:Array,default:null},showItemNavigators:{type:Boolean,default:!0},showIndicators:{type:Boolean,default:!0},slideShowActive:{type:Boolean,default:!0},changeItemOnIndicatorHover:{type:Boolean,default:!0},autoPlay:{type:Boolean,default:!1},templates:{type:null,default:null},id:{type:String,default:null}},mounted(){this.autoPlay&&this.$emit("start-slideshow")},methods:{next(){let e=this.activeIndex+1,t=this.circular&&this.value.length-1===this.activeIndex?0:e;this.$emit("update:activeIndex",t)},prev(){let e=this.activeIndex!==0?this.activeIndex-1:0,t=this.circular&&this.activeIndex===0?this.value.length-1:e;this.$emit("update:activeIndex",t)},stopSlideShow(){this.slideShowActive&&this.stopSlideShow&&this.$emit("stop-slideshow")},navBackward(e){this.stopSlideShow(),this.prev(),e&&e.cancelable&&e.preventDefault()},navForward(e){this.stopSlideShow(),this.next(),e&&e.cancelable&&e.preventDefault()},onIndicatorClick(e){this.stopSlideShow(),this.$emit("update:activeIndex",e)},onIndicatorMouseEnter(e){this.changeItemOnIndicatorHover&&(this.stopSlideShow(),this.$emit("update:activeIndex",e))},onIndicatorKeyDown(e,t){switch(e.code){case"Enter":case"Space":this.stopSlideShow(),this.$emit("update:activeIndex",t),e.preventDefault();break;case"ArrowDown":case"ArrowUp":e.preventDefault();break}},isIndicatorItemActive(e){return this.activeIndex===e},isNavBackwardDisabled(){return!this.circular&&this.activeIndex===0},isNavForwardDisabled(){return!this.circular&&this.activeIndex===this.value.length-1},ariaSlideNumber(e){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.slideNumber.replace(/{slideNumber}/g,e):void 0},ariaPageLabel(e){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.pageLabel.replace(/{page}/g,e):void 0}},computed:{activeItem(){return this.value[this.activeIndex]},navBackwardClass(){return["p-galleria-item-prev p-galleria-item-nav p-link",{"p-disabled":this.isNavBackwardDisabled()}]},navForwardClass(){return["p-galleria-item-next p-galleria-item-nav p-link",{"p-disabled":this.isNavForwardDisabled()}]},ariaSlideLabel(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.slide:void 0}},directives:{ripple:C}};const K={class:"p-galleria-item-wrapper"},M={class:"p-galleria-item-container"},G=["disabled"],U=m("span",{class:"p-galleria-item-prev-icon pi pi-chevron-left"},null,-1),q=[U],Z=["id","aria-label","aria-roledescription"],W=["disabled"],X=m("span",{class:"p-galleria-item-next-icon pi pi-chevron-right"},null,-1),Y=[X],J={key:2,class:"p-galleria-caption"},Q={key:0,class:"p-galleria-indicators p-reset"},ee=["aria-label","aria-selected","aria-controls","onClick","onMouseenter","onKeydown"],te={key:0,type:"button",tabindex:"-1",class:"p-link"};function ie(e,t,i,l,a,n){const p=x("ripple");return r(),d("div",K,[m("div",M,[i.showItemNavigators?b((r(),d("button",{key:0,type:"button",class:f(n.navBackwardClass),onClick:t[0]||(t[0]=s=>n.navBackward(s)),disabled:n.isNavBackwardDisabled()},q,10,G)),[[p]]):c("",!0),m("div",{id:i.id+"_item_"+i.activeIndex,class:"p-galleria-item",role:"group","aria-label":n.ariaSlideNumber(i.activeIndex+1),"aria-roledescription":n.ariaSlideLabel},[i.templates.item?(r(),v(g(i.templates.item),{key:0,item:n.activeItem},null,8,["item"])):c("",!0)],8,Z),i.showItemNavigators?b((r(),d("button",{key:1,type:"button",class:f(n.navForwardClass),onClick:t[1]||(t[1]=s=>n.navForward(s)),disabled:n.isNavForwardDisabled()},Y,10,W)),[[p]]):c("",!0),i.templates.caption?(r(),d("div",J,[i.templates.caption?(r(),v(g(i.templates.caption),{key:0,item:n.activeItem},null,8,["item"])):c("",!0)])):c("",!0)]),i.showIndicators?(r(),d("ul",Q,[(r(!0),d(_,null,k(i.value,(s,o)=>(r(),d("li",{key:`p-galleria-indicator-${o}`,class:f(["p-galleria-indicator",{"p-highlight":n.isIndicatorItemActive(o)}]),tabindex:"0","aria-label":n.ariaPageLabel(o+1),"aria-selected":i.activeIndex===o,"aria-controls":i.id+"_item_"+o,onClick:u=>n.onIndicatorClick(o),onMouseenter:u=>n.onIndicatorMouseEnter(o),onKeydown:u=>n.onIndicatorKeyDown(u,o)},[i.templates.indicator?c("",!0):(r(),d("button",te)),i.templates.indicator?(r(),v(g(i.templates.indicator),{key:1,index:o},null,8,["index"])):c("",!0)],42,ee))),128))])):c("",!0)])}$.render=ie;var A={name:"GalleriaThumbnails",emits:["stop-slideshow","update:activeIndex"],props:{containerId:{type:String,default:null},value:{type:Array,default:null},numVisible:{type:Number,default:3},activeIndex:{type:Number,default:0},isVertical:{type:Boolean,default:!1},slideShowActive:{type:Boolean,default:!1},circular:{type:Boolean,default:!1},responsiveOptions:{type:Array,default:null},contentHeight:{type:String,default:"300px"},showThumbnailNavigators:{type:Boolean,default:!0},templates:{type:null,default:null},prevButtonProps:{type:null,default:null},nextButtonProps:{type:null,default:null}},startPos:null,thumbnailsStyle:null,sortedResponsiveOptions:null,data(){return{d_numVisible:this.numVisible,d_oldNumVisible:this.numVisible,d_activeIndex:this.activeIndex,d_oldActiveItemIndex:this.activeIndex,totalShiftedItems:0,page:0}},watch:{numVisible(e,t){this.d_numVisible=e,this.d_oldNumVisible=t},activeIndex(e,t){this.d_activeIndex=e,this.d_oldActiveItemIndex=t}},mounted(){this.createStyle(),this.calculatePosition(),this.responsiveOptions&&this.bindDocumentListeners()},updated(){let e=this.totalShiftedItems;(this.d_oldNumVisible!==this.d_numVisible||this.d_oldActiveItemIndex!==this.d_activeIndex)&&(this.d_activeIndex<=this.getMedianItemIndex()?e=0:this.value.length-this.d_numVisible+this.getMedianItemIndex()<this.d_activeIndex?e=this.d_numVisible-this.value.length:this.value.length-this.d_numVisible<this.d_activeIndex&&this.d_numVisible%2===0?e=this.d_activeIndex*-1+this.getMedianItemIndex()+1:e=this.d_activeIndex*-1+this.getMedianItemIndex(),e!==this.totalShiftedItems&&(this.totalShiftedItems=e),this.$refs.itemsContainer.style.transform=this.isVertical?`translate3d(0, ${e*(100/this.d_numVisible)}%, 0)`:`translate3d(${e*(100/this.d_numVisible)}%, 0, 0)`,this.d_oldActiveItemIndex!==this.d_activeIndex&&(h.removeClass(this.$refs.itemsContainer,"p-items-hidden"),this.$refs.itemsContainer.style.transition="transform 500ms ease 0s"),this.d_oldActiveItemIndex=this.d_activeIndex,this.d_oldNumVisible=this.d_numVisible)},beforeUnmount(){this.responsiveOptions&&this.unbindDocumentListeners(),this.thumbnailsStyle&&this.thumbnailsStyle.parentNode.removeChild(this.thumbnailsStyle)},methods:{step(e){let t=this.totalShiftedItems+e;e<0&&-1*t+this.d_numVisible>this.value.length-1?t=this.d_numVisible-this.value.length:e>0&&t>0&&(t=0),this.circular&&(e<0&&this.value.length-1===this.d_activeIndex?t=0:e>0&&this.d_activeIndex===0&&(t=this.d_numVisible-this.value.length)),this.$refs.itemsContainer&&(h.removeClass(this.$refs.itemsContainer,"p-items-hidden"),this.$refs.itemsContainer.style.transform=this.isVertical?`translate3d(0, ${t*(100/this.d_numVisible)}%, 0)`:`translate3d(${t*(100/this.d_numVisible)}%, 0, 0)`,this.$refs.itemsContainer.style.transition="transform 500ms ease 0s"),this.totalShiftedItems=t},stopSlideShow(){this.slideShowActive&&this.stopSlideShow&&this.$emit("stop-slideshow")},getMedianItemIndex(){let e=Math.floor(this.d_numVisible/2);return this.d_numVisible%2?e:e-1},navBackward(e){this.stopSlideShow();let t=this.d_activeIndex!==0?this.d_activeIndex-1:0,i=t+this.totalShiftedItems;this.d_numVisible-i-1>this.getMedianItemIndex()&&(-1*this.totalShiftedItems!==0||this.circular)&&this.step(1);let l=this.circular&&this.d_activeIndex===0?this.value.length-1:t;this.$emit("update:activeIndex",l),e.cancelable&&e.preventDefault()},navForward(e){this.stopSlideShow();let t=this.d_activeIndex===this.value.length-1?this.value.length-1:this.d_activeIndex+1;t+this.totalShiftedItems>this.getMedianItemIndex()&&(-1*this.totalShiftedItems<this.getTotalPageNumber()-1||this.circular)&&this.step(-1);let i=this.circular&&this.value.length-1===this.d_activeIndex?0:t;this.$emit("update:activeIndex",i),e.cancelable&&e.preventDefault()},onItemClick(e){this.stopSlideShow();let t=e;if(t!==this.d_activeIndex){const i=t+this.totalShiftedItems;let l=0;t<this.d_activeIndex?(l=this.d_numVisible-i-1-this.getMedianItemIndex(),l>0&&-1*this.totalShiftedItems!==0&&this.step(l)):(l=this.getMedianItemIndex()-i,l<0&&-1*this.totalShiftedItems<this.getTotalPageNumber()-1&&this.step(l)),this.$emit("update:activeIndex",t)}},onThumbnailKeydown(e,t){switch((e.code==="Enter"||e.code==="Space")&&(this.onItemClick(t),e.preventDefault()),e.code){case"ArrowRight":this.onRightKey();break;case"ArrowLeft":this.onLeftKey();break;case"Home":this.onHomeKey(),e.preventDefault();break;case"End":this.onEndKey(),e.preventDefault();break;case"ArrowUp":case"ArrowDown":e.preventDefault();break;case"Tab":this.onTabKey();break}},onRightKey(){const e=h.find(this.$refs.itemsContainer,".p-galleria-thumbnail-item"),t=this.findFocusedIndicatorIndex();this.changedFocusedIndicator(t,t+1===e.length?e.length-1:t+1)},onLeftKey(){const e=this.findFocusedIndicatorIndex();this.changedFocusedIndicator(e,e-1<=0?0:e-1)},onHomeKey(){const e=this.findFocusedIndicatorIndex();this.changedFocusedIndicator(e,0)},onEndKey(){const e=h.find(this.$refs.itemsContainer,".p-galleria-thumbnail-item"),t=this.findFocusedIndicatorIndex();this.changedFocusedIndicator(t,e.length-1)},onTabKey(){const e=[...h.find(this.$refs.itemsContainer,".p-galleria-thumbnail-item")],t=e.findIndex(a=>h.hasClass(a,"p-galleria-thumbnail-item-current")),i=h.findSingle(this.$refs.itemsContainer,'.p-galleria-thumbnail-item > [tabindex="0"'),l=e.findIndex(a=>a===i.parentElement);e[l].children[0].tabIndex="-1",e[t].children[0].tabIndex="0"},findFocusedIndicatorIndex(){const e=[...h.find(this.$refs.itemsContainer,".p-galleria-thumbnail-item")],t=h.findSingle(this.$refs.itemsContainer,'.p-galleria-thumbnail-item > [tabindex="0"]');return e.findIndex(i=>i===t.parentElement)},changedFocusedIndicator(e,t){const i=h.find(this.$refs.itemsContainer,".p-galleria-thumbnail-item");i[e].children[0].tabIndex="-1",i[t].children[0].tabIndex="0",i[t].children[0].focus()},onTransitionEnd(){this.$refs.itemsContainer&&(h.addClass(this.$refs.itemsContainer,"p-items-hidden"),this.$refs.itemsContainer.style.transition="")},onTouchStart(e){let t=e.changedTouches[0];this.startPos={x:t.pageX,y:t.pageY}},onTouchMove(e){e.cancelable&&e.preventDefault()},onTouchEnd(e){let t=e.changedTouches[0];this.isVertical?this.changePageOnTouch(e,t.pageY-this.startPos.y):this.changePageOnTouch(e,t.pageX-this.startPos.x)},changePageOnTouch(e,t){t<0?this.navForward(e):this.navBackward(e)},getTotalPageNumber(){return this.value.length>this.d_numVisible?this.value.length-this.d_numVisible+1:0},createStyle(){this.thumbnailsStyle||(this.thumbnailsStyle=document.createElement("style"),this.thumbnailsStyle.type="text/css",document.body.appendChild(this.thumbnailsStyle));let e=`
                #${this.containerId} .p-galleria-thumbnail-item {
                    flex: 1 0 ${100/this.d_numVisible}%
                }
            `;if(this.responsiveOptions){this.sortedResponsiveOptions=[...this.responsiveOptions],this.sortedResponsiveOptions.sort((t,i)=>{const l=t.breakpoint,a=i.breakpoint;let n=null;return l==null&&a!=null?n=-1:l!=null&&a==null?n=1:l==null&&a==null?n=0:typeof l=="string"&&typeof a=="string"?n=l.localeCompare(a,void 0,{numeric:!0}):n=l<a?-1:l>a?1:0,-1*n});for(let t=0;t<this.sortedResponsiveOptions.length;t++){let i=this.sortedResponsiveOptions[t];e+=`
                        @media screen and (max-width: ${i.breakpoint}) {
                            #${this.containerId} .p-galleria-thumbnail-item {
                                flex: 1 0 ${100/i.numVisible}%
                            }
                        }
                    `}}this.thumbnailsStyle.innerHTML=e},calculatePosition(){if(this.$refs.itemsContainer&&this.sortedResponsiveOptions){let e=window.innerWidth,t={numVisible:this.numVisible};for(let i=0;i<this.sortedResponsiveOptions.length;i++){let l=this.sortedResponsiveOptions[i];parseInt(l.breakpoint,10)>=e&&(t=l)}this.d_numVisible!==t.numVisible&&(this.d_numVisible=t.numVisible)}},bindDocumentListeners(){this.documentResizeListener||(this.documentResizeListener=()=>{this.calculatePosition()},window.addEventListener("resize",this.documentResizeListener))},unbindDocumentListeners(){this.documentResizeListener&&(window.removeEventListener("resize",this.documentResizeListener),this.documentResizeListener=null)},isNavBackwardDisabled(){return!this.circular&&this.d_activeIndex===0||this.value.length<=this.d_numVisible},isNavForwardDisabled(){return!this.circular&&this.d_activeIndex===this.value.length-1||this.value.length<=this.d_numVisible},firstItemAciveIndex(){return this.totalShiftedItems*-1},lastItemActiveIndex(){return this.firstItemAciveIndex()+this.d_numVisible-1},isItemActive(e){return this.firstItemAciveIndex()<=e&&this.lastItemActiveIndex()>=e},ariaPageLabel(e){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.pageLabel.replace(/{page}/g,e):void 0}},computed:{navBackwardClass(){return["p-galleria-thumbnail-prev p-link",{"p-disabled":this.isNavBackwardDisabled()}]},navForwardClass(){return["p-galleria-thumbnail-next p-link",{"p-disabled":this.isNavForwardDisabled()}]},navBackwardIconClass(){return["p-galleria-thumbnail-prev-icon pi",{"pi-chevron-left":!this.isVertical,"pi-chevron-up":this.isVertical}]},navForwardIconClass(){return["p-galleria-thumbnail-next-icon pi",{"pi-chevron-right":!this.isVertical,"pi-chevron-down":this.isVertical}]},ariaPrevButtonLabel(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.prevPageLabel:void 0},ariaNextButtonLabel(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.nextPageLabel:void 0}},directives:{ripple:C}};const ne={class:"p-galleria-thumbnail-wrapper"},ae={class:"p-galleria-thumbnail-container"},le=["disabled","aria-label"],se=["aria-selected","aria-controls","onKeydown"],re=["tabindex","aria-label","aria-current","onClick"],oe=["disabled","aria-label"];function de(e,t,i,l,a,n){const p=x("ripple");return r(),d("div",ne,[m("div",ae,[i.showThumbnailNavigators?b((r(),d("button",I({key:0,class:n.navBackwardClass,disabled:n.isNavBackwardDisabled(),type:"button","aria-label":n.ariaPrevButtonLabel,onClick:t[0]||(t[0]=s=>n.navBackward(s))},i.prevButtonProps),[m("span",{class:f(n.navBackwardIconClass)},null,2)],16,le)),[[p]]):c("",!0),m("div",{class:"p-galleria-thumbnail-items-container",style:B({height:i.isVertical?i.contentHeight:""})},[m("div",{ref:"itemsContainer",class:"p-galleria-thumbnail-items",role:"tablist",onTransitionend:t[1]||(t[1]=(...s)=>n.onTransitionEnd&&n.onTransitionEnd(...s)),onTouchstart:t[2]||(t[2]=s=>n.onTouchStart(s)),onTouchmove:t[3]||(t[3]=s=>n.onTouchMove(s)),onTouchend:t[4]||(t[4]=s=>n.onTouchEnd(s))},[(r(!0),d(_,null,k(i.value,(s,o)=>(r(),d("div",{key:`p-galleria-thumbnail-item-${o}`,class:f(["p-galleria-thumbnail-item",{"p-galleria-thumbnail-item-current":i.activeIndex===o,"p-galleria-thumbnail-item-active":n.isItemActive(o),"p-galleria-thumbnail-item-start":n.firstItemAciveIndex()===o,"p-galleria-thumbnail-item-end":n.lastItemActiveIndex()===o}]),role:"tab","aria-selected":i.activeIndex===o,"aria-controls":i.containerId+"_item_"+o,onKeydown:u=>n.onThumbnailKeydown(u,o)},[m("div",{class:"p-galleria-thumbnail-item-content",tabindex:i.activeIndex===o?"0":"-1","aria-label":n.ariaPageLabel(o+1),"aria-current":i.activeIndex===o?"page":void 0,onClick:u=>n.onItemClick(o)},[i.templates.thumbnail?(r(),v(g(i.templates.thumbnail),{key:0,item:s},null,8,["item"])):c("",!0)],8,re)],42,se))),128))],544)],4),i.showThumbnailNavigators?b((r(),d("button",I({key:1,class:n.navForwardClass,disabled:n.isNavForwardDisabled(),type:"button","aria-label":n.ariaNextButtonLabel,onClick:t[5]||(t[5]=s=>n.navForward(s))},i.nextButtonProps),[m("span",{class:f(n.navForwardIconClass)},null,2)],16,oe)),[[p]]):c("",!0)])])}A.render=de;var T={name:"GalleriaContent",inheritAttrs:!1,interval:null,emits:["activeitem-change","mask-hide"],data(){return{id:this.$attrs.id||E(),activeIndex:this.$attrs.activeIndex,numVisible:this.$attrs.numVisible,slideShowActive:!1}},watch:{"$attrs.value":function(e){e&&e.length<this.numVisible&&(this.numVisible=e.length)},"$attrs.activeIndex":function(e){this.activeIndex=e},"$attrs.numVisible":function(e){this.numVisible=e}},updated(){this.$emit("activeitem-change",this.activeIndex)},beforeUnmount(){this.slideShowActive&&this.stopSlideShow()},methods:{isAutoPlayActive(){return this.slideShowActive},startSlideShow(){this.interval=setInterval(()=>{let e=this.$attrs.circular&&this.$attrs.value.length-1===this.activeIndex?0:this.activeIndex+1;this.activeIndex=e},this.$attrs.transitionInterval),this.slideShowActive=!0},stopSlideShow(){this.interval&&clearInterval(this.interval),this.slideShowActive=!1},getPositionClass(e,t){const l=["top","left","bottom","right"].find(a=>a===t);return l?`${e}-${l}`:""},isVertical(){return this.$attrs.thumbnailsPosition==="left"||this.$attrs.thumbnailsPosition==="right"}},computed:{galleriaClass(){const e=this.$attrs.showThumbnails&&this.getPositionClass("p-galleria-thumbnails",this.$attrs.thumbnailsPosition),t=this.$attrs.showIndicators&&this.getPositionClass("p-galleria-indicators",this.$attrs.indicatorsPosition);return["p-galleria p-component",{"p-galleria-fullscreen":this.$attrs.fullScreen,"p-galleria-indicator-onitem":this.$attrs.showIndicatorsOnItem,"p-galleria-item-nav-onhover":this.$attrs.showItemNavigatorsOnHover&&!this.$attrs.fullScreen},e,t,this.$attrs.containerClass]},closeAriaLabel(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.close:void 0}},components:{GalleriaItem:$,GalleriaThumbnails:A},directives:{ripple:C}};const ce=["id"],ue=["aria-label"],he=m("span",{class:"p-galleria-close-icon pi pi-times"},null,-1),me=[he],pe={key:1,class:"p-galleria-header"},ve=["aria-live"],fe={key:2,class:"p-galleria-footer"};function ge(e,t,i,l,a,n){const p=y("GalleriaItem"),s=y("GalleriaThumbnails"),o=x("ripple");return e.$attrs.value&&e.$attrs.value.length>0?(r(),d("div",I({key:0,id:a.id,class:n.galleriaClass,style:e.$attrs.containerStyle},e.$attrs.containerProps),[e.$attrs.fullScreen?b((r(),d("button",{key:0,autofocus:"",type:"button",class:"p-galleria-close p-link","aria-label":n.closeAriaLabel,onClick:t[0]||(t[0]=u=>e.$emit("mask-hide"))},me,8,ue)),[[o]]):c("",!0),e.$attrs.templates&&e.$attrs.templates.header?(r(),d("div",pe,[(r(),v(g(e.$attrs.templates.header)))])):c("",!0),m("div",{class:"p-galleria-content","aria-live":e.$attrs.autoPlay?"polite":"off"},[V(p,{id:a.id,activeIndex:a.activeIndex,"onUpdate:activeIndex":t[1]||(t[1]=u=>a.activeIndex=u),slideShowActive:a.slideShowActive,"onUpdate:slideShowActive":t[2]||(t[2]=u=>a.slideShowActive=u),value:e.$attrs.value,circular:e.$attrs.circular,templates:e.$attrs.templates,showIndicators:e.$attrs.showIndicators,changeItemOnIndicatorHover:e.$attrs.changeItemOnIndicatorHover,showItemNavigators:e.$attrs.showItemNavigators,autoPlay:e.$attrs.autoPlay,onStartSlideshow:n.startSlideShow,onStopSlideshow:n.stopSlideShow},null,8,["id","activeIndex","slideShowActive","value","circular","templates","showIndicators","changeItemOnIndicatorHover","showItemNavigators","autoPlay","onStartSlideshow","onStopSlideshow"]),e.$attrs.showThumbnails?(r(),v(s,{key:0,activeIndex:a.activeIndex,"onUpdate:activeIndex":t[3]||(t[3]=u=>a.activeIndex=u),slideShowActive:a.slideShowActive,"onUpdate:slideShowActive":t[4]||(t[4]=u=>a.slideShowActive=u),containerId:a.id,value:e.$attrs.value,templates:e.$attrs.templates,numVisible:a.numVisible,responsiveOptions:e.$attrs.responsiveOptions,circular:e.$attrs.circular,isVertical:n.isVertical(),contentHeight:e.$attrs.verticalThumbnailViewPortHeight,showThumbnailNavigators:e.$attrs.showThumbnailNavigators,prevButtonProps:e.$attrs.prevButtonProps,nextButtonProps:e.$attrs.nextButtonProps,onStopSlideshow:n.stopSlideShow},null,8,["activeIndex","slideShowActive","containerId","value","templates","numVisible","responsiveOptions","circular","isVertical","contentHeight","showThumbnailNavigators","prevButtonProps","nextButtonProps","onStopSlideshow"])):c("",!0)],8,ve),e.$attrs.templates&&e.$attrs.templates.footer?(r(),d("div",fe,[(r(),v(g(e.$attrs.templates.footer)))])):c("",!0)],16,ce)):c("",!0)}T.render=ge;var F={name:"Galleria",inheritAttrs:!1,emits:["update:activeIndex","update:visible"],props:{id:{type:String,default:null},value:{type:Array,default:null},activeIndex:{type:Number,default:0},fullScreen:{type:Boolean,default:!1},visible:{type:Boolean,default:!1},numVisible:{type:Number,default:3},responsiveOptions:{type:Array,default:null},showItemNavigators:{type:Boolean,default:!1},showThumbnailNavigators:{type:Boolean,default:!0},showItemNavigatorsOnHover:{type:Boolean,default:!1},changeItemOnIndicatorHover:{type:Boolean,default:!1},circular:{type:Boolean,default:!1},autoPlay:{type:Boolean,default:!1},transitionInterval:{type:Number,default:4e3},showThumbnails:{type:Boolean,default:!0},thumbnailsPosition:{type:String,default:"bottom"},verticalThumbnailViewPortHeight:{type:String,default:"300px"},showIndicators:{type:Boolean,default:!1},showIndicatorsOnItem:{type:Boolean,default:!1},indicatorsPosition:{type:String,default:"bottom"},baseZIndex:{type:Number,default:0},maskClass:{type:String,default:null},containerStyle:{type:null,default:null},containerClass:{type:null,default:null},containerProps:{type:null,default:null},prevButtonProps:{type:null,default:null},nextButtonProps:{type:null,default:null}},container:null,mask:null,data(){return{containerVisible:this.visible}},updated(){this.fullScreen&&this.visible&&(this.containerVisible=this.visible)},beforeUnmount(){this.fullScreen&&h.removeClass(document.body,"p-overflow-hidden"),this.mask=null,this.container&&(S.clear(this.container),this.container=null)},methods:{onBeforeEnter(e){S.set("modal",e,this.baseZIndex||this.$primevue.config.zIndex.modal)},onEnter(e){this.mask.style.zIndex=String(parseInt(e.style.zIndex,10)-1),h.addClass(document.body,"p-overflow-hidden"),this.focus()},onBeforeLeave(){h.addClass(this.mask,"p-component-overlay-leave")},onAfterLeave(e){S.clear(e),this.containerVisible=!1,h.removeClass(document.body,"p-overflow-hidden")},onActiveItemChange(e){this.activeIndex!==e&&this.$emit("update:activeIndex",e)},maskHide(){this.$emit("update:visible",!1)},containerRef(e){this.container=e},maskRef(e){this.mask=e},focus(){let e=this.container.$el.querySelector("[autofocus]");e&&e.focus()}},computed:{maskContentClass(){return["p-galleria-mask p-component-overlay p-component-overlay-enter",this.maskClass,{"p-input-filled":this.$primevue.config.inputStyle==="filled","p-ripple-disabled":this.$primevue.config.ripple===!1}]}},components:{GalleriaContent:T,Portal:P},directives:{focustrap:N}};const be=["role","aria-modal"];function Ie(e,t,i,l,a,n){const p=y("GalleriaContent"),s=y("Portal"),o=x("focustrap");return i.fullScreen?(r(),v(s,{key:0},{default:w(()=>[a.containerVisible?(r(),d("div",{key:0,ref:n.maskRef,class:f(n.maskContentClass),role:i.fullScreen?"dialog":"region","aria-modal":i.fullScreen?"true":void 0},[V(D,{name:"p-galleria",onBeforeEnter:n.onBeforeEnter,onEnter:n.onEnter,onBeforeLeave:n.onBeforeLeave,onAfterLeave:n.onAfterLeave,appear:""},{default:w(()=>[i.visible?b((r(),v(p,I({key:0,ref:n.containerRef},e.$props,{onMaskHide:n.maskHide,templates:e.$slots,onActiveitemChange:n.onActiveItemChange}),null,16,["onMaskHide","templates","onActiveitemChange"])),[[o]]):c("",!0)]),_:1},8,["onBeforeEnter","onEnter","onBeforeLeave","onAfterLeave"])],10,be)):c("",!0)]),_:1})):(r(),v(p,I({key:1},e.$props,{templates:e.$slots,onActiveitemChange:n.onActiveItemChange}),null,16,["templates","onActiveitemChange"]))}function ye(e,t){t===void 0&&(t={});var i=t.insertAt;if(!(!e||typeof document>"u")){var l=document.head||document.getElementsByTagName("head")[0],a=document.createElement("style");a.type="text/css",i==="top"&&l.firstChild?l.insertBefore(a,l.firstChild):l.appendChild(a),a.styleSheet?a.styleSheet.cssText=e:a.appendChild(document.createTextNode(e))}}var we=`
.p-galleria-content {
    display: flex;
    flex-direction: column;
}
.p-galleria-item-wrapper {
    display: flex;
    flex-direction: column;
    position: relative;
}
.p-galleria-item-container {
    position: relative;
    display: flex;
    height: 100%;
}
.p-galleria-item-nav {
    position: absolute;
    top: 50%;
    margin-top: -0.5rem;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}
.p-galleria-item-prev {
    left: 0;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
.p-galleria-item-next {
    right: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.p-galleria-item {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
}
.p-galleria-item-nav-onhover .p-galleria-item-nav {
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
}
.p-galleria-item-nav-onhover .p-galleria-item-wrapper:hover .p-galleria-item-nav {
    pointer-events: all;
    opacity: 1;
}
.p-galleria-item-nav-onhover .p-galleria-item-wrapper:hover .p-galleria-item-nav.p-disabled {
    pointer-events: none;
}
.p-galleria-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
}

/* Thumbnails */
.p-galleria-thumbnail-wrapper {
    display: flex;
    flex-direction: column;
    overflow: auto;
    flex-shrink: 0;
}
.p-galleria-thumbnail-prev,
.p-galleria-thumbnail-next {
    align-self: center;
    flex: 0 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    position: relative;
}
.p-galleria-thumbnail-prev span,
.p-galleria-thumbnail-next span {
    display: flex;
    justify-content: center;
    align-items: center;
}
.p-galleria-thumbnail-container {
    display: flex;
    flex-direction: row;
}
.p-galleria-thumbnail-items-container {
    overflow: hidden;
    width: 100%;
}
.p-galleria-thumbnail-items {
    display: flex;
}
.p-galleria-thumbnail-item {
    overflow: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0.5;
}
.p-galleria-thumbnail-item:hover {
    opacity: 1;
    transition: opacity 0.3s;
}
.p-galleria-thumbnail-item-current {
    opacity: 1;
}

/* Positions */
/* Thumbnails */
.p-galleria-thumbnails-left .p-galleria-content,
.p-galleria-thumbnails-right .p-galleria-content {
    flex-direction: row;
}
.p-galleria-thumbnails-left .p-galleria-item-wrapper,
.p-galleria-thumbnails-right .p-galleria-item-wrapper {
    flex-direction: row;
}
.p-galleria-thumbnails-left .p-galleria-item-wrapper,
.p-galleria-thumbnails-top .p-galleria-item-wrapper {
    order: 2;
}
.p-galleria-thumbnails-left .p-galleria-thumbnail-wrapper,
.p-galleria-thumbnails-top .p-galleria-thumbnail-wrapper {
    order: 1;
}
.p-galleria-thumbnails-left .p-galleria-thumbnail-container,
.p-galleria-thumbnails-right .p-galleria-thumbnail-container {
    flex-direction: column;
    flex-grow: 1;
}
.p-galleria-thumbnails-left .p-galleria-thumbnail-items,
.p-galleria-thumbnails-right .p-galleria-thumbnail-items {
    flex-direction: column;
    height: 100%;
}

/* Indicators */
.p-galleria-indicators {
    display: flex;
    align-items: center;
    justify-content: center;
}
.p-galleria-indicator > button {
    display: inline-flex;
    align-items: center;
}
.p-galleria-indicators-left .p-galleria-item-wrapper,
.p-galleria-indicators-right .p-galleria-item-wrapper {
    flex-direction: row;
    align-items: center;
}
.p-galleria-indicators-left .p-galleria-item-container,
.p-galleria-indicators-top .p-galleria-item-container {
    order: 2;
}
.p-galleria-indicators-left .p-galleria-indicators,
.p-galleria-indicators-top .p-galleria-indicators {
    order: 1;
}
.p-galleria-indicators-left .p-galleria-indicators,
.p-galleria-indicators-right .p-galleria-indicators {
    flex-direction: column;
}
.p-galleria-indicator-onitem .p-galleria-indicators {
    position: absolute;
    display: flex;
}
.p-galleria-indicator-onitem.p-galleria-indicators-top .p-galleria-indicators {
    top: 0;
    left: 0;
    width: 100%;
    align-items: flex-start;
}
.p-galleria-indicator-onitem.p-galleria-indicators-right .p-galleria-indicators {
    right: 0;
    top: 0;
    height: 100%;
    align-items: flex-end;
}
.p-galleria-indicator-onitem.p-galleria-indicators-bottom .p-galleria-indicators {
    bottom: 0;
    left: 0;
    width: 100%;
    align-items: flex-end;
}
.p-galleria-indicator-onitem.p-galleria-indicators-left .p-galleria-indicators {
    left: 0;
    top: 0;
    height: 100%;
    align-items: flex-start;
}

/* FullScreen */
.p-galleria-mask {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.p-galleria-close {
    position: absolute;
    top: 0;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}
.p-galleria-mask .p-galleria-item-nav {
    position: fixed;
    top: 50%;
    margin-top: -0.5rem;
}

/* Animation */
.p-galleria-enter-active {
    transition: all 150ms cubic-bezier(0, 0, 0.2, 1);
}
.p-galleria-leave-active {
    transition: all 150ms cubic-bezier(0.4, 0, 0.2, 1);
}
.p-galleria-enter-from,
.p-galleria-leave-to {
    opacity: 0;
    transform: scale(0.7);
}
.p-galleria-enter-active .p-galleria-item-nav {
    opacity: 0;
}

/* Keyboard Support */
.p-items-hidden .p-galleria-thumbnail-item {
    visibility: hidden;
}
.p-items-hidden .p-galleria-thumbnail-item.p-galleria-thumbnail-item-active {
    visibility: visible;
}
`;ye(we);F.render=Ie;const xe=O({components:{button:L,galleria:F},setup(){return{images:R([{itemImageSrc:"images/foto12.jpg",thumbnailImageSrc:"images/foto12.jpg"},{itemImageSrc:"images/fondoupq5.jpg",thumbnailImageSrc:"images/fondoupq5.jpg"},{itemImageSrc:"images/foto22.jpg",thumbnailImageSrc:"images/foto22.jpg"},{itemImageSrc:"images/foto32.jpg",thumbnailImageSrc:"images/foto32.jpg"}])}},data(){return{activeIndex:0,showThumbnails:!1,fullScreen:!1,galleriaClass:"custom-galleria"}},mounted(){this.galleriaClass.getImages().then(e=>this.images=e),this.bindDocumentListeners()},methods:{onThumbnailButtonClick(){this.showThumbnails=!this.showThumbnails},toggleFullScreen(){this.fullScreen?this.closeFullScreen():this.openFullScreen()},onFullScreenChange(){this.fullScreen=!this.fullScreen},openFullScreen(){let e=this.$refs.galleria.$el;e.requestFullscreen?e.requestFullscreen():e.mozRequestFullScreen?e.mozRequestFullScreen():e.webkitRequestFullscreen?e.webkitRequestFullscreen():e.msRequestFullscreen&&e.msRequestFullscreen()},closeFullScreen(){document.exitFullscreen?document.exitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitExitFullscreen?document.webkitExitFullscreen():document.msExitFullscreen&&document.msExitFullscreen()},bindDocumentListeners(){document.addEventListener("fullscreenchange",this.onFullScreenChange),document.addEventListener("mozfullscreenchange",this.onFullScreenChange),document.addEventListener("webkitfullscreenchange",this.onFullScreenChange),document.addEventListener("msfullscreenchange",this.onFullScreenChange)},unbindDocumentListeners(){document.removeEventListener("fullscreenchange",this.onFullScreenChange),document.removeEventListener("mozfullscreenchange",this.onFullScreenChange),document.removeEventListener("webkitfullscreenchange",this.onFullScreenChange),document.removeEventListener("msfullscreenchange",this.onFullScreenChange)}},computed:{galleriaClass(){return["custom-galleria",{fullscreen:this.fullScreen}]},fullScreenIcon(){return`pi ${this.fullScreen?"pi-window-minimize":"pi-window-maximize"}`}}}),Se=["src","alt"],Ce={class:"grid grid-nogutter justify-content-center"},_e=["src","alt"];function ke(e,t,i,l,a,n){const p=y("galleria");return r(),v(p,{ref:"galleria",value:e.images,activeIndex:e.activeIndex,"onUpdate:activeIndex":t[0]||(t[0]=s=>e.activeIndex=s),numVisible:5,containerStyle:"min-height: fullscreen",containerClass:e.galleriaClass,showThumbnails:e.showThumbnails,showItemNavigators:!0,showItemNavigatorsOnHover:!0,circular:!0,autoPlay:!0,transitionInterval:3e3},{item:w(s=>[m("img",{src:s.item.itemImageSrc,alt:s.item.alt,style:B([{width:e.fullScreen?"":"100%",display:e.fullScreen?"":"block"}])},null,12,Se)]),thumbnail:w(s=>[m("div",Ce,[m("img",{src:s.item.thumbnailImageSrc,alt:s.item.alt,style:{display:"block"}},null,8,_e)])]),_:1},8,["value","activeIndex","containerClass","showThumbnails"])}const Ae=z(xe,[["render",ke],["__scopeId","data-v-7d148b78"]]);export{Ae as G};
