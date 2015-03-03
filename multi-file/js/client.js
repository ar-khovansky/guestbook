var DBG = true;
var Console = jsx.Console;
Console.Init('EnableAll');

var O = jsx.ObjectRepository;

var g_GuestBook;



function GetFileUploadResponse( xhr ) {
  if ( xhr.responseText !== undefined )
    return xhr.responseText;
  else
    // Instead of an XHR object, an iframe is used for legacy browsers:
    return xhr.contents().text();
};

////////////////////////////////////////////////////////////////////////////////////////////////////

function Init() {
      Console.Group('Init');
  
  if ( sInitErrors ) {
    ErrorConsoleWrite(sInitErrors);
    return;
  }
  
  J.ajaxSetup({
    cache: false,
    timeout: C_GeneralTimeout,
    type: 'POST',
    success: OnAjaxSuccess_Global,
    error: OnAjaxError_Global
  });
  
  g_GuestBook = new CGuestBook;
  var View = new CGuestBookView('Main');
  jsx.ViewManager.RegisterTopView(View);
  g_GuestBook.AddView(View);
  g_GuestBook.Init();
  
      Console.GroupEnd();
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function CGuestBook() {
  jsx.CModel.call(this);
  
  this.bPending = false;
  this.Res = null;
  
  this.MsgMan = new CMsgManager;
}

CGuestBook.prototype = {
  sClass: 'GuestBook',
  
  Init: function() {
    this.MsgMan.UpdatePage(1);
  },
  
  
  Register: function( _sLogin, _sPassword ) {
    if ( this.bPending )
      return;
    
    this.Res = null;
    this.bPending = true;
    this.InvalidateViews({Registering: true});
    
    jsx.QueryManager.Query('Register', {Login: _sLogin, Password: _sPassword}, [this,
      function( _Res ) {
            Console.Group("CGuestBook 'Register' success callback");
        
        if ( _Res.Ok ) {
          g_sUserLogin = _sLogin;
          g_iUserGroup = _Res.UserGroup;
          
          this.MsgMan.OnUserChanged();
          
          this.Res = true;
        }
        else
          this.Res = _Res.Errors || false;
        
            Console.GroupEnd();
      },
      function() {
            Console.Group("CGuestBook 'Register' complete callback");
        
        this.bPending = false;
        this.InvalidateViews({Registering: false});
        
            Console.GroupEnd();
      }],
      true
    );
  },
  
  
  LogIn: function( _sLogin, _sPassword ) {
    if ( this.bPending )
      return;
    
    this.Res = null;
    this.bPending = true;
    this.InvalidateViews({LoggingIn: true});
    
    jsx.QueryManager.Query('LogIn', {Login: _sLogin, Password: _sPassword}, [this,
      function( _Res ) {
            Console.Group("CGuestBook 'LogIn' success callback");
        
        if ( _Res.Ok ) {
          g_sUserLogin = _sLogin;
          g_iUserGroup = _Res.UserGroup;
          
          this.MsgMan.OnUserChanged();
          
          this.Res = true;
        }
        else
          this.Res = _Res.Errors || false;
        
            Console.GroupEnd();
      },
      function() {
            Console.Group("CGuestBook 'LogIn' complete callback");
        
        this.bPending = false;
        this.InvalidateViews({LoggingIn: false});
        
            Console.GroupEnd();
      }],
      true
    );
  },
  
  
  LogOut: function() {
    if ( this.bPending )
      return;
    
    this.Res = null;
    this.bPending = true;
    this.InvalidateViews({LoggingOut: true});
    
    jsx.QueryManager.Query('LogOut', null, [this,
      function( _Res ) {
            Console.Group("CGuestBook 'LogOut' success callback");
        
        if ( _Res.Ok ) {
          g_sUserLogin = 'guest';
          g_iUserGroup = UserGroup_Guest;
          
          this.MsgMan.OnUserChanged();
          
          this.Res = true;
        }
        else
          this.Res = _Res.Errors || false;
        
            Console.GroupEnd();
      },
      function() {
            Console.Group("CGuestBook 'LogOut' complete callback");
        
        this.bPending = false;
        this.InvalidateViews({LoggingOut: false});
        
            Console.GroupEnd();
      }]
    );
  }
}
jsx.Extend(CGuestBook, jsx.CModel);



function CGuestBookView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.RegisterView = null;
  this.MsgManView = null;
}
CGuestBookView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CGuestBookView.Update_');
        Console.Dir(_Hints);
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_Main.replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      this.MsgManView = new CMsgManagerView('MsgManager');
      M.MsgMan.AddView(this.MsgManView);
      this.AddChild(this.MsgManView);
      
      this.AdaptToUserGroup();
    }
    else {
      if ( _Hints.Registering === false && M.Res === true ) {
        this.DeleteChild(this.RegisterView);
        this.RegisterView = null;
        
        J('#Register').empty();
        
        this.AdaptToUserGroup();
      }
      
      if ( _Hints.LoggingIn ) {
        HideErrorMsg('LogIn');
        J('#LogInWait').show();
      }
      else if ( _Hints.LoggingIn === false ) {
        J('#LogInWait').hide();
        
        if ( M.Res === true ) {
          J('#LogInBox').hide();
          this.AdaptToUserGroup();
        }
        else
          ShowErrorMsg('LogIn', M.Res ? M.Res : 'Ошибка');
      }
      
      if ( _Hints.LoggingOut ) {
        //HideErrorMsg('LogOut');
        //J('#LogOutWait').show();
      }
      else if ( _Hints.LoggingOut === false ) {
        //J('#LogOutWait').hide();
        
        if ( M.Res === true )
          this.AdaptToUserGroup();
        //else
        //  ShowErrorMsg('LogOut', M.Res ? M.Res : 'Ошибка');
      }
    }
    
        Console.GroupEnd();
    return true;
  },
  
  
  AdaptToUserGroup: function() {
    var t = this;
    var M = this.Model;
    
    if ( g_iUserGroup == UserGroup_Guest ) {
      J('#UserBlock_User').hide();
      J('#UserBlock_Guest').show();
      
      J('#ToggleLogInPaneTrigger').unbind('click').click(function(){ t.ToggleLogInPane(); });
      J('#LogInBtn').unbind('click').click(function(){ t.LogIn(); });
      
      J('#ToggleRegisterPaneTrigger').unbind('click').click(function(){ t.ToggleRegisterPane(); });
    }
    else {
      J('#UserBlock_Guest').hide();
      
      J('#UserBlock_User').show();
      J('#Login').text(g_sUserLogin);
      J('#LogOutTrigger').unbind('click').click(function(){ M.LogOut(); });
      
      if ( g_iUserGroup == UserGroup_Admin )
        J('#UserBlock_Admin').show();
      else
        J('#UserBlock_Admin').hide();
    }
  },
  
  
  ToggleLogInPane: function() {
    $LogInBox = J('#LogInBox');
    
    if ( ! $LogInBox.is(':visible') && this.RegisterView ) {
      this.DeleteChild(this.RegisterView);
      this.RegisterView = null;
      
      J('#Register').empty();
    }
      
    $LogInBox.toggle();
  },
  
  
  ToggleRegisterPane: function() {
    if ( this.RegisterView ) {
      this.DeleteChild(this.RegisterView);
      this.RegisterView = null;
      
      J('#Register').empty();
    }
    else {
      J('#LogInBox').hide();
      
      this.RegisterView = new CRegisterView('Register');
      this.Model.AddView(this.RegisterView);
      this.AddChild(this.RegisterView);
    }
  },
  
  
  LogIn: function() {
    this.Model.LogIn( J('#LogIn_Login').val(), J('#LogIn_Password').val() );
  }
}
jsx.Extend(CGuestBookView, jsx.CView);



