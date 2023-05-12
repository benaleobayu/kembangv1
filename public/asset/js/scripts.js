$(document).ready(function(){
    $("[rel=tooltip]").tooltip({ placement: 'top'});
});

$(document).ready(function() {
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 4000);
});    

// preview image create & edit
function previewImage()
{
    const image = document.querySelector('#image');
    const ImgPreview = document.querySelector('.img-preview');

    ImgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oRFEvent) {
        ImgPreview.src = oRFEvent.target.result;
    }

}


// check all di permission roles

    var checkAll = document.getElementById('check-all');
    var checkboxes = document.getElementsByName('permissions[]');

    checkAll.onclick = function() {
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    };
