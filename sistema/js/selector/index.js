$(function() {
	var $wrapper = $('#wrapper');

	// theme switcher
	var hash_url =  window.location.protocol+'//'+window.location.hostname+'/sistema/'; 
	var theme_match = String(window.location).match(/[?&]theme=([a-z0-9]+)/);
	var theme = (theme_match && theme_match[1]) || 'default';
	var themes = ['default','legacy','bootstrap2','bootstrap3'];
	$('head').append('<link rel="stylesheet" href="'+hash_url+'js/selector/css/selectize.' + theme + '.css">');

	var $themes = $('<div>').addClass('theme-selector').insertAfter('h1');
	for (var i = 0; i < themes.length; i++) {
		$themes.append('<a href="?theme=' + themes[i] + '"' + (themes[i] === theme ? ' class="active"' : '') + '>' + themes[i] + '</a>');
	}

      var selectize = $('#titulo').selectize({ //https://github.com/selectize/selectize.js/issues/942
        create: true,
         //plugins: ['remove_button'],
        plugins: ['restore_on_backspace'], 
         //<a href="javascript:void(0)" class="remove" tabindex="-1" title="retirar"><font><font class="">×</font></font></a>
		//plugins: { 'remove_button': {append: true} },
        sortField: {
          field: 'text',
          direction: 'asc'
        },
        //dropdownParent: 'body',
        render: {
            item: function(data, escape) {
//                return '<div class="item">' + escape(data.text) + ' <div class="remove">X</div></div>';
				return '<div data-value=' + escape(data.text) + ' class="item"><font><font class="">' + escape(data.text) + ' </font></font><a href="javascript:void(0)" class="remover" tabindex="-1" title="retirar"><font><font class=""></font></font></a></div>';

            },
			option_create: function(data, escape) {
					return '<div class="create">Añadir <strong>' + escape(data.input) + '</strong>&hellip;</div>';
			}            
        },
		/*
		onDelete: function(values) {
				return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
			}  */      
      });




	//$('a.remover').on('click', function(e)
	$('body').on('click','a.removerwww', function (event) {  
		//selectize.clear();
		//event.stopPropagation();
		

		//$("div.selectize-input.items.has-options.not-full input").siblings().addClass('osmel');
		/*
		event.stopPropagation();
		
		var e = $.Event("keydown");

		e.keyCode = KEY_BACKSPACE; //$.ui.keyCode.BACKSPACE;
		$("div.selectize-input.items.has-options.not-full input").trigger(e); //keydown
		*/
		//alert('aa');

		//$('input[name="nombre"]').trigger(e); //keydown

		 
		
	});

$("div.selectize-input.items.has-options.not-full input").keydown(function(e) {
	if (e.keyCode==8) {
		//alert('borrando');	
	}
    
});

/*
document.addEventListener("keydown", KeyCheck);  //or however you are calling your method
function KeyCheck(event)
{
   var KeyID = event.keyCode;
   switch(KeyID)
   {
      case 8:
      alert("backspace");
      console.log(event);
      break; 
      case 46:
      alert("delete");
      break;
      default:
     // alert("otro");
      return event.keyCode = 8;
      break;
   }
}
*/

	// display scripts on the page
	/*
	$('script', $wrapper).each(function() {
		var code = this.text;
		if (code && code.length) {
			var lines = code.split('\n');
			var indent = null;

			for (var i = 0; i < lines.length; i++) {
				if (/^[	 ]*$/.test(lines[i])) continue;
				if (!indent) {
					var lineindent = lines[i].match(/^([ 	]+)/);
					if (!lineindent) break;
					indent = lineindent[1];
				}
				lines[i] = lines[i].replace(new RegExp('^' + indent), '');
			}

			var code = $.trim(lines.join('\n')).replace(/	/g, '    ');
			var $pre = $('<pre>').addClass('js').text(code);
			$pre.insertAfter(this);
		}
	});
	*/

	// show current input values
	$('select.selectized,input.selectized', $wrapper).each(function() {
		var $container = $('<div>').addClass('value').html('Current Value: ');
		var $value = $('<span>').appendTo($container);
		var $input = $(this);
		var update = function(e) { $value.text(JSON.stringify($input.val())); }

		$(this).on('change', update);
		update();

		$container.insertAfter($input);
	});
});

/*
    padding: 2px 6px;
    margin: 0 3px 3px 0;
    color: #ffffff;
    cursor: pointer;
    background: #1da7ee;
    border: 1px solid #0073bb;
    border-radius: 4px;
}
*/