function CRegisterView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.Fields = {};
}
CRegisterView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CRegisterView.Update_');
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_Register.replace(/%IDP%/gi, this.DID)
                                                .replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      this.Fields.Login =
        new CFormField(this, 'Login', null /*new CValidator(ValidationRules_Login)*/, true);
      this.Fields.Password =
        new CFormField(this, 'Password', null, true);
      this.Fields.Password2 =
        new CFormField(this, 'Password2', null, true);
      
      J('#'+this.DID+'RegisterBtn').attr('disabled', true)
        .unbind('click').click(function(){ t.Register(); });
    }
    
    if ( _Hints.Registering ) {
      HideErrorMsg(this.DID);
      J('#'+this.DID+'Wait').show();
    }
    else if ( _Hints.Registering === false ) {
      if ( M.Res !== true )
        ShowErrorMsg(this.DID, M.Res ? M.Res : 'Ошибка');
      
      J('#'+this.DID+'Wait').hide();
    }
      
        Console.GroupEnd();
    return true;
  },
  
  
  Register: function() {
    this.Model.Register( J('#'+this.DID+'Login').val(), J('#'+this.DID+'Password').val() );
  },
  
  
  // Form interface
  
  IDP: function() {
    return this.DID;
  },
  
  FieldValid: function( _sField, _bValid ) {
    $Btn = J('#'+this.DID+'RegisterBtn');
    if ( jsx.Object.All_M(this.Fields, CFormField.prototype.Valid) &&
         this.Fields.Password.Val() == this.Fields.Password2.Val() )
      $Btn.removeAttr('disabled');
    else
      $Btn.attr('disabled', true);
  }
}
jsx.Extend(CRegisterView, jsx.CView);



