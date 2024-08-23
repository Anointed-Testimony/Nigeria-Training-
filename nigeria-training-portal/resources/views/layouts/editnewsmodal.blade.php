<div style="z-index: 10" id="news_info-modal">
    <form action="" method="POST" id="editNewsForm" enctype="multipart/form-data">
        @csrf
        <div id="withdraw_modal_content" class="news_inner_modal_content">
            <div class="withdraw-head">
                <p class="withdraw-head-text">Update News</p>
                <i onclick="closenewsEditModal()" id="with_modalClose" class="fa-solid fa-xmark"></i>
            </div>
            <hr class="withdraw-first-divider">
            <div class="withdraw-input">
                <label for="">Title of News</label>
                <input id="editNewsTitle" name="title" type="text" placeholder="Enter News Title,">
            </div>
            <div class="withdraw-input">
                <label for="">Content of News(min 200 characters)</label>
                <textarea id="blog-editor-edit" style="height: 300px" name="news_content" type="text" placeholder="Enter News Content"></textarea>
            </div>
            <div class="group_upload_logo">
                <label for="">Upload Featured Image</label>
                <input name="featured_image" type="file">
            </div>
            <button type="submit" class="withdraw_request_button">Update</button>
        </div>
    </form>
</div>

