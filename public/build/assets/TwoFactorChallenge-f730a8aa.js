import{g as u,P as b,f as a,b as o,u as t,w as m,F as c,o as s,X as C,a as i,j as n,m as p,n as w,R as V}from"./app-095f28e0.js";import{A as h}from"./AuthenticationCard-5302dbac.js";import{_ as I}from"./AuthenticationCardLogo-3aee46fb.js";import{_ as v,a as y}from"./TextInput-0cbad2bd.js";import{_ as g}from"./InputLabel-b9121432.js";import{_ as $}from"./PrimaryButton-e949a7fb.js";import"./_plugin-vue_export-helper-c27b6911.js";const T={class:"mb-4 text-sm text-gray-600"},U=["onSubmit"],B={key:0},F={key:1},N={class:"flex items-center justify-end mt-4"},P=["onClick"],D={__name:"TwoFactorChallenge",setup(j){const r=u(!1),e=b({code:"",recovery_code:""}),f=u(null),_=u(null),k=async()=>{r.value^=!0,await V(),r.value?(f.value.focus(),e.code=""):(_.value.focus(),e.recovery_code="")},x=()=>{e.post(route("two-factor.login"))};return(A,l)=>(s(),a(c,null,[o(t(C),{title:"Two-factor Confirmation"}),o(h,null,{logo:m(()=>[o(I)]),default:m(()=>[i("div",T,[r.value?(s(),a(c,{key:1},[n(" Por favor confirme el acceso a su cuenta ingresando uno de sus códigos de recuperación de emergencia. ")],64)):(s(),a(c,{key:0},[n(" Por favor confirma el acceso a tu cuenta ingresando el código de autenticación proporcionado por tu aplicacion autenticadora. ")],64))]),i("form",{onSubmit:p(x,["prevent"])},[r.value?(s(),a("div",F,[o(g,{for:"recovery_code",value:"Código de recuperación"}),o(v,{id:"recovery_code",ref_key:"recoveryCodeInput",ref:f,modelValue:t(e).recovery_code,"onUpdate:modelValue":l[1]||(l[1]=d=>t(e).recovery_code=d),type:"text",class:"mt-1 block w-full",autocomplete:"one-time-code"},null,8,["modelValue"]),o(y,{class:"mt-2",message:t(e).errors.recovery_code},null,8,["message"])])):(s(),a("div",B,[o(g,{for:"code",value:"Ingrese el código"}),o(v,{id:"code",ref_key:"codeInput",ref:_,modelValue:t(e).code,"onUpdate:modelValue":l[0]||(l[0]=d=>t(e).code=d),type:"text",inputmode:"numeric",class:"mt-1 block w-full",autofocus:"",autocomplete:"one-time-code"},null,8,["modelValue"]),o(y,{class:"mt-2",message:t(e).errors.code},null,8,["message"])])),i("div",N,[i("button",{type:"button",class:"text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer",onClick:p(k,["prevent"])},[r.value?(s(),a(c,{key:1},[n(" Usar código de autenticación ")],64)):(s(),a(c,{key:0},[n(" Usar código de recuperación ")],64))],8,P),o($,{class:w(["ml-4",{"opacity-25":t(e).processing}]),disabled:t(e).processing},{default:m(()=>[n(" Ingresar ")]),_:1},8,["class","disabled"])])],40,U)]),_:1})],64))}};export{D as default};