function CMsgManager() {
  jsx.CModel.call(this);
  
  this.aMsgs = [];
  
  this.TotalCount = 0;
  this.PageCount = 0;
  this.PageNum = 1;
  
  this.bPending = false;
  this.UpdateRes = null;
  this.OpRes = null;
  
  this.Msg = null;
  if ( g_iUserGroup == UserGroup_User || g_iUserGroup == UserGroup_Admin )
    this.Msg = new CMsg(this);
}

CMsgManager.prototype = {
  sClass: 'MsgManager',
  
  UpdatePage: function( _PageNum ) {
        Console.Group('CMsgManager.UpdatePage');
    
    this.PageNum = _PageNum;
    
    this.UpdateRes = null;
    this.bPending = true;
    this.InvalidateViews({Updating: true});
    
    jsx.QueryManager.Query('GetMsgs', {Page: {Num: _PageNum}},
      [this, this._GetMsgsCallback,
      function() {
            Console.Group("CMsgManager 'GetMsgs' complete callback");
        
        this.bPending = false;
        this.InvalidateViews({Updating: false});
        
            Console.GroupEnd();
      }],
      true
    );
    
        Console.GroupEnd();
  },
  
  
  NextPage: function() {
    if ( this.PageNum >= this.PageCount )
      return;
    
    this.UpdatePage(this.PageNum + 1);
  },
  
  PrevPage: function() {
    if ( this.PageNum == 1 )
      return;
    
    this.UpdatePage(this.PageNum - 1);
  },
  
  
  CreateMsg: function( _sText, _aMsgCallbacks ) {
        Console.Group('CMsgManager.CreateMsg');
    
    if ( this.bPending ) {
          Console.GroupEnd();
      return;
    }
    
    this.UpdateRes = null;
    this.bPending = true;
    this.InvalidateViews({Updating: true});
    
    jsx.QueryManager.PacketQuery(
      [ { Action: 'PostMsg', Data: {Text: _sText},
          AbortOnFail: true, CaptureErrors: true,
          Callback: [this, function( _Res ) {
                Console.Group("CMsgManager 'PostMsg'(packet) success callback");
            
            if ( _Res.Ok ) {
              jsx.Destruct(this.Msg);
              this.Msg = new CMsg(this);
              
              this.InvalidateViews({NewMsg: true});
            }
            else
              _aMsgCallbacks[0].call(this.Msg, _Res);
            
            //this.OpRes = _Res.Ok ? true : _Res.Errors || false;
            
                Console.GroupEnd();
          }]},
        { Action: 'GetMsgs', CaptureErrors: true,
          Data: {Page: {Containing: C_sPacketQueryContextValue}},
          Callback: [this, this._GetMsgsCallback]}
      ],
      [this, function() {
            Console.Group("CMsgManager 'Post/GetMsgs'(packet) complete callback");
        
        _aMsgCallbacks[1].call(this.Msg);
        
        this.bPending = false;
        this.InvalidateViews({Updating: false});
        
            Console.GroupEnd();
      }]
    );
    
        Console.GroupEnd();
  },
  
  
  ChangeMsg: function( _Msg, _sText, _aMsgCallbacks ) {
        Console.Group('CMsgManager.ChangeMsg');
    
    if ( this.bPending ) {
          Console.GroupEnd();
      return;
    }
    
    this.bPending = true;
    
    jsx.QueryManager.Query('ChangeMsg', {ID: _Msg.ID, Text: _sText}, [this,
      function( _Res ) {
            Console.Group("CMsgManager 'ChangeMsg' success callback");
        
        _aMsgCallbacks[0].call(_Msg, _Res);
        
            Console.GroupEnd();
      },
      function() {
            Console.Group("CMsgManager 'ChangeMsg' complete callback");
        
        _aMsgCallbacks[1].call(_Msg);
        
        this.bPending = false;
        
            Console.GroupEnd();
      }],
      true
    );
    
        Console.GroupEnd();
  },
  
  
  Delete: function( _Msg, _aMsgCallbacks ) {
        Console.Group('CMsgManager.Delete');
    
    if ( this.bPending ) {
          Console.GroupEnd();
      return;
    }
    
    this.UpdateRes = null;
    this.bPending = true;
    this.InvalidateViews({Deleting: true, Updating: true});
    
    jsx.QueryManager.PacketQuery(
      [ { Action: 'DeleteMsg', Data: {ID: _Msg.ID}, CaptureErrors: true,
          Callback: [this, function( _Res ) {
                Console.Group("CMsgManager 'DeleteMsg'(packet) success callback");
            
            this.OpRes = _Res === true ? true : _Res.Errors || false;
            
                Console.GroupEnd();
          }]},
        { Action: 'GetMsgs', Data: {Page: {Num: this.PageNum}}, CaptureErrors: true,
          Callback: [this, this._GetMsgsCallback] }
      ],
      [this, function() {
            Console.Group("CMsgManager 'Delete/GetMsgs'(packet) complete callback");
        
        _aMsgCallbacks[1].call(_Msg);
        
        this.bPending = false;
        this.InvalidateViews({Deleting: false, Updating: false});
        
            Console.GroupEnd();
      }]
    );
    
        Console.GroupEnd();
  },
  
  
  OnUserChanged: function() {
    this.UpdatePage(this.PageNum);
    
    if ( g_iUserGroup == UserGroup_User || g_iUserGroup == UserGroup_Admin ) {
      if ( ! this.Msg )
        this.Msg = new CMsg(this);
    }
    else {
      jsx.Destruct(this.Msg);
      this.Msg = null;
    }
    
    this.InvalidateViews({UserChanged: true})
  },
  
  
  _GetMsgsCallback: function( _Res ) {
        Console.Group("CMsgManager 'GetMsgs' success callback");
    
    if ( _Res.Ok ) {
      var aMsgs = new Array(_Res.Msgs.length);
      for ( var i = 0, Data; Data = _Res.Msgs[i]; i++ ) {
        var Msg = O.Get('Msg', Data.ID);
        Msg.Manager = this;
        Msg.UpdateData(Data);
        aMsgs[i] = Msg;
      }
      O.Release(this.aFilms);
      this.aMsgs = aMsgs;
      
      if ( _Res.Users )
        for ( var i = 0, Data; Data = _Res.Users[i]; i++ )
          O.GetWeak('User', Data.ID).UpdateData(Data);
      
      this.TotalCount = _Res.TotalCount;
      this.PageCount = Math.ceil(this.TotalCount / C_iNumMsgsOnPage);
      
      if ( _Res.PageNum )
        this.PageNum = _Res.PageNum;
      
      this.UpdateRes = true;
    }
    else
      this.UpdateRes = _Res.Errors || false;
    
        Console.GroupEnd();
  }
}
jsx.Extend(CMsgManager, jsx.CModel);



