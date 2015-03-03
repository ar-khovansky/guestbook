var DBG = true;
var Console = jsx.Console;
Console.Init('EnableAll');

var O = jsx.ObjectRepository;

var g_Installer;



function Init() {
      Console.Group('Init');
  
  //if ( sInitErrors ) {
  //  ErrorConsoleWrite(sInitErrors);
  //  return;
  // }
  
  J.ajaxSetup({
    cache: false,
    timeout: C_GeneralTimeout,
    type: 'POST',
    success: OnAjaxSuccess_Global,
    error: OnAjaxError_Global
  });
  
  g_Installer = new CInstaller;
  var View = new CInstallerView('A_Contents');
  jsx.ViewManager.RegisterTopView(View);
  g_Installer.AddView(View);
  g_Installer.Update();
  
      Console.GroupEnd();
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function CInstaller() {
  jsx.CModel.call(this);
  
  this.Data = {};
  
  this.bUpdating = false;
  this.UpdateRes = null;
  this.bInstalling = false;
  this.InstallRes = null;
  this.SavingConfig = false;
  this.SaveConfigRes = null;
  
  this.sInstallLog = null;
}

CInstaller.prototype = {
  sClass: 'Installer',
  
  Update: function() {
    if ( this.bUpdating )
      return;
    
    this.UpdateRes = null;
    this.bUpdating = true;
    this.InvalidateViews({Updating: true});
    
    jsx.QueryManager.Query_Obj(this.GetRequestObject(), 'CheckInstall', null, [this,
      function( _Res ) {
            Console.Group("CInstaller 'CheckInstall' success callback");
        
        if ( _Res.Ok ) {
          this.UpdateData(_Res.Install);
          
          this.UpdateRes = true;
        }
        else
          this.UpdateRes = _Res.Errors || false;
        
            Console.GroupEnd();
      },
      function() {
            Console.Group("CInstaller 'CheckInstall' complete callback");
        
        this.bUpdating = false;
        this.InvalidateViews({Updating: false});
        
            Console.GroupEnd();
      }],
      true
    );
  },
  
  
  Install: function( _Params ) {
    if ( this.bInstalling || this.bUpdating )
      return;
    
    this.InstallRes = this.UpdateRes = null;
    this.bInstalling = this.bUpdating = true;
    this.InvalidateViews({Installing: true, Updating: true});
    
    jsx.QueryManager.PacketQuery(
      [ { Obj: this, Method: 'Install', Args: [_Params],
          CaptureErrors: true,
          Callback: function( _Res ) {
                Console.Group("CInstaller 'Install'(packet) success callback");
            
            this.sInstallLog = _Res.Log;
            
            this.InstallRes = _Res.Ok ? true : _Res.Errors || false;
            
                Console.GroupEnd();
        } }
      ],
      [this, function() {
            Console.Group("CInstaller 'Install/CheckInstall'(packet) complete callback");
        
        this.bInstalling = this.bUpdating = false;
        this.InvalidateViews({Installing: false, Updating: false});
        
            Console.GroupEnd();
      }]
    );
  },
  
  
  SaveConfig: function( _Params ) {
    this.SaveConfigRes = this.UpdateRes = null;
    this.bSavingConfig = this.bUpdating = true;
    this.InvalidateViews({SavingConfig: true, Updating: true});
    
    jsx.QueryManager.PacketQuery(
      [ { Obj: this, Method: 'SaveConfig', Args: [_Params], CaptureErrors: true,
          Callback: function( _Res ) {
                Console.Group("CInstaller 'SaveConfig'(packet) success callback");
            
            this.SaveConfigRes = _Res === true ? true : _Res.Errors || false;
            
                Console.GroupEnd();
        } },
        { Obj: this, Method: 'CheckInstall', CaptureErrors: true,
          Callback: function( _Res ) {
                Console.Group("CInstaller 'CheckInstall' success callback");
            
            if ( _Res.Ok ) {
              this.UpdateData(_Res.Install);
              
              this.UpdateRes = true;
            }
            else
              this.UpdateRes = _Res.Errors || false;
            
                Console.GroupEnd();
        } }
      ],
      [this, function() {
            Console.Group("CInstaller 'SaveConfig/CheckInstall'(packet) complete callback");
        
        this.bSavingConfig = this.bUpdating = false;
        this.InvalidateViews({SavingConfig: false, Updating: false});
        
            Console.GroupEnd();
      }]
    );
  },
  
  
  GetRequestObject: function() {
    return {Class: this.sClass};
  }
}
jsx.Extend(CInstaller, jsx.CModel);



function CInstallerView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.InstallView = null;
  this.ConfigView = null;
}
CInstallerView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CInstallerView.Update_');
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.Updating ) {
      //HideErrorMsg(this.DID);
      //J('#'+this.DID+'Wait').show();
    }
    else if ( _Hints.Updating === false ) {
      if ( M.UpdateRes === true ) {
        if ( D.InstallOk ) {
          if ( this.InstallView ) {
            this.DeleteChild(this.InstallView);
            this.InstallView = null;
          }
          
          if ( ! this.ConfigView ) {
            this.ConfigView = new CConfigView(this.DID);
            M.AddView(this.ConfigView);
            this.AddChild(this.ConfigView);
          }
        }
        else {
          if ( this.ConfigView ) {
            this.DeleteChild(this.ConfigView);
            this.ConfigView = null;
          }
          
          if ( ! this.InstallView ) {
            this.InstallView = new CInstallView(this.DID);
            M.AddView(this.InstallView);
            this.AddChild(this.InstallView);
          }
        }
      }
      
      //J('#'+this.DID+'Wait').hide();
    }
      
        Console.GroupEnd();
    return true;
  }
}
jsx.Extend(CInstallerView, jsx.CView);



