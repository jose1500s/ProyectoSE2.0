import{P as B,g as f,c as w,w as s,o as d,j as r,f as S,a as l,b as o,e as p,s as v,R as U,m as _,h,u as a,x as R,n as E,I as F}from"./app-1b8d8cba.js";import{_ as z}from"./ActionMessage-f5e8e17e.js";import{_ as A}from"./FormSection-5edf5e72.js";import{a as g,_ as V}from"./TextInput-221a53c2.js";import{_ as k}from"./InputLabel-5702bda8.js";import{_ as D}from"./PrimaryButton-06c6be06.js";import{_ as C}from"./SecondaryButton-7120995c.js";import"./SectionTitle-356ea377.js";import"./_plugin-vue_export-helper-c27b6911.js";const G={key:0,class:"col-span-6 sm:col-span-4"},L={class:"mt-2"},T=["src","alt"],q={class:"mt-2"},H={class:"col-span-6 sm:col-span-4"},J={class:"col-span-6 sm:col-span-4"},M={key:0},O={class:"text-sm mt-2"},K={class:"mt-2 font-medium text-sm text-green-600"},se={__name:"UpdateProfileInformationForm",props:{user:Object},setup(c){const b=c,e=B({_method:"PUT",name:b.user.name,email:b.user.email,photo:null}),y=f(null),u=f(null),n=f(null),$=()=>{n.value&&(e.photo=n.value.files[0]),e.post(route("user-profile-information.update"),{errorBag:"updateProfileInformation",preserveScroll:!0,onSuccess:()=>P()})},x=()=>{y.value=!0},I=()=>{n.value.click()},N=()=>{const t=n.value.files[0];if(!t)return;const i=new FileReader;i.onload=m=>{u.value=m.target.result},i.readAsDataURL(t)},j=()=>{F.delete(route("current-user-photo.destroy"),{preserveScroll:!0,onSuccess:()=>{u.value=null,P()}})},P=()=>{var t;(t=n.value)!=null&&t.value&&(n.value.value=null)};return(t,i)=>(d(),w(A,{onSubmitted:$},{title:s(()=>[r(" Información de perfil ")]),description:s(()=>[r(" Actualice la información de perfil y la dirección de correo electrónico de su cuenta. ")]),form:s(()=>[t.$page.props.jetstream.managesProfilePhotos?(d(),S("div",G,[l("input",{ref_key:"photoInput",ref:n,type:"file",class:"hidden",onChange:N},null,544),o(k,{for:"photo",value:"Photo"}),p(l("div",L,[l("img",{src:c.user.profile_photo_url,alt:c.user.name,class:"rounded-full h-20 w-20 object-cover"},null,8,T)],512),[[v,!u.value]]),p(l("div",q,[l("span",{class:"block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center",style:U("background-image: url('"+u.value+"');")},null,4)],512),[[v,u.value]]),o(C,{class:"mt-2 mr-2",type:"button",onClick:_(I,["prevent"])},{default:s(()=>[r(" Seleccione una nueva foto ")]),_:1},8,["onClick"]),c.user.profile_photo_path?(d(),w(C,{key:0,type:"button",class:"mt-2",onClick:_(j,["prevent"])},{default:s(()=>[r(" Remover foto ")]),_:1},8,["onClick"])):h("",!0),o(g,{message:a(e).errors.photo,class:"mt-2"},null,8,["message"])])):h("",!0),l("div",H,[o(k,{for:"name",value:"Nombre"}),o(V,{id:"name",modelValue:a(e).name,"onUpdate:modelValue":i[0]||(i[0]=m=>a(e).name=m),type:"text",class:"mt-1 block w-full",autocomplete:"name"},null,8,["modelValue"]),o(g,{message:a(e).errors.name,class:"mt-2"},null,8,["message"])]),l("div",J,[o(k,{for:"email",value:"Correo electrónico"}),o(V,{id:"email",modelValue:a(e).email,"onUpdate:modelValue":i[1]||(i[1]=m=>a(e).email=m),type:"email",class:"mt-1 block w-full"},null,8,["modelValue"]),o(g,{message:a(e).errors.email,class:"mt-2"},null,8,["message"]),t.$page.props.jetstream.hasEmailVerification&&c.user.email_verified_at===null?(d(),S("div",M,[l("p",O,[r(" Su dirección de correo electrónico no está verificada. "),o(a(R),{href:t.route("verification.send"),method:"post",as:"button",class:"underline text-gray-600 hover:text-gray-900",onClick:_(x,["prevent"])},{default:s(()=>[r(" Haga clic aquí para volver a enviar el correo electrónico de verificación. ")]),_:1},8,["href","onClick"])]),p(l("div",K," Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico. ",512),[[v,y.value]])])):h("",!0)])]),actions:s(()=>[o(z,{on:a(e).recentlySuccessful,class:"mr-3"},{default:s(()=>[r(" Guardado. ")]),_:1},8,["on"]),o(D,{class:E({"opacity-25":a(e).processing}),disabled:a(e).processing},{default:s(()=>[r(" Guardar ")]),_:1},8,["class","disabled"])]),_:1}))}};export{se as default};