function CMsgManagerView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.MsgsView = null;
  this.MsgView = null;
}
CMsgManagerView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CMsgManagerView.Update_');
        Console.Dir(_Hints);
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      this.MsgsView = new CMsgsView('Msgs');
      M.AddView(this.MsgsView);
      this.AddChild(this.MsgsView);
      
      this.AdaptToUserGroup();
    }
    else {
      if ( _Hints.NewMsg ) {
        if ( this.MsgView ) {
          J('#MsgEdit').empty();
          this.DeleteChild(this.MsgView);
        }
        
        this.MsgView = new CMsgEditView('MsgEdit');
        M.Msg.AddView(this.MsgView);
        this.AddChild(this.MsgView);
      }
      
      if ( _Hints.UserChanged )
        this.AdaptToUserGroup();
      
      if ( _Hints.Deleting ) {
        HideErrorMsg('Msgs');
        //J('#'+this.DID+'Wait').show();
      }
      else if ( _Hints.Deleting === false ) {
        //J('#'+this.DID+'Wait').hide();
        
        if ( M.OpRes !== true )
          ShowErrorMsg('Msgs', M.OpRes ? M.OpRes : 'Ошибка');
      }
    }
    
        Console.GroupEnd();
    return true;
  },
  
  
  AdaptToUserGroup: function() {
    var M = this.Model;
    
    if ( g_iUserGroup == UserGroup_Guest ) {
      J('#PostBlock_User').hide();
      J('#PostBlock_Guest').show();
    }
    else {
      J('#PostBlock_Guest').hide();
      J('#PostBlock_User').show();
    }
    
    if ( M.Msg ) {
      if ( ! this.MsgView ) {
        this.MsgView = new CMsgEditView('MsgEdit');
        M.Msg.AddView(this.MsgView);
        this.AddChild(this.MsgView);
      }
    }
    else {
      if ( this.MsgView ) {
        J('#MsgEdit').empty();
        this.DeleteChild(this.MsgView);
        this.MsgView = null;
      }
    }
  }
}
jsx.Extend(CMsgManagerView, jsx.CView);



