var J = jQuery;
J.fn.extend({ xsShow: function() { return this.css('display', ''); } });



var owner = window.HTMLElement? window : document;
var prevKeydown = owner.onkeydown;
owner.onkeydown = function(e) {
  if (!e) e = window.event;
  if (e.ctrlKey && (e.keyCode == 192 /*|| e.keyCode == 96*/)) {
    J('#ErrorConsole').show();
    return false;
  }
  if ( prevKeydown ) {
    __prev = prevKeydown;
    return __prev(e);
  }
}


function ErrorConsoleWrite( s ) {
  J('#ErrorConsoleText').append(s.NewLinesToHtml());
  J('#ErrorConsole').show();
}

//

function PreprocessAjaxRes( _Data, _bHandleErrors ) {
  if ( _Data.text.length )
    ErrorConsoleWrite(_Data.text);
  
  if ( _Data.js.Errors && _bHandleErrors )
    ErrorConsoleWrite(_Data.js.Errors.join('\n').Html());
  
  return _Data.js;
}


function OnAjaxSuccess_Global( _Data/*, _sStatus, _Xhr*/ ) {
  return PreprocessAjaxRes(_Data, true);
}


function OnAjaxError_Global( _Xhr, _sStatus, _Ex ) {
  ErrorConsoleWrite( AjaxErrorMsg(_Xhr, _sStatus, _Ex) );
}


function AjaxErrorMsg( _Xhr, _sStatus, _Ex ) {
  if ( _sStatus == 'timeout' )
    var s = 'Тайм-аут';
  else {
    var s = 'Статус: '+_sStatus+'<br>';
    
    if ( _Ex )
      s += 'Исключение: '+_Ex.name+': '+_Ex.message+'<br>';
    
    try {
      var Response = J.parseJSON(_Xhr.responseText);
      var sText = Response ? Response.text : '';
    }
    catch ( Ex ) {
      var a = _Xhr.responseText.match(/"text":"(.*?)"}$/);
      var sText = a[1];
    }
    
    s += 'XMLHttpRequest:<br>&nbsp;&nbsp;'+_Xhr.status+': '+_Xhr.statusText+'<br>'+
         '&nbsp;&nbsp;'+sText.replace(/\\r\\n|\\r|\\n/g, '<br>');
  }
  
  return s;
}

//

