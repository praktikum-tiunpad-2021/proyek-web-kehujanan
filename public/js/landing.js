let btns = document.querySelectorAll('.sidebarBtn');
let injectContainerID = "injectContainer";
let injectScriptID = "injectScipt";
let orign = window.location.origin;
let baseURL = orign+'/dashboard';
let savedPages = [];
let loadingHTML = htmlToElement("<main class=\"isLoading\"></main>");
let pagesInLoading = [];
let isProcessing = false;

function getOverlayNode(){
    return document.querySelector('.overlay');
}
function showOverlayNode(){
    let overlayNode = getOverlayNode()
    overlayNode.classList.remove("hidden");
}
function hideOverlayNode(){
    let overlayNode = getOverlayNode()
    overlayNode.classList.add("hidden");
}
function init(){
    for (let i = 0; i < btns.length; i++) {
        if(btns[i].getAttribute('onclick') != null) continue;
        btns[i].addEventListener('click',function() { activate(btns[i].getAttribute('id')); } );
    }
    let activeBtnID = document.querySelector(".sideWrapper").getAttribute('activeBtn');
    // document.getElementById(activeBtnID).classList.add('active');
    // document.getElementById(activeBtnID).classList.remove('hidden');
    // let pageAddress = document.querySelector('.active').getAttribute('page');
    // pactivate(pageAddress);
    activate(activeBtnID,false);
    window.onpopstate = function(event) {
        // history.
        // let target = document.getElementById(event.state.activeID);
        // console.log('target'+target.getAttribute('page'));
        // switchActive(target);
        // pactivate(event.state.page,false);    
        activate(event.state.activeID,false);
    };
}
function getInjectContainer(){
    return document.getElementById(injectContainerID);
}
function createInjectContainer(payload){
    let containerNode = document.createElement('section');
    containerNode.setAttribute('id',injectContainerID);

    if(payload === undefined) return containerNode;
    if(typeof payload == "string"){
        payload = htmlToElements(payload);
        // console.log("Using string");
    }
    
    try {
        containerNode.appendChild(payload);
        // console.log("using Node");
    } catch (error) {
        let containerNodes = payload;
        for (var i = 0; i < containerNodes.length; i++) {
            // console.log(containerNodes[i]);
            containerNode.appendChild(containerNodes[i]);
        }
        // console.log("using Nodelist");
    }
    return containerNode;
}
function getInjectScript(){
    return document.getElementById(injectScriptID);
}
function getActiveBtn(){
    return document.querySelector('.active');
}
function getSidebarBtn(id){
    return document.getElementById(id);
}

function redirect(pageAddress) {
    window.location.replace(baseURL+pageAddress);
}

function savePage(pageAddress,page){
    if(page === undefined) page = getInjectContainer();
    if(pageAddress === undefined) pageAddress = getCurrentPage();
    if(page.classList !== undefined)
    page = page.cloneNode(true);
    // console.log('saved '+pageAddress + page.classList.contains('isLoading'));
    savedPages[pageAddress] = page;
    // console.log('confirm '+getPage(pageAddress).outerHTML);
}
function getPage(pageAddress){
    return savedPages[pageAddress];
}
function isSavedPage(pageAddress){
    return getPage(pageAddress) != "" && getPage(pageAddress) != null;
}
function getCurrentPage(){
    return getActiveBtn().getAttribute('page');
}
function saveCurrentPage(){
    if(getCurrentPage() != null) savePage();
}
function updatePage(pageAddress,page){
    savePage(pageAddress,page);
    if((getCurrentPage() == pageAddress)){
        loadPage(getPage(pageAddress),pageAddress);
    }
}

function switchActive(target){
    if(getActiveBtn() != null){
        let active = getActiveBtn();
        active.classList.remove('active');
    }
    target.classList.add('active');
    target.classList.remove('hidden');
}

