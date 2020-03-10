jQuery(function(){

    var minimized_elements = $('p.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 100) return;
        
        $(this).html(
            t.slice(0,100)+'<span>... </span><a href="#" class="more" style="color:rgb(0,70,0);font-size:120%;">More</a>'+
            '<span style="display:none;">'+ t.slice(100,t.length)+' <a href="#" class="less" style="color:rgb(0,70,0);">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });

});

function seachas(x){
    document.getElementById("seacha").style.visibility='visible';
    document.getElementById("head").style.opacity=0.09;
    document.getElementById("contain").style.opacity=0.09;
 
if(x=="Search"){ 
       document.getElementById("seacha-top0").style.visibility='visible'; 
    }
else{
        document.getElementById("seacha-top1").style.visibility='visible';
    }
}
function seaback()
{
    document.getElementById("seacha").style.visibility='hidden';
    document.getElementById("head").style.opacity=1;
    document.getElementById("contain").style.opacity=1;
 

       document.getElementById("seacha-top0").style.visibility='hidden'; 



    document.getElementById("seacha-top1").style.visibility='hidden'; 
}
var st="0";
function showmen(x){
    if(st!="0"){
        document.getElementById(st).style.visibility='hidden'; 
    }
        document.getElementById(x).style.visibility='visible'; 
        st=x

}
