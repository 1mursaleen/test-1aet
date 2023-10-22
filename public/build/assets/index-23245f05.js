import{T as y,c as S,a as h,u as V,b as x}from"./object-61f57073.js";import{_ as f,u as T,a as E,b as C,r as m,o as u,c as p,d as n,e,n as R,f as q,w as A,g as d,h as _}from"./main-23d9f12c.js";import{_ as N}from"./ck-white-96574686.js";import{l as B}from"./logo-5495e460.js";import"./index-efd6cdc7.js";import"./vue-cleave.min-c8018730.js";const M={components:{Textinput:y},data(){return{checkbox:!1}},setup(){const l=S({email:h().required("Email is required").email(),password:h().required("Password is required").min(8)}),t=T(),i=E(),s=C(),r={email:"user1@example.com",password:"password"},{handleSubmit:c}=V({validationSchema:l,initialValues:r}),{value:a,errorMessage:o}=x("email"),{value:b,errorMessage:g}=x("password"),w=c(async v=>{try{await s.login(v),i.push("/app/search")}catch(k){t.error("Login failed: "+k.message,{timeout:2e3})}});return{email:a,emailError:o,password:b,passwordError:g,onSubmit:w}}},j={class:"flex justify-between"},z={class:"cursor-pointer flex items-start"},F={key:0,src:N,alt:"",class:"h-[10px] w-[10px] block m-auto"},I=e("span",{class:"text-slate-500 text-sm leading-6"},"Keep me signed in",-1),P=e("button",{type:"submit",class:"btn btn-primary block w-full text-center"}," Sign in ",-1);function U(l,t,i,s,r,c){const a=m("Textinput");return u(),p("form",{onSubmit:t[3]||(t[3]=A((...o)=>s.onSubmit&&s.onSubmit(...o),["prevent"])),class:"space-y-4"},[n(a,{label:"Email",type:"email",placeholder:"Type your email",name:"emil",modelValue:s.email,"onUpdate:modelValue":t[0]||(t[0]=o=>s.email=o),error:s.emailError,classInput:"h-[48px]"},null,8,["modelValue","error"]),n(a,{label:"Password",type:"password",placeholder:"8+ characters, 1 capitat letter ",name:"password",modelValue:s.password,"onUpdate:modelValue":t[1]||(t[1]=o=>s.password=o),error:s.passwordError,hasicon:"",classInput:"h-[48px]"},null,8,["modelValue","error"]),e("div",j,[e("label",z,[e("input",{type:"checkbox",class:"hidden",onChange:t[2]||(t[2]=()=>r.checkbox=!r.checkbox)},null,32),e("span",{class:R(["h-4 w-4 border rounded flex-none inline-flex mr-3 relative top-1 transition-all duration-150",r.checkbox?"ring-2 ring-black-500 ring-offset-2 bg-slate-900":"bg-slate-100 border-slate-100"])},[r.checkbox?(u(),p("img",F)):q("",!0)],2),I])]),P],32)}const $=f(M,[["render",U]]),D={components:{Signin:$},setup(){return{logo:B}}},K={class:"loginwrapper"},L={class:"lg-inner-column"},G={class:"left-column relative z-[1]"},H={class:"max-w-[520px] pt-20 pl-20"},J={class:"w-20"},O=["src"],Q=e("h4",null,[_(" Awesome "),e("br"),e("span",{class:"text-slate-900 font-bold"}," Rank Tracker App ")],-1),W={class:"right-column relative"},X={class:"inner-content h-full flex flex-col bg-white"},Y={class:"auth-box h-full flex flex-col justify-center"},Z={class:"w-20 mobile-logo text-center mb-6 mx-auto block"},ee=["src"],se=e("div",{class:"text-center 2xl:mb-10 mb-4"},[e("h4",{class:"font-medium"},"Sign in"),e("div",{class:"text-slate-500 text-base"}," Sign in to your account to start using RankTracker ")],-1),te={class:"md:max-w-[345px] mx-auto font-normal text-slate-500 mt-12 uppercase text-sm"},oe=e("div",{class:"auth-footer text-center"}," Copyright 2023, RankTracker All Rights Reserved. ",-1);function ae(l,t,i,s,r,c){const a=m("router-link"),o=m("Signin");return u(),p("div",K,[e("div",L,[e("div",G,[e("div",H,[n(a,{to:"/"},{default:d(()=>[e("div",J,[e("img",{src:s.logo,alt:"",class:"mb-10"},null,8,O)])]),_:1}),Q])]),e("div",W,[e("div",X,[e("div",Y,[e("div",Z,[n(a,{to:"/"},{default:d(()=>[e("img",{src:s.logo,alt:"",class:"mx-auto"},null,8,ee)]),_:1})]),se,n(o),e("div",te,[_(" Don’t have an account? "),n(a,{to:"/register",class:"text-slate-900 font-medium hover:underline"},{default:d(()=>[_(" Sign up ")]),_:1})])]),oe])])])])}const me=f(D,[["render",ae]]);export{me as default};