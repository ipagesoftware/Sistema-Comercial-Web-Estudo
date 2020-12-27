/**
 * @author IPAGE
 * @copyright 2013
 * @descrição  
 */
function IPAGE_comboBoxClass(){
  var myObj;
  /****************************************** MÉTODOS PÚBLICOS DA CLASS *****************************************/
  this.init = init; 
  this.clear = clear;
  this.listCount = listCount;
  this.addItem = addItem;
  this.listText = listText;
  this.listDataValue = listDataValue;
  this.listValue = listValue;
  this.listIndex = listIndex;
  this.removeItem = removeItem;
  this.findReg = findReg;
  this.unselectAllItens = unselectAllItens;
  this.selectAllItens = selectAllItens; 
  this.obj = obj;  
  /************************************************* init *******************************************************/
  function init(par){
    /*
      PROPRIEDADES PAR:
      {
        obj:
      }
    */        
    if(typeof(par)=='undefined')
    {
      par ={};
    }  
    par.obj = localInitialize(par.obj, 'Combo1');
    myObj = $("select#"+par.obj);
  }
  /************************************************* obj ********************************************************/
  function obj()
  {
    return myObj;
  }
  /************************************************* init *******************************************************/
  function localInitialize(_par, _default){
      if(typeof(_par)=='undefined')
      {
        _par = _default;
      }  
      return _par;
  }
  /************************************************* clear ******************************************************/
  function clear(){
    myObj.html("");
  }
  /************************************************* listIndex **************************************************/
  function listIndex(_index){
  	if(listIndex.arguments.length===0){    	 
  	   return myObj.prop("selectedIndex"); //TEMOS UM GET NA PARADA!	 
  	}
  	else{
    	 myObj.prop("selectedIndex",_index);     
  	}
    return null;        
  }
  /************************************************* listText ***************************************************/
  function listText(){
    return $("select#" + myObj.attr("id") + ">option:selected").text();
  }
  /************************************************* listDataValue ***************************************************/
  function listDataValue(data_value){
    return $("select#" + myObj.attr("id") + ">option:selected").attr(data_value);
  }  
  /************************************************* listValue **************************************************/
  function listValue(){
    return $("select#" + myObj.attr("id") + ">option:selected").val();
  }
  /************************************************* listCount **************************************************/
  function listCount(){
    return myObj.get(0).options.length;
  }
  /************************************************* addItem ****************************************************/
  function addItem(text, value){
    try{
      var selLength = listCount();
      var i=0;
      for(i = selLength - 1; i >= 0; i -- ){
        if(myObj.get(0).options[i].value === value){
          return;
        }
      }
      var newOpt = new Option(text, value);
      selLength = listCount();
      myObj.get(0).options[selLength] = newOpt;
    }
    catch(err){
      //
    }
  }
  /************************************************* removeItem *******************************************************/
  function removeItem(index){
    var selLength = listCount();
    if(selLength > 0){
      myObj.get(0).options[index] = null;
    }
  }
  /************************************************* selectAllItens ***************************************************/
  function selectAllItens(){
    allOptions(obj,true);
  }
  /************************************************* unselectAllItens *************************************************/
  function unselectAllItens(){
    allOptions(obj,false);
  }
  function findReg(criterio, byValue){
    try{
      var obj1;
      var j = listCount();
      if(j === 0){
        return -1;
      }
      for(i = 0; i < j; i ++ ){        
        listIndex(i);
        if(typeof(byValue)==='undefined'){
          byValue = true;
        }
        if(byValue===true)
        {
          if(listValue() === criterio){
            break;
          }
        }
        else
        {
          if(listText() === criterio){
            break;
          }          
        }
      }
    }
    catch(err){
      //
    }
    return - 1;
  }
  
  /****************************************** MÉTODOS PRIVADOS DA CLASS *****************************************/
  /*************************************************  allOptions ************************************************/    
  function allOptions(op){
    try{
      var c = listCount();
      if(typeof(op) === 'undefined'){
        op = true;
      }
      var modo = op;
      for(var i = 0; i < c; i ++ ){
        myObj.get(0).options[i].ed = modo;
      }
    }
    catch(err){
    }
  }   
}