import{P as b,f as u,b as a,u as t,t as w,h as m,a as e,m as y,w as c,n as v,c as p,F as k,Q as V,o as i,X as N,j as d,x as g}from"./app-095f28e0.js";import{_ as f,a as x}from"./TextInput-0cbad2bd.js";import{_ as h}from"./InputLabel-b9121432.js";import{_ as P}from"./PrimaryButton-e949a7fb.js";const S={key:0,class:"mb-4 font-medium text-sm text-green-600"},B={class:"bg-white"},C={class:"lg:grid lg:min-h-screen lg:grid-cols-12"},O=e("aside",{class:"relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6"},[e("img",{alt:"Pattern",src:"images/fondoupq.jfif",class:"absolute inset-0 h-full w-full object-cover"})],-1),R={"aria-label":"Main",class:"flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:py-12 lg:px-16 xl:col-span-6"},j={class:"max-w-xl lg:max-w-3xl"},q=V('<a class="block text-blue-200" href="/"><img src="images/UPQLOGOREDONDO.png" alt="" width="60" height="60"><span class="sr-only">Home</span></a><h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl"> Servicios Estudiantiles 🐦 </h1><p class="mt-4 leading-relaxed text-gray-500"> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem aperiam perferendis accusantium repellat ex architecto reiciendis laborum, maxime! </p>',3),E=["onSubmit"],L={class:"col-span-6"},$={class:"col-span-6"},D={class:"col-span-6 sm:flex sm:items-center sm:gap-4"},F={class:"mt-4 text-sm text-gray-500 sm:mt-0"},U={class:"mt-4 text-sm text-gray-500 sm:mt-0"},G={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(o){const s=b({email:"",password:"",remember:!1}),_=()=>{s.transform(l=>({...l,remember:s.remember?"on":""})).post(route("login"),{onFinish:()=>s.reset("password")})};return(l,r)=>(i(),u(k,null,[a(t(N),{title:"Log in"}),o.status?(i(),u("div",S,w(o.status),1)):m("",!0),e("section",B,[e("div",C,[O,e("main",R,[e("div",j,[q,e("form",{onSubmit:y(_,["prevent"]),class:"mt-8 grid grid-cols-6 gap-6"},[e("div",L,[e("div",null,[a(h,{for:"email",value:"Correo electrónico"}),a(f,{id:"email",modelValue:t(s).email,"onUpdate:modelValue":r[0]||(r[0]=n=>t(s).email=n),type:"email",class:"mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm",required:"",autofocus:""},null,8,["modelValue"]),a(x,{class:"mt-2",message:t(s).errors.email},null,8,["message"])])]),e("div",$,[a(h,{for:"password",value:"Contraseña"}),a(f,{id:"password",modelValue:t(s).password,"onUpdate:modelValue":r[1]||(r[1]=n=>t(s).password=n),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password"},null,8,["modelValue"]),a(x,{class:"mt-2",message:t(s).errors.password},null,8,["message"])]),e("div",D,[a(P,{class:v(["inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500",{"opacity-25":t(s).processing}]),disabled:t(s).processing},{default:c(()=>[d(" Acceder ")]),_:1},8,["class","disabled"]),e("p",F,[o.canResetPassword?(i(),p(t(g),{key:0,href:l.route("register"),class:"text-gray-700 underline"},{default:c(()=>[d(" Registrarse ")]),_:1},8,["href"])):m("",!0)]),e("p",U,[o.canResetPassword?(i(),p(t(g),{key:0,href:l.route("password.request"),class:"text-gray-700 underline"},{default:c(()=>[d(" ¿Olvidaste tu contraseña? ")]),_:1},8,["href"])):m("",!0)])])],40,E)])])])])],64))}};export{G as default};