jsx.QueryManager = {
  AttachedRequests: {},


  AttachRequest: function( _sAction, _Request, _bAbortOnFail ) {
    this.AttachedRequests[_sAction] = {Request: _Request, AbortOnFail: _bAbortOnFail};
  },
  
  
  GetAttachedRequest: function( _sAction ) {
    return this.AttachedRequests[_sAction] || null;
  },
  
  
  Query: function( _sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout ) {
    var AttachedRequestData = this.GetAttachedRequest(_sAction);
    if ( AttachedRequestData ) {
      var Request = new jsx.CRequest(_sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout);
      if ( AttachedRequestData.AbortOnFail )
        Request.AbortOnFail = true;
      this.PacketQuery([Request, AttachedRequestData.Request]);
    }
    else
      this._Query(_sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout);
  },
  
  
  _MakeRequest: function( _sUrl, _sAction, _Data, _Timeout ) {
    var Request = { url: _sUrl+'?Action='+_sAction,
                    data: J.toJSON(_Data) };
    if ( _Timeout )
      Request.timeout = _Timeout;
    return Request;
  },
  
  
  _Query_: function( _sUrl, _sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout ) {
    var Request = this._MakeRequest(_sUrl, _sAction, _Data, _Timeout);
    
    var SuccessCB, ErrorCB, CompleteCB;
    
    if ( typeof(_Callbacks) == 'function' )
      SuccessCB = _Callbacks;
    else if ( _Callbacks instanceof Array ) {
      var Obj;
      if ( typeof(_Callbacks[0]) == 'object' || _Callbacks[0] === undefined ) //'object' - obj or null
        Obj = _Callbacks.shift();
      
      SuccessCB = _Callbacks[0];
      
      switch ( _Callbacks.length ) {
        case 3:
          ErrorCB = _Callbacks[1];
          CompleteCB = _Callbacks[2];
          break;
        case 2:
          CompleteCB = _Callbacks[1];
          break;
      }
    }
    
    if ( SuccessCB ) {
      if ( typeof(SuccessCB) == 'function' && Obj )
        SuccessCB = [Obj, SuccessCB];
      
      Request.success = jsx.EventDispatcher.MakeCallback(function( _Res, _sStatus, _Xhr ) {
        //if ( _Res.js.Errors == 'SessionExpired' ) {
        //  window.location = window.location.href.replace(/#.*$/, '');
        //  return;
        // }
        
        _Res = PreprocessAjaxRes(_Res, ! _bCaptureErrors);
        
        jsx.Call(SuccessCB, _Res);
      });
    }
    
    if ( ErrorCB ) {
      if ( typeof(ErrorCB) == 'function' && Obj )
        ErrorCB = [Obj, ErrorCB];
      
      Request.error = jsx.EventDispatcher.MakeCallback(function( _Xhr, _sStatus, _Ex ) {
        jsx.Call(ErrorCB, _Xhr, _sStatus, _Ex);
      });
    }
    
    if ( CompleteCB ) {
      if ( typeof(CompleteCB) == 'function' && Obj )
        CompleteCB = [Obj, CompleteCB];
      
      Request.complete = jsx.EventDispatcher.MakeCallback(function( _Xhr, _sStatus, _Ex ) {
        jsx.Call(CompleteCB, _Xhr, _sStatus);
      });
    }
    
    J.ajax(Request);
  },
  
  
  _Query: function( _sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout ) {
    this._Query_(C_sBackEnd, _sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout);
  },
  
  
  Query_Obj: function( _RequestObj, _sMethod, _aArgs, _Callbacks, _bCaptureErrors, _Timeout ) {
    var RequestData = _RequestObj;
    RequestData.Method = _sMethod;
    RequestData.Args = _aArgs;
    
    this._Query('CallMethod', RequestData, _Callbacks, _bCaptureErrors, _Timeout);
  },
  
  
  PacketQuery: function( _aRequests, _CompleteCallback, _Timeout ) {
    var aCallbacks = new Array(_aRequests.length);
    var iTimeout = 0;
    
    for ( var i = 0, Request; Request = _aRequests[i]; ++i ) {
      var CBData = aCallbacks[i] = {};
      if ( Request.Callback ) {
        CBData.Callback = typeof(Request.Callback) == 'function' ?
                          [Request.Obj, Request.Callback] : Request.Callback;
        delete Request.Callback;
      }
      if ( Request.CaptureErrors ) {
        CBData.CaptureErrors = Request.CaptureErrors;
        delete Request.CaptureErrors;
      }
      
      if ( Request.Obj ) {
        J.extend(Request, Request.Obj.GetRequestObject());
        delete Request.Obj;
      }
      
      if ( ! _Timeout )
        iTimeout += Request.Timeout ? Number(Request.Timeout) : C_GeneralTimeout;
      if ( Request.Timeout )
        delete Request.Timeout;
    }
    
    var fnCB = function( _Res ) {
      for ( var i = 0; i < _Res.Data.length; ++i ) {
        var Data = _Res.Data[i];
        var CBData = aCallbacks[i];
        
        if ( ! CBData.CaptureErrors && Data.Errors )
          ErrorConsoleWrite(Data.Errors.join('\n').Html());
        
        if ( CBData.Callback )
          jsx.Call(CBData.Callback, Data);
      }
    };
    
    var CB = _CompleteCallback ? [fnCB, _CompleteCallback] : fnCB;
    
    this._Query('PacketQuery', _aRequests, CB, false, _Timeout);
  }
}



jsx.CRequest = function( _sAction, _Data, _Callbacks, _bCaptureErrors, _Timeout ) {
  this.Action = _sAction;
  this.Data = _Data;
  this.Callbacks = _Callbacks;
  this.CaptureErrors = _bCaptureErrors;
  this.Timeout = _Timeout;
}

//

function RenderErrorMsg( _$Msg, _aErrors ) {
  _$Msg.html(_aErrors.join('\n').HtmlEncode().NewLinesToHtml());
}

function ShowErrorMsg( _IDP, _Error ) {
  var $Msg = J('#'+_IDP+'Msg');
  if ( _Error instanceof Array )
    RenderErrorMsg($Msg, _Error);
  else
    $Msg.text(_Error);
  
  J('#'+_IDP+'MsgBox').xsShow();
}

function HideErrorMsg( _IDP ) {
  J('#'+_IDP+'MsgBox').hide();
  J('#'+_IDP+'Msg').empty();
}

//

function CViewField( _Data, _sName, _IDP, _Encoder, _bComplex, _HideBoxIfEmpty, _fnRender ) {
  this.Data = _Data;
  this.sName = _sName;
  this.DID = _IDP+_sName;
  
  this.Encoder = J.extend({}, _Encoder);
  if ( this.Encoder.IsSet )
    this.Encoder.IsSet = new jsx.CCallback(this.Encoder.IsSet);
  if ( this.Encoder.Encode )
    this.Encoder.Encode = new jsx.CCallback(this.Encoder.Encode);
  
  this.bComplex = Boolean(_bComplex);
  this.HideBoxIfEmpty = _HideBoxIfEmpty;
  this.fnRender = _fnRender || _fnRender === false ? _fnRender : RenderField_Text;
}
CViewField.prototype = {
  Update: function() {
    var $Box = J('#'+this.DID+'Box');
    var v = this.bComplex ? this.Data : this.Data[this.sName];
    
    var Encoded;
    if ( (this.HideBoxIfEmpty == 'hide&render' || this.HideBoxIfEmpty == 'hide') &&
         ( (this.Encoder.IsSet) && ! this.Encoder.IsSet.Call(v) ||
           ! (this.Encoder.IsSet) && ! (Encoded = this.Encode(v)) ) )
    {
      $Box.hide();
      if ( this.HideBoxIfEmpty == 'hide&render' && this.fnRender )
        this.fnRender(J('#'+this.DID), Encoded !== undefined ? Encoded : this.Encode(v));
    }
    else {
      if ( this.fnRender )
        this.fnRender(J('#'+this.DID), Encoded !== undefined ? Encoded : this.Encode(v));
      if ( this.HideBoxIfEmpty )
        $Box.show();
    }
  },
  
  Encode: function( _v ) {
    return this.Encoder.Encode ? this.Encoder.Encode.Call(_v) : (_v != null ? String(_v) : '');
  }
}


