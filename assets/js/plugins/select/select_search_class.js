function selectSearchClass(){
  var thisClass = this;
  this.SelObj = function(formname, objListBox, objText, str){
    thisClass.formname = formname; thisClass.objListBox = objListBox; thisClass.objText = objText;
    thisClass.select_str = str || '';
    thisClass.selectArr = new Array();
    thisClass.initialize();
    thisClass.bldInitial();
    thisClass.bldUpdate();
  };
  this.initialize = function(){
    var i=0;
    if(thisClass.select_str === '')
    {      
      for(i = 0; i < document.forms[thisClass.formname][thisClass.objListBox].options.length;i ++ )
      {
        thisClass.selectArr[i] = document.forms[thisClass.formname][thisClass.objListBox].options[i];
        thisClass.select_str += document.forms[thisClass.formname][thisClass.objListBox].options[i].value + ":" + document.forms[thisClass.formname][thisClass.objListBox].options[i].text + ",";
      }
    }
    else{
      var tempArr = thisClass.select_str.split(',');
      for(i = 0; i < tempArr.length; i ++ ){
        var prop = tempArr[i].split(':');
        thisClass.selectArr[i] = new Option(prop[1], prop[0]);
      }
    }
    return;
  };
  this.bldInitial = function(){
    thisClass.initialize();
    for(var i = 0; i < (thisClass.selectArr.length - 1);i ++ )
    {
      document.forms[thisClass.formname][thisClass.objListBox].options[i] = thisClass.selectArr[i];
    }
    document.forms[thisClass.formname][thisClass.objListBox].options.length = thisClass.selectArr.length;
    return;
  };
  this.bldUpdate = function(){
    var str = document.forms[thisClass.formname][thisClass.objText].value.replace('^\\s*', '');
    if(str === ''){
      thisClass.bldInitial();
      return;
    }
    thisClass.initialize();
    var j = 0;
    pattern1 = new RegExp("^" + str, "i");
    for(var i = 0; i < thisClass.selectArr.length; i ++ )
    {
      if(pattern1.test(thisClass.selectArr[i].text))
      {
        j++;
        document.forms[thisClass.formname][thisClass.objListBox].options[j ] = thisClass.selectArr[i];
      }
    }
    document.forms[thisClass.formname][thisClass.objListBox].options.length = j;
    if(j === 1){
      document.forms[thisClass.formname][thisClass.objListBox].options[0].selected = true;
    }
  };
}