(function(c){
    var a=/^\s*|\s*$/g,d;
    var b={
        majorVersion:"3",
        minorVersion:"3.8",
        releaseDate:"2010-06-30",
        _init:function(){
            var r=this,o=document,m=navigator,f=m.userAgent,l,e,k,j,h,q;
            r.isOpera=c.opera&&opera.buildNumber;
            r.isWebKit=/WebKit/.test(f);
            r.isIE=!r.isWebKit&&!r.isOpera&&(/MSIE/gi).test(f)&&(/Explorer/gi).test(m.appName);
            r.isIE6=r.isIE&&/MSIE [56]/.test(f);
            r.isGecko=!r.isWebKit&&/Gecko/.test(f);
            r.isMac=f.indexOf("Mac")!=-1;
            r.isAir=/adobeair/i.test(f);
            r.isIDevice=/(iPad|iPhone)/.test(f);
            if(c.tinyMCEPreInit){
                r.suffix=tinyMCEPreInit.suffix;
                r.baseURL=tinyMCEPreInit.base;
                r.query=tinyMCEPreInit.query;
                return
            }
            r.suffix="";
            e=o.getElementsByTagName("base");
            for(l=0;l<e.length;l++){
                if(q=e[l].href){
                    if(/^https?:\/\/[^\/]+$/.test(q)){
                        q+="/"
                        }
                        j=q?q.match(/.*\//)[0]:""
                    }
                }
            function g(i){
            if(i.src&&/tiny_mce(|_gzip|_jquery|_prototype)(_dev|_src)?.js/.test(i.src)){
                if(/_(src|dev)\.js/g.test(i.src)){
                    r.suffix="_src"
                    }
                    if((h=i.src.indexOf("?"))!=-1){
                    r.query=i.src.substring(h+1)
                    }
                    r.baseURL=i.src.substring(0,i.src.lastIndexOf("/"));
                if(j&&r.baseURL.indexOf("://")==-1&&r.baseURL.indexOf("/")!==0){
                    r.baseURL=j+r.baseURL
                    }
                    return r.baseURL
                }
                return null
            }
            e=o.getElementsByTagName("script");
        for(l=0;l<e.length;l++){
            if(g(e[l])){
                return
            }
        }
        k=o.getElementsByTagName("head")[0];
    if(k){
        e=k.getElementsByTagName("script");
        for(l=0;l<e.length;l++){
            if(g(e[l])){
                return
            }
        }
        }
    return
},
is:function(f,e){
    if(!e){
        return f!==d
        }
        if(e=="array"&&(f.hasOwnProperty&&f instanceof Array)){
        return true
        }
        return typeof(f)==e
    },
each:function(h,e,g){
    var i,f;
    if(!h){
        return 0
        }
        g=g||h;
    if(h.length!==d){
        for(i=0,f=h.length;i<f;i++){
            if(e.call(g,h[i],i,h)===false){
                return 0
                }
            }
        }else{
    for(i in h){
        if(h.hasOwnProperty(i)){
            if(e.call(g,h[i],i,h)===false){
                return 0
                }
            }
    }
    }
return 1
},
map:function(e,g){
    var h=[];
    b.each(e,function(f){
        h.push(g(f))
        });
    return h
    },
grep:function(e,g){
    var h=[];
    b.each(e,function(f){
        if(!g||g(f)){
            h.push(f)
            }
        });
return h
},
inArray:function(f,g){
    var h,e;
    if(f){
        for(h=0,e=f.length;h<e;h++){
            if(f[h]===g){
                return h
                }
            }
        }
    return -1
},
extend:function(k,j){
    var h,g,f=arguments;
    for(h=1,g=f.length;h<g;h++){
        j=f[h];
        b.each(j,function(e,i){
            if(e!==d){
                k[i]=e
                }
            })
    }
    return k
},
trim:function(e){
    return(e?""+e:"").replace(a,"")
    },
create:function(m,e){
    var l=this,f,h,i,j,g,k=0;
    m=/^((static) )?([\w.]+)(:([\w.]+))?/.exec(m);
    i=m[3].match(/(^|\.)(\w+)$/i)[2];
    h=l.createNS(m[3].replace(/\.\w+$/,""));
    if(h[i]){
        return
    }
    if(m[2]=="static"){
        h[i]=e;
        if(this.onCreate){
            this.onCreate(m[2],m[3],h[i])
            }
            return
    }
    if(!e[i]){
        e[i]=function(){};

        k=1
        }
        h[i]=e[i];
    l.extend(h[i].prototype,e);
    if(m[5]){
        f=l.resolve(m[5]).prototype;
        j=m[5].match(/\.(\w+)$/i)[1];
        g=h[i];
        if(k){
            h[i]=function(){
                return f[j].apply(this,arguments)
                }
            }else{
        h[i]=function(){
            this.parent=f[j];
            return g.apply(this,arguments)
            }
        }
    h[i].prototype[i]=h[i];
l.each(f,function(o,p){
    h[i].prototype[p]=f[p]
    });
l.each(e,function(o,p){
    if(f[p]){
        h[i].prototype[p]=function(){
            this.parent=f[p];
            return o.apply(this,arguments)
            }
        }else{
    if(p!=i){
        h[i].prototype[p]=o
        }
    }
})
}
l.each(e["static"],function(o,p){
    h[i][p]=o
    });
if(this.onCreate){
    this.onCreate(m[2],m[3],h[i].prototype)
    }
},
walk:function(h,g,i,e){
    e=e||this;
    if(h){
        if(i){
            h=h[i]
            }
            b.each(h,function(j,f){
            if(g.call(e,j,f,i)===false){
                return false
                }
                b.walk(j,g,i,e)
            })
        }
    },
createNS:function(h,g){
    var f,e;
    g=g||c;
    h=h.split(".");
    for(f=0;f<h.length;f++){
        e=h[f];
        if(!g[e]){
            g[e]={}
        }
        g=g[e]
    }
    return g
},
resolve:function(h,g){
    var f,e;
    g=g||c;
    h=h.split(".");
    for(f=0,e=h.length;f<e;f++){
        g=g[h[f]];
        if(!g){
            break
        }
    }
    return g
},
addUnload:function(i,h){
    var g=this;
    i={
        func:i,
        scope:h||this
        };

    if(!g.unloads){
        function e(){
            var f=g.unloads,k,l;
            if(f){
                for(l in f){
                    k=f[l];
                    if(k&&k.func){
                        k.func.call(k.scope,1)
                        }
                    }
                if(c.detachEvent){
                c.detachEvent("onbeforeunload",j);
                c.detachEvent("onunload",e)
                }else{
                if(c.removeEventListener){
                    c.removeEventListener("unload",e,false)
                    }
                }
            g.unloads=k=f=w=e=0;
        if(c.CollectGarbage){
            CollectGarbage()
            }
        }
}
function j(){
    var k=document;
    if(k.readyState=="interactive"){
        function f(){
            k.detachEvent("onstop",f);
            if(e){
                e()
                }
                k=0
            }
            if(k){
            k.attachEvent("onstop",f)
            }
            c.setTimeout(function(){
            if(k){
                k.detachEvent("onstop",f)
                }
            },0)
    }
}
if(c.attachEvent){
    c.attachEvent("onunload",e);
    c.attachEvent("onbeforeunload",j)
    }else{
    if(c.addEventListener){
        c.addEventListener("unload",e,false)
        }
    }
g.unloads=[i]
}else{
    g.unloads.push(i)
    }
    return i
},
removeUnload:function(h){
    var e=this.unloads,g=null;
    b.each(e,function(j,f){
        if(j&&j.func==h){
            e.splice(f,1);
            g=h;
            return false
            }
        });
return g
},
explode:function(e,f){
    return e?b.map(e.split(f||","),b.trim):e
    },
_addVer:function(f){
    var e;
    if(!this.query){
        return f
        }
        e=(f.indexOf("?")==-1?"?":"&")+this.query;
    if(f.indexOf("#")==-1){
        return f+e
        }
        return f.replace("#",e+"#")
    }
};

b._init();
c.tinymce=c.tinyMCE=b
})(window);
tinymce.create("tinymce.util.Dispatcher",{
    scope:null,
    listeners:null,
    Dispatcher:function(a){
        this.scope=a||this;
        this.listeners=[]
        },
    add:function(a,b){
        this.listeners.push({
            cb:a,
            scope:b||this.scope
            });
        return a
        },
    addToTop:function(a,b){
        this.listeners.unshift({
            cb:a,
            scope:b||this.scope
            });
        return a
        },
    remove:function(a){
        var b=this.listeners,c=null;
        tinymce.each(b,function(e,d){
            if(a==e.cb){
                c=a;
                b.splice(d,1);
                return false
                }
            });
    return c
    },
dispatch:function(){
    var f,d=arguments,e,b=this.listeners,g;
    for(e=0;e<b.length;e++){
        g=b[e];
        f=g.cb.apply(g.scope,d);
        if(f===false){
            break
        }
    }
    return f
}
});
(function(){
    var a=tinymce.each;
    tinymce.create("tinymce.util.URI",{
        URI:function(e,g){
            var f=this,h,d,c;
            e=tinymce.trim(e);
            g=f.settings=g||{};

            if(/^(mailto|tel|news|javascript|about|data):/i.test(e)||/^\s*#/.test(e)){
                f.source=e;
                return
            }
            if(e.indexOf("/")===0&&e.indexOf("//")!==0){
                e=(g.base_uri?g.base_uri.protocol||"http":"http")+"://mce_host"+e
                }
                if(!/^\w*:?\/\//.test(e)){
                e=(g.base_uri.protocol||"http")+"://mce_host"+f.toAbsPath(g.base_uri.path,e)
                }
                e=e.replace(/@@/g,"(mce_at)");
            e=/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(e);
            a(["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],function(b,j){
                var k=e[j];
                if(k){
                    k=k.replace(/\(mce_at\)/g,"@@")
                    }
                    f[b]=k
                });
            if(c=g.base_uri){
                if(!f.protocol){
                    f.protocol=c.protocol
                    }
                    if(!f.userInfo){
                    f.userInfo=c.userInfo
                    }
                    if(!f.port&&f.host=="mce_host"){
                    f.port=c.port
                    }
                    if(!f.host||f.host=="mce_host"){
                    f.host=c.host
                    }
                    f.source=""
                }
            },
    setPath:function(c){
        var b=this;
        c=/^(.*?)\/?(\w+)?$/.exec(c);
        b.path=c[0];
        b.directory=c[1];
        b.file=c[2];
        b.source="";
        b.getURI()
        },
    toRelative:function(b){
        var c=this,d;
        if(b==="./"){
            return b
            }
            b=new tinymce.util.URI(b,{
            base_uri:c
        });
        if((b.host!="mce_host"&&c.host!=b.host&&b.host)||c.port!=b.port||c.protocol!=b.protocol){
            return b.getURI()
            }
            d=c.toRelPath(c.path,b.path);
        if(b.query){
            d+="?"+b.query
            }
            if(b.anchor){
            d+="#"+b.anchor
            }
            return d
        },
    toAbsolute:function(b,c){
        var b=new tinymce.util.URI(b,{
            base_uri:this
        });
        return b.getURI(this.host==b.host&&this.protocol==b.protocol?c:0)
        },
    toRelPath:function(g,h){
        var c,f=0,d="",e,b;
        g=g.substring(0,g.lastIndexOf("/"));
        g=g.split("/");
        c=h.split("/");
        if(g.length>=c.length){
            for(e=0,b=g.length;e<b;e++){
                if(e>=c.length||g[e]!=c[e]){
                    f=e+1;
                    break
                }
            }
            }
        if(g.length<c.length){
        for(e=0,b=c.length;e<b;e++){
            if(e>=g.length||g[e]!=c[e]){
                f=e+1;
                break
            }
        }
        }
    if(f==1){
    return h
    }
    for(e=0,b=g.length-(f-1);e<b;e++){
    d+="../"
    }
    for(e=f-1,b=c.length;e<b;e++){
    if(e!=f-1){
        d+="/"+c[e]
        }else{
        d+=c[e]
        }
    }
return d
},
toAbsPath:function(e,f){
    var c,b=0,h=[],d,g;
    d=/\/$/.test(f)?"/":"";
    e=e.split("/");
    f=f.split("/");
    a(e,function(i){
        if(i){
            h.push(i)
            }
        });
e=h;
for(c=f.length-1,h=[];c>=0;c--){
    if(f[c].length==0||f[c]=="."){
        continue
    }
    if(f[c]==".."){
        b++;
        continue
    }
    if(b>0){
        b--;
        continue
    }
    h.push(f[c])
    }
    c=e.length-b;
if(c<=0){
    g=h.reverse().join("/")
    }else{
    g=e.slice(0,c).join("/")+"/"+h.reverse().join("/")
    }
    if(g.indexOf("/")!==0){
    g="/"+g
    }
    if(d&&g.lastIndexOf("/")!==g.length-1){
    g+=d
    }
    return g
},
getURI:function(d){
    var c,b=this;
    if(!b.source||d){
        c="";
        if(!d){
            if(b.protocol){
                c+=b.protocol+"://"
                }
                if(b.userInfo){
                c+=b.userInfo+"@"
                }
                if(b.host){
                c+=b.host
                }
                if(b.port){
                c+=":"+b.port
                }
            }
        if(b.path){
        c+=b.path
        }
        if(b.query){
        c+="?"+b.query
        }
        if(b.anchor){
        c+="#"+b.anchor
        }
        b.source=c
    }
    return b.source
}
})
})();
(function(){
    var a=tinymce.each;
    tinymce.create("static tinymce.util.Cookie",{
        getHash:function(d){
            var b=this.get(d),c;
            if(b){
                a(b.split("&"),function(e){
                    e=e.split("=");
                    c=c||{};

                    c[unescape(e[0])]=unescape(e[1])
                    })
                }
                return c
            },
        setHash:function(j,b,g,f,i,c){
            var h="";
            a(b,function(e,d){
                h+=(!h?"":"&")+escape(d)+"="+escape(e)
                });
            this.set(j,h,g,f,i,c)
            },
        get:function(i){
            var h=document.cookie,g,f=i+"=",d;
            if(!h){
                return
            }
            d=h.indexOf("; "+f);
            if(d==-1){
                d=h.indexOf(f);
                if(d!=0){
                    return null
                    }
                }else{
            d+=2
            }
            g=h.indexOf(";",d);
        if(g==-1){
            g=h.length
            }
            return unescape(h.substring(d+f.length,g))
        },
    set:function(i,b,g,f,h,c){
        document.cookie=i+"="+escape(b)+((g)?"; expires="+g.toGMTString():"")+((f)?"; path="+escape(f):"")+((h)?"; domain="+h:"")+((c)?"; secure":"")
        },
    remove:function(e,b){
        var c=new Date();
        c.setTime(c.getTime()-1000);
        this.set(e,"",c,b,c)
        }
    })
})();
tinymce.create("static tinymce.util.JSON",{
    serialize:function(e){
        var c,a,d=tinymce.util.JSON.serialize,b;
        if(e==null){
            return"null"
            }
            b=typeof e;
        if(b=="string"){
            a="\bb\tt\nn\ff\rr\"\"''\\\\";
            return'"'+e.replace(/([\u0080-\uFFFF\x00-\x1f\"])/g,function(g,f){
                c=a.indexOf(f);
                if(c+1){
                    return"\\"+a.charAt(c+1)
                    }
                    g=f.charCodeAt().toString(16);
                return"\\u"+"0000".substring(g.length)+g
                })+'"'
            }
            if(b=="object"){
            if(e.hasOwnProperty&&e instanceof Array){
                for(c=0,a="[";c<e.length;c++){
                    a+=(c>0?",":"")+d(e[c])
                    }
                    return a+"]"
                }
                a="{";
            for(c in e){
                a+=typeof e[c]!="function"?(a.length>1?',"':'"')+c+'":'+d(e[c]):""
                }
                return a+"}"
            }
            return""+e
        },
    parse:function(s){
        try{
            return eval("("+s+")")
            }catch(ex){}
    }
});
tinymce.create("static tinymce.util.XHR",{
    send:function(g){
        var a,e,b=window,h=0;
        g.scope=g.scope||this;
        g.success_scope=g.success_scope||g.scope;
        g.error_scope=g.error_scope||g.scope;
        g.async=g.async===false?false:true;
        g.data=g.data||"";
        function d(i){
            a=0;
            try{
                a=new ActiveXObject(i)
                }catch(c){}
            return a
            }
            a=b.XMLHttpRequest?new XMLHttpRequest():d("Microsoft.XMLHTTP")||d("Msxml2.XMLHTTP");
        if(a){
            if(a.overrideMimeType){
                a.overrideMimeType(g.content_type)
                }
                a.open(g.type||(g.data?"POST":"GET"),g.url,g.async);
            if(g.content_type){
                a.setRequestHeader("Content-Type",g.content_type)
                }
                a.setRequestHeader("X-Requested-With","XMLHttpRequest");
            a.send(g.data);
            function f(){
                if(!g.async||a.readyState==4||h++>10000){
                    if(g.success&&h<10000&&a.status==200){
                        g.success.call(g.success_scope,""+a.responseText,a,g)
                        }else{
                        if(g.error){
                            g.error.call(g.error_scope,h>10000?"TIMED_OUT":"GENERAL",a,g)
                            }
                        }
                    a=null
                }else{
                b.setTimeout(f,10)
                }
            }
        if(!g.async){
        return f()
        }
        e=b.setTimeout(f,10)
    }
}
});
(function(){
    var c=tinymce.extend,b=tinymce.util.JSON,a=tinymce.util.XHR;
    tinymce.create("tinymce.util.JSONRequest",{
        JSONRequest:function(d){
            this.settings=c({},d);
            this.count=0
            },
        send:function(f){
            var e=f.error,d=f.success;
            f=c(this.settings,f);
            f.success=function(h,g){
                h=b.parse(h);
                if(typeof(h)=="undefined"){
                    h={
                        error:"JSON Parse error."
                    }
                }
                if(h.error){
                e.call(f.error_scope||f.scope,h.error,g)
                }else{
                d.call(f.success_scope||f.scope,h.result)
                }
            };

    f.error=function(h,g){
        e.call(f.error_scope||f.scope,h,g)
        };

    f.data=b.serialize({
        id:f.id||"c"+(this.count++),
        method:f.method,
        params:f.params
        });
    f.content_type="application/json";
    a.send(f)
        },
    "static":{
        sendRPC:function(d){
            return new tinymce.util.JSONRequest().send(d)
            }
        }
})
}());
(function(m){
    var k=m.each,j=m.is,i=m.isWebKit,d=m.isIE,a=/^(H[1-6R]|P|DIV|ADDRESS|PRE|FORM|T(ABLE|BODY|HEAD|FOOT|H|R|D)|LI|OL|UL|CAPTION|BLOCKQUOTE|CENTER|DL|DT|DD|DIR|FIELDSET|NOSCRIPT|MENU|ISINDEX|SAMP)$/,e=g("checked,compact,declare,defer,disabled,ismap,multiple,nohref,noresize,noshade,nowrap,readonly,selected"),f=g("src,href,style,coords,shape"),c={
        "&":"&amp;",
        '"':"&quot;",
        "<":"&lt;",
        ">":"&gt;"
    },n=/[<>&\"]/g,b=/^([a-z0-9],?)+$/i,h=/<(\w+)((?:\s+\w+(?:\s*=\s*(?:(?:"[^"]*")|(?:'[^']*')|[^>\s]+))?)*)(\s*\/?)>/g,l=/(\w+)(?:\s*=\s*(?:(?:"((?:\\.|[^"])*)")|(?:'((?:\\.|[^'])*)')|([^>\s]+)))?/g;
    function g(q){
        var p={},o;
        q=q.split(",");
        for(o=q.length;o>=0;o--){
            p[q[o]]=1
            }
            return p
        }
        m.create("tinymce.dom.DOMUtils",{
        doc:null,
        root:null,
        files:null,
        pixelStyles:/^(top|left|bottom|right|width|height|borderWidth)$/,
        props:{
            "for":"htmlFor",
            "class":"className",
            className:"className",
            checked:"checked",
            disabled:"disabled",
            maxlength:"maxLength",
            readonly:"readOnly",
            selected:"selected",
            value:"value",
            id:"id",
            name:"name",
            type:"type"
        },
        DOMUtils:function(u,q){
            var p=this,o;
            p.doc=u;
            p.win=window;
            p.files={};

            p.cssFlicker=false;
            p.counter=0;
            p.boxModel=!m.isIE||u.compatMode=="CSS1Compat";
            p.stdMode=u.documentMode===8;
            p.settings=q=m.extend({
                keep_values:false,
                hex_colors:1,
                process_html:1
            },q);
            if(m.isIE6){
                try{
                    u.execCommand("BackgroundImageCache",false,true)
                    }catch(r){
                    p.cssFlicker=true
                    }
                }
            if(q.valid_styles){
            p._styles={};

            k(q.valid_styles,function(t,s){
                p._styles[s]=m.explode(t)
                })
            }
            m.addUnload(p.destroy,p)
        },
    getRoot:function(){
        var o=this,p=o.settings;
        return(p&&o.get(p.root_element))||o.doc.body
        },
    getViewPort:function(p){
        var q,o;
        p=!p?this.win:p;
        q=p.document;
        o=this.boxModel?q.documentElement:q.body;
        return{
            x:p.pageXOffset||o.scrollLeft,
            y:p.pageYOffset||o.scrollTop,
            w:p.innerWidth||o.clientWidth,
            h:p.innerHeight||o.clientHeight
            }
        },
    getRect:function(s){
        var r,o=this,q;
        s=o.get(s);
        r=o.getPos(s);
        q=o.getSize(s);
        return{
            x:r.x,
            y:r.y,
            w:q.w,
            h:q.h
            }
        },
getSize:function(r){
    var p=this,o,q;
    r=p.get(r);
    o=p.getStyle(r,"width");
    q=p.getStyle(r,"height");
    if(o.indexOf("px")===-1){
        o=0
        }
        if(q.indexOf("px")===-1){
        q=0
        }
        return{
        w:parseInt(o)||r.offsetWidth||r.clientWidth,
        h:parseInt(q)||r.offsetHeight||r.clientHeight
        }
    },
getParent:function(q,p,o){
    return this.getParents(q,p,o,false)
    },
getParents:function(z,v,s,y){
    var q=this,p,u=q.settings,x=[];
    z=q.get(z);
    y=y===undefined;
    if(u.strict_root){
        s=s||q.getRoot()
        }
        if(j(v,"string")){
        p=v;
        if(v==="*"){
            v=function(o){
                return o.nodeType==1
                }
            }else{
        v=function(o){
            return q.is(o,p)
            }
        }
}while(z){
    if(z==s||!z.nodeType||z.nodeType===9){
        break
    }
    if(!v||v(z)){
        if(y){
            x.push(z)
            }else{
            return z
            }
        }
    z=z.parentNode
}
return y?x:null
},
get:function(o){
    var p;
    if(o&&this.doc&&typeof(o)=="string"){
        p=o;
        o=this.doc.getElementById(o);
        if(o&&o.id!==p){
            return this.doc.getElementsByName(p)[1]
            }
        }
    return o
},
getNext:function(p,o){
    return this._findSib(p,o,"nextSibling")
    },
getPrev:function(p,o){
    return this._findSib(p,o,"previousSibling")
    },
select:function(q,p){
    var o=this;
    return m.dom.Sizzle(q,o.get(p)||o.get(o.settings.root_element)||o.doc,[])
    },
is:function(q,o){
    var p;
    if(q.length===undefined){
        if(o==="*"){
            return q.nodeType==1
            }
            if(b.test(o)){
            o=o.toLowerCase().split(/,/);
            q=q.nodeName.toLowerCase();
            for(p=o.length-1;p>=0;p--){
                if(o[p]==q){
                    return true
                    }
                }
            return false
        }
    }
return m.dom.Sizzle.matches(o,q.nodeType?[q]:q).length>0
},
add:function(s,v,o,r,u){
    var q=this;
    return this.run(s,function(y){
        var x,t;
        x=j(v,"string")?q.doc.createElement(v):v;
        q.setAttribs(x,o);
        if(r){
            if(r.nodeType){
                x.appendChild(r)
                }else{
                q.setHTML(x,r)
                }
            }
        return !u?y.appendChild(x):x
        })
},
create:function(q,o,p){
    return this.add(this.doc.createElement(q),q,o,p,1)
    },
createHTML:function(v,p,s){
    var u="",r=this,q;
    u+="<"+v;
    for(q in p){
        if(p.hasOwnProperty(q)){
            u+=" "+q+'="'+r.encode(p[q])+'"'
            }
        }
    if(m.is(s)){
    return u+">"+s+"</"+v+">"
    }
    return u+" />"
},
remove:function(o,p){
    return this.run(o,function(r){
        var q,s;
        q=r.parentNode;
        if(!q){
            return null
            }
            if(p){
            while(s=r.firstChild){
                if(!m.isIE||s.nodeType!==3||s.nodeValue){
                    q.insertBefore(s,r)
                    }else{
                    r.removeChild(s)
                    }
                }
        }
    return q.removeChild(r)
    })
},
setStyle:function(r,o,p){
    var q=this;
    return q.run(r,function(v){
        var u,t;
        u=v.style;
        o=o.replace(/-(\D)/g,function(x,s){
            return s.toUpperCase()
            });
        if(q.pixelStyles.test(o)&&(m.is(p,"number")||/^[\-0-9\.]+$/.test(p))){
            p+="px"
            }
            switch(o){
            case"opacity":
                if(d){
                u.filter=p===""?"":"alpha(opacity="+(p*100)+")";
                if(!r.currentStyle||!r.currentStyle.hasLayout){
                    u.display="inline-block"
                    }
                }
            u[o]=u["-moz-opacity"]=u["-khtml-opacity"]=p||"";
            break;
        case"float":
            d?u.styleFloat=p:u.cssFloat=p;
            break;
        default:
            u[o]=p||""
            }
            if(q.settings.update_styles){
        q.setAttrib(v,"_mce_style")
        }
    })
},
getStyle:function(r,o,q){
    r=this.get(r);
    if(!r){
        return false
        }
        if(this.doc.defaultView&&q){
        o=o.replace(/[A-Z]/g,function(s){
            return"-"+s
            });
        try{
            return this.doc.defaultView.getComputedStyle(r,null).getPropertyValue(o)
            }catch(p){
            return null
            }
        }
    o=o.replace(/-(\D)/g,function(t,s){
    return s.toUpperCase()
    });
if(o=="float"){
    o=d?"styleFloat":"cssFloat"
    }
    if(r.currentStyle&&q){
    return r.currentStyle[o]
    }
    return r.style[o]
},
setStyles:function(u,v){
    var q=this,r=q.settings,p;
    p=r.update_styles;
    r.update_styles=0;
    k(v,function(o,s){
        q.setStyle(u,s,o)
        });
    r.update_styles=p;
    if(r.update_styles){
        q.setAttrib(u,r.cssText)
        }
    },
setAttrib:function(q,r,o){
    var p=this;
    if(!q||!r){
        return
    }
    if(p.settings.strict){
        r=r.toLowerCase()
        }
        return this.run(q,function(u){
        var t=p.settings;
        switch(r){
            case"style":
                if(!j(o,"string")){
                k(o,function(s,x){
                    p.setStyle(u,x,s)
                    });
                return
            }
            if(t.keep_values){
                if(o&&!p._isRes(o)){
                    u.setAttribute("_mce_style",o,2)
                    }else{
                    u.removeAttribute("_mce_style",2)
                    }
                }
            u.style.cssText=o;
            break;
        case"class":
            u.className=o||"";
            break;
        case"src":case"href":
            if(t.keep_values){
            if(t.url_converter){
                o=t.url_converter.call(t.url_converter_scope||p,o,r,u)
                }
                p.setAttrib(u,"_mce_"+r,o,2)
            }
            break;
        case"shape":
            u.setAttribute("_mce_style",o);
            break
            }
            if(j(o)&&o!==null&&o.length!==0){
        u.setAttribute(r,""+o,2)
        }else{
        u.removeAttribute(r,2)
        }
    })
},
setAttribs:function(q,r){
    var p=this;
    return this.run(q,function(o){
        k(r,function(s,t){
            p.setAttrib(o,t,s)
            })
        })
    },
getAttrib:function(r,s,q){
    var o,p=this;
    r=p.get(r);
    if(!r||r.nodeType!==1){
        return false
        }
        if(!j(q)){
        q=""
        }
        if(/^(src|href|style|coords|shape)$/.test(s)){
        o=r.getAttribute("_mce_"+s);
        if(o){
            return o
            }
        }
    if(d&&p.props[s]){
    o=r[p.props[s]];
    o=o&&o.nodeValue?o.nodeValue:o
    }
    if(!o){
    o=r.getAttribute(s,2)
    }
    if(/^(checked|compact|declare|defer|disabled|ismap|multiple|nohref|noshade|nowrap|readonly|selected)$/.test(s)){
    if(r[p.props[s]]===true&&o===""){
        return s
        }
        return o?s:""
    }
    if(r.nodeName==="FORM"&&r.getAttributeNode(s)){
    return r.getAttributeNode(s).nodeValue
    }
    if(s==="style"){
    o=o||r.style.cssText;
    if(o){
        o=p.serializeStyle(p.parseStyle(o),r.nodeName);
        if(p.settings.keep_values&&!p._isRes(o)){
            r.setAttribute("_mce_style",o)
            }
        }
}
if(i&&s==="class"&&o){
    o=o.replace(/(apple|webkit)\-[a-z\-]+/gi,"")
    }
    if(d){
    switch(s){
        case"rowspan":case"colspan":
            if(o===1){
            o=""
            }
            break;
        case"size":
            if(o==="+0"||o===20||o===0){
            o=""
            }
            break;
        case"width":case"height":case"vspace":case"checked":case"disabled":case"readonly":
            if(o===0){
            o=""
            }
            break;
        case"hspace":
            if(o===-1){
            o=""
            }
            break;
        case"maxlength":case"tabindex":
            if(o===32768||o===2147483647||o==="32768"){
            o=""
            }
            break;
        case"multiple":case"compact":case"noshade":case"nowrap":
            if(o===65535){
            return s
            }
            return q;
        case"shape":
            o=o.toLowerCase();
            break;
        default:
            if(s.indexOf("on")===0&&o){
            o=(""+o).replace(/^function\s+\w+\(\)\s+\{\s+(.*)\s+\}$/,"$1")
            }
        }
    }
return(o!==undefined&&o!==null&&o!=="")?""+o:q
},
getPos:function(A,s){
    var p=this,o=0,z=0,u,v=p.doc,q;
    A=p.get(A);
    s=s||v.body;
    if(A){
        if(d&&!p.stdMode){
            A=A.getBoundingClientRect();
            u=p.boxModel?v.documentElement:v.body;
            o=p.getStyle(p.select("html")[0],"borderWidth");
            o=(o=="medium"||p.boxModel&&!p.isIE6)&&2||o;
            return{
                x:A.left+u.scrollLeft-o,
                y:A.top+u.scrollTop-o
                }
            }
        q=A;
    while(q&&q!=s&&q.nodeType){
        o+=q.offsetLeft||0;
        z+=q.offsetTop||0;
        q=q.offsetParent
        }
        q=A.parentNode;
    while(q&&q!=s&&q.nodeType){
        o-=q.scrollLeft||0;
        z-=q.scrollTop||0;
        q=q.parentNode
        }
    }
return{
    x:o,
    y:z
}
},
parseStyle:function(r){
    var u=this,v=u.settings,x={};

    if(!r){
        return x
        }
        function p(D,A,C){
        var z,B,o,y;
        z=x[D+"-top"+A];
        if(!z){
            return
        }
        B=x[D+"-right"+A];
        if(z!=B){
            return
        }
        o=x[D+"-bottom"+A];
        if(B!=o){
            return
        }
        y=x[D+"-left"+A];
        if(o!=y){
            return
        }
        x[C]=y;
        delete x[D+"-top"+A];
        delete x[D+"-right"+A];
        delete x[D+"-bottom"+A];
        delete x[D+"-left"+A]
    }
    function q(y,s,o,A){
        var z;
        z=x[s];
        if(!z){
            return
        }
        z=x[o];
        if(!z){
            return
        }
        z=x[A];
        if(!z){
            return
        }
        x[y]=x[s]+" "+x[o]+" "+x[A];
        delete x[s];
        delete x[o];
        delete x[A]
    }
    r=r.replace(/&(#?[a-z0-9]+);/g,"&$1_MCE_SEMI_");
    k(r.split(";"),function(s){
        var o,t=[];
        if(s){
            s=s.replace(/_MCE_SEMI_/g,";");
            s=s.replace(/url\([^\)]+\)/g,function(y){
                t.push(y);
                return"url("+t.length+")"
                });
            s=s.split(":");
            o=m.trim(s[1]);
            o=o.replace(/url\(([^\)]+)\)/g,function(z,y){
                return t[parseInt(y)-1]
                });
            o=o.replace(/rgb\([^\)]+\)/g,function(y){
                return u.toHex(y)
                });
            if(v.url_converter){
                o=o.replace(/url\([\'\"]?([^\)\'\"]+)[\'\"]?\)/g,function(y,z){
                    return"url("+v.url_converter.call(v.url_converter_scope||u,u.decode(z),"style",null)+")"
                    })
                }
                x[m.trim(s[0]).toLowerCase()]=o
            }
        });
p("border","","border");
p("border","-width","border-width");
p("border","-color","border-color");
p("border","-style","border-style");
p("padding","","padding");
p("margin","","margin");
q("border","border-width","border-style","border-color");
if(d){
    if(x.border=="medium none"){
        x.border=""
        }
    }
return x
},
serializeStyle:function(v,p){
    var q=this,r="";
    function u(s,o){
        if(o&&s){
            if(o.indexOf("-")===0){
                return
            }
            switch(o){
                case"font-weight":
                    if(s==700){
                    s="bold"
                    }
                    break;
                case"color":case"background-color":
                    s=s.toLowerCase();
                    break
                    }
                    r+=(r?" ":"")+o+": "+s+";"
            }
        }
    if(p&&q._styles){
    k(q._styles["*"],function(o){
        u(v[o],o)
        });
    k(q._styles[p.toLowerCase()],function(o){
        u(v[o],o)
        })
    }else{
    k(v,u)
    }
    return r
},
loadCSS:function(o){
    var q=this,r=q.doc,p;
    if(!o){
        o=""
        }
        p=q.select("head")[0];
    k(o.split(","),function(s){
        var t;
        if(q.files[s]){
            return
        }
        q.files[s]=true;
        t=q.create("link",{
            rel:"stylesheet",
            href:m._addVer(s)
            });
        if(d&&r.documentMode){
            t.onload=function(){
                r.recalc();
                t.onload=null
                }
            }
        p.appendChild(t)
        })
},
addClass:function(o,p){
    return this.run(o,function(q){
        var r;
        if(!p){
            return 0
            }
            if(this.hasClass(q,p)){
            return q.className
            }
            r=this.removeClass(q,p);
        return q.className=(r!=""?(r+" "):"")+p
        })
    },
removeClass:function(q,r){
    var o=this,p;
    return o.run(q,function(t){
        var s;
        if(o.hasClass(t,r)){
            if(!p){
                p=new RegExp("(^|\\s+)"+r+"(\\s+|$)","g")
                }
                s=t.className.replace(p," ");
            s=m.trim(s!=" "?s:"");
            t.className=s;
            if(!s){
                t.removeAttribute("class");
                t.removeAttribute("className")
                }
                return s
            }
            return t.className
        })
    },
hasClass:function(p,o){
    p=this.get(p);
    if(!p||!o){
        return false
        }
        return(" "+p.className+" ").indexOf(" "+o+" ")!==-1
    },
show:function(o){
    return this.setStyle(o,"display","block")
    },
hide:function(o){
    return this.setStyle(o,"display","none")
    },
isHidden:function(o){
    o=this.get(o);
    return !o||o.style.display=="none"||this.getStyle(o,"display")=="none"
    },
uniqueId:function(o){
    return(!o?"mce_":o)+(this.counter++)
    },
setHTML:function(q,p){
    var o=this;
    return this.run(q,function(v){
        var r,t,s,z,u,r;
        p=o.processHTML(p);
        if(d){
            function y(){
                while(v.firstChild){
                    v.firstChild.removeNode()
                    }
                    try{
                    v.innerHTML="<br />"+p;
                    v.removeChild(v.firstChild)
                    }catch(x){
                    r=o.create("div");
                    r.innerHTML="<br />"+p;
                    k(r.childNodes,function(B,A){
                        if(A){
                            v.appendChild(B)
                            }
                        })
                }
            }
        if(o.settings.fix_ie_paragraphs){
        p=p.replace(/<p><\/p>|<p([^>]+)><\/p>|<p[^\/+]\/>/gi,'<p$1 _mce_keep="true">&nbsp;</p>')
        }
        y();
        if(o.settings.fix_ie_paragraphs){
        s=v.getElementsByTagName("p");
        for(t=s.length-1,r=0;t>=0;t--){
            z=s[t];
            if(!z.hasChildNodes()){
                if(!z._mce_keep){
                    r=1;
                    break
                }
                z.removeAttribute("_mce_keep")
                }
            }
        }
    if(r){
    p=p.replace(/<p ([^>]+)>|<p>/ig,'<div $1 _mce_tmp="1">');
    p=p.replace(/<\/p>/gi,"</div>");
    y();
    if(o.settings.fix_ie_paragraphs){
        s=v.getElementsByTagName("DIV");
        for(t=s.length-1;t>=0;t--){
            z=s[t];
            if(z._mce_tmp){
                u=o.doc.createElement("p");
                z.cloneNode(false).outerHTML.replace(/([a-z0-9\-_]+)=/gi,function(A,x){
                    var B;
                    if(x!=="_mce_tmp"){
                        B=z.getAttribute(x);
                        if(!B&&x==="class"){
                            B=z.className
                            }
                            u.setAttribute(x,B)
                        }
                    });
            for(r=0;r<z.childNodes.length;r++){
                u.appendChild(z.childNodes[r].cloneNode(true))
                }
                z.swapNode(u)
            }
        }
    }
}
}else{
    v.innerHTML=p
    }
    return p
})
},
processHTML:function(r){
    var p=this,q=p.settings,v=[];
    if(!q.process_html){
        return r
        }
        if(d){
        r=r.replace(/&apos;/g,"&#39;");
        r=r.replace(/\s+(disabled|checked|readonly|selected)\s*=\s*[\"\']?(false|0)[\"\']?/gi,"")
        }
        r=r.replace(/<a( )([^>]+)\/>|<a\/>/gi,"<a$1$2></a>");
    if(q.keep_values){
        if(/<script|noscript|style/i.test(r)){
            function o(t){
                t=t.replace(/(<!--\[CDATA\[|\]\]-->)/g,"\n");
                t=t.replace(/^[\r\n]*|[\r\n]*$/g,"");
                t=t.replace(/^\s*(\/\/\s*<!--|\/\/\s*<!\[CDATA\[|<!--|<!\[CDATA\[)[\r\n]*/g,"");
                t=t.replace(/\s*(\/\/\s*\]\]>|\/\/\s*-->|\]\]>|-->|\]\]-->)\s*$/g,"");
                return t
                }
                r=r.replace(/<script([^>]+|)>([\s\S]*?)<\/script>/gi,function(s,x,t){
                if(!x){
                    x=' type="text/javascript"'
                    }
                    x=x.replace(/src=\"([^\"]+)\"?/i,function(y,z){
                    if(q.url_converter){
                        z=p.encode(q.url_converter.call(q.url_converter_scope||p,p.decode(z),"src","script"))
                        }
                        return'_mce_src="'+z+'"'
                    });
                if(m.trim(t)){
                    v.push(o(t));
                    t="<!--\nMCE_SCRIPT:"+(v.length-1)+"\n// -->"
                    }
                    return"<mce:script"+x+">"+t+"</mce:script>"
                });
            r=r.replace(/<style([^>]+|)>([\s\S]*?)<\/style>/gi,function(s,x,t){
                if(t){
                    v.push(o(t));
                    t="<!--\nMCE_SCRIPT:"+(v.length-1)+"\n-->"
                    }
                    return"<mce:style"+x+">"+t+"</mce:style><style "+x+' _mce_bogus="1">'+t+"</style>"
                });
            r=r.replace(/<noscript([^>]+|)>([\s\S]*?)<\/noscript>/g,function(s,x,t){
                return"<mce:noscript"+x+"><!--"+p.encode(t).replace(/--/g,"&#45;&#45;")+"--></mce:noscript>"
                })
            }
            r=r.replace(/<!\[CDATA\[([\s\S]+)\]\]>/g,"<!--[CDATA[$1]]-->");
        function u(s){
            return s.replace(h,function(y,z,x,t){
                return"<"+z+x.replace(l,function(B,A,E,D,C){
                    var F;
                    A=A.toLowerCase();
                    E=E||D||C||"";
                    if(e[A]){
                        if(E==="false"||E==="0"){
                            return
                        }
                        return A+'="'+A+'"'
                        }
                        if(f[A]&&x.indexOf("_mce_"+A)==-1){
                        F=p.decode(E);
                        if(q.url_converter&&(A=="src"||A=="href")){
                            F=q.url_converter.call(q.url_converter_scope||p,F,A,z)
                            }
                            if(A=="style"){
                            F=p.serializeStyle(p.parseStyle(F),A)
                            }
                            return A+'="'+E+'" _mce_'+A+'="'+p.encode(F)+'"'
                        }
                        return B
                    })+t+">"
                })
            }
            r=u(r);
        r=r.replace(/MCE_SCRIPT:([0-9]+)/g,function(t,s){
            return v[s]
            })
        }
        return r
    },
getOuterHTML:function(o){
    var p;
    o=this.get(o);
    if(!o){
        return null
        }
        if(o.outerHTML!==undefined){
        return o.outerHTML
        }
        p=(o.ownerDocument||this.doc).createElement("body");
    p.appendChild(o.cloneNode(true));
    return p.innerHTML
    },
setOuterHTML:function(r,p,s){
    var o=this;
    function q(u,t,x){
        var y,v;
        v=x.createElement("body");
        v.innerHTML=t;
        y=v.lastChild;
        while(y){
            o.insertAfter(y.cloneNode(true),u);
            y=y.previousSibling
            }
            o.remove(u)
        }
        return this.run(r,function(u){
        u=o.get(u);
        if(u.nodeType==1){
            s=s||u.ownerDocument||o.doc;
            if(d){
                try{
                    if(d&&u.nodeType==1){
                        u.outerHTML=p
                        }else{
                        q(u,p,s)
                        }
                    }catch(t){
                q(u,p,s)
                }
            }else{
        q(u,p,s)
        }
    }
})
},
decode:function(p){
    var q,r,o;
    if(/&[\w#]+;/.test(p)){
        q=this.doc.createElement("div");
        q.innerHTML=p;
        r=q.firstChild;
        o="";
        if(r){
            do{
                o+=r.nodeValue
                }while(r=r.nextSibling)
        }
        return o||p
        }
        return p
    },
encode:function(o){
    return(""+o).replace(n,function(p){
        return c[p]
        })
    },
insertAfter:function(o,p){
    p=this.get(p);
    return this.run(o,function(r){
        var q,s;
        q=p.parentNode;
        s=p.nextSibling;
        if(s){
            q.insertBefore(r,s)
            }else{
            q.appendChild(r)
            }
            return r
        })
    },
isBlock:function(o){
    if(o.nodeType&&o.nodeType!==1){
        return false
        }
        o=o.nodeName||o;
    return a.test(o)
    },
replace:function(s,r,p){
    var q=this;
    if(j(r,"array")){
        s=s.cloneNode(true)
        }
        return q.run(r,function(t){
        if(p){
            k(m.grep(t.childNodes),function(o){
                s.appendChild(o)
                })
            }
            return t.parentNode.replaceChild(s,t)
        })
    },
rename:function(r,o){
    var q=this,p;
    if(r.nodeName!=o.toUpperCase()){
        p=q.create(o);
        k(q.getAttribs(r),function(s){
            q.setAttrib(p,s.nodeName,q.getAttrib(r,s.nodeName))
            });
        q.replace(p,r,1)
        }
        return p||r
    },
findCommonAncestor:function(q,o){
    var r=q,p;
    while(r){
        p=o;
        while(p&&r!=p){
            p=p.parentNode
            }
            if(r==p){
            break
        }
        r=r.parentNode
        }
        if(!r&&q.ownerDocument){
        return q.ownerDocument.documentElement
        }
        return r
    },
toHex:function(o){
    var q=/^\s*rgb\s*?\(\s*?([0-9]+)\s*?,\s*?([0-9]+)\s*?,\s*?([0-9]+)\s*?\)\s*$/i.exec(o);
    function p(r){
        r=parseInt(r).toString(16);
        return r.length>1?r:"0"+r
        }
        if(q){
        o="#"+p(q[1])+p(q[2])+p(q[3]);
        return o
        }
        return o
    },
getClasses:function(){
    var s=this,o=[],r,u={},v=s.settings.class_filter,q;
    if(s.classes){
        return s.classes
        }
        function x(t){
        k(t.imports,function(y){
            x(y)
            });
        k(t.cssRules||t.rules,function(y){
            switch(y.type||1){
                case 1:
                    if(y.selectorText){
                    k(y.selectorText.split(","),function(z){
                        z=z.replace(/^\s*|\s*$|^\s\./g,"");
                        if(/\.mce/.test(z)||!/\.[\w\-]+$/.test(z)){
                            return
                        }
                        q=z;
                        z=z.replace(/.*\.([a-z0-9_\-]+).*/i,"$1");
                        if(v&&!(z=v(z,q))){
                            return
                        }
                        if(!u[z]){
                            o.push({
                                "class":z
                            });
                            u[z]=1
                            }
                        })
                }
                break;
            case 3:
                x(y.styleSheet);
                break
                }
            })
}
try{
    k(s.doc.styleSheets,x)
    }catch(p){}
if(o.length>0){
    s.classes=o
    }
    return o
},
run:function(u,r,q){
    var p=this,v;
    if(p.doc&&typeof(u)==="string"){
        u=p.get(u)
        }
        if(!u){
        return false
        }
        q=q||this;
    if(!u.nodeType&&(u.length||u.length===0)){
        v=[];
        k(u,function(s,o){
            if(s){
                if(typeof(s)=="string"){
                    s=p.doc.getElementById(s)
                    }
                    v.push(r.call(q,s,o))
                }
            });
    return v
    }
    return r.call(q,u)
},
getAttribs:function(q){
    var p;
    q=this.get(q);
    if(!q){
        return[]
        }
        if(d){
        p=[];
        if(q.nodeName=="OBJECT"){
            return q.attributes
            }
            if(q.nodeName==="OPTION"&&this.getAttrib(q,"selected")){
            p.push({
                specified:1,
                nodeName:"selected"
            })
            }
            q.cloneNode(false).outerHTML.replace(/<\/?[\w:\-]+ ?|=[\"][^\"]+\"|=\'[^\']+\'|=[\w\-]+|>/gi,"").replace(/[\w:\-]+/gi,function(o){
            p.push({
                specified:1,
                nodeName:o
            })
            });
        return p
        }
        return q.attributes
    },
destroy:function(p){
    var o=this;
    if(o.events){
        o.events.destroy()
        }
        o.win=o.doc=o.root=o.events=null;
    if(!p){
        m.removeUnload(o.destroy)
        }
    },
createRng:function(){
    var o=this.doc;
    return o.createRange?o.createRange():new m.dom.Range(this)
    },
nodeIndex:function(s,t){
    var o=0,q,r,p;
    if(s){
        for(q=s.nodeType,s=s.previousSibling,r=s;s;s=s.previousSibling){
            p=s.nodeType;
            if(t&&p==3){
                if(p==q||!s.nodeValue.length){
                    continue
                }
            }
            o++;
        q=p
        }
        }
    return o
},
split:function(u,s,y){
    var z=this,o=z.createRng(),v,q,x;
    function p(A){
        var t,r=A.childNodes;
        if(A.nodeType==1&&A.getAttribute("_mce_type")=="bookmark"){
            return
        }
        for(t=r.length-1;t>=0;t--){
            p(r[t])
            }
            if(A.nodeType!=9){
            if(A.nodeType==3&&A.nodeValue.length>0){
                return
            }
            if(A.nodeType==1){
                r=A.childNodes;
                if(r.length==1&&r[0]&&r[0].nodeType==1&&r[0].getAttribute("_mce_type")=="bookmark"){
                    A.parentNode.insertBefore(r[0],A)
                    }
                    if(r.length||/^(br|hr|input|img)$/i.test(A.nodeName)){
                    return
                }
            }
            z.remove(A)
        }
        return A
    }
    if(u&&s){
    o.setStart(u.parentNode,z.nodeIndex(u));
    o.setEnd(s.parentNode,z.nodeIndex(s));
    v=o.extractContents();
    o=z.createRng();
    o.setStart(s.parentNode,z.nodeIndex(s)+1);
    o.setEnd(u.parentNode,z.nodeIndex(u)+1);
    q=o.extractContents();
    x=u.parentNode;
    x.insertBefore(p(v),u);
    if(y){
        x.replaceChild(y,s)
        }else{
        x.insertBefore(s,u)
        }
        x.insertBefore(p(q),u);
    z.remove(u);
    return y||s
    }
},
bind:function(s,o,r,q){
    var p=this;
    if(!p.events){
        p.events=new m.dom.EventUtils()
        }
        return p.events.add(s,o,r,q||this)
    },
unbind:function(r,o,q){
    var p=this;
    if(!p.events){
        p.events=new m.dom.EventUtils()
        }
        return p.events.remove(r,o,q)
    },
_findSib:function(r,o,p){
    var q=this,s=o;
    if(r){
        if(j(s,"string")){
            s=function(t){
                return q.is(t,o)
                }
            }
        for(r=r[p];r;r=r[p]){
        if(s(r)){
            return r
            }
        }
    }
return null
},
_isRes:function(o){
    return/^(top|left|bottom|right|width|height)/i.test(o)||/;\s*(top|left|bottom|right|width|height)/i.test(o)
    }
});
m.DOM=new m.dom.DOMUtils(document,{
    process_html:0
})
})(tinymce);
(function(a){
    function b(c){
        var N=this,e=c.doc,S=0,E=1,j=2,D=true,R=false,U="startOffset",h="startContainer",P="endContainer",z="endOffset",k=tinymce.extend,n=c.nodeIndex;
        k(N,{
            startContainer:e,
            startOffset:0,
            endContainer:e,
            endOffset:0,
            collapsed:D,
            commonAncestorContainer:e,
            START_TO_START:0,
            START_TO_END:1,
            END_TO_END:2,
            END_TO_START:3,
            setStart:q,
            setEnd:s,
            setStartBefore:g,
            setStartAfter:I,
            setEndBefore:J,
            setEndAfter:u,
            collapse:A,
            selectNode:x,
            selectNodeContents:F,
            compareBoundaryPoints:v,
            deleteContents:p,
            extractContents:H,
            cloneContents:d,
            insertNode:C,
            surroundContents:M,
            cloneRange:K
        });
        function q(V,t){
            B(D,V,t)
            }
            function s(V,t){
            B(R,V,t)
            }
            function g(t){
            q(t.parentNode,n(t))
            }
            function I(t){
            q(t.parentNode,n(t)+1)
            }
            function J(t){
            s(t.parentNode,n(t))
            }
            function u(t){
            s(t.parentNode,n(t)+1)
            }
            function A(t){
            if(t){
                N[P]=N[h];
                N[z]=N[U]
                }else{
                N[h]=N[P];
                N[U]=N[z]
                }
                N.collapsed=D
            }
            function x(t){
            g(t);
            u(t)
            }
            function F(t){
            q(t,0);
            s(t,t.nodeType===1?t.childNodes.length:t.nodeValue.length)
            }
            function v(W,X){
            var Z=N[h],Y=N[U],V=N[P],t=N[z];
            if(W===0){
                return G(Z,Y,Z,Y)
                }
                if(W===1){
                return G(Z,Y,V,t)
                }
                if(W===2){
                return G(V,t,V,t)
                }
                if(W===3){
                return G(V,t,Z,Y)
                }
            }
        function p(){
        m(j)
        }
        function H(){
        return m(S)
        }
        function d(){
        return m(E)
        }
        function C(Y){
        var V=this[h],t=this[U],X,W;
        if((V.nodeType===3||V.nodeType===4)&&V.nodeValue){
            if(!t){
                V.parentNode.insertBefore(Y,V)
                }else{
                if(t>=V.nodeValue.length){
                    c.insertAfter(Y,V)
                    }else{
                    X=V.splitText(t);
                    V.parentNode.insertBefore(Y,X)
                    }
                }
        }else{
    if(V.childNodes.length>0){
        W=V.childNodes[t]
        }
        if(W){
        V.insertBefore(Y,W)
        }else{
        V.appendChild(Y)
        }
    }
}
function M(V){
    var t=N.extractContents();
    N.insertNode(V);
    V.appendChild(t);
    N.selectNode(V)
    }
    function K(){
    return k(new b(c),{
        startContainer:N[h],
        startOffset:N[U],
        endContainer:N[P],
        endOffset:N[z],
        collapsed:N.collapsed,
        commonAncestorContainer:N.commonAncestorContainer
        })
    }
    function O(t,V){
    var W;
    if(t.nodeType==3){
        return t
        }
        if(V<0){
        return t
        }
        W=t.firstChild;
    while(W&&V>0){
        --V;
        W=W.nextSibling
        }
        if(W){
        return W
        }
        return t
    }
    function l(){
    return(N[h]==N[P]&&N[U]==N[z])
    }
    function G(X,Z,V,Y){
    var aa,W,t,ab,ad,ac;
    if(X==V){
        if(Z==Y){
            return 0
            }
            if(Z<Y){
            return -1
            }
            return 1
        }
        aa=V;
    while(aa&&aa.parentNode!=X){
        aa=aa.parentNode
        }
        if(aa){
        W=0;
        t=X.firstChild;
        while(t!=aa&&W<Z){
            W++;
            t=t.nextSibling
            }
            if(Z<=W){
            return -1
            }
            return 1
        }
        aa=X;
    while(aa&&aa.parentNode!=V){
        aa=aa.parentNode
        }
        if(aa){
        W=0;
        t=V.firstChild;
        while(t!=aa&&W<Y){
            W++;
            t=t.nextSibling
            }
            if(W<Y){
            return -1
            }
            return 1
        }
        ab=c.findCommonAncestor(X,V);
    ad=X;
    while(ad&&ad.parentNode!=ab){
        ad=ad.parentNode
        }
        if(!ad){
        ad=ab
        }
        ac=V;
    while(ac&&ac.parentNode!=ab){
        ac=ac.parentNode
        }
        if(!ac){
        ac=ab
        }
        if(ad==ac){
        return 0
        }
        t=ab.firstChild;
    while(t){
        if(t==ad){
            return -1
            }
            if(t==ac){
            return 1
            }
            t=t.nextSibling
        }
    }
function B(V,Y,X){
    var t,W;
    if(V){
        N[h]=Y;
        N[U]=X
        }else{
        N[P]=Y;
        N[z]=X
        }
        t=N[P];
    while(t.parentNode){
        t=t.parentNode
        }
        W=N[h];
    while(W.parentNode){
        W=W.parentNode
        }
        if(W==t){
        if(G(N[h],N[U],N[P],N[z])>0){
            N.collapse(V)
            }
        }else{
    N.collapse(V)
    }
    N.collapsed=l();
N.commonAncestorContainer=c.findCommonAncestor(N[h],N[P])
}
function m(ab){
    var aa,X=0,ad=0,V,Z,W,Y,t,ac;
    if(N[h]==N[P]){
        return f(ab)
        }
        for(aa=N[P],V=aa.parentNode;V;aa=V,V=V.parentNode){
        if(V==N[h]){
            return r(aa,ab)
            }
            ++X
        }
        for(aa=N[h],V=aa.parentNode;V;aa=V,V=V.parentNode){
        if(V==N[P]){
            return T(aa,ab)
            }
            ++ad
        }
        Z=ad-X;
    W=N[h];
    while(Z>0){
        W=W.parentNode;
        Z--
    }
    Y=N[P];
    while(Z<0){
        Y=Y.parentNode;
        Z++
    }
    for(t=W.parentNode,ac=Y.parentNode;t!=ac;t=t.parentNode,ac=ac.parentNode){
        W=t;
        Y=ac
        }
        return o(W,Y,ab)
    }
    function f(Z){
    var ab,Y,X,aa,t,W,V;
    if(Z!=j){
        ab=e.createDocumentFragment()
        }
        if(N[U]==N[z]){
        return ab
        }
        if(N[h].nodeType==3){
        Y=N[h].nodeValue;
        X=Y.substring(N[U],N[z]);
        if(Z!=E){
            N[h].deleteData(N[U],N[z]-N[U]);
            N.collapse(D)
            }
            if(Z==j){
            return
        }
        ab.appendChild(e.createTextNode(X));
        return ab
        }
        aa=O(N[h],N[U]);
    t=N[z]-N[U];
    while(t>0){
        W=aa.nextSibling;
        V=y(aa,Z);
        if(ab){
            ab.appendChild(V)
            }
            --t;
        aa=W
        }
        if(Z!=E){
        N.collapse(D)
        }
        return ab
    }
    function r(ab,Y){
    var aa,Z,V,t,X,W;
    if(Y!=j){
        aa=e.createDocumentFragment()
        }
        Z=i(ab,Y);
    if(aa){
        aa.appendChild(Z)
        }
        V=n(ab);
    t=V-N[U];
    if(t<=0){
        if(Y!=E){
            N.setEndBefore(ab);
            N.collapse(R)
            }
            return aa
        }
        Z=ab.previousSibling;
    while(t>0){
        X=Z.previousSibling;
        W=y(Z,Y);
        if(aa){
            aa.insertBefore(W,aa.firstChild)
            }
            --t;
        Z=X
        }
        if(Y!=E){
        N.setEndBefore(ab);
        N.collapse(R)
        }
        return aa
    }
    function T(Z,Y){
    var ab,V,aa,t,X,W;
    if(Y!=j){
        ab=e.createDocumentFragment()
        }
        aa=Q(Z,Y);
    if(ab){
        ab.appendChild(aa)
        }
        V=n(Z);
    ++V;
    t=N[z]-V;
    aa=Z.nextSibling;
    while(t>0){
        X=aa.nextSibling;
        W=y(aa,Y);
        if(ab){
            ab.appendChild(W)
            }
            --t;
        aa=X
        }
        if(Y!=E){
        N.setStartAfter(Z);
        N.collapse(D)
        }
        return ab
    }
    function o(Z,t,ac){
    var W,ae,Y,aa,ab,V,ad,X;
    if(ac!=j){
        ae=e.createDocumentFragment()
        }
        W=Q(Z,ac);
    if(ae){
        ae.appendChild(W)
        }
        Y=Z.parentNode;
    aa=n(Z);
    ab=n(t);
    ++aa;
    V=ab-aa;
    ad=Z.nextSibling;
    while(V>0){
        X=ad.nextSibling;
        W=y(ad,ac);
        if(ae){
            ae.appendChild(W)
            }
            ad=X;
        --V
        }
        W=i(t,ac);
    if(ae){
        ae.appendChild(W)
        }
        if(ac!=E){
        N.setStartAfter(Z);
        N.collapse(D)
        }
        return ae
    }
    function i(aa,ab){
    var W=O(N[P],N[z]-1),ac,Z,Y,t,V,X=W!=N[P];
    if(W==aa){
        return L(W,X,R,ab)
        }
        ac=W.parentNode;
    Z=L(ac,R,R,ab);
    while(ac){
        while(W){
            Y=W.previousSibling;
            t=L(W,X,R,ab);
            if(ab!=j){
                Z.insertBefore(t,Z.firstChild)
                }
                X=D;
            W=Y
            }
            if(ac==aa){
            return Z
            }
            W=ac.previousSibling;
        ac=ac.parentNode;
        V=L(ac,R,R,ab);
        if(ab!=j){
            V.appendChild(Z)
            }
            Z=V
        }
    }
function Q(aa,ab){
    var X=O(N[h],N[U]),Y=X!=N[h],ac,Z,W,t,V;
    if(X==aa){
        return L(X,Y,D,ab)
        }
        ac=X.parentNode;
    Z=L(ac,R,D,ab);
    while(ac){
        while(X){
            W=X.nextSibling;
            t=L(X,Y,D,ab);
            if(ab!=j){
                Z.appendChild(t)
                }
                Y=D;
            X=W
            }
            if(ac==aa){
            return Z
            }
            X=ac.nextSibling;
        ac=ac.parentNode;
        V=L(ac,R,D,ab);
        if(ab!=j){
            V.appendChild(Z)
            }
            Z=V
        }
    }
function L(t,Y,ab,ac){
    var X,W,Z,V,aa;
    if(Y){
        return y(t,ac)
        }
        if(t.nodeType==3){
        X=t.nodeValue;
        if(ab){
            V=N[U];
            W=X.substring(V);
            Z=X.substring(0,V)
            }else{
            V=N[z];
            W=X.substring(0,V);
            Z=X.substring(V)
            }
            if(ac!=E){
            t.nodeValue=Z
            }
            if(ac==j){
            return
        }
        aa=t.cloneNode(R);
        aa.nodeValue=W;
        return aa
        }
        if(ac==j){
        return
    }
    return t.cloneNode(R)
    }
    function y(V,t){
    if(t!=j){
        return t==E?V.cloneNode(D):V
        }
        V.parentNode.removeChild(V)
    }
}
a.Range=b
})(tinymce.dom);
(function(){
    function a(g){
        var i=this,j="\uFEFF",e,h,d=g.dom,c=true,f=false;
        function b(){
            var n=g.getRng(),k=d.createRng(),m,o;
            m=n.item?n.item(0):n.parentElement();
            if(m.ownerDocument!=d.doc){
                return k
                }
                if(n.item||!m.hasChildNodes()){
                k.setStart(m.parentNode,d.nodeIndex(m));
                k.setEnd(k.startContainer,k.startOffset+1);
                return k
                }
                o=g.isCollapsed();
            function l(s){
                var u,q,t,p,A=0,x,y,z,r,v;
                r=n.duplicate();
                r.collapse(s);
                u=d.create("a");
                z=r.parentElement();
                if(!z.hasChildNodes()){
                    k[s?"setStart":"setEnd"](z,0);
                    return
                }
                z.appendChild(u);
                r.moveToElementText(u);
                v=n.compareEndPoints(s?"StartToStart":"EndToEnd",r);
                if(v>0){
                    k[s?"setStartAfter":"setEndAfter"](z);
                    d.remove(u);
                    return
                }
                p=tinymce.grep(z.childNodes);
                x=p.length-1;
                while(A<=x){
                    y=Math.floor((A+x)/2);
                    z.insertBefore(u,p[y]);
                    r.moveToElementText(u);
                    v=n.compareEndPoints(s?"StartToStart":"EndToEnd",r);
                    if(v>0){
                        A=y+1
                        }else{
                        if(v<0){
                            x=y-1
                            }else{
                            found=true;
                            break
                        }
                    }
                }
            q=v>0||y==0?u.nextSibling:u.previousSibling;
        if(q.nodeType==1){
            d.remove(u);
            t=d.nodeIndex(q);
            q=q.parentNode;
            if(!s||y>0){
                t++
            }
        }else{
        if(v>0||y==0){
            r.setEndPoint(s?"StartToStart":"EndToEnd",n);
            t=r.text.length
            }else{
            r.setEndPoint(s?"StartToStart":"EndToEnd",n);
            t=q.nodeValue.length-r.text.length
            }
            d.remove(u)
        }
        k[s?"setStart":"setEnd"](q,t)
    }
    l(true);
    if(!o){
    l()
    }
    return k
}
this.addRange=function(k){
    var p,n,m,r,u,s,t=g.dom.doc,o=t.body;
    function l(B){
        var x,A,v,z,y;
        v=d.create("a");
        x=B?m:u;
        A=B?r:s;
        z=p.duplicate();
        if(x==t){
            x=o;
            A=0
            }
            if(x.nodeType==3){
            x.parentNode.insertBefore(v,x);
            z.moveToElementText(v);
            z.moveStart("character",A);
            d.remove(v);
            p.setEndPoint(B?"StartToStart":"EndToEnd",z)
            }else{
            y=x.childNodes;
            if(y.length){
                if(A>=y.length){
                    d.insertAfter(v,y[y.length-1])
                    }else{
                    x.insertBefore(v,y[A])
                    }
                    z.moveToElementText(v)
                }else{
                v=t.createTextNode(j);
                x.appendChild(v);
                z.moveToElementText(v.parentNode);
                z.collapse(c)
                }
                p.setEndPoint(B?"StartToStart":"EndToEnd",z);
            d.remove(v)
            }
        }
    this.destroy();
    m=k.startContainer;
    r=k.startOffset;
    u=k.endContainer;
    s=k.endOffset;
    p=o.createTextRange();
    if(m==u&&m.nodeType==1&&r==s-1){
    if(r==s-1){
        try{
            n=o.createControlRange();
            n.addElement(m.childNodes[r]);
            n.select();
            n.scrollIntoView();
            return
        }catch(q){}
    }
}
l(true);
l();
p.select();
p.scrollIntoView()
};

this.getRangeAt=function(){
    if(!e||!tinymce.dom.RangeUtils.compareRanges(h,g.getRng())){
        e=b();
        h=g.getRng()
        }
        try{
        e.startContainer.nextSibling
        }catch(k){
        e=b();
        h=null
        }
        return e
    };

this.destroy=function(){
    h=e=null
    };

if(g.dom.boxModel){
    (function(){
        var q=d.doc,l=q.body,n,o;
        q.documentElement.unselectable=c;
        function p(r,u){
            var s=l.createTextRange();
            try{
                s.moveToPoint(r,u)
                }catch(t){
                s=null
                }
                return s
            }
            function m(s){
            var r;
            if(s.button){
                r=p(s.x,s.y);
                if(r){
                    if(r.compareEndPoints("StartToStart",o)>0){
                        r.setEndPoint("StartToStart",o)
                        }else{
                        r.setEndPoint("EndToEnd",o)
                        }
                        r.select()
                    }
                }else{
            k()
            }
        }
    function k(){
        d.unbind(q,"mouseup",k);
        d.unbind(q,"mousemove",m);
        n=0
        }
        d.bind(q,"mousedown",function(r){
        if(r.target.nodeName==="HTML"){
            if(n){
                k()
                }
                n=1;
            o=p(r.x,r.y);
            if(o){
                d.bind(q,"mouseup",k);
                d.bind(q,"mousemove",m);
                o.select()
                }
            }
    })
})()
}
}
tinymce.dom.TridentSelection=a
})();
(function(){
    var p=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,j=0,d=Object.prototype.toString,o=false,i=true;
    [0,0].sort(function(){
        i=false;
        return 0
        });
    var b=function(v,e,z,A){
        z=z||[];
        e=e||document;
        var C=e;
        if(e.nodeType!==1&&e.nodeType!==9){
            return[]
            }
            if(!v||typeof v!=="string"){
            return z
            }
            var x=[],s,E,H,r,u=true,t=b.isXML(e),B=v,D,G,F,y;
        do{
            p.exec("");
            s=p.exec(B);
            if(s){
                B=s[3];
                x.push(s[1]);
                if(s[2]){
                    r=s[3];
                    break
                }
            }
        }while(s);
    if(x.length>1&&k.exec(v)){
    if(x.length===2&&f.relative[x[0]]){
        E=h(x[0]+x[1],e)
        }else{
        E=f.relative[x[0]]?[e]:b(x.shift(),e);
        while(x.length){
            v=x.shift();
            if(f.relative[v]){
                v+=x.shift()
                }
                E=h(v,E)
            }
        }
}else{
    if(!A&&x.length>1&&e.nodeType===9&&!t&&f.match.ID.test(x[0])&&!f.match.ID.test(x[x.length-1])){
        D=b.find(x.shift(),e,t);
        e=D.expr?b.filter(D.expr,D.set)[0]:D.set[0]
        }
        if(e){
        D=A?{
            expr:x.pop(),
            set:a(A)
            }:b.find(x.pop(),x.length===1&&(x[0]==="~"||x[0]==="+")&&e.parentNode?e.parentNode:e,t);
        E=D.expr?b.filter(D.expr,D.set):D.set;
        if(x.length>0){
            H=a(E)
            }else{
            u=false
            }while(x.length){
            G=x.pop();
            F=G;
            if(!f.relative[G]){
                G=""
                }else{
                F=x.pop()
                }
                if(F==null){
                F=e
                }
                f.relative[G](H,F,t)
            }
        }else{
    H=x=[]
    }
}
if(!H){
    H=E
    }
    if(!H){
    b.error(G||v)
    }
    if(d.call(H)==="[object Array]"){
    if(!u){
        z.push.apply(z,H)
        }else{
        if(e&&e.nodeType===1){
            for(y=0;H[y]!=null;y++){
                if(H[y]&&(H[y]===true||H[y].nodeType===1&&b.contains(e,H[y]))){
                    z.push(E[y])
                    }
                }
            }else{
    for(y=0;H[y]!=null;y++){
        if(H[y]&&H[y].nodeType===1){
            z.push(E[y])
            }
        }
    }
}
}else{
    a(H,z)
    }
    if(r){
    b(r,C,z,A);
    b.uniqueSort(z)
    }
    return z
};

b.uniqueSort=function(r){
    if(c){
        o=i;
        r.sort(c);
        if(o){
            for(var e=1;e<r.length;e++){
                if(r[e]===r[e-1]){
                    r.splice(e--,1)
                    }
                }
            }
    }
return r
};

b.matches=function(e,r){
    return b(e,null,null,r)
    };

b.find=function(y,e,z){
    var x;
    if(!y){
        return[]
        }
        for(var t=0,s=f.order.length;t<s;t++){
        var v=f.order[t],u;
        if((u=f.leftMatch[v].exec(y))){
            var r=u[1];
            u.splice(1,1);
            if(r.substr(r.length-1)!=="\\"){
                u[1]=(u[1]||"").replace(/\\/g,"");
                x=f.find[v](u,e,z);
                if(x!=null){
                    y=y.replace(f.match[v],"");
                    break
                }
            }
        }
    }
if(!x){
    x=e.getElementsByTagName("*")
    }
    return{
    set:x,
    expr:y
}
};

b.filter=function(C,B,F,u){
    var s=C,H=[],z=B,x,e,y=B&&B[0]&&b.isXML(B[0]);
    while(C&&B.length){
        for(var A in f.filter){
            if((x=f.leftMatch[A].exec(C))!=null&&x[2]){
                var r=f.filter[A],G,E,t=x[1];
                e=false;
                x.splice(1,1);
                if(t.substr(t.length-1)==="\\"){
                    continue
                }
                if(z===H){
                    H=[]
                    }
                    if(f.preFilter[A]){
                    x=f.preFilter[A](x,z,F,H,u,y);
                    if(!x){
                        e=G=true
                        }else{
                        if(x===true){
                            continue
                        }
                    }
                }
            if(x){
            for(var v=0;(E=z[v])!=null;v++){
                if(E){
                    G=r(E,x,v,z);
                    var D=u^!!G;
                    if(F&&G!=null){
                        if(D){
                            e=true
                            }else{
                            z[v]=false
                            }
                        }else{
                    if(D){
                        H.push(E);
                        e=true
                        }
                    }
            }
        }
        }
    if(G!==undefined){
    if(!F){
        z=H
        }
        C=C.replace(f.match[A],"");
    if(!e){
        return[]
        }
        break
}
}
}
if(C===s){
    if(e==null){
        b.error(C)
        }else{
        break
    }
}
s=C
}
return z
};

b.error=function(e){
    throw"Syntax error, unrecognized expression: "+e
    };

var f=b.selectors={
    order:["ID","NAME","TAG"],
    match:{
        ID:/#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
        CLASS:/\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
        NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,
        ATTR:/\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,
        TAG:/^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,
        CHILD:/:(only|nth|last|first)-child(?:\((even|odd|[\dn+\-]*)\))?/,
        POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,
        PSEUDO:/:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/
    },
    leftMatch:{},
    attrMap:{
        "class":"className",
        "for":"htmlFor"
    },
    attrHandle:{
        href:function(e){
            return e.getAttribute("href")
            }
        },
relative:{
    "+":function(x,r){
        var t=typeof r==="string",v=t&&!/\W/.test(r),y=t&&!v;
        if(v){
            r=r.toLowerCase()
            }
            for(var s=0,e=x.length,u;s<e;s++){
            if((u=x[s])){
                while((u=u.previousSibling)&&u.nodeType!==1){}
                x[s]=y||u&&u.nodeName.toLowerCase()===r?u||false:u===r
                }
            }
        if(y){
        b.filter(r,x,true)
        }
    },
">":function(x,r){
    var u=typeof r==="string",v,s=0,e=x.length;
    if(u&&!/\W/.test(r)){
        r=r.toLowerCase();
        for(;s<e;s++){
            v=x[s];
            if(v){
                var t=v.parentNode;
                x[s]=t.nodeName.toLowerCase()===r?t:false
                }
            }
        }else{
    for(;s<e;s++){
        v=x[s];
        if(v){
            x[s]=u?v.parentNode:v.parentNode===r
            }
        }
    if(u){
    b.filter(r,x,true)
    }
}
},
"":function(t,r,v){
    var s=j++,e=q,u;
    if(typeof r==="string"&&!/\W/.test(r)){
        r=r.toLowerCase();
        u=r;
        e=n
        }
        e("parentNode",r,s,t,u,v)
    },
"~":function(t,r,v){
    var s=j++,e=q,u;
    if(typeof r==="string"&&!/\W/.test(r)){
        r=r.toLowerCase();
        u=r;
        e=n
        }
        e("previousSibling",r,s,t,u,v)
    }
},
find:{
    ID:function(r,s,t){
        if(typeof s.getElementById!=="undefined"&&!t){
            var e=s.getElementById(r[1]);
            return e?[e]:[]
            }
        },
NAME:function(s,v){
    if(typeof v.getElementsByName!=="undefined"){
        var r=[],u=v.getElementsByName(s[1]);
        for(var t=0,e=u.length;t<e;t++){
            if(u[t].getAttribute("name")===s[1]){
                r.push(u[t])
                }
            }
        return r.length===0?null:r
    }
},
TAG:function(e,r){
    return r.getElementsByTagName(e[1])
    }
},
preFilter:{
    CLASS:function(t,r,s,e,x,y){
        t=" "+t[1].replace(/\\/g,"")+" ";
        if(y){
            return t
            }
            for(var u=0,v;(v=r[u])!=null;u++){
            if(v){
                if(x^(v.className&&(" "+v.className+" ").replace(/[\t\n]/g," ").indexOf(t)>=0)){
                    if(!s){
                        e.push(v)
                        }
                    }else{
                if(s){
                    r[u]=false
                    }
                }
        }
    }
return false
},
ID:function(e){
    return e[1].replace(/\\/g,"")
    },
TAG:function(r,e){
    return r[1].toLowerCase()
    },
CHILD:function(e){
    if(e[1]==="nth"){
        var r=/(-?)(\d*)n((?:\+|-)?\d*)/.exec(e[2]==="even"&&"2n"||e[2]==="odd"&&"2n+1"||!/\D/.test(e[2])&&"0n+"+e[2]||e[2]);
        e[2]=(r[1]+(r[2]||1))-0;
        e[3]=r[3]-0
    }
    e[0]=j++;
    return e
    },
ATTR:function(u,r,s,e,v,x){
    var t=u[1].replace(/\\/g,"");
    if(!x&&f.attrMap[t]){
        u[1]=f.attrMap[t]
        }
        if(u[2]==="~="){
        u[4]=" "+u[4]+" "
        }
        return u
    },
PSEUDO:function(u,r,s,e,v){
    if(u[1]==="not"){
        if((p.exec(u[3])||"").length>1||/^\w/.test(u[3])){
            u[3]=b(u[3],null,null,r)
            }else{
            var t=b.filter(u[3],r,s,true^v);
            if(!s){
                e.push.apply(e,t)
                }
                return false
            }
        }else{
    if(f.match.POS.test(u[0])||f.match.CHILD.test(u[0])){
        return true
        }
    }
return u
},
POS:function(e){
    e.unshift(true);
    return e
    }
},
filters:{
    enabled:function(e){
        return e.disabled===false&&e.type!=="hidden"
        },
    disabled:function(e){
        return e.disabled===true
        },
    checked:function(e){
        return e.checked===true
        },
    selected:function(e){
        e.parentNode.selectedIndex;
        return e.selected===true
        },
    parent:function(e){
        return !!e.firstChild
        },
    empty:function(e){
        return !e.firstChild
        },
    has:function(s,r,e){
        return !!b(e[3],s).length
        },
    header:function(e){
        return(/h\d/i).test(e.nodeName)
        },
    text:function(e){
        return"text"===e.type
        },
    radio:function(e){
        return"radio"===e.type
        },
    checkbox:function(e){
        return"checkbox"===e.type
        },
    file:function(e){
        return"file"===e.type
        },
    password:function(e){
        return"password"===e.type
        },
    submit:function(e){
        return"submit"===e.type
        },
    image:function(e){
        return"image"===e.type
        },
    reset:function(e){
        return"reset"===e.type
        },
    button:function(e){
        return"button"===e.type||e.nodeName.toLowerCase()==="button"
        },
    input:function(e){
        return(/input|select|textarea|button/i).test(e.nodeName)
        }
    },
setFilters:{
    first:function(r,e){
        return e===0
        },
    last:function(s,r,e,t){
        return r===t.length-1
        },
    even:function(r,e){
        return e%2===0
        },
    odd:function(r,e){
        return e%2===1
        },
    lt:function(s,r,e){
        return r<e[3]-0
        },
    gt:function(s,r,e){
        return r>e[3]-0
        },
    nth:function(s,r,e){
        return e[3]-0===r
        },
    eq:function(s,r,e){
        return e[3]-0===r
        }
    },
filter:{
    PSEUDO:function(s,y,x,z){
        var e=y[1],r=f.filters[e];
        if(r){
            return r(s,x,y,z)
            }else{
            if(e==="contains"){
                return(s.textContent||s.innerText||b.getText([s])||"").indexOf(y[3])>=0
                }else{
                if(e==="not"){
                    var t=y[3];
                    for(var v=0,u=t.length;v<u;v++){
                        if(t[v]===s){
                            return false
                            }
                        }
                    return true
                }else{
                b.error("Syntax error, unrecognized expression: "+e)
                }
            }
    }
},
CHILD:function(e,t){
    var x=t[1],r=e;
    switch(x){
        case"only":case"first":
            while((r=r.previousSibling)){
            if(r.nodeType===1){
                return false
                }
            }
        if(x==="first"){
            return true
            }
            r=e;
    case"last":
        while((r=r.nextSibling)){
        if(r.nodeType===1){
            return false
            }
        }
    return true;
case"nth":
    var s=t[2],A=t[3];
    if(s===1&&A===0){
    return true
    }
    var v=t[0],z=e.parentNode;
if(z&&(z.sizcache!==v||!e.nodeIndex)){
    var u=0;
    for(r=z.firstChild;r;r=r.nextSibling){
        if(r.nodeType===1){
            r.nodeIndex=++u
            }
        }
    z.sizcache=v
}
var y=e.nodeIndex-A;
if(s===0){
    return y===0
    }else{
    return(y%s===0&&y/s>=0)
    }
}
},
ID:function(r,e){
    return r.nodeType===1&&r.getAttribute("id")===e
    },
TAG:function(r,e){
    return(e==="*"&&r.nodeType===1)||r.nodeName.toLowerCase()===e
    },
CLASS:function(r,e){
    return(" "+(r.className||r.getAttribute("class"))+" ").indexOf(e)>-1
    },
ATTR:function(v,t){
    var s=t[1],e=f.attrHandle[s]?f.attrHandle[s](v):v[s]!=null?v[s]:v.getAttribute(s),x=e+"",u=t[2],r=t[4];
    return e==null?u==="!=":u==="="?x===r:u==="*="?x.indexOf(r)>=0:u==="~="?(" "+x+" ").indexOf(r)>=0:!r?x&&e!==false:u==="!="?x!==r:u==="^="?x.indexOf(r)===0:u==="$="?x.substr(x.length-r.length)===r:u==="|="?x===r||x.substr(0,r.length+1)===r+"-":false
    },
POS:function(u,r,s,v){
    var e=r[2],t=f.setFilters[e];
    if(t){
        return t(u,s,r,v)
        }
    }
}
};

var k=f.match.POS,g=function(r,e){
    return"\\"+(e-0+1)
    };

for(var m in f.match){
    f.match[m]=new RegExp(f.match[m].source+(/(?![^\[]*\])(?![^\(]*\))/.source));
    f.leftMatch[m]=new RegExp(/(^(?:.|\r|\n)*?)/.source+f.match[m].source.replace(/\\(\d+)/g,g))
    }
    var a=function(r,e){
    r=Array.prototype.slice.call(r,0);
    if(e){
        e.push.apply(e,r);
        return e
        }
        return r
    };

try{
    Array.prototype.slice.call(document.documentElement.childNodes,0)[0].nodeType
    }catch(l){
    a=function(u,t){
        var r=t||[],s=0;
        if(d.call(u)==="[object Array]"){
            Array.prototype.push.apply(r,u)
            }else{
            if(typeof u.length==="number"){
                for(var e=u.length;s<e;s++){
                    r.push(u[s])
                    }
                }else{
            for(;u[s];s++){
                r.push(u[s])
                }
            }
        }
return r
}
}
var c;
if(document.documentElement.compareDocumentPosition){
    c=function(r,e){
        if(!r.compareDocumentPosition||!e.compareDocumentPosition){
            if(r==e){
                o=true
                }
                return r.compareDocumentPosition?-1:1
            }
            var s=r.compareDocumentPosition(e)&4?-1:r===e?0:1;
        if(s===0){
            o=true
            }
            return s
        }
    }else{
    if("sourceIndex" in document.documentElement){
        c=function(r,e){
            if(!r.sourceIndex||!e.sourceIndex){
                if(r==e){
                    o=true
                    }
                    return r.sourceIndex?-1:1
                }
                var s=r.sourceIndex-e.sourceIndex;
            if(s===0){
                o=true
                }
                return s
            }
        }else{
    if(document.createRange){
        c=function(t,r){
            if(!t.ownerDocument||!r.ownerDocument){
                if(t==r){
                    o=true
                    }
                    return t.ownerDocument?-1:1
                }
                var s=t.ownerDocument.createRange(),e=r.ownerDocument.createRange();
            s.setStart(t,0);
            s.setEnd(t,0);
            e.setStart(r,0);
            e.setEnd(r,0);
            var u=s.compareBoundaryPoints(Range.START_TO_END,e);
            if(u===0){
                o=true
                }
                return u
            }
        }
}
}
b.getText=function(e){
    var r="",t;
    for(var s=0;e[s];s++){
        t=e[s];
        if(t.nodeType===3||t.nodeType===4){
            r+=t.nodeValue
            }else{
            if(t.nodeType!==8){
                r+=b.getText(t.childNodes)
                }
            }
    }
    return r
};
(function(){
    var r=document.createElement("div"),s="script"+(new Date()).getTime();
    r.innerHTML="<a name='"+s+"'/>";
    var e=document.documentElement;
    e.insertBefore(r,e.firstChild);
    if(document.getElementById(s)){
        f.find.ID=function(u,v,x){
            if(typeof v.getElementById!=="undefined"&&!x){
                var t=v.getElementById(u[1]);
                return t?t.id===u[1]||typeof t.getAttributeNode!=="undefined"&&t.getAttributeNode("id").nodeValue===u[1]?[t]:undefined:[]
                }
            };

    f.filter.ID=function(v,t){
        var u=typeof v.getAttributeNode!=="undefined"&&v.getAttributeNode("id");
        return v.nodeType===1&&u&&u.nodeValue===t
        }
    }
e.removeChild(r);
e=r=null
})();
(function(){
    var e=document.createElement("div");
    e.appendChild(document.createComment(""));
    if(e.getElementsByTagName("*").length>0){
        f.find.TAG=function(r,v){
            var u=v.getElementsByTagName(r[1]);
            if(r[1]==="*"){
                var t=[];
                for(var s=0;u[s];s++){
                    if(u[s].nodeType===1){
                        t.push(u[s])
                        }
                    }
                u=t
            }
            return u
        }
    }
e.innerHTML="<a href='#'></a>";
if(e.firstChild&&typeof e.firstChild.getAttribute!=="undefined"&&e.firstChild.getAttribute("href")!=="#"){
    f.attrHandle.href=function(r){
        return r.getAttribute("href",2)
        }
    }
e=null
})();
if(document.querySelectorAll){
    (function(){
        var e=b,s=document.createElement("div");
        s.innerHTML="<p class='TEST'></p>";
        if(s.querySelectorAll&&s.querySelectorAll(".TEST").length===0){
            return
        }
        b=function(x,v,t,u){
            v=v||document;
            if(!u&&v.nodeType===9&&!b.isXML(v)){
                try{
                    return a(v.querySelectorAll(x),t)
                    }catch(y){}
            }
            return e(x,v,t,u)
        };

    for(var r in e){
        b[r]=e[r]
        }
        s=null
    })()
}(function(){
    var e=document.createElement("div");
    e.innerHTML="<div class='test e'></div><div class='test'></div>";
    if(!e.getElementsByClassName||e.getElementsByClassName("e").length===0){
        return
    }
    e.lastChild.className="e";
    if(e.getElementsByClassName("e").length===1){
        return
    }
    f.order.splice(1,0,"CLASS");
    f.find.CLASS=function(r,s,t){
        if(typeof s.getElementsByClassName!=="undefined"&&!t){
            return s.getElementsByClassName(r[1])
            }
        };

e=null
})();
function n(r,x,v,A,y,z){
    for(var t=0,s=A.length;t<s;t++){
        var e=A[t];
        if(e){
            e=e[r];
            var u=false;
            while(e){
                if(e.sizcache===v){
                    u=A[e.sizset];
                    break
                }
                if(e.nodeType===1&&!z){
                    e.sizcache=v;
                    e.sizset=t
                    }
                    if(e.nodeName.toLowerCase()===x){
                    u=e;
                    break
                }
                e=e[r]
                }
                A[t]=u
            }
        }
    }
function q(r,x,v,A,y,z){
    for(var t=0,s=A.length;t<s;t++){
        var e=A[t];
        if(e){
            e=e[r];
            var u=false;
            while(e){
                if(e.sizcache===v){
                    u=A[e.sizset];
                    break
                }
                if(e.nodeType===1){
                    if(!z){
                        e.sizcache=v;
                        e.sizset=t
                        }
                        if(typeof x!=="string"){
                        if(e===x){
                            u=true;
                            break
                        }
                    }else{
                    if(b.filter(x,[e]).length>0){
                        u=e;
                        break
                    }
                }
            }
        e=e[r]
    }
    A[t]=u
    }
}
}
b.contains=document.compareDocumentPosition?function(r,e){
    return !!(r.compareDocumentPosition(e)&16)
    }:function(r,e){
    return r!==e&&(r.contains?r.contains(e):true)
    };

b.isXML=function(e){
    var r=(e?e.ownerDocument||e:0).documentElement;
    return r?r.nodeName!=="HTML":false
    };

var h=function(e,y){
    var t=[],u="",v,s=y.nodeType?[y]:y;
    while((v=f.match.PSEUDO.exec(e))){
        u+=v[0];
        e=e.replace(f.match.PSEUDO,"")
        }
        e=f.relative[e]?e+"*":e;
    for(var x=0,r=s.length;x<r;x++){
        b(e,s[x],t)
        }
        return b.filter(u,t)
    };

window.tinymce.dom.Sizzle=b
})();
(function(d){
    var f=d.each,c=d.DOM,b=d.isIE,e=d.isWebKit,a;
    d.create("tinymce.dom.EventUtils",{
        EventUtils:function(){
            this.inits=[];
            this.events=[]
            },
        add:function(m,p,l,j){
            var g,h=this,i=h.events,k;
            if(p instanceof Array){
                k=[];
                f(p,function(o){
                    k.push(h.add(m,o,l,j))
                    });
                return k
                }
                if(m&&m.hasOwnProperty&&m instanceof Array){
                k=[];
                f(m,function(n){
                    n=c.get(n);
                    k.push(h.add(n,p,l,j))
                    });
                return k
                }
                m=c.get(m);
            if(!m){
                return
            }
            g=function(n){
                if(h.disabled){
                    return
                }
                n=n||window.event;
                if(n&&b){
                    if(!n.target){
                        n.target=n.srcElement
                        }
                        d.extend(n,h._stoppers)
                    }
                    if(!j){
                    return l(n)
                    }
                    return l.call(j,n)
                };

            if(p=="unload"){
                d.unloads.unshift({
                    func:g
                });
                return g
                }
                if(p=="init"){
                if(h.domLoaded){
                    g()
                    }else{
                    h.inits.push(g)
                    }
                    return g
                }
                i.push({
                obj:m,
                name:p,
                func:l,
                cfunc:g,
                scope:j
            });
            h._add(m,p,g);
            return l
            },
        remove:function(l,m,k){
            var h=this,g=h.events,i=false,j;
            if(l&&l.hasOwnProperty&&l instanceof Array){
                j=[];
                f(l,function(n){
                    n=c.get(n);
                    j.push(h.remove(n,m,k))
                    });
                return j
                }
                l=c.get(l);
            f(g,function(o,n){
                if(o.obj==l&&o.name==m&&(!k||(o.func==k||o.cfunc==k))){
                    g.splice(n,1);
                    h._remove(l,m,o.cfunc);
                    i=true;
                    return false
                    }
                });
        return i
        },
    clear:function(l){
        var j=this,g=j.events,h,k;
        if(l){
            l=c.get(l);
            for(h=g.length-1;h>=0;h--){
                k=g[h];
                if(k.obj===l){
                    j._remove(k.obj,k.name,k.cfunc);
                    k.obj=k.cfunc=null;
                    g.splice(h,1)
                    }
                }
            }
    },
cancel:function(g){
    if(!g){
        return false
        }
        this.stop(g);
    return this.prevent(g)
    },
stop:function(g){
    if(g.stopPropagation){
        g.stopPropagation()
        }else{
        g.cancelBubble=true
        }
        return false
    },
prevent:function(g){
    if(g.preventDefault){
        g.preventDefault()
        }else{
        g.returnValue=false
        }
        return false
    },
destroy:function(){
    var g=this;
    f(g.events,function(j,h){
        g._remove(j.obj,j.name,j.cfunc);
        j.obj=j.cfunc=null
        });
    g.events=[];
    g=null
    },
_add:function(h,i,g){
    if(h.attachEvent){
        h.attachEvent("on"+i,g)
        }else{
        if(h.addEventListener){
            h.addEventListener(i,g,false)
            }else{
            h["on"+i]=g
            }
        }
},
_remove:function(i,j,h){
    if(i){
        try{
            if(i.detachEvent){
                i.detachEvent("on"+j,h)
                }else{
                if(i.removeEventListener){
                    i.removeEventListener(j,h,false)
                    }else{
                    i["on"+j]=null
                    }
                }
        }catch(g){}
}
},
_pageInit:function(h){
    var g=this;
    if(g.domLoaded){
        return
    }
    g.domLoaded=true;
    f(g.inits,function(i){
        i()
        });
    g.inits=[]
    },
_wait:function(i){
    var g=this,h=i.document;
    if(i.tinyMCE_GZ&&tinyMCE_GZ.loaded){
        g.domLoaded=1;
        return
    }
    if(h.attachEvent){
        h.attachEvent("onreadystatechange",function(){
            if(h.readyState==="complete"){
                h.detachEvent("onreadystatechange",arguments.callee);
                g._pageInit(i)
                }
            });
    if(h.documentElement.doScroll&&i==i.top){
        (function(){
            if(g.domLoaded){
                return
            }
            try{
                h.documentElement.doScroll("left")
                }catch(j){
                setTimeout(arguments.callee,0);
                return
            }
            g._pageInit(i)
            })()
        }
    }else{
    if(h.addEventListener){
        g._add(i,"DOMContentLoaded",function(){
            g._pageInit(i)
            })
        }
    }
g._add(i,"load",function(){
    g._pageInit(i)
    })
},
_stoppers:{
    preventDefault:function(){
        this.returnValue=false
        },
    stopPropagation:function(){
        this.cancelBubble=true
        }
    }
});
a=d.dom.Event=new d.dom.EventUtils();
a._wait(window);
d.addUnload(function(){
    a.destroy()
    })
})(tinymce);
(function(a){
    a.dom.Element=function(f,d){
        var b=this,e,c;
        b.settings=d=d||{};

        b.id=f;
        b.dom=e=d.dom||a.DOM;
        if(!a.isIE){
            c=e.get(b.id)
            }
            a.each(("getPos,getRect,getParent,add,setStyle,getStyle,setStyles,setAttrib,setAttribs,getAttrib,addClass,removeClass,hasClass,getOuterHTML,setOuterHTML,remove,show,hide,isHidden,setHTML,get").split(/,/),function(g){
            b[g]=function(){
                var h=[f],j;
                for(j=0;j<arguments.length;j++){
                    h.push(arguments[j])
                    }
                    h=e[g].apply(e,h);
                b.update(g);
                return h
                }
            });
    a.extend(b,{
        on:function(i,h,g){
            return a.dom.Event.add(b.id,i,h,g)
            },
        getXY:function(){
            return{
                x:parseInt(b.getStyle("left")),
                y:parseInt(b.getStyle("top"))
                }
            },
    getSize:function(){
        var g=e.get(b.id);
        return{
            w:parseInt(b.getStyle("width")||g.clientWidth),
            h:parseInt(b.getStyle("height")||g.clientHeight)
            }
        },
    moveTo:function(g,h){
        b.setStyles({
            left:g,
            top:h
        })
        },
    moveBy:function(g,i){
        var h=b.getXY();
        b.moveTo(h.x+g,h.y+i)
        },
    resizeTo:function(g,i){
        b.setStyles({
            width:g,
            height:i
        })
        },
    resizeBy:function(g,j){
        var i=b.getSize();
        b.resizeTo(i.w+g,i.h+j)
        },
    update:function(h){
        var g;
        if(a.isIE6&&d.blocker){
            h=h||"";
            if(h.indexOf("get")===0||h.indexOf("has")===0||h.indexOf("is")===0){
                return
            }
            if(h=="remove"){
                e.remove(b.blocker);
                return
            }
            if(!b.blocker){
                b.blocker=e.uniqueId();
                g=e.add(d.container||e.getRoot(),"iframe",{
                    id:b.blocker,
                    style:"position:absolute;",
                    frameBorder:0,
                    src:'javascript:""'
                });
                e.setStyle(g,"opacity",0)
                }else{
                g=e.get(b.blocker)
                }
                e.setStyles(g,{
                left:b.getStyle("left",1),
                top:b.getStyle("top",1),
                width:b.getStyle("width",1),
                height:b.getStyle("height",1),
                display:b.getStyle("display",1),
                zIndex:parseInt(b.getStyle("zIndex",1)||0)-1
                })
            }
        }
})
}
})(tinymce);
(function(c){
    function e(f){
        return f.replace(/[\n\r]+/g,"")
        }
        var b=c.is,a=c.isIE,d=c.each;
    c.create("tinymce.dom.Selection",{
        Selection:function(i,h,g){
            var f=this;
            f.dom=i;
            f.win=h;
            f.serializer=g;
            d(["onBeforeSetContent","onBeforeGetContent","onSetContent","onGetContent"],function(j){
                f[j]=new c.util.Dispatcher(f)
                });
            if(!f.win.getSelection){
                f.tridentSel=new c.dom.TridentSelection(f)
                }
                c.addUnload(f.destroy,f)
            },
        getContent:function(g){
            var f=this,h=f.getRng(),l=f.dom.create("body"),j=f.getSel(),i,k,m;
            g=g||{};

            i=k="";
            g.get=true;
            g.format=g.format||"html";
            f.onBeforeGetContent.dispatch(f,g);
            if(g.format=="text"){
                return f.isCollapsed()?"":(h.text||(j.toString?j.toString():""))
                }
                if(h.cloneContents){
                m=h.cloneContents();
                if(m){
                    l.appendChild(m)
                    }
                }else{
            if(b(h.item)||b(h.htmlText)){
                l.innerHTML=h.item?h.item(0).outerHTML:h.htmlText
                }else{
                l.innerHTML=h.toString()
                }
            }
        if(/^\s/.test(l.innerHTML)){
        i=" "
        }
        if(/\s+$/.test(l.innerHTML)){
        k=" "
        }
        g.getInner=true;
    g.content=f.isCollapsed()?"":i+f.serializer.serialize(l,g)+k;
        f.onGetContent.dispatch(f,g);
        return g.content
        },
    setContent:function(i,g){
        var f=this,j=f.getRng(),l,k=f.win.document;
        g=g||{
            format:"html"
        };

        g.set=true;
        i=g.content=f.dom.processHTML(i);
        f.onBeforeSetContent.dispatch(f,g);
        i=g.content;
        if(j.insertNode){
            i+='<span id="__caret">_</span>';
            if(j.startContainer==k&&j.endContainer==k){
                k.body.innerHTML=i
                }else{
                j.deleteContents();
                if(k.body.childNodes.length==0){
                    k.body.innerHTML=i
                    }else{
                    j.insertNode(j.createContextualFragment(i))
                    }
                }
            l=f.dom.get("__caret");
        j=k.createRange();
        j.setStartBefore(l);
        j.setEndBefore(l);
        f.setRng(j);
        f.dom.remove("__caret")
        }else{
        if(j.item){
            k.execCommand("Delete",false,null);
            j=f.getRng()
            }
            j.pasteHTML(i)
        }
        f.onSetContent.dispatch(f,g)
    },
getStart:function(){
    var g=this.getRng(),h,f,j,i;
    if(g.duplicate||g.item){
        if(g.item){
            return g.item(0)
            }
            j=g.duplicate();
        j.collapse(1);
        h=j.parentElement();
        f=i=g.parentElement();
        while(i=i.parentNode){
            if(i==h){
                h=f;
                break
            }
        }
        if(h&&h.nodeName=="BODY"){
        return h.firstChild||h
        }
        return h
    }else{
    h=g.startContainer;
    if(h.nodeType==1&&h.hasChildNodes()){
        h=h.childNodes[Math.min(h.childNodes.length-1,g.startOffset)]
        }
        if(h&&h.nodeType==3){
        return h.parentNode
        }
        return h
    }
},
getEnd:function(){
    var g=this,h=g.getRng(),i,f;
    if(h.duplicate||h.item){
        if(h.item){
            return h.item(0)
            }
            h=h.duplicate();
        h.collapse(0);
        i=h.parentElement();
        if(i&&i.nodeName=="BODY"){
            return i.lastChild||i
            }
            return i
        }else{
        i=h.endContainer;
        f=h.endOffset;
        if(i.nodeType==1&&i.hasChildNodes()){
            i=i.childNodes[f>0?f-1:f]
            }
            if(i&&i.nodeType==3){
            return i.parentNode
            }
            return i
        }
    },
getBookmark:function(q,r){
    var u=this,m=u.dom,g,j,i,n,h,o,p,l="\uFEFF",s;
    function f(v,x){
        var t=0;
        d(m.select(v),function(z,y){
            if(z==x){
                t=y
                }
            });
    return t
    }
    if(q==2){
    function k(){
        var v=u.getRng(true),t=m.getRoot(),x={};

        function y(B,G){
            var A=B[G?"startContainer":"endContainer"],F=B[G?"startOffset":"endOffset"],z=[],C,E,D=0;
            if(A.nodeType==3){
                if(r){
                    for(C=A.previousSibling;C&&C.nodeType==3;C=C.previousSibling){
                        F+=C.nodeValue.length
                        }
                    }
                    z.push(F)
            }else{
            E=A.childNodes;
            if(F>=E.length&&E.length){
                D=1;
                F=Math.max(0,E.length-1)
                }
                z.push(u.dom.nodeIndex(E[F],r)+D)
            }
            for(;A&&A!=t;A=A.parentNode){
            z.push(u.dom.nodeIndex(A,r))
            }
            return z
        }
        x.start=y(v,true);
    if(!u.isCollapsed()){
        x.end=y(v)
        }
        return x
    }
    return k()
}
if(q){
    return{
        rng:u.getRng()
        }
    }
g=u.getRng();
i=m.uniqueId();
n=tinyMCE.activeEditor.selection.isCollapsed();
s="overflow:hidden;line-height:0px";
if(g.duplicate||g.item){
    if(!g.item){
        j=g.duplicate();
        g.collapse();
        g.pasteHTML('<span _mce_type="bookmark" id="'+i+'_start" style="'+s+'">'+l+"</span>");
        if(!n){
            j.collapse(false);
            j.pasteHTML('<span _mce_type="bookmark" id="'+i+'_end" style="'+s+'">'+l+"</span>")
            }
        }else{
    o=g.item(0);
    h=o.nodeName;
    return{
        name:h,
        index:f(h,o)
        }
    }
}else{
    o=u.getNode();
    h=o.nodeName;
    if(h=="IMG"){
        return{
            name:h,
            index:f(h,o)
            }
        }
    j=g.cloneRange();
if(!n){
    j.collapse(false);
    j.insertNode(m.create("span",{
        _mce_type:"bookmark",
        id:i+"_end",
        style:s
    },l))
    }
    g.collapse(true);
g.insertNode(m.create("span",{
    _mce_type:"bookmark",
    id:i+"_start",
    style:s
},l))
}
u.moveToBookmark({
    id:i,
    keep:1
});
return{
    id:i
}
},
moveToBookmark:function(n){
    var r=this,l=r.dom,i,h,f,q,j,s,o,p;
    if(r.tridentSel){
        r.tridentSel.destroy()
        }
        if(n){
        if(n.start){
            f=l.createRng();
            q=l.getRoot();
            function g(z){
                var t=n[z?"start":"end"],v,x,y,u;
                if(t){
                    for(x=q,v=t.length-1;v>=1;v--){
                        u=x.childNodes;
                        if(u.length){
                            x=u[t[v]]
                            }
                        }
                    if(z){
                    f.setStart(x,t[0])
                    }else{
                    f.setEnd(x,t[0])
                    }
                }
        }
    g(true);
g();
r.setRng(f)
}else{
    if(n.id){
        function k(A){
            var u=l.get(n.id+"_"+A),z,t,x,y,v=n.keep;
            if(u){
                z=u.parentNode;
                if(A=="start"){
                    if(!v){
                        t=l.nodeIndex(u)
                        }else{
                        z=u.firstChild;
                        t=1
                        }
                        j=s=z;
                    o=p=t
                    }else{
                    if(!v){
                        t=l.nodeIndex(u)
                        }else{
                        z=u.firstChild;
                        t=1
                        }
                        s=z;
                    p=t
                    }
                    if(!v){
                    y=u.previousSibling;
                    x=u.nextSibling;
                    d(c.grep(u.childNodes),function(B){
                        if(B.nodeType==3){
                            B.nodeValue=B.nodeValue.replace(/\uFEFF/g,"")
                            }
                        });
                while(u=l.get(n.id+"_"+A)){
                    l.remove(u,1)
                    }
                    if(y&&x&&y.nodeType==x.nodeType&&y.nodeType==3){
                    t=y.nodeValue.length;
                    y.appendData(x.nodeValue);
                    l.remove(x);
                    if(A=="start"){
                        j=s=y;
                        o=p=t
                        }else{
                        s=y;
                        p=t
                        }
                    }
            }
    }
}
function m(t){
    if(!a&&l.isBlock(t)&&!t.innerHTML){
        t.innerHTML='<br _mce_bogus="1" />'
        }
        return t
    }
    k("start");
k("end");
f=l.createRng();
f.setStart(m(j),o);
f.setEnd(m(s),p);
r.setRng(f)
}else{
    if(n.name){
        r.select(l.select(n.name)[n.index])
        }else{
        if(n.rng){
            r.setRng(n.rng)
            }
        }
}
}
}
},
select:function(k,j){
    var i=this,l=i.dom,g=l.createRng(),f;
    f=l.nodeIndex(k);
    g.setStart(k.parentNode,f);
    g.setEnd(k.parentNode,f+1);
    if(j){
        function h(m,o){
            var n=new c.dom.TreeWalker(m,m);
            do{
                if(m.nodeType==3&&c.trim(m.nodeValue).length!=0){
                    if(o){
                        g.setStart(m,0)
                        }else{
                        g.setEnd(m,m.nodeValue.length)
                        }
                        return
                }
                if(m.nodeName=="BR"){
                    if(o){
                        g.setStartBefore(m)
                        }else{
                        g.setEndBefore(m)
                        }
                        return
                }
            }while(m=(o?n.next():n.prev()))
    }
    h(k,1);
    h(k)
    }
    i.setRng(g);
return k
},
isCollapsed:function(){
    var f=this,h=f.getRng(),g=f.getSel();
    if(!h||h.item){
        return false
        }
        if(h.compareEndPoints){
        return h.compareEndPoints("StartToEnd",h)===0
        }
        return !g||h.collapsed
    },
collapse:function(f){
    var g=this,h=g.getRng(),i;
    if(h.item){
        i=h.item(0);
        h=this.win.document.body.createTextRange();
        h.moveToElementText(i)
        }
        h.collapse(!!f);
    g.setRng(h)
    },
getSel:function(){
    var g=this,f=this.win;
    return f.getSelection?f.getSelection():f.document.selection
    },
getRng:function(j){
    var g=this,h,i;
    if(j&&g.tridentSel){
        return g.tridentSel.getRangeAt(0)
        }
        try{
        if(h=g.getSel()){
            i=h.rangeCount>0?h.getRangeAt(0):(h.createRange?h.createRange():g.win.document.createRange())
            }
        }catch(f){}
if(!i){
    i=g.win.document.createRange?g.win.document.createRange():g.win.document.body.createTextRange()
    }
    if(g.selectedRange&&g.explicitRange){
    if(i.compareBoundaryPoints(i.START_TO_START,g.selectedRange)===0&&i.compareBoundaryPoints(i.END_TO_END,g.selectedRange)===0){
        i=g.explicitRange
        }else{
        g.selectedRange=null;
        g.explicitRange=null
        }
    }
return i
},
setRng:function(i){
    var h,g=this;
    if(!g.tridentSel){
        h=g.getSel();
        if(h){
            g.explicitRange=i;
            h.removeAllRanges();
            h.addRange(i);
            g.selectedRange=h.getRangeAt(0)
            }
        }else{
    if(i.cloneRange){
        g.tridentSel.addRange(i);
        return
    }
    try{
        i.select()
        }catch(f){}
}
},
setNode:function(g){
    var f=this;
    f.setContent(f.dom.getOuterHTML(g));
    return g
    },
getNode:function(){
    var g=this,f=g.getRng(),h=g.getSel(),i;
    if(f.setStart){
        if(!f){
            return g.dom.getRoot()
            }
            i=f.commonAncestorContainer;
        if(!f.collapsed){
            if(f.startContainer==f.endContainer){
                if(f.startOffset-f.endOffset<2){
                    if(f.startContainer.hasChildNodes()){
                        i=f.startContainer.childNodes[f.startOffset]
                        }
                    }
            }
        if(c.isWebKit&&h.anchorNode&&h.anchorNode.nodeType==1){
        return h.anchorNode.childNodes[h.anchorOffset]
        }
    }
if(i&&i.nodeType==3){
    return i.parentNode
    }
    return i
}
return f.item?f.item(0):f.parentElement()
},
getSelectedBlocks:function(g,f){
    var i=this,j=i.dom,m,h,l,k=[];
    m=j.getParent(g||i.getStart(),j.isBlock);
    h=j.getParent(f||i.getEnd(),j.isBlock);
    if(m){
        k.push(m)
        }
        if(m&&h&&m!=h){
        l=m;
        while((l=l.nextSibling)&&l!=h){
            if(j.isBlock(l)){
                k.push(l)
                }
            }
    }
if(h&&m!=h){
    k.push(h)
    }
    return k
},
destroy:function(g){
    var f=this;
    f.win=null;
    if(f.tridentSel){
        f.tridentSel.destroy()
        }
        if(!g){
        c.removeUnload(f.destroy)
        }
    }
})
})(tinymce);
(function(a){
    a.create("tinymce.dom.XMLWriter",{
        node:null,
        XMLWriter:function(c){
            function b(){
                var e=document.implementation;
                if(!e||!e.createDocument){
                    try{
                        return new ActiveXObject("MSXML2.DOMDocument")
                        }catch(d){}
                    try{
                        return new ActiveXObject("Microsoft.XmlDom")
                        }catch(d){}
                }else{
                return e.createDocument("","",null)
                }
            }
        this.doc=b();
        this.valid=a.isOpera||a.isWebKit;
        this.reset()
        },
    reset:function(){
        var b=this,c=b.doc;
        if(c.firstChild){
            c.removeChild(c.firstChild)
            }
            b.node=c.appendChild(c.createElement("html"))
        },
    writeStartElement:function(c){
        var b=this;
        b.node=b.node.appendChild(b.doc.createElement(c))
        },
    writeAttribute:function(c,b){
        if(this.valid){
            b=b.replace(/>/g,"%MCGT%")
            }
            this.node.setAttribute(c,b)
        },
    writeEndElement:function(){
        this.node=this.node.parentNode
        },
    writeFullEndElement:function(){
        var b=this,c=b.node;
        c.appendChild(b.doc.createTextNode(""));
        b.node=c.parentNode
        },
    writeText:function(b){
        if(this.valid){
            b=b.replace(/>/g,"%MCGT%")
            }
            this.node.appendChild(this.doc.createTextNode(b))
        },
    writeCDATA:function(b){
        this.node.appendChild(this.doc.createCDATASection(b))
        },
    writeComment:function(b){
        if(a.isIE){
            b=b.replace(/^\-|\-$/g," ")
            }
            this.node.appendChild(this.doc.createComment(b.replace(/\-\-/g," ")))
        },
    getContent:function(){
        var b;
        b=this.doc.xml||new XMLSerializer().serializeToString(this.doc);
        b=b.replace(/<\?[^?]+\?>|<html>|<\/html>|<html\/>|<!DOCTYPE[^>]+>/g,"");
        b=b.replace(/ ?\/>/g," />");
        if(this.valid){
            b=b.replace(/\%MCGT%/g,"&gt;")
            }
            return b
        }
    })
})(tinymce);
(function(a){
    a.create("tinymce.dom.StringWriter",{
        str:null,
        tags:null,
        count:0,
        settings:null,
        indent:null,
        StringWriter:function(b){
            this.settings=a.extend({
                indent_char:" ",
                indentation:0
            },b);
            this.reset()
            },
        reset:function(){
            this.indent="";
            this.str="";
            this.tags=[];
            this.count=0
            },
        writeStartElement:function(b){
            this._writeAttributesEnd();
            this.writeRaw("<"+b);
            this.tags.push(b);
            this.inAttr=true;
            this.count++;
            this.elementCount=this.count
            },
        writeAttribute:function(d,b){
            var c=this;
            c.writeRaw(" "+c.encode(d)+'="'+c.encode(b)+'"')
            },
        writeEndElement:function(){
            var b;
            if(this.tags.length>0){
                b=this.tags.pop();
                if(this._writeAttributesEnd(1)){
                    this.writeRaw("</"+b+">")
                    }
                    if(this.settings.indentation>0){
                    this.writeRaw("\n")
                    }
                }
        },
    writeFullEndElement:function(){
        if(this.tags.length>0){
            this._writeAttributesEnd();
            this.writeRaw("</"+this.tags.pop()+">");
            if(this.settings.indentation>0){
                this.writeRaw("\n")
                }
            }
    },
writeText:function(b){
    this._writeAttributesEnd();
    this.writeRaw(this.encode(b));
    this.count++
},
writeCDATA:function(b){
    this._writeAttributesEnd();
    this.writeRaw("<![CDATA["+b+"]]>");
    this.count++
},
writeComment:function(b){
    this._writeAttributesEnd();
    this.writeRaw("<!-- "+b+"-->");
    this.count++
},
writeRaw:function(b){
    this.str+=b
    },
encode:function(b){
    return b.replace(/[<>&"]/g,function(c){
        switch(c){
            case"<":
                return"&lt;";
            case">":
                return"&gt;";
            case"&":
                return"&amp;";
            case'"':
                return"&quot;"
                }
                return c
        })
    },
getContent:function(){
    return this.str
    },
_writeAttributesEnd:function(b){
    if(!this.inAttr){
        return
    }
    this.inAttr=false;
    if(b&&this.elementCount==this.count){
        this.writeRaw(" />");
        return false
        }
        this.writeRaw(">");
    return true
    }
})
})(tinymce);
(function(e){
    var g=e.extend,f=e.each,b=e.util.Dispatcher,d=e.isIE,a=e.isGecko;
    function c(h){
        return h.replace(/([?+*])/g,".$1")
        }
        e.create("tinymce.dom.Serializer",{
        Serializer:function(j){
            var i=this;
            i.key=0;
            i.onPreProcess=new b(i);
            i.onPostProcess=new b(i);
            try{
                i.writer=new e.dom.XMLWriter()
                }catch(h){
                i.writer=new e.dom.StringWriter()
                }
                i.settings=j=g({
                dom:e.DOM,
                valid_nodes:0,
                node_filter:0,
                attr_filter:0,
                invalid_attrs:/^(_mce_|_moz_|sizset|sizcache)/,
                closed:/^(br|hr|input|meta|img|link|param|area)$/,
                entity_encoding:"named",
                entities:"160,nbsp,161,iexcl,162,cent,163,pound,164,curren,165,yen,166,brvbar,167,sect,168,uml,169,copy,170,ordf,171,laquo,172,not,173,shy,174,reg,175,macr,176,deg,177,plusmn,178,sup2,179,sup3,180,acute,181,micro,182,para,183,middot,184,cedil,185,sup1,186,ordm,187,raquo,188,frac14,189,frac12,190,frac34,191,iquest,192,Agrave,193,Aacute,194,Acirc,195,Atilde,196,Auml,197,Aring,198,AElig,199,Ccedil,200,Egrave,201,Eacute,202,Ecirc,203,Euml,204,Igrave,205,Iacute,206,Icirc,207,Iuml,208,ETH,209,Ntilde,210,Ograve,211,Oacute,212,Ocirc,213,Otilde,214,Ouml,215,times,216,Oslash,217,Ugrave,218,Uacute,219,Ucirc,220,Uuml,221,Yacute,222,THORN,223,szlig,224,agrave,225,aacute,226,acirc,227,atilde,228,auml,229,aring,230,aelig,231,ccedil,232,egrave,233,eacute,234,ecirc,235,euml,236,igrave,237,iacute,238,icirc,239,iuml,240,eth,241,ntilde,242,ograve,243,oacute,244,ocirc,245,otilde,246,ouml,247,divide,248,oslash,249,ugrave,250,uacute,251,ucirc,252,uuml,253,yacute,254,thorn,255,yuml,402,fnof,913,Alpha,914,Beta,915,Gamma,916,Delta,917,Epsilon,918,Zeta,919,Eta,920,Theta,921,Iota,922,Kappa,923,Lambda,924,Mu,925,Nu,926,Xi,927,Omicron,928,Pi,929,Rho,931,Sigma,932,Tau,933,Upsilon,934,Phi,935,Chi,936,Psi,937,Omega,945,alpha,946,beta,947,gamma,948,delta,949,epsilon,950,zeta,951,eta,952,theta,953,iota,954,kappa,955,lambda,956,mu,957,nu,958,xi,959,omicron,960,pi,961,rho,962,sigmaf,963,sigma,964,tau,965,upsilon,966,phi,967,chi,968,psi,969,omega,977,thetasym,978,upsih,982,piv,8226,bull,8230,hellip,8242,prime,8243,Prime,8254,oline,8260,frasl,8472,weierp,8465,image,8476,real,8482,trade,8501,alefsym,8592,larr,8593,uarr,8594,rarr,8595,darr,8596,harr,8629,crarr,8656,lArr,8657,uArr,8658,rArr,8659,dArr,8660,hArr,8704,forall,8706,part,8707,exist,8709,empty,8711,nabla,8712,isin,8713,notin,8715,ni,8719,prod,8721,sum,8722,minus,8727,lowast,8730,radic,8733,prop,8734,infin,8736,ang,8743,and,8744,or,8745,cap,8746,cup,8747,int,8756,there4,8764,sim,8773,cong,8776,asymp,8800,ne,8801,equiv,8804,le,8805,ge,8834,sub,8835,sup,8836,nsub,8838,sube,8839,supe,8853,oplus,8855,otimes,8869,perp,8901,sdot,8968,lceil,8969,rceil,8970,lfloor,8971,rfloor,9001,lang,9002,rang,9674,loz,9824,spades,9827,clubs,9829,hearts,9830,diams,338,OElig,339,oelig,352,Scaron,353,scaron,376,Yuml,710,circ,732,tilde,8194,ensp,8195,emsp,8201,thinsp,8204,zwnj,8205,zwj,8206,lrm,8207,rlm,8211,ndash,8212,mdash,8216,lsquo,8217,rsquo,8218,sbquo,8220,ldquo,8221,rdquo,8222,bdquo,8224,dagger,8225,Dagger,8240,permil,8249,lsaquo,8250,rsaquo,8364,euro",
                valid_elements:"*[*]",
                extended_valid_elements:0,
                invalid_elements:0,
                fix_table_elements:1,
                fix_list_elements:true,
                fix_content_duplication:true,
                convert_fonts_to_spans:false,
                font_size_classes:0,
                apply_source_formatting:0,
                indent_mode:"simple",
                indent_char:"\t",
                indent_levels:1,
                remove_linebreaks:1,
                remove_redundant_brs:1,
                element_format:"xhtml"
            },j);
            i.dom=j.dom;
            i.schema=j.schema;
            if(j.entity_encoding=="named"&&!j.entities){
                j.entity_encoding="raw"
                }
                if(j.remove_redundant_brs){
                i.onPostProcess.add(function(k,l){
                    l.content=l.content.replace(/(<br \/>\s*)+<\/(p|h[1-6]|div|li)>/gi,function(n,m,o){
                        if(/^<br \/>\s*<\//.test(n)){
                            return"</"+o+">"
                            }
                            return n
                        })
                    })
                }
                if(j.element_format=="html"){
                i.onPostProcess.add(function(k,l){
                    l.content=l.content.replace(/<([^>]+) \/>/g,"<$1>")
                    })
                }
                if(j.fix_list_elements){
                i.onPreProcess.add(function(v,s){
                    var l,z,y=["ol","ul"],u,t,q,k=/^(OL|UL)$/,A;
                    function m(r,x){
                        var o=x.split(","),p;
                        while((r=r.previousSibling)!=null){
                            for(p=0;p<o.length;p++){
                                if(r.nodeName==o[p]){
                                    return r
                                    }
                                }
                            }
                        return null
                }
                for(z=0;z<y.length;z++){
                    l=i.dom.select(y[z],s.node);
                    for(u=0;u<l.length;u++){
                        t=l[u];
                        q=t.parentNode;
                        if(k.test(q.nodeName)){
                            A=m(t,"LI");
                            if(!A){
                                A=i.dom.create("li");
                                A.innerHTML="&nbsp;";
                                A.appendChild(t);
                                q.insertBefore(A,q.firstChild)
                                }else{
                                A.appendChild(t)
                                }
                            }
                    }
                }
            })
}
if(j.fix_table_elements){
    i.onPreProcess.add(function(k,l){
        if(!e.isOpera||opera.buildNumber()>=1767){
            f(i.dom.select("p table",l.node).reverse(),function(p){
                var o=i.dom.getParent(p.parentNode,"table,p");
                if(o.nodeName!="TABLE"){
                    try{
                        i.dom.split(o,p)
                        }catch(m){}
                }
            })
    }
    })
}
},
setEntities:function(o){
    var n=this,j,m,h={},k;
    if(n.entityLookup){
        return
    }
    j=o.split(",");
    for(m=0;m<j.length;m+=2){
        k=j[m];
        if(k==34||k==38||k==60||k==62){
            continue
        }
        h[String.fromCharCode(j[m])]=j[m+1];
        k=parseInt(j[m]).toString(16)
        }
        n.entityLookup=h
    },
setRules:function(i){
    var h=this;
    h._setup();
    h.rules={};

    h.wildRules=[];
    h.validElements={};

    return h.addRules(i)
    },
addRules:function(i){
    var h=this,j;
    if(!i){
        return
    }
    h._setup();
    f(i.split(","),function(m){
        var q=m.split(/\[|\]/),l=q[0].split("/"),r,k,o,n=[];
        if(j){
            k=e.extend([],j.attribs)
            }
            if(q.length>1){
            f(q[1].split("|"),function(u){
                var p={},t;
                k=k||[];
                u=u.replace(/::/g,"~");
                u=/^([!\-])?([\w*.?~_\-]+|)([=:<])?(.+)?$/.exec(u);
                u[2]=u[2].replace(/~/g,":");
                if(u[1]=="!"){
                    r=r||[];
                    r.push(u[2])
                    }
                    if(u[1]=="-"){
                    for(t=0;t<k.length;t++){
                        if(k[t].name==u[2]){
                            k.splice(t,1);
                            return
                        }
                    }
                    }
                switch(u[3]){
                case"=":
                    p.defaultVal=u[4]||"";
                    break;
                case":":
                    p.forcedVal=u[4];
                    break;
                case"<":
                    p.validVals=u[4].split("?");
                    break
                    }
                    if(/[*.?]/.test(u[2])){
                o=o||[];
                p.nameRE=new RegExp("^"+c(u[2])+"$");
                o.push(p)
                }else{
                p.name=u[2];
                k.push(p)
                }
                n.push(u[2])
            })
    }
    f(l,function(v,u){
        var y=v.charAt(0),t=1,p={};

        if(j){
            if(j.noEmpty){
                p.noEmpty=j.noEmpty
                }
                if(j.fullEnd){
                p.fullEnd=j.fullEnd
                }
                if(j.padd){
                p.padd=j.padd
                }
            }
        switch(y){
        case"-":
            p.noEmpty=true;
            break;
        case"+":
            p.fullEnd=true;
            break;
        case"#":
            p.padd=true;
            break;
        default:
            t=0
            }
            l[u]=v=v.substring(t);
        h.validElements[v]=1;
        if(/[*.?]/.test(l[0])){
        p.nameRE=new RegExp("^"+c(l[0])+"$");
        h.wildRules=h.wildRules||{};

        h.wildRules.push(p)
        }else{
        p.name=l[0];
        if(l[0]=="@"){
            j=p
            }
            h.rules[v]=p
        }
        p.attribs=k;
    if(r){
        p.requiredAttribs=r
        }
        if(o){
        v="";
        f(n,function(s){
            if(v){
                v+="|"
                }
                v+="("+c(s)+")"
            });
        p.validAttribsRE=new RegExp("^"+v.toLowerCase()+"$");
        p.wildAttribs=o
        }
    })
});
i="";
f(h.validElements,function(m,l){
    if(i){
        i+="|"
        }
        if(l!="@"){
        i+=l
        }
    });
h.validElementsRE=new RegExp("^("+c(i.toLowerCase())+")$")
},
findRule:function(m){
    var j=this,l=j.rules,h,k;
    j._setup();
    k=l[m];
    if(k){
        return k
        }
        l=j.wildRules;
    for(h=0;h<l.length;h++){
        if(l[h].nameRE.test(m)){
            return l[h]
            }
        }
    return null
},
findAttribRule:function(h,l){
    var j,k=h.wildAttribs;
    for(j=0;j<k.length;j++){
        if(k[j].nameRE.test(l)){
            return k[j]
            }
        }
    return null
},
serialize:function(r,q){
    var m,k=this,p,i,j,l;
    k._setup();
    q=q||{};

    q.format=q.format||"html";
    k.processObj=q;
    if(d){
        l=[];
        f(r.getElementsByTagName("option"),function(o){
            var h=k.dom.getAttrib(o,"selected");
            l.push(h?h:null)
            })
        }
        r=r.cloneNode(true);
    if(d){
        f(r.getElementsByTagName("option"),function(o,h){
            k.dom.setAttrib(o,"selected",l[h])
            })
        }
        j=r.ownerDocument.implementation;
    if(j.createHTMLDocument&&(e.isOpera&&opera.buildNumber()>=1767)){
        p=j.createHTMLDocument("");
        f(r.nodeName=="BODY"?r.childNodes:[r],function(h){
            p.body.appendChild(p.importNode(h,true))
            });
        if(r.nodeName!="BODY"){
            r=p.body.firstChild
            }else{
            r=p.body
            }
            i=k.dom.doc;
        k.dom.doc=p
        }
        k.key=""+(parseInt(k.key)+1);
    if(!q.no_events){
        q.node=r;
        k.onPreProcess.dispatch(k,q)
        }
        k.writer.reset();
    k._info=q;
    k._serializeNode(r,q.getInner);
    q.content=k.writer.getContent();
    if(i){
        k.dom.doc=i
        }
        if(!q.no_events){
        k.onPostProcess.dispatch(k,q)
        }
        k._postProcess(q);
    q.node=null;
    return e.trim(q.content)
    },
_postProcess:function(n){
    var i=this,k=i.settings,j=n.content,m=[],l;
    if(n.format=="html"){
        l=i._protect({
            content:j,
            patterns:[{
                pattern:/(<script[^>]*>)(.*?)(<\/script>)/g
            },{
                pattern:/(<noscript[^>]*>)(.*?)(<\/noscript>)/g
            },{
                pattern:/(<style[^>]*>)(.*?)(<\/style>)/g
            },{
                pattern:/(<pre[^>]*>)(.*?)(<\/pre>)/g,
                encode:1
            },{
                pattern:/(<!--\[CDATA\[)(.*?)(\]\]-->)/g
            }]
            });
        j=l.content;
        if(k.entity_encoding!=="raw"){
            j=i._encode(j)
            }
            if(!n.set){
            j=j.replace(/<p>\s+<\/p>|<p([^>]+)>\s+<\/p>/g,k.entity_encoding=="numeric"?"<p$1>&#160;</p>":"<p$1>&nbsp;</p>");
            if(k.remove_linebreaks){
                j=j.replace(/\r?\n|\r/g," ");
                j=j.replace(/(<[^>]+>)\s+/g,"$1 ");
                j=j.replace(/\s+(<\/[^>]+>)/g," $1");
                j=j.replace(/<(p|h[1-6]|blockquote|hr|div|table|tbody|tr|td|body|head|html|title|meta|style|pre|script|link|object) ([^>]+)>\s+/g,"<$1 $2>");
                j=j.replace(/<(p|h[1-6]|blockquote|hr|div|table|tbody|tr|td|body|head|html|title|meta|style|pre|script|link|object)>\s+/g,"<$1>");
                j=j.replace(/\s+<\/(p|h[1-6]|blockquote|hr|div|table|tbody|tr|td|body|head|html|title|meta|style|pre|script|link|object)>/g,"</$1>")
                }
                if(k.apply_source_formatting&&k.indent_mode=="simple"){
                j=j.replace(/<(\/?)(ul|hr|table|meta|link|tbody|tr|object|body|head|html|map)(|[^>]+)>\s*/g,"\n<$1$2$3>\n");
                j=j.replace(/\s*<(p|h[1-6]|blockquote|div|title|style|pre|script|td|li|area)(|[^>]+)>/g,"\n<$1$2>");
                j=j.replace(/<\/(p|h[1-6]|blockquote|div|title|style|pre|script|td|li)>\s*/g,"</$1>\n");
                j=j.replace(/\n\n/g,"\n")
                }
            }
        j=i._unprotect(j,l);
    j=j.replace(/<!--\[CDATA\[([\s\S]+)\]\]-->/g,"<![CDATA[$1]]>");
    if(k.entity_encoding=="raw"){
        j=j.replace(/<p>&nbsp;<\/p>|<p([^>]+)>&nbsp;<\/p>/g,"<p$1>\u00a0</p>")
        }
        j=j.replace(/<noscript([^>]+|)>([\s\S]*?)<\/noscript>/g,function(h,p,o){
        return"<noscript"+p+">"+i.dom.decode(o.replace(/<!--|-->/g,""))+"</noscript>"
        })
    }
    n.content=j
},
_serializeNode:function(E,J){
    var A=this,B=A.settings,y=A.writer,q,j,u,G,F,I,C,h,z,k,r,D,p,m,H,o,x;
    if(!B.node_filter||B.node_filter(E)){
        switch(E.nodeType){
            case 1:
                if(E.hasAttribute?E.hasAttribute("_mce_bogus"):E.getAttribute("_mce_bogus")){
                return
            }
            p=H=false;
            q=E.hasChildNodes();
                k=E.getAttribute("_mce_name")||E.nodeName.toLowerCase();
                o=E.getAttribute("_mce_type");
                if(o){
                if(!A._info.cleanup){
                    p=true;
                    return
                }else{
                    H=1
                    }
                }
            if(d){
                x=E.scopeName;
                if(x&&x!=="HTML"&&x!=="html"){
                    k=x+":"+k
                    }
                }
            if(k.indexOf("mce:")===0){
            k=k.substring(4)
            }
            if(!H){
            if(!A.validElementsRE||!A.validElementsRE.test(k)||(A.invalidElementsRE&&A.invalidElementsRE.test(k))||J){
                p=true;
                break
            }
        }
        if(d){
        if(B.fix_content_duplication){
            if(E._mce_serialized==A.key){
                return
            }
            E._mce_serialized=A.key
            }
            if(k.charAt(0)=="/"){
            k=k.substring(1)
            }
        }else{
    if(a){
        if(E.nodeName==="BR"&&E.getAttribute("type")=="_moz"){
            return
        }
    }
}
if(B.validate_children){
    if(A.elementName&&!A.schema.isValid(A.elementName,k)){
        p=true;
        break
    }
    A.elementName=k
    }
    r=A.findRule(k);
if(!r){
    p=true;
    break
}
k=r.name||k;
m=B.closed.test(k);
if((!q&&r.noEmpty)||(d&&!k)){
    p=true;
    break
}
if(r.requiredAttribs){
    I=r.requiredAttribs;
    for(G=I.length-1;G>=0;G--){
        if(this.dom.getAttrib(E,I[G])!==""){
            break
        }
    }
    if(G==-1){
    p=true;
    break
}
}
y.writeStartElement(k);
if(r.attribs){
    for(G=0,C=r.attribs,F=C.length;G<F;G++){
        I=C[G];
        z=A._getAttrib(E,I);
        if(z!==null){
            y.writeAttribute(I.name,z)
            }
        }
    }
if(r.validAttribsRE){
    C=A.dom.getAttribs(E);
    for(G=C.length-1;G>-1;G--){
        h=C[G];
        if(h.specified){
            I=h.nodeName.toLowerCase();
            if(B.invalid_attrs.test(I)||!r.validAttribsRE.test(I)){
                continue
            }
            D=A.findAttribRule(r,I);
            z=A._getAttrib(E,D,I);
            if(z!==null){
                y.writeAttribute(I,z)
                }
            }
    }
}
if(o&&H){
    y.writeAttribute("_mce_type",o)
    }
    if(k==="script"&&e.trim(E.innerHTML)){
    y.writeText("// ");
    y.writeCDATA(E.innerHTML.replace(/<!--|-->|<\[CDATA\[|\]\]>/g,""));
    q=false;
    break
}
if(r.padd){
    if(q&&(u=E.firstChild)&&u.nodeType===1&&E.childNodes.length===1){
        if(u.hasAttribute?u.hasAttribute("_mce_bogus"):u.getAttribute("_mce_bogus")){
            y.writeText("\u00a0")
            }
        }else{
    if(!q){
        y.writeText("\u00a0")
        }
    }
}
break;
case 3:
    if(B.validate_children&&A.elementName&&!A.schema.isValid(A.elementName,"#text")){
    return
}
return y.writeText(E.nodeValue);
case 4:
    return y.writeCDATA(E.nodeValue);
case 8:
    return y.writeComment(E.nodeValue)
    }
}else{
    if(E.nodeType==1){
        q=E.hasChildNodes()
        }
    }
if(q&&!m){
    u=E.firstChild;
    while(u){
        A._serializeNode(u);
        A.elementName=k;
        u=u.nextSibling
        }
    }
if(!p){
    if(!m){
        y.writeFullEndElement()
        }else{
        y.writeEndElement()
        }
    }
},
_protect:function(j){
    var i=this;
    j.items=j.items||[];
    function h(l){
        return l.replace(/[\r\n\\]/g,function(m){
            if(m==="\n"){
                return"\\n"
                }else{
                if(m==="\\"){
                    return"\\\\"
                    }
                }
            return"\\r"
        })
    }
    function k(l){
    return l.replace(/\\[\\rn]/g,function(m){
        if(m==="\\n"){
            return"\n"
            }else{
            if(m==="\\\\"){
                return"\\"
                }
            }
        return"\r"
    })
}
f(j.patterns,function(l){
    j.content=k(h(j.content).replace(l.pattern,function(n,o,m,p){
        m=k(m);
        if(l.encode){
            m=i._encode(m)
            }
            j.items.push(m);
        return o+"<!--mce:"+(j.items.length-1)+"-->"+p
        }))
    });
return j
},
_unprotect:function(i,j){
    i=i.replace(/\<!--mce:([0-9]+)--\>/g,function(k,h){
        return j.items[parseInt(h)]
        });
    j.items=[];
    return i
    },
_encode:function(m){
    var j=this,k=j.settings,i;
    if(k.entity_encoding!=="raw"){
        if(k.entity_encoding.indexOf("named")!=-1){
            j.setEntities(k.entities);
            i=j.entityLookup;
            m=m.replace(/[\u007E-\uFFFF]/g,function(h){
                var l;
                if(l=i[h]){
                    h="&"+l+";"
                    }
                    return h
                })
            }
            if(k.entity_encoding.indexOf("numeric")!=-1){
            m=m.replace(/[\u007E-\uFFFF]/g,function(h){
                return"&#"+h.charCodeAt(0)+";"
                })
            }
        }
    return m
},
_setup:function(){
    var h=this,i=this.settings;
    if(h.done){
        return
    }
    h.done=1;
    h.setRules(i.valid_elements);
    h.addRules(i.extended_valid_elements);
    if(i.invalid_elements){
        h.invalidElementsRE=new RegExp("^("+c(i.invalid_elements.replace(/,/g,"|").toLowerCase())+")$")
        }
        if(i.attrib_value_filter){
        h.attribValueFilter=i.attribValueFilter
        }
    },
_getAttrib:function(m,j,h){
    var l,k;
    h=h||j.name;
    if(j.forcedVal&&(k=j.forcedVal)){
        if(k==="{$uid}"){
            return this.dom.uniqueId()
            }
            return k
        }
        k=this.dom.getAttrib(m,h);
    switch(h){
        case"rowspan":case"colspan":
            if(k=="1"){
            k=""
            }
            break
        }
        if(this.attribValueFilter){
        k=this.attribValueFilter(h,k,m)
        }
        if(j.validVals){
        for(l=j.validVals.length-1;l>=0;l--){
            if(k==j.validVals[l]){
                break
            }
        }
        if(l==-1){
        return null
        }
    }
if(k===""&&typeof(j.defaultVal)!="undefined"){
    k=j.defaultVal;
    if(k==="{$uid}"){
        return this.dom.uniqueId()
        }
        return k
    }else{
    if(h=="class"&&this.processObj.get){
        k=k.replace(/\s?mceItem\w+\s?/g,"")
        }
    }
if(k===""){
    return null
    }
    return k
}
})
})(tinymce);
(function(a){
    a.dom.ScriptLoader=function(h){
        var c=0,k=1,i=2,l={},j=[],f={},d=[],g=0,e;
        function b(m,u){
            var v=this,q=a.DOM,s,o,r,n;
            function p(){
                q.remove(n);
                if(s){
                    s.onreadystatechange=s.onload=s=null
                    }
                    u()
                }
                n=q.uniqueId();
            if(a.isIE6){
                o=new a.util.URI(m);
                r=location;
                if(o.host==r.hostname&&o.port==r.port&&(o.protocol+":")==r.protocol){
                    a.util.XHR.send({
                        url:a._addVer(o.getURI()),
                        success:function(x){
                            var t=q.create("script",{
                                type:"text/javascript"
                            });
                            t.text=x;
                            document.getElementsByTagName("head")[0].appendChild(t);
                            q.remove(t);
                            p()
                            }
                        });
                return
            }
        }
        s=q.create("script",{
        id:n,
        type:"text/javascript",
        src:a._addVer(m)
        });
    s.onload=p;
    s.onreadystatechange=function(){
        var t=s.readyState;
        if(t=="complete"||t=="loaded"){
            p()
            }
        };
(document.getElementsByTagName("head")[0]||document.body).appendChild(s)
    }
    this.isDone=function(m){
    return l[m]==i
    };

this.markDone=function(m){
    l[m]=i
    };

this.add=this.load=function(m,q,n){
    var o,p=l[m];
    if(p==e){
        j.push(m);
        l[m]=c
        }
        if(q){
        if(!f[m]){
            f[m]=[]
            }
            f[m].push({
            func:q,
            scope:n||this
            })
        }
    };

this.loadQueue=function(n,m){
    this.loadScripts(j,n,m)
    };

this.loadScripts=function(m,q,p){
    var o;
    function n(r){
        a.each(f[r],function(s){
            s.func.call(s.scope)
            });
        f[r]=e
        }
        d.push({
        func:q,
        scope:p||this
        });
    o=function(){
        var r=a.grep(m);
        m.length=0;
        a.each(r,function(s){
            if(l[s]==i){
                n(s);
                return
            }
            if(l[s]!=k){
                l[s]=k;
                g++;
                b(s,function(){
                    l[s]=i;
                    g--;
                    n(s);
                    o()
                    })
                }
            });
    if(!g){
        a.each(d,function(s){
            s.func.call(s.scope)
            });
        d.length=0
        }
    };

o()
}
};

a.ScriptLoader=new a.dom.ScriptLoader()
})(tinymce);
tinymce.dom.TreeWalker=function(a,c){
    var b=a;
    function d(i,f,e,j){
        var h,g;
        if(i){
            if(!j&&i[f]){
                return i[f]
                }
                if(i!=c){
                h=i[e];
                if(h){
                    return h
                    }
                    for(g=i.parentNode;g&&g!=c;g=g.parentNode){
                    h=g[e];
                    if(h){
                        return h
                        }
                    }
                }
        }
}
this.current=function(){
    return b
    };

this.next=function(e){
    return(b=d(b,"firstChild","nextSibling",e))
    };

this.prev=function(e){
    return(b=d(b,"lastChild","lastSibling",e))
    }
};
(function(){
    var a={};

    function b(f,e){
        var d;
        function c(g){
            return g.replace(/[A-Z]+/g,function(h){
                return c(f[h])
                })
            }
            for(d in f){
            if(f.hasOwnProperty(d)){
                f[d]=c(f[d])
                }
            }
        c(e).replace(/#/g,"#text").replace(/(\w+)\[([^\]]+)\]/g,function(l,g,j){
        var h,k={};

        j=j.split(/\|/);
        for(h=j.length-1;h>=0;h--){
            k[j[h]]=1
            }
            a[g]=k
        })
    }
    b({
    Z:"#|H|K|N|O|P",
    Y:"#|X|form|R|Q",
    X:"p|T|div|U|W|isindex|fieldset|table",
    W:"pre|hr|blockquote|address|center|noframes",
    U:"ul|ol|dl|menu|dir",
    ZC:"#|p|Y|div|U|W|table|br|span|bdo|object|applet|img|map|K|N|Q",
    T:"h1|h2|h3|h4|h5|h6",
    ZB:"#|X|S|Q",
    S:"R|P",
    ZA:"#|a|G|J|M|O|P",
    R:"#|a|H|K|N|O",
    Q:"noscript|P",
    P:"ins|del|script",
    O:"input|select|textarea|label|button",
    N:"M|L",
    M:"em|strong|dfn|code|q|samp|kbd|var|cite|abbr|acronym",
    L:"sub|sup",
    K:"J|I",
    J:"tt|i|b|u|s|strike",
    I:"big|small|font|basefont",
    H:"G|F",
    G:"br|span|bdo",
    F:"object|applet|img|map|iframe"
},"script[]style[]object[#|param|X|form|a|H|K|N|O|Q]param[]p[S]a[Z]br[]span[S]bdo[S]applet[#|param|X|form|a|H|K|N|O|Q]h1[S]img[]map[X|form|Q|area]h2[S]iframe[#|X|form|a|H|K|N|O|Q]h3[S]tt[S]i[S]b[S]u[S]s[S]strike[S]big[S]small[S]font[S]basefont[]em[S]strong[S]dfn[S]code[S]q[S]samp[S]kbd[S]var[S]cite[S]abbr[S]acronym[S]sub[S]sup[S]input[]select[optgroup|option]optgroup[option]option[]textarea[]label[S]button[#|p|T|div|U|W|table|G|object|applet|img|map|K|N|Q]h4[S]ins[#|X|form|a|H|K|N|O|Q]h5[S]del[#|X|form|a|H|K|N|O|Q]h6[S]div[#|X|form|a|H|K|N|O|Q]ul[li]li[#|X|form|a|H|K|N|O|Q]ol[li]dl[dt|dd]dt[S]dd[#|X|form|a|H|K|N|O|Q]menu[li]dir[li]pre[ZA]hr[]blockquote[#|X|form|a|H|K|N|O|Q]address[S|p]center[#|X|form|a|H|K|N|O|Q]noframes[#|X|form|a|H|K|N|O|Q]isindex[]fieldset[#|legend|X|form|a|H|K|N|O|Q]legend[S]table[caption|col|colgroup|thead|tfoot|tbody|tr]caption[S]col[]colgroup[col]thead[tr]tr[th|td]th[#|X|form|a|H|K|N|O|Q]form[#|X|a|H|K|N|O|Q]noscript[#|X|form|a|H|K|N|O|Q]td[#|X|form|a|H|K|N|O|Q]tfoot[tr]tbody[tr]area[]base[]body[#|X|form|a|H|K|N|O|Q]");
tinymce.dom.Schema=function(){
    var c=this,d=a;
    c.isValid=function(f,e){
        var g=d[f];
        return !!(g&&(!e||g[e]))
        }
    }
})();
(function(a){
    a.dom.RangeUtils=function(c){
        var b="\uFEFF";
        this.walk=function(d,r){
            var h=d.startContainer,k=d.startOffset,s=d.endContainer,l=d.endOffset,i,f,n,g,q,p,e;
            e=c.select("td.mceSelected,th.mceSelected");
            if(e.length>0){
                a.each(e,function(t){
                    r([t])
                    });
                return
            }
            function o(v,u,t){
                var x=[];
                for(;v&&v!=t;v=v[u]){
                    x.push(v)
                    }
                    return x
                }
                function m(u,t){
                do{
                    if(u.parentNode==t){
                        return u
                        }
                        u=u.parentNode
                    }while(u)
            }
            function j(v,u,x){
                var t=x?"nextSibling":"previousSibling";
                for(g=v,q=g.parentNode;g&&g!=u;g=q){
                    q=g.parentNode;
                    p=o(g==v?g:g[t],t);
                    if(p.length){
                        if(!x){
                            p.reverse()
                            }
                            r(p)
                        }
                    }
                }
            if(h.nodeType==1&&h.hasChildNodes()){
        h=h.childNodes[k]
        }
        if(s.nodeType==1&&s.hasChildNodes()){
        s=s.childNodes[Math.min(k==l?l:l-1,s.childNodes.length-1)]
        }
        i=c.findCommonAncestor(h,s);
    if(h==s){
        return r([h])
        }
        for(g=h;g;g=g.parentNode){
        if(g==s){
            return j(h,i,true)
            }
            if(g==i){
            break
        }
    }
    for(g=s;g;g=g.parentNode){
    if(g==h){
        return j(s,i)
        }
        if(g==i){
        break
    }
}
f=m(h,i)||h;
    n=m(s,i)||s;
    j(h,f,true);
    p=o(f==h?f:f.nextSibling,"nextSibling",n==s?n.nextSibling:n);
    if(p.length){
    r(p)
    }
    j(s,n)
    }
};

a.dom.RangeUtils.compareRanges=function(c,b){
    if(c&&b){
        if(c.item||c.duplicate){
            if(c.item&&b.item&&c.item(0)===b.item(0)){
                return true
                }
                if(c.isEqual&&b.isEqual&&b.isEqual(c)){
                return true
                }
            }else{
        return c.startContainer==b.startContainer&&c.startOffset==b.startOffset
        }
    }
return false
}
})(tinymce);
(function(c){
    var b=c.DOM,a=c.is;
    c.create("tinymce.ui.Control",{
        Control:function(e,d){
            this.id=e;
            this.settings=d=d||{};

            this.rendered=false;
            this.onRender=new c.util.Dispatcher(this);
            this.classPrefix="";
            this.scope=d.scope||this;
            this.disabled=0;
            this.active=0
            },
        setDisabled:function(d){
            var f;
            if(d!=this.disabled){
                f=b.get(this.id);
                if(f&&this.settings.unavailable_prefix){
                    if(d){
                        this.prevTitle=f.title;
                        f.title=this.settings.unavailable_prefix+": "+f.title
                        }else{
                        f.title=this.prevTitle
                        }
                    }
                this.setState("Disabled",d);
            this.setState("Enabled",!d);
            this.disabled=d
            }
        },
    isDisabled:function(){
        return this.disabled
        },
    setActive:function(d){
        if(d!=this.active){
            this.setState("Active",d);
            this.active=d
            }
        },
isActive:function(){
    return this.active
    },
setState:function(f,d){
    var e=b.get(this.id);
    f=this.classPrefix+f;
    if(d){
        b.addClass(e,f)
        }else{
        b.removeClass(e,f)
        }
    },
isRendered:function(){
    return this.rendered
    },
renderHTML:function(){},
    renderTo:function(d){
    b.setHTML(d,this.renderHTML())
    },
postRender:function(){
    var e=this,d;
    if(a(e.disabled)){
        d=e.disabled;
        e.disabled=-1;
        e.setDisabled(d)
        }
        if(a(e.active)){
        d=e.active;
        e.active=-1;
        e.setActive(d)
        }
    },
remove:function(){
    b.remove(this.id);
    this.destroy()
    },
destroy:function(){
    c.dom.Event.clear(this.id)
    }
})
})(tinymce);
tinymce.create("tinymce.ui.Container:tinymce.ui.Control",{
    Container:function(b,a){
        this.parent(b,a);
        this.controls=[];
        this.lookup={}
    },
add:function(a){
    this.lookup[a.id]=a;
    this.controls.push(a);
    return a
    },
get:function(a){
    return this.lookup[a]
    }
});
tinymce.create("tinymce.ui.Separator:tinymce.ui.Control",{
    Separator:function(b,a){
        this.parent(b,a);
        this.classPrefix="mceSeparator"
        },
    renderHTML:function(){
        return tinymce.DOM.createHTML("span",{
            "class":this.classPrefix
            })
        }
    });
(function(d){
    var c=d.is,b=d.DOM,e=d.each,a=d.walk;
    d.create("tinymce.ui.MenuItem:tinymce.ui.Control",{
        MenuItem:function(g,f){
            this.parent(g,f);
            this.classPrefix="mceMenuItem"
            },
        setSelected:function(f){
            this.setState("Selected",f);
            this.selected=f
            },
        isSelected:function(){
            return this.selected
            },
        postRender:function(){
            var f=this;
            f.parent();
            if(c(f.selected)){
                f.setSelected(f.selected)
                }
            }
    })
})(tinymce);
(function(d){
    var c=d.is,b=d.DOM,e=d.each,a=d.walk;
    d.create("tinymce.ui.Menu:tinymce.ui.MenuItem",{
        Menu:function(h,g){
            var f=this;
            f.parent(h,g);
            f.items={};

            f.collapsed=false;
            f.menuCount=0;
            f.onAddItem=new d.util.Dispatcher(this)
            },
        expand:function(g){
            var f=this;
            if(g){
                a(f,function(h){
                    if(h.expand){
                        h.expand()
                        }
                    },"items",f)
            }
            f.collapsed=false
        },
    collapse:function(g){
        var f=this;
        if(g){
            a(f,function(h){
                if(h.collapse){
                    h.collapse()
                    }
                },"items",f)
        }
        f.collapsed=true
    },
    isCollapsed:function(){
        return this.collapsed
        },
    add:function(f){
        if(!f.settings){
            f=new d.ui.MenuItem(f.id||b.uniqueId(),f)
            }
            this.onAddItem.dispatch(this,f);
        return this.items[f.id]=f
        },
    addSeparator:function(){
        return this.add({
            separator:true
        })
        },
    addMenu:function(f){
        if(!f.collapse){
            f=this.createMenu(f)
            }
            this.menuCount++;
        return this.add(f)
        },
    hasMenus:function(){
        return this.menuCount!==0
        },
    remove:function(f){
        delete this.items[f.id]
    },
    removeAll:function(){
        var f=this;
        a(f,function(g){
            if(g.removeAll){
                g.removeAll()
                }else{
                g.remove()
                }
                g.destroy()
            },"items",f);
        f.items={}
    },
createMenu:function(g){
    var f=new d.ui.Menu(g.id||b.uniqueId(),g);
    f.onAddItem.add(this.onAddItem.dispatch,this.onAddItem);
    return f
    }
})
})(tinymce);
(function(e){
    var d=e.is,c=e.DOM,f=e.each,a=e.dom.Event,b=e.dom.Element;
    e.create("tinymce.ui.DropMenu:tinymce.ui.Menu",{
        DropMenu:function(h,g){
            g=g||{};

            g.container=g.container||c.doc.body;
            g.offset_x=g.offset_x||0;
            g.offset_y=g.offset_y||0;
            g.vp_offset_x=g.vp_offset_x||0;
            g.vp_offset_y=g.vp_offset_y||0;
            if(d(g.icons)&&!g.icons){
                g["class"]+=" mceNoIcons"
                }
                this.parent(h,g);
            this.onShowMenu=new e.util.Dispatcher(this);
            this.onHideMenu=new e.util.Dispatcher(this);
            this.classPrefix="mceMenu"
            },
        createMenu:function(j){
            var h=this,i=h.settings,g;
            j.container=j.container||i.container;
            j.parent=h;
            j.constrain=j.constrain||i.constrain;
            j["class"]=j["class"]||i["class"];
            j.vp_offset_x=j.vp_offset_x||i.vp_offset_x;
            j.vp_offset_y=j.vp_offset_y||i.vp_offset_y;
            g=new e.ui.DropMenu(j.id||c.uniqueId(),j);
            g.onAddItem.add(h.onAddItem.dispatch,h.onAddItem);
            return g
            },
        update:function(){
            var i=this,j=i.settings,g=c.get("menu_"+i.id+"_tbl"),l=c.get("menu_"+i.id+"_co"),h,k;
            h=j.max_width?Math.min(g.clientWidth,j.max_width):g.clientWidth;
            k=j.max_height?Math.min(g.clientHeight,j.max_height):g.clientHeight;
            if(!c.boxModel){
                i.element.setStyles({
                    width:h+2,
                    height:k+2
                    })
                }else{
                i.element.setStyles({
                    width:h,
                    height:k
                })
                }
                if(j.max_width){
                c.setStyle(l,"width",h)
                }
                if(j.max_height){
                c.setStyle(l,"height",k);
                if(g.clientHeight<j.max_height){
                    c.setStyle(l,"overflow","hidden")
                    }
                }
        },
    showMenu:function(p,n,r){
        var z=this,A=z.settings,o,g=c.getViewPort(),u,l,v,q,i=2,k,j,m=z.classPrefix;
        z.collapse(1);
        if(z.isMenuVisible){
            return
        }
        if(!z.rendered){
            o=c.add(z.settings.container,z.renderNode());
            f(z.items,function(h){
                h.postRender()
                });
            z.element=new b("menu_"+z.id,{
                blocker:1,
                container:A.container
                })
            }else{
            o=c.get("menu_"+z.id)
            }
            if(!e.isOpera){
            c.setStyles(o,{
                left:-65535,
                top:-65535
            })
            }
            c.show(o);
        z.update();
        p+=A.offset_x||0;
        n+=A.offset_y||0;
        g.w-=4;
        g.h-=4;
        if(A.constrain){
            u=o.clientWidth-i;
            l=o.clientHeight-i;
            v=g.x+g.w;
            q=g.y+g.h;
            if((p+A.vp_offset_x+u)>v){
                p=r?r-u:Math.max(0,(v-A.vp_offset_x)-u)
                }
                if((n+A.vp_offset_y+l)>q){
                n=Math.max(0,(q-A.vp_offset_y)-l)
                }
            }
        c.setStyles(o,{
        left:p,
        top:n
    });
    z.element.update();
    z.isMenuVisible=1;
    z.mouseClickFunc=a.add(o,"click",function(s){
        var h;
        s=s.target;
        if(s&&(s=c.getParent(s,"tr"))&&!c.hasClass(s,m+"ItemSub")){
            h=z.items[s.id];
            if(h.isDisabled()){
                return
            }
            k=z;
            while(k){
                if(k.hideMenu){
                    k.hideMenu()
                    }
                    k=k.settings.parent
                }
                if(h.settings.onclick){
                h.settings.onclick(s)
                }
                return a.cancel(s)
            }
        });
if(z.hasMenus()){
    z.mouseOverFunc=a.add(o,"mouseover",function(x){
        var h,t,s;
        x=x.target;
        if(x&&(x=c.getParent(x,"tr"))){
            h=z.items[x.id];
            if(z.lastMenu){
                z.lastMenu.collapse(1)
                }
                if(h.isDisabled()){
                return
            }
            if(x&&c.hasClass(x,m+"ItemSub")){
                t=c.getRect(x);
                h.showMenu((t.x+t.w-i),t.y-i,t.x);
                z.lastMenu=h;
                c.addClass(c.get(h.id).firstChild,m+"ItemActive")
                }
            }
    })
}
z.onShowMenu.dispatch(z);
if(A.keyboard_focus){
    a.add(o,"keydown",z._keyHandler,z);
    c.select("a","menu_"+z.id)[0].focus();
    z._focusIdx=0
    }
},
hideMenu:function(j){
    var g=this,i=c.get("menu_"+g.id),h;
    if(!g.isMenuVisible){
        return
    }
    a.remove(i,"mouseover",g.mouseOverFunc);
    a.remove(i,"click",g.mouseClickFunc);
    a.remove(i,"keydown",g._keyHandler);
    c.hide(i);
    g.isMenuVisible=0;
    if(!j){
        g.collapse(1)
        }
        if(g.element){
        g.element.hide()
        }
        if(h=c.get(g.id)){
        c.removeClass(h.firstChild,g.classPrefix+"ItemActive")
        }
        g.onHideMenu.dispatch(g)
    },
add:function(i){
    var g=this,h;
    i=g.parent(i);
    if(g.isRendered&&(h=c.get("menu_"+g.id))){
        g._add(c.select("tbody",h)[0],i)
        }
        return i
    },
collapse:function(g){
    this.parent(g);
    this.hideMenu(1)
    },
remove:function(g){
    c.remove(g.id);
    this.destroy();
    return this.parent(g)
    },
destroy:function(){
    var g=this,h=c.get("menu_"+g.id);
    a.remove(h,"mouseover",g.mouseOverFunc);
    a.remove(h,"click",g.mouseClickFunc);
    if(g.element){
        g.element.remove()
        }
        c.remove(h)
    },
renderNode:function(){
    var i=this,j=i.settings,l,h,k,g;
    g=c.create("div",{
        id:"menu_"+i.id,
        "class":j["class"],
        style:"position:absolute;left:0;top:0;z-index:200000"
    });
    k=c.add(g,"div",{
        id:"menu_"+i.id+"_co",
        "class":i.classPrefix+(j["class"]?" "+j["class"]:"")
        });
    i.element=new b("menu_"+i.id,{
        blocker:1,
        container:j.container
        });
    if(j.menu_line){
        c.add(k,"span",{
            "class":i.classPrefix+"Line"
            })
        }
        l=c.add(k,"table",{
        id:"menu_"+i.id+"_tbl",
        border:0,
        cellPadding:0,
        cellSpacing:0
    });
    h=c.add(l,"tbody");
    f(i.items,function(m){
        i._add(h,m)
        });
    i.rendered=true;
    return g
    },
_keyHandler:function(j){
    var i=this,h=j.keyCode;
    function g(m){
        var k=i._focusIdx+m,l=c.select("a","menu_"+i.id)[k];
        if(l){
            i._focusIdx=k;
            l.focus()
            }
        }
    switch(h){
    case 38:
        g(-1);
        return;
    case 40:
        g(1);
        return;
    case 13:
        return;
    case 27:
        return this.hideMenu()
        }
    },
_add:function(j,h){
    var i,q=h.settings,p,l,k,m=this.classPrefix,g;
    if(q.separator){
        l=c.add(j,"tr",{
            id:h.id,
            "class":m+"ItemSeparator"
            });
        c.add(l,"td",{
            "class":m+"ItemSeparator"
            });
        if(i=l.previousSibling){
            c.addClass(i,"mceLast")
            }
            return
    }
    i=l=c.add(j,"tr",{
        id:h.id,
        "class":m+"Item "+m+"ItemEnabled"
        });
    i=k=c.add(i,"td");
    i=p=c.add(i,"a",{
        href:"javascript:;",
        onclick:"return false;",
        onmousedown:"return false;"
    });
    c.addClass(k,q["class"]);
    g=c.add(i,"span",{
        "class":"mceIcon"+(q.icon?" mce_"+q.icon:"")
        });
    if(q.icon_src){
        c.add(g,"img",{
            src:q.icon_src
            })
        }
        i=c.add(i,q.element||"span",{
        "class":"mceText",
        title:h.settings.title
        },h.settings.title);
    if(h.settings.style){
        c.setAttrib(i,"style",h.settings.style)
        }
        if(j.childNodes.length==1){
        c.addClass(l,"mceFirst")
        }
        if((i=l.previousSibling)&&c.hasClass(i,m+"ItemSeparator")){
        c.addClass(l,"mceFirst")
        }
        if(h.collapse){
        c.addClass(l,m+"ItemSub")
        }
        if(i=l.previousSibling){
        c.removeClass(i,"mceLast")
        }
        c.addClass(l,"mceLast")
    }
})
})(tinymce);
(function(b){
    var a=b.DOM;
    b.create("tinymce.ui.Button:tinymce.ui.Control",{
        Button:function(d,c){
            this.parent(d,c);
            this.classPrefix="mceButton"
            },
        renderHTML:function(){
            var f=this.classPrefix,e=this.settings,d,c;
            c=a.encode(e.label||"");
            d='<a id="'+this.id+'" href="javascript:;" class="'+f+" "+f+"Enabled "+e["class"]+(c?" "+f+"Labeled":"")+'" onmousedown="return false;" onclick="return false;" title="'+a.encode(e.title)+'">';
            if(e.image){
                d+='<img class="mceIcon" src="'+e.image+'" />'+c+"</a>"
                }else{
                d+='<span class="mceIcon '+e["class"]+'"></span>'+(c?'<span class="'+f+'Label">'+c+"</span>":"")+"</a>"
                }
                return d
            },
        postRender:function(){
            var c=this,d=c.settings;
            b.dom.Event.add(c.id,"click",function(f){
                if(!c.isDisabled()){
                    return d.onclick.call(d.scope,f)
                    }
                })
        }
    })
})(tinymce);
(function(d){
    var c=d.DOM,b=d.dom.Event,e=d.each,a=d.util.Dispatcher;
    d.create("tinymce.ui.ListBox:tinymce.ui.Control",{
        ListBox:function(h,g){
            var f=this;
            f.parent(h,g);
            f.items=[];
            f.onChange=new a(f);
            f.onPostRender=new a(f);
            f.onAdd=new a(f);
            f.onRenderMenu=new d.util.Dispatcher(this);
            f.classPrefix="mceListBox"
            },
        select:function(h){
            var g=this,j,i;
            if(h==undefined){
                return g.selectByIndex(-1)
                }
                if(h&&h.call){
                i=h
                }else{
                i=function(f){
                    return f==h
                    }
                }
            if(h!=g.selectedValue){
            e(g.items,function(k,f){
                if(i(k.value)){
                    j=1;
                    g.selectByIndex(f);
                    return false
                    }
                });
        if(!j){
            g.selectByIndex(-1)
            }
        }
    },
selectByIndex:function(f){
    var g=this,h,i;
    if(f!=g.selectedIndex){
        h=c.get(g.id+"_text");
        i=g.items[f];
        if(i){
            g.selectedValue=i.value;
            g.selectedIndex=f;
            c.setHTML(h,c.encode(i.title));
            c.removeClass(h,"mceTitle")
            }else{
            c.setHTML(h,c.encode(g.settings.title));
            c.addClass(h,"mceTitle");
            g.selectedValue=g.selectedIndex=null
            }
            h=0
        }
    },
add:function(i,f,h){
    var g=this;
    h=h||{};

    h=d.extend(h,{
        title:i,
        value:f
    });
    g.items.push(h);
    g.onAdd.dispatch(g,h)
    },
getLength:function(){
    return this.items.length
    },
renderHTML:function(){
    var i="",f=this,g=f.settings,j=f.classPrefix;
    i='<table id="'+f.id+'" cellpadding="0" cellspacing="0" class="'+j+" "+j+"Enabled"+(g["class"]?(" "+g["class"]):"")+'"><tbody><tr>';
    i+="<td>"+c.createHTML("a",{
        id:f.id+"_text",
        href:"javascript:;",
        "class":"mceText",
        onclick:"return false;",
        onmousedown:"return false;"
    },c.encode(f.settings.title))+"</td>";
    i+="<td>"+c.createHTML("a",{
        id:f.id+"_open",
        tabindex:-1,
        href:"javascript:;",
        "class":"mceOpen",
        onclick:"return false;",
        onmousedown:"return false;"
    },"<span></span>")+"</td>";
    i+="</tr></tbody></table>";
    return i
    },
showMenu:function(){
    var g=this,j,i,h=c.get(this.id),f;
    if(g.isDisabled()||g.items.length==0){
        return
    }
    if(g.menu&&g.menu.isMenuVisible){
        return g.hideMenu()
        }
        if(!g.isMenuRendered){
        g.renderMenu();
        g.isMenuRendered=true
        }
        j=c.getPos(this.settings.menu_container);
    i=c.getPos(h);
    f=g.menu;
    f.settings.offset_x=i.x;
    f.settings.offset_y=i.y;
    f.settings.keyboard_focus=!d.isOpera;
    if(g.oldID){
        f.items[g.oldID].setSelected(0)
        }
        e(g.items,function(k){
        if(k.value===g.selectedValue){
            f.items[k.id].setSelected(1);
            g.oldID=k.id
            }
        });
f.showMenu(0,h.clientHeight);
b.add(c.doc,"mousedown",g.hideMenu,g);
c.addClass(g.id,g.classPrefix+"Selected")
},
hideMenu:function(g){
    var f=this;
    if(f.menu&&f.menu.isMenuVisible){
        if(g&&g.type=="mousedown"&&(g.target.id==f.id+"_text"||g.target.id==f.id+"_open")){
            return
        }
        if(!g||!c.getParent(g.target,".mceMenu")){
            c.removeClass(f.id,f.classPrefix+"Selected");
            b.remove(c.doc,"mousedown",f.hideMenu,f);
            f.menu.hideMenu()
            }
        }
},
renderMenu:function(){
    var g=this,f;
    f=g.settings.control_manager.createDropMenu(g.id+"_menu",{
        menu_line:1,
        "class":g.classPrefix+"Menu mceNoIcons",
        max_width:150,
        max_height:150
    });
    f.onHideMenu.add(g.hideMenu,g);
    f.add({
        title:g.settings.title,
        "class":"mceMenuItemTitle",
        onclick:function(){
            if(g.settings.onselect("")!==false){
                g.select("")
                }
            }
    });
e(g.items,function(h){
    if(h.value===undefined){
        f.add({
            title:h.title,
            "class":"mceMenuItemTitle",
            onclick:function(){
                if(g.settings.onselect("")!==false){
                    g.select("")
                    }
                }
        })
}else{
    h.id=c.uniqueId();
    h.onclick=function(){
        if(g.settings.onselect(h.value)!==false){
            g.select(h.value)
            }
        };

f.add(h)
}
});
g.onRenderMenu.dispatch(g,f);
g.menu=f
},
postRender:function(){
    var f=this,g=f.classPrefix;
    b.add(f.id,"click",f.showMenu,f);
    b.add(f.id+"_text","focus",function(){
        if(!f._focused){
            f.keyDownHandler=b.add(f.id+"_text","keydown",function(k){
                var h=-1,i,j=k.keyCode;
                e(f.items,function(l,m){
                    if(f.selectedValue==l.value){
                        h=m
                        }
                    });
            if(j==38){
                i=f.items[h-1]
                }else{
                if(j==40){
                    i=f.items[h+1]
                    }else{
                    if(j==13){
                        i=f.selectedValue;
                        f.selectedValue=null;
                        f.settings.onselect(i);
                        return b.cancel(k)
                        }
                    }
            }
            if(i){
            f.hideMenu();
            f.select(i.value)
            }
        })
}
f._focused=1
});
b.add(f.id+"_text","blur",function(){
    b.remove(f.id+"_text","keydown",f.keyDownHandler);
    f._focused=0
    });
if(d.isIE6||!c.boxModel){
    b.add(f.id,"mouseover",function(){
        if(!c.hasClass(f.id,g+"Disabled")){
            c.addClass(f.id,g+"Hover")
            }
        });
b.add(f.id,"mouseout",function(){
    if(!c.hasClass(f.id,g+"Disabled")){
        c.removeClass(f.id,g+"Hover")
        }
    })
}
f.onPostRender.dispatch(f,c.get(f.id))
},
destroy:function(){
    this.parent();
    b.clear(this.id+"_text");
    b.clear(this.id+"_open")
    }
})
})(tinymce);
(function(d){
    var c=d.DOM,b=d.dom.Event,e=d.each,a=d.util.Dispatcher;
    d.create("tinymce.ui.NativeListBox:tinymce.ui.ListBox",{
        NativeListBox:function(g,f){
            this.parent(g,f);
            this.classPrefix="mceNativeListBox"
            },
        setDisabled:function(f){
            c.get(this.id).disabled=f
            },
        isDisabled:function(){
            return c.get(this.id).disabled
            },
        select:function(h){
            var g=this,j,i;
            if(h==undefined){
                return g.selectByIndex(-1)
                }
                if(h&&h.call){
                i=h
                }else{
                i=function(f){
                    return f==h
                    }
                }
            if(h!=g.selectedValue){
            e(g.items,function(k,f){
                if(i(k.value)){
                    j=1;
                    g.selectByIndex(f);
                    return false
                    }
                });
        if(!j){
            g.selectByIndex(-1)
            }
        }
    },
selectByIndex:function(f){
    c.get(this.id).selectedIndex=f+1;
    this.selectedValue=this.items[f]?this.items[f].value:null
    },
add:function(j,g,f){
    var i,h=this;
    f=f||{};

    f.value=g;
    if(h.isRendered()){
        c.add(c.get(this.id),"option",f,j)
        }
        i={
        title:j,
        value:g,
        attribs:f
    };

    h.items.push(i);
    h.onAdd.dispatch(h,i)
    },
getLength:function(){
    return this.items.length
    },
renderHTML:function(){
    var g,f=this;
    g=c.createHTML("option",{
        value:""
    },"-- "+f.settings.title+" --");
    e(f.items,function(h){
        g+=c.createHTML("option",{
            value:h.value
            },h.title)
        });
    g=c.createHTML("select",{
        id:f.id,
        "class":"mceNativeListBox"
    },g);
    return g
    },
postRender:function(){
    var g=this,h;
    g.rendered=true;
    function f(j){
        var i=g.items[j.target.selectedIndex-1];
        if(i&&(i=i.value)){
            g.onChange.dispatch(g,i);
            if(g.settings.onselect){
                g.settings.onselect(i)
                }
            }
    }
b.add(g.id,"change",f);
b.add(g.id,"keydown",function(j){
    var i;
    b.remove(g.id,"change",h);
    i=b.add(g.id,"blur",function(){
        b.add(g.id,"change",f);
        b.remove(g.id,"blur",i)
        });
    if(j.keyCode==13||j.keyCode==32){
        f(j);
        return b.cancel(j)
        }
    });
g.onPostRender.dispatch(g,c.get(g.id))
}
})
})(tinymce);
(function(c){
    var b=c.DOM,a=c.dom.Event,d=c.each;
    c.create("tinymce.ui.MenuButton:tinymce.ui.Button",{
        MenuButton:function(f,e){
            this.parent(f,e);
            this.onRenderMenu=new c.util.Dispatcher(this);
            e.menu_container=e.menu_container||b.doc.body
            },
        showMenu:function(){
            var g=this,j,i,h=b.get(g.id),f;
            if(g.isDisabled()){
                return
            }
            if(!g.isMenuRendered){
                g.renderMenu();
                g.isMenuRendered=true
                }
                if(g.isMenuVisible){
                return g.hideMenu()
                }
                j=b.getPos(g.settings.menu_container);
            i=b.getPos(h);
            f=g.menu;
            f.settings.offset_x=i.x;
            f.settings.offset_y=i.y;
            f.settings.vp_offset_x=i.x;
            f.settings.vp_offset_y=i.y;
            f.settings.keyboard_focus=g._focused;
            f.showMenu(0,h.clientHeight);
            a.add(b.doc,"mousedown",g.hideMenu,g);
            g.setState("Selected",1);
            g.isMenuVisible=1
            },
        renderMenu:function(){
            var f=this,e;
            e=f.settings.control_manager.createDropMenu(f.id+"_menu",{
                menu_line:1,
                "class":this.classPrefix+"Menu",
                icons:f.settings.icons
                });
            e.onHideMenu.add(f.hideMenu,f);
            f.onRenderMenu.dispatch(f,e);
            f.menu=e
            },
        hideMenu:function(g){
            var f=this;
            if(g&&g.type=="mousedown"&&b.getParent(g.target,function(h){
                return h.id===f.id||h.id===f.id+"_open"
                })){
                return
            }
            if(!g||!b.getParent(g.target,".mceMenu")){
                f.setState("Selected",0);
                a.remove(b.doc,"mousedown",f.hideMenu,f);
                if(f.menu){
                    f.menu.hideMenu()
                    }
                }
            f.isMenuVisible=0
        },
    postRender:function(){
        var e=this,f=e.settings;
        a.add(e.id,"click",function(){
            if(!e.isDisabled()){
                if(f.onclick){
                    f.onclick(e.value)
                    }
                    e.showMenu()
                }
            })
    }
    })
})(tinymce);
(function(c){
    var b=c.DOM,a=c.dom.Event,d=c.each;
    c.create("tinymce.ui.SplitButton:tinymce.ui.MenuButton",{
        SplitButton:function(f,e){
            this.parent(f,e);
            this.classPrefix="mceSplitButton"
            },
        renderHTML:function(){
            var i,f=this,g=f.settings,e;
            i="<tbody><tr>";
            if(g.image){
                e=b.createHTML("img ",{
                    src:g.image,
                    "class":"mceAction "+g["class"]
                    })
                }else{
                e=b.createHTML("span",{
                    "class":"mceAction "+g["class"]
                    },"")
                }
                i+="<td>"+b.createHTML("a",{
                id:f.id+"_action",
                href:"javascript:;",
                "class":"mceAction "+g["class"],
                onclick:"return false;",
                onmousedown:"return false;",
                title:g.title
                },e)+"</td>";
            e=b.createHTML("span",{
                "class":"mceOpen "+g["class"]
                });
            i+="<td>"+b.createHTML("a",{
                id:f.id+"_open",
                href:"javascript:;",
                "class":"mceOpen "+g["class"],
                onclick:"return false;",
                onmousedown:"return false;",
                title:g.title
                },e)+"</td>";
            i+="</tr></tbody>";
            return b.createHTML("table",{
                id:f.id,
                "class":"mceSplitButton mceSplitButtonEnabled "+g["class"],
                cellpadding:"0",
                cellspacing:"0",
                onmousedown:"return false;",
                title:g.title
                },i)
            },
        postRender:function(){
            var e=this,f=e.settings;
            if(f.onclick){
                a.add(e.id+"_action","click",function(){
                    if(!e.isDisabled()){
                        f.onclick(e.value)
                        }
                    })
            }
            a.add(e.id+"_open","click",e.showMenu,e);
        a.add(e.id+"_open","focus",function(){
            e._focused=1
            });
        a.add(e.id+"_open","blur",function(){
            e._focused=0
            });
        if(c.isIE6||!b.boxModel){
            a.add(e.id,"mouseover",function(){
                if(!b.hasClass(e.id,"mceSplitButtonDisabled")){
                    b.addClass(e.id,"mceSplitButtonHover")
                    }
                });
        a.add(e.id,"mouseout",function(){
            if(!b.hasClass(e.id,"mceSplitButtonDisabled")){
                b.removeClass(e.id,"mceSplitButtonHover")
                }
            })
    }
    },
destroy:function(){
    this.parent();
    a.clear(this.id+"_action");
    a.clear(this.id+"_open")
    }
})
})(tinymce);
(function(d){
    var c=d.DOM,a=d.dom.Event,b=d.is,e=d.each;
    d.create("tinymce.ui.ColorSplitButton:tinymce.ui.SplitButton",{
        ColorSplitButton:function(h,g){
            var f=this;
            f.parent(h,g);
            f.settings=g=d.extend({
                colors:"000000,993300,333300,003300,003366,000080,333399,333333,800000,FF6600,808000,008000,008080,0000FF,666699,808080,FF0000,FF9900,99CC00,339966,33CCCC,3366FF,800080,999999,FF00FF,FFCC00,FFFF00,00FF00,00FFFF,00CCFF,993366,C0C0C0,FF99CC,FFCC99,FFFF99,CCFFCC,CCFFFF,99CCFF,CC99FF,FFFFFF",
                grid_width:8,
                default_color:"#888888"
            },f.settings);
            f.onShowMenu=new d.util.Dispatcher(f);
            f.onHideMenu=new d.util.Dispatcher(f);
            f.value=g.default_color
            },
        showMenu:function(){
            var f=this,g,j,i,h;
            if(f.isDisabled()){
                return
            }
            if(!f.isMenuRendered){
                f.renderMenu();
                f.isMenuRendered=true
                }
                if(f.isMenuVisible){
                return f.hideMenu()
                }
                i=c.get(f.id);
            c.show(f.id+"_menu");
            c.addClass(i,"mceSplitButtonSelected");
            h=c.getPos(i);
            c.setStyles(f.id+"_menu",{
                left:h.x,
                top:h.y+i.clientHeight,
                zIndex:200000
            });
            i=0;
            a.add(c.doc,"mousedown",f.hideMenu,f);
            f.onShowMenu.dispatch(f);
            if(f._focused){
                f._keyHandler=a.add(f.id+"_menu","keydown",function(k){
                    if(k.keyCode==27){
                        f.hideMenu()
                        }
                    });
            c.select("a",f.id+"_menu")[0].focus()
            }
            f.isMenuVisible=1
        },
    hideMenu:function(g){
        var f=this;
        if(g&&g.type=="mousedown"&&c.getParent(g.target,function(h){
            return h.id===f.id+"_open"
            })){
            return
        }
        if(!g||!c.getParent(g.target,".mceSplitButtonMenu")){
            c.removeClass(f.id,"mceSplitButtonSelected");
            a.remove(c.doc,"mousedown",f.hideMenu,f);
            a.remove(f.id+"_menu","keydown",f._keyHandler);
            c.hide(f.id+"_menu")
            }
            f.onHideMenu.dispatch(f);
        f.isMenuVisible=0
        },
    renderMenu:function(){
        var k=this,f,j=0,l=k.settings,p,h,o,g;
        g=c.add(l.menu_container,"div",{
            id:k.id+"_menu",
            "class":l.menu_class+" "+l["class"],
            style:"position:absolute;left:0;top:-1000px;"
        });
        f=c.add(g,"div",{
            "class":l["class"]+" mceSplitButtonMenu"
            });
        c.add(f,"span",{
            "class":"mceMenuLine"
        });
        p=c.add(f,"table",{
            "class":"mceColorSplitMenu"
        });
        h=c.add(p,"tbody");
        j=0;
        e(b(l.colors,"array")?l.colors:l.colors.split(","),function(i){
            i=i.replace(/^#/,"");
            if(!j--){
                o=c.add(h,"tr");
                j=l.grid_width-1
                }
                p=c.add(o,"td");
            p=c.add(p,"a",{
                href:"javascript:;",
                style:{
                    backgroundColor:"#"+i
                    },
                _mce_color:"#"+i
                })
            });
        if(l.more_colors_func){
            p=c.add(h,"tr");
            p=c.add(p,"td",{
                colspan:l.grid_width,
                "class":"mceMoreColors"
            });
            p=c.add(p,"a",{
                id:k.id+"_more",
                href:"javascript:;",
                onclick:"return false;",
                "class":"mceMoreColors"
            },l.more_colors_title);
            a.add(p,"click",function(i){
                l.more_colors_func.call(l.more_colors_scope||this);
                return a.cancel(i)
                })
            }
            c.addClass(f,"mceColorSplitMenu");
        a.add(k.id+"_menu","click",function(i){
            var m;
            i=i.target;
            if(i.nodeName=="A"&&(m=i.getAttribute("_mce_color"))){
                k.setColor(m)
                }
                return a.cancel(i)
            });
        return g
        },
    setColor:function(g){
        var f=this;
        c.setStyle(f.id+"_preview","backgroundColor",g);
        f.value=g;
        f.hideMenu();
        f.settings.onselect(g)
        },
    postRender:function(){
        var f=this,g=f.id;
        f.parent();
        c.add(g+"_action","div",{
            id:g+"_preview",
            "class":"mceColorPreview"
        });
        c.setStyle(f.id+"_preview","backgroundColor",f.value)
        },
    destroy:function(){
        this.parent();
        a.clear(this.id+"_menu");
        a.clear(this.id+"_more");
        c.remove(this.id+"_menu")
        }
    })
})(tinymce);
tinymce.create("tinymce.ui.Toolbar:tinymce.ui.Container",{
    renderHTML:function(){
        var l=this,e="",g,j,b=tinymce.DOM,m=l.settings,d,a,f,k;
        k=l.controls;
        for(d=0;d<k.length;d++){
            j=k[d];
            a=k[d-1];
            f=k[d+1];
            if(d===0){
                g="mceToolbarStart";
                if(j.Button){
                    g+=" mceToolbarStartButton"
                    }else{
                    if(j.SplitButton){
                        g+=" mceToolbarStartSplitButton"
                        }else{
                        if(j.ListBox){
                            g+=" mceToolbarStartListBox"
                            }
                        }
                }
            e+=b.createHTML("td",{
            "class":g
        },b.createHTML("span",null,"<!-- IE -->"))
            }
            if(a&&j.ListBox){
            if(a.Button||a.SplitButton){
                e+=b.createHTML("td",{
                    "class":"mceToolbarEnd"
                },b.createHTML("span",null,"<!-- IE -->"))
                }
            }
        if(b.stdMode){
        e+='<td style="position: relative">'+j.renderHTML()+"</td>"
        }else{
        e+="<td>"+j.renderHTML()+"</td>"
        }
        if(f&&j.ListBox){
        if(f.Button||f.SplitButton){
            e+=b.createHTML("td",{
                "class":"mceToolbarStart"
            },b.createHTML("span",null,"<!-- IE -->"))
            }
        }
}
g="mceToolbarEnd";
if(j.Button){
    g+=" mceToolbarEndButton"
    }else{
    if(j.SplitButton){
        g+=" mceToolbarEndSplitButton"
        }else{
        if(j.ListBox){
            g+=" mceToolbarEndListBox"
            }
        }
}
e+=b.createHTML("td",{
    "class":g
},b.createHTML("span",null,"<!-- IE -->"));
return b.createHTML("table",{
    id:l.id,
    "class":"mceToolbar"+(m["class"]?" "+m["class"]:""),
    cellpadding:"0",
    cellspacing:"0",
    align:l.settings.align||""
    },"<tbody><tr>"+e+"</tr></tbody>")
}
});
(function(b){
    var a=b.util.Dispatcher,c=b.each;
    b.create("tinymce.AddOnManager",{
        items:[],
        urls:{},
        lookup:{},
        onAdd:new a(this),
        get:function(d){
            return this.lookup[d]
            },
        requireLangPack:function(e){
            var d=b.settings;
            if(d&&d.language){
                b.ScriptLoader.add(this.urls[e]+"/langs/"+d.language+".js")
                }
            },
    add:function(e,d){
        this.items.push(d);
        this.lookup[e]=d;
        this.onAdd.dispatch(this,e,d);
        return d
        },
    load:function(h,e,d,g){
        var f=this;
        if(f.urls[h]){
            return
        }
        if(e.indexOf("/")!=0&&e.indexOf("://")==-1){
            e=b.baseURL+"/"+e
            }
            f.urls[h]=e.substring(0,e.lastIndexOf("/"));
        b.ScriptLoader.add(e,d,g)
        }
    });
b.PluginManager=new b.AddOnManager();
    b.ThemeManager=new b.AddOnManager()
    }(tinymce));
(function(j){
    var g=j.each,d=j.extend,k=j.DOM,i=j.dom.Event,f=j.ThemeManager,b=j.PluginManager,e=j.explode,h=j.util.Dispatcher,a,c=0;
    j.documentBaseURL=window.location.href.replace(/[\?#].*$/,"").replace(/[\/\\][^\/]+$/,"");
    if(!/[\/\\]$/.test(j.documentBaseURL)){
        j.documentBaseURL+="/"
        }
        j.baseURL=new j.util.URI(j.documentBaseURL).toAbsolute(j.baseURL);
    j.baseURI=new j.util.URI(j.baseURL);
    j.onBeforeUnload=new h(j);
    i.add(window,"beforeunload",function(l){
        j.onBeforeUnload.dispatch(j,l)
        });
    j.onAddEditor=new h(j);
    j.onRemoveEditor=new h(j);
    j.EditorManager=d(j,{
        editors:[],
        i18n:{},
        activeEditor:null,
        init:function(q){
            var n=this,p,l=j.ScriptLoader,u,o=[],m;
            function r(x,y,t){
                var v=x[y];
                if(!v){
                    return
                }
                if(j.is(v,"string")){
                    t=v.replace(/\.\w+$/,"");
                    t=t?j.resolve(t):0;
                    v=j.resolve(v)
                    }
                    return v.apply(t||this,Array.prototype.slice.call(arguments,2))
                }
                q=d({
                theme:"simple",
                language:"en"
            },q);
            n.settings=q;
            i.add(document,"init",function(){
                var s,v;
                r(q,"onpageload");
                switch(q.mode){
                    case"exact":
                        s=q.elements||"";
                        if(s.length>0){
                        g(e(s),function(x){
                            if(k.get(x)){
                                m=new j.Editor(x,q);
                                o.push(m);
                                m.render(1)
                                }else{
                                g(document.forms,function(y){
                                    g(y.elements,function(z){
                                        if(z.name===x){
                                            x="mce_editor_"+c++;
                                            k.setAttrib(z,"id",x);
                                            m=new j.Editor(x,q);
                                            o.push(m);
                                            m.render(1)
                                            }
                                        })
                                })
                            }
                        })
                    }
                    break;
            case"textareas":case"specific_textareas":
                function t(y,x){
                return x.constructor===RegExp?x.test(y.className):k.hasClass(y,x)
                }
                g(k.select("textarea"),function(x){
                if(q.editor_deselector&&t(x,q.editor_deselector)){
                    return
                }
                if(!q.editor_selector||t(x,q.editor_selector)){
                    u=k.get(x.name);
                    if(!x.id&&!u){
                        x.id=x.name
                        }
                        if(!x.id||n.get(x.id)){
                        x.id=k.uniqueId()
                        }
                        m=new j.Editor(x.id,q);
                    o.push(m);
                    m.render(1)
                    }
                });
            break
            }
            if(q.oninit){
            s=v=0;
            g(o,function(x){
                v++;
                if(!x.initialized){
                    x.onInit.add(function(){
                        s++;
                        if(s==v){
                            r(q,"oninit")
                            }
                        })
                }else{
                s++
            }
            if(s==v){
                r(q,"oninit")
                }
            })
    }
    })
},
get:function(l){
    if(l===a){
        return this.editors
        }
        return this.editors[l]
    },
getInstanceById:function(l){
    return this.get(l)
    },
add:function(m){
    var l=this,n=l.editors;
    n[m.id]=m;
    n.push(m);
    l._setActive(m);
    l.onAddEditor.dispatch(l,m);
    return m
    },
remove:function(n){
    var m=this,l,o=m.editors;
    if(!o[n.id]){
        return null
        }
        delete o[n.id];
    for(l=0;l<o.length;l++){
        if(o[l]==n){
            o.splice(l,1);
            break
        }
    }
    if(m.activeEditor==n){
    m._setActive(o[0])
    }
    n.destroy();
m.onRemoveEditor.dispatch(m,n);
return n
},
execCommand:function(r,p,o){
    var q=this,n=q.get(o),l;
    switch(r){
        case"mceFocus":
            n.focus();
            return true;
        case"mceAddEditor":case"mceAddControl":
            if(!q.get(o)){
            new j.Editor(o,q.settings).render()
            }
            return true;
        case"mceAddFrameControl":
            l=o.window;
            l.tinyMCE=tinyMCE;
            l.tinymce=j;
            j.DOM.doc=l.document;
            j.DOM.win=l;
            n=new j.Editor(o.element_id,o);
            n.render();
            if(j.isIE){
            function m(){
                n.destroy();
                l.detachEvent("onunload",m);
                l=l.tinyMCE=l.tinymce=null
                }
                l.attachEvent("onunload",m)
            }
            o.page_window=null;
        return true;
        case"mceRemoveEditor":case"mceRemoveControl":
            if(n){
            n.remove()
            }
            return true;
        case"mceToggleEditor":
            if(!n){
            q.execCommand("mceAddControl",0,o);
            return true
            }
            if(n.isHidden()){
            n.show()
            }else{
            n.hide()
            }
            return true
        }
        if(q.activeEditor){
        return q.activeEditor.execCommand(r,p,o)
        }
        return false
    },
execInstanceCommand:function(p,o,n,m){
    var l=this.get(p);
    if(l){
        return l.execCommand(o,n,m)
        }
        return false
    },
triggerSave:function(){
    g(this.editors,function(l){
        l.save()
        })
    },
addI18n:function(n,q){
    var l,m=this.i18n;
    if(!j.is(n,"string")){
        g(n,function(r,p){
            g(r,function(t,s){
                g(t,function(v,u){
                    if(s==="common"){
                        m[p+"."+u]=v
                        }else{
                        m[p+"."+s+"."+u]=v
                        }
                    })
            })
        })
    }else{
    g(q,function(r,p){
        m[n+"."+p]=r
        })
    }
},
_setActive:function(l){
    this.selectedInstance=this.activeEditor=l
    }
})
})(tinymce);
(function(m){
    var n=m.DOM,j=m.dom.Event,f=m.extend,k=m.util.Dispatcher,i=m.each,a=m.isGecko,b=m.isIE,e=m.isWebKit,d=m.is,h=m.ThemeManager,c=m.PluginManager,o=m.inArray,l=m.grep,g=m.explode;
    m.create("tinymce.Editor",{
        Editor:function(r,q){
            var p=this;
            p.id=p.editorId=r;
            p.execCommands={};

            p.queryStateCommands={};

            p.queryValueCommands={};

            p.isNotDirty=false;
            p.plugins={};

            i(["onPreInit","onBeforeRenderUI","onPostRender","onInit","onRemove","onActivate","onDeactivate","onClick","onEvent","onMouseUp","onMouseDown","onDblClick","onKeyDown","onKeyUp","onKeyPress","onContextMenu","onSubmit","onReset","onPaste","onPreProcess","onPostProcess","onBeforeSetContent","onBeforeGetContent","onSetContent","onGetContent","onLoadContent","onSaveContent","onNodeChange","onChange","onBeforeExecCommand","onExecCommand","onUndo","onRedo","onVisualAid","onSetProgressState"],function(s){
                p[s]=new k(p)
                });
            p.settings=q=f({
                id:r,
                language:"en",
                docs_language:"en",
                theme:"simple",
                skin:"default",
                delta_width:0,
                delta_height:0,
                popup_css:"",
                plugins:"",
                document_base_url:m.documentBaseURL,
                add_form_submit_trigger:1,
                submit_patch:1,
                add_unload_trigger:1,
                convert_urls:1,
                relative_urls:1,
                remove_script_host:1,
                table_inline_editing:0,
                object_resizing:1,
                cleanup:1,
                accessibility_focus:1,
                custom_shortcuts:1,
                custom_undo_redo_keyboard_shortcuts:1,
                custom_undo_redo_restore_selection:1,
                custom_undo_redo:1,
                doctype:m.isIE6?'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">':"<!DOCTYPE>",
                visual_table_class:"mceItemTable",
                visual:1,
                font_size_style_values:"xx-small,x-small,small,medium,large,x-large,xx-large",
                apply_source_formatting:1,
                directionality:"ltr",
                forced_root_block:"p",
                valid_elements:"@[id|class|style|title|dir<ltr?rtl|lang|xml::lang|onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup],a[rel|rev|charset|hreflang|tabindex|accesskey|type|name|href|target|title|class|onfocus|onblur],strong/b,em/i,strike,u,#p,-ol[type|compact],-ul[type|compact],-li,br,img[longdesc|usemap|src|border|alt=|title|hspace|vspace|width|height|align],-sub,-sup,-blockquote[cite],-table[border|cellspacing|cellpadding|width|frame|rules|height|align|summary|bgcolor|background|bordercolor],-tr[rowspan|width|height|align|valign|bgcolor|background|bordercolor],tbody,thead,tfoot,#td[colspan|rowspan|width|height|align|valign|bgcolor|background|bordercolor|scope],#th[colspan|rowspan|width|height|align|valign|scope],caption,-div,-span,-code,-pre,address,-h1,-h2,-h3,-h4,-h5,-h6,hr[size|noshade],-font[face|size|color],dd,dl,dt,cite,abbr,acronym,del[datetime|cite],ins[datetime|cite],object[classid|width|height|codebase|*],param[name|value],embed[type|width|height|src|*],script[src|type],map[name],area[shape|coords|href|alt|target],bdo,button,col[align|char|charoff|span|valign|width],colgroup[align|char|charoff|span|valign|width],dfn,fieldset,form[action|accept|accept-charset|enctype|method],input[accept|alt|checked|disabled|maxlength|name|readonly|size|src|type|value|tabindex|accesskey],kbd,label[for],legend,noscript,optgroup[label|disabled],option[disabled|label|selected|value],q[cite],samp,select[disabled|multiple|name|size],small,textarea[cols|rows|disabled|name|readonly],tt,var,big",
                hidden_input:1,
                padd_empty_editor:1,
                render_ui:1,
                init_theme:1,
                force_p_newlines:1,
                indentation:"30px",
                keep_styles:1,
                fix_table_elements:1,
                inline_styles:1,
                convert_fonts_to_spans:true
            },q);
            p.documentBaseURI=new m.util.URI(q.document_base_url||m.documentBaseURL,{
                base_uri:tinyMCE.baseURI
                });
            p.baseURI=m.baseURI;
            p.execCallback("setup",p)
            },
        render:function(r){
            var u=this,v=u.settings,x=u.id,p=m.ScriptLoader;
            if(!j.domLoaded){
                j.add(document,"init",function(){
                    u.render()
                    });
                return
            }
            tinyMCE.settings=v;
            if(!u.getElement()){
                return
            }
            if(m.isIDevice){
                return
            }
            if(!/TEXTAREA|INPUT/i.test(u.getElement().nodeName)&&v.hidden_input&&n.getParent(x,"form")){
                n.insertAfter(n.create("input",{
                    type:"hidden",
                    name:x
                }),x)
                }
                if(m.WindowManager){
                u.windowManager=new m.WindowManager(u)
                }
                if(v.encoding=="xml"){
                u.onGetContent.add(function(s,t){
                    if(t.save){
                        t.content=n.encode(t.content)
                        }
                    })
            }
            if(v.add_form_submit_trigger){
            u.onSubmit.addToTop(function(){
                if(u.initialized){
                    u.save();
                    u.isNotDirty=1
                    }
                })
        }
        if(v.add_unload_trigger){
        u._beforeUnload=tinyMCE.onBeforeUnload.add(function(){
            if(u.initialized&&!u.destroyed&&!u.isHidden()){
                u.save({
                    format:"raw",
                    no_events:true
                })
                }
            })
    }
    m.addUnload(u.destroy,u);
    if(v.submit_patch){
        u.onBeforeRenderUI.add(function(){
            var s=u.getElement().form;
            if(!s){
                return
            }
            if(s._mceOldSubmit){
                return
            }
            if(!s.submit.nodeType&&!s.submit.length){
                u.formElement=s;
                s._mceOldSubmit=s.submit;
                s.submit=function(){
                    m.triggerSave();
                    u.isNotDirty=1;
                    return u.formElement._mceOldSubmit(u.formElement)
                    }
                }
            s=null
        })
    }
    function q(){
    if(v.language){
        p.add(m.baseURL+"/langs/"+v.language+".js")
        }
        if(v.theme&&v.theme.charAt(0)!="-"&&!h.urls[v.theme]){
        h.load(v.theme,"themes/"+v.theme+"/editor_template"+m.suffix+".js")
        }
        i(g(v.plugins),function(s){
        if(s&&s.charAt(0)!="-"&&!c.urls[s]){
            if(s=="safari"){
                return
            }
            c.load(s,"plugins/"+s+"/editor_plugin"+m.suffix+".js")
            }
        });
p.loadQueue(function(){
    if(!u.removed){
        u.init()
        }
    })
}
q()
},
init:function(){
    var r,E=this,F=E.settings,B,y,A=E.getElement(),q,p,C,x,z,D;
    m.add(E);
    if(F.theme){
        F.theme=F.theme.replace(/-/,"");
        q=h.get(F.theme);
        E.theme=new q();
        if(E.theme.init&&F.init_theme){
            E.theme.init(E,h.urls[F.theme]||m.documentBaseURL.replace(/\/$/,""))
            }
        }
    i(g(F.plugins.replace(/\-/g,"")),function(G){
    var H=c.get(G),t=c.urls[G]||m.documentBaseURL.replace(/\/$/,""),s;
    if(H){
        s=new H(E,t);
        E.plugins[G]=s;
        if(s.init){
            s.init(E,t)
            }
        }
});
if(F.popup_css!==false){
    if(F.popup_css){
        F.popup_css=E.documentBaseURI.toAbsolute(F.popup_css)
        }else{
        F.popup_css=E.baseURI.toAbsolute("themes/"+F.theme+"/skins/"+F.skin+"/dialog.css")
        }
    }
if(F.popup_css_add){
    F.popup_css+=","+E.documentBaseURI.toAbsolute(F.popup_css_add)
    }
    E.controlManager=new m.ControlManager(E);
if(F.custom_undo_redo){
    E.onBeforeExecCommand.add(function(t,G,u,H,s){
        if(G!="Undo"&&G!="Redo"&&G!="mceRepaint"&&(!s||!s.skip_undo)){
            if(!E.undoManager.hasUndo()){
                E.undoManager.add()
                }
            }
    });
E.onExecCommand.add(function(t,G,u,H,s){
    if(G!="Undo"&&G!="Redo"&&G!="mceRepaint"&&(!s||!s.skip_undo)){
        E.undoManager.add()
        }
    })
}
E.onExecCommand.add(function(s,t){
    if(!/^(FontName|FontSize)$/.test(t)){
        E.nodeChanged()
        }
    });
if(a){
    function v(s,t){
        if(!t||!t.initial){
            E.execCommand("mceRepaint")
            }
        }
    E.onUndo.add(v);
E.onRedo.add(v);
E.onSetContent.add(v)
}
E.onBeforeRenderUI.dispatch(E,E.controlManager);
if(F.render_ui){
    B=F.width||A.style.width||A.offsetWidth;
    y=F.height||A.style.height||A.offsetHeight;
    E.orgDisplay=A.style.display;
    D=/^[0-9\.]+(|px)$/i;
    if(D.test(""+B)){
        B=Math.max(parseInt(B)+(q.deltaWidth||0),100)
        }
        if(D.test(""+y)){
        y=Math.max(parseInt(y)+(q.deltaHeight||0),100)
        }
        q=E.theme.renderUI({
        targetNode:A,
        width:B,
        height:y,
        deltaWidth:F.delta_width,
        deltaHeight:F.delta_height
        });
    E.editorContainer=q.editorContainer
    }
    if(document.domain&&location.hostname!=document.domain){
    m.relaxedDomain=document.domain
    }
    n.setStyles(q.sizeContainer||q.editorContainer,{
    width:B,
    height:y
});
y=(q.iframeHeight||y)+(typeof(y)=="number"?(q.deltaHeight||0):"");
if(y<100){
    y=100
    }
    E.iframeHTML=F.doctype+'<html><head xmlns="http://www.w3.org/1999/xhtml">';
if(F.document_base_url!=m.documentBaseURL){
    E.iframeHTML+='<base href="'+E.documentBaseURI.getURI()+'" />'
    }
    E.iframeHTML+='<meta http-equiv="X-UA-Compatible" content="IE=7" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
if(m.relaxedDomain){
    E.iframeHTML+='<script type="text/javascript">document.domain = "'+m.relaxedDomain+'";<\/script>'
    }
    x=F.body_id||"tinymce";
if(x.indexOf("=")!=-1){
    x=E.getParam("body_id","","hash");
    x=x[E.id]||x
    }
    z=F.body_class||"";
if(z.indexOf("=")!=-1){
    z=E.getParam("body_class","","hash");
    z=z[E.id]||""
    }
    E.iframeHTML+='</head><body id="'+x+'" class="mceContentBody '+z+'"></body></html>';
if(m.relaxedDomain){
    if(b||(m.isOpera&&parseFloat(opera.version())>=9.5)){
        C='javascript:(function(){document.open();document.domain="'+document.domain+'";var ed = window.parent.tinyMCE.get("'+E.id+'");document.write(ed.iframeHTML);document.close();ed.setupIframe();})()'
        }else{
        if(m.isOpera){
            C='javascript:(function(){document.open();document.domain="'+document.domain+'";document.close();ed.setupIframe();})()'
            }
        }
}
r=n.add(q.iframeContainer,"iframe",{
    id:E.id+"_ifr",
    src:C||'javascript:""',
    frameBorder:"0",
    style:{
        width:"100%",
        height:y
    }
});
E.contentAreaContainer=q.iframeContainer;
n.get(q.editorContainer).style.display=E.orgDisplay;
n.get(E.id).style.display="none";
if(!b||!m.relaxedDomain){
    E.setupIframe()
    }
    A=r=q=null
},
setupIframe:function(){
    var z=this,A=z.settings,r=n.get(z.id),u=z.getDoc(),q,x;
    if(!b||!m.relaxedDomain){
        u.open();
        u.write(z.iframeHTML);
        u.close()
        }
        if(!b){
        try{
            if(!A.readonly){
                u.designMode="On"
                }
            }catch(v){}
}
if(b){
    x=z.getBody();
    n.hide(x);
    if(!A.readonly){
        x.contentEditable=true
        }
        n.show(x)
    }
    z.dom=new m.dom.DOMUtils(z.getDoc(),{
    keep_values:true,
    url_converter:z.convertURL,
    url_converter_scope:z,
    hex_colors:A.force_hex_style_colors,
    class_filter:A.class_filter,
    update_styles:1,
    fix_ie_paragraphs:1,
    valid_styles:A.valid_styles
    });
z.schema=new m.dom.Schema();
z.serializer=new m.dom.Serializer(f(A,{
    valid_elements:A.verify_html===false?"*[*]":A.valid_elements,
    dom:z.dom,
    schema:z.schema
    }));
z.selection=new m.dom.Selection(z.dom,z.getWin(),z.serializer);
z.formatter=new m.Formatter(this);
z.formatter.register({
    alignleft:[{
        selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
        styles:{
            textAlign:"left"
        }
    },{
    selector:"img,table",
    styles:{
        "float":"left"
    }
}],
aligncenter:[{
    selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
    styles:{
        textAlign:"center"
    }
},{
    selector:"img",
    styles:{
        display:"block",
        marginLeft:"auto",
        marginRight:"auto"
    }
},{
    selector:"table",
    styles:{
        marginLeft:"auto",
        marginRight:"auto"
    }
}],
alignright:[{
    selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
    styles:{
        textAlign:"right"
    }
},{
    selector:"img,table",
    styles:{
        "float":"right"
    }
}],
alignfull:[{
    selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
    styles:{
        textAlign:"justify"
    }
}],
bold:[{
    inline:"strong"
},{
    inline:"span",
    styles:{
        fontWeight:"bold"
    }
},{
    inline:"b"
}],
italic:[{
    inline:"em"
},{
    inline:"span",
    styles:{
        fontStyle:"italic"
    }
},{
    inline:"i"
}],
underline:[{
    inline:"span",
    styles:{
        textDecoration:"underline"
    },
    exact:true
},{
    inline:"u"
}],
strikethrough:[{
    inline:"span",
    styles:{
        textDecoration:"line-through"
    },
    exact:true
},{
    inline:"u"
}],
forecolor:{
    inline:"span",
    styles:{
        color:"%value"
    }
},
hilitecolor:{
    inline:"span",
    styles:{
        backgroundColor:"%value"
    }
},
fontname:{
    inline:"span",
    styles:{
        fontFamily:"%value"
    }
},
fontsize:{
    inline:"span",
    styles:{
        fontSize:"%value"
    }
},
fontsize_class:{
    inline:"span",
    attributes:{
        "class":"%value"
    }
},
blockquote:{
    block:"blockquote",
    wrapper:1,
    remove:"all"
},
removeformat:[{
    selector:"b,strong,em,i,font,u,strike",
    remove:"all",
    split:true,
    expand:false,
    block_expand:true,
    deep:true
},{
    selector:"span",
    attributes:["style","class"],
    remove:"empty",
    split:true,
    expand:false,
    deep:true
},{
    selector:"*",
    attributes:["style","class"],
    split:false,
    expand:false,
    deep:true
}]
});
i("p h1 h2 h3 h4 h5 h6 div address pre div code dt dd samp".split(/\s/),function(s){
    z.formatter.register(s,{
        block:s,
        remove:"all"
    })
    });
z.formatter.register(z.settings.formats);
z.undoManager=new m.UndoManager(z);
z.undoManager.onAdd.add(function(t,s){
    if(!s.initial){
        return z.onChange.dispatch(z,s,t)
        }
    });
z.undoManager.onUndo.add(function(t,s){
    return z.onUndo.dispatch(z,s,t)
    });
z.undoManager.onRedo.add(function(t,s){
    return z.onRedo.dispatch(z,s,t)
    });
z.forceBlocks=new m.ForceBlocks(z,{
    forced_root_block:A.forced_root_block
    });
z.editorCommands=new m.EditorCommands(z);
z.serializer.onPreProcess.add(function(s,t){
    return z.onPreProcess.dispatch(z,t,s)
    });
z.serializer.onPostProcess.add(function(s,t){
    return z.onPostProcess.dispatch(z,t,s)
    });
z.onPreInit.dispatch(z);
if(!A.gecko_spellcheck){
    z.getBody().spellcheck=0
    }
    if(!A.readonly){
    z._addEvents()
    }
    z.controlManager.onPostRender.dispatch(z,z.controlManager);
z.onPostRender.dispatch(z);
if(A.directionality){
    z.getBody().dir=A.directionality
    }
    if(A.nowrap){
    z.getBody().style.whiteSpace="nowrap"
    }
    if(A.custom_elements){
    function y(s,t){
        i(g(A.custom_elements),function(B){
            var C;
            if(B.indexOf("~")===0){
                B=B.substring(1);
                C="span"
                }else{
                C="div"
                }
                t.content=t.content.replace(new RegExp("<("+B+")([^>]*)>","g"),"<"+C+' _mce_name="$1"$2>');
            t.content=t.content.replace(new RegExp("</("+B+")>","g"),"</"+C+">")
            })
        }
        z.onBeforeSetContent.add(y);
    z.onPostProcess.add(function(s,t){
        if(t.set){
            y(s,t)
            }
        })
}
if(A.handle_node_change_callback){
    z.onNodeChange.add(function(t,s,B){
        z.execCallback("handle_node_change_callback",z.id,B,-1,-1,true,z.selection.isCollapsed())
        })
    }
    if(A.save_callback){
    z.onSaveContent.add(function(s,B){
        var t=z.execCallback("save_callback",z.id,B.content,z.getBody());
        if(t){
            B.content=t
            }
        })
}
if(A.onchange_callback){
    z.onChange.add(function(t,s){
        z.execCallback("onchange_callback",z,s)
        })
    }
    if(A.convert_newlines_to_brs){
    z.onBeforeSetContent.add(function(s,t){
        if(t.initial){
            t.content=t.content.replace(/\r?\n/g,"<br />")
            }
        })
}
if(A.fix_nesting&&b){
    z.onBeforeSetContent.add(function(s,t){
        t.content=z._fixNesting(t.content)
        })
    }
    if(A.preformatted){
    z.onPostProcess.add(function(s,t){
        t.content=t.content.replace(/^\s*<pre.*?>/,"");
        t.content=t.content.replace(/<\/pre>\s*$/,"");
        if(t.set){
            t.content='<pre class="mceItemHidden">'+t.content+"</pre>"
            }
        })
}
if(A.verify_css_classes){
    z.serializer.attribValueFilter=function(D,B){
        var C,t;
        if(D=="class"){
            if(!z.classesRE){
                t=z.dom.getClasses();
                if(t.length>0){
                    C="";
                    i(t,function(s){
                        C+=(C?"|":"")+s["class"]
                        });
                    z.classesRE=new RegExp("("+C+")","gi")
                    }
                }
            return !z.classesRE||/(\bmceItem\w+\b|\bmceTemp\w+\b)/g.test(B)||z.classesRE.test(B)?B:""
        }
        return B
    }
}
if(A.cleanup_callback){
    z.onBeforeSetContent.add(function(s,t){
        t.content=z.execCallback("cleanup_callback","insert_to_editor",t.content,t)
        });
    z.onPreProcess.add(function(s,t){
        if(t.set){
            z.execCallback("cleanup_callback","insert_to_editor_dom",t.node,t)
            }
            if(t.get){
            z.execCallback("cleanup_callback","get_from_editor_dom",t.node,t)
            }
        });
z.onPostProcess.add(function(s,t){
    if(t.set){
        t.content=z.execCallback("cleanup_callback","insert_to_editor",t.content,t)
        }
        if(t.get){
        t.content=z.execCallback("cleanup_callback","get_from_editor",t.content,t)
        }
    })
}
if(A.save_callback){
    z.onGetContent.add(function(s,t){
        if(t.save){
            t.content=z.execCallback("save_callback",z.id,t.content,z.getBody())
            }
        })
}
if(A.handle_event_callback){
    z.onEvent.add(function(s,t,B){
        if(z.execCallback("handle_event_callback",t,s,B)===false){
            j.cancel(t)
            }
        })
}
z.onSetContent.add(function(){
    z.addVisual(z.getBody())
    });
if(A.padd_empty_editor){
    z.onPostProcess.add(function(s,t){
        t.content=t.content.replace(/^(<p[^>]*>(&nbsp;|&#160;|\s|\u00a0|)<\/p>[\r\n]*|<br \/>[\r\n]*)$/,"")
        })
    }
    if(a){
    function p(s,t){
        i(s.dom.select("a"),function(C){
            var B=C.parentNode;
            if(s.dom.isBlock(B)&&B.lastChild===C){
                s.dom.add(B,"br",{
                    _mce_bogus:1
                })
                }
            })
    }
    z.onExecCommand.add(function(s,t){
    if(t==="CreateLink"){
        p(s)
        }
    });
z.onSetContent.add(z.selection.onSetContent.add(p));
if(!A.readonly){
    try{
        u.designMode="Off";
        u.designMode="On"
        }catch(v){}
}
}
setTimeout(function(){
    if(z.removed){
        return
    }
    z.load({
        initial:true,
        format:(A.cleanup_on_startup?"html":"raw")
        });
    z.startContent=z.getContent({
        format:"raw"
    });
    z.initialized=true;
    z.onInit.dispatch(z);
    z.execCallback("setupcontent_callback",z.id,z.getBody(),z.getDoc());
    z.execCallback("init_instance_callback",z);
    z.focus(true);
    z.nodeChanged({
        initial:1
    });
    if(A.content_css){
        m.each(g(A.content_css),function(s){
            z.dom.loadCSS(z.documentBaseURI.toAbsolute(s))
            })
        }
        if(A.auto_focus){
        setTimeout(function(){
            var s=m.get(A.auto_focus);
            s.selection.select(s.getBody(),1);
            s.selection.collapse(1);
            s.getWin().focus()
            },100)
        }
    },1);
r=null
},
focus:function(s){
    var x,q=this,v=q.settings.content_editable,r,p,u=q.getDoc();
    if(!s){
        r=q.selection.getRng();
        if(r.item){
            p=r.item(0)
            }
            if(!v){
            q.getWin().focus()
            }
            if(p&&p.ownerDocument==u){
            r=u.body.createControlRange();
            r.addElement(p);
            r.select()
            }
        }
    if(m.activeEditor!=q){
    if((x=m.activeEditor)!=null){
        x.onDeactivate.dispatch(x,q)
        }
        q.onActivate.dispatch(q,x)
    }
    m._setActive(q)
},
execCallback:function(u){
    var p=this,r=p.settings[u],q;
    if(!r){
        return
    }
    if(p.callbackLookup&&(q=p.callbackLookup[u])){
        r=q.func;
        q=q.scope
        }
        if(d(r,"string")){
        q=r.replace(/\.\w+$/,"");
        q=q?m.resolve(q):0;
        r=m.resolve(r);
        p.callbackLookup=p.callbackLookup||{};

        p.callbackLookup[u]={
            func:r,
            scope:q
        }
    }
    return r.apply(q||p,Array.prototype.slice.call(arguments,1))
},
translate:function(p){
    var r=this.settings.language||"en",q=m.i18n;
    if(!p){
        return""
        }
        return q[r+"."+p]||p.replace(/{\#([^}]+)\}/g,function(t,s){
        return q[r+"."+s]||"{#"+s+"}"
        })
    },
getLang:function(q,p){
    return m.i18n[(this.settings.language||"en")+"."+q]||(d(p)?p:"{#"+q+"}")
    },
getParam:function(u,r,p){
    var s=m.trim,q=d(this.settings[u])?this.settings[u]:r,t;
    if(p==="hash"){
        t={};

        if(d(q,"string")){
            i(q.indexOf("=")>0?q.split(/[;,](?![^=;,]*(?:[;,]|$))/):q.split(","),function(x){
                x=x.split("=");
                if(x.length>1){
                    t[s(x[0])]=s(x[1])
                    }else{
                    t[s(x[0])]=s(x)
                    }
                })
        }else{
        t=q
        }
        return t
    }
    return q
},
nodeChanged:function(r){
    var p=this,q=p.selection,u=(b?q.getNode():q.getStart())||p.getBody();
    if(p.initialized){
        r=r||{};

        u=b&&u.ownerDocument!=p.getDoc()?p.getBody():u;
        r.parents=[];
        p.dom.getParent(u,function(s){
            if(s.nodeName=="BODY"){
                return true
                }
                r.parents.push(s)
            });
        p.onNodeChange.dispatch(p,r?r.controlManager||p.controlManager:p.controlManager,u,q.isCollapsed(),r)
        }
    },
addButton:function(r,q){
    var p=this;
    p.buttons=p.buttons||{};

    p.buttons[r]=q
    },
addCommand:function(r,q,p){
    this.execCommands[r]={
        func:q,
        scope:p||this
        }
    },
addQueryStateHandler:function(r,q,p){
    this.queryStateCommands[r]={
        func:q,
        scope:p||this
        }
    },
addQueryValueHandler:function(r,q,p){
    this.queryValueCommands[r]={
        func:q,
        scope:p||this
        }
    },
addShortcut:function(r,u,p,s){
    var q=this,v;
    if(!q.settings.custom_shortcuts){
        return false
        }
        q.shortcuts=q.shortcuts||{};

    if(d(p,"string")){
        v=p;
        p=function(){
            q.execCommand(v,false,null)
            }
        }
    if(d(p,"object")){
    v=p;
    p=function(){
        q.execCommand(v[0],v[1],v[2])
        }
    }
i(g(r),function(t){
    var x={
        func:p,
        scope:s||this,
        desc:u,
        alt:false,
        ctrl:false,
        shift:false
    };

    i(g(t,"+"),function(y){
        switch(y){
            case"alt":case"ctrl":case"shift":
                x[y]=true;
                break;
            default:
                x.charCode=y.charCodeAt(0);
                x.keyCode=y.toUpperCase().charCodeAt(0)
                }
            });
q.shortcuts[(x.ctrl?"ctrl":"")+","+(x.alt?"alt":"")+","+(x.shift?"shift":"")+","+x.keyCode]=x
    });
return true
},
execCommand:function(x,v,z,p){
    var r=this,u=0,y,q;
    if(!/^(mceAddUndoLevel|mceEndUndoLevel|mceBeginUndoLevel|mceRepaint|SelectAll)$/.test(x)&&(!p||!p.skip_focus)){
        r.focus()
        }
        y={};

    r.onBeforeExecCommand.dispatch(r,x,v,z,y);
    if(y.terminate){
        return false
        }
        if(r.execCallback("execcommand_callback",r.id,r.selection.getNode(),x,v,z)){
        r.onExecCommand.dispatch(r,x,v,z,p);
        return true
        }
        if(y=r.execCommands[x]){
        q=y.func.call(y.scope,v,z);
        if(q!==true){
            r.onExecCommand.dispatch(r,x,v,z,p);
            return q
            }
        }
    i(r.plugins,function(s){
    if(s.execCommand&&s.execCommand(x,v,z)){
        r.onExecCommand.dispatch(r,x,v,z,p);
        u=1;
        return false
        }
    });
if(u){
    return true
    }
    if(r.theme&&r.theme.execCommand&&r.theme.execCommand(x,v,z)){
    r.onExecCommand.dispatch(r,x,v,z,p);
    return true
    }
    if(m.GlobalCommands.execCommand(r,x,v,z)){
    r.onExecCommand.dispatch(r,x,v,z,p);
    return true
    }
    if(r.editorCommands.execCommand(x,v,z)){
    r.onExecCommand.dispatch(r,x,v,z,p);
    return true
    }
    r.getDoc().execCommand(x,v,z);
r.onExecCommand.dispatch(r,x,v,z,p)
},
queryCommandState:function(u){
    var q=this,v,r;
    if(q._isHidden()){
        return
    }
    if(v=q.queryStateCommands[u]){
        r=v.func.call(v.scope);
        if(r!==true){
            return r
            }
        }
    v=q.editorCommands.queryCommandState(u);
if(v!==-1){
    return v
    }
    try{
    return this.getDoc().queryCommandState(u)
    }catch(p){}
},
queryCommandValue:function(v){
    var q=this,u,r;
    if(q._isHidden()){
        return
    }
    if(u=q.queryValueCommands[v]){
        r=u.func.call(u.scope);
        if(r!==true){
            return r
            }
        }
    u=q.editorCommands.queryCommandValue(v);
if(d(u)){
    return u
    }
    try{
    return this.getDoc().queryCommandValue(v)
    }catch(p){}
},
show:function(){
    var p=this;
    n.show(p.getContainer());
    n.hide(p.id);
    p.load()
    },
hide:function(){
    var p=this,q=p.getDoc();
    if(b&&q){
        q.execCommand("SelectAll")
        }
        p.save();
    n.hide(p.getContainer());
    n.setStyle(p.id,"display",p.orgDisplay)
    },
isHidden:function(){
    return !n.isHidden(this.id)
    },
setProgressState:function(p,q,r){
    this.onSetProgressState.dispatch(this,p,q,r);
    return p
    },
load:function(s){
    var p=this,r=p.getElement(),q;
    if(r){
        s=s||{};

        s.load=true;
        q=p.setContent(d(r.value)?r.value:r.innerHTML,s);
        s.element=r;
        if(!s.no_events){
            p.onLoadContent.dispatch(p,s)
            }
            s.element=r=null;
        return q
        }
    },
save:function(u){
    var p=this,s=p.getElement(),q,r;
    if(!s||!p.initialized){
        return
    }
    u=u||{};

    u.save=true;
    if(!u.no_events){
        p.undoManager.typing=0;
        p.undoManager.add()
        }
        u.element=s;
    q=u.content=p.getContent(u);
    if(!u.no_events){
        p.onSaveContent.dispatch(p,u)
        }
        q=u.content;
    if(!/TEXTAREA|INPUT/i.test(s.nodeName)){
        s.innerHTML=q;
        if(r=n.getParent(p.id,"form")){
            i(r.elements,function(t){
                if(t.name==p.id){
                    t.value=q;
                    return false
                    }
                })
        }
    }else{
    s.value=q
    }
    u.element=s=null;
return q
},
setContent:function(q,r){
    var p=this;
    r=r||{};

    r.format=r.format||"html";
    r.set=true;
    r.content=q;
    if(!r.no_events){
        p.onBeforeSetContent.dispatch(p,r)
        }
        if(!m.isIE&&(q.length===0||/^\s+$/.test(q))){
        r.content=p.dom.setHTML(p.getBody(),'<br _mce_bogus="1" />');
        r.format="raw"
        }
        r.content=p.dom.setHTML(p.getBody(),m.trim(r.content));
    if(r.format!="raw"&&p.settings.cleanup){
        r.getInner=true;
        r.content=p.dom.setHTML(p.getBody(),p.serializer.serialize(p.getBody(),r))
        }
        if(!r.no_events){
        p.onSetContent.dispatch(p,r)
        }
        return r.content
    },
getContent:function(r){
    var p=this,q;
    r=r||{};

    r.format=r.format||"html";
    r.get=true;
    if(!r.no_events){
        p.onBeforeGetContent.dispatch(p,r)
        }
        if(r.format!="raw"&&p.settings.cleanup){
        r.getInner=true;
        q=p.serializer.serialize(p.getBody(),r)
        }else{
        q=p.getBody().innerHTML
        }
        q=q.replace(/^\s*|\s*$/g,"");
    r.content=q;
    if(!r.no_events){
        p.onGetContent.dispatch(p,r)
        }
        return r.content
    },
isDirty:function(){
    var p=this;
    return m.trim(p.startContent)!=m.trim(p.getContent({
        format:"raw",
        no_events:1
    }))&&!p.isNotDirty
    },
getContainer:function(){
    var p=this;
    if(!p.container){
        p.container=n.get(p.editorContainer||p.id+"_parent")
        }
        return p.container
    },
getContentAreaContainer:function(){
    return this.contentAreaContainer
    },
getElement:function(){
    return n.get(this.settings.content_element||this.id)
    },
getWin:function(){
    var p=this,q;
    if(!p.contentWindow){
        q=n.get(p.id+"_ifr");
        if(q){
            p.contentWindow=q.contentWindow
            }
        }
    return p.contentWindow
},
getDoc:function(){
    var q=this,p;
    if(!q.contentDocument){
        p=q.getWin();
        if(p){
            q.contentDocument=p.document
            }
        }
    return q.contentDocument
},
getBody:function(){
    return this.bodyElement||this.getDoc().body
    },
convertURL:function(p,x,v){
    var q=this,r=q.settings;
    if(r.urlconverter_callback){
        return q.execCallback("urlconverter_callback",p,v,true,x)
        }
        if(!r.convert_urls||(v&&v.nodeName=="LINK")||p.indexOf("file:")===0){
        return p
        }
        if(r.relative_urls){
        return q.documentBaseURI.toRelative(p)
        }
        p=q.documentBaseURI.toAbsolute(p,r.remove_script_host);
    return p
    },
addVisual:function(r){
    var p=this,q=p.settings;
    r=r||p.getBody();
    if(!d(p.hasVisual)){
        p.hasVisual=q.visual
        }
        i(p.dom.select("table,a",r),function(t){
        var s;
        switch(t.nodeName){
            case"TABLE":
                s=p.dom.getAttrib(t,"border");
                if(!s||s=="0"){
                if(p.hasVisual){
                    p.dom.addClass(t,q.visual_table_class)
                    }else{
                    p.dom.removeClass(t,q.visual_table_class)
                    }
                }
            return;
        case"A":
            s=p.dom.getAttrib(t,"name");
            if(s){
            if(p.hasVisual){
                p.dom.addClass(t,"mceItemAnchor")
                }else{
                p.dom.removeClass(t,"mceItemAnchor")
                }
            }
        return
        }
    });
p.onVisualAid.dispatch(p,r,p.hasVisual)
},
remove:function(){
    var p=this,q=p.getContainer();
    p.removed=1;
    p.hide();
    p.execCallback("remove_instance_callback",p);
    p.onRemove.dispatch(p);
    p.onExecCommand.listeners=[];
    m.remove(p);
    n.remove(q)
    },
destroy:function(q){
    var p=this;
    if(p.destroyed){
        return
    }
    if(!q){
        m.removeUnload(p.destroy);
        tinyMCE.onBeforeUnload.remove(p._beforeUnload);
        if(p.theme&&p.theme.destroy){
            p.theme.destroy()
            }
            p.controlManager.destroy();
        p.selection.destroy();
        p.dom.destroy();
        if(!p.settings.content_editable){
            j.clear(p.getWin());
            j.clear(p.getDoc())
            }
            j.clear(p.getBody());
        j.clear(p.formElement)
        }
        if(p.formElement){
        p.formElement.submit=p.formElement._mceOldSubmit;
        p.formElement._mceOldSubmit=null
        }
        p.contentAreaContainer=p.formElement=p.container=p.settings.content_element=p.bodyElement=p.contentDocument=p.contentWindow=null;
    if(p.selection){
        p.selection=p.selection.win=p.selection.dom=p.selection.dom.doc=null
        }
        p.destroyed=1
    },
_addEvents:function(){
    var v=this,u,y=v.settings,x={
        mouseup:"onMouseUp",
        mousedown:"onMouseDown",
        click:"onClick",
        keyup:"onKeyUp",
        keydown:"onKeyDown",
        keypress:"onKeyPress",
        submit:"onSubmit",
        reset:"onReset",
        contextmenu:"onContextMenu",
        dblclick:"onDblClick",
        paste:"onPaste"
    };

    function r(t,A){
        var s=t.type;
        if(v.removed){
            return
        }
        if(v.onEvent.dispatch(v,t,A)!==false){
            v[x[t.fakeType||t.type]].dispatch(v,t,A)
            }
        }
    i(x,function(t,s){
    switch(s){
        case"contextmenu":
            if(m.isOpera){
            v.dom.bind(v.getBody(),"mousedown",function(A){
                if(A.ctrlKey){
                    A.fakeType="contextmenu";
                    r(A)
                    }
                })
        }else{
            v.dom.bind(v.getBody(),s,r)
            }
            break;
    case"paste":
        v.dom.bind(v.getBody(),s,function(A){
        r(A)
        });
    break;
    case"submit":case"reset":
        v.dom.bind(v.getElement().form||n.getParent(v.id,"form"),s,r);
        break;
    default:
        v.dom.bind(y.content_editable?v.getBody():v.getDoc(),s,r)
        }
    });
v.dom.bind(y.content_editable?v.getBody():(a?v.getDoc():v.getWin()),"focus",function(s){
    v.focus(true)
    });
if(m.isGecko){
    v.dom.bind(v.getDoc(),"DOMNodeInserted",function(t){
        var s;
        t=t.target;
        if(t.nodeType===1&&t.nodeName==="IMG"&&(s=t.getAttribute("_mce_src"))){
            t.src=v.documentBaseURI.toAbsolute(s)
            }
        })
}
if(a){
    function p(){
        var B=this,D=B.getDoc(),C=B.settings;
        if(a&&!C.readonly){
            if(B._isHidden()){
                try{
                    if(!C.content_editable){
                        D.designMode="On"
                        }
                    }catch(A){}
        }
        try{
        D.execCommand("styleWithCSS",0,false)
        }catch(A){
        if(!B._isHidden()){
            try{
                D.execCommand("useCSS",0,true)
                }catch(A){}
        }
    }
if(!C.table_inline_editing){
    try{
        D.execCommand("enableInlineTableEditing",false,false)
        }catch(A){}
}
if(!C.object_resizing){
    try{
        D.execCommand("enableObjectResizing",false,false)
        }catch(A){}
}
}
}
v.onBeforeExecCommand.add(p);
v.onMouseDown.add(p)
}
if(m.isWebKit){
    v.onClick.add(function(s,t){
        t=t.target;
        if(t.nodeName=="IMG"||(t.nodeName=="A"&&v.dom.hasClass(t,"mceItemAnchor"))){
            v.selection.getSel().setBaseAndExtent(t,0,t,1)
            }
        })
}
v.onMouseUp.add(v.nodeChanged);
v.onKeyUp.add(function(s,t){
    var A=t.keyCode;
    if((A>=33&&A<=36)||(A>=37&&A<=40)||A==13||A==45||A==46||A==8||(m.isMac&&(A==91||A==93))||t.ctrlKey){
        v.nodeChanged()
        }
    });
v.onReset.add(function(){
    v.setContent(v.startContent,{
        format:"raw"
    })
    });
if(y.custom_shortcuts){
    if(y.custom_undo_redo_keyboard_shortcuts){
        v.addShortcut("ctrl+z",v.getLang("undo_desc"),"Undo");
        v.addShortcut("ctrl+y",v.getLang("redo_desc"),"Redo")
        }
        v.addShortcut("ctrl+b",v.getLang("bold_desc"),"Bold");
    v.addShortcut("ctrl+i",v.getLang("italic_desc"),"Italic");
    v.addShortcut("ctrl+u",v.getLang("underline_desc"),"Underline");
    for(u=1;u<=6;u++){
        v.addShortcut("ctrl+"+u,"",["FormatBlock",false,"h"+u])
        }
        v.addShortcut("ctrl+7","",["FormatBlock",false,"<p>"]);
    v.addShortcut("ctrl+8","",["FormatBlock",false,"<div>"]);
    v.addShortcut("ctrl+9","",["FormatBlock",false,"<address>"]);
    function z(t){
        var s=null;
        if(!t.altKey&&!t.ctrlKey&&!t.metaKey){
            return s
            }
            i(v.shortcuts,function(A){
            if(m.isMac&&A.ctrl!=t.metaKey){
                return
            }else{
                if(!m.isMac&&A.ctrl!=t.ctrlKey){
                    return
                }
            }
            if(A.alt!=t.altKey){
            return
        }
        if(A.shift!=t.shiftKey){
            return
        }
        if(t.keyCode==A.keyCode||(t.charCode&&t.charCode==A.charCode)){
            s=A;
            return false
            }
        });
return s
}
v.onKeyUp.add(function(s,t){
    var A=z(t);
    if(A){
        return j.cancel(t)
        }
    });
v.onKeyPress.add(function(s,t){
    var A=z(t);
    if(A){
        return j.cancel(t)
        }
    });
v.onKeyDown.add(function(s,t){
    var A=z(t);
    if(A){
        A.func.call(A.scope);
        return j.cancel(t)
        }
    })
}
if(m.isIE){
    v.dom.bind(v.getDoc(),"controlselect",function(A){
        var t=v.resizeInfo,s;
        A=A.target;
        if(A.nodeName!=="IMG"){
            return
        }
        if(t){
            v.dom.unbind(t.node,t.ev,t.cb)
            }
            if(!v.dom.hasClass(A,"mceItemNoResize")){
            ev="resizeend";
            s=v.dom.bind(A,ev,function(C){
                var B;
                C=C.target;
                if(B=v.dom.getStyle(C,"width")){
                    v.dom.setAttrib(C,"width",B.replace(/[^0-9%]+/g,""));
                    v.dom.setStyle(C,"width","")
                    }
                    if(B=v.dom.getStyle(C,"height")){
                    v.dom.setAttrib(C,"height",B.replace(/[^0-9%]+/g,""));
                    v.dom.setStyle(C,"height","")
                    }
                })
        }else{
        ev="resizestart";
        s=v.dom.bind(A,"resizestart",j.cancel,j)
        }
        t=v.resizeInfo={
        node:A,
        ev:ev,
        cb:s
    }
    });
v.onKeyDown.add(function(s,t){
    switch(t.keyCode){
        case 8:
            if(v.selection.getRng().item){
            s.dom.remove(v.selection.getRng().item(0));
            return j.cancel(t)
            }
        }
    })
}
if(m.isOpera){
    v.onClick.add(function(s,t){
        j.prevent(t)
        })
    }
    if(y.custom_undo_redo){
    function q(){
        v.undoManager.typing=0;
        v.undoManager.add()
        }
        v.dom.bind(v.getDoc(),"focusout",function(s){
        if(!v.removed&&v.undoManager.typing){
            q()
            }
        });
v.onKeyUp.add(function(s,t){
    if((t.keyCode>=33&&t.keyCode<=36)||(t.keyCode>=37&&t.keyCode<=40)||t.keyCode==13||t.keyCode==45||t.ctrlKey){
        q()
        }
    });
v.onKeyDown.add(function(t,D){
    var s,C,B;
    if(b&&D.keyCode==46){
        s=v.selection.getRng();
        if(s.parentElement){
            C=s.parentElement();
            if(D.ctrlKey){
                s.moveEnd("word",1);
                s.select()
                }
                v.selection.getSel().clear();
            if(s.parentElement()==C){
                B=v.selection.getBookmark();
                try{
                    C.innerHTML=C.innerHTML
                    }catch(A){}
                v.selection.moveToBookmark(B)
                }
                D.preventDefault();
            return
        }
    }
    if((D.keyCode>=33&&D.keyCode<=36)||(D.keyCode>=37&&D.keyCode<=40)||D.keyCode==13||D.keyCode==45){
    if(v.undoManager.typing){
        q()
        }
        return
}
if(!v.undoManager.typing){
    v.undoManager.add();
    v.undoManager.typing=1
    }
});
v.onMouseDown.add(function(){
    if(v.undoManager.typing){
        q()
        }
    })
}
},
_isHidden:function(){
    var p;
    if(!a){
        return 0
        }
        p=this.selection.getSel();
    return(!p||!p.rangeCount||p.rangeCount==0)
    },
_fixNesting:function(q){
    var r=[],p;
    q=q.replace(/<(\/)?([^\s>]+)[^>]*?>/g,function(t,s,v){
        var u;
        if(s==="/"){
            if(!r.length){
                return""
                }
                if(v!==r[r.length-1].tag){
                for(p=r.length-1;p>=0;p--){
                    if(r[p].tag===v){
                        r[p].close=1;
                        break
                    }
                }
                return""
            }else{
            r.pop();
            if(r.length&&r[r.length-1].close){
                t=t+"</"+r[r.length-1].tag+">";
                r.pop()
                }
            }
    }else{
    if(/^(br|hr|input|meta|img|link|param)$/i.test(v)){
        return t
        }
        if(/\/>$/.test(t)){
        return t
        }
        r.push({
        tag:v
    })
    }
    return t
});
for(p=r.length-1;p>=0;p--){
    q+="</"+r[p].tag+">"
    }
    return q
}
})
})(tinymce);
(function(c){
    var d=c.each,e,a=true,b=false;
    c.EditorCommands=function(n){
        var l=n.dom,p=n.selection,j={
            state:{},
            exec:{},
            value:{}
    },k=n.settings,o;
    function q(y,x,v){
        var u;
        y=y.toLowerCase();
        if(u=j.exec[y]){
            u(y,x,v);
            return a
            }
            return b
        }
        function m(v){
        var u;
        v=v.toLowerCase();
        if(u=j.state[v]){
            return u(v)
            }
            return -1
        }
        function h(v){
        var u;
        v=v.toLowerCase();
        if(u=j.value[v]){
            return u(v)
            }
            return b
        }
        function t(u,v){
        v=v||"exec";
        d(u,function(y,x){
            d(x.toLowerCase().split(","),function(z){
                j[v][z]=y
                })
            })
        }
        c.extend(this,{
        execCommand:q,
        queryCommandState:m,
        queryCommandValue:h,
        addCommands:t
    });
    function f(x,v,u){
        if(v===e){
            v=b
            }
            if(u===e){
            u=null
            }
            return n.getDoc().execCommand(x,v,u)
        }
        function s(u){
        return n.formatter.match(u)
        }
        function r(u,v){
        n.formatter.toggle(u,v?{
            value:v
        }:e)
        }
        function i(u){
        o=p.getBookmark(u)
        }
        function g(){
        p.moveToBookmark(o)
        }
        t({
        "mceResetDesignMode,mceBeginUndoLevel":function(){},
        "mceEndUndoLevel,mceAddUndoLevel":function(){
            n.undoManager.add()
            },
        "Cut,Copy,Paste":function(y){
            var x=n.getDoc(),u;
            try{
                f(y)
                }catch(v){
                u=a
                }
                if(u||!x.queryCommandSupported(y)){
                if(c.isGecko){
                    n.windowManager.confirm(n.getLang("clipboard_msg"),function(z){
                        if(z){
                            open("http://www.mozilla.org/editor/midasdemo/securityprefs.html","_blank")
                            }
                        })
                }else{
                n.windowManager.alert(n.getLang("clipboard_no_support"))
                }
            }
    },
unlink:function(u){
    if(p.isCollapsed()){
        p.select(p.getNode())
        }
        f(u);
    p.collapse(b)
    },
"JustifyLeft,JustifyCenter,JustifyRight,JustifyFull":function(u){
    var v=u.substring(7);
    d("left,center,right,full".split(","),function(x){
        if(v!=x){
            n.formatter.remove("align"+x)
            }
        });
r("align"+v)
    },
"InsertUnorderedList,InsertOrderedList":function(x){
    var u,v;
    f(x);
    u=l.getParent(p.getNode(),"ol,ul");
    if(u){
        v=u.parentNode;
        if(/^(H[1-6]|P|ADDRESS|PRE)$/.test(v.nodeName)){
            i();
            l.split(v,u);
            g()
            }
        }
},
"Bold,Italic,Underline,Strikethrough":function(u){
    r(u)
    },
"ForeColor,HiliteColor,FontName":function(x,v,u){
    r(x,u)
    },
FontSize:function(y,x,v){
    var u,z;
    if(v>=1&&v<=7){
        z=c.explode(k.font_size_style_values);
        u=c.explode(k.font_size_classes);
        if(u){
            v=u[v-1]||v
            }else{
            v=z[v-1]||v
            }
        }
    r(y,v)
},
RemoveFormat:function(u){
    n.formatter.remove(u)
    },
mceBlockQuote:function(u){
    r("blockquote")
    },
FormatBlock:function(x,v,u){
    return r(u||"p")
    },
mceCleanup:function(){
    var u=p.getBookmark();
    n.setContent(n.getContent({
        cleanup:a
    }),{
        cleanup:a
    });
    p.moveToBookmark(u)
    },
mceRemoveNode:function(y,x,v){
    var u=v||p.getNode();
    if(u!=n.getBody()){
        i();
        n.dom.remove(u,a);
        g()
        }
    },
mceSelectNodeDepth:function(y,x,v){
    var u=0;
    l.getParent(p.getNode(),function(z){
        if(z.nodeType==1&&u++==v){
            p.select(z);
            return b
            }
        },n.getBody())
},
mceSelectNode:function(x,v,u){
    p.select(u)
    },
mceInsertContent:function(x,v,u){
    p.setContent(u)
    },
mceInsertRawHTML:function(x,v,u){
    p.setContent("tiny_mce_marker");
    n.setContent(n.getContent().replace(/tiny_mce_marker/g,u))
    },
mceSetContent:function(x,v,u){
    n.setContent(u)
    },
"Indent,Outdent":function(y){
    var v,u,x;
    v=k.indentation;
    u=/[a-z%]+$/i.exec(v);
    v=parseInt(v);
    if(!m("InsertUnorderedList")&&!m("InsertOrderedList")){
        d(p.getSelectedBlocks(),function(z){
            if(y=="outdent"){
                x=Math.max(0,parseInt(z.style.paddingLeft||0)-v);
                l.setStyle(z,"paddingLeft",x?x+u:"")
                }else{
                l.setStyle(z,"paddingLeft",(parseInt(z.style.paddingLeft||0)+v)+u)
                }
            })
    }else{
    f(y)
    }
},
mceRepaint:function(){
    var v;
    if(c.isGecko){
        try{
            i(a);
            if(p.getSel()){
                p.getSel().selectAllChildren(n.getBody())
                }
                p.collapse(a);
            g()
            }catch(u){}
    }
},
mceToggleFormat:function(x,v,u){
    n.formatter.toggle(u)
    },
InsertHorizontalRule:function(){
    p.setContent("<hr />")
    },
mceToggleVisualAid:function(){
    n.hasVisual=!n.hasVisual;
    n.addVisual()
    },
mceReplaceContent:function(x,v,u){
    p.setContent(u.replace(/\{\$selection\}/g,p.getContent({
        format:"text"
    })))
    },
mceInsertLink:function(y,x,v){
    var u=l.getParent(p.getNode(),"a");
    if(c.is(v,"string")){
        v={
            href:v
        }
    }
    if(!u){
    f("CreateLink",b,"javascript:mctmp(0);");
    d(l.select("a[href=javascript:mctmp(0);]"),function(z){
        l.setAttribs(z,v)
        })
    }else{
    if(v.href){
        l.setAttribs(u,v)
        }else{
        n.dom.remove(u,a)
        }
    }
},
selectAll:function(){
    var v=l.getRoot(),u=l.createRng();
    u.setStart(v,0);
    u.setEnd(v,v.childNodes.length);
    n.selection.setRng(u)
    }
});
t({
    "JustifyLeft,JustifyCenter,JustifyRight,JustifyFull":function(u){
        return s("align"+u.substring(7))
        },
    "Bold,Italic,Underline,Strikethrough":function(u){
        return s(u)
        },
    mceBlockQuote:function(){
        return s("blockquote")
        },
    Outdent:function(){
        var u;
        if(k.inline_styles){
            if((u=l.getParent(p.getStart(),l.isBlock))&&parseInt(u.style.paddingLeft)>0){
                return a
                }
                if((u=l.getParent(p.getEnd(),l.isBlock))&&parseInt(u.style.paddingLeft)>0){
                return a
                }
            }
        return m("InsertUnorderedList")||m("InsertOrderedList")||(!k.inline_styles&&!!l.getParent(p.getNode(),"BLOCKQUOTE"))
    },
"InsertUnorderedList,InsertOrderedList":function(u){
    return l.getParent(p.getNode(),u=="insertunorderedlist"?"UL":"OL")
    }
},"state");
t({
    "FontSize,FontName":function(x){
        var v=0,u;
        if(u=l.getParent(p.getNode(),"span")){
            if(x=="fontsize"){
                v=u.style.fontSize
                }else{
                v=u.style.fontFamily.replace(/, /g,",").replace(/[\'\"]/g,"").toLowerCase()
                }
            }
        return v
    }
},"value");
if(k.custom_undo_redo){
    t({
        Undo:function(){
            n.undoManager.undo()
            },
        Redo:function(){
            n.undoManager.redo()
            }
        })
}
}
})(tinymce);
(function(b){
    var a=b.util.Dispatcher;
    b.UndoManager=function(e){
        var c,d=0,g=[];
        function f(){
            return b.trim(e.getContent({
                format:"raw",
                no_events:1
            }))
            }
            return c={
            typing:0,
            onAdd:new a(c),
            onUndo:new a(c),
            onRedo:new a(c),
            add:function(l){
                var h,j=e.settings,k;
                l=l||{};

                l.content=f();
                k=g[d];
                if(k&&k.content==l.content){
                    if(d>0||g.length==1){
                        return null
                        }
                    }
                if(j.custom_undo_redo_levels){
                if(g.length>j.custom_undo_redo_levels){
                    for(h=0;h<g.length-1;h++){
                        g[h]=g[h+1]
                        }
                        g.length--;
                    d=g.length
                    }
                }
            l.bookmark=e.selection.getBookmark(2,true);
        if(d<g.length-1){
            if(d==0){
                g=[]
                }else{
                g.length=d+1
                }
            }
        g.push(l);
    d=g.length-1;
    c.onAdd.dispatch(c,l);
    e.isNotDirty=0;
    return l
    },
undo:function(){
    var j,h;
    if(c.typing){
        c.add();
        c.typing=0
        }
        if(d>0){
        j=g[--d];
        e.setContent(j.content,{
            format:"raw"
        });
        e.selection.moveToBookmark(j.bookmark);
        c.onUndo.dispatch(c,j)
        }
        return j
    },
redo:function(){
    var h;
    if(d<g.length-1){
        h=g[++d];
        e.setContent(h.content,{
            format:"raw"
        });
        e.selection.moveToBookmark(h.bookmark);
        c.onRedo.dispatch(c,h)
        }
        return h
    },
clear:function(){
    g=[];
    d=c.typing=0
    },
hasUndo:function(){
    return d>0||c.typing
    },
hasRedo:function(){
    return d<g.length-1
    }
}
}
})(tinymce);
(function(m){
    var k=m.dom.Event,c=m.isIE,a=m.isGecko,b=m.isOpera,j=m.each,i=m.extend,d=true,h=false;
    function l(p){
        var q,o,n;
        do{
            if(/^(SPAN|STRONG|B|EM|I|FONT|STRIKE|U)$/.test(p.nodeName)){
                if(q){
                    o=p.cloneNode(false);
                    o.appendChild(q);
                    q=o
                    }else{
                    q=n=p.cloneNode(false)
                    }
                    q.removeAttribute("id")
                }
            }while(p=p.parentNode);
    if(q){
        return{
            wrapper:q,
            inner:n
        }
    }
}
function g(o,p){
    var n=p.ownerDocument.createRange();
    n.setStart(o.endContainer,o.endOffset);
    n.setEndAfter(p);
    return n.cloneContents().textContent.length==0
    }
    function f(o){
    o=o.innerHTML;
    o=o.replace(/<(img|hr|table|input|select|textarea)[ \>]/gi,"-");
    o=o.replace(/<[^>]+>/g,"");
    return o.replace(/[ \u00a0\t\r\n]+/g,"")==""
    }
    function e(p,r,n){
    var o,q;
    if(f(n)){
        o=r.getParent(n,"ul,ol");
        if(!r.getParent(o.parentNode,"ul,ol")){
            r.split(o,n);
            q=r.create("p",0,'<br _mce_bogus="1" />');
            r.replace(q,n);
            p.select(q,1)
            }
            return h
        }
        return d
    }
    m.create("tinymce.ForceBlocks",{
    ForceBlocks:function(o){
        var p=this,q=o.settings,r;
        p.editor=o;
        p.dom=o.dom;
        r=(q.forced_root_block||"p").toLowerCase();
        q.element=r.toUpperCase();
        o.onPreInit.add(p.setup,p);
        p.reOpera=new RegExp("(\\u00a0|&#160;|&nbsp;)</"+r+">","gi");
        p.rePadd=new RegExp("<p( )([^>]+)><\\/p>|<p( )([^>]+)\\/>|<p( )([^>]+)>\\s+<\\/p>|<p><\\/p>|<p\\/>|<p>\\s+<\\/p>".replace(/p/g,r),"gi");
        p.reNbsp2BR1=new RegExp("<p( )([^>]+)>[\\s\\u00a0]+<\\/p>|<p>[\\s\\u00a0]+<\\/p>".replace(/p/g,r),"gi");
        p.reNbsp2BR2=new RegExp("<%p()([^>]+)>(&nbsp;|&#160;)<\\/%p>|<%p>(&nbsp;|&#160;)<\\/%p>".replace(/%p/g,r),"gi");
        p.reBR2Nbsp=new RegExp("<p( )([^>]+)>\\s*<br \\/>\\s*<\\/p>|<p>\\s*<br \\/>\\s*<\\/p>".replace(/p/g,r),"gi");
        function n(s,t){
            if(b){
                t.content=t.content.replace(p.reOpera,"</"+r+">")
                }
                t.content=t.content.replace(p.rePadd,"<"+r+"$1$2$3$4$5$6>\u00a0</"+r+">");
            if(!c&&!b&&t.set){
                t.content=t.content.replace(p.reNbsp2BR1,"<"+r+"$1$2><br /></"+r+">");
                t.content=t.content.replace(p.reNbsp2BR2,"<"+r+"$1$2><br /></"+r+">")
                }else{
                t.content=t.content.replace(p.reBR2Nbsp,"<"+r+"$1$2>\u00a0</"+r+">")
                }
            }
        o.onBeforeSetContent.add(n);
    o.onPostProcess.add(n);
    if(q.forced_root_block){
        o.onInit.add(p.forceRoots,p);
        o.onSetContent.add(p.forceRoots,p);
        o.onBeforeGetContent.add(p.forceRoots,p)
        }
    },
setup:function(){
    var o=this,n=o.editor,q=n.settings,u=n.dom,p=n.selection;
    if(q.forced_root_block){
        n.onBeforeExecCommand.add(o.forceRoots,o);
        n.onKeyUp.add(o.forceRoots,o);
        n.onPreProcess.add(o.forceRoots,o)
        }
        if(q.force_br_newlines){
        if(c){
            n.onKeyPress.add(function(s,t){
                var v;
                if(t.keyCode==13&&p.getNode().nodeName!="LI"){
                    p.setContent('<br id="__" /> ',{
                        format:"raw"
                    });
                    v=u.get("__");
                    v.removeAttribute("id");
                    p.select(v);
                    p.collapse();
                    return k.cancel(t)
                    }
                })
        }
    }
if(q.force_p_newlines){
    if(!c){
        n.onKeyPress.add(function(s,t){
            if(t.keyCode==13&&!t.shiftKey&&!o.insertPara(t)){
                k.cancel(t)
                }
            })
    }else{
    m.addUnload(function(){
        o._previousFormats=0
        });
    n.onKeyPress.add(function(s,t){
        o._previousFormats=0;
        if(t.keyCode==13&&!t.shiftKey&&s.selection.isCollapsed()&&q.keep_styles){
            o._previousFormats=l(s.selection.getStart())
            }
        });
n.onKeyUp.add(function(t,x){
    if(x.keyCode==13&&!x.shiftKey){
        var v=t.selection.getStart(),s=o._previousFormats;
        if(!v.hasChildNodes()){
            v=u.getParent(v,u.isBlock);
            if(v){
                v.innerHTML="";
                if(o._previousFormats){
                    v.appendChild(s.wrapper);
                    s.inner.innerHTML="\uFEFF"
                    }else{
                    v.innerHTML="\uFEFF"
                    }
                    p.select(v,1);
                t.getDoc().execCommand("Delete",false,null)
                }
            }
    }
})
}
if(a){
    n.onKeyDown.add(function(s,t){
        if((t.keyCode==8||t.keyCode==46)&&!t.shiftKey){
            o.backspaceDelete(t,t.keyCode==8)
            }
        })
}
}
if(m.isWebKit){
    function r(t){
        var s=p.getRng(),v,z=u.create("div",null," "),y,x=u.getViewPort(t.getWin()).h;
        s.insertNode(v=u.create("br"));
        s.setStartAfter(v);
        s.setEndAfter(v);
        p.setRng(s);
        if(p.getSel().focusNode==v.previousSibling){
            p.select(u.insertAfter(u.doc.createTextNode("\u00a0"),v));
            p.collapse(d)
            }
            u.insertAfter(z,v);
        y=u.getPos(z).y;
        u.remove(z);
        if(y>x){
            t.getWin().scrollTo(0,y)
            }
        }
    n.onKeyPress.add(function(s,t){
    if(t.keyCode==13&&(t.shiftKey||(q.force_br_newlines&&!u.getParent(p.getNode(),"h1,h2,h3,h4,h5,h6,ol,ul")))){
        r(s);
        k.cancel(t)
        }
    })
}
n.onPreProcess.add(function(s,t){
    j(u.select("p,h1,h2,h3,h4,h5,h6,div",t.node),function(v){
        if(f(v)){
            j(u.select("span,em,strong,b,i",t.node),function(x){
                if(!x.hasChildNodes()){
                    x.appendChild(s.getDoc().createTextNode("\u00a0"));
                    return h
                    }
                })
        }
    })
});
if(c){
    if(q.element!="P"){
        n.onKeyPress.add(function(s,t){
            o.lastElm=p.getNode().nodeName
            });
        n.onKeyUp.add(function(t,v){
            var y,x=p.getNode(),s=t.getBody();
            if(s.childNodes.length===1&&x.nodeName=="P"){
                x=u.rename(x,q.element);
                p.select(x);
                p.collapse();
                t.nodeChanged()
                }else{
                if(v.keyCode==13&&!v.shiftKey&&o.lastElm!="P"){
                    y=u.getParent(x,"p");
                    if(y){
                        u.rename(y,q.element);
                        t.nodeChanged()
                        }
                    }
            }
        })
}
}
},
find:function(v,q,r){
    var p=this.editor,o=p.getDoc().createTreeWalker(v,4,null,h),u=-1;
    while(v=o.nextNode()){
        u++;
        if(q==0&&v==r){
            return u
            }
            if(q==1&&u==r){
            return v
            }
        }
    return -1
},
forceRoots:function(x,I){
    var z=this,x=z.editor,M=x.getBody(),J=x.getDoc(),P=x.selection,A=P.getSel(),B=P.getRng(),N=-2,v,G,o,p,K=-16777215;
    var L,q,O,F,C,u=M.childNodes,E,D,y;
    for(E=u.length-1;E>=0;E--){
        L=u[E];
        if(L.nodeType===1&&L.getAttribute("_mce_type")){
            q=null;
            continue
        }
        if(L.nodeType===3||(!z.dom.isBlock(L)&&L.nodeType!==8&&!/^(script|mce:script|style|mce:style)$/i.test(L.nodeName))){
            if(!q){
                if(L.nodeType!=3||/[^\s]/g.test(L.nodeValue)){
                    if(N==-2&&B){
                        if(!c){
                            if(B.startContainer.nodeType==1&&(D=B.startContainer.childNodes[B.startOffset])&&D.nodeType==1){
                                y=D.getAttribute("id");
                                D.setAttribute("id","__mce")
                                }else{
                                if(x.dom.getParent(B.startContainer,function(n){
                                    return n===M
                                    })){
                                    G=B.startOffset;
                                    o=B.endOffset;
                                    N=z.find(M,0,B.startContainer);
                                    v=z.find(M,0,B.endContainer)
                                    }
                                }
                        }else{
                    if(B.item){
                        p=J.body.createTextRange();
                        p.moveToElementText(B.item(0));
                        B=p
                        }
                        p=J.body.createTextRange();
                    p.moveToElementText(M);
                    p.collapse(1);
                    O=p.move("character",K)*-1;
                    p=B.duplicate();
                    p.collapse(1);
                    F=p.move("character",K)*-1;
                    p=B.duplicate();
                    p.collapse(0);
                    C=(p.move("character",K)*-1)-F;
                    N=F-O;
                    v=C
                    }
                }
            q=x.dom.create(x.settings.forced_root_block);
        L.parentNode.replaceChild(q,L);
        q.appendChild(L)
        }
    }else{
    if(q.hasChildNodes()){
        q.insertBefore(L,q.firstChild)
        }else{
        q.appendChild(L)
        }
    }
}else{
    q=null
    }
}
if(N!=-2){
    if(!c){
        q=M.getElementsByTagName(x.settings.element)[0];
        B=J.createRange();
        if(N!=-1){
            B.setStart(z.find(M,1,N),G)
            }else{
            B.setStart(q,0)
            }
            if(v!=-1){
            B.setEnd(z.find(M,1,v),o)
            }else{
            B.setEnd(q,0)
            }
            if(A){
            A.removeAllRanges();
            A.addRange(B)
            }
        }else{
    try{
        B=A.createRange();
        B.moveToElementText(M);
        B.collapse(1);
        B.moveStart("character",N);
        B.moveEnd("character",v);
        B.select()
        }catch(H){}
}
}else{
    if(!c&&(D=x.dom.get("__mce"))){
        if(y){
            D.setAttribute("id",y)
            }else{
            D.removeAttribute("id")
            }
            B=J.createRange();
        B.setStartBefore(D);
        B.setEndBefore(D);
        P.setRng(B)
        }
    }
},
getParentBlock:function(p){
    var o=this.dom;
    return o.getParent(p,o.isBlock)
    },
insertPara:function(S){
    var G=this,x=G.editor,O=x.dom,T=x.getDoc(),X=x.settings,H=x.selection.getSel(),I=H.getRangeAt(0),W=T.body;
    var L,M,J,Q,P,u,p,v,A,o,E,V,q,z,K,N=O.getViewPort(x.getWin()),D,F,C;
    L=T.createRange();
    L.setStart(H.anchorNode,H.anchorOffset);
    L.collapse(d);
    M=T.createRange();
    M.setStart(H.focusNode,H.focusOffset);
    M.collapse(d);
    J=L.compareBoundaryPoints(L.START_TO_END,M)<0;
    Q=J?H.anchorNode:H.focusNode;
    P=J?H.anchorOffset:H.focusOffset;
    u=J?H.focusNode:H.anchorNode;
    p=J?H.focusOffset:H.anchorOffset;
    if(Q===u&&/^(TD|TH)$/.test(Q.nodeName)){
        if(Q.firstChild.nodeName=="BR"){
            O.remove(Q.firstChild)
            }
            if(Q.childNodes.length==0){
            x.dom.add(Q,X.element,null,"<br />");
            V=x.dom.add(Q,X.element,null,"<br />")
            }else{
            K=Q.innerHTML;
            Q.innerHTML="";
            x.dom.add(Q,X.element,null,K);
            V=x.dom.add(Q,X.element,null,"<br />")
            }
            I=T.createRange();
        I.selectNodeContents(V);
        I.collapse(1);
        x.selection.setRng(I);
        return h
        }
        if(Q==W&&u==W&&W.firstChild&&x.dom.isBlock(W.firstChild)){
        Q=u=Q.firstChild;
        P=p=0;
        L=T.createRange();
        L.setStart(Q,0);
        M=T.createRange();
        M.setStart(u,0)
        }
        Q=Q.nodeName=="HTML"?T.body:Q;
    Q=Q.nodeName=="BODY"?Q.firstChild:Q;
    u=u.nodeName=="HTML"?T.body:u;
    u=u.nodeName=="BODY"?u.firstChild:u;
    v=G.getParentBlock(Q);
    A=G.getParentBlock(u);
    o=v?v.nodeName:X.element;
    if(K=G.dom.getParent(v,"li,pre")){
        if(K.nodeName=="LI"){
            return e(x.selection,G.dom,K)
            }
            return d
        }
        if(v&&(v.nodeName=="CAPTION"||/absolute|relative|fixed/gi.test(O.getStyle(v,"position",1)))){
        o=X.element;
        v=null
        }
        if(A&&(A.nodeName=="CAPTION"||/absolute|relative|fixed/gi.test(O.getStyle(v,"position",1)))){
        o=X.element;
        A=null
        }
        if(/(TD|TABLE|TH|CAPTION)/.test(o)||(v&&o=="DIV"&&/left|right/gi.test(O.getStyle(v,"float",1)))){
        o=X.element;
        v=A=null
        }
        E=(v&&v.nodeName==o)?v.cloneNode(0):x.dom.create(o);
    V=(A&&A.nodeName==o)?A.cloneNode(0):x.dom.create(o);
    V.removeAttribute("id");
    if(/^(H[1-6])$/.test(o)&&g(I,v)){
        V=x.dom.create(X.element)
        }
        K=q=Q;
    do{
        if(K==W||K.nodeType==9||G.dom.isBlock(K)||/(TD|TABLE|TH|CAPTION)/.test(K.nodeName)){
            break
        }
        q=K
        }while((K=K.previousSibling?K.previousSibling:K.parentNode));
    K=z=u;
    do{
        if(K==W||K.nodeType==9||G.dom.isBlock(K)||/(TD|TABLE|TH|CAPTION)/.test(K.nodeName)){
            break
        }
        z=K
        }while((K=K.nextSibling?K.nextSibling:K.parentNode));
    if(q.nodeName==o){
        L.setStart(q,0)
        }else{
        L.setStartBefore(q)
        }
        L.setEnd(Q,P);
    E.appendChild(L.cloneContents()||T.createTextNode(""));
    try{
        M.setEndAfter(z)
        }catch(R){}
    M.setStart(u,p);
    V.appendChild(M.cloneContents()||T.createTextNode(""));
    I=T.createRange();
    if(!q.previousSibling&&q.parentNode.nodeName==o){
        I.setStartBefore(q.parentNode)
        }else{
        if(L.startContainer.nodeName==o&&L.startOffset==0){
            I.setStartBefore(L.startContainer)
            }else{
            I.setStart(L.startContainer,L.startOffset)
            }
        }
    if(!z.nextSibling&&z.parentNode.nodeName==o){
    I.setEndAfter(z.parentNode)
    }else{
    I.setEnd(M.endContainer,M.endOffset)
    }
    I.deleteContents();
if(b){
    x.getWin().scrollTo(0,N.y)
    }
    if(E.firstChild&&E.firstChild.nodeName==o){
    E.innerHTML=E.firstChild.innerHTML
    }
    if(V.firstChild&&V.firstChild.nodeName==o){
    V.innerHTML=V.firstChild.innerHTML
    }
    if(f(E)){
    E.innerHTML="<br />"
    }
    function U(y,s){
    var r=[],Z,Y,t;
    y.innerHTML="";
    if(X.keep_styles){
        Y=s;
        do{
            if(/^(SPAN|STRONG|B|EM|I|FONT|STRIKE|U)$/.test(Y.nodeName)){
                Z=Y.cloneNode(h);
                O.setAttrib(Z,"id","");
                r.push(Z)
                }
            }while(Y=Y.parentNode)
}
if(r.length>0){
    for(t=r.length-1,Z=y;t>=0;t--){
        Z=Z.appendChild(r[t])
        }
        r[0].innerHTML=b?"&nbsp;":"<br />";
    return r[0]
    }else{
    y.innerHTML=b?"&nbsp;":"<br />"
    }
}
if(f(V)){
    C=U(V,u)
    }
    if(b&&parseFloat(opera.version())<9.5){
    I.insertNode(E);
    I.insertNode(V)
    }else{
    I.insertNode(V);
    I.insertNode(E)
    }
    V.normalize();
E.normalize();
function B(r){
    return T.createTreeWalker(r,NodeFilter.SHOW_TEXT,null,h).nextNode()||r
    }
    I=T.createRange();
I.selectNodeContents(a?B(C||V):C||V);
I.collapse(1);
H.removeAllRanges();
H.addRange(I);
D=x.dom.getPos(V).y;
F=V.clientHeight;
if(D<N.y||D+F>N.y+N.h){
    x.getWin().scrollTo(0,D<N.y?D:D-N.h+25)
    }
    return h
},
backspaceDelete:function(v,C){
    var D=this,u=D.editor,z=u.getBody(),s=u.dom,q,x=u.selection,p=x.getRng(),y=p.startContainer,q,A,B,o;
    if(!C&&p.collapsed&&y.nodeType==1&&p.startOffset==y.childNodes.length){
        o=new m.dom.TreeWalker(y.lastChild,y);
        for(q=y.lastChild;q;q=o.prev()){
            if(q.nodeType==3){
                p.setStart(q,q.nodeValue.length);
                p.collapse(true);
                x.setRng(p);
                return
            }
        }
        }
    if(y&&u.dom.isBlock(y)&&!/^(TD|TH)$/.test(y.nodeName)&&C){
    if(y.childNodes.length==0||(y.childNodes.length==1&&y.firstChild.nodeName=="BR")){
        q=y;
        while((q=q.previousSibling)&&!u.dom.isBlock(q)){}
        if(q){
            if(y!=z.firstChild){
                A=u.dom.doc.createTreeWalker(q,NodeFilter.SHOW_TEXT,null,h);
                while(B=A.nextNode()){
                    q=B
                    }
                    p=u.getDoc().createRange();
                p.setStart(q,q.nodeValue?q.nodeValue.length:0);
                p.setEnd(q,q.nodeValue?q.nodeValue.length:0);
                x.setRng(p);
                u.dom.remove(y)
                }
                return k.cancel(v)
            }
        }
}
}
})
})(tinymce);
(function(c){
    var b=c.DOM,a=c.dom.Event,d=c.each,e=c.extend;
    c.create("tinymce.ControlManager",{
        ControlManager:function(f,j){
            var h=this,g;
            j=j||{};

            h.editor=f;
            h.controls={};

            h.onAdd=new c.util.Dispatcher(h);
            h.onPostRender=new c.util.Dispatcher(h);
            h.prefix=j.prefix||f.id+"_";
            h._cls={};

            h.onPostRender.add(function(){
                d(h.controls,function(i){
                    i.postRender()
                    })
                })
            },
        get:function(f){
            return this.controls[this.prefix+f]||this.controls[f]
            },
        setActive:function(h,f){
            var g=null;
            if(g=this.get(h)){
                g.setActive(f)
                }
                return g
            },
        setDisabled:function(h,f){
            var g=null;
            if(g=this.get(h)){
                g.setDisabled(f)
                }
                return g
            },
        add:function(g){
            var f=this;
            if(g){
                f.controls[g.id]=g;
                f.onAdd.dispatch(g,f)
                }
                return g
            },
        createControl:function(i){
            var h,g=this,f=g.editor;
            d(f.plugins,function(j){
                if(j.createControl){
                    h=j.createControl(i,g);
                    if(h){
                        return false
                        }
                    }
            });
    switch(i){
        case"|":case"separator":
            return g.createSeparator()
            }
            if(!h&&f.buttons&&(h=f.buttons[i])){
        return g.createButton(i,h)
        }
        return g.add(h)
        },
    createDropMenu:function(f,n,h){
        var m=this,i=m.editor,j,g,k,l;
        n=e({
            "class":"mceDropDown",
            constrain:i.settings.constrain_menus
            },n);
        n["class"]=n["class"]+" "+i.getParam("skin")+"Skin";
        if(k=i.getParam("skin_variant")){
            n["class"]+=" "+i.getParam("skin")+"Skin"+k.substring(0,1).toUpperCase()+k.substring(1)
            }
            f=m.prefix+f;
        l=h||m._cls.dropmenu||c.ui.DropMenu;
        j=m.controls[f]=new l(f,n);
        j.onAddItem.add(function(r,q){
            var p=q.settings;
            p.title=i.getLang(p.title,p.title);
            if(!p.onclick){
                p.onclick=function(o){
                    if(p.cmd){
                        i.execCommand(p.cmd,p.ui||false,p.value)
                        }
                    }
            }
        });
i.onRemove.add(function(){
    j.destroy()
    });
if(c.isIE){
    j.onShowMenu.add(function(){
        i.focus();
        g=i.selection.getBookmark(1)
        });
    j.onHideMenu.add(function(){
        if(g){
            i.selection.moveToBookmark(g);
            g=0
            }
        })
}
return m.add(j)
},
createListBox:function(m,i,l){
    var h=this,g=h.editor,j,k,f;
    if(h.get(m)){
        return null
        }
        i.title=g.translate(i.title);
    i.scope=i.scope||g;
    if(!i.onselect){
        i.onselect=function(n){
            g.execCommand(i.cmd,i.ui||false,n||i.value)
            }
        }
    i=e({
    title:i.title,
    "class":"mce_"+m,
    scope:i.scope,
    control_manager:h
},i);
m=h.prefix+m;
if(g.settings.use_native_selects){
    k=new c.ui.NativeListBox(m,i)
    }else{
    f=l||h._cls.listbox||c.ui.ListBox;
    k=new f(m,i)
    }
    h.controls[m]=k;
if(c.isWebKit){
    k.onPostRender.add(function(p,o){
        a.add(o,"mousedown",function(){
            g.bookmark=g.selection.getBookmark(1)
            });
        a.add(o,"focus",function(){
            g.selection.moveToBookmark(g.bookmark);
            g.bookmark=null
            })
        })
    }
    if(k.hideMenu){
    g.onMouseDown.add(k.hideMenu,k)
    }
    return h.add(k)
},
createButton:function(m,i,l){
    var h=this,g=h.editor,j,k,f;
    if(h.get(m)){
        return null
        }
        i.title=g.translate(i.title);
    i.label=g.translate(i.label);
    i.scope=i.scope||g;
    if(!i.onclick&&!i.menu_button){
        i.onclick=function(){
            g.execCommand(i.cmd,i.ui||false,i.value)
            }
        }
    i=e({
    title:i.title,
    "class":"mce_"+m,
    unavailable_prefix:g.getLang("unavailable",""),
    scope:i.scope,
    control_manager:h
},i);
m=h.prefix+m;
if(i.menu_button){
    f=l||h._cls.menubutton||c.ui.MenuButton;
    k=new f(m,i);
    g.onMouseDown.add(k.hideMenu,k)
    }else{
    f=h._cls.button||c.ui.Button;
    k=new f(m,i)
    }
    return h.add(k)
},
createMenuButton:function(h,f,g){
    f=f||{};

    f.menu_button=1;
    return this.createButton(h,f,g)
    },
createSplitButton:function(m,i,l){
    var h=this,g=h.editor,j,k,f;
    if(h.get(m)){
        return null
        }
        i.title=g.translate(i.title);
    i.scope=i.scope||g;
    if(!i.onclick){
        i.onclick=function(n){
            g.execCommand(i.cmd,i.ui||false,n||i.value)
            }
        }
    if(!i.onselect){
    i.onselect=function(n){
        g.execCommand(i.cmd,i.ui||false,n||i.value)
        }
    }
i=e({
    title:i.title,
    "class":"mce_"+m,
    scope:i.scope,
    control_manager:h
},i);
m=h.prefix+m;
f=l||h._cls.splitbutton||c.ui.SplitButton;
k=h.add(new f(m,i));
g.onMouseDown.add(k.hideMenu,k);
return k
},
createColorSplitButton:function(f,n,h){
    var l=this,j=l.editor,i,k,m,g;
    if(l.get(f)){
        return null
        }
        n.title=j.translate(n.title);
    n.scope=n.scope||j;
    if(!n.onclick){
        n.onclick=function(o){
            if(c.isIE){
                g=j.selection.getBookmark(1)
                }
                j.execCommand(n.cmd,n.ui||false,o||n.value)
            }
        }
    if(!n.onselect){
    n.onselect=function(o){
        j.execCommand(n.cmd,n.ui||false,o||n.value)
        }
    }
n=e({
    title:n.title,
    "class":"mce_"+f,
    menu_class:j.getParam("skin")+"Skin",
    scope:n.scope,
    more_colors_title:j.getLang("more_colors")
    },n);
f=l.prefix+f;
m=h||l._cls.colorsplitbutton||c.ui.ColorSplitButton;
k=new m(f,n);
j.onMouseDown.add(k.hideMenu,k);
j.onRemove.add(function(){
    k.destroy()
    });
if(c.isIE){
    k.onShowMenu.add(function(){
        j.focus();
        g=j.selection.getBookmark(1)
        });
    k.onHideMenu.add(function(){
        if(g){
            j.selection.moveToBookmark(g);
            g=0
            }
        })
}
return l.add(k)
},
createToolbar:function(k,h,j){
    var i,g=this,f;
    k=g.prefix+k;
    f=j||g._cls.toolbar||c.ui.Toolbar;
    i=new f(k,h);
    if(g.get(k)){
        return null
        }
        return g.add(i)
    },
createSeparator:function(g){
    var f=g||this._cls.separator||c.ui.Separator;
    return new f()
    },
setControlType:function(g,f){
    return this._cls[g.toLowerCase()]=f
    },
destroy:function(){
    d(this.controls,function(f){
        f.destroy()
        });
    this.controls=null
    }
})
})(tinymce);
(function(d){
    var a=d.util.Dispatcher,e=d.each,c=d.isIE,b=d.isOpera;
    d.create("tinymce.WindowManager",{
        WindowManager:function(f){
            var g=this;
            g.editor=f;
            g.onOpen=new a(g);
            g.onClose=new a(g);
            g.params={};

            g.features={}
        },
    open:function(z,h){
        var v=this,k="",n,m,i=v.editor.settings.dialog_type=="modal",q,o,j,g=d.DOM.getViewPort(),r;
        z=z||{};

        h=h||{};

        o=b?g.w:screen.width;
        j=b?g.h:screen.height;
        z.name=z.name||"mc_"+new Date().getTime();
        z.width=parseInt(z.width||320);
        z.height=parseInt(z.height||240);
        z.resizable=true;
        z.left=z.left||parseInt(o/2)-(z.width/2);
        z.top=z.top||parseInt(j/2)-(z.height/2);
        h.inline=false;
        h.mce_width=z.width;
        h.mce_height=z.height;
        h.mce_auto_focus=z.auto_focus;
        if(i){
            if(c){
                z.center=true;
                z.help=false;
                z.dialogWidth=z.width+"px";
                z.dialogHeight=z.height+"px";
                z.scroll=z.scrollbars||false
                }
            }
        e(z,function(p,f){
        if(d.is(p,"boolean")){
            p=p?"yes":"no"
            }
            if(!/^(name|url)$/.test(f)){
            if(c&&i){
                k+=(k?";":"")+f+":"+p
                }else{
                k+=(k?",":"")+f+"="+p
                }
            }
    });
v.features=z;
v.params=h;
v.onOpen.dispatch(v,z,h);
    r=z.url||z.file;
    r=d._addVer(r);
    try{
    if(c&&i){
        q=1;
        window.showModalDialog(r,window,k)
        }else{
        q=window.open(r,z.name,k)
        }
    }catch(l){}
    if(!q){
    alert(v.editor.getLang("popup_blocked"))
    }
},
close:function(f){
    f.close();
    this.onClose.dispatch(this)
    },
createInstance:function(i,h,g,m,l,k){
    var j=d.resolve(i);
    return new j(h,g,m,l,k)
    },
confirm:function(h,f,i,g){
    g=g||window;
    f.call(i||this,g.confirm(this._decode(this.editor.getLang(h,h))))
    },
alert:function(h,f,j,g){
    var i=this;
    g=g||window;
    g.alert(i._decode(i.editor.getLang(h,h)));
    if(f){
        f.call(j||i)
        }
    },
resizeBy:function(f,g,h){
    h.resizeBy(f,g)
    },
_decode:function(f){
    return d.DOM.decode(f).replace(/\\n/g,"\n")
    }
})
}(tinymce));
(function(a){
    function b(){
        var d={},c={},e={};

        function f(j,i,h,g){
            if(typeof(i)=="string"){
                i=[i]
                }
                a.each(i,function(k){
                j[k.toLowerCase()]={
                    func:h,
                    scope:g
                }
            })
        }
        a.extend(this,{
        add:function(i,h,g){
            f(d,i,h,g)
            },
        addQueryStateHandler:function(i,h,g){
            f(c,i,h,g)
            },
        addQueryValueHandler:function(i,h,g){
            f(e,i,h,g)
            },
        execCommand:function(h,k,j,i,g){
            if(k=d[k.toLowerCase()]){
                if(k.func.call(h||k.scope,j,i,g)!==false){
                    return true
                    }
                }
        },
    queryCommandValue:function(){
        if(cmd=e[cmd.toLowerCase()]){
            return cmd.func.call(scope||cmd.scope,ui,value,args)
            }
        },
queryCommandState:function(){
    if(cmd=c[cmd.toLowerCase()]){
        return cmd.func.call(scope||cmd.scope,ui,value,args)
        }
    }
})
}
a.GlobalCommands=new b()
})(tinymce);
(function(a){
    a.Formatter=function(T){
        var K={},M=a.each,c=T.dom,p=T.selection,s=a.dom.TreeWalker,I=new a.dom.RangeUtils(c),d=T.schema.isValid,E=c.isBlock,k=T.settings.forced_root_block,r=c.nodeIndex,D="\uFEFF",e=/^(src|href|style)$/,Q=false,A=true,o,N={
            apply:[],
            remove:[]
        };

        function y(U){
            return U instanceof Array
            }
            function l(V,U){
            return c.getParents(V,U,c.getRoot())
            }
            function b(U){
            return U.nodeType===1&&(U.face==="mceinline"||U.style.fontFamily==="mceinline")
            }
            function P(U){
            return U?K[U]:K
            }
            function j(U,V){
            if(U){
                if(typeof(U)!=="string"){
                    M(U,function(X,W){
                        j(W,X)
                        })
                    }else{
                    V=V.length?V:[V];
                    M(V,function(W){
                        if(W.deep===o){
                            W.deep=!W.selector
                            }
                            if(W.split===o){
                            W.split=!W.selector||W.inline
                            }
                            if(W.remove===o&&W.selector&&!W.inline){
                            W.remove="none"
                            }
                            if(W.selector&&W.inline){
                            W.mixed=true;
                            W.block_expand=true
                            }
                            if(typeof(W.classes)==="string"){
                            W.classes=W.classes.split(/\s+/)
                            }
                        });
                K[U]=V
                }
            }
    }
function R(W,ac,Y){
    var Z=P(W),ad=Z[0],ab,V,aa;
    function X(ag){
        var af=ag.startContainer,aj=ag.startOffset,ai,ah;
        if(af.nodeType==1||af.nodeValue===""){
            af=af.nodeType==1?af.childNodes[aj]:af;
            if(af){
                ai=new s(af,af.parentNode);
                for(ah=ai.current();ah;ah=ai.next()){
                    if(ah.nodeType==3&&!f(ah)){
                        ag.setStart(ah,0);
                        break
                    }
                }
                }
        }
return ag
}
function U(ag,af){
    af=af||ad;
    if(ag){
        M(af.styles,function(ai,ah){
            c.setStyle(ag,ah,q(ai,ac))
            });
        M(af.attributes,function(ai,ah){
            c.setAttrib(ag,ah,q(ai,ac))
            });
        M(af.classes,function(ah){
            ah=q(ah,ac);
            if(!c.hasClass(ag,ah)){
                c.addClass(ag,ah)
                }
            })
    }
}
function ae(ag){
    var af=[],ai,ah;
    ai=ad.inline||ad.block;
    ah=c.create(ai);
    U(ah);
    I.walk(ag,function(aj){
        var ak;
        function al(am){
            var ap=am.nodeName.toLowerCase(),ao=am.parentNode.nodeName.toLowerCase(),an;
            if(g(ap,"br")){
                ak=0;
                if(ad.block){
                    c.remove(am)
                    }
                    return
            }
            if(ad.wrapper&&v(am,W,ac)){
                ak=0;
                return
            }
            if(ad.block&&!ad.wrapper&&F(ap)){
                am=c.rename(am,ai);
                U(am);
                af.push(am);
                ak=0;
                return
            }
            if(ad.selector){
                M(Z,function(aq){
                    if(c.is(am,aq.selector)&&!b(am)){
                        U(am,aq);
                        an=true
                        }
                    });
            if(!ad.inline||an){
                ak=0;
                return
            }
        }
        if(d(ai,ap)&&d(ao,ai)){
        if(!ak){
            ak=ah.cloneNode(Q);
            am.parentNode.insertBefore(ak,am);
            af.push(ak)
            }
            ak.appendChild(am)
        }else{
        ak=0;
        M(a.grep(am.childNodes),al);
        ak=0
        }
    }
    M(aj,al)
});
M(af,function(al){
    var aj;
    function am(ao){
        var an=0;
        M(ao.childNodes,function(ap){
            if(!f(ap)&&!G(ap)){
                an++
            }
        });
    return an
    }
    function ak(an){
    var ap,ao;
    M(an.childNodes,function(aq){
        if(aq.nodeType==1&&!G(aq)&&!b(aq)){
            ap=aq;
            return Q
            }
        });
if(ap&&h(ap,ad)){
    ao=ap.cloneNode(Q);
    U(ao);
    c.replace(ao,an,A);
    c.remove(ap,1)
    }
    return ao||an
}
aj=am(al);
if(aj===0){
    c.remove(al,1);
    return
}
if(ad.inline||ad.wrapper){
    if(!ad.exact&&aj===1){
        al=ak(al)
        }
        M(Z,function(an){
        M(c.select(an.inline,al),function(ao){
            S(an,ac,ao,an.exact?ao:null)
            })
        });
    if(v(al.parentNode,W,ac)){
        c.remove(al,1);
        al=0;
        return A
        }
        if(ad.merge_with_parents){
        c.getParent(al.parentNode,function(an){
            if(v(an,W,ac)){
                c.remove(al,1);
                al=0;
                return A
                }
            })
    }
    if(al){
    al=t(B(al),al);
    al=t(al,B(al,A))
    }
}
})
}
if(ad){
    if(Y){
        V=c.createRng();
        V.setStartBefore(Y);
        V.setEndAfter(Y);
        ae(n(V,Z))
        }else{
        if(!p.isCollapsed()||!ad.inline){
            ab=p.getBookmark();
            ae(n(p.getRng(A),Z));
            p.moveToBookmark(ab);
            p.setRng(X(p.getRng(A)));
            T.nodeChanged()
            }else{
            O("apply",W,ac)
            }
        }
}
}
function z(W,af,Z){
    var aa=P(W),ah=aa[0],ae,ad,V;
    function Y(ak){
        var aj=ak.startContainer,ap=ak.startOffset,ao,an,al,am;
        if(aj.nodeType==3&&ap>=aj.nodeValue.length-1){
            aj=aj.parentNode;
            ap=r(aj)+1
            }
            if(aj.nodeType==1){
            al=aj.childNodes;
            aj=al[Math.min(ap,al.length-1)];
            ao=new s(aj);
            if(ap>al.length-1){
                ao.next()
                }
                for(an=ao.current();an;an=ao.next()){
                if(an.nodeType==3&&!f(an)){
                    am=c.create("a",null,D);
                    an.parentNode.insertBefore(am,an);
                    ak.setStart(an,0);
                    p.setRng(ak);
                    c.remove(am);
                    return
                }
            }
            }
    }
function X(am){
    var al,ak,aj;
    al=a.grep(am.childNodes);
    for(ak=0,aj=aa.length;ak<aj;ak++){
        if(S(aa[ak],af,am,am)){
            break
        }
    }
    if(ah.deep){
    for(ak=0,aj=al.length;ak<aj;ak++){
        X(al[ak])
        }
    }
}
function ab(aj){
    var ak;
    M(l(aj.parentNode).reverse(),function(al){
        var am;
        if(!ak&&al.id!="_start"&&al.id!="_end"){
            am=v(al,W,af);
            if(am&&am.split!==false){
                ak=al
                }
            }
    });
return ak
}
function U(am,aj,ao,ar){
    var at,aq,ap,al,an,ak;
    if(am){
        ak=am.parentNode;
        for(at=aj.parentNode;at&&at!=ak;at=at.parentNode){
            aq=at.cloneNode(Q);
            for(an=0;an<aa.length;an++){
                if(S(aa[an],af,aq,aq)){
                    aq=0;
                    break
                }
            }
            if(aq){
            if(ap){
                aq.appendChild(ap)
                }
                if(!al){
                al=aq
                }
                ap=aq
            }
        }
        if(ar&&(!ah.mixed||!E(am))){
    aj=c.split(am,aj)
    }
    if(ap){
    ao.parentNode.insertBefore(ap,ao);
    al.appendChild(ao)
    }
}
return aj
}
function ag(aj){
    return U(ab(aj),aj,aj,true)
    }
    function ac(al){
    var ak=c.get(al?"_start":"_end"),aj=ak[al?"firstChild":"lastChild"];
    if(G(aj)){
        aj=aj[al?"firstChild":"lastChild"]
        }
        c.remove(ak,true);
    return aj
    }
    function ai(aj){
    var ak,al;
    aj=n(aj,aa,A);
    if(ah.split){
        ak=H(aj,A);
        al=H(aj);
        if(ak!=al){
            ak=L(ak,"span",{
                id:"_start",
                _mce_type:"bookmark"
            });
            al=L(al,"span",{
                id:"_end",
                _mce_type:"bookmark"
            });
            ag(ak);
            ag(al);
            ak=ac(A);
            al=ac()
            }else{
            ak=al=ag(ak)
            }
            aj.startContainer=ak.parentNode;
        aj.startOffset=r(ak);
        aj.endContainer=al.parentNode;
        aj.endOffset=r(al)+1
        }
        I.walk(aj,function(am){
        M(am,function(an){
            X(an)
            })
        })
    }
    if(Z){
    V=c.createRng();
    V.setStartBefore(Z);
    V.setEndAfter(Z);
    ai(V);
    return
}
if(!p.isCollapsed()||!ah.inline){
    ae=p.getBookmark();
    ai(p.getRng(A));
    p.moveToBookmark(ae);
    if(i(W,af,p.getStart())){
        Y(p.getRng(true))
        }
        T.nodeChanged()
    }else{
    O("remove",W,af)
    }
}
function C(U,W,V){
    if(i(U,W,V)){
        z(U,W,V)
        }else{
        R(U,W,V)
        }
    }
function v(V,U,aa,Y){
    var W=P(U),ab,Z,X;
    function ac(ag,ai,aj){
        var af,ah,ad=ai[aj],ae;
        if(ad){
            if(ad.length===o){
                for(af in ad){
                    if(ad.hasOwnProperty(af)){
                        if(aj==="attributes"){
                            ah=c.getAttrib(ag,af)
                            }else{
                            ah=J(ag,af)
                            }
                            if(Y&&!ah&&!ai.exact){
                            return
                        }
                        if((!Y||ai.exact)&&!g(ah,q(ad[af],aa))){
                            return
                        }
                    }
                }
                }else{
    for(ae=0;ae<ad.length;ae++){
        if(aj==="attributes"?c.getAttrib(ag,ad[ae]):J(ag,ad[ae])){
            return ai
            }
        }
    }
}
return ai
}
if(W&&V){
    for(Z=0;Z<W.length;Z++){
        ab=W[Z];
        if(h(V,ab)&&ac(V,ab,"attributes")&&ac(V,ab,"styles")){
            if(X=ab.classes){
                for(Z=0;Z<X.length;Z++){
                    if(!c.hasClass(V,X[Z])){
                        return
                    }
                }
                }
            return ab
    }
    }
}
}
function i(W,Z,Y){
    var V,X;
    function U(aa){
        aa=c.getParent(aa,function(ab){
            return !!v(ab,W,Z,true)
            });
        return v(aa,W,Z)
        }
        if(Y){
        return U(Y)
        }
        if(p.isCollapsed()){
        for(X=N.apply.length-1;X>=0;X--){
            if(N.apply[X].name==W){
                return true
                }
            }
        for(X=N.remove.length-1;X>=0;X--){
        if(N.remove[X].name==W){
            return false
            }
        }
    return U(p.getNode())
}
Y=p.getNode();
if(U(Y)){
    return A
    }
    V=p.getStart();
if(V!=Y){
    if(U(V)){
        return A
        }
    }
return Q
}
function u(ab,aa){
    var Y,Z=[],X={},W,V,U;
    if(p.isCollapsed()){
        for(V=0;V<ab.length;V++){
            for(W=N.remove.length-1;W>=0;W--){
                U=ab[V];
                if(N.remove[W].name==U){
                    X[U]=true;
                    break
                }
            }
            }
        for(W=N.apply.length-1;W>=0;W--){
    for(V=0;V<ab.length;V++){
        U=ab[V];
        if(!X[U]&&N.apply[W].name==U){
            X[U]=true;
            Z.push(U)
            }
        }
    }
}
Y=p.getStart();
c.getParent(Y,function(ae){
    var ad,ac;
    for(ad=0;ad<ab.length;ad++){
        ac=ab[ad];
        if(!X[ac]&&v(ae,ac,aa)){
            X[ac]=true;
            Z.push(ac)
            }
        }
    });
return Z
}
function x(Y){
    var aa=P(Y),X,W,Z,V,U;
    if(aa){
        X=p.getStart();
        W=l(X);
        for(V=aa.length-1;V>=0;V--){
            U=aa[V].selector;
            if(!U){
                return A
                }
                for(Z=W.length-1;Z>=0;Z--){
                if(c.is(W[Z],U)){
                    return A
                    }
                }
            }
        }
return Q
}
a.extend(this,{
    get:P,
    register:j,
    apply:R,
    remove:z,
    toggle:C,
    match:i,
    matchAll:u,
    matchNode:v,
    canApply:x
});
function h(U,V){
    if(g(U,V.inline)){
        return A
        }
        if(g(U,V.block)){
        return A
        }
        if(V.selector){
        return c.is(U,V.selector)
        }
    }
function g(V,U){
    V=V||"";
    U=U||"";
    V=""+(V.nodeName||V);
    U=""+(U.nodeName||U);
    return V.toLowerCase()==U.toLowerCase()
    }
    function J(V,U){
    var W=c.getStyle(V,U);
    if(U=="color"||U=="backgroundColor"){
        W=c.toHex(W)
        }
        if(U=="fontWeight"&&W==700){
        W="bold"
        }
        return""+W
    }
    function q(U,V){
    if(typeof(U)!="string"){
        U=U(V)
        }else{
        if(V){
            U=U.replace(/%(\w+)/g,function(X,W){
                return V[W]||X
                })
            }
        }
    return U
}
function f(U){
    return U&&U.nodeType===3&&/^([\s\r\n]+|)$/.test(U.nodeValue)
    }
    function L(W,V,U){
    var X=c.create(V,U);
    W.parentNode.insertBefore(X,W);
    X.appendChild(W);
    return X
    }
    function n(U,ac,X){
    var W=U.startContainer,Z=U.startOffset,af=U.endContainer,aa=U.endOffset,ae,ab;
    function ad(ai,aj,ag,ah){
        var ak,al;
        ah=ah||c.getRoot();
        for(;;){
            ak=ai.parentNode;
            if(ak==ah||(!ac[0].block_expand&&E(ak))){
                return ai
                }
                for(ae=ak[aj];ae&&ae!=ai;ae=ae[ag]){
                if(ae.nodeType==1&&!G(ae)){
                    return ai
                    }
                    if(ae.nodeType==3&&!f(ae)){
                    return ai
                    }
                }
            ai=ai.parentNode
        }
        return ai
    }
    if(W.nodeType==1&&W.hasChildNodes()){
    ab=W.childNodes.length-1;
    W=W.childNodes[Z>ab?ab:Z];
    if(W.nodeType==3){
        Z=0
        }
    }
if(af.nodeType==1&&af.hasChildNodes()){
    ab=af.childNodes.length-1;
    af=af.childNodes[aa>ab?ab:aa-1];
    if(af.nodeType==3){
        aa=af.nodeValue.length
        }
    }
if(G(W.parentNode)){
    W=W.parentNode
    }
    if(G(W)){
    W=W.nextSibling||W
    }
    if(G(af.parentNode)){
    af=af.parentNode
    }
    if(G(af)){
    af=af.previousSibling||af
    }
    if(ac[0].inline||ac[0].block_expand){
    W=ad(W,"firstChild","nextSibling");
    af=ad(af,"lastChild","previousSibling")
    }
    if(ac[0].selector&&ac[0].expand!==Q&&!ac[0].inline){
    function Y(ah,ag){
        var ai,aj,ak;
        if(ah.nodeType==3&&ah.nodeValue.length==0&&ah[ag]){
            ah=ah[ag]
            }
            ai=l(ah);
        for(aj=0;aj<ai.length;aj++){
            for(ak=0;ak<ac.length;ak++){
                if(c.is(ai[aj],ac[ak].selector)){
                    return ai[aj]
                    }
                }
            }
        return ah
}
W=Y(W,"previousSibling");
af=Y(af,"nextSibling")
}
if(ac[0].block||ac[0].selector){
    function V(ah,ag,aj){
        var ai;
        if(!ac[0].wrapper){
            ai=c.getParent(ah,ac[0].block)
            }
            if(!ai){
            ai=c.getParent(ah.nodeType==3?ah.parentNode:ah,E)
            }
            if(ai&&ac[0].wrapper){
            ai=l(ai,"ul,ol").reverse()[0]||ai
            }
            if(!ai){
            ai=ah;
            while(ai[ag]&&!E(ai[ag])){
                ai=ai[ag];
                if(g(ai,"br")){
                    break
                }
            }
        }
    return ai||ah
}
W=V(W,"previousSibling");
af=V(af,"nextSibling");
if(ac[0].block){
    if(!E(W)){
        W=ad(W,"firstChild","nextSibling")
        }
        if(!E(af)){
        af=ad(af,"lastChild","previousSibling")
        }
    }
}
if(W.nodeType==1){
    Z=r(W);
    W=W.parentNode
    }
    if(af.nodeType==1){
    aa=r(af)+1;
    af=af.parentNode
    }
    return{
    startContainer:W,
    startOffset:Z,
    endContainer:af,
    endOffset:aa
}
}
function S(aa,Z,X,U){
    var W,V,Y;
    if(!h(X,aa)){
        return Q
        }
        if(aa.remove!="all"){
        M(aa.styles,function(ac,ab){
            ac=q(ac,Z);
            if(typeof(ab)==="number"){
                ab=ac;
                U=0
                }
                if(!U||g(J(U,ab),ac)){
                c.setStyle(X,ab,"")
                }
                Y=1
            });
        if(Y&&c.getAttrib(X,"style")==""){
            X.removeAttribute("style");
            X.removeAttribute("_mce_style")
            }
            M(aa.attributes,function(ad,ab){
            var ac;
            ad=q(ad,Z);
            if(typeof(ab)==="number"){
                ab=ad;
                U=0
                }
                if(!U||g(c.getAttrib(U,ab),ad)){
                if(ab=="class"){
                    ad=c.getAttrib(X,ab);
                    if(ad){
                        ac="";
                        M(ad.split(/\s+/),function(ae){
                            if(/mce\w+/.test(ae)){
                                ac+=(ac?" ":"")+ae
                                }
                            });
                    if(ac){
                        c.setAttrib(X,ab,ac);
                        return
                    }
                }
            }
        if(ab=="class"){
            X.removeAttribute("className")
            }
            if(e.test(ab)){
            X.removeAttribute("_mce_"+ab)
            }
            X.removeAttribute(ab)
        }
    });
M(aa.classes,function(ab){
    ab=q(ab,Z);
    if(!U||c.hasClass(U,ab)){
        c.removeClass(X,ab)
        }
    });
V=c.getAttribs(X);
for(W=0;W<V.length;W++){
    if(V[W].nodeName.indexOf("_")!==0){
        return Q
        }
    }
}
if(aa.remove!="none"){
    m(X,aa);
    return A
    }
}
function m(W,X){
    var U=W.parentNode,V;
    if(X.block){
        if(!k){
            function Y(aa,Z,ab){
                aa=B(aa,Z,ab);
                return !aa||(aa.nodeName=="BR"||E(aa))
                }
                if(E(W)&&!E(U)){
                if(!Y(W,Q)&&!Y(W.firstChild,A,1)){
                    W.insertBefore(c.create("br"),W.firstChild)
                    }
                    if(!Y(W,A)&&!Y(W.lastChild,Q,1)){
                    W.appendChild(c.create("br"))
                    }
                }
        }else{
    if(U==c.getRoot()){
        if(!X.list_block||!g(W,X.list_block)){
            M(a.grep(W.childNodes),function(Z){
                if(d(k,Z.nodeName.toLowerCase())){
                    if(!V){
                        V=L(Z,k)
                        }else{
                        V.appendChild(Z)
                        }
                    }else{
                V=0
                }
            })
    }
}
}
}
if(X.selector&&X.inline&&!g(X.inline,W)){
    return
}
c.remove(W,1)
}
function B(V,U,W){
    if(V){
        U=U?"nextSibling":"previousSibling";
        for(V=W?V:V[U];V;V=V[U]){
            if(V.nodeType==1||!f(V)){
                return V
                }
            }
        }
}
function G(U){
    return U&&U.nodeType==1&&U.getAttribute("_mce_type")=="bookmark"
    }
    function t(Y,X){
    var U,W,V;
    function aa(ad,ac){
        if(ad.nodeName!=ac.nodeName){
            return Q
            }
            function ab(af){
            var ag={};

            M(c.getAttribs(af),function(ah){
                var ai=ah.nodeName.toLowerCase();
                if(ai.indexOf("_")!==0&&ai!=="style"){
                    ag[ai]=c.getAttrib(af,ai)
                    }
                });
        return ag
        }
        function ae(ai,ah){
        var ag,af;
        for(af in ai){
            if(ai.hasOwnProperty(af)){
                ag=ah[af];
                if(ag===o){
                    return Q
                    }
                    if(ai[af]!=ag){
                    return Q
                    }
                    delete ah[af]
            }
        }
        for(af in ah){
        if(ah.hasOwnProperty(af)){
            return Q
            }
        }
    return A
}
if(!ae(ab(ad),ab(ac))){
    return Q
    }
    if(!ae(c.parseStyle(c.getAttrib(ad,"style")),c.parseStyle(c.getAttrib(ac,"style")))){
    return Q
    }
    return A
}
if(Y&&X){
    function Z(ac,ab){
        for(W=ac;W;W=W[ab]){
            if(W.nodeType==3&&!f(W)){
                return ac
                }
                if(W.nodeType==1&&!G(W)){
                return W
                }
            }
        return ac
    }
    Y=Z(Y,"previousSibling");
X=Z(X,"nextSibling");
if(aa(Y,X)){
    for(W=Y.nextSibling;W&&W!=X;){
        V=W;
        W=W.nextSibling;
        Y.appendChild(V)
        }
        c.remove(X);
    M(a.grep(X.childNodes),function(ab){
        Y.appendChild(ab)
        });
    return Y
    }
}
return X
}
function F(U){
    return/^(h[1-6]|p|div|pre|address|dl|dt|dd)$/.test(U)
    }
    function H(V,Y){
    var U,X,W;
    U=V[Y?"startContainer":"endContainer"];
    X=V[Y?"startOffset":"endOffset"];
    if(U.nodeType==1){
        W=U.childNodes.length-1;
        if(!Y&&X){
            X--
        }
        U=U.childNodes[X>W?W:X]
        }
        return U
    }
    function O(Z,V,Y){
    var W,U=N[Z],aa=N[Z=="apply"?"remove":"apply"];
    function ab(){
        return N.apply.length||N.remove.length
        }
        function X(){
        N.apply=[];
        N.remove=[]
        }
        function ac(ad){
        M(N.apply.reverse(),function(ae){
            R(ae.name,ae.vars,ad)
            });
        M(N.remove.reverse(),function(ae){
            z(ae.name,ae.vars,ad)
            });
        c.remove(ad,1);
        X()
        }
        for(W=U.length-1;W>=0;W--){
        if(U[W].name==V){
            return
        }
    }
    U.push({
    name:V,
    vars:Y
});
for(W=aa.length-1;W>=0;W--){
    if(aa[W].name==V){
        aa.splice(W,1)
        }
    }
if(ab()){
    T.getDoc().execCommand("FontName",false,"mceinline");
    N.lastRng=p.getRng();
    M(c.select("font,span"),function(ae){
        var ad;
        if(b(ae)){
            ad=p.getBookmark();
            ac(ae);
            p.moveToBookmark(ad);
            T.nodeChanged()
            }
        });
if(!N.isListening&&ab()){
    N.isListening=true;
    M("onKeyDown,onKeyUp,onKeyPress,onMouseUp".split(","),function(ad){
        T[ad].addToTop(function(ae,af){
            if(ab()&&!a.dom.RangeUtils.compareRanges(N.lastRng,p.getRng())){
                M(c.select("font,span"),function(ah){
                    var ai,ag;
                    if(b(ah)){
                        ai=ah.firstChild;
                        if(ai){
                            ac(ah);
                            ag=c.createRng();
                            ag.setStart(ai,ai.nodeValue.length);
                            ag.setEnd(ai,ai.nodeValue.length);
                            p.setRng(ag);
                            ae.nodeChanged()
                            }else{
                            c.remove(ah)
                            }
                        }
                });
        if(af.type=="keyup"||af.type=="mouseup"){
            X()
            }
        }
    })
})
}
}
}
}
})(tinymce);
tinymce.onAddEditor.add(function(e,a){
    var d,h,g,c=a.settings;
    if(c.inline_styles){
        h=e.explode(c.font_size_style_values);
        function b(j,i){
            g.replace(g.create("span",{
                style:i
            }),j,1)
            }
            d={
            font:function(j,i){
                b(i,{
                    backgroundColor:i.style.backgroundColor,
                    color:i.color,
                    fontFamily:i.face,
                    fontSize:h[parseInt(i.size)-1]
                    })
                },
            u:function(j,i){
                b(i,{
                    textDecoration:"underline"
                })
                },
            strike:function(j,i){
                b(i,{
                    textDecoration:"line-through"
                })
                }
            };

    function f(i,j){
        g=i.dom;
        if(c.convert_fonts_to_spans){
            e.each(g.select("font,u,strike",j.node),function(k){
                d[k.nodeName.toLowerCase()](a.dom,k)
                })
            }
        }
    a.onPreProcess.add(f);
    a.onInit.add(function(){
    a.selection.onSetContent.add(f)
    })
}
});