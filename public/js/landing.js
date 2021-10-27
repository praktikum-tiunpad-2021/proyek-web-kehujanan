let btns = document.querySelectorAll('.sidebarBtn');

for (let i = 0; i < btns.length; i++) {
    btns[i].addEventListener('click',activate);
}


function inject(container, injectContainer, payload){
    if(injectContainer.querySelector("script") != null) injectContainer.querySelector("script").remove();
    let epayload = htmlToElement(payload);
    container.innerHTML = payload;
    if(epayload.querySelectorAll("script").length != 0){
        container.querySelector("script").remove();
        let scriptNode = document.createElement('script');
        scriptNode.innerHTML = epayload.querySelector("script").innerHTML;
        injectContainer.appendChild(scriptNode);
    }
}

function htmlToElement(html) {
    var template = document.createElement('template');
    html = html.trim(); // Never return a text node of whitespace as the result
    template.innerHTML = html;
    return template.content;
}
function htmlToElements(html) {
    var template = document.createElement('template');
    template.innerHTML = html;
    return template.content.childNodes;
}

let currentPage;
let pages = [];

function postForm(e) {
    let url = e.getAttribute('action');
    let container = document.getElementsByClassName("container")[0];
    let injectContainer = document.querySelector(".inject");
    let xhr=new XMLHttpRequest();
    xhr.open('post',url,true);
    //xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");<--don't do this
    let formData=new FormData(e);
    formData.append('update', true);    // makes no difference
    xhr.send(formData);
    xhr.onload=function() {
        // alert(xhr.responseURL);
        console.log(xhr.response);
        // alert(xhr.responseText);
        // alert(pages[xhr.responseURL]);
        // if(confirm("yaks"))
        pages[xhr.responseURL] = xhr.responseText;
        inject(container,injectContainer,pages[xhr.responseURL]);
        
        // pactivate(xhr.responseURL);
        // alert("cuk slsese");

        // inject(container,injectContainer,pages['/tugas/index']);
    };
}
function deleteTugas(e) {
    if(!confirm('Hapus tugas ini?')) return;
    let container = document.getElementsByClassName("container")[0];
    let injectContainer = document.querySelector(".inject");
    let page = e.getAttribute('action');
    let method = e.getAttribute('method');

    // let data = e.getAttribute('data');
    const xhr = new XMLHttpRequest();
    
    xhr.onload = ()=> {
        // console.log(xhr.responseType);
            // alert(xhr.responseURL);
            
            pactivate(xhr.responseURL);
        };
    xhr.open(method, page);
    xhr.send();
    // xhr.send(`var1=${data}`);
}
function pactivate(page) {

    let container = document.getElementsByClassName("container")[0];
    let injectContainer = document.querySelector(".inject");
    // let data = e.getAttribute('data');
    console.log(page);

    if(currentPage != null) pages[currentPage] = container.innerHTML;
    
    if(pages[page] == "" ||pages[page] == null){
        pages[page] = "Loading...";
    }
    inject(container,injectContainer,pages[page]);
    
    const xhr = new XMLHttpRequest();
    xhr.onload = ()=> {
        // console.log(xhr.responseType);
        pages[page] = xhr.responseText;
            inject(container,injectContainer,pages[page]);
        
            currentPage = page;
        };
    xhr.open("GET", page);
    xhr.send();

}
function aactivate(el) {
    let page = el.getAttribute('page');
    let container = document.getElementsByClassName("container")[0];
    let injectContainer = document.querySelector(".inject");
    // let data = el.getAttribute('data');
    console.log(page);
    
    // if(pages[page] == "" ||pages[page] == null){
        pages[page] = "Loading...";
    // }
    const xhr = new XMLHttpRequest();
    inject(container,injectContainer,pages[page]);
    
    xhr.onload = ()=> {
        // console.log(xhr.responseType);
            pages[page] = xhr.responseText;
            
            inject(container,injectContainer,pages[page]);
            currentPage = page;
        };
    xhr.open("GET", page);
    xhr.send();
}
function activate(e) {
    let active = document.querySelector('.active');
    let page = this.getAttribute('page');
    let container = document.getElementsByClassName("container")[0];
    let injectContainer = document.querySelector(".inject");

    pages[active.getAttribute('page')] = container.innerHTML;
    if(pages[page] == "" ||pages[page] == null){
        pages[page] = "Loading...";
    }
    active.classList.remove('active');
    this.classList.add('active');
    const xhr = new XMLHttpRequest();
    inject(container,injectContainer,pages[page]);
    
    xhr.onload = ()=> {
        // console.log(xhr.responseType);
        pages[page] = xhr.responseText;
        if (document.querySelector('.active') == this) {
            // inject(injectContainer,pages[page]);
            inject(container,injectContainer,pages[page]);
            // container.innerHTML = pages[page];
        }
    }
    

    xhr.open("GET", page);
    xhr.send();
}

aactivate(document.querySelector('.active'));