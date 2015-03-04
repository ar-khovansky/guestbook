var jsx = {};


jsx.rNewLines = /\r\n|\r|\n/g;


//

String.prototype.HtmlEncode = function() {
  return this.replace(/&/g, '&amp;').replace(/\"/g, '&quot;')
             .replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

String.prototype.NewLinesToHtml = function() {
  return this.replace(/\r\n|\r|\n/g, '<br>');
}

String.prototype.Html = function() {
  return this.HtmlEncode().NewLinesToHtml();
}


////////////////////////////////////////////////////////////////////////////////////////////////////

Array.prototype.Contains = function( _v ) {
  for ( var i = 0; i < this.length; ++i )
    if ( this[i] == _v )
      return true;
  return false;
}

Array.prototype.Delete = function( _v ) {
  for ( var i = 0; i < this.length; ++i )
    if ( this[i] == _v ) {
      this.splice(i, 1);
      break;
    }
  return this;
}

Array.prototype.Find_V = function( _v ) {
  for ( var i = 0; i < this.length; i++ )
    if ( typeof(_v) == 'function' ? _v(this[i]) : (this[i] == _v) )
      return this[i];
  return null;
}

//

Array.prototype.Set_Add_R = function( _v ) {
  if ( this.Contains(_v) )
    return false;
  
  this.push(_v);
  return true;
}

Array.prototype.Set_Delete_R = function( _v ) {
  for ( var i = 0; i < this.length; ++i )
    if ( this[i] == _v ) {
      this.splice(i, 1);
      return true;
    }
  return false;
}

Array.prototype.Set_Subtract = function( _v ) {
  if ( _v instanceof Array ) {
    for ( var i = 0; i < _v.length; ++i )
      this.Delete(_v[i]);
  }
  else
    this.Delete(_v);
  
  return this;
}

Array.prototype.Set_Extract = function( _a ) {
  var a = [];
  
  for ( var i = 0; i < this.length; )
    if ( _a.Contains(this[i]) ) {
      a.push(this[i]);
      this.splice(i, 1);
    }
    else
      i++
  
  return a;
}

//

jsx.Object = {
  IsEmpty: function( _o ) {
    for ( var k in _o )
      return false;
    return true;
  },
  
  
  HasAnyKey: function( _o, _aKeys ) {
    for ( var i = 0; i < _aKeys.length; i++ )
      if ( _o[_aKeys[i]] !== undefined )
        return true;
    return false;
  },
  
  
  Clone: function( _o ) {
    var o = {};
    for ( var k in _o )
      o[k] = _o[k];
    return o;
  },
  
  
  Extract: function( _o, _aProps ) {
    var o = {};
    for ( var i = 0, sProp; sProp = _aProps[i]; i++ )
      if ( _o[sProp] !== undefined ) {
        o[sProp] = _o[sProp];
        delete _o[sProp];
      }
    
    return o;
  },
  
  
  Select: function( _o, _Props ) {
    var o = {};
    
    var aInclude = _Props instanceof Array ? _Props : null;
    var aExclude = _Props instanceof Array ? null : _Props.Exclude;
    
    for ( var k in _o )
      if ( aInclude && aInclude.Contains(k) ||
           aExclude && ! aExclude.Contains(k) )
        o[k] = _o[k];
    
    return o;
  },
  
  
  Flip_A: function( _o ) {
    var o = {}, v, a;
    for ( var k in _o ) {
      v = _o[k];
      if ( ! (a = o[v]) )
        a = o[v] = [];
      a.push(k);
    }
    return o;
  },
  
  
  All_M: function( _o, _fn ) {
    for ( var k in _o )
      if ( ! _fn.call(_o[k]) )
        return false;
    return true;
  }
}

//

jsx.Equal = function( _1, _2 ) {
  if ( _1 === _2)
    return true;
  else if ( _1 instanceof Array && _2 instanceof Array ) {
    if ( _1.length != _2.length )
      return false;
    for ( var i = 0; i < _1.length; ++i )
      if ( ! jsx.Equal(_1[i], _2[i]) )
        return false;
    return true;
  }
  else if ( _1 === null && _2 === null ) // typeof(null) == 'object'
    return true;
  else if ( typeof(_1) == 'object' && typeof(_2) == 'object' ) {
    var Keys = {};
    for ( var Key in _1 ) {
      if ( ! jsx.Equal(_1[Key], _2[Key]) )
        return false;
      Keys[Key] = true;
    }
    for ( var Key in _2 )
      if ( ! Keys[Key] && ! jsx.Equal(_1[Key], _2[Key]) )
        return false;
    return true;
  }
  else
    return false;
}

jsx.CompareNumbers = function( _1, _2 ) {
  return _1 - _2;
}

////////////////////////////////////////////////////////////////////////////////////////////////////


jsx.Extend = function( _Child, _Super ) {
  for ( var Property in _Super.prototype ) {
    if (typeof _Child.prototype[Property] == "undefined")
      _Child.prototype[Property] = _Super.prototype[Property];
  }
  return _Child;
}


//

jsx.Flags = function( _v ) {
  this.o = _v || {};
}
jsx.Flags.prototype = {
  IsSet_Any: function( _v ) {
    if ( _v instanceof Array ) {
      for ( var i = 0; i < _v.length; i++ )
        if ( this.o[_v[i]] )
          return true;
      return false;
    }
    else
      return Boolean(this.o[_v]);
  }
}


////////////////////////////////////////////////////////////////////////////////////////////////////
// Callable object - function or method

jsx.CCallback = function( _FnOrArr ) {
  this.a = typeof(_FnOrArr) == 'function' ? [null, _FnOrArr] : _FnOrArr;
}
jsx.CCallback.prototype = {
  Obj: function() {
    return this.a[0];
  },
  
  Call: function() {
    // IE (8) can't handle undefined or null for Args
    return this.a[1].apply(this.a[0], arguments.length ? arguments : (this.Args || []));
  }
}


jsx.Call = function( _CallObj ) {
  if ( typeof(_CallObj) == 'function' ) {
    var Obj = null;
    var fn = _CallObj;
  }
  else {
    var Obj = _CallObj[0];
    var fn = _CallObj[1];
  }
  
  fn.apply(Obj, Array.prototype.slice.call(arguments, 1));
}


jsx.Call_A = function( _CallObj, _aArgs ) {
  if ( typeof(_CallObj) == 'function' ) {
    var Obj = null;
    var fn = _CallObj;
  }
  else {
    var Obj = _CallObj[0];
    var fn = _CallObj[1];
  }
  
  fn.apply(Obj, _aArgs);
}


////////////////////////////////////////////////////////////////////////////////////////////////////
// Reference-counting repository of objects derived from CObject. When number of references to
// object becomes zero, object.Destruct() is called.
// The key is object class and ID.

jsx.CObjectRepository = function() {
  this.Data = {};
}

jsx.CObjectRepository.prototype = {
  Get: function( _sClass, _ID ) {
    var Class = this.Data[_sClass];
    if ( ! Class )
      Class = this.Data[_sClass] = {};
    
    if ( typeof(_ID) == 'object' && ! (_ID instanceof Number) && ! (_ID instanceof String) ) {
      for ( var ID in _ID )
        _ID[ID] = this._Get(Class, _sClass, ID, _ID[ID]);
      return _ID;
    }
    else
      return this._Get(Class, _sClass, _ID);
  },
  
  
  GetObjects: function( _Classes_Objs ) {
    for ( var sClass in _Classes_Objs )
      this.Get(sClass, _Classes_Objs[sClass]);
    return _Classes_Objs;
  },
  
  
  GetExisting: function( _sClass, _ID ) {
    var Class = this.Data[_sClass];
    if ( ! Class )
      return null;
    
    var ObjData = Class[_ID];
    if ( ! ObjData )
      return null;
    
    ObjData.RefCount++;
    return ObjData.Obj;
  },
  
  
  GetWeak: function( _sClass, _ID ) {
    var Class = this.Data[_sClass];
    if ( ! Class )
      return null;
    
    var ObjData = Class[_ID];
    if ( ! ObjData )
      return null;
    
    return ObjData.Obj;
  },
  
  
  Release: function() {
    if ( arguments.length == 1 ) {
      var _ID = arguments[0];
      
      if ( _ID instanceof Array )
        for ( var i = 0; i < _ID.length; i++ )
          this.Release(_ID[i]);
      else {
        var _Obj = arguments[0];
        
        if ( _Obj == null )
          return null;
        
        return this._Release(this.Data[_Obj.sClass], _Obj.ID);
      }
    }
    else {
      var Class = this.Data[arguments[0]];
      var _ID = arguments[1];
      var RefCount = arguments[2];
      
      if ( _ID instanceof Array )
        for ( var i = 0; i < _ID.length; i++ )
          this._Release(Class, _ID[i]);
      else if ( typeof(_ID) == 'object' && ! (_ID instanceof Number) && ! (_ID instanceof String) )
        for ( var ID in _ID )
          this._Release(Class, ID, _ID[ID]);
      else
        return this._Release(Class, _ID, RefCount);
    }
    
    return null; // dummy for multi-obj cases
  },
  
  
  ReleaseObjects: function( _Classes_Objs ) {
    for ( var sClass in _Classes_Objs )
      this.Release(sClass, _Classes_Objs[sClass]);
  },
  
  
  _Get: function( _Class, _sClass, _ID, _RefCount ) {
    if ( _RefCount === undefined )
      _RefCount = 1;
    
    var ObjData = _Class[_ID];
    if ( ObjData ) {
      ObjData.RefCount += _RefCount;
      return ObjData.Obj;
    }
    else {
      var Obj = eval('new C'+_sClass);
      Obj.ID = _ID;
      
      if ( Obj.Init )
        Obj.Init();
      
      _Class[_ID] = {'Obj': Obj, RefCount: _RefCount}
      return Obj;
    }
  },
  
  
  _Release: function( _Class, _ID, _RefCount ) {
    if ( _RefCount === undefined )
      _RefCount = 1;
    
    var ObjData = _Class[_ID];
        if(DBG) jsx.Console.Assert(ObjData, '_ID = ',_ID);
    
    ObjData.RefCount -= _RefCount;
    if ( ObjData.RefCount < 0 )
      jsx.Console.Error('ObjData.RefCount < 0', ObjData);
    
    if ( ObjData.RefCount <= 0 ) {
      ObjData.Obj.Destruct();
      delete _Class[_ID];
      return 0;
    }
    else
      return ObjData.RefCount;
  },
  
  
  _PrintDebugInfo: function() {
    for ( var sClass in this.Data ) {
      var Class = this.Data[sClass];
      
      var i = 0;
      var aIDs = [];
      for ( var ID in Class ) {
        i++;
        aIDs.push(ID+':'+Class[ID].RefCount);
      }
      
      jsx.Console.Log(sClass+': '+i+': '+aIDs.join(', '));
    }
  }
}

jsx.ObjectRepository = new jsx.CObjectRepository;


////////////////////////////////////////////////////////////////////////////////////////////////////
// Reference-counted object

jsx.CObject = function() {
  //this.bConnectedAsEmitter;
  //this.bConnectedAsReceiver;
}
jsx.CObject.prototype = {
  Destruct: function() {
  },
  
  
  AddRef: function() {
    jsx.ObjectRepository.Get(this.sClass, this.ID);
  },
  
  ReleaseRef: function() {
    jsx.ObjectRepository.Release(this.sClass, this.ID);
  }
}

//

jsx.Destruct = function( _Obj ) {
  if ( _Obj && _Obj.Destruct )
    _Obj.Destruct();
}


////////////////////////////////////////////////////////////////////////////////////////////////////
// Presentation model class.
// A model has several views which it notifies about its changes.

jsx.CModel = function() {
  this.aViews = [];
}

jsx.CModel.prototype = {
  AddView: function( _View ) {
jsx.Console.GroupCollapsed('CModel['+this.sClass+':'+this.ID+'].AddView');
    
    this.aViews.push( _View );
    _View.Attach(this);
    
jsx.Console.GroupEnd();
  },
  
  DetachView: function( _View ) {
    this.aViews.Delete(_View);
  },
  
  InvalidateViews: function( _Hints ) {
jsx.Console.Group('CModel['+this.sClass+':'+this.ID+'].InvalidateViews');
if ( _Hints )
  jsx.Console.Dir(_Hints);
    
    for ( var i = 0, View; View = this.aViews[i]; ++i )
      View.Invalidate(_Hints);
    
jsx.Console.GroupEnd();
  },
  
  
  UpdateViews: function() {
jsx.Console.Group('CModel['+this.sClass+':'+this.ID+'].UpdateViews');
    
    for ( var i = 0, View; View = this.aViews[i]; ++i )
      View.Update();
    
jsx.Console.GroupEnd();
  },
  
  
  UpdateData: function( _Data ) {
jsx.Console.Group('CModel['+this.sClass+':'+this.ID+'].UpdateData');
    
    var Changed = {};
    
    for ( var Key in _Data ) {
      if ( ! jsx.Equal(_Data[Key], this.Data[Key]) ) {
        this.Data[Key] = _Data[Key];
        Changed[Key] = true;
      }
    }
    
    if ( ! jsx.Object.IsEmpty(Changed) )
      this.InvalidateViews({Data: Changed});
    
jsx.Console.GroupEnd();
  },
  
  
  ViewsUseField: function( _sField ) {
    for ( var i = 0, View; View = this.aViews[i]; i++ )
      if ( View.aUsedFields && View.aUsedFields.Contains(_sField) )
        return true;
    return false;
  }
}
jsx.Extend(jsx.CModel, jsx.CObject);


////////////////////////////////////////////////////////////////////////////////////////////////////
// View class.
// View is attached to its model. Views are organized into hierarchical structure. View updates
// itself and, possibly, its children when model notifies about changes.

jsx.CView = function() {
  this.Model = null;
  
  this.bDirty = true;
  this.UpdateHints = {};
  this.bUpdateHintsTracking = false;
  
  this.Parent = null;
  
  this.aChildren = [];
  this.bDescendantsDirty = false;
}

jsx.CView.prototype = {
  Attach: function( _Model ) {
  jsx.Console.Group('CView['+_Model.sClass+':'+_Model.ID+' #'+this.DID+'].Attach');
  this.DebugPrint();
    
    this.Model = _Model;
    this.Invalidate();
    this.bUpdateHintsTracking = false;
    
    if ( this.OnModelAttach )
      this.OnModelAttach();
    
  jsx.Console.GroupEnd();
  },
  
  
  Detach: function() {
  jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].Detach');
  this.DebugPrint();
    
    if ( this.Model ) {
      this.Model.DetachView(this);
      this.Model = null;
    }
    
  jsx.Console.GroupEnd();
  },
  
  
  // _Hint can be string or array
  Invalidate: function( _Hints ) {
  jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].Invalidate');
  this.DebugPrint();
    
    if ( ! _Hints )
      _Hints = {all: true};
    
    jQuery.extend(true, this.UpdateHints, _Hints);
    
    if ( this.Parent )
      if ( ! (this.bDirty || this.bDescendantsDirty) )
        this.Parent.SetDescendantsDirty();
    
    this.bDirty = true;
    
  jsx.Console.GroupEnd();
  },
  
  
  AddChild: function( _Child ) {
        jsx.Console.GroupCollapsed('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].AddChild');
        this.DebugPrint();
    
    _Child.Parent = this;
    this.aChildren.push(_Child);
    
    if ( _Child.bDirty || _Child.bDescendantsDirty )
      this.SetDescendantsDirty();
    
        jsx.Console.GroupEnd();
  },
  
  
  SetDescendantsDirty: function() {
  jsx.Console.GroupCollapsed('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].SetDescendantsDirty');
  this.DebugPrint();
    
    if ( this.Parent )
      if ( ! (this.bDirty || this.bDescendantsDirty) )
        this.Parent.SetDescendantsDirty();
    
    this.bDescendantsDirty = true;
    
  jsx.Console.GroupEnd();
  },
  
  
  Update: function() {
  jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].Update');
  this.DebugPrint();
    
    if ( this.bDirty ) {
      if ( ! this.Update_(this.UpdateHints) ) {
        jsx.Console.Log('return false');
        jsx.Console.GroupEnd();
        return false;
      }
      
      this.bDirty = false;
      this.UpdateHints = {};
    }
    
    var b = this.bDescendantsDirty && this.aChildren.length ? this._UpdateChildren() : true;
    
  jsx.Console.Log('return '+b);
  jsx.Console.GroupEnd();
    return b;
  },
  
  
  UpdateChildren: function() {
  jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].UpdateChildren');
  this.DebugPrint();
    
    var b = this.bDescendantsDirty && this.aChildren.length ? this._UpdateChildren() : true;
      
  jsx.Console.Log('return '+b);
  jsx.Console.GroupEnd();
    return b;
  },
  
  
  _UpdateChildren: function() {
  jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+']._UpdateChildren');
  this.DebugPrint();
    
    var b = true;
    
    for ( var i = 0, View; View = this.aChildren[i]; i++ )
      if ( ! View.Update() )
        b = false;
    
    if ( b )
      this.bDescendantsDirty = false;
      
  jsx.Console.Log('return '+b);
  jsx.Console.GroupEnd();
    return b;
  },
  
  
  DeleteChildren: function( _a ) {
        jsx.Console.GroupCollapsed('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].DeleteChildren');
        this.DebugPrint();
    
    if ( _a )
      for ( var i = 0; i < _a.length; i++ )
        this.DeleteChild(_a[i]);
    else {
      for ( var i = 0, View; View = this.aChildren[i]; i++ )
        View.Destruct();
      
      this.ClearChildren();
    }
    
        jsx.Console.GroupEnd();
  },
  
  
  DeleteChild: function( _View ) {
        jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].DeleteChild');
        this.DebugPrint();
    
    if ( this.aChildren.Set_Delete_R(_View) ) {
      _View.Destruct();
      
      if ( ! this.aChildren.length )
        this.bDescendantsDirty = false;
    }
    
        jsx.Console.GroupEnd();
  },
  
  
  ClearChildren: function() {
        jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].ClearChildren');
        this.DebugPrint();
    
    this.aChildren = [];
    this.bDescendantsDirty = false;
    
        jsx.Console.GroupEnd();
  },
  
  
  SetChildren: function( _a ) {
    this.aChildren.Set_Subtract(_a);
    this.DeleteChildren();
    
    this.aChildren = _a;
    for ( var i = 0, View; View = _a[i]; i++ ) {
      View.Parent = this;
      
      if ( View.bDirty || View.bDescendantsDirty )
        this.SetDescendantsDirty();
    }
  },
  
  
  Destruct: function() {
        jsx.Console.Group('CView['+this.Model.sClass+':'+this.Model.ID+' #'+this.DID+'].Destruct');
        this.DebugPrint();
    
    jsx.CObject.prototype.Destruct.call(this);
    
    this.DeleteChildren();
    this.Detach();
    
    //if ( this.Destruct_ )
    //  this.Destruct_();
    
        jsx.Console.GroupEnd();
  },
  
  
  DebugPrint: function() {
    jsx.Console.Log(this, ' | bDirty: '+this.bDirty+', bDescendantsDirty: '+this.bDescendantsDirty+
                ', Children: '+this.aChildren.length);
  }
}
jsx.Extend(jsx.CView, jsx.CObject);


