import{o as a,f as u,a as t,g as Y,d as B,l as te,u as f,n as h,h as v,t as k,m as ne,J as R,p as se,q as ie,r as b,i as D,e as L,s as O,b as l,w as c,T as Z,c as w,x as A,Z as C,D as y,y as x,z as I,A as E,U as T,j as oe,C as j,F as M,B as N,E as z,O as ae,k as re,G as le,H as de,X as ce,I as $,K as ue,L as pe}from"./app-1b8d8cba.js";import{_ as K}from"./_plugin-vue_export-helper-c27b6911.js";import{F as U,R as H,s as P,a as X}from"./button.esm-256f0b79.js";const me={},he={viewBox:"0 0 48 48",fill:"none",xmlns:"http://www.w3.org/2000/svg"},fe=t("path",{d:"M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z",fill:"#6875F5"},null,-1),ge=t("path",{d:"M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z",fill:"#6875F5"},null,-1),ve=[fe,ge];function be(e,n){return a(),u("svg",he,ve)}const ye=K(me,[["render",be]]),we={class:"max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8"},xe={class:"flex items-center justify-between flex-wrap"},ke={class:"w-0 flex-1 flex items-center min-w-0"},_e={key:0,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},Ce=t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),Le=[Ce],Be={key:1,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},Se=t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"},null,-1),ze=[Se],Ee={class:"ml-3 font-medium text-sm text-white truncate"},Ie={class:"shrink-0 sm:ml-3"},je=t("svg",{class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18L18 6M6 6l12 12"})],-1),Ae=[je],Me={__name:"Banner",setup(e){const n=Y(!0),s=B(()=>{var o;return((o=R().props.jetstream.flash)==null?void 0:o.bannerStyle)||"success"}),r=B(()=>{var o;return((o=R().props.jetstream.flash)==null?void 0:o.banner)||""});return te(r,async()=>{n.value=!0}),(o,i)=>(a(),u("div",null,[n.value&&f(r)?(a(),u("div",{key:0,class:h({"bg-indigo-500":f(s)=="success","bg-red-700":f(s)=="danger"})},[t("div",we,[t("div",xe,[t("div",ke,[t("span",{class:h(["flex p-2 rounded-lg",{"bg-indigo-600":f(s)=="success","bg-red-600":f(s)=="danger"}])},[f(s)=="success"?(a(),u("svg",_e,Le)):v("",!0),f(s)=="danger"?(a(),u("svg",Be,ze)):v("",!0)],2),t("p",Ee,k(f(r)),1)]),t("div",Ie,[t("button",{type:"button",class:h(["-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition",{"hover:bg-indigo-600 focus:bg-indigo-600":f(s)=="success","hover:bg-red-600 focus:bg-red-600":f(s)=="danger"}]),"aria-label":"Dismiss",onClick:i[0]||(i[0]=ne(m=>n.value=!1,["prevent"]))},Ae,2)])])])],2)):v("",!0)]))}},De={class:"relative"},$e={__name:"Dropdown",props:{align:{type:String,default:"right"},width:{type:String,default:"48"},contentClasses:{type:Array,default:()=>["py-1","bg-white"]}},setup(e){const n=e;let s=Y(!1);const r=m=>{s.value&&m.key==="Escape"&&(s.value=!1)};se(()=>document.addEventListener("keydown",r)),ie(()=>document.removeEventListener("keydown",r));const o=B(()=>({48:"w-48"})[n.width.toString()]),i=B(()=>n.align==="left"?"origin-top-left left-0":n.align==="right"?"origin-top-right right-0":"origin-top");return(m,p)=>(a(),u("div",De,[t("div",{onClick:p[0]||(p[0]=d=>D(s)?s.value=!f(s):s=!f(s))},[b(m.$slots,"trigger")]),L(t("div",{class:"fixed inset-0 z-40",onClick:p[1]||(p[1]=d=>D(s)?s.value=!1:s=!1)},null,512),[[O,f(s)]]),l(Z,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:c(()=>[L(t("div",{class:h(["absolute z-50 mt-2 rounded-md shadow-lg",[f(o),f(i)]]),style:{display:"none"},onClick:p[2]||(p[2]=d=>D(s)?s.value=!1:s=!1)},[t("div",{class:h(["rounded-md ring-1 ring-black ring-opacity-5",e.contentClasses])},[b(m.$slots,"content")],2)],2),[[O,f(s)]])]),_:3})]))}},Te={key:0,type:"submit",class:"block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"},Ze=["href"],He={__name:"DropdownLink",props:{href:String,as:String},setup(e){return(n,s)=>(a(),u("div",null,[e.as=="button"?(a(),u("button",Te,[b(n.$slots,"default")])):e.as=="a"?(a(),u("a",{key:1,href:e.href,class:"block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"},[b(n.$slots,"default")],8,Ze)):(a(),w(f(A),{key:2,href:e.href,class:"block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"},{default:c(()=>[b(n.$slots,"default")]),_:3},8,["href"]))]))}},Pe={__name:"NavLink",props:{href:String,active:Boolean},setup(e){const n=e,s=B(()=>n.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition");return(r,o)=>(a(),w(f(A),{href:e.href,class:h(f(s))},{default:c(()=>[b(r.$slots,"default")]),_:3},8,["href","class"]))}},Ve={__name:"ResponsiveNavLink",props:{active:Boolean,href:String,as:String},setup(e){const n=e,s=B(()=>n.active?"block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition":"block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition");return(r,o)=>(a(),u("div",null,[e.as=="button"?(a(),u("button",{key:0,class:h([f(s),"w-full text-left"])},[b(r.$slots,"default")],2)):(a(),w(f(A),{key:1,href:e.href,class:h(f(s))},{default:c(()=>[b(r.$slots,"default")]),_:3},8,["href","class"]))]))}};var F={name:"Sidebar",inheritAttrs:!1,emits:["update:visible","show","hide","after-hide"],props:{visible:{type:Boolean,default:!1},position:{type:String,default:"left"},baseZIndex:{type:Number,default:0},autoZIndex:{type:Boolean,default:!0},dismissable:{type:Boolean,default:!0},showCloseIcon:{type:Boolean,default:!0},closeIcon:{type:String,default:"pi pi-times"},modal:{type:Boolean,default:!0},blockScroll:{type:Boolean,default:!1}},data(){return{containerVisible:this.visible}},container:null,mask:null,content:null,headerContainer:null,closeButton:null,outsideClickListener:null,updated(){this.visible&&(this.containerVisible=this.visible)},beforeUnmount(){this.disableDocumentSettings(),this.mask&&this.autoZIndex&&C.clear(this.mask),this.container=null,this.mask=null},methods:{hide(){this.$emit("update:visible",!1)},onEnter(){this.$emit("show"),this.focus(),this.autoZIndex&&C.set("modal",this.mask,this.baseZIndex||this.$primevue.config.zIndex.modal)},onAfterEnter(){this.enableDocumentSettings()},onBeforeLeave(){this.modal&&y.addClass(this.mask,"p-component-overlay-leave")},onLeave(){this.$emit("hide")},onAfterLeave(){this.autoZIndex&&C.clear(this.mask),this.containerVisible=!1,this.disableDocumentSettings(),this.$emit("after-hide")},onMaskClick(e){this.dismissable&&this.modal&&this.mask===e.target&&this.hide()},focus(){const e=s=>s.querySelector("[autofocus]");let n=this.$slots.default&&e(this.content);n||(n=this.$slots.header&&e(this.headerContainer),n||(n=e(this.container))),n&&n.focus()},enableDocumentSettings(){this.dismissable&&!this.modal&&this.bindOutsideClickListener(),this.blockScroll&&y.addClass(document.body,"p-overflow-hidden")},disableDocumentSettings(){this.unbindOutsideClickListener(),this.blockScroll&&y.removeClass(document.body,"p-overflow-hidden")},onKeydown(e){e.code==="Escape"&&this.hide()},containerRef(e){this.container=e},maskRef(e){this.mask=e},contentRef(e){this.content=e},headerContainerRef(e){this.headerContainer=e},closeButtonRef(e){this.closeButton=e},getPositionClass(){const n=["left","right","top","bottom"].find(s=>s===this.position);return n?`p-sidebar-${n}`:""},bindOutsideClickListener(){this.outsideClickListener||(this.outsideClickListener=e=>{this.isOutsideClicked(e)&&this.hide()},document.addEventListener("click",this.outsideClickListener))},unbindOutsideClickListener(){this.outsideClickListener&&(document.removeEventListener("click",this.outsideClickListener),this.outsideClickListener=null)},isOutsideClicked(e){return this.container&&!this.container.contains(e.target)}},computed:{containerClass(){return["p-sidebar p-component",{"p-input-filled":this.$primevue.config.inputStyle==="filled","p-ripple-disabled":this.$primevue.config.ripple===!1,"p-sidebar-full":this.fullScreen}]},fullScreen(){return this.position==="full"},closeAriaLabel(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.close:void 0},maskClass(){return["p-sidebar-mask",this.getPositionClass(),{"p-component-overlay p-component-overlay-enter":this.modal,"p-sidebar-mask-scrollblocker":this.blockScroll,"p-sidebar-visible":this.containerVisible,"p-sidebar-full":this.fullScreen}]}},directives:{focustrap:U,ripple:H},components:{Portal:P}};const Re=["aria-modal"],Oe={key:0,class:"p-sidebar-header-content"},Ye=["aria-label"];function Ne(e,n,s,r,o,i){const m=x("Portal"),p=I("ripple"),d=I("focustrap");return a(),w(m,null,{default:c(()=>[o.containerVisible?(a(),u("div",{key:0,ref:i.maskRef,class:h(i.maskClass),onMousedown:n[2]||(n[2]=(...g)=>i.onMaskClick&&i.onMaskClick(...g))},[l(Z,{name:"p-sidebar",onEnter:i.onEnter,onAfterEnter:i.onAfterEnter,onBeforeLeave:i.onBeforeLeave,onLeave:i.onLeave,onAfterLeave:i.onAfterLeave,appear:""},{default:c(()=>[s.visible?L((a(),u("div",E({key:0,ref:i.containerRef,class:i.containerClass,role:"complementary","aria-modal":s.modal,onKeydown:n[1]||(n[1]=(...g)=>i.onKeydown&&i.onKeydown(...g))},e.$attrs),[t("div",{ref:i.headerContainerRef,class:"p-sidebar-header"},[e.$slots.header?(a(),u("div",Oe,[b(e.$slots,"header")])):v("",!0),s.showCloseIcon?L((a(),u("button",{key:1,ref:i.closeButtonRef,autofocus:"",type:"button",class:"p-sidebar-close p-sidebar-icon p-link","aria-label":i.closeAriaLabel,onClick:n[0]||(n[0]=(...g)=>i.hide&&i.hide(...g))},[t("span",{class:h(["p-sidebar-close-icon",s.closeIcon])},null,2)],8,Ye)),[[p]]):v("",!0)],512),t("div",{ref:i.contentRef,class:"p-sidebar-content"},[b(e.$slots,"default")],512)],16,Re)),[[d]]):v("",!0)]),_:3},8,["onEnter","onAfterEnter","onBeforeLeave","onLeave","onAfterLeave"])],34)):v("",!0)]),_:3})}function Ke(e,n){n===void 0&&(n={});var s=n.insertAt;if(!(!e||typeof document>"u")){var r=document.head||document.getElementsByTagName("head")[0],o=document.createElement("style");o.type="text/css",s==="top"&&r.firstChild?r.insertBefore(o,r.firstChild):r.appendChild(o),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(document.createTextNode(e))}}var Ue=`
.p-sidebar-mask {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none;
    justify-content: center;
    align-items: center;
    pointer-events: none;
    background-color: transparent;
    transition-property: background-color;
}
.p-sidebar-mask.p-component-overlay {
    pointer-events: auto;
}
.p-sidebar-visible {
    display: flex;
}
.p-sidebar {
    display: flex;
    flex-direction: column;
    pointer-events: auto;
    transform: translate3d(0px, 0px, 0px);
    position: relative;
    transition: transform 0.3s;
}
.p-sidebar-content {
    overflow-y: auto;
    flex-grow: 1;
}
.p-sidebar-header {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    flex-shrink: 0;
}
.p-sidebar-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}
.p-sidebar-full .p-sidebar {
    transition: none;
    transform: none;
    width: 100vw !important;
    height: 100vh !important;
    max-height: 100%;
    top: 0px !important;
    left: 0px !important;
}

/* Animation */
/* Center */
.p-sidebar-left .p-sidebar-enter-from,
.p-sidebar-left .p-sidebar-leave-to {
    transform: translateX(-100%);
}
.p-sidebar-right .p-sidebar-enter-from,
.p-sidebar-right .p-sidebar-leave-to {
    transform: translateX(100%);
}
.p-sidebar-top .p-sidebar-enter-from,
.p-sidebar-top .p-sidebar-leave-to {
    transform: translateY(-100%);
}
.p-sidebar-bottom .p-sidebar-enter-from,
.p-sidebar-bottom .p-sidebar-leave-to {
    transform: translateY(100%);
}
.p-sidebar-full .p-sidebar-enter-from,
.p-sidebar-full .p-sidebar-leave-to {
    opacity: 0;
}
.p-sidebar-full .p-sidebar-enter-active,
.p-sidebar-full .p-sidebar-leave-active {
    transition: opacity 400ms cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* Position */
.p-sidebar-left {
    justify-content: flex-start;
}
.p-sidebar-right {
    justify-content: flex-end;
}
.p-sidebar-top {
    align-items: flex-start;
}
.p-sidebar-bottom {
    align-items: flex-end;
}

/* Size */
.p-sidebar-left .p-sidebar {
    width: 20rem;
    height: 100%;
}
.p-sidebar-right .p-sidebar {
    width: 20rem;
    height: 100%;
}
.p-sidebar-top .p-sidebar {
    height: 10rem;
    width: 100%;
}
.p-sidebar-bottom .p-sidebar {
    height: 10rem;
    width: 100%;
}
.p-sidebar-left .p-sidebar-sm,
.p-sidebar-right .p-sidebar-sm {
    width: 20rem;
}
.p-sidebar-left .p-sidebar-md,
.p-sidebar-right .p-sidebar-md {
    width: 40rem;
}
.p-sidebar-left .p-sidebar-lg,
.p-sidebar-right .p-sidebar-lg {
    width: 60rem;
}
.p-sidebar-top .p-sidebar-sm,
.p-sidebar-bottom .p-sidebar-sm {
    height: 10rem;
}
.p-sidebar-top .p-sidebar-md,
.p-sidebar-bottom .p-sidebar-md {
    height: 20rem;
}
.p-sidebar-top .p-sidebar-lg,
.p-sidebar-bottom .p-sidebar-lg {
    height: 30rem;
}
.p-sidebar-left .p-sidebar-content,
.p-sidebar-right .p-sidebar-content,
.p-sidebar-top .p-sidebar-content,
.p-sidebar-bottom .p-sidebar-content {
    width: 100%;
    height: 100%;
}
@media screen and (max-width: 64em) {
.p-sidebar-left .p-sidebar-lg,
    .p-sidebar-left .p-sidebar-md,
    .p-sidebar-right .p-sidebar-lg,
    .p-sidebar-right .p-sidebar-md {
        width: 20rem;
}
}
`;Ke(Ue);F.render=Ne;var G={name:"Avatar",emits:["error"],props:{label:{type:String,default:null},icon:{type:String,default:null},image:{type:String,default:null},size:{type:String,default:"normal"},shape:{type:String,default:"square"},"aria-labelledby":{type:String,default:null},"aria-label":{type:String,default:null}},methods:{onError(){this.$emit("error")}},computed:{containerClass(){return["p-avatar p-component",{"p-avatar-image":this.image!=null,"p-avatar-circle":this.shape==="circle","p-avatar-lg":this.size==="large","p-avatar-xl":this.size==="xlarge"}]},iconClass(){return["p-avatar-icon",this.icon]}}};const Xe=["aria-labelledby","aria-label"],Fe={key:0,class:"p-avatar-text"},Ge=["src"];function qe(e,n,s,r,o,i){return a(),u("div",{class:h(i.containerClass),"aria-labelledby":e.ariaLabelledby,"aria-label":e.ariaLabel},[b(e.$slots,"default",{},()=>[s.label?(a(),u("span",Fe,k(s.label),1)):s.icon?(a(),u("span",{key:1,class:h(i.iconClass)},null,2)):s.image?(a(),u("img",{key:2,src:s.image,onError:n[0]||(n[0]=(...m)=>i.onError&&i.onError(...m))},null,40,Ge)):v("",!0)])],10,Xe)}function Qe(e,n){n===void 0&&(n={});var s=n.insertAt;if(!(!e||typeof document>"u")){var r=document.head||document.getElementsByTagName("head")[0],o=document.createElement("style");o.type="text/css",s==="top"&&r.firstChild?r.insertBefore(o,r.firstChild):r.appendChild(o),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(document.createTextNode(e))}}var Je=`
.p-avatar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    font-size: 1rem;
}
.p-avatar.p-avatar-image {
    background-color: transparent;
}
.p-avatar.p-avatar-circle {
    border-radius: 50%;
}
.p-avatar-circle img {
    border-radius: 50%;
}
.p-avatar .p-avatar-icon {
    font-size: 1rem;
}
.p-avatar img {
    width: 100%;
    height: 100%;
}
`;Qe(Je);G.render=qe;var q={name:"Dialog",inheritAttrs:!1,emits:["update:visible","show","hide","after-hide","maximize","unmaximize","dragend"],props:{header:{type:null,default:null},footer:{type:null,default:null},visible:{type:Boolean,default:!1},modal:{type:Boolean,default:null},contentStyle:{type:null,default:null},contentClass:{type:String,default:null},contentProps:{type:null,default:null},rtl:{type:Boolean,default:null},maximizable:{type:Boolean,default:!1},dismissableMask:{type:Boolean,default:!1},closable:{type:Boolean,default:!0},closeOnEscape:{type:Boolean,default:!0},showHeader:{type:Boolean,default:!0},baseZIndex:{type:Number,default:0},autoZIndex:{type:Boolean,default:!0},position:{type:String,default:"center"},breakpoints:{type:Object,default:null},draggable:{type:Boolean,default:!0},keepInViewport:{type:Boolean,default:!0},minX:{type:Number,default:0},minY:{type:Number,default:0},appendTo:{type:String,default:"body"},closeIcon:{type:String,default:"pi pi-times"},maximizeIcon:{type:String,default:"pi pi-window-maximize"},minimizeIcon:{type:String,default:"pi pi-window-minimize"},closeButtonProps:{type:null,default:null},_instance:null},provide(){return{dialogRef:B(()=>this._instance)}},data(){return{containerVisible:this.visible,maximized:!1,focusable:!1}},documentKeydownListener:null,container:null,mask:null,content:null,headerContainer:null,footerContainer:null,maximizableButton:null,closeButton:null,styleElement:null,dragging:null,documentDragListener:null,documentDragEndListener:null,lastPageX:null,lastPageY:null,updated(){this.visible&&(this.containerVisible=this.visible)},beforeUnmount(){this.unbindDocumentState(),this.unbindGlobalListeners(),this.destroyStyle(),this.mask&&this.autoZIndex&&C.clear(this.mask),this.container=null,this.mask=null},mounted(){this.breakpoints&&this.createStyle()},methods:{close(){this.$emit("update:visible",!1)},onBeforeEnter(e){e.setAttribute(this.attributeSelector,"")},onEnter(){this.$emit("show"),this.focus(),this.enableDocumentSettings(),this.bindGlobalListeners(),this.autoZIndex&&C.set("modal",this.mask,this.baseZIndex+this.$primevue.config.zIndex.modal)},onBeforeLeave(){this.modal&&y.addClass(this.mask,"p-component-overlay-leave")},onLeave(){this.$emit("hide"),this.focusable=!1},onAfterLeave(){this.autoZIndex&&C.clear(this.mask),this.containerVisible=!1,this.unbindDocumentState(),this.unbindGlobalListeners(),this.$emit("after-hide")},onMaskClick(e){this.dismissableMask&&this.modal&&this.mask===e.target&&this.close()},focus(){const e=s=>s.querySelector("[autofocus]");let n=this.$slots.footer&&e(this.footerContainer);n||(n=this.$slots.header&&e(this.headerContainer),n||(n=this.$slots.default&&e(this.content),n||(n=e(this.container)))),n&&(this.focusable=!0,n.focus())},maximize(e){this.maximized?(this.maximized=!1,this.$emit("unmaximize",e)):(this.maximized=!0,this.$emit("maximize",e)),this.modal||(this.maximized?y.addClass(document.body,"p-overflow-hidden"):y.removeClass(document.body,"p-overflow-hidden"))},enableDocumentSettings(){(this.modal||this.maximizable&&this.maximized)&&y.addClass(document.body,"p-overflow-hidden")},unbindDocumentState(){(this.modal||this.maximizable&&this.maximized)&&y.removeClass(document.body,"p-overflow-hidden")},onKeyDown(e){e.code==="Escape"&&this.closeOnEscape&&this.close()},bindDocumentKeyDownListener(){this.documentKeydownListener||(this.documentKeydownListener=this.onKeyDown.bind(this),window.document.addEventListener("keydown",this.documentKeydownListener))},unbindDocumentKeyDownListener(){this.documentKeydownListener&&(window.document.removeEventListener("keydown",this.documentKeydownListener),this.documentKeydownListener=null)},getPositionClass(){const n=["left","right","top","topleft","topright","bottom","bottomleft","bottomright"].find(s=>s===this.position);return n?`p-dialog-${n}`:""},containerRef(e){this.container=e},maskRef(e){this.mask=e},contentRef(e){this.content=e},headerContainerRef(e){this.headerContainer=e},footerContainerRef(e){this.footerContainer=e},maximizableRef(e){this.maximizableButton=e},closeButtonRef(e){this.closeButton=e},createStyle(){if(!this.styleElement){this.styleElement=document.createElement("style"),this.styleElement.type="text/css",document.head.appendChild(this.styleElement);let e="";for(let n in this.breakpoints)e+=`
                        @media screen and (max-width: ${n}) {
                            .p-dialog[${this.attributeSelector}] {
                                width: ${this.breakpoints[n]} !important;
                            }
                        }
                    `;this.styleElement.innerHTML=e}},destroyStyle(){this.styleElement&&(document.head.removeChild(this.styleElement),this.styleElement=null)},initDrag(e){y.hasClass(e.target,"p-dialog-header-icon")||y.hasClass(e.target.parentElement,"p-dialog-header-icon")||this.draggable&&(this.dragging=!0,this.lastPageX=e.pageX,this.lastPageY=e.pageY,this.container.style.margin="0",y.addClass(document.body,"p-unselectable-text"))},bindGlobalListeners(){this.draggable&&(this.bindDocumentDragListener(),this.bindDocumentDragEndListener()),this.closeOnEscape&&this.closable&&this.bindDocumentKeyDownListener()},unbindGlobalListeners(){this.unbindDocumentDragListener(),this.unbindDocumentDragEndListener(),this.unbindDocumentKeyDownListener()},bindDocumentDragListener(){this.documentDragListener=e=>{if(this.dragging){let n=y.getOuterWidth(this.container),s=y.getOuterHeight(this.container),r=e.pageX-this.lastPageX,o=e.pageY-this.lastPageY,i=this.container.getBoundingClientRect(),m=i.left+r,p=i.top+o,d=y.getViewport();this.container.style.position="fixed",this.keepInViewport?(m>=this.minX&&m+n<d.width&&(this.lastPageX=e.pageX,this.container.style.left=m+"px"),p>=this.minY&&p+s<d.height&&(this.lastPageY=e.pageY,this.container.style.top=p+"px")):(this.lastPageX=e.pageX,this.container.style.left=m+"px",this.lastPageY=e.pageY,this.container.style.top=p+"px")}},window.document.addEventListener("mousemove",this.documentDragListener)},unbindDocumentDragListener(){this.documentDragListener&&(window.document.removeEventListener("mousemove",this.documentDragListener),this.documentDragListener=null)},bindDocumentDragEndListener(){this.documentDragEndListener=e=>{this.dragging&&(this.dragging=!1,y.removeClass(document.body,"p-unselectable-text"),this.$emit("dragend",e))},window.document.addEventListener("mouseup",this.documentDragEndListener)},unbindDocumentDragEndListener(){this.documentDragEndListener&&(window.document.removeEventListener("mouseup",this.documentDragEndListener),this.documentDragEndListener=null)}},computed:{maskClass(){return["p-dialog-mask",{"p-component-overlay p-component-overlay-enter":this.modal},this.getPositionClass()]},dialogClass(){return["p-dialog p-component",{"p-dialog-rtl":this.rtl,"p-dialog-maximized":this.maximizable&&this.maximized,"p-input-filled":this.$primevue.config.inputStyle==="filled","p-ripple-disabled":this.$primevue.config.ripple===!1}]},maximizeIconClass(){return["p-dialog-header-maximize-icon",{[this.maximizeIcon]:!this.maximized,[this.minimizeIcon]:this.maximized}]},ariaId(){return T()},ariaLabelledById(){return this.header!=null||this.$attrs["aria-labelledby"]!==null?this.ariaId+"_header":null},closeAriaLabel(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.close:void 0},attributeSelector(){return T()},contentStyleClass(){return["p-dialog-content",this.contentClass]}},directives:{ripple:H,focustrap:U},components:{Portal:P}};const We=["aria-labelledby","aria-modal"],et=["id"],tt={class:"p-dialog-header-icons"},nt=["autofocus","tabindex"],st=["autofocus","aria-label"];function it(e,n,s,r,o,i){const m=x("Portal"),p=I("ripple"),d=I("focustrap");return a(),w(m,{appendTo:s.appendTo},{default:c(()=>[o.containerVisible?(a(),u("div",{key:0,ref:i.maskRef,class:h(i.maskClass),onClick:n[3]||(n[3]=(...g)=>i.onMaskClick&&i.onMaskClick(...g))},[l(Z,{name:"p-dialog",onBeforeEnter:i.onBeforeEnter,onEnter:i.onEnter,onBeforeLeave:i.onBeforeLeave,onLeave:i.onLeave,onAfterLeave:i.onAfterLeave,appear:""},{default:c(()=>[s.visible?L((a(),u("div",E({key:0,ref:i.containerRef,class:i.dialogClass,role:"dialog","aria-labelledby":i.ariaLabelledById,"aria-modal":s.modal},e.$attrs),[s.showHeader?(a(),u("div",{key:0,ref:i.headerContainerRef,class:"p-dialog-header",onMousedown:n[2]||(n[2]=(...g)=>i.initDrag&&i.initDrag(...g))},[b(e.$slots,"header",{},()=>[s.header?(a(),u("span",{key:0,id:i.ariaLabelledById,class:"p-dialog-title"},k(s.header),9,et)):v("",!0)]),t("div",tt,[s.maximizable?L((a(),u("button",{key:0,ref:i.maximizableRef,autofocus:o.focusable,class:"p-dialog-header-icon p-dialog-header-maximize p-link",onClick:n[0]||(n[0]=(...g)=>i.maximize&&i.maximize(...g)),type:"button",tabindex:s.maximizable?"0":"-1"},[t("span",{class:h(i.maximizeIconClass)},null,2)],8,nt)),[[p]]):v("",!0),s.closable?L((a(),u("button",E({key:1,ref:i.closeButtonRef,autofocus:o.focusable,class:"p-dialog-header-icon p-dialog-header-close p-link",onClick:n[1]||(n[1]=(...g)=>i.close&&i.close(...g)),"aria-label":i.closeAriaLabel,type:"button"},s.closeButtonProps),[t("span",{class:h(["p-dialog-header-close-icon",s.closeIcon])},null,2)],16,st)),[[p]]):v("",!0)])],544)):v("",!0),t("div",E({ref:i.contentRef,class:i.contentStyleClass,style:s.contentStyle},s.contentProps),[b(e.$slots,"default")],16),s.footer||e.$slots.footer?(a(),u("div",{key:1,ref:i.footerContainerRef,class:"p-dialog-footer"},[b(e.$slots,"footer",{},()=>[oe(k(s.footer),1)])],512)):v("",!0)],16,We)),[[d,{disabled:!s.modal}]]):v("",!0)]),_:3},8,["onBeforeEnter","onEnter","onBeforeLeave","onLeave","onAfterLeave"])],2)):v("",!0)]),_:3},8,["appendTo"])}function ot(e,n){n===void 0&&(n={});var s=n.insertAt;if(!(!e||typeof document>"u")){var r=document.head||document.getElementsByTagName("head")[0],o=document.createElement("style");o.type="text/css",s==="top"&&r.firstChild?r.insertBefore(o,r.firstChild):r.appendChild(o),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(document.createTextNode(e))}}var at=`
.p-dialog-mask {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    pointer-events: none;
}
.p-dialog-mask.p-component-overlay {
    pointer-events: auto;
}
.p-dialog {
    display: flex;
    flex-direction: column;
    pointer-events: auto;
    max-height: 90%;
    transform: scale(1);
}
.p-dialog-content {
    overflow-y: auto;
}
.p-dialog-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
}
.p-dialog-footer {
    flex-shrink: 0;
}
.p-dialog .p-dialog-header-icons {
    display: flex;
    align-items: center;
}
.p-dialog .p-dialog-header-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}

