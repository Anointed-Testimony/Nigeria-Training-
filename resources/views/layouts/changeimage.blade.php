<div id="changeImageContainer" class="">
    <div class="change_image_box">
        <div class="change_box_header">
            <div class="change_box_upper_header">
                <h1>Add New Image</h1>
                <i class="fa-solid fa-times" onclick="closeImageBox()"></i>
            </div>
            <hr style="margin-top: 5px; ">
        </div>
        <div class="change_image_body">
            <div class="upload-featured" id="featuredDivs"> 
                <label for="edit_featured_image">
                    <i class="fa-regular fa-image"></i> 
                    <p>Upload Image</p>
                </label>
                <input type="file" name="banner_image" id="edit_featured_image" class="featured_image" accept=".png, .jpg" onchange="displayImage(this)">
            </div>
            <div class="upload-inputs">
                <label for="">Image Link</label>
                <input type="text" name="image_link">
            </div> 
        </div>
        <button style="margin-top: 10px" class="upload_section-button">Proceed</button>
    </div>
</div>

<script>
    function displayImage(input) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var parentElement = input.parentNode; // Get the parent element
                parentElement.style.backgroundImage = 'url(' + e.target.result + ')';
            }

            reader.readAsDataURL(file);
        }
    }
</script>
<script>
    function closeImageBox() {
        document.getElementById("changeImageContainer").style.display = "none";
    }
</script>