////////////////////////////////////////////////////////////////////////////////////////////////////
// View manager.
// Uses event mechanism to postpone UI update until after current function (usually server
// response callback).

jsx.ViewManager = {
  aTopViews: [],
  bUpdateQueued: false,
  
  
  RegisterTopView: function( _View ) {
    jsx.Console.GroupCollapsed('ViewManager.RegisterTopView(',_View,') | '+
              'aTopViews: '+this.aTopViews.length+', bUpdateQueued = '+this.bUpdateQueued);
    
    if ( this.aTopViews.Set_Add_R(_View) ) {
      _View.Parent = this;
      
      if ( _View.bDirty || _View.bDescendantsDirty )
        this.Invalidate();
    }
    
    jsx.Console.GroupEnd();
  },
  
  
  UnregisterTopView: function( _View ) {
    jsx.Console.GroupCollapsed('ViewManager.UnregisterTopView(',_View,') | '+
              'aTopViews: '+this.aTopViews.length+', bUpdateQueued = '+this.bUpdateQueued);
    
    _View.Parent = null;
    this.aTopViews.Delete(_View);
    
    jsx.Console.GroupEnd();
  },
  
  
  SetDescendantsDirty: function() {
    this.Invalidate();
  },
  
  
  Invalidate: function() {
    var t = jsx.ViewManager;
jsx.Console.Group('ViewManager.Invalidate | '+
              'aTopViews: '+t.aTopViews.length+', bUpdateQueued = '+t.bUpdateQueued);
    
    if ( ! t.bUpdateQueued ) {
      jsx.EventDispatcher.Post(t._Update);
      t.bUpdateQueued = true;
    }
jsx.Console.GroupEnd();
  },
  
  
  _Update: function() {
    var t = jsx.ViewManager;
jsx.Console.Group('ViewManager._Update | '+
              'aTopViews: '+t.aTopViews.length+', bUpdateQueued = '+t.bUpdateQueued);
    
    for ( var i = 0, View; View = t.aTopViews[i]; i++ )
      View.Update();
      
    t.bUpdateQueued = false;
jsx.Console.GroupEnd();
  }
}


