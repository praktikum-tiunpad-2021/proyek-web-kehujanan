let btns = document.querySelectorAll('.sidebar .sidebarBtn');

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


let pages = [];

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