function CMsgsView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.aNavViews = [];
  this.aMsgViews = [];
}
CMsgsView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CMsgsView.Update_');
        Console.Dir(_Hints);
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      this.RenderMsgs(true);
    }
    else {
      if ( _Hints.Updating ) {
        HideErrorMsg(this.DID);
        //J('#'+this.DID+'Wait').show();
      }
      else if ( _Hints.Updating === false ) {
        //J('#'+this.DID+'Wait').hide();
        
        // M.UpdateRes == null when post part of post/get packet query fails
        if ( M.UpdateRes != null )
          this.RenderMsgs();
      }
    }
    
        Console.GroupEnd();
    return true;
  },
  
  
  RenderMsgs: function( _bInitial ) {
    var M = this.Model, D = M.Data;
    
    if ( M.PageCount > 1 ) {
      if ( ! this.aNavViews.length ) {
        var NavView = new CMsgsView_Navigation('MsgsNavTop');
        M.AddView(NavView);
        this.aNavViews.push(NavView);
        NavView = new CMsgsView_Navigation('MsgsNavBottom');
        M.AddView(NavView);
        this.aNavViews.push(NavView);
      }
    }
    else {
      this.aNavViews = [];
      
      J('#MsgsNavTop').empty();
      J('#MsgsNavBottom').empty();
    }
    
    if ( _bInitial || M.UpdateRes === true ) {
      var aOldMsgViews = this.aMsgViews.slice(0);
      this.aMsgViews = [];
      
      var $El = J('#MsgsList').empty();
      
      var $Tbl = J('<table>', {'class': 'Msgs'});
      var MsgView, a;
      
      for ( var i = 0, Msg; Msg = M.aMsgs[i]; i++ ) {
        var DID = 'Msg'+Msg.ID;
        
        $Tbl.append( J('<tr>', {id: DID, 'class': 'Msg '+(i % 2 ? 'Odd' : 'Even')}) );
        
        if ( (a = aOldMsgViews.Set_Extract(Msg.aViews)).length ) {
          MsgView = a[0];
          MsgView.Invalidate({all: true});
        }
        else {
          MsgView = new CMsgView(DID);
          Msg.AddView(MsgView);
        }
        this.aMsgViews.push(MsgView);
      }
      
      $El.append($Tbl);
      
      this.SetChildren(this.aNavViews.concat(this.aMsgViews));
    }
    else {
      J('#MsgsList').empty();
      ShowErrorMsg('Msgs', M.UpdateRes ? M.UpdateRes : 'Ошибка');
    }
  }
}
jsx.Extend(CMsgsView, jsx.CView);



function CMsgsView_Navigation( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
}

CMsgsView_Navigation.prototype = {
  Update_: function() {
        Console.Group('CMsgsView_Navigation.Update_');
    
    var M = this.Model;
    
    var $El = J('#'+this.DID).empty();
    
    if ( ! M.PageCount || M.PageCount == 1 ) {
          Console.GroupEnd();
      return true;
    }
    
    var sPrev = '&larr; предыдущая';
    var sNext = 'следующая &rarr;';
    
    $El.append('Страницы: ')
    $El.append(
      M.PageNum > 1 ?
        J('<a>', {'class': 'Clickable'}).html(sPrev).click(function(){ M.PrevPage(); }) :
        J('<span>', {'class': 'Disabled'}).html(sPrev),
      '&nbsp;' );
    for ( var i = 1; i <= M.PageCount; i++ ) {
      var bNum = i == 1 || i == M.PageCount || Math.abs(i-M.PageNum) <= 4 ||
                 i/10 == Math.round(i/10);
      var s = bNum ? i : '.';
      
      var $a = J('<a>', {'class': 'Clickable PageLink'}).text(s).click(this.Make_Page_OnClick(i));
      $a.addClass( bNum ? 'Number' : 'Dot' );
      if ( i == M.PageNum )
        $a.addClass('Current');
      if ( ! bNum )
        $a.attr('title', i);
      
      $El.append( $a );
    }
    $El.append(
      '&nbsp;',
      M.PageNum < M.PageCount ?
        J('<a>', {'class': 'Clickable'}).html(sNext).click(function(){ M.NextPage(); }) :
        J('<span>', {'class': 'Disabled'}).html(sNext) );
    
        Console.GroupEnd();
    return true;
  },
  
  
  Make_Page_OnClick: function( _PageNum ) {
    var M = this.Model;
    return function(){ M.UpdatePage(_PageNum); }
  }
}
jsx.Extend(CMsgsView_Navigation, jsx.CView);



function CMsg( _MsgManager ) {
  jsx.CModel.call(this);
  
  this.Data = {};
  this.User = null;
  
  this.Manager = _MsgManager;
  
  this.$FileUpload = null;
  this.aFiles = [];
  
  this.bPending = false;
  this.Res = null;
  this.sSendingText = null;
}