////////////////////////////////////////////////////////////////////////////////////////////////////
// Event queue dispatcher

jsx.EventDispatcher = {
  aQueue: [],
  LoopTimeout: 0,
  bLoopStarted: false,
  
  
  StartLoop: function( /*_Timeout*/ ) {
    if ( this.bLoopStarted )
      return;
    this.bLoopStarted = true;
    
    //if ( _Timeout !== undefined )
    //  this.LoopTimeout = _Timeout;
    
    setTimeout(this.LoopCallback, this.LoopTimeout);
  },
  
  
  LoopCallback: function() {
    var t = jsx.EventDispatcher;
jsx.Console.Group('EventDispatcher.LoopCallback | queue: '+t.aQueue.length+', bLoopStarted = '+t.bLoopStarted);
    
    if ( t.aQueue.length )
      t.aQueue.shift().Call();
    
    if ( t.aQueue.length )
      setTimeout(t.LoopCallback, t.LoopTimeout);
    else
      t.bLoopStarted = false;
jsx.Console.GroupEnd();
  },
  
  
  Post: function( _Callback ) {
jsx.Console.Group('EventDispatcher.Post | queue: '+this.aQueue.length+', bLoopStarted = '+this.bLoopStarted);
    if ( typeof(_Callback) == 'function' || _Callback instanceof Array )
      _Callback = new jsx.CCallback(_Callback);
    
    this.aQueue.push(_Callback);
    this.StartLoop();
jsx.Console.GroupEnd();
  },
  
  
  MakeCallback: function( _Callback ) {
    return function() {
jsx.Console.Group('MakeCallback callback');
      if ( typeof(_Callback) == 'function' || _Callback instanceof Array )
        _Callback = new jsx.CCallback(_Callback);
      
      _Callback.Args = arguments;
      
      jsx.EventDispatcher.Post(_Callback);
jsx.Console.GroupEnd();
    }
  }
}


