"use strict";(self["webpackChunkfrontend"]=self["webpackChunkfrontend"]||[]).push([[706],{9662:function(t,r,n){var e=n(614),o=n(6330),i=TypeError;t.exports=function(t){if(e(t))return t;throw i(o(t)+" is not a function")}},9670:function(t,r,n){var e=n(111),o=String,i=TypeError;t.exports=function(t){if(e(t))return t;throw i(o(t)+" is not an object")}},1318:function(t,r,n){var e=n(5656),o=n(1400),i=n(6244),a=function(t){return function(r,n,a){var u,c=e(r),s=i(c),l=o(a,s);if(t&&n!=n){while(s>l)if(u=c[l++],u!=u)return!0}else for(;s>l;l++)if((t||l in c)&&c[l]===n)return t||l||0;return!t&&-1}};t.exports={includes:a(!0),indexOf:a(!1)}},3658:function(t,r,n){var e=n(9781),o=n(3157),i=TypeError,a=Object.getOwnPropertyDescriptor,u=e&&!function(){if(void 0!==this)return!0;try{Object.defineProperty([],"length",{writable:!1}).length=1}catch(t){return t instanceof TypeError}}();t.exports=u?function(t,r){if(o(t)&&!a(t,"length").writable)throw i("Cannot set read only .length");return t.length=r}:function(t,r){return t.length=r}},4326:function(t,r,n){var e=n(1702),o=e({}.toString),i=e("".slice);t.exports=function(t){return i(o(t),8,-1)}},9920:function(t,r,n){var e=n(2597),o=n(3887),i=n(1236),a=n(3070);t.exports=function(t,r,n){for(var u=o(r),c=a.f,s=i.f,l=0;l<u.length;l++){var f=u[l];e(t,f)||n&&e(n,f)||c(t,f,s(r,f))}}},8880:function(t,r,n){var e=n(9781),o=n(3070),i=n(9114);t.exports=e?function(t,r,n){return o.f(t,r,i(1,n))}:function(t,r,n){return t[r]=n,t}},9114:function(t){t.exports=function(t,r){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:r}}},8052:function(t,r,n){var e=n(614),o=n(3070),i=n(6339),a=n(3072);t.exports=function(t,r,n,u){u||(u={});var c=u.enumerable,s=void 0!==u.name?u.name:r;if(e(n)&&i(n,s,u),u.global)c?t[r]=n:a(r,n);else{try{u.unsafe?t[r]&&(c=!0):delete t[r]}catch(l){}c?t[r]=n:o.f(t,r,{value:n,enumerable:!1,configurable:!u.nonConfigurable,writable:!u.nonWritable})}return t}},3072:function(t,r,n){var e=n(7854),o=Object.defineProperty;t.exports=function(t,r){try{o(e,t,{value:r,configurable:!0,writable:!0})}catch(n){e[t]=r}return r}},9781:function(t,r,n){var e=n(7293);t.exports=!e((function(){return 7!=Object.defineProperty({},1,{get:function(){return 7}})[1]}))},4154:function(t){var r="object"==typeof document&&document.all,n="undefined"==typeof r&&void 0!==r;t.exports={all:r,IS_HTMLDDA:n}},317:function(t,r,n){var e=n(7854),o=n(111),i=e.document,a=o(i)&&o(i.createElement);t.exports=function(t){return a?i.createElement(t):{}}},7207:function(t){var r=TypeError,n=9007199254740991;t.exports=function(t){if(t>n)throw r("Maximum allowed index exceeded");return t}},8113:function(t){t.exports="undefined"!=typeof navigator&&String(navigator.userAgent)||""},7392:function(t,r,n){var e,o,i=n(7854),a=n(8113),u=i.process,c=i.Deno,s=u&&u.versions||c&&c.version,l=s&&s.v8;l&&(e=l.split("."),o=e[0]>0&&e[0]<4?1:+(e[0]+e[1])),!o&&a&&(e=a.match(/Edge\/(\d+)/),(!e||e[1]>=74)&&(e=a.match(/Chrome\/(\d+)/),e&&(o=+e[1]))),t.exports=o},748:function(t){t.exports=["constructor","hasOwnProperty","isPrototypeOf","propertyIsEnumerable","toLocaleString","toString","valueOf"]},2109:function(t,r,n){var e=n(7854),o=n(1236).f,i=n(8880),a=n(8052),u=n(3072),c=n(9920),s=n(4705);t.exports=function(t,r){var n,l,f,p,v,d,h=t.target,m=t.global,y=t.stat;if(l=m?e:y?e[h]||u(h,{}):(e[h]||{}).prototype,l)for(f in r){if(v=r[f],t.dontCallGetSet?(d=o(l,f),p=d&&d.value):p=l[f],n=s(m?f:h+(y?".":"#")+f,t.forced),!n&&void 0!==p){if(typeof v==typeof p)continue;c(v,p)}(t.sham||p&&p.sham)&&i(v,"sham",!0),a(l,f,v,t)}}},7293:function(t){t.exports=function(t){try{return!!t()}catch(r){return!0}}},4374:function(t,r,n){var e=n(7293);t.exports=!e((function(){var t=function(){}.bind();return"function"!=typeof t||t.hasOwnProperty("prototype")}))},6916:function(t,r,n){var e=n(4374),o=Function.prototype.call;t.exports=e?o.bind(o):function(){return o.apply(o,arguments)}},6530:function(t,r,n){var e=n(9781),o=n(2597),i=Function.prototype,a=e&&Object.getOwnPropertyDescriptor,u=o(i,"name"),c=u&&"something"===function(){}.name,s=u&&(!e||e&&a(i,"name").configurable);t.exports={EXISTS:u,PROPER:c,CONFIGURABLE:s}},1702:function(t,r,n){var e=n(4374),o=Function.prototype,i=o.call,a=e&&o.bind.bind(i,i);t.exports=e?a:function(t){return function(){return i.apply(t,arguments)}}},5005:function(t,r,n){var e=n(7854),o=n(614),i=function(t){return o(t)?t:void 0};t.exports=function(t,r){return arguments.length<2?i(e[t]):e[t]&&e[t][r]}},8173:function(t,r,n){var e=n(9662),o=n(8554);t.exports=function(t,r){var n=t[r];return o(n)?void 0:e(n)}},7854:function(t,r,n){var e=function(t){return t&&t.Math==Math&&t};t.exports=e("object"==typeof globalThis&&globalThis)||e("object"==typeof window&&window)||e("object"==typeof self&&self)||e("object"==typeof n.g&&n.g)||function(){return this}()||this||Function("return this")()},2597:function(t,r,n){var e=n(1702),o=n(7908),i=e({}.hasOwnProperty);t.exports=Object.hasOwn||function(t,r){return i(o(t),r)}},3501:function(t){t.exports={}},4664:function(t,r,n){var e=n(9781),o=n(7293),i=n(317);t.exports=!e&&!o((function(){return 7!=Object.defineProperty(i("div"),"a",{get:function(){return 7}}).a}))},8361:function(t,r,n){var e=n(1702),o=n(7293),i=n(4326),a=Object,u=e("".split);t.exports=o((function(){return!a("z").propertyIsEnumerable(0)}))?function(t){return"String"==i(t)?u(t,""):a(t)}:a},2788:function(t,r,n){var e=n(1702),o=n(614),i=n(5465),a=e(Function.toString);o(i.inspectSource)||(i.inspectSource=function(t){return a(t)}),t.exports=i.inspectSource},9909:function(t,r,n){var e,o,i,a=n(4811),u=n(7854),c=n(111),s=n(8880),l=n(2597),f=n(5465),p=n(6200),v=n(3501),d="Object already initialized",h=u.TypeError,m=u.WeakMap,y=function(t){return i(t)?o(t):e(t,{})},b=function(t){return function(r){var n;if(!c(r)||(n=o(r)).type!==t)throw h("Incompatible receiver, "+t+" required");return n}};if(a||f.state){var g=f.state||(f.state=new m);g.get=g.get,g.has=g.has,g.set=g.set,e=function(t,r){if(g.has(t))throw h(d);return r.facade=t,g.set(t,r),r},o=function(t){return g.get(t)||{}},i=function(t){return g.has(t)}}else{var x=p("state");v[x]=!0,e=function(t,r){if(l(t,x))throw h(d);return r.facade=t,s(t,x,r),r},o=function(t){return l(t,x)?t[x]:{}},i=function(t){return l(t,x)}}t.exports={set:e,get:o,has:i,enforce:y,getterFor:b}},3157:function(t,r,n){var e=n(4326);t.exports=Array.isArray||function(t){return"Array"==e(t)}},614:function(t,r,n){var e=n(4154),o=e.all;t.exports=e.IS_HTMLDDA?function(t){return"function"==typeof t||t===o}:function(t){return"function"==typeof t}},4705:function(t,r,n){var e=n(7293),o=n(614),i=/#|\.prototype\./,a=function(t,r){var n=c[u(t)];return n==l||n!=s&&(o(r)?e(r):!!r)},u=a.normalize=function(t){return String(t).replace(i,".").toLowerCase()},c=a.data={},s=a.NATIVE="N",l=a.POLYFILL="P";t.exports=a},8554:function(t){t.exports=function(t){return null===t||void 0===t}},111:function(t,r,n){var e=n(614),o=n(4154),i=o.all;t.exports=o.IS_HTMLDDA?function(t){return"object"==typeof t?null!==t:e(t)||t===i}:function(t){return"object"==typeof t?null!==t:e(t)}},1913:function(t){t.exports=!1},2190:function(t,r,n){var e=n(5005),o=n(614),i=n(7976),a=n(3307),u=Object;t.exports=a?function(t){return"symbol"==typeof t}:function(t){var r=e("Symbol");return o(r)&&i(r.prototype,u(t))}},6244:function(t,r,n){var e=n(7466);t.exports=function(t){return e(t.length)}},6339:function(t,r,n){var e=n(1702),o=n(7293),i=n(614),a=n(2597),u=n(9781),c=n(6530).CONFIGURABLE,s=n(2788),l=n(9909),f=l.enforce,p=l.get,v=String,d=Object.defineProperty,h=e("".slice),m=e("".replace),y=e([].join),b=u&&!o((function(){return 8!==d((function(){}),"length",{value:8}).length})),g=String(String).split("String"),x=t.exports=function(t,r,n){"Symbol("===h(v(r),0,7)&&(r="["+m(v(r),/^Symbol\(([^)]*)\)/,"$1")+"]"),n&&n.getter&&(r="get "+r),n&&n.setter&&(r="set "+r),(!a(t,"name")||c&&t.name!==r)&&(u?d(t,"name",{value:r,configurable:!0}):t.name=r),b&&n&&a(n,"arity")&&t.length!==n.arity&&d(t,"length",{value:n.arity});try{n&&a(n,"constructor")&&n.constructor?u&&d(t,"prototype",{writable:!1}):t.prototype&&(t.prototype=void 0)}catch(o){}var e=f(t);return a(e,"source")||(e.source=y(g,"string"==typeof r?r:"")),t};Function.prototype.toString=x((function(){return i(this)&&p(this).source||s(this)}),"toString")},4758:function(t){var r=Math.ceil,n=Math.floor;t.exports=Math.trunc||function(t){var e=+t;return(e>0?n:r)(e)}},3070:function(t,r,n){var e=n(9781),o=n(4664),i=n(3353),a=n(9670),u=n(4948),c=TypeError,s=Object.defineProperty,l=Object.getOwnPropertyDescriptor,f="enumerable",p="configurable",v="writable";r.f=e?i?function(t,r,n){if(a(t),r=u(r),a(n),"function"===typeof t&&"prototype"===r&&"value"in n&&v in n&&!n[v]){var e=l(t,r);e&&e[v]&&(t[r]=n.value,n={configurable:p in n?n[p]:e[p],enumerable:f in n?n[f]:e[f],writable:!1})}return s(t,r,n)}:s:function(t,r,n){if(a(t),r=u(r),a(n),o)try{return s(t,r,n)}catch(e){}if("get"in n||"set"in n)throw c("Accessors not supported");return"value"in n&&(t[r]=n.value),t}},1236:function(t,r,n){var e=n(9781),o=n(6916),i=n(5296),a=n(9114),u=n(5656),c=n(4948),s=n(2597),l=n(4664),f=Object.getOwnPropertyDescriptor;r.f=e?f:function(t,r){if(t=u(t),r=c(r),l)try{return f(t,r)}catch(n){}if(s(t,r))return a(!o(i.f,t,r),t[r])}},8006:function(t,r,n){var e=n(6324),o=n(748),i=o.concat("length","prototype");r.f=Object.getOwnPropertyNames||function(t){return e(t,i)}},5181:function(t,r){r.f=Object.getOwnPropertySymbols},7976:function(t,r,n){var e=n(1702);t.exports=e({}.isPrototypeOf)},6324:function(t,r,n){var e=n(1702),o=n(2597),i=n(5656),a=n(1318).indexOf,u=n(3501),c=e([].push);t.exports=function(t,r){var n,e=i(t),s=0,l=[];for(n in e)!o(u,n)&&o(e,n)&&c(l,n);while(r.length>s)o(e,n=r[s++])&&(~a(l,n)||c(l,n));return l}},5296:function(t,r){var n={}.propertyIsEnumerable,e=Object.getOwnPropertyDescriptor,o=e&&!n.call({1:2},1);r.f=o?function(t){var r=e(this,t);return!!r&&r.enumerable}:n},2140:function(t,r,n){var e=n(6916),o=n(614),i=n(111),a=TypeError;t.exports=function(t,r){var n,u;if("string"===r&&o(n=t.toString)&&!i(u=e(n,t)))return u;if(o(n=t.valueOf)&&!i(u=e(n,t)))return u;if("string"!==r&&o(n=t.toString)&&!i(u=e(n,t)))return u;throw a("Can't convert object to primitive value")}},3887:function(t,r,n){var e=n(5005),o=n(1702),i=n(8006),a=n(5181),u=n(9670),c=o([].concat);t.exports=e("Reflect","ownKeys")||function(t){var r=i.f(u(t)),n=a.f;return n?c(r,n(t)):r}},4488:function(t,r,n){var e=n(8554),o=TypeError;t.exports=function(t){if(e(t))throw o("Can't call method on "+t);return t}},6200:function(t,r,n){var e=n(2309),o=n(9711),i=e("keys");t.exports=function(t){return i[t]||(i[t]=o(t))}},5465:function(t,r,n){var e=n(7854),o=n(3072),i="__core-js_shared__",a=e[i]||o(i,{});t.exports=a},2309:function(t,r,n){var e=n(1913),o=n(5465);(t.exports=function(t,r){return o[t]||(o[t]=void 0!==r?r:{})})("versions",[]).push({version:"3.32.0",mode:e?"pure":"global",copyright:"© 2014-2023 Denis Pushkarev (zloirock.ru)",license:"https://github.com/zloirock/core-js/blob/v3.32.0/LICENSE",source:"https://github.com/zloirock/core-js"})},6293:function(t,r,n){var e=n(7392),o=n(7293),i=n(7854),a=i.String;t.exports=!!Object.getOwnPropertySymbols&&!o((function(){var t=Symbol();return!a(t)||!(Object(t)instanceof Symbol)||!Symbol.sham&&e&&e<41}))},1400:function(t,r,n){var e=n(9303),o=Math.max,i=Math.min;t.exports=function(t,r){var n=e(t);return n<0?o(n+r,0):i(n,r)}},5656:function(t,r,n){var e=n(8361),o=n(4488);t.exports=function(t){return e(o(t))}},9303:function(t,r,n){var e=n(4758);t.exports=function(t){var r=+t;return r!==r||0===r?0:e(r)}},7466:function(t,r,n){var e=n(9303),o=Math.min;t.exports=function(t){return t>0?o(e(t),9007199254740991):0}},7908:function(t,r,n){var e=n(4488),o=Object;t.exports=function(t){return o(e(t))}},7593:function(t,r,n){var e=n(6916),o=n(111),i=n(2190),a=n(8173),u=n(2140),c=n(5112),s=TypeError,l=c("toPrimitive");t.exports=function(t,r){if(!o(t)||i(t))return t;var n,c=a(t,l);if(c){if(void 0===r&&(r="default"),n=e(c,t,r),!o(n)||i(n))return n;throw s("Can't convert object to primitive value")}return void 0===r&&(r="number"),u(t,r)}},4948:function(t,r,n){var e=n(7593),o=n(2190);t.exports=function(t){var r=e(t,"string");return o(r)?r:r+""}},6330:function(t){var r=String;t.exports=function(t){try{return r(t)}catch(n){return"Object"}}},9711:function(t,r,n){var e=n(1702),o=0,i=Math.random(),a=e(1..toString);t.exports=function(t){return"Symbol("+(void 0===t?"":t)+")_"+a(++o+i,36)}},3307:function(t,r,n){var e=n(6293);t.exports=e&&!Symbol.sham&&"symbol"==typeof Symbol.iterator},3353:function(t,r,n){var e=n(9781),o=n(7293);t.exports=e&&o((function(){return 42!=Object.defineProperty((function(){}),"prototype",{value:42,writable:!1}).prototype}))},4811:function(t,r,n){var e=n(7854),o=n(614),i=e.WeakMap;t.exports=o(i)&&/native code/.test(String(i))},5112:function(t,r,n){var e=n(7854),o=n(2309),i=n(2597),a=n(9711),u=n(6293),c=n(3307),s=e.Symbol,l=o("wks"),f=c?s["for"]||s:s&&s.withoutSetter||a;t.exports=function(t){return i(l,t)||(l[t]=u&&i(s,t)?s[t]:f("Symbol."+t)),l[t]}},7658:function(t,r,n){var e=n(2109),o=n(7908),i=n(6244),a=n(3658),u=n(7207),c=n(7293),s=c((function(){return 4294967297!==[].push.call({length:4294967296},1)})),l=function(){try{Object.defineProperty([],"length",{writable:!1}).push()}catch(t){return t instanceof TypeError}},f=s||!l();e({target:"Array",proto:!0,arity:1,forced:f},{push:function(t){var r=o(this),n=i(r),e=arguments.length;u(n+e);for(var c=0;c<e;c++)r[n]=arguments[c],n++;return a(r,n),n}})},7706:function(t,r,n){n.r(r),n.d(r,{default:function(){return H}});var e=n(6252),o=n(3577);const i=t=>((0,e.dD)("data-v-1d8592f7"),t=t(),(0,e.Cn)(),t),a={ref:"formulario",id:"main",method:"post"},u={class:"tabs is-boxed mb-0"},c=i((()=>(0,e._)("a",null,[(0,e._)("span",null,"Principal")],-1))),s=[c],l={id:"conteudo1",class:"p-4 conteudo"},f={class:"columns m-0"},p={class:"field m-0 pt-0 column is-one-fifth"},v=i((()=>(0,e._)("label",{class:"label"},"Login",-1))),d={class:"control"},h=["value"],m={class:"is-danger"},y={class:"columns m-0"},b={class:"field m-0 pt-0 column is is-one-fifth"},g=i((()=>(0,e._)("label",{class:"label"},"Funcionário",-1))),x={class:"control"},w=["value"],_={class:"is-danger"},S={class:"columns m-0"},O={class:"field m-0 py-0 column is-one-fifth"},j=i((()=>(0,e._)("label",{class:"label"},"Senha",-1))),P=i((()=>(0,e._)("div",{class:"control"},[(0,e._)("input",{name:"senha",class:"input is-small",type:"password"})],-1))),E={class:"is-danger"},D={class:"columns m-0"},C={class:"field m-0 pt-0 column is-one-fifth"},M=i((()=>(0,e._)("label",{class:"label"},"Repita a senha",-1))),T=i((()=>(0,e._)("div",{class:"control"},[(0,e._)("input",{name:"senhaRepetida",class:"input is-small",type:"password"})],-1))),k={class:"is-danger"},A={hidden:""},F=["value"],I=["value"],V={id:"botoes",class:"field is-grouped is-grouped-right p-3"},L={class:"control"},z=i((()=>(0,e._)("p",{class:"control"},[(0,e._)("a",{href:"/usuarios",class:"button is-danger"}," Cancelar ")],-1)));function R(t,r,n,i,c,$){const R=(0,e.up)("fa");return(0,e.wg)(),(0,e.iD)("form",a,[(0,e._)("div",u,[(0,e._)("ul",null,[(0,e._)("li",{id:"aba1",onClick:r[0]||(r[0]=t=>$.selecionarAba("1")),class:"aba is-active"},s)])]),(0,e._)("div",l,[(0,e._)("div",f,[(0,e._)("div",p,[v,(0,e._)("div",d,[(0,e._)("input",{name:"usuario",id:"usuario",class:"input is-small",type:"text",autofocus:"",value:c.usuario?c.usuario.usuario:""},null,8,h)]),(0,e._)("small",m,(0,o.zw)(c.erroValidacao&&c.erroValidacao.usuario),1)])]),(0,e._)("div",y,[(0,e._)("div",b,[g,(0,e._)("div",x,[(0,e._)("input",{name:"funcionario",class:"input is-small",type:"text",value:c.usuario?c.usuario.funcionario:null},null,8,w)]),(0,e._)("small",_,(0,o.zw)(c.erroValidacao&&c.erroValidacao.funcionario),1)])]),(0,e._)("div",S,[(0,e._)("div",O,[j,P,(0,e._)("small",E,(0,o.zw)(c.erroValidacao&&c.erroValidacao.senha),1)])]),(0,e._)("div",D,[(0,e._)("div",C,[M,T,(0,e._)("small",k,(0,o.zw)(c.erroValidacao&&c.erroValidacao.senhaRepetida),1)])])]),(0,e._)("div",A,[(0,e._)("input",{type:"text",name:"empresa_id",value:c.empresa},null,8,F),(0,e._)("input",{type:"text",name:"id",value:c.usuario?c.usuario.id:""},null,8,I)]),(0,e._)("div",V,[(0,e._)("p",L,[(0,e._)("button",{class:"button is-primary",type:"button",onClick:r[1]||(r[1]=(...t)=>$.enviarDados&&$.enviarDados(...t))},[(0,e.Wm)(R,{icon:"floppy-disk",class:"mr-1"}),(0,e.Uk)("Salvar ")])]),z])],512)}n(7658);var N=n(4621),U={name:"FormularioUsuario",data(){return{mensagem:[],erroValidacao:[],usuario:[],empresa:sessionStorage.getItem("empresa")}},async mounted(){let t=this.$route.query.id;await this.listar(t)},methods:{listar:async function(t){try{const r=await N.Z.get("api/usuarios/formulario?id="+t);this.usuario=r.data.usuario}catch(r){this.$root.mostrarFlashMenssage("danger","Erro",r),console.error(r)}},selecionarAba(t){let r=$(".conteudo").get();for(let i=0;i<r.length;i++)r[i].setAttribute("hidden","true");let n=$("#conteudo"+t);n.removeAttr("hidden");let e=$(".aba").get();for(let i=0;i<e.length;i++)e[i].classList.remove("is-active");let o=$("#aba"+t);o.addClass("is-active")},enviarDados:async function(){const t=new FormData(this.$refs.formulario);await N.Z.post("/api/usuarios/salvar-usuario",t).then((t=>{this.$root.mostrarFlashMenssage(t.data.tipo,t.data.titulo,t.data.mensagem),console.log(t.data),this.erroValidacao=t.data.erroValidacao,t.data.erroValidacao||this.$router.push({name:"usuariosView"})})).catch((t=>{this.$root.mostrarFlashMenssage("danger","Erro",t),console.error("Erro ao enviar dados:",t)}))}}},W=n(3744);const G=(0,W.Z)(U,[["render",R],["__scopeId","data-v-1d8592f7"]]);var H=G}}]);
//# sourceMappingURL=706.7c27fbe7.js.map