function CViewField_Proxy( _Callback ) {
  this.Callback = new jsx.CCallback(_Callback);
}
CViewField_Proxy.prototype = {
  Update: function() { this.Callback.Call(); }
}


var g_FieldEncoder_Text = {
  IsSet: function( _s ) { return _s.length; }
}
var g_FieldEncoder_Bool_True = {
  IsSet: function( _b ) { return Boolean(_b); }
}
var g_FieldEncoder_Number_NonZero = {
  IsSet: function( _v ) { return Boolean(Number(_v)); }
}

var g_FieldEncoder_UnixTimestampToLocaleDate = {
  Encode: function( _v ) {
    if ( _v == null )
      return '';
    
    var DT = new Date(_v * 1000);
    return DT.toLocaleDateString();
  }
}

var g_FieldEncoder_UnixTimestampToLocaleDateTime = {
  Encode: function( _v ) {
    if ( _v == null )
      return '';
    
    var DT = new Date(_v * 1000);
    return DT.toLocaleString();
  }
}

var g_FieldEncoder_NewLinesToHtml = {
  Encode: function( _s ) { return _s.NewLinesToHtml(); }
}

var g_FieldEncoder_Html = {
  Encode: function( _s ) { return _s.Html(); }
}

var g_FieldEncoder_BBCodeToHtml = {
  Encode: function( _s ) {
    _s = _s.HtmlEncode();
    
    _s = _s.replace(/\[img\](.+?)\[\/img\]/ig, "<img src='files/$1' />");
    
    return _s.NewLinesToHtml();
  }
}

function RenderField_Text( _$El, _s ) { _$El.text(_s); }
function RenderField_Html( _$El, _s ) { _$El.html(_s); }
function RenderField_ImgSrc( _$El, _s ) { _$El.attr('src', _s); }
function RenderField_Href( _$El, _s ) {
  if ( _s != null )
    _$El.attr('href', _s);
  else
    _$El.removeAttr('href');
}

function RenderField_Link( _$a, _s ) {
  if ( _s != null )
    _$a.attr('href', _s).text(_s);
  else
    _$a.removeAttr('href').text('');
}

function RenderField_jQuery( _$El, _$ ) {
  _$El.empty();
  if ( _$ )
    _$El.append(_$);
}

//

function CFormField( _Form, _ID, _Validator, _bNotEmpty ) {
  this.Form = _Form;
  this.ID = _ID;
  this.Validator = _Validator;
  this.bNotEmpty = Boolean(_bNotEmpty);
  
  this.DID = this.Form.IDP()+this.ID;
  this.Init();
}
CFormField.prototype = {
  Init: function() {
    var t = this;
    J('#'+this.DID).change(function(){ t.OnChange(J(this).val()); });
  },
  
  SetVal: function( _v ) {
    J('#'+this.DID).val(_v || '');
    this.Form.FieldValid(this.ID, this._Valid(_v));
  },
  
  Val: function() {
    return J('#'+this.DID).val();
  },
  
  OnChange: function( _s ) {
    this.Form.FieldValid(this.ID, this._Valid(_s));
  },
  
  Valid: function() {
    return this._Valid(this.Val());
  },
  
  _Valid: function( _v ) {
    if ( (_v == null || _v === '') && this.bNotEmpty )
      return false;
    return ! this.Validator || this.Validator.Valid(_v);
  }
}

//

function InsertTextAtCursor( _Textarea, _s) {
  _Textarea.focus();
  if (document.selection && document.selection.createRange) {
    var r = document.selection.createRange();
    r.text = _s;
  }
  else if (_Textarea.setSelectionRange) {
    var start = _Textarea.selectionStart;
    var end   = _Textarea.selectionEnd;
    var sel1  = _Textarea.value.substr(0, start);
    var sel2  = _Textarea.value.substr(end);
    _Textarea.value   = sel1 + _s + sel2;
    _Textarea.setSelectionRange(start+_s.length, start+_s.length);
  }
  else
    _Textarea.value += _s;
  
  // For IE.
  //setTimeout(function() { _Textarea.focus() }, 100);
}
