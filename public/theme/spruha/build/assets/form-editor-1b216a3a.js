$(function () {
    var l = Quill.import("ui/icons");
    l.bold = '<i class="la la-bold" aria-hidden="true"></i>', l.italic = '<i class="la la-italic" aria-hidden="true"></i>', l.underline = '<i class="la la-underline" aria-hidden="true"></i>', l.strike = '<i class="la la-strikethrough" aria-hidden="true"></i>', l.list.ordered = '<i class="la la-list-ol" aria-hidden="true"></i>', l.list.bullet = '<i class="la la-list-ul" aria-hidden="true"></i>', l.link = '<i class="la la-link" aria-hidden="true"></i>', l.image = '<i class="la la-image" aria-hidden="true"></i>', l.video = '<i class="la la-film" aria-hidden="true"></i>', l["code-block"] = '<i class="la la-code" aria-hidden="true"></i>';
    var i = [[{header: [1, 2, 3, 4, 5, 6, !1]}], ["bold", "italic", "underline", "strike"], [{list: "ordered"}, {list: "bullet"}], ["link", "image", "video"]];
    new Quill("#quillEditor", {
        modules: {toolbar: i},
        theme: "snow"
    }), new Quill("#quillEditorModal2", {modules: {toolbar: i}, theme: "snow"});
    var e = [["bold", "italic", "underline"], [{header: 1}, {header: 2}, "blockquote"], ["link", "image", "code-block"]];
    new Quill("#quillInline", {
        modules: {toolbar: e},
        bounds: "#quillInline",
        scrollingContainer: "#scrolling-container",
        placeholder: "Write something...",
        theme: "bubble"
    }), new PerfectScrollbar("#scrolling-container", {suppressScrollX: !0}), $("#summernote").summernote({
        placeholder: "Hello bootstrap 4",
        tabsize: 3,
        height: 300
    })
});
