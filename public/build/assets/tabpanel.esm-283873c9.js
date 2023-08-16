import{R as m}from"./button.esm-256f0b79.js";import{U as y,D as l,o,f as c,a as h,e as p,A as u,h as b,F as g,k as w,n as k,z as P,t as A,c as x,B as T,s as B,r as C}from"./app-1b8d8cba.js";var _={name:"TabView",emits:["update:activeIndex","tab-change","tab-click"],props:{activeIndex:{type:Number,default:0},lazy:{type:Boolean,default:!1},scrollable:{type:Boolean,default:!1},tabindex:{type:Number,default:0},selectOnFocus:{type:Boolean,default:!1},previousButtonProps:{type:null,default:null},nextButtonProps:{type:null,default:null}},data(){return{id:this.$attrs.id,d_activeIndex:this.activeIndex,isPrevButtonDisabled:!0,isNextButtonDisabled:!1}},watch:{"$attrs.id":function(e){this.id=e||y()},activeIndex(e){this.d_activeIndex=e,this.scrollInView({index:e})}},mounted(){this.id=this.id||y(),this.updateInkBar(),this.scrollable&&this.updateButtonState()},updated(){this.updateInkBar()},methods:{isTabPanel(e){return e.type.name==="TabPanel"},isTabActive(e){return this.d_activeIndex===e},getTabProp(e,t){return e.props?e.props[t]:void 0},getKey(e,t){return this.getTabProp(e,"header")||t},getTabHeaderActionId(e){return`${this.id}_${e}_header_action`},getTabContentId(e){return`${this.id}_${e}_content`},onScroll(e){this.scrollable&&this.updateButtonState(),e.preventDefault()},onPrevButtonClick(){const e=this.$refs.content,t=l.getWidth(e)-this.getVisibleButtonWidths(),n=e.scrollLeft-t;e.scrollLeft=n<=0?0:n},onNextButtonClick(){const e=this.$refs.content,t=l.getWidth(e)-this.getVisibleButtonWidths(),n=e.scrollLeft+t,s=e.scrollWidth-t;e.scrollLeft=n>=s?s:n},onTabClick(e,t,n){this.changeActiveIndex(e,t,n),this.$emit("tab-click",{originalEvent:e,index:n})},onTabKeyDown(e,t,n){switch(e.code){case"ArrowLeft":this.onTabArrowLeftKey(e);break;case"ArrowRight":this.onTabArrowRightKey(e);break;case"Home":this.onTabHomeKey(e);break;case"End":this.onTabEndKey(e);break;case"PageDown":this.onPageDownKey(e);break;case"PageUp":this.onPageUpKey(e);break;case"Enter":case"Space":this.onTabEnterKey(e,t,n);break}},onTabArrowRightKey(e){const t=this.findNextHeaderAction(e.target.parentElement);t?this.changeFocusedTab(e,t):this.onTabHomeKey(e),e.preventDefault()},onTabArrowLeftKey(e){const t=this.findPrevHeaderAction(e.target.parentElement);t?this.changeFocusedTab(e,t):this.onTabEndKey(e),e.preventDefault()},onTabHomeKey(e){const t=this.findFirstHeaderAction();this.changeFocusedTab(e,t),e.preventDefault()},onTabEndKey(e){const t=this.findLastHeaderAction();this.changeFocusedTab(e,t),e.preventDefault()},onPageDownKey(e){this.scrollInView({index:this.$refs.nav.children.length-2}),e.preventDefault()},onPageUpKey(e){this.scrollInView({index:0}),e.preventDefault()},onTabEnterKey(e,t,n){this.changeActiveIndex(e,t,n),e.preventDefault()},findNextHeaderAction(e,t=!1){const n=t?e:e.nextElementSibling;return n?l.hasClass(n,"p-disabled")||l.hasClass(n,"p-tabview-ink-bar")?this.findNextHeaderAction(n):l.findSingle(n,".p-tabview-header-action"):null},findPrevHeaderAction(e,t=!1){const n=t?e:e.previousElementSibling;return n?l.hasClass(n,"p-disabled")||l.hasClass(n,"p-tabview-ink-bar")?this.findPrevHeaderAction(n):l.findSingle(n,".p-tabview-header-action"):null},findFirstHeaderAction(){return this.findNextHeaderAction(this.$refs.nav.firstElementChild,!0)},findLastHeaderAction(){return this.findPrevHeaderAction(this.$refs.nav.lastElementChild,!0)},changeActiveIndex(e,t,n){!this.getTabProp(t,"disabled")&&this.d_activeIndex!==n&&(this.d_activeIndex=n,this.$emit("update:activeIndex",n),this.$emit("tab-change",{originalEvent:e,index:n}),this.scrollInView({index:n}))},changeFocusedTab(e,t){if(t&&(l.focus(t),this.scrollInView({element:t}),this.selectOnFocus)){const n=parseInt(t.parentElement.dataset.index,10),s=this.tabs[n];this.changeActiveIndex(e,s,n)}},scrollInView({element:e,index:t=-1}){const n=e||this.$refs.nav.children[t];n&&n.scrollIntoView&&n.scrollIntoView({block:"nearest"})},updateInkBar(){let e=this.$refs.nav.children[this.d_activeIndex];this.$refs.inkbar.style.width=l.getWidth(e)+"px",this.$refs.inkbar.style.left=l.getOffset(e).left-l.getOffset(this.$refs.nav).left+"px"},updateButtonState(){const e=this.$refs.content,{scrollLeft:t,scrollWidth:n}=e,s=l.getWidth(e);this.isPrevButtonDisabled=t===0,this.isNextButtonDisabled=parseInt(t)===n-s},getVisibleButtonWidths(){const{prevBtn:e,nextBtn:t}=this.$refs;return[e,t].reduce((n,s)=>s?n+l.getWidth(s):n,0)},getTabHeaderClass(e,t){return["p-tabview-header",this.getTabProp(e,"headerClass"),{"p-highlight":this.d_activeIndex===t,"p-disabled":this.getTabProp(e,"disabled")}]},getTabContentClass(e){return["p-tabview-panel",this.getTabProp(e,"contentClass")]}},computed:{contentClasses(){return["p-tabview p-component",{"p-tabview-scrollable":this.scrollable}]},tabs(){return this.$slots.default().reduce((e,t)=>(this.isTabPanel(t)?e.push(t):t.children&&t.children instanceof Array&&t.children.forEach(n=>{this.isTabPanel(n)&&e.push(n)}),e),[])},prevButtonAriaLabel(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.previous:void 0},nextButtonAriaLabel(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.next:void 0}},directives:{ripple:m}};const I={class:"p-tabview-nav-container"},H=["tabindex","aria-label"],D=h("span",{class:"pi pi-chevron-left","aria-hidden":"true"},null,-1),K=[D],E={ref:"nav",class:"p-tabview-nav",role:"tablist"},S=["data-index"],N=["id","tabindex","aria-disabled","aria-selected","aria-controls","onClick","onKeydown"],L={key:0,class:"p-tabview-title"},V={ref:"inkbar",class:"p-tabview-ink-bar",role:"presentation","aria-hidden":"true"},F=["tabindex","aria-label"],W=h("span",{class:"pi pi-chevron-right","aria-hidden":"true"},null,-1),z=[W],R={class:"p-tabview-panels"},U=["aria-labelledby"];function O(e,t,n,s,d,a){const v=P("ripple");return o(),c("div",{class:k(a.contentClasses)},[h("div",I,[n.scrollable&&!d.isPrevButtonDisabled?p((o(),c("button",u({key:0,ref:"prevBtn",type:"button",class:"p-tabview-nav-prev p-tabview-nav-btn p-link",tabindex:n.tabindex,"aria-label":a.prevButtonAriaLabel,onClick:t[0]||(t[0]=(...i)=>a.onPrevButtonClick&&a.onPrevButtonClick(...i))},n.previousButtonProps),K,16,H)),[[v]]):b("",!0),h("div",{ref:"content",class:"p-tabview-nav-content",onScroll:t[1]||(t[1]=(...i)=>a.onScroll&&a.onScroll(...i))},[h("ul",E,[(o(!0),c(g,null,w(a.tabs,(i,r)=>(o(),c("li",u({key:a.getKey(i,r),style:a.getTabProp(i,"headerStyle"),class:a.getTabHeaderClass(i,r),role:"presentation","data-index":r},a.getTabProp(i,"headerProps")),[p((o(),c("a",u({id:a.getTabHeaderActionId(r),class:"p-tabview-nav-link p-tabview-header-action",tabindex:a.getTabProp(i,"disabled")||!a.isTabActive(r)?-1:n.tabindex,role:"tab","aria-disabled":a.getTabProp(i,"disabled"),"aria-selected":a.isTabActive(r),"aria-controls":a.getTabContentId(r),onClick:f=>a.onTabClick(f,i,r),onKeydown:f=>a.onTabKeyDown(f,i,r)},a.getTabProp(i,"headerActionProps")),[i.props&&i.props.header?(o(),c("span",L,A(i.props.header),1)):b("",!0),i.children&&i.children.header?(o(),x(T(i.children.header),{key:1})):b("",!0)],16,N)),[[v]])],16,S))),128)),h("li",V,null,512)],512)],544),n.scrollable&&!d.isNextButtonDisabled?p((o(),c("button",u({key:1,ref:"nextBtn",type:"button",class:"p-tabview-nav-next p-tabview-nav-btn p-link",tabindex:n.tabindex,"aria-label":a.nextButtonAriaLabel,onClick:t[2]||(t[2]=(...i)=>a.onNextButtonClick&&a.onNextButtonClick(...i))},n.nextButtonProps),z,16,F)),[[v]]):b("",!0)]),h("div",R,[(o(!0),c(g,null,w(a.tabs,(i,r)=>(o(),c(g,{key:a.getKey(i,r)},[!n.lazy||a.isTabActive(r)?p((o(),c("div",u({key:0,style:a.getTabProp(i,"contentStyle"),class:a.getTabContentClass(i),role:"tabpanel","aria-labelledby":a.getTabHeaderActionId(r)},a.getTabProp(i,"contentProps")),[(o(),x(T(i)))],16,U)),[[B,n.lazy?!0:a.isTabActive(r)]]):b("",!0)],64))),128))])],2)}function j(e,t){t===void 0&&(t={});var n=t.insertAt;if(!(!e||typeof document>"u")){var s=document.head||document.getElementsByTagName("head")[0],d=document.createElement("style");d.type="text/css",n==="top"&&s.firstChild?s.insertBefore(d,s.firstChild):s.appendChild(d),d.styleSheet?d.styleSheet.cssText=e:d.appendChild(document.createTextNode(e))}}var q=`
.p-tabview-nav-container {
    position: relative;
}
.p-tabview-scrollable .p-tabview-nav-container {
    overflow: hidden;
}
.p-tabview-nav-content {
    overflow-x: auto;
    overflow-y: hidden;
    scroll-behavior: smooth;
    scrollbar-width: none;
    overscroll-behavior: contain auto;
}
.p-tabview-nav {
    display: flex;
    margin: 0;
    padding: 0;
    list-style-type: none;
    flex: 1 1 auto;
}
.p-tabview-header-action {
    cursor: pointer;
    user-select: none;
    display: flex;
    align-items: center;
    position: relative;
    text-decoration: none;
    overflow: hidden;
}
.p-tabview-ink-bar {
    display: none;
    z-index: 1;
}
.p-tabview-header-action:focus {
    z-index: 1;
}
.p-tabview-title {
    line-height: 1;
    white-space: nowrap;
}
.p-tabview-nav-btn {
    position: absolute;
    top: 0;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.p-tabview-nav-prev {
    left: 0;
}
.p-tabview-nav-next {
    right: 0;
}
.p-tabview-nav-content::-webkit-scrollbar {
    display: none;
}
`;j(q);_.render=O;var G={name:"TabPanel",props:{header:null,headerStyle:null,headerClass:null,headerProps:null,headerActionProps:null,contentStyle:null,contentClass:null,contentProps:null,disabled:Boolean}};function J(e,t,n,s,d,a){return C(e.$slots,"default")}G.render=J;export{G as a,_ as s};
