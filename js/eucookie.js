jQuery(document).ready(function(){
     
    var cookie = jQuery.cookie("hidden");
    var hidden = cookie ? cookie.split("|").getUnique() : [];
    var cookieExpires = 365; // cookie expires in 365 days
 
    // Remember the message was hidden
    jQuery.each( hidden, function(){
        var pid = this;
        jQuery('#' + pid).hide();
    })
 
    // Add Click functionality
    jQuery('#cookieClose').click(function(){
        jQuery('#cookie-msg').hide();
            updateCookie( jQuery('#cookie-msg') );
    });
  
    // Update the Cookie
    function updateCookie(el){
        var indx = el.attr('id');
        var tmp = hidden.getUnique();
        if (el.is(':hidden')) {
        // add item to hidden list
            tmp.push(indx);
        } else {
        // remove element id from the list
            tmp.splice( tmp.indexOf(indx) , 1);
        }
        hidden = tmp.getUnique();
        jQuery.cookie("hidden", hidden.join('|'), { expires: cookieExpires } );
    }
  
    if(hidden.indexOf('cookie-msg') == -1) {
        jQuery('#cookie-msg').slideDown();
    };
     
});
// Return a unique array.
Array.prototype.getUnique = function() {
 var o = new Object();
 var i, e;
 for (i = 0; e = this[i]; i++) {o[e] = 1};
 var a = new Array();
 for (e in o) {a.push (e)};
 return a;
}
 
// Fix indexOf in IE
if (!Array.prototype.indexOf) {
 Array.prototype.indexOf = function(obj, start) {
  for (var i = (start || 0), j = this.length; i < j; i++) {
   if (this[i] == obj) { return i; }
  }
  return -1;
 }
}