CMsg.prototype = {
  sClass: 'Msg',
  
  UpdateData: function( _Data ) {
    var Changed = {};
    
    for ( var Key in _Data ) {
      if ( ! jsx.Equal(_Data[Key], this.Data[Key]) ) {
        this.Data[Key] = _Data[Key];
        Changed[Key] = true;
        
        if ( Key == 'UserID' ) {
          O.Release(this.User);
          this.User = O.Get('User', _Data.UserID);
        }
      }
    }
    
    if ( ! jsx.Object.IsEmpty(Changed) )
      this.InvalidateViews({Data: Changed});
  },
  
  
  Destruct: function() {
    O.Release(this.User);
  },
  
  
  SetFileUpload: function( _$FileUpload ) {
    this.$FileUpload = _$FileUpload;
    
    var t = this;
    
    this.$FileUpload.fileUpload('option', {
      url: C_sBackEnd+'?Action=UploadFile',
      method: 'POST',
      //forceIframeUpload: true,
      
      initUpload: function(event, _aFiles, _Index, _Xhr, handler, _fnUpload) {
        t.aFiles.push(new CFile(_aFiles[_Index], _Xhr));
        t.InvalidateViews({FilesChanged: true});
        _fnUpload();
      },
      
      onLoad: function(event, files, index, _Xhr, handler) {
        var sResponse = GetFileUploadResponse(_Xhr);
        
        try {
          var Response = J.parseJSON(sResponse);
          var sText = Response ? Response.text : '';
          
          var File = t.aFiles.Find_V( function(_File){ return _File.Xhr == _Xhr; } );
          
          var Res = Response.js;
          if ( Res.Ok )
            File.SetUploadedFile(Res.File);
          else
            File.SetUploadErrors(Res.Errors);
        }
        catch ( Ex ) {
          var a = sResponse.match(/"text":"(.*?)"}$/);
          var sText = a[1];
        }
        
        if ( sText )
          ErrorConsoleWrite(sText);
      }
    });
  },
  
  
  Send: function( _sText ) {
        Console.Group('CMsg.Send');
    
    if ( this.bPending ) {
          Console.GroupEnd();
      return;
    }
    
    this.Res = null;
    this.bPending = true;
    
    if ( this.ID ) {
      this.sSendingText = _sText;
      
      this.InvalidateViews({Sending: true});
      
      this.Manager.ChangeMsg( this, _sText, [
        function( _Res ) {
              Console.Group("CMsg 'Change' success callback");
          
          if ( _Res === true ) {
            if ( this.sSendingText != this.Data.Text ) {
              this.Data.Text = this.sSendingText;
              this.InvalidateViews({Data: {Text: true}});
            }
            
            this.Res = true;
          }
          else
            this.Res = _Res.Errors || false;
          
              Console.GroupEnd();
        },
        function() {
              Console.Group("CMsg 'Change' complete callback");
          
          this.bPending = false;
          this.InvalidateViews({Sending: false});
          
              Console.GroupEnd();
        }]
      );
    }
    else {
      this.InvalidateViews({Sending: true});
      
      this.Manager.CreateMsg( _sText, [
        function( _Res ) {
              Console.Group("CMsg 'Create' success callback");
          
          this.Res = _Res.Ok ? true : _Res.Errors || false;
          
              Console.GroupEnd();
        },
        function() {
              Console.Group("CMsg 'Create' complete callback");
          
          this.bPending = false;
          this.InvalidateViews({Sending: false});
          
              Console.GroupEnd();
        }]
      );
    }
    
        Console.GroupEnd();
  },
  
  
  Delete: function() {
        Console.Group('CMsg.Delete');
    
    if ( this.bPending ) {
          Console.GroupEnd();
      return;
    }
    
    this.Res = null;
    this.bPending = true;
    
    this.InvalidateViews({Deleting: true});
    
    this.Manager.Delete( this, [
      function( _Res ) {
      },
      function() {
            Console.Group("CMsg 'Delete' complete callback");
        
        this.bPending = false;
        this.InvalidateViews({Deleting: false});
        
            Console.GroupEnd();
      }]
    );
    
        Console.GroupEnd();
  }
}
jsx.Extend(CMsg, jsx.CModel);



