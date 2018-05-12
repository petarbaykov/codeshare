$(document).ready(function(){

	var tab = $('.code > div');
       tab.hide().filter(':first').show();
       $('#tabs a:first ').addClass("active");
       $('#tabs a ').click(function(){
       		tab.hide();
       		tab.filter(this.hash).show();
       		$('#tabs a ').removeClass('active');
       		$(this).addClass('active');
       		return false;
       });

       $('#save_code').click(function(){
		var code_html = editor_html.getValue();
		var code_css = editor_css.getValue();
		var code_js = editor_js.getValue();
		var user_id = $('#user_id').val();
		var code_id = $('#code_id').val();
		$.ajax({
			type:'post',
			url:'includes/save_code.php',
			data: "html="+code_html+"&css="+code_css+"&js="+code_js+"&user_id="+user_id,
			
			success:function(){
				window.open('view_code.php?code=' + code_id,'_self')
			}
		});
	});
	var hover = false;

	$('.dropdown-parent').click(function(){
		hover = ! hover;
		if(hover){
			$(".dropdown").show();
		}else{
			$(".dropdown").hide();
		}
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
        var js = getJS();
       $('body',target).append(html);
        $('body',target).append('<style>' + css + "</style>");
        $('head',target).append("<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>");
        
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
        $('body',target).append('<script type="text/javascript">' + js + "</script>");
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
        $('body',target).append('<script type="text/javascript">' + js + "</script>");
     });
        $('.heading-preview').on("click", '.run', function(){
        var target =$('#preview')[0].contentWindow.document;
        target.open();
        target.close();
         var html = getHTML();
        var css = getCSS();
        var js = getJS();
        $('body',target).append(html);
         $('head',target).append("<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>");
        $('body',target).append('<style>' + css + "</style>");
        
        $('body',target).append('<script type="text/javascript">' + js + "</script>");
     });
       
       	
});