/* Fluid */
.p-fluid .p-dialog-footer .p-button {
    width: auto;
}

/* Animation */
/* Center */
.p-dialog-enter-active {
    transition: all 150ms cubic-bezier(0, 0, 0.2, 1);
}
.p-dialog-leave-active {
    transition: all 150ms cubic-bezier(0.4, 0, 0.2, 1);
}
.p-dialog-enter-from,
.p-dialog-leave-to {
    opacity: 0;
    transform: scale(0.7);
}

/* Top, Bottom, Left, Right, Top* and Bottom* */
.p-dialog-top .p-dialog,
.p-dialog-bottom .p-dialog,
.p-dialog-left .p-dialog,
.p-dialog-right .p-dialog,
.p-dialog-topleft .p-dialog,
.p-dialog-topright .p-dialog,
.p-dialog-bottomleft .p-dialog,
.p-dialog-bottomright .p-dialog {
    margin: 0.75rem;
    transform: translate3d(0px, 0px, 0px);
}
.p-dialog-top .p-dialog-enter-active,
.p-dialog-top .p-dialog-leave-active,
.p-dialog-bottom .p-dialog-enter-active,
.p-dialog-bottom .p-dialog-leave-active,
.p-dialog-left .p-dialog-enter-active,
.p-dialog-left .p-dialog-leave-active,
.p-dialog-right .p-dialog-enter-active,
.p-dialog-right .p-dialog-leave-active,
.p-dialog-topleft .p-dialog-enter-active,
.p-dialog-topleft .p-dialog-leave-active,
.p-dialog-topright .p-dialog-enter-active,
.p-dialog-topright .p-dialog-leave-active,
.p-dialog-bottomleft .p-dialog-enter-active,
.p-dialog-bottomleft .p-dialog-leave-active,
.p-dialog-bottomright .p-dialog-enter-active,
.p-dialog-bottomright .p-dialog-leave-active {
    transition: all 0.3s ease-out;
}
.p-dialog-top .p-dialog-enter-from,
.p-dialog-top .p-dialog-leave-to {
    transform: translate3d(0px, -100%, 0px);
}
.p-dialog-bottom .p-dialog-enter-from,
.p-dialog-bottom .p-dialog-leave-to {
    transform: translate3d(0px, 100%, 0px);
}
.p-dialog-left .p-dialog-enter-from,
.p-dialog-left .p-dialog-leave-to,
.p-dialog-topleft .p-dialog-enter-from,
.p-dialog-topleft .p-dialog-leave-to,
.p-dialog-bottomleft .p-dialog-enter-from,
.p-dialog-bottomleft .p-dialog-leave-to {
    transform: translate3d(-100%, 0px, 0px);
}
.p-dialog-right .p-dialog-enter-from,
.p-dialog-right .p-dialog-leave-to,
.p-dialog-topright .p-dialog-enter-from,
.p-dialog-topright .p-dialog-leave-to,
.p-dialog-bottomright .p-dialog-enter-from,
.p-dialog-bottomright .p-dialog-leave-to {
    transform: translate3d(100%, 0px, 0px);
}

