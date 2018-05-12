$(document).ready(function(){
     
     $('#html .CodeMirror').attr('id','name');
        $(".menu-link").click(function(){
      $("#menu").toggleClass("active");
      $(".main-container").toggleClass("active");
    });
    var editor_html = CodeMirror.fromTextArea(document.getElementById("code_html"), {
                    mode: "text/html",
                    lineNumbers: true,
                    lineWrapping: true,
                    theme: "monokai"
                });
    var editor_css = CodeMirror.fromTextArea(document.getElementById("code_css"), {
                    mode: "css",
                    lineNumbers: true,
                    lineWrapping: true,
                     theme: "monokai"
                     
                   
                });
    var editor_js = CodeMirror.fromTextArea(document.getElementById("code_js"), {
                    mode: "javascript",
                    lineNumbers: true,
                    lineWrapping: true,
                    theme: "monokai"
                });
     function getHTML(){
        var html = editor_html.getValue();
        return html;
     } 
     function getCSS(){
        var css = editor_css.getValue();
        return css;
     }
     function getJS(){
        var js = editor_js.getValue();
        return js;
     }
     $('body').on("keyup", '.edit textarea', function(){
        var target = $('#preview')[0].contentWindow.document;
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
      
       $('body').on("load", '.editor', function(){
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
       $('nav').on("click", '.run', function(){
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

        $('.tab-panels .tabs li').on('click', function(){
        var $panel = $(this).closest('.tab-panels');
        $panel.find('.tabs li.active-tab').removeClass('active-tab');
        $(this).addClass('active-tab');
         var panelToShow = $(this).attr('rel');
         $panel.find('.panel.active-panel').show(300, showNextPanel);
         function showNextPanel(){
          $(this).removeClass('active-panel');
          $('#' + panelToShow).hide(300, function(){
              $(this).addClass('active-panel');
          });
         }
       });

      
       
      
});