function CMsgView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.EditView = null;
}
CMsgView.prototype = {
  OnModelAttach: function() {
    var t = this;
    var D = this.Model.Data;
    
    this.Fields = {
      CreateTimestamp: new CViewField(D, 'CreateTimestamp', this.DID,
                                      g_FieldEncoder_UnixTimestampToLocaleDateTime),
      Text: new CViewField(D, 'Text', this.DID, g_FieldEncoder_BBCodeToHtml,
                           false, false, RenderField_Html)
    }
  },
  
  
  Update_: function( _Hints ) {
        Console.Group('CMsgView.Update_');
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html(
        C_sTemplate_Msg.replace(/%ID%/gi, M.ID).replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      this.DeleteChildren();
      
      var UserView = new CUserView_Msg(this.DID+'User');
      O.GetWeak('User', D.UserID).AddView(UserView);
      this.AddChild(UserView);
      
      for ( var sField in this.Fields )
        this.Fields[sField].Update();
      
      var $Controls = J('#'+this.DID+'Controls');
      if ( D.CanEdit )
        $Controls.append(
          J('<a>', {id: this.DID+'EditTrigger', 'class': 'Control'}).text('Изменить')
            .click(function(){ t.Edit(); }) );
      if ( D.CanEdit && D.CanDelete )
        $Controls.append(' &sdot; ');
      if ( D.CanDelete )
        $Controls.append(
          J('<a>', {id: this.DID+'DeleteTrigger', 'class': 'Control'}).text('Удалить')
            .click(function(){ if ( confirm('Удалить сообщение?') ) M.Delete(); }) );
    }
    else {
      if ( _Hints.Sending ) {
        J('#'+this.DID+'DeleteTrigger').attr('disabled', true);
      }
      else if ( _Hints.Sending === false )
        if ( M.Res === true ) {
          J('#'+this.DID+'Edit').hide().empty();
          
          this.DeleteChild(this.EditView);
          this.EditView = null;
          
          J('#'+this.DID+'Text').show();
          J('#'+this.DID+'MsgBox').find('a.Control').removeAttr('disabled');
        }
        else {
          J('#'+this.DID+'DeleteTrigger').removeAttr('disabled');
        }
      
      if ( _Hints.Data ) {
        //var DocFields = this.FieldMap_Full.Get(_Hints.Data);
        for ( var sField in _Hints.Data )
          if ( this.Fields[sField] )
            this.Fields[sField].Update();
      }
    }
    
        Console.GroupEnd();
    return true;
  },
  
  
  Edit: function() {
    var M = this.Model;
    
    if ( this.EditView || M.bPending )
      return;
    
    this.bEditing = true;
    this.bEditChange = false;
    
    J('#'+this.DID+'Text').hide();
    J('#'+this.DID+'Edit').show();
    
    this.EditView = new CMsgEditView(this.DID+'Edit', true);
    M.AddView(this.EditView);
    this.AddChild(this.EditView);
    
    J('#'+this.DID+'EditTrigger').attr('Disabled', true);
  },
  
  
  CancelEdit: function() {
    if ( this.Model.bPending )
      return;
    
    J('#'+this.DID+'Edit').hide().empty();
    
    this.DeleteChild(this.EditView);
    this.EditView = null;
    
    J('#'+this.DID+'Text').show();
    J('#'+this.DID+'EditTrigger').removeAttr('Disabled');
  }
}
jsx.Extend(CMsgView, jsx.CView);



function CMsgEditView( _DID, _bExistingMode ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  this.bExistingMode = Boolean(_bExistingMode);
  
  this.bEditChange = false;
}
CMsgEditView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CMsgEditView.Update_');
        Console.Dir(_Hints);
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_MsgEdit
        .replace(/%IDP%/gi, this.DID).replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      var $FileUpload = J('#'+this.DID+'FilesForm');
      $FileUpload.fileUpload();
      M.SetFileUpload($FileUpload);
      
      var $Tbl = J('#'+this.DID+'Files');
      for ( var i = 0, File; File = M.aFiles[i]; i++ ) {
        var DID = this.DID+'File'+i;
        
        $Tbl.append( J('<tr>', {id: DID}) );
        
        var View = new CFileView(DID);
        File.AddView(View);
        this.AddChild(View);
      }
      
      J('#'+this.DID+'SendTrigger').unbind('click').click(function(){ t._Send(); });
      if ( this.bExistingMode ) {
        J('#'+this.DID+'Textarea').val(M.Data.Text).keyup(function(){ t._OnKeyUp(this); }).focus();
        J('#'+this.DID+'CancelTrigger').show()
          .unbind('click').click(function(){ t.Parent.CancelEdit(); });
      }
    }
    else {
      if ( _Hints.FilesChanged ) {
        var $Tbl = J('#'+this.DID+'Files');
        
        for ( var i = this.aChildren.length, File; File = M.aFiles[i]; i++ ) {
          var DID = this.DID+'File'+i;
          
          $Tbl.append( J('<tr>', {id: DID}) );
          
          var View = new CFileView(DID);
          File.AddView(View);
          this.AddChild(View);
        }
      }
      
      if ( _Hints.Sending ) {
        HideErrorMsg(this.DID);
        J('#'+this.DID+'ChangeIndicator').hide();
        J('#'+this.DID+'SendWait').show();
        J('#'+this.DID+'Textarea, #'+this.DID+'SendTrigger, #'+this.DID+'CancelTrigger')
          .attr('disabled', true);
      }
      else if ( _Hints.Sending === false && M.Res !== true ) {
        ShowErrorMsg(this.DID, M.Res ? M.Res : 'Ошибка');
        J('#'+this.DID+'SendWait').hide();
        J('#'+this.DID+'ChangeIndicator').show();
        J('#'+this.DID+'Textarea, #'+this.DID+'SendTrigger, #'+this.DID+'CancelTrigger')
          .removeAttr('disabled');
      }
    }
    
        Console.GroupEnd();
    return true;
  },
  
  
  InsertImage: function( _sFileName ) {
    InsertTextAtCursor(J('#'+this.DID+'Textarea').get(0), '[img]'+_sFileName+'[/img]');
  },
  
  
  _OnKeyUp: function( _El ) {
    var bEditChange = J(_El).val() != this.Model.Data.Text;
    
    if ( bEditChange != this.bEditChange ) {
      J('#'+this.DID+'ChangeIndicator').toggle();
      this.bEditChange = bEditChange;
    }
  },
  
  
  _Send: function() {
    this.Model.Send( J('#'+this.DID+'Textarea').val() );
  }
}
jsx.Extend(CMsgEditView, jsx.CView);