function injectScript(payload){
    let injectContainer = document.getElementById(injectScriptID);
    // if(injectContainer.querySelector("script") != null) injectContainer.querySelector("script").remove();
    let injectedScripts = injectContainer.querySelectorAll("script");
    injectedScripts.forEach(script => {
        script.remove();
        // script.classList.add('old');
    });
    let scripts = payload.querySelectorAll("script");
    // console.log(createInjectContainer(payload.cloneNode()));
    let scriptNode;
    scripts.forEach(script => {
        if(script.classList.contains('inject')){
            scriptNode = document.createElement('script');
            scriptNode.innerHTML = script.innerHTML;
            console.log(scriptNode);
            // if(script.classList.contains('once')) 
            script.remove();
            injectContainer.appendChild(scriptNode);
        }
    });
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

function loadPage(page){
    // console.log("injecting "+pageAddress+", container of type : "+typeof page);
    let container = getInjectContainer();
    container.remove();
    // console.log(page);

    document.body.insertBefore(page,getOverlayNode());
    injectScript(page);
}

function updatePageXHR(pageAddress){
    // console.log("xhr page now loading : "+pageAddress);
    if(pagesInLoading.includes(pageAddress)) return;
    pagesInLoading.push(pageAddress);
    if(!isSavedPage(pageAddress)) updatePage(pageAddress,createInjectContainer());
    getPage(pageAddress).classList.add('isLoading');
    const xhr = new XMLHttpRequest();
    xhr.onload = ()=> {
        // console.log("loaded with xhr "+pageAddress+" ,responseURL : " + xhr.responseURL);
        let containerNode = createInjectContainer(xhr.response);
        updatePage(pageAddress,containerNode);
        // console.log(pagesInLoading);
        pagesInLoading = pagesInLoading.filter(x => x!=pageAddress);
    };
    xhr.open("GET", pageAddress);
    xhr.send();
}

function postForm(e) {
    // e = form element
    if (isProcessing) {
        return;
    }
    isProcessing = true;
    let url = e.getAttribute('action');
    
    //xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");<--don't do this
    let xhr=new XMLHttpRequest();
    xhr.open('post',url,true);
    let formData=new FormData(e);
    formData.append('update', true);    // makes no difference
    try {
        xhr.send(formData);
    }
    catch(err) {
        appendNotification("Data gagal diupdate",true);
        return;
    }
    xhr.onload=function() {
        let path = "/tugas";
        let indexURL = origin+path;
        let responseURL = xhr.responseURL;
        let pageAddress = responseURL.substr(origin.length);
        let response = htmlToElement(xhr.response)
        injectScript(response);
        console.log(pageAddress);
        if(responseURL == indexURL){ // validation success
            updatePage(pageAddress,createInjectContainer(response));
        }// validation failed
        updatePage(pageAddress,createInjectContainer(response));
        if(xhr.status != 200){

            appendNotification("Data gagal diupdate",true);
        }
        else{

            appendNotification(xhr.getResponseHeader('pesan'));
        }
        isProcessing = false;
    };
}
function markTugas(el = new HTMLElement()) {
    if (isProcessing) {
        return;
    }
    let confirmString = el.classList.contains('selesai') ? 'Belum menyelesaikan tugas ini?' : 'Sudah menyelesaikan tugas ini?';
    if(!confirm(confirmString)) return;
    isProcessing = true;
    let page = el.getAttribute('action');
    let method = el.getAttribute('method');

    // let data = el.getAttribute('data');
    const xhr = new XMLHttpRequest();
    let icon = el.innerHTML;
    el.innerHTML = "<i class=\"fas fa-spinner\"></i>";
    el.querySelector('*').classList.toggle('spinning');
    xhr.onload = ()=> {
        el.querySelector('*').classList.toggle('spinning');
        appendNotification(xhr.getResponseHeader('pesan'));
        if(xhr.getResponseHeader('markstatus') == 'selesai')el.classList.add('selesai');
        else el.classList.remove('selesai');
        isProcessing = false;
        el.innerHTML = icon;
    };
    xhr.open(method, page);
    xhr.send();
    // xhr.send(`var1=${data}`);
}
function deleteTugas(el) {
    if (isProcessing) {
        return;
    }
    if(!confirm('Hapus tugas ini?')) return;
    isProcessing = true;
    let page = el.getAttribute('action');
    let method = el.getAttribute('method');

    const xhr = new XMLHttpRequest();
    let icon = el.innerHTML;
    el.innerHTML = "<i class=\"fas fa-spinner\"></i>";
    el.querySelector('*').classList.toggle('spinning');
    xhr.onload = ()=> {
        el.querySelector('*').classList.toggle('spinning');
        appendNotification(xhr.getResponseHeader('pesan'));
        if(xhr.getResponseHeader('status') == 'dihapus'){
            el.parentElement.remove();
        }else{
            alert('Penghapusan gagal');
            el.innerHTML = icon;
        }
        // console.log(xhr.responseType);
        // alert(xhr.responseURL);
        isProcessing = false;
    };
    xhr.open(method, page);
    xhr.send();
}
function editTugas(el = new HTMLElement()){
    let editBtn = getSidebarBtn('edit');
    let pageAddress = el.getAttribute('page');
    editBtn.setAttribute('page',pageAddress);
    activate('edit');
}
//use this
function activate(elOrId,push=true) {
    let el;
    if(typeof elOrId == 'string') el = getSidebarBtn(elOrId);
    else el = elOrId;
    let pageAddress = el.getAttribute('page');
    el.classList.remove('hidden');
    
    if(getActiveBtn() == null) switchActive(el);
    console.log("load from "+getCurrentPage()+ " to " + pageAddress);
    if(getCurrentPage() == pageAddress){
        console.log('with xhr');
        push = false;
        updatePageXHR(pageAddress);
    }else{
        console.log('with cache');
        saveCurrentPage();
        if(!isSavedPage(pageAddress)) updatePageXHR(pageAddress);
        loadPage(getPage(pageAddress));
        switchActive(el);
    }
    if(push) window.history.pushState({page: pageAddress ,activeID: getActiveBtn().getAttribute('id')}, '', baseURL+pageAddress.split('.',1));
    // loadPage(pageAddress,push);
}

function appendNotification(str,error=false){
    if(str === "" || str == null) return;
    let notificationNode = document.createElement('span');
    let notificationList = document.getElementById('notificationList');
    if(error) notificationNode.classList.add('error');
    notificationNode.innerHTML = '<b>'+str+'</b>'; 
    notificationList.appendChild(notificationNode);
    notificationList.classList.remove('empty');
    setTimeout(function() {notificationNode.remove();if(notificationList.innerHTML == "")notificationList.classList.add('empty');},2000);
}

function addTag(el = new HTMLElement(),selectedList = new HTMLElement()) {
    let value = el.value;
    if(value == "") return;
    el.value = '';
    document.getElementById("tagOption_"+value).disabled = true;
    let node = document.createElement('input');
    node.setAttribute('type','checkbox');
    node.classList.add('tag');
    node.checked = true;
    node.value = value;
    node.name = selectedList.id+"[]";
    node.id = "selectedTag_"+value;
    node.setAttribute('onclick','clearTag(this);');
    selectedList.appendChild(node);
}
function clearTag(tag){
    console.log(tag);
    document.getElementById("tagOption_"+tag.value).removeAttribute('disabled');
    tag.remove();
}
function clearTags(selectedList = new HTMLElement()) {
    console.log(selectedList.childElementCount);
    for (let i = 0; i < selectedList.childElementCount;) {
        var tag = selectedList.children.item(i);
        clearTag(tag);
    }
}
function toggleFilter() {
    document.getElementById('filterModal').classList.toggle('hidden');
}

init();
// aactivate(document.querySelector('.active'));

