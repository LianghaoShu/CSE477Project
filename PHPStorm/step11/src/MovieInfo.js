import $ from 'jquery';
import {parse_json} from "./parse_json";
import {Stars} from "./Stars";
export const MovieInfo = function(sel) {
    var that = this;
    this.selected = '#information';
    this.obj = $(sel);
    if(this.obj.length === 0) {
        return;
    }
    this.element = this.obj.get(0);
    var title = this.element.dataset.movie;
    var year = this.element.dataset.year;

    console.log(title);
    console.log(year);
    console.log('MovieInfo object installed');



    $.ajax({
        url: "https://api.themoviedb.org/3/search/movie",
        data: {api_key: "a348a86f2bebc7fc89f80184a94187c5", query:title, year: year},
        method: "GET",
        dataType: "text",
        success: function(data) {
            var json = parse_json(data);
            if(json.total_results === 0){
               that.obj.html("<p>No information available</p>");
            }
            else{

                that.tabs(json.results[0]);
                //console.log(that.obj.children(""));
                //that.intallListeners();
                $("ul > li > a").click(function(event) {
                    event.preventDefault();
                    that.obj.find(this).siblings('div').fadeIn(1000);
                    that.obj.find(this).children('img').css('opacity','1.0');
                    that.obj.find(this).parent('li').siblings('li').children('div').fadeOut(1000);
                    that.obj.find(this).parent('li').siblings('li').children('a').children('img').css("opacity",0.3);
                })



            }


        },
        error: function(xhr, status, error) {
            that.obj.html("<p>Unable to communicate<br>with themoviedb.org</p>");
        }
    });


}


MovieInfo.prototype.tabs = function(info) {
    var that = this;
    var str = "<ul>";

    str+= "<li><a href=\"\" ><img src=\"dist/img/info.png\" style='opacity: 1'></a>";
    str+= "<div class='show'>";
    str+= "<p>Title: "+info["title"]+"</p>";
    str+= "<p>Release Date: "+info["release_date"]+"</p>";
    str+= "<p>Vote average: "+info["vote_average"]+"</p>";
    str+= "<p>Vote count: "+info["vote_count"]+"</p>";
    str+= "</div>";
    str+= "</li>";

    str+= "<li><a href=\"\"><img src=\"dist/img/plot.png\"></a>";
    str+= "<div >";
    str+= "<p>"+info["overview"]+"</p>";
    str+= "</div>";
    str+= "</li>";

    if(info["poster_path"]){
        str+= "<li><a href=\"\" ><img src=\"dist/img/poster.png\"></a>";
        str+= "<div>";
        str+= "<p class=\"poster\"><img src=\""+ "http://image.tmdb.org/t/p/w500"+ info["poster_path"] +"\"></p>";
        str+= "</div>";
        str+= "</li>";
    }



    str+="<ul>";


    that.obj.html(str);


}





