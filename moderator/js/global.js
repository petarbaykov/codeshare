$(document).ready(function(){
  
        $(".menu-link").click(function(){
      $("#menu").toggleClass("active");
      $(".main-container").toggleClass("active");
    });
    var editor = CodeMirror.fromTextArea(document.getElementById("code_html"), {
                    mode: "text/html",
                    lineNumbers: true,
                    lineWrapping: true,
                    theme: "monokai",
                    autofocus: true,
                    firstLineNumber:1
                });
              var editor = CodeMirror.fromTextArea(document.getElementById("code_css"), {
                    mode: "css",
                    lineNumbers: true,
                    lineWrapping: true,
                     theme: "monokai",
                     autofocus: true
                   
                });
                var editor = CodeMirror.fromTextArea(document.getElementById("code_js"), {
                    mode: "javascript",
                    lineNumbers: true,
                    lineWrapping: true,
                     theme: "monokai",
                     autofocus: true
                });
     function getHTML(){
        var html = editor.getValue();
        return html;
     } 
     function getCSS(){
        var css = editor.getValue();
        return css;
     }
     function getJS(){
        var js = editor.getValue();
        return js;
     }
     $('body').on("keyup", '.editor', function(){
        var target =$('#preview')[0].contentWindow.document;
        target.open();
        target.close();
        var html = getHTML();
        var css = getCSS();
        $('body',target).append(html);
        $('head',target).append("<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>");
        $('body',target).append('<style>' + css + "</style>");
     });
     $('body').on("change", '.editor', function(){
        var target =$('#preview')[0].contentWindow.document;
        target.open();
        target.close();
        var js = getJS();
        var css = getCSS();
        var html = getHTML();

        $('body',target).append(html);
        $('body',target).append('<style>' + css + "</style>");
           $('head',target).append("<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>");
        $('head',target).append('<script type="text/javascript">' + js + "</script>");
     });
       $('li a').on("click", '.run', function(){
        var target =$('#preview')[0].contentWindow.document;
        target.open();
        target.close();
         var html = getHTML();
        var css = getCSS();
        var js = getJS();
        $('body',target).append(html);
         $('head',target).append("<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>");
        $('body',target).append('<style>' + css + "</style>");
        $('head',target).append('<script type="text/javascript">' + js + "</script>");
     });

});