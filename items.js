
var Itemarray = [];
var Host = "http://localhost/";

class registerItemClass
{
    constructor(item, obrazek,str, obr, gold)
	{
    this.item = item;
    this.obrazek = obrazek;
    this.str = str;
    this.obr = obr;
    this.gold = gold;
    }
  
    getItemObrazek()
    {
	return this.obrazek;
    }
	
	getItemInstance()
	{
	return this.item;	
	}
	
    getItemStr()
    {
	return this.str;
    }
	
	getItemObr()
	{
	return this.obr;	
	}

	getItemGold()
	{
	return this.gold;	
	}
}

function registerItem(instance, str, obr, gold)
{
	var item = new registerItemClass(instance,Host+"Strona/images/Items/"+instance+".PNG",str, obr, gold);
    Itemarray.push(item);	
};

function getItemObrazekByInstance(instance)
{
	var len = Itemarray.length;
    for (var i = 0; i < len; i++)
    {
		if(Itemarray[i].getItemInstance() == instance)
		{
		    return Itemarray[i].getItemObrazek();
			break;
		}
	}
}

function getItemDescriptionNote(instance)
{
	var len = Itemarray.length;
    for (var i = 0; i < len; i++)
    {
		if(Itemarray[i].getItemInstance() == instance)
		{
		    return Itemarray[i].getItemStr();
			break;
		}
	}
}

registerItem("ITMW_SHORTSWORD3", 20, 40, 75);
registerItem("ITMW_SHORTSWORD2", 10, 20, 250);