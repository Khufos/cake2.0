/*
 * jQuery transparent corner plugin
 *
 * version 0.1 (10/10/2007)
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * Most corner styles taken from Dave Methvin and Mike Alsup's jQuery.corner version 1.7 (1/26/2007).
 *        http://methvin.com/jquery/jq-corner.html
 */

/**
 * The transparentCorners() method provides a simple way of styling DOM elements.  
 *
 * transparentCorners() takes a map of options argument: jQuery( selector ).transparentCorners( { option: arg, option2: arg2, etc } )
 *
 *   cornerSize: The size of the corners, in pixels. Defaults to 10.
 *
 *   corners:     The style of corners all corners not otherwise specified. Defaults to "round". 
 *   top:         The style of the two top corners, unless specified individually as well. Defaults to the value set by corners.
 *   topLeft:     The style of the top left corner. Defaults to the value specified by top.
 *   topRight:    The style of the top right corner. Defaults to the value specified by top.
 *   bottom:      The style of the two bottom corners, unless specified individually as well. efaults to the value set by corners.
 *   bottomLeft:  The style of the bottom left corner. Defaults to the value specified by bottom.
 *   bottomRight: The style of the bottom right corner. Defaults to the value specified by bottom.
 *
 *   resetCorners: If true, any existing corners will be completely re-created. If false, only the colors of the corners will be updated.
 *
 * Valid corner styles:
 *   round, cool, sharp, bite, slide, jut, curl, tear, wicked, long, sculpt, dog, dog2, dog3, fray, notch, bevel
 *
 * @example $('.adorn').transparentCorners();
 * @desc Create round, 10px corners 
 *
 * @example $('.adorn').transparentCorners( { cornerSize: 25 } );
 * @desc Create round, 25px corners 
 *
 * @example $('.adorn').transparentCorners( { top: "none", bottom: "notch" } );
 * @desc Create notched, 10px corners on bottom only
 *
 * @example $('.adorn').transparentCorners( { corners: "none", topRight: "dog", cornerSize: 25 });
 * @desc Create dogeared, 25px corner on the top-right corner only
 *
 * @name transparentCorners
 * @type jQuery
 * @param Options options Options which control the corner style
 * @cat Plugins/transparentCorners
 * @return jQuery
 * @author Joseph Andrusyszyn (joseph.andrusyszyn@gmail.com)
 */
(function() {
var getCornerStripWidth = function( i, fx, cornerSize ) {
  var retval = 0;
  switch(fx.toLowerCase()) {
    case 'round':     retval = Math.round(cornerSize*(1-Math.cos(Math.asin(i/cornerSize)))); break;
    case 'cool':      retval = Math.round(cornerSize*(1+Math.cos(Math.asin(i/cornerSize)))); break;
    case 'sharp':     retval = cornerSize - i; break;
    case 'bite':      retval = Math.round(cornerSize*(Math.cos(Math.asin((cornerSize-i-1)/cornerSize)))); break;
    case 'slide':     retval = Math.round(cornerSize*(Math.atan2(i,cornerSize/i))); break;
    case 'jut':       retval = Math.round(cornerSize*(Math.atan2(cornerSize,(cornerSize-i-1)))); break;
    case 'curl':      retval = Math.round(cornerSize*(Math.atan(i))); break;
    case 'tear':      retval = Math.round(cornerSize*(Math.cos(i))); break;
    case 'tear2':     retval = Math.round(cornerSize*(Math.sin(i))); break;
    case 'wicked':    retval = Math.round(cornerSize*(Math.tan(i))); break;
    case 'long':      retval = Math.round(cornerSize*(Math.sqrt(i))); break;
    case 'sculpt':    retval = Math.round(cornerSize*(Math.log((cornerSize-i-1),cornerSize))); break;
    case 'dog':       retval = (i&1) ? (i+1) : cornerSize; break;
    case 'dog2':      retval = (i&2) ? (i+1) : cornerSize; break;
    case 'dog3':      retval = (i&3) ? (i+1) : cornerSize; break;
    case 'fray':      retval = (i%2)*cornerSize; break;
    case 'notch':     retval = cornerSize; break;
    case 'bevel':     retval = i+1; break;
    case 'roman':     retval = cornerSize - i * i; break;
    case 'longcurl':  retval = Math.round( cornerSize * Math.log(i) ); break;
    case 'plates':    retval = ( i - cornerSize / 2 ) * ( i - cornerSize / 2 ); break;
    case 'scrapbook': retval = (i&1) ? 0 : i; break;
  }
  return Math.max( retval, 0 );
};

jQuery.fn.transparentCorners = function( settings ) {

  settings = jQuery.extend( { corners: "round", cornerSize: 10, resetCorners: false }, settings );

  var cornerSize = settings.cornerSize;
  var resetCorners = settings.resetCorners;

  var topLeftFX = settings.topLeft || settings.top || settings.corners || "none";
  var topRightFX = settings.topRight || settings.top || settings.corners || "none";
  var hasTop = topLeftFX != "none" || topRightFX != "none";

  var bottomLeftFX = settings.bottomLeft || settings.bottom || settings.corners || "none";
  var bottomRightFX = settings.bottomRight || settings.bottom || settings.corners || "none";
  var hasBottom = bottomLeftFX != "none" || bottomRightFX != "none";

  return this.each( function( index ) {
    var addCorners = false;
    if( jQuery(this).parent(".transparentCornersContainer").size() == 0 ) {
      jQuery(this).wrap( "<div class=\"transparentCornersContainer\"></div>" );
      var getCss = new Array( "width", "float", "margin" );
      for( var css in getCss ) {
        jQuery(this).parent().css( getCss[css], jQuery(this).css(getCss[css]) );
      }
      jQuery(this).css("float", "none");
      jQuery(this).css("width", "auto");
      jQuery(this).css("margin", "0");
      addCorners = true;
    } else {
      if( resetCorners ) {
        jQuery(this).parent(".transparentCornersContainer").children(".transparentCornersStrip").remove();
        addCorners = true;
      }
    }
    if( addCorners ) {
      for( var i = 0; i < cornerSize; i++ ) {
        if( hasTop ) {
          jQuery(this).parent().prepend( "<div class=\"transparentCornersStrip\" style=\""
                             + " margin-left: " + getCornerStripWidth( i, topLeftFX, cornerSize ) + "px;"
                             + " margin-right: " + getCornerStripWidth( i, topRightFX, cornerSize ) + "px;"
                             + " height: 1px; overflow: hidden;\"></div>");
        }
        if( hasBottom ) {
          jQuery(this).parent().append( "<div class=\"transparentCornersStrip\" style=\""
                             + " margin-left: " + getCornerStripWidth( i, bottomLeftFX, cornerSize ) + "px;"
                             + " margin-right: " + getCornerStripWidth( i, bottomRightFX, cornerSize ) + "px;"
                             + " height: 1px; overflow: hidden;\"></div>");
        }
      }
    }
    jQuery(this).parent(".transparentCornersContainer").children(".transparentCornersStrip").css( "background-color", jQuery(this).css("background-color") );
   });
};
})();
