// jQuery Alert Dialogs Plugin
//
// Version 1.1
//
// Cory S.N. LaViska
// A Beautiful Site (http://abeautifulsite.net/)
// 14 May 2009
//
// Website: http://abeautifulsite.net/blog/2008/12/jquery-alert-dialogs/
//
// Usage:
//		jAlert( message, [title, callback] )
//		jCritical( message, [title, callback] )
//		jConfirm( message, [title, callback] )
//		jQuestion( message, [title, callback] )
//		jPrompt( message, [value, title, callback] )
// 
// History:
//
//		1.00 - Released (29 December 2008)
//
//		1.01 - Fixed bug where unbinding would destroy all resize events
//
// License:
// 
// This plugin is dual-licensed under the GNU General Public License and the MIT License and
// is copyright 2008 A Beautiful Site, LLC. 
//
(function($) {
	
	$.alerts = {
		// These properties can be read/written by accessing $.alerts.propertyName from your scripts at any time
		
		verticalOffset: -75,                // vertical offset of the dialog from center screen, in pixels
		horizontalOffset: 0,                // horizontal offset of the dialog from center screen, in pixels/
		repositionOnResize: true,           // re-centers the dialog on window resize
		overlayOpacity: 0.9,                // transparency level of overlay
		overlayColor: '#333',               // base color of overlay
		draggable: true,                    // make the dialogs draggable (requires UI Draggables plugin)
		okButton: '&nbsp;Ok&nbsp;',         // text for the OK button
		cancelButton: '&nbsp;Cancelar&nbsp;', // text for the Cancel button
    yesButton: '&nbsp;Sim&nbsp;', // text for the Yes button
    noButton: '&nbsp;Não&nbsp;', // text for the No button
		dialogClass: null,                  // if specified, this class will be applied to all dialogs
		
		// Public methods
		
		alert: function(message, title, callback) {
			if( title === null ){
			 title = 'Atenção';
      }
      var tmp = '<p style="text-align:justify">';
      tmp    += '<span class="ui-icon icon-alert" style="float:left; margin:0 7px 50px 0;"></span>';
      tmp    += message;
      tmp    += '</p>';
      message = tmp;   
			//
      $.alerts._show(title, message, null, 'alert', function(result) {
				if( callback ){
				  callback(result);
        }
			});
		},
		critical: function(message, title, callback) {//IPAGE
			if( title === null ){
			 title = 'Atenção';
      }
      var tmp = '<p style="text-align:justify">';
      tmp    += '<span class="ui-icon icon-circle-close" style="float:left; margin:0 7px 50px 0;"></span>';
      tmp    += message;
      tmp    += '</p>';
      message = tmp;  
            
			$.alerts._show(title, message, null, 'critical', function(result) {
				if( callback ){
				  callback(result);
        }
			});
		},		
		confirm: function(message, title, callback) {
			if( title === null ){
			 title = 'Confirmar';
      }
      var tmp = '<p style="text-align:justify">';
      tmp    += '<span class="ui-icon icon-help" style="float:left; margin:0 7px 50px 0;"></span>';
      tmp    += message;
      tmp    += '</p>';
      message = tmp;        
			$.alerts._show(title, message, null, 'confirm', function(result) {
				if( callback ){
				  callback(result);
        }
			});
		},
		question: function(message, title, callback) {
			if( title === null ){
			   title = '?';
      }
      var tmp = '<p style="text-align:justify">';
      tmp    += '<span class="ui-icon icon-help" style="float:left; margin:0 7px 50px 0;"></span>';
      tmp    += message;
      tmp    += '</p>';
      message = tmp;        
			$.alerts._show(title, message, null, 'question', function(result) {
				if( callback ){
				  callback(result);
        }
			});
		},
			
		prompt: function(message, value, title, callback) {
			if( title === null ){
			   title = 'Entrada Dados';
      }
      var tmp = '<p>';
      tmp    += '<span class="ui-icon icon-info" style="float:left; margin:0 7px 50px 0;"></span>';
      tmp    += message;
      tmp    += '</p>';
      message = tmp;        
			$.alerts._show(title, message, value, 'prompt', function(result) {
				if( callback ){
				  callback(result);
        }
			});      
		},
		
		// Private methods
		
		_show: function(title, msg, value, type, callback) {
		  var w = 0;      
      try
      {
        w = $("#ipage_popup_container").outerWidth();
      }
      catch(e)
      {
        w = $("#ipage_popup_container").width();
      }
      //
			$.alerts._hide();
			$.alerts._overlay('show');

			$("body").append(
			  '<div id="ipage_popup_container">' +
			    '<h3 id="ipage_popup_title"></h3>' +
			    '<div id="ipage_popup_content">' +
			      '<div id="ipage_popup_message"></div>' +
				'</div>' +
			  '</div>');
			

			if( $.alerts.dialogClass ){
			   $("#ipage_popup_container").addClass($.alerts.dialogClass);
      }
			
			// IE6 Fix
			var pos = ($.browser.msie && parseInt($.browser.version,10) <= 6 ) ? 'absolute' : 'fixed'; 
			
			$("#ipage_popup_container").css({
				position: pos,
				zIndex: 99999,
				padding: 0,
				margin: 0
			});
			
			$("#ipage_popup_title").text(title);
      $("#ipage_popup_content").addClass(type);
            
			$("#ipage_popup_message").text(msg);
			$("#ipage_popup_message").html($("#ipage_popup_message").text().replace(/\n/g, '<br />') );
			
			$("#ipage_popup_container").css({
				minWidth: w,
				maxWidth: w
			});
			
			$.alerts._reposition();
			$.alerts._maintainPosition(true);
			
			switch( type ) {
				case 'alert':
          $("#ipage_popup_message").after('<div id="ipage_popup_panel" style="width:95%;"><button class="btn btn-success pull-center" id="ipage_popup_ok"><i class="fa fa-check"></i>' + $.alerts.okButton+'</button></div>');
					$("#ipage_popup_ok").click( function() {
						$.alerts._hide();
						callback(true);
					});
					$("#ipage_popup_ok").focus().keypress( function(e) {
						if( e.keyCode === 13 || e.keyCode === 27 ) {
						  $("#ipage_popup_ok").trigger('click');
            }
					});
				break;
				case 'critical':// IPAGE
					$("#ipage_popup_message").after('<div id="ipage_popup_panel" style="width:95%;"><button class="btn btn-success pull-center" id="ipage_popup_ok"><i class="fa fa-check"></i>'+$.alerts.okButton+'</button></div>');

          $("#ipage_popup_ok").click( function() {
						$.alerts._hide();
						callback(true);
					});
					$("#ipage_popup_ok").focus().keypress( function(e) {
						if( e.keyCode === 13 || e.keyCode === 27 ) {
						  $("#ipage_popup_ok").trigger('click');
            }
					});
				break;
				case 'confirm':
					tmp = '<div id="ipage_popup_panel" style="width:95%;">';
          tmp += '<button class="btn btn-success pull-center" id="ipage_popup_ok">';
          tmp += '<i class="fa fa-check"></i>' + $.alerts.yesButton + '</button>&nbsp;';
          tmp += '<button class="btn btn-danger pull-center" id="ipage_popup_cancel">';
          tmp += '<i class="fa fa-times"></i>' + $.alerts.noButton + '</button></div>';
          //
          $("#ipage_popup_message").after(tmp);          
					$("#ipage_popup_ok").click( function() {
						$.alerts._hide();
						if( callback ) {
						  callback(true);
            }
					});
					$("#ipage_popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) {
						  callback(false);
            }
					});
					$("#ipage_popup_ok").focus();
					$("#ipage_popup_ok, #ipage_popup_cancel").keypress( function(e) {
						if( e.keyCode === 13 ) {
						  $("#ipage_popup_ok").trigger('click');
            }
						if( e.keyCode === 27 ){
						    $("#ipage_popup_cancel").trigger('click');
            }
					});
				break;
				case 'question':
					tmp = '<div id="ipage_popup_panel" style="width:95%;">';
          tmp += '<button class="btn btn-success pull-center" id="ipage_popup_ok"><i class="fa fa-check"></i>' + $.alerts.yesButton + '</button>&nbsp;';
          tmp += '<button class="btn btn-danger pull-center" id="ipage_popup_cancel"><i class="fa fa-times"></i>' + $.alerts.noButton + '</button>';
          tmp += '</div>';        
          
          $("#ipage_popup_message").after(tmp);
          				
					$("#ipage_popup_ok").click( function() {
						$.alerts._hide();
						if( callback ){
						  callback(true);
            }
					});
					$("#ipage_popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ){
						    callback(false);
            }
					});
					$("#ipage_popup_ok").focus();
					$("#ipage_popup_ok, #ipage_popup_cancel").keypress( function(e) {
						if( e.keyCode === 13 ) {
						    $("#ipage_popup_ok").trigger('click');
            }
						if( e.keyCode === 27 ){
						  $("#ipage_popup_cancel").trigger('click');
            }
					});
				break;

				case 'prompt':
					tmp = '<div id="ipage_popup_panel" style="width:95%;">';
          tmp += '<p><br/><br/></p>';
          tmp += '<button class="btn btn-success pull-center" id="ipage_popup_ok"><i class="fa fa-check"></i>' + $.alerts.okButton + '</button>&nbsp;';
          tmp += '<button class="btn btn-danger pull-center" id="ipage_popup_cancel"><i class="fa fa-times"></i>' + $.alerts.cancelButton + '</button>';
          
					$("#ipage_popup_message").append('<br /><input type="text" size="30" id="ipage_popup_prompt"/>').after(tmp);

					$("#ipage_popup_prompt").width( $("#ipage_popup_message").width());
          $("#ipage_popup_prompt").css({left: '17px'});
					$("#ipage_popup_ok").click( function() {
						var val = $("#ipage_popup_prompt").val();
						$.alerts._hide();
						if( callback ){
						  callback( val );
            }
					});
					$("#ipage_popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ){
						  callback( null );
            }
					});
					$("#ipage_popup_prompt, #ipage_popup_ok, #ipage_popup_cancel").keypress( function(e) {
						if( e.keyCode === 13 ){
						  $("#ipage_popup_ok").trigger('click');
            }
						if( e.keyCode === 27 ){
						  $("#ipage_popup_cancel").trigger('click');
            }
					});
					if( value ){
					 $("#ipage_popup_prompt").val(value);
          }
					$("#ipage_popup_prompt").focus().select();
				  break;
        default:
          break;
			}
			
			// Make draggable
			if( $.alerts.draggable ) {
				try {
					$("#ipage_popup_container").draggable({ handle: $("#ipage_popup_title") });
					$("#ipage_popup_title").css({ cursor: 'move' });
				} catch(e) { /* requires jQuery UI draggables */ }
			}
		},
		
		_hide: function() {
			$("#ipage_popup_container").remove();
			$.alerts._overlay('hide');
			$.alerts._maintainPosition(false);
		},
		
		_overlay: function(status) {
			switch( status ) {
				case 'show':
					$.alerts._overlay('hide');
					$("body").append('<div id="ipage_popup_overlay"></div>');
					$("#ipage_popup_overlay").css({
						position: 'absolute',
						zIndex: 99998,
						top: '0px',
						left: '0px',
						width: '100%',
						height: $(document).height(),
						background: $.alerts.overlayColor,
						opacity: $.alerts.overlayOpacity
					});
			 	 break;
				case 'hide':
					$("#ipage_popup_overlay").remove();
  				break;
        default:
          break;
			}
		},		
		_reposition: function() {
		  var w = 0;
      var h = 0;
      
      try
      {
        w = $("#ipage_popup_container").outerWidth();
      }
      catch(e)
      {
        w = $("#ipage_popup_container").width();
      }
      //
      try
      {
        h = $("#ipage_popup_container").outerHeight();
      }
      catch(e)
      {
        h = $("#ipage_popup_container").height();
      }
			var top = (($(window).height() / 2) - (h / 2)) + $.alerts.verticalOffset,
			    left = (($(window).width() / 2) - (w / 2)) + $.alerts.horizontalOffset;
			if( top < 0 ){
			 top = 0;
      } 
			if( left < 0 ){
			 left = 0;
      }
			
			// IE6 fix
			/*
      if( $.browser.msie && parseInt($.browser.version,10) <= 6 ){
  			 top = top + $(window).scrollTop();
      } 
			*/
			$("#ipage_popup_container").css({
				top: top + 'px',
				left: left + 'px'
			});
			$("#ipage_popup_overlay").height( $(document).height() );
		},
		
		_maintainPosition: function(status) {
			if( $.alerts.repositionOnResize ) {
				switch(status) {
					case true:
						$(window).bind('resize', $.alerts._reposition);
					   break;
					case false:
						$(window).unbind('resize', $.alerts._reposition);
					  break;
				  default:
            break;
        }
			}
		}	
	};	
	// Shortuct functions
	jAlert = function(message, title, callback) {
    $.alerts.alert(message, title, callback);
	};
  // IPAGE
	jCritical = function(message, title, callback) {
    $.alerts.critical(message, title, callback);
	};
	
	jConfirm = function(message, title, callback) {
		$.alerts.confirm(message, title, callback);
	};
		
	jQuestion = function(message, title, callback) {
		$.alerts.question(message, title, callback);
	};

	jPrompt = function(message, value, title, callback) {
		$.alerts.prompt(message, value, title, callback);
	};
	
})(jQuery);