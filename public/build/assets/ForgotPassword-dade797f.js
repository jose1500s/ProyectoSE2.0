import{P as m,f as r,b as a,u as t,t as d,h as _,a as e,m as u,w as g,n as p,F as f,Q as h,o as i,X as x,j as b}from"./app-b13a5dc1.js";import{_ as y,a as v}from"./TextInput-9edf673a.js";import{_ as w}from"./InputLabel-1b14f594.js";import{_ as A}from"./PrimaryButton-1e6769cd.js";const k={key:0,class:"mb-4 font-medium text-sm text-green-600"},N={class:"bg-white"},j={class:"lg:grid lg:min-h-screen lg:grid-cols-12"},V=e("aside",{class:"relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6"},[e("img",{alt:"Pattern",src:"https://instagram.fqro3-1.fna.fbcdn.net/v/t39.30808-6/326772626_571218561657861_2871428478941625678_n.jpg?stp=c0.0.1020.679a_dst-jpg_e15_s720x720&_nc_ht=instagram.fqro3-1.fna.fbcdn.net&_nc_cat=109&_nc_ohc=hrRxn5wUBfkAX9VKOTu&tn=AYryxUEIGWX04rCG&edm=ACWDqb8AAAAA&ccb=7-5&ig_cache_key=MzAyMTcwNTU5MTM5MjAyNzgxNA%3D%3D.2-ccb7-5&oh=00_AfAHgYj08h-PJ1ICf-OdpQ-ArGElBvRJDhJk7m5_jyMYEw&oe=63D45F69&_nc_sid=1527a3",class:"absolute inset-0 h-full w-full object-cover"})],-1),D={"aria-label":"Main",class:"flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:py-12 lg:px-16 xl:col-span-6"},E={class:"max-w-xl lg:max-w-3xl"},M=h('<a class="block text-blue-600" href="/"><img src="images/UPQLOGOREDONDO.png" alt="" width="60" height="60"><span class="sr-only">Home</span></a><h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl"> Servicios Escolares 🐦 </h1><p class="mt-4 leading-relaxed text-gray-500"> ¿Olvidaste tu contraseña? No hay problema. Solo dejanos tu direccion de correo electronico y te enviaremos un email para resetear tu contraseña. </p>',3),O=["onSubmit"],S={class:"col-span-6"},C={class:"col-span-6 sm:flex sm:items-center sm:gap-4"},q={__name:"ForgotPassword",props:{status:String},setup(o){const s=m({email:""}),n=()=>{s.post(route("password.email"))};return(P,l)=>(i(),r(f,null,[a(t(x),{title:"Forgot Password"}),o.status?(i(),r("div",k,d(o.status),1)):_("",!0),e("section",N,[e("div",j,[V,e("main",D,[e("div",E,[M,e("form",{onSubmit:u(n,["prevent"]),class:"mt-8 grid grid-cols-6 gap-6"},[e("div",S,[e("div",null,[a(w,{for:"email",value:"Email"}),a(y,{id:"email",modelValue:t(s).email,"onUpdate:modelValue":l[0]||(l[0]=c=>t(s).email=c),type:"email",class:"mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm",required:"",autofocus:""},null,8,["modelValue"]),a(v,{class:"mt-2",message:t(s).errors.email},null,8,["message"])])]),e("div",C,[a(A,{class:p(["inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500",{"opacity-25":t(s).processing}]),disabled:t(s).processing},{default:g(()=>[b(" Enviar correo de recuperacion ")]),_:1},8,["class","disabled"])])],40,O)])])])])],64))}};export{q as default};