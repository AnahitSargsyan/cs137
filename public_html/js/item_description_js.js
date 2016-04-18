/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Created by Arash Nase
 */


var global_id = "";
function set_id(clicked_id) {
    global_id = clicked_id;
}

// Global Variable (hat items) declaration
var donald_trump = {
    name:"Donald Trump",
    category:"Baseball Cap",
    color:"Red",
    material:"Cotton",
    price:1,
    desc:"Join the political movement sweeping the nation and help make america \n\
          great again with this hand crafted baseball cap. Turn heads wherever \n\
          you go and have awkward conversations with strangers about your misguided\n\
          political choices!",
    src:"img/hats/donald_trump.jpg",
    id: "donald_trump"
};

var armenian = {
    name:"Donald Trump",
    category:"Bucket Hat",
    color:"Multi",
    material:"Cotton",
    price:77,
    desc:"Beautiful rare Armenian hat",
    src:"img/hats/armenian.jpg",
    id: "armenian"
};

my_object = null;

function get_object() {
    switch(global_id) {
        case donald_trump.id:
            my_object = donald_trump;
            break;
        case armenian.id:
            my_object = armenian;
            break;
    }
}

function set_html(object) {
    document.getElementById('name').innerHTML = object.name;
    document.getElementById('color').innerHTML = object.color;
    document.getElementById('material').innerHTML = object.material;
    document.getElementById('price').innerHTML = "$" + object.price;
    document.getElementById('desc').innerHTML = object.desc;
}


//set_html(object);



/*
 *  <a href="item_description.html">
                    <img src="img/hats/armenian_bucket.jpg"  id="armenian" onClick="set_id(this.id)" alt ="Armenian Hat" height="200" weight = "200">
                </a>
 */