function CInstallView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.Fields = {};
}
CInstallView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CInstallView.Update_');
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_A_Install
        .replace(/%IDP%/gi, this.DID).replace(/%TemplateDir%/gi, C_sTemplateDir) );
      
      this.Fields.DB_Host = new CFormField(this, 'DB_Host', null, true);
      this.Fields.DB_User = new CFormField(this, 'DB_User', null, true);
      this.Fields.DB_Password = new CFormField(this, 'DB_Password', null, true);
      this.Fields.DB_DBName = new CFormField(this, 'DB_DBName', null, true);
      
      this.Fields.AdminLogin =
        new CFormField(this, 'AdminLogin', null /*new CValidator(ValidationRules_Login)*/, true);
      this.Fields.AdminPassword =
        new CFormField(this, 'AdminPassword', null, true);
      this.Fields.AdminPassword2 =
        new CFormField(this, 'AdminPassword2', null, true);
      
      for ( var sField in this.Fields )
        this.Fields[sField].SetVal(D.Config && D.Config[sField]);
      
      J('#'+this.DID+'InstallBtn').click(function(){ t.Install(); });
      J('#'+this.DID+'GoToConfigTrigger').click(function(){ M.Update(); });
    }
    else
    if ( _Hints.Installing ) {
      J('#'+this.DID+'InstallWait').show();
      J('#'+this.DID+'InstallLog').hide();
      HideErrorMsg(this.DID+'Install');
      J('#'+this.DID+'GoToConfigTrigger').hide();
    }
    else if ( _Hints.Installing === false ) {
      if ( M.InstallRes === true ) {
        J('#'+this.DID+'GoToConfigTrigger').show();
      }
      else
        ShowErrorMsg(this.DID+'Install', M.InstallRes ? M.InstallRes : 'Ошибка');
      
      J('#'+this.DID+'InstallWait').hide();
      J('#'+this.DID+'InstallLog').html(M.sInstallLog.HtmlEncode().NewLinesToHtml()).show();
    }
      
        Console.GroupEnd();
    return true;
  },
  
  
  Install: function() {
    var Params = {};
    for ( var sField in this.Fields )
      if ( sField != 'AdminPassword2' )
        Params[sField] = this.Fields[sField].Val();
    
    this.Model.Install(Params);
  },
  
  
  // Form interface
  
  IDP: function() {
    return this.DID;
  },
  
  FieldValid: function( _sField, _bValid ) {
    $Btn = J('#'+this.DID+'InstallBtn');
    if ( jsx.Object.All_M(this.Fields, CFormField.prototype.Valid) &&
         this.Fields.AdminPassword.Val() == this.Fields.AdminPassword2.Val() )
      $Btn.removeAttr('disabled');
    else
      $Btn.attr('disabled', true);
  }
}
jsx.Extend(CInstallView, jsx.CView);



function CConfigView( _DID ) {
  jsx.CView.call(this);
  
  this.DID = _DID;
  
  this.Fields = {};
}
CConfigView.prototype = {
  Update_: function( _Hints ) {
        Console.Group('CConfigView.Update_');
    
    var t = this;
    var M = this.Model, D = M.Data;
    
    if ( _Hints.all ) {
      J('#'+this.DID).html( C_sTemplate_A_Config
        .replace(/%IDP%/gi, this.DID).replace(/%TemplateDir%/gi, C_sTemplateDir) );
      
      this.Fields.SiteTitle = new CFormField(this, 'SiteTitle');
      this.Fields.NumMsgsOnPage = new CFormField(this, 'NumMsgsOnPage');
      this.Fields.Template = new CFormField(this, 'Template');
      this.Fields.FileSystemEncoding = new CFormField(this, 'FileSystemEncoding');
      
      for ( var sField in this.Fields )
        this.Fields[sField].SetVal(D.Config && D.Config[sField]);
      
      J('#'+this.DID+'ApplyBtn').click(function(){ t.Apply(); });
    }
    else {
      if ( _Hints.SavingConfig ) {
        HideErrorMsg(this.DID+'Apply');
        J('#'+this.DID+'ApplyWait').show();
      }
      else if ( _Hints.SavingConfig === false ) {
        if ( M.SaveConfigRes === true ) {
        }
        else
          ShowErrorMsg(this.DID+'Apply', M.SaveConfigRes ? M.SaveConfigRes : 'Ошибка');
        
        J('#'+this.DID+'ApplyWait').hide();
      }
      
      if ( _Hints.Updating === false && M.UpdateRes === true )
        for ( var sField in this.Fields )
          this.Fields[sField].SetVal(D.Config && D.Config[sField]);
    }
      
        Console.GroupEnd();
    return true;
  },
  
  
  Apply: function() {
    var Params = {};
    for ( var sField in this.Fields )
      Params[sField] = this.Fields[sField].Val();
    
    this.Model.SaveConfig(Params);
  },
  
  
  // Form interface
  
  IDP: function() {
    return this.DID;
  },
  
  FieldValid: function( _sField, _bValid ) {
    $Btn = J('#'+this.DID+'ApplyBtn');
    if ( jsx.Object.All_M(this.Fields, CFormField.prototype.Valid) )
      $Btn.removeAttr('disabled');
    else
      $Btn.attr('disabled', true);
  }
}
jsx.Extend(CConfigView, jsx.CView);