function CFile( _LocalFile, _Xhr ) {
  jsx.CModel.call(this);
  
  this.Local = _LocalFile;
  this.Xhr = _Xhr;
  this.Uploaded = null;
  this.UploadErrors = null;
}

CFile.prototype = {
  sClass: 'File',
  
  SetUploadedFile: function( _File ) {
    this.Uploaded = _File;
    
    this.InvalidateViews({Uploaded: true});
  },
  
  SetUploadErrors: function( _Errors ) {
    this.UploadErrors = _Errors || false;
    
    this.InvalidateViews({Uploaded: false});
  }
}
jsx.Extend(CFile, jsx.CModel);



function CFileView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
}
CFileView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CFileView.Update_');
    
    var t = this;
    var M = this.Model;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_File
        .replace(/%IDP%/gi, this.DID).replace(/%ImagesPrefix%/gi, C_sImagesPrefix) );
      
      if ( M.Uploaded ) {
        J('#'+this.DID+'Name').text(M.Uploaded.Name);
        J('#'+this.DID+'Size').text(M.Uploaded.Size);
        J('#'+this.DID+'InsertTrigger').show()
          .click(function(){ t.Parent.InsertImage(M.Uploaded.Name); });
      }
      else {
        J('#'+this.DID+'Name').text(M.Local.name);
        J('#'+this.DID+'Size').text(M.Local.size != null ? M.Local.size : '');
        
        if ( M.UploadErrors == null )
          J('#'+this.DID+'Wait').show();
        else
          ShowErrorMsg(this.DID, M.UploadErrors ? M.UploadErrors : 'Ошибка');
      }
    }
    else {
      J('#'+this.DID+'Wait').hide();
      
      if ( _Hints.Uploaded ) {
        J('#'+this.DID+'Name').text(M.Uploaded.Name);
        J('#'+this.DID+'Size').text(M.Uploaded.Size);
        J('#'+this.DID+'InsertTrigger').show()
          .click(function(){ t.Parent.InsertImage(M.Uploaded.Name); });
      }
      else if ( _Hints.Uploaded === false) {
        ShowErrorMsg(this.DID, M.UploadErrors ? M.UploadErrors : 'Ошибка');
      }
    }
    
        Console.GroupEnd();
    return true;
  }
}
jsx.Extend(CFileView, jsx.CView);



function CUser() {
  jsx.CModel.call(this);
  
  this.Data = {};
}

CUser.prototype = {
  sClass: 'User'
}
jsx.Extend(CUser, jsx.CModel);



function CUserView_Msg( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
}
CUserView_Msg.prototype = {
  OnModelAttach: function() {
    var D = this.Model.Data;
    
    this.Fields = {
      Login: new CViewField(D, 'Login', this.DID),
      Group: new CViewField_Proxy([this, this.RenderGroup])
    }
  },
  
  
  Update_: function( _Hints ) {
        Console.Group('CUserView_Msg.Update_');
    
    for ( var sField in this.Fields )
      this.Fields[sField].Update();
    
        Console.GroupEnd();
    return true;
  },
  
  
  RenderGroup: function() {
    var D = this.Model.Data;
    var $El = J('#'+this.DID+'Group');
    
    if ( D.Group == UserGroup_Admin )
      $El.text('Администратор').addClass('Admin').show();
    else
      $El.hide().empty().removeClass('Admin');
  }
}
jsx.Extend(CUserView_Msg, jsx.CView);
