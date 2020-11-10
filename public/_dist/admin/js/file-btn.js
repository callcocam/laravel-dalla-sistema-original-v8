document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('button-image').addEventListener('click', (event) => {
        event.preventDefault();
        window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
    });
});
// set file link
function fmSetLink($url) {
    document.getElementById('image_label').value = $url;

    console.log(document.getElementById('image_tag'))
    if(document.getElementById('image_tag')){
        document.getElementById('image_tag').setAttribute('src', $url);
    }

}
