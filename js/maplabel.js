/**
 * @license
 *
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * @fileoverview Map Label.
 *
 * @author Luke Mahe (lukem@google.com),
 *         Chris Broadfoot (cbro@google.com)
 */

/**
 * Creates a new Map Label
 * @constructor
 * @extends google.maps.OverlayView
 * @param {Object.<string, *>=} opt_options Optional properties to set.
 */

var hauteur_finale;
var largueur_label=80;

function MapLabel(opt_options) {
    hauteur_finale=0;
    this.set('code',null);
    this.set('back_color', '#ffffff');
  this.set('pastille_array',null);
    this.set('fontFamily', 'sans-serif');
  this.set('fontSize', 12);
  this.set('fontColor', '#000000');
  this.set('strokeWeight', 0);
  this.set('strokeColor', '#ffffff');
  this.set('align', 'center');

  this.set('zIndex', 1e3);

  this.setValues(opt_options);
}
MapLabel.prototype = new google.maps.OverlayView;

window['MapLabel'] = MapLabel;


/** @inheritDoc */
MapLabel.prototype.changed = function(prop) {
  switch (prop) {
      case 'pastille_array':
      case 'back_color':
    case 'fontFamily':
    case 'fontSize':
    case 'fontColor':
    case 'strokeWeight':
    case 'strokeColor':
    case 'align':
    case 'text':
      return this.drawCanvas_();
    case 'maxZoom':
    case 'minZoom':
    case 'position':
      return this.draw();
  }
};

/**
 * Draws the label to the canvas 2d context.
 * @private
 */
MapLabel.prototype.drawCanvas_ = function() {
  var canvas = this.canvas_;
  if (!canvas) return;

  var style = canvas.style;
  style.zIndex = /** @type number */(this.get('zIndex'));

  var ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
    
  ctx.font = this.get('fontSize') + 'px ' + this.get('fontFamily');
    
    var text = this.get('text');
    var strokeWeight = Number(this.get('strokeWeight'));
    var padding_bottom=6;
    var padding_right=6;
    
    var largeur_finale=wrapText(ctx, text, 2, 6, largueur_label, 12);
    //alert(hauteur_finale);
    //var temp_textMeasure = ctx.measureText(text);
    var temp_textWidth = largeur_finale + strokeWeight;
    var temp_textHeight = hauteur_finale-4;
    
    var color_background=this.get('back_color');
    
    if (color_background==Global.statut_color_5){
        ctx.lineWidth=2;
        ctx.strokeStyle = "#ffffff";
    }else{
        ctx.lineWidth=2;
        ctx.strokeStyle = "#000000";
    }
    
    //ctx.strokeStyle = "rgb(255, 0, 0)";
    ctx.fillStyle = color_background;
    roundRect(ctx, 2, 4, temp_textWidth+padding_right+2, temp_textHeight+padding_bottom, 3, true);
    
   if (color_background==Global.statut_color_5){
        ctx.fillStyle = "#ffffff";
    }else{
        ctx.fillStyle = "#000000";
    } 
  ctx.strokeStyle = this.get('strokeColor');
  //ctx.fillStyle = this.get('fontColor');
  ctx.font = this.get('fontSize') + 'px ' + this.get('fontFamily');

    var pastille_array=this.get('pastille_array');
    var code=this.get('code');
    
  if (pastille_array!=null){
      if (pastille_array.length>0 && code!==""){
          for (var i=0;i<pastille_array.length;i++){
					var code_pastille=pastille_array[i].slice(pastille_array[i].length-8,pastille_array[i].length);
					if (code_pastille==code){
						
                        ctx.fillStyle = "#ff0000";
                        roundRect(ctx, temp_textWidth+padding_right-2, 0, 14,14, 7, true,false);
                        
                        base_image = new Image();
                          base_image.src = base_url+'images/logo_photo_10_10.png';
                          base_image.onload = function(){
                            ctx.drawImage(base_image, temp_textWidth+padding_right, 1);
                          }
					}
				}
      }
  }

  if (color_background==Global.statut_color_5){
        ctx.fillStyle = "#ffffff";
    }else{
        ctx.fillStyle = "#000000";
    } 
  if (text) {
    if (strokeWeight) {
      ctx.lineWidth = strokeWeight;
      ctx.strokeText(text, strokeWeight, strokeWeight);
    }

    largeur_finale=wrapText(ctx, text, 8, 6, largueur_label, 12);
      
    //ctx.fillText(text, 5, 4);

    var textMeasure = ctx.measureText(text);
    var textWidth = textMeasure.width + strokeWeight;
    style.marginLeft = -largeur_finale/2-8 + 'px';
    // Bring actual text top in line with desired latitude.
    // Cheaper than calculating height of text.
    style.marginTop = -69-hauteur_finale+'px';
      
  }
};

