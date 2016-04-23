var express= require('express');
var cheerio= require('cheerio');
var request= require('request');
var fs= require('fs');

var app=express();  //creating an express application
app.use(express.static(__dirname + '/public'));
app.get('/',function(req,res){
	//web_scraping script will come here --- function is a callback

	// *****scraping Dawn News*****
	url="http://www.dawn.com/";
	res.set('Content-Type', 'text/html');
	request(url,function(error,response,html){
		if(!error)
		{
			var $ = cheerio.load(html);
			// console.log(html);
			var headlines=[];
			var temp,temp2,link,img;

			temp=$("article[data-type='story']").children().first().children().first().text(); //for getting headline of top-story
			console.log("Dawn");
			temp2=$("article[data-type='story']").children().eq(2).text(); //getting body of top-story
			link=$("article[data-type='story']").children().eq(1).children().first().children().first().html();
			img=$("article[data-type='story']").children().eq(1).children().first().children().first().children().first().html();
			headlines.push({headline:temp,news:temp2,storyLink:link,image:img}); //pushing values in object
			var count=0;			
			// getting the rest of the stories-limit to 5 stories (total)
			$("article.story.soft-half--bottom[data-type='story']").each(function(){
				count++;
				if(count<5)
				{
					temp=$(this).children().eq(1).children().first().text(); //getting headline of story
					temp2=$(this).children().eq(3).text();  //getting body of story
					link=$(this).children().eq(2).children().first().children().first().html(); //getting html of news link -- separate href
					img=$(this).children().eq(2).children().first().children().first().children().first().html(); //getting html of image link
					headlines.push({headline:temp,news:temp2,storyLink:link,image:img}); //pushing values in object
				}
			});
			var json=JSON.stringify(headlines);
			fs.writeFile('public/dawn.json',json,function(err){ //writing results to file
				if(!err)
					console.log("output file created...");
			});
		}
	});

	// *****scraping BBC News*****
	url="http://www.bbc.com/news/";
	request(url,function(error,response,html){
		if(!error)
		{
			var $=cheerio.load(html);
			var headlines=[];
			var temp,temp2,link,img,count=0;
			console.log("BBC");
			temp=$(".top-story-header").children().first().text();
			temp2=$("#top-story").children().eq(3).text(); //body of news
			link="http://bbc.com"+$(".top-story-header").children().first().attr("href"); //story link
			img=$("#top-story").children().eq(1).children().first().attr("src");
			headlines.push({headline:temp,news:temp2,storyLink:link,image:img}); //pushing values in object
			$(".secondary-top-story").each(function(){
				temp=$(this).children().first().children().first().text();
				temp2=$(this).children().first().children().eq(1).text();
				link="http://bbc.com"+$(this).children().first().children().first().children().first().attr("href");
				img=$(this).children().first().children().first().children().first().children().first().attr("src");
				headlines.push({headline:temp,news:temp2,storyLink:link,image:img}); //pushing values in object
			});
			var json=JSON.stringify(headlines);
			fs.writeFile('public/bbc.json',json,function(err){ //writing results to file
				if(!err)
					console.log("next output created");
			});
		}
	});

	// *****scraping Express Tribune*****
	url="http://tribune.com.pk/";
	request(url,function(error,response,html){
		if(!error)
		{
			var $=cheerio.load(html);
			var headlines=[];
			var temp,temp2,link,img,count=0;
			temp=$("h1.title").children().first().text();
			console.log("Tribune");
			temp2=$("h1.title").next().children().eq(2).text();
			link=$("h1.title").children().first().attr("href");
			img=$("h1.title").next().children().first().children().first().attr("src");
			headlines.push({headline:temp,news:temp2,storyLink:link,image:img}); //pushing values in object
			$("h2.title").each(function(){
				count++;
				if(count<4)
				{
					temp=$(this).children().first().text();
					temp2=$(this).next().children().eq(2).text();
					link=$(this).children().first().attr("href");
					img=$(this).next().children().first().children().first().attr("src");
					headlines.push({headline:temp,news:temp2,storyLink:link,image:img}); //pushing values in object
				}
			});
			var json=JSON.stringify(headlines);
			fs.writeFile('public/tribune.json',json,function(err){ //writing results to file
				if(!err)
					console.log("next output created");
			});
		}
	});

	// *****scraping Al-Jazeera*****
	url="http://www.aljazeera.com/";
	request(url,function(error,response,html){
		if(!error)
		{
			var $=cheerio.load(html);
			var headlines=[];
			var temp,temp2,link,img,count=0;
			console.log("Al-Jazeera");
			temp=$("td.wp_posting_ws_right_head").children().first().text();
			temp2=$("td.wp_posting_ws_right_head").children().eq(2).text();
			link="http://aljazeera.com"+$("td.wp_posting_ws_right_head").children().first().attr("href");
			img=""; //image for top-story not available
			headlines.push({headline:temp,news:temp2,storyLink:link,image:img}); //pushing values in object
			$("a.indexText-Bold2.indexText-Font2").each(function(){
				count++;
				if(count<4)
				{
					temp=$(this).text();
					temp2=$(this).parent().next().next().text();
					link="http://aljazeera.com"+$(this).attr("href");
					img="http://aljazeera.com"+$(this).parent().prev().prev().prev().children().first().children().first().attr("src");
					headlines.push({headline:temp,news:temp2,storyLink:link,image:img}); //pushing values in object
				}
			});
			var json=JSON.stringify(headlines);
			fs.writeFile('public/aljazeera.json',json,function(err){ //writing results to file
				if(!err)
					console.log("next output created");
			});
		}
	});

	// *****scraping ABC News*****
	url="http://abcnews.go.com/";
	request(url,function(error,response,html){
		if(!error)
		{
			var $=cheerio.load(html);
			var headlines=[];
			var temp,temp2,link,img,count=0;
			console.log("ABC News");
			
			$("div.tho").each(function(){
				if(count<6)
				{
					temp=$(this).children().eq(1).children().eq(1).text();
					temp2=$(this).children().eq(1).children().eq(2).text();
					link="http://abcnews.go.com"+$(this).children().first().children().first().attr("href");
					img=$(this).children().first().children().first().children().first().attr("src");
					if(count%2==0)
						headlines.push({headline:temp,news:temp2,storyLink:link,image:img}); //pushing values in object
				}
				count++;
			});
			var json=JSON.stringify(headlines);
			fs.writeFile('public/abcnews.json',json,function(err){ //writing results to file
				if(!err)
					console.log("next output created");
			});
		}
	});
	setTimeout(function(){
		res.sendFile("index.html", {root: "."});	
	},10000);
	

}).listen(8095);
console.log("Server started...scraping content...");