/* Maximize */
.p-dialog-maximized {
    -webkit-transition: none;
    transition: none;
    transform: none;
    width: 100vw !important;
    height: 100vh !important;
    top: 0px !important;
    left: 0px !important;
    max-height: 100%;
    height: 100%;
}
.p-dialog-maximized .p-dialog-content {
    flex-grow: 1;
}

/* Position */
.p-dialog-left {
    justify-content: flex-start;
}
.p-dialog-right {
    justify-content: flex-end;
}
.p-dialog-top {
    align-items: flex-start;
}
.p-dialog-topleft {
    justify-content: flex-start;
    align-items: flex-start;
}
.p-dialog-topright {
    justify-content: flex-end;
    align-items: flex-start;
}
.p-dialog-bottom {
    align-items: flex-end;
}
.p-dialog-bottomleft {
    justify-content: flex-start;
    align-items: flex-end;
}
.p-dialog-bottomright {
    justify-content: flex-end;
    align-items: flex-end;
}
.p-confirm-dialog .p-dialog-content {
    display: flex;
    align-items: center;
}
`;ot(at);q.render=it;var Q={name:"ConfirmDialog",props:{group:String,breakpoints:{type:Object,default:null}},confirmListener:null,closeListener:null,data(){return{visible:!1,confirmation:null}},mounted(){this.confirmListener=e=>{e&&e.group===this.group&&(this.confirmation=e,this.confirmation.onShow&&this.confirmation.onShow(),this.visible=!0)},this.closeListener=()=>{this.visible=!1,this.confirmation=null},j.on("confirm",this.confirmListener),j.on("close",this.closeListener)},beforeUnmount(){j.off("confirm",this.confirmListener),j.off("close",this.closeListener)},methods:{accept(){this.confirmation.accept&&this.confirmation.accept(),this.visible=!1},reject(){this.confirmation.reject&&this.confirmation.reject(),this.visible=!1},onHide(){this.confirmation.onHide&&this.confirmation.onHide(),this.visible=!1}},computed:{header(){return this.confirmation?this.confirmation.header:null},message(){return this.confirmation?this.confirmation.message:null},blockScroll(){return this.confirmation?this.confirmation.blockScroll:!0},position(){return this.confirmation?this.confirmation.position:null},iconClass(){return["p-confirm-dialog-icon",this.confirmation?this.confirmation.icon:null]},acceptLabel(){return this.confirmation?this.confirmation.acceptLabel||this.$primevue.config.locale.accept:null},rejectLabel(){return this.confirmation?this.confirmation.rejectLabel||this.$primevue.config.locale.reject:null},acceptIcon(){return this.confirmation?this.confirmation.acceptIcon:null},rejectIcon(){return this.confirmation?this.confirmation.rejectIcon:null},acceptClass(){return["p-confirm-dialog-accept",this.confirmation?this.confirmation.acceptClass:null]},rejectClass(){return["p-confirm-dialog-reject",this.confirmation?this.confirmation.rejectClass||"p-button-text":null]},autoFocusAccept(){return this.confirmation.defaultFocus===void 0||this.confirmation.defaultFocus==="accept"},autoFocusReject(){return this.confirmation.defaultFocus==="reject"},closeOnEscape(){return this.confirmation?this.confirmation.closeOnEscape:!0}},components:{CDialog:q,CDButton:X}};const rt={class:"p-confirm-dialog-message"};function lt(e,n,s,r,o,i){const m=x("CDButton"),p=x("CDialog");return a(),w(p,{visible:o.visible,"onUpdate:visible":[n[2]||(n[2]=d=>o.visible=d),i.onHide],role:"alertdialog",class:"p-confirm-dialog",modal:!0,header:i.header,blockScroll:i.blockScroll,position:i.position,breakpoints:s.breakpoints,closeOnEscape:i.closeOnEscape},{footer:c(()=>[l(m,{label:i.rejectLabel,icon:i.rejectIcon,class:h(i.rejectClass),onClick:n[0]||(n[0]=d=>i.reject()),autofocus:i.autoFocusReject},null,8,["label","icon","class","autofocus"]),l(m,{label:i.acceptLabel,icon:i.acceptIcon,class:h(i.acceptClass),onClick:n[1]||(n[1]=d=>i.accept()),autofocus:i.autoFocusAccept},null,8,["label","icon","class","autofocus"])]),default:c(()=>[e.$slots.message?(a(),w(N(e.$slots.message),{key:1,message:o.confirmation},null,8,["message"])):(a(),u(M,{key:0},[o.confirmation.icon?(a(),u("i",{key:0,class:h(i.iconClass)},null,2)):v("",!0),t("span",rt,k(i.message),1)],64))]),_:1},8,["visible","header","blockScroll","position","breakpoints","closeOnEscape","onUpdate:visible"])}Q.render=lt;var J={name:"ToastMessage",emits:["close"],props:{message:{type:null,default:null},template:{type:null,default:null},closeIcon:{type:String,default:null},infoIcon:{type:String,default:null},warnIcon:{type:String,default:null},errorIcon:{type:String,default:null},successIcon:{type:String,default:null},closeButtonProps:{type:null,default:null}},closeTimeout:null,mounted(){this.message.life&&(this.closeTimeout=setTimeout(()=>{this.close()},this.message.life))},beforeUnmount(){this.clearCloseTimeout()},methods:{close(){this.$emit("close",this.message)},onCloseClick(){this.clearCloseTimeout(),this.close()},clearCloseTimeout(){this.closeTimeout&&(clearTimeout(this.closeTimeout),this.closeTimeout=null)}},computed:{containerClass(){return["p-toast-message",this.message.styleClass,{"p-toast-message-info":this.message.severity==="info","p-toast-message-warn":this.message.severity==="warn","p-toast-message-error":this.message.severity==="error","p-toast-message-success":this.message.severity==="success"}]},iconClass(){return["p-toast-message-icon",{[this.infoIcon]:this.message.severity==="info",[this.warnIcon]:this.message.severity==="warn",[this.errorIcon]:this.message.severity==="error",[this.successIcon]:this.message.severity==="success"}]},closeAriaLabel(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.close:void 0}},directives:{ripple:H}};const dt={class:"p-toast-message-text"},ct={class:"p-toast-summary"},ut={class:"p-toast-detail"},pt={key:2},mt=["aria-label"];function ht(e,n,s,r,o,i){const m=I("ripple");return a(),u("div",{class:h(i.containerClass),role:"alert","aria-live":"assertive","aria-atomic":"true"},[t("div",{class:h(["p-toast-message-content",s.message.contentStyleClass])},[s.template?(a(),w(N(s.template),{key:1,message:s.message},null,8,["message"])):(a(),u(M,{key:0},[t("span",{class:h(i.iconClass)},null,2),t("div",dt,[t("span",ct,k(s.message.summary),1),t("div",ut,k(s.message.detail),1)])],64)),s.message.closable!==!1?(a(),u("div",pt,[L((a(),u("button",E({class:"p-toast-icon-close p-link",type:"button","aria-label":i.closeAriaLabel,onClick:n[0]||(n[0]=(...p)=>i.onCloseClick&&i.onCloseClick(...p)),autofocus:""},s.closeButtonProps),[t("span",{class:h(["p-toast-icon-close-icon",s.closeIcon])},null,2)],16,mt)),[[m]])])):v("",!0)],2)],2)}J.render=ht;var ft=0,W={name:"Toast",inheritAttrs:!1,props:{group:{type:String,default:null},position:{type:String,default:"top-right"},autoZIndex:{type:Boolean,default:!0},baseZIndex:{type:Number,default:0},breakpoints:{type:Object,default:null},closeIcon:{type:String,default:"pi pi-times"},infoIcon:{type:String,default:"pi pi-info-circle"},warnIcon:{type:String,default:"pi pi-exclamation-triangle"},errorIcon:{type:String,default:"pi pi-times"},successIcon:{type:String,default:"pi pi-check"},closeButtonProps:{type:null,default:null}},data(){return{messages:[]}},styleElement:null,mounted(){z.on("add",this.onAdd),z.on("remove-group",this.onRemoveGroup),z.on("remove-all-groups",this.onRemoveAllGroups),this.breakpoints&&this.createStyle()},beforeUnmount(){this.destroyStyle(),this.$refs.container&&this.autoZIndex&&C.clear(this.$refs.container),z.off("add",this.onAdd),z.off("remove-group",this.onRemoveGroup),z.off("remove-all-groups",this.onRemoveAllGroups)},methods:{add(e){e.id==null&&(e.id=ft++),this.messages=[...this.messages,e]},remove(e){let n=-1;for(let s=0;s<this.messages.length;s++)if(this.messages[s]===e){n=s;break}this.messages.splice(n,1)},onAdd(e){this.group==e.group&&this.add(e)},onRemoveGroup(e){this.group===e&&(this.messages=[])},onRemoveAllGroups(){this.messages=[]},onEnter(){this.$refs.container.setAttribute(this.attributeSelector,""),this.autoZIndex&&C.set("modal",this.$refs.container,this.baseZIndex||this.$primevue.config.zIndex.modal)},onLeave(){this.$refs.container&&this.autoZIndex&&ae.isEmpty(this.messages)&&setTimeout(()=>{C.clear(this.$refs.container)},200)},createStyle(){if(!this.styleElement){this.styleElement=document.createElement("style"),this.styleElement.type="text/css",document.head.appendChild(this.styleElement);let e="";for(let n in this.breakpoints){let s="";for(let r in this.breakpoints[n])s+=r+":"+this.breakpoints[n][r]+"!important;";e+=`
                        @media screen and (max-width: ${n}) {
                            .p-toast[${this.attributeSelector}] {
                                ${s}
                            }
                        }
                    `}this.styleElement.innerHTML=e}},destroyStyle(){this.styleElement&&(document.head.removeChild(this.styleElement),this.styleElement=null)}},computed:{containerClass(){return["p-toast p-component p-toast-"+this.position,{"p-input-filled":this.$primevue.config.inputStyle==="filled","p-ripple-disabled":this.$primevue.config.ripple===!1}]},attributeSelector(){return T()}},components:{ToastMessage:J,Portal:P}};function gt(e,n,s,r,o,i){const m=x("ToastMessage"),p=x("Portal");return a(),w(p,null,{default:c(()=>[t("div",E({ref:"container",class:i.containerClass},e.$attrs),[l(le,{name:"p-toast-message",tag:"div",onEnter:i.onEnter,onLeave:i.onLeave},{default:c(()=>[(a(!0),u(M,null,re(o.messages,d=>(a(),w(m,{key:d.id,message:d,template:e.$slots.message,closeIcon:s.closeIcon,infoIcon:s.infoIcon,warnIcon:s.warnIcon,errorIcon:s.errorIcon,successIcon:s.successIcon,closeButtonProps:s.closeButtonProps,onClose:n[0]||(n[0]=g=>i.remove(g))},null,8,["message","template","closeIcon","infoIcon","warnIcon","errorIcon","successIcon","closeButtonProps"]))),128))]),_:1},8,["onEnter","onLeave"])],16)]),_:1})}function vt(e,n){n===void 0&&(n={});var s=n.insertAt;if(!(!e||typeof document>"u")){var r=document.head||document.getElementsByTagName("head")[0],o=document.createElement("style");o.type="text/css",s==="top"&&r.firstChild?r.insertBefore(o,r.firstChild):r.appendChild(o),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(document.createTextNode(e))}}var bt=`
