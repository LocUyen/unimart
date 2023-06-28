$(document).ready(function() {
    $(".tag_choose").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
    $(".parent_choose").select2({
        placeholder: "Chọn danh mục",
        allowClear: true
    })
});