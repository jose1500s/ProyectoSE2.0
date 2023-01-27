import{P as b,f as u,b as a,u as t,t as w,h as c,a as e,m as y,w as m,n as v,c as g,F as A,Q as k,o as i,X as V,j as d,x as p}from"./app-b13a5dc1.js";import{_,a as f}from"./TextInput-9edf673a.js";import{_ as x}from"./InputLabel-1b14f594.js";import{_ as N}from"./PrimaryButton-1e6769cd.js";const j={key:0,class:"mb-4 font-medium text-sm text-green-600"},D={class:"bg-white"},E={class:"lg:grid lg:min-h-screen lg:grid-cols-12"},M=e("aside",{class:"relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6"},[e("img",{alt:"Pattern",src:"https://instagram.fqro3-1.fna.fbcdn.net/v/t39.30808-6/326772626_571218561657861_2871428478941625678_n.jpg?stp=c0.0.1020.679a_dst-jpg_e15_s720x720&_nc_ht=instagram.fqro3-1.fna.fbcdn.net&_nc_cat=109&_nc_ohc=hrRxn5wUBfkAX9VKOTu&tn=AYryxUEIGWX04rCG&edm=ACWDqb8AAAAA&ccb=7-5&ig_cache_key=MzAyMTcwNTU5MTM5MjAyNzgxNA%3D%3D.2-ccb7-5&oh=00_AfAHgYj08h-PJ1ICf-OdpQ-ArGElBvRJDhJk7m5_jyMYEw&oe=63D45F69&_nc_sid=1527a3",class:"absolute inset-0 h-full w-full object-cover"})],-1),P={"aria-label":"Main",class:"flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:py-12 lg:px-16 xl:col-span-6"},B={class:"max-w-xl lg:max-w-3xl"},O=k('<a class="block text-blue-200" href="/"><img src="images/UPQLOGOREDONDO.png" alt="" width="60" height="60"><span class="sr-only">Home</span></a><h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl"> Servicios Estudiantiles 🐦 </h1><p class="mt-4 leading-relaxed text-gray-500"> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem aperiam perferendis accusantium repellat ex architecto reiciendis laborum, maxime! </p>',3),R=["onSubmit"],q={class:"col-span-6"},C={class:"col-span-6"},S={class:"col-span-6 sm:flex sm:items-center sm:gap-4"},U={class:"mt-4 text-sm text-gray-500 sm:mt-0"},T={class:"mt-4 text-sm text-gray-500 sm:mt-0"},z={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(o){const s=b({email:"",password:"",remember:!1}),h=()=>{s.transform(r=>({...r,remember:s.remember?"on":""})).post(route("login"),{onFinish:()=>s.reset("password")})};return(r,l)=>(i(),u(A,null,[a(t(V),{title:"Log in"}),o.status?(i(),u("div",j,w(o.status),1)):c("",!0),e("section",D,[e("div",E,[M,e("main",P,[e("div",B,[O,e("form",{onSubmit:y(h,["prevent"]),class:"mt-8 grid grid-cols-6 gap-6"},[e("div",q,[e("div",null,[a(x,{for:"email",value:"Email"}),a(_,{id:"email",modelValue:t(s).email,"onUpdate:modelValue":l[0]||(l[0]=n=>t(s).email=n),type:"email",class:"mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm",required:"",autofocus:""},null,8,["modelValue"]),a(f,{class:"mt-2",message:t(s).errors.email},null,8,["message"])])]),e("div",C,[a(x,{for:"password",value:"Password"}),a(_,{id:"password",modelValue:t(s).password,"onUpdate:modelValue":l[1]||(l[1]=n=>t(s).password=n),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password"},null,8,["modelValue"]),a(f,{class:"mt-2",message:t(s).errors.password},null,8,["message"])]),e("div",S,[a(N,{class:v(["inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500",{"opacity-25":t(s).processing}]),disabled:t(s).processing},{default:m(()=>[d(" Acceder ")]),_:1},8,["class","disabled"]),e("p",U,[o.canResetPassword?(i(),g(t(p),{key:0,href:r.route("register"),class:"text-gray-700 underline"},{default:m(()=>[d(" Registrarse ")]),_:1},8,["href"])):c("",!0)]),e("p",T,[o.canResetPassword?(i(),g(t(p),{key:0,href:r.route("password.request"),class:"text-gray-700 underline"},{default:m(()=>[d(" ¿Olvidaste tu contraseña? ")]),_:1},8,["href"])):c("",!0)])])],40,R)])])])])],64))}};export{z as default};
