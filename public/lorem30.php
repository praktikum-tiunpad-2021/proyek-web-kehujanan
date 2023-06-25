<div>
    <div id="date"></div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem vero sed veritatis placeat animi excepturi culpa quia ex voluptas? Pariatur tempora officia nostrum assumenda, eos suscipit veritatis nulla dignissimos odit!
</div>
<script class="inject">
    function sleep (time) {
    return new Promise((resolve) => setTimeout(resolve, time));
    }
    var printDate = function () {
        let date = new Date().toLocaleTimeString();
        try {
            
            document.getElementById('date').innerText = date;
        } catch (error) {
            
        }
        sleep(1000).then(printDate).catch(()=>{printDate = undefined;});
    }
    printDate();
</script>