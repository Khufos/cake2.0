function criarSummernote() {
    $(".summernote").summernote({
        lang: "pt-BR",
        height: 300,
        toolbar: [
            ["style", ["bold", "italic", "underline", "clear"]],
            ["fontsize", ["fontsize"]],
            ['fontname', ['fontname']],
            ['fontsizeunit', ['fontsizeunit']],
            ['forecolor', ['forecolor']],
            ['backcolor', ['backcolor']],
            ['strikethrough', ['strikethrough']],
            ['superscript', ['superscript']],
            ['subscript', ['subscript']],
            ['clear', ['clear']],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
            ["table", ["table"]],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'help']],
            ['undo', ['undo', 'redo']]
        ],
        callbacks: {
            onPaste: function (e) {
                // if (!confirm("Deseja colar este conteúdo COM a formatação? Podem existir diferenças com a formatação original!")) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData("Text");
                    e.preventDefault();
                    setTimeout(function () {
                        document.execCommand("insertText", false, bufferText);
                    }, 10);
                // }
            },
        },
    });
}
