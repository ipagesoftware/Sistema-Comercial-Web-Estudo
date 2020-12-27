function selectClass(){
  this.clearOption = function(obj){
    var options = '';
    $("select#" + obj).html(options);
  };
  this.selectCount = function(obj){
    if(obj === undefined){
      return 0;
    }
    try{
      var i = $("select#" + obj).get(0).options.length;
      return i;
    }
    catch(err){
      return 0;
    }
    return 0;
  };
  this.notEqual = function(objname1, objname2){
    try{
      var lst1 = $("select#" + objname1);
      var lst2 = $("select#" + objname2);
      var obj1;
      var obj2;
      var j = $(lst2).get(0).options.length;
      var k = $(lst1).get(0).options.length;
      if(k === 0 || j === 0){
        return;
      }
      for(i = 0; i < j; i ++ ){
        obj2 = $(lst2).get(0).options[i].value;
        for(m = 0; m < k; m ++ ){
          obj1 = $(lst1).get(0).options[m].value;
          if(obj1 === obj2){
            this.deleteOption($(lst1).get(0).id, m);
            break;
          }
        }
      }
    }
    catch(err){
      //
    }
  };
  this.moveOptions = function(theSelFrom, theSelTo){
    try{
      var selLength = this.selectCount(theSelFrom);
      var selectedText = new Array();
      var selectedValues = new Array();
      var selectedCount = 0;
      var i;
      for(i = selLength - 1; i >= 0; i -- ){
        if($("#" + theSelFrom).get(0).options[i].selected){
          selectedText[selectedCount] = $("#" + theSelFrom).get(0).options[i].text;
          selectedValues[selectedCount] = $("#" + theSelFrom).get(0).options[i].value;
          this.deleteOption(theSelFrom, i);
          selectedCount ++ ;
        }
      }
      for(i = selectedCount - 1; i >= 0; i -- ){        
        this.addOption(theSelTo, selectedText[i], selectedValues[i]);
      }
      return selectedCount;
    }
    catch(err){
      //
    }
  };
  this.addOption = function(theSel, theText, theValue){
    try{
      var selLength = this.selectCount(theSel);
      var i;
      for(i = selLength - 1; i >= 0; i -- ){
        if($("#" + theSel).get(0).options[i].value === theValue){
          return;
        }
      }
      var newOpt = new Option(theText, theValue);
      selLength = this.selectCount(theSel);
      $("#" + theSel).get(0).options[selLength] = newOpt;
    }
    catch(err){
    }
  };
  this.deleteOption = function(theSel, theIndex){
    try{
      var selLength = $("#" + theSel).get(0).options.length;
      if(selLength > 0){
        $("#" + theSel).get(0).options[theIndex] = null;
      }
    }
    catch(err){
    }
  };
  this.selectAllOptions = function(obj, op){
    try{
      var c = this.selectCount(obj);
      if(typeof(op) === 'undefined'){
        op = true;
      }
      var modo = op;
      for(var i = 0; i < c; i ++ ){
        $("#" + obj).get(0).options[i].selected = modo;
      }
    }
    catch(err){
    }
  };
  this.findReg = function(objname1, criterio){
    try{
      var lst1 = $("select#" + objname1);
      var obj1;
      var j = $(lst1).get(0).options.length;
      if(j === 0){
        return -1;
      }
      for(i = 0; i < j; i ++ ){
        obj1 = $(lst1).get(0).options[i].value;
        if(obj1 === criterio){
          return i;
        }
      }
    }
    catch(err){
    }
    return - 1;
  };
}