.p-toast {
    position: fixed;
    width: 25rem;
}
.p-toast-message-content {
    display: flex;
    align-items: flex-start;
}
.p-toast-message-text {
    flex: 1 1 auto;
}
.p-toast-top-right {
    top: 20px;
    right: 20px;
}
.p-toast-top-left {
    top: 20px;
    left: 20px;
}
.p-toast-bottom-left {
    bottom: 20px;
    left: 20px;
}
.p-toast-bottom-right {
    bottom: 20px;
    right: 20px;
}
.p-toast-top-center {
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
}
.p-toast-bottom-center {
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
}
.p-toast-center {
    left: 50%;
    top: 50%;
    min-width: 20vw;
    transform: translate(-50%, -50%);
}
.p-toast-icon-close {
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}
.p-toast-icon-close.p-link {
    cursor: pointer;
}

/* Animations */
.p-toast-message-enter-from {
    opacity: 0;
    -webkit-transform: translateY(50%);
    -ms-transform: translateY(50%);
    transform: translateY(50%);
}
.p-toast-message-leave-from {
    max-height: 1000px;
}
.p-toast .p-toast-message.p-toast-message-leave-to {
    max-height: 0;
    opacity: 0;
    margin-bottom: 0;
    overflow: hidden;
}
.p-toast-message-enter-active {
    -webkit-transition: transform 0.3s, opacity 0.3s;
    transition: transform 0.3s, opacity 0.3s;
}
.p-toast-message-leave-active {
    -webkit-transition: max-height 0.45s cubic-bezier(0, 1, 0, 1), opacity 0.3s, margin-bottom 0.3s;
    transition: max-height 0.45s cubic-bezier(0, 1, 0, 1), opacity 0.3s, margin-bottom 0.3s;
}
`;vt(bt);W.render=gt;const yt=de({data(){return{visibleLeft:!1}},components:{Button:X,Sidebar:F,Avatar:G,Dropdown:$e,DropdownLink:He,NavLink:Pe,ResponsiveNavLink:Ve,Banner:Me,ApplicationMark:ye,Head:ce,Link:A,ConfirmDialog:Q,Toast:W},props:{users:Array,title:String},methods:{logout(){$.post(route("logout"))},showProfile(){$.get(route("profile.show"))}},setup(){const e=ue(),n=pe();return n.add({severity:"info",summary:"Info Message",detail:"Message Content",life:3e3}),{confirm1:()=>{e.require({message:"Are you sure you want to proceed?",header:"Confirmation",icon:"pi pi-exclamation-triangle",accept:()=>{n.add({severity:"info",summary:"Confirmed",detail:"You have accepted",life:3e3})},reject:()=>{n.add({severity:"error",summary:"Rejected",detail:"You have rejected",life:3e3})}})},confirm2:()=>{e.require({message:"Do you want to delete this record?",header:"Delete Confirmation",icon:"pi pi-info-circle",acceptClass:"p-button-danger",accept:()=>{n.add({severity:"info",summary:"Confirmed",detail:"Record deleted",life:3e3})},reject:()=>{n.add({severity:"error",summary:"Rejected",detail:"You have rejected",life:3e3})}})},confirmPosition:m=>{e.require({group:"positionDialog",message:"¿Desea cerrar sesión?",header:"Sesión",icon:"pi pi-info-circle",position:m,accept:()=>{$.post(route("logout"))},reject:()=>{n.add({severity:"info",summary:"Cancelado",detail:"Se canceló el cierre de sesión",life:3e3})},acceptLabel:"Aceptar",rejectLabel:"Cancelar"})},showTemplate:()=>{e.require({group:"templating",header:"Terms and Conditions",message:"Do you accept that?",icon:"pi pi-question-circle",acceptIcon:"pi pi-check",rejectIcon:"pi pi-times",accept:()=>{this.$toast.add({severity:"info",summary:"Confirmed",detail:"You have accepted",life:3e3})},reject:()=>{this.$toast.add({severity:"error",summary:"Rejected",detail:"You have rejected",life:3e3})}})}}}}),wt={class:"absolute top-1/2 z-40"},xt={class:"fixed top-1/2"},kt=t("img",{src:"https://visionindustrial.com.mx/wp-content/uploads/2016/08/UPQ-logo.jpg",alt:"LogoUPQ",class:"h-20 mx-auto"},null,-1),_t={class:"menus"},Ct=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"})],-1),Lt=t("span",{class:"ml-4"}," Ingreso",-1),Bt=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"w-6 h-6",viewBox:"0 0 24 24"},[t("path",{fill:"currentColor",d:"M14.75 15c.966 0 1.75.784 1.75 1.75l-.001.962c.117 2.19-1.511 3.297-4.432 3.297c-2.91 0-4.567-1.09-4.567-3.259v-1c0-.966.784-1.75 1.75-1.75h5.5Zm0 1.5h-5.5a.25.25 0 0 0-.25.25v1c0 1.176.887 1.759 3.067 1.759c2.168 0 2.995-.564 2.933-1.757V16.75a.25.25 0 0 0-.25-.25Zm-11-6.5h4.376a4.007 4.007 0 0 0-.095 1.5H3.75a.25.25 0 0 0-.25.25v1c0 1.176.887 1.759 3.067 1.759c.462 0 .863-.026 1.207-.077a2.743 2.743 0 0 0-1.173 1.576l-.034.001C3.657 16.009 2 14.919 2 12.75v-1c0-.966.784-1.75 1.75-1.75Zm16.5 0c.966 0 1.75.784 1.75 1.75l-.001.962c.117 2.19-1.511 3.297-4.432 3.297l-.169-.002a2.755 2.755 0 0 0-1.218-1.606c.387.072.847.108 1.387.108c2.168 0 2.995-.564 2.933-1.757V11.75a.25.25 0 0 0-.25-.25h-4.28a4.05 4.05 0 0 0-.096-1.5h4.376ZM12 8a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm0 1.5a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3ZM6.5 3a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm11 0a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm-11 1.5a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3Zm11 0a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3Z"})],-1),St=t("span",{class:"ml-4"}," Matrícula",-1),zt=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"})],-1),Et=t("span",{class:"ml-4"}," Bajas",-1),It=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"})],-1),jt=t("span",{class:"ml-4"}," Egresados",-1),At=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-6 w-6",viewBox:"0 0 48 48"},[t("g",{fill:"currentColor","fill-rule":"evenodd","clip-rule":"evenodd"},[t("path",{d:"M14 6a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h11v2H14a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v28a4 4 0 0 1-4 4h-3v-2h3a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H14Z"}),t("path",{d:"M18 11a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H19a1 1 0 0 1-1-1Zm-4 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm14 10a2 2 0 1 0 0-4a2 2 0 0 0 0 4Zm0 2a4 4 0 1 0 0-8a4 4 0 0 0 0 8Z"}),t("path",{d:"M27 35h-2v9l3-1.5l3 1.5v-9h-2v5.764l-1-.5l-1 .5V35Z"})])],-1),Mt=t("span",{class:"ml-4"}," Titulados",-1),Dt=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"})],-1),$t=t("span",{class:"ml-4"}," Becas",-1),Tt=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"w-6 h-6",viewBox:"0 0 24 24"},[t("path",{fill:"currentColor",d:"M21.004 7.975V6c0-2.206-1.794-4-4-4h-10c-2.206 0-4 1.794-4 4v1.998l-.076.004A1 1 0 0 0 2 9v2a1 1 0 0 0 1 1h.004v6c0 .735.403 1.372.996 1.72V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h10v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1.276A1.994 1.994 0 0 0 21.004 18v-6a1 1 0 0 0 1-1V9.062a1.006 1.006 0 0 0-.072-.455c-.203-.487-.635-.604-.928-.632zM19.006 18H5.004v-5h14.001l.001 5zM11.004 7v4h-6V7h6zm8 0v4h-6V7h6zm-12-3h10c.736 0 1.375.405 1.722 1H5.282c.347-.595.986-1 1.722-1z"}),t("circle",{cx:"7.5",cy:"15.5",r:"1.5",fill:"currentColor"}),t("circle",{cx:"16.5",cy:"15.5",r:"1.5",fill:"currentColor"})],-1),Zt=t("span",{class:"ml-4"}," Transporte",-1),Ht=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"})],-1),Pt=t("span",{class:"ml-4"}," Cambio de carrera",-1),Vt=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"})],-1),Rt=t("span",{class:"ml-4"}," Equivalencia ",-1),Ot={class:"footerSideBarResponsive mt-8"},Yt={class:"avatar flex justify-center"},Nt={class:"text-center"},Kt={class:"text-center"},Ut={class:"botones"},Xt={class:"flex p-4"},Ft={class:"pl-2"},Gt={class:"card"},qt={class:"grid flex-column"},Qt={class:"p-col flex justify-center gap-5"},Jt={class:"absolute left-0 h-screen flex z-50"},Wt={class:"fixed h-screen top-0 md:flex md:flex-shrink-0 max-sm:hidden md:w-64 border-r-2 border-gray-100"},en={class:"flex flex-col w-64"},tn={class:"flex flex-col flex-grow overflow-y-auto bg-white border-r border-gray-50"},nn={class:"flex flex-col items-center flex-shrink-0 px-4"},sn=t("img",{src:"https://visionindustrial.com.mx/wp-content/uploads/2016/08/UPQ-logo.jpg",alt:"LogoUPQ"},null,-1),on=t("button",{class:"hidden rounded-lg focus:outline-none focus:shadow-outline"},[t("svg",{fill:"currentColor",viewBox:"0 0 20 20",class:"w-6 h-6"},[t("path",{"fill-rule":"evenodd",d:"M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z","clip-rule":"evenodd"}),t("path",{"fill-rule":"evenodd",d:"M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z","clip-rule":"evenodd"})])],-1),an={class:"flex flex-col flex-grow px-4 mt-5"},rn={class:"flex-1 space-y-1 bg-white"},ln=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"})],-1),dn=t("span",{class:"ml-4"}," Ingreso",-1),cn=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-6 w-6",viewBox:"0 0 24 24"},[t("path",{fill:"currentColor",d:"M14.75 15c.966 0 1.75.784 1.75 1.75l-.001.962c.117 2.19-1.511 3.297-4.432 3.297c-2.91 0-4.567-1.09-4.567-3.259v-1c0-.966.784-1.75 1.75-1.75h5.5Zm0 1.5h-5.5a.25.25 0 0 0-.25.25v1c0 1.176.887 1.759 3.067 1.759c2.168 0 2.995-.564 2.933-1.757V16.75a.25.25 0 0 0-.25-.25Zm-11-6.5h4.376a4.007 4.007 0 0 0-.095 1.5H3.75a.25.25 0 0 0-.25.25v1c0 1.176.887 1.759 3.067 1.759c.462 0 .863-.026 1.207-.077a2.743 2.743 0 0 0-1.173 1.576l-.034.001C3.657 16.009 2 14.919 2 12.75v-1c0-.966.784-1.75 1.75-1.75Zm16.5 0c.966 0 1.75.784 1.75 1.75l-.001.962c.117 2.19-1.511 3.297-4.432 3.297l-.169-.002a2.755 2.755 0 0 0-1.218-1.606c.387.072.847.108 1.387.108c2.168 0 2.995-.564 2.933-1.757V11.75a.25.25 0 0 0-.25-.25h-4.28a4.05 4.05 0 0 0-.096-1.5h4.376ZM12 8a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm0 1.5a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3ZM6.5 3a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm11 0a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm-11 1.5a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3Zm11 0a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3Z"})],-1),un=t("span",{class:"ml-4"}," Matrícula",-1),pn=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"})],-1),mn=t("span",{class:"ml-4"}," Bajas",-1),hn=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"})],-1),fn=t("span",{class:"ml-4"}," Egresados",-1),gn=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-7 w-7",viewBox:"0 0 48 48"},[t("g",{fill:"currentColor","fill-rule":"evenodd","clip-rule":"evenodd"},[t("path",{d:"M14 6a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h11v2H14a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v28a4 4 0 0 1-4 4h-3v-2h3a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H14Z"}),t("path",{d:"M18 11a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H19a1 1 0 0 1-1-1Zm-4 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm14 10a2 2 0 1 0 0-4a2 2 0 0 0 0 4Zm0 2a4 4 0 1 0 0-8a4 4 0 0 0 0 8Z"}),t("path",{d:"M27 35h-2v9l3-1.5l3 1.5v-9h-2v5.764l-1-.5l-1 .5V35Z"})])],-1),vn=t("span",{class:"ml-3"}," Titulados",-1),bn=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"})],-1),yn=t("span",{class:"ml-4"}," Becas",-1),wn=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"w-6 h-6",viewBox:"0 0 24 24"},[t("path",{fill:"currentColor",d:"M21.004 7.975V6c0-2.206-1.794-4-4-4h-10c-2.206 0-4 1.794-4 4v1.998l-.076.004A1 1 0 0 0 2 9v2a1 1 0 0 0 1 1h.004v6c0 .735.403 1.372.996 1.72V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h10v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1.276A1.994 1.994 0 0 0 21.004 18v-6a1 1 0 0 0 1-1V9.062a1.006 1.006 0 0 0-.072-.455c-.203-.487-.635-.604-.928-.632zM19.006 18H5.004v-5h14.001l.001 5zM11.004 7v4h-6V7h6zm8 0v4h-6V7h6zm-12-3h10c.736 0 1.375.405 1.722 1H5.282c.347-.595.986-1 1.722-1z"}),t("circle",{cx:"7.5",cy:"15.5",r:"1.5",fill:"currentColor"}),t("circle",{cx:"16.5",cy:"15.5",r:"1.5",fill:"currentColor"})],-1),xn=t("span",{class:"ml-4"}," Transporte",-1),kn=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"})],-1),_n=t("span",{class:"ml-4"}," Cambio de carrera",-1),Cn=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"})],-1),Ln=t("span",{class:"ml-4"}," Equivalencia ",-1),Bn={class:"a absolute bottom-0 w-[95%] h-auto"},Sn={class:"avatar flex justify-center"},zn={class:"text-center"},En={class:"text-center"},In={class:"botones p-5"},jn={class:"flex p-4"},An={class:"pl-2"},Mn={class:"card"},Dn={class:"grid flex-column"},$n={class:"p-col flex justify-center gap-5"},Tn={key:0,class:"bg-white shadow"},Zn={class:"max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 md:ml-[260px]"},Hn={class:"h-sc ml-[244px] max-sm:m-auto"};function Pn(e,n,s,r,o,i){const m=x("Head"),p=x("Button"),d=x("Link"),g=x("Avatar"),V=x("Toast"),S=x("ConfirmDialog"),ee=x("Sidebar");return a(),u(M,null,[l(m,{title:e.title},null,8,["title"]),t("div",wt,[t("div",xt,[l(p,{icon:"pi pi-arrow-right",onClick:n[0]||(n[0]=_=>e.visibleLeft=!0),class:"mr-2"}),l(ee,{visible:e.visibleLeft,"onUpdate:visible":n[3]||(n[3]=_=>e.visibleLeft=_),baseZIndex:1e4},{default:c(()=>[l(d,{href:"/dashboard",class:"px-8 text-left focus:outline-none"},{default:c(()=>[kt]),_:1}),t("div",_t,[t("ul",null,[t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.ingreso"),active:""},{default:c(()=>[Ct,Lt]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.matricula")},{default:c(()=>[Bt,St]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.bajas")},{default:c(()=>[zt,Et]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.egresados")},{default:c(()=>[It,jt]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.titulados")},{default:c(()=>[At,Mt]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.becas")},{default:c(()=>[Dt,$t]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.transporte")},{default:c(()=>[Tt,Zt]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.cambio_de_carrera")},{default:c(()=>[Ht,Pt]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.segurofacultativo")},{default:c(()=>[Vt,Rt]),_:1},8,["href"])])])]),t("div",Ot,[t("div",Yt,[e.$page.props.user.name.split(" ").length>1?(a(),w(g,{key:0,label:e.$page.props.user.name.charAt(0)+e.$page.props.user.name.split(" ")[1].charAt(0),class:"mr-2",size:"large",style:{"background-color":"#2196f3",color:"#ffffff"}},null,8,["label"])):e.$page.props.user.name.split(" ").length==1?(a(),w(g,{key:1,label:e.$page.props.user.name.charAt(0),class:"mr-2",size:"large",style:{"background-color":"#2196f3",color:"#ffffff"}},null,8,["label"])):v("",!0)]),t("h2",Nt,k(e.$page.props.user.name),1),t("h2",Kt,k(e.$page.props.user.email),1),t("div",Ut,[t("div",null,[l(V),l(S),l(S,{group:"templating"},{message:c(_=>[t("div",Xt,[t("i",{class:h(_.message.icon),style:{"font-size":"1.5rem"}},null,2),t("p",Ft,k(_.message.message),1)])]),_:1}),l(S,{group:"positionDialog"}),t("div",Gt,[t("div",qt,[t("div",Qt,[l(p,{onClick:n[1]||(n[1]=_=>e.confirmPosition("bottomleft")),icon:"pi pi-sign-out",class:"p-button-rounded p-button-secondary"}),l(p,{onClick:n[2]||(n[2]=_=>e.showProfile()),icon:"pi pi-cog",class:"p-button-rounded p-button-secondary"})])])])])])])]),_:1},8,["visible"])])]),t("div",Jt,[t("div",Wt,[t("div",en,[t("div",tn,[t("div",nn,[l(d,{href:"/dashboard",class:"px-8 text-left focus:outline-none"},{default:c(()=>[sn]),_:1}),on]),t("div",an,[t("nav",rn,[t("ul",null,[t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.ingreso"),active:""},{default:c(()=>[ln,dn]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.matricula")},{default:c(()=>[cn,un]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.bajas")},{default:c(()=>[pn,mn]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.egresados")},{default:c(()=>[hn,fn]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.titulados")},{default:c(()=>[gn,vn]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.becas")},{default:c(()=>[bn,yn]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.transporte")},{default:c(()=>[wn,xn]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.cambio_de_carrera")},{default:c(()=>[kn,_n]),_:1},8,["href"])]),t("li",null,[l(d,{class:"inline-flex items-center w-full px-4 py-2 mt-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-lg bg-gray-50 hover:bg-gray-200 focus:shadow-outline hover:cursor-pointer",white:"",href:e.route("usuario.segurofacultativo")},{default:c(()=>[Cn,Ln]),_:1},8,["href"])])]),t("div",Bn,[t("div",Sn,[e.$page.props.user.name.split(" ").length>1?(a(),w(g,{key:0,label:e.$page.props.user.name.charAt(0)+e.$page.props.user.name.split(" ")[1].charAt(0),class:"mr-2",size:"large",style:{"background-color":"#2196f3",color:"#ffffff"}},null,8,["label"])):e.$page.props.user.name.split(" ").length==1?(a(),w(g,{key:1,label:e.$page.props.user.name.charAt(0),class:"mr-2",size:"large",style:{"background-color":"#2196f3",color:"#ffffff"}},null,8,["label"])):v("",!0)]),t("h2",zn,k(e.$page.props.user.name),1),t("h2",En,k(e.$page.props.user.email),1),t("div",In,[t("div",null,[l(V),l(S),l(S,{group:"templating"},{message:c(_=>[t("div",jn,[t("i",{class:h(_.message.icon),style:{"font-size":"1.5rem"}},null,2),t("p",An,k(_.message.message),1)])]),_:1}),l(S,{group:"positionDialog"}),t("div",Mn,[t("div",Dn,[t("div",$n,[l(p,{onClick:n[4]||(n[4]=_=>e.confirmPosition("bottomleft")),icon:"pi pi-sign-out",class:"p-button-rounded p-button-secondary"}),l(p,{onClick:n[5]||(n[5]=_=>e.showProfile()),icon:"pi pi-cog",class:"p-button-rounded p-button-secondary"})])])])])])])])])])])])]),e.$slots.header?(a(),u("header",Tn,[t("div",Zn,[b(e.$slots,"header")])])):v("",!0),t("main",Hn,[b(e.$slots,"default")])],64)}const Yn=K(yt,[["render",Pn]]);export{Yn as A,W as a,Q as b,q as s};