/**
 * @inheritDoc
 */
MapLabel.prototype.onAdd = function() {
  var canvas = this.canvas_ = document.createElement('canvas');
  var style = canvas.style;
  style.position = 'absolute';

  var ctx = canvas.getContext('2d');
  ctx.lineJoin = 'round';
  ctx.textBaseline = 'top';

  this.drawCanvas_();

  var panes = this.getPanes();
  if (panes) {
    panes.floatShadow.appendChild(canvas);
    //  panes.overlayLayer.appendChild(canvas);
      //  panes.floatPane.appendChild(canvas);
  }
};
MapLabel.prototype['onAdd'] = MapLabel.prototype.onAdd;

/**
 * Gets the appropriate margin-left for the canvas.
 * @private
 * @param {number} textWidth  the width of the text, in pixels.
 * @return {number} the margin-left, in pixels.
 */
MapLabel.prototype.getMarginLeft_ = function(textWidth) {
  switch (this.get('align')) {
    case 'left':
      return 0;
    case 'right':
      return -textWidth;
  }
  return textWidth / -2;
};

/**
 * @inheritDoc
 */
MapLabel.prototype.draw = function() {
  var projection = this.getProjection();

  if (!projection) {
    // The map projection is not ready yet so do nothing
    return;
  }

  if (!this.canvas_) {
    // onAdd has not been called yet.
    return;
  }

  var latLng = /** @type {google.maps.LatLng} */ (this.get('position'));
  if (!latLng) {
    return;
  }
  var pos = projection.fromLatLngToDivPixel(latLng);

  var style = this.canvas_.style;

  style['top'] = pos.y + 'px';
  style['left'] = pos.x + 'px';

  style['visibility'] = this.getVisible_();
};
MapLabel.prototype['draw'] = MapLabel.prototype.draw;

/**
 * Get the visibility of the label.
 * @private
 * @return {string} blank string if visible, 'hidden' if invisible.
 */
MapLabel.prototype.getVisible_ = function() {
  var minZoom = /** @type number */(this.get('minZoom'));
  var maxZoom = /** @type number */(this.get('maxZoom'));

  if (minZoom === undefined && maxZoom === undefined) {
    return '';
  }

  var map = this.getMap();
  if (!map) {
    return '';
  }

  var mapZoom = map.getZoom();
  if (mapZoom < minZoom || mapZoom > maxZoom) {
    return 'hidden';
  }
  return '';
};

/**
 * @inheritDoc
 */
MapLabel.prototype.onRemove = function() {
  var canvas = this.canvas_;
  if (canvas && canvas.parentNode) {
    canvas.parentNode.removeChild(canvas);
  }
};
MapLabel.prototype['onRemove'] = MapLabel.prototype.onRemove;

function roundRect(ctx, x, y, width, height, radius, fill, stroke) {
  if (typeof stroke == "undefined" ) {
    stroke = true;
  }
  if (typeof radius === "undefined") {
    radius = 5;
  }
  ctx.beginPath();
  ctx.moveTo(x + radius, y);
  ctx.lineTo(x + width - radius, y);
  ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
  ctx.lineTo(x + width, y + height - radius);
  ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
  ctx.lineTo(x + radius, y + height);
  ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
  ctx.lineTo(x, y + radius);
  ctx.quadraticCurveTo(x, y, x + radius, y);
  ctx.closePath();
  if (stroke) {
    ctx.stroke();
  }
  if (fill) {
    ctx.fill();
  }        
}



function wrapText(context, text, x, y, maxWidth, lineHeight) {
        var words = text.split(' ');
        var line = '';
        var largeur_finale=0;
    
        for(var n = 0; n < words.length; n++) {
          var testLine = line + words[n] + ' ';
          var metrics = context.measureText(testLine);
          var testWidth = metrics.width;
          if (testWidth > maxWidth && n > 0) {
            context.fillText(line, x, y);
            var largeur=context.measureText(line);
            if (largeur_finale<largeur.width){
                largeur_finale=largeur.width;
            }
            line = words[n] + ' ';
            y += lineHeight;
          }
          else {
            line = testLine;
          }
        }
        context.fillText(line, x, y);
        var largeur=context.measureText(line);
            if (largeur_finale<largeur.width){
                largeur_finale=largeur.width;
            }
        hauteur_finale=y + lineHeight;
        return largeur_finale;
      }