////////////////////////////////////////////////////////////////////////////////////////////////////
// Debug console.

jsx.Console = {
  Mode: 'DisableAll',
  Tags: new jsx.Flags,
  
  
  Init: function( _Mode, _Tags ) {
    this.Mode = _Mode;
    this.Tags = new jsx.Flags(_Tags);
  },
  
  
  Log: function() {
    if ( this._Enabled('log', '') )
      console.log.apply(null, arguments);
  },
  Log_T: function( _Tags ) {
    if ( this._Enabled('log', _Tags) )
      console.log.apply(null, Array.prototype.slice.call(arguments, 1));
  },
  
  Warn: function() {
    if ( this._Enabled('warn', '') )
      console.warn.apply(null, arguments);
  },
  
  Error: function() {
    if ( this._Enabled('error', '') )
      console.error.apply(null, arguments);
  },
  
  Assert: function() {
    if ( this._Enabled('assert', '') )
      console.assert.apply(null, arguments);
  },
  Assert_T: function( _Tags ) {
    if ( this._Enabled('assert', _Tags) )
      console.assert.apply(null, Array.prototype.slice.call(arguments, 1));
  },
  
  Group: function() {
    if ( this._Enabled('group', '') )
      console.group.apply(null, arguments);
  },
  Group_T: function( _Tags ) {
    if ( this._Enabled('group', _Tags) )
      console.group.apply(null, Array.prototype.slice.call(arguments, 1));
  },
  
  GroupCollapsed: function() {
    if ( this._Enabled('groupCollapsed', '') )
      console.groupCollapsed.apply(null, arguments);
  },
  
  GroupEnd: function() {
    if ( this._Enabled('groupEnd', '') )
      console.groupEnd.apply(null, arguments);
  },
  GroupEnd_T: function( _Tags ) {
    if ( this._Enabled('groupEnd', _Tags) )
      console.groupEnd.apply(null, Array.prototype.slice.call(arguments, 1));
  },
  
  Dir: function() {
    if ( this._Enabled('dir', '') )
      console.dir.apply(null, arguments);
  },
  Dir_T: function( _Tags ) {
    if ( this._Enabled('dir', _Tags) )
      console.dir.apply(null, Array.prototype.slice.call(arguments, 1));
  },
  
  Trace: function() {
    if ( this._Enabled('trace', '') )
      console.trace.apply(null, arguments);
  },
  
  Table: function() {
    if ( this._Enabled('table', '') )
      console.table.apply(null, arguments);
  },
  
  
  _Enabled: function( _sMethod, _Tags ) {
    if ( ! (window.console && jQuery.browser.mozilla) )
      return false;
    
    if ( ['warn', 'error', 'assert'].Contains(_sMethod) )
      return true;
    
    switch ( this.Mode ) {
      case 'EnableAll':
        return true;
      case 'EnableTags':
        return this.Tags.IsSet_Any(_Tags);
      case 'DisableAll':
        return false;
    }
    
    return false;
  }
}

//
